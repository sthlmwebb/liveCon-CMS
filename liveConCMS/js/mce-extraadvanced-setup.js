// Executes the "advanced" setup for Tiny MCE. Used in the news section for example.

	tinyMCE.init({
		// General options
		mode : 'textareas',
		theme : 'advanced',
		plugins : 'table,advimage,advlink,preview,media,searchreplace,paste,directionality,jqueryinlinepopups',

		// Theme options
		theme_advanced_buttons1 : 'bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect,|,forecolor,backcolor,|,hr,charmap,|,code,removeformat,',
		theme_advanced_buttons2 : 'cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,image,media,cleanup,help,|,preview',
		theme_advanced_buttons3 : 'tablecontrols,|,visualaid,|,sub,sup',
		theme_advanced_toolbar_location : 'top',
		theme_advanced_toolbar_align : 'left',
		theme_advanced_statusbar_location : 'bottom',
		theme_advanced_resizing : false,
		language: 'sv',

		// Example content CSS (should be your site CSS)
		content_css : 'css/content.css',
			});
