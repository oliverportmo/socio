<?php 
class SocialIdentity extends DataObject {
	
	public static $db = array(
		'Provider' => 'Varchar',
		'Token' => 'Text',
		'PreferredUsername' => 'Varchar'
	);
	
	public static $has_one = array(
		'Member' => 'Member'		
	);
	
}