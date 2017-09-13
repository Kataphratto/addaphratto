<?php get_header(); ?>
<section class="content" id="content" role="main">
	<?php
		if ( function_exists('yoast_breadcrumb') ) {
		  yoast_breadcrumb('<div class="breadcrumbs">','</div>');
		}
	?>
	<div class="page-content" id="post-<?php the_ID(); ?>">
		<div class="page-content__wrapper">
			<?php if ( have_posts() ) : ?>
				<header class="page-content__wrapper__title-block">
					<h1 class="page-content__wrapper__title-block__title">
						<?php printf( __( 'Risultati per: %s', 'my_website' ), get_search_query() ); ?>
					</h1>
				</header>

				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'entry-search' ); ?>
				<?php endwhile; ?>
					<?php get_template_part( 'nav', 'below' ); ?>
				<?php else : ?>

				<header class="page-content__wrapper__title-block">
					<h2 class="page-content__wrapper__title-block__title">
						<?php _e( 'Nessun risultato disponibile. Riprova modificando i termini di ricerca', 'my_website' ); ?>
					</h2>
				</header>
				<article class="post no-results not-found">
					<section class="entry-content">
						<p><?php _e( 'Riprova con il form sottostante.', 'my_website' ); ?></p>
						<?php get_search_form(); ?>
					</section>
				</article>
			<?php endif; ?>
		</div>
	</div>
	<?php get_sidebar(); ?>
</section>
<?php get_footer(); ?>