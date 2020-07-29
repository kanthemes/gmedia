<?php
/*
 * Metaboxes
 * --------------------------
 *
 */ 
add_filter( 'gm_metaboxes', 'gm_metaboxes' );
function gm_metaboxes( array $metaboxes ) {
		$prefix = 'gm_';		
		$metaboxes[] = array(
			'id'		 => 'review_control',
			'title'      => __('Puanlama Sistemi', 'gm'),
			'pages'      => array('post','uygulama'), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'fields' => array(
				array(
					'label' => __('Puanlamayı Etkinleştir', 'gm'),
					'desc'	=> __('Puanlama sistemini etkinleştirmek için bunu işaretleyin.', 'gm'),
					'id'	=> $prefix . 'enable_review',
					'type'	=> 'checkbox'
				),
				array(
					'label' => __('Kriterler', 'gm'),
					'desc'	=> __('<strong>Kriter</strong> : Kriteriniz - <strong>Skor</strong> : 0 - 10 arasında bir değer girin, örn. 0.1', 'gm'),
					'id'	=> $prefix . 'rating_criteria',
					'type'	=> 'rating_criteria'
				),
				array(
					'label' => __('Puanlama Tipi', 'gm'),
					'desc'	=> __('Puanlama tipini iki farklı şekilde seçebilirsiniz.', 'gm'),
					'id'	=> $prefix . 'rating_type',
					'type'	=> 'select',
					'options' => array ( 'number' => 'Sayı', 'letter' => 'Harf' )
				),
				array(
					'label' => __('Puanlama Başlığı', 'gm'),
					'desc'	=> __('Puanlama kutusunun başlığını girin', 'gm'),
					'id'	=> $prefix . 'review_box_title',
					'type'	=> 'text',
					'std'	=> 'GM Uckan Teması'
				),
				array(
					'label' => __('Açıklama', 'gm'),
					'desc'	=> __('Puanlama hakkında açıklama girebilirsiniz.', 'gm'),
					'id'	=> $prefix . 'review_summary',
					'type'	=> 'textarea',
					'std'	=> 'GM Uckan teması google materyal tasarım standartlarında tasarlanan bir wordpress temasıdır.'
				),
			)
		);
	return $metaboxes;
}
