<?php
add_action( 'widgets_init', 'recent_posts_widget' );
function recent_posts_widget() {
	register_widget( 'recent_posts' );
}
class recent_posts extends WP_Widget {
	public function __construct(){
		$widget_ops = array( 'classname' => 'recentpost', 'description' => 'Seçeneceğiniz kategorinin son yazılarını listeyen son yazılar bileşeni.' );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'recentpost_widget' );
		parent::__construct( 'recentpost_widget', THEME_NAME .' - '.__( "Sidebar Küçük Son Yazılar" , 'geo' ) , $widget_ops, $control_ops );
	}
	public function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title'] );
		$no_of_posts = $instance['no_of_posts'];
		$cats_id = $instance['cats_id'];
		$thumb = $instance['thumb'];
		echo $before_widget;
			echo $before_title;
			echo $title ; ?>
		<?php echo $after_title; ?>
		<?php gm_recent_entries($no_of_posts , $thumb , $cats_id)?>
	<?php 
		echo $after_widget;
	}
	public function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['no_of_posts'] = strip_tags( $new_instance['no_of_posts'] );
		$instance['cats_id'] = implode(',' , $new_instance['cats_id']  );
		$instance['thumb'] = strip_tags( $new_instance['thumb'] );
		return $instance;
	}
	public function form($instance){
		$defaults = array( 'title' =>__( 'Category Posts' , 'geo'), 'no_of_posts' => '5' , 'cats_id' => '1' , 'thumb' => 'true' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		$categories_obj = get_categories();
		$categories = array();
		foreach ($categories_obj as $pn_cat) {
			$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Başlık:' , 'geo') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>"><?php _e( 'Yazı Sayısı:' , 'geo') ?></label>
			<input id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" value="<?php echo $instance['no_of_posts']; ?>" type="text" size="3" />
		</p>
		<p>
			<?php $cats_id = explode ( ',' , $instance['cats_id'] ) ; ?>
			<label for="<?php echo $this->get_field_id( 'cats_id' ); ?>"><?php _e( 'Kategori:' , 'geo') ?></label>
			<select multiple="multiple" id="<?php echo $this->get_field_id( 'cats_id' ); ?>[]" name="<?php echo $this->get_field_name( 'cats_id' ); ?>[]">
				<?php foreach ($categories as $key => $option) { ?>
				<option value="<?php echo $key ?>" <?php if ( in_array( $key , $cats_id ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'thumb' ); ?>"><?php _e( 'Resimler Görünsün:' , 'geo') ?></label>
			<input id="<?php echo $this->get_field_id( 'thumb' ); ?>" name="<?php echo $this->get_field_name( 'thumb' ); ?>" value="true" <?php if( $instance['thumb'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
	<?php
	}
}
?>