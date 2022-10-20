<?php

if ( !defined( 'ABSPATH' ) )
    wp_die( 'Direct access forbidden.' );
/**
 * Theme’s filters and actions
 */

require get_parent_theme_file_path( '/inc/hooks/widget-register.php' );
require get_parent_theme_file_path( '/inc/hooks/tgmpa-plugins.php' );
require get_parent_theme_file_path( '/inc/hooks/theme-demos.php' );
require get_parent_theme_file_path( '/inc/hooks/blog.php' );
require get_parent_theme_file_path( '/inc/hooks/woocommerce.php' );
require get_parent_theme_file_path( '/inc/hooks/header-loader.php' );
