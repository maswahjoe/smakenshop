<?php
$event_date = '';
if(defined('FW')){
    $event_date = fw_get_db_post_option( get_the_ID(), 'event_date' );
}
?>
<div class="marketo-single-event-wraper row">
    <div class="col-md-3">
        <?php if(has_post_thumbnail()): ?>
            <div class="marketo-event-image">
            <?php echo wp_get_attachment_image(get_post_thumbnail_id( get_the_ID() ), array(243, 150), false, array(
                  'alt'  =>  get_the_title()
              )); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-md-6 marketo-event-details">
        <h3 class="color-white xs-post-title marketo-post-title"><?php echo get_the_title(); ?></h3>
        <p><?php echo wp_kses_post(wp_trim_words(get_the_content(),19,'')) ?></p>
        <?php if(!empty($event_date)): ?>
            <div class="countdown-container xs-countdown-timer" data-countdown="<?php echo esc_attr($event_date); ?>"></div>
        <?php endif; ?>
    </div>
    <div class="col-md-3">
        <div class="marketo-btn-wraper">
            <a href="<?php echo esc_url(get_permalink()); ?>" class="xs-btn round-btn green-btn"><?php echo esc_html__('subscribe','marketo') ?></a>
        </div>
    </div>
</div>