<?php

/*
	Template Name: News
*/

get_header(); ?>

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
						<?php the_title(); ?>
					</h1>
					<?php if ( get_field('sottotitolo') ): ?>
						<h2 class="page-content__wrapper__title-block__subtitle">
							<?php echo get_field('sottotitolo') ?>
						</h2>
					<?php endif ?>
				</header>
		
				<section class="entry-content">

					<div class="latest-posts clearfix">
						<?php

							$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
							
							$wpquery = new WP_Query(array(
								'post_type'      => "post",
								'posts_per_page' => 3,
								'paged' => $paged
							));
							
							while ($wpquery->have_posts()): $wpquery->the_post(); ?>
							<div class="latest-posts__row-posts__single-post latest-posts__row-posts__single-post--paged">
								<div class="latest-posts__row-posts__single-post__text-block">
									<div class="latest-posts__row-posts__single-post__text-block__eventdate">
										<div class="news-element__date__dayname"><?php echo get_the_date('d/m/Y'); ?></div>
									</div>
									<div class="latest-posts__row-posts__single-post__text-block__title">
										<a href="<?php echo get_the_permalink(); ?>" class="news-element__link"><?php the_title(); ?></a>
									</div>
									<div class="latest-posts__row-posts__single-post__text-block__text"><?php the_content(); ?></div>
									<div class="latest-posts__row-posts__single-post__text-block__postlink">
										<a href="<?php echo get_the_permalink(); ?>"><?php _e("Vai all'articolo",'my_website'); ?></a>
									</div>
								</div>
							</div>
						<?php
							endwhile; 
							paging(__("Altri articoli",'my_website'), $wpquery->found_posts, $wpquery->query_vars['posts_per_page']);
							wp_reset_postdata();
						?>
					</div>
				</section>
			</div>			
		</article>
	<?php endwhile; endif; ?>
	<?php get_sidebar(); ?>

</section>
<?php get_footer(); ?>