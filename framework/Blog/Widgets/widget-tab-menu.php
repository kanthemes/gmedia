<?php
add_action('widgets_init', 'tabs_load_widgets');
function tabs_load_widgets()
{
	register_widget('Tabs_Widget');
}
class Tabs_Widget extends WP_Widget {
	function Tabs_Widget()
	{
		$widget_ops = array('classname' => 'tab-widget', 'description' => 'Son Yazılar, Popüler Yazılar ve Etiketlerin bulunduğu Tab Menü Bileşeni');
		$control_ops = array('id_base' => 'tabs-widget');
		$this->WP_Widget('tabs-widget', THEME_NAME .' - '.__( "Tab Menu" , 'bg' ) , $widget_ops, $control_ops );
	}
	function widget($args, $instance)
	{
		extract($args);
		$posts1 = $instance['posts1'];
		$posts = $instance['posts'];
		$tags_count = $instance['tags'];
		$show_recent_posts1 = isset($instance['show_recent_posts1']) ? 'true' : 'false';
		$show_popular_posts = isset($instance['show_popular_posts']) ? 'true' : 'false';
		$show_tags = isset($instance['show_tags']) ? 'true' : 'false';
		echo $before_widget;
		if($title) {
			echo $before_title.$title.$after_title;
		}		
		?>
		<!-- BEGIN WIDGET -->
		<div id="tab-menu">
			<div class="tabMenu">
				<ul>
					<?php if($show_recent_posts1 == 'true'): ?><li class="waves-effect"><a title="Son Yazılar" href="#">Son Yazılar</a></li><?php endif; ?>
					<?php if($show_popular_posts == 'true'): ?><li class="waves-effect"><a title="Popular" href="#">Popüler Yazılar</a></li><?php endif; ?>
					<?php if($show_tags == 'true'): ?><li class="waves-effect"><a title="Tag" href="#">Tags</a></li><?php endif; ?>
				</ul>
			</div>
			
			<div class="tabContainer">
			
				<?php if($show_recent_posts1 == 'true'): ?>
				<div id="tab1" class="tabContent">
					<?php
					$recent_posts1 = new WP_Query('showposts='.$posts1.'');
					if($recent_posts1->have_posts()): ?>
						<?php while($recent_posts1->have_posts()): $recent_posts1->the_post(); ?>
						<div class="tabitem">
							<?php if(has_post_thumbnail()): ?>
							<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'fg-small'); ?>
								<div class="tabimage pull-left">
									<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" width='100' height='67' /></a>
								</div>
							<?php endif; ?>
							<div class="tabPost">
								<h2><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2>
								<?php echo getPostViews(get_the_ID()); ?>
								<span class="tarih"><i class="material-icons md-15"></i> <?php printf( _x( '%s önce', '%s = human-readable time difference', 'gm' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?></span>
							</div>
						</div>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
				<?php endif; ?>
				
				<?php if($show_popular_posts == 'true'): ?>
				<div id="tab2" class="tabContent">
					<?php
					$popular_posts = new WP_Query( array(
						'meta_key' => 'post_views_count',
						'orderby' => 'meta_value_num',
						'posts_per_page' => 5
					) );
					if($popular_posts->have_posts()): ?>
						<?php while($popular_posts->have_posts()): $popular_posts->the_post(); ?>
						<div class="tabitem">
							<?php if(has_post_thumbnail()): ?>
							<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'fg-small'); ?>
								<div class="tabimage pull-left">
									<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" width='100' height='67' /></a>
								</div>
							<?php endif; ?>
							<div class="tabPost">
								<h2><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2>
								<?php echo getPostViews(get_the_ID()); ?>
								<span class="comments"><i class="material-icons md-16"></i> <a href="<?php the_permalink(); ?>#comments"><?php comments_number( '0', '1', '%' ); ?></a></span>
							</div>
						</div>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
				<?php endif; ?>
				
				<?php if($show_tags == 'true'): ?>
				<div id="tab3" class="tabContent">
					<div class="tagcloud">
						<?php
						$tags = get_tags(array('orderby' => 'count', 'order' => 'DESC', 'number' => $tags_count));
						foreach ((array) $tags as $tag) {
						?>
						<?php echo '<a class="waves-effect" href="' . get_tag_link ($tag->term_id) . '" rel="tag">' . $tag->name . '</a>';	?>
						<?php } ?>
					</div>

				</div>
				<?php endif; ?>
				
			</div>
		
		</div>
		<!-- END WIDGET -->
		<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['posts1'] = $new_instance['posts1'];
		$instance['posts'] = $new_instance['posts'];
		$instance['tags'] = $new_instance['tags'];
		$instance['show_recent_posts1'] = $new_instance['show_recent_posts1'];
		$instance['show_popular_posts'] = $new_instance['show_popular_posts'];
		$instance['show_tags'] = $new_instance['show_tags'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('posts1' => 5, 'posts' => '5', 'tags' => 20, 'show_recent_posts1' => 'on', 'show_popular_posts' => 'on', 'show_tags' =>  'on');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('posts1'); ?>">Son Yazı Sayısı:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts1'); ?>" name="<?php echo $this->get_field_name('posts1'); ?>" value="<?php echo $instance['posts1']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>">Popüler Yazı Sayısı:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('tags'); ?>">Etiket Sayısı:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('tags'); ?>" name="<?php echo $this->get_field_name('tags'); ?>" value="<?php echo $instance['tags']; ?>" />
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_recent_posts1'], 'on'); ?> id="<?php echo $this->get_field_id('show_recent_posts1'); ?>" name="<?php echo $this->get_field_name('show_recent_posts1'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_recent_posts1'); ?>">Son Yazıları Göster</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_popular_posts'], 'on'); ?> id="<?php echo $this->get_field_id('show_popular_posts'); ?>" name="<?php echo $this->get_field_name('show_popular_posts'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_popular_posts'); ?>">Popüler Yazıları Göster</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_tags'], 'on'); ?> id="<?php echo $this->get_field_id('show_tags'); ?>" name="<?php echo $this->get_field_name('show_tags'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_tags'); ?>">Etiketleri Göster</label>
		</p>
	<?php }
}