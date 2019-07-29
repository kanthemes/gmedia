<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="content col-md-8">
			<div class="row">
				<div class="contents">
					<div class="title-box">
						<h2 class="title"><div style="color: #333; display:inline">Aranan Kelime</div> " <?php echo get_search_query(); ?> "</h2>
					</div>
					<?php if ( have_posts() ) : while ( have_posts() ): the_post(); ?>
						<?php get_template_part('framework/Blog/post') ?>
					<?php endwhile; ?>
					<?php else: ?>
					<p style="padding: 1em">Aradığınız sonuca ulaşamadık</p>
					<?php endif; ?>
				</div>
				<?php if (function_exists("wp_gm_pagination")){ wp_gm_pagination();}?>
			</div>
		</div>	
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>