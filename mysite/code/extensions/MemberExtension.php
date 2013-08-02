<?php
class MemberExtension extends DataExtension {

	public static $db = array(
		'TotalCoins' => 'Int',
		'Type' => 'Enum("Regular,Pro","Regular")'
	);

	public static $has_many = array(
		'SocialEntities' => 'SocialEntity'
	);

	public static $many_many = array(
		'CompletedEntities' => 'SocialEntity',
		'SkippedEntities' => 'SocialEntity'
	);

}