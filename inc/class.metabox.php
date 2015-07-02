<?php

class songbook_metabox extends songbook_functions {

    function songbook_metabox() {
        add_action('add_meta_boxes', array($this, 'register_metabox'));
        add_action('save_post', array($this, 'savesongmeta'));
        
        if ($this->option('enable_playlists') === 'enable')add_action('save_post', array($this, 'save_playlist'));
    }

    function register_metabox() {
        add_meta_box('songbook_details', __('Song details', WPSB_LANGDOM), array($this, 'song_metabox_content'), 'song', 'side', 'default');
        if ($this->option('enable_playlists') === 'enable')add_meta_box('playlist_content', __('Playlist', WPSB_LANGDOM), array($this, 'playlist_content'), 'playlist', 'normal', 'high');
    }

    function song_metabox_content() {
        global $post;
        echo'<div id="song_meta">';
        
        echo '<input type="hidden" name="songbook[nonce]" id="noncefield" value="'.wp_create_nonce(plugin_basename(__FILE__)).'"/>';

        $files['info']=__('Details',WPSB_LANGDOM);
        if($this->option('enable_filelinking')==='enable')$files['files']= __('Files', WPSB_LANGDOM);
        if($this->option('enable_setvideolink')==='enable')$files['videos']= __('Videos', WPSB_LANGDOM);
        if($this->option('enable_playlists')==='enable')$files['playlists']=__('Playlists',WPSB_LANGDOM);
        
        $keys = array_keys($files);
        echo'<div class="nav">';
        foreach ($keys as $key) {
            echo $this->add_element('span', array('class' => 'tablink', 'id' => $key), true, $files[$key]);
        }
        echo'</div>';
        unset($files);

        foreach ($keys as $key) {
            echo"<div class=\"section\" id=\"$key\">";
            include_once 'metabox/' . $key . '.php';
            echo'</div>';
        }
        echo'</div>';
    }

    function savesongmeta() {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)return;
        if(!isset($_POST['songbook']))return;
        $data=$_POST['songbook'];
        
        if(!wp_verify_nonce($data['nonce'],plugin_basename(__FILE__)))return;
        
        foreach(array_keys($data) as $item){
            update_post_meta(get_the_ID(),$item,$data[$item]);
        }
        
    }
    
    function playlist_content(){
        echo'Ahoj';
        
        $data=get_the_content();
        
    }
    
    function save_playlist(){
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;
        
        
        
    }

}

$wpsb_metabox = new songbook_metabox();
