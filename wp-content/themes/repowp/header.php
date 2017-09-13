<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, user-scalable=no" />
		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
		<title><?php wp_title( '' ); ?></title>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div class="page-wrapper">
		
			<header class="header">
			
				<?php 
					$pre_header_tel = OptionsHelper::get("pre-header-tel");
					$pre_header_mail = OptionsHelper::get("pre-header-mail");
					$pre_header_text = OptionsHelper::get("pre-header-left");
					
					if (($pre_header_tel != "") || ($pre_header_mail != "") || ($pre_header_text != "") ){
				?>
					<div class="header__top">
						<div class="header__top__wrapper">
							<span class="header__top__wrapper--tel"><a href="tel:<?php echo $pre_header_tel; ?>"><?php echo $pre_header_tel; ?></a></span>
							<span class="header__top__wrapper--email"><a href="mailto:<?php echo $pre_header_mail; ?>"><?php echo $pre_header_mail; ?></a></span>
							<span class="header__top__wrapper--text"><?php echo $pre_header_text; ?></span>
						</div>
					</div>
				<?php
					}
				?>
				
				<div class="header__wrapper">
					
					<div class="header__menu-wrapper" data-menu-desktop>
					
						<div class="header__menu-wrapper--container">
					
							<a class="header__menu-wrapper__logo" href="<?php echo get_home_url(); ?>">
								<?php
									$logo = OptionsHelper::get("logo-header");
									echo "<img src='{$logo['url']}' alt=''>";
								?>
							</a>
			
							<div class="menu-desktop">
								<div class="menu-desktop__claim">
									<?php echo OptionsHelper::get("claim") ?>
								</div>
								
								<div class="menu-desktop__menu-container">
									<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
								</div>
								
								<div class="menu-desktop__searchform">
									<?php get_search_form() ?>
								</div>
								
								<div class="menu-desktop__language">
									<?php do_action('wpml_add_language_selector'); ?>
								</div>
								
								
							</div>
							
							<div class="menu-mobile" data-menu-mobile>
								<?php if(defined("ICL_LANGUAGE_NAME")) { ?>
									<div class="menu-mobile__languages" data-menu-wrapper>
										<div class="menu-mobile__languages__label" data-menu-trigger><?php echo ICL_LANGUAGE_NAME; ?></div>
										<div class="menu-mobile__languages__menu" data-menu-container>
											<?php require_once('modules/template-parts/language-selector.php'); ?>
										</div>
									</div>
								<?php } ?>
								
								<div class="menu-mobile" data-menu-mobile>
									
									<div class="menu-mobile__navigation" data-menu-wrapper>
										<div class="menu-mobile__navigation__label" data-menu-trigger>
											<span class="menu-mobile__navigation__label__text menu-mobile__navigation__label__text--closed">
												<?php echo _e('Menu', 'my_website') ?>
											</span>
											<span class="menu-mobile__navigation__label__text menu-mobile__navigation__label__text--opened">
												<?php echo _e('Chiudi', 'my_website') ?>
											</span>
											<span class="menu-mobile__navigation__label__icon menu-mobile__navigation__label__icon--closed"></span>
											<span class="menu-mobile__navigation__label__icon menu-mobile__navigation__label__icon--opened"></span>
										</div>
										<div class="menu-mobile__navigation__content" data-menu-container>
											<div class="menu-mobile__navigation__content__scroll">
												<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>

												<div class="menu-mobile__navigation__content__search">
													<?php get_search_form() ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="fake-menu"></div>
					</div>
				</div>
				
			</header>
			
			<main class="page" role="main">
