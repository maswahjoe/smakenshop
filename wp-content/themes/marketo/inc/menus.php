<?php

if ( !defined( 'ABSPATH' ) )
    wp_die( 'Direct access forbidden.' );

/**
 * Register theme menus
 */

class wp_main_mobile_navwalker extends Walker_Nav_Menu {

    private $current_Item;

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        if( $args->has_children ){
            $output .= "\n$indent<ul role=\"menu\" class=\"collapse collapse-".$this->current_Item->ID." \">\n";
        }

    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $this->current_Item = $item;

        if (strcasecmp($item->attr_title, 'divider') == 0 && $depth === 1) {
            $output .= $indent . '<li role="presentation" class="divider">';
        } else if (strcasecmp($item->attr_title, 'dropdown-header') == 0 && $depth === 1) {
            $output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
        } else if (strcasecmp($item->attr_title, 'disabled') == 0) {
            $output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
        } else {

            $class_names = $value = '';

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;

            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

            if($args->has_children  && $depth>0 ) $class_names .= ' dropdown ';

            if(in_array('current-menu-parent', $classes)) { $class_names .= ' active'; }
            if(in_array('current_page_parent', $classes)) { $class_names .= ' active'; }
            if(in_array('current-menu-item', $classes)) { $class_names .= ' active'; }

            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

            $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
            $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

            $output .= $indent . '<li' . $id . $value . $class_names .'>';

            $atts = array();
            $atts['title']  = ! empty( $item->title )   ? $item->title  : '';
            $atts['target'] = ! empty( $item->target )  ? $item->target : '';
            $atts['rel']    = ! empty( $item->xfn )     ? $item->xfn    : '';
            $atts['href']   = ! empty( $item->url )     ? $item->url    : '';

            $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

            $attributes = '';
            foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                    $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $item_output = $args->before;

            if(! empty( $item->attr_title )){
                $item_output .= '<a'. $attributes .'><span class="glyphicon ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';
            } else {
                $item_output .= '<a'. $attributes .'>';
            }

            $caret = ($depth === 0) ? 'down' : 'right';

            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
            $item_output .=  '</a>';
            $item_output .= $args->after;

            if($args->has_children) {

                $item_output .= '
                <span class="menu-toggler collapsed" data-toggle="collapse" data-target=".collapse-'.$item->ID.'">
                <i class="fa fa-angle-right"></i>
                </span>';
            }


            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
    }

    function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( !$element ) {
            return;
        }
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}

class marketo_main_nav_walker extends Walker_Nav_Menu {

    private $current_Item;

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        if( $args->has_children ){
            $output .= "\n$indent<ul role=\"menu\" class=\"nav-dropdown nav-submenu \">\n";
        }
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $this->current_Item = $item;

        $menu_label = get_post_meta($item->ID, '_menu_item_label', true);
        $menu_label_bg_color = get_post_meta($item->ID, '_menu_item_label_bg_color', true);
        $menu_label_text_color = get_post_meta($item->ID, '_menu_item_label_text_color', true);
        $style_attributes = ' style="color: ' . esc_attr( $menu_label_text_color ) . '; background-color: ' . esc_attr( $menu_label_bg_color ) . '"';
        $style_border_attributes = 'style="border-left: 2.5px solid ' . esc_attr( $menu_label_bg_color ) . ';border-top: 2.5px solid ' . esc_attr( $menu_label_bg_color ) . '"';

        if (strcasecmp($item->attr_title, 'divider') == 0 && $depth === 1) {
            $output .= $indent . '<li role="presentation" class="divider">';
        } else if (strcasecmp($item->attr_title, 'dropdown-header') == 0 && $depth === 1) {
            $output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
        } else if (strcasecmp($item->attr_title, 'disabled') == 0) {
            $output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
        } else {

            $class_names = $value = '';

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;

            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

            if($args->has_children  && $depth>0 ) $class_names .= ' dropdown ';

            if(in_array('current-menu-parent', $classes)) { $class_names .= ' active'; }
            if(in_array('current_page_parent', $classes)) { $class_names .= ' active'; }
            if(in_array('current-menu-item', $classes)) { $class_names .= ' active'; }

            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

            $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
            $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

            $output .= $indent . '<li' . $id . $value . $class_names .'>';


            $atts = array();
            $atts['title']  = ! empty( $item->title )   ? $item->title  : '';
            $atts['target'] = ! empty( $item->target )  ? $item->target : '';
            $atts['rel']    = ! empty( $item->xfn )     ? $item->xfn    : '';
            $atts['href']   = ! empty( $item->url )     ? $item->url    : '';

            $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

            $attributes = '';
            foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                    $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $item_output = $args->before;
            if($item->object == 'mega_menu' && $depth ==1){
                if ( class_exists( 'Elementor\Plugin' ) ) {
                    $elementor = Elementor\Plugin::instance();
                    $item_output   .= '<div class="megamenu-content">'.$elementor->frontend->get_builder_content_for_display( $item->object_id ).'</div>';
                    wp_reset_postdata();
                }

            }else{

                $item_output .= '<a'. $attributes .'>';


                $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

                if($menu_label != ''){
                    $item_output .= '<span class="menu-label" '.$style_attributes.'><span class="menu-label-arrow" '.$style_border_attributes.'></span>'.$menu_label.'</span>';
                }

                $item_output .=  '</a>';
            }


            $item_output .= $args->after;


            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
    }

    function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( !$element ) {
            return;
        }
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}

class marketo_vertical_nav_walker extends Walker_Nav_Menu {

    private $current_Item;

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        if( $args->has_children ){
            $output .= "\n$indent<ul role=\"menu\" class=\"cd-secondary-dropdown is-hidden\">\n";
        }
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $this->current_Item = $item;

        if (strcasecmp($item->attr_title, 'divider') == 0 && $depth === 1) {
            $output .= $indent . '<li role="presentation" class="divider">';
        } else if (strcasecmp($item->attr_title, 'dropdown-header') == 0 && $depth === 1) {
            $output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
        } else if (strcasecmp($item->attr_title, 'disabled') == 0) {
            $output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
        } else {
            $optional_css_classes_arr = get_post_meta( $item->ID, '_menu_item_classes', true );
            $optional_css_classes = implode(' ', $optional_css_classes_arr);
            $item->classes = array_diff($item->classes, $optional_css_classes_arr);
            $class_names = $value = '';

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;

            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

            if($args->has_children  && $depth>0 ) $class_names .= ' dropdown ';

            if(in_array('current-menu-parent', $classes)) { $class_names .= ' active'; }
            if(in_array('current_page_parent', $classes)) { $class_names .= ' active'; }
            if(in_array('current-menu-item', $classes)) { $class_names .= ' active'; }

            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

            $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
            $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

            $output .= $indent . '<li' . $id . $value . $class_names .'>';


            $atts = array();
            $atts['title']  = ! empty( $item->title )   ? $item->title  : '';
            $atts['target'] = ! empty( $item->target )  ? $item->target : '';
            $atts['rel']    = ! empty( $item->xfn )     ? $item->xfn    : '';
            $atts['href']   = ! empty( $item->url )     ? $item->url    : '';

            $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

            $attributes = '';
            foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                    $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $item_output = $args->before;
            if($item->object == 'mega_menu' && $depth ==1){
                if ( class_exists( 'Elementor\Plugin' ) ) {
                    $elementor = Elementor\Plugin::instance();
                    $item_output   .= $elementor->frontend->get_builder_content_for_display( $item->object_id );
                    wp_reset_postdata();
                }

                // $item_output .= marketo_get_post_content($item->title);
            }else{

                if(! empty( $optional_css_classes )){
                    $item_output .= '<a'. $attributes .'><i class="' . esc_attr( $optional_css_classes ) . '"></i>&nbsp;';
                } else {
                    $item_output .= '<a'. $attributes .'>';
                }
                $menu_icon = get_post_meta($item->ID, '_menu_item_icon', true);
                if($menu_icon != ''){
                    $item_output .='<i class="'.esc_attr($menu_icon).'"></i>';
                }

                $caret = ($depth === 0) ? 'down' : 'right';

                $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

                if($args->has_children) {
                    $item_output .= '<i class="fa fa-angle-right submenu-icon"></i>';
                }


                $item_output .=  '</a>';
            }


            $item_output .= $args->after;


            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
    }

    function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( !$element ) {
            return;
        }
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}

class marketo_vertical_mobile_nav_walker extends Walker_Nav_Menu {

    private $current_Item;

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        if( $args->has_children ){
            $output .= "\n$indent<ul role=\"menu\" class=\"nav-dropdown nav-submenu\">\n";
        }
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $this->current_Item = $item;

        if (strcasecmp($item->attr_title, 'divider') == 0 && $depth === 1) {
            $output .= $indent . '<li role="presentation" class="divider">';
        } else if (strcasecmp($item->attr_title, 'dropdown-header') == 0 && $depth === 1) {
            $output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
        } else if (strcasecmp($item->attr_title, 'disabled') == 0) {
            $output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
        } else {
            $optional_css_classes_arr = get_post_meta( $item->ID, '_menu_item_classes', true );
            $optional_css_classes = implode(' ', $optional_css_classes_arr);
            $item->classes = array_diff($item->classes, $optional_css_classes_arr);
            $class_names = $value = '';

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;

            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

            if($args->has_children  && $depth>0 ) $class_names .= ' dropdown ';

            if(in_array('current-menu-parent', $classes)) { $class_names .= ' active'; }
            if(in_array('current_page_parent', $classes)) { $class_names .= ' active'; }
            if(in_array('current-menu-item', $classes)) { $class_names .= ' active'; }

            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

            $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
            $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

            $output .= $indent . '<li' . $id . $value . $class_names .'>';


            $atts = array();
            $atts['title']  = ! empty( $item->title )   ? $item->title  : '';
            $atts['target'] = ! empty( $item->target )  ? $item->target : '';
            $atts['rel']    = ! empty( $item->xfn )     ? $item->xfn    : '';
            $atts['href']   = ! empty( $item->url )     ? $item->url    : '';

            $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

            $attributes = '';
            foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                    $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $item_output = $args->before;
            if($item->object == 'mega_menu' && $depth ==1){
                if ( class_exists( 'Elementor\Plugin' ) ) {
                    $elementor = Elementor\Plugin::instance();
                    $item_output   .= $elementor->frontend->get_builder_content_for_display( $item->object_id );
                    wp_reset_postdata();
                }

                // $item_output .= marketo_get_post_content($item->title);
            }else{

                if(! empty( $optional_css_classes )){
                    $item_output .= '<a'. $attributes .'><i class="' . esc_attr( $optional_css_classes ) . '"></i>&nbsp;';
                } else {
                    $item_output .= '<a'. $attributes .'>';
                }
                $menu_icon = get_post_meta($item->ID, '_menu_item_icon', true);
                if($menu_icon != ''){
                    $item_output .='<i class="'.esc_attr($menu_icon).'"></i>';
                }

                $caret = ($depth === 0) ? 'down' : 'right';

                $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

                $item_output .=  '</a>';
            }


            $item_output .= $args->after;


            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
    }

    function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( !$element ) {
            return;
        }
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}
