<?php
class songbook_ajax extends songbook_functions {
    public function __construct() {
        add_action('wp_ajax_gdocstitle',array($this,'gdocstitle'));
    }
    function gdocstitle(){
        $url=(strpos($_POST['url'],'http://') || strpos($_POST['url'],'https://'))?$_POST['url']:'http://'.$_POST['url'];
        $page=file_get_contents($url);
        
        preg_match("/\<title\>(.*)\<\/title\>/i",$page,$title);
        echo $title[1];
    }
}
$wpsb_ajax=new songbook_ajax();