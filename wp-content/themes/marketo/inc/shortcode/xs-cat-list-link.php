<?php

namespace Elementor;

if (!defined('ABSPATH')) exit;

class Xs_Woo_Cats_List_Widget extends Widget_Base
{

    public $base;

    public function get_name()
    {
        return 'xs-woo-cats-list-link';
    }

    public function get_title()
    {
        return esc_html__('Marketo Category Link', 'marketo');
    }

    public function get_icon()
    {
        return 'eicon-posts-grid';
    }

    public function get_categories()
    {
        return ['marketo-elements'];
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Select Categories', 'marketo'),
            ]
        );

        $this->add_control(
            'xs_woo_cats_selector_title',
            [
                'label' => esc_html__('Title', 'marketo'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('Title Here', 'marketo'),
            ]
        );

        $this->add_control(
            'xs_woo_cats_link',
            [
                'label' => esc_html__('Select category', 'marketo'),
                'type'      => Custom_Controls_Manager::AJAXSELECT2,
                'label_block' => true,
                'options'   =>'product_cat', 
                'multiple' => 'true',
            ]
        );

        $this->add_responsive_control(
            'heading_link_text_align', [
                'label'			 =>esc_html__( 'Alignment', 'marketo' ),
                'type'			 => Controls_Manager::CHOOSE,
                'options'		 => [

                    'left'		 => [
                        'title'	 =>esc_html__( 'Left', 'marketo' ),
                        'icon'	 => 'fa fa-align-left',
                    ],
                    'center'	 => [
                        'title'	 =>esc_html__( 'Center', 'marketo' ),
                        'icon'	 => 'fa fa-align-center',
                    ],
                ],
                'default'		 => '',
                'selectors' => [
                    '{{WRAPPER}} .block-product-cate-wraper' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .xs-about-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        /*Mega Menu Styles for Heading*/
        $this->start_controls_section(
            'section_style',
            [
                'label' =>esc_html__( 'Heading Style', 'marketo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'heading_text_color',
            [
                'label' =>esc_html__( 'Heading Color', 'marketo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} h3.block-cate-header' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'label' =>esc_html__( 'Typography', 'marketo' ),
                'selector' => '{{WRAPPER}} h3.block-cate-header',
            ]
        );
        $this->add_control(
            'margin_bottom',
            [
                'label' =>esc_html__( 'Margin Bottom', 'marketo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} h3.block-cate-header' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'padding_bottom',
            [
                'label' =>esc_html__( 'Padding Bottom', 'marketo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 12,
                ],
                'selectors' => [
                    '{{WRAPPER}} h3.block-cate-header' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'heading_border_bottom',
            [
                'label' =>esc_html__( 'Border Bottom', 'marketo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'default' => [''],
                'selectors' => [
                    '{{WRAPPER}} h3.block-cate-header' => 'border-bottom: {{SIZE}}{{UNIT}} solid;',
                ],
            ]
        );
        $this->add_control(
            'border_color',
            [
                'label' =>esc_html__( 'Border Color', 'marketo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h3.block-cate-header' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        /*Mega Menu Styles for links*/
        $this->start_controls_section(
            'link_style',
            [
                'label' =>esc_html__( 'Link Style', 'marketo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'link_text_color',
            [
                'label' =>esc_html__( 'Link Color', 'marketo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .block-product-cate-wraper .nav .nav-link' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'link_hover_color',
            [
                'label' =>esc_html__( 'Link Hover Color', 'marketo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .block-product-cate-wraper .nav .nav-link:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'link_typography',
                'label' =>esc_html__( 'Typography', 'marketo' ),
                'selector' => '{{WRAPPER}} .block-product-cate-wraper .nav .nav-link',
            ]
        );
        $this->add_control(
            'link_padding_bottom',
            [
                'label' =>esc_html__( 'Padding Top Bottom', 'marketo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .block-product-cate-wraper .nav .nav-link' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'link_border_bottom',
            [
                'label' =>esc_html__( 'Border Bottom', 'marketo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'default' => [''],
                'selectors' => [
                    '{{WRAPPER}} .block-product-cate-wraper .nav .nav-link' => 'border-bottom: {{SIZE}}{{UNIT}} solid;',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings();
        $xs_woo_cats_selector = $settings['xs_woo_cats_link'];
        $xs_woo_cats_selector_title = $settings['xs_woo_cats_selector_title'];
        ?>
        <div class="block-product-cate-wraper">
            <h3 class="block-cate-header"><?php echo esc_html($xs_woo_cats_selector_title); ?></h3>
            <ul class="nav flex-column">
                <?php
                
                if (is_array($xs_woo_cats_selector) && !empty($xs_woo_cats_selector)) {
                    foreach ($xs_woo_cats_selector as $xs_woo_cat_selector) {
                        ?>
                        <li class="nav-item"><a class="nav-link"
                                href="<?php echo get_category_link($xs_woo_cat_selector); ?>"><?php echo get_the_category_by_ID($xs_woo_cat_selector); ?></a>
                        </li><?php
                    }
                }

                ?>
            </ul>
        </div>
        <?php
    }

    protected function content_template()
    {
    }
}