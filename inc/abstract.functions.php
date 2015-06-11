<?php
/**
 * Includes external functions for WP-Songbook plugin
 *
 * @author sjiamnocna
 */

abstract class songbook_functions {
    function defs($optname=false){
        //default option values without prefixes
        $defs=array(
            'enable_filelinking'=>'disable',
            'enable_setvideolink'=>'disable',
            'enable_authorstax'=>'disable',
            'enable_albumstax'=>'disable',
            'enable_genrestax'=>'disable',
            'enable_comments'=>'enable',
            'enable_playlists'=>'disable',
            'enable_sbwidget'=>'disable',
            'enable_sswidget'=>'disable',
            'mincap_cpt_display'=>'read',
            'mincap_addfiles'=>'edit_posts',
            'mincap_manauthors'=>'edit_posts',
            'mincap_ssidebar_control'=>'publish_posts',
            ''=>''
            );
        if(!$optname)return $defs;
        if(isset($optname)&&isset($defs[$optname]))return $defs[$optname];
    }
    function option($optname,$action='get',$newvalue=false,$default=false){
        $prefix='songbook_';
        $val=$newvalue;
        if(!$optname)return;
        if($default)$val=$this->defs($optname);
        if($action==='get')$val=get_option($prefix.$optname);
        if($action==='save')$val=update_option($prefix.$optname,$val);
        
        if(!$val)$val=$this->defs($optname);
        
        return $val;
    }
    function multielements($arr,$bef,$aft,$lineend=PHP_EOL){
        if(!is_array($arr)||!$bef||!$aft)return;
        
        $ret='';
        foreach($arr as $el){
            $ret.=$bef.$el.$aft.$lineend;
        }
        return $ret;
    }
    
    function fields($cont,$type='header'){
        
        if($type==='header')switch($cont){
            case'songs':
                $columns['title']=__('Title',WPSB_LANGDOM);
                if($this->option('shcdefs_dispauthor')==='display'&&$this->option('enable_authorstax')==='enable')$columns['author']=__('Author',WPSB_LANGDOM);
                if($this->option('shcdefs_dispgenre')==='display'&&$this->option('enable_genrestax')==='enable')$columns['genre']=__('Genre',WPSB_LANGDOM);
                if($this->option('shcdefs_dispalbum')==='display'&&$this->option('enable_albumstax')==='enable')$columns['album']=__('Album',WPSB_LANGDOM);
                if($this->option('shcdefs_dispyear')==='display')$columns['year']=__('Year',WPSB_LANGDOM);
                if($this->option('disp_videolinkinshc')==='display')$columns['videolink']=__('Video',WPSB_LANGDOM);
                if($this->option('disp_songfilesinshc')==='display')$columns['songfiles']=__('Song files',WPSB_LANGDOM);
                break;
            case'authors':
                $columns['title']=__('Title',WPSB_LANGDOM);
                $columns['count']=__('Count',WPSB_LANGDOM);
                break;
            case'albums':
                $columns['title']=__('Title',WPSB_LANGDOM);
                $columns['count']=__('Count',WPSB_LANGDOM);
                break;
            case'genres':
                $columns['title']=__('Title',WPSB_LANGDOM);
                $columns['count']=__('Count',WPSB_LANGDOM);
                break;
            case'playlists':
                break;
        }
        else if($type==='content'&&$cont==='songs'){
                $columns['title']='<a href="'.get_the_permalink().'" title="'.__('Display lyrics for',WPSB_LANGDOM).' '.get_the_title().'">'.get_the_title().'</a>';
                if($this->option('shcdefs_dispauthor')==='display'&&$this->option('enable_authorstax')==='enable')$columns['author']=get_the_term_list(get_the_ID(),'songauthor');
                if($this->option('shcdefs_dispgenre')==='display'&&$this->option('enable_genrestax')==='enable')$columns['genre']=get_the_term_list(get_the_ID(),'songgenre');
                if($this->option('shcdefs_dispalbum')==='display'&&$this->option('enable_albumstax')==='enable')$columns['album']=get_the_term_list(get_the_ID(),'songalbum');
                if($this->option('shcdefs_dispyear')==='display')$columns['year']=get_the_time('Y');
                if($this->option('disp_videolinkinshc')==='display')$columns['videolink']=__('Video',WPSB_LANGDOM);
                if($this->option('disp_songfilesinshc')==='display')$columns['songfiles']=__('Song files',WPSB_LANGDOM);
        }
        if(isset($columns))return $columns;
    }
}
