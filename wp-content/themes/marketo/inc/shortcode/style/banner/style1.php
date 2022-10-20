<?php
if(isset($image['url']) && !empty($image['url'])){
    $image = 'background-image: url('.$image['url'].')';
}else{
    $image = '';
}
?>
<div class="small-offer-banner-v2">
    <div class="small-offer-banner d-flex <?php echo esc_attr($hover_effect); ?>" style="<?php echo esc_attr($image); ?>">
        <div class="offer-banner-content align-self-center">
            <p><?php echo esc_html($title); ?></p>
            <h3><?php echo wp_kses_post($sub_title); ?></h3>
            <?php if(!empty($btn_label)): ?>
                <div class="xs-btn-wraper">
                    <a href="<?php echo esc_url( $btn_link ); ?>" target="<?php echo esc_html( $btn_target ); ?>" class="btn btn-primary"><?php echo esc_html($btn_label); ?></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>