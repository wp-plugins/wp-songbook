<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of base
 *
 * @author sjiamnocna
 */
class wp_songbook extends songbook_functions {
    function wp_songbook($key=''){
        load_plugin_textdomain(WPSB_LANGDOM,false,WPSB_DIRNAME.'/langs/');
        
        add_action('init',array($this,'regenqfiles'));
        add_action('wp_enqueue_scripts',array($this,'enq_public'));
        add_action('admin_enqueue_scripts',array($this,'enq_admin'));
    }
    
    function regenqfiles(){
          wp_register_script('songbook_jquery_dragsort',plugins_url().'/'.WPSB_DIRNAME.'/files/js/jquery.dragsort-0.5.1.min.js',array('jquery'));
          wp_register_script('songbook_files_functions',plugins_url().'/'.WPSB_DIRNAME.'/files/js/files_fcs.js',array('jquery'));
          wp_register_script('songbook_filebox_script',plugins_url().'/'.WPSB_DIRNAME.'/files/js/filescript.js',array('jquery','songbook_files_functions'));
          wp_register_script('songbook_settings_script',plugins_url().'/'.WPSB_DIRNAME.'/files/js/settings.js',array('jquery'));
          wp_register_script('songbook_metabox_script',plugins_url().'/'.WPSB_DIRNAME.'/files/js/metabox.js',array('jquery'));
          
          
          wp_register_style('songbook_jqueryuistyle',plugins_url().'/'.WPSB_DIRNAME.'/files/css/jqueryui_customstyle.css');
          wp_register_style('songbook_filebox_style',plugins_url().'/'.WPSB_DIRNAME.'/files/css/filestyle.css');
          wp_register_style('songbook_metabox_css',plugins_url().'/'.WPSB_DIRNAME.'/files/css/metabox.css');
          wp_register_style('songbook_filetypes_css',plugins_url().'/'.WPSB_DIRNAME.'/files/css/filetypes.css');
          wp_register_style('songbook_settings_style',plugins_url().'/'.WPSB_DIRNAME.'/files/css/settstyle.css');
          wp_register_style('songbook_songlist_style',plugins_url().'/'.WPSB_DIRNAME.'/files/css/songlist.css');
          wp_register_style('songbook_songbase_style',plugins_url().'/'.WPSB_DIRNAME.'/files/css/songbasics.css');

          
    $songbook_filebox_functions_translation=array(
        'unlink_confirm'=>__('Really unlink file from song?',WPSB_LANGDOM),
        'new_title'=>__('New title:',WPSB_LANGDOM)
    );
    $songbook_filebox_script_translation=array(
        'choosefiles'=>__('Choose files to link',WPSB_LANGDOM),
        'selectfiles_butt'=>__('Link files',WPSB_LANGDOM)
        );
    $songbook_tooltips_script_translation=array(
        'textch'=>__('Set new title for the file (will be shown instead of filename)',WPSB_LANGDOM),
        'lock'=>__('Set file publicly visible or visible to users only',WPSB_LANGDOM),
        'remover'=>__('Unlink file from song',WPSB_LANGDOM),
        'songbook_addfile_button'=>__('Click to link files to song',WPSB_LANGDOM),
        'songbook_tempo_meta'=>__('Set song speed',WPSB_LANGDOM)
        );
    wp_localize_script('songbook_files_functions','songbook_filebox_func',$songbook_filebox_functions_translation);
    wp_localize_script('songbook_filebox_script','songbook_filebox_script',$songbook_filebox_script_translation);
    wp_localize_script('songbook_tooltips_script','songbook_tooltips_script',$songbook_tooltips_script_translation);
}
    
    function enq_public(){
        $sb_listpageid=get_option('songbook_shcdefs_listpageid');
        if($sb_listpageid==get_the_ID())wp_enqueue_style('songbook_songlist_style');
        if(is_single()&&get_post_type()=='song'){
        wp_enqueue_style('songbook_songbase_style');
        wp_enqueue_style('songbook_filetypes_css');
    }
    }
    
    function enq_admin(){
        $songbook_enq_page=basename($_SERVER['PHP_SELF'])."?".$_SERVER['QUERY_STRING'];
        $songbook_getpage=(isset($_GET['page']))?$_GET['page']:false;
        if((preg_match('/^(edit\.php|post-new\.php|post\.php).*/',$songbook_enq_page)&&get_post_type()=='song')){
        wp_enqueue_media();
        
        
        wp_enqueue_style('songbook_filebox_style');
        wp_enqueue_style('songbook_jqueryuistyle');
        wp_enqueue_style('songbook_filetypes_css');
        wp_enqueue_style('songbook_metabox_css');
//    wp_enqueue_script('songbook_jquery_custom');
        wp_enqueue_script('songbook_jquery_dragsort');
        wp_enqueue_script('jquery-ui-tooltip');
        wp_enqueue_script('songbook_tooltips_script');
        wp_enqueue_script('songbook_files_functions');
        wp_enqueue_script('songbook_filebox_script');
        wp_enqueue_script('songbook_metabox_script');
        
        }elseif($songbook_getpage=='songbook-settlink'){
            
        wp_enqueue_style('songbook_settings_style');
        wp_enqueue_script('songbook_settings_script');
        wp_enqueue_script('jquery-ui-sortable');
        }
    }
}
$wpsb_base=new wp_songbook();