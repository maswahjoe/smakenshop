<?php $show_promotional_card = marketo_option('show_promotional_card');
if($show_promotional_card){
    get_template_part( 'template-parts/navigation/content', 'nav-top-coupon' );
} ?>
<?php $show_topbar = marketo_option('show_topbar');
if($show_topbar){
    get_template_part( 'template-parts/navigation/content', 'nav-top' );
} ?>
<header class="xs-header xs-header-one">
    <?php get_template_part( 'template-parts/navigation/content', 'nav' );

    $show_header_bottom = marketo_option('show_header_bottom');
    if($show_header_bottom){
        get_template_part( 'template-parts/navigation/content', 'nav-down' );
    }
    ?>
</header>