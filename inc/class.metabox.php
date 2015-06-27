<?php

class songbook_metabox extends songbook_functions {

    function songbook_metabox() {
        add_action('add_meta_boxes', array($this, 'register_metabox'));
        add_action('save_post', array($this, 'savemeta'));
    }

    function register_metabox() {
        if ($this->option('enable_filelinking') !== 'enable' || !current_user_can($this->option('mincap_addfiles')))
            return;
        add_meta_box('songbook_details', __('Song details', 'wpsongbook'), array($this, 'metabox_content'), 'song', 'side', 'default');
    }

    function metabox_content() {
        global $post;
        echo'<div id="song_meta">';
        wp_nonce_field();

        $files = array(
            'authors' => __('Authors', ''),
            'files' => __('Files', ''),
            'videos' => __('Videos', '')
        );
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

    function savemeta() {
        if (!wp_verify_nonce((isset($_POST['songbook_filebox_noncename'])) ? $_POST['songbook_filebox_noncename'] : false, plugin_basename(__FILE__)) || !current_user_can('edit_post'))
            return;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;
        $songbook_fileids = $_POST['fileid'];
        if (count($songbook_fileids) > 1) {
            foreach ($songbook_fileids as $songbook_fileid) {
                if ($songbook_fileid !== 0)
                    $files[$songbook_fileid] = array(
                        'url' => $_POST['url_' . $songbook_fileid],
                        'private' => $_POST['private_' . $songbook_fileid],
                        'title' => $_POST['title_' . $songbook_fileid],
                        'indent' => $_POST['level_' . $songbook_fileid],
                        'extension' => $_POST['fileext_' . $songbook_fileid]
                    );
            }
        }elseif (count($songbook_fileids) === 1) {
            if ($songbook_fileid !== 0)
                $files[$songbook_fileid] = array(
                    'url' => $_POST['url_' . $songbook_fileid],
                    'private' => $_POST['private_' . $songbook_fileid],
                    'title' => $_POST['title_' . $songbook_fileid],
                    'indent' => $_POST['level_' . $songbook_fileid],
                    'extension' => $_POST['fileext_' . $songbook_fileid]
                );
        }
        if (!$files)
            return;
        $songbook_savevalue = serialize($files);
        update_post_meta($songbook_postid, 'songbook_filebox', $songbook_savevalue);
    }

}

$wpsb_metabox = new songbook_metabox();
