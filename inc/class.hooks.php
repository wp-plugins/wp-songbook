<?php

class songbook_hooks extends songbook_functions {

    function songbook_hooks() {
        add_filter('the_content', array($this, 'songlist'));
        add_filter('term_link', array($this, 'taxlinks'), 10, 3);
        add_filter('term_link', array($this, 'content'));
        add_action('admin_head', array($this, 'adminhed'));
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

    function songlist($toedit) {
        //check post
        if (get_the_ID() != $this->option('shcdefs_listpageid'))
            return$toedit;




        if ($this->option('showintext') === 'display')
            $return[] = $toedit;
        $return[] = '<table id="wpsongbook_list">';

        //get titles of each column to make 
        if ($this->option('shcdefs_thead') === 'display') {
            $fields = $this->fields('songs');
            foreach ($this->option('shcdefs_tablecont') as $item) {
                $thead[] = $fields[$item];
            }
            $return[] = $this->multielements($thead, '<td>', '</td>');
        }


        $taxon = (isset($_GET['type'])) ? $_GET['type'] : false;
        $tag = (isset($_GET['tag'])) ? $_GET['tag'] : false;

        //add query
        $wpsb_query = new WP_Query(array(
            'post_type' => 'song',
            'nopaging' => true,
            'posts_per_page' => -1,
            'orderby' => ($this->option('shcdefs_orderby')) ? $this->option('shcdefs_orderby') : 'title',
            'order' => ($this->option('shcdefs_order')) ? $this->option('shcdefs_order') : 'desc',
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

                foreach ($this->option('shcdefs_tablecont') as $item) {
                    $items[$i][] = $data[$item];
                }
                $i++;
            }





        for ($i = 0; $i < count($items); $i++) {
            $return[] = '<tr>' . $this->multielements($items[$i], '<td>', '</td>') . '</tr>';
        }

        $return[] = '</table>';
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
        if ($this->option('disp_backtolistinsong'))
            $ret.=$this->backtolist() . PHP_EOL;
        if ($this->option('disp_authorsinsong') === 'display' || $this->option('disp_genresinsong') === 'display' || $this->option('disp_albumsinsong') === 'display' || $this->option('disp_videolinkinsong') === 'head') {
            if ($this->option('disp_authorsinsong'))
                $ret.='<span class="author">' . get_the_term_list(get_the_ID(), 'songauthor') . '</span>';
            if ($this->option('disp_albumsinsong'))
                $ret.='<span class="album">' . get_the_term_list(get_the_ID(), 'songalbum') . '</span>';
            if ($this->option('disp_genresinsong'))
                $ret.='<span class="genre">' . get_the_term_list(get_the_ID(), 'songgenre') . '</span>';
        }
        $ret.=$toedit;

        return $ret;
    }

}

$wpsb_hooks = new songbook_hooks();
