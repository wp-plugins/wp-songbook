<?php
function songbook_saveopt($songbook_optname,$songbook_newoptvalue){
    if(!get_option($songbook_optname))add_option($songbook_optname);
    update_option($songbook_optname,$songbook_newoptvalue);
}
function songbook_getpagetitle($Url){
    $str = file_get_contents($Url);
    if(strlen($str)>0){
        preg_match("/\<title\>(.*)\<\/title\>/",$str,$title);
        return $title[1];
    }
}
function songbook_version(){
	if ( ! function_exists( 'get_plugins' ) )
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
	$plugin_file = basename( ( __FILE__ ) );
	return $plugin_folder[$plugin_file]['Version'];
}
function songbook_setdefaults($version){
        $songbook_opt['songbook_enable_filelinking']='enable'; //y
        $songbook_opt['songbook_enable_setbpm']=''; //y
        $songbook_opt['songbook_enable_setvideolink']='enable'; //y
        $songbook_opt['songbook_enable_authorstax']='enable'; //y
        $songbook_opt['songbook_enable_widget']='';
        $songbook_opt['songbook_mincap_addfiles']='edit_posts'; //y
        $songbook_opt['songbook_mincap_addvideolink']='edit_posts'; //y
        $songbook_opt['songbook_mincap_addtempo']='edit_posts'; //y
        $songbook_opt['songbook_mincap_manauthors']='manage_categories'; //y
        $songbook_opt['songbook_disp_filelistinshc']=''; //y
        $songbook_opt['songbook_disp_filelistforlogged']='';
        $songbook_opt['songbook_disp_filelistinsong']=''; //y
        $songbook_opt['songbook_disp_videolinkinshc']='display'; //y
        $songbook_opt['songbook_disp_videolinkinsong']='display'; //y
        $songbook_opt['songbook_disp_authorsinshc']='display'; //y
        $songbook_opt['songbook_disp_authorsinsong']='display'; //y
        $songbook_opt['songbook_shcdefs_listpageid']='';
        $songbook_opt['songbook_shcdefs_showintext']='';
        $songbook_opt['songbook_shcdefs_orderby']='title'; //y
        $songbook_opt['songbook_shcdefs_order']='asc'; //y
        foreach(array_keys($songbook_opt) as $songbook_key){
            songbook_saveopt($songbook_key,$songbook_opt[$songbook_key]);
        }
}