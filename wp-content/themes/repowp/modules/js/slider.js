import * as utils from './utils.js';

export class Slider{

	constructor(slider){

		this.slider   = slider;
		this.slides   = this.slider.find($(utils.getDataAttr('data-slide')));
		this.count    = this.slides.length;
		this.arrows   = this.slider.find($(utils.getDataAttr('data-slider-arrow')));
		this.nav      = this.slider.find($(utils.getDataAttr('data-nav')));
		this.navDots  = this.nav.find($(utils.getDataAttr('data-nav-dot')));
		this.position = 0;
		this.move     = false;

		this.init();
	}

	init(){

		this.animateSlide($(this.slides[0]),1,1);
		$(this.navDots[0]).addClass('active');

		if ( this.count > 1 ){

			this.setClock();
			this.setArrowControls();
			this.setNavigationControls();

		} else {

			this.nav.remove();
			this.arrows.remove();

		}

	}

	setClock(){

		this.autoplayInterval = setInterval(function(){

			this.slide(true);

		}.bind(this), 4000);

	}

	animateSlide(slide,opacity,zindex){

		$(slide).animate({
			'opacity' : opacity

			}, 300, function() {

				if ( opacity == 0)
					slide.removeClass('ready');
				else if ( opacity == 1)
					slide.addClass('ready');

				slide.css('z-index', zindex);
				this.move = false;

			}.bind(this)
		).bind(this);

	}

	setArrowControls(){

		$(this.arrows).addClass('show');

		$(this.arrows).click( (e) => {

			e.preventDefault();

			if (this.move)
				return false;
			else
				this.move = true;

			clearInterval(this.autoplayInterval);
			
			let target = $(e.target);

			if ( target.attr('data-slider-arrow') == 'next' )
				this.slide(true);

			if ( target.attr('data-slider-arrow') == 'prev' )
				this.slide(false);

		}).bind(this);
	}

	slide(direction,pos){

		this.animateSlide($(this.slides[this.position]),0,0);
		$(this.navDots[this.position]).removeClass('active');

		if ( typeof pos == "undefined"){
			var pos = 1;

			if (direction){

				if ( this.position == this.slides.length-1 )
					this.position = -1;

			} else {

				pos = -1;

				if ( this.position == 0 )
					this.position = this.slides.length;

			}

			this.position = this.position+pos;

		} else {

			pos = Math.abs(pos - this.position);

			if (direction)
				this.position = this.position+pos;
			else
				this.position = this.position-pos;

		}	
		
		this.animateSlide($(this.slides[this.position]),1,1);
		$(this.navDots[this.position]).addClass('active');

	}

	setNavigationControls(){

		$(this.nav).addClass('show');

		$(this.navDots).click( (e) => {

			let target = $(e.target),
				posNow = target.attr('data-nav-dot');

			if ( this.position == posNow )
				return false

			else if ( this.position < posNow )
				this.slide(true,posNow);

			else if ( this.position > posNow )
				this.slide(false,posNow);

			clearInterval(this.autoplayInterval);

		}).bind(this);

	}

}