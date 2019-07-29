<?php
add_action('admin_head', 'imaj_ekleme_butonu_tiny');
function imaj_ekleme_butonu_tiny() {
    global $typenow;
    if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') && !current_user_can('post_type') ) {
    return;
    }
    if( ! in_array( $typenow, array( 'post', 'page' ) ) )
        return;
    if ( get_user_option('rich_editing') == 'true') {
        add_filter("mce_external_plugins", "imaj_ekleme_butonu_tinymce");
        add_filter('mce_buttons', 'imaj_ekleme_butonu_kaydet');
    }
}
function imaj_ekleme_butonu_tinymce($plugin_array) {
    $plugin_array['imaj_ekleme_butonu'] = get_template_directory_uri().'/framework/shortcodes/popup-button.js';
    return $plugin_array;
}
function bg_shortcodes_mce_css() {
	wp_enqueue_style('bg-shortcodes-admin-css',  get_template_directory_uri().'/framework/shortcodes/css/shortcodes.css' );
}
add_action( 'admin_enqueue_scripts', 'bg_shortcodes_mce_css' );
function imaj_ekleme_butonu_kaydet($buttons) {
   array_push($buttons, "imaj_ekleme_butonu");
   return $buttons;
}
/* ------------------------------------------------------------------------- *
 *  Kutu
/* ------------------------------------------------------------------------- */
function shortcode_box( $atts, $content = null ) {
	$type = 'alert-info';
	
    if( is_array( $atts ) ) extract($atts);
	
	$out = '<div class="alert ' .$type. '" role="alert"><button class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>'. do_shortcode($content). '</div>';
    return $out;
}
add_shortcode('box', 'shortcode_box');
/* ------------------------------------------------------------------------- *
 *  Button
/* ------------------------------------------------------------------------- */
function shortcode_button( $atts, $content = null ) {
	$size  = 'small';
	$color = 'gray';
	$link  = $button_target = $align = $icon   = '';
	
    if( is_array( $atts ) ) extract($atts);

	if( !empty( $target ) && $target == 'true' ) $button_target = ' target="_blank"';
	if( !empty( $icon ) )   $icon   = '<i class="fa '.$icon.'"></i>';
	
	$out = '<a href="'.$link.'"'.$button_target.' class="btn '.$size.' '.$color.' '.$align.' waves-effect">'. $icon . do_shortcode($content). '</a>';
    return $out;
}
add_shortcode('button', 'shortcode_button');
/* ------------------------------------------------------------------------- *
 *  Recent Posts
/* ------------------------------------------------------------------------- */
function my_recent_posts_shortcode($atts){
extract(shortcode_atts(array(
      "tags" => '',
      "posts" => '5',
      "title" => 'Başlık',
   ), $atts));
 $q = new WP_Query(
   array(  'posts_per_page' => $posts,
      'order' => 'ASC',
    'tag_id'=> $tags,)
 );
$list ="";
while($q->have_posts()) : $q->the_post();
$list .= '<li><div class="collapsible-header"><div class="pull-left"><a href="' . get_permalink() . '">' . get_the_title() . '</a></div><div class="pull-right">' . get_the_date() . '</div></div><div class="collapsible-body"><p>' . get_the_excerpt() . '<a href="' . get_permalink() . '">Okumaya Devam Et</a></p></div></li>';
endwhile;
wp_reset_postdata();

return '<h3>'. $title .'</h3><ul class="collapsible popout" data-collapsible="accordion"><li>'.$list . '</ul>';

}
add_shortcode('recent-posts', 'my_recent_posts_shortcode');
/* ------------------------------------------------------------------------- *
 *  Recent Post
/* ------------------------------------------------------------------------- */
function my_recent_posts1_shortcode($atts){
extract(shortcode_atts(array(
      "id" => '',
   ), $atts));
 $q = new WP_Query(
   array( 'p'=> $id,)
 );
$list ="";
while($q->have_posts()) : $q->the_post();
if (has_post_thumbnail() ) {
    $image_id = get_post_thumbnail_id();  
    $image_url = wp_get_attachment_image_src($image_id,'fg-medium');  
    $image_url = $image_url[0]; 
}
$list .= '<a href="' . get_permalink() . '"><div class="card horizontal"><div class="card-image pull-left"><img src="'.$image_url.'" /></div><div class="card-content"><p><i class="material-icons md-18">&#xE8E4;</i> Tavsiye Edilen Yazı</p><h3 class="headline">' . get_the_title() . '</h3></div></div><div class="card-url" tooltip="Yazıyı okumak için tıklayın"><i class="material-icons">&#xE876;</i></div></a>';
endwhile;
wp_reset_postdata();

return '<div class="post-card col-md-12">'.$list . '</div><div class="clearfix"></div>';

}
add_shortcode('recent-post', 'my_recent_posts1_shortcode');

/* ------------------------------------------------------------------------- *
 *  Google Map
/* ------------------------------------------------------------------------- */
function googlemap_function($atts, $content = null) {
   extract(shortcode_atts(array(
      "width" => '100%',
      "height" => '480',
      "src" => ''
   ), $atts));
   return '<p><iframe class="googlemap" width="'.$width.'" height="'.$height.'" src="'.$src.'&output=embed" ></iframe></p>';
}
add_shortcode("googlemap", "googlemap_function");
/* ------------------------------------------------------------------------- *
 *  Toggle
/* ------------------------------------------------------------------------- */
 	function ss_framework_content_togglegroup_sc( $atts, $content = null ) {
	extract(shortcode_atts(array('type' => '', ), $atts));

		if( !isset( $GLOBALS['toggle_groups'] ) )
			$GLOBALS['toggle_groups'] = 0;
			
		$GLOBALS['toggle_groups']++;
		do_shortcode( $content );
		if( is_array( $GLOBALS['toggles'] ) ) {
			foreach( $GLOBALS['toggles'] as $toggle ) {
			
			 $toggles[] = '<li><div class="collapsible-header">' . $toggle['title'] . '</div><div class="collapsible-body"><p>' . do_shortcode( $toggle['content'] ) . '</p></div></li>';
			}
			$return = "\n". '<ul class="collapsible '.$type.'" data-collapsible="accordion">' . implode( "\n", $toggles) . '</ul>' . "\n";
		}
		
		$GLOBALS['toggles'] = null;
		return $return;
	}
add_shortcode('togglegroup', 'ss_framework_content_togglegroup_sc');
	// Single tab
	function ss_framework_content_toggle_sc( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title' => ''
		), $atts) );
		$i = $GLOBALS['toggle_count'];
				$GLOBALS['toggles'][$i] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' => $content );
				$GLOBALS['toggle_count']++;
	}
	add_shortcode('toggle', 'ss_framework_content_toggle_sc');
/* ------------------------------------------------------------------------- *
 *  Tab Menu
/* ------------------------------------------------------------------------- */
 	function ss_framework_content_tabgroup_sc( $atts, $content = null ) {
	$type  = 'nav-tabs';
		if( !isset( $GLOBALS['tabs_groups'] ) )
			$GLOBALS['tabs_groups'] = 0;
			
		$GLOBALS['tabs_groups']++;
		$GLOBALS['tab_count'] = 0;
		$tabs_count = 1;
		do_shortcode( $content );
		if( is_array( $GLOBALS['tabs'] ) ) {
			foreach( $GLOBALS['tabs'] as $tab ) {
				$tabs[] = '<li><a data-toggle="tab" href="#tab-' . $GLOBALS['tabs_groups'] . '-' . $tabs_count . '">' . $tab['title'] . '</a></li>';
				$panes[] = '<div id="tab-' . $GLOBALS['tabs_groups'] . '-' . $tabs_count++ . '" class="tab-pane active">' . do_shortcode( $tab['content'] ) . '</div>';
			}
			$return = "\n". '<div class="tab-shortcode"><ul id="tabs" class="nav '.$type.'" data-tabs="tabs">' . implode( "\n", $tabs ) . '</ul>' . "\n" . '<div id="my-tab-content" class="tab-content">' . implode( "\n", $panes ) . '</div></div>' . "\n";
		}
		
		$GLOBALS['tabs'] = null;
		return $return;
	}
add_shortcode('tabgroup', 'ss_framework_content_tabgroup_sc');
	// Single tab
	function ss_framework_content_tab_sc( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title' => ''
		), $atts) );
		$i = $GLOBALS['tab_count'];
		$GLOBALS['tabs'][$i] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' => $content );
		$GLOBALS['tab_count']++;
	}
	add_shortcode('tab', 'ss_framework_content_tab_sc');
 /* ------------------------------------------------------------------------- *
 *  Vurgula
/* ------------------------------------------------------------------------- */
add_shortcode('vurgula', 'shortcode_highlight');
	function shortcode_highlight($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'renk' => 'sarı',
				'renk' => 'kırmızı',
			), $atts);
			
			if($atts['renk'] == 'kırmızı') {
				return '<span class="highlight2">' .do_shortcode($content). '</span>';
			} else {
				return '<span class="highlight1">' .do_shortcode($content). '</span>';
			}

	}	