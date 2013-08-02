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
	
	private static $allowed_actions = array ('addEntity');
	public function init() {
		parent::init ();

		
	}
	
	public function FacebookForm() {
		
		if($fb = DataList::create('SocialEntity')->where('"MemberID" = '.Member::currentUserID().' AND "Type" = \'FacebookProfile\'')->sort('Created','DESC')->limit(3)) {
			
			$fbvalue1 = $fb[0]->Link;
			
		} else {
			
			$fb = array();
			$fbvalue1 = "http://";
			
		}
		
		
		$fields = new FieldList(
			TextField::create('FacebookProfile', 'Facebook Profile')->addExtraClass('input-xxlarge')->setAttribute('value', $fbvalue1),
			TextareaField::create('FacebookDescription', 'Tell us why people should follow you', $fb[0]->Description)->addExtraClass('input-xxlarge auto')->setAttribute('maxlength', '300'),
			NumericField::create('FacebookCPC', 'How many credits per follow', $fb[0]->CPC ? $fb[0]->CPC : 5)->addExtraClass('input-small')->setDescription('extra info'),
			NumericField::create('FacebookMax', 'Max. amount of credits to spend', $fb[0]->MaxCoins ? $fb[0]->MaxCoins : 50)->addExtraClass('input-small')->setDescription('extra info')
		);
			
		$action = new FieldList(
			FormAction::create("addEntity")->setTitle("Save")->addExtraClass('btn btn-primary')
		);
		
		$required = new RequiredFields(
			array()
		);
		
		$form = new StyledForm($this, "EntityForm", $fields, $action, $required);
		
		return $form;
		
	}
	
	public function TwitterForm() {
	
		if($tw = DataList::create('SocialEntity')->where('"MemberID" = '.Member::currentUserID().' AND "Type" = \'TwitterAccount\'')->sort('Created','DESC')->limit(3)) {
				
			$twvalue1 = $tw[0]->Link;
				
		} else {
				
			$tw = array();
			$twvalue1 = "http://";
				
		}
	
	
		$fields = new FieldList(
				TextField::create('TwitterAccount', 'Facebook Profile')->addExtraClass('input-xxlarge')->setAttribute('value', $twvalue1),
				TextareaField::create('TwitterDescription', 'Tell us why people should follow you', $fb[0]->Description)->addExtraClass('input-xxlarge auto')->setAttribute('maxlength', '300'),
				NumericField::create('TwitterCPC', 'How many credits per follow', $fb[0]->CPC ? $fb[0]->CPC : 5)->addExtraClass('input-small')->setDescription('extra info'),
				NumericField::create('TwitterMax', 'Max. amount of credits to spend', $fb[0]->MaxCoins ? $fb[0]->MaxCoins : 50)->addExtraClass('input-small')->setDescription('extra info')
		);
			
		$action = new FieldList(
				FormAction::create("addEntity")->setTitle("Save")->addExtraClass('btn btn-primary')
		);
	
		$required = new RequiredFields(
				array()
		);
	
		$form = new StyledForm($this, "EntityForm", $fields, $action, $required);
	
		return $form;
	
	}
	
	
	
	public function addEntity() {
		
	}
	
	
}