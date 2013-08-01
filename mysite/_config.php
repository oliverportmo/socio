<?php

Director::set_environment_type("dev");

global $project;
$project = 'mysite';

global $databaseConfig;
$databaseConfig = array(
	"type" => 'MySQLDatabase',
	"server" => 'localhost',
	"username" => 'root',
	"password" => 'alixanna',
	"database" => 'SS_socio',
	"path" => '',
);

// Set the site locale
i18n::set_locale('en_US');

//Security::setDefaultAdmin('admin', 'admin');

Object::add_extension('Member', 'MemberExtension');