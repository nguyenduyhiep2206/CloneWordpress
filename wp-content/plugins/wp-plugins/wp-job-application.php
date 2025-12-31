<?php
/**
 * Plugin Name: Job Application Plugin
 * Plugin URI: https://github.com/myusername/job-application-plugin
 * Description: Plugin này cho phép người dùng gửi đơn ứng tuyển thông qua một form trên website.
 * Version: 1.0.0
 * Author: My plugin
 * Author URI: https://mywebsite.com
 */

defined('ABSPATH') || exit;

require_once __DIR__ . '/src/Database.php';

register_activation_hook(__FILE__, ['Database', 'create_contact_table']);
register_activation_hook(__FILE__, ['Database', 'create_job_application_table']);
