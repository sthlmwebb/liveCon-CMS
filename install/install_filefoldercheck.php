<?PHP
function doInitTest()
{
$array = array(0, 0, 0, 0, 0, 0, 0);

		if( ini_get('safe_mode') ){
		  /* Safe mode */
		 $array[0] = 1;
			
		}else{
			/* Normal mode */
		}

		$tmpPathName = mt_rand();
		if(!mkdir("$tmpPathName.tmp", 0777))
		{
		/* Vi kunde inte skapa en mapp */
		$array[1] = 1;
		} 
			
			//$fh = fopen("$tmpPathName.tmp/liveconcms.tmp", "w+");
			$content = "liveCon CMS - Testing rights on server";
			$fh = file_put_contents("$tmpPathName.tmp/liveconcms.tmp", $content); // (PHP 5) 
			
			if(!$fh)
			{
			/* en fil kunnde inte skapas på servern */
			$array[2] = 1;
			}
		
				if (!copy("$tmpPathName.tmp/liveconcms.tmp", "$tmpPathName.tmp/liveconcms.tmp2")) 
				{
				/* Filen kunde inte kopieras */
				$array[3] = 1;
				}
		
					if(!unlink("$tmpPathName.tmp/liveconcms.tmp"))
					{
					/* Filen kunde inte plockas bort */
					$array[4] = 1;
					}
					
					if(!unlink("$tmpPathName.tmp/liveconcms.tmp2"))
					{
					/* Filen kunde inte plockas bort */
					$array[5] = 1;
					}
		
	
	if(! rmdir("$tmpPathName.tmp"))	
	 {
	  /* Mappen kunde inte plockas bort */
	  $array[6] = 1;
	 }
	 
	 return $array;
}
?>