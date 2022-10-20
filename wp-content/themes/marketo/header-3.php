<?php
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

$show_promotional_card = marketo_option('show_promotional_card');
if($show_promotional_card){
    get_template_part( 'template-parts/navigation/content', 'nav-top-coupon' );
}
$show_topbar = marketo_option('show_topbar');
if($show_topbar){
    get_template_part( 'template-parts/navigation/content', 'nav-top' );
}
$header_fullwidth = marketo_option('header_fullwidth');
if($header_fullwidth){
    $container = 'container container-fullwidth';
}else{
    $container = 'container';
}
$alcatagory_text = marketo_option('all_catagory_btn_text', marketo_defaults('all_catagory_btn_text'));
?>


<header class="xs-header xs-header-three">
    <div class="xs-navBar navBar-v5">
        <div class="<?php echo esc_attr($container); ?>">
            <div class="row">
                <div class="col-lg-5 col-sm-4 xs-order-1 flex-middle">
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
                <div class="col-lg-7">
                    <?php get_template_part( 'template-parts/navigation/nav-part/nav', 'search' ); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="xs-navDown navDown-v5">
        <div class="<?php echo esc_attr($container); ?>">
            <div class="row">
                <div class="col-lg-3 d-none d-md-none d-lg-block">
                    <div class="cd-dropdown-wrapper xs-vartical-menu">
                        <a class="cd-dropdown-trigger xs-dropdown-trigger" href="#0">
                            <i class="fa fa-list-ul"></i> <?php echo esc_html($alcatagory_text) !='' ? $alcatagory_text : esc_html__(' All Categories','marketo')?>
                        </a>
                        <nav class="cd-dropdown">
                            <h2><?php esc_html_e('Marketo','marketo')?></h2>
                            <a href="#0" class="cd-close"><?php esc_html_e('Close','marketo')?></a>
                            <?php get_template_part( 'template-parts/navigation/nav-part/vertical', 'nav' ); ?>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-7 col-md-8  xs-order-2 xs-menus-group">
                    <nav class="xs-menus">
                        <div class="nav-header">
                            <div class="nav-toggle"></div>
                        </div>
                        <div class="nav-menus-wrapper">
                            <?php get_template_part( 'template-parts/navigation/nav-part/primary', 'nav' ); ?>
                        </div>
                    </nav>
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
                <div class="col-lg-2 col-md-4 xs-order-3 xs-wishlist-group">
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
                        <div class="xs-myaccount">
                            <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class ="xs-single-wishList" >
                                <i class="icon icon-user2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>