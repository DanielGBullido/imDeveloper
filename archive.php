<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package imDeveloper
 */

get_header(); ?>

<div class="row">

    <div class="page-header">
        <?php
        the_archive_title('<h1 class="page-title">', '</h1>');
        the_archive_description('<div class="archive-description">', '</div>');
        ?>
    </div>

    <div class="container-fluid">
        <section id="primary" class="blog-archive">
            <?php
            if (have_posts()) : ?>
                <?php
                /* Start the Loop */
                while (have_posts()) : the_post();
                    get_template_part('template-parts/content', get_post_format());
                endwhile;

                the_posts_navigation();
            else :
                get_template_part('template-parts/content', 'none');
            endif; ?>

        </section><!-- #primary -->
        <?php get_sidebar(); ?>
    </div>
    <?php get_footer(); ?>
</div>
