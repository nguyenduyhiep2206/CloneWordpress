<?php

/**
 * Cron job management for Task Manager
 *
 * @package TaskManager
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class TMCron
 *
 * Handles cron schedules and events for Task Manager.
 */
class TMCron
{
    /**
     * Add custom cron schedules.
     *
     * @param array $schedules Existing cron schedules.
     * @return array Modified cron schedules.
     */
    public static function addCronSchedules($schedules)
    {
        $schedules['every_1_minutes'] = [
            'interval' => 60,
            'display'  => 'Every 1 Minutes',
        ];
        return $schedules;
    }

    /**
     * Schedule cron events.
     *
     * @return void
     */
    public static function scheduleEvents()
    {
        if (! wp_next_scheduled('tm_send_emails')) {
            wp_schedule_event(time(), 'every_1_minutes', 'tm_send_emails');
        }

        if (! wp_next_scheduled('tm_cleanup')) {
            wp_schedule_event(time(), 'daily', 'tm_cleanup');
        }
    }

    /**
     * Clear scheduled events.
     *
     * @return void
     */
    public static function clearEvents()
    {
        wp_clear_scheduled_hook('tm_send_emails');
        wp_clear_scheduled_hook('tm_cleanup');
    }
}
