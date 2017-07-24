<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package imDeveloper
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">

        <div class="entry-title">
            <a href="<?php the_permalink() ?>" rel="bookmark">
                <?php
                if (is_singular()) :
                    the_title('<h1 class="title">', '</h1>');
                else :
                    the_title('<h2 class="title">', '</h2>');
                endif; ?>
            </a>
        </div>

        <?php
        if (has_post_thumbnail()) : ?>
            <div class="entry-thumb">
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <?php the_post_thumbnail("large", ["class" => "img-thumbnail"]); ?>
                </a>
            </div>
        <?php endif;

        if ('post' === get_post_type()) : ?>
            <div class="entry-meta">
                <?php imdeveloper_posted_on(); ?>
            </div><!-- .entry-meta -->
            <?php
        endif; ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        if (is_single()) {
            the_content();
        } else {
            the_excerpt();
        }

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'imdeveloper'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php imdeveloper_entry_footer(); ?>
        <?php if (is_single()) {
            imdeveloper_custom_post_navigation();

            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
        } ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
