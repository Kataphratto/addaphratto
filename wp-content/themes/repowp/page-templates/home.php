<?php

/*
	Template Name: Home
*/

get_header(); ?>

<section class="content" id="content" role="main">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<article class="page-content" data-onepage>
		<div class="page-content__wrapper page-content__wrapper--fullwidth">
			<section class="entry-content">
				<?php the_content(); ?>
			</section>
		</div>

	</article>
	<?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>