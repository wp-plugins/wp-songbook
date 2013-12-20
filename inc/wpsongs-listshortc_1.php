<?php
//seznam příspěvků/odkaz na výstup + info o písni (v parametrech)
function songbook_shc(){
$songbook_listshquery=array(
	   	'post_type'=>'song',
                'nopaging'=>true,
                'orderby'=>'title',
                'order'=>'asc',
	   	'posts_per_page'=>-1
	);
	query_posts($songbook_listshquery);
        if(have_posts()): ?>
<style type="text/css">
   .songbook_songlist{
      display:block;
      width:98%;
      margin:10px auto;
      padding:0px;
   }
   .songbook_songlist .songbook_songlist_onesong{
      display:block;
      width:100%;
      padding:4px 1.5%;
      margin:0px;
   }
   .songbook_songlist .songbook_songlist_onesong a{
      color:#0f265e;
      font-size:103%;
      text-decoration:underline;
   }
   .songbook_songlist .songbook_songlist_onesong a:hover{
      color:#183d96;
   }
   .songbook_songlist .songbook_songlist_onesong span>a{
      text-decoration:none;
   }
   .songbook_songlist .songbook_songlist_onesong .songbook_songlist_onesong_infodiv{
      display:block;
      margin:0px;
      padding:0px;
   }
   .songbook_songlist .songbook_songlist_onesong .songbook_songlist_onesong_extenddiv{
      width:99%;
      display:none;
      margin:0px 0.2%;
      padding:2px 0.5%;
   }
   .songbook_songlist .songbook_songlist_onesong .songbook_songlist_onesong_extenddiv img{
      display:block;
      padding:1px;
      border:1px dashed black;
   }
</style>
<?php
            echo'<div class="songbook_songlist">';
            $songbook_evenoddnum=0;
	while ( have_posts()):the_post();
            $songbook_even=($songbook_evenoddnum%2==0)?' style="background:#EEEEEE;"':'';
            $songbook_songauthors='<span>('.strip_tags(get_the_term_list($post->post_id,'songauthor','',', ')).')</span>';
            echo'<div class="songbook_songlist_onesong"'.$songbook_even.'>';
            echo'<div class="songbook_songlist_onesong_infodiv"><a href="'.get_permalink().'" alt="'.__('Display whole song','wpsongbook').'">';
            the_title();
            echo'</a>';
            if(get_the_term_list($post->post_id,'songauthor'))echo'&nbsp;&nbsp;&nbsp;&nbsp;'.$songbook_songauthors;
            echo'</div></div>';
            $songbook_evenoddnum++;
        endwhile;
        echo'</div>';
        wp_reset_query();
        endif;
}
add_shortcode('songbook','songbook_shc');
?>