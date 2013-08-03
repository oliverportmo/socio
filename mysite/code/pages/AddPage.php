<?php
class AddPage extends Page {
	
	private static $db = array(
		'EntityType' => 'Enum("Accounts,Websites,FacebookPages,Tweets","Accounts")'
	);
	function getCMSFields() {
		$fields = parent::getCMSFields ();
	
		$fields->addFieldToTab ( 'Root.Main', new DropdownField('EntityType','EntityType', array("Accounts" => "Accounts","Websites" => "Websites","FacebookPages" => "FacebookPages","Tweets" => "Tweets")), 'Content' );
	
		return $fields;
	}
	
}

class AddPage_Controller extends Page_Controller {
	
	private static $allowed_actions = array ('FacebookForm','TwitterForm','GoogleForm','addEntity');
	public function init() {
		parent::init ();
		
		Requirements::customScript('
		
			$("input.action").on("click", function () {
				$("form").each(function () {
			        post_form_data($(this).serialize());
			    });
				return false;
			});
			    		
			function post_form_data(data) {
			    $.ajax({
			        type: "POST",
			        url: "'.$this->Link().'addEntity",
			        data: data,
			        success: function () {},
			        error: function () {}
			    });
			}
		
		
		');

		
	}
	
	public function FacebookForm() {
		
		$fb = DataList::create('SocialEntity')->where('"MemberID" = '.Member::currentUserID().' AND "Type" = \'FacebookProfile\'')->sort('Created','DESC')->limit(1);
		if($fb->First()) {
			
			$fblink1 = $fb->First()->Link;
			$fbextraclass = 'success';
			$fbdesc1 = $fb->First()->Desc;
			$fbcpc1 = $fb->First()->CPC;
			$fbmax1 = $fb->First()->MaxCoins;
			$fbid = $fb->First()->ID;
			
		} else {
			
			$fblink1 = "http://";
			$fbextraclass = '';
			$fbdesc1 = '';
			$fbcpc1 = '5';
			$fbmax1 = '10';
			$fbid = '';
			
		}
		
		
		$fields = new FieldList(
			TextField::create('FacebookProfile', 'Facebook Profile')->addExtraClass('input-xxlarge ')->setRightTitle($fbextraclass)->setAttribute('value', $fblink1)->setAttribute('type', 'url'),
			TextareaField::create('FacebookDescription', 'Tell us why people should follow you', $fbdesc1)->addExtraClass('input-xxlarge auto')->setAttribute('maxlength', '300'),
			NumericField::create('FacebookCPC', 'How many credits per follow', $fbcpc1)->addExtraClass('input-small')->setDescription('extra info')->setAttribute('type', 'number'),
			NumericField::create('FacebookMax', 'Max. amount of credits to spend', $fbmax1)->addExtraClass('input-small')->setDescription('extra info')->setAttribute('type', 'number'),
			HiddenField::create('FacebookID', 'FacebookID', $fbid)
	);
			
		$action = new FieldList(
			FormAction::create("addEntity")->setTitle("Save")->addExtraClass('btn btn-primary')
		);
		
		$required = new RequiredFields(
			array()
		);
		
		$form = new StyledForm($this, "FacebookForm", $fields, $action, $required);
		
		return $form;
		
	}
	
	public function TwitterForm() {
	
		$tw = DataList::create('SocialEntity')->where('"MemberID" = '.Member::currentUserID().' AND "Type" = \'TwitterAccount\'')->sort('Created','DESC')->limit(1);
				
		if($tw->First()) {
				
			$twlink1 = $tw->First()->Link;
			$twextraclass = 'success';
			$twdesc1 = $tw->First()->Desc;
			$twcpc1 = $tw->First()->CPC;
			$twmax1 = $tw->First()->MaxCoins;
			$twid = $tw->First()->ID;
				
		} else {
				
			
			$twlink1 = "http://";
			$twextraclass = '';
			$twdesc1 = '';
			$twcpc1 = '5';
			$twmax1 = '10';
			$twid = '';
			
				
		}
	
	
		$fields = new FieldList(
				TextField::create('TwitterAccount', 'Twitter Account')->addExtraClass('input-xxlarge')->setAttribute('value', $twlink1)->setAttribute('type', 'url'),
				TextareaField::create('TwitterDescription', 'Tell us why people should follow you', $twdesc1)->addExtraClass('input-xxlarge auto')->setAttribute('maxlength', '300'),
				NumericField::create('TwitterCPC', 'How many credits per follow', $twcpc1)->addExtraClass('input-small')->setDescription('extra info')->setAttribute('type', 'number'),
				NumericField::create('TwitterMax', 'Max. amount of credits to spend', $twmax1)->addExtraClass('input-small')->setDescription('extra info')->setAttribute('type', 'number'),
				HiddenField::create('TwitterID', 'TwitterID', $twid)
		);
			
		$action = new FieldList(
				FormAction::create("addEntity")->setTitle("Save")->addExtraClass('btn btn-primary')
		);
	
		$required = new RequiredFields(
				array()
		);
	
		$form = new StyledForm($this, "TwitterForm", $fields, $action, $required);
	
		return $form;
	
	}
	
	public function GoogleForm() {
	
		$gl = DataList::create('SocialEntity')->where('"MemberID" = '.Member::currentUserID().' AND "Type" = \'GoogleAccount\'')->sort('Created','DESC')->limit(1);
	
		if($gl->First()) {
	
			$gllink1 = $gl->First()->Link;
			$glextraclass = 'success';
			$gldesc1 = $gl->First()->Desc;
			$glcpc1 = $gl->First()->CPC;
			$glmax1 = $gl->First()->MaxCoins;
			$glid = $gl->First()->ID;
	
		} else {
	
				
			$gllink1 = "http://";
			$glextraclass = '';
			$gldesc1 = '';
			$glcpc1 = '5';
			$glmax1 = '10';
			$glid = '';				
	
		}
	
	
		$fields = new FieldList(
				TextField::create('GoogleAccount', 'Google+ Account')->addExtraClass('input-xxlarge')->setAttribute('value', $gllink1)->setAttribute('type', 'url'),
				TextareaField::create('GoogleDescription', 'Tell us why people should follow you', $gldesc1)->addExtraClass('input-xxlarge auto')->setAttribute('maxlength', '300'),
				NumericField::create('GoogleCPC', 'How many credits per follow', $glcpc1)->addExtraClass('input-small')->setDescription('extra info')->setAttribute('type', 'number'),
				NumericField::create('GoogleMax', 'Max. amount of credits to spend', $glmax1)->addExtraClass('input-small')->setDescription('extra info')->setAttribute('type', 'number'),
				HiddenField::create('GoogleID', 'GoogleID', $twid)
		);
			
		$action = new FieldList(
				FormAction::create("addEntity")->setTitle("Save")->addExtraClass('btn btn-primary')
		);
	
		$required = new RequiredFields(
				array()
		);
	
		$form = new StyledForm($this, "GoogleForm", $fields, $action, $required);
	
		return $form;
	
	}
	
	
	
	public function addEntity($data, Form $form) {
		echo 'received'. $data['GoogleAccount'];
		print_r($data);
		
	}
	
	
}