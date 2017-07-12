<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package imDeveloper
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside class="col-sm-3 offset-sm-1 blog-sidebar">
    <?php dynamic_sidebar('sidebar-1'); ?>
</aside><!-- #secondary -->
