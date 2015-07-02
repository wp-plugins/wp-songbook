<div class="field" id="text_backtolist">
    <?php _e('Back to list link text', WPSB_LANGDOM); ?>

    <div class="note">
        <?php _e('Sets the back to list link text', WPSB_LANGDOM); ?>
    </div>

    <textarea name="songbook[text_backtolist]"><?php echo $this->option('text_backtolist'); ?></textarea>

</div>

<div class="field" id="text_error_nothingfound">
    <?php _e('Nothing found text', WPSB_LANGDOM); ?>

    <div class="note">
        <?php _e('Sets text displayed when nothing was found for selected condition', WPSB_LANGDOM); ?>
    </div>

    <textarea name="songbook[text_error_nothingfound]"><?php echo $this->option('text_error_nothingfound'); ?></textarea>

</div>

<div class="field" id="text_error_disabled">
    <?php _e('Function disabled text', WPSB_LANGDOM); ?>

    <div class="note">
        <?php _e('Sets text displayed when required function of plugin is disabled at the moment', WPSB_LANGDOM); ?>
    </div>

    <textarea name="songbook[text_error_disabled]"><?php echo $this->option('text_error_disabled'); ?></textarea>

</div>