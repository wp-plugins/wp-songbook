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
        $songbook_metaboxcontent=explode(',',$songbook_value);
        if(!empty($songbook_value)){
        foreach($songbook_metaboxcontent as $songbook_metaboxonefile){
            $songbook_removelink=(current_user_can('edit_post'))?'<a class="removeele" onclick="removefile(\'post_'.$songbook_metaboxonefile.'\');">X</a>':'$nbsp;$nbsp;';
           echo'<p class="onefile" id="post_'.$songbook_metaboxonefile.'"><input type="hidden" name="songbook_attachedfiles[]" value="'.$songbook_metaboxonefile.'">'.$songbook_removelink.'&nbsp;&nbsp;<a href="'.wp_get_attachment_url($songbook_metaboxonefile).'" target="_blank">'.basename(get_attached_file($songbook_metaboxonefile)).'</a></p>';
        }
        }else{
            echo'<p class="filemetabox_warn">'.__('No files found attached to this post. You should add anything first. You can choose more files when you hold CTRL','wpsongbook').'</p>';
        }
        echo'</div>';
}
function songbook_enqueue_admin_scr(){
    wp_enqueue_media();
    wp_enqueue_style('mediaman_style',plugins_url().'/wp-songbook/css/mediastyle.css');
    wp_enqueue_script('mediaman_script',plugins_url().'/wp-songbook/js/mediascript.js');
    $songbook_filescript_translation=array(
        'unlink_confirm'=>__('Really unlink from song?','wpsongbook'),
        'choosefiles'=>__('Choose files to link','wpsongbook'),
        'selectfiles_butt'=>__('Link files','wpsongbook'),
        'removefile'=>__('Remove file','wpsongbook')
        );
    wp_localize_script('mediaman_script','songbook_filescr_translation',$songbook_filescript_translation);
}
function songbook_save_filemetabox($songbook_postid){
    if(!wp_verify_nonce($_POST['songbook_filebox_noncename'],plugin_basename(__FILE__))||!current_user_can('edit_post'))return$songbook_postid;
    if(defined('DOING_AUTOSAVE')&&DOING_AUTOSAVE)return$songbook_postid;
        $songbook_savevalue_unique=array_unique($_POST['songbook_attachedfiles']);
        $songbook_savevalue=implode(',',$songbook_savevalue_unique);
        if($songbook_savevalue)update_post_meta($songbook_postid,'songbook_filebox',$songbook_savevalue);
}