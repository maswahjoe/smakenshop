
<div class="media small-offer-banner">
    <div class="offer-banner-content align-self-center">
        <span class="product-categories">
            <p><?php echo esc_html($title); ?></p>
        </span>
        <h3><?php echo wp_kses_post($sub_title); ?></h3>
        <?php if($btn_label): ?>
            <div class="xs-btn-wraper">
                <a href="<?php echo esc_url( $btn_link ); ?>" target="<?php echo esc_html( $btn_target ); ?>" class="btn btn-primary"><?php echo esc_html($btn_label); ?></a>
            </div>
        <?php endif; ?>
    </div><!-- .offer-banner-content END -->
    <?php if(isset($image['url']) && !empty($image['url'])): ?>
        <div class="media-body">
            <?php echo wp_get_attachment_image($image['id'], 'full', false, array(
                  'alt'  =>  get_the_title($alt)
              )); ?>
        </div><!-- .media-body END -->
    <?php endif;  ?>
</div>