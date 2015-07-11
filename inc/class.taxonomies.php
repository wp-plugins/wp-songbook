<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of taxonomies
 *
 * @author sjiamnocna
 */
class songbook_taxonomies extends songbook_functions {

    function __construct() {
        if ($this->option('enable_authorstax') === 'enable')
            add_action('init', array($this, 'authors'));
        if ($this->option('enable_genrestax') === 'enable')
            add_action('init', array($this, 'genres'));
        if ($this->option('enable_albumstax') === 'enable')
            add_action('init', array($this, 'albums'));
    }

    function authors() {
        $labels = array(
            'name' => __('Authors', WPSB_LANGDOM),
            'singular_name' => __('Author', WPSB_LANGDOM),
            'search_items' => __('Search authors', WPSB_LANGDOM),
            'popular_items' => __('Popular authors', WPSB_LANGDOM),
            'all_items' => __('All authors', WPSB_LANGDOM),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit author', WPSB_LANGDOM),
            'update_item' => __('Update author', WPSB_LANGDOM),
            'add_new_item' => __('Add new author', WPSB_LANGDOM),
            'new_item_name' => __('New author name', WPSB_LANGDOM),
            'separate_items_with_commas' => __('Separate authors by commas', WPSB_LANGDOM),
            'add_or_remove_items' => __('Add or remove authors', WPSB_LANGDOM),
            'choose_from_most_used' => __('Choose from most used authors', WPSB_LANGDOM),
            'not_found' => __('No authors found', WPSB_LANGDOM),
            'menu_name' => __('Song authors', WPSB_LANGDOM),
        );
        $songbook_taxauthor_args = array(
            'labels' => $labels,
            'show_tagcloud' => FALSE,
            'show_admin_column' => true
        );
        register_taxonomy('songauthor', 'song', $songbook_taxauthor_args);
    }

    function genres() {
        $labels = array(
            'name' => __('Genres', WPSB_LANGDOM),
            'singular_name' => __('Genre', WPSB_LANGDOM),
            'search_items' => __('Search genres', WPSB_LANGDOM),
            'popular_items' => __('Popular genres', WPSB_LANGDOM),
            'all_items' => __('All genres', WPSB_LANGDOM),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit genre', WPSB_LANGDOM),
            'update_item' => __('Update genre', WPSB_LANGDOM),
            'add_new_item' => __('Add new genre', WPSB_LANGDOM),
            'new_item_name' => __('New genre name', WPSB_LANGDOM),
            'separate_items_with_commas' => __('Separate genres by commas', WPSB_LANGDOM),
            'add_or_remove_items' => __('Add or remove genres', WPSB_LANGDOM),
            'choose_from_most_used' => __('Choose from most used genres', WPSB_LANGDOM),
            'not_found' => __('No genres found', WPSB_LANGDOM),
            'menu_name' => __('Song genres', WPSB_LANGDOM),
        );
        $songbook_taxgenre_args = array(
            'labels' => $labels,
            'show_tagcloud' => FALSE,
            'show_admin_column' => true
        );
        register_taxonomy('songgenre', 'song', $songbook_taxgenre_args);
    }

    function albums() {
        $labels = array(
            'name' => __('Albums', WPSB_LANGDOM),
            'singular_name' => __('Album', WPSB_LANGDOM),
            'search_items' => __('Search albums', WPSB_LANGDOM),
            'popular_items' => __('Popular albums', WPSB_LANGDOM),
            'all_items' => __('All albums', WPSB_LANGDOM),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit album', WPSB_LANGDOM),
            'update_item' => __('Update album', WPSB_LANGDOM),
            'add_new_item' => __('Add new album', WPSB_LANGDOM),
            'new_item_name' => __('New album name', WPSB_LANGDOM),
            'separate_items_with_commas' => __('Separate albums by commas', WPSB_LANGDOM),
            'add_or_remove_items' => __('Add or remove albums', WPSB_LANGDOM),
            'choose_from_most_used' => __('Choose from most used albums', WPSB_LANGDOM),
            'not_found' => __('No albums found', WPSB_LANGDOM),
            'menu_name' => __('Song albums', WPSB_LANGDOM),
        );
        $songbook_taxalbum_args = array(
            'labels' => $labels,
            'show_tagcloud' => FALSE,
            'show_admin_column' => true
        );
        register_taxonomy('songalbum', 'song', $songbook_taxalbum_args);
    }

}

$wpsb_taxons = new songbook_taxonomies();
