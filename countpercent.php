<?php
	$path = "score/";
	if (!is_dir($path)){
		mkdir($path, 0777, true);
	}
	$fileW = @fopen($path."percent.txt","a") or die("Unable to open file!");
	$coutOVER =  -1;
	$countALL = -1;
	$data = 0;
	$score = $_POST["score"]."\r\n";
	if($fileW){
		if(flock($fileW,LOCK_EX)){
			fwrite($fileW,$score);
			flock($fileW,LOCK_UN);
		}
		fclose($fileW);
	}

	$fileR = @fopen("score/percent.txt","r") or die("Unable to open file!");
	if($fileR){
		while(!feof($fileR)){
			$temCount = fgets($fileR,999);
			if($temCount<$score){
				$coutOVER ++;
			}
			$countALL ++;
		}
		$data = $coutOVER/$countALL*100;
		echo floor($data);
		fclose($fileR);
	}
?>