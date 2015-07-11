<?php

/**
 * Plugin Name: WP Songbook
 * Description: Plugin for simple managing songs, song authors, lyrics and everything is needed for it.
 * Version: 2.0.&epsilon;
 * Text Domain: wpsongbook
 * Domain Path: /langs
 * Author: Sjiamnocna
 * Author URI: http://sjiamnocna.com/wpsongbook
 */

//tell if error occurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('WPSB_DIRNAME', 'wp-songbook-remake');
define('WPSB_LANGDOM', 'wpsongbook');
define('WPSB_VERSION', '2.0.&epsilon;');

include_once 'inc/func.functions.php';
include_once 'inc/func.filters.php';
include_once 'inc/class.ajax.php';
include_once 'inc/class.base.php';
include_once 'inc/class.posttypes.php';
include_once 'inc/class.metabox.php';
include_once 'inc/class.taxonomies.php';
include_once 'inc/class.admin.php';
include_once 'inc/class.hooks.php';
