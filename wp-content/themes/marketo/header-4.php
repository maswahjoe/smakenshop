<?php
$show_promotional_card = marketo_option('show_promotional_card');
$show_topbar = marketo_option('show_topbar');
$category_selector = marketo_option('category_selectors');
$show_header_bottom = marketo_option('show_header_bottom');
$show_header_cta = marketo_option('show_header_cta');
$cta_btn_title = marketo_option('cta_btn_title', marketo_defaults('cta_btn_title'));
$cta_btn_subtitle = marketo_option('cta_btn_subtitle', marketo_defaults('cta_btn_subtitle'));
$cta_btn_link = marketo_option('cta_btn_link', marketo_defaults('cta_btn_link'));
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
<header class="xs-header xs-header-four">
    <?php get_template_part( 'template-parts/navigation/content', 'nav' );?>
    <div class="xs-navCate d-none d-md-none d-lg-block">
        <div class="<?php echo esc_attr($container); ?>">
            <ul class="xs-nav-cate clearfix">
                <?php if($category_selector[0]['cat'] != ''){ ?>

                    <?php foreach ($category_selector as $category){ ?>
                        <li>
                            <a href="<?php echo get_category_link( $category['cat'] );?>">
                                <?php if(isset($category['cat_icon']) && $category['cat_icon'] != ""){ ?>
                                    <i class="<?php echo esc_attr($category['cat_icon']);?>"></i>
                                <?php } ?>
                                <?php echo get_the_category_by_ID($category['cat']);?>
                            </a>
                        </li>
                    <?php } ?>

                <?php } ?>
                <?php get_template_part( 'template-parts/navigation/nav-part/nav', 'search' ); ?>
                <?php if($show_header_cta): ?>
                    <li>
                        <a href="<?php echo esc_url($cta_btn_link) ?>" class="btn btn-outline-primary">
                            <strong><?php echo esc_html($cta_btn_title) ?></strong>
                            <?php echo esc_html($cta_btn_subtitle) ?>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        </div>
</header>