<?php
add_action('widgets_init', 'bg_homepage_2col_load_widgets');
function bg_homepage_2col_load_widgets()
{
	register_widget('Bg_Homepage_2col_Widget');
}
class Bg_Homepage_2col_Widget extends WP_Widget {
	public function __construct(){
		$widget_ops = array('classname' => 'bg_homepage_2col', 'description' => 'Çift sütunlu kategori bazlı son yazılar bileşeni.');
		$control_ops = array('id_base' => 'bg_homepage_2col-widget');
		parent::__construct('bg_homepage_2col-widget', THEME_NAME .' - '.__( "Çift Sütunlu Son Yazılar" , 'gm' ) , $widget_ops, $control_ops );
	}
	public function widget($args,$instance){
		extract($args);
		$show_excerpt = isset($instance['show_excerpt']) ? 'true' : 'false';
		$title = $instance['title'];
		$post_type = 'all';
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		$images = true;
		$title_2 = $instance['title_2'];
		$post_type_2 = 'all';
		$categories_2 = $instance['categories_2'];
		$posts_2 = $instance['posts_2'];
		$images_2 = true;
		echo $before_widget;
		?>
		<?php
		$post_types = get_post_types();
		unset($post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);
		if($post_type == 'all') {
			$post_type_array = $post_types;
		} else {
			$post_type_array = $post_type;
		}
		?>
		<div class="block-posts row">
			<?php
			$recent_posts = new WP_Query(array(
				'showposts' => $posts,
				'cat' => $categories,
			));
			?>
			<?php $counter = 1; while($recent_posts->have_posts()): $recent_posts->the_post(); global $post;  ?>
			<?php if($counter == 1): ?>
			<div class="post-box col-md-6">
			<div class="row">
			<div class="post-col-item">
				<?php echo $before_title; echo $title ; echo $after_title; ?>
				<div class="colitem">
					<div class="block-alt-image">
						<?php if(has_post_thumbnail()): ?>
						<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'fg-xm'); ?>
							<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img class="img-responsive" src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" width='390' height='220' /></a>
						<?php else: ?>
							<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img class="img-responsive" src="<?php echo ot_get_option('no-images'); ?>" alt="<?php the_title(); ?>" width='390' height='220' /></a>
						<?php endif; ?>
					</div> 
					<div class="post-header">
						<span class="entry-time timestamp"><i class="material-icons md-15"></i> <time class="updated" datetime="<?php the_time('c'); ?>"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' önce'; ?>	</time></span>
						<h2 class="title"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2>
						<?php if($show_excerpt == 'true'): ?>    
							<?php if (ot_get_option('excerpt-length') != '0'): ?>
								<?php the_excerpt(); ?>
							<?php else: ?>
							<p>Bu yazıya içerik girilmemiş.</p>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				<?php else: ?>
					<div class="post-item-small">
						<?php if($images && has_post_thumbnail()): ?>
						<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'fg-small'); ?>
						<div class="pull-left"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" width='100' height='67' /></a></div>
						<?php else: ?>
						<?php endif; ?>
						<div class="post-item-smallContent">
							<h3><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h3>
							<span class="post-meta">
								<?php echo getPostViews(get_the_ID()); ?>
								<span class="tarih"><i class="material-icons md-15"></i> <?php printf( _x( '%s önce', '%s = human-readable time difference', 'gm' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?></span>
							</span>
						</div>
					</div>
				<?php endif; ?>
			<?php $counter++; endwhile; ?>
				</div>
			</div>
			</div>
			</div>
		<?php
		$post_types = get_post_types();
		unset($post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);
		if($post_type_2 == 'all') {
			$post_type_2_array = $post_types;
		} else {
			$post_type_2_array = $post_type;
		}
		?>
			<?php
			$recent_posts = new WP_Query(array(
				'showposts' => $posts_2,
				'cat' => $categories_2,
			));
			?>			
			<?php $counter = 1; while($recent_posts->have_posts()): $recent_posts->the_post(); global $post;  ?>
			<?php if($counter == 1): ?>
			<div class="post-box col-md-6 last">
			<div class="row">
			<div class="post-col-item">
				<?php echo $before_title; echo $title_2 ; echo $after_title; ?>
				<div class="colitem">
					<div class="block-alt-image">
						<?php if(has_post_thumbnail()): ?>
						<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'fg-xm'); ?>
							<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img class="img-responsive" src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" width='390' height='220' /></a>
						<?php else: ?>
							<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img class="img-responsive" src="<?php echo ot_get_option('no-images'); ?>" alt="<?php the_title(); ?>" width='390' height='220' /></a>
						<?php endif; ?>
					</div>
					<div class="post-header">
						<span class="entry-time timestamp"><i class="material-icons md-15"></i> <time class="updated" datetime="<?php the_time('c'); ?>"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' önce'; ?>	</time></span>
						<h2 class="title"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2>
						<?php if($show_excerpt == 'true'): ?>    
							<?php if (ot_get_option('excerpt-length') != '0'): ?>
								<?php the_excerpt(); ?>
							<?php else: ?>
							<p>Bu yazıya içerik girilmemiş.</p>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				<?php else: ?>
					<div class="post-item-small">
						<?php if($images && has_post_thumbnail()): ?>
						<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'fg-small'); ?>
						<div class="pull-left"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" width='100' height='67' /></a></div>
						<?php else: ?>
						<?php endif; ?>
						<div class="post-item-smallContent">
							<h3><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h3>
							<span class="post-meta">
								<?php echo getPostViews(get_the_ID()); ?>
								<span class="tarih"><i class="material-icons md-15"></i> <?php printf( _x( '%s önce', '%s = human-readable time difference', 'gm' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?></span>
							</span>
						</div>
					</div>
				<?php endif; ?>
			<?php $counter++; endwhile; ?>
			</div>
			</div>
			</div>
			</div>
			</div>
		<?php
		echo $after_widget;
	}
	public function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['show_excerpt'] = $new_instance['show_excerpt'];
		$instance['title'] = $new_instance['title'];
		$instance['post_type'] = 'all';
		$instance['categories'] = $new_instance['categories'];
		$instance['posts'] = $new_instance['posts'];
		$instance['show_images'] = true;
		$instance['title_2'] = $new_instance['title_2'];
		$instance['post_type_2'] = 'all';
		$instance['categories_2'] = $new_instance['categories_2'];
		$instance['posts_2'] = $new_instance['posts_2'];
		$instance['show_images_2'] = true;
		return $instance;
	}
	public function form($instance){
		$defaults = array('show_excerpt' => null, 'title' => 'Son Yazılar', 'post_type' => 'all', 'categories' => 'all', 'posts' => 4, 'title_2' => 'Son Yazılar', 'post_type_2' => 'all', 'categories_2' => 'all', 'posts_2' => 4);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_excerpt'], 'on'); ?> id="<?php echo $this->get_field_id('show_excerpt'); ?>" name="<?php echo $this->get_field_name('show_excerpt'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_excerpt'); ?>">Açıklamayı Göster</label>
		</p>
		<h3>1. Sütun</h3>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Başlık:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>">Kategori Seçin:</label> 
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>Tüm Kategoriler</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>">Yazı Sayısı:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
		</p>
		<h3 style='margin-top: 40px;'>2. Sütun</h3>
		<p>
			<label for="<?php echo $this->get_field_id('title_2'); ?>">Başlık:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title_2'); ?>" name="<?php echo $this->get_field_name('title_2'); ?>" value="<?php echo $instance['title_2']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('categories_2'); ?>">Kategori Seçin:</label> 
			<select id="<?php echo $this->get_field_id('categories_2'); ?>" name="<?php echo $this->get_field_name('categories_2'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories_2']) echo 'selected="selected"'; ?>>Tüm Kategoriler</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories_2']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('posts_2'); ?>">Yazı Sayısı:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts_2'); ?>" name="<?php echo $this->get_field_name('posts_2'); ?>" value="<?php echo $instance['posts_2']; ?>" />
		</p>
	<?php }
}
?>