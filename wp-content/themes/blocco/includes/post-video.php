<?php

/*-----------------------------------------------------------------------------------*/
/*	Video Fields
/*-----------------------------------------------------------------------------------*/

$meta_box_video = array(
	'id' => 'sf-meta-box-video',
	'title' => 'Post Video Options',
	'page' => 'post',
	'context' => 'side',
	'priority' => 'high',
	'fields' => array(
	
		array(
			'id' => 'sf_video_url',
			'type' => 'text',
			'std' => ''
		),
			
	),
	
);

add_action('admin_menu', 'sf_add_box');

/*-----------------------------------------------------------------------------------*/
/*	Add These Fields to the Post Editor
/*-----------------------------------------------------------------------------------*/
 
function sf_add_box() {
	global $meta_box_video;
	add_meta_box($meta_box_video['id'], $meta_box_video['title'], 'sf_show_box_video', $meta_box_video['page'], $meta_box_video['context'], $meta_box_video['priority']);
}

/*-----------------------------------------------------------------------------------*/
/*	Show the Video Box
/*-----------------------------------------------------------------------------------*/

function sf_show_box_video() {
	global $meta_box_video, $post;
 	
	echo '<p style="padding:10px 0 0 0;">'.__('Enter a YouTube or Vimeo video URL in the field below to add a video to this post which will be displayed in the post header. The video you are embedding should be in standard 16:9 format for best results.', 'framework').'</p>';

	echo '<input type="hidden" name="sf_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($meta_box_video['fields'] as $field) {
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
			case 'text':
			
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'],'" size="30" style="width:99%; margin-bottom:10px; float:left;" />';
			
			break;
		}

	}
 
	echo '</table>';
}
 
add_action('save_post', 'sf_save_data');

/*-----------------------------------------------------------------------------------*/
/*	Save Everything
/*-----------------------------------------------------------------------------------*/
 
function sf_save_data($post_id) {
	global $meta_box, $meta_box_video;
 
	if (!wp_verify_nonce($_POST['sf_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}
 
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
 
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	
	foreach ($meta_box_video['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/*	The Video Function
/*-----------------------------------------------------------------------------------*/

function sf_video($postid) {
	
	$video_url = get_post_meta($postid, 'sf_video_url', true);
	
	if($width == '')
		$width = 660;
	
	if($height == '')
		$height = 371;

	if(trim($embeded_code) == '') 
	{
		
		if(preg_match('/youtube/', $video_url)) 
		{
			
			if(preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $video_url, $matches))
			{
				$output = '<iframe title="YouTube video player" class="youtube-player" type="text/html" width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$matches[1].'" frameborder="0" allowFullScreen></iframe>';
			}
			else 
			{
				$output = __('Sorry that seems to be an invalid <strong>YouTube</strong> URL. Please check it again.', 'framework');
			}
			
		}
		elseif(preg_match('/vimeo/', $video_url)) 
		{
			
			if(preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video_url, $matches))
			{
				$output = '<iframe src="http://player.vimeo.com/video/'.$matches[1].'" width="'.$width.'" height="'.$height.'" frameborder="0"></iframe>';
			}
			else 
			{
				$output = __('Sorry that seems to be an invalid <strong>Vimeo</strong> URL. Please check it again. Make sure there is a string of numbers at the end.', 'framework');
			}
			
		}
		else 
		{
			$output = __('Sorry that is an invalid YouTube or Vimeo URL.', 'framework');
		}
		
		echo $output;
		
	}
	else
	{
		echo stripslashes(htmlspecialchars_decode($embeded_code));
	}
	
}