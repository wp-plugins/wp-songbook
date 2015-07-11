<?php

/**
 * Includes external functions for WP-Songbook plugin
 *
 * @author sjiamnocna
 */
abstract class songbook_functions {

    function add_element($html, $pars = array(), $pair = true, $content = '') {
        if (!isset($html))
            return;

        $ret = '<' . $html;

        $param = '';
        $keys = array_keys($pars);
        $i = 0;
        while ($i < count($keys)) {

            $param.=' ' . $keys[$i] . '="' . $pars[$keys[$i]] . '"';
            $i++;
        }

        $ret.=$param;
        $ret.=($pair) ? '>' : '/>';
        $ret.=$content;
        if ($pair)
            $ret.="</$html>";
        return $ret;
    }

    function backtolist($bef = '', $aft = '', $linkid = 'backtolink') {

        $ret = $bef;
        $link = get_the_permalink($this->option('shcdefs_listpageid'));
        $ret.="<a href=\"$link\" id=\"$linkid\">";
        $ret.=$this->option('text_backtolist');
        $ret.='</a>';
        $ret.=$aft;
    }

    function defs($optname = false) {
        //default option values without prefixes
        $defs = array(
            'enable_filelinking' => 'disable',
            'enable_setvideolink' => 'disable',
            'enable_authorstax' => 'enable',
            'enable_albumstax' => 'disable',
            'enable_genrestax' => 'disable',
            'enable_comments' => 'disable',
            'enable_playlists' => 'disable',
            'enable_sbwidget' => 'disable',
            'enable_sswidget' => 'disable',
            'mincap_cpt_display' => 'read',
            'mincap_addfiles' => 'edit_posts',
            'mincap_manauthors' => 'edit_posts',
            'mincap_ssidebar_control' => 'publish_posts',
            'text_backtolist' => __('Go back to the song list', WPSB_LANGDOM),
            'text_error_nothingfound' => __('We are sorry but nothing was found for selected conditions. An (probably green) alien from space have stolen everything similar this morning. Please, try something different',WPSB_LANGDOM),
            'text_error_disabled'=>__('We are sorry, but this features are disabled on this site',WPSB_LANGDOM),
            'text_no_file'=>__('No files were added to the song yet',WPSB_LANGDOM),
            'disp_backtolistinsong'=>'display',
            'disp_filelistinsong' =>'display',
            'disp_filelistforlogged' =>'private',
            'disp_videolinkinsong'=>'false',
            'disp_authorsinsong'=>'display',
            'disp_genresinsong'=>'false',
            'disp_albumsinsong'=>'false',
            'disp_lyrelement'=>'none',
            'disp_videolinkinshc'=>'display',
            'disp_songfilesinshc'=>'false',
            'shcdefs_listpageid'=>0,
            'shcdefs_dispcont'=>'songs',
            'shcdefs_tablecont'=>'',
            'shcdefs_orderby'=>'title',
            'shcdefs_order'=>'asc',
            'shcdefs_thead'=>'display',
            'shcdefs_dispauthor'=>'display',
            'shcdefs_dispgenre'=>'false',
            'shcdefs_dispalbum'=>'false',
            'shcdefs_dispyear'=>'false',
            'shcdefs_yeartype'=>'display',
            'shcdefs_dispsongcount'=>'display'
        );
        if (!$optname)
            return $defs;
        if (isset($optname) && isset($defs[$optname]))
            return $defs[$optname];
        else return '';
    }
    
    function defs_all(){
        foreach(array_keys($this->defs()) as $key){
            $this->option($key,'setdef');
        }
    }

    function fields($cont, $type = 'header') {

        if ($type === 'header')
            switch ($cont) {
                case'songs':
                    $columns['title'] = __('Title', WPSB_LANGDOM);
                    if ($this->option('shcdefs_dispauthor') === 'display' && $this->option('enable_authorstax') === 'enable')
                        $columns['author'] = __('Author', WPSB_LANGDOM);
                    if ($this->option('shcdefs_dispgenre') === 'display' && $this->option('enable_genrestax') === 'enable')
                        $columns['genre'] = __('Genre', WPSB_LANGDOM);
                    if ($this->option('shcdefs_dispalbum') === 'display' && $this->option('enable_albumstax') === 'enable')
                        $columns['album'] = __('Album', WPSB_LANGDOM);
                    if ($this->option('shcdefs_dispyear') === 'display')
                        $columns['year'] = __('Year', WPSB_LANGDOM);
                    if ($this->option('disp_videolinkinshc') === 'display')
                        $columns['videolink'] = __('Video', WPSB_LANGDOM);
                    if ($this->option('disp_songfilesinshc') === 'display')
                        $columns['songfiles'] = __('Song files', WPSB_LANGDOM);
                    break;
                case'authors':
                    $columns['title'] = __('Title', WPSB_LANGDOM);
                    $columns['count'] = __('Count', WPSB_LANGDOM);
                    break;
                case'albums':
                    $columns['title'] = __('Title', WPSB_LANGDOM);
                    $columns['count'] = __('Count', WPSB_LANGDOM);
                    break;
                case'genres':
                    $columns['title'] = __('Title', WPSB_LANGDOM);
                    $columns['count'] = __('Count', WPSB_LANGDOM);
                    break;
                case'playlists':
                    break;
            }
        else if ($type === 'content' && $cont === 'songs') {
            $columns['title'] = '<a href="' . get_the_permalink() . '" title="' . __('Display lyrics for', WPSB_LANGDOM) . ' ' . get_the_title() . '">' . get_the_title() . '</a>';
            if ($this->option('shcdefs_dispauthor') === 'display' && $this->option('enable_authorstax') === 'enable')
                $columns['author'] = get_the_term_list(get_the_ID(), 'songauthor');
            if ($this->option('shcdefs_dispgenre') === 'display' && $this->option('enable_genrestax') === 'enable')
                $columns['genre'] = get_the_term_list(get_the_ID(), 'songgenre');
            if ($this->option('shcdefs_dispalbum') === 'display' && $this->option('enable_albumstax') === 'enable')
                $columns['album'] = get_the_term_list(get_the_ID(), 'songalbum');
            if ($this->option('shcdefs_dispyear') === 'display')
                $columns['year'] = get_the_time('Y');
            if ($this->option('disp_videolinkinshc') === 'display')
                $columns['videolink'] = __('Video', WPSB_LANGDOM);
            if ($this->option('disp_songfilesinshc') === 'display')
                $columns['songfiles'] = __('Song files', WPSB_LANGDOM);
        }
        if (isset($columns))
            return $columns;
    }

    function getadmincolors() {
        global $_wp_admin_css_colors;
        $admin_colors = $_wp_admin_css_colors;
        return $admin_colors[get_user_meta(get_current_user_id(), 'admin_color', true)];
    }
    
    function getmeta($id,$metaname){
        $r=  get_post_meta($id,$metaname,true);
        if($r && !is_object($r))return $r;
        else return false;
    }
    
    function getfile($files,$fid){
        return [
                    'id'=>$fid,
                    'title'=>(isset($files[$fid]['title']))?$files[$fid]['title']:basename(wp_get_attachment_url($fid)),
                    'type'=>(isset($files[$fid]['type']))?$files[$fid]['type']:false,
                    'private'=>(isset($files[$fid]['private']))?$files[$fid]['private']:$this->option('disp_filelistforlogged'),
                    'url'=>(isset($files[$fid]['url']))?$files[$fid]['url']:wp_get_attachment_url($fid)
                ];
    }

    function multielements($arr, $bef, $aft, $lineend = PHP_EOL) {
        if (!is_array($arr) || !$bef || !$aft)
            return;

        $ret = '';
        foreach ($arr as $el) {
            $ret.=$bef . $el . $aft . $lineend;
        }
        return $ret;
    }

    function option($optname, $action = 'get', $newvalue = false) {
        $prefix = 'songbook_';
        $default=($action==='def' || $action==='setdef')?true:false;
        $val = $newvalue;
        if (!$optname)
            return;
        if ($action === 'get')
            $val = apply_filters('chkval_'.$optname,get_option($prefix . $optname));
        if ($action === 'save'){
            $val = apply_filters('chkval_'.$optname, $val);
            $val = update_option($prefix . $optname, $val);
        }

        if (!$val || $default)
            $val = $this->defs($optname);
        
        if($action==='setdef')
            update_option($prefix . $optname, $val);

        return $val;
    }

}
