<?php

/**
 * Plugin Name: Role Plugin
 * Description: Plugin to create custom role for WordPress
 * Version: 1.0.0
 * Author: anonymous
 */

// Create custom role Content Manager
function create_content_manager_role()
{
    add_role(
        'content_manager',
        'Content Manager',
        array(
            'read'                   => true,
            'edit_posts'             => true,
            'edit_others_posts'      => true,
            'edit_published_posts'   => true,
            'publish_posts'          => true,
            'delete_posts'           => true,
            'delete_others_posts'    => true,
            'delete_published_posts' => true,
            'upload_files'           => true,
            'manage_categories'      => true,
        )
    );
}
add_action('init', 'create_content_manager_role');

// Create custom role HR (Human Resources)
function create_hr_role()
{
    add_role(
        'hr',
        'HR',
        array(
            'read'                   => true,
            'edit_posts'             => false,
            'edit_others_posts'      => false,
            'edit_published_posts'   => false,
            'publish_posts'          => false,
            'delete_posts'           => false,
            'delete_others_posts'    => false,
            'delete_published_posts' => false,
            'upload_files'           => false,
        )
    );
}
add_action('init', 'create_hr_role');

// Handle custom login form
function handle_custom_login() {
    if (isset($_POST['custom_login_submit'])) {
        // Verify nonce
        if (!isset($_POST['custom_login_nonce']) || !wp_verify_nonce($_POST['custom_login_nonce'], 'custom_login_action')) {
            wp_redirect(home_url('/login?login=failed'));
            exit;
        }

        $username = isset($_POST['username']) ? sanitize_user($_POST['username']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $remember = isset($_POST['rememberme']) ? true : false;

        if (empty($username) || empty($password)) {
            wp_redirect(home_url('/login?login=failed'));
            exit;
        }

        // Authenticate user
        $user = wp_authenticate($username, $password);

        if (is_wp_error($user)) {
            wp_redirect(home_url('/login?login=failed'));
            exit;
        }

        // Login successful
        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID, $remember);
        
        // Redirect based on user role
        $redirect_url = admin_url();
        if (!user_can($user->ID, 'edit_posts')) {
            $redirect_url = home_url();
        }
        
        wp_redirect($redirect_url);
        exit;
    }
}
add_action('init', 'handle_custom_login');

// Protect admin page based on roles
function restrict_admin_access() {
    // Allow admin-post.php and admin-ajax.php for AJAX requests
    if (wp_doing_ajax() || wp_doing_cron()) {
        return;
    }
    
    // Check if trying to access admin area
    if (is_admin() && !wp_doing_ajax()) {
        if (!current_user_can('edit_posts')) {
            wp_redirect(home_url());
            exit;
        }
    }
}
add_action('admin_init', 'restrict_admin_access');

// Hide admin bar for users without edit_posts capability
function hide_admin_bar_for_hr() {
    if (!current_user_can('edit_posts')) {
        show_admin_bar(false);
    }
}
add_action('init', 'hide_admin_bar_for_hr');