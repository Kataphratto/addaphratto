<?php get_header(); ?>

<section class="content" id="content" role="main">
	<div class="page-content">
		<?php
			if ( function_exists('yoast_breadcrumb') ) {
			  yoast_breadcrumb('<div class="breadcrumbs">','</div>');
			}
		?>
		<div class="page-content__wrapper">
			<header class="page-content__wrapper__title-block">
				<h1 class="page-content__wrapper__title-block__title">
					<?php the_title(); ?>
				</h1>
				<?php if ( get_field('sottotitolo') ): ?>
					<h2 class="page-content__wrapper__title-block__subtitle">
						<?php echo get_field('sottotitolo') ?>
					</h2>
				<?php endif ?>
			</header>
			<section class="entry-content">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'entry' ); ?>
				<?php endwhile; endif; ?>
				<?php get_template_part( 'nav', 'below' ); ?>
			</section>
		</div>
		<?php get_template_part('inc/before-footer', 'before-footer') ?>
	</div>

	<?php get_sidebar(); ?>
</section>

<?php get_footer(); ?>