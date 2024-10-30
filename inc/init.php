<?php
/**
 * Plugin init.
 *
 * @since 2.2.4
 *
 * @package Booking Official Searchbox
 */

defined( 'ABSPATH' ) || exit;

// Include the init file.
require_once dirname( __FILE__ ) . '/constants.php';

require_once BOS_PLUGIN_PATH . '/core-functions.php';

require_once BOS_PLUGIN_PATH . '/helpers.php';

require_once BOS_PLUGIN_PATH . '/static.php';

include_once BOS_PLUGIN_PATH . '/widget/bos_widget.php';