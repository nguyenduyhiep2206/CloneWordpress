<?php
// Handle contact form
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['contact_submit'])) {
    // Get data from form
    $name    = sanitize_text_field($_POST['contact_name'] ?? '');
    $email   = sanitize_email($_POST['contact_email'] ?? '');
    $subject = sanitize_text_field($_POST['contact_subject'] ?? '');
    $message = sanitize_textarea_field($_POST['contact_message'] ?? '');

    $error = '';
    $success = false;

    // Validate data
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error = 'Please fill in all fields.';
    } elseif (!is_email($email)) {
        $error = 'Invalid email address.';
    } else {
        // Save to contact_forms table (if using task-manager plugin)
        global $wpdb;
        $table = $wpdb->prefix . 'contact_forms';
        $wpdb->insert($table, [
            'name'    => $name,
            'email'   => $email,
            'subject' => $subject,
            'message' => $message,
        ]);
        
        // Add to email queue (if you want to send email async)
        if (function_exists('tmAddEmailQueue')) {
            $admin_email = get_option('admin_email');
            $mail_subject = '[Contact] ' . $subject;
            $mail_body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
            tmAddEmailQueue($admin_email, $mail_subject, $mail_body);
        }
        
        $success = true;
    }
}
?>
<?php get_header('v2'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Contact form</h3>
                </div>
                <div class="card-body">
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?php echo esc_html($error); ?></div>
                    <?php elseif (!empty($success)): ?>
                        <div class="alert alert-success">Thank you for contacting us! We will respond as soon as possible.</div>
                    <?php endif; ?>

                    <form method="post" action="">
                        <?php wp_nonce_field('contact_form_action', 'contact_form_nonce'); ?>
                        <div class="mb-3">
                            <label for="contact_name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="contact_name" id="contact_name" required value="<?php echo esc_attr($_POST['contact_name'] ?? ''); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="contact_email" class="form-label">Your Email</label>
                            <input type="email" class="form-control" name="contact_email" id="contact_email" required value="<?php echo esc_attr($_POST['contact_email'] ?? ''); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="contact_subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" name="contact_subject" id="contact_subject" required value="<?php echo esc_attr($_POST['contact_subject'] ?? ''); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="contact_message" class="form-label">Message</label>
                            <textarea class="form-control" name="contact_message" id="contact_message" rows="5" required><?php echo esc_textarea($_POST['contact_message'] ?? ''); ?></textarea>
                        </div>
                        <button type="submit" name="contact_submit" class="btn btn-primary w-100">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer('v2'); ?>
