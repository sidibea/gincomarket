/**
 * added sortable for widgets
 * date : 2017-05-16
 */
function initWidgetSortable()
{
	try{
		if(jQuery('.widget_sortable_table tbody').length) {
			jQuery('.widget_sortable_table tbody').sortable({
			  	stop: function( event, ui ) {
			  		var _widget_counter = 1;
			  		jQuery('input[name^="widget_position"]').each(function() {
			  			jQuery(this).val(_widget_counter);
			  			jQuery(this).attr('tabindex', _widget_counter);
			  			_widget_counter++;
			  		});
			  	}
			});
		}
	}
	catch(e) {
		console.log('sortable not supported');
	}
}