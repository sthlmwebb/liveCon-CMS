<?PHP header('Content-type: text/javascript');?>

/*
	Global variables
*/

	var sPath = window.location.pathname;
	var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);


/*Do not cache the ajax calls*/
$.ajaxSetup ({
	cache: false
});

/*Validate URL*/
function isUrl(s) {
	var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
	return regexp.test(s);
}

/*
	Function to center a object on screen
*/
(function($){
     $.fn.extend({
          center: function () {
                return this.each(function() {
                        var top = ($(window).height() - $(this).outerHeight()) / 2;
                        var left = ($(window).width() - $(this).outerWidth()) / 2;
                        $(this).css({position:'absolute', margin:0, top: (top > 0 ? top : 0)+'px', left: (left > 0 ? left : 0)+'px'});
                });
        }
     });
})(jQuery);

/*
	Center object to parent
*/
(function( $ ){
	$.fn.objCenter = function() {
		return this.each(function(){
			var parent = $(this).parent(); var parentPos = parent.offset(); var parentWidth = parent.width(); var parentHeight = parent.height(); var thisWidth = $(this).outerWidth(); var thisHeight = $(this).outerHeight();
			
			var x = (parentWidth / 2) + parentPos.left - (thisWidth / 2); var y = (parentHeight / 2) + parentPos.top - (thisHeight / 2);
			
			$(this).css({position:'absolute', left: x, top: y});			
		});
  	};
})( jQuery );

/*
	"Ajax loader" - Shows a spinning circle.
*/

(function( $ ){
  $.fn.lcLoader = function() {
  
	var text = "Laddar...";
	
	this.append('<div id="lcLoader" class="ui-widget-overlay" \/>');
	
	$("#lcLoader").prepend('<div><img src="skins/images/ajax-loader.gif" /><br /><span>'+text+'</span></div>');

	$("#lcLoader div").css({
		'display':'block',
		'width':'100px',
		'text-align':'center',
		'z-index':'9999',
		'overflow':'hidden'
	});

	$("#lcLoader div").center();
	
	};
})( jQuery );

/*
	Functions to create, read and erase cookies
*/

function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name,"",-1);
}

/*
	Function to load images asyncronously in to a given location, it takes one argument (source). And comes with a callback function.
	Also uses a  "IE cache hack" to prevent caching the images.
*/

(function( $ ){
	$.fn.lcLoadImg = function(src, callback) {
		return this.each(function(){
		
		$element = $(this);
		var date = new Date();	
		var ieCacheHack = "?lcdummy=" + date;	
		
			$('<img />').attr('src', src+ieCacheHack)
			.load(function(data){
			
				$element.append( $(this) );
				
				if(typeof callback == 'function'){
					callback.call(this, data);
				}				
			
			});
		});   
 	};
})( jQuery );

/*
	Error popup.
	This function takes one argument - Error id.
*/
function lcErrorPopup(id){
		
	$("body").append('<div id="lc-dialog" \/>');
	
	$("#lc-dialog").dialog({	
		autoOpen: false,
		resizable: false,
		width: '400px',
		height: 'auto',
		modal: true,
		position: ['center', 'center']
	});
	$("#lc-dialog").dialog({ buttons: { 
		"Ok": function() { 
			$(this).dialog("close"); 
			$("#lc-dialog").remove(); 
		}		
		}
	});		
	
	$("#lc-dialog").load("liveconcms_errorpopup.php #lc-error-msg-"+id, function(){
		var dialogTitle = $("#lc-dialog").find(".lc-dialog-title").text();
		$("body").find('#ui-dialog-title-lc-dialog').text(dialogTitle);
		$("#lc-dialog").find(".lc-dialog-title").hide();
		
		$("#lc-dialog").dialog('open');
	});
	
	return false;
}


/*
	Popup and confirmation box when deleting items.
	Used in: liveconcms_newsarchive.php for example.
*/
(function( $ ){
  $.fn.lcDeleteItem = function() {
	$(this).click(function(e) {
	
		e.preventDefault();
		
		var delUrl = $(this).attr("href");
		
		var text = $(this).text();
						
		var tr = $(this).closest('tr');
				
		var refreshUrl = window.location.href;
		
		$("#lc-dialog").remove();
		$("body").append('<div id="lc-dialog" \/>');
		$("#lc-dialog").dialog({	
			autoOpen: false,
			resizable: false,
			width: 400,
			modal: true,
			position: ['center', 'center'],
			title: text,				
		});
			
		$("#lc-dialog").dialog('option', 'buttons', {
			"Ta bort" : function() {
			$(".ui-dialog").remove();	
			$("body").lcLoader();								
			$.post(delUrl, function(){				
				if (sPage === "liveconcms_menus.php") {window.location = refreshUrl}
				else {
					$("#lcLoader").remove();				
					$("body").append('<div id="freeow" \/>');
					$('#freeow').freeow('Information', 'Objektet borttaget.', {
						classes: ['lc-notice ui-widget-content ui-state-highlight ui-corner-all ui-box-shadow'],
					});					
					$(this).dialog("close");
					tr.toggle('highlight', 500);
				}
			});

			},
			"Avbryt" : function() {
				$(this).dialog("close");
			}
		});
			
		$("#lc-dialog").html(function(){
			return '<div><img class="lc-dialog-icon" src="skins/images/dialog-info.png" style="max-height:50px;" /><p>Denna åtgärd går ej att ångra.</p></div>';
		});
				
		$("#lc-dialog").dialog('open');	
		
		return false;	

		
	});

	};
})( jQuery );

/*
	Filetree base UI setup
*/

(function( $ ){
	$.fn.lcfileTree = function() {
	
		return this.each(function() { 	
			$(this).find(".lc-folder-title").next().hide();
			$(this).find(".lc-folder-title").css("cursor", "pointer");

			/* Add class depending on file format */
			$("a.lc-browser-file-link").addClass(function(){
				var fileExt = $(this).attr('href').split('.').pop().toLowerCase();				
				if ( fileExt == "png" ){$(this).addClass("pngFile");}
				else if ( fileExt == "jpg" ){$(this).addClass("jpgFile");}
				else if ( fileExt == "jpeg" ){$(this).addClass("jpgFile");}
				else if ( fileExt == "gif" ){$(this).addClass("gifFile");}
				else if ( fileExt == "html" ){$(this).addClass("htmlFile");}
				else if ( fileExt == "htm" ){$(this).addClass("htmlFile");}
				else if ( fileExt == "php" ){$(this).addClass("phpFile");}
				else if ( fileExt == "css" ){$(this).addClass("cssFile");}
				else if ( fileExt == "js" ){$(this).addClass("jsFile");}
				else {$(this).addClass("otherFile");}		
			});	

			/* Add a click function that toggles the sub-menu */
			$(this).find(".lc-folder-title").click( function() {
				$(this).next().toggle('blind');
				$(this).toggleClass("lc-folder-title-open");
			});
			return false;
		});

 	};
})( jQuery );

/*
	Quick image edit
*/
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
		var imgWidth = $(this).width();	
		var imgHeight = $(this).height();	
		var path = "liveConCMS/";	
	
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
						'width': $element.width(),
						'height': $element.height(),
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
					$("#" + settings.overlayID).click(function(){

						/*Prevent page from being scrolled*/
						$("body").css({'overflow' : 'hidden'});
											
						/*Remove dublicates*/
						$("#lc-dialog").remove();
						
						/*Create dialog div*/
						$("body").append('<div id="lc-dialog"><iframe id="lc-iframe" width="960px" height="500px" frameBorder="0"></iframe></div>');
				
						$("#lc-dialog").dialog({	
							autoOpen: false,
							resizable: false,
							width: 'auto',
							height: 'auto',
							modal: true,
							position: ['center', 'center'],
							title: settings.dialogTitle						
						}).css({
							'padding':'0.1px'
						});
						
						$.getScript('liveConCMS/js/jquery.iframe.js', function(){				
							$('#lc-dialog iframe').src('liveConCMS/liveconcms_changeimg.php', function(){
							$("#lc-dialog").dialog('open');
							$("#lc-dialog iframe").contents().find("input[name=lc-img-src]").val(imgSrc);	
							$("#lc-dialog iframe").contents().find("textarea[name=lc-img-alt]").val(imgAlt);	
							$("#lc-dialog iframe").contents().find("input[name=lc-img-x]").val(imgWidth);	
							$("#lc-dialog iframe").contents().find("input[name=lc-img-y]").val(imgHeight);								
							});						
						});						
							
						
						$("#lc-dialog").dialog( "option", "buttons", { 
							"Ok": function() { 
							
								var newImgSrc = $("#lc-dialog iframe").contents().find("input[name=lc-img-src]").val();
								var newImgAlt = $("#lc-dialog iframe").contents().find("textarea[name=lc-img-alt]").val();
								var newImgWidth = $("#lc-dialog iframe").contents().find("input[name=lc-img-x]").val();
								var newImgHeight = $("#lc-dialog iframe").contents().find("input[name=lc-img-y]").val();

								/*Check if a new image is choosen, and if its a http link or a link to the media library. Replace the width and height as well.*/
								if (newImgSrc.length === 0 ) {$element.attr('src', imgSrc)}
								else if (isUrl(newImgSrc)) {$element.attr('src', newImgSrc); $element.attr('width', newImgWidth); $element.attr('height', newImgHeight)}
								else {$element.attr('src', path+newImgSrc); $element.attr('width', newImgWidth); $element.attr('height', newImgHeight)}
								
								/*Check for new alt tag*/
								if (newImgAlt.length === 0 ) {$element.attr('alt',  imgAlt)}
								else {$element.attr('alt',  newImgAlt)}
								
								/*Grab new HTML*/
								var contentHtml = $("#lc-main-content").html();
								
								/*Replace action url with page url and insert new HTML into textarea*/
								$("#lc-iframe").contents().find('#lc-form').attr('action', pageUrl);
								$("#lc-iframe").contents().find("#TextArea1").text(contentHtml);							 
							
								/*Send the form to the server*/
								$("#lc-iframe").contents().find("input[type=submit]").trigger('click');
										
							},
							
							"Cancel": function() { 
								$(this).dialog("close"); 
								$("#lc-dialog").remove();
							}	
						});	
					
						return false;		
						
					});
					
					//Remove the overlay div on mouseout
					$("#" + settings.overlayID).mouseleave(function(){
						$(this).remove();
					});					
			
			});
			

		});
 
	};
})( jQuery );


/*Setup for main navigation*/
function lcAdminPanel() {

	/*Menu hover effect*/
	$("a.lc-menu-default").each(function(){
		var $this = $(this);
		var parent = $(this).parent();
				
		$this.clone().appendTo($this).css({
			opacity : 0
		}).switchClass('lc-menu-default', 'lc-menu-hover').mouseenter(function(){
			$(this).animate({
				opacity: 1
			});
			return false;
		}).mouseleave(function(){
			$(this).animate({
				opacity: 0
			});			
		});
			
	});
	
	/*Move submenu back to bottom of li*/
	$("#lccms-adminpanel_wrapper ul li").find('.adminpanel_submenu_wrapper').each(function(){
		var parent = $(this).parent('li');
		var $this = $(this);
		var parentPos = parent.offset();
		
		
		$(this).appendTo(parent).css({
			'left': parentPos.left
		});
			
		parent.mouseenter(function(){		
			$this.css({
				'display':'block',
				'margin-top':'-10px',
				'position':'absolute'
			});
			$this.animate({
				'margin-top': '+=10',
			});
		}).mouseleave(function(){
			$this.css({
				'display':'none',
				'margin-top': '-10px'
			});
		});
	});
	
	/*Setup the minimize/maximize button on the adminpanel*/
	var adminpanelOffset = $("#lccms-adminpanel_wrapper .adminpanel").offset();
	var adminpanelWidth = $("#lccms-adminpanel_wrapper .adminpanel").width();
	var minimizeWidth = $("#lc-minimize-panel").width();
	var minpos = adminpanelOffset.left + adminpanelWidth - minimizeWidth;
	
	
	$("#lc-minimize-panel").css({
		'position':'absolute',
		'left': minpos
	});
	
	$("#lc-minimize-panel .lc-max").toggle();
	
	$("#lc-minimize-panel").click(function(){
		var minmax = $("#lccms-adminpanel_wrapper").hasClass('lc-min');	
		if ( minmax === true ) { $("#lc-minimize-panel .lc-max").toggle(); $("#lc-minimize-panel .lc-min").toggle(); createCookie('minmax','true',1); }
		else if ( minmax === false ) { eraseCookie('minmax'); createCookie('minmax','false',1); }
		$("#lccms-adminpanel_wrapper").toggleClass('lc-min', 800);	
		return true
	});	
	
	if ( sPage === "liveconcms_startpage.php" ) { createCookie('minmax','true',1) }
	if ( readCookie('minmax') === 'false' ) { $("#lccms-adminpanel_wrapper").toggleClass('lc-min', 0); }
	
	/*Hide min/max when in backend*/
	var lcbody = $("body").hasClass('lc-body');
	if ( lcbody === true ) { $("#lc-minimize-panel").hide(); }
	
	/*Setup liveCon Logo*/
	var lclogoWidth = $("#lccms-panel-logo").width();
	var lclogoPos = (adminpanelOffset.left / 2) - (lclogoWidth / 2);
	
	$("#lccms-panel-logo").css({
		'position':'absolute',
		'left':lclogoPos
	});
		
}

(function( $ ){
	$.fn.lcEditableImg = function() {
	
		return this.each(function() { 
			var img = $(this).attr('src');
			var fileExt = $(this).attr('src').split('.').pop().toLowerCase();	
			$(this).click(function(){
				$("body").append('<div id="lc-dialog" \/>');
				$("#lc-dialog").dialog({	
					autoOpen: true,
					resizable: false,
					width: '400px',
					height: 'auto',
					modal: true,
					title: 'Byt bild',
					position: ['center', 'center']
				});	
				
				$("#lc-dialog").html(function(){
					return '<form method="post" id="lcEditableImg-form" enctype="multipart/form-data" action="liveConCMS/core/functions/changepic.php?filename='+img+'&filetype='+fileExt+'"><fieldset><input name="File" type="file" /><em>Filformat:'+fileExt+'</em></fieldset><input style="display:none;" name="submit" type="submit" value="Ladda upp" /></form>';
				});
				
				$("#lc-dialog").dialog({ buttons: { 
					"Ok": function() { 
						$("#lcEditableImg-form").find("input[type=submit]").trigger('click');
					},
					"Cancel": function() { 
						$(this).dialog("close"); 
						$("#lc-dialog").remove(); 
					}					
					}
				});						


			});
		});

 	};
})( jQuery );


/*
	Makes the plugins open in a modal popup
*/
lc_plugin_Gallery = {
	init: function(url, dialogTitle){
		this.close();
		this.setup(url, dialogTitle);	
	},
	setup: function (url, dialogTitle) {				
		$("body").append('<div id="lc-dialog"><iframe id="lc-iframe" width="960px" height="350px" frameBorder="0"></iframe></div>');
		$("#lc-dialog").dialog({	
			autoOpen: false,
			width: 'auto',
			height: 'auto',
			modal: true,
			position: ['center', 'center'],
			title: dialogTitle						
		}).css({
			'padding':'0.1px'
		});	
		
		$("#lc-dialog").dialog({ buttons: { 
			"Stäng fönster": function() { 
				lc_plugin_Gallery.close();
			}					
			}
		});			
		
		$.getScript('js/jquery.iframe.js', function(){				
			$('#lc-dialog iframe').src(url, function(){
				$("#lc-dialog").dialog('open');
				$("#lc-dialog iframe").contents().find('.page-title').hide();
			});						
		});	
	},
	close: function() {
		$("#lc-dialog").dialog('close');
		$("#lc-iframe").remove();
		$("#lc-dialog").remove();
	}
};
