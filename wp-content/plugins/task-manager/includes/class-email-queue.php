<?php

/**
 * Email queue management for Task Manager.
 *
 * @package TaskManager
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class TM_Email_Queue
 *
 * Provides methods for managing an email queue within Task Manager.
 */
class TMEmailQueue
{
    /**
     * Add an email to the queue.
     *
     * @param string $to      Recipient email address.
     * @param string $subject Email subject.
     * @param string $message Email message body.
     * @return int|false Insert ID on success, false on failure.
     */
    public static function add($to, $subject, $message)
    {
        global $wpdb;

        return $wpdb->insert(
            $wpdb->prefix . 'email_queue',
            array(
                'to_email' => sanitize_email($to),
                'subject'  => sanitize_text_field($subject),
                'message'  => wp_kses_post($message),
            )
        );
    }

    /**
     * Process the email queue and send pending emails.
     *
     * @return void
     */
    public static function processQueue()
    {
        global $wpdb;

        // Get pending emails (limit 10 per run)
        $emails = $wpdb->get_results(
            "SELECT * FROM {$wpdb->prefix}email_queue
             WHERE status = 'pending'
             LIMIT 10"
        );

        foreach ($emails as $email) {
            // Log each email being sent
            error_log('Cron: Sending email to ' . $email->to_email);

            if (wp_mail($email->to_email, $email->subject, $email->message)) {
                $wpdb->update(
                    $wpdb->prefix . 'email_queue',
                    ['status' => 'sent'],
                    ['id' => $email->id]
                );
            }
        }

        error_log('Task Manager: Email queue processed at ' . current_time('mysql'));
    }
}
