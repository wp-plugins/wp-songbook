<?php
function songbook_authortax(){
    $labels = array(
		'name'                       => __('Authors','wpsongbook'),
		'singular_name'              => __('Author','wpsongbook'),
		'search_items'               => __('Search authors','wpsongbook'),
		'popular_items'              => __('Popular authors','wpsongbook'),
		'all_items'                  => __('All authors','wpsongbook'),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __('Edit author','wpsongbook'),
		'update_item'                => __('Update author','wpsongbook'),
		'add_new_item'               => __('Add new author','wpsongbook'),
		'new_item_name'              => __('New author name','wpsongbook'),
		'separate_items_with_commas' => __('Separate authors by commas','wpsongbook'),
		'add_or_remove_items'        => __('Add or remove authors','wpsongbook'),
		'choose_from_most_used'      => __('Choose from most used authors','wpsongbook'),
		'not_found'                  => __('No authors found','wpsongbook'),
		'menu_name'                  => __('Song authors','wpsongbook'),
	);
    $songbook_taxauthor_args=array(
                'labels'=>$labels,
                'show_tagcloud'=>FALSE,
                'show_admin_column'=>true
        );
    register_taxonomy('songauthor','song',$songbook_taxauthor_args);
}
add_action('init','songbook_authortax');
?>