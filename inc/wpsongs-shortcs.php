<?php
function songbook_objectToArray($d) {
  if(is_object($d)) {
    $d = get_object_vars($d);
  }
  if(is_array($d)) {
    return array_map(__FUNCTION__, $d); // recursive
  } else {
    return $d;
  }
}

function songbook_pluginlistshc($songbook_toedit) {
    if (get_the_ID() != get_option('songbook_shcdefs_listpageid'))
        return$songbook_toedit;
    $songbooklist_result = (get_option('songbook_shcdefs_showintext') == 'display') ? $songbook_toedit : '';

    $orderby = $_GET['orderby'];
    $authorsongs = $_GET['author'];

    if($_GET['authors']){
    $allauthors=songbook_objectToArray(get_terms('songauthor'));
    $i=0;
    
    $sb_authorsdialog='<div id="authors">';
    while($i<=count($allauthors)){
        $slug=$allauthors[$i]['slug'];
        $name=$allauthors[$i]['name'];
        $url_songlist=get_permalink(get_option('songbook_shcdefs_listpageid'));
        $url=$url_songlist.'?author='.$slug;
        
        $sb_authorsdialog.='<a class="sauthor" href="'.$url.'" title="'.__('View all songs of').$name.'">'.$name.'</a>';
        $i++;
    }
    $sb_authorsdialog.='<a id="backtosongs" href="'.$url_songlist.'" title="'.__('Go back to song list','wpsongbook').'">'.__('Go back','wpsongbook').'<a/>';
    $sb_authorsdialog.='</div>';

    return $sb_authorsdialog;
    }

    $songbook_listshquery = array(
        'post_type' => 'song',
        'nopaging' => true,
        'orderby' => (get_option('songbook_shcdefs_orderby')) ? get_option('songbook_shcdefs_orderby') : 'title',
        'order' => (get_option('songbook_shcdefs_order')) ? get_option('songbook_shcdefs_order') : 'desc',
        'posts_per_page' => -1,
        'tax_query' => (!empty($authorsongs)) ? array(
            array(
                'taxonomy' => 'songauthor',
                'field' => 'slug',
                'terms' => $authorsongs
            )
                ) : FALSE
    );
        //get all songs
    query_posts($songbook_listshquery);
    if (have_posts()) {

        $songbooklist_result.='<table class="songbook_songlist">';
        //thead
        $songbooklist_result.=(get_option('songbook_shcdefs_dispthead')==='display')?'<tr class="thead"><td>' . __('Song title', 'wpsongbook').'</td>':null;
        $songbooklist_result.=(get_option('songbook_shcdefs_dispthead')==='display'&&get_option('songbook_disp_authorsinshc')==='display')?'<td>'.__('Author','wpsongbook').'</td>':null;
        $songbooklist_result.=(get_option('songbook_shcdefs_dispthead')==='display'&&get_option('songbook_shcdefs_dispalbum')==='display')?'<td>'.__('Album','wpsongbook').'</td>':null;
        $songbooklist_result.=(get_option('songbook_shcdefs_dispthead')==='display'&&get_option('songbook_shcdefs_dispgenre')==='display')?'<td>'.__('Genre','wpsongbook').'</td>':null;
        $songbooklist_result.=(get_option('songbook_shcdefs_dispthead')==='display'&&get_option('songbook_shcdefs_dispyear')==='display')?'<td>'.__('Year','wpsongbook').'</td>':null;
        $songbooklist_result.=(get_option('songbook_shcdefs_dispthead')==='display'&&get_option('songbook_shcdefs_dispauthslink')==='display')?'<a title="'.__('Show list of all authors','wpsongbook').'" id="opendialog" href="'.get_permalink(get_option('songbook_shcdefs_listpageid')).'?authors=1">'.__('Show all authors','wpsongbook').'</a>':null;
        $songbooklist_result.=(get_option('songbook_shcdefs_dispthead')==='display')?'</tr>':NULL;
        //songs
        while (have_posts()):the_post();
            $songbooklist_result.='<tr>';
            
            $song_url=get_permalink();
            $song_songauthors=(get_option('songbook_disp_authorsinshc')==='display'&&get_the_term_list($post->post_id,'songauthor','',','))?get_the_term_list($post->post_id,'songauthor','',','):'&nbsp';
            $song_songalbum=(get_option('songbook_shcdefs_dispalbum')==='display'&&get_the_term_list($post->post_id,'songalbum','',','))?get_the_term_list($post->post_id,'songalbum','',','):'&nbsp';
            $song_songgenre=(get_option('songbook_shcdefs_dispgenre')==='display'&&get_the_term_list($post->post_id,'songgenre','',','))?get_the_term_list($post->post_id,'songgenre','',','):'&nbsp';
            $song_fileicos=(get_option('songbook_disp_videolinkinshc')==='display' && get_post_meta(get_the_ID(), 'songbook_video_link', true)) ? '<a href="' . get_post_meta(get_the_ID(), 'songbook_video_link', true) . '" title="' . songbook_getpagetitle(get_post_meta(get_the_ID(), 'songbook_video_link', true)) . '">' . '<img style="margin:1px;float:left;width:20px;height:20px;" src="' . plugins_url() . '/wp-songbook/img/video.ico' . '"/>' . '</a>' :'&nbsp';
            $song_year=(get_option('songbook_shcdefs_dispyear')==='display')?get_the_time('Y'):'&nbsp';
            
            $songbooklist_result.='<td class="songbook_songname"><a href="' . $song_url . '" alt="' . __('Display whole song', 'wpsongbook') . '">' . get_the_title() . '</a></td>';
            $songbooklist_result.=(get_option('songbook_disp_authorsinshc')==='display'&&get_the_term_list($post->post_id,'songauthor','',','))?'<td class="songbook_songauthor">'.$song_songauthors.'</td>':null;
            $songbooklist_result.=(get_option('songbook_shcdefs_dispalbum')==='display'&&get_the_term_list($post->post_id,'songalbum','',','))?'<td>'.$song_songalbum.'</td>':null;
            $songbooklist_result.=(get_option('songbook_shcdefs_dispyear')==='display')?'<td>'.$song_year.'</td>':null;
            $songbooklist_result.=(get_option('songbook_shcdefs_dispgenre')==='display'&&get_the_term_list($post->post_id,'songgenre','',','))?'<td>'.$song_songgenre.'</td>':null;
            
            $songbooklist_result.='</tr>';
        endwhile;
        //table end
        $songbooklist_result.='</table>';
        //reset query
        wp_reset_query();
    }
        //return result
    if ($songbooklist_result)
        return$songbooklist_result;
}

?>