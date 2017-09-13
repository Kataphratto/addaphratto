<?php get_header(); ?>

<section class="content" id="content" role="main">
	<?php
		if ( function_exists('yoast_breadcrumb') ) {
		  yoast_breadcrumb('<div class="breadcrumbs">','</div>');
		}
	?>
	<div class="page-content">
		<div class="page-content__wrapper">
			<header class="page-content__wrapper__title-block">
				<h1 class="page-content__wrapper__title-block__title">
					<?php the_title(); ?>
				</h1>
			</header>
			<section class="entry-content">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'entry' ); ?>
				<?php endwhile; endif; ?>
				
				<div class="comments">
					<?php comments_template( '', true ); ?>
				</div>
			</section>
		</div>
		<?php get_template_part('inc/before-footer', 'before-footer') ?>
	</div>

	<?php get_sidebar(); ?>
</section>

<?php get_footer(); ?>
