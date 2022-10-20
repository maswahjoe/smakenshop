<div class="xs-content-header background-version">
    <h2 class="xs-content-title"><?php echo esc_html($head_title); ?></h2>
    <div class="customNavigation xs-custom-nav">
        <a class="prev" id="prev-4"><i class="icon icon-left-arrows"></i></a>
        <a class="next" id="next-4"><i class="icon icon-right-arrow"></i></a>
    </div>
    <div class="clearfix"></div>
</div>
<div class="xs-deal-of-the-week owl-carousel">
    <?php
    if ($xs_query->have_posts()):
        while ($xs_query->have_posts()) :
            $xs_query->the_post();
            $xs_product = wc_get_product(get_the_id());
            $img_link = xs_resize(get_post_thumbnail_id(), 275, 275, true);
            $availability = $xs_product->get_availability();
            $stock_available = ($stock = get_post_meta(get_the_ID(), '_stock', true)) ? $stock : 0;
            $stock_sold = ($total_sales = get_post_meta(get_the_ID(), 'total_sales', true)) ? $total_sales : 0;
            $percentage = ($stock_available > 0 ? round($stock_sold / $stock_available * 100) : 0);
            $percentage = ($stock_available > 0 ? round($stock_sold / $stock_available * 100) : 0);
            $product_deal_date = get_post_meta(get_the_ID(), '_marketo_deal_date', true);
            $product_deal_title = get_post_meta(get_the_ID(), '_marketo_deal_title', true);
            ?>

            <div class="xs-deal-blocks">
                <?php if (!empty($img_link)): ?>
                <a class="xs_product_img_link" href="<?php echo esc_url(get_the_permalink()) ?>">
                       <?php if(!empty($img_link)){
                                    echo wp_get_attachment_image(get_post_thumbnail_id($xs_query->ID), array(275, 275), false, array(
                                        'alt'  =>  get_the_title()
                                    ));
                                  }
                        ?>
                </a>
                <?php endif; ?>
                <div class="xs-deals-info">
                    <div class="media">
                        <div class="media-body mr-3 align-self-center">
                            <h4 class="product-title">
                                <a href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo get_the_title(); ?></a>
                            </h4>
                            <span class="price"> <?php echo marketo_return($xs_product->get_price_html()); ?></span>
                        </div>
                        <?php if ($xs_product->is_on_sale()) : ?>
                            <div class="xs-product-offer-label">
                                <span><?php echo marketo_get_sell_price(get_the_ID()); ?></span>
                                <small><?php echo esc_html__('Offer', 'marketo') ?></small>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($stock_available > 0) : ?>
                        <div class="xs-deal-stock-limit clearfix">
                            <span class="product-sold"><?php echo esc_html__('Already Sold:', 'marketo'); ?><?php echo esc_html($stock_sold); ?></span>
                            <span class="product-available"><?php echo esc_html__('Available:', 'marketo'); ?><?php echo esc_html($stock_available); ?></span>
                        </div>
                        <div class="progress xs-progress">
                            <div class="progress-bar" role="progressbar"
                                 aria-valuenow="<?php echo esc_attr($percentage) ?>" aria-valuemin="0"
                                 aria-valuemax="100" style="width: <?php echo esc_attr($percentage) ?>%;"></div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if (!empty($product_deal_date)): ?>
                    <hr>
                    <div class="countdow-timer">
                        <h4><?php echo wp_kses_post($product_deal_title); ?></h4>
                        <div class="xs-countdown-timer"
                             data-countdown="<?php echo esc_attr($product_deal_date); ?>"></div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
</div>