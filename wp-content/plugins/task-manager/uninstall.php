<?php
/**
 * Uninstall Task Manager
 * 
 * This file is executed when the plugin is uninstalled
 */

// If uninstall not called from WordPress, then exit
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

global $wpdb;

// Drop tables
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}email_queue");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}contact_forms");

// Clear scheduled cron events
wp_clear_scheduled_hook('tm_send_emails');
wp_clear_scheduled_hook('tm_cleanup');