<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<main id="main" role="main">
<div class="container">
    <div class="row">
		<?php if ( ot_get_option( 'headeralti-reklam' ) ): ?>
			<div class="header-ads" style="margin-bottom: 1em">
				<?php echo ot_get_option('headeralti-reklam'); ?>
			</div>
		<?php endif;?>
		<div class="clearfix"></div>
		<div class="content col-md-12">
			<div class="row">
				<article <?php post_class(); ?>>
					<div class="content-area">
						<header class="entry-header">
						<div class="entry-title-box">
							<h1 class="entry-title"><?php the_title(); ?></h1>
							<div class="entry-title-meta">
								<span class="entry-time timestamp"><time class="updated" datetime="<?php the_time('c'); ?>"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' önce'; ?></time></span>
								<a class="fn" rel="author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a> tarafından
								<div class="pull-right">
									<?php echo getPostViews(get_the_ID()); ?>
									<?php echo get_simple_likes_button( get_the_ID() ); ?>
								</div>
							</div>
							<?php if ( ot_get_option( 'share-post' ) != 'off' ) { get_template_part('framework/Blog/share-post'); } ?>
						</div>
						</header>
						<div class="divider"></div>
						<?php if ( ot_get_option( 'yazi-sonu-reklam' ) ): ?>
							<div class="entry-ads" style="padding: 1em; text-align:center">
								<?php echo ot_get_option('yazi-sonu-reklam'); ?>
							</div>
							<div class="divider"></div>
						<?php endif;?>
						<?php setPostViews(get_the_ID()); ?>
						<div class="att-navigation col-md-12">
							<div class="pull-left"><?php previous_image_link( false, '← Geri' ); ?></div>
							<div class="pull-right"><?php next_image_link( false, 'İleri →' ); ?></div>
						</div>
						<div class="clearfix"></div>
						<div class="divider"></div>
						<div class="entry entry-content" style="text-align:center">
							 <?php if (wp_attachment_is_image($post->id)) { $att_image = wp_get_attachment_image_src( $post->id, "full"); ?>
							<p class="attachment">
								<a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>">
								<img src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>"  class="attachment-medium" alt="<?php the_title(); ?>" />
								</a>
							</p>
							<?php } ?>
						</div>
						<div class="entry-footer">	
							<div class="divider"></div>
							<?php comments_template('',true); ?>
						</div>
					</div>
				</article>
				<?php endwhile; endif; ?>
			</div>
		</div>
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