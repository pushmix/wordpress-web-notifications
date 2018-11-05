(function( $, document) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

$(function() {

        if(document.getElementsByClassName("dual_list").length > 0){

	var dualListbox = new DualListbox('.dual_list',{
	    addEvent: function(value) {
	        //console.log(value);
	    },
	    removeEvent: function(value) {
	        //console.log(value);
	    },
	    availableTitle: 'Available pages',
	    selectedTitle: 'Display opt in prompt',
	    addButtonText: '>',
	    removeButtonText: '<',
	    addAllButtonText: '>>',
	    removeAllButtonText: '<<'
	});	

	
	dualListbox.add_button.setAttribute('class', 'button-primary');
	dualListbox.add_all_button.setAttribute('class', 'button-primary');
	dualListbox.remove_button.setAttribute('class', 'button-primary');
	dualListbox.remove_all_button.setAttribute('class', 'button-primary');

	document.getElementsByClassName("dual_list")[0].setAttribute("multiple", true);	
    }
});

 

})( jQuery, document );