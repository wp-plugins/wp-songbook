<div class="field" id="mincap_cpt_display">
    <div class="left">
        <?php _e('Show Songs menu', WPSB_LANGDOM); ?>

        <div class="note">
            <?php _e('Choose minimal permission, which user needs to be able to even see the "Songs" menu', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[mincap_cpt_display]">
            <option value="manage_options" <?php selected($this->option('mincap_cpt_display'), 'manage_options'); ?>><?php _e('Manage options', WPSB_LANGDOM); ?>
            <option value="read_private_pages" <?php selected($this->option('mincap_cpt_display'), 'read_private_pages'); ?>><?php _e('Read private pages', WPSB_LANGDOM); ?>
            <option value="publish_posts" <?php selected($this->option('mincap_cpt_display'), 'publish_posts'); ?>><?php _e('Publish posts', WPSB_LANGDOM); ?>
            <option value="edit_posts" <?php selected($this->option('mincap_cpt_display'), 'edit_posts'); ?>><?php _e('Edit posts', WPSB_LANGDOM); ?>
            <option value="read" <?php selected($this->option('mincap_cpt_display'), 'read'); ?>><?php _e('Read', WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="mincap_addfiles">
    <div class="left">
        <?php _e('Add files or video link to songs', WPSB_LANGDOM); ?>

        <div class="note">
            <?php _e('Choose minimal permission, which user needs to be able to add files or video links to the songs', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[mincap_addfiles]">
            <option value="manage_options" <?php selected($this->option('mincap_addfiles'), 'manage_options'); ?>><?php _e('Manage options', WPSB_LANGDOM); ?>
            <option value="read_private_pages" <?php selected($this->option('mincap_addfiles'), 'read_private_pages'); ?>><?php _e('Read private pages', WPSB_LANGDOM); ?>
            <option value="publish_posts" <?php selected($this->option('mincap_addfiles'), 'publish_posts'); ?>><?php _e('Publish posts', WPSB_LANGDOM); ?>
            <option value="edit_posts" <?php selected($this->option('mincap_addfiles'), 'edit_posts'); ?>><?php _e('Edit posts', WPSB_LANGDOM); ?>
            <option value="read" <?php selected($this->option('mincap_addfiles'), 'read'); ?>><?php _e('Read', WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="mincap_manauthors">
    <div class="left">
        <?php _e('Add and edit song taxonomies (authors, albums, genres)', WPSB_LANGDOM); ?>

        <div class="note">
            <?php _e('Choose minimal permission, which user needs to add and edit song taxonomies like Authors, Albums or Genre', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[mincap_manauthors]">
            <option value="manage_options" <?php selected($this->option('mincap_manauthors'), 'manage_options'); ?>><?php _e('Manage options', WPSB_LANGDOM); ?>
            <option value="read_private_pages" <?php selected($this->option('mincap_manauthors'), 'read_private_pages'); ?>><?php _e('Read private pages', WPSB_LANGDOM); ?>
            <option value="publish_posts" <?php selected($this->option('mincap_manauthors'), 'publish_posts'); ?>><?php _e('Publish posts', WPSB_LANGDOM); ?>
            <option value="edit_posts" <?php selected($this->option('mincap_manauthors'), 'edit_posts'); ?>><?php _e('Edit posts', WPSB_LANGDOM); ?>
            <option value="read" <?php selected($this->option('mincap_manauthors'), 'read'); ?>><?php _e('Read', WPSB_LANGDOM); ?>
        </select>
    </div>
</div>

<div class="field" id="mincap_ssidebar_control">
    <div class="left">
        <?php _e('Update song widget settings', WPSB_LANGDOM); ?>

        <div class="note">
            <?php _e('Choose minimal permission, which user needs to be able to set content of the song widgets', WPSB_LANGDOM); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[mincap_ssidebar_control]">
            <option value="manage_options" <?php selected($this->option('mincap_ssidebar_control'), 'manage_options'); ?>><?php _e('Manage options', WPSB_LANGDOM); ?>
            <option value="read_private_pages" <?php selected($this->option('mincap_ssidebar_control'), 'read_private_pages'); ?>><?php _e('Read private pages', WPSB_LANGDOM); ?>
            <option value="publish_posts" <?php selected($this->option('mincap_ssidebar_control'), 'publish_posts'); ?>><?php _e('Publish posts', WPSB_LANGDOM); ?>
            <option value="edit_posts" <?php selected($this->option('mincap_ssidebar_control'), 'edit_posts'); ?>><?php _e('Edit posts', WPSB_LANGDOM); ?>
            <option value="read" <?php selected($this->option('mincap_ssidebar_control'), 'read'); ?>><?php _e('Read', WPSB_LANGDOM); ?>
        </select>
    </div>
</div>