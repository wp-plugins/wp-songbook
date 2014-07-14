<?php
function songbook_albumtax(){
    $labels = array(
		'name'                       => __('Albums','wpsongbook'),
		'singular_name'              => __('Album','wpsongbook'),
		'search_items'               => __('Search albums','wpsongbook'),
		'popular_items'              => __('Popular albums','wpsongbook'),
		'all_items'                  => __('All albums','wpsongbook'),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __('Edit album','wpsongbook'),
		'update_item'                => __('Update album','wpsongbook'),
		'add_new_item'               => __('Add new album','wpsongbook'),
		'new_item_name'              => __('New album name','wpsongbook'),
		'separate_items_with_commas' => __('Separate albums by commas','wpsongbook'),
		'add_or_remove_items'        => __('Add or remove albums','wpsongbook'),
		'choose_from_most_used'      => __('Choose from most used albums','wpsongbook'),
		'not_found'                  => __('No albums found','wpsongbook'),
		'menu_name'                  => __('Song albums','wpsongbook'),
	);
    $songbook_taxalbum_args=array(
                'labels'=>$labels,
                'show_tagcloud'=>FALSE,
                'show_admin_column'=>true
        );
    register_taxonomy('songalbum','song',$songbook_taxalbum_args);
}
add_action('init','songbook_albumtax');
?>