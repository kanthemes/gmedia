<div class="container">	
<div class="row">
<div class="featured">
	<?php $recent_posts = new WP_Query(array('showposts' => ot_get_option('hotnews_posts_count'),'cat' => ot_get_option('hotnews_category'))); ?>
	<?php $big_count = round(1 / 4); if(!$big_count) { $big_count = 1; } ?>
	<?php $counter = 1; while($recent_posts->have_posts()): $recent_posts->the_post(); ?>
	<?php if($counter <= $big_count): ?>
	<div class="hotnews waves-effect big">
		<figure class="block-image">
			<?php if(has_post_thumbnail()): ?>
			<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'fg-slider'); ?>
				<img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" width='585' height='400' />
			<?php else: ?>
				<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img class="img-responsive" src="<?php echo ot_get_option('no-images'); ?>" alt="<?php the_title(); ?>" width='585' height='400' /></a>
			<?php endif; ?>
			<div class="slide-inner">
				<a class="slide-href" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
			<div class="post-comments">
				<span class="comments"><i class="material-icons md-16"></i> <a href="<?php the_permalink(); ?>#comments"><?php comments_number( '0', '1', '%' ); ?></a></span>
			</div>
			<figcaption class="post-meta">
			<span class="entry-category"><?php the_category(', '); ?></span>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<span class="entry-time timestamp"><i class="material-icons">access_time</i> <time class="updated" datetime="<?php the_time('c'); ?>"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' önce'; ?> </time></span>
				<span class="entry-author fn"><i class="material-icons">account_circle</i> <?php the_author(); ?></span>
			</figcaption>	
			</div>
		</figure>
		<div class="slideshow-overlay"></div>
	</div>
	<?php else: ?>
	<div class="hotnews small waves-effect">	
		<figure class="block-image">
			<?php if(has_post_thumbnail()): ?>
			<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'fg-xm'); ?>
				<img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" width='292' height='200'/>
			<?php else: ?>
				<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img class="img-responsive" src="<?php echo ot_get_option('no-images'); ?>" alt="<?php the_title(); ?>" width='292' height='200' /></a>
			<?php endif; ?>
			<div class="slide-inner">
				<a class="slide-href" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
				<div class="post-comments">
					<span class="comments"><i class="material-icons md-16"></i> <a href="<?php the_permalink(); ?>#comments"><?php comments_number( '0', '1', '%' ); ?></a></span>
				</div>
				<figcaption class="post-meta">
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<span class="entry-time timestamp"><time class="updated" datetime="<?php the_time('c'); ?>"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' önce'; ?></time>• </span>
					<span class="entry-category"><?php the_category(', '); ?></span>
				</figcaption>
			</div>
		</figure>
		<div class="slideshow-overlay"></div>
	</div>
	<?php endif; ?>
	<?php $counter++; endwhile; ?>
</div>
</div>
</div>