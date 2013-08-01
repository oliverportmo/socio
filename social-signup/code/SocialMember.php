<?php 
class SocialMember extends DataExtension {
	
	public static $db = array(	
		'Token' => 'Text',
		'Complete' => 'Boolean'
	);
	
	public static $has_many = array(
		'Identities' => 'SocialIdentity'	
	);
	
}