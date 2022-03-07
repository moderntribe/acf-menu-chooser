<?php

/*
 * Plugin Name: Advanced Custom Fields: Menu Chooser
 * Plugin URI: https://github.com/moderntribe/acf-menu-chooser
 * Description: List WordPress Menus in a select ACF field.
 * Version: 1.1.0
 * Author: Reyhoun, modified by Modern Tribe
 * Author URI: http://reyhoun.com/
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * GitHub Plugin URI: https://github.com/moderntribe/acf-menu-chooser
 * GitHub Branch:     master
*/

defined( 'ABSPATH' ) || exit;

// 1. set text domain
// Reference: https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
load_plugin_textdomain( 'acf-menu-chooser', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );

add_action( 'acf/include_field_types', static function() {
	include_once __DIR__ . '/acf-menu-chooser-v5.php';
}, 10, 0 );
