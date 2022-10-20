<?php
$menu			 = marketo_get_option( 'mainmenu_style' );
$menu_class		 = $menu_style		 = $header_wrapper	 = $pull_right		 = '';
?>


	<?php
	wp_nav_menu(
        array(
            'theme_location'	 => 'primary',
            'container_class'	 => ' ',
            'menu_class'		 => 'nav-menu lg-menu',
            'fallback_cb'		 => '',
            'depth'              => 3,
            'menu_id'			 => 'main-menu',
            'walker'			 => new marketo_main_nav_walker(),
        )
	);

	
	?>
