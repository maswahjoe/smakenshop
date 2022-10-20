<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Cats_Products_Widget extends Widget_Base {

    public $base;

    public function get_name() {
        return 'xs-cats-product';
    }

    public function get_title() {
        return esc_html__( 'Marketo Product Category', 'marketo' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return [ 'marketo-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Select Categories', 'marketo'),
            ]
        );

        $this->add_control(
            'style',
            [
                'label'     => esc_html__( 'Style', 'marketo' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'style1',
                'options'   => [
                    'style1'     => esc_html__( 'style 1', 'marketo' ),
                    'style2'     => esc_html__( 'style 2', 'marketo' ),
                    'style3'     => esc_html__( 'style 3', 'marketo' ),
                ],
            ]
        );

        $this->add_control(
            'head_title',
            [
                'label' =>esc_html__('Title', 'marketo'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   =>esc_html__('Title Here', 'marketo'),
                'condition'     => [
                    'style' => ['style1']
                ]
            ]
        );

        $this->add_control(
            'xs_woo_cats_selector',
            [
                'label' => esc_html__('Select category', 'marketo'),
                'type'      => Custom_Controls_Manager::AJAXSELECT2,
                'options'   =>'product_cat',
                'multiple' => 'true',
                'label_block' => true
            ]
        );

        $this->add_control(
            'product_count',
            [
                'label'         => esc_html__( 'Product count', 'marketo' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => esc_html__( '3', 'marketo' ),
                'condition'     => [
                    'style' => ['style1','style2','style3']
                ]

            ]
        );


        $this->end_controls_section();
		 $this->start_controls_section(
            'section_style', [
                'label'	 =>esc_html__( 'Style', 'marketo' ),
                'tab'	 => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'markato_product_cat_section_title_color',
			[
				'label' => esc_html__( 'Section Title Color', 'marketo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xs-content-header .xs-content-title' => 'color: {{VALUE}}',
                ],
                'condition'  => [
                    'style' => ['style1']
                ],
			]
        );
        
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'markato_product_cat_section_title_typography',
				'label' => esc_html__( 'Typography', 'marketo' ),
                'selector' => '{{WRAPPER}} .xs-content-header .xs-content-title',
                'condition'  => [
                    'style' => ['style1']
                ],
			]
		);

        $this->start_controls_tabs(
             'marketo_tab_heading_control', 
             [
                'condition'  => [
                    'style' => ['style3', 'style2']
                ],
             ]
       );

        $this->start_controls_tab(
			'marketo_tab_heading_control_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'marketo' ),
			]
        );

        $this->add_control(
            'tab_color_normal', [
                'label'		 =>esc_html__( 'Tab heading bg color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-nav-tab-v3 .nav-item .nav-link' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .xs-nav-tab-v3 .nav-item .nav-link::after' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .xs-nav-tab-v3 .nav-item .nav-link span' => 'color: {{VALUE}};'
                ],
                'condition'  => [
                    'style' => ['style3', 'style2']
                ],
            ]
        );

        $this->add_control(
            'tab_right_boder_color', [
                'label'		 =>esc_html__( 'Border color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-nav-tab-v3 .nav-item .nav-link::before' => 'border-color: {{VALUE}};',
                ],
                'condition'  => [
                    'style' => ['style3', 'style2']
                ],
            ]
        );

        $this->add_control(
            'tab_text_color', [
                'label'		 =>esc_html__( 'Tab title color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-nav-tab-v3 .nav-item .nav-link' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .xs-nav-tab-v3 .nav-item .nav-link small' => 'color: {{VALUE}};',
                ],
                'condition'  => [
                    'style' => ['style3', 'style2']
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
			'marketo_tab_heading_control_active_tab',
			[
				'label' => esc_html__( 'Active', 'marketo' ),
			]
        );
        $this->add_control(
            'tab_color', [
                'label'		 =>esc_html__( 'Tab heading bg color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-nav-tab-v3 .nav-item .nav-link.active' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .xs-nav-tab-v3 .nav-item .nav-link::after' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .xs-nav-tab-v3 .nav-item .nav-link span' => 'color: {{VALUE}};'
                ],
                'condition'  => [
                    'style' => ['style3', 'style2']
                ],
            ]
        );

        $this->add_control(
            'tab_text_color_active', [
                'label'		 =>esc_html__( 'Tab title color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-nav-tab-v3 .nav-item .nav-link.active' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .xs-nav-tab-v3 .nav-item .nav-link.active small' => 'color: {{VALUE}} !important;',
                ],
                'condition'  => [
                    'style' => ['style3', 'style2']
                ],
            ]
        );


		$this->end_controls_tab();

        $this->end_controls_tabs();

         $this->end_controls_section();
         
         $this->start_controls_section(
			'marketo_prodcut_cat_product_style',
			[
				'label' => esc_html__( 'Product Style', 'marketo' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );
        $this->add_control(
			'marketo_prodcut_cat_product_typography_title_section',
			[
				'label' => esc_html__( 'Title Style Setting', 'marketo' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'marketo_prodcut_cat_product_typography_title',
				'label' => esc_html__( 'Typography', 'marketo' ),
				'selector' => '{{WRAPPER}} .product-category-version-2 .product-title a',
			]
		);

        $this->start_controls_tabs(
			'marketo_prodcut_cat_product_title_color_setting'
        );  
        
        $this->start_controls_tab(
			'marketo_prodcut_cat_product_title_color_normal_setting',
			[
				'label' => esc_html__( 'Normal', 'marketo' ),
			]
        );
        
        $this->add_control(
            'marketo_prodcut_cat_product_title_color_normal', [
                'label'		 =>esc_html__( 'Color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-product-widget .product-title a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-category-version-2 .product-title a' => 'color: {{VALUE}};',
                ],
               
            ]
        );

        $this->end_controls_tab();

		$this->start_controls_tab(
			'marketo_prodcut_cat_product_title_color_hover_setting',
			[
				'label' => esc_html__( 'Hover', 'marketo' ),
			]
        );
        $this->add_control(
            'marketo_prodcut_cat_product_title_color_hover', [
                'label'		 =>esc_html__( 'Color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-product-widget .product-title a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-category-version-2 .product-title a:hover' => 'color: {{VALUE}};',
                ],
               
            ]
        );
		$this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->add_control(
			'marketo_prodcut_cat_product_typography_price_section',
			[
				'label' => esc_html__( 'Price Style Setting', 'marketo' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'marketo_prodcut_cat_product_price_color', [
                'label'		 =>esc_html__( 'Color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-product-widget .woocommerce-Price-amount.amount' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-category-version-2 .woocommerce-Price-amount.amount' => 'color: {{VALUE}};',
                ],
               
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'marketo_prodcut_cat_product_price_typography',
				'label' => esc_html__( 'Typography', 'marketo' ),
				'selector' => '{{WRAPPER}} .product-category-version-2 .woocommerce-Price-amount.amount',
			]
		);

        $this->end_controls_section();  
   
    }

    protected function render( ) {
        $settings = $this->get_settings();
        $style = $settings['style'];
        $product_tab = $settings['xs_woo_cats_selector'];
        $head_title = $settings['head_title'];
        $product_count = $settings['product_count'];

        switch ($style) {
            case 'style1':
                require MARKETO_SHORTCODE_DIR_STYLE.'/product-cat/style1.php';
                break;

            case 'style2':
                require MARKETO_SHORTCODE_DIR_STYLE.'/product-cat/style2.php';
                break;

            case 'style3':
                require MARKETO_SHORTCODE_DIR_STYLE.'/product-cat/style3.php';
                break;

        }
        ?>

    <?php }
    protected function content_template() { }
}