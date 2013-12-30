<?php
function songbook_contentfilter($songbook_toedit) {
    if(is_search()||is_archive()||get_post_type()!=='song')return$songbook_toedit;
    $songbook_mustbelogged=(get_option('songbook_disp_filelistforlogged')=='display')?is_user_logged_in():true;
    if(get_option('songbook_disp_filelistinsong')=='display'&&get_post_meta(get_the_ID(),'songbook_filebox',true)&&$songbook_mustbelogged){
    $songbook_files=explode(',',get_post_meta(get_the_ID(),'songbook_filebox',true));
    $songbook_files_result='<style type="text/css">
        .songbook_songfiles{margin:0px 2.5%;}
        .songbook_songfiles > tr:hover{background:rgba(70,70,70,0.6);}
        </style>
';
    if(count($songbook_files)>0)$songbook_files_result.='<table class="songbook_songfiles">';
    foreach ($songbook_files as $songbook_toicon_onefile){
                $songbook_files_result.='<tr>';
                $songbook_file_ext=pathinfo(wp_get_attachment_url($songbook_toicon_onefile),PATHINFO_EXTENSION);
                $songbook_file_url=wp_get_attachment_url($songbook_toicon_onefile);
                $songbook_file_basename=basename(get_attached_file($songbook_toicon_onefile));
                $songbook_icon_url=plugins_url().'/wp-songbook/img/exticons_32/'.$songbook_file_ext.'.png';
                $songbook_icon_img='<img style="margin:1px;float:left;width:18px;height:18px;" src="'.$songbook_icon_url.'" alt="*.'.$songbook_file_ext.' title="'.$songbook_file_basename.'/>';
                $songbook_attachment_meta=get_post($songbook_toicon_onefile);
                $songbook_file_title=($songbook_attachment_meta->post_excerpt!='')?$songbook_attachment_meta->post_excerpt:$songbook_file_basename;
                $songbook_files_result.='<td class="songbook_fileicon">'.$songbook_icon_img.'</td>';
                $songbook_files_result.='<td class="songbook_filename"><a href="'.$songbook_file_url.'" alt="'.$songbook_attachment_meta->post_excerpt.'">'.$songbook_file_title.'</a></td>';
                $songbook_files_result.='</tr>';
    }
    if(count($songbook_files)>0)$songbook_files_result.='</table>';
    }
    if(get_option('songbook_disp_authorsinsong')!='display')return $songbook_toedit;
if(get_the_term_list($post->post_id,'songauthor')){
   $songbook_curposttaxauthor=(get_option('songbook_disp_authorsinsong')=='display')?get_the_term_list($post->post_id,'songauthor',__('Authors: ','wpsongbook').'&nbsp;&nbsp;',', '):'';
   $songbook_editedcontent='<p style="display:block;width:98%;margin:0px auto;padding:0px 1%;font-style:italic;color:gray;font-size:110%;border-bottom:1px dashed rgb(244,222,202);">'.$songbook_curposttaxauthor.'</p>';
   return $songbook_toedit.$songbook_files_result.$songbook_editedcontent;
} else {
   return $songbook_toedit;
}
}
function songbook_timeremover($songbook_timetoedit){
   if(get_post_type()=='song')return'';
   else return$songbook_timetoedit;
}
?>