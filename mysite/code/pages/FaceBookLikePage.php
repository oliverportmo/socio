<?php
class FaceBookLikePage extends Page {
	
}

class FaceBookLikePage_Controller extends Page_Controller {
	
	public function init() {
	
		parent::init();
		
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
	
		Requirements::customScript('
	
			function saveAction() {
	
				$("#action").load("'.$this->URLSegment.'/saveaction");
			}
						
			function skipAction() {
	
				$("#action").load("'.$this->URLSegment.'/skipaction");
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
			$sqlQuery->selectField('"SocialEntity"."ClassName" as SClass');
			$sqlQuery->selectField('"Member_CompletedEntities"."ID"');
			$sqlQuery->selectField('"Member_SkippedEntities"."ID"');
	
			$sqlQuery->addLeftJoin('Member_CompletedEntities', '"SocialEntity"."ID" = "Member_CompletedEntities"."SocialEntityID"');
			$sqlQuery->addLeftJoin('Member_SkippedEntities', '"SocialEntity"."ID" = "Member_SkippedEntities"."SocialEntityID"');
	
			$sqlQuery->addWhere('"SocialEntity"."ClassName" = \'Website\''); // liking of fb pages is not working at the moment - no callback from fb bug
			$sqlQuery->addWhere('"SocialEntity"."MemberID" != '.Member::currentUser()->ID);
			$sqlQuery->addWhere('MaxCoins > 0');
			$sqlQuery->addWhere('"Member_CompletedEntities"."SocialEntityID" IS NULL');
			$sqlQuery->addWhere('"Member_SkippedEntities"."SocialEntityID" IS NULL');
			
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
		
			if($this->getEntity()->SClass == 'Website')  {
	
				return '<div class="fb-like" data-href="'.$this->getEntity()->Link.'" data-send="false" data-width="450" data-show-faces="false"></div>';
	
			} elseif ($this->getEntity()->SClass == 'FaceBookPage') {
	
				return 'facebook page are temporarily unavailable';
	
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
			echo '<div class="alert alert-success">saved</div>';
		}
		
		
		
	}
	
	public function skipaction() {
	
		$member = Member::currentUser();
		$entity = DataObject::get_by_id('SocialEntity', $this->getEntity()->SID);
		$member->SkippedEntities()->add($entity);
		
		if($member->write()) {
			echo '<div class="alert">skipped</div>';
		}
		
	}
	
}