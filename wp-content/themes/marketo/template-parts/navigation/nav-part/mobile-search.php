<?php
$cats = xs_category_list_slug('product_cat');

$marketo_algolia = marketo_option('marketo_algolia');
$search_wrapper = 'xs-navbar-search xs-navbar-search-wrapper navsearch-form';
if (class_exists('Algolia_Plugin')) {
    $search_wrapper = 'xs-navbar-search navsearch-form';
}
?>

    <form class="<?php echo esc_attr($search_wrapper); ?>" action="<?php echo esc_url(home_url('/')); ?>" method="get"
          id="header_forms">
        <div class="input-group">
            <input type="search" name="s" class="form-control"
                   placeholder="<?php esc_attr_e('Find your product', 'marketo'); ?>">
            <?php if (!class_exists('Algolia_Plugin')): ?>
                <div class="xs-category-select-wraper">
                    <i class="xs-spin"></i>
                    <select class="xs-category-select2" name="product_cat">
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
                <input type="hidden" name="post_type"
                       value="<?php esc_html_e('product', 'marketo'); ?>">
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>