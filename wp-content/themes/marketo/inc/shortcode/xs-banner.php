<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


class Xs_Banner extends Widget_Base
{


    public function get_name()
    {
        return 'xs-banner';
    }


    public function get_title()
    {
        return __('Marketo Banner', 'marketo');
    }


    public function get_icon()
    {
        return 'eicon-banner';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the image widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @since 2.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['marketo-elements'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_image',
            [
                'label' => esc_html__('Image', 'marketo'),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__('Style', 'marketo'),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('style 1', 'marketo'),
                    'style2' => esc_html__('style 2', 'marketo'),
                    'style3' => esc_html__('style 3', 'marketo'),
                ],
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'marketo'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'image_position',
            [
                'label' => esc_html__( 'Image Position', 'marketo' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 5,
                    ],

                ],
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .media-body' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'style' => 'style2'
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'marketo'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('Enter your title', 'marketo'),
                'default' => esc_html__('Basic Gift Idea', 'marketo'),
            ]
        );
        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__('Sub Title', 'marketo'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('Enter your Sub Title', 'marketo'),
                'default' => esc_html__("Mini Two Wheel Self Balancing Scooter ", 'marketo'),
            ]
        );
        $this->add_control(
            'sub_desc',
            [
                'label' => esc_html__('Description', 'marketo'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('Enter your Description', 'marketo'),
                'default' => esc_html__(" Mini Two Wheel Self Balancing Scooter ", 'marketo'),
                'condition' => [
                    'style' => 'style3',
                ]
            ]
        );
        $this->add_control(
            'banner_link',
            [
                'label' => esc_html__('Link', 'marketo'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('#', 'marketo'),
                'default' => esc_html__('#', 'marketo'),
            ]
        );
        $this->add_control(
            'btn_label',
            [
                'label' => esc_html__('Button Label', 'marketo'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Go Shop', 'marketo'),
                'default' => esc_html__('Go Shop', 'marketo'),
            ]
        );

        $this->add_control(
            'btn_link',
            [
                'label' => esc_html__('Link to', 'marketo'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'marketo'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_general_style', [
                'label' => esc_html__('general', 'marketo'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'     => ['style' => 'style1']
            ]
        );

        $this->add_control(
            'tab_title_padding',
            [
                'label' => esc_html__( 'Max Width', 'marketo' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],

                'size_units' => [ '%'],
                'selectors' => [
                    '{{WRAPPER}} .offer-banner-content' => 'max-width: {{SIZE}}%;',
                ],
                'condition' =>  [
                    'style' =>  'style1'
                ],
            ]
        );
        $this->add_control(
            'hover_effect',
            [
                'label'         => esc_html__( 'Hover Effect', 'marketo' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'marketo' ),
                'label_off'     => esc_html__( 'No', 'marketo' ),
                'default'   => 'yes',
                'condition' =>  [
                    'style' =>  'style1'
                ]
            ]
        );
        $this->end_controls_section();
        //Title Style Section
        $this->start_controls_section(
            'section_title_style', [
                'label' => esc_html__('Title', 'marketo'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color', [
                'label' => esc_html__('Title color', 'marketo'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .offer-banner-content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .organic-widget-content h4' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'title_margin_bottom',
            [
                'label' => esc_html__( 'Margin Bottom', 'marketo' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],

                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .offer-banner-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .organic-widget-content h4' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .offer-banner-content p, {{WRAPPER}} .organic-widget-content h4',
            ]
        );

        $this->end_controls_section();

        //Subtitle Style Section
        $this->start_controls_section(
            'section_subtitle_style', [
                'label' => esc_html__('Sub Title', 'marketo'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'subtitle_color', [
                'label' => esc_html__('color', 'marketo'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .offer-banner-content h3' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .organic-widget-content h5' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .offer-banner-content h3 , {{WRAPPER}} .organic-widget-content h5',
            ]
        );

        $this->add_control(
            'sutitle_margin_bottom',
            [
                'label' => esc_html__( 'Margin Bottom', 'marketo' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],

                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .offer-banner-content h3' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .organic-widget-content h5' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //Description Style Section
        $this->start_controls_section(
            'section_desc_style', [
                'label' => esc_html__('Desscription Title', 'marketo'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style3'
                ]
            ]
        );

        $this->add_control(
            'desc_color', [
                'label' => esc_html__('color', 'marketo'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .organic-widget-content p' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'desc_typography',
                'selector' => '{{WRAPPER}} .organic-widget-content p',
            ]
        );

        $this->end_controls_section();

        //Description Style Section
        $this->start_controls_section(
            'section_bg_style', [
                'label' => esc_html__('Background Color', 'marketo'),
                'tab' => Controls_Manager::TAB_STYLE,

            ]
        );

        $this->add_control(
            'bg_color', [
                'label' => esc_html__('Bg color', 'marketo'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .small-offer-banner' => 'background-color: {{VALUE}};'
                ],
                'condition' => [
                    'style!' => 'style3'
                ]
            ]
        );
        $this->add_control(
            'bg_color_one', [
                'label' => esc_html__('Bg color One', 'marketo'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-organic-product-widget' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .xs-organic-product-widget:before' => 'border-color: {{VALUE}};'
                ],
                'condition' => [
                    'style' => 'style3'
                ]
            ]
        );

        $this->add_control(
            'bg_color_two', [
                'label' => esc_html__('Bg color One', 'marketo'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-organic-product-widget::before' => 'background-color: {{VALUE}};'
                ],
                'condition' => [
                    'style' => 'style3'
                ]
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Button Style', 'marketo'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style!' => 'style3'
                ]
            ]
        );

        $this->start_controls_tabs('xs_tabs_button_style');

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => esc_html__('Normal', 'marketo'),
            ]
        );

        $this->add_control(
            'btn_text_color',
            [
                'label' => esc_html__('Text Color', 'marketo'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .btn-primary' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_color',
            [
                'label' => esc_html__('Background Color', 'marketo'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-primary' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'btn_tab_button_hover',
            [
                'label' => esc_html__('Hover', 'marketo'),
            ]
        );

        $this->add_control(
            'btn_hover_color',
            [
                'label' => esc_html__('Text Color', 'marketo'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-primary:hover' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_hover_color',
            [
                'label' => esc_html__('Background Color', 'marketo'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-primary::before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

    }

    /**
     * Render image widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $style = $settings['style'];
        $image = $settings['image'];
        $title = $settings['title'];
        $sub_title = $settings['sub_title'];
        $sub_desc = $settings['sub_desc'];
        $banner_link = $settings['banner_link'];
        $btn_label = $settings['btn_label'];
        $btn_link = (!empty($settings['btn_link']['url'])) ? $settings['btn_link']['url'] : '';
        $btn_target = ($settings['btn_link']['is_external']) ? '_blank' : '_self';
        $hover_effect = ($settings['hover_effect']) ? '' : 'xs-no-hover';
        $alt = '';
        if (!empty($image['image']['id'])) {
            $alt = get_post_meta($image['image']['id'], '_wp_attachment_image_alt', true);
            if (!empty($alt)) {
                $alt = $alt;
            } else {
                $alt = get_the_title($image['image']['id']);
            }
        }

        switch ($style) {
            case 'style1':
                require MARKETO_SHORTCODE_DIR_STYLE . '/banner/style1.php';
                break;

            case 'style2':
                require MARKETO_SHORTCODE_DIR_STYLE . '/banner/style2.php';
                break;

            case 'style3':
                require MARKETO_SHORTCODE_DIR_STYLE . '/banner/style3.php';
                break;

        }
        ?>

        <?php
    }

    /**
     * Render image widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function content_template()
    {
    }

}
