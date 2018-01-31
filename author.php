<?php get_header(); ?>
<div class="container-opt">
		<div class="autor-page">
				<div class="author-cover" style="background: #43a047 url(<?php the_author_meta( 'page-cover', $userID );?>)no-repeat center center/cover">
					<div class="author-top">
						<div class="author-top-left">
							<i class="material-icons md-18">menu</i> Profil
						</div>
					</div>
						<div class="author-avatar pull-center">
							<?php echo get_avatar(get_the_author_meta('user_email'),'85'); ?>
						</div>
						<div class="author-name pull-center">
							<h1><?php echo get_the_author(); ?></h1>
						</div>
				</div>
			<div class="authoritem" style="margin-bottom: 3em">	
				<div style="text-align:center; padding: 1em"><h2><i class="material-icons">face</i> Yazara ait son yazılar</h2></div>
				<div class="contents">	
					<?php if ( have_posts() ) : while ( have_posts() ): the_post(); ?>
							<?php get_template_part('framework/Blog/post') ?>
					<?php endwhile; ?>
					<?php endif; ?>
				</div>	
				<?php if (function_exists("wp_gm_pagination")){ wp_gm_pagination();}?>
			</div>	
		</div>	
</div>
<?php get_footer(); ?>