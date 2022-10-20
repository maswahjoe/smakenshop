<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * nav serch widgets
 */
class Xs_Category_Menu extends Widget_Base {


    public function get_name() {
        return 'xs-category-menu';
    }

    public function get_title() {
        return esc_html__( 'Marketo category menu', 'marketo' );
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return [ 'marketo-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_product_category_link_settings',
            array(
                'label' => esc_html__( 'Product Category Links', 'marketo' ),
            )
        );

        $this->add_control(
			'xs_product_cat_link_show_search',
			[
				'label' => __( 'Show Search', 'marketo' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'marketo' ),
				'label_off' => __( 'Hide', 'marketo' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );

        $this->add_control(
			'xs_product_cat_link_rel',
			[
				'label' => __( 'Link Rel', 'marketo' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'marketo' ),
				'label_off' => __( 'Hide', 'marketo' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );

        $this->add_control(
			'xs_product_cat_link_target',
			[
				'label' => __( 'Link Target', 'marketo' ),
				'type' => Controls_Manager::SELECT,
				'default' => '_self',
				'options' => [
                    '_self'   => __( 'Self', 'marketo' ),
					'_blank'  => __( 'Blank', 'marketo' ),
					'_parent' => __( 'Parent', 'marketo' ),
					'_top'    => __( 'Top', 'marketo' ),
				],
			]
        );

        $this->add_control(
			'xs_product_search_icon',
			[
				'label'       => __( 'Search Icon', 'marketo' ),
				'type'        => Controls_Manager::ICON,
                'default'     => 'fa fa-search',
                'label_block' => true,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
            'xs_product_cat_link',
            [
                'label'       => esc_html__('Product Cat', 'marketo'),
                'type'        => Custom_Controls_Manager::AJAXSELECT2,
                'options'     => 'product_cat',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
			'xs_product_cat_link_icon',
			[
				'label'       => __( 'Icon', 'marketo' ),
				'type'        => Controls_Manager::ICON,
                'default'     => 'icon icon-screen',
                'label_block' => true,
			]
        );

		$this->add_control(
			'xs_product_cat_links',
			[
				'label'  => __( 'Cat Links', 'marketo' ),
				'type'   => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'xs_category_menu_style_tab',
			[
				'label' => __( 'Item', 'marketo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
			'xs_category_menu_style_border_color',
			[
				'label' => __( 'Border Color', 'marketo' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xs-nav-cate>li' => 'color: {{VALUE}}',
					'{{WRAPPER}} .xs-nav-cate' => 'border-color: {{VALUE}}',
				],
			]
        );

        // --Nav button style tabs
        $this->start_controls_tabs( 'xs_category_menu_list_style_tabs' );

        $this->start_controls_tab(
            'xs_category_menu_list_style_tab_normal',
            [
                'label' =>esc_html__( 'Normal', 'marketo' ),
            ]
        );

        $this->add_responsive_control(
			'xs_category_menu_style_color_normal',
			[
				'label' => __( 'Color', 'marketo' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xs-nav-cate>li>a, {{WRAPPER}} .navSearch-group>a' => 'color: {{VALUE}}',
				],
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'xs_category_menu_list_style_tab_hover',
            [
                'label' =>esc_html__( 'Hover', 'marketo' ),
            ]
        );

        $this->add_responsive_control(
			'xs_category_menu_style_color_hover',
			[
				'label' => __( 'Color', 'marketo' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xs-nav-cate>li>a:hover, {{WRAPPER}} .navSearch-group>a:hover' => 'color: {{VALUE}}',
				],
			]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
			'xs_category_menu_search_tab',
			[
				'label' => __( 'Search', 'marketo' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'xs_product_cat_link_show_search' => 'yes'
                ]
			]
		);

        $this->add_responsive_control(
			'xs_category_menu_search_border_color',
			[
				'label' => __( 'Border Color', 'marketo' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .navsearch-form input:not([type=submit])' => 'border-color: {{VALUE}}',
				],
			]
        );

        $this->add_responsive_control(
			'xs_category_menu_search_bg_color',
			[
				'label' => __( 'Background Color', 'marketo' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .navsearch-form input:not([type=submit])' => 'background-color: {{VALUE}}',
				],
			]
        );

        $this->add_responsive_control(
			'xs_category_menu_search_placeholder_title_color',
			[
				'label' => __( 'Placeholder Color', 'marketo' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ..navsearch-form input:not([type=submit])::-webkit-input-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} ..navsearch-form input:not([type=submit])::-moz-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} ..navsearch-form input:not([type=submit]):-ms-input-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} ..navsearch-form input:not([type=submit]):-moz-placeholder' => 'color: {{VALUE}}',
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

        ?>
        <ul class="xs-nav-cate xs-ele-nav-cat clearfix">
            <?php if (! empty($xs_product_cat_links)) {
                foreach ($xs_product_cat_links as $category){ ?>
                <li>
                    <a rel="<?php echo esc_attr( 'yes' == $xs_product_cat_link_rel ? "nofollow" : "" ); ?>" target="<?php echo esc_attr($xs_product_cat_link_target); ?>" href="<?php echo get_category_link( $category['xs_product_cat_link'] );?>">
                        <?php if(isset($category['xs_product_cat_link_icon']) && $category['xs_product_cat_link_icon'] != ""){ ?>
                            <i class="<?php echo esc_attr($category['xs_product_cat_link_icon']);?>"></i>
                        <?php } 


                            if($category['xs_product_cat_link'] != '') : 

                               echo get_the_category_by_ID($category['xs_product_cat_link']);

                            endif;
                         ?>
                    </a>
                </li>
            <?php
                }
            }
            ?>
            <?php if ('yes' == $xs_product_cat_link_show_search) { ?>
            <li>
                <div class="navSearch-group">
                    <a href="#" class="navsearch-button"><i class="<?php echo esc_attr( $xs_product_search_icon ); ?>"></i></a>
                    <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="navsearch-form">
                        <input type="search" name="s" placeholder="<?php esc_attr_e('Search', 'marketo'); ?>" id="search" value="<?php echo get_search_query(); ?>">
                        <input type="hidden" name="post_type" value="product" />
                    </form>
                </div>
            </li>
            <?php }?>
        </ul>
        <?php
    }

    protected function content_template() {}
}
