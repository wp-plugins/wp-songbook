<?php
if(!defined('WP_UNINSTALL_PLUGIN'))exit();
$songbook_optstorem=array(
        'songbook_version',
        'songbook_enable_filelinking',
        'songbook_enable_setbpm',
        'songbook_enable_setvideolink',
        'songbook_enable_authorstax',
        'songbook_enable_widget',
        'songbook_enable_shortcode',
        'songbook_mincap_workwithsongs',
        'songbook_mincap_addfiles',
        'songbook_mincap_addvideolink',
        'songbook_mincap_addtempo',
        'songbook_mincap_manauthors',
        'songbook_disp_filelistinshc',
        'songbook_disp_filelistinsong',
        'songbook_disp_authorsinshc',
        'songbook_disp_authorsinsong',
        'songbook_shcdefs_orderby',
        'songbook_shcdefs_order'
);
foreach($songbook_optstorem as $songbook_opttorem){
    delete_option($songbook_opttorem);
}
$songbook_posts=get_posts(array(
	'post_type' =>'song'
));
$songbook_taxons=get_terms('songauthor');
if (is_array($songbook_posts)) {
   foreach ($songbook_posts as $post) {
       wp_delete_post($post->ID,true);
   }
}
if (is_array($songbook_taxons)) {
   foreach ($songbook_posts as $tax) {
       wp_delete_term($tax->term_id,'songauthor');
   }
}