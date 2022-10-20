<?php
if ( !defined( 'ABSPATH' ) )
    wp_die( 'Direct access forbidden.' );
/**
 * Helper functions used all over the theme
 */

/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package xs
 */
/*
  Return
 *
 *  */

// simply echos the variable
function marketo_return( $s ) {
    return $s;
}

/*
 * FOR ONE PAGE Section
 * since 1.0
 */

function marketo_editor_data( $value ) {
    return wp_kses_post( $value );
}

// Gets unyson option data in safe mode
// since 1.0

function marketo_get_option( $k, $v = '', $m = 'theme-settings' ) {
    if ( defined( 'FW' ) ) {
        switch ( $m ) {
            case 'theme-settings':
                $v = fw_get_db_settings_option( $k );
                break;

            default:
                $v = '';
                break;
        }
    }
    return $v;
}

if ( !function_exists( 'xs_resize' ) ) {
    function xs_resize( $id, $width = false, $height = false, $crop = false ) {
        if(function_exists('fw_resize')){
            $url = wp_get_attachment_image_src($id, 'full');

            return fw_resize( $url[0], $width, $height, $crop );
        }else{
            $response = wp_get_attachment_image_src( $id, array($width,$height));
            if(!empty($response)){
                return $response[0];
            }
        }

    }
}
// Gets unyson image url from option data in a much simple way
// sience 1.0

function marketo_get_image( $k, $v = '', $d = false ) {

    if ( $d == true ) {
        $attachment = $k;
    } else {
        $attachment = marketo_get_option( $k );
    }

    if ( isset( $attachment[ 'url' ] ) && !empty( $attachment ) ) {
        $v = $attachment[ 'url' ];
    }

    return $v;
}

/* Gets unyson image url from variable
 * sience 1.0
 * marketo_image($img, $alt )
 */

function marketo_image( $img, $alt, $v = '' ) {

    if ( isset( $img[ 'url' ] ) && !empty( $img ) ) {
        $i	 = $img[ 'url' ];
        $v	 = "<img src=" . $i . " alt=" . $alt . " />";
    }

    return $v;
}

// Gets original page ID/ Slug
// since 1.0

function marketo_main( $id, $name = true ) {
    if ( function_exists( 'icl_object_id' ) ) {
        $id = icl_object_id( $id, 'page', true, 'en' );
    }

    if ( $name === true ) {
        $post = get_post( $id );
        return $post->post_name;
    } else {
        return $id;
    }
}

function marketpress_page_list(){
    $xs_pagess = array();
    $xs_pages = get_pages();
    if(is_array($xs_pages)){
        foreach($xs_pages as $xs_page){
            $xs_pagess[$xs_page->ID] = $xs_page->post_title;
        }
    }
    return $xs_pagess;
}

// Gets post's meta data in a much simplier way.
// since 1.0

function marketo_get_post_meta( $id, $needle ) {
    $data = get_post_meta( $id, 'fw_options' );
    if ( is_array( $data ) && isset( $data[ 0 ][ 'page_sections' ] ) ) {
        $data = $data[ 0 ][ 'page_sections' ];

        if ( is_array( $data ) ) {
            return marketo_seekKey( $data, $needle );
        }
    }
}



/*
 * btn Function
 * since 1.0
 */
//btn function

if ( !function_exists( 'marketo_theme_button_class' ) ) :

    function marketo_theme_button_class( $style ) {
        /**
         * Display specific class for buttons - depends on theme
         */
        if ( $style == 'default' ) {
            echo 'btn btn-border';
        } elseif ( $style == 'primary' ) {
            echo 'btn btn-primary';
        } else {
            echo 'default';
        }
    }

endif;



/*
 * Function for color RGB
 */

function marketo_color_rgb( $hex ) {
    $hex		 = preg_replace( "/^#(.*)$/", "$1", $hex );
    $rgb		 = array();
    $rgb[ 'r' ]	 = hexdec( substr( $hex, 0, 2 ) );
    $rgb[ 'g' ]	 = hexdec( substr( $hex, 2, 2 ) );
    $rgb[ 'b' ]	 = hexdec( substr( $hex, 4, 2 ) );

    $color_hex = $rgb[ "r" ] . ", " . $rgb[ "g" ] . ", " . $rgb[ "b" ];

    return $color_hex;
}

/*
 * Section Edit option
 *
 * This function for show section edit option in every section in one page
 *
 * Since 1.0
 *  */

function marketo_edit_section() {
    ?>
    <div class="section-edit">
        <div class="container relative">
            <?php
            if ( is_user_logged_in() ) {
                edit_post_link( esc_html__( 'Edit', 'marketo' ), '', '' );
            }
            ?>
            <span class="section-abc"><?php echo esc_html( get_the_title() ); ?></span>
        </div>
    </div>
    <?php
}



// breadcrumbs

if ( !function_exists( 'marketo_get_breadcrumbs' ) ) {

    function marketo_get_breadcrumbs( $seperator = '' ){

        echo '<ol class="breadcrumb">';
        if ( !is_home() ) {
            echo '<li class="breadcrumb-item"><a href="';
            echo esc_url( get_home_url( '/' ) );
            echo '">';
            echo esc_html__( 'Home', 'marketo' );
            echo "</a></li> " . esc_attr( $seperator );
            if ( is_category() || is_single() ) {
                echo '<li class="breadcrumb-item">';
                $category	 = get_the_category();
                $post		 = get_queried_object();
                $postType	 = get_post_type_object( get_post_type( $post ) );
                if ( !empty( $category ) ) {
                    echo esc_html( $category[ 0 ]->cat_name ) . '</li>';
                } else if ( $postType ) {
                    echo esc_html( $postType->labels->singular_name ) . '</li>';
                }

                if ( is_single() ) {
                    echo esc_attr( $seperator ) . "  <li class=\"breadcrumb-item\">";
                    echo wp_trim_words( get_the_title() );
                    echo '</li>';
                }
            } elseif ( is_page() ) {
                echo '<li class="breadcrumb-item">';
                echo wp_trim_words( get_the_title());
                echo '</li>';
            }
        }
        if ( is_tag() ) {
            single_tag_title();
        } elseif ( is_day() ) {
            echo"<li class=\"breadcrumb-item\">" . esc_html__( 'Blogs for', 'marketo' ) . " ";
            the_time( 'F jS, Y' );
            echo'</li>';
        } elseif ( is_month() ) {
            echo"<li class=\"breadcrumb-item\">" . esc_html__( 'Blogs for', 'marketo' ) . " ";
            the_time( 'F, Y' );
            echo'</li>';
        } elseif ( is_year() ) {
            echo"<li class=\"breadcrumb-item\">" . esc_html__( 'Blogs for', 'marketo' ) . " ";
            the_time( 'Y' );
            echo'</li>';
        } elseif ( is_author() ) {
            echo"<li class=\"breadcrumb-item\">" . esc_html__( 'Author Blogs', 'marketo' );
            echo'</li>';
        } elseif ( isset( $_GET[ 'paged' ] ) && !empty( $_GET[ 'paged' ] ) ) {
            echo "<li>" . esc_html__( 'Blogs', 'marketo' );
            echo'</li>';
        } elseif ( is_search() ) {
            echo"<li class=\"breadcrumb-item\">" . esc_html__( 'Search Result', 'marketo' );
            echo'</li>';
        } elseif ( is_404() ) {
            echo"<li class=\"breadcrumb-item\">" . esc_html__( '404 Not Found', 'marketo' );
            echo'</li>';
        }
        echo '</ol>';

    }
}

/*
 * WP Kses Allowed HTML Tags Array in function
 * @Since Version 0.1
 * @param ar
 * Use: marketo_kses($raw_string);
 * */

function marketo_kses( $raw ) {

    $allowed_tags = array(
        'a'								 => array(
            'class'	 => array(),
            'href'	 => array(),
            'rel'	 => array(),
            'title'	 => array(),
        ),
        'abbr'							 => array(
            'title' => array(),
        ),
        'b'								 => array(),
        'blockquote'					 => array(
            'cite' => array(),
        ),
        'cite'							 => array(
            'title' => array(),
        ),
        'code'							 => array(),
        'del'							 => array(
            'datetime'	 => array(),
            'title'		 => array(),
        ),
        'dd'							 => array(),
        'div'							 => array(
            'class'	 => array(),
            'title'	 => array(),
            'style'	 => array(),
        ),
        'dl'							 => array(),
        'dt'							 => array(),
        'em'							 => array(),
        'h1'							 => array(),
        'h2'							 => array(),
        'h3'							 => array(),
        'h4'							 => array(),
        'h5'							 => array(),
        'h6'							 => array(),
        'i'								 => array(
            'class' => array(),
        ),
        'img'							 => array(
            'alt'	 => array(),
            'class'	 => array(),
            'height' => array(),
            'src'	 => array(),
            'width'	 => array(),
        ),
        'li'							 => array(
            'class' => array(),
        ),
        'ol'							 => array(
            'class' => array(),
        ),
        'p'								 => array(
            'class' => array(),
        ),
        'q'								 => array(
            'cite'	 => array(),
            'title'	 => array(),
        ),
        'span'							 => array(
            'class'	 => array(),
            'title'	 => array(),
            'style'	 => array(),
        ),
        'strike'						 => array(),
        'br'							 => array(),
        'strong'						 => array(),
        'data-wow-duration'				 => array(),
        'data-wow-delay'				 => array(),
        'data-wallpaper-options'		 => array(),
        'data-stellar-background-ratio'	 => array(),
        'ul'							 => array(
            'class' => array(),
        ),
    );

    if ( function_exists( 'wp_kses' ) ) { // WP is here
        $allowed = wp_kses( $raw, $allowed_tags );
    } else {
        $allowed = $raw;
    }


    return $allowed;
}


/**
 *
 * Load Goggle Font
 * @since 1.0.0
 *
 */

function marketo_google_fonts_url()
{
    $fonts_url = '';
    $font_families = array();
    //Body Font
    $body_font = marketo_option('body_font', marketo_defaults('body_font'));
    if(!empty($body_font)){
        $body_families = isset($body_font['font-family']) ? $body_font['font-family'] : '';
        $body_variant = isset($body_font['variant']) ? $body_font['variant'] : '';
        $font_families[] = $body_families.":".$body_variant;
    }
    //Heading font
    if(!empty($head_font)){
        $head_font = marketo_option('heading_font', marketo_defaults('heading_font'));
        $head_families = isset($head_font['font-family']) ? $head_font['font-family'] : '';
        $head_variant = isset($head_font['variant']) ? $head_font['variant'] : '';
        $font_families[] = $head_families.":".$head_variant;
    }

    $font_families[] = 'Rubik:300,400,500,700|Pacifico:200,400,500,600,700';

    if ($font_families) {
        $query_args = array(
            'family' => urlencode(implode('|', $font_families))
        );

        $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
    }

    return esc_url_raw($fonts_url);
}


/**
 *
 * Get Catagories/Taxonomies List
 * @since 1.0.0
 *
 */

function xs_category_list_slug( $cat ){
    $query_args = array(
        'orderby'       => 'ID',
        'order'         => 'DESC',
        'hide_empty'    => 1,
        'taxonomy'      => $cat
    );

    $categories = get_categories( $query_args );
    $options = array( esc_html__('0', 'marketo') => 'All Category');
    if(is_array($categories) && count($categories) > 0){
        return $categories;
    }
}

/**
 *
 * Get Catagories/Taxonomies List
 * @since 1.0.0
 *
 */

function xs_featured_product(){
    $query_args = array(
        'post_type'     => 'product',
        'tax_query'     => array(
            'relation'  => 'AND',
            array(
                'taxonomy'  => 'product_type',
                'field'     => 'slug',
                'terms'     => 'wp_fundraising',
            ),
            array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
            ),
        ),
        'posts_per_page' => -1,
    );
    $xs_query = new WP_Query($query_args);
    $options = array( esc_html__('0', 'marketo') => 'Select Product');
    if($xs_query->have_posts()):
        while ($xs_query->have_posts()) {
            $xs_query->the_post();
            $options[get_the_ID()] = get_the_title();
        }
        wp_reset_postdata();
        return $options;
    endif;

}

function marketo_option($option) {
    // Get options
    return get_theme_mod( $option, marketo_defaults($option) );
}

function marketo_defaults($options){

    $default = array(
        'body_font' => array(),
        'heading_font' => array(),
        'header_layout'  => '1',
        'show_login' => '',
        'marketo_dashbord' => '',
        'show_header_cta' => '',
        'cta_btn_label' => esc_html__( 'start a campaign', 'marketo' ),
        'cta_btn_link' => esc_html__( '#', 'marketo' ),
        'show_border' => '',
        'page_sidebar' => 3,
        'show_breadcrumb' => 1,
        'blog_sidebar' => 3,
        'blog_show_breadcrumb' => 1,
        'blog_single_sidebar' => 1,
        'blog_author'	=>	'',
        'show_author' => '',
        'show_category'=> 1,
        'show_comment'=> 1,
        'show_preloader' => '',
        'show_social'	=> '',
        'shop_grid_column' => 4,
        'shop_sidebar' =>3,
        'shop_show_breadcrumb' =>'',
        'footer_style' =>1,
        'facebook' => '#',
        'instagram' => '#',
        'twitter' => '#',
        'dribbble' => '#',
        'pinterest' => '#',
        'show_footer_logo' => false,
        'show_back_top_top' => false,
        'show_footer_layout' => true,
        'footer_widget_layout' => 4,
        'show_fixed_footer' => '',
        'copyright_text' => esc_html__( 'Copyrights By Xpeedstudio - 2021', 'marketo' ),
        'cta_btn_title' => esc_html__('BLACK FRIDAY','marketo'),
        'cta_btn_subtitle' => esc_html__('Get 45% Off!','marketo'),
        'cta_btn_link' => '#',
        'map_api' => '',
        'marketo_rtl' => '',
        'marketo_algolia' => 0,
        'shop_grid_column' => 3,
        'shop_list_column' => 3,
    );

    if(!empty($default[$options])) return $default[$options];
}

/**
 *
 * Get Catagories/Taxonomies List
 * @since 1.0.0
 *
 */

function xs_category_list( $cat ){
    $query_args = array(
        'orderby'       => 'ID',
        'order'         => 'DESC',
        'hide_empty'    => 1,
        'taxonomy'      => $cat
    );

    $categories = get_categories( $query_args );
    $options = array( esc_html__('0', 'marketo') => 'All Category');
    if(is_array($categories) && count($categories) > 0){
        foreach ($categories as $cat){
            $options[$cat->term_id] = $cat->name;
        }
        return $options;
    }
}

function marketo_get_posts($post_type){
    $mega_menus = array();
    $args = array(
        'post_type' => $post_type,
    );
    $posts = get_posts($args);
    foreach ($posts as $post){
        $mega_menus[$post->post_name] = $post->post_title;
    }
    return $mega_menus;
}

function marketo_get_mega_item_child_slug($location, $option_id){

    $mega_item = '';
    $locations 	= get_nav_menu_locations();
    $menu 		= wp_get_nav_menu_object( $locations[$location] );
    $menuitems 	= wp_get_nav_menu_items( $menu->term_id );

    foreach ($menuitems as $menuitem){

        $id = $menuitem->ID;
        $mega_item = fw_ext_mega_menu_get_db_item_option($id, $option_id);

    }
    return $mega_item;
}

function marketo_get_post_content($title){
    $args = array(
        'title'        => $title,
        'post_type'   => 'mega_menu',
        'post_status' => 'publish',
        'numberposts' => 1
    );

    $the_query = new WP_Query( $args );
    $output = '';
    if ( $the_query->have_posts() ) :
        while ( $the_query->have_posts() ) : $the_query->the_post();
            ob_start();
            the_content();
            $output = ob_get_clean();

        endwhile;
    endif;
    wp_reset_postdata();

    return $output;
}

function marketo_get_sell_price($xs_id){
    $xs_product = wc_get_product($xs_id);
    if( $xs_product->is_type( 'variable' ) ) {
        $var_regular_price = array();
        $var_sale_price = array();
        $var_diff_price = array();
        $available_variations = $xs_product->get_available_variations();
        foreach ( $available_variations as $key => $available_variation ) {
            $variation_id = $available_variation['variation_id']; // Getting the variable id of just the 1st product. You can loop $available_variations to get info about each variation.
            $variable_product = new WC_Product_Variation( $variation_id );

            $variable_product_regular_price = $variable_product->get_regular_price();
            $variable_product_sale_price = $variable_product->get_sale_price();

            if( ! empty( $variable_product_regular_price ) ) {
                $var_regular_price[] = $variable_product_regular_price;
            } else {
                $var_regular_price[] = 0;
            }
            if( ! empty( $variable_product_sale_price ) ) {
                $var_sale_price[] = $variable_product_sale_price;
            } else {
                $var_sale_price[] = 0;
            }
        }

        foreach( $var_regular_price as $key => $reg_price ) {
            if( isset( $var_sale_price[$key] ) && $var_sale_price[$key] !== 0 ) {
                $var_diff_price[] = $reg_price - $var_sale_price[$key];
            } else {
                $var_diff_price[] = 0;
            }
        }

        $best_key = array_search( max( $var_diff_price ), $var_diff_price );

        $regular_price = $var_regular_price[$best_key];
        $sale_price = $var_sale_price[$best_key];
    } else {
        $regular_price = $xs_product->get_regular_price();
        $sale_price = $xs_product->get_sale_price();
    }

    $regular_price = wc_get_price_to_display( $xs_product, array( 'qty' => 1, 'price' => $regular_price ) );
    $sale_price = wc_get_price_to_display( $xs_product, array( 'qty' => 1, 'price' => $sale_price ) );

    $savings = floor( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 ) . '%';

    return $savings;
}

function marketo_wc_get_product_list(){
    $query_args = array(
        'post_type'     => 'product',
        'post_status'       => 'publish',
        'posts_per_page' => -1,
    );
    $xs_query = new WP_Query($query_args);
    $options = array( esc_html__('0', 'marketo') => 'Select Product');
    if($xs_query->have_posts()):
        while ($xs_query->have_posts()) {
            $xs_query->the_post();
            $options[get_the_ID()] = get_the_title();
        }
        return $options;
    endif;
    wp_reset_postdata();
}
function marketpres_content_read_more( $num = 20 ) {

    $excerpt		 = get_the_excerpt();
    $trimmed_content = wp_trim_words( $excerpt, $num_words = $num, $more = null );

    echo wp_kses_post( $trimmed_content );
}
/*
 * Mini Cart
 *
 * */
function marketo_ajax_add_to_cart(){
    // Get messages
    ob_start();

    wc_print_notices();

    $notices = ob_get_clean();

    // Get mini cart
    ob_start();

    woocommerce_mini_cart();

    $mini_cart = ob_get_clean();

    // Fragments and mini cart are returned
    $data = array(
        'fragments' => apply_filters( 'woocommerce_add_to_cart_fragments', array(
                'div.widget_shopping_cart_content' => '<div class="widget_shopping_cart_content">' . $mini_cart . '</div>',
            )
        ),
        'cart_hash' => apply_filters( 'woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5( json_encode( WC()->cart->get_cart_for_session() ) ) : '', WC()->cart->get_cart_for_session() ),
    );

    wp_send_json( $data );
    wp_die();
}
/*
 *
 * Wishlist Ajax header count
 * */
add_action( 'wp_ajax_marketo_ajax_add_to_cart', 'marketo_ajax_add_to_cart' );
add_action( 'wp_ajax_nopriv_marketo_ajax_add_to_cart', 'marketo_ajax_add_to_cart' );

if( ! function_exists( 'marketo_wishlist_count' ) ) {
    function marketo_wishlist_count() {
        if( class_exists( 'YITH_WCWL' ) ) {
            echo YITH_WCWL()->count_products();
        }
        wp_die();
    }
    add_action( 'wp_ajax_marketo_wishlist_count', 'marketo_wishlist_count' );
    add_action( 'wp_ajax_nopriv_marketo_wishlist_count', 'marketo_wishlist_count' );

}

if(!function_exists('xp_result_search_product')){
    function xp_result_search_product(){
        ob_start();

        $keyword = $_REQUEST['keyword'];
        $cate_ids = isset($_REQUEST['cate_id']) ? $_REQUEST['cate_id'] : '-1';
        $posts_per_page = 6;
        if ( $keyword || $cate_ids) {
            $search_query = array(
                // 's'              => $keyword,
                'order'          => 'DESC',
                'orderby'        => 'date',
                'post_status'    => 'publish',
                'post_type'      => array('product'),
                'posts_per_page' => -1,
            );
            if (isset($cate_ids) && ($cate_ids != -1)) {
                $search_query['tax_query'] = array(array(
                    'taxonomy'         => 'product_cat',
                    'terms'            => array($cate_ids),
                    'include_children' => true,
                ));
            }
            if ($keyword && isset($keyword) && $keyword !== "") {
                $search_query['s'] = $keyword;
            }

            $search = new WP_Query( $search_query );

            $newdata = array();

            if ($search && $search->post  !== null  && $search->post  !== '') {
                $count = 0;
                foreach ( $search->posts as $post ) {
                    if ($count >= $posts_per_page) {

                        $category = get_term_by('id', $cate_ids, 'product_cat', 'ARRAY_A');
                        $cate_slug = isset($category['slug']) ? '&amp;product_cate=' . $category['slug'] : '';
                        $newdata[] = array(
                            'id'        => -2,
                            'title'     => '<a href="' . site_url() .'?s=' . $keyword . '&amp;post_type=product' . $cate_slug . '"> ' . esc_html__('View More','marketo') . '</a>',
                        );
                        break;
                    }
                    $product = new WC_Product( $post->ID );
                    $price = $product->get_price_html();

                    $newdata[] = array(
                        'id'        => $post->ID,
                        'title'     => $post->post_title,
                        'guid'      => get_permalink( $post->ID ),
                        'thumb'		=> get_the_post_thumbnail( $post->ID, 'thumbnail' ),
                        'price'		=> $price,
                    );
                    $count++;

                }
            }
            else {
                $newdata[] = array(
                    'id'        => -1,
                    'title'     => esc_html__( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'marketo'),
                );
            }
            ob_end_clean();
            echo json_encode( $newdata );
        }
        wp_die();
    }
    add_action( 'wp_ajax_xp_result_search_product', 'xp_result_search_product' );
    add_action( 'wp_ajax_nopriv_xp_result_search_product', 'xp_result_search_product' );
}
if (!function_exists('yolo_advanced_search_category_query')) {

    function marketo_advanced_search_category_query($query)
    {
        if ($query->is_search()) {
            // category terms search.
            if (isset($_GET['product_cate']) && ($_GET['product_cate'] != -1)) {
                $query->set('tax_query', array(array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug',
                    'terms' => array($_GET['product_cate']),
                ),

                ));
            }

            return $query;
        }
    }

    add_action('pre_get_posts', 'marketo_advanced_search_category_query', 1000);

}

function marketo_get_account_link(){
    $user_id   = get_current_user_id();
    $account_link      =  get_the_permalink(get_option( 'woocommerce_myaccount_page_id' ))  ;
    $author       = get_user_by( 'id', $user_id );
    if ( function_exists( 'dokan_get_navigation_url' ) && is_array(dokan_get_navigation_url()) && in_array( 'seller', $author->roles ) ) {
        $account_link = dokan_get_navigation_url();
    }
    return $account_link;
}

function marketo_add_to_compare_link() {

    global $product, $yith_woocompare;
    $product_id = $product->get_id();

    $button_text = get_option( 'yith_woocompare_button_text', esc_html__( 'Add to Compare', 'marketo' ) );

    echo apply_filters( 'marketo_add_to_compare_link', sprintf(
        '<a href="%s" class="%s" data-product_id="%d">%s</a>',
        $yith_woocompare->obj->add_product_url( $product_id ),
        'add-to-compare-link compare',
        $product_id,
        '<i class="icon icon-shuffle-arrow"></i>'
    ) );
}
// Product per page



/**
 * Display category image on category archive
 */
add_action( 'woocommerce_archive_description', 'woocommerce_category_image', 9 );
function woocommerce_category_image() {

    $archive_image = marketo_option('shop_banner_global_display');
    $force_banner = marketo_option('banner_force_on_catagory');

    if ( is_product_category() ){
        global $wp_query;
        $cat = $wp_query->get_queried_object();
        $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
        $image = wp_get_attachment_url( $thumbnail_id );
        if ( $image && ($force_banner != 1)) {
            echo '<div class="woo-cat-image"><img src="' . $image . '" alt="' . $cat->name . '" /></div>';
        }elseif ('' != $archive_image){
            echo '<div class="woo-cat-image"><img src="' . $archive_image . '" alt="'.esc_attr("Global banner").'" /></div>';
        }
    }
}

// Product per page

/**
 * Change number of products that are displayed per page (shop page)
 */


add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
    $post_per_page = marketo_option('woo_posts_per_page');

    $cols = 12;

    if('' != $post_per_page){

        $cols =   $post_per_page;
    }

    return $cols;
}

function getwooplugins(){return 778;}

add_filter('gwp_affiliate_id', 'getwooplugins');


add_filter('woocommerce_catalog_orderby', 'wc_customize_product_sorting');

function wc_customize_product_sorting($sorting_options){
    $sorting_options = array(
        'menu_order' => esc_html__( 'Sorting', 'marketo' ),
        'popularity' => esc_html__( ' Popularity', 'marketo' ),
        'rating'     => esc_html__( ' Average rating', 'marketo' ),
        'date'       => esc_html__( ' Newness', 'marketo' ),
        'price'      => esc_html__( 'Price: low to high', 'marketo' ),
        'price-desc' => esc_html__( 'Price: high to low', 'marketo' ),
    );

    return $sorting_options;
}

add_action("woocommerce_before_shop_loop", "xs_marketo_wc_catalog_ordaring_up", 29);
function xs_marketo_wc_catalog_ordaring_up(){
    echo '<p class="before-default-sorting">'. esc_html__('Sort by', 'marketo').'</p>';
}


function marketo_woocommerce_before_mini_cart(){
	echo '<div class="xs-checkout-form">';
}
add_action('woocommerce_checkout_after_customer_details', 'marketo_woocommerce_before_mini_cart');
function marketo_woocommerce_after_mini_cart(){
	echo '</div>';
}
add_action('woocommerce_checkout_after_order_review', 'marketo_woocommerce_after_mini_cart');

function marketo_ekit_headers($format='html'){
    if(class_exists('ElementsKit_Lite')){
        $select = [];
        $args = array(
			'posts_per_page'   => -1,
			'post_type' => 'elementskit_template',
			'meta_key' => 'elementskit_template_type',
			'meta_value' => 'header'
        );
        $headers = get_posts($args);
        $select[] = esc_html__( "Please select a header", "marketo" );
        foreach($headers as $header) {
            $select[$header->ID ] = $header->post_title;
        }
        return $select;
    }
    return [];
}

function marketo_ekit_footers($format='html'){
    if(class_exists('ElementsKit_Lite')){
        $select = [];
        $args = array(
			'posts_per_page'   => -1,
			'post_type' => 'elementskit_template',
			'meta_key' => 'elementskit_template_type',
			'meta_value' => 'footer'
        );
        $footers = get_posts($args);
        $select[] = esc_html__( "Please select a footer", "marketo" );
        foreach($footers as $footer) {
            $select[$footer->ID ] = $footer->post_title;
        }
        return $select;
    }
    return [];
}

function marketo_get_builder_id($builder_select_value, $builder_enable_value) {
    $builder_settings = marketo_option($builder_select_value);
    $builder_enable   = marketo_option($builder_enable_value);
    $builder_id       = '';
    if($builder_enable || $builder_enable != 'null'){
        $builder_id =   $builder_settings;
    }
    return $builder_id;
}