<?php
class WebsitePage extends Page {

}

class WebsitePage_Controller extends Page_Controller {

	private static $allowed_actions = array (
		'like',
		'tweet',
		'saveaction'
	);

	public function init() {

		parent::init();

		if($this->request->param('Action') == 'like')  {

			Requirements::customScript('

				$(document).ready(function() {
					$.ajaxSetup({ cache: true });
				  	$.getScript("//connect.facebook.net/nl_NL/all.js", function(){
				    	FB.init({
				      		appId: "544602052271665",
				      		channelUrl: "http://socio.local/socio/channel.php",
							status: true,
							cookie: true,
	      					xfbml: true
				    	});
						FB.Event.subscribe("edge.create",
	    					function(response) {
	        					saveAction();
	    					}
						);
				  	});
				});


			');

		}

		if($this->request->param('Action') == 'tweet')  {

			Requirements::customScript('

				    window.twttr = (function (d,s,id) {

      					var t, js, fjs = d.getElementsByTagName(s)[0];

      					if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;

     					js.src="https://platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);

      					return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });

    				}(document, "script", "twitter-wjs"));





			');

		}

		Requirements::customScript('

			function saveAction() {

				$("#action").load("'.$this->URLSegment.'/saveaction");
			}


		');




	}


	public function getEntity() {

		//check if
		// 1. url does not belong to current user
		// 2. url has sufficient coins
		// 3. url has not yet been completed or skipped

		if(Member::currentUser()) {

			$sqlQuery = new SQLQuery();

			$sqlQuery->setFrom('SocialEntity');
			$sqlQuery->selectField('*');
			$sqlQuery->selectField('"SocialEntity"."ID" as SID');
			$sqlQuery->selectField('"Member_CompletedEntities"."ID"');

			$sqlQuery->addLeftJoin('Member_CompletedEntities', '"SocialEntity"."ID" = "Member_CompletedEntities"."SocialEntityID"');

			$sqlQuery->addWhere('"SocialEntity"."MemberID" != '.Member::currentUser()->ID);
			$sqlQuery->addWhere('MaxCoins > 0');
			$sqlQuery->addWhere('"Member_CompletedEntities"."SocialEntityID" IS NULL');
			$sqlQuery->setOrderBy('"SocialEntity"."ID"');
			$sqlQuery->setLimit(1);
			$sqlQuery->setDistinct(true);

			$result = $sqlQuery->execute();
			
			$entities = new ArrayList();
			foreach($result as $row) { 
    			$entities->push(new ArrayData($row)); 
			}
			
			return $entities->First();

		} else {

			return false;

		}


	}

	public function Action() {

		if($this->getEntity()) {


			$link = $this->getEntity()->Link;
			$title = $this->getEntity()->Title;

			if($this->request->param('Action') == 'like')  {

				return '<div class="fb-like" data-href="'.$link.'" data-send="false" data-width="450" data-show-faces="false"></div>';

			} else if ($this->request->param('Action') == 'tweet') {

				return '<a href="https://twitter.com/share" class="twitter-share-button" data-lang="nl" data-size="large" data-count="none" data-url="'.$link.'" data-text="'.$title.'">Tweet</a>
						<script>twttr.ready(function(twttr) { twttr.events.bind("tweet", function (event) { saveAction(); });});</script>';

			} else {

				return 'no action set';

			}

		} else {

			return 'no more items';
		}

	}

	public function saveaction() {

		$member = Member::currentUser();
		$entity = DataObject::get_by_id('SocialEntity', $this->getEntity()->SID);
		$member->CompletedEntities()->add($entity);
		if($member->write()) {
			echo 'saved';
		}
	}

}