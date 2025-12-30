<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header>
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
            <h1><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
            <nav>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'fallback_cb'    => function () {
                        wp_page_menu(array(
                            'menu_class' => 'menu',
                            'show_home'  => true,
                        ));
                    },
                ));
                ?>
            </nav>
        </div>
    </header>
    <main>