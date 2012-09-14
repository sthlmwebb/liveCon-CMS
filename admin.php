<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" />
<title>Login liveConCMS</title>


<link rel="stylesheet" type="text/css" href="liveConCMS/skins/reset.css">
<link rel="stylesheet" type="text/css" href="liveConCMS/skins/styles.php">

<script type="text/javascript" src="liveConCMS/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="liveConCMS/js/jquery-ui.1.8.11-min.js"></script>

<script type="text/javascript">
//Function to center a object on screen.
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

$(document).ready(function(){
	//Center .bodywrapper
	$('.bodywrapper').center();
	
	//Execute UI button layout
	$("input:submit, input:reset").button();
});
</script>
</head>

<body id="lc-login" class="lc-body">

	<div class="bodywrapper">

			<div class="ui-widget ui-widget-content ui-corner-all ui-box-shadow" id="lc-loginbox">
				<span class="ui-widget-header ui-corner-top ui-helper-clearfix"><h3>Login</h3></span>
					<div class="ui-widget-content">			 
						<p>Please enter your username and password to login.</p>
						
							<?PHP
								if (isset($_GET['badlogin']))
								 {
									echo "
												<div class='ui-state-error ui-corner-all'> 
													<span class='ui-icon ui-icon-alert'></span> 
														<span class='ui-state-error-text'>Wrong username or password.</span>	
												</div>
										";	
								}
							?>		 
									<form method='post' action='liveConCMS/liveconcms_login.php'>
										<fieldset>
											<b>Username:</b>
											<input name='username' type='text' />
										</fieldset>							
										<fieldset>
											<b>Password:</b>
											<input name='password' type='password' />
										</fieldset>
										<fieldset>
											<input name='submit' type='submit' value='Login'>
											<input name='reset' type='reset' value='Reset'>
										</fieldset>
									</form>					
					</div>
			</div>

		<span class="lc-copyright">
			<p>liveCon CMS by <a href="http://www.sthlmwebb.se" target="_blank">STHLM Webbproduktion</a></p>
			<p>&copy Copyright 2012 STHLM Webbproduktion AB</p>
		</span>
			
	</div>
	
</body>
</html>