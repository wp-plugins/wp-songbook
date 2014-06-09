<?php
function songbook_dispfiles($songid){
    if(get_option('songbook_disp_filelistinsong')!='display'||!get_post_meta($songid,'songbook_filebox',true))return NULL;
//download file when _get download
    if($_GET['download']){
$filePath=parse_url(wp_get_attachment_url($_GET['download']),PHP_URL_PATH);
$fileName=pathinfo(wp_get_attachment_url($_GET['download']),PATHINFO_BASENAME);
$mimeType=str_replace('.','',pathinfo(parse_url(wp_get_attachment_url($_GET['download']),PHP_URL_PATH), PATHINFO_EXTENSION));
    $mimeTypes = array(
        'pdf' => 'application/pdf',
        'txt' => 'text/plain',
        'html' => 'text/html',
        'exe' => 'application/octet-stream',
        'zip' => 'application/zip',
        'doc' => 'application/msword',
        'xls' => 'application/vnd.ms-excel',
        'ppt' => 'application/vnd.ms-powerpoint',
        'gif' => 'image/gif',
        'png' => 'image/png',
        'jpeg' => 'image/jpg',
        'jpg' => 'image/jpg',
        'php' => 'text/plain'
    );

    //Send Headers
    header('Content-Type: ' . $mimeTypes[$mimeType]); 
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');
    header('Cache-Control: private');
    header('Pragma: private');
    //run it
    readfile($filePath);
}
    $postmeta=(is_array(get_post_meta($songid,'songbook_filebox',true)))?get_post_meta($songid,'songbook_filebox',true)[0]:get_post_meta($songid,'songbook_filebox',true);
    $songbook_fileval=(is_array(get_post_meta($songid,'songbook_filebox',true)))?$postmeta:get_post_meta($songid,'songbook_filebox',true);
    $sb_fileval_serialized=(unserialize($songbook_fileval));
    $songbook_filearr=($sb_fileval_serialized)?unserialize($songbook_fileval):explode(',',$songbook_fileval);
    if(!is_array($songbook_filearr))return false;
    else{
        $result='<div class="sb_songfiles" title="'.__('Linked files','wpsongbook').'">';
        $filesdisplayedcount=0;
    foreach(array_keys($songbook_filearr) as $file){
        if(is_int($file)&&$file!="N"){
        //get attachment to complete info, that wasnt added with file directly
        $attachment=get_post($file);
        //add values with conditions to variables
        $url=($songbook_filearr[$file]['url'])?$songbook_filearr[$file]['url']:wp_get_attachment_url($file);
        $lockedordisplay=($songbook_filearr[$file]['private']=='private')?current_user_can('read'):true;
        $title=($songbook_filearr[$file]['title'])?$songbook_filearr[$file]['title']:$attachment->post_title;
        $indent=($songbook_filearr[$file]['indent'])?$songbook_filearr[$file]['indent']:NULL;
        $extension=($songbook_filearr[$file]['extension'])?$songbook_filearr[$file]['extension']:str_replace('.','',pathinfo(parse_url($url,PHP_URL_PATH), PATHINFO_EXTENSION));
        //finaly add content
        if($lockedordisplay){
                $result.='<div class="file">';
                $result.='<span class="exticon '.$extension.'"></span>';
                $result.='<div class="maininfo">';
                $result.='<p class="filetitle">'.$title.'</p>';
                $result.='<p class="toolbar"><a href="'.$url.'" title="'.$title.'">'.__('Show','wpsongbook').'</a>';
//              $result.='<a href="?download='.$file.'">'.__('Download','wpsongbook').'</a>';
                $result.='</div>';
                $result.='</div>';
                $filesdisplayedcount++;
        }else{
            $protected=true;
        }
        }
    }
        if($protected)$result.=(!$protected)?'<div class="file">'.__('You must be logged to see these files','wpsongbook').'</div>':null;
        $result.='</div>';
    }
    if($filesdisplayedcount>0)return $result;
}

function songbook_contentfilter($songbook_toedit) {
    //if not post type song, end proccess
    if(is_search()||is_archive()||get_post_type()!=='song')return$songbook_toedit;
    //add backtolist link to content
    if(get_option('songbook_disp_backtolistinsong')=='display'&&get_option('songbook_shcdefs_listpageid')){
        $posturl=get_permalink(get_option('songbook_shcdefs_listpageid'));
        $songbook_backtolistlinklink='<a class="backtolist" href="'.$posturl.'" title="'.__('Go back to song list','wpsongbook').'">&lt;&lt;&nbsp;'.__('Go back to song list','wpsongbook').'</a>';
    }
if(get_the_term_list($post->post_id,'songauthor')){
   $songbook_curposttaxauthor=(get_option('songbook_disp_authorsinsong')=='display')?get_the_term_list($post->post_id,'songauthor',__('Author: ','wpsongbook').'&nbsp;',', '):'';
   $songbook_editedcontent='<p style="display:block;width:98%;margin:0px auto;padding:0px 1%;font-style:italic;color:gray;font-size:110%;border-bottom:1px dashed rgb(244,222,202);">'.$songbook_curposttaxauthor.'</p>';
}
if(songbook_dispfiles(get_the_ID())){
    $songbook_files_result=songbook_dispfiles(get_the_ID());
}
if(get_option('songbook_disp_lyrelement')){
    switch(get_option('songbook_disp_lyrelement')){
        case'div':
            $songbook_opening='<div class="wpsongbook_lyrics">';
            $songbook_closing='</div>';
        break;
        case'blockquote':
            $songbook_opening='<blockquote class="wpsongbook_lyrics">';
            $songbook_closing='</blockquote>';
        break;
        case'pre':
            $songbook_opening='<pre class="wpsongbook_lyrics">';
            $songbook_closing='</pre>';
        break;
        case'code':
            $songbook_opening='<code class="wpsongbook_lyrics">';
            $songbook_closing='</code>';
        break;
    }
}
if($songbook_backtolistlinklink||$songbook_toedit||$songbook_files_result||$songbook_editedcontent||($songbook_opening&&$songbook_closing))return $songbook_backtolistlinklink.$songbook_opening.$songbook_toedit.$songbook_closing.$songbook_files_result.$songbook_editedcontent;
else return $songbook_toedit;
}
function songbook_timeremover($songbook_timetoedit){
   if(get_post_type()=='song')return'';
   else return$songbook_timetoedit;
}