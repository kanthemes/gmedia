<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php $postid = get_the_ID(); setPostViews($postid); ?>
<div class="entry-top-fixed">
<div class="container">
<div class="row">
<div class="pull-left">
<?php if ( ot_get_option( 'open-menu' ) != 'off' ): ?>
	<div class="menu-icon pull-left">
		<a href="#" id="hamburger-icon" class="buton-md more waves-effect" title="Menu">
			<i class="material-icons md-dark"></i>
		</a>
	</div>
<?php endif; ?>
<h2 class="entry-title"><?php the_title(); ?></h2>
</div>
<div class="pull-right">
<?php echo get_simple_likes_button( get_the_ID() ); ?></div>
</div>
</div>
</div>
<main id="main" role="main">
<div class="container">
    <div class="row">
		<?php if ( ot_get_option( 'headeralti-reklam' ) ): ?>
			<div class="header-ads" style="margin-bottom: 1em">
				<?php echo ot_get_option('headeralti-reklam'); ?>
			</div>
		<?php endif;?>
		<div class="clearfix"></div>
		<div class="content col-md-8" id="mains">
			<div class="row">
				<article <?php post_class(); ?>>
					<div class="content-area">
						<header class="entry-header">
						<div class="entry-title-box">
							<?php if ( ot_get_option( 'breadcrumb' ) != 'off' ) { get_template_part('framework/Blog/breadcrumb'); } ?>
							<h2 class="entry-title"><?php the_title(); ?></h2>
							<div class="entry-title-meta">
								<span class="entry-time timestamp"><time class="updated" datetime="<?php the_time('c'); ?>"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' önce'; ?></time></span>
								<a class="fn" rel="author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a> tarafından
								<div class="pull-right">
									<?php echo getPostViews(get_the_ID()); ?>
								</div>
							</div>
							<?php if ( ot_get_option( 'share-post' ) != 'off' ) { get_template_part('framework/Blog/share-post'); } ?>
						</div>
						<?php if(has_post_thumbnail()): ?>
						<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'fg-post'); ?>
							<div class="entry-image">
								<img  class="img-responsive" src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" width='780' height='360' />
							</div>
						<?php else: ?>
						<div class="entry-image">
							<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img class="img-responsive" src="<?php echo ot_get_option('no-images'); ?>" alt="<?php the_title(); ?>" width='780' height='360' /></a>
						</div>
						<?php endif; ?>
							<button class="btn more waves-effect"><?php echo get_simple_likes_button( get_the_ID() ); ?></button>
						</header>
						
						<?php if(get_post_meta( $post->ID, 'gm_' . 'enable_review', true ) == true) : ?>		
							<?php gm_print_review_box($post->ID, get_post_meta( $post->ID, true ));  ?>
							<div class="divider"></div>
						<?php endif; ?>
						
						<div class="entry entry-content">
							<?php if ( ot_get_option( 'yazi-reklam' ) ): ?>
							<div class="entry-ads" style="padding: 1em; text-align:center">
								<?php echo ot_get_option('yazi-reklam'); ?>
							</div>
						<?php endif;?>
							<?php the_content(); ?>
						</div>
						<?php if ( ot_get_option( 'yazi-sonu-reklam' ) ): ?>
							<div class="divider"></div>
							<div class="entry-ads" style="padding: 1em; text-align:center">
								<?php echo ot_get_option('yazi-sonu-reklam'); ?>
							</div>
						<?php endif;?>
						<div class="entry-footer">	
							<div class="divider"></div>
							<?php the_tags( '<div class="entry-tags"><ul><li class="btn white waves-effect waves-light"># ', '</li><li class="btn white waves-effect waves-light"># ', '</li></ul></div><div class="divider"></div>' ); ?>
							<?php get_template_part('framework/Blog/post-navigation'); ?>
							<div class="divider"></div>
							<?php if ( ot_get_option( 'related-posts' ) != 'off' ) { get_template_part('framework/Blog/related-posts'); } ?>
							<div class="divider"></div>
							<?php comments_template('',true); ?>
						</div>
					</div>
				</article>
				<?php endwhile; endif; ?>
			</div>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<nav class="containersc lkm">
	<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" tooltip="<?php the_author(); ?>" class="buttons"><?php echo get_avatar(get_the_author_meta('user_email'),'40'); ?></a>
	<a href="#" tooltip="Yukarı Çık" class="buttons red"><i class="material-icons md-18"></i></a>
	<a href="#share" tooltip="Yazıyı Paylaş" class="buttons purple"><i class="material-icons md-18"></i></a>
	<a href="#comments" tooltip="Yorum Yap" class="buttons midnight"><i class="material-icons md-18"></i></a>
	<a href="/" tooltip="Ana Sayfa" class="buttons green"><i class="material-icons md-18"></i></a>
	<a href="#" tooltip="Pusula" class="buttons orange"><span><span class="rotate"></span></span></a>
</nav>	
</main>
<?php get_footer(); ?>	