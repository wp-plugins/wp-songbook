<?php
function songbook_pluginlistshc($songbook_toedit){
    if(get_the_ID()!=get_option('songbook_shcdefs_listpageid'))return$songbook_toedit;
    $songbooklist_result=(get_option('songbook_shcdefs_showintext')=='display')?$songbook_toedit:'';
$songbook_listshquery=array(
	   	'post_type'=>'song',
                'nopaging'=>true,
                'orderby'=>(get_option('songbook_shcdefs_orderby'))?get_option('songbook_shcdefs_orderby'):'title',
                'order'=>(get_option('songbook_shcdefs_order'))?get_option('songbook_shcdefs_order'):'desc',
	   	'posts_per_page'=>-1
	);
	query_posts($songbook_listshquery);
        if(have_posts()){
    $songbooklist_result.='<table class="songbook_songlist">';
	while ( have_posts()):the_post();
            $songbooklist_result.='<tr>';
            $songbooklist_result.='<td class="songbook_songlist_onesong_info">';
            $songbook_songauthors=(get_option('songbook_disp_authorsinshc')&&get_the_term_list($post->post_id,'songauthor','',', '))?'<span>('.strip_tags(get_the_term_list($post->post_id,'songauthor','',', ')).')</span>':'';
            $songbooklist_result.='<a href="'.get_permalink().'" alt="'.__('Display whole song','wpsongbook').'">'.get_the_title().'</a>';
            if($songbook_songauthors)$songbooklist_result.='&nbsp;'.$songbook_songauthors;
            $songbooklist_result.='</td>';
            $songbooklist_result.='<td>';
            $songbooklist_result.=(get_option('songbook_disp_videolinkinshc')=='display'&&get_post_meta(get_the_ID(),'songbook_video_link',true))?'<a href="'.get_post_meta(get_the_ID(),'songbook_video_link',true).'" title="'.songbook_getpagetitle(get_post_meta(get_the_ID(),'songbook_video_link',true)).'">'.'<img style="margin:1px;float:left;width:20px;height:20px;" src="'.plugins_url().'/wp-songbook/img/video.ico'.'"/>'.'</a>':false;
            $songbooklist_result.='</td>';
            $songbooklist_result.='</tr>';
        endwhile;
        $songbooklist_result.='</table>';
        wp_reset_query();
        }
        if($songbooklist_result)return$songbooklist_result;
}
?>