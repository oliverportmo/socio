<?php
class SocialEntity extends DataObject {

	public static $db = array(
			'Title' => 'Varchar',
			'Description' => 'Text',
			'Link' => 'Text',
			'MaxCoins' => 'Int',
			'CPC' => 'Int'
	);

	public static $has_one = array(
			'Member' => 'Member'
	);

	public static $belongs_many_many = array(
			'CompletedMembers' => 'Member',
			'SkippedMembers' => 'Member'
	);

}