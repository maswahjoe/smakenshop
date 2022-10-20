<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * nav serch widgets
 */
class Xs_Promotional_Coupon extends Widget_Base {


    public function get_name() {
        return 'xs-promotional-coupon';
    }

    public function get_title() {
        return esc_html__( 'Marketo promotional coupon', 'marketo' );
    }

    public function get_icon() {
        return 'eicon-meta-data';
    }

    public function get_categories() {
        return [ 'marketo-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_product_promotional_settings',
            array(
                'label' => esc_html__( 'Product promotional coupon', 'marketo' ),
            )
        );

        $this->add_control(
			'xs_promotional_text',
			[
				'label' => __( 'Title', 'marketo' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Apply this coupon & get 40% off', 'marketo' ),
                'placeholder' => __( 'Type your title here', 'marketo' ),
                'label_block' => true,
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'xs_promo_coupon_style_tab',
			[
				'label' => __( 'Content', 'marketo' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
			'xs_promo_coupon_color',
			[
				'label' => __( 'Color', 'marketo' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xs-promotion p' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'xs_promo_coupon_background',
				'label' => __( 'Background', 'marketo' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .xs-promotion.alert-info',
			]
        );

        $this->add_control(
			'xs_promo_coupon_heading_one',
			[
				'label' => __( 'Badge', 'marketo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_responsive_control(
			'xs_promo_coupon_badge__color',
			[
				'label' => __( 'Color', 'marketo' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xs-promotion.alert-info strong' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_responsive_control(
			'xs_promo_coupon_badge_bg_color',
			[
				'label' => __( 'Background Color', 'marketo' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xs-promotion.alert-info strong' => 'background-color: {{VALUE}}',
				],
			]
        );

        $this->add_control(
			'xs_promo_coupon_heading_two',
			[
				'label' => __( 'Cross', 'marketo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
        );

        $this->add_responsive_control(
			'xs_promo_coupon_cross__color',
			[
				'label' => __( 'Color', 'marketo' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xs-promotion .close' => 'color: {{VALUE}}',
				],
			]
		);

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

        if ($xs_promotional_text !== '') { ?>
        <div class="alert alert-info fade show xs-promotion xs-ele-promotion" role="alert">
            <div class="container">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="fa fa-close"></i>
                    </span>
                </button>
                <p><?php echo wp_kses_post( $xs_promotional_text ); ?></p>
            </div>
        </div>
        <?php
        }
    }

    protected function content_template() {}
}
