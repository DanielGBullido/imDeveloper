<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package imDeveloper
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function imdeveloper_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    return $classes;
}

add_filter('body_class', 'imdeveloper_body_classes');

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function imdeveloper_pingback_header()
{
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}

add_action('wp_head', 'imdeveloper_pingback_header');

function imdeveloper_custom_post_navigation()
{
    $next_post = get_next_post();
    $previous_post = get_previous_post();

    the_post_navigation(array(
        'next_text' => '<div class="col-sm-6 col-md-4"><span class="meta-nav glyphicon glyphicon-chevron-left" aria-hidden="true"></span> ' .
            '<div class="thumbnail">
              ' . get_the_post_thumbnail($next_post->ID, 'small') . '
              <div class="caption">
                <h3>%title</h3>
                <p>' . wp_trim_words(get_post_field('post_content', $next_post->ID), 30) . '</p>
                </div>
            </div></div>',
        'prev_text' => '<div class="col-sm-6 col-md-4"><span class="meta-nav glyphicon glyphicon-chevron-right" aria-hidden="true"></span> ' .
            '<div class="thumbnail">
              ' . get_the_post_thumbnail($previous_post->ID, 'small') . '
              <div class="caption">
                <h3>%title</h3>
                <p>' . wp_trim_words(get_post_field('post_content', $previous_post->ID), 30) . '</p>
                </div>
            </div></div>',
    ));
}

function imdeveloper_related_post($postId)
{
    $categories = get_the_category($postId);
    if ($categories) {
        $category_ids = array();
        foreach ($categories as $individual_category) {
            $category_ids[] = $individual_category->term_id;
        }
        $args = array(
            'category__in' => $category_ids,
            'post__not_in' => array($postId),
            'posts_per_page' => 3,
            'caller_get_posts' => 1,
            'order' => 'DESC',
            'orderby' => 'date',
        );
        $loop = new WP_Query($args);
        if ($loop->have_posts()) {
            echo '<div class="related-posts"><h3>Articulos relacionados sobre ' . get_the_category()[0]->name .'</h3><ul>';
            while ($loop->have_posts()) : $loop->the_post(); ?>
                <li>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail" onclick="window.location='<?= the_permalink()?>'">
                            <?php the_post_thumbnail('small'); ?>
                            <div class="caption">
                                <h4>
                                    <a href="<?= the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>">
                                        <?php the_title(); ?></a>
                                </h4>
                                <p><?php echo wp_trim_words(get_post_field('post_content', get_the_ID()), 20) ?></p>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endwhile;
            echo '</ul></div>';
        }
    }
}