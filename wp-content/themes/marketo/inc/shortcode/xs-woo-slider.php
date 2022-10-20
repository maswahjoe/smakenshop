<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Woo_Slider_Widget extends Widget_Base {

    public $base;

    public function get_name() {
        return 'xs-woo-slider';
    }

    public function get_title() {
        return esc_html__( 'Marketo Product Slider', 'marketo' );
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return [ 'marketo-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Product element', 'marketo'),
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
                ],
            ]
        );
        $this->add_control(
            'water_title',
            [
                'label' =>esc_html__('Water Text', 'marketo'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   =>esc_html__('Deal Of The Day', 'marketo'),
                'condition' => [
                        'style' => 'style1',
                ]
            ]
        );
        $this->add_control(
            'btn_label1',
            [
                'label' =>esc_html__('Button Label 1', 'marketo'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   =>esc_html__('BUY NOW', 'marketo'),
                'condition' => [
                    'style' => 'style1',
                ]
            ]
        );
        $this->add_control(
            'btn_label',
            [
                'label' =>esc_html__('Button Label 2', 'marketo'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   =>esc_html__('VIEW COLLECTIONS', 'marketo'),
                'condition' => [
                    'style' => 'style1',
                ]
            ]
        );

        $this->add_control(
            'product_ids',
            [
                'label' => __( 'Select Product', 'marketo' ),
                'type'      => Custom_Controls_Manager::AJAXSELECT2,
                'options'   =>'product_list',
                'multiple' => true,
                'condition' => [
                    'style' => 'style1',
                ],
                'default' => 0,
            ]
        );
        $this->add_control(
            'btn_link',
            [
                'label' =>esc_html__( 'Link', 'marketo' ),
                'type' => Controls_Manager::URL,
                'placeholder' =>esc_html__('http://your-link.com','marketo' ),
                'default' => [
                    'url' => '#',
                ],
                'condition' => [
                    'style' => 'style1',
                ]
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'xs_product',
            [
                'label' =>esc_html__('Product Name', 'marketo'),
                'type'      => Custom_Controls_Manager::AJAXSELECT2,
                'options'   =>'product_list',
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'show_product_image',
            [
                'label'	=>	esc_html__('Show Product Image','marketo'),
                'type'	=> Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' =>esc_html__( 'Yes', 'marketo' ),
                'label_off' =>esc_html__( 'No', 'marketo' ),

            ]
        );
        $repeater->add_control(
            'image',
            [
                'label' =>esc_html__('Image', 'marketo'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
                'condition' => [
                    'show_product_image' => '',
                ]
            ]
        );

        $this->add_control(
            'xs_allproduct',
            [
                'label' =>esc_html__('Product Element', 'marketo'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'xs_product' =>0,
                        'show_product_image' => esc_html__('yes','marketo'),
                        'image' => Utils::get_placeholder_image_src(),
                    ],

                    [
                        'xs_product' => 0,
                        'show_product_image' => esc_html__('yes','marketo'),
                        'image' => Utils::get_placeholder_image_src(),
                    ],

                    [
                        'xs_product' =>0,
                        'show_product_image' => esc_html__('yes','marketo'),
                        'image' => Utils::get_placeholder_image_src(),
                    ],
                ],
                'fields' => $repeater->get_controls(),
                'condition' => [
                    'style' => 'style2',
                ],
            ]
        );

        $this->add_control(
            'product_count',
            [
                'label'         => esc_html__( 'Product count', 'marketo' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => esc_html__( '3', 'marketo' ),
                'condition' => [
                    'style' => 'style1',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style', [
                'label'	 =>esc_html__( 'Style', 'marketo' ),
                'tab'	 => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style1',
                ]
            ]
        );

        $this->add_control(
            'pd_background_color', [
                'label'		 =>esc_html__( 'Background Color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-deal-of-the-day-section' => 'background-color: {{VALUE}};'
                ]
            ]
        );
        $this->add_control(
            'padding',
            [
                'label' => esc_html__( 'Padding', 'marketo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .xs-deal-of-the-day-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_control(
            'pd_cat_title_color', [
                'label'		 =>esc_html__( 'Category color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .best-deal-sub-title' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'		 => 'slider_cat_title_typography',
                'selector'	 => '{{WRAPPER}} .best-deal-sub-title',
            ]
        );
        $this->add_control(
            'pd_title_color', [
                'label'		 =>esc_html__( 'Title color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .best-deal-title' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'		 => 'slider_title_typography',
                'selector'	 => '{{WRAPPER}} .best-deal-title',
            ]
        );
       // Price color and typography
        $this->add_control(
            'pd_reg_price_color', [
                'label'		 =>esc_html__( 'Regular Price color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .price del' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'pd_sel_price_color', [
                'label'		 =>esc_html__( 'Sell Price color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .price ins span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'		 => 'sell_title_typography',
                'label'		 =>esc_html__( 'Regular Price Typography', 'marketo' ),
                'selector'	 => '{{WRAPPER}} .price del',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'		 => 'sell_price_typography',
                'label'		 =>esc_html__( 'Sell Price Typography', 'marketo' ),
                'selector'	 => '{{WRAPPER}} .price ins span',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'marketo_product_slider_water_mark', [
                'label'	 =>esc_html__( 'WaterMark Style', 'marketo' ),
                'tab'	 => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pd_watter_color', [
                'label'		 =>esc_html__( 'Watermark color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-watermark-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'		 => 'xs_watter_typography',
                'label'		 =>esc_html__( 'Watermark Typography', 'marketo' ),
                'selector'	 => '{{WRAPPER}} .xs-watermark-text',
            ]
        );

        $this->add_control(
			'xs_watter_mark_vertical_position',
			[
				'label' => __( 'Watter Mark Vertical Position', 'marketo' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 600,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .xs-watermark-text' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);


        // Button setting 
        $this->end_controls_section();

        $this->start_controls_section(
            'marketo_product_slider_btn', [
                'label'	 =>esc_html__( 'Button Style', 'marketo' ),
                'tab'	 => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'pd_btn1_color', [
                'label'		 =>esc_html__( 'Button Label 1 Color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .btn-product-slider-1' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'		 => 'xs_btn1_typography',
                'label'		 =>esc_html__( 'Button Label 1  Typography', 'marketo' ),
                'selector'	 => '{{WRAPPER}} .btn-product-slider-1',
            ]
        );

        $this->add_control(
            'pd_background1_color', [
                'label'		 =>esc_html__( 'Button 1  Background Color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .btn-product-slider-1' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'pd_background1_hv_color', [
                'label'		 =>esc_html__( 'Button 1  hover Background  Color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .btn-product-slider-1:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'pd_border1_color', [
                'label'		 =>esc_html__( 'Button 1 border Color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .btn-product-slider-1' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'pd_border1_hv_color', [
                'label'		 =>esc_html__( 'Button 1 border Color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .btn-product-slider-1:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        // Button 2
        $this->add_control(
            'pd_btn2_color', [
                'label'		 =>esc_html__( 'Button Label 2 Color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .btn-product-slider-2' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'		 => 'xs_btn2_typography',
                'label'		 =>esc_html__( 'Button Label 2  Typography', 'marketo' ),
                'selector'	 => '{{WRAPPER}} .btn-product-slider-2',
            ]
        );

        $this->add_control(
            'pd_background2_color', [
                'label'		 =>esc_html__( 'Button 2  Background Color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .btn-product-slider-2' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'pd_background2_hv_color', [
                'label'		 =>esc_html__( 'Button 2  hover Background  Color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .btn-product-slider-2:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'pd_border2_color', [
                'label'		 =>esc_html__( 'Button 2 border Color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .btn-product-slider-2' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'pd_border2_hv_color', [
                'label'		 =>esc_html__( 'Button 2 border Color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .btn-product-slider-1:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render( ) {
        $settings = $this->get_settings();
        $style = $settings['style'];
        $product_ids = $settings['product_ids'];
        $water_title = $settings['water_title'];
        $btn_label = $settings['btn_label'];
        $btn_label1 = $settings['btn_label1'];
        $product_count = $settings['product_count'];
        $btn_link = (! empty( $settings['btn_link']['url'])) ? $settings['btn_link']['url'] : '';
        $btn_target = ( $settings['btn_link']['is_external']) ? '_blank' : '_self';
        $args = array(
            'post_type'         => array('product'),
            'post_status'       => array('publish'),
        );
        switch ($style) {
            case 'style1':
                require MARKETO_SHORTCODE_DIR_STYLE.'/product-slider/style1.php';
                break;

            case 'style2':
                require MARKETO_SHORTCODE_DIR_STYLE.'/product-slider/style2.php';
                break;
        }
    }

    protected function content_template() { }
}