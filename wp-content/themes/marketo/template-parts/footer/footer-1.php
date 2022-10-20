<?php


$footer_logo = marketo_option('footer_logo');
$footer_columns = marketo_option( 'footer_widget_layout',marketo_defaults('footer_widget_layout') );

$show_footer_logo = marketo_option( 'show_footer_logo',marketo_defaults('show_footer_logo') );
$show_back_to_top = marketo_option( 'show_back_to_top',marketo_defaults('show_back_to_top') );
$show_fixed_footer = marketo_option( 'show_fixed_footer',marketo_defaults('show_fixed_footer') );
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


$fixed_footer = '';
if($show_fixed_footer){
    $fixed_footer = 'xs-fixed-footer';
}
$header_fullwidth = marketo_option('header_fullwidth');
if($header_fullwidth){
    $container = 'container container-fullwidth';
}else{
    $container = 'container';
}
$show_footer_layout = marketo_option( 'show_footer_layout' );

?>
<footer class="xs-footer-section">
    <?php if($show_footer_layout): ?>
        <div class="xs-footer-main">
            <div class="<?php echo esc_attr($container); ?>">
                <?php if(!empty($footer_logo) && $show_footer_logo): ?>
                    <div class="xs-footer-logo">
                        <a href="#">
                            <?php echo wp_get_attachment_image(attachment_url_to_postid($footer_logo), 'full', false, array(
                                'alt'   => get_bloginfo()
                                )); 
                            ?>
                        </a>
                    </div>
                <?php endif ?>
                <div class="row">
                    <?php
                   
                    for ($i = 1; $i <= $footer_columns ;$i++):
                        $widget_width_col = apply_filters( "marketo_footer_widget_{$i}_width", $widget_width );
                        $widget_width_col = empty($widget_width_col) ? $widget_width : $widget_width_col;
                        ?>
                        <div class="col-md-<?php echo esc_attr($widget_width_col); ?> footer-widget">
                            <?php
                            if(is_active_sidebar('footer-widget-'.$i)):
                                dynamic_sidebar('footer-widget-'.$i);
                            endif;
                            ?>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="xs-copyright">
        <div class="<?php echo esc_attr($container); ?>">
            <div class="row">
                <div class="col-md-6">
                    <div class="xs-copyright-text">
                        <?php echo marketo_option('copyright_text',marketo_defaults('copyright_text')); ?>
                    </div>
                </div>
                <?php $payment_methods = marketo_option('payment_methods');
                if(!empty($payment_methods)){ ?>
                    <div class="col-md-6">
                        <ul class="xs-payment-card">
                            <li class="payment-title"><?php esc_html_e('Allow payment base on','marketo');?></li>
                            <?php
                            foreach($payment_methods as $payment_method){
                                $payment_img = wp_get_attachment_url($payment_method['payment_img']);
                                ?>
                                <li>
                                    <a href="<?php echo esc_url($payment_method['payment_url']); ?>">
                                        <?php 
                                          echo wp_get_attachment_image(attachment_url_to_postid($payment_img), 'full', false, array(
                                              'alt'  => get_the_title()
                                          ));
                                       ?> 
                                    </a>
                                </li>
                             <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

</footer>