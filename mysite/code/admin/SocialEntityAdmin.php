<?php
class SocialEntityAdmin extends ModelAdmin {

	public static $managed_models = array(
		'Website',
		'FaceBookPage',
		'FaceBookProfile',
		'TwitterProfile',
		'Tweet'
	);

	static $url_segment = 'socialentities';
	static $menu_title = 'Social Entities';
	static $menu_priority = 95;
	//static $menu_icon = 'mysite/img/icons/distributor-icon.pn';



}