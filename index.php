<?php get_header(); ?>
<?php if ( ot_get_option( 'slider' ) != 'off' ) { get_template_part('framework/Blog/featured'); } ?>
<?php if ( ot_get_option( 'hotnews' ) != 'off' ) { get_template_part('framework/Blog/hotnews'); } ?>	
<div class="container">
	<div class="row">
	<?php if ( ot_get_option( 'headeralti-reklam' ) ): ?>
		<div class="header-ads">
			<?php echo ot_get_option('headeralti-reklam'); ?>
		</div>
	<?php endif;?>
		<div class="content col-md-8">
			<div class="row">
				<div class="contents">
					<div class="title-box iki">
						<div class="pull-left">
							<h2 class="title"><i class="material-icons md-16"></i> <a href="#post"><?php _e('Son Yazılar','gm'); ?></a></h2>
						</div>
						<div class="apps-dropdown pull-right">
							<?php $apps_list = wp_list_categories( array(
							  'orderby' => 'name',
							  'show_count' => false,
							  'pad_counts' => false,
							  'hierarchical' => 1,
							  'echo' => 0,
							  'title_li' => '<i class="material-icons md-16"></i> Kategoriler',
							) );
							if ( $apps_list )
							echo '<ul class="apps-type 1">' . $apps_list . '</ul>'; ?>
						</div>
					</div>
					<?php if ( have_posts() ) : while ( have_posts() ): the_post(); ?>
						<?php get_template_part('framework/Blog/post') ?>
					<?php endwhile; ?>
					<?php else: ?>
						<div class="col-md-12" style="background: #fff; padding: 1em">
							Bu siteye henüz herhangi bir içerik girilmemiştir.
						</div>
					<?php endif; ?>
				</div>
				<?php if (function_exists("wp_gm_pagination")){ wp_gm_pagination();}?> 
			</div>
			<?php if ( is_home() && ! is_paged() ) : ?>
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('homepage') ) :  endif; ?>
			<?php endif; ?>
		</div>	
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>