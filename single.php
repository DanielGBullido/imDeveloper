<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package imDeveloper
 */

get_header(); ?>
<div class="row">
    <div class="container-fluid">
        <section id="primary" class="content-main">
            <main id="main" class="site-main">
                <?php
                while (have_posts()) : the_post();
                    get_template_part('template-parts/content', get_post_format());
                endwhile; // End of the loop.
                ?>
            </main><!-- #main -->
        </section>
        <?php get_sidebar(); ?>
    </div><!-- #primary -->
    <?php get_footer(); ?>
</div><!-- #primary -->


