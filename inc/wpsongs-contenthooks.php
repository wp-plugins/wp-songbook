<?php
function songbook_contentfilter($songbook_toedit) {
    if(get_option('songbook_disp_authorsinsong')!='display')return $songbook_toedit;
if((get_post_type()=='song'&&is_single())||get_the_term_list($post->post_id,'songauthor')){
   $songbook_curposttaxauthor=get_the_term_list($post->post_id,'songauthor',__('Authors: ','wpsongbook').'&nbsp;&nbsp;',', ');
   $songbook_editedcontent='<p style="display:block;width:98%;margin:0px auto;padding:0px 1%;font-style:italic;color:gray;font-size:110%;border-bottom:1px dashed rgb(244,222,202);">'.$songbook_curposttaxauthor.'</p>';
   return $songbook_toedit.$songbook_editedcontent;
} else {
   return $songbook_toedit;
}
}
function songbook_timeremover($songbook_timetoedit){
   if(get_post_type()=='song')return'';
   else return$songbook_timetoedit;
   //datum vzniku písně nebo nic
}
add_filter('the_content','songbook_contentfilter');
add_filter('the_time','songbook_timeremover');
add_filter('the_date','songbook_timeremover');
?>