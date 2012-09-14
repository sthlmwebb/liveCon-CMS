// This .js file executes the "simple" setup for Tiny MCE used in the liveCon CMS backend.

tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,separator,bullist,numlist,separator, undo,redo,separator,link,unlink,separator,forecolor,formatselect, fontsizeselect", 
	theme_advanced_buttons2 : "", 
	theme_advanced_buttons3 : "", 
	theme_advanced_toolbar_location : "top", 
	theme_advanced_toolbar_align : "left",
	language: 'sv'
	});
