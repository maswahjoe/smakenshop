<?php
$show_promotional_card = marketo_option('show_promotional_card');
$show_topbar = marketo_option('show_topbar');
$category_selector = marketo_option('category_selectors');
$show_header_bottom = marketo_option('show_header_bottom');
$show_header_cta = marketo_option('show_header_cta');
$cta_btn_title = marketo_option('cta_btn_title', marketo_defaults('cta_btn_title'));
$cta_btn_subtitle = marketo_option('cta_btn_subtitle', marketo_defaults('cta_btn_subtitle'));
$cta_btn_link = marketo_option('cta_btn_link', marketo_defaults('cta_btn_link'));
$alcatagory_text = marketo_option('all_catagory_btn_text', marketo_defaults('all_catagory_btn_text'));
$logo = marketo_option('site_logo');
$retina_logo = marketo_option('retina_site_logo');

/*Site logo*/
$site_logo  = ( !empty($logo) ? wp_get_attachment_image(attachment_url_to_postid($logo), 'full', false, array(
    'alt'  => get_bloginfo('name'))) : '<img class = "img-responsive" width="150" height="60" 
    src="'.MARKETO_IMAGES . '/logo.png'.'" alt="'.get_bloginfo('name').'" >');

/*retina logo*/
$retina_logo  = ( !empty($retina_logo) ? wp_get_attachment_image(attachment_url_to_postid($retina_logo), 'full', false, array(
   'alt'  => get_bloginfo('name'))) : '<img class = "img-responsive" width="150" height="70" 
   src="'.MARKETO_IMAGES . '/logo@2x.png'.'" alt="'.get_bloginfo('name').'" >');

if($show_promotional_card){
    get_template_part( 'template-parts/navigation/content', 'nav-top-coupon' );
}

if($show_topbar){
    get_template_part( 'template-parts/navigation/content', 'nav-top' );
}

$header_fullwidth = marketo_option('header_fullwidth');
if($header_fullwidth){
    $container = 'container container-fullwidth';
}else{
    $container = 'container';
}
$menu_col = 'col-lg-9';
if($show_header_cta){
    $menu_col = 'col-lg-6';
}
?>
<header class="xs-header xs-mb-0">
    <!-- nav bar section -->
    <div class="xs-navBar navBar-v6">
        <div class="<?php echo esc_attr($container); ?>">
            <div class="row">
                <div class="col-lg-3 col-sm-4 xs-order-1  flex-middle">
                    <div class="xs-logo-wraper">
                        <a class="xs_default_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                           <?php echo $site_logo; ?>
                        </a>
                        <?php if(!empty($retina_logo)): ?>
                            <a class="xs_retina_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                 <?php echo $retina_logo; ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-3 xs-order-3 xs-menus-group">
                    <?php get_template_part( 'template-parts/navigation/nav-part/nav', 'search' ); ?>
                </div>
                <div class="col-lg-3 col-sm-5 xs-order-2 xs-wishlist-group">
                    <div class="xs-wish-list-item">
                        <?php if(class_exists( 'YITH_WCWL' )): ?>
                            <span class="xs-wish-list">
                                <a href="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>" class="xs-single-wishList">
                                    <span class="xs-item-count xswhishlist"><?php echo YITH_WCWL()->count_products(); ?></span>
                                    <i class="icon icon-heart"></i>
                                </a>
                            </span>
                        <?php endif; ?>
                        <?php if ( class_exists( 'WooCommerce' ) ) { ?>
                            <div class="xs-miniCart-dropdown">
                                <?php  $xs_product_count = WC()->cart->cart_contents_count; ?>
                                <a href="<?php echo esc_url( wc_get_cart_url() ); ?>"  class ="xs-single-wishList offset-cart-menu">
                                    <span class="xs-item-count highlight xscart"><?php echo esc_html($xs_product_count); ?></span>
                                    <i class="icon icon-bag"></i>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div><!-- .row END -->
        </div><!-- .container END -->
    </div>    <!-- End nav bar section -->

    <!-- nav down section -->
    <div class="xs-navDown navDown-v7 secondary-header-v">
        <div class="<?php echo esc_attr($container); ?>">
            <div class="row">
                <div class="col-lg-3 d-none d-md-none d-lg-block">
                    <!-- vertical menu bar -->
                    <div class="cd-dropdown-wrapper xs-vartical-menu">
                        <a class="cd-dropdown-trigger xs-dropdown-trigger" href="#0">
                            <i class="fa fa-list-ul"></i> <?php echo esc_html($alcatagory_text) !='' ? $alcatagory_text : esc_html__(' All Categories','marketo')?>

                        </a>
                        <nav class="cd-dropdown">
                            <h2>Marketpress</h2>
                            <a href="#0" class="cd-close">Close</a>
                            <?php get_template_part( 'template-parts/navigation/nav-part/vertical', 'nav' ); ?>
                        </nav> <!-- .cd-dropdown -->
                    </div> <!-- .cd-dropdown-wrapper -->                <!-- End vertical menu bar -->
                </div>
                <div class="<?php echo esc_attr($menu_col); ?>">
                    <nav class="xs-menus xs_nav-landscape">
                        <div class="nav-header">
                            <div class="nav-toggle"></div>
                        </div><!-- .nav-header END -->
                        <div class="nav-menus-wrapper" style="transition-property: none;"><span class="nav-menus-wrapper-close-button">✕</span>
                            <!-- menu list area -->
                            <?php get_template_part( 'template-parts/navigation/nav-part/primary', 'nav' ); ?>                       <!-- END menu list area -->
                        </div><!-- .nav-menus-wrapper END -->
                        <div class="nav-overlay-panel"></div></nav><!-- .xs-menus END -->
                </div>
                <?php if($show_header_cta): ?>
                    <div class="col-lg-3 col-lg-3 d-none d-md-none d-lg-block home-v-7">
                        <a href="<?php echo esc_url($cta_btn_link); ?>" class="btn btn-primary btn-lg">
                            <span><?php echo esc_html($cta_btn_title); ?> </span>
                            <span> <?php echo esc_html($cta_btn_subtitle); ?></span>
                        </a>

                    </div>
                <?php endif; ?>
            </div><!-- .row END -->
        </div><!-- .container END -->
    </div>    <!-- End nav down section -->
    <!-- <div class="nav-cover"></div> -->
    <div class="nav-cover"></div>
</header>