// liveCon quick image edit. Overlays a div on selected elements.
// Latest update 2010-10-30 by Martin Lindgren.
(function($){
	$.fn.lcChangeImg = function(options) {
  
		var settings = {
			overlayID         	: 'lccms-hoverOverlay',
			contentID			: 'lccms-hover-content',
			content				: '',
			contentContainer	: 'a',
			fadeSpeed			: 400,
			opacity				: 0.5,
			cursor				: 'default',
			dialogTitle			: '',
			dialogText			: '',
			inputText			: ''
		};
	
		return this.each(function() {        
			// If options exist, lets merge them
			// with our default settings
		if ( options ) { 
			$.extend( settings, options );
		}
		
		var $element = $(this);		
		var imgSrc = $(this).attr('src');
		var pageUrl = window.location.href
		var imgAlt = $(this).attr('alt');
		var formUrl = 'liveConCMS/core/functions/changepic.php?filename=';
		var fileExt = $(this).attr('src').split('.').pop().toLowerCase();
	  
			$(this).mouseover(function(){
				
					//We dont want any dublicates.
					$("#" + settings.overlayID).remove();
					$("#" + settings.contentID).remove();
				
					//Some variables
					var $element = $(this);
					
					//Create div overlay
					$("body").append("<div id='"+ settings.overlayID +"' \/>");
					
					//Copy DOM values from parent element and insert to overlay element
					$("#" + settings.overlayID).css({
						'width': $element.outerWidth(),
						'height': $element.outerHeight(),
						'display': 'block',
						'position': 'absolute',
						'top': $element.offset().top,
						'left': $element.offset().left,
						'cursor': 'pointer',
						'opacity': settings.opacity,
						'cursor': settings.cursor,
						'z-index': '4'
					});
					
					//Create content for overlay div.
					$("#" + settings.overlayID).append('<'+settings.contentContainer+' id="'+ settings.contentID +'">'+ settings.content +'</'+settings.contentContainer+'>');	
					
					//Manipulate DOM for overlay content
					$("#" + settings.contentID).css({
						'width': '100%',
						'height': 'auto',
						'display': 'inline-block',
						'text-align': 'center',
						'line-height': $element.outerHeight() + 'px',
						'opacity' : '1',
						'cursor': settings.cursor,
						'z-index': '10'
					});					
							
					//Hide the overlay div by default and then show it. Same with the content
					$("#" + settings.overlayID).toggle().fadeIn(settings.fadeSpeed);
					$("#" + settings.contentID).toggle().fadeIn(settings.fadeSpeed);
					
					//OK lets go. Toggle dialog function when click
					$("#" + settings.contentID).click(function(){
					
						$("#lc-dialog").remove();
						$("body").append('<div id="lc-dialog" \/>');
						$("#lc-dialog").dialog({	
							autoOpen: false,
							resizable: false,
							width: 'auto',
							height: 'auto',
							modal: true,
							position: ['center', 'center'],
							title: settings.dialogTitle	
						})
						.html(function(){
							return '<form id="lc-change-pic" name="lc-change-pic" method="post" enctype="multipart/form-data" action="'+ formUrl + imgSrc +'"><fieldset><input type="file" name="File" /><em>' +settings.dialogText +'&nbsp;<b>' + fileExt +'</b></em></fieldset><fieldset><input type="submit" name="submit" value="'+ settings.inputText +'" /></fieldset></form>';
						});
										
						$("input:submit, input:reset").button();
						
						$("#lc-dialog").dialog('open');	
												
					});

					//Remove the overlay div on mouseout
					$("#" + settings.overlayID).mouseleave(function(){
						$(this).remove();
					});					
			
			});
			

		});
 
	};
})( jQuery );