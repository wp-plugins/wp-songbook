<?php
function songbook_add_metabox_aditionals(){
        if((get_option('songbook_enable_setvideolink')!='enable')||(!current_user_can(get_option('songbook_mincap_addvideolink'))))return;
        add_meta_box('songbook_songinfo',__('Another song properties','wpsongbook'),'songbook_metabox_aditionals','song','side','default');
}
function songbook_metabox_aditionals(){
    global $post;
    if(get_option('songbook_enable_setvideolink')=='enable'&&current_user_can(get_option('songbook_mincap_addvideolink')))$songbook_forms_set_values['songbook_video_link']=get_post_meta($post->ID,'songbook_video_link',true);
echo'<div class="songbook_aditional_meta">';
echo'<input type="hidden" name="songbook_aditionals_noncename" id="songbook_noncename" value="'.wp_create_nonce(plugin_basename(__FILE__) ).'"/>';

if(get_option('songbook_enable_setvideolink')=='enable'&&current_user_can(get_option('songbook_mincap_addvideolink')))echo'<label for="songbook_video_link">'.__('Video link:','wpsongbook').'</label>
<input type="text" value="'.$songbook_forms_set_values['songbook_video_link'].'" name="songbook_video_link" id="songbook_video_link"/>
</div>'; else echo'hovno';
}
function songbook_save_aditionals($songbook_postid){
    $verifyonce=(isset($_POST['songbook_aditionals_noncename']))?$_POST['songbook_aditionals_noncename']:false;
    
    if(!wp_verify_nonce($verifyonce,plugin_basename(__FILE__)))return;
    if(defined('DOING_AUTOSAVE')&&DOING_AUTOSAVE)return;
    if(!current_user_can(get_option('songbook_mincap_addvideolink')))return;
    $songbook_mbox_resulttosave['songbook_video_link']=$_POST['songbook_video_link'];
    update_post_meta($songbook_postid,'songbook_video_link',$songbook_mbox_resulttosave['songbook_video_link']);
}