<?php

/*-----------------------------------------------------------------------------------*/
/* Get and Then Set the Theme Name
/*-----------------------------------------------------------------------------------*/

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
	// echo $themename;
}

/*-----------------------------------------------------------------------------------*/
/* Allow Formatting Within Info Boxes
/*-----------------------------------------------------------------------------------*/

function optionscheck_change_santiziation() 
{
	remove_filter( 'of_sanitize_info', 'of_sanitize_allowedtags' );
	add_filter( 'of_sanitize_info', 'sf_of_sanitize_allowedtags' );
}
add_action( 'admin_init','optionscheck_change_santiziation', 100 );

/*-----------------------------------------------------------------------------------*/
/* Define Optional Formatting
/*-----------------------------------------------------------------------------------*/

function sf_of_sanitize_allowedtags( $input ) 
{
	global $allowedtags;
	
	$allowedtags = array(
		'a' => array(
			'href'   => array(),
			'class'  => array(),
			'title'  => array(),
			'target' => array(),
			'rel'    => array()
		),
		'img' => array(
			'src'    => array(),
			'class'  => array(),
			'alt'    => array(),
			'width'  => array(),
			'height' => array()
		),
		'iframe' => array(
			'src'         => array(),
			'height'      => array(),
			'width'       => array(),
			'frameborder' => array()
		),
		'p' => array(
			'id'    => array(),
			'class' => array()
		),
		'bold' => array(
			'id'    => array(),
			'class' => array()
		),
		'ol' => array(
			'id'    => array(),
			'class' => array()
		),
		'li' => array(
			'id'    => array(),
			'class' => array()
		),
		'div' => array(
			'id'    => array(),
			'class' => array()
		),
		'span' => array(
			'id'    => array(),
			'class' => array()
		),
		'br' => array(),
		'strong' => array(),
		'em' => array()
	);
	
	$output = wpautop( wp_kses( $input, $allowedtags ) );
	
	return $output;
}

/*-----------------------------------------------------------------------------------*/
/* Define Theme Specific Options
/*-----------------------------------------------------------------------------------*/

function optionsframework_options() {
	
	// Background Defaults
	$theme_background_defaults = array('color' => '', 'image' => '', 'repeat' => '','position' => '','attachment'=>'');
	
	// Categories
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pages
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// Images Path
	$imagepath =  get_stylesheet_directory_uri() . '/images/';
		
	$options = array();						
	
	/*-----------------------------------------------------------------------------------*/
	/* Header Options
	/*-----------------------------------------------------------------------------------*/					
						
	$options[] = array( "name" => "Logo &amp; Favicon",
						"type" => "heading");	
	
	$options[] = array( "name" => "Custom Logo &amp; Favicon Options",
						"desc" => "Use the options below to customize the theme icon (favicon) and logo. The font used for the default Blocco logo is called <strong>Aventura</strong> and can be found on <a href='http://new.myfonts.com/fonts/sudtipos/aventura/&amp;refby=ca75' title='Aventura' target='_blank'>MyFonts.com</a>.",
						"type" => "info");
						
	$options[] = array( "name" => "Upload a Custom Logo Image",
						"desc" => "It is recommended that you use the original logo image as a template for your custom logo image.",
						"id" => "logo_image",
						"type" => "upload");								
	
	$options[] = array( "name" => "Upload a Custom Favicon Image",
						"desc" => "It is recommended that you use a square image (png or jpg) no larger than 50px by 50px in size.",
						"id" => "icon_image",
						"type" => "upload");								
							
	/*-----------------------------------------------------------------------------------*/
	/* Home Page Category
	/*-----------------------------------------------------------------------------------*/
	
	$options[] = array( "name" => "Featured Content",
						"type" => "heading");					
						
	$options[] = array( "name" => "Home Page Category Options",
						"desc" => "If you would like to replace <strong>Recent Posts</strong> on the home page with posts from a specified category, first enable and then configure the Home Page Category options below. Please note that enabling this option will disable pagination on the home page.",
						"type" => "info");
	
	$options[] = array( "name" => "Enable the Home Page Category",
						"desc" => "Click here to enable the <strong>Home Page Category</strong> option and then configure the options below.",
						"id" => "enable_home_category",
						"type" => "checkbox");
	
	$options[] = array( "name" => "Select the Home Page Category",
						"desc" => "Select the category from which you would like to display posts on the home page.",
						"id" => "home_category",
						"type" => "select",
						"options" => $options_categories);	
	
	$options[] = array( "name" => "Number of Posts",
						"desc" => "Enter the number of posts you would like to display on the home page.",
						"id" => "home_count",
						"std" => "12",
						"type" => "text");						
						
	/*-----------------------------------------------------------------------------------*/
	/* Custom Text Options
	/*-----------------------------------------------------------------------------------*/		
	
	$options[] = array( "name" => "Custom Text",
						"type" => "heading");			
						
	$options[] = array( "name" => "Custom Theme Text Options",
						"desc" => "Use the options below to customize theme text elements however you like. You can restore the default options at any time by clicking the <strong>Restore Defaults</strong> button (bottom left).",
						"type" => "info");
	
	$options[] = array( "name" => "Custom Home Page Menu Text",
						"desc" => "Enter the text you wish to use for the home page menu item in the sidebar.",
						"id" => "home_text",
						"std" => "Home",
						"type" => "text");
	
	$options[] = array( "name" => "Custom Search Field Text",
						"desc" => "Enter the text you wish to use for the search field within the sidebar.",
						"id" => "search_text",
						"std" => "Search for Something",
						"type" => "text");
						
	$options[] = array( "name" => "404 Page Text",
						"desc" => "Enter the text you wish to use for 404 (not found) pages.",
						"id" => "nothing_title_text",
						"std" => "Sorry, Nothing Here by That Name",
						"type" => "text");
						
	/*-----------------------------------------------------------------------------------*/
	/* Disable Enable Options
	/*-----------------------------------------------------------------------------------*/	
	
	$options[] = array( "name" => "Disable &amp; Enable",
						"type" => "heading");						
						
	$options[] = array( "name" => "Disable Theme Features and/or Information",
						"desc" => "Use the options below to disable or hide certain theme features and information such as mobile optimizations the post thumbnail grid lines, the post info box and miscellaneous post information.",
						"type" => "info");
						
	$options[] = array( "name" => "Disable Theme Features",
	   					"desc" => "",
	   					"id" => "disable_theme_features",
	   					"type" => "multicheck",
	   					"options" => array ( '1' => 'Disable Search Field', '2' => 'Disable Logo', '3' => 'Disable iPhone Optimizations', '4' => 'Disable iPad Optimizations' ));					
						
	$options[] = array( "name" => "Disable Post Features",
	   					"desc" => "",
	   					"id" => "disable_post_features",
	   					"type" => "multicheck",
	   					"options" => array ( '1' => 'Disable Post Thumbnail Grid Lines', '2' => 'Disable Post Comments' ));					
								  					
	$options[] = array( "name" => "Disable or Hide Post Info",
	   					"desc" => "",
	   					"id" => "disable_post_info",
	   					"type" => "multicheck",
	   					"options" => array ( '1' => 'Disable the Post Info Box', '2' => 'Hide the Post Author', '3' => 'Hide the Post Date', '4' => 'Hide the Post Categories', '5' => 'Hide the Post Comments Number' ));
	   					
	$options[] = array( "name" => "Disable PressTrends",
						"desc" => "We use PressTrends.io to gather information about how the Blocco theme is used. Disable PressTrends by checking this box.",
						"id" => "disable_presstrends",
						"type" => "checkbox");   					
	
	return $options;
}