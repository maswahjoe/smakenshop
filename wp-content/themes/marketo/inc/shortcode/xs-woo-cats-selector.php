<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Woo_Cats_Selector_Widget extends Widget_Base {

  public $base;

    public function get_name() {
        return 'xs-woo-cats-selector';
    }

    public function get_title() {
        return esc_html__( 'Marketo Category Selector', 'marketo' );
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
            'xs_woo_cats_selector_title',
            [
                'label' =>esc_html__('Title', 'marketo'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   =>esc_html__('Menu Title Here', 'marketo'),
            ]
        );

        $this->add_control(
          'xs_woo_cats_selector',
          [
            'label'    =>esc_html__( 'Select category', 'marketo' ),
            'type'      => Custom_Controls_Manager::AJAXSELECT2,
            'options'   =>'product_cat',
            'label_block' => true,
            'multiple'  => 'true'
          ]
        );


        $this->end_controls_section();
    }

    protected function render( ) {
          $settings = $this->get_settings();
          $xs_woo_cats_selector = $settings['xs_woo_cats_selector'];
          $xs_woo_cats_selector_title = $settings['xs_woo_cats_selector_title'];


          ?>
          <li class="mega_child">
              <h5><?php echo esc_html($xs_woo_cats_selector_title); ?></h5>
              <ul class="menu">
                  <?php
                  foreach ($xs_woo_cats_selector as $xs_woo_cat_selector){
                      ?><li class="menu-item"><a href="<?php echo get_category_link($xs_woo_cat_selector);?>"><?php echo get_the_category_by_ID($xs_woo_cat_selector);?></a></li><?php
                  }
                   ?>
              </ul>
          </li>
    <?php }
    protected function content_template() { }
}