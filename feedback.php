<?php
	$today = date("Y-m-d");
	$path = "suggest/".$today."/";
	if (!is_dir($path)){
		mkdir($path, 0777, true);
	}
	$myfile = @fopen($path."recorder.txt","a") or die("Unable to open file!");
	if($myfile){
		if(flock($myfile,LOCK_EX)){
			$txt = $_POST["suggest"]."\r\n";
			fwrite($myfile,$txt);
			flock($myfile,LOCK_UN);
		}
		fclose($myfile);
	}
?>