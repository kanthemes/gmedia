<div class="clearfix"></div>
<div class="post-navigation">
	<?php $prev_post = get_previous_post(); if($prev_post) { ?>
		<div class="older-posts col-md-6">
			<i class="material-icons md-18"></i> <?php previous_post_link('%link') ?>
		</div>
	<?php }?>
						
	<?php $next_post = get_next_post(); if($next_post) { ?>
		<div class="newer-posts col-md-6">
			<?php  next_post_link('%link') ?> <i class="material-icons md-18"></i>
		</div>
	<?php }?>
</div> 