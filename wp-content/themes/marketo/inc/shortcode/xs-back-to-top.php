<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * nav serch widgets
 */
class Xs_Back_To_Top_Button extends Widget_Base {


    public function get_name() {
        return 'xs-back-to-top';
    }

    public function get_title() {
        return esc_html__( 'Marketo Back To Top Button', 'marketo' );
    }

    public function get_icon() {
        return 'eicon-button';
    }

    public function get_categories() {
        return [ 'marketo-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_back_to_top_button_settings',
            array(
                'label' => esc_html__( 'Back to top button setting', 'marketo' ),
            )
        );

        $this->add_control(
			'back_to_top_btn_title',
			[
				'label'       => __( 'Title', 'marketo' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Back to top', 'marketo' ),
				'placeholder' => __( 'Type your title here', 'marketo' ),
			]
        );

        $this->add_control(
			'back_to_top_btn_icon',
			[
				'label'       => __( 'Icon', 'marketo' ),
				'type'        => Controls_Manager::ICON,
                'default'     => 'icon icon-arrow-right',
                'label_block' => true,
			]
		);

        $this->end_controls_section();

        // Nav button style tab
        $this->start_controls_section(
			'back_to_top_style_tab',
			[
				'label' => __( 'Button', 'marketo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_responsive_control(
			'back_to_top_style_padding',
			[
				'label'      => __( 'Padding', 'marketo' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .btn:not([data-toggle=popover])' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'back_to_top_style_content_typography',
				'label'    => __( 'Typography', 'marketo' ),
				'selector' => '{{WRAPPER}} .btn:not([data-toggle=popover])',
			]
        );

        // --Nav button style tabs
        $this->start_controls_tabs( 'back_to_top_list_style_tabs' );

        $this->start_controls_tab(
            'back_to_top_list_style_tab_normal',
            [
                'label' =>esc_html__( 'Normal', 'marketo' ),
            ]
        );

        $this->add_responsive_control(
			'back_to_top_style_title_color_normal',
			[
				'label' => __( 'Color', 'marketo' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn:not([data-toggle=popover])' => 'color: {{VALUE}}',
				],
			]
        );

        $this->add_responsive_control(
			'back_to_top_style_title_bg_color_normal',
			[
				'label' => __( 'Background Color', 'marketo' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn:not([data-toggle=popover])' => 'background-color: {{VALUE}}',
				],
			]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'back_to_top_list_style_tab_hover',
            [
                'label' =>esc_html__( 'Hover', 'marketo' ),
            ]
        );

        $this->add_responsive_control(
			'back_to_top_style_title_color_hover',
			[
				'label' => __( 'Color', 'marketo' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn:not([data-toggle=popover]):hover' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_responsive_control(
			'back_to_top_style_title_bg_color_hover',
			[
				'label' => __( 'Background Color', 'marketo' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn:not([data-toggle=popover])::before' => 'background-color: {{VALUE}}',
				],
			]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

		$this->end_controls_section();
    }


    /**
     * Get lcation coordinates by entered address and store into metadata.
     *
     * @return void
     */

    protected function render() {
        $settings = $this->get_settings();

        extract($settings);

        ?>
        <?php if ($back_to_top_btn_title !== '') { ?>
            <div class="xs-back-to-top-wraper">
                <a href="#" class="xs-back-to-top btn btn-success"><?php echo esc_html( $back_to_top_btn_title ); ?><i class="<?php echo esc_attr( $back_to_top_btn_icon ); ?>"></i></a>
            </div>
        <?php }?>
        <?php
    }

    protected function content_template() {}
}
