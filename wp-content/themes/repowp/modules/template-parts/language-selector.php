<?php if ( function_exists('icl_object_id') ) {

	$languages = icl_get_languages('skip_missing=0&orderby=id&order=asc&link_empty_to=str');

	if ( count($languages) > 0 ): ?>
		<div class="lang-selector">
			<?php foreach ($languages as $language): ?>
				<a class="lang-selector__lang-item" href="<?php echo $language['url'] ?>" >
					<img class="lang-selector__lang-item__image" src="<?php echo $language['country_flag_url'] ?>" alt="">
					<span class="lang-selector__lang-item__label<?php if( $language['active'] == 1 ): ?> active<?php endif ?>"><?php echo $language["native_name"] ?></span>
				</a>
			<?php endforeach; ?>
		</div>
	<?php endif;
} ?>