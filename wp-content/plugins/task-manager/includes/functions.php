<?php

/**
 * Helper functions for Task Manager.
 *
 * @package TaskManager
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add an email to the queue.
 *
 * @param string $to      Recipient email address.
 * @param string $subject Email subject.
 * @param string $message Email message body.
 * @return int|false Insert ID on success, false on failure.
 */
function tmAddEmailQueue(string $to, string $subject, string $message)
{
    return TMEmailQueue::add($to, $subject, $message);
}

