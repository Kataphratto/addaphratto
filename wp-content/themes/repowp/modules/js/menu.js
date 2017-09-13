/* Menu */

import * as utils from './utils.js';

export class Menu {

	constructor(menu){
		this.menu        = $(utils.getDataAttr(menu));
		this.triggers    = this.menu.find($(utils.getDataAttr('data-menu-trigger')));
		this.containers  = this.menu.find($(utils.getDataAttr('data-menu-container')));

		this.parents = this.containers.find(".menu-item-has-children");
		this.count = this.parents.length;
		
		this.parents.each(function(i,e){
			jQuery(e).prepend("<div class='open-sub-menu' data-open-submenu></div>");
			if(i == this.count - 1){
				this.openSubMenus  = this.menu.find($(utils.getDataAttr('data-open-submenu')));
			}
		}.bind(this));

		this.init();
	}

	init(){
		this.setListeners();
	}

	setListeners(){

		this.triggers.bind('click', (e) => {

			let target    = jQuery(e.target),
				opacity   = 1,
				container = target.closest($(utils.getDataAttr('data-menu-wrapper'))).find($(utils.getDataAttr('data-menu-container')));

			if ( container.hasClass('show') ) {
				opacity = 0;
				this.animateMenu(container,opacity);
				this.triggers.removeClass("open");
				$("html").removeClass("menu-mobile-open");
			}

			else {
				container.addClass('show');
				this.animateMenu(container,opacity);
				this.triggers.addClass("open");
				$("html").addClass("menu-mobile-open");
			}

		});
		
		if ( this.count > 0){
			this.openSubMenus.bind('click', (e) => {
				let target = jQuery(e.target);
				if (target.parent("li").find(".sub-menu").hasClass("sub-menu--visible")){
					target.parent("li").find(".sub-menu").removeClass("sub-menu--visible");
					target.removeClass("open-sub-menu--open");
				}
				else{
					target.parent("li").find(".sub-menu").first().addClass("sub-menu--visible");
					target.addClass("open-sub-menu--open");
				}
			});
		}
		
	}

	animateMenu(element,opacity) {

		element.animate({
			opacity: opacity
		}, 200,

		function(){

			if (opacity == 0)
				element.removeClass('show');
		});
	}
}
