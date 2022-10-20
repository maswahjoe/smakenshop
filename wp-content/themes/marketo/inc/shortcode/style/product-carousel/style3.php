<div class="recent-view-slider owl-carousel">
    <?php
    if ($xs_query->have_posts()):
        while ($xs_query->have_posts()) :
            $xs_query->the_post();
            $xs_product = wc_get_product(get_the_id());
            $img_link = xs_resize(get_post_thumbnail_id(), 185, 200, true);
            ?>
            <div class="item">
                <a href="<?php echo esc_url(get_the_permalink()); ?>">
                      <?php if(!empty($img_link)){
                             echo wp_get_attachment_image(get_post_thumbnail_id($xs_query->ID), array(185, 200), false, array(
                                'alt'  =>  get_the_title()
                             ));
                        }
                    ?>
                </a>
            </div>
            <?php
        endwhile;
    endif;
    wp_reset_postdata();
    ?>
</div>