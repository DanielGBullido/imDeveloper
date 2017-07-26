<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package imDeveloper
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php comment_form(); ?>
    <?php
    // You can start editing here -- including this comment!
    if (have_comments()) : ?>
        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // Are there comments to navigate through? ?>
            <nav id="comment-nav-above" class="navigation comment-navigation">
                <h2 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'imdeveloper'); ?></h2>
                <div class="nav-links">

                    <div class="nav-previous"><?php previous_comments_link(esc_html__('Older Comments',
                            'imdeveloper')); ?></div>
                    <div class="nav-next"><?php next_comments_link(esc_html__('Newer Comments',
                            'imdeveloper')); ?></div>

                </div><!-- .nav-links -->
            </nav><!-- #comment-nav-above -->
        <?php endif; // Check for comment navigation. ?>

        <ul class="comments-list">
            <?php
            wp_list_comments(array(
                'style' => 'ul',
                'short_ping' => true,
                'type' => 'comment',
                'callback' => 'mytheme_comment',
            ));
            ?>
        </ul><!-- .comment-list -->

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // Are there comments to navigate through? ?>
            <nav id="comment-nav-below" class="navigation comment-navigation">
                <h2 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'imdeveloper'); ?></h2>
                <div class="nav-links">

                    <div class="nav-previous"><?php previous_comments_link(esc_html__('Older Comments',
                            'imdeveloper')); ?></div>
                    <div class="nav-next"><?php next_comments_link(esc_html__('Newer Comments',
                            'imdeveloper')); ?></div>

                </div><!-- .nav-links -->
            </nav><!-- #comment-nav-below -->
            <?php
        endif; // Check for comment navigation.

    endif; // Check for have_comments().


    // If comments are closed and there are comments, let's leave a little note, shall we?
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>

        <p class="no-comments"><?php esc_html_e('Comments are closed.', 'imdeveloper'); ?></p>
        <?php
    endif;
    ?>

</div><!-- #comments -->
