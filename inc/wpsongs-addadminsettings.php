<?php
function songbook_updateopt($songbook_optname,$songbook_newval){
    if(!$songbook_optname||!$songbook_newval)return false;
    if(!get_option($songbook_optname))add_option ($songbook_optname);
    update_option($songbook_optname,$songbook_newval);
}
function songbook_manpage(){
    echo'<div class="wrap"><div id="icon-tools" class="icon32" style="background:url('.plugins_url('../img/bass_key_icon.png', __FILE__ ).') no-repeat;width:45px;height:45px;"></div>';
    echo'<h2>'.__('How to use songbook plugin','wpsongbook').'</h2>';
    echo'<div style="display:block;width:98%;margin:5px auto;">'.__('Using this plugin is very simple. Plugin allows you to add own posts called song, then you can set it with Authors name and then add some files to it. I\'m trying to make it easy for all users even they\'re not interested with wordpress and just needs add content','wpsongbook').'</div>';
    echo'<h3>'.__('Adding songs','wpsongbook').'</h3>';
    echo'<div style="display:block;width:98%;margin:5px auto;">'.__('You can add songs simple with clicking on Add new song. You set title, lyrics, author and you publish it.','wpsongbook').'</div>';
    echo'<h3>'.__('Managing authors','wpsongbook').'</h3>';
    echo'<div style="display:block;width:98%;margin:5px auto;">'.__('Managing authors is as simple as categories. You can simple add authors name (if you want you can add description too) and save it. Than you can chose author/s in edit song screen. Author names shoud appear on single song output.','wpsongbook').'</div>';
    echo'<h3>'.__('Listing songs on public','wpsongbook').'</h3>';
    echo'<div style="display:block;width:98%;margin:5px auto;">'.__('For list of all songs you should create page and add shortcode [songbook_listsongs] in it. It\'ll be replaced with alphabet ordered song list. Than you can put it into your menu or link it from anywhere you want.','wpsongbook').'</div>';
    echo'</div>';
    echo'<h3>'.__('Attaching files into songs','wpsongbook').'</h3>';
    echo'<div style="display:block;width:98%;margin:5px auto;">'.__('For attaching files with songs you can use a box next to text editor. It\'s very simple to use. If you hold CTRL you can choose more files to link and if you click on cross next to filename, the file would be removed.','wpsongbook').'</div>';
    echo'</div>';
}
function songbook_settpage(){
    $songbook_translation=array(
        'changes'=>__('Changes:','wpsongbook'),
        'no_changes'=>__('No changes were made. Everything is, at it was :)','wpsongbook'),
        'enable'=>__('Yes','wpsongbook'),
        'manage_options'=>__('Manage options','wpsongbook'),
        'read_private_pages'=>__('Read private pages','wpsongbook'),
        'publish_posts'=>__('Publish posts','wpsongbook'),
        'edit_posts'=>__('Edit posts','wpsongbook'),
        'manage_categories'=>__('Manage categories','wpsongbook'),
        'read'=>__('Read','wpsongbook'),
        'display'=>__('Display','wpsongbook'),
        'modified'=>__('Last modified','wpsongbook'),
        'ID'=>__('ID','wpsongbook'),
        'title'=>__('Title','wpsongbook'),
        'rand'=>__('Random','wpsongbook'),
        'asc'=>__('Ascending order','wpsongbook'),
        'desc'=>__('Descending order','wpsongbook'),
        'songbook_sets'=>__('Songbook settings','wpsongbook'),
        'songbook_general'=>__('General settings','wpsongbook'),
        'songbook_general_desc'=>__('Basic controls of plugin','wpsongbook'),
        'songbook_enable_filelinking'=>__('Allow file linking','wpsongbook'),
        'songbook_enable_setbpm'=>__('Allow adding tempo to song','wpsongbook'),
        'songbook_enable_setvideolink'=>__('Allow adding video link','wpsongbook'),
        'songbook_enable_authorstax'=>__('Allow using authors','wpsongbook'),
        'songbook_enable_widget'=>__('Allow using widget','wpsongbook'),
        'songbook_enable_shortcode'=>__('Allow using list shortcode','wpsongbook'),
        'songbook_caps'=>__('Capabilities','wpsongbook'),
        'songbook_caps_desc'=>__('Allow only to users that can','wpsongbook'),
        'songbook_mincap_addfiles'=>__('Add files to songs','wpsongbook'),
        'songbook_mincap_addvideolink'=>__('Manage song video link','wpsongbook'),
        'songbook_mincap_addtempo'=>__('Manage song tempo','wpsongbook'),
        'songbook_mincap_manauthors'=>__('Manage song authors','wpsongbook'),
        'songbook_behavior'=>__('Behavior','wpsongbook'),
        'songbook_behavior_desc'=>__('Appearance and beavior of publicly visible parts','wpsongbook'),
        'songbook_disp_filelistinshc'=>__('Display list of attached files in song listing','wpsongbook'),
        'songbook_disp_filelistinsong'=>__('Display list of attached files automatically in songs','wpsongbook'),
        'songbook_disp_authorsinsong'=>__('Display authors name in song view','wpsongbook'),
        'songbook_disp_authorsinshc'=>__('Display authors name in song listing','wpsongbook'),
        'songbook_shcdefs'=>__('Song list defaults','wpsongbook'),
        'songbook_shcdefs_desc'=>__('You should use shortcode [songbook] to display songs list. Here you can specify your own parameters for list.','wpsongbook'),
        'songbook_shcdefs_orderby'=>__('Order songs by','wpsongbook'),
        'songbook_shcdefs_order'=>__('Order','wpsongbook'),
        'songbook_shcdefs_showfiles'=>__('Show attached files icons','wpsongbook'),
        'songbook_autoaddshcpage'=>__('Automatically add page with shortcode (use just if you are sure, you didn\'t do it yet, otherwise you will have it twice on your wordpress)','wpsongbook')
    );
    ?>
<div class="wrap"><div id="icon-tools" class="icon32" style="background:url('<?php plugins_url('../img/settings_screen_icon.png', __FILE__ ) ?>') no-repeat;width:45px;height:45px;"></div>
    <h2><?php echo$songbook_translation['songbook_sets']; ?></h2>
<?php
    if($_POST['songbook_savesets']){
        $songbook_newopts['songbook_enable_filelinking']=$_POST['songbook_enable_filelinking']; //y
        $songbook_newopts['songbook_enable_setbpm']=$_POST['songbook_enable_setbpm']; //y
        $songbook_newopts['songbook_enable_setvideolink']=$_POST['songbook_enable_setvideolink']; //y
        $songbook_newopts['songbook_enable_authorstax']=$_POST['songbook_enable_authorstax']; //y
        $songbook_newopts['songbook_enable_widget']=$_POST['songbook_enable_widget'];
        $songbook_newopts['songbook_enable_shortcode']=$_POST['songbook_enable_shortcode']; //y
        $songbook_newopts['songbook_mincap_addfiles']=$_POST['songbook_mincap_addfiles']; //y
        $songbook_newopts['songbook_mincap_addvideolink']=$_POST['songbook_mincap_addvideolink']; //y
        $songbook_newopts['songbook_mincap_addtempo']=$_POST['songbook_mincap_addtempo']; //y
        $songbook_newopts['songbook_mincap_manauthors']=$_POST['songbook_mincap_manauthors']; //y
        $songbook_newopts['songbook_disp_filelistinshc']=$_POST['songbook_disp_filelistinshc'];
        $songbook_newopts['songbook_disp_filelistinsong']=$_POST['songbook_disp_filelistinsong'];
        $songbook_newopts['songbook_disp_authorsinshc']=$_POST['songbook_disp_authorsinshc']; //y
        $songbook_newopts['songbook_disp_authorsinsong']=$_POST['songbook_disp_authorsinsong'];
        $songbook_newopts['songbook_shcdefs_orderby']=$_POST['songbook_shcdefs_orderby'];
        $songbook_newopts['songbook_shcdefs_order']=$_POST['songbook_shcdefs_order'];
        $songbook_newopts['songbook_shcdefs_showfiles']=$_POST['songbook_shcdefs_showfiles'];
        echo'<div class="successupd">';
        echo'<h3>'.$songbook_translation['changes'].'</h3>';
        echo'<ul>';
        $songbook_changecount=0;
        foreach(array_keys($songbook_newopts) as $songbook_key){
            if(get_option($songbook_key)!=$songbook_newopts[$songbook_key]){
                $songbook_translation_optval=($songbook_translation[$songbook_newopts[$songbook_key]]!='')?$songbook_translation[$songbook_newopts[$songbook_key]]:__('No','wpsongbook');
                $songbook_translation_optkey=($songbook_translation[$songbook_key])?$songbook_translation[$songbook_key]:$songbook_key;                
                echo'<li>'.$songbook_translation_optkey.':&nbsp;&nbsp;'.$songbook_translation_optval.'</li>';
                $songbook_changecount++;
            }
        }
        if($songbook_changecount<=0)echo$songbook_translation['no_changes'];
        echo'</ul>';
        echo'</div>';
        foreach(array_keys($songbook_newopts) as $songbook_key){
            songbook_saveopt($songbook_key,$songbook_newopts[$songbook_key]);
        }
        if($_POST['songbook_autoaddshcpage']){
            $songbook_shc_perpage=($songbook_newopts['songbook_shcdefs_perpage'])?' perpage='.$songbook_newopts['songbook_shcdefs_perpage']:'';
            $songbook_shc_orderby=($songbook_newopts['songbook_shcdefs_orderby'])?' orderby='.$songbook_newopts['songbook_shcdefs_orderby']:'';
            $songbook_shc_desc=($songbook_newopts['songbook_shcdefs_order'])?' '.$songbook_newopts['songbook_shcdefs_order']:'';
            $songbook_shc_showfiles=($songbook_newopts['songbook_shcdefs_showfiles'])?' showfiles='.$songbook_newopts['songbook_shcdefs_showfiles']:'';
            $songbook_postcontentshc='[songbook]';
            $post = array(
        'menu_order'     =>'5',
        'comment_status' =>'closed',
        'post_author'    =>'songbook plugin',
        'post_content'   =>$songbook_postcontentshc,
        'post_status'    =>'publish',
        'post_title'     =>__('Songs','wpsongbook'),
        'post_type'      =>'page'
        );  
        wp_insert_post($post);
        }
    } ?>
        <form action="#" method="post">
        <div class="oddil">
    <h3><?php echo$songbook_translation['songbook_general']; ?></h3>
            <p class="poznamka"><?php echo$songbook_translation['songbook_general_desc']; ?></p>
                <input type="checkbox" name="songbook_enable_filelinking" value="enable" <?php checked(get_option('songbook_enable_filelinking'),'enable'); ?>><?php echo$songbook_translation['songbook_enable_filelinking']; ?><br/>
                <input type="checkbox" name="songbook_enable_setbpm" value="enable" <?php checked(get_option('songbook_enable_setbpm'),'enable'); ?>><?php echo$songbook_translation['songbook_enable_setbpm']; ?><br/>
                <input type="checkbox" name="songbook_enable_setvideolink" value="enable" <?php checked(get_option('songbook_enable_setvideolink'),'enable'); ?>><?php echo$songbook_translation['songbook_enable_setvideolink']; ?><br/>
                <input type="checkbox" name="songbook_enable_authorstax" value="enable" <?php checked(get_option('songbook_enable_authorstax'),'enable'); ?>><?php echo$songbook_translation['songbook_enable_authorstax']; ?><br/>
                <input type="checkbox" name="songbook_enable_widget" value="enable" <?php checked(get_option('songbook_enable_widget'),'enable'); ?>><?php echo$songbook_translation['songbook_enable_widget']; ?>&nbsp;&nbsp;&nbsp;<span style="color:graytext;font-size:102%;font-style:italic;">//still not implemented</span><br/>
                <input type="checkbox" name="songbook_enable_shortcode" value="enable" <?php checked(get_option('songbook_enable_shortcode'),'enable'); ?>><?php echo$songbook_translation['songbook_enable_shortcode']; ?><br/>
        </div>
        <div class="oddil">
    <h3><?php echo$songbook_translation['songbook_caps']; ?></h3>
            <p class="poznamka"><?php echo$songbook_translation['songbook_caps_desc']; ?></p>
        <label for="songbook_mincap_addfiles"><?php echo$songbook_translation['songbook_mincap_addfiles']; ?></label>
            <select name="songbook_mincap_addfiles" id="songbook_mincap_addfiles">
                <option value="manage_options" <?php selected(get_option('songbook_mincap_addfiles'),'manage_options'); ?>>&nbsp;<?php echo$songbook_translation['manage_options']; ?>
                <option value="read_private_pages" <?php selected(get_option('songbook_mincap_addfiles'),'read_private_pages'); ?>>&nbsp;<?php echo$songbook_translation['read_private_pages']; ?>
                <option value="publish_posts" <?php selected(get_option('songbook_mincap_addfiles'),'publish_posts'); ?>>&nbsp;<?php echo$songbook_translation['publish_posts']; ?>
                <option value="edit_posts" <?php selected(get_option('songbook_mincap_addfiles'),'edit_posts') ?>>&nbsp;<?php echo$songbook_translation['edit_posts']; ?>
                <option value="read" <?php selected(get_option('songbook_mincap_addfiles'),'read') ?>>&nbsp;<?php echo$songbook_translation['read']; ?>
            </select>
        <label for="songbook_mincap_addvideolink"><?php echo$songbook_translation['songbook_mincap_addvideolink']; ?></label>
            <select name="songbook_mincap_addvideolink" id="songbook_mincap_addvideolink">
            <option value="manage_options" <?php selected(get_option('songbook_mincap_addvideolink'),'manage_options'); ?>>&nbsp;<?php echo$songbook_translation['manage_options']; ?>
            <option value="read_private_pages" <?php selected(get_option('songbook_mincap_addvideolink'),'read_private_pages'); ?>>&nbsp;<?php echo$songbook_translation['read_private_pages']; ?>
            <option value="publish_posts" <?php selected(get_option('songbook_mincap_addvideolink'),'publish_posts'); ?>>&nbsp;<?php echo$songbook_translation['publish_posts']; ?>
            <option value="edit_posts" <?php selected(get_option('songbook_mincap_addvideolink'),'edit_posts'); ?>>&nbsp;<?php echo$songbook_translation['edit_posts']; ?>
            <option value="read" <?php selected(get_option('songbook_mincap_addvideolink'),'read')?>>&nbsp;<?php echo$songbook_translation['read']; ?>
            </select>
        <label for="songbook_mincap_addtempo"><?php echo$songbook_translation['songbook_mincap_addtempo']; ?></label>
            <select name="songbook_mincap_addtempo" id="songbook_mincap_addtempo">'
            <option value="manage_options" <?php selected(get_option('songbook_mincap_addtempo'),'manage_options') ?>>&nbsp;<?php echo$songbook_translation['manage_options']; ?>
            <option value="read_private_pages" <?php selected(get_option('songbook_mincap_addtempo'),'read_private_pages'); ?>>&nbsp;<?php echo$songbook_translation['read_private_pages']; ?>
            <option value="edit_posts" <?php selected(get_option('songbook_mincap_addtempo'),'edit_posts')?>>&nbsp;<?php echo$songbook_translation['edit_posts']; ?>
            <option value="read" <?php selected(get_option('songbook_mincap_addtempo'),'read'); ?>>&nbsp;<?php echo$songbook_translation['read']; ?>
            </select>
        <label for="songbook_mincap_manauthor"><?php echo$songbook_translation['songbook_mincap_manauthor']; ?></label>
            <select name="songbook_mincap_manauthor" id="songbook_mincap_manauthor">'
            <option value="manage_options" <?php selected(get_option('songbook_mincap_manauthor'),'manage_options') ?>>&nbsp;<?php echo$songbook_translation['manage_options']; ?>
            <option value="manage_categories" <?php selected(get_option('songbook_mincap_manauthor'),'manage_categories') ?>>&nbsp;<?php echo$songbook_translation['manage_categories']; ?>
            <option value="read_private_pages" <?php selected(get_option('songbook_mincap_manauthor'),'read_private_pages'); ?>>&nbsp;<?php echo$songbook_translation['read_private_pages']; ?>
            <option value="edit_posts" <?php selected(get_option('songbook_mincap_manauthor'),'edit_posts')?>>&nbsp;<?php echo$songbook_translation['edit_posts']; ?>
            <option value="read" <?php selected(get_option('songbook_mincap_manauthor'),'read'); ?>>&nbsp;<?php echo$songbook_translation['read']; ?>
            </select>
        </div>
        <div class="oddil">
    <h3><?php echo$songbook_translation['songbook_behavior']; ?></h3>
            <p class="poznamka"><?php echo$songbook_translation['songbook_behavior_desc']; ?></p>
                <input type="checkbox" name="songbook_disp_filelistinsong" value="display" <?php checked(get_option('songbook_disp_filelistinsong'),'display'); ?>><?php echo$songbook_translation['songbook_disp_filelistinsong']; ?><br/>
                <input type="checkbox" name="songbook_disp_filelistinshc" value="display" <?php checked(get_option('songbook_disp_filelistinshc'),'display'); ?>><?php echo$songbook_translation['songbook_disp_filelistinshc']; ?><br/>
                <input type="checkbox" name="songbook_disp_authorsinshc" value="display" <?php checked(get_option('songbook_disp_authorsinshc'),'display'); ?>><?php echo$songbook_translation['songbook_disp_authorsinshc']; ?><br/>
                <input type="checkbox" name="songbook_disp_authorsinsong" value="display" <?php checked(get_option('songbook_disp_authorsinsong'),'display'); ?>><?php echo$songbook_translation['songbook_disp_authorsinsong']; ?><br/>
        </div>
        <div class="oddil">
    <h3><?php echo$songbook_translation['songbook_shcdefs']; ?></h3>
            <p class="poznamka"><?php echo$songbook_translation['songbook_shcdefs_desc']; ?></p>
                <label for="songbook_shcdefs_orderby"><?php echo$songbook_translation['songbook_shcdefs_orderby'] ?></label>
                <select name="songbook_shcdefs_orderby" id="songbook_shcdefs_orderby">
                    <option value="title" <?php selected(get_option('songbook_shcdefs_orderby'),'title') ?>>&nbsp;<?php echo$songbook_translation['title']; ?>
                    <option value="modified" <?php selected(get_option('songbook_shcdefs_orderby'),'modified') ?>>&nbsp;<?php echo$songbook_translation['modified']; ?>
                    <option value="ID" <?php selected(get_option('songbook_shcdefs_orderby'),'ID') ?>>&nbsp;<?php echo$songbook_translation['ID']; ?>
                    <option value="rand" <?php selected(get_option('songbook_shcdefs_orderby'),'rand') ?>>&nbsp;<?php echo$songbook_translation['rand']; ?>
                </select>
                <select name="songbook_shcdefs_order" id="songbook_shcdefs_order">
                    <option value="asc">&nbsp;<?php echo$songbook_translation['asc']; ?>
                    <option value="desc">&nbsp;<?php echo$songbook_translation['desc']; ?>
                </select><br/>
                <input type="checkbox" name="songbook_shcdefs_showfiles" value="desc" <?php checked(get_option('songbook_shcdefs_showfiles'),'desc'); ?>><?php echo$songbook_translation['songbook_shcdefs_showfiles']; ?><br/>
                <input type="checkbox" name="songbook_autoaddshcpage" id="songbook_autoaddshcpage" value="display"><?php echo$songbook_translation['songbook_autoaddshcpage']; ?><br/>
        </div>
        <input type="submit" value="Save settings" name="songbook_savesets" class="button-primary">
    </form>
    </div>
<?php
}
function songbook_registeradminlinks(){
   add_submenu_page('edit.php?post_type=song',__('How to use','wpsongbook'),__('How to use','wpsongbook'),'read','songbook-helplink','songbook_manpage');
   add_submenu_page('edit.php?post_type=song',__('Songbook settings','wpsongbook'),__('Songbook settings','wpsongbook'),'edit_dashboard','songbook-settlink','songbook_settpage');
        }
?>