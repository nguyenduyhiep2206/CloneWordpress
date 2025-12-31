<?php
if (have_posts()):
    while (have_posts()):
        the_post();
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
                            <?php if (in_array(get_post_type(), ['post', 'service'])): ?>
                                <a href="<?php the_permalink(); ?>" class="btn btn-success">Xem Thêm</a>
                            <?php elseif (get_post_type() === 'page'): ?>
                                <a href="<?php echo home_url(); ?>" class="btn btn-success">Quay lại</a>
                            <?php endif; ?>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
<?php
    endwhile;
endif;
?>
<div class="pagination">
    <?php
    echo paginate_links();
    ?>
</div>
