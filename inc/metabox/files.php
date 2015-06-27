<div class="tab" id="songfiles">
<div class="uploader">
<div class="button" id="songbook_addfile_button"><?php _e('Add files','wpsongbook') ?></div>
<input type="hidden" name="songbook_filebox_noncename" id="songbook_noncename" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)) ?>"/>
</div>
<div id="obal">
    <?php
        $songbook_value=(get_post_meta($post->ID,'songbook_filebox',true)!=="N")?get_post_meta($post->ID,'songbook_filebox',true):false;
        $songbook_array=(is_array($songbook_value))?$songbook_value[0]:$songbook_value;
        $value=(unserialize($songbook_array))?unserialize($songbook_array):explode(',',$songbook_array);
        if(is_array($value)){
            
        foreach(array_keys($value) as $file){
            if(is_int($file)&&wp_get_attachment_url($file)){
            $attachment=get_post($file);
            $title=($value[$file]['title'])?$value[$file]['title']:$attachment->post_title;
            $lockclass=($value[$file]['private']=='private')?'locked':'unlocked';
            $url=(isset($value[$file]['url']))?$value[$file]['url']:wp_get_attachment_url($file);
?>            
<div class="file" id="file_<?php echo $file; ?>">
    <span class="exticon <?php echo ($value[$file]['extension'])?$value[$file]['extension']:''; ?>">
    </span>
    <div class="maininfo">
        <p class="filetitle"><a id="href_<?php echo $file; ?>" href="<?php echo $value[$file]['url']; ?>" target="_blank"><?php echo $title; ?></a></p>
        <input type="hidden" id="fileid" name="fileid[]" value="<?php echo $file; ?>"/>
        <input type="hidden" id="private_<?php echo $file; ?>" name="private_<?php echo $file; ?>" value="<?php echo $value[$file]['private']; ?>"/>
        <input type="hidden" id="url_<?php echo $file; ?>" name="url_<?php echo $file; ?>" value="<?php echo $value[$file]['url']; ?>"/>
        <input type="hidden" id="level_<?php echo $file; ?>" name="level_<?php echo $file; ?>" value="<?php echo $value[$file]['indent']; ?>"/>
        <input type="hidden" id="fileext_<?php echo $file; ?>" name="fileext_<?php echo $file; ?>" value="<?php echo $value[$file]['extension']; ?>"/>
        <input type="hidden" id="title_<?php echo $file; ?>" name="title_<?php echo $file; ?>" value="<?php echo $value[$file]['title']; ?>"/>
        <p class="toolbar">
            <span class="toolspan">
                <a class="textch" rel="<?php echo $file; ?>"></a>
                <a class="lock <?php echo $lockclass ?>" rel="<?php echo $file; ?>"></a>
                <a class="remover" rel="<?php echo $file; ?>"></a>
            </span>
        </p>
    </div>
</div>
<?php
        }}
        }else{
            echo'<div id="nofile">'.__('No file linked with this song. You have to link some first, to see it here. Simply click one of the buttons above :)','wpsongbook').'</div>';
        }


    
        echo'</div>';
        echo'</div>';