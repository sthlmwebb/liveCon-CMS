/*
	File: jqueryload.js
	This file loads all javascript needed for backend.
*/

$(document).ready(function() {

		//Style for buttons and forms
		$("input:submit, input:reset, button").button();
		$("a.ui-button").button();
		$("a.addButton").button({ icons:{primary: 'ui-icon-plusthick'}});
		$("a.moveButton").button({ icons:{primary: 'ui-icon-arrow-4-diag'}});
		$("span.moveButton").button({ icons:{primary: 'ui-icon-arrow-2-n-s'}});
		$("ul.ui-sortable li").buttonset();		
		$("a.sortsubButton").button({text: false, icons:{primary: 'ui-icon ui-icon-carat-1-s'}});
		$("a.lc-delete-msg").button({ icons:{primary: 'ui-icon-circle-minus'}});
		$("a.editButton").button({ icons:{primary: 'ui-icon-pencil'}});
		$("a.button-edit-mainNav").button({ text: false, icons:{primary: 'ui-icon-pencil'}});
		$("a.button-delete-mainNav").button({ text: false, icons:{primary: 'ui-icon-circle-minus'}});
		$(".buttonset").buttonset();
		$("input:checkbox").button();
		$("input:radio").button();
		$("li.sub-like-nav input:checkbox").button({ text: false, icons:{primary: 'ui-icon-link'}});
		$("li.sub-like-nav input:checkbox").button({ text: false, icons:{primary: 'ui-icon-link'}});
		$("li.delete-sub a.deleteButton").button({ text:false, icons:{primary: 'ui-icon-circle-minus'}});
		$("li.delete-submenu a.deleteButton").button({ text:false, icons:{primary: 'ui-icon-circle-minus'}});
		
		/*Execute the accordion*/
		$("#accordion").accordion({
			autoHeight: true
		});

		/*Execute the accordion effect used by the message box in the intra*/
		$("#accordionIntra").accordion({
			collapsible: true,
			autoHeight: true,
		});

		/*
			Create the upload popup function for the intra using jQuery-UI
		*/
		/*Dialog*/		
		$("#lc-intra-upload-dialog").dialog({
			autoOpen:false,
			width: 600,
			modal: true
		});
				
		/*Dialog Link*/
		$("#lc-intra-upload-doc").click(function(){
			$("#lc-intra-upload-dialog").dialog('open');
			return false;
		});

		/* Tooltip needs fix in FF */
		/*Custom effect for tooltip*/
		$.tools.tooltip.addEffect("fx1",
			function(done) {
				this.getTip().fadeIn();
				done.call();
			},

			// hide function
			function(done) {
				this.getTip().fadeOut();
				done.call();
			}
		);

		/*Tooltip - Edit items*/
		$("table .lc-editItem[title]").tooltip({
			position: 'center right',
			delay:0,
			effect: 'fx1',
			tipClass: 'lc-tooltip ui-corner-all ui-widget ui-state-highlight',
			opacity: 0.9
		});
		
		/*Tooltip - Delete items*/
		$("table .lc-deleteItem[title]").tooltip({
			position: 'center right',
			delay:0,
			effect: 'fx1',
			tipClass: 'lc-tooltip ui-corner-all ui-state-error',
			opacity: 0.9
		});	
	
		/*Tooltip - Admin profilbar*/
		$("#lc-profilinfo a.lc-profile-user-normal[title]").tooltip({
			position: 'bottom center',
			delay:0,
			offset: [15 , 0],
			tipClass: 'lc-tooltip ui-corner-all ui-state-highlight',
			opacity: 0.9
		});	

		/*Tooltip - Admin profilbar*/
		$("#lc-profilinfo a.lc-profile-logout-normal[title]").tooltip({
			position: 'bottom center',
			delay:0,
			effect: 'fx1',
			offset: [15 , 0],
			tipClass: 'lc-tooltip ui-corner-all ui-state-error',
			opacity: 0.9
		});		

		/*Accordion - Submenu, "same as root menu" */
		$(".sub-like-nav label").tooltip({
			position: 'top center',
			delay:0,
			effect: 'fx1',
			offset: [-5 , 0],
			tipClass: 'lc-tooltip ui-corner-all ui-state-highlight',
			opacity: 0.9
		});	

		/*Accordion - Submenu, "delete" */
		$(".delete-sub a").tooltip({
			position: 'top center',
			delay:0,
			effect: 'fx1',
			offset: [-5 , 0],
			tipClass: 'lc-tooltip ui-corner-all ui-state-error',
			opacity: 0.9
		});			

		$(".main-nav-settings ul li a.button-edit-mainNav").tooltip({
			position: 'top center',
			delay:0,
			effect: 'fx1',
			offset: [-5 , 0],
			tipClass: 'lc-tooltip ui-corner-all ui-state-highlight',
			opacity: 0.9
		});	
		
		$(".main-nav-settings ul li a.button-delete-mainNav").tooltip({
			position: 'top center',
			delay:0,
			effect: 'fx1',
			offset: [-5 , 0],
			tipClass: 'lc-tooltip ui-corner-all ui-state-error',
			opacity: 0.9
		});	
		
		$(".lc-toolbar button").tooltip({
			position: 'top center',
			delay:0,
			effect: 'fx1',
			offset: [-5 , 0],
			tipClass: 'lc-tooltip ui-corner-all ui-state-highlight',
			opacity: 0.9
		});			
		
		$(".submenu_list_options-2 li.delete-sub a.lc-deleteItem").tooltip({
			position: 'top center',
			delay:0,
			effect: 'fx1',
			offset: [-5 , 0],
			tipClass: 'lc-tooltip ui-corner-all ui-state-highlight',
			opacity: 0.9
		});		
		
		
		/* Open modules in modal popup */
		$("#lccms-adminpanel_wrapper .adminpanel_plugin .adminpanel_submenu_wrapper a").click(function(e){
			e.preventDefault();
			var url = $(this).attr('href');
			var dialogTitle = $(this).html();
			lc_plugin_Gallery.init(url, dialogTitle);
		});

		$("#lc-plugin-list .lc-module-link").click(function(e){
			e.preventDefault();
			var url = $(this).attr('href');
			var dialogTitle = $(this).html();
			lc_plugin_Gallery.init(url, dialogTitle);
		});
		
});

/*jQuery UI modal popup.*/
$(window).load(function popupError() {
	$("#popup").dialog({
		resizable: false,
		modal: true,
		buttons: { "Stäng": 
			function() { $(this).dialog("close"); } 
		}
	});
});
