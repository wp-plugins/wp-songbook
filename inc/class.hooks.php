<?php

class songbook_hooks extends songbook_functions {

    function __construct() {
        add_filter('the_content', array($this, 'songlist'));
        add_filter('term_link', array($this, 'taxlinks'), 10, 3);
        add_filter('term_link', array($this, 'content'));
        
        add_action('admin_head', array($this, 'adminhed'));
        
        add_action('admin_print_scripts',array($this,'disable_drafts_script'));
        add_action('admin_init', array($this,'disable_drafts'));

    }

    function adminhed() {
        ?>
        <style type="text/css">
            #songbook_admin_wrap #content ul.right{
                background:<?php echo $this->getadmincolors()->colors[1]; ?>;
            }
            #songbook_admin_wrap #content ul.right a{
                background:<?php echo $this->getadmincolors()->colors[0]; ?>;
                color:<?php echo $this->getadmincolors()->icon_colors['base']; ?>;
            }
            #songbook_admin_wrap #content ul.right a:hover{
                color:<?php echo $this->getadmincolors()->icon_colors['focus']; ?>;
                border-left:2px solid <?php echo $this->getadmincolors()->colors[2]; ?>;
            }
            #songbook_admin_wrap > #content > ul.right a.active{
                border-left-color:<?php echo $this->getadmincolors()->colors[2]; ?>;
                color:<?php echo $this->getadmincolors()->icon_colors['current']; ?>;
            }
            #songbook_admin_wrap > #content > ul.right a.active:hover{
                border-left:4px solid <?php echo $this->getadmincolors()->colors[2]; ?>;
            }
        </style>
        <?php
    }

    function disable_drafts_script() {
        global $post;
        $songbook_enq_page=basename($_SERVER['PHP_SELF'])."?".$_SERVER['QUERY_STRING'];
        $songbook_getpage=(isset($_GET['page']))?$_GET['page']:false;
        
        if(get_the_ID())if (preg_match('/^(edit\.php|post-new\.php|post\.php).*/',$songbook_enq_page) && in_array(get_post_type(get_the_ID()),array('song','playlist'))) {
            wp_dequeue_script('autosave');
        }
    }
    
    function disable_drafts(){
    remove_post_type_support('song', 'revisions');
    remove_post_type_support('playlist', 'revisions');
    }

    function songlist($toedit) {
        //check post
        if (get_the_ID() != $this->option('shcdefs_listpageid'))
            return$toedit;
        if ($this->option('showintext') === 'display')
            $return[] = $toedit;

        $a = isset($_GET['type']);
        $b = isset($_GET['tag']);

        if ($a && !$b)
            $list_content = $_GET['type'];
        else if ($a && $b)
            $list_content = 'songs';
        else if (!$a && !$b)
            $list_content = $this->option('shcdefs_dispcont');

        $list_content = (in_array($list_content, array('songs', 'albums', 'genres', 'authors'))) ? $list_content : 'songs';

        $table_content = ($list_content !== 'songs') ? array_keys($this->fields('authors')) : $this->option('shcdefs_tablecont');

        $taxon = (isset($_GET['type'])) ? $_GET['type'] : false;
        $tag = (isset($_GET['type']) && isset($_GET['tag'])) ? $_GET['tag'] : false;

        switch ($list_content) {
            case'authors':
                if ($this->option('enable_authorstax') !== 'enable')
                    $error = $list_content;
                $tax = 'songauthor';
                break;
            case'albums':
                if ($this->option('enable_albumstax') !== 'enable')
                    $error = $list_content;
                $tax = 'songalbum';
                break;
            case'genres':
                if ($this->option('enable_genrestax') !== 'enable')
                    $error = $list_content;
                $tax = 'songgenre';
                break;
            default:
                $tax = false;
                break;
        }

        $items = array();

        if (!isset($error)) {

            switch ($list_content) {
                case'songs':

                    $orderby=(isset($_GET['orderby'])) ? $_GET['orderby'] : $this->option('shcdefs_orderby');
                    
                    //add query
                    $wpsb_query = new WP_Query(array(
                        'post_type' => 'song',
                        'nopaging' => true,
                        'posts_per_page' => -1,
                        'orderby' => $orderby,
                        'order' => (isset($_GET['order'])) ? $_GET['order'] : $this->option('shcdefs_order'),
                        'tax_query' => ($taxon && $tag) ? array(array(
                                'taxonomy' => $taxon,
                                'field' => 'slug',
                                'terms' => $tag
                            )
                                ) : FALSE
                    ));

                    $i = 0;
                    if ($wpsb_query->have_posts())
                        while ($wpsb_query->have_posts()) {
                            $wpsb_query->the_post();
                            $data = $this->fields('songs', 'content');

                            foreach ($table_content as $item) {
                                $items[$i][] = $data[$item];
                            }
                            $i++;
                        }

                    break;
                case'authors':

                    //get all taxonomy terms
                    $terms = get_terms($tax);

                    for ($i = 0; $i < count($terms); $i++) {
                        $link = get_term_link($terms[$i]);

                        $items[$i]['title'] = "<a href=\"$link\">" . $terms[$i]->name . '</a>';
                        $items[$i]['count'] = $terms[$i]->count;
                    }

                    break;
                case'albums':

                    //get all taxonomy terms
                    $terms = get_terms($tax);

                    for ($i = 0; $i < count($terms); $i++) {
                        $link = get_term_link($terms[$i]);

                        $items[$i]['title'] = "<a href=\"$link\">" . $terms[$i]->name . '</a>';
                        $items[$i]['count'] = $terms[$i]->count;
                    }

                    break;
                case'genres':

                    //get all taxonomy terms
                    $terms = get_terms($tax);

                    for ($i = 0; $i < count($terms); $i++) {
                        $link = get_term_link($terms[$i]);

                        $items[$i]['title'] = "<a href=\"$link\">" . $terms[$i]->name . '</a>';
                        $items[$i]['count'] = $terms[$i]->count;
                    }

                    break;
            }
        }




        //if its selected to display table head, gets titles of each column to make 
        if (!isset($error)) {

            $return[] = '<table id="wpsongbook_list">';
            if ($this->option('shcdefs_thead') === 'display') {
                $fields = ($list_content === 'songs') ? $this->fields('songs') : $this->fields('authors');

                foreach ($table_content as $item) {
                    $thead[] = $fields[$item];
                }

                $return[] = $this->multielements($thead, '<td>', '</td>');
            }

            //finally insert rows with content
            if (count($items) >= 1)
                for ($i = 0; $i < count($items); $i++) {
                    $return[] = '<tr>' . $this->multielements($items[$i], '<td>', '</td>') . '</tr>';
                }

            $return[] = '</table>';
        }

        if (isset($error))
            return '<div class="sorry">' . $this->option('text_error_disabled') . '</div>';
        elseif (!isset($error) && count($items) < 1)
            return'<div class="sorry">' . $this->option('text_error_nothingfound') . '</div>';
        else
        if (isset($return))
            return implode(PHP_EOL, $return);
    }

    function taxlinks($url, $term, $taxonomy) {

        $term_con = $term;
        $listurl = get_permalink($this->option('shcdefs_listpageid'));
        if (!in_array($taxonomy, array('songauthor', 'songalbum', 'songgenre')))
            return $url;

        $ending = '';
        switch ($taxonomy) {
            case'songauthor':
                $ending = 'type=authors&tag=' . $term_con->slug;
                break;
            case'songgenre':
                $ending = 'type=genres&tag=' . $term_con->slug;
                break;
            case'songalbum':
                $ending = 'type=albums&tag=' . $term_con->slug;
                break;
        }

        if (stripos($listurl, '?'))
            $ending_f = '&' . $ending;
        else
            $ending_f = '?' . $ending;
        return $listurl . $ending_f;
    }

    function content($toedit) {
        if (is_search() || is_archive() || !is_single() || get_post_type() !== 'song')
            return $toedit;

        $ret = '';
        if ($this->option('disp_backtolistinsong')==='display')
            $ret.=$this->backtolist() . PHP_EOL;
        if ($this->option('disp_authorsinsong') === 'display' || $this->option('disp_genresinsong') === 'display' || $this->option('disp_albumsinsong') === 'display' || $this->option('disp_videolinkinsong') === 'head') {
            if ($this->option('disp_authorsinsong')==='display' && $this->option('enable_authorstax'==='enable'))
                $ret.='<span class="author">' . get_the_term_list(get_the_ID(), 'songauthor') . '</span>';
            if ($this->option('disp_albumsinsong')==='display' && $this->option('enable_albumstax'==='enable'))
                $ret.='<span class="album">' . get_the_term_list(get_the_ID(), 'songalbum') . '</span>';
            if ($this->option('disp_genresinsong')==='display' && $this->option('enable_genrestax'==='enable'))
                $ret.='<span class="genre">' . get_the_term_list(get_the_ID(), 'songgenre') . '</span>';
        }
        $ret.=$toedit;

        return $ret;
    }

}

$wpsb_hooks = new songbook_hooks();
