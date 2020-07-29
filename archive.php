<?php get_header(); ?>
<div class="container">
<div class="row">
<div class="content col-md-8">
<div class="row">
<div class="contents">
<div class="title-box">
<h2 class="title">
							<?php if(is_day()): ?>
								<?php printf(__(' Günlük Arşiv: <span>%s</span>' , 'gm'), get_the_date()); ?>
							<?php elseif (is_month()) : ?>
								<?php printf(__('Aylık Arşiv: <span>%s</span>' , 'gm'), get_the_date('Y F')); ?>
							<?php elseif (is_year()) : ?>
								<?php printf(__(' Yıllık Arşiv: <span>%s</span>' , 'gm'), get_the_date('Y')); ?>
							<?php else : ?>
								<?php _e('Blog Archives' , 'gm'); ?>
							<?php endif; ?>
						</h2>
					</div>
					<?php if ( have_posts() ) : while ( have_posts() ): the_post(); ?>
						<?php get_template_part('framework/Blog/post') ?>
					<?php endwhile; ?>
					<?php endif; ?>
				</div>
				<?php if (function_exists("wp_gm_pagination")){ wp_gm_pagination();}?>
			</div>
		</div>	
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>