<?php
function songbook_pluginlistshc($songbook_toedit) {
    if (get_the_ID() != get_option('songbook_shcdefs_listpageid'))
        return$songbook_toedit;
    
    //what to display - settings or URL parameter
    $getopt_content = (get_option('songbook_shcdefs_dispcont')) ? get_option('songbook_shcdefs_dispcont') : 'songs';
    $sb_dispcont = (isset($_GET['cont'])&&$_GET['cont']!==null)?$_GET['cont']:$getopt_content;
    
    if(isset($_GET['cont'])){
        $sb_dispcont=$_GET['cont'];
    }elseif(!isset($_GET['cont'])&&get_option('songbook_shcdefs_dispcont')){
        $sb_dispcont=get_option('songbook_shcdefs_dispcont');
    }else{
        $sb_dispcont='songs';
    }
    
    //$songbook_maketable=new sbclass_maketable(count($thead),$thead,$tr,'class="songbook_songlist"');
    if ($sb_dispcont === 'songs'||(($sb_dispcont==='authors'||$sb_dispcont==='albums'||$sb_dispcont==='genres')&&(isset($_GET['tag'])))) {
        //thead for songs
        $theader[]=(get_option('songbook_shcdefs_dispthead')==='display')?__('Song title','wpsongbook'):false;
        $theader[]=(get_option('songbook_shcdefs_dispthead')==='display'&&get_option('songbook_disp_authorsinshc')==='display')?__('Author','wpsongbook'):false;
        $theader[]=(get_option('songbook_shcdefs_dispthead')==='display'&&get_option('songbook_shcdefs_dispalbum')==='display')?__('Album','wpsongbook'):false;
        $theader[]=(get_option('songbook_shcdefs_dispthead')==='display'&&get_option('songbook_shcdefs_dispgenre')==='display')?__('Genre','wpsongbook'):false;
        $theader[]=(get_option('songbook_shcdefs_dispthead')==='display'&&get_option('songbook_shcdefs_dispyear')==='display')?__('Year','wpsongbook'):false;
        $thead=(count($theader)>0)?sb_array_removeempty($theader):false;
        

        if((($sb_dispcont==='authors'||$sb_dispcont==='albums'||$sb_dispcont==='genres')&&(isset($_GET['tag'])))){
            switch($sb_dispcont){
                case'authors':
                    $tax='songauthor';
                    echo 123456789;
                break;
                case'albums':
                    $tax='songalbum';
                break;
                case'genres':
                    $tax='songgenre';
                break;
                default:
                    $tax=false;
                break;
            }
        }
        
        //table content
        //creating arguments for query
        $sbquery_args=array(
        'post_type' => 'song',
        'nopaging' => true,
        'orderby' => (get_option('songbook_shcdefs_orderby')) ? get_option('songbook_shcdefs_orderby') : 'title',
        'order' => (get_option('songbook_shcdefs_order')) ? get_option('songbook_shcdefs_order') : 'desc',
        'posts_per_page' => -1,
        'tax_query' => (isset($tax)&&$tax!==false) ? array(array(
                'taxonomy' =>$tax,
                'field' => 'slug',
                'terms' => $_GET['tag']
                )
            ) : FALSE
        );
        
        //execute query args and create an query
        $sbquery=new WP_Query($sbquery_args);
        
        if($sbquery->have_posts()){
            $v=0;
            while($sbquery->have_posts()){
                //start post
                $sbquery->the_post();
                //get data into array for table
                $stitle=get_the_title();
                $surl=get_the_permalink();
                $sauthors=get_the_term_list(get_the_ID(),'songauthor');
                $salbums=get_the_term_list(get_the_ID(),'songalbum');
                $sgenres=get_the_term_list(get_the_ID(),'songgenre');
                $syear=get_the_time('Y');
                
                $sb_tcont[$v][]='<a href="'.$surl.'" title="'.__('See whole song','wpsongbook').'">'.$stitle.'</a>';
                $sb_tcont[$v][]=(get_option('songbook_disp_authorsinshc')==='display')?$sauthors:false;
                $sb_tcont[$v][]=(get_option('songbook_shcdefs_dispalbum')==='display')?$salbums:false;
                $sb_tcont[$v][]=(get_option('songbook_shcdefs_dispgenre')==='display')?$sgenres:false;
                $sb_tcont[$v][]=(get_option('songbook_shcdefs_dispyear')==='display')?$syear:false;
                
                $v++;
            }
        }else echo'NOTHING FOUND';
        
    }elseif(($sb_dispcont==='authors'||$sb_dispcont==='albums'||$sb_dispcont==='genres')&&!isset($_GET['tag'])){
        
        //set header titles and tax slugs if needed
        switch($sb_dispcont){
            case'authors':
                if(get_option('songbook_shcdefs_dispthead')==='display')$theader=array(__('Author','wpsongbook'),(get_option('songbook_shcdefs_dispsongcount')==='display')?__('Song count','wpsongbook'):false);
                $taxname='songauthor';
            break;
            case'albums':
                if(get_option('songbook_shcdefs_dispthead')==='display')$theader=array(__('Album','wpsongbook'),(get_option('songbook_shcdefs_dispsongcount')==='display')?__('Song count','wpsongbook'):false);
                $taxname='songalbum';
            break;
            case'genres':
                if(get_option('songbook_shcdefs_dispthead')==='display')$theader=array(__('Genre','wpsongbook'),(get_option('songbook_shcdefs_dispsongcount')==='display')?__('Song count','wpsongbook'):false);
                $taxname='songgenre';
            break;
        }
        //finally edit the header info to pass it as table parameters
        $thead=(count($theader)>0)?sb_array_removeempty($theader):false;
        
        $terms=get_terms($taxname);
        $v=0;
        foreach($terms as $term){
            $sb_tcont[$v][]='<a id="'.$term->term_id.'" href="'.get_term_link($term,$taxname).'" title="'.__('See all songs of author','wpsongbook').'">'.$term->name.'</a>';
            $sb_tcont[$v][]=(get_option('songbook_shcdefs_dispsongcount')==='display')?$term->count:false;
        }
    }
    
    //if results, make table
    if(isset($sb_tcont))$songbook_maketable=new sbclass_maketable(count($thead),$thead,$sb_tcont,'class="songbook_songlist"');
    $songbooklist_result=(isset($songbook_maketable))?$songbook_maketable->returnresult():$songbook_toedit;
    
    //return result table
    if ($songbooklist_result)
        return $songbooklist_result;
}

?>