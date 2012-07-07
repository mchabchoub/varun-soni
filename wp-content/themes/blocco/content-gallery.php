<div id="post-<?php the_ID(); ?>" <?php post_class('gallery-item') ?>>
	<?php if(has_post_thumbnail()) : ?>
		<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail('gallery'); ?>
		</a>
		
		<h2><?php the_title(''); ?></h2>
	<?php else : ?>
		<h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(''); ?></a></h2>
	<?php endif ; ?> 
</div> <!-- gallery-item -->