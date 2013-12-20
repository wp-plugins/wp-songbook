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
    echo'<div style="display:block;width:98%;margin:5px auto;">'.__('For attaching files with songs I recommend plugin <strong>WP Simple Filetopostlinker</strong>, becouse it\'s very simple for using, and good cooperating with this plugin.','wpsongbook').'</div>';
    echo'</div>';
}
function songbook_settpage(){
    if($_POST['songbook_savesets']){
        $songbook_newopts['songbook_enable_filelinking']=$_POST['songbook_enable_filelinking'];
        $songbook_newopts['songbook_enable_setbpm']=$_POST['songbook_enable_setbpm'];
        $songbook_newopts['songbook_enable_setvideolink']=$_POST['songbook_enable_setvideolink'];
        $songbook_newopts['songbook_enable_authorstax']=$_POST['songbook_enable_authorstax'];
        $songbook_newopts['songbook_enable_widget']=$_POST['songbook_enable_widget'];
        $songbook_newopts['songbook_enable_shortcode']=$_POST['songbook_enable_shortcode'];
        $songbook_newopts['songbook_mincap_addfiles']=$_POST['songbook_mincap_addfiles'];
        $songbook_newopts['songbook_mincap_addvideolink']=$_POST['songbook_mincap_addvideolink'];
        $songbook_newopts['songbook_mincap_addtempo']=$_POST['songbook_mincap_addtempo'];
        $songbook_newopts['songbook_mincap_manauthors']=$_POST['songbook_mincap_manauthors'];
        $songbook_newopts['songbook_disp_filelistinshc']=$_POST['songbook_disp_filelistinshc'];
        $songbook_newopts['songbook_disp_filelistinsong']=$_POST['songbook_disp_filelistinsong'];
        $songbook_newopts['songbook_disp_authorsinshc']=$_POST['songbook_disp_authorsinshc'];
        $songbook_newopts['songbook_disp_authorsinsong']=$_POST['songbook_disp_authorsinsong'];
        foreach(array_keys($songbook_newopts) as $key){
            songbook_saveopt($key,$songbook_newopts[$key]);
        }
    } ?>
    <div class="wrap"><div id="icon-tools" class="icon32" style="background:url('<?php plugins_url('../img/settings_screen_icon.png', __FILE__ ) ?>') no-repeat;width:45px;height:45px;"></div>
    <h2><?php _e('Songbook settings','wpsongbook'); ?></h2>
        <form action="#" method="post">
        <div class="oddil">
    <h3><?php _e('General plugin settings','wpsongbook'); ?></h3>
            <p class="poznamka"><?php _e('Basic control for plugin','wpsongbook') ?></p>
                <input type="checkbox" name="songbook_enable_filelinking" value="enable" <?php checked(get_option('songbook_enable_filelinking'),'enable'); ?>><?php _e('Allow file linking','wpsongbook'); ?><br/>
                <input type="checkbox" name="songbook_enable_setbpm" value="enable" <?php checked(get_option('songbook_enable_setbpm'),'enable'); ?>><?php _e('Allow adding tempo to song','wpsongbook'); ?><br/>
                <input type="checkbox" name="songbook_enable_setvideolink" value="enable" <?php checked(get_option('songbook_enable_setvideolink'),'enable'); ?>><?php _e('Allow adding video link','wpsongbook'); ?><br/>
                <input type="checkbox" name="songbook_enable_authorstax" value="enable" <?php checked(get_option('songbook_enable_authorstax'),'enable'); ?>><?php _e('Allow using authors','wpsongbook'); ?><br/>
                <input type="checkbox" name="songbook_enable_widget" value="enable" <?php checked(get_option('songbook_enable_widget'),'enable'); ?>><?php _e('Allow using widget','wpsongbook'); ?>&nbsp;&nbsp;&nbsp;<span style="color:graytext;font-size:102%;font-style:italic;">//still not implemented</span><br/>
                <input type="checkbox" name="songbook_enable_shortcode" value="enable" <?php checked(get_option('songbook_enable_shortcode'),'enable'); ?>><?php _e('Allow using list shortcode','wpsongbook'); ?><br/>
        </div>
        <div class="oddil">
    <h3><?php _e('Capabilities','wpsongbook'); ?></h3>
            <p class="poznamka"><?php _e('Allow only to users that can','wpsongbook'); ?></p>
        <label for="songbook_mincap_addfiles"><?php _e('Add files to songs','wpsongbook'); ?></label>
            <select name="songbook_mincap_addfiles" id="songbook_mincap_addfiles">
                <option value="manage_options" <?php selected(get_option('songbook_mincap_addfiles'),'manage_options'); ?>>&nbsp;<?php _e('Manage options','wpsongbook'); ?>
                <option value="read_private_pages" <?php selected(get_option('songbook_mincap_addfiles'),'read_private_pages'); ?>>&nbsp;<?php _e('Read private pages','wpsongbook'); ?>
                <option value="publish_posts" <?php selected(get_option('songbook_mincap_addfiles'),'publish_posts'); ?>>&nbsp;<?php _e('Publish posts','wpsongbook'); ?>
                <option value="edit_posts" <?php selected(get_option('songbook_mincap_addfiles'),'edit_posts') ?>>&nbsp;<?php _e('Edit posts','wpsongbook'); ?>
                <option value="read" <?php selected(get_option('songbook_mincap_addfiles'),'read') ?>>&nbsp;<?php _e('Read','wpsongbook'); ?>
            </select>
        <label for="songbook_mincap_addvideolink"><?php _e('Manage song video link','wpsongbook'); ?></label>
            <select name="songbook_mincap_addvideolink" id="songbook_mincap_addvideolink">
            <option value="manage_options" <?php selected(get_option('songbook_mincap_addvideolink'),'manage_options'); ?>>&nbsp;<?php _e('Manage options','wpsongbook'); ?>
            <option value="read_private_pages" <?php selected(get_option('songbook_mincap_addvideolink'),'read_private_pages'); ?>>&nbsp;<?php _e('Read private pages','wpsongbook'); ?>
            <option value="publish_posts" <?php selected(get_option('songbook_mincap_addvideolink'),'publish_posts'); ?>>&nbsp;<?php _e('Publish posts','wpsongbook'); ?>
            <option value="edit_posts" <?php selected(get_option('songbook_mincap_addvideolink'),'edit_posts') ?>>&nbsp;<?php _e('Edit posts','wpsongbook'); ?>
            <option value="read" <?php selected(get_option('songbook_mincap_addvideolink'),'read')?>>&nbsp;<?php _e('Read','wpsongbook'); ?>
            </select>
        <label for="songbook_mincap_addtempo"><?php _e('Manage song tempo','wpsongbook'); ?></label>
            <select name="songbook_mincap_addtempo" id="songbook_mincap_addtempo">'
            <option value="manage_options" <?php selected(get_option('songbook_mincap_addtempo'),'manage_options') ?>>&nbsp;<?php _e('Manage options','wpsongbook'); ?>
            <option value="read_private_pages" <?php selected(get_option('songbook_mincap_addtempo'),'read_private_pages'); ?>>&nbsp;<?php _e('Publish posts','wpsongbook'); ?>
            <option value="edit_posts" <?php selected(get_option('songbook_mincap_addtempo'),'edit_posts')?>>&nbsp;<?php _e('Edit posts','wpsongbook'); ?>
            <option value="read" <?php selected(get_option('songbook_mincap_addtempo'),'read'); ?>>&nbsp;<?php _e('Read','wpsongbook'); ?>
            </select>
        <label for="songbook_mincap_manauthor"><?php _e('Manage song authors','wpsongbook'); ?></label>
            <select name="songbook_mincap_manauthor" id="songbook_mincap_manauthor">'
            <option value="manage_options" <?php selected(get_option('songbook_mincap_manauthor'),'manage_options') ?>>&nbsp;<?php _e('Manage options','wpsongbook'); ?>
            <option value="read_private_pages" <?php selected(get_option('songbook_mincap_manauthor'),'read_private_pages'); ?>>&nbsp;<?php _e('Publish posts','wpsongbook'); ?>
            <option value="edit_posts" <?php selected(get_option('songbook_mincap_manauthor'),'edit_posts')?>>&nbsp;<?php _e('Edit posts','wpsongbook'); ?>
            <option value="read" <?php selected(get_option('songbook_mincap_manauthor'),'read'); ?>>&nbsp;<?php _e('Read','wpsongbook'); ?>
            </select>
        </div>
        <div class="oddil">
    <h3><?php _e('Behavior','wpsongbook'); ?></h3>
            <p class="poznamka"><?php _e('Appearance and beavior of publicly visible parts','wpsongbook') ?></p>
                <input type="checkbox" name="songbook_disp_filelistinsong" value="display" <?php checked(get_option('songbook_disp_filelistinsong'),'display'); ?>><?php _e('Display list of attached files automatically in songs','wpsongbook'); ?>&nbsp;&nbsp;&nbsp;<span style="color:graytext;font-size:102%;font-style:italic;">//still not implemented</span><br/>
                <input type="checkbox" name="songbook_disp_filelistinshc" value="display" <?php checked(get_option('songbook_disp_filelistinshc'),'display'); ?>><?php _e('Display attached files also in song list table as icons','wpsongbook'); ?>&nbsp;&nbsp;&nbsp;<span style="color:graytext;font-size:102%;font-style:italic;">//still not implemented</span><br/>
                <input type="checkbox" name="songbook_disp_authorsinshc" value="display" <?php checked(get_option('songbook_disp_authorsinshc'),'display'); ?>><?php _e('Display authors name in song listing','wpsongbook'); ?><br/>
                <input type="checkbox" name="songbook_disp_authorsinsong" value="display" <?php checked(get_option('songbook_disp_authorsinsong'),'display'); ?>><?php _e('Display authors name in song view','wpsongbook'); ?><br/>
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