<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<h3 class="entry-title">
			<?php the_title() ?>
		</h3>
	</header>

	<div class="entry-content entry-content--search">
		<?php the_excerpt(); ?>
	</div>

	<footer class="entry-footer">
		<a class="entry-footer-link" href="<?php echo esc_url( get_permalink() ) ?>">
			<?php _e("Vai all'articolo", 'my_website') ?>
		</a>
	</footer>

</article>