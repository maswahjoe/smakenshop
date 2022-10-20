<?php


class Widget_Includes
{
    public static $classprefix = 'Marketo';
    public static $root_dir = XS_PLUGIN_DIR . 'widgets/';

    // include widgets
    // ----------------------------------------------------------------------------------------
    public static function _action_widgets_init()
    {
        self::include_widget('contact');
        self::include_widget('footer-address');
        self::include_widget('recent-post');
        self::include_widget('twitter-feed');
    }

    // include and register widgets
    // ----------------------------------------------------------------------------------------
    public static function include_widget($widget_dir)
    {
        include self::$root_dir . $widget_dir . '/class-widget-' . $widget_dir . '.php';

        register_widget(self::$classprefix . '_' . self::dirname_to_classname($widget_dir));
    }

    // auto load
    // ----------------------------------------------------------------------------------------
    public static function init()
    {
        add_action('widgets_init', array(__CLASS__, '_action_widgets_init'));
    }


    // directory name to class name, transform dynamically
    // ----------------------------------------------------------------------------------------
    private static function dirname_to_classname($dirname)
    {
        $class_name = explode('-', $dirname);
        $class_name = array_map('ucfirst', $class_name);
        $class_name = implode('_', $class_name);

        return $class_name;
    }

}

Widget_Includes::init();