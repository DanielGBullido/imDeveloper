/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
jQuery(document).ready(function( $ ) {
    $('.button-menu').on('click',function(){
        $(".navigation-panel" ).toggleClass( "open-menu" );
    });
});