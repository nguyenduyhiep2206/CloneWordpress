<header>
    <nav class="navbar navbar-expand-md navbar-light bg-light" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'your-theme-slug'); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="<?php echo home_url(); ?>">Home</a>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php
                wp_nav_menu(array(
                    'theme_location'    => 'primary',
                    'depth'             => 2,
                    'container'         => false,
                    'menu_class'        => 'nav navbar-nav me-auto mb-2 mb-md-0',
                    'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                    'walker'            => new WP_Bootstrap_Navwalker(),
                ));
                ?>
                <div class="d-flex ms-auto">
                    <?php if (is_user_logged_in()) : ?>
                        <a href="<?php echo wp_logout_url(home_url()); ?>" class="btn btn-outline-primary me-2">Đăng xuất</a>
                    <?php else : ?>
                        <a href="<?php echo esc_url( home_url('/login/') ); ?>" class="btn btn-outline-primary me-2">Đăng nhập</a>
                        <a href="<?php echo wp_registration_url(); ?>" class="btn btn-primary">Đăng ký</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>