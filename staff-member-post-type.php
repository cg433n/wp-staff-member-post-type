<?php
/**
 * Plugin Name: Staff Member Post Type
 * Description: This plugin registers the 'staff-member' post type.
 * Version: 1.0
 * License: GPLv2
 */

if ( ! defined ( 'ABSPATH' ) ) {
	exit;
}

require_once( 'includes/post-type.php' );
require_once( 'includes/featured-members-widget.php' );
require_once( 'includes/shortcodes.php' );
