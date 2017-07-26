<?php
/**
 * imDeveloper Theme Customizer
 *
 * @package imDeveloper
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function imdeveloper_customize_register($wp_customize)
{
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('blogname', array(
            'selector' => '.site-title a',
            'render_callback' => 'imdeveloper_customize_partial_blogname',
        ));
        $wp_customize->selective_refresh->add_partial('blogdescription', array(
            'selector' => '.site-description',
            'render_callback' => 'imdeveloper_customize_partial_blogdescription',
        ));
    }
}

add_action('customize_register', 'imdeveloper_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function imdeveloper_customize_partial_blogname()
{
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function imdeveloper_customize_partial_blogdescription()
{
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function imdeveloper_customize_preview_js()
{
    wp_enqueue_script('imdeveloper-customizer', get_template_directory_uri() . '/js/customizer.js',
        array('customize-preview'), '20151215', true);
}

add_action('customize_preview_init', 'imdeveloper_customize_preview_js');


function new_excerpt_more($more)
{
    global $post;
    return '<a class="read-more" href="' . get_permalink($post->ID) . '"> ...( Seguir leyendo )</a>';
}

add_filter('excerpt_more', 'new_excerpt_more');

function imdeveloper_search_form($form)
{
    $form = '
    <form role="search" method="get" id="searchform" class="searchform" action="' . home_url('/') . '">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="input-group">
                    <input type="text" class="form-control" value="' . get_search_query() . '"
                           placeholder="' . __('Search for:') . '">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">' . esc_attr__('Search') . '</button>
                    </span>
                </div>
            </div>
        </div>
    </form>';

    return $form;
}

add_filter('get_search_form', 'imdeveloper_search_form', 100);