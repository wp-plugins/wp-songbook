<?php
/**
 * Plugin Name: WP songbook
 * Description: Wordpress plugin, allowing people to manage lyrics and all what has something to do with songs. In future there should be more features as Import from OpenLP and others.
 * Version: 1.4.2
 * Text Domain: wpsongbook
 * Domain Path: /langs
 * Author: Sjiamnocna
 * Author URI: http://sjiaphoto.g6.cz/
 * Plugin URI: http://sjiaphoto.g6.cz/wp-songbook/
 */
//include other filesgo 
  include_once('inc/wpsongs-functions.php');
  include_once('inc/wpsongs-cuspt-song.php');
  if(get_option('songbook_enable_authorstax')==='enable')include_once('inc/wpsongs-cuspt-tax-author.php');
  if(get_option('songbook_enable_albumstax')==='enable')include_once('inc/wpsongs-cuspt-tax-album.php');
  if(get_option('songbook_enable_genrestax')==='enable')include_once('inc/wpsongs-cuspt-tax-genre.php');
  include_once('inc/wpsongs-addmbox-files.php');
  include_once('inc/wpsongs-addmbox-aditionals.php');
//dont include still not working part
//include_once('inc/wpsongs-widget.php');
  include_once('inc/wpsongs-shortcs.php');
  include_once('inc/wpsongs-contenthooks.php');
  include_once('inc/wpsongs-addadminsettings.php');
function songbook_plugin_init(){
//load textdomain
  load_plugin_textdomain('wpsongbook',false,'wp-songbook/langs/');

//register all scripts
$wp_version = get_bloginfo('version');

//  wp_register_script('songbook_jquery_custom',plugins_url().'/wp-songbook/js/jquery/js/jquery-ui-1.10.4.custom.js',array('jquery'));
  wp_register_script('songbook_jquery_dragsort',plugins_url().'/wp-songbook/js/jquery.dragsort-0.5.1.min.js',array('jquery'));
  wp_register_script('songbook_files_functions',plugins_url().'/wp-songbook/js/files_fcs.js',array('jquery'));
  wp_register_script('songbook_filebox_script',plugins_url().'/wp-songbook/js/filescript.js',array('jquery','songbook_files_functions'));
  wp_register_script('songbook_tooltips_script',plugins_url().'/wp-songbook/js/tooltips.js',array('jquery','songbook_jquery_custom'));
  wp_register_style('songbook_jqueryuistyle',plugins_url().'/wp-songbook/css/jqueryui_customstyle.css');
  wp_register_style('songbook_filebox_style',plugins_url().'/wp-songbook/css/filestyle.css');
  wp_register_style('songbook_filetypes_css',plugins_url().'/wp-songbook/css/filetypes.css');
  wp_register_style('songbook_settings_style',plugins_url().'/wp-songbook/css/settstyle.css');
  wp_register_style('songbook_songlist_style',plugins_url().'/wp-songbook/css/songlist.css');
  wp_register_style('songbook_songbase_style',plugins_url().'/wp-songbook/css/songbasics.css');
//localize scripts
    $songbook_filebox_functions_translation=array(
        'unlink_confirm'=>__('Really unlink file from song?','wpsongbook'),
        'new_title'=>__('New title:','wpsongbook')
    );
    $songbook_filebox_script_translation=array(
        'choosefiles'=>__('Choose files to link','wpsongbook'),
        'selectfiles_butt'=>__('Link files','wpsongbook')
        );
    $songbook_tooltips_script_translation=array(
        'textch'=>__('Set new title for the file (will be shown instead of filename)','wpsongbook'),
        'lock'=>__('Set file publicly visible or visible to users only','wpsongbook'),
        'remover'=>__('Unlink file from song','wpsongbook'),
        'songbook_addfile_button'=>__('Click to link files to song','wpsongbook'),
        'songbook_tempo_meta'=>__('Set song speed','wpsongbook')
        );
    wp_localize_script('songbook_files_functions','songbook_filebox_func',$songbook_filebox_functions_translation);
    wp_localize_script('songbook_filebox_script','songbook_filebox_script',$songbook_filebox_script_translation);
    wp_localize_script('songbook_tooltips_script','songbook_tooltips_script',$songbook_tooltips_script_translation);
}

function songbook_warnmessages(){
        function sb_nolistpage() {
            echo '
            <div id="error" class="updated fade"><p><strong>'.sprintf(__('You haven\'t set your songbook page. Go %1$s to the settings %2$s and set it, if you want to see the song list on website.'),'<a href="'.admin_url('edit.php?post_type=song&page=songbook-settlink').'" alt="'.__('Go to the settings page','wpsongbook').'">','</a>').'</strong> '.'</p></div>';
        }
        function sb_lowwp() {
            echo '
            <div id="error" class="updated fade"><p><strong>'.sprintf(__('Your Wordpress version is to old (you use version %3$s) to run plugin WP Songbook. You can update to newest version in %1$s Dashboard %2$s'),'<a href="'.admin_url('update-core.php').'">','</a>',songbook_check_wp_version()).'</strong> '.'</p></div>';
        }
    if(!get_option('songbook_shcdefs_listpageid'))add_action('admin_notices', 'sb_nolistpage');
    if(!songbook_check_wp_version('3.9'))add_action('admin_notices', 'sb_lowwp');
}

function songbook_enqueue_admin(){
    $songbook_enq_page=basename($_SERVER['PHP_SELF'])."?".$_SERVER['QUERY_STRING'];
    if((ereg('^(edit\.php|post-new\.php|post\.php).*$',$songbook_enq_page)&&get_post_type()=='song')){
        wp_enqueue_media();
        wp_enqueue_style('songbook_filebox_style');
        wp_enqueue_style('songbook_jqueryuistyle');
        wp_enqueue_style('songbook_filetypes_css');
    //    wp_enqueue_script('songbook_jquery_custom');
        wp_enqueue_script('songbook_jquery_dragsort');
        wp_enqueue_script('jquery-ui-tooltip');
        wp_enqueue_script('songbook_tooltips_script');
        wp_enqueue_script('songbook_files_functions');
        wp_enqueue_script('songbook_filebox_script');
    }elseif($_GET['page']=='songbook-settlink'){
        wp_enqueue_style('songbook_settings_style');
    //    wp_enqueue_script('songbook_jquery_custom');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('songbook_tooltips');
    }elseif($_GET['page']=='songbook-helplink'){
    //    wp_enqueue_script('songbook_jquery_custom');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('songbook_tooltips');
    }
}
function songbook_enqueue_public(){
    $sb_listpageid=get_option('songbook_shcdefs_listpageid');
    if($sb_listpageid==get_the_ID())wp_enqueue_style('songbook_songlist_style');
    if(is_single&&get_post_type()=='song'){
        wp_enqueue_style('songbook_songbase_style');
        wp_enqueue_style('songbook_filetypes_css');
    }
}
//activation hook
function songbook_activation(){
    include_once('inc/wpsongs-functions.php');
    if(get_option('songbook_version')){
        $songbook_updated=(get_option('songbook_version')!=songbook_version());
        if($songbook_updated){
            songbook_saveopt('songbook_version',songbook_version());
            function sb_upgraded() {
            echo '<div id="updated" class="updated fade"><p><strong>'.sprintf(__('Congratulations. You have successfuly upgraded your WP songbook plugin from version %2$s to %1$s'),songbook_version(),get_option('songbook_version')).'</strong> '.'</p></div>';
            }
            add_action('admin_notices','sb_upgraded');
        }
    }else{
            function sb_firstlaunch() {
            echo'<div id="updated" class="updated fade"><p><strong>'.sprintf(__('Welcome, I\'m the Songbook. You can use me to manage lyrics and add files to it. You can have a nice view on settings page, to recognize what am I able to do :)')).'</strong> '.'</p></div>';
            }
            add_action('admin_notices','sb_upgraded');
        songbook_saveopt('songbook_version',songbook_version());
        songbook_setdefaults(songbook_version());
    }
}
register_activation_hook(__FILE__,'songbook_activation');
add_action('plugins_loaded','songbook_plugin_init');
add_action('wp_enqueue_scripts','songbook_enqueue_public');
add_action('admin_enqueue_scripts','songbook_enqueue_admin');
//inc/wpsongs-cuspt-song.php
add_action('init','songbook_cptbase');
add_action('init','songbook_warnmessages');
add_action('admin_menu','songbook_cptremoveboxes');
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
add_filter('term_link','authorsongsurl',10,3);
add_filter('plugin_action_links_'.plugin_basename(__FILE__),'songbook_pluginspagelink',10,2);
add_filter('plugin_row_meta','songbook_pluginmetalinks',10,2);
add_filter('the_content','songbook_contentfilter');
add_filter('the_time','songbook_timeremover');
add_filter('the_date','songbook_timeremover');
?>