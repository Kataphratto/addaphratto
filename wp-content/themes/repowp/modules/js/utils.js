/* Utils
 * 
 * List of general purpose functions
 * 
*/

export function getDataAttr(selector){
	let dataAttr = '[' + selector + ']';
	return dataAttr;
};

export function classSwitcher(selector,classname){
	let target = $(selector);

	target.bind('click', (e) => {
		$(e.target).toggleClass(classname);
	})
};

export function isVisible(selector) {
	
	let target = $(selector);
	
    var rect = target[0].getBoundingClientRect();
    return (
        (rect.height > 0 || rect.width > 0) &&
        rect.bottom >= 0 &&
        rect.right >= 0 &&
        rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.left <= (window.innerWidth || document.documentElement.clientWidth)
    );
};
