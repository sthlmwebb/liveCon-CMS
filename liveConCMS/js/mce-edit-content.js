//Create the Tiny MCE UI popup for content edit
//This script executes the simple setup for Tiny MCE
	$(document).ready(function(){

		$("#lc-button-editpage").click(function(){
			$("#lc-dialog").remove();
			$("body").append('<div id="lc-dialog" \/>');
						
			$("#lc-dialog").dialog({	
				autoOpen: false,
				resizable: false,
				width: 960,
				modal: true,
				position: ['center',150],
				title: "Edit",
				open: function(event, ui){

				},
				beforeclose: function(event, ui) {
					//console.log('ui: ', ui);
					tinyMCE.get('TextArea1').remove();
					$("#TextArea1").remove();
				}
				
			});
			
			$("#lc-dialog").html(function(){
			var pathname = window.location.href;
			return '<p><?PHP echo "$liveConCMS_Onpage_2";?></p><form method="post" action="' + pathname + '"><textarea name="TextArea1" id="TextArea1"></textarea><hr /><input name="submit" type="submit" value="Save" /><input type="reset" value="Cancel" onClick="window.location.reload()" /></form>';
			});
			
			$("input:submit, input:reset, button").button();
			
			$("#lc-dialog").dialog('open');	
			tinyMCE.init({
				mode : 'textareas',
				theme : 'simple',
				plugins : '',
				theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,separator,bullist,numlist,separator, undo,redo,separator,link,unlink,separator,forecolor,formatselect, fontsizeselect", 
				theme_advanced_buttons2 : "", 
				theme_advanced_buttons3 : "", 
				theme_advanced_toolbar_location : 'top',
				theme_advanced_toolbar_align : 'left',
				theme_advanced_statusbar_location : 'bottom',
				theme_advanced_resizing : true,
				width: "930",
				height: "400",
				language: 'sv'
				
				setup : function(ed) {
					ed.onInit.add(function(ed) {
						tinyMCE.get('TextArea1').setContent($("#lc-main-content").html());
						tinyMCE.execCommand('mceRepaint');
					});

				}
				 
				
		 	});
			return false;	
		
	});

		
		
	});