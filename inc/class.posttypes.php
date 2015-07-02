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
class songbook_customtypes extends songbook_functions {

    function songbook_customtypes() {
        add_action('init', array($this, 'cpt_songs'));

        if ($this->option('enable_playlists') === 'enable')
            add_action('init', array($this, 'cpt_playlists'));


        add_action('admin_menu', array($this, 'cptremoveboxes'));
    }

    function cpt_songs() {
        $args = array(
            'labels' => array(
                'name' => __('Songs', WPSB_LANGDOM),
                'singular_name' => __('Song', WPSB_LANGDOM),
                'add_new' => __('Add new', WPSB_LANGDOM),
                'add_new_item' => __('Add new song', WPSB_LANGDOM),
                'edit_item' => __('Edit song', WPSB_LANGDOM),
                'new_item' => __('New song', WPSB_LANGDOM),
                'all_items' => __('All songs', WPSB_LANGDOM),
                'view_item' => __('View song', WPSB_LANGDOM),
                'search_items' => __('Search songs', WPSB_LANGDOM),
                'not_found' => __('No song found', WPSB_LANGDOM),
                'not_found_in_trash' => __('No song found in trash', WPSB_LANGDOM),
                'parent_item_colon' => '',
                'menu_name' => __('Songs', WPSB_LANGDOM)
            ),
            'public' => true,
            'menu_position' => 5,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_admin_bar' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'song'),
            'capability_type' => 'post',
            'menu_icon' => (get_bloginfo('version') < 3.8) ? plugins_url('../files/img/menu_black.png', __FILE__) : plugins_url('../files/img/menu_white.png', __FILE__),
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 10,
            'supports' => array('title', 'editor', 'thumbnail', ($this->option('enable_comments') === 'enable') ? 'comments' : false)
        );
        register_post_type('song', $args);
    }

    function cpt_playlists() {
        $args = array(
            'labels' => array(
                'name' => __('Playlists', WPSB_LANGDOM),
                'singular_name' => __('Playlist', WPSB_LANGDOM),
                'add_new' => __('Add new', WPSB_LANGDOM),
                'add_new_item' => __('Add new playlist', WPSB_LANGDOM),
                'edit_item' => __('Edit playlist', WPSB_LANGDOM),
                'new_item' => __('New playlist', WPSB_LANGDOM),
                'all_items' => __('Playlists', WPSB_LANGDOM),
                'view_item' => __('View playlist', WPSB_LANGDOM),
                'search_items' => __('Search playlists', WPSB_LANGDOM),
                'not_found' => __('No playlist found', WPSB_LANGDOM),
                'not_found_in_trash' => __('No playlist found in trash', WPSB_LANGDOM),
                'parent_item_colon' => '',
                'menu_name' => __('Playlists', WPSB_LANGDOM)
            ),
            'public' => true,
            'menu_position' => 5,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => 'edit.php?post_type=song',
            'show_in_admin_bar' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'song'),
            'capability_type' => 'post',
            'menu_icon' => (get_bloginfo('version') < 3.8) ? plugins_url('../files/img/menu_black.png', __FILE__) : plugins_url('../files/img/menu_white.png', __FILE__),
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 10,
            'supports' => array('title',($this->option('enable_comments') === 'enable') ? 'comments' : false)
        );
        register_post_type('playlist', $args);
    }

    function cptremoveboxes() {
        remove_meta_box('postexcerpt', 'song', 'normal'); //removes post excerpt field for songs
        remove_meta_box('postimagediv', 'song', 'normal'); //removes featured images
        remove_meta_box('authordiv', 'song', 'normal'); //removes author
        
        if ($this->option('enable_playlists') === 'enable'){
            remove_meta_box('authordiv', 'playlist', 'normal'); //removes author
            remove_meta_box('postexcerpt', 'playlist', 'normal'); //removes post excerpt field from playlists
            remove_meta_box('postimagediv', 'playlist', 'normal'); //removes featured images
        }
    }

}

$wpsb_cpt_song = new songbook_customtypes();
