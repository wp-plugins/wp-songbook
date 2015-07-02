<div class="content">
    <div class="left">
        <div class="text">
            <p class="title"><?php _e('Wordpress Songbook', WPSB_LANGDOM); ?> v. <?php echo(WPSB_VERSION); ?></p>
            <?php _e('You may use these pages to set the behavior of the plugin. Just choose part that you would like to change on the right.', WPSB_LANGDOM); ?>
        </div>
        <div class="text">
            <p class="title"><?php _e('Notice', WPSB_LANGDOM); ?></p>
            <?php _e('Some of the features are still in development or were not implemented yet. Please, use them with caution on your own risk', WPSB_LANGDOM); ?>
        </div>
        <div class="text">
            <?php

            FUNCTION inverseHex($color) {
                $color = TRIM($color);
                $prependHash = FALSE;

                IF (STRPOS($color, '#') !== FALSE) {
                    $prependHash = TRUE;
                    $color = STR_REPLACE('#', '', $color);
                }

                SWITCH ($len = STRLEN($color)) {
                    CASE 3:
                        $color = PREG_REPLACE("/(.)(.)(.)/", "\\1\\1\\2\\2\\3\\3", $color);
                    CASE 6:
                        BREAK;
                    DEFAULT:
                        TRIGGER_ERROR("Invalid hex length ($len). Must be (3) or (6)", E_USER_ERROR);
                }

                IF (!PREG_MATCH('/[a-f0-9]{6}/i', $color)) {
                    $color = HTMLENTITIES($color);
                    TRIGGER_ERROR("Invalid hex string #$color", E_USER_ERROR);
                }

                $r = DECHEX(255 - HEXDEC(SUBSTR($color, 0, 2)));
                $r = (STRLEN($r) > 1) ? $r : '0' . $r;
                $g = DECHEX(255 - HEXDEC(SUBSTR($color, 2, 2)));
                $g = (STRLEN($g) > 1) ? $g : '0' . $g;
                $b = DECHEX(255 - HEXDEC(SUBSTR($color, 4, 2)));
                $b = (STRLEN($b) > 1) ? $b : '0' . $b;

                RETURN ($prependHash ? '#' : NULL) . $r . $g . $b;
            }

            foreach (array_keys($this->getadmincolors()->colors) as $color) {
                echo'<span style="display:block;color:' . inverseHex($this->getadmincolors()->colors[$color]) . ';padding:4px;height:20px;margin:2px;float:left;background:' . $this->getadmincolors()->colors[$color] . ';">' . $color . '</span>';
            }
            echo'<br/>';
            echo'<br/>';
            foreach (array_keys($this->getadmincolors()->icon_colors) as $color) {
                echo'<span style="display:block;color:' . inverseHex($this->getadmincolors()->icon_colors[$color]) . ';padding:4px;height:20px;margin:2px;float:left;background:' . $this->getadmincolors()->icon_colors[$color] . ';">' . $color . '</span>';
            }
            ?>
        </div>
    </div>
    <div class = "right">
        <input type = "button" class = "button-primary button-donate"/>
    </div>
</div>