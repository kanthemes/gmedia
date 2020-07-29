		<article id="post-<?php the_ID(); ?>" <?php post_class('post-home'); ?> >	
			<div class="block-image pull-left">
				<?php if(has_post_thumbnail()): ?>
				<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'fg-medium'); ?>
					<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" width='250' height='200'/></a>
				<?php else: ?>
					<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img class="img-responsive" src="<?php echo ot_get_option('no-images'); ?>" alt="<?php the_title(); ?>" width='250' height='200' /></a>
				<?php endif; ?>
				<div class="post-meta">
					<ul>
						<li><?php echo get_simple_likes_button( get_the_ID() ); ?></li>
						<li><?php echo getPostViews(get_the_ID()); ?></li>
					</ul>
				</div>
			<a class="btn more waves-effect" href="<?php echo get_permalink(); ?>" title="<?php the_title_attribute(); ?>"><i class="material-icons md-20"></i></a>
			</div>
			<div class="post-header">
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<div class="pull-left">
				<span class="entry-time timestamp"><time class="updated" datetime="<?php the_time('c'); ?>"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' önce'; ?></time></span><span class="sticky-post"><i class="material-icons"></i> Bu yazı sabitlenmiştir.</span>
				</div>
				•<span class="entry-category"><?php the_category(', '); ?></span>
				<div class="entry-content">	
					<?php if (ot_get_option('excerpt-length') != '0'): ?>
						<?php the_excerpt(); ?>
					<?php else: ?>
						<p>Bu yazıya içerik girilmemiş.</p>
					<?php endif; ?>
				</div>
			</div>	
		</article>