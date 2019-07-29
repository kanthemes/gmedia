<?php
add_action( 'widgets_init', 'tie_Author_Bio_widget' );
function tie_Author_Bio_widget() {
	register_widget( 'tie_Author_Bio' );
}
class tie_Author_Bio extends WP_Widget {

	function tie_Author_Bio() {
		$widget_ops = array( 'classname' => 'Author-Bio' );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'author-bio-widget' );
		$this->WP_Widget( 'author-bio-widget', THEME_NAME .' - '.__( 'Yazar Profil' , 'gm' ) , $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$img = $instance['img'];
		$author = $instance['author'];
		$coverimg = $instance['coverimg'];
		if( function_exists('icl_t') )  $text_code = icl_t( THEME_NAME , 'widget_content_'.$this->id , $instance['text_code'] ); else $text_code = $instance['text_code'] ;
	
			echo $before_widget;
			echo $before_title;
			echo $title ; 
			echo $after_title; ?>
			<div class="widget_Author-Bio">
			<script>
			  //document ready
			  $(function() {
				$(".dropdown-button").dropdown({
				  inDuration: 300,
				  outDuration: 225,
				  constrain_width: false, // Does not change width of dropdown to that of the activator
				  // gutter: -130, // Spacing from edge
				  belowOrigin: false, // Displays dropdown below the button
				  alignment: 'left'
				});
			  }); // end of document ready
			})(jQuery); // end of jQuery name space
			</script>
			<div class="autor-page">
				<div class="author-cover" style="background: url(<?php echo $coverimg; ?>)no-repeat center center/cover">
					<div class="author-top">
						<div class="author-top-left">
							<i class="fa fa-bars"></i> Profil
						</div>
						<div class="author-top-right">
							<a href="#!" data-activates='dropdown1' class="secondary-content dropdown-button btn transparent waves-effect"><i class="fa fa-ellipsis-v"></i></a>
							<ul id='dropdown1' class='dropdown-content'>
							  <li><a href="#!">Facebook</a></li>
							  <li><a href="#!">Twitter</a></li>
							  <li><a href="#!">Google +</a></li>
							</ul>
						</div>
					</div>
					<div class="author-profil">
						<div class="author-name">
							<h1><?php echo $author; ?></h1>
						</div>
						<div class="author-avatar">
							<img alt="<?php echo $author; ?>" height="70" width="70" src="<?php echo $img; ?>">
						</div>
					</div>
				</div>
				<div class="author-description">
			<?php
			echo do_shortcode( $text_code ); ?>
			</div>
			</div>		
			</div>		
			<?php
			echo $after_widget;
		
		
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['author'] = strip_tags( $new_instance['author'] );
		$instance['img'] = $new_instance['img'] ;
		$instance['coverimg'] = $new_instance['coverimg'] ;
		$instance['text_code'] = $new_instance['text_code'] ;
		
		if (function_exists('icl_register_string')) {
			icl_register_string( THEME_NAME , 'widget_content_'.$this->id, $new_instance['text_code'] );
		}
		
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__( 'About Author' , 'gm') );
		$defaults = array( 'author' =>__( 'Author' , 'gm') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Başlık:' , 'gm') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty($instance['title']) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'author' ); ?>"><?php _e( 'İsminiz:' , 'gm') ?></label>
			<input id="<?php echo $this->get_field_id( 'author' ); ?>" name="<?php echo $this->get_field_name( 'author' ); ?>" value="<?php if( !empty($instance['author']) ) echo $instance['author']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'img' ); ?>"><?php _e( 'Arkaplan URL:' , 'gm') ?><div class="description"><i>Standart: 345x150px</i></div></label>
			<input id="<?php echo $this->get_field_id( 'coverimg' ); ?>" name="<?php echo $this->get_field_name( 'coverimg' ); ?>" value="<?php if( !empty($instance['coverimg']) ) echo $instance['coverimg']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'img' ); ?>"><?php _e( 'Avatar URL' , 'gm') ?><div class="description"><i>Standart: 75x75px</i></div></label>
			<input id="<?php echo $this->get_field_id( 'img' ); ?>" name="<?php echo $this->get_field_name( 'img' ); ?>" value="<?php if( !empty($instance['img']) ) echo $instance['img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'text_code' ); ?>"><?php _e( 'Hakkımda:' , 'gm') ?><i></i></label>
			<textarea rows="15" id="<?php echo $this->get_field_id( 'text_code' ); ?>" name="<?php echo $this->get_field_name( 'text_code' ); ?>" class="widefat" ><?php if( !empty($instance['text_code']) ) echo $instance['text_code']; ?></textarea>
		</p>
		


	<?php
	}
}
?>