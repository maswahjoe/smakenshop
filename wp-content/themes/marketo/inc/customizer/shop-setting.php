<?php
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'shop_sidebar',
    'label'       => esc_html__( 'Shop Sidebar Position', 'marketo' ),
    'section'     => 'shop_section',
    'default'     => '2',
    'choices'     => array(
        '1'      => esc_html__('Full Width','marketo'),
        '2'      => esc_html__('Left Sidebar','marketo'),
        '3'      => esc_html__('Right Sidebar','marketo'),
    ),
);
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'shop_grid_column',
    'label'       => esc_html__( 'Grid Per Row', 'marketo' ),
    'section'     => 'shop_section',
    'default'     => '3',
    'choices'     => array(
        '6'     => esc_html__( '2 Column', 'marketo' ),
        '4'     => esc_html__( '3 Column', 'marketo' ),
        '3'     => esc_html__( '4 Column', 'marketo' ),
    ),

);
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'shop_grid_column_tab',
    'label'       => esc_html__( 'Grid Per Row Tab', 'marketo' ),
    'section'     => 'shop_section',
    'default'     => '6',
    'choices'     => array(
        '6'     => esc_html__( '2 Column', 'marketo' ),
        '4'     => esc_html__( '3 Column', 'marketo' ),
        '3'     => esc_html__( '4 Column', 'marketo' ),
    ),

);
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'shop_grid_column_mobile',
    'label'       => esc_html__( 'Grid Per Row Mobile', 'marketo' ),
    'section'     => 'shop_section',
    'default'     => '12',
    'choices'     => array(
        '12'     => esc_html__( '1 Column', 'marketo' ),
        '6'     => esc_html__( '2 Column', 'marketo' ),
        '4'     => esc_html__( '3 Column', 'marketo' ),
    ),

);
$fields[]= array(
    'type'        => 'text',
    'label'       =>esc_html__( 'Product Per Page', 'marketo' ),
    'settings'    => 'woo_posts_per_page',
    'section'     => 'shop_section',
	'default'     => '12',
);
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'shop_archive_desc',
    'label'       => esc_html__( 'Show Category Image ', 'marketo' ),
    'section'     => 'shop_section',
    'default'     => '3',
    'choices'     => array(
        '1'      => esc_html__('Hide Category Image','marketo'),
        '2'      => esc_html__('Show Top','marketo'),
        '3'      => esc_html__('Show Before Product','marketo'),
    ),
);
$fields[]= array(
    'type'        => 'image',
    'label'       =>esc_html__( 'Upload Global Category Banner', 'marketo' ),
    'settings'    => 'shop_banner_global_display',
    'section'     => 'shop_section',
);
$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'banner_force_on_catagory',
    'label'       => esc_html__( 'Force Banner For All Category', 'marketo' ),
    'section'     => 'shop_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Yes', 'marketo' ),
        'off' => esc_attr__( 'No', 'marketo' ),
    ),
);
$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'shop_banner_shop_page_sho',
    'label'       => esc_html__( 'Show Banner On Shop', 'marketo' ),
    'section'     => 'shop_section',
    'default'     => true,
    'choices'     => array(
        'on'  => esc_attr__( 'Yes', 'marketo' ),
        'off' => esc_attr__( 'No', 'marketo' ),
    ),
);