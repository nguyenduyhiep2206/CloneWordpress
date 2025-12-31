<?php

/**
 * Database class file.
 * This class is used to interact with the database.
 */

class Database
{
    public static function create_job_application_table()
    {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}job_applications (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id BIGINT(20) UNSIGNED NULL,
            post_id BIGINT(20) UNSIGNED NULL,
            full_name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            phone VARCHAR(50),
            cv_url VARCHAR(500),
            cover_letter TEXT,
            status VARCHAR(50) DEFAULT 'pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES {$wpdb->users}(ID) ON DELETE SET NULL,
            FOREIGN KEY (post_id) REFERENCES {$wpdb->posts}(ID) ON DELETE SET NULL,
            INDEX idx_email (email),
            INDEX idx_status (status),
            INDEX idx_user_id (user_id)
        ) $charset_collate;");
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    public static function insert_job_application($data)
    {
        global $wpdb;
        return $wpdb->insert("{$wpdb->prefix}job_applications", $data);
    }
    // Get all job applications
    public static function get_all_job_applications()
    {
        global $wpdb;
        return $wpdb->get_results("SELECT * FROM {$wpdb->prefix}job_applications");
    }

    // Create contact form table in the database
    public static function create_contact_table()
    {
        global $wpdb;
        $table_name = "{$wpdb->prefix}contact_forms";
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            subject VARCHAR(255),
            message TEXT NOT NULL,
            status VARCHAR(50) DEFAULT 'pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            INDEX idx_email (email),
            INDEX idx_status (status)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    
    // Add method to save contact form information
    public static function insert_contact($data)
    {
        global $wpdb;
        return $wpdb->insert("{$wpdb->prefix}contact_forms", $data);
    }

    // Get all contact form submissions
    public static function get_all_contacts()
    {
        global $wpdb;
        $table_name = "{$wpdb->prefix}contact_forms";
        return $wpdb->get_results("SELECT * FROM $table_name");
    }
}