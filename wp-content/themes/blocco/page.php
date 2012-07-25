<?php get_header(); ?>

<div id="content">
	<div id="content-single">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php get_template_part( 'content', 'single' ); ?>
		<?php endwhile; else : ?>
			<?php get_template_part( 'content', 'nothing' ); ?>
		<?php endif; ?>	
	</div> <!-- content-single -->
		<?php mylinkorder_list_bookmarks(array(
		'category_name' => 'inner-pages',
		'orderby' => 'order',
		'category_orderby' => 'order',
		'show_description' => 1,
		'between' => '<br />',
		'category_before' => '<li id=%id class=%class>',
		'category_after' => '</li>'
		)
		); ?>
		
		<img class="up-btn"	src="<?php bloginfo('template_url')	?>/images/up.png"	alt=""	/>
</div> <!-- content -->

<?php get_footer(); ?>
