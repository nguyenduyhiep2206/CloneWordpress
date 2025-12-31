<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <article class="post">
            <?php if (has_post_thumbnail()) : ?>
                <div class="post-thumbnail">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('large', array('class' => 'post-image')); ?>
                    </a>
                </div>
            <?php endif; ?>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="post-meta">
                <span>Published: <?php echo get_the_date(); ?></span>
            </div>
            <div class="post-content">
                <?php the_excerpt(); ?>
            </div>
            <a href="<?php the_permalink(); ?>">Read more &rarr;</a>
        </article>
    <?php endwhile; ?>

    <div class="pagination">
        <?php
        the_posts_pagination(array(
            'prev_text' => '&laquo; Previous',
            'next_text' => 'Next &raquo;',
        ));
        ?>
    </div>
<?php else : ?>
    <p>No posts found.</p>
<?php endif; ?>

<?php get_footer(); ?>