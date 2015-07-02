<div class="tab" id="songfiles">
    <div class="uploader">
        <div class="button" id="songbook_addfile_button"><?php _e('Add files', WPSB_LANGDOM) ?></div>
        <input type="hidden" name="songbook_filebox_noncename" id="songbook_noncename" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)) ?>"/>
    </div>
    <div id="obal">
        <?php
        $files = (get_post_meta($post->ID, 'files', true) !== "N") ? get_post_meta($post->ID, 'files', true) : false;

        $keys = array_keys($files);
        for ($i = 0; $i < count($files); $i++) {
            $att=get_post($keys[$i]);
            
            $fid=$keys[$i];
            $title=(isset($files[$i]['title']))?$files[$i]['title']:$att->post_title;
            $lockclass=(isset($files[$i]['private']))?$files[$i]['private']:'locked';
            
            ?>

            <div class="file" id="file_<?php echo $fid; ?>">
                <span class="exticon <?php echo ($files[$fid]['extension']) ? $files[$fid]['extension'] : ''; ?>">
                </span>
                <div class="maininfo">
                    <p class="filetitle">
                        <a id="href_<?php echo $fid; ?>" href="<?php echo $files[$fid]['url']; ?>" target="_blank">
                            <?php echo $title; ?>
                        </a>
                    </p>

                    <?php
                        $j=0;
                        $keysb=array_keys($files[$keys[$i]]);
                        while($j<count($keysb)){
                            echo $this->add_element('input',array(
                                'type'=>'hidden',
                                'name'=>"songbook[files][$fid][$keysb[$j]]",
                                'value'=>$files[$fid][$keysb[$j]]
                            )).PHP_EOL;
                            $j++;
                        }
                    ?>

                    <p class="toolbar">
                        <span class="toolspan">
                            <a class="textch" rel="<?php echo $fid; ?>"></a>
                            <a class="lock <?php echo $lockclass; ?>" rel="<?php echo $fid; ?>"></a>
                            <a class="remover" rel="<?php echo $fid; ?>"></a>
                        </span>
                    </p>
                </div>
            </div>

            <?php
        }
        ?>


    </div>
</div>