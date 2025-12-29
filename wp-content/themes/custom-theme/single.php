<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <article class="single-post">
            <header class="post-header">
                <h1 class="post-title"><?php the_title(); ?></h1>
                <div class="post-meta">
                    <span class="post-date">Published: <?php echo get_the_date(); ?></span>
                    <?php if (get_the_author()) : ?>
                        <span class="post-author">By: <?php the_author(); ?></span>
                    <?php endif; ?>
                    <?php if (has_category()) : ?>
                        <span class="post-categories">Categories: <?php the_category(', '); ?></span>
                    <?php endif; ?>
                </div>
            </header>

            <?php if (has_post_thumbnail()) : ?>
                <div class="post-featured-image">
                    <?php the_post_thumbnail('large', array('class' => 'featured-image')); ?>
                </div>
            <?php endif; ?>

            <div class="post-content">
                <?php the_content(); ?>
            </div>

            <?php if (has_tag()) : ?>
                <div class="post-tags">
                    <strong>Tags: </strong><?php the_tags('', ', ', ''); ?>
                </div>
            <?php endif; ?>

            <nav class="post-navigation">
                <div class="nav-previous">
                    <?php previous_post_link('%link', '&laquo; Previous Post'); ?>
                </div>
                <div class="nav-next">
                    <?php next_post_link('%link', 'Next Post &raquo;'); ?>
                </div>
            </nav>

            <?php
            // Comments section
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>
        </article>
    <?php endwhile; ?>
<?php else : ?>
    <p>Post not found.</p>
<?php endif; ?>

<?php get_footer(); ?>

