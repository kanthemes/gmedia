<?php
require_once('wp-updates-theme.php');
new WPUpdatesThemeUpdater_2211( 'http://wp-updates.com/api/2/theme', basename( get_template_directory() ) );
define ('THEME_NAME',	"Gm" );
define ('THEME_FOLDER',	"gmedia" );          
/* ------------------------------------------------------------------------- *
 *  Content width
/* ------------------------------------------------------------------------- */
if ( ! isset( $content_width ) ) {
	$content_width = 720;
}
/* ------------------------------------------------------------------------- *
 *  Navbar Add Classes
/* ------------------------------------------------------------------------- */
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class($classes, $item){
     if( in_array('secondary', $classes) ){
      $classes[] = 'active ';
     }
     return $classes;
}
/* ------------------------------------------------------------------------- *
 *  Attachment
/* ------------------------------------------------------------------------- */
function wp_get_attachment( $attachment_id ) {

    $attachment = get_post( $attachment_id );
    return array(
        'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href' => get_permalink( $attachment->ID ),
        'src' => $attachment->guid,
        'title' => $attachment->post_title
    );
}

add_filter('previous_image_link', 'post_link_attributes');
add_filter('next_image_link', 'post_link_attributes');
 
function post_link_attributes($output) {
    $code = 'class="btn waves-effect"';
    return str_replace('<a href=', '<a '.$code.' href=', $output);
}

/* ------------------------------------------------------------------------- *
 *  SETUP
/* ------------------------------------------------------------------------- */
if ( ! function_exists( 'gm_setup' ) ) {
	function gm_setup() {	
		add_theme_support( 'automatic-feed-links' );
		add_theme_support('title-tag');
		add_action( 'show_user_profile', 'add_extra_social_links' );
		add_action( 'edit_user_profile', 'add_extra_social_links' );
		register_nav_menus( array(
			'header' => __( 'Açılır Menü', 'gm' ),
			'secondary' => __( 'Normal Menü', 'gm' ),
			'footer' => __( 'Footer', 'gm' ),
		) );
	}
}
add_action( 'after_setup_theme', 'gm_setup' );
/* ------------------------------------------------------------------------- *
 *  Clean up the WordPress Head
/* ------------------------------------------------------------------------- */
if( !function_exists( "gm_head_cleanup" ) ) {  
  function gm_head_cleanup() {
    // remove header links
    remove_action( 'wp_head', 'feed_links_extra', 3 );                    // Category Feeds
    remove_action( 'wp_head', 'feed_links', 2 );                          // Post and Comment Feeds
    remove_action( 'wp_head', 'rsd_link' );                               // EditURI link
    remove_action( 'wp_head', 'wlwmanifest_link' );                       // Windows Live Writer
    remove_action( 'wp_head', 'index_rel_link' );                         // index link
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );            // previous link
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );             // start link
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Links for Adjacent Posts
    remove_action( 'wp_head', 'wp_generator' );                           // WP vergmn
  }
}
// Launch operation cleanup
add_action( 'init', 'gm_head_cleanup' );
// remove WP vergmn from RSS
if( !function_exists( "gm_rss_vergmn" ) ) {  
  function gm_rss_vergmn() { return ''; }
}
add_filter( 'the_generator', 'gm_rss_vergmn' );
/* ------------------------------------------------------------------------- *
 *  OptionTree framework integration: Use in theme mode
/* ------------------------------------------------------------------------- */
	
	add_filter( 'ot_show_pages', '__return_false' );
	add_filter( 'ot_show_new_layout', '__return_false' );
	add_filter( 'ot_theme_mode', '__return_true' );
	load_template( get_template_directory() . '/framework/Admin/ot-loader.php' );
	load_template( get_template_directory() . '/framework/Admin/theme-options.php' );
	load_template( get_template_directory() . '/framework/Admin/dynamic-styles.php' );
	load_template( get_template_directory() . '/framework/shortcodes/shortcodes.php' );
	
/* ------------------------------------------------------------------------- *
 *  Custom Favicon
/* ------------------------------------------------------------------------- */	
if ( ! function_exists( 'gm_favicon' ) ) {
	function gm_favicon() {
		if ( ot_get_option('favicon') ) {
			echo '<link rel="shortcut icon" href="'.ot_get_option('favicon').'" />'."\n";
		}
	}
}
add_filter( 'wp_head', 'gm_favicon' );
/*-----------------------------------------------------------------------------------*/
# Metaboxes
/*-----------------------------------------------------------------------------------*/
	include_once('framework/metaboxes/gm-metaboxes.php');
	include_once('framework/metaboxes/metabox.php');
	include_once('framework/metaboxes/review.php');
/* ------------------------------------------------------------------------- *
 *  Comment Temp
/* ------------------------------------------------------------------------- */
if (!function_exists('gm_comment')) :
    function gm_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' : ?>

                <li class="comment media" id="comment-<?php comment_ID(); ?>">
                    <div class="media-body">
                        <p>
                            <?php _e('Pingback:', 'gm'); ?> <?php comment_author_link(); ?>
                        </p>
                    </div><!--/.media-body -->
                <?php
                break;
            default :
                // Proceed with normal comments.
                global $post; ?>

                <li <?php comment_class(); ?>  id="comment-<?php comment_ID(); ?>">
                        <div class="comment-body">
						<a href="<?php echo $comment->comment_author_url;?>" class="user-avatar pull-left">
                            <?php echo get_avatar($comment, 60); ?>
                        </a>
							<div class="comment-content">
								<div class="comment-heading comment-author vcard">
									<a class="pull-left" href="<?php bloginfo('url'); ?>/?author=<?php echo $comment->user_id ?>"><?php comment_author(); ?></a>  <span class="author">Yazar</span>
								</div>
								<?php if ('0' == $comment->comment_approved) : ?>
									<p class="comment-awaiting-moderation"><?php _e(
										'Yorumunuz editör tarafından inceledikten sonra yayınlanacaktır.',
										'gm'
									); ?></p>
								<?php endif; ?>
								<?php comment_text(); ?>
								<div class="comment-meta">
									<?php printf('<span class="date"><a href="%1$s">%3$s</a></span>',
										esc_url(get_comment_link($comment->comment_ID)),
										get_comment_time('c'),
										sprintf(
										__('%1$s', 'gm'),
										get_comment_date()
									)
									); ?>  
									<?php comment_reply_link( array_merge($args, array(
												'reply_text' => __('<span class="reply"><i class="material-icons">subdirectory_arrow_right</i> Cevapla</span>', 'gm'),
												'respond_id' => 'respond',    
												'depth'      => $depth,
												'max_depth'  => $args['max_depth']
											)
									)); ?>	
								</div>
							</div>
                        </div>
                    </li>
                        <!--/.media-body -->
<?php if($args['max_depth']!=$depth) { ?>
<?php } ?>
                <?php
                break;
        endswitch;
    }
endif;

/* ------------------------------------------------------------------------- *
 *  Social Media
/* ------------------------------------------------------------------------- */
if ( ! function_exists( 'gm_social_links' ) ) {

	function gm_social_links() {
		if ( !ot_get_option('social-links') =='' ) {
			$links = ot_get_option('social-links', array());
			if ( !empty( $links ) ) {
				echo '<div class="sosyal-medya">';	
				foreach( $links as $item ) {
					
					// Build each separate html-section only if set
					if ( isset($item['title']) && !empty($item['title']) ) 
						{ $title = '' .$item['title']. ''; } else $title = '';
					if ( isset($item['social-link']) && !empty($item['social-link']) ) 
						{ $link = 'href="' .$item['social-link']. '"'; } else $link = '';
					if ( isset($item['social-icon']) && !empty($item['social-icon']) ) 
						{ $icon = ''.$item['social-icon']. ''; } else $icon = 'circlestar';
					if ( isset($item['social-target']) && !empty($item['social-target']) ) 
						{ $target = 'target="' .$item['social-target']. '"'; } else $target = '';
					
					// Put them together
					if ( isset($item['title']) && !empty($item['title']) ) {
						echo '<a rel="nofollow" title="'.$icon.'" '.$link.' '.$target.'><i class="fa '.$icon.'"></i></a>';
					}
				}
				echo '</div>';
			}
		}
	}
	
}
/* ------------------------------------------------------------------------- *
 *  Extra Profil
/* ------------------------------------------------------------------------- */
function add_extra_social_links( $user )
{
    ?>
        <h3>Yazar Sayfası</h3>

        <table class="form-table">
            <tr>
                <th><label for="page-cover">Yazar Sayfası Arkaplan</label></th>
                <td><input type="text" name="page-cover" value="<?php echo esc_attr(get_the_author_meta( 'page-cover', $user->ID )); ?>" class="regular-text" /></td>
            </tr>
        </table>
    <?php
}

add_action( 'personal_options_update', 'save_extra_social_links' );
add_action( 'edit_user_profile_update', 'save_extra_social_links' );

function save_extra_social_links( $user_id )
{
    update_user_meta( $user_id,'page-cover', sanitize_text_field( $_POST['page-cover'] ) );
}

/* ------------------------------------------------------------------------- *
 *  THEME SETUP
/* ------------------------------------------------------------------------- */
    require_once(get_template_directory() . '/framework/theme-functions.php' );
    require_once(get_template_directory() . '/framework/widgets.php' );
	load_template( get_template_directory() . '/framework/post-like.php' );
/* ------------------------------------------------------------------------- *
 *  POST THUMBNAILS 
/* ------------------------------------------------------------------------- */
add_theme_support('post-thumbnails');
if ( function_exists( 'add_image_size' ) ){
	add_image_size( 'fg-small'		,100,  67,  true );
	add_image_size( 'fg-medium'		,250,  200, true );
	add_image_size( 'fg-xm'		,383,  220, true );
	add_image_size( 'fg-slider'		,585,  400, true );
	add_image_size( 'fg-post'		,780,  360, true );
}

/* ------------------------------------------------------------------------- *
 *  EXCERPT 
/* ------------------------------------------------------------------------- */
if ( ! function_exists( 'gm_excerpt_more' ) ) {
	function gm_excerpt_more( $more ) {
		return '&#46;&#46;&#46;';
	}
}
add_filter( 'excerpt_more', 'gm_excerpt_more' );

// Excerpt length
if ( ! function_exists( 'gm_excerpt_length' ) ) {
	function gm_excerpt_length( $length ) {
		return ot_get_option('excerpt-length',$length);
	}
}
add_filter( 'excerpt_length', 'gm_excerpt_length', 999 );

/* ------------------------------------------------------------------------- *
 *  POST VIEW 
/* ------------------------------------------------------------------------- */

function setPostViews($postID) {
 $count_key = 'post_views_count';
 $count = get_post_meta($postID, $count_key, true);
 if($count==''){
 $count = 0;
 delete_post_meta($postID, $count_key);
 add_post_meta($postID, $count_key, 0);
 }else{
 $count++;
 update_post_meta($postID, $count_key, $count);
 }
}

function getPostViews($postID){
 $count_key = 'post_views_count';
 $count = get_post_meta($postID, $count_key, true); $count_new = round($count/2, 0);
 if($count==''){
 delete_post_meta($postID, $count_key);
 add_post_meta($postID, $count_key, 0);
 return "0";
 }
 return '<i class="material-icons md-18">&#xE417;</i> '.$count_new.'';
}