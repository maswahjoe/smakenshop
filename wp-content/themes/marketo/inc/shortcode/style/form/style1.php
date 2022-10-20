<div class="xs-newsletter-content">
    <form action="#" method="POST" class="xs-newsletter round" data-link="<?php echo wp_kses_post($link); ?>">
        <label for="xs-newsletter-email"></label>
        <input type="email" name="email" id="xs-newsletter-email" placeholder="<?php esc_attr_e('Enter Email', 'marketo'); ?>">
        <input type="submit" class = "xs-mailchimp-btn" value="<?php esc_attr_e('submit', 'marketo') ?>">
    </form><!-- .xs-newsletter END-->
</div>
