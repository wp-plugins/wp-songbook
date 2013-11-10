<?php
//add_action('widgets_init','songbook_widget');
function songbook_widget() {
	register_widget('songbook_widget');
}
class songbook_widget extends WP_Widget {
	function songbook_widget() {
		$songbook_widget_ops=array('classname'=>'songbookwidget','description'=>__('Widget to work with CPT song','songbook'));
		$songbook_control_ops=array('width'=>300,'height'=>350,'id_base'=>'songbook-widget');
		$this->WP_Widget('songbook-widget',__('Songbook widget','songbook'),$songbook_widget_ops,$songbook_control_ops);
	}
	function widget($args,$instance){
		extract($args);
		$songbook_title=apply_filters('widget_title',$instance['songbook_widgtitle']);
        $number=isset($instance['songbook_songcount'])?$instance['songbook_songcount']:8;
        
        echo $before_widget;
		if($songbook_title)echo $before_title.$songbook_title.$after_title;
                $songbook_qpwidget_args=array(
                    'post_type'=>'song',
                    'posts_per_page' => $number
                );
                while(have_posts()){
                   echo'<a href="'.get_permalink().'">';
                   the_title();
                   echo'</a>';
                }
		echo $after_widget;
	}
	function update($new_instance,$old_instance) {
		$instance=$old_instance;
		$instance['songbook_widgtitle']=strip_tags( $new_instance['songbook_widgtitle'] );
        $instance['songbook_songcount']=$new_instance['songbook_songcount'];
		return $instance;
	}
	function form($instance) {
		$defaults = array('songbook_widgtitle'=>__('Songbook widget','songbook'));
		$instance = wp_parse_args($instance, $defaults );
                ?>
            <div id="options" style="margin:0px 0 15px 0;padding:0px;">
               <p>
                   <label for="<?php echo $this->get_field_id('songbook_widgtitle'); ?>"><?php _e('Title:','songbook'); ?></label>
                   <input id="<?php echo $this->get_field_id('songbook_widgtitle'); ?>" name="<?php echo $this->get_field_name('songbook_widgtitle'); ?>" value="<?php echo $instance['songbook_widgtitle']; ?>" style="width:100%;" />
               </p>
               <p>
                   <label for="<?php echo $this->get_field_id('songbook_songcount'); ?>"><?php _e('Count of entries displayed:','songbook'); ?></label>
                   <input id="<?php echo $this->get_field_id('songbook_songcount'); ?>" name="<?php echo $this->get_field_name('songbook_songcount'); ?>" value="<?php echo $instance['songbook_songcount']; ?>" style="width:100%;" />
               </p>
            </div>
	<?php
	}
}
?>
