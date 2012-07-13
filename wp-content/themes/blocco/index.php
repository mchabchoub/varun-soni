<?php get_header(); ?>

<div id="content" class="<?php if (is_home()) { echo 'is-home'; } ?>">
	<div id="content-gallery">
	
	<?php mylinkorder_list_bookmarks('orderby=order&category_orderby=order'); ?>
	
		<?php if (is_home()) {
			if (of_get_option("enable_home_category")) { 
				$home_cat = of_get_option('home_category');
				$home_count = of_get_option('home_count');
				query_posts("cat=$home_cat&posts_per_page=$home_count");
			};
		}; ?>
	
		<?php /* if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php get_template_part( 'content', 'gallery' ); ?>
		<?php endwhile; else : ?>
			<?php get_template_part( 'content', 'nothing' ); ?>
		<?php endif; */?>
		
		
	</div> <!-- content-gallery -->
</div> <!-- content -->

<?php get_footer(); ?>
