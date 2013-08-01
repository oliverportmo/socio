<!DOCTYPE html>
<html lang="$ContentLocale">
<!--<![endif]-->
<!--[if IE 6 ]><html lang="$ContentLocale" class="ie ie6"><![endif]-->
<!--[if IE 7 ]><html lang="$ContentLocale" class="ie ie7"><![endif]-->
<!--[if IE 8 ]><html lang="$ContentLocale" class="ie ie8"><![endif]-->
<head>
	<% base_tag %>
	<title><% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> &raquo; $SiteConfig.Title</title>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	$MetaTags(false)
	
	<link href="mysite/css/main.css" rel="stylesheet" type="text/css" />
	<!--[if IE 8]><link href="mysite/css/ie8.css" rel="stylesheet" type="text/css" /><![endif]-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
</head>

<body>

	<% include Header %>


	<!-- Content container -->
	<div id="container">

		<% include Sidebar %>


		<!-- Content -->
		<div id="content">

		   $Layout

		</div>
		<!-- /content -->

	</div>
	<!-- /content container -->


	<% include Footer %>
</body>
</html>