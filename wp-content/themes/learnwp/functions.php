<?php
// Load CSS Bootstrap
function load_css_bootstrap()
{
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '5.3.0', 'all');
}
add_action('wp_enqueue_scripts', 'load_css_bootstrap');

// Load JS Bootstrap
function load_js_bootstrap()
{
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', 'jquery', '5.3.0', true);
}
add_action('wp_enqueue_scripts', 'load_js_bootstrap');

// Load my styles
function load_my_styles()
{
    wp_enqueue_style('my-styles', get_template_directory_uri() . '/css/mystyle.css', array(), '1.0.0', 'all');
}
add_action('wp_enqueue_scripts', 'load_my_styles');

/**
 * Register custom navigation walker
 */
function register_custom_navigation_walker()
{
    require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';

    register_nav_menus(array(
        'primary' => 'Primary Menu',
        'mobile' => 'Mobile Menu',
    ));
}
add_action('after_setup_theme', 'register_custom_navigation_walker');

// Đăng ký Custom Post Type "service"
function tao_custom_post_type()
{
    $labels = array(
        'name'                  => 'Services',
        'singular_name'         => 'Service',
    );

    $args = array(
        'labels'             => $labels,
        'description'        => 'Post type for services',
        'public'             => true,
        'rewrite'            => array('slug' => 'service'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'show_in_rest'       => true,
        'taxonomies'         => array('category', 'post_tag'),
    );

    register_post_type('service', $args);

}
add_action('init', 'tao_custom_post_type');

// Hiển thị cả post và service ở trang blog/home (Trang chủ bài viết)
function lay_custom_post_type($query)
{
    if ($query->is_home() && $query->is_main_query()) {
        $query->set('post_type', array('post', 'service'));
    }
    return $query;
}
add_filter('pre_get_posts', 'lay_custom_post_type');

function lay_category_post_and_service($query)
{
    if (
        !is_admin() &&
        $query->is_main_query() &&
        (is_category() || is_tag())
    ) {
        $post_types = array('post', 'service');
        $query->set('post_type', $post_types);
    }
}
add_action('pre_get_posts', 'lay_category_post_and_service');

