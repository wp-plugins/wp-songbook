<?php
function songbook_check_wp_version($minver='1') {
    global $wp_version;
    if ($wp_version >= $minver) {
        return $wp_version;
    } else return false;
}
function songbook_saveopt($songbook_optname,$songbook_newoptvalue){
    if(!get_option($songbook_optname))add_option($songbook_optname);
    update_option($songbook_optname,$songbook_newoptvalue);
}
function songbook_gettagcont($url, $tagname)
 {
    $string=file_get_contents($url);
    $pattern = "/<$tagname.*>(.*?)<\/$tagname>/";
    preg_match($pattern, $string, $matches);
    return $matches[1];
 }
function songbook_getpagetitle($url){
    $str=file_get_contents($url);
    if(strlen($str)>0){
        preg_match("/\<title\>(.*)\<\/title\>/",$str,$title);
        return $title[1];
    }
}
function songbook_getfilesasarray($postid){
    $files=get_post_meta($postid,'songbook_filebox',true);
    $files=(is_array($files))?unserialize($files[0]):unserialize($files);
    $count=0;
    while($count<count($files)){
        $result[$count]=$files[$count];
        $count++;
    }
}
function songbook_downfile($file_id){
$filePath=parse_url(wp_get_attachment_url($file_id),PHP_URL_PATH);
$fileName=pathinfo(wp_get_attachment_url($file_id),PATHINFO_BASENAME);
$mimeType=str_replace('.','',pathinfo(parse_url(wp_get_attachment_url($file_id),PHP_URL_PATH), PATHINFO_EXTENSION));
    $mimeTypes = array(
        'pdf' => 'application/pdf',
        'txt' => 'text/plain',
        'html' => 'text/html',
        'exe' => 'application/octet-stream',
        'zip' => 'application/zip',
        'doc' => 'application/msword',
        'xls' => 'application/vnd.ms-excel',
        'ppt' => 'application/vnd.ms-powerpoint',
        'gif' => 'image/gif',
        'png' => 'image/png',
        'jpeg' => 'image/jpg',
        'jpg' => 'image/jpg',
        'php' => 'text/plain'
    );

    //Send Headers
    header('Content-Type: ' . $mimeTypes[$mimeType]); 
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');
    header('Cache-Control: private');
    header('Pragma: private');
    //run it
    readfile($filePath);
}
function songbook_version(){
	if ( ! function_exists( 'get_plugins' ) )
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
	$plugin_file = basename( ( __FILE__ ) );
	return $plugin_folder[$plugin_file]['Version'];
}
function songbook_setdefaults(){
    $version_bignum= str_replace('.','',songbook_version());
    $version_defs=array(
      '112'=>array(
          'songbook_enable_filelinking'=>'enable',
          'songbook_enable_setvideolink'=>'enable',
          'songbook_enable_authorstax'=>'enable',
          'songbook_enable_widget'=>'',
          'songbook_mincap_addfiles'=>'edit_posts',
          'songbook_mincap_addvideolink'=>'edit_posts',
          'songbook_mincap_manauthors'=>'manage_categories',
          'songbook_disp_filelistforlogged'=>'',
          'songbook_disp_filelistinsong'=>'',
          'songbook_disp_videolinkinshc'=>'display',
          'songbook_disp_videolinkinsong'=>'display',
          'songbook_disp_authorsinshc'=>'display',
          'songbook_disp_authorsinsong'=>'display',
          'songbook_shcdefs_listpageid'=>'',
          'songbook_shcdefs_showintext'=>'',
          'songbook_shcdefs_orderby'=>'title',
          'songbook_shcdefs_order'=>'asc'
      ),
      '120'=>array(
          'songbook_disp_lyrelement'=>'none'
      )
    );
    foreach(array_keys($version_defs) as $key){
        if($key<=$version_bignum){
            foreach(array_keys($version_defs[$key]) as $tosavekey){
                songbook_saveopt($tosavekey,$version_defs[$key][$tosavekey]);
            }
        }
    }
}
function authorsongsurl($url,$term,$taxonomy){
    $term_con=(array) $term;
    $listurl=get_permalink(get_option('songbook_shcdefs_listpageid'));
    if($taxonomy!=='songauthor')return $url;
    if($taxonomy=='songauthor')return $listurl.'?author='.$term_con['slug'];
}