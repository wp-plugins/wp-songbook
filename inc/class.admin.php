<?php

class songbook_admin extends songbook_functions {

    public function songbook_admin() {
        add_action('admin_menu', array($this, 'regadminpage'));
        add_filter('plugin_row_meta',array($this,'pluginmetalinks'),10,2);
        add_filter('plugin_action_links_'.WPSB_DIRNAME.'/wp-songbook.php','songbook_pluginspagelink',10,2);
    }

    function regadminpage() {
        add_submenu_page('edit.php?post_type=song', __('Settings', 'wpsongbook'), __('Songbook settings', 'wpsongbook'), 'edit_dashboard', 'songbook-settlink', array($this, 'create_adminset'));
    }

    public function create_adminset() {
        if (isset($_POST['sb_savesets']) && isset($_POST['_wpnonce']))
            if (wp_verify_nonce($_POST['_wpnonce'])) {

                if (isset($_POST['songbook'])) {
                    
                    $vals = $_POST['songbook'];

                    if ($vals['shcdefs_listpageid'] === 'autoaddpage') {

                        $title = (!empty($vals['shcdefs_autoadd_pgtitle'])) ? $vals['shcdefs_autoadd_pgtitle'] : __('Songs', 'wpsongbook');
                        if (!get_page_by_title(__($title, 'wpsongbook'))) {
                            $post = array(
                                'menu_order' => '5',
                                'comment_status' => 'closed',
                                'post_author' => 'songbook plugin',
                                'post_content' => ' ',
                                'post_status' => 'publish',
                                'post_title' => $title,
                                'post_type' => 'page'
                            );
                            wp_insert_post($post);
                        }
                        unset($vals['shcdefs_autoload_pgtitle']);
                        if ((isset($title)))
                            $vals['shcdefs_listpageid'] = get_page_by_title($title)->ID;
                        else
                            unset($vals['shcdefs_listpageid']);
                    }
                }

                if (count($vals) > 1)
                    foreach (array_keys($vals) as $pkey) {
                        $this->option($pkey, 'save', $vals[$pkey]);
//                echo $pkey.'&nbsp;'.$_POST['songbook'][$pkey].'<br/>';
                    }
            }

        $pages = array(
            'pluginfo.php' => __('Plugin info', WPSB_LANGDOM),
            'basic.php' => __('Songbook settings', WPSB_LANGDOM),
            'capabilities.php' => __('Capabilities', WPSB_LANGDOM),
//                'modules.php'=>__('Plugin modules',WPSB_LANGDOM),
            'songcontent.php' => __('Song content', WPSB_LANGDOM),
            'songlist.php' => __('Song list behavior', WPSB_LANGDOM)
        );
        ?>
        <form id="songbook_admin_wrap" method="post">
            <h1><?php _e('WP Songbook plugin settings', 'estatewp'); ?></h1>
            <div id="content">
                <form>
                    <div class="left">
                        <?php
                        $files = array_keys($pages);
                        $act = (isset($_GET['cont']) && in_array($_GET['cont'] . '.php', $files)) ? $_GET['cont'] : 'pluginfo';

                        foreach ($files as $page) {

                            $class[] = 'part';
                            if ($act . '.php' === $page)
                                $class[] = 'active';
                            $divclass = ' class="' . implode(' ', $class) . '"';

                            echo"<div $divclass>";
                            echo"<h2>" . $pages[$act . '.php'] . "</h2>";
                            echo'<div class="inside">';
                            include_once 'admin/' . $page;
                            echo'</div>';
                            echo'</div>';

                            unset($class);
                        }
                        wp_nonce_field();
                        ?>
                    </div>
                    <ul class="right">
                        <?php
                        foreach (array_keys($pages) as $item) {

                            $short = str_replace('.php', '', $item);

                            $end = ($item !== 'pluginfo.php') ? '&cont=' . $short : '';
                            $active = ($act === $short) ? ' class="active" ' : '';
                            $url = admin_url('edit.php?post_type=song&page=songbook-settlink' . $end);
                            $text = $pages[$item];

                            echo"<a href=\"$url\" id=\"$short\"$active>$text</a>";
                        }
                        ?>
                    </ul>
                    <input type="submit" class="button-primary" name="sb_savesets" value="<?php _e('Save settings', WPSB_LANGDOM); ?>"/>
            </div>
        </form>

        <?php
    }

    function pluginspagelink($links) {
        $songbook_pluginlinks = array(
            'edit.php?post_type=song&page=songbook-settlink' => __('Settings', 'wpsongbook')
        );
        foreach (array_keys($songbook_pluginlinks) as $songbook_pluginlinkkey) {
            $songbook_link = '<a href="' . $songbook_pluginlinkkey . '">' . $songbook_pluginlinks[$songbook_pluginlinkkey] . '</a>';
            array_push($links, $songbook_link);
        }
        return $links;
    }

    function pluginmetalinks($links, $file) {
        if ($file != 'wp-songbook/wordpress-songbook.php')
            return$links;
        $songbook_pluginlinks = array(
            admin_url('edit.php?post_type=song&page=songbook-settlink')=> __('Songbook settings', 'wpsongbook'),
            'https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=65SS8NS48FPFQ&lc=CZ&item_name=%c5%a0imon%20Jan%c4%8da&currency_code=CZK&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted' => __('Donate me', 'wpsongbook')
        );
        foreach (array_keys($songbook_pluginlinks) as $songbook_pluginlinkkey) {
            if ($songbook_pluginlinks[$songbook_pluginlinkkey])
                $songbook_link = '<a href="' . $songbook_pluginlinkkey . '">' . $songbook_pluginlinks[$songbook_pluginlinkkey] . '</a>';
            if (!$songbook_pluginlinks[$songbook_pluginlinkkey])
                $songbook_link = $songbook_pluginlinkkey;
            array_push($links, $songbook_link);
        }
        return $links;
    }

}

$eadmin = new songbook_admin();
