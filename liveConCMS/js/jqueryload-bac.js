$(function() {
		//Style for buttons and forms
		$("input:submit, input:reset, button").button();
		$("a.ui-button").button();
		$("a.addButton").button({ icons:{primary: 'ui-icon-plusthick'}});
		$("a.moveButton").button({ icons:{primary: 'ui-icon-arrow-4-diag'}});
		$("span.moveButton").button({ icons:{primary: 'ui-icon-arrow-2-n-s'}});
		$("ul.ui-sortable li").buttonset();		
		$("a.sortsubButton").button({text: false, icons:{primary: 'ui-icon ui-icon-carat-1-s'}});
		$("a.deleteButton").button({ icons:{primary: 'ui-icon-circle-minus'}});
		$("a.editButton").button({ icons:{primary: 'ui-icon-pencil'}});
		$("a.button-edit-mainNav").button({ text: false, icons:{primary: 'ui-icon-pencil'}});
		$("a.button-delete-mainNav").button({ text: false, icons:{primary: 'ui-icon-circle-minus'}});
		$("a.buttonLogout").button({ text: false, icons:{primary: 'ui-icon-power'}});
		$("a.buttonUser").button({ icons:{primary: 'ui-icon-user'}});
		$(".buttonset").buttonset();
		$("input:checkbox").button();
		$("input:radio").button();
		$("li.sub-like-nav input:checkbox").button({ text: false, icons:{primary: 'ui-icon-link'}});
		$("li.sub-like-nav input:checkbox").button({ text: false, icons:{primary: 'ui-icon-link'}});
		$("li.delete-sub a.deleteButton").button({ text:false, icons:{primary: 'ui-icon-circle-minus'}});
		
		//Execute the accordion
		$("#accordion").accordion(
			{
			autoHeight: true
			});
		
});

//Create the upload popup function for the intra
$(function() {
	// Dialog			
	$('#dialog').dialog({
		autoOpen: false,
		width: 600,
		buttons: {
			"Ladda upp": function() { 
				$(this).dialog("close"); 
			}, 
			"Avbryt": function() { 
				$(this).dialog("close"); 
			} 
		},
		modal: true
	});
				
	// Dialog Link
	$('#lc-intra-upload-doc').click(function(){
		$('#dialog').dialog('open');
		return false;
	});

});



//Execute jQuery UI Sortable for the menu drag and drop.
$(function (){
	//This one is for the main navigation
	$(".ui-sort-mainNav").sortable({ 
		opacity: 0.6, 
		cursor: 'move', 
		axis: 'y',
		placeholder: 'sortable-placeholder',
			update: function() {
				var order = $(this).sortable("serialize") + '&action=updateRecordsListings';
				$.post("core/include/updateMenuDB.php", order, function(theResponse){
				$("#contentRight").html(theResponse);
				});
			}
	});	
});
		
//And this one is for the submenu´s
$(function() {
	$(".ui-sort-subNav").sortable({ 
	opacity: 0.6, 
	cursor: 'move', 
	axis: 'y',
	placeholder: 'sortable-placeholder',
	update: function() {
		var order = $(this).sortable("serialize") + '&action=updateRecordsListings';
		$.post("core/include/updateSubmenuDB.php", order, function(theResponse){
			$("#contentRight").html(theResponse);
		});
	}
	});
});
		

// Execute the accordion effect used by the message box in the intra
$(function accordionIntra() {
	$("#accordionIntra").accordion({
		collapsible: true,
		autoHeight: true,
	});
});

//This is the 'tooltip' effect. Using jQuery Tools
$(function infoTooltip() {
	$("[title]").tooltip({
		effect: 'fade',
		position: 'top right',
		offset: [-5 , 0],
		tipClass: 'lc-infoTooltip',
		opacity: 0.9
	});
});