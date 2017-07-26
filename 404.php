<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package imDeveloper
 */

get_header(); ?>
<div class="row">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'imdeveloper'); ?></h1>
    </header><!-- .page-header -->
    <div class="container-fluid">
        <section id="primary" class="error-404 not-found">
            <article class="page-content">

                <?= imdeveloper_search_form(); ?>

                <img src="<?= get_template_directory_uri(); ?>/assets/img/404.gif" />

            </article><!-- .page-content -->
        </section><!-- .error-404 -->

        </section><!-- #primary -->
        <?php get_sidebar(); ?>
    </div>
    <?php get_footer(); ?>
</div>
