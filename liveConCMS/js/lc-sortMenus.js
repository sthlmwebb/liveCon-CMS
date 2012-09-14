$(document).ready(function () {
	
	//$("a.sortsubButton").button({text: false, icons:{primary: 'ui-icon ui-icon-carat-1-s'}});

	$(".ui-sort-mainNav").sortable({ 
		opacity: 0.6, 
		cursor: 'move', 
		axis: 'y',
		width: 960,
		forcePlaceholderSize: true,
		placeholder: 'lc-sortable-placeholder ui-corner-all'
	});	
		
	$(".ui-sort-subNav").sortable({ 
		opacity: 0.6, 
		cursor: 'move', 
		axis: 'y',
		width: 960,
		placeholder: 'lc-sortable-placeholder ui-corner-all'
	});
	
});