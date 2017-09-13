<?php get_header(); ?>

<section class="content" id="content" role="main">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php
			if ( function_exists('yoast_breadcrumb') ) {
			  yoast_breadcrumb('<div class="breadcrumbs">','</div>');
			}
		?>
		<article class="page-content" id="post-<?php the_ID(); ?>">
			<div class="page-content__wrapper">
				<header class="page-content__wrapper__title-block">
					<h1 class="page-content__wrapper__title-block__title">
						<?php 
							if ( get_field('titolo') ){
								echo get_field('titolo');
							}
							else{
								the_title();
							}
						?>
					</h1>
					<?php if ( get_field('sottotitolo') ): ?>
						<h2 class="page-content__wrapper__title-block__subtitle">
							<?php echo get_field('sottotitolo') ?>
						</h2>
					<?php endif ?>
				</header>
				<section class="entry-content">
					<?php // if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
					<?php the_content(); ?>
				</section>
			</div>

			<?php get_template_part('inc/before-footer', 'before-footer') ?>

		</article>
	<?php endwhile; endif; ?>

	<?php get_sidebar(); ?>
</section>
<?php get_footer('module'); ?>
