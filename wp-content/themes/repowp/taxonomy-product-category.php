<?php get_header(); ?>

<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>

<?php $children = get_term_children($term->term_id, 'product-category') ?>

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
					<?php echo $term->name ?>
				</h1>
				<?php if ( get_field('cat_subtitle', $term) ): ?>
					<h2 class="page-content__wrapper__title-block__subtitle">
						<?php echo get_field('cat_subtitle', $term) ?>
					</h2>
				<?php endif ?>
			</header>
			<section class="entry-content">
				<div class="product-categories">

					<?php if ( !empty($children) ): ?>
						<div class="product-categories__list" data-selection>
							<div class="product-categories__list__label" data-selection-trigger>
								<?php echo _e('Seleziona una categoria', 'my_website') ?>
							</div>

							<div class="product-categories__list__content hide" data-selection-container>
								<div data-selection-wrapper>
									<?php foreach ( $children as $child ): ?>
										<?php $cat = get_term_by( 'id', $child, get_query_var('taxonomy')); ?>
										<?php if ( $cat->parent == $term->term_id ): ?>
											<a class="product-categories__list__content__link" href="<?php echo get_term_link($cat->term_id) ?>">
												<?php echo $cat->name ?>
											</a>
										<?php endif ?>
									<?php endforeach ?>
								</div>
							</div>
						</div>

					<?php else:

						$products = get_posts(
							array(
								'posts_per_page' => -1,
								'post_type' => 'prodotti',
								'tax_query' => array(
									array(
										'taxonomy' => 'product-category',
										'field' => 'term_id',
										'terms' => $term->term_id,
									)
								)
							)
						);

						if ( !empty($products) ): ?>

							<ul class="product-grid">
								<?php foreach ( $products as $product ): ?>
									<li class="product-grid__element">
										<a href="<?php echo $product->guid ?>">
											<?php echo get_the_post_thumbnail($product->ID) ?>

											<div class="product-grid__element__text">

												<div class="product-grid__element__text__wrapper">
													<span>
														<?php echo $product->post_title; ?>
													</span>
													<strong>
														<?php _e('Scopri di più', 'my_website') ?>
													</strong>
												</div>
											</div>

										</a>
									</li>
								<?php endforeach ?>
							</ul>
						<?php endif ?>
					<?php endif ?>

					<div class="product-categories__description">
						<?php echo $term->description ?>
					</div>
				</div>
			</section>
		</div>
		<?php get_template_part('inc/before-footer', 'before-footer') ?>
	</div>

	<?php get_sidebar(); ?>
</section>

<?php get_footer(); ?>