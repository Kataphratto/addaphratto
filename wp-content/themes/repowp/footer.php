<?php
 $address    = OptionsHelper::get("address");
 $phone      = OptionsHelper::get("phone");
 $email      = OptionsHelper::get("email");
 $copy       = OptionsHelper::get("copyright");
 $rea        = OptionsHelper::get("rea");
 $csociale   = OptionsHelper::get("c-sociale");
 $piva       = OptionsHelper::get("p-iva");
 $codicefisc = OptionsHelper::get("codice-fisc");
 $registro   = OptionsHelper::get("registro");
 ?>
 			</main>
			<footer class="footer" role="contentinfo">
				<div class="footer__content">
					<div class="footer__content__logo">
						<?php
							$logo = OptionsHelper::get("logo-header");
							echo "<img src='{$logo['url']}' alt=''>";
						?>
					</div>
					<div class="footer__content__address">
						<?php echo nl2br($address) ?>
					</div>
					<div class="footer__content__contact">
						<div class="footer__content__contact__phone">
							<a href="tel:<?php echo $phone ?>"><?php echo $phone ?></a>
						</div>
						<div class="footer__content__contact__email">
							<a href="mailto:<?php echo $email ?>"><?php echo $email ?></a>
						</div>
					</div>
					<div class="footer__content__contact__socials">
						<?php echo do_shortcode('[socials]'); ?>
					</div>
				</div>
				<div class="footer__copyright">
					<div class="footer__copyright__content">
						<span class="footer__copyright__content__text"><?php echo $copy ?></span>
						<span class="footer__copyright__content__piva">
							<a href="<?php if(defined("ICL_LANGUAGE_CODE")) {echo "/".ICL_LANGUAGE_CODE; } ?>/cookie-policy"><?php _e('Cookie Policy', 'my_website') ?></a>
							<a href="<?php if(defined("ICL_LANGUAGE_CODE")) {echo "/".ICL_LANGUAGE_CODE; } ?>/privacy"><?php _e('Privacy', 'my_website') ?></a>

							<?php if ($rea): ?>
								<?php _e('Rea:','my_website') ?> <?php echo $rea ?>
							<?php endif?>

							<?php if ($csociale): ?>
								- <?php _e('Capitale Sociale:','my_website') ?> <?php echo $csociale ?>
							<?php endif?>

							<?php if ($piva): ?>
								- <?php _e('P.IVA:','my_website') ?> <?php echo $piva ?>
							<?php endif?>

							<?php if ($codicefisc): ?>
								- <?php _e('Codice Fiscale:','my_website') ?> <?php echo $codicefisc ?>
							<?php endif?>

							<?php if ($registro): ?>
								- <?php _e('Registro Imprese:','my_website') ?> <?php echo $registro ?>
							<?php endif?>
							
						</span>
					</div>
				</div>
			</footer>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>
