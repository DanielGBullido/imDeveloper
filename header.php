<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package imDeveloper
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="container-fluid">
    <div class="row">
        <header class="col-xs-3 col-sm-3 col-md-2 col-lg-2 navigation-panel">
            <div class="navigation-panel-container">
                <?php

                $custom_logo_id = get_theme_mod('custom_logo');
                $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                if (has_custom_logo()) : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <img class="site-logo" src="<?php echo esc_url($logo[0]); ?>">
                    </a>
                <?php endif;

                if (is_front_page() && is_home()) : ?>
                    <h1 class="site-title"><?php bloginfo('name'); ?></h1>
                <?php else : ?>
                    <p class="site-title"><?php bloginfo('name'); ?></p>
                    <?php
                endif;

                $description = get_bloginfo('description', 'display');
                if (is_front_page() && is_home() && !is_customize_preview()) : ?>
                    <h2 class="site-description"><?= $description; ?></h2>
                <?php else : ?>
                    <p class="site-description"><?= $description; ?></p>
                    <?php
                endif; ?>
            </div><!-- .site-branding -->

            <button type="button" class="navbar-toggle button-menu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <nav id="site-navigation" class="site-navigation ">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu-1',
                    'menu_id' => 'primary-menu',
                    'container' => 'ul',
                    'menu_class' => 'nav nav-pills nav-stacked'
                ));
                ?>
            </nav><!-- #site-navigation -->
        </header><!-- #masthead -->

        <main class="col-xs-9 col-sm-9 col-md-10 col-lg-10 col-xs-offset-3 col-sm-offset-4 col-md-offset-2 col-lg-offset-2  main">
