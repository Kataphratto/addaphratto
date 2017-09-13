/* Selection */

import * as utils from './utils.js';

export class Selection {

	constructor(select){
		this.select      = $(utils.getDataAttr(select));
		this.trigger     = this.select.find($(utils.getDataAttr('data-selection-trigger')));
		this.container   = this.select.find($(utils.getDataAttr('data-selection-container')));
		this.wrapper     = this.container.find($(utils.getDataAttr('data-selection-wrapper')));
		this.moving = false;

		this.init();
	}

	init(){
		this.setListeners();
	}

	setListeners(){

		this.trigger.bind('click', (e) => {

			if (this.moving)
				return false;
			else
				this.moving = true;
			
			e.preventDefault();

			let $target = e.target;
			let height  = 0;

			if ( this.container.hasClass('hide') ) {
				height = this.wrapper.height();

				if ( height > 282 && !this.container.hasClass('scroll') )
					this.container.addClass('scroll');
			}

			this.container.animate({
				'height' : height

			}, 200, () => {
				this.container.toggleClass('hide');
				this.container.toggleClass('show');
				this.moving = false;
			});

		});
	}
}