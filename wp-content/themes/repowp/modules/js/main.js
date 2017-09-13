//Libs
import Modernizr from './.modernizrrc';
import ObjectFitImages from 'object-fit-images';
import Picturefill from 'picturefill/src/picturefill';
import * as utils from './utils.js';

//Classes
import { Menu } from './menu.js';
import { StickyMenu } from './sticky-menu.js';
import { SlickCarousel } from './slick-carousel.js';
import { Slider } from './slider.js';
import { Selection } from './selection.js';
import { Search } from './search.js';

document.addEventListener("DOMContentLoaded", function(event) {
	
	window.$ = jQuery;

	ObjectFitImages(); 

	jQuery('.slick-carousel__container').each(function(){
		new SlickCarousel($(this));
	});
	
	var menu = new Menu('data-menu-mobile');
	var stickyMenu = new StickyMenu('data-menu-desktop','header__menu-wrapper__fixed','header');
	
	$(window).scroll(function(){
		if($(window).width() > 768){
			stickyMenu.setSticky(stickyMenu.classMenu,'header__menu-wrapper__fixed','header');
		}
	});	

	$(utils.getDataAttr('data-slider')).each( (i,e) => {
		new Slider($(e));
	});

	var selection = new Selection('data-selection');
	var search = new Search('data-search');

});
