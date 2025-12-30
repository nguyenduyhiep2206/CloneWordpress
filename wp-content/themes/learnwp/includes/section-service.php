<?php
// Kiểm tra có đang ở post type "service" chưa
if (have_posts()):
    while (have_posts()):
        the_post();
        // Chỉ hiển thị nếu là post type "service"
        if (get_post_type() === 'service'):
?>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h1 class="card-title mb-3"><?php the_title(); ?></h1>
                            <div class="card-text">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
        endif;
    endwhile;
else:
    echo '<div class="container"><div class="alert alert-warning">No service found.</div></div>';
endif;
