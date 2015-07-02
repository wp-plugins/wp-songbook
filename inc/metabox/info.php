<span class="label"><?php _e('Song tempo (BPM)', WPSB_LANGDOM); ?></span>
<input type="text" name="songbook[tempo]" value="<?php echo get_post_meta($post->ID, 'tempo', true); ?>"/>

<span class="label"><?php _e('Song duration (minutes)', WPSB_LANGDOM); ?></span>
<input type="text" name="songbook[duration]" value="<?php echo get_post_meta($post->ID, 'duration', true); ?>"/>