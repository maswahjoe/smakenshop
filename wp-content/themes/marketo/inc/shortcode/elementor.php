<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Shortcode{

	/**
     * Holds the class object.
     *
     * @since 1.0
     *
     */
	public static $_instance;

	/**
     * Load Construct
     *
     * @since 1.0
     */

	public function __construct(){

		add_action('elementor/init', array($this, 'xs_elementor_init'));
        add_action('elementor/controls/controls_registered', array( $this, 'xs_icon_pack' ), 11 );
        add_action('elementor/controls/controls_registered', array( $this, 'xs_ajax_select2' ), 12 ); // ajax select2
        add_action('elementor/controls/controls_registered', array( $this, 'control_image_choose' ), 13 );
        add_action('elementor/widgets/widgets_registered', array($this, 'xs_shortcode_elements'));
        add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'editor_enqueue_styles' ) );
        add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'editor_enqueue_scripts' ) );
        add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'elementor/preview/enqueue_styles', array( $this, 'preview_enqueue_scripts' ) );

	}


    /**
     * Enqueue Scripts
     *
     * @return void
     */

     public function enqueue_scripts() {
         wp_enqueue_script( 'xs-main-elementor', MARKETO_SCRIPTS  . '/elementor.js',array( 'jquery', 'elementor-frontend' ), MARKETO_VERSION, true );

         if (class_exists('ElementsKit_Lite')) {
            if(\ElementsKit_Lite::package_type() == 'free' && !in_array('elementskit/elementskit.php', apply_filters('active_plugins', get_option('active_plugins')))){
                wp_enqueue_style( 'marketo-widget-styles-pro', MARKETO_CSS . '/widget-styles-pro.css', null, MARKETO_VERSION );
                wp_enqueue_script( 'marketo-widget-scripts-pro', MARKETO_SCRIPTS . '/widget-scripts-pro.js', array( 'jquery', 'elementor-frontend' ), MARKETO_VERSION, true );
            }
        }
     }

    /**
     * Enqueue Scripts
     *
     * @return void
     */

     public function editor_enqueue_scripts() {
         wp_enqueue_script( 'mock', MARKETO_SCRIPTS . '/mock.js', array( 'jquery' ), MARKETO_VERSION, true );
         wp_enqueue_script( 'jquery-dropdown', MARKETO_SCRIPTS . '/jquery.dropdown.js', array( 'jquery' ), MARKETO_VERSION, true );
         wp_enqueue_script( 'marketo-searchable', MARKETO_SCRIPTS . '/searchable.js', array( 'jquery' ), MARKETO_VERSION, true );

     }

    /**
     * Enqueue editor styles
     *
     * @return void
     */

    public function editor_enqueue_styles() {
        wp_enqueue_style( 'xs-icon-elementor', MARKETO_CSS.'/iconfont.css',null, MARKETO_VERSION );

        wp_enqueue_style( 'jquery-dropdown', MARKETO_CSS . '/jquery.dropdown.css', null, MARKETO_VERSION );

    }

    /**
     * Preview Enqueue Scripts
     *
     * @return void
     */

    public function preview_enqueue_scripts() {
        wp_enqueue_style('xs-admin-elementor', MARKETO_CSS . '/elementor-admin.css', null, MARKETO_VERSION);
    }
	/**
     * Elementor Initialization
     *
     * @since 1.0
     *
     */

    public function xs_elementor_init(){
        \Elementor\Plugin::$instance->elements_manager->add_category(
            'marketo-elements',
            [
                'title' =>esc_html__( 'Marketo', 'marketo' ),
                'icon' => 'fa fa-plug',
            ],
            1
        );
    }

    /**
     * Extend Icon pack core controls.
     *
     * @param  object $controls_manager Controls manager instance.
     * @return void
     */

    public function xs_icon_pack( $controls_manager ) {

        require_once MARKETO_SHORTCODE_DIR. 'controls/xs-icon.php';

        $controls = array(
            $controls_manager::ICON => 'Xs_Icon_Controler',
        );

        foreach ( $controls as $control_id => $class_name ) {
            $controls_manager->unregister_control( $control_id );
            $controls_manager->register_control( $control_id, new $class_name() );
        }

    }

    // registering ajax select 2 control
    public function xs_ajax_select2( $controls_manager ) {

        require_once MARKETO_SHORTCODE_DIR. 'controls/xs-select2.php';
        $controls_manager->register_control( 'marketoajaxselect2', new \Control_Ajax_Select2() );

    }

    // registering image choose
    public function control_image_choose( $controls_manager ) {

        require_once MARKETO_SHORTCODE_DIR. 'controls/xs-choose.php';
        $controls_manager->register_control( 'imagechoose', new \Control_Image_Choose() );

    }


    public function xs_shortcode_elements($widgets_manager){
        require_once MARKETO_SHORTCODE_DIR.'xs-map.php';
        require_once MARKETO_SHORTCODE_DIR.'xs-my-account.php';
        require_once MARKETO_SHORTCODE_DIR.'xs-heading.php';
        require_once MARKETO_SHORTCODE_DIR.'xs-blog.php';
        require_once MARKETO_SHORTCODE_DIR.'xs-team.php';
        require_once MARKETO_SHORTCODE_DIR.'xs-image-box.php';
        require_once MARKETO_SHORTCODE_DIR.'xs-image.php';
        require_once MARKETO_SHORTCODE_DIR.'xs-banner.php';
        require_once MARKETO_SHORTCODE_DIR.'xs-logo-carousel.php';
        require_once MARKETO_SHORTCODE_DIR.'xs-subscribe.php';
        require_once MARKETO_SHORTCODE_DIR.'xs-button.php';
        require_once MARKETO_SHORTCODE_DIR.'xs-cat-list-link.php';
        require_once MARKETO_SHORTCODE_DIR.'xs-slider.php';
        require_once MARKETO_SHORTCODE_DIR.'xs-counter.php';
        require_once MARKETO_SHORTCODE_DIR.'xs-imagetoltip.php';
        require_once MARKETO_SHORTCODE_DIR.'xs-fun-fact.php';
        require_once MARKETO_SHORTCODE_DIR.'xs-page-link.php';
        require_once MARKETO_SHORTCODE_DIR.'xs-nav-search.php';
        require_once MARKETO_SHORTCODE_DIR.'xs-nav-cart.php';
        require_once MARKETO_SHORTCODE_DIR.'xs-nav-button.php';
        require_once MARKETO_SHORTCODE_DIR.'xs-back-to-top.php';
        require_once MARKETO_SHORTCODE_DIR.'xs-promotion-coupon.php';

        $widgets_manager->register_widget_type(new Elementor\Xs_Maps_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_My_Account_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Heading_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Image_Box_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Post_Widget());
        $widgets_manager->register_widget_type(new Elementor\XS_Team_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Image());
        $widgets_manager->register_widget_type(new Elementor\Xs_Banner());
        $widgets_manager->register_widget_type(new Elementor\Xs_Logo_Carousel_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Subscribe_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Button_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Woo_Cats_List_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Slider_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Countdown_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Image_Tooltip());
        $widgets_manager->register_widget_type(new Elementor\Xs_Image_Tooltip());
        $widgets_manager->register_widget_type(new Elementor\Xs_Page_List_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Fun_Fact_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Nav_Search());
        $widgets_manager->register_widget_type(new Elementor\Xs_Nav_Cart());
        $widgets_manager->register_widget_type(new Elementor\Xs_Nav_Button());
        $widgets_manager->register_widget_type(new Elementor\Xs_Back_To_Top_Button());
        $widgets_manager->register_widget_type(new Elementor\Xs_Promotional_Coupon());

        if(class_exists('\Elementor\Elementskit_Widget_Vertical_Menu')){
            $widgets_manager->register_widget_type(new Elementor\Elementskit_Widget_Vertical_Menu());
        }

        if(class_exists('WooCommerce')){

            require_once MARKETO_SHORTCODE_DIR.'xs-product.php';
            $widgets_manager->register_widget_type(new Elementor\Xs_Woo_Product_Widget());

            require_once MARKETO_SHORTCODE_DIR.'xs-woo-tab.php';
            $widgets_manager->register_widget_type(new Elementor\Xs_Woo_Tab_Widget());

            require_once MARKETO_SHORTCODE_DIR.'xs-woo-cats-selector.php';
            $widgets_manager->register_widget_type(new Elementor\Xs_Woo_Cats_Selector_Widget());

            require_once MARKETO_SHORTCODE_DIR.'xs-woo-slider.php';
            $widgets_manager->register_widget_type(new Elementor\Xs_Woo_Slider_Widget());

            require_once MARKETO_SHORTCODE_DIR.'xs-woo-carousel.php';
            $widgets_manager->register_widget_type(new Elementor\Xs_Woo_Carousel_Widget());

            require_once MARKETO_SHORTCODE_DIR.'xs-cat-product.php';
            $widgets_manager->register_widget_type(new Elementor\Xs_Cats_Products_Widget());

            require_once MARKETO_SHORTCODE_DIR.'xs-nav-cart.php';
            $widgets_manager->register_widget_type(new Elementor\Xs_Nav_Cart());

            require_once MARKETO_SHORTCODE_DIR.'xs-categoty-menu.php';
            $widgets_manager->register_widget_type(new Elementor\Xs_Category_Menu());
        }
    }

	public static function xs_get_instance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new Xs_Shortcode();
        }
        return self::$_instance;
    }

}
$Xs_Shortcode = Xs_Shortcode::xs_get_instance();

if(!defined('ELEMENTOR_PRO_VERSION')){
    add_action( 'elementor/editor/after_enqueue_styles', function() {
        wp_enqueue_style( 'xs-elementor-editor-panel',  MARKETO_CSS . '/elementor-editor-panel.css', null,  MARKETO_VERSION );
    });
}