<?php
// this will take a markdown file with lots of headings and split it into many small markdown files...
//where the file names will be based on the heading names..
//writing this to account for a large central readme being written in Google Drive and then saves into 
//github...


	if(!isset($argv[1])){
		echo "Usage: php splitter.php <file_to_split>\n";
		exit(); 
	}else{
		$file_to_parse = $argv[1];
	}

	if(!file_exists($file_to_parse)){
		echo "Error: could not find a file at $file_to_parse\n";
		exit();
	}

	$file_lines = file_get_contents($file_to_parse);

	var_export($file_lines);
	

