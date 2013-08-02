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
		
		if(!$fb = DataList::create('SocialEntity')->where('"MemberID" = '.Member::currentUserID().' AND "Type" = \'FacebookProfile\'')->sort('Created','DESC')->limit(3)) {
			
			$fb = array();
			
		} 
		
		$fields = new FieldList(
			TextField::create('FacebookProfile', 'Facebook Profile', $fb[0]->Link),
			TextareaField::create('FacebookDescription', 'Tell us why people should follow you', $fb[0]->Description),
			NumericField::create('FacebookCPC', 'How many credits per follow', $fb[0]->CPC ? $fb[0]->CPC : 5),
			NumericField::create('FacebookMax', 'Max. amount of credits to spend', $fb[0]->MaxCoins ? $fb[0]->MaxCoins : 50)
		);
			
		$action = new FieldList(
			FormAction::create("addEntity")->setTitle("")
		);
		
		$required = new RequiredFields(
			array()
		);
		
		$form = new Form($this, "EntityForm", $fields, $action, $required);
		
		return $form;
		
	}
	
	
	
	public function addEntity() {
		
	}
	
	
}