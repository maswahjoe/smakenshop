<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) )
    exit;

class Xs_Subscribe_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-subscribe';
    }

    public function get_title() {
        return esc_html__( 'Marketo Subscribe Form', 'marketo' );
    }

    public function get_icon() {
        return 'eicon-email-field';
    }

    public function get_categories() {
        return [ 'marketo-elements' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_tab', [
                'label' =>esc_html__( 'Subscribe Form', 'marketo' ),
            ]
        );

        $this->add_control(
            'style', [
                'type'		 => Controls_Manager::SELECT,
                'label'		 => esc_html__( 'Choose Style', 'marketo' ),
                'default'	 => 'style1',
                'label_block'	 => true,
                'options'	 => [
                    'style1' => esc_html__( 'Style 1', 'marketo' ),
                    'style2' => esc_html__( 'Style 2', 'marketo' ),
                ],
            ]
        );

        $this->add_control(
            'link', [
                'label'			 => esc_html__( 'Mailchip form Action Url', 'marketo' ),
                'type'			 => Controls_Manager::TEXTAREA,
                'label_block'	 => true,
                'placeholder'	 => esc_html__( 'Enter Mailchip Form Action Link', 'marketo' ),
                'description'	 => 'Check this how to find <a href="https://support.xpeedstudio.com/knowledgebase/how-to-get-a-mailchimp-form-action-url/">Mailchimp Action Url</a>',
            ]
        );
        $this->end_controls_section();
        //Button Style Section
        $this->start_controls_section(
            'section_title_style', [
                'label'	 =>esc_html__( 'Button Style', 'marketo' ),
                'tab'	 => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'btn_border_radius',
            [
                'label' =>esc_html__( 'Border Radius', 'marketo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '' ,
                    'left' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .xs-mailchimp-btn' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_border_width',
            [
                'label' =>esc_html__( 'Border Width', 'marketo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '' ,
                    'left' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .xs-mailchimp-btn' =>  'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};border-style:solid;',
                ],
            ]
        );
        $this->add_control(
            'btn_border_color', [
                'label'		 =>esc_html__( 'Border Color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-mailchimp-btn' => 'border-color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'border_hover_color', [
                'label'		 =>esc_html__( 'Hover Border Color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-mailchimp-btn:hover' => 'border-color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'btn_color', [
                'label'		 =>esc_html__( 'Button Color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-mailchimp-btn' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'btn_hover_color', [
                'label'		 =>esc_html__( 'Button Hover Color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-mailchimp-btn:hover' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'btn_bg_color', [
                'label'		 =>esc_html__( 'Button Bg Color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-mailchimp-btn' => 'background-color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'btn_bg_hover_color', [
                'label'		 =>esc_html__( 'Button Bg Hover Color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-mailchimp-btn:hover' => 'background-color: {{VALUE}};'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_field_tab', [
                'label' =>esc_html__( 'Field Style', 'marketo' ),
                'tab'	 => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'field_border_radius',
            [
                'label' =>esc_html__( 'Border Radius', 'marketo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '' ,
                    'left' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .xs-newsletter input:not([type="submit"])' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'field_border_width',
            [
                'label' =>esc_html__( 'Border Width', 'marketo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '' ,
                    'left' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .xs-newsletter input:not([type="submit"])' =>  'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};border-style:solid;',
                ],
            ]
        );
        $this->add_control(
            'field_border_color', [
                'label'		 =>esc_html__( 'Border Color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-newsletter input:not([type="submit"])' => 'border-color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'field_bg_color', [
                'label'		 =>esc_html__( 'BG Color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-newsletter input:not([type="submit"])' => 'background-color: {{VALUE}};'
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $style = $settings[ 'style' ];
        $link = $settings[ 'link' ];

        switch ( $style ) {
            case 'style1':
                require MARKETO_SHORTCODE_DIR_STYLE . '/form/style1.php';
                break;

            case 'style2':
                require MARKETO_SHORTCODE_DIR_STYLE . '/form/style2.php';
                break;
        }
    }

    protected function content_template() {

    }
}