<form class="xs-navbar-search xs-ele-nav-search-widget xs-navbar-search-wrapper elementor-search-wrapper" action="<?php echo esc_url(home_url('/')); ?>" method="get"
        id="header_form_<?php echo $this->get_id(); ?>">
    <div class="input-group">
        <input type="search" name="s" class="form-control"
                placeholder="<?php echo esc_attr($market_nav_search_place_holder); ?>">
        <?php if (!class_exists('Algolia_Plugin')): ?>
            <?php if ($xs_nav_search_cat_select_show === 'yes') { ?>
                <div class="xs-category-select-wraper">
                    <i class="xs-spin"></i>
                    <select class="xs-ele-nav-search-select" name="product_cat">
                        <option value="-1"><?php echo esc_html($market_nav_search); ?></option>
                        <?php if (is_array($cats) && !empty($cats)): ?>
                            <?php foreach ($cats as $cat) { ?>
                                <option class="<?php echo esc_attr( $cat->category_parent !== 0 ? 'child-category' : '' )?>" value="<?php echo esc_html($cat->term_id); ?>"><?php echo esc_html($cat->name); ?></option>
                            <?php } ?>
                        <?php endif; ?>
                    </select>
                </div>
            <?php }; ?>
        <?php endif; ?>
        <div class="input-group-btn elementor-search-button">
            <input type="hidden" id="search-param" name="post_type"
                    value="<?php esc_html_e('product', 'marketo'); ?>">
            <button type="submit" class="btn btn-primary"><i class="<?php echo esc_attr($market_vertical_menu_search_icon['value']); ?>"></i></button>
        </div>
    </div>
</form>