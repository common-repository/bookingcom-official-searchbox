<?php
/**
 * Constants.
 *
 * @package Booking Official Searchbox
 */

defined( 'ABSPATH' ) || exit;

define( 'BOS_PLUGIN_NAME', 'Booking.com Official Search Box' );
define( 'BOS_PLUGIN_VERSION', '2.3.1' );
if ( ! defined( 'BOS_WP_VERSION' ) ) {
    define( 'BOS_WP_VERSION', get_bloginfo( 'version' ) );
}

if ( ! defined( 'BOS_PLUGIN_FILE' ) ) {
	define( 'BOS_PLUGIN_FILE', __FILE__ );
}

if ( ! defined( 'BOS_PLUGIN_PATH' ) ) {
    define( 'BOS_PLUGIN_PATH', untrailingslashit( plugin_dir_path( BOS_PLUGIN_FILE ) ) );
}

if ( ! defined( 'BOS_PLUGIN_URL' ) ) {
    define( 'BOS_PLUGIN_URL', untrailingslashit( plugins_url( '/', BOS_PLUGIN_FILE ) ) );
}

if ( ! defined( 'BOS_INC_PLUGIN_DIR' ) ) {
    define( 'BOS_INC_PLUGIN_DIR', BOS_PLUGIN_PATH );
}

if ( ! defined( 'BOS_PLUGIN_HELPER_DIR' ) ) {
    define( 'BOS_PLUGIN_HELPER_DIR', BOS_INC_PLUGIN_DIR . '/helpers' );
}

if ( ! defined( 'BOS_PLUGIN_ASSETS' ) ) {
    define( 'BOS_PLUGIN_ASSETS', BOS_PLUGIN_DIR_URL . '/assets' );
}

if ( ! defined( 'BOS_DEFAULT_AID' ) ) {
    define( 'BOS_DEFAULT_AID', 382821 );
}

// Default fallback values
if ( ! defined( 'BOS_CALENDAR' ) ) {
    define( 'BOS_CALENDAR', 0 );
}
        
if ( ! defined( 'BOS_DEST_TYPE' ) ) {
    define( 'BOS_DEST_TYPE', 'select' ); // destination type of settings and meta box
}

if ( ! defined( 'BOS_FLEXIBLE_DATES' ) ) {
    define( 'BOS_FLEXIBLE_DATES', 0 ); // flexible dates ( invisible )
}

// if ( ! defined( 'BOS_SAVE_BUTTON' ) ) {
// define( 'BOS_SAVE_BUTTON' , 0 ); // save button on widget ( invisible )
// }

if ( ! defined( 'BOS_LOGODIM' ) ) {
    define( 'BOS_LOGODIM', 'blue_150x25' ); // logo dimension and color
}

if ( ! defined( 'BOS_LOGOPOS' ) ) {
    define( 'BOS_LOGOPOS', 'left' ); // booking.com logo position
}

if ( ! defined( 'BOS_SELECTED_DATE_COLOR' ) ) {
    define( 'BOS_SELECTED_DATE_COLOR', '#0071c2' );
}

if ( ! defined( 'BOS_BUTTONPOS' ) ) {
    define( 'BOS_BUTTONPOS', 'right' ); // button position
}

if ( ! defined( 'BOS_BGCOLOR' ) ) {
    define( 'BOS_BGCOLOR', '' ); // searchbox background color
}

if ( ! defined( 'BOS_HEADLINE_SIZE' ) ) {
    define( 'BOS_HEADLINE_SIZE', '19' ); // headline fontsize
}

if ( ! defined( 'BOS_HEADLINE_TEXTCOLOR' ) ) {
    define( 'BOS_HEADLINE_TEXTCOLOR', '#003580' ); // headline text color
}

if ( ! defined( 'BOS_DEST_TEXTCOLOR' ) ) {
    define( 'BOS_DEST_TEXTCOLOR', '#003580' ); // destination text color
}

if ( ! defined( 'BOS_DEST_BGCOLOR' ) ) {
    define( 'BOS_DEST_BGCOLOR', '#FFFFFF' ); // destination field background color
}

if ( ! defined( 'BOS_TEXTCOLOR' ) ) {
    define( 'BOS_TEXTCOLOR', '#003580' ); // searchbox text color 
}

if ( ! defined( 'BOS_FLEXDATE_TEXTCOLOR' ) ) {
    define( 'BOS_FLEXDATE_TEXTCOLOR', '#003580' ); // flex date text color
}

if ( ! defined( 'BOS_DATES_BGCOLOR' ) ) {
    define( 'BOS_DATES_BGCOLOR', '#FFFFFF' ); // dates background color
}

if ( ! defined(  'BOS_DATE_TEXTCOLOR' ) ) {
    define( 'BOS_DATE_TEXTCOLOR', '#003580' ); // date fields text color
}

if ( ! defined( 'BOS_SUBMIT_BGCOLOR' ) ) {
    define( 'BOS_SUBMIT_BGCOLOR', '#0896FF' ); // submit background color
}

if ( ! defined( 'BOS_SUBMIT_BORDERCOLOR' ) ) {
    define( 'BOS_SUBMIT_BORDERCOLOR', '#0896FF' ); // submit border color
}

if ( ! defined( 'BOS_SUBMIT_TEXTCOLOR' ) ) {
    define( 'BOS_SUBMIT_TEXTCOLOR', '#FFFFFF' ); // submit border color
}

if ( ! defined( 'BOS_CALENDAR_SELECTED_DATE_BGCOLOR' ) ) {
    define( 'BOS_CALENDAR_SELECTED_DATE_BGCOLOR', '#0071c2' );
}

if ( ! defined( 'BOS_CALENDAR_SELECTED_DATE_TEXTCOLOR' ) ) {
    define( 'BOS_CALENDAR_SELECTED_DATE_TEXTCOLOR', '#FFFFFF' );
}

if ( ! defined( 'BOS_CALENDAR_DAYNAMES_COLOR' ) ) {
    define( 'BOS_CALENDAR_DAYNAMES_COLOR', '#003580' );
}

if ( ! defined( 'BOS_DISPLAY_IN_CUSTOM_TYPES' ) ) {
    define( 'BOS_DISPLAY_IN_CUSTOM_TYPES', '' ); // submit border color
}

if ( ! defined( 'BOS_DEFAULT_DOMAIN' ) ) {
    define( 'BOS_DEFAULT_DOMAIN', '//www.booking.com/' ); // landing page
}

if ( ! defined( 'BOS_TARGET_PAGE' ) ) {
    define( 'BOS_TARGET_PAGE', 'searchresults.html' ); // landing page
}