<?php
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
}
/*function songbook_settpage(){
   	echo'<div class="wrap"><div id="icon-tools" class="icon32" style="background:url('.plugins_url('../img/settings_screen_icon.png', __FILE__ ).') no-repeat;width:45px;height:45px;"></div>';
	echo'<h2>'.__('Songbook settings','wpsongbook').'</h2>';
    echo'<h3>Capabilities, Allow add files,</h3>';
    echo'</div>';
}*/
function songbook_registeradminlinks(){
   add_submenu_page('edit.php?post_type=song',__('How to use','wpsongbook'),__('How to use','wpsongbook'),'read','songbook-helplink','songbook_manpage');
//   add_submenu_page('edit.php?post_type=song',__('Songbook settings','wpsongbook'),__('Songbook settings','wpsongbook'),'edit_dashboard','songbook-settlink','songbook_settpage');
        }
?>