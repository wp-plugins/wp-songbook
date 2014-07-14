<?php
function songbook_genretax(){
    $labels = array(
		'name'                       => __('Genres','wpsongbook'),
		'singular_name'              => __('Genre','wpsongbook'),
		'search_items'               => __('Search genres','wpsongbook'),
		'popular_items'              => __('Popular genres','wpsongbook'),
		'all_items'                  => __('All genres','wpsongbook'),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __('Edit genre','wpsongbook'),
		'update_item'                => __('Update genre','wpsongbook'),
		'add_new_item'               => __('Add new genre','wpsongbook'),
		'new_item_name'              => __('New genre name','wpsongbook'),
		'separate_items_with_commas' => __('Separate genres by commas','wpsongbook'),
		'add_or_remove_items'        => __('Add or remove genres','wpsongbook'),
		'choose_from_most_used'      => __('Choose from most used genres','wpsongbook'),
		'not_found'                  => __('No genres found','wpsongbook'),
		'menu_name'                  => __('Song genres','wpsongbook'),
	);
    $songbook_taxgenre_args=array(
                'labels'=>$labels,
                'show_tagcloud'=>FALSE,
                'show_admin_column'=>true
        );
    register_taxonomy('songgenre','song',$songbook_taxgenre_args);
}
add_action('init','songbook_genretax');
?>