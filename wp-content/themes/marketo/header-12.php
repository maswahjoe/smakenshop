<?php
$show_promotional_card = marketo_option('show_promotional_card');
$phnnumber = marketo_option('phone_number');
$phnnumber_to_call = ('' != $phnnumber) ? $phnnumber : '+1 (254) 258-8898';
$show_topbar = marketo_option('show_topbar');
$category_selector = marketo_option('category_selectors');
$show_header_bottom = marketo_option('show_header_bottom');
$show_header_cta = marketo_option('show_header_cta');
$cta_btn_title = marketo_option('cta_btn_title', marketo_defaults('cta_btn_title'));
$cta_btn_subtitle = marketo_option('cta_btn_subtitle', marketo_defaults('cta_btn_subtitle'));
$cta_btn_link = marketo_option('cta_btn_link', marketo_defaults('cta_btn_link'));
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
?>
<header class="xs-header xs-mb-0 xs-header-v12">
    <!-- nav bar section -->
    <div class="header-latest">
        <div class="<?php echo esc_attr($container); ?>">
            <div class="row">
                <div class="col-lg-4">
                    <div class="xs-logo-wraper">
                        <a class="xs_default_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <?php echo $site_logo; ?>
                        </a>
                        <?php if(!empty($retina_logo)): ?>
                            <a class="xs_retina_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <?php echo $retina_logo; ?>
                            </a>
                        <?php endif; ?>
                        <span class="logo-info">
                        <span>Hotline:</span>
                        <a href="<?php echo esc_attr('tel:'.$phnnumber_to_call)?>" class="phone-number"><?php echo esc_html($phnnumber_to_call); ?></a>
                    </span>
                    </div><!-- .xs-logo-wraper END -->
                </div>
                <div class="col-lg-8 xs-position-static text-right">
                    <div class="nav-area-group">
                        <nav class="xs-menus xs_nav-landscape">
                            <div class="nav-header">
                                <div class="nav-toggle"></div>
                            </div><!-- .nav-header END -->
                            <div class="nav-menus-wrapper" style="transition-property: none;"><span class="nav-menus-wrapper-close-button">✕</span>
                                <!-- menu list area -->
                                <?php get_template_part( 'template-parts/navigation/nav-part/primary', 'nav' ); ?>                         <!-- END menu list area -->
                            </div><!-- .nav-menus-wrapper END -->
                            <div class="nav-overlay-panel"></div>
                        </nav><!-- .xs-menus END -->
                        <div class="xs-wish-list-item">
                            <div class="navSearch-group">
                                <a href="#" class="navsearch-button"><i class="icon icon-search xs-search-icon"></i></a>
                                <?php get_template_part( 'template-parts/navigation/nav-part/nav', 'search' ); ?>
                            </div>
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
                    </div><!-- .nav-area-group END -->
                </div>
            </div><!-- .row END -->
        </div><!-- .container END -->
    </div>    <!-- End nav bar section -->
    <!-- <div class="nav-cover"></div> -->
    <div class="nav-cover"></div>
</header>