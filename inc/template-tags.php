<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package imDeveloper
 */

if (!function_exists('imdeveloper_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function imdeveloper_posted_on()
    {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

        $time_string = sprintf($time_string,
            esc_attr(get_the_date('c')),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date('c')),
            esc_html(get_the_modified_date())
        );

        $posted_on = sprintf(
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark"><span class="glyphicon glyphicon-calendar"></span>' . $time_string . '</a>'
        );

        $byline = sprintf(
            '<span class="author vcard"><span class="glyphicon glyphicon-user"></span><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<span class="posted-on container-meta">' . $posted_on . '</span><span class="byline container-meta"> ' . $byline . '</span>'; // WPCS: XSS OK.

        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', ', 'imdeveloper'));
            if ($categories_list) {
                /* translators: 1: list of categories. */
                printf('<span class="cat-links container-meta"><span class="glyphicon glyphicon-bookmark"></span>' .
                    esc_html__('%1$s', 'imdeveloper') .
                    '</span>',
                    $categories_list); // WPCS: XSS OK.
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'imdeveloper'));
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<span class="tags-links container-meta"><span class="glyphicon glyphicon-tags"></span>' .
                    esc_html__('%1$s', 'imdeveloper') .
                    '</span>',
                    $tags_list); // WPCS: XSS OK.
            }
        }
    }
endif;

if (!function_exists('imdeveloper_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function imdeveloper_entry_footer()
    {
        // Hide category and tag text for pages.

        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                    /* translators: %s: post title */
                        __('<span class="glyphicon glyphicon-comment"></span>', 'imdeveloper'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                )
            );
            echo '</span>';
        }

        edit_post_link(
            sprintf(
                wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Edit <span class="screen-reader-text">%s</span>', 'imdeveloper'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
endif;
