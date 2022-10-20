<?php

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'footer_builder_enable',
    'label'       =>  esc_html__( 'Footer Builder Enable', 'marketo' ),
    'section'     => 'footer_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'marketo' ),
        'off' => esc_attr__( 'Disable', 'marketo' ),
    ),
);

$fields[]= array(
    'type'        => 'select',
	'settings'    => 'xs_footer_builder_select',
	'label'       => esc_html__( 'Select Footer', 'marketo' ),
	'section'     => 'footer_section',
	'multiple'    => 1,
	'choices'     => marketo_ekit_footers(),
    'required'      => array(
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => true
        )
    ),
);

$fields[]= array(
    'type'        => 'custom',
	'settings'    => 'xs_footer_custom_setting',
	'section'     => 'footer_section',
    'default'         => '<h2 class="header_builder_edit"><a class="xs_builder_edit_link" style="text-transform: uppercase; color:green" target="_blank" href='. admin_url( 'post.php?action=elementor&post='.marketo_get_builder_id('xs_footer_builder_select', 'footer_builder_enable') ). '>'. esc_html('Edit content here.'). '</a></h2><h3><a style="text-transform: uppercase; color:#17a2b8" target="_blank" href="https://support.xpeedstudio.com/knowledgebase/customize-marketo-header-and-footer-builder/">'. esc_html('How to edit footer'). '</a></h3>',
    'priority'    => 10,
    'required'      => array(
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => true
        )
    ),
);

$fields[]= array(
    'type'        => 'radio-image',
    'settings'    => 'footer_style',
    'label'       => esc_html__( 'Footer Style', 'marketo' ),
    'section'     => 'footer_section',
    'default'     => '1',
    'choices'     => array(
        '1'   => get_template_directory_uri() . '/assets/images/footer/footer_1.png',
        '2' => get_template_directory_uri() . '/assets/images/footer/footer_2.png',
        '3' => get_template_directory_uri() . '/assets/images/footer/footer_3.png',
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_footer_logo',
    'label'       =>esc_html__( 'Show Footer Logo', 'marketo' ),
    'section'     => 'footer_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'marketo' ),
        'off' => esc_attr__( 'Disable', 'marketo' ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_style',
            'operator'  => '==',
            'value'     => 1,
        ),
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);

$fields[] = array(
    'type'        => 'image',
    'settings'    => 'footer_logo',
    'label'       => esc_html__( 'Footer Logo', 'marketo' ),
    'section'     => 'footer_section',
    'required'      => array(
        array(
            'setting'   => 'show_footer_logo',
            'operator'  => '==',
            'value'     => true
        ),
        array(
            'setting'   => 'footer_style',
            'operator'  => '==',
            'value'     => 1,
        ),
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);


$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_footer_layout',
    'label'       =>esc_html__( 'Show Footer Widget', 'marketo' ),
    'section'     => 'footer_section',
    'default'     => true,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'marketo' ),
        'off' => esc_attr__( 'Disable', 'marketo' ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);

$fields[] = array(
    'type'        => 'select',
    'settings'    => 'footer_widget_layout',
    'label'       => esc_html__( 'Number of Footer Widgets', 'marketo' ),
    'section'     => 'footer_section',
    'default'     => 4,
    'choices'     => array(
        1 => esc_attr__( '1', 'marketo' ),
        2 => esc_attr__( '2', 'marketo' ),
        3 => esc_attr__( '3', 'marketo' ),
        4 => esc_attr__( '4', 'marketo' ),
        5 => esc_attr__( '5', 'marketo' ),
        6 => esc_attr__( '6', 'marketo' ),
    ),
    'required'      => array(
        array(
            'setting'   => 'show_footer_layout',
            'operator'  => '==',
            'value'     => true
        ),
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);

$fields[] = array(
    'type'        => 'select',
    'settings'    => 'footer_widget_1_grid',
    'label'       => esc_html__( 'Number of Grids of Footer Widgets 1', 'marketo' ),
    'section'     => 'footer_section',
    'default'     => '3',
    'choices'     => array(
        '1' => esc_attr__( '1', 'marketo' ),
        '2' => esc_attr__( '2', 'marketo' ),
        '3' => esc_attr__( '3', 'marketo' ),
        '4' => esc_attr__( '4', 'marketo' ),
        '5' => esc_attr__( '5', 'marketo' ),
        '6' => esc_attr__( '6', 'marketo' ),
        '7' => esc_attr__( '7', 'marketo' ),
        '8' => esc_attr__( '8', 'marketo' ),
        '9' => esc_attr__( '9', 'marketo' ),
        '10' => esc_attr__( '10', 'marketo' ),
        '11' => esc_attr__( '11', 'marketo' ),
        '12' => esc_attr__( '12', 'marketo' ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_widget_layout',
            'operator'  => '>=',
            'value'     => 1
        ),
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);

$fields[] = array(
    'type'        => 'select',
    'settings'    => 'footer_widget_2_grid',
    'label'       => esc_html__( 'Number of Grids of Footer Widgets 2', 'marketo' ),
    'section'     => 'footer_section',
    'default'     => '3',
    'choices'     => array(
        '1' => esc_attr__( '1', 'marketo' ),
        '2' => esc_attr__( '2', 'marketo' ),
        '3' => esc_attr__( '3', 'marketo' ),
        '4' => esc_attr__( '4', 'marketo' ),
        '5' => esc_attr__( '5', 'marketo' ),
        '6' => esc_attr__( '6', 'marketo' ),
        '7' => esc_attr__( '7', 'marketo' ),
        '8' => esc_attr__( '8', 'marketo' ),
        '9' => esc_attr__( '9', 'marketo' ),
        '10' => esc_attr__( '10', 'marketo' ),
        '11' => esc_attr__( '11', 'marketo' ),
        '12' => esc_attr__( '12', 'marketo' ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_widget_layout',
            'operator'  => '>=',
            'value'     => 2
        ),
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'footer_widget_3_grid',
    'label'       => esc_html__( 'Number of Grids of Footer Widgets 3', 'marketo' ),
    'section'     => 'footer_section',
    'default'     => '3',
    'choices'     => array(
        '1' => esc_attr__( '1', 'marketo' ),
        '2' => esc_attr__( '2', 'marketo' ),
        '3' => esc_attr__( '3', 'marketo' ),
        '4' => esc_attr__( '4', 'marketo' ),
        '5' => esc_attr__( '5', 'marketo' ),
        '6' => esc_attr__( '6', 'marketo' ),
        '7' => esc_attr__( '7', 'marketo' ),
        '8' => esc_attr__( '8', 'marketo' ),
        '9' => esc_attr__( '9', 'marketo' ),
        '10' => esc_attr__( '10', 'marketo' ),
        '11' => esc_attr__( '11', 'marketo' ),
        '12' => esc_attr__( '12', 'marketo' ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_widget_layout',
            'operator'  => '>=',
            'value'     => 3
        ),
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'footer_widget_4_grid',
    'label'       => esc_html__( 'Number of Grids of Footer Widgets 4', 'marketo' ),
    'section'     => 'footer_section',
    'default'     => '3',
    'choices'     => array(
        '1' => esc_attr__( '1', 'marketo' ),
        '2' => esc_attr__( '2', 'marketo' ),
        '3' => esc_attr__( '3', 'marketo' ),
        '4' => esc_attr__( '4', 'marketo' ),
        '5' => esc_attr__( '5', 'marketo' ),
        '6' => esc_attr__( '6', 'marketo' ),
        '7' => esc_attr__( '7', 'marketo' ),
        '8' => esc_attr__( '8', 'marketo' ),
        '9' => esc_attr__( '9', 'marketo' ),
        '10' => esc_attr__( '10', 'marketo' ),
        '11' => esc_attr__( '11', 'marketo' ),
        '12' => esc_attr__( '12', 'marketo' ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_widget_layout',
            'operator'  => '>=',
            'value'     => 4
        ),
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'footer_widget_5_grid',
    'label'       => esc_html__( 'Number of Grids of Footer Widgets 5', 'marketo' ),
    'section'     => 'footer_section',
    'default'     => '3',
    'choices'     => array(
        '1' => esc_attr__( '1', 'marketo' ),
        '2' => esc_attr__( '2', 'marketo' ),
        '3' => esc_attr__( '3', 'marketo' ),
        '4' => esc_attr__( '4', 'marketo' ),
        '5' => esc_attr__( '5', 'marketo' ),
        '6' => esc_attr__( '6', 'marketo' ),
        '7' => esc_attr__( '7', 'marketo' ),
        '8' => esc_attr__( '8', 'marketo' ),
        '9' => esc_attr__( '9', 'marketo' ),
        '10' => esc_attr__( '10', 'marketo' ),
        '11' => esc_attr__( '11', 'marketo' ),
        '12' => esc_attr__( '12', 'marketo' ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_widget_layout',
            'operator'  => '>=',
            'value'     => 5
        ),
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'footer_widget_6_grid',
    'label'       => esc_html__( 'Number of Grids of Footer Widgets 6', 'marketo' ),
    'section'     => 'footer_section',
    'default'     => '3',
    'choices'     => array(
        '1' => esc_attr__( '1', 'marketo' ),
        '2' => esc_attr__( '2', 'marketo' ),
        '3' => esc_attr__( '3', 'marketo' ),
        '4' => esc_attr__( '4', 'marketo' ),
        '5' => esc_attr__( '5', 'marketo' ),
        '6' => esc_attr__( '6', 'marketo' ),
        '7' => esc_attr__( '7', 'marketo' ),
        '8' => esc_attr__( '8', 'marketo' ),
        '9' => esc_attr__( '9', 'marketo' ),
        '10' => esc_attr__( '10', 'marketo' ),
        '11' => esc_attr__( '11', 'marketo' ),
        '12' => esc_attr__( '12', 'marketo' ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_widget_layout',
            'operator'  => '>=',
            'value'     => 6
        ),
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);


$fields[] = array(
    'type'        => 'color',
    'settings'    => 'footer_bg_color',
    'label'       => esc_html__( 'Background Color', 'marketo' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.xs-footer-section .marketo-footer-top-layer',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-footer-section .xs-footer-main',
            'property'	=> 'background-color',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);
$fields[] = array(
    'type'        => 'color',
    'settings'    => 'footer_title_color',
    'label'       => esc_html__( 'Footer Title color', 'marketo' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.footer-widget h3.widget-title',
            'property'	=> 'color',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);



$fields[] = array(
    'type'        => 'color',
    'settings'    => 'footer_text_color',
    'label'       => esc_html__( 'Footer text color', 'marketo' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.xs-footer-description .media-body p',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.footer-widget .xs-tweet li',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.footer-widget .media-body',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.footer-widget .media-body address',
            'property'	=> 'color',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'footer_link_color',
    'label'       => esc_html__( 'Footer link color', 'marketo' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.xs-footer-description .media-body p a',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.footer-widget .menu-item a',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.xs-footer-section .footer-widget .marketo-single-footer a',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.footer-widget .xs-tweet li a',
            'property'	=> 'color',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);

$fields[] = array(
    'type'        => 'custom',
    'settings' => 'custom_title_transparent',
    'label'       => '',
    'section'     => 'footer_section',
    'default'     => '<div class="xs-title-divider">'.esc_html__("Copyright Section","marketo").'</div>',
    'required'      => array(
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);


$fields[]= array(
    'type'        => 'textarea',
    'settings'    => 'copyright_text',
    'label'       => esc_html__( 'Copyright text', 'marketo' ),
    'section'     => 'footer_section',
    'transport'   => 'postMessage',
    'js_vars'     => array(
        array(
            'element'  => '.marketo-footer-bottom .marketo-copyright-text p',
            'function' => 'html'
        ),
    ),
    'default'     => esc_html__( 'Copyrights By Xpeedstudio - '.date('Y').'', 'marketo' ),
    'required'      => array(
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);


$fields[] = array(
    'type'        => 'color',
    'settings'    => 'copyright_bg_color',
    'label'       => esc_html__( 'Background color', 'marketo' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.xs-footer-section .xs-footer-bottom-layer',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.marketo-footer-version-2 .marketo-footer-bottom-v2',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-footer-section .xs-back-to-top-wraper .xs-back-to-top',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-footer-section .xs-copyright',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-footer-info-and-payment .xs-map-popup.btn-warning',
            'property'	=> 'background-color',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'copyright_text_color',
    'label'       => esc_html__( 'Text color', 'marketo' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.marketo-footer-bottom .marketo-copyright-text p',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.marketo-footer-bottom-v2 .marketo-copyright-text-v2 p',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.xs-social-list-v7 li.xs-text-content ',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.xs-copyright-text',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.xs-copyright-text p',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.xs-payment-card .payment-title',
            'property'	=> 'color',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'copyright_link_color',
    'label'       => esc_html__( 'Link color', 'marketo' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.marketo-footer-bottom .marketo-copyright-text p a',
            'property'	=> 'color',
            'suffix'    => '!important',
        ),
        array(
            'element' 	=> '.marketo-footer-bottom-v2 .marketo-copyright-text-v2 p a',
            'property'	=> 'color',
            'suffix'    => '!important',
        ),
        array(
            'element' 	=> '.marketo-footer-bottom-v2 .marketo-copyright-text-v2 p a',
            'property'	=> 'color',
            'suffix'    => '!important',
        ),
        array(
            'element' 	=> '.xs-social-list-v7 li a',
            'property'	=> 'color',
            'suffix'    => '!important',
        ),
        array(
            'element' 	=> ' .xs-copyright .xs-copyright-text a',
            'property'	=> 'color',
	        'suffix'    => '!important',
        ),
	    array(
            'element' 	=> ' .xs-copyright .xs-social-list li a',
            'property'	=> 'color',
	        'suffix'    => '!important',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);




$fields[] = array(

    'type'        => 'repeater',
    'label'       => esc_attr__( 'Payment Method Logo Control', 'marketo' ),
    'section'     => 'footer_section',
    'priority'    => 10,
    'row_label' => array(
        'type' => 'text',
        'value' => esc_attr__('Payment Method Logo', 'marketo' ),
    ),
    'settings'    => 'payment_methods',
    'default'     => array(
        array(
            'payment_img' => '',
            'payment_url'  => '#',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_style',
            'operator'  => '==',
            'value'     => 1,
        ),
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
    'fields' => array(

        'payment_img' => array(
            'type'        => 'image',
            'label'       => esc_html__( 'Footer Logo', 'marketo' ),
            'description' => esc_attr__( 'This will be the Payment Gateway Logo', 'marketo' ),
            'default'     => '',
        ),
        'payment_url' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Payment URL', 'marketo' ),
            'description' => esc_attr__( 'This will be the Payment Gateway URL', 'marketo' ),
            'default'     => '#',
        ),
    )
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_back_to_top',
    'label'       =>esc_html__( 'Show Back To Top', 'marketo' ),
    'section'     => 'footer_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'marketo' ),
        'off' => esc_attr__( 'Disable', 'marketo' ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
);

$fields[] = array(
	'type'        => 'color',
	'settings'    => 'back_to_top_color',
	'label'       => esc_html__( 'Back To Top Color', 'marketo' ),
	'section'     => 'footer_section',
	'transport'   => 'auto',
	'required'      => array(
		array(
			'setting'   => 'show_back_to_top',
			'operator'  => '==',
			'value'     => 1,
		),
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
	'output'      => array(
		array(
			'element' 	=> '.xs-footer-section .xs-back-to-top-wraper .xs-back-to-top',
			'property'	=> 'color',
		),
	),
);

$fields[] = array(
	'type'        => 'color',
	'settings'    => 'back_to_top_bg_color',
	'label'       => esc_html__( 'Back To Top Bg Color', 'marketo' ),
	'section'     => 'footer_section',
	'transport'   => 'auto',
	'required'      => array(
		array(
			'setting'   => 'show_back_to_top',
			'operator'  => '==',
			'value'     => 1,
		),
        array(
            'setting'   => 'footer_builder_enable',
            'operator'  => '==',
            'value'     => ''
        )
    ),
	'output'      => array(
		array(
			'element' 	=> '.xs-footer-section .xs-back-to-top-wraper .xs-back-to-top',
			'property'	=> 'background-color',
		),
	),
);