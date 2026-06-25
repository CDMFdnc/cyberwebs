<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- Canvas for Background Effects -->
<canvas id="cyber-bg-canvas"></canvas>

<header>
<div class="site-title">
<a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
</div>
<nav class="main-navigation">
<?php
if (has_nav_menu('primary')) {
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'container' => false,
        'depth' => 1,
        'fallback_cb' => false
    ));
} else {
    echo '<ul>';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
    if (class_exists('WooCommerce')) {
        echo '<li><a href="' . esc_url(get_permalink(wc_get_page_id('shop'))) . '">Shop</a></li>';
        echo '<li><a href="' . esc_url(get_permalink(wc_get_page_id('cart'))) . '">Cart</a></li>';
    }
    echo '</ul>';
}
?>
</nav>
</header>
<div class="container">
