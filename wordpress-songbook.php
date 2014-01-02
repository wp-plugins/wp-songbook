<?php
/**
 * Plugin Name: WP songbook
 * Description: Wordpress plugin, allowing people to manage lyrics and all what has something to do with songs. In future there should be more features as Import from OpenLP and others.
 * Version: 1.1.1
 * Text Domain: wpsongbook
 * Domain Path: /langs
 * Author: Sjiamnocna
 * Author URI: http://sjiaphoto.g6.cz/
 * Plugin URI: http://sjiaphoto.g6.cz/wp-songbook/
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
  wp_register_script('songbook_filebox_script',plugins_url().'/wp-songbook/js/filescript.js');
  wp_register_script('songbook_settings_script',plugins_url().'/wp-songbook/js/setts_script.js');
  wp_register_style('songbook_filebox_style',plugins_url().'/wp-songbook/css/filestyle.css');
  wp_register_style('songbook_settings_style',plugins_url().'/wp-songbook/css/settstyle.css');
}
function songbook_activation(){
    include_once('inc/wpsongs-functions.php');
    if(get_option('songbook_version')){
        $songbook_updated=(get_option('songbook_version')!=songbook_version());
        if($songbook_updated){
            songbook_saveopt('songbook_version',songbook_version());
        }
    }else{
        songbook_saveopt('songbook_version',songbook_version());
        songbook_setdefaults(songbook_version());
    }
}
function songbook_enqueue_admin(){
    $songbook_enq_page=basename($_SERVER['PHP_SELF'])."?".$_SERVER['QUERY_STRING'];
    if((ereg('^(edit\.php|post-new\.php|post\.php).*$',$songbook_enq_page)&&get_post_type()=='song')){
    wp_enqueue_style('songbook_filebox_style');
    wp_enqueue_script('songbook_filebox_script');
    $songbook_filescript_translation=array(
        'unlink_confirm'=>__('Really unlink from song?','wpsongbook'),
        'choosefiles'=>__('Choose files to link','wpsongbook'),
        'selectfiles_butt'=>__('Link files','wpsongbook'),
        'removefile'=>__('Remove file','wpsongbook')
        );
    wp_localize_script('songbook_filebox_script','songbook_filescr_translation',$songbook_filescript_translation);
    }elseif($_GET['page']=='songbook-settlink'){
        wp_enqueue_style('songbook_settings_style');
        wp_enqueue_script('songbook_settings_script');
    }
}
register_activation_hook(__FILE__,'songbook_activation');
add_action('plugins_loaded','songbook_plugin_init');
add_action('admin_enqueue_scripts','songbook_enqueue_admin');
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
//inc/wpsongs-addmbox-aditionals.php
add_action('add_meta_boxes','songbook_add_metabox_aditionals');
add_action('save_post','songbook_save_aditionals');
//inc/wpsongs-shortcs.php
//add_shortcode('songbook_songlist','songbook_pluginlistshc');
add_filter('the_content','songbook_pluginlistshc');
//inc/wpsongs-contenthooks.php
add_filter('plugin_action_links_'.plugin_basename(__FILE__),'songbook_pluginspagelink',10,2);
add_filter('plugin_row_meta','songbook_pluginmetalinks',10,2);
add_filter('the_content','songbook_contentfilter');
add_filter('the_time','songbook_timeremover');
add_filter('the_date','songbook_timeremover');
?>