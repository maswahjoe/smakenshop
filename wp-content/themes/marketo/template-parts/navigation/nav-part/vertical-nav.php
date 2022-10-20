<?php
$menu			 = marketo_get_option( 'mainmenu_style' );
$menu_class		 = $menu_style		 = $header_wrapper	 = $pull_right		 = '';

	wp_nav_menu(
        array(
            'theme_location'	 => 'vertical_nav',
            'container_class'	 => ' ',
            'menu_class'		 => 'cd-dropdown-content',
            'fallback_cb'		 => '',
            'menu_id'			 => 'main-menu-vertical',
            'walker'			 => new marketo_vertical_nav_walker(),
        )
	);

