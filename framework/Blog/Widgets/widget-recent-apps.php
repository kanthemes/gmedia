<?php

function gm_load_recent_apps() {
	register_widget('gm_recent_apps');
}

add_action('widgets_init', 'gm_load_recent_apps');

class gm_recent_apps extends WP_Widget {

/* Widget setup. */

function gm_recent_apps() {
	$widget_ops = array( 'classname' => 'gm_recent_apps', 'description' => __('Uygulamalar kısmına eklediğiniz yazıların listesi (Ana sayfa için tasarlanmıştır)', 'gm') );
	$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'gm_recent_apps');
	$this->WP_Widget('gm_recent_apps', THEME_NAME .' - '.__( "Son Uygulamalar" , 'gm' ) , $widget_ops, $control_ops );
}
	
/* Display the widget on the screen. */

function widget($args, $instance) {
	extract($args);
	$title = apply_filters('widget_title', $instance['title'] );
	$posts = $instance['posts'];
	echo $before_widget;
	?>
	<div class="block-posts row">
		<div class="post-col-item">
		<div class="title-box iki">
			<div class="pull-left">
				<h2 class="title"><i class="material-icons md-16"></i> <a href="<?php echo get_category_link($categories); ?>"><?php echo $title; ?></a></h2>
			</div>
			<div class="apps-dropdown pull-right">
				<?php $apps_list = wp_list_categories( array(
				 'taxonomy' => 'tur',
				 'orderby' => 'name',
				 'show_count' => false,
				 'pad_counts' => false,
				 'hierarchical' => 1,
				 'echo' => 0,
				 'title_li' => '<i class="material-icons md-16"></i> Türler',
				) );
				if ( $apps_list )
				echo '<ul class="apps-type 2">' . $apps_list . '</ul>'; ?>	
			</div>
		</div>
		</div>
	<div class="uyg-box-group multiple-items">		
		<?php $recent_download = new WP_Query(array('showposts' => $posts, 'post_type' => 'uygulama',)); ?>
		<?php if ($recent_download->have_posts()) : ?>
			<?php $count = 0; ?>
			<?php while($recent_download->have_posts()): $recent_download->the_post(); global $post; ?>
			<?php $count++; ?>
				<?php get_template_part('framework/Blog/uygulama-box-article') ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
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
	$defaults = array('title' => 'Son Uygulamalar', 'categories' => 'all', 'posts' => 4);
	$instance = wp_parse_args((array) $instance, $defaults); ?>

	<!-- Widget title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'gm'); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
	</p>
	<!-- Number of posts: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e('Uygulama Sayısı', 'gm'); ?><div class="description"><i>4 ve katları</i></div></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'posts' ); ?>" name="<?php echo $this->get_field_name( 'posts' ); ?>" value="<?php echo $instance['posts']; ?>" />
	</p>
		
<?php } } ?>