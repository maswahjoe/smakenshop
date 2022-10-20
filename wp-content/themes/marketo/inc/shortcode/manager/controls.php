<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor controls manager.
 *
 * Elementor controls manager handler class is responsible for registering and
 * initializing all the supported controls, both regular controls and the group
 * controls.
 *
 * @since 1.0.0
 */
if(class_exists( 'Elementor\Controls_Manager' )) {
    abstract class Custom_Controls_Manager extends Controls_Manager
    {
        const AJAXSELECT2 = 'marketoajaxselect2';
        const IMAGECHOOSE = 'imagechoose';
    }
}