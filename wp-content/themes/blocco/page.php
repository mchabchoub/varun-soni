<?php get_header(); ?>

<div id="content">
	<div id="content-single">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php get_template_part( 'content', 'single' ); ?>
		<?php endwhile; else : ?>
			<?php get_template_part( 'content', 'nothing' ); ?>
		<?php endif; ?>
	</div> <!-- content-single -->
</div> <!-- content -->

<?php get_footer(); ?>
