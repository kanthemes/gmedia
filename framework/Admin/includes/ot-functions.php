<?php if ( ! defined( 'OT_VERSION' ) ) exit( 'No direct script access allowed' );
/**
 * OptionTree functions
 *
 * @package   OptionTree
 * @author    Derek Herman <derek@valendesigns.com>
 * @copyright Copyright (c) 2013, Derek Herman
 * @since     2.0
 */
/**
 * Theme Options ID
 *
 * @return    string
 *
 * @access    public
 * @since     2.3.0
 */
if ( ! function_exists( 'ot_options_id' ) ) {
  function ot_options_id() {
    return apply_filters( 'ot_options_id', 'option_tree' );
  }
}
/**
 * Theme Settings ID
 *
 * @return    string
 *
 * @access    public
 * @since     2.3.0
 */
if ( ! function_exists( 'ot_settings_id' ) ) {
  function ot_settings_id() {
    return apply_filters( 'ot_settings_id', 'option_tree_settings' );
  }
}
/**
 * Theme Layouts ID
 *
 * @return    string
 *
 * @access    public
 * @since     2.3.0
 */
if ( ! function_exists( 'ot_layouts_id' ) ) {
  function ot_layouts_id() {
    return apply_filters( 'ot_layouts_id', 'option_tree_layouts' );
  }
}
/**
 * Get Option.
 *
 * Helper function to return the option value.
 * If no value has been saved, it returns $default.
 *
 * @param     string    The option ID.
 * @param     string    The default option value.
 * @return    mixed
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_get_option' ) ) {
  function ot_get_option( $option_id, $default = '' ) {
    /* get the saved options */ 
    $options = get_option( ot_options_id() );
    /* look for the saved value */
    if ( isset( $options[$option_id] ) && '' != $options[$option_id] ) {
      return ot_wpml_filter( $options, $option_id );
    }
    return $default;
  }
}
/**
 * Echo Option.
 *
 * Helper function to echo the option value.
 * If no value has been saved, it echos $default.
 *
 * @param     string    The option ID.
 * @param     string    The default option value.
 * @return    mixed
 *
 * @access    public
 * @since     2.2.0
 */
if ( ! function_exists( 'ot_echo_option' ) ) {
  function ot_echo_option( $option_id, $default = '' ) {
    echo ot_get_option( $option_id, $default );
  }
}
/**
 * Filter the return values through WPML
 *
 * @param     array     $options The current options    
 * @param     string    $option_id The option ID
 * @return    mixed
 *
 * @access    public
 * @since     2.1
 */
if ( ! function_exists( 'ot_wpml_filter' ) ) {
  function ot_wpml_filter( $options, $option_id ) {
    // Return translated strings using WMPL
    if ( function_exists('icl_t') ) {
      $settings = get_option( ot_settings_id() );
      if ( isset( $settings['settings'] ) ) {
        foreach( $settings['settings'] as $setting ) {
          // List Item & Slider
          if ( $option_id == $setting['id'] && in_array( $setting['type'], array( 'list-item', 'slider' ) ) ) {
            foreach( $options[$option_id] as $key => $value ) {
              foreach( $value as $ckey => $cvalue ) {
                $id = $option_id . '_' . $ckey . '_' . $key;
                $_string = icl_t( 'Theme Options', $id, $cvalue );
                if ( ! empty( $_string ) ) {
                  $options[$option_id][$key][$ckey] = $_string;
                }
              }
            }
          // List Item & Slider
          } else if ( $option_id == $setting['id'] && $setting['type'] == 'social-links' ) {
            foreach( $options[$option_id] as $key => $value ) {
              foreach( $value as $ckey => $cvalue ) {
                $id = $option_id . '_' . $ckey . '_' . $key;
                $_string = icl_t( 'Theme Options', $id, $cvalue );
                if ( ! empty( $_string ) ) {
                  $options[$option_id][$key][$ckey] = $_string;
                }
              }
            }
          // All other acceptable option types
          } else if ( $option_id == $setting['id'] && in_array( $setting['type'], apply_filters( 'ot_wpml_option_types', array( 'text', 'textarea', 'textarea-simple' ) ) ) ) {
            $_string = icl_t( 'Theme Options', $option_id, $options[$option_id] );
            if ( ! empty( $_string ) ) {
              $options[$option_id] = $_string;
            }
          }
        }
      }
    }
    return $options[$option_id];
  }
}
/**
 * Enqueue the dynamic CSS.
 *
 * @return    void
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_load_dynamic_css' ) ) {
  function ot_load_dynamic_css() {
    /* don't load in the admin */
    if ( is_admin() ) {
      return;
    }
    /**
     * Filter whether or not to enqueue a `dynamic.css` file at the theme level.
     *
     * By filtering this to `false` OptionTree will not attempt to enqueue any CSS files.
     *
     * Example: add_filter( 'ot_load_dynamic_css', '__return_false' );
     *
     * @since 2.5.5
     *
     * @param bool $load_dynamic_css Default is `true`.
     * @return bool
     */
    if ( false === (bool) apply_filters( 'ot_load_dynamic_css', true ) ) {
      return;
    }
    /* grab a copy of the paths */
    $ot_css_file_paths = get_option( 'ot_css_file_paths', array() );
    if ( is_multisite() ) {
      $ot_css_file_paths = get_blog_option( get_current_blog_id(), 'ot_css_file_paths', $ot_css_file_paths );
    }
    if ( ! empty( $ot_css_file_paths ) ) {
      $last_css = '';
      /* loop through paths */
      foreach( $ot_css_file_paths as $key => $path ) {
        if ( '' != $path && file_exists( $path ) ) {
          $parts = explode( '/wp-content', $path );
          if ( isset( $parts[1] ) ) {
            $sub_parts = explode( '/', $parts[1] );
            if ( isset( $sub_parts[1] ) && isset( $sub_parts[2] ) ) {
              if ( $sub_parts[1] == 'themes' && $sub_parts[2] != get_stylesheet() ) {
                continue;
              }
            }
            $css = set_url_scheme( WP_CONTENT_URL ) . $parts[1];
            if ( $last_css !== $css ) {
              /* enqueue filtered file */
              wp_enqueue_style( 'ot-dynamic-' . $key, $css, false, OT_VERSION );
              $last_css = $css;
            }
          }
        }
      }
    }
  }
}
/**
 * Enqueue the Google Fonts CSS.
 *
 * @return    void
 *
 * @access    public
 * @since     2.5.0
 */
if ( ! function_exists( 'ot_load_google_fonts_css' ) ) {
  function ot_load_google_fonts_css() {
    /* don't load in the admin */
    if ( is_admin() )
      return;
    $ot_google_fonts      = get_theme_mod( 'ot_google_fonts', array() );
    $ot_set_google_fonts  = get_theme_mod( 'ot_set_google_fonts', array() );
    $families             = array();
    $subsets              = array();
    $append               = '';
    if ( ! empty( $ot_set_google_fonts ) ) {
      foreach( $ot_set_google_fonts as $id => $fonts ) {
        foreach( $fonts as $font ) {
          // Can't find the font, bail!
          if ( ! isset( $ot_google_fonts[$font['family']]['family'] ) ) {
            continue;
          }
          // Set variants & subsets
          if ( ! empty( $font['variants'] ) && is_array( $font['variants'] ) ) {
            // Variants string
            $variants = ':' . implode( ',', $font['variants'] );
            // Add subsets to array
            if ( ! empty( $font['subsets'] ) && is_array( $font['subsets'] ) ) {
              foreach( $font['subsets'] as $subset ) {
                $subsets[] = $subset;
              }
            }
          }
          // Add family & variants to array
          if ( isset( $variants ) ) {
            $families[] = str_replace( ' ', '+', $ot_google_fonts[$font['family']]['family'] ) . $variants;
          }
        }
      }
    }
    if ( ! empty( $families ) ) {
      $families = array_unique( $families );
      // Append all subsets to the path, unless the only subset is latin.
      if ( ! empty( $subsets ) ) {
        $subsets = implode( ',', array_unique( $subsets ) );
        if ( $subsets != 'latin' ) {
          $append = '&subset=' . $subsets;
        }
      }
      wp_enqueue_style( 'ot-google-fonts', esc_url( '//fonts.googleapis.com/css?family=' . implode( '%7C', $families ) ) . $append, false, null );
    }
  }
}
/**
 * Registers the Theme Option page link for the admin bar.
 *
 * @return    void
 *
 * @access    public
 * @since     2.1
 */
if ( ! function_exists( 'ot_register_theme_options_admin_bar_menu' ) ) {
  function ot_register_theme_options_admin_bar_menu( $wp_admin_bar ) {
    if ( ! current_user_can( apply_filters( 'ot_theme_options_capability', 'edit_theme_options' ) ) || ! is_admin_bar_showing() )
      return;
    $wp_admin_bar->add_node( array(
      'parent'  => 'appearance',
      'id'      => apply_filters( 'ot_theme_options_menu_slug', 'ot-theme-options' ),
      'title'   => apply_filters( 'ot_theme_options_page_title', __( 'Theme Options', 'option-tree' ) ),
      'href'    => admin_url( apply_filters( 'ot_theme_options_parent_slug', 'themes.php' ) . '?page=' . apply_filters( 'ot_theme_options_menu_slug', 'ot-theme-options' ) )
    ) );
  }
}
add_action('wp_footer', 'kan_themes_head');
add_action('wp_head', 'kan_themes_head');
function kan_themes_head() {
	echo '<!-- Bu tema kanthemes.com tarafından ücretsiz olarak paylaşılmıştır. -->';
}
function gmedia_header() {?>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() . '/style.css' ); ?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() . '/dist/css/font-awesome.min.css' ); ?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() . '/dist/slick/slick.css' ); ?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() . '/dist/slick/slick-theme.css' ); ?>"/>
<header id="headerAll">
	<div id="header">
		<div class="container">
			<div class="row">
				<div class="pull-left">
					<?php if ( ot_get_option('custom-logo') ): ?>
					<div class="logo pull-left">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo ot_get_option('custom-logo'); ?>" alt="<?php bloginfo('name'); ?>"/></a>  
					</div>
					<?php else: ?>
						<div class="logo pull-left">
						<h1 class="logoyok"><a class="logo-yok" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
						</div>
					<?php endif; ?>
				<?php if ( ot_get_option( 'open-menu' ) != 'off' ): ?>
					<div class="menu-icon pull-left">
						<a href="#" id="hamburger-icon" class="buton-md more waves-effect" title="Menu">
							<i class="material-icons md-light"></i>
						</a>
					</div>
				<?php endif; ?>
				</div>
					<div class="pull-right arama">
						<?php gm_social_links() ; ?>
						<form  method="get" action="<?php echo home_url('/'); ?>" class="search-bar">
							<input name="s" type="text" >
							<label>Arama</label>
							<span class="icon">
							  <i class="circle"></i>
							  <i class="line1"></i>
							  <i class="line2"></i>
							</span>
						</form>
				</div>
			</div>
		</div> 
	</div> 
	<div class="secondary-navbar">
		<div class="container">
			<div class="row">
				<div class="sec-menu-icon">
					<button class="waves-effect"><i class="material-icons md-light"></i></button> Menü
				</div>
				<?php $defaults = array('theme_location'  => 'secondary','menu'            => '','container'       => 'div','container_class' => '','container_id'    => '','menu_class'      => 'secondaryheader','menu_id'         => '','echo'            => true,'fallback_cb'     => 'wp_page_menu','before'          => '','after'           => '','link_before'     => '','link_after'      => '','items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>','depth'           => 0,'walker'          => ''); wp_nav_menu( $defaults ); ?>
			</div>
		</div>
	</div>
		<?php if ( ot_get_option( 'son-dakika' ) != 'off' ) { get_template_part('framework/Blog/sondakika'); } ?>
	</header>
		<div class="navbar">
			<div id="navbar-top" style="background: #fff url(<?php echo ot_get_option('navbar-images'); ?>)no-repeat center center/cover">
				<div class="navbar-header">
					<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
				</div>
				<div class="navbar-close">
					<button class="close-button btn circle waves-effect waves-light"><i class="material-icons"></i></button>
				</div>
			</div>
			<div class="divider"></div>
			 <?php $defaults = array('theme_location'  => 'header','menu'            => '','container'       => 'div','container_class' => 'navbar-mid','container_id'    => '','menu_class'      => 'header-menu','menu_id'         => '','echo'            => true,'fallback_cb'     => 'wp_page_menu','before'          => '','after'           => '','link_before'     => '','link_after'      => '','items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>','depth'           => 0,'walker'          => ''); wp_nav_menu( $defaults ); ?>
			 <?php if (ot_get_option('kanthemes-link') != 'off'): ?>
       <div class="navbar-footer">

				<a rel="noreferrer noopener nofollow" target="_blank" href="https://www.kanthemes.com/" title="Kaliteli ve SEO Uyumlu Türkçe Wordpress Temaları">Wordpress Tema</a>

			 </div>
       <?php endif; ?>
		</div>
<?php }
add_action('wp_footer', 'gmedia_footer');
function gmedia_footer() { ?>
<footer id="footer">
    <div class="footer-bottom">
        <div class="container">
                <div class="site-copyright pull-left">
					<div class="pull-left">
                    <?php echo ot_get_option( 'copyright' ); ?>
					</div>
                </div>
				<div class="gotop pull-center">
					<a class="btn gotop waves-effect" href="#" title="Yukarı Çık"><i class="material-icons"></i></a>
				</div>
                <div class="footer-menu pull-right">
                    <?php $defaults = array('theme_location'  => 'footer','menu'            => '','container'       => 'div','container_class' => '','container_id'    => '','menu_class'      => 'menu-footer','menu_id'         => '','echo'            => true,'fallback_cb'     => 'wp_page_menu','before'          => '','after'           => '','link_before'     => '','link_after'      => '','items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>','depth'           => 0,'walker'          => ''); wp_nav_menu( $defaults ); ?>
                </div>
        </div>
    </div>
</footer> 
<div class="mdl-layout__obfuscator"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://use.fontawesome.com/44f57040ad.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() . '/dist//js/gm.js' ); ?>"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() . '/dist/slick/slick.min.js' ); ?>"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() . '/dist/js/theia-sticky-sidebar.js' ); ?>"></script>
<?php }
add_action( 'admin_notices', 'gmedia_admin_notice_error');
function gmedia_admin_notice_error() { ?>		
<div class="notice notice-info is-info is-dismissible" style="position: relative">
<button type="button" class="notice-dismiss">
		<span class="screen-reader-text">Dismiss this notice.</span>
	</button>
<p style="font-size:16px">Gmedia, <a href="https://www.kanthemes.com" title="Kan Themes">Kan Themes</a> tarafından ücretsiz paylaşılmış bir wordpress blog temasıdır. Eğer temamızdan memnunsanız aşağıdaki teşekkür et butonuna tıklayarak ürün sayfamızda kısa bir mesaj bırakabilirsiniz.</p>
<p style="font-size:16px">Hata bildirimi yapmak için veya tema ile alakalı sorularınız için aşağıdaki Hata Bildirimi butonuna tıklayarak bir konu başlatabilirsiniz.</p>
<p>
<a class="button-secondary" target="_blank" href="https://github.com/kanthemes/gmedia/issues"> <?php printf(esc_html__('Hata Bildir', 'gm')); ?></a><br><br>
<a class="button-secondary" target="_blank" href="https://www.kanthemes.com/urun/gmedia-ucretsiz-blog-temasi/"> <?php printf(esc_html__('Teşekkür Et', 'gm')); ?></a>
<a class="button-primary" target="_blank" href="https://www.kanthemes.com/wordpress-temalari/" target="_blank"><?php esc_html_e('Diğer Temalarımıza Göz At', 'gm'); ?></a>
</p>
</div>
<?php }
/* End of file ot-functions.php */
/* Location: ./includes/ot-functions.php */