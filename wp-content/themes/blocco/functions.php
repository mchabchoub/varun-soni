<?php

define('THEME', get_template_directory_uri(), true);

/*-----------------------------------------------------------------------------------*/
/* Options Framework Helper Function
/*-----------------------------------------------------------------------------------*/
 
if ( !function_exists( 'of_get_option' ) ) {
	function of_get_option($name, $default = false) {
	 
	    $optionsframework_settings = get_option('optionsframework');
	 
	    // Gets the Unique Option ID
	    $option_name = $optionsframework_settings['id'];
	 
	    if ( get_option($option_name) ) {
	        $options = get_option($option_name);
	    }
	 
	    if ( isset($options[$name]) ) {
	        return $options[$name];
	    } else {
	        return $default;
	    }
	}
}

/*-----------------------------------------------------------------------------------*/
/* Check for the Options Framework Plugin
/*-----------------------------------------------------------------------------------*/

add_action( 'admin_init', 'sf_of_check' );

function sf_of_check() {
	if ( ! function_exists( 'optionsframework_init' ) ) {
		add_thickbox(); // Required for the plugin install dialog.
		add_action( 'admin_notices', 'sf_of_check_notice' );
	}
}

function sf_of_check_notice() {
	if ( ! current_user_can( 'install_plugins' ) ) return;
?>	
	<div class="updated fade">
		<p>The Options Framework plugin is required for this theme to function properly. <a href="<?php echo admin_url('plugin-install.php?tab=plugin-information&plugin=options-framework&TB_iframe=true&width=640&height=517'); ?>" class="thickbox onclick">Click Here</a> to install and activate this required plugin.</p>
	</div>

<?php
}

/*-----------------------------------------------------------------------------------*/
/* WordPress Compliance
/*-----------------------------------------------------------------------------------*/

if ( ! isset( $content_width ) ) $content_width = 660;

function wporg_compliance() {
	paginate_comments_links();
	get_the_tag_list();
	posts_nav_link();
	paginate_links();
	next_posts_link();
	previous_posts_link();
	add_editor_style();
	add_custom_background();
	add_custom_image_header();
}

/*-----------------------------------------------------------------------------------*/
/* RSS Feed Links
/*-----------------------------------------------------------------------------------*/

add_theme_support( 'automatic-feed-links' );

/*-----------------------------------------------------------------------------------*/
/* Required Theme Scripts
/*-----------------------------------------------------------------------------------*/

function sf_theme_js() {
	if (is_admin()) return;
	wp_enqueue_script('jquery');
	wp_enqueue_script('menu', THEME . '/scripts/menu.js', 'jquery', '1.0');
	wp_enqueue_script('fitvids', THEME . '/scripts/fitvids.js', 'jquery', '1.0');
}
add_action('init', 'sf_theme_js');

/*-----------------------------------------------------------------------------------*/
/* Register Custom Menus and Create Default Menus
/*-----------------------------------------------------------------------------------*/

add_action('init', 'register_custom_menu');
 
function register_custom_menu() {
	global $pagenow;

	register_nav_menu( 'first_menu', __('First Menu') );
	
	register_nav_menu( 'second_menu', __('Second Menu') );
	
	if ( is_admin() && ( isset( $_GET['activated'] ) && 'themes.php' == $pagenow ) ) {
		if ( !is_nav_menu( 'Second Menu' ) ) {
			$menu_id = wp_create_nav_menu( 'Social Menu' );
	
	      	$menu_twitter = array( 'menu-item-type' => 'custom', 'menu-item-url' => 'http://www.twitter.com/','menu-item-title' => 'Twitter', 'menu-item-attr-title' => 'Twitter', 'menu-item-classes' => 'twitter' );
	      	$menu_facebook = array( 'menu-item-type' => 'custom', 'menu-item-url' => 'http://www.facebook.com/','menu-item-title' => 'Facebook', 'menu-item-attr-title' => 'Facebook', 'menu-item-classes' => 'facebook' );
	      	$menu_google = array( 'menu-item-type' => 'custom', 'menu-item-url' => 'http://plus.google.com/','menu-item-title' => 'Google+', 'menu-item-attr-title' => 'Google+', 'menu-item-classes' => 'google-plus' );
	      	$menu_dribbble = array( 'menu-item-type' => 'custom', 'menu-item-url' => 'http://www.dribbble.com/','menu-item-title' => 'Dribbble', 'menu-item-attr-title' => 'Dribbble', 'menu-item-classes' => 'dribbble' );
	      	$menu_vimeo = array( 'menu-item-type' => 'custom', 'menu-item-url' => 'http://www.vimeo.com/','menu-item-title' => 'Vimeo', 'menu-item-attr-title' => 'Vimeo', 'menu-item-classes' => 'vimeo' );
	      	$menu_youtube = array( 'menu-item-type' => 'custom', 'menu-item-url' => 'http://www.youtube.com/','menu-item-title' => 'YouTube', 'menu-item-attr-title' => 'YouTube', 'menu-item-classes' => 'youtube' );
	      	$menu_subscribe = array( 'menu-item-type' => 'custom', 'menu-item-url' => get_home_url('/feed/'),'menu-item-title' => 'Subscribe', 'menu-item-attr-title' => 'Subscribe', 'menu-item-classes' => 'subscribe' );
	
	     	wp_update_nav_menu_item( $menu_id, 0, $menu_twitter );
	     	wp_update_nav_menu_item( $menu_id, 0, $menu_facebook );
	     	wp_update_nav_menu_item( $menu_id, 0, $menu_google );
	     	wp_update_nav_menu_item( $menu_id, 0, $menu_dribbble );
	     	wp_update_nav_menu_item( $menu_id, 0, $menu_vimeo );
	     	wp_update_nav_menu_item( $menu_id, 0, $menu_youtube );
	      	wp_update_nav_menu_item( $menu_id, 0, $menu_subscribe );
	
			set_theme_mod( 'nav_menu_locations', array(
				'second_menu' => $menu_id,
			) );
		}
	}
	
	register_nav_menu( 'third_menu', __('Third Menu') );
}

/*-----------------------------------------------------------------------------------*/
/* Define Post Thumbnails
/*-----------------------------------------------------------------------------------*/

if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(260, 186, true);
    add_image_size('single', 660, 440, true);
    add_image_size('gallery', 219, 219, true);
}

/*-----------------------------------------------------------------------------------*/
/* Unregister Non-Compatible Widgets
/*-----------------------------------------------------------------------------------*/

function unregister_default_wp_widgets() {
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Akismet');
	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Akismet');
	unregister_widget('WP_Nav_Menu_Widget');
}
 
add_action('widgets_init', 'unregister_default_wp_widgets', 11);

/*-----------------------------------------------------------------------------------*/
/* PressTrends.io
/*-----------------------------------------------------------------------------------*/

if (of_get_option('disable_presstrends') == '0') {
	function presstrends() {
	$api_key = '0cvrc8pzevl1d1lt2dyipf8cw4xh1tvzzfq6';
	$auth = '10hkwhadxjvvvcljrqdzhdg9lf9o7hg85';
	$data = get_transient( 'presstrends_data' );
	if (!$data || $data == ''){
	$api_base = 'http://api.presstrends.io/index.php/api/sites/add/auth/';
	$url = $api_base . $auth . '/api/' . $api_key . '/';
	$data = array();
	$count_posts = wp_count_posts();
	$count_pages = wp_count_posts('page');
	$comments_count = wp_count_comments();
	$theme_data = get_theme_data(get_stylesheet_directory() . '/style.css');
	$plugin_count = count(get_option('active_plugins'));
	$all_plugins = get_plugins();
	foreach($all_plugins as $plugin_file => $plugin_data) {
	$plugin_name .= $plugin_data['Name'];
	$plugin_name .= '&';
	}
	$data['url'] = stripslashes(str_replace(array('http://', '/', ':' ), '', site_url()));
	$data['posts'] = $count_posts->publish;
	$data['pages'] = $count_pages->publish;
	$data['comments'] = $comments_count->total_comments;
	$data['approved'] = $comments_count->approved;
	$data['spam'] = $comments_count->spam;
	$data['theme_version'] = $theme_data['Version'];
	$data['theme_name'] = $theme_data['Name'];
	$data['site_name'] = str_replace( ' ', '', get_bloginfo( 'name' ));
	$data['plugins'] = $plugin_count;
	$data['plugin'] = urlencode($plugin_name);
	$data['wpversion'] = get_bloginfo('version');
	foreach ( $data as $k => $v ) {
	$url .= $k . '/' . $v . '/';
	}
	$response = wp_remote_get( $url );
	set_transient('presstrends_data', $data, 60*60*24);
	}}
	add_action('admin_init', 'presstrends');
}

/*-----------------------------------------------------------------------------------*/
/* Load Custom Post Options
/*-----------------------------------------------------------------------------------*/

include("includes/post-video.php");

/*-----------------------------------------------------------------------------------*/
/* Custom Pagination Function
/*-----------------------------------------------------------------------------------*/

function sf_pagenavi($before = '', $after = '', $prelabel = '', $nxtlabel = '', $pages_to_show = 5, $always_show = false) {
	global $request, $posts_per_page, $wpdb, $paged;
	if(empty($prelabel)) {   $prelabel = '';
		} if(empty($nxtlabel)) {
		$nxtlabel = '';
	} $half_pages_to_show = round($pages_to_show/2);
	if (!is_single()) {
		if(!is_category()) {
		preg_match('#FROM\s(.*)\sORDER BY#siU', $request, $matches);  } else {
		preg_match('#FROM\s(.*)\sGROUP BY#siU', $request, $matches);  }
		$fromwhere = $matches[1];
		$numposts = $wpdb->get_var("SELECT COUNT(DISTINCT ID) FROM $fromwhere");
		$max_page = ceil($numposts /$posts_per_page);
		if(empty($paged)) {
			$paged = 1;
		}
		if($max_page > 1 || $always_show) {
			echo "$before <div id='paginate'><ul>";
			for($i = $paged - $half_pages_to_show; $i <= $paged + $half_pages_to_show; $i++) {   if ($i >= 1 && $i <= $max_page) {   if($i == $paged) {
					echo ' <li><a class="current-page" href="'.get_pagenum_link($i).'">'.$i.'</a></li> ';
						} else {
					echo ' <li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li> ';   }
				}
			}
			echo "</ul></div> $after";
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Custom Comments Display
/*-----------------------------------------------------------------------------------*/

function sf_comments($comment, $args, $depth) {
   	$GLOBALS['comment'] = $comment; ?>
   
	<div class="post-comment">
		<?php echo get_avatar($comment,$size='30',$default='<path_to_url>' ); ?>
		
		<div id="comment-<?php comment_ID(); ?>" class="post-comment-text">
			<h4><?php printf(__('%s'), get_comment_author_link()) ?></h4>
			
			<?php comment_text() ?>
			
			<div class="reply">
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div>
		</div>
     </div>
	<?php
}

function sf_comment_excerpt($comment_ID = 0, $num_words = 20) {
	$comment = get_comment( $comment_ID );
	$comment_text = strip_tags($comment->comment_content);
	$blah = explode(' ', $comment_text);
	if (count($blah) > $num_words) {
		$k = $num_words;
		$use_dotdotdot = 1;
	} else {
		$k = count($blah);
		$use_dotdotdot = 0;
	}
	
	$excerpt = '';
	for ($i=0; $i<$k; $i++) {
		$excerpt .= $blah[$i] . ' ';
	}
	
	$excerpt .= ($use_dotdotdot) ? '...' : '';
	return apply_filters('get_comment_excerpt', $excerpt);
}

/*-----------------------------------------------------------------------------------*/
/* Register Widgetized Sidebars
/*-----------------------------------------------------------------------------------*/

if ( function_exists('register_sidebar') )
register_sidebar(array('name'=>'Post Sidebar',
	'before_widget' => '<div id="%1$s" class="gallery-item %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));

?>