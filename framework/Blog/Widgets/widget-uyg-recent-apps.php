<?php
add_action( 'widgets_init', 'gm_uyg_widget' );
function gm_uyg_widget() {
	register_widget( 'gm_uygwidget' );
}
class gm_uygwidget extends WP_Widget {
	function gm_uygwidget() {
		$widget_ops = array( 'classname' => 'gm_uyg_widget' );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'gm_uyg_widget' );
		$this->WP_Widget( 'gm_uyg_widget', THEME_NAME .' - '.__( 'Sidebar Son Uygulamalar' , 'gm' ) , $widget_ops, $control_ops );
	}
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$posts = $instance['posts'];
			echo $before_widget;
			echo $before_title;
			echo $title ; 
			echo $after_title; ?>
				<?php
					$popular_posts = new WP_Query( array(
						'post_type' => 'uygulama',
						'posts_per_page' => $posts
					) );
					if($popular_posts->have_posts()): ?>
						<?php while($popular_posts->have_posts()): $popular_posts->the_post(); ?>
						<div class="tabitem">
								<div class="tabimage pull-left">
									<?php the_post_thumbnail( array(50,50) ); ?>
								</div>
							<div class="tabPost">
								<h2><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php $values = get_post_custom_values("gm_down_title"); echo $values[0]; ?></a></h2>
								<div class="meta">
									<span class="gelistirici"><?php $values = get_post_custom_values("gm_down_develop"); echo $values[0]; ?>, </span>
									<?php if ( $terms = get_the_terms( $post->ID , 'tur' )): ?>
										<?php foreach( $terms as $term ) { ?>
											<a href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a>
										<?php unset($term); } ?>
									<?php else: ?>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<?php endwhile; ?>
					<?php endif; ?>
			<?php
			echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['posts'] = strip_tags( $new_instance['posts'] );
		return $instance;
	}
	function form( $instance ) {
		$defaults = array('title' => 'Son Uygulamalar', 'posts' => 5);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Başlık:' , 'gm') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty($instance['title']) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e( 'Yazı Sayısı:' , 'gm') ?></label>
			<input id="<?php echo $this->get_field_id( 'posts' ); ?>" name="<?php echo $this->get_field_name( 'posts' ); ?>" value="<?php if( !empty($instance['posts']) ) echo $instance['posts']; ?>" class="widefat" type="text" />
		</p>
	<?php
	}
}
?>