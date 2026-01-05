<?php

/**
 * Database operations for Task Manager.
 *
 * @package TaskManager
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class TMDatabase
 *
 * Handles database operations such as table creation and data cleanup for Task Manager.
 */
class TMDatabase
{
    /**
     * Create required database tables.
     *
     * @return void
     */
    public static function createTables()
    {
        global $wpdb;
        $charsetCollate = $wpdb->get_charset_collate();

        // Create email_queue table.
        $wpdb->query(
            "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}email_queue (
                id bigint(20) AUTO_INCREMENT PRIMARY KEY,
                to_email varchar(255) NOT NULL,
                subject varchar(255) NOT NULL,
                message text NOT NULL,
                status varchar(20) DEFAULT 'pending',
                created_at datetime DEFAULT CURRENT_TIMESTAMP,
                KEY status (status)
            ) $charsetCollate"
        );

        // Create contact_forms table.
        $wpdb->query(
            "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}contact_forms (
                id bigint(20) AUTO_INCREMENT PRIMARY KEY,
                name varchar(255) NOT NULL,
                email varchar(255) NOT NULL,
                subject varchar(255) NOT NULL,
                message text NOT NULL,
                status varchar(20) DEFAULT 'pending',
                created_at datetime DEFAULT CURRENT_TIMESTAMP,
                KEY status (status),
                KEY email (email)
            ) $charsetCollate"
        );
    }

    /**
     * Clean up old data from tables.
     *
     * @return void
     */
    public static function cleanupOldData()
    {
        global $wpdb;

        // Delete sent emails older than 7 days.
        $wpdb->query(
            "DELETE FROM {$wpdb->prefix}email_queue 
             WHERE status = 'sent' AND created_at < DATE_SUB(NOW(), INTERVAL 7 DAY)"
        );

        // Delete contact forms older than 30 days.
        $wpdb->query(
            "DELETE FROM {$wpdb->prefix}contact_forms 
             WHERE created_at < DATE_SUB(NOW(), INTERVAL 30 DAY)"
        );
    }
}