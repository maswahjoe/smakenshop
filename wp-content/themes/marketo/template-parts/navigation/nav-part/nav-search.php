<?php
$cats = xs_category_list_slug('product_cat');
$header_layout = marketo_option('header_layout');
$marketo_algolia = marketo_option('marketo_algolia');
$search_wrapper = 'xs-navbar-search xs-navbar-search-wrapper';
if (class_exists('Algolia_Plugin')) {
    $search_wrapper = 'xs-navbar-search';
}

if ($header_layout == '4') {
    ?>
    <li>
        <div class="navSearch-group">
            <a href="#" class="navsearch-button"><i class="fa fa-search"></i></a>
            <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="navsearch-form">
                <input type="search" name="s" placeholder="<?php esc_attr_e('Search', 'marketo'); ?>" id="search" value="<?php echo get_search_query(); ?>">
                <input type="hidden" name="post_type" value="product" />
            </form>
        </div>
    </li>

<?php }elseif ($header_layout == '9'){
    ?>
    <div class="search-form-area">
        <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="inline-serach-form clearfix woocommerce-product-search">
            <input type="search" class="form-control serach-form" name="s" placeholder="<?php esc_attr_e('Search', 'marketo'); ?>" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" value="<?php echo get_search_query(); ?>">
            <button class="search-btn" id="searchsubmit" type="submit"><i class="fa fa-search"></i></button>
            <input type="hidden" name="post_type" value="product" />
        </form>
    </div>

    <?php
} elseif ($header_layout == '10'){
    ?>
    <div class="search-form-area">
        <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="inline-serach-form style2 clearfix">
            <input type="search" class="form-control serach-form" name="s" placeholder="<?php esc_attr_e('Search...', 'marketo'); ?>" id="search" value="<?php echo get_search_query(); ?>">
            <button class="search-btn" id="searchsubmit" type="submit"><i class="fa fa-search"></i></button>
            <input type="hidden" name="post_type" value="product" />
        </form><!-- .inline-serach-form .clearfix END -->
    </div><!-- .search-form-area END -->
    <?php
}elseif ($header_layout == '11' || $header_layout == '12'){
    ?>
    <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="navsearch-form" style="display: none;">
        <input type="search" placeholder="<?php esc_attr_e('Search', 'marketo'); ?>" name="s" id="search" value="<?php echo get_search_query(); ?>">
        <input type="hidden" name="post_type" value="product" />
    </form>
    <?php
} else { ?>

    <form class="<?php echo esc_attr($search_wrapper); ?>" action="<?php echo esc_url(home_url('/')); ?>" method="get"
          id="header_form">
        <div class="input-group">
            <input type="search" name="s" class="form-control"
                   placeholder="<?php esc_attr_e('Find your product', 'marketo'); ?>">
            <?php if (!class_exists('Algolia_Plugin')): ?>
                <div class="xs-category-select-wraper">
                    <i class="xs-spin"></i>
                    <select class="xs-category-select" name="product_cat">
                        <option value="-1"><?php esc_html_e('All Categories', 'marketo'); ?></option>
                        <?php if (is_array($cats) && !empty($cats)): ?>
                            <?php foreach ($cats as $cat) { ?>
                                <option value="<?php echo esc_html($cat->term_id); ?>"><?php echo esc_html($cat->name); ?></option>
                            <?php } ?>
                        <?php endif; ?>
                    </select>
                </div>
            <?php endif; ?>
            <div class="input-group-btn">
                <input type="hidden" id="search-param" name="post_type"
                       value="<?php esc_html_e('product', 'marketo'); ?>">
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>

<?php } ?>