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

    function songbook_taxonomies() {
        if ($this->option('enable_authorstax') === 'enable')
            add_action('init', array($this, 'authors'));
        if ($this->option('enable_genrestax') === 'enable')
            add_action('init', array($this, 'genres'));
        if ($this->option('enable_albumstax') === 'enable')
            add_action('init', array($this, 'albums'));
    }

    function authors() {
        $labels = array(
            'name' => __('Authors', 'wpsongbook'),
            'singular_name' => __('Author', 'wpsongbook'),
            'search_items' => __('Search authors', 'wpsongbook'),
            'popular_items' => __('Popular authors', 'wpsongbook'),
            'all_items' => __('All authors', 'wpsongbook'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit author', 'wpsongbook'),
            'update_item' => __('Update author', 'wpsongbook'),
            'add_new_item' => __('Add new author', 'wpsongbook'),
            'new_item_name' => __('New author name', 'wpsongbook'),
            'separate_items_with_commas' => __('Separate authors by commas', 'wpsongbook'),
            'add_or_remove_items' => __('Add or remove authors', 'wpsongbook'),
            'choose_from_most_used' => __('Choose from most used authors', 'wpsongbook'),
            'not_found' => __('No authors found', 'wpsongbook'),
            'menu_name' => __('Song authors', 'wpsongbook'),
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
            'name' => __('Genres', 'wpsongbook'),
            'singular_name' => __('Genre', 'wpsongbook'),
            'search_items' => __('Search genres', 'wpsongbook'),
            'popular_items' => __('Popular genres', 'wpsongbook'),
            'all_items' => __('All genres', 'wpsongbook'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit genre', 'wpsongbook'),
            'update_item' => __('Update genre', 'wpsongbook'),
            'add_new_item' => __('Add new genre', 'wpsongbook'),
            'new_item_name' => __('New genre name', 'wpsongbook'),
            'separate_items_with_commas' => __('Separate genres by commas', 'wpsongbook'),
            'add_or_remove_items' => __('Add or remove genres', 'wpsongbook'),
            'choose_from_most_used' => __('Choose from most used genres', 'wpsongbook'),
            'not_found' => __('No genres found', 'wpsongbook'),
            'menu_name' => __('Song genres', 'wpsongbook'),
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
            'name' => __('Albums', 'wpsongbook'),
            'singular_name' => __('Album', 'wpsongbook'),
            'search_items' => __('Search albums', 'wpsongbook'),
            'popular_items' => __('Popular albums', 'wpsongbook'),
            'all_items' => __('All albums', 'wpsongbook'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit album', 'wpsongbook'),
            'update_item' => __('Update album', 'wpsongbook'),
            'add_new_item' => __('Add new album', 'wpsongbook'),
            'new_item_name' => __('New album name', 'wpsongbook'),
            'separate_items_with_commas' => __('Separate albums by commas', 'wpsongbook'),
            'add_or_remove_items' => __('Add or remove albums', 'wpsongbook'),
            'choose_from_most_used' => __('Choose from most used albums', 'wpsongbook'),
            'not_found' => __('No albums found', 'wpsongbook'),
            'menu_name' => __('Song albums', 'wpsongbook'),
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
