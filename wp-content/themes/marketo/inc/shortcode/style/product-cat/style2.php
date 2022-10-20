<?php if (is_array($product_tab) && count($product_tab) > 0): ?>
    <?php $rand_id = 'xs-tabs-' . mt_rand(10000, 99999) . '-'; ?>
    <ul class="nav nav-tabs xs-nav-tab-v3" role="tablist">
        <?php foreach ($product_tab as $key => $product_tabs): ?>
            <?php
            $cat_name = get_term_by('id', $product_tabs, 'product_cat');
            $active = ($key == 0) ? 'active' : '';
            $xs_icon = '';
            if (defined('FW')) {
                $xs_icon = fw_get_db_term_option($product_tabs, 'product_cat', 'xs_product_cat');
            }

            ?>
            <li class="nav-item">
                <a class="nav-link <?php echo esc_attr($active) ?>" data-toggle="tab"
                   href="#<?php echo esc_attr($rand_id . $key . '-' . $cat_name->term_id); ?>" role="tab">
                    <span class="<?php echo esc_attr($xs_icon); ?>"></span> <?php echo esc_html($cat_name->name); ?>
                    <small><?php echo esc_html($cat_name->count.' ') ?><?php echo esc_html__('Items Available', 'marketo'); ?> </small>
                </a>
            </li>

        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<div class="tab-content">
    <?php if (is_array($product_tab) && count($product_tab) > 0): ?>
        <?php foreach ($product_tab as $key => $tabs_content): ?>
            <?php
            $active = ($key == 0) ? 'show active' : '';
            $tabs_id = 'xs-tabs-' . $key;
            $cat_name = get_term_by('id', $tabs_content, 'product_cat');
            $args = array(
                'post_type' => array('product'),
                'post_status' => array('publish'),
                'posts_per_page' => $product_count,
                'tax_query' => array(
                    'relation' => 'AND',

                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'slug',
                        'terms' => $cat_name->slug,
                    ),
                )
            );

            $xs_query = new \WP_Query($args);
            ?>
            <div class="tab-pane fade <?php echo esc_attr($active) ?>"
                 id="<?php echo esc_attr($rand_id . $key . '-' . $cat_name->term_id); ?>" role="tabpanel">
                <div class="row no-gutters product-category-version-2">
                    <?php
                    if ($xs_query->have_posts()):
                        while ($xs_query->have_posts()) :
                            $xs_query->the_post();
                            $xs_product = wc_get_product(get_the_id());
                            $img_link = xs_resize(get_post_thumbnail_id(), 125, 125, true);
                            ?>
                            <div class="col-md-4 col-lg-2">
                                <div class="xs-product-category">
                                    <?php if (!empty($img_link)): ?>
                                        <a class="xs_product_img_link"
                                           href="<?php echo esc_url(get_the_permalink()) ?>">
                                           <?php
                                                echo wp_get_attachment_image(get_post_thumbnail_id($xs_query->ID), array(125, 125), false, array(
                                                    'alt'  =>  get_the_title()
                                                )); 
                                            ?>
                                        </a>
                                    <?php endif; ?>
                                    <h4 class="product-title"><a
                                                href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo get_the_title(); ?></a>
                                    </h4>
                                    <span class="price">
                                        <?php echo marketo_return($xs_product->get_price_html()); ?>
                                    </span>
                                </div>
                            </div>
                        <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>