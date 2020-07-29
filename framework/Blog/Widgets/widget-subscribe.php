<?php
add_action( 'widgets_init', 'gm_subscribe_widgets' );
function gm_subscribe_widgets() {
	register_widget('gm_subscribe_widget');
}
class gm_subscribe_widget extends WP_Widget {
	function gm_subscribe_widget() {
		$widget_ops = array( 'classname' => 'widget_subscribe', 'description' => 'Displays RSS Email Subscription Form' );
		$this->WP_Widget('gm_subscribe_widget', THEME_NAME .' - '.__( "RSS Email ile Abone Ol Bileşeni" , 'gm' ) , $widget_ops );
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array('title' => 'Abone Olun', 'subscribe_text' => 'Yazılarımızı fırından çıkar çıkmaz e-posta adresinde görmek ister misiniz?', 'feedid' => '') );
        $title = esc_attr($instance['title']);
		$feedid = $instance['feedid'];
?>
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
               <?php _e('Başlık', 'gm'); ?>
            </label>			
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p>
			<label for="<?php echo $this->get_field_id( 'subscribe_text' ); ?>"><?php _e('Açıklama:', 'gm'); ?></label>
			<textarea style="height:200px;" class="widefat" id="<?php echo $this->get_field_id( 'subscribe_text' ); ?>" name="<?php echo $this->get_field_name( 'subscribe_text' ); ?>"><?php echo stripslashes(htmlspecialchars(( $instance['subscribe_text'] ), ENT_QUOTES)); ?></textarea>
        </p>
		<p>
            <label for="<?php echo $this->get_field_id('feedid'); ?>">
               <?php _e('Feedburner ID:', 'gm'); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('feedid'); ?>" name="<?php echo $this->get_field_name('feedid'); ?>" type="text" value="<?php echo $feedid; ?>" />
        </p>
<?php
    }
	function update($new_instance, $old_instance) {
        $instance=$old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
		$instance['feedid'] = $new_instance['feedid'];
        $instance['subscribe_text'] = $new_instance['subscribe_text'];
        return $instance;
    }
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title'] );
		if ( empty($title) ) $title = false;
		$feedid = $instance['feedid'];	
		$subscribe_text = $instance['subscribe_text'];	
			echo $before_widget;
			echo $before_title;
			echo $title ; 
			echo $after_title; ?>
<form class="form-subscribe" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedid ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
  <p><?php echo $subscribe_text; ?></p>
  <div class="material-input subscribe">
    <input type="text" name="email" class="gm-subscribe-email" onblur="if(this.value=='')this.value='<?php _e('E-Posta','bg'); ?>';" onfocus="if(this.value=='<?php _e('E-Posta','bg'); ?>')this.value='';" value="<?php _e('E-Posta','bg'); ?>" />
	<input type="hidden" value="<?php echo $feedid ?>" name="uri" />
	<input type="hidden" name="loc" value="en_US"/>
	<label><i class="material-icons">mail_outline</i></label>
	<button type="submit" class="input-submit waves-effect"><i class="material-icons">arrow_downward</i></button>
</div>
</form>
        <?php
		echo $after_widget;
	}
}
?>