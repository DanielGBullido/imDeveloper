<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package imDeveloper
 */


if ( ! function_exists('proyects') ) {

// Register Custom Post Type
    function proyects() {

        $labels = array(
            'name'                  => _x( 'Proyectos', 'Post Type General Name', 'proyects' ),
            'singular_name'         => _x( 'Proyecto', 'Post Type Singular Name', 'proyects' ),
            'menu_name'             => __( 'Proyectos', 'proyects' ),
            'name_admin_bar'        => __( 'Proyecto', 'proyects' ),
            'archives'              => __( 'Item Archives', 'proyects' ),
            'attributes'            => __( 'Item Attributes', 'proyects' ),
            'parent_item_colon'     => __( 'Parent Item:', 'proyects' ),
            'all_items'             => __( 'Todos los proyectos', 'proyects' ),
            'add_new_item'          => __( 'Añadir nuevo', 'proyects' ),
            'add_new'               => __( 'Añadir nuevo', 'proyects' ),
            'new_item'              => __( 'Proyecto nuevo', 'proyects' ),
            'edit_item'             => __( 'Editar proyecto', 'proyects' ),
            'update_item'           => __( 'Actualizar proyecto', 'proyects' ),
            'view_item'             => __( 'Ver proyecto', 'proyects' ),
            'view_items'            => __( 'Ver proyectos', 'proyects' ),
            'search_items'          => __( 'Buscar proyecto', 'proyects' ),
            'not_found'             => __( 'No encontrado', 'proyects' ),
            'not_found_in_trash'    => __( 'No existe', 'proyects' ),
            'featured_image'        => __( 'Imagen destacada', 'proyects' ),
            'set_featured_image'    => __( 'Elegir imagen destacada', 'proyects' ),
            'remove_featured_image' => __( 'Eliminar imagen destacada', 'proyects' ),
            'use_featured_image'    => __( 'Usar imagen destacada', 'proyects' ),
            'insert_into_item'      => __( 'Añadir al proyecto', 'proyects' ),
            'uploaded_to_this_item' => __( 'Añadir a este proyecto', 'proyects' ),
            'items_list'            => __( 'Listado', 'proyects' ),
            'items_list_navigation' => __( 'Navegación', 'proyects' ),
            'filter_items_list'     => __( 'Filtros', 'proyects' ),
        );
        $rewrite = array(
            'slug'                  => 'proyecto',
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => true,
        );
        $args = array(
            'label'                 => __( 'Proyecto', 'proyects' ),
            'description'           => __( 'Site articles.', 'proyects' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-analytics',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => 'proyectos',
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => $rewrite,
            'capability_type'       => 'page',
        );
        register_post_type( 'proyects', $args );

    }
    add_action( 'init', 'proyects', 0 );

}


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
            echo '<div class="related-posts"><h3>Articulos relacionados sobre ' . get_the_category()[0]->name . '</h3><ul>';
            while ($loop->have_posts()) : $loop->the_post(); ?>
                <li>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail" onclick="window.location='<?= the_permalink() ?>'">
                            <?php the_post_thumbnail('small'); ?>
                            <div class="caption">
                                <h4>
                                    <a href="<?= the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
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

function mytheme_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment; ?>
    <?php /*
        <?php if ($comment->comment_approved == '0') : ?>
            <em><?php _e('Your comment is awaiting moderation.') ?></em>
            <br />
        <?php endif; ?>

        <div class="comment-meta commentmetadata">
            <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
                <?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a>
            <?php edit_comment_link(__('(Edit)'),'  ','') ?></div>
    </div> */ ?>


    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>" class="comment-main-level">
            <div class="comment-box col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="comment-head">
                    <div class="comment-avatar">
                        <?php echo get_avatar($comment, $size = '48', $default = '<path_to_url>'); ?>
                    </div>
                    <?php printf(__('<h6 class="comment-name">%s</h6> '), get_comment_author_link()); ?>
                    <div class="reply">
                        <?php comment_reply_link(array_merge($args, array(
                                    'depth' => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'reply_text' => __('Responder <i class="glyphicon glyphicon-share-alt"></i>',
                                        'textdomain'),
                                )
                            )
                        ) ?>
                    </div>
                    <span><?php printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time()) ?></span>

                </div>
                <div class="comment-content">
                    <?php comment_text() ?>
                </div>
            </div>
        </div>
    </li>
    <?php
}