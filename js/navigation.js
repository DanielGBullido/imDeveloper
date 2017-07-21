/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
$( document ).ready(function() {
    $('.button-menu').on('click',function(){
        console.log("ay madre");
        $(".navigation-panel" ).toggleClass( "open-menu" );
    });
});
