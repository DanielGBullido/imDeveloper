/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
jQuery( document ).ready(function() {
    jQuery('.button-menu').on('click',function(){
        console.log("ay madre");
        jQuery(".navigation-panel" ).toggleClass( "open-menu" );
    });
});
