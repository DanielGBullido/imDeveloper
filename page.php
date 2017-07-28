<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package imDeveloper
 */

get_header(); ?>
<div class="row">
    <?php
    if (is_home() && !is_front_page()) : ?>
        <div class="page-header">
            <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
        </div>
    <?php endif; ?>

    <div class="container-fluid">
        <section id="primary" class="site-main">

            <?php
            while (have_posts()) : the_post();

                get_template_part('template-parts/content', 'page');

                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>

        </section><!-- #primary -->

        <?php get_sidebar(); ?>
    </div>
    <?php get_footer(); ?>
</div>
