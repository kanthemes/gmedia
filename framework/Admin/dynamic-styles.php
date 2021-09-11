<?php
/* Dinamik Stiller
/* ------------------------------------ */
if ( ! function_exists( 'gm_dynamic_css' ) ) {

	function gm_dynamic_css() {
		if ( ot_get_option('dynamic-styles') != 'off' ) {
		
			
			// baslangic
			$styles = '<style type="text/css">'."\n";			
			// arkaplan
			if ( ot_get_option('cg-background') != '#f1f1f1' ) {
				$styles .= 'body { background-color: '.ot_get_option('cg-background').' !important; }'."\n";
			}
			
			// ana-renk
			if ( ot_get_option('cg-first-color') != '#2f409a' ) {
				$styles .= '.secondary-navbar, #spinner a, .sosyal-medya a, .hotnews h2:after, span.rotate, .btn, .tabMenu ul, .tabMenu li, #comments .comment-submit, .comment.byuser span.author, #review-box .overall-score .overall, .search-bar input, .navbar-footer a:after, .featured .entry-category { background-color: '.ot_get_option('cg-first-color').' !important; }'."\n";
				$styles .= '.post-home .post-header .entry-time, .block-posts .colitem,  .post-header .entry-time, .material-input .input-submit:hover, .material-input label, .recentapp .itemBottom .fiyat, .sondakika .slick-prev:hover:before, .sondakika .slick-next:hover:before, .sondakika-label, .entry p>a, .navbar .header-menu li.aktif a, .navbar-footer   { color: '.ot_get_option('cg-first-color').' !important; }'."\n";
			}
			
			// ikinci-renk
			if ( ot_get_option('cg-second-color') != '#00233d' ) {
				$styles .= '#header, #navbar-top button.close-button  { background-color: '.ot_get_option('cg-second-color').' !important; }'."\n";
				$styles .= '.title-box i  { color: '.ot_get_option('cg-second-color').' !important; }'."\n";
			}
			
			// sidebar
			if ( ot_get_option('radio_image') == 'full-width' ) {
				$styles .= '.content{ width: 100% !important}'."\n";
				$styles .= '.sidebar.full-width{display:none !important}'."\n";
			}
			
			if ( ot_get_option('radio_image') == 'left-sidebar' ) {
				$styles .= '.content.col-md-8{ float:right !important}'."\n";
				$styles .= '.sidebar{ padding-left:0; padding-right: 15px !important}'."\n";
			}

			// tipografi
			if ( ot_get_option('typographies') != '' ) {
				
				$typographies = ot_get_option('typographies');
				$font_color = $typographies['font-color'];
				$font_family = $typographies['font-family'];
				$font_size = $typographies['font-size'];
				$font_style = $typographies['font-style'];
				$font_weight = $typographies['font-weight'];
				$line_height = $typographies['line-height'];
				
				if ( $font_color != "" ) {
					$styles .= 'body {color:'.$font_color.' !important;}'."\n";
				}
				if ( $font_family != "" ) {
					$styles .= 'body {font-family:'.$font_family.' !important;}'."\n";
				}
				if ( $font_size != "" ) {
					$styles .= 'body {font-size:'.$font_size.' !important;}'."\n";
				}
				if ( $font_style != "" ) {
					$styles .= 'body {font-style:'.$font_style.' !important;}'."\n";
				}
				if ( $font_weight != "" ) {
					$styles .= 'body {font-weight:'.$font_weight.' !important;}'."\n";
				}
				if ( $line_height != "" ) {
					$styles .= 'body {line-height:'.$line_height.' !important;}'."\n";
				}
				else {
					$styles .= '';
				}
			}
			
			$styles .= '</style>'."\n";
			// bitis
			
			echo $styles;		
		}
	}
	
}
add_action( 'wp_head', 'gm_dynamic_css', 100 );