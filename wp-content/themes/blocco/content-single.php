<div id="post-<?php the_ID(); ?>" class="post-item">
	<?php 
		$disable_post_features = of_get_option( 'disable_post_features' );
		$disable_post_info = of_get_option( 'disable_post_info' );
		$video_url = get_post_meta(get_the_ID(), 'sf_video_url', true);
		$embeded_code = get_post_meta(get_the_ID(), 'sf_embed_code', true);
	?>
	
	<?php if (has_post_thumbnail()) { ?>
	<div class="post-header<?php if($video_url !='' || $embeded_code != '') {echo ' has-video';} ?>">
		<?php if ($disable_post_features['1'] == '0') { ?>
		<!-- grid lines over thumbnail -->
		<div class="grid-horizontal"></div>
		<div class="grid-vertical-left"></div>
		<div class="grid-vertical-right"></div>
		<!-- grid lines over thumbnail -->
		<?php } ?>
		
		<?php the_post_thumbnail('single'); ?>
	</div> <!-- post-header -->
	<?php }; ?>
	
	<?php if($video_url !='' || $embeded_code != '') { ?>
	<div class="post-header-video">
		<?php sf_video(get_the_ID()); ?>
	</div> <!-- post-header-video -->
	<?php } ?>
	
	<div class="post-content<?php if (has_post_thumbnail()) { echo ' has-thumbnail'; } ?>">
		<div class="post-sidebar">
			<?php if (has_post_thumbnail()) { ?>
			<div class="thumbnail-mobile">
				<?php the_post_thumbnail('gallery'); ?>
			</div>
			<?php }; ?>
		
			<div class="gallery-item<?php if (has_post_thumbnail()) {echo ' has-thumbnail';} else {echo ' no-thumbnail';} ?><?php if($video_url !='' || $embeded_code != '') {echo ' has-video';} ?>">
				<h2><?php the_title(''); ?></h2>
			</div>
			
			<?php if ($disable_post_info['1'] == '0') { ?>
			<div class="gallery-item">
				<ul>
					<?php if ($disable_post_info['2'] == '0') { ?>
					<li><?php the_author(); ?></li>
					<?php } ?>
					<?php if ($disable_post_info['3'] == '0') { ?>
					<li><?php the_time( get_option('date_format') ); ?></li>
					<?php } ?>
				<?php if (is_single()) { ?>
					<?php if ($disable_post_info['4'] == '0') { ?>
					<li><?php the_category(', ') ?></li>
					<?php } ?>
					<?php if ($disable_post_info['5'] == '0') { ?>
					<li><?php comments_popup_link('0 Comments','1 Comment','% Comments'); ?></li>
					<?php } ?>
				<?php }; ?>
				</ul>
			</div>
			<?php } ?>
			
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Post Sidebar') ) : ?>
			<?php endif; ?>
		</div> <!-- post-sidebar -->
		
		<?php the_content(''); ?>
		
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', '' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div> <!-- post-content -->
</div> <!-- post-item -->