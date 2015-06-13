<div class="field" id="disp_backtolistinsong">
    <div class="left">
        <?php _e('Display link back to songlist', WPSB_LANGDOM); ?>
               
        <div class="note">
        <?php _e('Adds link to the page set for the song list above the lyrics', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[disp_backtolistinsong]">
            <option value="false" <?php selected($this->option('disp_backtolistinsong'), 'false'); ?>><?php _e('Don\'t display',WPSB_LANGDOM); ?>
            <option value="display" <?php selected($this->option('disp_backtolistinsong'), 'display'); ?>><?php _e('Display',WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="disp_filelistinsong">
    <div class="left">
        <?php _e('Display attached files', WPSB_LANGDOM); ?>
               
        <div class="note">
        <?php _e('Shows attached file list in songs', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[disp_filelistinsong]">
            <option value="false" <?php selected($this->option('disp_filelistinsong'), 'false'); ?>><?php _e('Don\'t display',WPSB_LANGDOM); ?>
            <option value="display" <?php selected($this->option('disp_filelistinsong'), 'display'); ?>><?php _e('Display',WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="disp_filelistforlogged">
    <div class="left">
        <?php _e('Display files only for members', WPSB_LANGDOM); ?>
               
        <div class="note">
        <?php _e('Whether to display the song files only to logged in members of the site', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[disp_filelistforlogged]">
            <option value="false" <?php selected($this->option('disp_filelistforlogged'), 'false'); ?>><?php _e('Don\'t display',WPSB_LANGDOM); ?>
            <option value="display" <?php selected($this->option('disp_filelistforlogged'), 'display'); ?>><?php _e('Display',WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="disp_videolinkinsong">
    <div class="left">
        <?php _e('Display video link', WPSB_LANGDOM); ?>
               
        <div class="note">
        <?php _e('Whether to display video link and where)', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[disp_videolinkinsong]">
            <option value="none" <?php selected($this->option('disp_videolinkinsong'), 'none'); ?>><?php _e('Dont display', WPSB_LANGDOM); ?>
            <option value="head" <?php selected($this->option('disp_videolinkinsong'), 'head'); ?>><?php _e('Display in songs head (together with authors etc.)', WPSB_LANGDOM); ?>
            <option value="embed_below" <?php selected($this->option('disp_videolinkinsong'), 'embed_below'); ?>><?php _e('Embed (below lyrics)', WPSB_LANGDOM); ?>
            <option value="within_files" <?php selected($this->option('disp_videolinkinsong'), 'within_files'); ?>><?php _e('In the file list', WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="disp_authorsinsong">
    <div class="left">
        <?php _e('Display authors in songs', WPSB_LANGDOM); ?>
               
        <div class="note">
        <?php _e('Display authors in songs', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[disp_authorsinsong]">
            <option value="false" <?php selected($this->option('disp_authorsinsong'), 'false'); ?>><?php _e('Don\'t display',WPSB_LANGDOM); ?>
            <option value="display" <?php selected($this->option('disp_authorsinsong'), 'display'); ?>><?php _e('Display',WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="disp_genresinsong">
    <div class="left">
        <?php _e('Display genres in songs', WPSB_LANGDOM); ?>
               
        <div class="note">
        <?php _e('Display genres in songs', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[disp_genresinsong]">
            <option value="false" <?php selected($this->option('disp_genresinsong'), 'false'); ?>><?php _e('Don\'t display',WPSB_LANGDOM); ?>
            <option value="display" <?php selected($this->option('disp_genresinsong'), 'display'); ?>><?php _e('Display',WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="disp_albumsinsong">
    <div class="left">
        <?php _e('Display albums in songs', WPSB_LANGDOM); ?>
               
        <div class="note">
        <?php _e('Display album in songs', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[disp_albumsinsong]">
            <option value="false" <?php selected($this->option('disp_albumsinsong'), 'false'); ?>><?php _e('Don\'t display',WPSB_LANGDOM); ?>
            <option value="display" <?php selected($this->option('disp_albumsinsong'), 'display'); ?>><?php _e('Display',WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="disp_lyrelement">
    <div class="left">
        <?php _e('Lyrics wrapper', WPSB_LANGDOM); ?>
               
        <div class="note">
        <?php _e('Select element which should wrap the song lyrics', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[disp_lyrelement]">
            <option value="none" <?php selected($this->option('disp_lyrelement'), 'none'); ?>><?php _e('No element',WPSB_LANGDOM); ?>
            <option value="div" <?php selected($this->option('disp_lyrelement'), 'div'); ?>><?php _e('Div',WPSB_LANGDOM); ?>
            <option value="blockquote" <?php selected($this->option('disp_lyrelement'), 'blockquote'); ?>><?php _e('Blockquote',WPSB_LANGDOM); ?>
            <option value="pre" <?php selected($this->option('disp_lyrelement'), 'pre'); ?>><?php _e('Preformated',WPSB_LANGDOM); ?>
            <option value="code" <?php selected($this->option('disp_lyrelement'), 'code'); ?>><?php _e('Code',WPSB_LANGDOM); ?>
        </select>
    </div>
</div>