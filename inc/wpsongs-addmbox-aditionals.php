<?php
function songbook_add_metabox_aditionals(){
        if((get_option('songbook_enable_setbpm')!='enable'&&get_option('songbook_enable_setvideolink')!='enable')||(!current_user_can(get_option('songbook_mincap_addvideolink'))&&!current_user_can(get_option('songbook_mincap_addtempo'))))return get_option('songbook_enable_setbpm').get_option('songbook_enable_setvideolink');
        add_meta_box('songbook_songinfo',__('Another song properties','wpsongbook'),'songbook_metabox_aditionals','song','side','default');
}
function songbook_metabox_aditionals(){
    global $post;
    if(get_option('songbook_enable_setbpm')=='enable'&&current_user_can(get_option('songbook_mincap_addtempo')))$songbook_forms_set_values['songbook_tempo_meta']=(get_post_meta($post->ID,'songbook_tempo_meta',true))?get_post_meta($post->ID,'songbook_tempo_meta',true):'85';
    if(get_option('songbook_enable_setvideolink')=='enable'&&current_user_can(get_option('songbook_mincap_addvideolink')))$songbook_forms_set_values['songbook_video_link']=get_post_meta($post->ID,'songbook_video_link',true);
echo'<div class="songbook_aditional_meta">';
echo'<input type="hidden" name="songbook_aditionals_noncename" id="songbook_noncename" value="'.wp_create_nonce(plugin_basename(__FILE__) ).'"/>';
if(get_option('songbook_enable_setbpm')=='enable'&&current_user_can(get_option('songbook_mincap_addtempo')))echo'<label for="songbook_tempo_meta">'.__('Song tempo (BPM):','wpsongbook').'</label>
<input type="number" value="'.$songbook_forms_set_values['songbook_tempo_meta'].'" name="songbook_tempo_meta" id="songbook_tempo_meta"/><br/>';
if(get_option('songbook_enable_setvideolink')=='enable'&&current_user_can(get_option('songbook_mincap_addvideolink')))echo'<label for="songbook_video_link">'.__('Video link:','wpsongbook').'</label>
<input type="text" value="'.$songbook_forms_set_values['songbook_video_link'].'" name="songbook_video_link" id="songbook_video_link"/>
</div>';
}
function songbook_save_aditionals($songbook_postid){
    if(!wp_verify_nonce($_POST['songbook_aditionals_noncename'],plugin_basename(__FILE__)))return$songbook_postid;
    if(defined('DOING_AUTOSAVE')&&DOING_AUTOSAVE)return$songbook_postid;
    if(!current_user_can(get_option('songbook_mincap_addtempo'))||!current_user_can(get_option('songbook_mincap_addvideolink')))return$songbook_postid;
    $songbook_mbox_resulttosave['songbook_tempo_meta']=$_POST['songbook_tempo_meta'];
    $songbook_mbox_resulttosave['songbook_video_link']=$_POST['songbook_video_link'];
    update_post_meta($songbook_postid,'songbook_tempo_meta',$songbook_mbox_resulttosave['songbook_tempo_meta']);
    update_post_meta($songbook_postid,'songbook_video_link',$songbook_mbox_resulttosave['songbook_video_link']);
}