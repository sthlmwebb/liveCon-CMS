$(document).ready(function lc_popup_mainNav() {

	/*Fix the placeholder div when sorting menus*/
	var placeholderHeight = $(".ui-sort-Navigation li").height();
	$(".lc-sortable-placeholder").css({
		'height': placeholderHeight
	});
	
	//Popup for menu edit
	$("#lc-popup-mainNav").dialog({
		autoOpen:false,
		resizable: false,
		draggable: true,
		width: 960,
		title: "Editera huvudmeny",
		modal: true
	});	

	// The click function
	$("#primary-navigation").click(function(){
		$("#lc-popup-mainNav").dialog('open');
		return false;
	});
	
	$("#lc-popup-mainNav").dialog( "option", "buttons", { 
		"Ok": function() {
			var order = $(".ui-sort-mainNav").sortable("serialize") + '&action=updateRecordsListings';
			$.post("liveConCMS/core/include/updateMenuDB.php", order);
			$("#lc-sort-mainMenus-Wrapper").find("input[type=submit]").trigger('click');
		},	
		"Cancel": function() { 
			$(this).dialog("close"); 
			$("#lc-dialog").remove();
		}	
	});		
});


//Popup for sub-menu edit
$(document).ready(function lc_popup_mainNav() {
	$("#lc-popup-subNav").dialog({
		autoOpen:false,
		resizable: false,
		draggable: true,
		width: 960,
		title: "Editera undermeny",
		modal: true
	});	

	// The click function
	$("#lc-sub-nav").click(function(){
		$("#lc-popup-subNav").dialog('open');
		return false;
	});
	
	$("#lc-popup-subNav").dialog( "option", "buttons", { 
		"Ok": function() {
			var order = $(".ui-sort-subNav").sortable("serialize") + '&action=updateRecordsListings';
			$.post("liveConCMS/core/include/updateSubMenuDB.php", order);
			$("#lc-sort-subMenus-Wrapper").find("input[type=submit]").trigger('click');
		},	
		"Cancel": function() { 
			$(this).dialog("close"); 
			$("#lc-dialog").remove();
		}	
	});	
	
}); 

$(document).ready(function() {	
	//Editable images in main content
	$("#lc-main-content img").lcChangeImg({
			overlayID         	: 'lccms-hoverOverlay',
			contentID			: 'lccms-hover-content',
			content				: 'Klicka här för att byta bild',
			fadeSpeed			: 400,
			opacity				: 0.85,
			cursor				: 'pointer',
			dialogTitle			: 'Byt bild',
			inputText			: 'Ladda upp bild',
			dialogText			: 'Du kan endast ladda upp:'
	});

	$(".lc-editableImg").lcEditableImg();

});

