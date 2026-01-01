<?php
/**
 * Template Name: Custom Login Page
 */

get_header();
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Login</h3>
                </div>
                <div class="card-body">
                    <?php
                    // Display error message if there is one
                    if (isset($_GET['login']) && $_GET['login'] == 'failed') {
                        echo '<div class="alert alert-danger">Username or password is incorrect!</div>';
                    }
                    ?>
                    
                    <form method="post" action="">
                        <?php wp_nonce_field('custom_login_action', 'custom_login_nonce'); ?>
                        
                        <div class="mb-3">
                            <label for="username" class="form-label">Username or Email</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberme" name="rememberme">
                            <label class="form-check-label" for="rememberme">
                                Remember me
                            </label>
                        </div>
                        
                        <button type="submit" name="custom_login_submit" class="btn btn-primary w-100">
                            Login
                        </button>
                    </form>
                    
                    <div class="mt-3 text-center">
                        <a href="<?php echo wp_lostpassword_url(); ?>">Forgot password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>