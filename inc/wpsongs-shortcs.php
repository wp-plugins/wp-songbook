<?php
function songbook_pluginlistshc($songbook_toedit){
    if(get_the_ID()!=get_option('songbook_shcdefs_listpageid'))return$songbook_toedit;
    $songbooklist_result=(get_option('songbook_shcdefs_showintext'))?$songbook_toedit:'';
$songbook_listshquery=array(
	   	'post_type'=>'song',
                'nopaging'=>true,
                'orderby'=>(get_option('songbook_shcdefs_orderby'))?get_option('songbook_shcdefs_orderby'):'title',
                'order'=>(get_option('songbook_shcdefs_order'))?get_option('songbook_shcdefs_order'):'desc',
	   	'posts_per_page'=>-1
	);
	query_posts($songbook_listshquery);
        if(have_posts()){ $songbooklist_result=
'<style type="text/css">
    .songbook_songlist{
        width:97%;
        margin:5px auto;
        border-spacing:0px;
        border-collapse:collapse;
    }
    .songbook_songlist tr:hover{
        background:rgba(239, 239, 239,0.5);
    }
    .songbook_songlist>tbody>tr>.songbook_songlist_onesong_info{
        width:70%;
    }
</style>';
    $songbooklist_result.='<table class="songbook_songlist">';
	while ( have_posts()):the_post();
            $songbooklist_result.='<tr>';
            $songbooklist_result.='<td class="songbook_songlist_onesong_info">';
            $songbook_songauthors=(get_option('songbook_disp_authorsinshc'))?'<span>('.strip_tags(get_the_term_list($post->post_id,'songauthor','',', ')).')</span>':'';
            $songbook_value=(get_option('songbook_disp_filelistinshc')=='display')?get_post_meta(get_the_ID(),'songbook_filebox',true):false;
            $songbook_files=(ereg('^[0-9]*,.*[^,]$',$songbook_value[0]))?explode(',',$songbook_value):$songbook_value;
            $songbooklist_result.='<a href="'.get_permalink().'" alt="'.__('Display whole song','wpsongbook').'">'.get_the_title().'</a>';
            if($songbook_songauthors)$songbooklist_result.='&nbsp;'.$songbook_songauthors;
            $songbooklist_result.='</td>';
            if((is_user_logged_in()&&$songbook_files)||(get_option('songbook_disp_videolinkinshc')=='display'&&get_post_meta(get_the_ID(),'songbook_video_link',true))){
            $songbooklist_result.='<td>';
            $songbooklist_result.=(get_option('songbook_disp_videolinkinshc')=='display'&&get_post_meta(get_the_ID(),'songbook_video_link',true))?'<a href="'.get_post_meta(get_the_ID(),'songbook_video_link',true).'" title="'.songbook_getpagetitle(get_post_meta(get_the_ID(),'songbook_video_link',true)).'">'.'<img style="margin:1px;float:left;width:20px;height:20px;" src="'.plugins_url().'/wp-songbook/img/exticons_32/youtube.png'.'"/>'.'</a>':false;
            if(is_array($songbook_files)){
            foreach ($songbook_files as $songbook_toicon_onefile){
                $songbook_file_ext=pathinfo(wp_get_attachment_url($songbook_toicon_onefile),PATHINFO_EXTENSION);
                $songbook_file_url=wp_get_attachment_url($songbook_toicon_onefile);
                $songbook_file_basename=basename(get_attached_file($songbook_toicon_onefile));
                $songbook_icon_url=plugins_url().'/wp-songbook/img/exticons_32/'.$songbook_file_ext.'.png';
                $songbook_icon_img='<img style="margin:1px;float:left;width:20px;height:20px;" src="'.$songbook_icon_url.'" alt="'.$songbook_file_basename.' title="'.$songbook_file_basename.'/>';
                if($songbook_toicon_onefile)$songbooklist_result.='<a href="'.$songbook_file_url.'" alt="'.$songbook_file_basename.'">'.$songbook_icon_img.'</a>';
            }
            }else{
                $songbook_file_ext=pathinfo(wp_get_attachment_url($songbook_files),PATHINFO_EXTENSION);
                $songbook_file_url=wp_get_attachment_url($songbook_files);
                $songbook_file_basename=basename(get_attached_file($songbook_files));
                $songbook_icon_url=plugins_url().'/wp-songbook/img/exticons_32/'.$songbook_file_ext.'.png';
                $songbook_icon_img='<img style="margin:1px;float:left;width:20px;height:20px;" src="'.$songbook_icon_url.'" alt="'.$songbook_file_basename.' title="'.$songbook_file_basename.'/>';
                if($songbook_files)$songbooklist_result.='<a href="'.$songbook_file_url.'" alt="'.$songbook_file_basename.'">'.$songbook_icon_img.'</a>';
            }
            }
            $songbooklist_result.='</td>';
            $songbooklist_result.='</tr>';
        endwhile;
        $songbooklist_result.='</table>';
        wp_reset_query();
        }
        if($songbooklist_result)return$songbooklist_result;
}
?>