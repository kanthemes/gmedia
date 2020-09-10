<?php
add_action('widgets_init', 'gm_sidebar_1col_load_widgets');
function gm_sidebar_1col_load_widgets()
{
	register_widget('Gm_sidebar_1col_Widget');
}
class Gm_sidebar_1col_Widget extends WP_Widget {
	public function __construct(){
		$widget_ops = array('classname' => 'gm_sidebar_1col', 'description' => 'Tek sütunlu kategori bazlı son yazılar bileşeni.');
		$control_ops = array('id_base' => 'gm_sidebar_1col-widget');
		parent::__construct('gm_sidebar_1col-widget', THEME_NAME .' - '.__( "Sidebar Büyük Son Yazılar" , 'gm' ) , $widget_ops, $control_ops );
	}
	public function widget($args, $instance)
	{
		extract($args);
		$show_excerpt = isset($instance['show_excerpt']) ? 'true' : 'false';
		$title = $instance['title'];
		$post_type = 'all';
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		$images = true;
		echo $before_widget;
		?>
		<?php
			$recent_posts = new WP_Query(array(
				'showposts' => $posts,
				'cat' => $categories,
			));
			?>
			<?php $counter = 1; while($recent_posts->have_posts()): $recent_posts->the_post(); ?>
			<?php if($counter == 1): ?>
			<?php $big_count = round(1 / 4); if(!$big_count) { $big_count = 1; } ?>
		<div class="sidebar-post-widget">
		<div class="row">
		<div class="title-box side-title">
			<h2 class="title"><i class="material-icons md-16"></i> <a href="<?php echo get_category_link($categories); ?>"><?php echo $title; ?></a></h2>
		</div>
		<div class="post-sidebar">
				<div class="post-sidebar-big">
					<div class="post-sidebar-big-image">
						<?php if(has_post_thumbnail()): ?>
							<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'fg-xm'); ?>
							<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img class="img-responsive" src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" width='375' height='220' /></a>
						<?php else: ?>
							<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img class="img-responsive" src="<?php echo ot_get_option('no-images'); ?>" alt="<?php the_title(); ?>" width='375' height='220' /></a>
						<?php endif; ?>
						<div class="post-sidebar-big-meta">
							<?php $kategori = get_the_category();  if($kategori[0]->cat_name == "featured") {$name = $kategori[1]->cat_name;$cat_id = get_cat_ID( $name );$link = get_category_link( $cat_id ); echo '<a class="btn btn-small waves-effect" href="'. esc_url( $link ) .'"">'. $name .'</a>';} else {$name = $kategori[0]->cat_name;$cat_id = get_cat_ID( $name );$link = get_category_link( $cat_id );echo '<a  class="btn btn-small waves-effect" href="'. esc_url( $link ) .'"">'. $name .'</a>';} ?>
						</div>
					</div>
					<div class="post-header">
						<h2 class="title"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2>
						<?php if($show_excerpt == 'true'): ?>    
							<?php if (ot_get_option('excerpt-length') != '0'): ?>
								<?php the_excerpt(); ?>
							<?php else: ?>
							<p>Bu yazıya içerik girilmemiş.</p>
							<?php endif; ?>
						<?php endif; ?>
						<div class="post-meta">
							<a class="fn" rel="author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a> 
							<span class="comments"><i class="material-icons md-16"></i> <a href="<?php the_permalink(); ?>#comments"><?php comments_number( '0', '1', '%' ); ?></a></span> 	<?php echo getPostViews(get_the_ID()); ?>
						</div>
					</div>
				</div>	
			<?php else: ?>
				<div class="post-sidebar-small">
					<h2><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2> 
				</div>
			<?php endif; ?>
			<?php $counter++; endwhile; ?>
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
		return $instance;
	}
	public function form($instance){
		$defaults = array('show_excerpt' => null, 'title' => 'Son Yazılar', 'post_type' => 'all', 'categories' => 'all', 'posts' => 4);
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
	<?php }
}
?>