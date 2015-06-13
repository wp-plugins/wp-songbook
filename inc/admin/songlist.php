<div class="field" id="shcdefs_listpageid">
    <div class="left">
        <?php _e('Song list page', WPSB_LANGDOM); ?>

        <div class="note">
            <?php _e('Choose page on which should be the list printed', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[shcdefs_listpageid]">
            <?php
            query_posts(array('post_type' => 'page', 'nopaging' => true, 'orderby' => 'title'));

            $songbook_pageselect = '<option value="autoaddpage">' . __('Autoadd new page', WPSB_LANGDOM) . PHP_EOL;
            if (have_posts())
                while (have_posts()):the_post();

                    $songbook_selected = ($this->option('shcdefs_listpageid') == get_the_ID()) ? 'selected="selected"' : '';
                    $songbook_pageselect.='<option value="' . get_the_ID() . '" ' . $songbook_selected . '>&nbsp;' . get_the_title() . PHP_EOL;
                endwhile;

            echo$songbook_pageselect;
            ?>
        </select>
        <?php
        if ($this->option('shcdefs_listpageid') > 0) {
            $title = get_the_title($this->option('shcdefs_listpageid'));
            $permalink = get_the_permalink($this->option('shcdefs_listpageid'));
            echo __('Visit page:', WPSB_LANGDOM) . "&nbsp; <a href=\"$permalink\" target=\"_blank\">$title</a>";
        }
        ?>
        <input type="text"<?php if ($this->option('shcdefs_listpageid') > 0) echo' class="hidden"'; ?> id="shcdefs_autoadd_pgtitle" name="songbook[shcdefs_autoadd_pgtitle]" placeholder="<?php _e('Fill in your new page title', WPSB_LANGDOM); ?>">
    </div>
</div>

<div class="field" id="shcdefs_dispcont">
    <div class="left">
<?php _e('Display first', WPSB_LANGDOM); ?>

        <div class="note">
        <?php _e('Sets what will the list contain. You may set, the list will contain names of all authors with link to list of their songs etc.', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[shcdefs_dispcont]">
            <option value="songs" <?php selected($this->option('shcdefs_dispcont'), 'songs'); ?>><?php _e('Songs', WPSB_LANGDOM); ?>
            <option value="authors" <?php selected($this->option('shcdefs_dispcont'), 'authors'); ?>><?php _e('Authors', WPSB_LANGDOM); ?>
            <option value="albums" <?php selected($this->option('shcdefs_dispcont'), 'albums'); ?>><?php _e('Albums', WPSB_LANGDOM); ?>
            <option value="genres" <?php selected($this->option('shcdefs_dispcont'), 'genres'); ?>><?php _e('Genres', WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="shcdefs_tablecont">
<?php
_e('Songlist table content', WPSB_LANGDOM);
?>

    <div class="note">
    <?php _e('Only for experimental use',WPSB_LANGDOM); ?><br/>
    <?php _e('Allows to set order of collumns in the song list table', WPSB_LANGDOM); ?>
    </div>
<?php

$columns=$this->fields($this->option('shcdefs_dispcont'));

?>
    <div class="sortable-x">
        <?php
            $keys=($this->option('shcdefs_tablecont'))?$this->option('shcdefs_tablecont'):array_keys($columns);
            $i=0;
            
            while($i<count($keys)){
                
                if(isset($columns[$keys[$i]])){
                    echo'<div class="tbitem" id='.$keys[$i].'>';
                    echo'<input type="hidden" name="songbook[shcdefs_tablecont][]" value="'.$keys[$i].'"/>';
                    echo $columns[$keys[$i]];
                    echo'</div>';
                }                
                
                $i++;
            }
            
            if(array_diff(array_keys($columns),$keys)){
                $keys=array_diff(array_keys($columns),$keys);
                $k=array_keys($keys);
                $i=0;
            while($i<count($keys)){
                
                    echo'<div class="tbitem" id='.$keys[$k[$i]].'>';
                    echo'<input type="hidden" name="songbook[shcdefs_tablecont][]" value="'.$keys[$k[$i]].'"/>';
                    echo $columns[$keys[$k[$i]]];
                    echo'</div>';
                    $i++;
                }
            
            }
        ?>
    </div>
    
</div>

<div class="field" id="shcdefs_orderby">
    <div class="left">
<?php _e('Order songs by', WPSB_LANGDOM); ?>

        <div class="note">
        <?php _e('This will order the songs by selected term', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[shcdefs_orderby]">
            <option value="songs" <?php selected($this->option('shcdefs_orderby'), 'songs'); ?>><?php _e('Song title', WPSB_LANGDOM); ?>
            <option value="authors" <?php selected($this->option('shcdefs_orderby'), 'authors'); ?>><?php _e('Song author', WPSB_LANGDOM); ?>
            <option value="albums" <?php selected($this->option('shcdefs_orderby'), 'albums'); ?>><?php _e('Song album', WPSB_LANGDOM); ?>
            <option value="genres" <?php selected($this->option('shcdefs_orderby'), 'genres'); ?>><?php _e('Song genre', WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="shcdefs_order">
    <div class="left">
<?php _e('List order', WPSB_LANGDOM); ?>

        <div class="note">
        <?php _e('Sets ascending or descending ordering by the term above', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[shcdefs_order]">
            <option value="asc" <?php selected($this->option('shcdefs_order'), 'asc'); ?>><?php _e('Ascending', WPSB_LANGDOM); ?>
            <option value="desc" <?php selected($this->option('shcdefs_order'), 'desc'); ?>><?php _e('Descending', WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="shcdefs_thead">
    <div class="left">
<?php _e('Display table head', WPSB_LANGDOM); ?>

        <div class="note">
        <?php _e('Display each column\'s description in the song list', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[shcdefs_thead]">
            <option value="false" <?php selected($this->option('shcdefs_thead'), 'false'); ?>><?php _e('Don\'t display', WPSB_LANGDOM); ?>
            <option value="display" <?php selected($this->option('shcdefs_thead'), 'display'); ?>><?php _e('Display', WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="shcdefs_dispauthor">
    <div class="left">
<?php _e('Display author', WPSB_LANGDOM); ?>

        <div class="note">
        <?php _e('Display author(s) of each song in the list', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[shcdefs_dispauthor]">
            <option value="false" <?php selected($this->option('shcdefs_dispauthor'), 'false'); ?>><?php _e('Don\'t display', WPSB_LANGDOM); ?>
            <option value="display" <?php selected($this->option('shcdefs_dispauthor'), 'display'); ?>><?php _e('Display', WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="shcdefs_dispgenre">
    <div class="left">
<?php _e('Display genre', WPSB_LANGDOM); ?>

        <div class="note">
        <?php _e('Display genre of each song in the list', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[shcdefs_dispgenre]">
            <option value="false" <?php selected($this->option('shcdefs_dispgenre'), 'false'); ?>><?php _e('Don\'t display', WPSB_LANGDOM); ?>
            <option value="display" <?php selected($this->option('shcdefs_dispgenre'), 'display'); ?>><?php _e('Display', WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="shcdefs_dispalbum">
    <div class="left">
<?php _e('Display album', WPSB_LANGDOM); ?>

        <div class="note">
        <?php _e('Display album of each song in the list', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[shcdefs_dispalbum]">
            <option value="false" <?php selected($this->option('shcdefs_dispalbum'), 'false'); ?>><?php _e('Don\'t display', WPSB_LANGDOM); ?>
            <option value="display" <?php selected($this->option('shcdefs_dispalbum'), 'display'); ?>><?php _e('Display', WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="shcdefs_dispyear">
    <div class="left">
<?php _e('Display year', WPSB_LANGDOM); ?>

        <div class="note">
        <?php _e('Adds column to display song year - you have to set it as publishing time of the song in the "publish" tab of editor', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[shcdefs_dispyear]">
            <option value="false" <?php selected($this->option('shcdefs_dispyear'), 'false'); ?>><?php _e('Don\'t display', WPSB_LANGDOM); ?>
            <option value="display" <?php selected($this->option('shcdefs_dispyear'), 'display'); ?>><?php _e('Display', WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="shcdefs_dispsongcount">
    <div class="left">
<?php _e('Display song count', WPSB_LANGDOM); ?>

        <div class="note">
        <?php _e('Displays count of the songs contained in current term (Author, Album or Genre) - useful e.g. when you set a list of authors', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[shcdefs_dispsongcount]">
            <option value="false" <?php selected($this->option('shcdefs_dispsongcount'), 'false'); ?>><?php _e('Don\'t display', WPSB_LANGDOM); ?>
            <option value="display" <?php selected($this->option('shcdefs_dispsongcount'), 'display'); ?>><?php _e('Display', WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="disp_videolinkinshc">
    <div class="left">
<?php _e('Display video link', WPSB_LANGDOM); ?>

        <div class="note">
        <?php _e('Still in development, use at your own risk :)', WPSB_LANGDOM); ?><br/><br/>
<?php _e('Whether to display video link in the song list', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[disp_videolinkinshc]">
            <option value="false" <?php selected($this->option('disp_videolinkinshc'), 'false'); ?>><?php _e('Don\'t display', WPSB_LANGDOM); ?>
            <option value="display" <?php selected($this->option('disp_videolinkinshc'), 'display'); ?>><?php _e('Display', WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="disp_songfilesinshc">
    <div class="left">
<?php _e('Display linked files', WPSB_LANGDOM); ?>

        <div class="note">
        <?php _e('Still in development, use at your own risk :)', WPSB_LANGDOM); ?><br/><br/>
<?php _e('Whether to display linked files (as filetype icons) in the song list', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[disp_songfilesinshc]">
            <option value="false" <?php selected($this->option('disp_songfilesinshc'), 'false'); ?>><?php _e('Don\'t display', WPSB_LANGDOM); ?>
            <option value="display" <?php selected($this->option('disp_songfilesinshc'), 'display'); ?>><?php _e('Display', WPSB_LANGDOM); ?>
        </select>
    </div>
</div>