<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<!-- Mobile viewport optimized: j.mp/bplateviewport -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
<!-- Force a page reload every hour & don't cache anything -->
<meta http-equiv="refresh" content="3600">
<meta http-equiv="pragma" content="nocache">

<title><?php wp_title('|', true, 'left'); ?></title>

<!-- Included Foundation CSS Files -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/foundation.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/app.css">
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">

<!--[if lt IE 9]>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie.css">
<![endif]-->

<!-- IE Fix for HTML5 Tags -->
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Google Web Fonts
	 Find one you like at http://www.google.com/webfonts
	 Change line 74 in /css/foundation.css to include the updated font name	-->
<link href='http://fonts.googleapis.com/css?family=Magra:700,400' rel='stylesheet' type='text/css'>

<link href="<?php echo get_template_directory_uri(); ?>/css/fontawesome.css" rel="stylesheet" media="screen and (min-width: 767px)" type='text/css'>
<link href="<?php echo get_template_directory_uri(); ?>/css/climacons.css" rel="stylesheet" media="screen and (min-width: 767px)" type='text/css'>


<script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.foundation.js"></script>


<?php wp_head(); ?>

</head>

<body id="body">

<div id="container" class="container" role="document">
<!-- <div id="location" class="hide-for-small"><?php $str = site_url(); $regex = '/(?<!href=["\'])http:\/\//';	$str = preg_replace($regex, '', $str); echo $str; ?></div>	-->
<!-- Row for main content area -->
