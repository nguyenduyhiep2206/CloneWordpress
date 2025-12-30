<?php
if (have_posts()):
    while (have_posts()) {
        the_post();
?>
        <div class="card">
            <div class="card-body">
                <h2 class="card-title"><?php the_title(); ?></h2>
                <div class="card-text"><?php the_excerpt(); ?></div>
            </div>
            <div class="card-footer">
                <a href="<?php the_permalink(); ?>" class="btn btn-success">Xem Thêm</a>
            </div>
        </div>
<?php
    }
endif;
