<?php get_header(); ?>

<section class="content" id="content" role="main">
	<?php
		if ( function_exists('yoast_breadcrumb') ) {
		  yoast_breadcrumb('<div class="breadcrumbs">','</div>');
		}
	?>
	<div class="page-content" id="post-<?php the_ID(); ?>">
		<div class="page-content__wrapper">
			<header class="page-content__wrapper__title-block">
				<h1 class="page-content__wrapper__title-block__title">
					<?php _e( 'Errore 404: Pagina non trovata', 'my_website' ); ?>
				</h1>
			</header>
			<section class="entry-content">
				<p><?php _e( "Pagina non trovata. L'elemento è stato rimosso oppure il link non è valido", 'my_website' ); ?></p>
			</section>
		</div>

		<?php get_template_part('inc/before-footer', 'before-footer') ?>

	</div>

	<?php get_sidebar(); ?>
</section>
<?php get_footer('module'); ?>