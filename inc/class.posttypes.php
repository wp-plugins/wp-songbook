<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of cpt-song
 *
 * @author sjiamnocna
 */
class songbook_customtypes extends songbook_functions{
    function songbook_customtypes(){
        add_action('init',array($this,'cpt_songs'));
        if($this->option('enable_playlists')==='enable')add_action('init',array($this,'cpt_playlists'));
        
        add_action('admin_menu',array($this,'cptremoveboxes'));
    }
    function cpt_songs() {
  $args = array(
    'labels'=>array(
        'name'=>__('Songs','wpsongbook'),
        'singular_name'=>__('Song','wpsongbook'),
        'add_new'=>__('Add new','wpsongbook'),
        'add_new_item'=>__('Add new song','wpsongbook'),
        'edit_item'=>__('Edit song','wpsongbook'),
        'new_item'=>__('New song','wpsongbook'),
        'all_items'=>__('All songs','wpsongbook'),
        'view_item'=>__('View song','wpsongbook'),
        'search_items'=>__('Search songs','wpsongbook'),
        'not_found'=>__('No song found','wpsongbook'),
        'not_found_in_trash'=>__('No song found in trash','wpsongbook'),
        'parent_item_colon'=>'',
        'menu_name'=>__('Songs','wpsongbook')
             ),
        'public'=>true,
        'menu_position'=>5,
        'publicly_queryable'=>true,
        'show_ui'=>true,
        'show_in_menu'=>true,
        'show_in_admin_bar'=>true,
        'query_var'=>true,
        'rewrite'=>array('slug'=>'song'),
        'capability_type'=>'post',
        'menu_icon'=>(get_bloginfo('version')<3.8)?plugins_url('../files/img/menu_black.png',__FILE__):plugins_url('../files/img/menu_white.png',__FILE__),
        'has_archive'=>true,
        'hierarchical'=>false,
        'menu_position'=>10,
        'supports'=>array('title','editor',(get_option('songbook_enable_comments')==='enable')?'comments':false)
        );
        register_post_type( 'song', $args );
    }
    function cpt_playlists(){
        
    }
    function cptremoveboxes() {
        remove_meta_box('postexcerpt','song','normal'); //removes comments status
        remove_meta_box('postimagediv','song','normal'); //removes featured images
        remove_meta_box('authordiv','song','normal'); //removes author 
    }
}
$wpsb_cpt_song=new songbook_customtypes();