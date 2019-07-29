<div class="down-detail">
<div class="down-header">
	<ul>
		<?php if ( $values = get_post_custom_values("gm_down_title")): ?><li><span class="bold">Uygulama Adı:</span> <?php $values = get_post_custom_values("gm_down_title"); echo $values[0]; ?></li><?php endif; ?>
		<?php if ( $values = get_post_custom_values("gm_down_develop")): ?><li><span class="bold">Geliştirici:</span> <?php $values = get_post_custom_values("gm_down_develop"); echo $values[0]; ?></li><?php endif; ?>
		<?php if ( $terms = get_the_terms( $post->ID , 'tur' )): ?>
			<?php foreach( $terms as $term ) { ?>
				<li><span class="bold">Tür: </span><a href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a></li>
			<?php unset($term); } ?>
		<?php else: ?>
		<?php endif; ?>
		<?php if ( $values = get_post_custom_values("gm_down_language")): ?><li><span class="bold">Dil:</span> <?php $values = get_post_custom_values("gm_down_language"); echo $values[0]; ?></li><?php endif; ?>
		<?php if ( $values = get_post_custom_values("gm_down_size")): ?><li><span class="bold">Boyut:</span> <?php $values = get_post_custom_values("gm_down_size"); echo $values[0]; ?></li><?php endif; ?>
		<?php if ( $values = get_post_custom_values("gm_down_fiyat")): ?><li><span class="bold">Fiyat:</span> <?php $values = get_post_custom_values("gm_down_fiyat"); echo $values[0]; ?></li><?php else: ?><li><span class="bold">Fiyat:</span> Ücretsiz</li><?php endif; ?>
	</ul>	
</div>
<div class="divider"></div>
<div class="down-footer">
<?php if ( $values = get_post_custom_values("gm_down_url")): ?>
	<a class="btn waves-effect waves-light" target="blank" href="<?php echo esc_url( home_url( '/' ) ); ?>download.php?id=<?php echo $post->ID; ?>" rel="nofollow" title="İndir <?php the_title(); ?>"><?php $values = get_post_custom_values("gm_down_button_title"); echo $values[0]; ?></a>
<?php endif; ?>
<?php if ( $values = get_post_custom_values("gm_down_url1")): ?>
<br />
<br />
	<a class="btn twitter waves-effect waves-light" target="blank" href="<?php echo esc_url( home_url( '/' ) ); ?>download1.php?id=<?php echo $post->ID; ?>" rel="nofollow" title="İndir <?php the_title(); ?>"><?php $values = get_post_custom_values("gm_down_button_title1"); echo $values[0]; ?></a>
<?php endif; ?>
</div>
</div>