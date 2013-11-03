<?php
/**
 * Plugin Name: WP songbook
 * Description: Wordpress plugin, allowing people to manage lyrics and all what has something to do with song. In future there should be more features as Import from OpenLP and others.
 * Version: 0.4
 * Text Domain: wpsongbook
 * Domain Path: /langs
 * Author: Sjiamnocna
 * Author URI: http://sjiaphoto.g6.cz/wp-songbook
 */
function songbook_plugin_init(){
  load_plugin_textdomain('wpsongbook',false,'wp-songbook/langs/');
  include_once(plugin_dir_path(__FILE__).'inc/wpsongs-cuspt.php');
  include_once(plugin_dir_path(__FILE__).'inc/wpsongs-mboxes.php');
  include_once(plugin_dir_path(__FILE__).'inc/wpsongs-custaxons.php');
//  include_once(plugin_dir_path(__FILE__).'inc/wpsongs-widget.php');
  include_once(plugin_dir_path(__FILE__).'inc/wpsongs-listshortc.php');
  include_once(plugin_dir_path(__FILE__).'inc/wpsongs-contenthooks.php');
  include_once(plugin_dir_path(__FILE__).'inc/wpsongs-addadminsettings.php');
}
add_action('plugins_loaded','songbook_plugin_init');
add_action('init','songbook_cptbase');
add_action('init','songbook_authortax');
add_action('admin_menu','songbook_cptremoveboxes');
add_action('admin_menu','songbook_registeradminlinks');
?>
