<div class="sondakika">
	<div class="container">
		<div class="row">
			<div class="sondakika-items">
				<div class="sondakika-label pull-left">
					<i class="material-icons">&#xE3E7;</i>
				</div>
				<?php
				 query_posts( array( 'cat' =>  ot_get_option('son-dakika-kategori'), 'posts_per_page' => ot_get_option('son-dakika-sayisi') ) );
				 if(have_posts()):
				?>
							<div class="autoplay sondakika-item-group">
								<?php while(have_posts()): the_post(); $timeout = ot_get_option('son-dakika-hiz'  ); ?>
									<div class="sondakika-item">
										<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
									</div>
								<?php endwhile; ?>
							</div>
				<?php else: ?>
				<div class="sondaika-item">
					Kategori ayarlarını yapın
				</div>
				<?php endif; wp_reset_query(); ?>
			</div>
		</div>
	</div>
</div>
