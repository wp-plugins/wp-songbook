<?php
/**
 * Plugin Name: WP Songbook
 * Description: Plugin for simple managing songs, song authors, lyrics and everything is needed for it.
 * Version: 2.0.&alpha;
 * Text Domain: wpsongbook
 * Domain Path: /langs
 * Author: Sjiamnocna
 * Author URI: http://sjiamnocna.com/wpsongbook
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once 'inc/abstract.functions.php';
include_once 'inc/class.base.php';
include_once 'inc/class.posttypes.php';
include_once 'inc/class.metabox.php';
include_once 'inc/class.taxonomies.php';
include_once 'inc/class.admin.php';
include_once 'inc/class.hooks.php';