<?php
function songbook_saveopt($songbook_optname,$songbook_newoptvalue){
    if(!get_option($songbook_optname))add_option($songbook_optname);
    update_option($songbook_optname,$songbook_newoptvalue);
}