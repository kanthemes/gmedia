<?php
/**
 * Initialize the custom Theme Options.
 */
add_action( 'init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 *
 * @return    void
 * @since     2.0
 */
function custom_theme_options() {

  /* OptionTree is not loaded yet, or this is not an admin request */
  if ( ! function_exists( 'ot_settings_id' ) || ! is_admin() )
    return false;

  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( ot_settings_id(), array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'content'       => array( 
        array(
          'id'        => 'option_types_help',
          'title'     => __( 'Hakkında', 'gm' ),
          'content'   => '<p>' . __( 'Bu tema Uckan Themes tarafından geliştirilmiştir. İletişim için uckannet@gmail.com adresine mail atabilirsiniz.', 'gm' ) . '</p>'
        )
      )
    ),
    'sections'        => array( 
	array(
        'id'          => 'genel',
        'title'       => __( 'Genel', 'Gm' )
      ),
	  array(
        'id'          => 'blog',
        'title'       => __( 'Blog', 'gm' )
      ),
	  array(
        'id'          => 'footer',
        'title'       => __( 'Footer', 'gm' )
      ),
	  array( 
        'id'          => 'manset',
        'title'       => __( 'Manşet', 'gm' )
      ),
	  array( 
        'id'          => 'sondakika',
        'title'       => __( 'Son Dakika', 'gm' )
      ),
	  array( 
        'id'          => 'sosyal',
        'title'       => __( 'Sosyal', 'gm' )
      ),
	  array( 
        'id'          => 'slider',
        'title'       => __( 'Slider', 'gm' )
      ),
	  array( 
        'id'          => 'reklam',
        'title'       => __( 'Reklam Yönetimi', 'gm' )
      ),
	  array( 
        'id'          => 'analiz',
        'title'       => __( 'Analiz Kodunuz', 'gm' )
      ),
	  array( 
        'id'          => 'theme-styles',
        'title'       => __( 'Görünüm Ayarları', 'gm' )
      ),
    ),
    'settings'        => array(
			array(
				'id'		=> 'kanthemes-link',
				'label'		=> 'Tema Yapımcısı Linki',
				'desc'		=> 'Tema yapımcısı linkinin görünümü.',
				'std'		=> 'on',
				'type'		=> 'on-off',
				'section'	=> 'genel'
			),
		array(
			'id'		=> 'custom-logo',
			'label'		=> __('Logo', 'gm'),
			'desc'		=> 'Yüksekliği <code>60pixeli</code> geçmeyecek bir logo ekleyebilirsiniz.',
			'type'		=> 'upload',
			'section'	=> 'genel'
		),
		array(
			'id'		=> 'no-images',
			'label'		=> __('Default Görsel', 'gm'),
			'desc'		=> 'Öne çıkarılmış görsel yoksa buraya eklediğiniz görsel gözükecek',
			'std'       => get_template_directory_uri() . '/images/thumbnail.png',
			'type'		=> 'upload',
			'section'	=> 'genel'
		),
		array(
			'id'		=> 'favicon',
			'label'		=> __('Favicon', 'gm'),
			'desc'		=> '16x16 ebatlarında png/gif/ico formatında favicon ekleyebilirsiniz',
			'type'		=> 'upload',
			'section'	=> 'genel'
		),
		array(
			'id'			=> 'excerpt-length',
			'label'			=> __('Kelime Limiti', 'gm'),
			'desc'			=> 'Max kelime sayısı <code>Standart: 30</code>',
			'std'			=> '30',
			'type'			=> 'numeric-slider',
			'section'		=> 'blog',
			'min_max_step'	=> '0,40,1'
		),
		array(
			'id'		=> 'breadcrumb',
			'label'		=> 'Breadcrumb Ayarı',
			'desc'		=> 'Breadcrumb <code>Aktif/Aktif Değil</code>',
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		array(
			'id'		=> 'related-posts',
			'label'		=> 'Benzer Yazılar',
			'desc'		=> 'Yazı içerisinde benzer yazıları <code>göster/gösterme</code>',
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		array(
			'id'		=> 'share-post',
			'label'		=> 'Yazıyı Paylaş',
			'desc'		=> 'Yazı içerisinde yazıyı paylaş butonlarını <code>göster/gösterme</code>',
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		array(
			'id'		=> 'hotnews',
			'label'		=> 'Manşet',
			'desc'		=> 'Anasayfada manşet göster/gösterme',
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'manset'
		),
		array(
			'id'			=> 'hotnews_posts_count',
			'label'			=> __('Manşette görünmesini istediğiniz yazı sayısı', 'gm'),
			'desc'			=> 'Max yazı sayısı <code>Standart: 5</code>',
			'std'			=> '5',
			'type'			=> 'numeric-slider',
			'section'		=> 'manset',
			'min_max_step'	=> '5,13,4'
		),
		array(
			'id'		=> 'hotnews_category',
			'label'		=> 'Manşet Kategorisi',
			'desc'		=> 'Manşette görünmesini istediğiniz yazıların bulunduğu kategoriyi seçin',
			'type'		=> 'category-checkbox',
			'section'	=> 'manset'
		),
		array(
			'id'		=> 'slider',
			'label'		=> 'Slider',
			'desc'		=> 'Anasayfada slider (Menü altındaki) göster/gösterme',
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'slider'
		),
		array(
			'id'		=> 'slider_category',
			'label'		=> 'Slider Kategorisi',
			'desc'		=> 'Sliderda görünmesini istediğiniz yazıların bulunduğu kategoriyi seçin',
			'type'		=> 'category-checkbox',
			'section'	=> 'slider'
		),
		array(
			'id'			=> 'slider_posts_count',
			'label'			=> __('Sliderda görünmesini istediğiniz yazı sayısı', 'gm'),
			'desc'			=> 'Max yazı sayısı <code>Standart: 6</code>',
			'std'			=> '6',
			'type'			=> 'numeric-slider',
			'section'		=> 'slider',
			'min_max_step'	=> '5,12,1'
		),
		array(
			'id'		=> 'copyright',
			'label'		=> 'Footer Copyright',
			'desc'		=> 'Footerda gözükmesini istediğiniz copyright içeriğini girin.',
			'type'		=> 'textarea',
			'section'	=> 'footer'
		),
		array(
			'id'		=> 'yazi-reklam',
			'label'		=> 'Yazı içi reklam 300x250',
			'desc'		=> 'Yazı içinde öne çıkarılmış görselin altına reklam ekleyebilirsiniz. Yandaki alana reklam kodunuzu ekleyin.',
			'type'		=> 'textarea-simple',
			'rows'       => '10',
			'section'	=> 'reklam'
		),
		array(
			'id'		=> 'yazi-sonu-reklam',
			'label'		=> 'Yazı Sonu reklam',
			'desc'		=> 'Yazı sonuna reklam ekleyebilirsiniz. Yandaki alana reklam kodunuzu ekleyin.',
			'type'		=> 'textarea-simple',
			'rows'       => '10',
			'section'	=> 'reklam'
		),
		array(
			'id'		=> 'headeralti-reklam',
			'label'		=> 'Header Altı reklam',
			'desc'		=> ' Yandaki alana reklam kodunuzu ekleyin.',
			'type'		=> 'textarea-simple',
			'rows'       => '10',
			'section'	=> 'reklam'
		),
		array(
			'id'		=> 'footer-analiz',
			'label'		=> 'Footer Kod',
			'desc'		=> 'Bu alana ekleyeceğiniz kod sitenin en alt kısmına eklenecek. Buraya google analiz kodunuzu veya herhangi bir analiz kodunu ekleyebilirsiniz.',
			'type'		=> 'textarea-simple',
			'rows'       => '10',
			'section'	=> 'analiz'
		),
		array(
			'id'		=> 'social-links',
			'label'		=> 'Sosyal Linkler',
			'desc'		=> 'Sosyal medya sitelerindeki hesaplarınızı açılır menüye ekleyebilirsiniz. Yeni bir hesap eklemek için <code>Add New</code> butonuna tıklayın.',
			'type'		=> 'list-item',
			'section'	=> 'sosyal',
			'choices'	=> array(),
			'settings'	=> array(
				array(
					'id'		=> 'social-link',
					'label'		=> 'Link',
					'desc'		=> 'Sosyal medya hesabınızın tam urlsini girin.',
					'std'		=> 'http://',
					'type'		=> 'text',
					'choices'	=> array()
				),
				array(
					'id'		=> 'social-icon',
					'label'		=> 'İkon',
					'desc'		=> 'Örnek: fa-facebook (Diğerleri için <a href="https://fontawesome.com/v4.7.0/icons/">tıklayın.</a>',
					'std'		=> 'fa-',
					'type'		=> 'text',
					'choices'	=> array()
				),
				array(
					'id'		=> 'social-target',
					'label'		=> 'Link Ayarları',
					'desc'		=> '',
					'std'		=> '',
					'type'		=> 'checkbox',
					'choices'	=> array(
						array( 
							'value' => '_blank',
							'label' => 'Yeni sekmede açılsın'
						)
					)
				)
			)
		),
		array(
			'id'		=> 'son-dakika',
			'label'		=> 'Son Dakika',
			'desc'		=> '',
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'sondakika'
		),
		array(
			'id'			=> 'son-dakika-sayisi',
			'label'			=> __('Yazı Sayısı', 'gm'),
			'desc'			=> '',
			'std'			=> '6',
			'type'			=> 'numeric-slider',
			'section'		=> 'sondakika',
			'min_max_step'	=> '5,12,1'
		),
		array(
        'id'          => 'son-dakika-kategori',
        'label'       => __( 'Category Select', 'gm' ),
        'desc'        => __( 'The Category Select option type displays a list of category IDs. It allows the user to select only one category ID and will return that value for use in a custom function or loop.', 'theme-text-domain' ),
        'std'         => '',
        'type'        => 'category-select',
        'section'     => 'sondakika',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
		array(
			'id'		=> 'dynamic-styles',
			'label'		=> 'Ayarlar Geçerli Olsun mu?',
			'desc'		=> 'Aşağıdaki ayarların geçeriliği olsun/olmasın',
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'theme-styles'
		),
		array(
			'id'          => 'radio_image',
			'label'       => __( 'Sidebar Görünümü', 'bg' ),
			'desc'        => sprintf( __( 'Sidebarın nasıl görünmesini istediğinizi seçin. SAdece ilk üçü çalışır.', 'gm' )),
			'std'         => 'right-sidebar',
			'type'        => 'radio-image',
			'section'     => 'theme-styles',
			'operator'    => 'and'
		),
		array(
			'id'		=> 'cg-background',
			'label'		=> 'Body Background',
			'std'		=> '#f1f1f1',
			'type'		=> 'colorpicker',
			'section'	=> 'theme-styles'
		),
		array(
			'id'		=> 'cg-first-color',
			'label'		=> 'Ana Renk',
			'desc'			=> 'Sitenin tasarımına uygun bir renk seçimi yapmak için <a href="https://material.google.com/style/color.html#color-color-palette">tıklayın.</a>',
			'std'		=> '#4861de',
			'type'		=> 'colorpicker',
			'class'		=> '',
			'section'	=> 'theme-styles'
		),
		array(
			'id'		=> 'cg-second-color',
			'label'		=> 'İkinci renk',
			'std'		=> '#364bb7',
			'desc'			=> 'Sitenin tasarımına uygun bir renk seçimi yapmak için <a href="https://material.google.com/style/color.html#color-color-palette">tıklayın.</a>',
			'type'		=> 'colorpicker',
			'class'		=> '',
			'section'	=> 'theme-styles'
		),
		array(
			'id'		=> 'typographies',
			'label'		=>  __( 'Tipografi', 'gm' ),
			'desc'		=>  __( 'Site tipografisini ayarlayın', 'gm' ),
			'type'		=> 'typography',
			'section'	=> 'theme-styles'
		),
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings ); 
  }
  
  /* Lets OptionTree know the UI Builder is being overridden */
  global $ot_has_custom_theme_options;
  $ot_has_custom_theme_options = true;
  
}