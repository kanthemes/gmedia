<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="content col-md-8">
			<div class="row">
				<div class="contents">
					<div class="title-box">
						<h2 class="title"><i class="material-icons md-16">keyboard_arrow_down</i> <?php echo single_cat_title('', false); ?></h2>
					</div>
						<?php if(category_description()): ?>
							<div style="padding: 1em; line-height: 1.6; border-bottom: 1px solid #ececec; "><?php echo category_description(); ?></div>
						<?php endif; ?>
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