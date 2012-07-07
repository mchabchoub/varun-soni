<?php 
	$disable_theme_features = of_get_option( 'disable_theme_features' );
?>

<div id="foreword">
	<?php if ($disable_theme_features['2'] == '0') { ?>
	<div id="logo">
		<a class="fade" href="<?php echo home_url(); ?>/" title="Home" ><img src="<?php echo ($logo = of_get_option('logo_image')) ? $logo : get_template_directory_uri() . "/images/logo.png"; ?>" alt="<?php bloginfo('name'); ?>" /></a>
	</div>
	<?php } ?>
	
	<div id="menu">
		<ul class="menu home-menu">
			<li class="<?php if (is_front_page()) { echo 'current-menu-item'; } ?>"><a href="<?php echo home_url(); ?>/"><?php echo of_get_option('home_text'); ?></a></li>
		</ul>
		
		<?php if ($disable_theme_features['1'] == '0') { ?>
		<form method="get" id="search-form" action="<?php echo home_url(); ?>/">
			<input type="text" name="s" id="s" value="<?php echo of_get_option('search_text'); ?>" onfocus="if(this.value=='<?php echo of_get_option('search_text'); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php echo of_get_option('search_text'); ?>';" />
		</form>
		<?php } ?>
		
		<?php wp_nav_menu(array('theme_location' => 'first_menu', 'container_class' => 'first-menu')); ?>
		
		<?php wp_nav_menu(array('theme_location' => 'second_menu', 'container_class' => 'second-menu')); ?>
		
		<?php wp_nav_menu(array('theme_location' => 'third_menu', 'container_class' => 'third-menu')); ?>
		
		<?php if (of_get_option("enable_home_category")) : else : if (function_exists('sf_pagenavi')) { sf_pagenavi('', '', '', '', 20, false); } endif; ?>
	</div> <!-- menu -->
	
	<div id="menu-mobile-left">	
		<ul class="menu home-menu">
			<li><a class="display-menu" href="javascript:void(0)">&#8226;</a></li>
		</ul>
		
		<?php if (of_get_option("enable_home_category")) : else : if (function_exists('sf_pagenavi')) { sf_pagenavi('', '', '', '', 20, false); } endif; ?>
	</div> <!-- menu-mobile-left -->

	<div id="menu-mobile">
		<ul class="menu home-menu">
			<li class="<?php if (is_front_page()) { echo 'current-menu-item'; } ?>"><a href="<?php echo home_url(); ?>/"><?php echo of_get_option('home_text'); ?></a></li>
		</ul>
		
		<?php wp_nav_menu(array('theme_location' => 'first_menu', 'container_class' => 'first-menu')); ?>
		
		<?php wp_nav_menu(array('theme_location' => 'second_menu', 'container_class' => 'second-menu')); ?>
		
		<?php wp_nav_menu(array('theme_location' => 'third_menu', 'container_class' => 'third-menu')); ?>
	</div> <!-- menu-mobile -->
</div> <!-- foreword -->