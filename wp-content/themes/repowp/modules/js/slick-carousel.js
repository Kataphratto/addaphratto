/* Slick Carousel */

import * as utils from './utils.js';

export class SlickCarousel {

	constructor(slickcarousel){
		
		let data_image_number = parseInt(slickcarousel.attr("data-image-number")),
			data_image_number_move = parseInt(slickcarousel.attr("data-image-number-move")),
			data_image_number_landscape = parseInt(slickcarousel.attr("data-image-number-landscape")),
			data_image_number_move_landscape = parseInt(slickcarousel.attr("data-image-number-move-landscape")),
			data_image_number_portrait = parseInt(slickcarousel.attr("data-image-number-portrait")),
			data_image_number_move_portrait = parseInt(slickcarousel.attr("data-image-number-move-portrait")),
			data_image_number_mobile = parseInt(slickcarousel.attr("data-image-number-mobile")),
			data_image_number_move_mobile = parseInt(slickcarousel.attr("data-image-number-move-mobile")),
			data_speed = parseInt(slickcarousel.attr("data-speed")),
			data_fade = (slickcarousel.attr("data-fade") == 'true'),
			data_dots = (slickcarousel.attr("data-dots") == 'true'),
			data_infinite = (slickcarousel.attr("data-infinite") == 'true'),
			data_arrows = (slickcarousel.attr("data-arrows") == 'true'),
			data_autoplay = (slickcarousel.attr("data-autoplay") == 'true'),
			data_autoplay_speed = parseInt(slickcarousel.attr("data-autoplay-speed"));

		slickcarousel.slick({
			slidesToShow: data_image_number,
			slidesToScroll: data_image_number_move,
			speed: data_speed,
			fade: data_fade,
			dots: data_dots,
			infinite: data_infinite,
			arrows: data_arrows,
			autoplay: data_autoplay,
			autoplaySpeed: data_autoplay_speed,
			responsive: [
				{
				breakpoint: 1025,
					settings: {
						slidesToShow: data_image_number_landscape,
						slidesToScroll: data_image_number_move_landscape,
						speed: data_speed,
						fade: data_fade,
						dots: data_dots,
						infinite: data_infinite,
						arrows: data_arrows,
						autoplay: data_autoplay,
						autoplaySpeed: data_autoplay_speed
					}
				},
				{
				breakpoint: 769,
					settings: {
						slidesToShow: data_image_number_portrait,
						slidesToScroll: data_image_number_move_portrait,
						speed: data_speed,
						fade: data_fade,
						dots: data_dots,
						infinite: data_infinite,
						arrows: data_arrows,
						autoplay: data_autoplay,
						autoplaySpeed: data_autoplay_speed
					}
				},
				{
				breakpoint: 481,
					settings: {
						slidesToShow: data_image_number_mobile,
						slidesToScroll: data_image_number_move_mobile,
						speed: data_speed,
						fade: data_fade,
						dots: data_dots,
						infinite: data_infinite,
						arrows: data_arrows,
						autoplay: data_autoplay,
						autoplaySpeed: data_autoplay_speed
					}
				}
			]
		});
	}
}
