<div class="xs-ele-without-cat-search">
    <div class="navSearch-group">
        <a href="#" class="navsearch-button">
            <div class="navsearch-button-icon-group">
                <i class="<?php echo esc_attr($market_vertical_menu_search_icon['value']); ?> xs-search-icon"></i>
                <i class="<?php echo esc_attr($market_vertical_menu_search_icon_active['value']); ?> active-search-icon"></i>
            </div>
        </a>
        <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="navsearch-form" style="display: none;">
            <input type="search" class="form-control" placeholder="<?php echo esc_attr($market_nav_search_place_holder); ?>" name="s" id="search" value="<?php echo get_search_query(); ?>">
            <input type="hidden" name="post_type" value="product" />
        </form>
    </div><!-- .navSearch-group END -->
</div>