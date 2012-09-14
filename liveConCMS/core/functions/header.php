<?PHP
$NavigateFileName = $_SESSION['sess_liveConCMSPageIndex'] [5];
if (isset($_GET['filename']) == "")
{
$filetoChange = "";
$filetype = "";
}
else
{
$filetoChange = isset($_GET['filename']) ? $_GET['filename'] : filename('n');
$filetype = file_extension($filetoChange);
}


if (isset($_POST['submit']))
{

 
 if ($filetoChange == "")
 {

 }
	
			    if(empty($_FILES["File"]['name'])) 
			   {
			   	   			  
			   }
			   else
			   {
			  
			   		$filetoChangeDir = dirname($filetoChange);	   			   			   
			   		$upload_dir = "../../../$filetoChangeDir/"; 
	
	
				 
				   if ($filetype == "jpg")
				   {
				   $filetypes = 'jpg,JPG'; 
				   }
				   elseif ($filetype == "jpeg")
				   {
				   $filetypes = 'jpeg,JPEG'; 
				   }
				   elseif($filetype == "png")
				   {
				   $filetypes = 'png,PNG'; 
				   }
				   elseif($filetype == "gif")
				   {
				   $filetypes = 'gif,GIF'; 
				   }
				  
				  	$maxsize = (1024*900000); 
				
					if($_FILES["File"]['size'] > $maxsize) 
					{
				
					}
				     
				      
				        $types = explode(',', $filetypes); 
				   		$file = explode('.', $_FILES["File"]['name']); 
				   		$extension = $file[sizeof($file)-1]; 
				   		if(!in_array(strtolower($extension), $types)) 
						{
						
						}
				       
						$thefile = basename($filetoChange); 
						
										
						while (file_exists($upload_dir.$thefile)) 
						{ 
						unlink($upload_dir.$thefile);
						
						} 
				
					
				 	if (is_uploaded_file($_FILES["File"]['tmp_name']) && move_uploaded_file($_FILES["File"]['tmp_name'],$upload_dir.$thefile)) 
				    { 
					 
					 header("Refresh: 0;URL=../../../$NavigateFileName");
  					 exit; 
					 
				    }
				    else
				    {
				     header("Refresh: 0;URL=../liveconcms_error.php?error_id=7");
					exit; 
					}   
			   
			   }

}

if (isset($_GET['close']) == "1")
{
echo "<script>"; 
echo "self.window.close()";
echo "</script>";
}

function file_extension($filename)
{
   return pathinfo($filename, PATHINFO_EXTENSION);
}


?>