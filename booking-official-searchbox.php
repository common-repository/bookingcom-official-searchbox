<?php
/**
 * Plugin Name: Booking.com Official Search Box
 * Plugin URI: https://www.booking.com/affiliate-program/v2/index.html
 * Description: This plugin creates a search box for Booking.com Affiliate Partners to implement using their affiliate ID. If you’re not an Affiliate Partner yet, you can still implement the plugin. To get the most out of the plugin and earn commission, you’ll need to <a href="http://www.booking.com/content/affiliates.html" target="_blank">sign up for the Booking.com Affiliate Partner Programme.</a>
 * Version: 2.3.1
 * Author: Partnerships at Booking.com
 * Author URI: https://www.booking.com/affiliate-program/v2/index.html
 * Text Domain: bookingcom-official-searchbox
 * Domain Path: /languages
 * License: GPLv2
 */
     
     
/*  Copyright 2014-2022 Partnerships at Booking.com  ( email : wp-plugins@booking.com )
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License 
along with this program; if not, write to the Free Software 
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'BOS_PLUGIN_DIR_URL' ) ) {
    define( 'BOS_PLUGIN_DIR_URL' , untrailingslashit( plugins_url( '/', __FILE__ ) ) );
}
if ( ! defined( 'BOS_PLUGIN_MAIN_FILE' ) ) {
    define( 'BOS_PLUGIN_MAIN_FILE', plugin_basename(__FILE__) );
}

// Include the init file.
require_once dirname( __FILE__ ) . '/inc/init.php';