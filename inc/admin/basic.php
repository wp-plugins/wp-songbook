<div class="field" id="enable_authorstax">
    <div class="left">
        <?php _e('Allow using authors', WPSB_LANGDOM); ?>
               
        <div class="note">
        <?php _e('Adds "Authors" taxonomy to sort songs by its author', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[enable_authorstax]">
            <option value="disable" <?php selected($this->option('enable_authorstax'), 'disable'); ?>><?php _e('Disable',WPSB_LANGDOM); ?>
            <option value="enable" <?php selected($this->option('enable_authorstax'), 'enable'); ?>><?php _e('Enable',WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="enable_albumstax">
    <div class="left">
        <?php _e('Allow using albums', WPSB_LANGDOM); ?>
               
        <div class="note">
        <?php _e('Adds "Albums" taxonomy to sort songs by its album', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[enable_albumstax]">
            <option value="disable" <?php selected($this->option('enable_albumstax'), 'disable'); ?>><?php _e('Disable',WPSB_LANGDOM); ?>
            <option value="enable" <?php selected($this->option('enable_albumstax'), 'enable'); ?>><?php _e('Enable',WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="enable_genrestax">
    <div class="left">
        <?php _e('Allow using genres', WPSB_LANGDOM); ?>
               
        <div class="note">
        <?php _e('Adds "Genre" taxonomy to sort songs by its genre', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[enable_genrestax]">
            <option value="disable" <?php selected($this->option('enable_genrestax'), 'disable'); ?>><?php _e('Disable',WPSB_LANGDOM); ?>
            <option value="enable" <?php selected($this->option('enable_genrestax'), 'enable'); ?>><?php _e('Enable',WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="enable_comments">
    <div class="left">
        <?php _e('Enable song comments', WPSB_LANGDOM); ?>
               
        <div class="note">
        <?php _e('Allows users to add comments to song (it may be set also differently for each song, if this is enabled)', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[enable_comments]">
            <option value="disable" <?php selected($this->option('enable_comments'), 'disable'); ?>><?php _e('Disable',WPSB_LANGDOM); ?>
            <option value="enable" <?php selected($this->option('enable_comments'), 'enable'); ?>><?php _e('Enable',WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="enable_filelinking">
    <div class="left">
        <?php _e('Allow file linking', WPSB_LANGDOM); ?>
               
        <div class="note">
        <?php _e('Adds extra field for attaching files to the song', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[enable_filelinking]">
            <option value="disable" <?php selected($this->option('enable_filelinking'), 'disable'); ?>><?php _e('Disable',WPSB_LANGDOM); ?>
            <option value="enable" <?php selected($this->option('enable_filelinking'), 'enable'); ?>><?php _e('Enable',WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="enable_setvideolink">
    <div class="left">
        <?php _e('Allow adding video link', WPSB_LANGDOM); ?>
               
        <div class="note">
        <?php _e('Adds extra field for song video link (Youtube)', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[enable_setvideolink]">
            <option value="disable" <?php selected($this->option('enable_setvideolink'), 'disable'); ?>><?php _e('Disable',WPSB_LANGDOM); ?>
            <option value="enable" <?php selected($this->option('enable_setvideolink'), 'enable'); ?>><?php _e('Enable',WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="enable_playlists">
    <div class="left">
        <?php _e('Allow using playlists', WPSB_LANGDOM); ?>
               
        <div class="note">
        <?php _e('Still in development, use at your own risk :)', WPSB_LANGDOM); ?><br/><br/>
        <?php _e('Adds new post type, that may make song lists (more songs together in custom order)', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[enable_playlists]">
            <option value="disable" <?php selected($this->option('enable_playlists'), 'disable'); ?>><?php _e('Disable',WPSB_LANGDOM); ?>
            <option value="enable" <?php selected($this->option('enable_playlists'), 'enable'); ?>><?php _e('Enable',WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="enable_sbwidget">
    <div class="left">
        <?php _e('Allow using sidebar widget', WPSB_LANGDOM); ?>
               
        <div class="note">
        <?php _e('Still in development, use at your own risk :)', WPSB_LANGDOM); ?><br/><br/>
        <?php _e('Adds new widget to display songbook info. You can find it on the Themes -> Widgets page', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[enable_sbwidget]">
            <option value="disable" <?php selected($this->option('enable_sbwidget'), 'disable'); ?>><?php _e('Disable',WPSB_LANGDOM); ?>
            <option value="enable" <?php selected($this->option('enable_sbwidget'), 'enable'); ?>><?php _e('Enable',WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="enable_sswidget">
    <div class="left">
        <?php _e('Allow Songside widgets', WPSB_LANGDOM); ?>
               
        <div class="note">
        <?php _e('Still in development, use at your own risk :)', WPSB_LANGDOM); ?><br/><br/>
        <?php _e('Adds opportunity to add useful informations to the bottom of the song content (you can specify here and also in editor for current song)', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[enable_sswidget]">
            <option value="disable" <?php selected($this->option('enable_sswidget'), 'disable'); ?>><?php _e('Disable',WPSB_LANGDOM); ?>
            <option value="enable" <?php selected($this->option('enable_sswidget'), 'enable'); ?>><?php _e('Enable',WPSB_LANGDOM); ?>
        </select>
    </div>
</div>