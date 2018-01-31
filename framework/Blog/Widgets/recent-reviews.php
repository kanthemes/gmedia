<?php

function gm_load_recent_reviews() {
	register_widget('gm_recent_reviews');
}

add_action('widgets_init', 'gm_load_recent_reviews');

class gm_recent_reviews extends WP_Widget {

/* Widget setup. */

function gm_recent_reviews() {
	$widget_ops = array( 'classname' => 'gm_recent_reviews', 'description' => __('(Sidebar) A widget that displays recent reviews.', 'gm') );
	$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'gm_recent_reviews');
	$this->WP_Widget('gm_recent_reviews', THEME_NAME .' - '.__( "Son İncelemeler" , 'gm' ) , $widget_ops, $control_ops );
}
	
/* Display the widget on the screen. */

function widget($args, $instance) {
	extract($args);
	$title = apply_filters('widget_title', $instance['title'] );
	$posts = $instance['posts'];
	echo $before_widget;

	if($title) { echo $before_title . $title . $after_title; } ?>
	<div class="recentreviews">
	<?php $recent_reviews = new WP_Query(array('showposts' => $posts, 'meta_key' => 'gm_enable_review', 'meta_value' => 'on',)); ?>
	<?php if ($recent_reviews->have_posts()) : ?>
		<?php $count = 0; ?>
		<?php while($recent_reviews->have_posts()): $recent_reviews->the_post(); global $post; ?>
		<?php $count++; ?>

			<div class="recentreview">
				<div class="recentreview-image">
				<?php if(has_post_thumbnail()): ?>
				<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'fg-xm'); ?>
					<a class="img-responsive" href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" width='345' height='220' /></a>
				<?php endif; ?>	
				<div class="recentreview-item">
					<h2><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2>
					<?php if(get_post_meta( $post->ID, 'gm_' . 'enable_review', true )) gm_print_review_badge($post->ID); ?>
				</div>
				</div>
			</div>
		
		<?php endwhile; ?>
	<?php endif; ?>
	</div>
	<?php wp_reset_query(); ?>
	<?php echo $after_widget; }

/* Update the widget settings. */
	
function update($new_instance, $old_instance) {
	$instance = $old_instance;
	$instance['title'] = $new_instance['title'];
	$instance['posts'] = $new_instance['posts'];
	return $instance;
}

/* Set up some default widget settings. */

function form($instance){
	$defaults = array('title' => 'Recent Reviews', 'categories' => 'all', 'posts' => 5);
	$instance = wp_parse_args((array) $instance, $defaults); ?>

	<!-- Widget title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'gm'); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
	</p>
	<!-- Number of posts: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e('Number of posts:', 'gm'); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'posts' ); ?>" name="<?php echo $this->get_field_name( 'posts' ); ?>" value="<?php echo $instance['posts']; ?>" />
	</p>
		
<?php } } ?>