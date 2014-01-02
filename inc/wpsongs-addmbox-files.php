<?php
function songbook_add_metabox_linkfile(){
    if(get_option('songbook_enable_filelinking')!='enable'||!current_user_can(get_option('songbook_mincap_addfiles')))return get_option('songbook_enable_filelinking');
        add_meta_box('songbook_files',__('Link files','wpsongbook'),'songbook_metabox_files','song','side','default');
}
function songbook_metabox_files(){
        global $post;
    echo'<div class="uploader">
<input class="button" id="addfile_button" value="'.__('Add files','wpsongbook').'" />
</div>';
    echo'<div id="obal">';
        echo'<input type="hidden" name="songbook_filebox_noncename" id="songbook_noncename" value="'.wp_create_nonce(plugin_basename(__FILE__)).'"/>';
        $songbook_value=get_post_meta($post->ID,'songbook_filebox',true);
        $songbook_metaboxcontent=(ereg('^[0-9]*,.*[^,]$',$songbook_value[0]))?explode(',',$songbook_value):$songbook_value;
        if(!empty($songbook_metaboxcontent)&&is_array($songbook_metaboxcontent)){
        foreach($songbook_metaboxcontent as $songbook_metaboxonefile){
            $songbook_removelink=(current_user_can('edit_post'))?'<a class="removeele" onclick="removefile(\'post_'.$songbook_metaboxonefile.'\');">X</a>':'$nbsp;$nbsp;';
           if(get_attached_file($songbook_metaboxonefile))echo'<p class="onefile" id="post_'.$songbook_metaboxonefile.'"><input type="hidden" name="songbook_attachedfiles[]" value="'.$songbook_metaboxonefile.'">'.$songbook_removelink.'&nbsp;&nbsp;<a href="'.wp_get_attachment_url($songbook_metaboxonefile).'" target="_blank">'.basename(get_attached_file($songbook_metaboxonefile)).'</a></p>';
        }
        }elseif(!empty($songbook_metaboxcontent)&&!is_array($songbook_metaboxcontent)){
            echo'<p class="filemetabox_warn">'.__('No files found attached to this post. You should add anything first. You can choose more files when you hold CTRL','wpsongbook').'</p>';
        }
        echo'</div>';
}
function songbook_save_filemetabox($songbook_postid){
    if(!wp_verify_nonce($_POST['songbook_filebox_noncename'],plugin_basename(__FILE__))||!current_user_can('edit_post'))return$songbook_postid;
    if(defined('DOING_AUTOSAVE')&&DOING_AUTOSAVE)return$songbook_postid;
        $songbook_savevalue_unique=array_unique($_POST['songbook_attachedfiles']);
        $songbook_savevalue=(count($songbook_savevalue_unique)>1)?implode(',',$songbook_savevalue_unique):$songbook_savevalue_unique;
        update_post_meta($songbook_postid,'songbook_filebox',$songbook_savevalue);
}