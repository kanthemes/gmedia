<div class="col-md-3 ">
	<div class="uyg-box">
		<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'>
			<div class="uygulama-image waves-effect waves-light">
				<?php the_post_thumbnail( array(125,125) ); ?>
			</div>
		</a>
		<div class="post-meta">
			<div class="title">
				<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php $values = get_post_custom_values("gm_down_title"); echo $values[0]; ?></a>
			</div>
			<div class="pull-left tur-isletim">
				<?php if ( $terms = get_the_terms( $post->ID , 'tur' )): ?>
				<?php foreach( $terms as $term ) { ?>
					<a href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a>
				<?php unset($term); } ?>
				<?php else: ?>
				<?php endif; ?>
			</div>
			<div class="pull-right fiyat">
				<?php if ( $values = get_post_custom_values("gm_down_fiyat")): ?>
					<?php $values = get_post_custom_values("gm_down_fiyat"); echo $values[0]; ?>
				<?php else: ?>
					Ücretsiz
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>