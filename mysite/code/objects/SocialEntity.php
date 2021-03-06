<?php
class SocialEntity extends DataObject {

	public static $db = array(
			'Title' => 'Varchar',
			'Description' => 'Text',
			'Link' => 'Text',
			'MaxCoins' => 'Int',
			'CPC' => 'Int',
			'Type' => 'Enum("FacebookProfile, TwitterAccount, GoogleAccount, Website, FacebookPage, Tweet","FacebookPage")'
	);

	public static $has_one = array(
			'Member' => 'Member'
	);

	public static $belongs_many_many = array(
			'CompletedMembers' => 'Member',
			'SkippedMembers' => 'Member'
	);

}