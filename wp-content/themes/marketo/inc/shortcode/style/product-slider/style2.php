
<div class="product-block-slider owl-carousel">
    <?php
    $xs_allproduct = $settings['xs_allproduct'];
    foreach($xs_allproduct as $xs_product):
        $args['post_in'] = $xs_product['xs_product'];
        $post_id = $xs_product['xs_product'];
        $args['posts_per_page'] = 1;
        $show_product_img = $xs_product['show_product_image'];
        $img_link = $xs_product['image']['url'];
        $xs_query = new \WP_Query( $args );
        if($xs_query->have_posts()):
            while ($xs_query->have_posts()) :
                $xs_query->the_post();
                $xs_product = wc_get_product($xs_product['xs_product']);
                ?>
                <div class="item">
                    <?php
                    if($show_product_img):
                        echo wp_get_attachment_image(get_post_thumbnail_id($post_id), 'full', false, array(
                            'alt'  =>  get_the_title()
                        )); 
                        ?>
                    <?php else: 
                          echo wp_get_attachment_image(attachment_url_to_postid($img_link), 'full', false, array(
                              'alt'  =>  get_the_title()
                          )); 
                     endif; ?>
                </div>
            <?php
            endwhile;
        endif;
    endforeach;
    wp_reset_postdata();
    ?>
</div>