//	File: jqueryload.js
//	This file contains the generic JS script used on all sites when your loged in.


//	Fades in the page when its fully loaded. To prevent gfx hickups.
$(window).load(function() {
	$("body").hide();
	$(document).ready(function() {
		$("body").fadeIn(1000) .delay(80);
	});
});

$(document).ready(function() {
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

// Execute the accordion effect used by the message box in the intra
	$("#accordionIntra").accordion({
		collapsible: true,
		autoHeight: true,
	});

//Create the upload popup function for the intra using jQuery Tools
	// Dialog			
	$("#dialog").dialog({
		autoOpen:false,
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
	$("#lc-intra-upload-doc").click(function(){
		$("#dialog").dialog('open');
		return false;
	});



//This is the 'tooltip' effect. Using jQuery Tools
	$("[title]").tooltip({
		effect: 'fade',
		position: 'top center',
		delay:0,
		offset: [-5 , 0],
		tipClass: 'lc-infoTooltip',
		opacity: 0.9
	});
	

});

//jQuery UI modal popup.
$(window).load(function popupError() {
	$("#popup").dialog({
		resizable: false,
		modal: true,
		buttons: { "Stäng": 
			function() { $(this).dialog("close"); } 
		}
	});
});

//This is the standard confirmation box when deleting content such as news or templates.
$(document).ready(function() {

	$(".deleteItem").click(function(lc_deleteNews) {
	
		lc_deleteNews.preventDefault();
		var delUrl = $(this).attr("href");
		
			$("#lc-dialog").remove();
			$("body").append('<div id="lc-dialog" \/>');
			$("#lc-dialog").dialog({	
				autoOpen: false,
				resizable: false,
				width: 400,
				modal: true,
				position: ['center', 'center'],
				title: "Ta bort",				
			});
			
			$("#lc-dialog").dialog('option', 'buttons', {
					"Radera" : function() {
						window.location.href = delUrl;
						},
					"Avbryt" : function() {
						$(this).dialog("close");
						}
					});
			
			$("#lc-dialog").html(function(){
				return '<div><p>Är du säker på att du vill ta bort detta?</p> <p><em>Det går ej att ångra.</em></p></div>';
			});
				
			$("#lc-dialog").dialog('open');	
		
			return false;

	});

});