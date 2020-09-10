<?php
/*-----------------------------------------------------------------------------------*/
# Page Navi
/*-----------------------------------------------------------------------------------*/
// Bootstrap pagination function
function wp_gm_pagination($pages = '', $range = 4)
{
     $showitems = ($range * 2) + 1;
     global $paged;
     if(empty($paged)) $paged = 1;
     if($pages == '')
     {
         global $wp_query;
		 $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }
     if(1 != $pages)
     {
        echo '<nav><ul class="pagination"><li class="disabled hidden-xs"><span><span>Sayfa '.$paged.' - '.$pages.'</span></span></li>';
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."' aria-label='İlk'>&laquo;<span class='hidden-xs'> İlk</span></a></li>";
         if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."' aria-label='Önceki'>&lsaquo;<span class='hidden-xs'> Önceki</span></a></li>";
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li class=\"active\"><span>".$i."</span>
    </li>":"<li><a href='".get_pagenum_link($i)."'>".$i."</a></li>";
             }
         }
         if ($paged < $pages && $showitems < $pages) echo "<li><a href=\"".get_pagenum_link($paged + 1)."\"  aria-label='İleri'><span class='hidden-xs'>İleri </span>&rsaquo;</a></li>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."' aria-label='Son'><span class='hidden-xs'>Son </span>&raquo;</a></li>";
         echo "</ul></nav>";
     }
}
/* ------------------------------------------------------------------------- *
 *  REGISTER WIDGET
/* ------------------------------------------------------------------------- */
if(function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widgets %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="title-box"><h2 class="title"><i class="material-icons md-16"></i> ',
		'after_title' => '</h2></div>',
	));
	register_sidebar(array(
		'name' => 'Homepage',
		'id' => 'sidebar-2',
		'before_widget' => '<section class="homepage-widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<div class="title-box"><h2 class="title"><i class="material-icons md-16"></i> ',
		'after_title' => '</h2></div>',
	));
}
/* ------------------------------------------------------------------------- *
 *  Recent Posts Widget
/* ------------------------------------------------------------------------- */
function gm_recent_entries($posts_number = 5 , $thumb = true , $cats = 1){
	global $post;
	$original_post = $post;
	$args = array(
		'posts_per_page'		 => $posts_number,
		'cat'					 => $cats,
		'no_found_rows'          => true
	);
	$get_posts_query = new WP_Query( $args ); ?>
    <div class="recentPosts">
	   <?php if ( $get_posts_query->have_posts() ):
		while ( $get_posts_query->have_posts() ) : $get_posts_query->the_post()?>
            <div class="recentPost">
				<div class="tabitem">
					<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) : ?>
						<?php if(has_post_thumbnail()): ?>
						<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'fg-small'); ?>
						<div class="tabimage pull-left">
							<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" width='100' height='67' /></a>
						</div>
						<?php endif; ?>
					<?php endif; ?>
					 <div class="tabPost">
						<h2><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2>
						<?php echo getPostViews(get_the_ID()); ?>
						<span class="tarih"><i class="material-icons md-15"></i> <?php printf( _x( '%s önce', '%s = human-readable time difference', 'gm' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?></span>
					</div>
				</div>
            </div>
		<?php
		endwhile;
	endif;?>
	</div>
	<?php $post = $original_post;
	wp_reset_query();
}
/* ------------------------------------------------------------------------- *
 *  Sidebar Recent Posts Widget
/* ------------------------------------------------------------------------- */
function gm_side_recent_entries($posts_number = 5 , $thumb = true , $cats = 1){
	global $post;
	$original_post = $post;
	$args = array(
		'posts_per_page'		 => $posts_number,
		'cat'					 => $cats,
		'no_found_rows'          => true
	);
	$get_posts_query = new WP_Query( $args ); ?>
    <div class="side-recent-post">
	   <?php if ( $get_posts_query->have_posts() ):
		while ( $get_posts_query->have_posts() ) : $get_posts_query->the_post()?>
            <div class="siderecentPost">
				<div class="post-home-small">
					<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) : ?>
						<?php if(has_post_thumbnail()): ?>
						<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'fg-medium'); ?>
						<div class="image pull-left">
							<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" width='100' height='100' /></a>
						</div>
						<?php endif; ?>
					<?php endif; ?>
					 <div class="post-header">
						<h2><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2>
						<?php echo getPostViews(get_the_ID()); ?>
						<span class="tarih"><i class="material-icons md-15"></i> <?php printf( _x( '%s önce', '%s = human-readable time difference', 'gm' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?></span>
					</div>
				</div>
            </div>
		<?php
		endwhile;
	endif;?>
	</div>
	<?php $post = $original_post;
	wp_reset_query();
}