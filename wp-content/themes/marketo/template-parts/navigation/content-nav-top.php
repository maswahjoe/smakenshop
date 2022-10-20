<?php
$top_class = $menu_bg_color = '';

$top_bar_infos = marketo_option('top_bar_infos');
$header_social_links = marketo_option('footer_social_links');
$header_fullwidth = marketo_option('header_fullwidth');

$social_follow_us_title = marketo_option('social_follow_us_title');
$my_account_title = marketo_option('my_accout_title');
$my_login_title = marketo_option('my_login_title');
$account_and_login_url = marketo_option('account_and_login_url');

($my_account_title !== null && $my_account_title !== '') ? $my_account_title_value = $my_account_title : $my_account_title_value = esc_html__('My Account', 'marketo');

($my_login_title !== null && $my_login_title !== '') ? $my_login_title_value = $my_login_title : $my_login_title_value = esc_html__('Login', 'marketo');

($social_follow_us_title !== null && $social_follow_us_title !== '') ? $social_follow_us_title_value = $social_follow_us_title : $social_follow_us_title_value = esc_html__('Follow Us', 'marketo');

$account__link = marketo_get_account_link();
if ($account_and_login_url !== '' && $account_and_login_url !== null) {
    $account__link = $account_and_login_url;
}

$login__link = get_permalink(get_option('woocommerce_myaccount_page_id'));
if ($account_and_login_url !== '' && $account_and_login_url !== null) {
    $login__link = $account_and_login_url;
}

if ($header_fullwidth) {
    $container = 'container container-fullwidth';
} else {
    $container = 'container';
}
$show_topbar_border = marketo_option('show_topbar_border');
if ($show_topbar_border) {
    $border_class = "v-border";
} else {
    $border_class = "";
}
?>

<div class="xs-top-bar <?php echo esc_attr($border_class); ?> d-none d-md-none d-lg-block">
    <div class="<?php echo esc_attr($container); ?>">
        <div class="row">
            <div class="col-lg-8">
                <div class="topbar-info-group">
                    <?php if ($top_bar_infos[0]['info_text'] != '') { ?>
                        <ul class="xs-top-bar-info">
                            <?php foreach ($top_bar_infos as $top_bar_info) { ?>
                                <li>
                                    <a href="<?php echo esc_url($top_bar_info['info_url']); ?>">
                                        <?php if ($top_bar_info['info_icon'] != "") { ?>
                                            <i class="<?php echo esc_attr($top_bar_info['info_icon']); ?>"></i>
                                        <?php } ?>
                                        <?php echo esc_html($top_bar_info['info_text']); ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                    <?php
                    if ($header_social_links) { ?>
                        <ul class="xs-social-list">
                            <li class="xs-list-text"><?php echo esc_html($social_follow_us_title_value); ?></li>
                            <?php
                            foreach ($header_social_links as $social) {
                                $icon = (isset($social['social_icon']) ? $social['social_icon'] : '');
                                ?>
                                <li><a href="<?php echo esc_url($social['social_url']); ?>"><i
                                            class="<?php echo esc_attr($icon); ?>"></i></a></li><?php
                            }
                            ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-4">
                <ul class="xs-top-bar-info right-content">
                    <?php if (is_user_logged_in()) : ?>
                        <li>
                            <a href="<?php echo $account__link; ?>"><?php echo esc_html($my_account_title_value); ?></a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="<?php echo $login__link; ?>"><?php echo esc_html($my_login_title_value); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>