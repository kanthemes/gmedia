<?php
/**
 * Team Post Type
 *
 * @package   Team_Post_Type
 * @license   GPL-2.0+
 */

/**
 * Register metaboxes.
 *
 * @package Team_Post_Type
 */
class Team_Post_Type_Metaboxes {

	public function init() {
		add_action( 'add_meta_boxes', array( $this, 'team_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ),  10, 2 );
	}

	/**
	 * Register the metaboxes to be used for the team post type
	 *
	 * @since 0.1.0
	 */
	public function team_meta_boxes() {
		add_meta_box(
			'uygulama_detay',
			'Uygulama Detayları',
			array( $this, 'render_meta_boxes' ),
			'uygulama',
			'normal',
			'high'
		);
	}

   /**
	* The HTML for the fields
	*
	* @since 0.1.0
	*/
	function render_meta_boxes( $post ) {

		$meta = get_post_custom( $post->ID );
		$uygulama_adi = ! isset( $meta['gm_uygulama_adi'][0] ) ? '' : $meta['gm_uygulama_adi'][0];
		$uygulama_gelistirici = ! isset( $meta['gm_uygulama_gelistirici'][0] ) ? '' : $meta['gm_uygulama_gelistirici'][0];
		$uygulama_dil = ! isset( $meta['gm_uygulama_dil'][0] ) ? '' : $meta['gm_uygulama_dil'][0];
		$uygulama_boyut = ! isset( $meta['gm_uygulama_boyut'][0] ) ? '' : $meta['gm_uygulama_boyut'][0];
		$uygulama_fiyat = ! isset( $meta['gm_uygulama_fiyat'][0] ) ? '' : $meta['gm_uygulama_fiyat'][0];
		$uygulama_buton = ! isset( $meta['gm_uygulama_buton'][0] ) ? '' : $meta['gm_uygulama_buton'][0];
		$uygulama_url = ! isset( $meta['gm_uygulama_url'][0] ) ? '' : $meta['gm_uygulama_url'][0];
		$uygulama_buton2 = ! isset( $meta['gm_uygulama_buton2'][0] ) ? '' : $meta['gm_uygulama_buton2'][0];
		$uygulama_url2 = ! isset( $meta['gm_uygulama_url2'][0] ) ? '' : $meta['gm_uygulama_url2'][0];

		wp_nonce_field( basename( __FILE__ ), 'uygulama_detay' ); ?>

		<table class="form-table">

			<tr>
				<td class="team_meta_box_td" colspan="2">
					<label for="gm_uygulama_adi"><?php _e( 'Uygulama Adı', 'gm' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="gm_uygulama_adi" class="regular-text" value="<?php echo $uygulama_adi; ?>">
					<p class="description"><?php _e( 'Uygulama adını girin', 'gm' ); ?></p>
				</td>
			</tr>

			<tr>
				<td class="team_meta_box_td" colspan="2">
					<label for="gm_uygulama_gelistirici"><?php _e( 'Geliştirici', 'gm' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="gm_uygulama_gelistirici" class="regular-text" value="<?php echo $uygulama_gelistirici; ?>">
					<p class="description"><?php _e( 'Uygulamanın geliştiricisi belliyse girin, belli değilse boş bırakın.', 'gm' ); ?></p>
				</td>
			</tr>

			<tr>
				<td class="team_meta_box_td" colspan="2">
					<label for="gm_uygulama_dil"><?php _e( 'Dil', 'gm' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="gm_uygulama_dil" class="regular-text" value="<?php echo $uygulama_dil; ?>">
					<p class="description"><?php _e( 'Uygulama desteklediği dilleri "," ile ayırarak girin.', 'gm' ); ?></p>
				</td>
			</tr>

			<tr>
				<td class="team_meta_box_td" colspan="2">
					<label for="gm_uygulama_boyut"><?php _e( 'Boyut', 'gm' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="gm_uygulama_boyut" class="regular-text" value="<?php echo $uygulama_boyut; ?>">
					<p class="description"><?php _e( 'Uygulama boyutunu girin.', 'gm' ); ?></p>
				</td>
			</tr>
			
			<tr>
				<td class="team_meta_box_td" colspan="2">
					<label for="gm_uygulama_fiyat"><?php _e( 'Fiyat', 'gm' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="gm_uygulama_fiyat" class="regular-text" value="<?php echo $uygulama_fiyat; ?>">
					<p class="description"><?php _e( 'Uygulamanın fiyatını girin. Ücretsizse "ücretsiz" yazın', 'gm' ); ?></p>
				</td>
			</tr>
			
			<tr>
				<td class="team_meta_box_td" colspan="2">
					<label for="gm_uygulama_buton"><?php _e( 'Buton Başlık', 'gm' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="gm_uygulama_buton" class="regular-text" value="<?php echo $uygulama_buton; ?>">
					<p class="description"><?php _e( 'Buton başlığını girin örneğin "Downlaod"', 'gm' ); ?></p>
				</td>
			</tr>
			
			<tr>
				<td class="team_meta_box_td" colspan="2">
					<label for="gm_uygulama_url"><?php _e( 'URL', 'gm' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="gm_uygulama_url" class="regular-text" value="<?php echo $uygulama_url; ?>">
					<p class="description"><?php _e( 'İndirilecek dosyanın urlsini girin.', 'gm' ); ?></p>
				</td>
			</tr>
			<tr>
				<td class="team_meta_box_td" colspan="2">
					<label for="gm_uygulama_buton"><?php _e( 'Buton Başlık2', 'gm' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="gm_uygulama_buton2" class="regular-text" value="<?php echo $uygulama_buton2; ?>">
					<p class="description"><?php _e( 'Buton başlığını girin örneğin "Downlaod"', 'gm' ); ?></p>
				</td>
			</tr>
			
			<tr>
				<td class="team_meta_box_td" colspan="2">
					<label for="gm_uygulama_url2"><?php _e( 'URL2', 'gm' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="gm_uygulama_url2" class="regular-text" value="<?php echo $uygulama_url2; ?>">
					<p class="description"><?php _e( 'İndirilecek dosyanın urlsini girin.', 'gm' ); ?></p>
				</td>
			</tr>

		</table>

	<?php }

   /**
	* Save metaboxes
	*
	* @since 0.1.0
	*/
	function save_meta_boxes( $post_id ) {

		global $post;

		// Verify nonce
		if ( !isset( $_POST['uygulama_detay'] ) || !wp_verify_nonce( $_POST['uygulama_detay'], basename(__FILE__) ) ) {
			return $post_id;
		}

		// Check Autosave
		if ( (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || ( defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit']) ) {
			return $post_id;
		}

		// Don't save if only a revision
		if ( isset( $post->post_type ) && $post->post_type == 'revision' ) {
			return $post_id;
		}

		// Check permissions
		if ( !current_user_can( 'edit_post', $post->ID ) ) {
			return $post_id;
		}

		$meta['gm_uygulama_adi'] = ( isset( $_POST['gm_uygulama_adi'] ) ? esc_textarea( $_POST['gm_uygulama_adi'] ) : '' );
		$meta['gm_uygulama_gelistirici'] = ( isset( $_POST['gm_uygulama_gelistirici'] ) ? esc_textarea( $_POST['gm_uygulama_gelistirici'] ) : '' );
		$meta['gm_uygulama_dil'] = ( isset( $_POST['gm_uygulama_dil'] ) ? esc_textarea( $_POST['gm_uygulama_dil'] ) : '' );
		$meta['gm_uygulama_boyut'] = ( isset( $_POST['gm_uygulama_boyut'] ) ? esc_textarea( $_POST['gm_uygulama_boyut'] ) : '' );
		$meta['gm_uygulama_fiyat'] = ( isset( $_POST['gm_uygulama_fiyat'] ) ? esc_textarea( $_POST['gm_uygulama_fiyat'] ) : '' );
		$meta['gm_uygulama_buton'] = ( isset( $_POST['gm_uygulama_buton'] ) ? esc_textarea( $_POST['gm_uygulama_buton'] ) : '' );
		$meta['gm_uygulama_url'] = ( isset( $_POST['gm_uygulama_url'] ) ? esc_url( $_POST['gm_uygulama_url'] ) : '' );
		$meta['gm_uygulama_buton2'] = ( isset( $_POST['gm_uygulama_buton2'] ) ? esc_textarea( $_POST['gm_uygulama_buton2'] ) : '' );
		$meta['gm_uygulama_url2'] = ( isset( $_POST['gm_uygulama_url2'] ) ? esc_url( $_POST['gm_uygulama_url2'] ) : '' );

		foreach ( $meta as $key => $value ) {
			update_post_meta( $post->ID, $key, $value );
		}
	}

}