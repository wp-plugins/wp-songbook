<span class="label">
    <?php
    $taggedin = get_post_meta(get_the_ID(), 'playlists', true);
    $playlists = get_posts(array(
        'post_type' => 'playlist',
        'posts_per_page' => 5
    ));
    
    if ($taggedin)
        _e('Song is already a part of these playlists:', WPSB_LANGDOM);
    else
        _e('Song hasn\'t been added to any playlist yet', WPSB_LANGDOM);
    ?>
</span>