<div class="search-form-area">
    <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="inline-serach-form style2 clearfix">
        <input type="search" class="form-control serach-form" name="s" placeholder="<?php echo esc_attr($market_nav_search_place_holder); ?>" id="search" value="<?php echo get_search_query(); ?>">
        <button class="search-btn" id="searchsubmit" type="submit"><i class="<?php echo esc_attr($market_vertical_menu_search_icon['value']); ?>"></i></button>
        <input type="hidden" name="post_type" value="product" />
    </form><!-- .inline-serach-form .clearfix END -->
</div><!-- .search-form-area END -->