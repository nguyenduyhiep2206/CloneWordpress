<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header version 2</title>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css">
    <?php wp_head(); ?>
</head>

<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Header version 2</h1>
                </div>
            </div>
        </div>
    </header>
</body>

<!-- Menu -->
<?php get_template_part('includes/section', 'menu'); ?>