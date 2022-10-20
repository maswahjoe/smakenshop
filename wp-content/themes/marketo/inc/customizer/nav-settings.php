<?php



$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'header_builder_enable',
    'label'       =>  esc_html__( 'Header Builder Enable', 'marketo' ),
    'section'     => 'nav_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'marketo' ),
        'off' => esc_attr__( 'Disable', 'marketo' ),
    ),
);

$fields[]= array(
    'type'        => 'select',
	'settings'    => 'xs_header_builder_select',
	'label'       => esc_html__( 'Select Header', 'marketo' ),
	'section'     => 'nav_section',
	'multiple'    => 1,
	'choices'     => marketo_ekit_headers(),
    'required'      => array(
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => true
        )
    ),
);

$fields[]= array(
    'type'        => 'custom',
	'settings'    => 'xs_header_custom_setting',
	'section'     => 'nav_section',
    'default'         => '<h2 class="header_builder_edit"><a class="xs_builder_edit_link" style="text-transform: uppercase; color:green" target="_blank" href='. admin_url( 'post.php?action=elementor&post='.marketo_get_builder_id('xs_header_builder_select', 'header_builder_enable') ). '>'. esc_html('Edit content here.'). '</a></h2><h3><a style="text-transform: uppercase; color:#17a2b8" target="_blank" href="https://support.xpeedstudio.com/knowledgebase/customize-marketo-header-and-footer-builder/">'. esc_html('How to edit header'). '</a></h3>',
    'priority'    => 10,
    'required'      => array(
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => true
        )
    ),
);


$fields[]= array(
    'type'        => 'radio-image',
    'settings'    => 'header_layout',
    'label'       => esc_html__( 'Header Layout', 'marketo' ),
    'section'     => 'nav_section',
    'default'     => '1',
    'choices'     => array(
        '1'   => get_template_directory_uri() . '/assets/images/header/header_1.png',
        '3' => get_template_directory_uri() . '/assets/images/header/header_3.png',
        '4' => get_template_directory_uri() . '/assets/images/header/header_1.png',
        '5' => get_template_directory_uri() . '/assets/images/header/header_2.png',
        '6' => get_template_directory_uri() . '/assets/images/header/header_6.png',
        '7' => get_template_directory_uri() . '/assets/images/header/header_7.png',
        '8' => get_template_directory_uri() . '/assets/images/header/header_8.jpg',
        '9' => get_template_directory_uri() . '/assets/images/header/header_9.jpg',
        '10' => get_template_directory_uri() . '/assets/images/header/header_10.jpg',
        '11' => get_template_directory_uri() . '/assets/images/header/header_11.jpg',
        '12' => get_template_directory_uri() . '/assets/images/header/header_12.jpg',
    ),
    'required'      => array(
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);
$fields[] = array(

    'type'        => 'repeater',
    'label'       => esc_attr__( 'Categories', 'marketo' ),
    'section'     => 'nav_section',
    'priority'    => 10,
    'row_label' => array(
        'type' => 'text',
        'value' => esc_attr__('Categories', 'marketo' ),
    ),
    'settings'    => 'category_selectors',
    'default'     => array(
        array(
            'cat' => '',
            'cat_icon'  => '',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'header_layout',
            'operator'  => '==',
            'value'     => '4',
        ),
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        ),
    ),
    'fields' => array(
        'cat' => array(
            'type'        => 'select',
            'label'       => __( 'Select Category', 'marketo' ),
            'default'     => '1',
            'priority'    => 10,
            'choices'     => xs_category_list('product_cat'),
        ),
        'cat_icon' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Category Icon', 'marketo' ),
            'default'     => '',
        ),
    )
);
$fields[] = array(
    'type'        => 'color',
    'settings'    => 'header_primary_color',
    'label'       => esc_html__( 'Header Primary Color', 'marketo' ),
    'section'     => 'nav_section',
    'output'      => array(
        array(
            'element' 	=> '.xs-vartical-menu .cd-dropdown-trigger',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-navDown .xs-navbar-search .btn[type="submit"]',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-navbar-search .btn-primary',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-single-wishList .xs-item-count.highlight',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-navDown.navDown-v5 .xs-vartical-menu .cd-dropdown-trigger',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-navBar.navBar-v5 .xs-navbar-search .btn[type="submit"]',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-navDown.secondary-color-v .xs-vartical-menu .cd-dropdown-content',
            'property'	=> 'background-color',
        ),

		array(
            'element' 	=> '.help-tip',
            'property'	=> 'background-color',
        ),
		array(
            'element' 	=> '.xs-serachForm input[type=submit]',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-navBar.navbar-orange',
            'property'	=> 'background-color',
        ),
		array(
            'element' 	=> '.xs-navDown .btn:not([type=submit]) strong',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.secondary-header-v .xs-vartical-menu .cd-dropdown-trigger',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.navBar-v6 .xs-navbar-search .btn[type="submit"]',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.navBar-v6 .xs-single-wishList .xs-item-count.highlight',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-navBar.navbar-dark',
            'property'	=> 'background-color',
        ),array(
            'element' 	=> '.xs-logo-wraper .logo-info .phone-number',
            'property'	=> 'color',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);
$fields[] = array(
    'type'        => 'color',
    'settings'    => 'header_hover_color',
    'label'       => esc_html__( 'Hover Color', 'marketo' ),
    'section'     => 'nav_section',
    'output'      => array(
        array(
            'element' 	=> '.xs-vartical-menu .cd-dropdown-trigger:hover',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-navDown .xs-navbar-search .btn[type="submit"]:hover',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-navbar-search .btn-primary:hover',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-single-wishList .xs-item-count.highlight:hover',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-navDown.navDown-v5 .xs-vartical-menu .cd-dropdown-trigger:hover',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-navDown.navDown-v5 .xs-menus .nav-menu>li>a:hover',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.xs-navBar.navBar-v5 .xs-navbar-search .btn[type="submit"]:hover',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-navDown.secondary-color-v .xs-vartical-menu .cd-dropdown-content:hover',
            'property'	=> 'background-color',
        ),
      array(
            'element' 	=> '.btn:not([data-toggle=popover]).btn-primary::before',
            'property'	=> 'background-color',
        ), array(
            'element' 	=> '.single_add_to_cart_button::before',
            'property'	=> 'background-color',
        ), array(
            'element' 	=> '..woocommerce #respond input#submit:hover',
            'property'	=> 'background-color',
        ),
		array(
            'element' 	=> '.select-options',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.select-options::before',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-vartical-menu .cd-dropdown-trigger.dropdown-is-active:hover, .xs-vartical-menu .cd-dropdown-trigger:hover',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-logo-wraper .logo-info .phone-number:hover',
            'property'	=> 'color',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'header_fullwidth',
    'label'       => esc_html__( 'Header full Width', 'marketo' ),
    'section'     => 'nav_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'marketo' ),
        'off' => esc_attr__( 'Disable', 'marketo' ),
    ),
    'required'      => array(
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);



$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_promotional_card',
    'label'       => esc_html__( 'Show Promotional Card', 'marketo' ),
    'section'     => 'nav_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'marketo' ),
        'off' => esc_attr__( 'Disable', 'marketo' ),
    ),
    'required'      => array(
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);
$fields[] = array(
    'type'        => 'color',
    'settings'    => 'promotional_card_bg_color',
    'label'       => esc_html__( 'Promotional Card Background Color', 'marketo' ),
    'section'     => 'nav_section',
    'required'      => array(
        array(
            'setting'   => 'show_promotional_card',
            'operator'  => '==',
            'value'     => true,
        ),
    ),
    'output'      => array(
        array(
            'element' 	=> '.xs-promotion.alert-success',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-promotion.alert-info',
            'property'	=> 'background-color',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);
$fields[] = array(
    'type'        => 'color',
    'settings'    => 'promotional_card_color',
    'label'       => esc_html__( 'Promotional Card Color', 'marketo' ),
    'section'     => 'nav_section',
    'required'      => array(
        array(
            'setting'   => 'show_promotional_card',
            'operator'  => '==',
            'value'     => true,
        ),
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
    'output'      => array(
        array(
            'element' 	=> '.xs-promotion p',
            'property'	=> 'color',
        ),
    ),
);

$fields[]= array(
    'type'        => 'textarea',
    'settings'    => 'promotional_text',
    'label'       => esc_html__( 'Promotional text', 'marketo' ),
    'section'     => 'nav_section',
    'transport'   => 'postMessage',
    'required'      => array(
        array(
            'setting'   => 'show_promotional_card',
            'operator'  => '==',
            'value'     => true,
        ),
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
    'js_vars'     => array(
        array(
            'element'  => '.xs-promotion p',
            'function' => 'html'
        ),
    ),
    'default'     => esc_html__( 'Welcome to Emarket ! Wrap new offers / gift every single day on Weekends  New Coupon code: Happy2017', 'marketo' ),
);

$fields[]= array(
    'type'        => 'text',
    'settings'    => 'phone_number',
    'label'       => esc_html__( 'Phone Number', 'marketo' ),
    'section'     => 'nav_section',
    'required'      => array(
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);

$fields[] = array(
	'type'        => 'select',
	'settings'    => 'promotion_align',
	'label'       => esc_html__( 'Text alignment', 'marketo' ),
	'section'     => 'nav_section',
	'transport'   => 'auto',
	'required'      => array(
		array(
			'setting'   => 'show_promotional_card',
			'operator'  => '==',
			'value'     => true,
		),
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
	'choices'     => array(
		'left' => esc_attr__( 'Left', 'marketo' ),
		'center' => esc_attr__( 'Center', 'marketo' ),
		'right' => esc_attr__( 'Right', 'marketo' ),
	),
	'output'     => array(
		array(
			'element'  => '.xs-promotion p',
			'property' => 'text-align'
		),
	),
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_topbar',
    'label'       => esc_html__( 'Show Top Bar', 'marketo' ),
    'section'     => 'nav_section',
    'default'     => false,
    'required'      => array(
        array(
            'setting'   => 'header_layout',
            'operator'  => '!=',
            'value'     => '2',
        ),
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'marketo' ),
        'off' => esc_attr__( 'Disable', 'marketo' ),
    ),
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_topbar_border',
    'label'       => esc_html__( 'Show Top Bar Border', 'marketo' ),
    'section'     => 'nav_section',
    'default'     => false,
    'required'      => array(
        array(
            'setting'   => 'show_topbar',
            'operator'  => '==',
            'value'     => true,
        ),
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'marketo' ),
        'off' => esc_attr__( 'Disable', 'marketo' ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'topbar_border_color',
    'label'       => esc_html__( 'Topbar Border Color', 'marketo' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'required'      => array(
        array(
            'setting'   => 'show_topbar_border',
            'operator'  => '==',
            'value'     => true,
        ),
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
    'output'      => array(
        array(
            'element' 	=> '.xs-top-bar.v-border',
            'property'	=> 'border-color',
        ),
    ),
);
$fields[] = array(

    'type'        => 'repeater',
    'label'       => esc_attr__( 'Top bar left information', 'marketo' ),
    'section'     => 'nav_section',
    'priority'    => 10,
    'row_label' => array(
        'type' => 'text',
        'value' => esc_attr__('Top Bar Info', 'marketo' ),
    ),
    'settings'    => 'top_bar_infos',
    'default'     => array(
        array(
            'info_text' => '',
            'info_url'  => '',
            'info_icon'  => '',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'header_layout',
            'operator'  => '!=',
            'value'     => '2',
        ),
        array(
            'setting'   => 'show_topbar',
            'operator'  => '==',
            'value'     => true,
        ),
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
    'fields' => array(
        'info_text' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Top Bar Info Text', 'marketo' ),
            'default'     => '',
        ),
        'info_url' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Top Bar Info URL', 'marketo' ),
            'default'     => '#',
        ),
        'info_icon' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Top Bar Info Icon', 'marketo' ),
            'default'     => 'fa fa-facebook',
        ),
    )
);
$fields[] = array(
    'type'        => 'color',
    'settings'    => 'nav_top_color',
    'label'       => esc_html__( 'Topbar Color', 'marketo' ),
    'section'     => 'nav_section',
    'required'      => array(
        array(
            'setting'   => 'header_layout',
            'operator'  => '!=',
            'value'     => '2',
        ),
        array(
            'setting'   => 'show_topbar',
            'operator'  => '==',
            'value'     => true,
        ),
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
    'output'      => array(
        array(
            'element' 	=> '.xs-top-bar',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.xs-top-bar-info li a',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.xs-social-list li a',
            'property'	=> 'color',
        ),
    ),
);
$fields[] = array(
    'type'        => 'color',
    'settings'    => 'nav_top_bg_color',
    'label'       => esc_html__( 'Topbar Background Color', 'marketo' ),
    'section'     => 'nav_section',
    'required'      => array(
        array(
            'setting'   => 'header_layout',
            'operator'  => '!=',
            'value'     => '2',
        ),
        array(
            'setting'   => 'show_topbar',
            'operator'  => '==',
            'value'     => true,
        ),
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
    'output'      => array(
        array(
            'element' 	=> '.xs-top-bar',
            'property'	=> 'background-color',
        ),
    ),
);


$fields[] = array(
	'type'        => 'color',
	'settings'    => 'menu_bg_color',
	'label'       => esc_html__( 'Menu Background Color', 'marketo' ),
	'section'     => 'nav_section',
	'output'      => array(
		array(
			'element' 	=> '.xs-header',
			'property'	=> 'background-color',
		),
        array(
            'element' 	=> '.xs-header',
            'property'	=> 'background-color',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);

$fields[] = array(
	'type'        => 'color',
	'settings'    => 'menu_color',
	'label'       => esc_html__( 'Menu Color', 'marketo' ),
	'section'     => 'nav_section',
	'output'      => array(
		array(
			'element' 	=> '.xs-menus .nav-menu > li > a',
			'property'	=> 'color',
			'suffix'   => ' !important',
		),

		array(
			'element' 	=> '.xs-single-wishList',
			'property'	=> 'color',
			'suffix'   => ' !important',
		),
		array(
			'element' 	=> '.xs-menus .nav-menu > li > a .submenu-indicator-chevron',
			'property'	=> 'border-color',
		),
		array(
			'element' 	=> '.xs-navBar .navbar-border .xs-menus .nav-menu > li > a::before',
			'property'	=> 'background-color',
		),
		array(
			'element' 	=> '.xs-menus .nav-menu > :not(.megamenu) .nav-dropdown li a',
			'property'	=> 'color',
		),
    ),
    'required'      => array(
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);

$fields[] = array(
	'type'        => 'color',
	'settings'    => 'menu_hover_color',
	'label'       => esc_html__( 'Menu Hover Color', 'marketo' ),
	'section'     => 'nav_section',
	'output'      => array(
		array(
			'element' 	=> '.xs-menus .nav-menu > li > a:hover',
			'property'	=> 'color',
		),
		array(
			'element' 	=> '.xs-menus .nav-menu > li:hover > a .submenu-indicator-chevron',
			'property'	=> 'border-color',
		),
		array(
			'element' 	=> '.xs-single-wishList:hover',
			'property'	=> 'color',
		),array(
			'element' 	=> '.nav-menu > li.focus > a',
			'property'	=> 'color',
		),
    ),
    'required'      => array(
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);
$fields[] = array(
    'type'        => 'color',
    'settings'    => 'sub_menu_color',
    'label'       => esc_html__( 'Sub Menu Color', 'marketo' ),
    'section'     => 'nav_section',
    'output'      => array(
        array(
            'element' 	=> '.xs-menus .nav-menu > :not(.megamenu) .nav-dropdown li a',
            'property'	=> 'color',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'sub_menu_hover_color',
    'label'       => esc_html__( 'Sub Menu Hover Color', 'marketo' ),
    'section'     => 'nav_section',
    'output'      => array(
        array(
            'element' 	=> '.xs-menus .nav-menu > :not(.megamenu) .nav-dropdown li a:hover',
            'property'	=> 'color',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);


$fields[]= array(
	'type'        => 'switch',
	'settings'    => 'show_header_cta',
	'label'       =>esc_html__( 'Show CTA Button', 'marketo' ),
	'section'     => 'nav_section',
	'default'     => '',
	'choices'     => array(
		'on'  => esc_attr__( 'Enable', 'marketo' ),
		'off' => esc_attr__( 'Disable', 'marketo' ),
	),
    'required'      => array(
        array(
            'setting'   => 'header_layout',
            'operator'  => '!=',
            'value'     => '2',
        ),
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);

$fields[] = array(
    'type'		 => 'text',
    'settings'	 => 'all_catagory_btn_text',
    'label'		 => esc_html__( 'All Category Button', 'marketo' ),
    'section'	 => 'nav_section',
    'default' => ' All Categories',
    'required'      => array(
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);

$fields[]= array(
	'type'        => 'text',
	'settings'    => 'cta_btn_title',
	'label'       =>esc_html__( 'CTA Button Title', 'marketo' ),
	'section'     => 'nav_section',
	'transport'   => 'postMessage',
    'js_vars'     => array(
      	array(
       		'element'  => '.marketo-icon-menu .xs-btn',
       		'function' => 'html'
      	),
    ),
	'default'     => esc_html__( 'Black Friday', 'marketo' ),
	'required'      => array(
        array(
            'setting'   => 'show_header_cta', // or simply without [image]
            'operator'  => '==',
            'value'     => true // and just have 'image' here
        ),
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);
$fields[]= array(
	'type'        => 'switch',
	'settings'    => 'search_full_width',
	'label'       =>esc_html__( 'Search bar full width', 'marketo' ),
	'section'     => 'nav_section',
	'default'     => '',
	'choices'     => array(
		'on'  => esc_attr__( 'yes', 'marketo' ),
		'off' => esc_attr__( 'no', 'marketo' ),
	),
    'required'      => array(
        array(
            'setting'   => 'show_header_cta', // or simply without [image]
            'operator'  => '==',
            'value'     => false // and just have 'image' here
        ),
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);


$fields[]= array(
	'type'        => 'text',
	'settings'    => 'cta_btn_subtitle',
	'label'       =>esc_html__( 'CTA Button Sub Title', 'marketo' ),
	'section'     => 'nav_section',
	'transport'   => 'postMessage',
    'js_vars'     => array(
      	array(
       		'element'  => '.marketo-icon-menu .xs-btn',
       		'function' => 'html'
      	),
    ),
	'default'     => esc_html__( 'Get 45% Off!', 'marketo' ),
	'required'      => array(
        array(
            'setting'   => 'show_header_cta', // or simply without [image]
            'operator'  => '==',
            'value'     => true // and just have 'image' here
        ),
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);

$fields[]= array(
	'type'        => 'text',
	'settings'    => 'cta_btn_link',
	'label'       =>esc_html__( 'CTA Button Link', 'marketo' ),
	'section'     => 'nav_section',
    'js_vars'     => array(
      	array(
       		'element'  => '.marketo-icon-menu .xs-btn',
       		'function' => 'html'
      	),
    ),
	'default'     => esc_html__( '#', 'marketo' ),
	'required'      => array(
        array(
            'setting'   => 'show_header_cta',
            'operator'  => '==',
            'value'     => true
        ),
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);


$fields[]= array(
    'type'        => 'switch',
    'label'       =>esc_html__( 'Show Header Bottom', 'marketo' ),
    'settings'    => 'show_header_bottom',
    'section'     => 'nav_section',
    'default'     => '0',
    'required'      => array(
	    array(
		    'setting'   => 'header_layout',
		    'operator'  => '==',
		    'value'     => '1',
	    ),
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'marketo' ),
        'off' => esc_attr__( 'Disable', 'marketo' ),
    ),
);

$fields[] = array(
	'type'		 => 'text',
	'settings'	 => 'social_follow_us_title',
	'label'		 => esc_html__( 'Social Follow us title', 'marketo' ),
	'section'	 => 'nav_section',
    'default' => 'Follow Us',
    'required'      => array(
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);

$fields[] = array(
	'type'		 => 'repeater',
	'label'		 => esc_attr__( 'Social Control', 'marketo' ),
	'section'	 => 'nav_section',
	'priority'	 => 10,
	'row_label'	 => array(
		'type'	 => 'text',
		'value'	 => esc_attr__( 'Social Profile', 'marketo' ),
	),
	'settings'	 => 'footer_social_links',
	'default'	 => array(
		array(
			'social_text'	 => esc_attr__( 'Facebook', 'marketo' ),
			'social_url'	 => 'https://www.facebook.com/xpeedstudio/',
			'social_icon'	 => 'fa fa-facebook',
		),
	),
	'fields' => array(
		'social_text'	 => array(
			'type'			 => 'text',
			'label'			 => esc_attr__( 'Social Text', 'marketo' ),
			'description'	 => esc_attr__( 'This will be the label for your social link', 'marketo' ),
			'default'		 => '',
		),
		'social_url'	 => array(
			'type'			 => 'text',
			'label'			 => esc_attr__( 'Social URL', 'marketo' ),
			'description'	 => esc_attr__( 'This will be the social URL', 'marketo' ),
			'default'		 => '#',
		),
		'social_icon'	 => array(
			'type'			 => 'text',
			'label'			 => esc_attr__( 'Social Icon', 'marketo' ),
			'description'	 => esc_attr__( 'This will be the social Icon CSS Class', 'marketo' ),
			'default'		 => 'fa fa-facebook',
		),
    ),
    'required'      => array(
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);

$fields[] = array(
    'type'		 => 'text',
    'settings'	 => 'my_accout_title',
    'label'		 => esc_html__( 'My account title', 'marketo' ),
    'section'	 => 'nav_section',
    'default' => 'My account',
    'required'      => array(
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);

$fields[] = array(
    'type'		 => 'text',
    'settings'	 => 'my_login_title',
    'label'		 => esc_html__( 'Login title', 'marketo' ),
    'section'	 => 'nav_section',
    'default' => 'Login',
    'required'      => array(
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);

$fields[] = array(
    'type'		 => 'text',
    'settings'	 => 'account_and_login_url',
    'label'		 => esc_html__( 'Account URL', 'marketo' ),
    'section'	 => 'nav_section',
    'default' => '',
    'required'      => array(
        array(
            'setting'   => 'header_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);