<?php
$facebook = marketo_option( 'facebook',marketo_defaults('facebook') );
$twitter = marketo_option( 'twitter',marketo_defaults('twitter') );
$dribbble = marketo_option( 'dribbble',marketo_defaults('dribbble') );
$pinterest = marketo_option( 'pinterest',marketo_defaults('pinterest') );
$instagram = marketo_option( 'instagram',marketo_defaults('instagram') );
$footer_columns = marketo_option( 'footer_widget_layout',marketo_defaults('footer_widget_layout') );
$show_fixed_footer = marketo_option( 'show_fixed_footer',marketo_defaults('show_fixed_footer') );
$show_back_to_top = marketo_option( 'show_back_to_top',marketo_defaults('show_back_to_top') );
$footer_style = marketo_option( 'footer_style',marketo_defaults('footer_style') );

if($footer_columns == 1 ) {
    $widget_width = 12;
}elseif($footer_columns == 2 ) {
    $widget_width = 6;
}elseif($footer_columns == 3 ) {
    $widget_width = 4;
}elseif($footer_columns == 4 ) {
    $widget_width = 3;
}elseif($footer_columns == 5 ) {
    $widget_width = 2;
}elseif($footer_columns == 6 ) {
    $widget_width = 2;
}
$header_fullwidth = marketo_option('header_fullwidth');
if($header_fullwidth){
    $container = 'container container-fullwidth';
}else{
    $container = 'container';
}
?>
<footer class="xs-footer-section marketo-footer-version-2">
    <?php if(class_exists('Xs_Main')): ?>
        <div class="marketo-footer-top-layer">
            <div class="<?php echo esc_attr($container); ?>">
                <div class="row">
                    <?php for ($i = 1; $i <= $footer_columns ;$i++): ?>
                        <?php
                        $widget_width_col = apply_filters( "marketo_footer_widget_{$i}_width", $widget_width );
                        $widget_width_col = empty($widget_width_col) ? $widget_width : $widget_width_col;
                        ?>
                        <div class="col-md-<?php echo esc_attr($widget_width_col); ?>">
                            <div class="footer_widget">
                                <?php
                                if(is_active_sidebar('footer-widget-'.$i)):
                                    dynamic_sidebar('footer-widget-'.$i);
                                endif;
                                ?>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="xs-copyright copyright-gray">
        <div class="<?php echo esc_attr($container); ?>">
            <div class="row">
                <div class="col-md-6">
                    <div class="xs-copyright-text">
                        <p><?php echo marketo_option('copyright_text',marketo_defaults('copyright_text')); ?></p>
                    </div>
                </div>
                <?php $footer_social_links = marketo_option('footer_social_links');
                if(!empty($footer_social_links)){
                    ?>
                    <div class="col-md-6">
                        <ul class="xs-social-list version-2">
                            <?php
                            foreach($footer_social_links as $social){
                                ?><li><a href="<?php echo esc_url($social['social_url']); ?>"><i class="<?php echo esc_attr($social['social_icon']); ?>"></i><?php echo esc_attr($social['social_text']); ?></a></li><?php
                            } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php 
if($show_back_to_top){
    ?><div class="xs-back-to-top-wraper">
    <a href="#" class="xs-back-to-top btn btn-warning"><?php esc_html_e('Back top','marketo');?><i class="icon icon-arrow-right"></i></a>
</div><?php
} ?> 

</footer>