<?php get_header(); ?>

<div id="content">
	<div id="content-single">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php get_template_part( 'content', 'single' ); ?>
		<?php endwhile; else : ?>
			<?php get_template_part( 'content', 'nothing' ); ?>
		<?php endif; ?> 
		
		<?php 
			$disable_post_features = of_get_option( 'disable_post_features' );
		?>
		
		<?php if ($disable_post_features['2'] == '0') { ?>
		<?php comments_template(); ?>
		<?php } ?>
	</div> <!-- content-single -->
</div> <!-- content -->

<?php get_footer(); ?>
