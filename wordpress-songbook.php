<?php
/**
 * Plugin Name: WP songbook
 * Description: Wordpress plugin, allowing people to manage lyrics and all what has something to do with songs. More info in description
 * Version: 1.6
 * Text Domain: wpsongbook
 * Domain Path: /langs
 * Author: Sjiamnocna
 * Author URI: http://sjiaphoto.g6.cz/
 * Plugin URI: http://sjiaphoto.g6.cz/wp-songbook/
 */
//include other files

  include_once('inc/wpsongs-functions.php');
  include_once('inc/wpsongs-cuspt-song.php');
  if(get_option('songbook_enable_authorstax')==='enable')include_once('inc/wpsongs-cuspt-tax-author.php');
  if(get_option('songbook_enable_albumstax')==='enable')include_once('inc/wpsongs-cuspt-tax-album.php');
  if(get_option('songbook_enable_genrestax')==='enable')include_once('inc/wpsongs-cuspt-tax-genre.php');
  if(get_option('songbook_enable_songwidgets')==='enable')include_once('inc/wpsongs-songsidewidgets.php'); 
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
}

function songbook_regenqfiles(){
//register all scripts
$wp_version = get_bloginfo('version');

//  if(!wp_script_is('songbook_jquery_custom','registered'))wp_register_script('songbook_jquery_custom',plugins_url().'/wp-songbook/js/jquery/js/jquery-ui-1.10.4.custom.js',array('jquery'));
//  if(!wp_script_is('songbook_jquery_dragsort','registered'))
          wp_register_script('songbook_jquery_dragsort',plugins_url().'/wp-songbook/js/jquery.dragsort-0.5.1.min.js',array('jquery'));
//  if(!wp_script_is('songbook_files_functions','registered'))
          wp_register_script('songbook_files_functions',plugins_url().'/wp-songbook/js/files_fcs.js',array('jquery'));
//  if(!wp_script_is('songbook_filebox_script','registered'))
          wp_register_script('songbook_filebox_script',plugins_url().'/wp-songbook/js/filescript.js',array('jquery','songbook_files_functions'));
//  if(!wp_script_is('songbook_jquery_dragsort','registered'))wp_register_script('songbook_tooltips_script',plugins_url().'/wp-songbook/js/tooltips.js',array('jquery','songbook_jquery_custom'));
//  if(!wp_style_is('songbook_jqueryuistyle','registered'))
          wp_register_style('songbook_jqueryuistyle',plugins_url().'/wp-songbook/css/jqueryui_customstyle.css');
//  if(!wp_style_is('songbook_filebox_style','registered'))
          wp_register_style('songbook_filebox_style',plugins_url().'/wp-songbook/css/filestyle.css');
//  if(!wp_style_is('songbook_filetypes_css','registered'))
          wp_register_style('songbook_filetypes_css',plugins_url().'/wp-songbook/css/filetypes.css');
//  if(!wp_style_is('songbook_settings_style','registered'))
          wp_register_style('songbook_settings_style',plugins_url().'/wp-songbook/css/settstyle.css');
//  if(!wp_style_is('songbook_songlist_style','registered'))
          wp_register_style('songbook_songlist_style',plugins_url().'/wp-songbook/css/songlist.css');
//  if(!wp_style_is('songbook_songbase_style','registered'))
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
    songbook_regenqfiles();
    $songbook_enq_page=basename($_SERVER['PHP_SELF'])."?".$_SERVER['QUERY_STRING'];
    $songbook_getpage=(isset($_GET['page']))?$_GET['page']:false;
    if((preg_match('/^(edit\.php|post-new\.php|post\.php).*/',$songbook_enq_page)&&get_post_type()=='song')){
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
    }elseif($songbook_getpage=='songbook-settlink'){
        if(wp_style_is('songbook_settings_style','registered'))wp_enqueue_style('songbook_settings_style');
        else echo$songbook_enq_page;
    //    wp_enqueue_script('songbook_jquery_custom');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('songbook_tooltips');
    }elseif($songbook_getpage=='songbook-helplink'){
        echo$songbook_enq_page;
    //    wp_enqueue_script('songbook_jquery_custom');
        wp_enqueue_script('thickbox');
    }
}

function songbook_enqueue_public(){
    songbook_regenqfiles();
    $sb_listpageid=get_option('songbook_shcdefs_listpageid');
    if($sb_listpageid==get_the_ID())wp_enqueue_style('songbook_songlist_style');
    if(is_single()&&get_post_type()=='song'){
        wp_enqueue_style('songbook_songbase_style');
        wp_enqueue_style('songbook_filetypes_css');
    }
}

//activation hook

//function songbook_activation(){}
//register_activation_hook(__FILE__,'songbook_activation');

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
