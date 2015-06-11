<?php

class songbook_hooks extends songbook_functions {

    function songbook_hooks() {
        add_filter('the_content', array($this, 'songlist'));
    }

    function songlist($toedit) {
        //check post
        if (get_the_ID() != $this->option('shcdefs_listpageid'))
            return$toedit;

        //get settings
        $opts = array('shcdefs_tablecont', 'shcdefs_listpageid', 'shcdefs_dispcont', 'shcdefs_orderby', 'shcdefs_order', 'shcdefs_thead', 'shcdefs_dispauthor', 'shcdefs_dispgenre', 'shcdefs_dispalbum', 'shcdefs_dispyear', 'shcdefs_dispsongcount', 'shcdefs_showintext', 'disp_videolinkinshc', 'disp_songfilesinshc');
        foreach ($opts as $opt) {
            $optval[explode('_', $opt)[1]] = $this->option($opt);
        }
        
        if($optval['showintext']==='display')$return[]=$toedit;
        $return[]='<table id="wpsongbook_list">';
        
        //get titles of each column to make 
        if($optval['thead']==='display'){
            $fields=$this->fields('songs');
            foreach($optval['tablecont'] as $item){
                $thead[]=$fields[$item];
            }
            $return[]=$this->multielements($thead,'<td>','</td>');
        }
        
        
        
        
        //add query
        $wpsb_query = new WP_Query(array(
            'post_type' => 'song',
            'nopaging' => true,
            'posts_per_page' => -1,
            'orderby' => ($optval['orderby']) ? $optval['orderby'] : 'title',
            'order' => ($optval['order']) ? $optval['order'] : 'desc',
            'tax_query' => (isset($tax) && $tax !== false) ? array(array(
                    'taxonomy' => $tax,
                    'field' => 'slug',
                    'terms' => $_GET['tag']
                )
                    ) : FALSE
        ));
        if($wpsb_query->have_posts())while($wpsb_query->have_posts()){
            $wpsb_query->the_post();
            $data=$this->fields('songs','content');
            
            foreach($optval['tablecont'] as $item){
                $items[]=$data[$item];
            }
            
            $return[]='<tr>'.$this->multielements($items,'<td>','</td>').'</tr>';
        }



        $return[] = '</table>';
        return implode(PHP_EOL, $return);
    }

}

$wpsb_hooks = new songbook_hooks();
