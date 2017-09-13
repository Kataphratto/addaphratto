/* Menu */

import * as utils from './utils.js';

export class Search {

	constructor(search){
		this.trigger     = $(utils.getDataAttr(search));
		this.searchmenu  = this.trigger.parent().find($(utils.getDataAttr('data-form-menu')));
		this.searchinput = this.searchmenu.find($(utils.getDataAttr('data-search-input')));
		
		this.setListeners();
	}

	setListeners() {
		this.trigger.bind('click', () => {

			this.trigger.toggleClass('focus');

			this.searchmenu.toggleClass('show');

			if ( this.searchmenu.hasClass('show') )
				this.searchinput.trigger('focus');

		})
	}
}