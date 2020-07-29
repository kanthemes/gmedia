<?php
 query_posts( array( 'cat' =>  ot_get_option('slider_category'), 'posts_per_page' => ot_get_option('slider_posts_count') ) );
 if(have_posts()):
?>
<div class="featured center">
    <?php while(have_posts()): the_post(); ?>
		<div class="featured-item col-md-4">
			<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'></a>
			<div class="featured-img">
			  <?php if ( has_post_thumbnail() ): ?>
				<?php the_post_thumbnail('fg-xm'); ?>
			  <?php else: ?>
					<img class="img-responsive" src="<?php echo ot_get_option('no-images'); ?>" alt="<?php the_title(); ?>" width='250' height='200' />
			  <?php endif; ?> 
			  <div class="featured-meta">
				<div class="post-meta">
					<span class="entry-category"><?php the_category(', '); ?></span>
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<span class="entry-time timestamp"><time class="updated" datetime="<?php the_time('c'); ?>"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' önce'; ?></time></span>
				</div>
			  </div>
			</div>
		</div>
    <?php endwhile; ?>
</div>
<?php endif; wp_reset_query(); ?>