<?php
	/**
	* Add jQuery
	*/
	function add_jquery_script() {
	    wp_deregister_script( 'jquery' );
	    wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
	    wp_enqueue_script( 'jquery' );
	}
	add_action('wp_enqueue_scripts', 'add_jquery_script');
	
	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
	remove_action('wp_head', 'wp_generator');

	add_action( 'after_setup_theme', 'craig_theme_setup' );
	
	function craig_theme_setup() {
		// Add RSS links to <head> section
		add_theme_support( 'automatic-feed-links' );

	    //Support for Featured Images for posts or pages
	    add_theme_support( 'post-thumbnails' );

	    //Support for WP3 menus - create menus in the admin interface, then add them to widget areas in
	    //the theme (like, say, the Nav widget area). Menus are not baked into this theme.
	    add_theme_support( 'menus');
		
	}
   
    //enable shortcodes in widgets
    if (!is_admin()) {
        add_filter('widget_text', 'do_shortcode', 11);
    }

	// sidebars / widget areas: I have one in the header, nav, sidebar, and footer
    register_sidebar(array(
        'name' => 'Sidebar Widgets',
        'id'   => 'sidebar-widgets',
        'description'   => 'These are widgets for the sidebar.',
        //'before_widget' => '<div id="%1$s" class="widget %2$s">',
        //'after_widget'  => '</div>',
        'before_widget' => '',
        'after_widget' => '',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));