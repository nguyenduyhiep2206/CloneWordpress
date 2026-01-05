<?php

/**
 * Plugin Name: Task Manager
 * Description: Cron jobs and async email queue management
 * Version: 3.0.2
 * Author: Anonymous
 */


// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('TM_VERSION', '3.0.2');
define('TM_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('TM_PLUGIN_URL', plugin_dir_url(__FILE__));
define('TM_PLUGIN_BASENAME', plugin_basename(__FILE__));

/**
 * Main plugin class
 */
class TaskManager
{

    /**
     * Instance of this class
     */
    private static $instance = null;

    /**
     * Get instance of this class
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor
     */
    private function __construct()
    {
        $this->includes();
        $this->initHooks();
    }

    /**
     * Include required files
     */
    private function includes()
    {
        require_once TM_PLUGIN_DIR . 'includes/class-database.php';
        require_once TM_PLUGIN_DIR . 'includes/class-cron.php';
        require_once TM_PLUGIN_DIR . 'includes/class-email-queue.php';
        require_once TM_PLUGIN_DIR . 'includes/functions.php';
    }

    /**
     * Initialize hooks
     */
    private function initHooks()
    {
        // Activation and deactivation hooks
        register_activation_hook(__FILE__, array('TMDatabase', 'createTables'));
        register_activation_hook(__FILE__, array('TMCron', 'scheduleEvents'));
        register_deactivation_hook(__FILE__, array('TMCron', 'clearEvents'));

        // Register cron actions EARLY - before plugins_loaded
        // This ensures they're available when wp-cron.php runs
        add_action('tm_send_emails', array('TMEmailQueue', 'processQueue'));
        add_action('tm_cleanup', array('TMDatabase', 'cleanupOldData'));
        
        // Add custom cron schedules - also early
        add_filter('cron_schedules', array('TMCron', 'addCronSchedules'));

        // Initialize plugin
        add_action('plugins_loaded', array($this, 'init'));
    }

    /**
     * Initialize plugin
     */
    public function init()
    {
        // Plugin initialization code can go here if needed
    }
}

/**
 * Initialize the plugin
 */
function taskManagerInit()
{
    return TaskManager::getInstance();
}

taskManagerInit();
