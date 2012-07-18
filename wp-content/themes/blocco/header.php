<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<!--
**********************************************************************************************

Designed and Built by Press75.com

**********************************************************************************************
-->

<head>
	<!--[if IE]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	
	<!-- Page Titles -->
	<title><?php bloginfo('name'); ?><?php wp_title('|'); ?></title>
	
	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<?php if (is_single() || is_page() ) : if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<meta name="description" content="<?php the_excerpt_rss(); ?>" />
	<?php endwhile; endif; elseif(is_home()) : ?>
	<meta name="description" content="<?php bloginfo('description'); ?>" />
	<?php endif; ?>
	
	<!-- Fix the Zoom Bug in Mobile Safari -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	
	<!-- Theme Styles -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css" type="text/css" media="screen" />
	<?php $disable_theme_features = of_get_option( 'disable_theme_features' ); if ($disable_theme_features['4'] == '0') { ?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style-ipad.css" type="text/css" media="screen" />
	<?php } if ($disable_theme_features['3'] == '0') { ?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style-iphone.css" type="text/css" media="screen" />
	<?php } ?>
	
	<!-- Pingback URL -->
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<!-- Custom Favicon -->
	<?php if (of_get_option('icon_image')) { ?>
	<?php $favicon_link = of_get_option('icon_image'); ?>
	<link rel="shortcut icon" href="<?php echo $favicon_link; ?>" />
	<link rel="apple-touch-icon" href="<?php echo $favicon_link; ?>" />
	<?php } ; ?>
	<?php if (is_singular() && get_option('thread_comments')) wp_enqueue_script('comment-reply'); ?>
	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php get_template_part( 'foreword' ); ?>