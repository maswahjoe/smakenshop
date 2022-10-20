<?php

class Marketo_Features{

    static function module_url(){
        return plugin_dir_url( __FILE__ );
    }

    public function run(){
        // die('foo');

        add_action('elementskit/loaded', function(){
            // include 'custom-css/init.php';
            if (class_exists('ElementsKit_Lite')) {
                if(\ElementsKit_Lite::package_type() == 'free' && !in_array('elementskit/elementskit.php', apply_filters('active_plugins', get_option('active_plugins')))){
                    $this->include_files();
                    $this->load_classes();
                    add_action( 'wp_enqueue_scripts', [$this, 'scripts'] );
                }
            }
        });

    }

    public function scripts(){

    }

    public function load_classes(){
        new ElementsKit\Modules\Sticky_Content\Init();
    }

    public function include_files(){
        require_once('sticky-content/init.php');
        require_once('vertical-menu/vertical-menu.php');
    }

    public static $instance = null;

    public static function instance() {
        if ( is_null( self::$instance ) ) {

            // Fire the class instance
            self::$instance = new self();
            self::$instance;
        }

        return self::$instance;
    }

}

Marketo_Features::instance()->run();