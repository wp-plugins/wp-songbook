<?php
/**
 * Plugin Name: WP songbook
 * Description: Wordpress plugin, allowing people to manage lyrics and all what has something to do with song. In future there should be more features as Import from OpenLP and others.
 * Version: 1.0
 * Text Domain: wpsongbook
 * Domain Path: /langs
 * Author: Sjiamnocna
 * Author URI: http://sjiaphoto.g6.cz/wp-songbook
 */
function songbook_plugin_init(){
  load_plugin_textdomain('wpsongbook',false,'wp-songbook/langs/');
  include_once('inc/wpsongs-functions.php');
  include_once('inc/wpsongs-cuspt-song.php');
  include_once('inc/wpsongs-cuspt-tax-author.php');
  include_once('inc/wpsongs-addmbox-files.php');
  include_once('inc/wpsongs-addmbox-aditionals.php');
// dont include still not working part
//  include_once('inc/wpsongs-widget.php');
  include_once('inc/wpsongs-shortcs.php');
  include_once('inc/wpsongs-contenthooks.php');
  include_once('inc/wpsongs-addadminsettings.php');
}
add_action('plugins_loaded','songbook_plugin_init');
//inc/wpsongs-cuspt-song.php
add_action('init','songbook_cptbase');
add_action('admin_menu','songbook_remove_cpt_onroles');
add_action('admin_menu','songbook_cptremoveboxes');
//inc/wpsongs-cuspt-tax-author
add_action('init','songbook_authortax');
//inc/wpsongs-addadminsettings.php
add_action('admin_menu','songbook_registeradminlinks');
//inc/wpsongs-addmbox-files.php
add_action('add_meta_boxes','songbook_add_metabox_linkfile');
add_action('save_post','songbook_save_filemetabox');
add_action('admin_enqueue_scripts','songbook_enqueue_admin_scr');
//inc/wpsongs-addmbox-aditionals.php
add_action('add_meta_boxes','songbook_add_metabox_aditionals');
add_action('save_post','songbook_save_aditionals');
//inc/wpsongs-shortcs.php
add_shortcode('songbook','songbook_shc');
//inc/wpsongs-contenthooks.php
add_filter('the_content','songbook_contentfilter');
add_filter('the_time','songbook_timeremover');
add_filter('the_date','songbook_timeremover');
?>