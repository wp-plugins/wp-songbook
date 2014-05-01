<?php
function songbook_cptbase() {
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
    'menu_icon'=>(get_bloginfo('version')<3.8)?plugins_url('../img/menu_black.png',__FILE__):plugins_url('../img/menu_white.png',__FILE__),
    'has_archive'=>true,
    'hierarchical'=>false,
    'menu_position'=>10,
    'supports'=>array('title','editor')
  );
  register_post_type( 'song', $args );
}
function songbook_cptremoveboxes() {
 remove_meta_box('postexcerpt','song','normal'); //removes comments status
 remove_meta_box('postimagediv','song','normal'); //removes comments
 remove_meta_box('authordiv','song','normal'); //removes author 
}
function songbook_remove_cpt_onroles() {
    if( !current_user_can('edit_posts') ){
      remove_menu_page('edit.php?post_type=song');
    }
}
?>