<?php
/**
 * Team Post Type
 *
 * @package   Team_Post_Type
 * @license   GPL-2.0+
 */

/**
 * Register post types and taxonomies.
 *
 * @package Team_Post_Type
 */
class Team_Post_Type_Registrations {

	public $post_type = 'uygulama';

	public $taxonomies = array( 'tur');
	public $taxonomiess = array( 'isletim');

	public function init() {
		// Add the team post type and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses Team_Post_Type_Registrations::register_post_type()
	 * @uses Team_Post_Type_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
		$this->register_taxonomy_category();
		$this->register_taxonomy_categoryy();
	}

	/**
	 * Register the custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
		protected function register_post_type() {
		$labels = array(
		'name'                  => _x( 'Uygulamalar', 'Uygulamalar', 'text_domain' ),
		'singular_name'         => _x( 'Uygulama', 'Post Type Singular Name', 'text_domain' ),
		'all_items'             => __( 'Tüm Uygulamalar', 'text_domain' ),	
		);

		$supports = array(
			'title',
			'editor',
			'thumbnail',
			'custom-fields',
			'revisions',
			'excerpt',
			'comments',
		);

		$args = array(
			'labels'          => $labels,
			'supports'        => $supports,
			'public'          => true,
			'capability_type' => 'post',
			'rewrite' => array(
				'slug' => 'uygulama/%isletim%/%tur%',
				'with_front' => false
			),
			'menu_position'   => 4,
			'menu_icon'       => 'dashicons-id',
		);

		$args = apply_filters( 'team_post_type_args', $args );

		register_post_type( $this->post_type, $args );
	}

	/**
	 * Register a taxonomy for Team Categories.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_category() {
		$labels = array(
			'name'                       => __( 'Uygulama Türü', 'team-post-type' ),
			'singular_name'              => __( 'Tür', 'team-post-type' ),
			'menu_name'                  => __( 'Tür', 'team-post-type' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'capability_type' => 'post',
			'hierarchical'      => true,
			'rewrite' => array(
				'slug' => 'tur',
				'with_front' => false
			),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'team_post_type_category_args', $args );
		register_taxonomy( 'tur', array( 'uygulama' ), $args );
	}
	/**
	 * Register a taxonomy for Team Categories.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_categoryy() {
		$labels = array(
			'name'                       => __( 'Uygulama Türü', 'team-post-type' ),
			'singular_name'              => __( 'Tür', 'team-post-type' ),
			'menu_name'                  => __( 'İşletim Sistemi', 'team-post-type' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'capability_type' => 'post',
			'hierarchical'      => true,
			'rewrite' => array(
				'slug' => 'isletim',
				'with_front' => false
			),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'team_post_type_category_args', $args );
		register_taxonomy( 'isletim', array( 'uygulama' ), $args );
	}
}