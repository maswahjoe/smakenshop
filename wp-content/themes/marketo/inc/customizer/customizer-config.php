<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Do not proceed if Kirki does not exist.
if ( ! class_exists( 'Kirki' ) ) {
	return;
}


Kirki::add_config( 'marketo_customizer', array(
	'capability'  => 'edit_theme_options',
	'option_type' => 'theme_mod',
) );


function marketo_customizer_sections($wp_customize){
    $wp_customize->add_panel( 'theme_option', array(
        'priority'    => 10,
        'title'       => esc_attr__( 'Theme Options', 'marketo' ),
    ) );

	$wp_customize->add_section( 'general_section', array(
		'title'			=> esc_html__( 'General Settings', 'marketo' ),
		'priority'		=> 1,
		'description'	=> esc_html__( 'To change logo, global color etc', 'marketo' ),
        'panel'          => 'theme_option',
	) );

	$wp_customize->add_section( 'nav_section', array(
		'title'			=> esc_html__( 'Navigation Settings', 'marketo' ),
		'priority'		=> 2,
		'description'	=> esc_html__( 'Setting Your Menu', 'marketo' ),
        'panel'          => 'theme_option',
	) );

	$wp_customize->add_section( 'page_section', array(
        'title'			=> esc_html__( 'Page Settings', 'marketo' ),
        'priority'		=> 3,
        'description'	=> esc_html__( 'Setting Your Page', 'marketo' ),
        'panel'          => 'theme_option',
    ) );

    $wp_customize->add_section( 'blog_section', array(
        'title'         => esc_html__( 'Blog Settings', 'marketo' ),
        'priority'      => 4,
        'description'   => esc_html__( 'Setting Your Blog', 'marketo' ),
        'panel'          => 'theme_option',
    ) );

    $wp_customize->add_section( 'blog_single_section', array(
        'title'         => esc_html__( 'Single Blog Settings', 'marketo' ),
        'priority'      => 5,
        'description'   => esc_html__( 'Setting Your Singel Blog', 'marketo' ),
        'panel'          => 'theme_option',
    ) );

    $wp_customize->add_section( 'shop_section', array(
        'title'         => esc_html__( 'Shop Settings', 'marketo' ),
        'priority'      => 5,
        'description'   => esc_html__( 'Setting Your Shop page', 'marketo' ),
        'panel'          => 'theme_option',
    ) );

    $wp_customize->add_section( 'footer_section', array(
        'title'			=> esc_html__( 'Footer Settings', 'marketo' ),
        'priority'		=> 6,
        'description'	=> esc_html__( 'Setting Your Footer', 'marketo' ),
        'panel'          => 'theme_option',
    ) );

    $wp_customize->add_section( 'styling_section', array(
        'title'			=> esc_html__( 'Styling Settings', 'marketo' ),
        'priority'		=> 7,
        'description'	=> esc_html__( 'Setting Your font', 'marketo' ),
        'panel'          => 'theme_option',
    ) );
}

add_action( 'customize_register', 'marketo_customizer_sections' );

require MARKETO_CUSTOMIZER_DIR . 'customizer-fields.php' ;
