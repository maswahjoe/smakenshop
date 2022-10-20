<?php

namespace Elementor;

if (!defined('ABSPATH'))
    exit;

class Xs_My_Account_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-my-account';
    }

    public function get_title() {
        return esc_html__( 'Marketo My Account', 'marketo' );
    }

    public function get_icon() {
        return 'eicon-user-circle-o';
    }

    public function get_categories() {
        return [ 'marketo-elements' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_tab',
            [
                'label' =>esc_html__('Marketo My Account', 'marketo'),
            ]
        );

        $this->add_control(
            'login_btn_text',
            [
                'label' =>esc_html__( 'Login Text', 'marketo' ),
                'type' => Controls_Manager::TEXT,
                'default' =>esc_html__( 'Login ', 'marketo' ),
                'placeholder' =>esc_html__( 'Login ', 'marketo' ),
            ]
        );
        $this->add_control(
            'account_btn_text',
            [
                'label' =>esc_html__( 'Account Text', 'marketo' ),
                'type' => Controls_Manager::TEXT,
                'default' =>esc_html__( 'My Account ', 'marketo' ),
                'placeholder' =>esc_html__( 'My Account ', 'marketo' ),
            ]
        );

        $this->add_control(
            'login_btn_link',
            [
                'label' =>esc_html__( 'Login Link', 'marketo' ),
                'type' => Controls_Manager::URL,
                'placeholder' =>esc_html__('http://your-link.com','marketo' ),
                'default' => [
                    'url' => '#',
                ],
            ]
        );
        $this->add_control(
            'account_btn_link',
            [
                'label' =>esc_html__( 'Account Link', 'marketo' ),
                'type' => Controls_Manager::URL,
                'placeholder' =>esc_html__('http://your-link.com','marketo' ),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_responsive_control(
            'btn_align',
            [
                'label' =>esc_html__( 'Alignment', 'marketo' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left'    => [
                        'title' =>esc_html__( 'Left', 'marketo' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' =>esc_html__( 'Center', 'marketo' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' =>esc_html__( 'Right', 'marketo' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'prefix_class' => 'elementor%s-align-',
                'default' => '',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' =>esc_html__( 'Button Style', 'marketo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'boder_width',
            [
                'label' =>esc_html__( 'Border Width', 'marketo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0 ,
                    'left' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .btn-primary' =>  'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};border-style: solid;',
                ],
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
                    '{{WRAPPER}} .btn-primary' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'btn_padding',
            [
                'label' =>esc_html__( 'Padding', 'marketo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '' ,
                    'left' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .btn-primary' =>  'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'label' =>esc_html__( 'Typography', 'marketo' ),
                'selector' => '{{WRAPPER}} a.btn-primary',
            ]
        );

        $this->start_controls_tabs( 'xs_tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' =>esc_html__( 'Normal', 'marketo' ),
            ]
        );

        $this->add_control(
            'btn_text_color',
            [
                'label' =>esc_html__( 'Text Color', 'marketo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} a.btn-primary' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_color',
            [
                'label' =>esc_html__( 'Background Color', 'marketo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a.btn-primary' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'border_color', [
                'label'		 =>esc_html__( 'Border color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .btn-primary' => 'border-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'btn_tab_button_hover',
            [
                'label' =>esc_html__( 'Hover', 'marketo' ),
            ]
        );

        $this->add_control(
            'btn_hover_color',
            [
                'label' =>esc_html__( 'Text Color', 'marketo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a.btn-primary:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_hover_color',
            [
                'label' =>esc_html__( 'Background Color', 'marketo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-primary:before' => 'border-bottom: 100px solid {{VALUE}};',
                    '{{WRAPPER}} .btn-primary:after' => 'border-top: 100px solid {{VALUE}};',
                    '{{WRAPPER}} .btn-primary::before' => 'background-color:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_hover_border_color',
            [
                'label' =>esc_html__( 'Border Color', 'marketo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a.btn-primary:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();

    }

    protected function render( ) {
        $settings = $this->get_settings();

        $login_btn_text = $settings['login_btn_text'];
        $account_btn_text = $settings['account_btn_text'];

        $login_btn_link = (! empty( $settings['login_btn_link']['url'])) ? $settings['login_btn_link']['url'] : '';
        $account_btn_link = (! empty( $settings['account_btn_link']['url'])) ? $settings['account_btn_link']['url'] : '';

        $login_btn_target = ( $settings['login_btn_link']['is_external']) ? '_blank' : '_self';
        $account_btn_target = ( $settings['account_btn_link']['is_external']) ? '_blank' : '_self';

        ?>
        <?php if( ! is_user_logged_in() && !empty($login_btn_text)): ?>
            <a href="<?php echo esc_url( $login_btn_link ); ?>" target="<?php echo esc_html( $login_btn_target ); ?>" class="btn btn-primary">
                <?php echo esc_html( $login_btn_text ); ?>
            </a>
        <?php endif; ?>
        <?php if(is_user_logged_in() && !empty($account_btn_text)): ?>
            <a href="<?php echo esc_url( $account_btn_link ); ?>" target="<?php echo esc_html( $account_btn_target ); ?>" class="btn btn-primary">
                <?php echo esc_html( $account_btn_text ); ?>
            </a>
        <?php endif; ?>
        <?php
    }

    protected function content_template() { }
}