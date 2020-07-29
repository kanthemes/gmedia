<?php
if (post_password_required()) {
    return;
} ?>
<div id="comments" class="comments-area">
 <?php if ('open' == $post->comment_status) : ?>
    <div id="respond">	
		<div class="post-title">
			<h3 class="title">Bir Cevap Yazın</h3>
		</div>	
		<?php cancel_comment_reply_link(); ?>
		<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
		<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
		<?php else : ?>
		<p class="comment-notes">E-posta hesabınız yayınlanmayacak. Gerekli alanlar <span class="required">*</span> ile işaretlenmişlerdir</p>   
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="comment-form" id="commentform">
		<div class="comment-input">
			<textarea name="comment" id="comment" cols="100%" rows="5" tabindex="4"></textarea>
			<span></span>
		</div>
		<?php if ( $user_ID ) : ?>
		<p class="comment-logged"><a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a> hesabından çıkış yapmak için <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Çıkış yap">tıklayın.</a></p>
		<?php else : ?>
		<div class="comment-input-group">
			<div class="comment-input">
				<label>Kullanıcı Adı: <?php if ($req) echo "*"; ?></label>
				<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" <?php if ($req) echo "aria-required='true'"; ?> />
			</div>
			<div class="comment-input">
				<label>E-Posta: <?php if ($req) echo "*"; ?></label>
				<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" <?php if ($req) echo "aria-required='true'"; ?> />
			</div>
			<div class="comment-input last">
				<label>Website:</label>
				<input type="text" name="url" id="Website" value="<?php echo esc_attr($comment_author_url); ?>" />
			</div>
		</div>
		<?php endif; ?>    
		<button name="submit" type="submit" id="submit" class="comment-submit" tabindex="5"/>Yorum Gönder</button>
		<?php comment_id_fields(); ?>
		<?php do_action('comment_form', $post->ID); ?>
		</form>
		<?php endif; // If registration required and not logged in ?>
	</div>
	<?php endif; // if you delete this the sky will fall on your head ?>
<div id="respond">
    <?php if (have_comments()) : ?>
		<div class="comment-box">
			<h3><?php comments_number( 'Yorum Yok', 'Yapılan Yorum (1)', 'Yapına Yorumlar (%)' ); ?></a></h3>
		</div>
		<div class="commentbox">
			<ul class="media-list">
				<?php wp_list_comments(array('callback' => 'gm_comment')); ?>
			</ul>
			<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
				<nav id="comment-nav-below" class="navigation" role="navigation">
					<div class="nav-previous">
						<?php previous_comments_link( _e('&larr; Older Comments', 'gm')); ?>
					</div>
					<div class="nav-next">
						<?php next_comments_link(_e('Newer Comments &rarr;', 'gm')); ?>
					</div>
				</nav>
			<?php endif; ?>
		</div>
        <?php else : ?>
        <?php if ('open' == $post->comment_status) : ?>
			<p class="no-comment"><i class="material-icons">sentiment_neutral</i> Bu yazıya henüz yorum yapılmamıştır, yazı hakkındaki düşüncelerinizi paylaşmaktan çekinmeyin.</p>
        <?php else : ?>
			<p><i class="material-icons">wifi_lock</i> Bu yazıya yorum yapılması editör tarafından yasaklanmıştır, anlayışınız için teşekkürler.</p>
        <?php endif; ?>
    <?php endif; ?>
</div>
</div><!-- #comments .comments-area -->