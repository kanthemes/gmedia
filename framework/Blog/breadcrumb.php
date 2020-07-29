<div id="breadcrumbs">
	<div xmlns:v="http://rdf.data-vocabulary.org/#">
		<span typeof="v:Breadcrumb">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="active waves-effect btn" rel="v:url" property="v:title">Anasayfa</a>
			<span rel="v:child" typeof="v:Breadcrumb">
				<?php
					$categories = get_the_category();
					$output = '';
					if($categories){
						foreach($categories as $category) {
							$output .= '<a class="waves-effect waves-light btn twitter" href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "%s hakkında diğer yazılar", "gm" ), $category->name ) ) . '" rel="v:url" property="v:title">'.$category->cat_name.'</a>';
						}
					echo trim($output);
					}
				?>
			</span>
		</span>	
	</div>	
</div>
