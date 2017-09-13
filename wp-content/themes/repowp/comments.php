<?php if ( 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) return; ?>
<section id="comments">

	<?php if ( have_comments() ) : 

		if ( ! empty( $comments_by_type['comment'] ) ) : ?>
			<section id="comments-list" class="comments">
				<div class="comments__summary"><?php comments_number(); ?></div>
				<?php if ( get_comment_pages_count() > 1 ) : ?>
					<nav id="comments-nav-above" class="comments-navigation" role="navigation">
						<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
					</nav>
				<?php endif; ?>

				<ul class="comments__list">
					<?php wp_list_comments( 'type=comment' ); ?>
				</ul>
				
				<?php if ( get_comment_pages_count() > 1 ) : ?>
					<nav id="comments-nav-below" class="comments-navigation" role="navigation">
						<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
					</nav>
				<?php endif; ?>
			</section>
		<?php endif; 
	endif;

	if ( comments_open() ) comment_form(); ?>
</section>