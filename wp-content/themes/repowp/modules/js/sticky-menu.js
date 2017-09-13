/* Sticky Menu */

import * as utils from './utils.js';

export class StickyMenu {

	constructor(menu,styckyClass,headerClass){
		this.menu        = $(utils.getDataAttr(menu));
		this.classMenu = this.menu[0].attributes[0].value;

		this.init(styckyClass,headerClass);
		
		var menu_height = $("."+this.classMenu).height();
		$(".fake-menu").height(menu_height);
		
	}

	init(styckyClass,headerClass){
		this.setSticky(this.classMenu,styckyClass,headerClass);
	}

	setSticky(classMenu,styckyClass,headerClass){
			
		var header_height = $("."+headerClass).height();

		if( $(window).scrollTop() > header_height ) {
			$("."+classMenu).addClass(styckyClass);
		} else {
			$("."+classMenu).removeClass(styckyClass);
		}

	}
} 
