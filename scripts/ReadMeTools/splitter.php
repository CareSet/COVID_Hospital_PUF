<?php
// this will take a markdown file with lots of headings and split it into many small markdown files...
//where the file names will be based on the heading names..
//writing this to account for a large central readme being written in Google Drive and then saves into 
//github...


	if(!isset($argv[2])){
		echo "Usage: php splitter.php <file_to_split> <directory_to_write_to>\n";
		exit(); 
	}else{
		$file_to_parse = $argv[1];
		$dir_to_write_to = $argv[2];
	}

	if(!file_exists($file_to_parse)){
		echo "Error: could not find a file at $file_to_parse\n";
		exit();
	}

	if(!is_dir($dir_to_write_to)){
		echo "Error: cannot see $dir_to_write_to as a directory\n";
		exit();
	}
	
	if(!is_dir($dir_to_write_to. "/questions")){
		mkdir($dir_to_write_to. "/questions");
	}


	$split_level = '###'; //anything with this level or lower goes into subfile


	$file_lines = file($file_to_parse);

	$save_files = [];
	$current_file_name = 'ReadMe.md';
	foreach($file_lines as $this_line){
		if(strpos($this_line,$split_level) === 0){//note that we will not match unless the heading string is at the start of the line..
			//if we are here then we have reached a new subsection at ### or lower... 
			//we need to create a new section of our save_files for this section of the readme...
			list($prefix,$heading)  = explode('# ',$this_line);
			$dashes_instead_of_spaces = str_replace(' ','-',strtolower($heading));//replace spaces with underscores
			$no_special_chars = preg_replace('/[^A-Za-z0-9\-]/', '', $dashes_instead_of_spaces);
			$shorter_string  = substr($no_special_chars,0,64); // make it shorter

			//this is the final text transformation, which results in a new file name... 
			$current_file_name = "$shorter_string.md";//its a markdown file
			$save_files[$current_file_name]['heading'] = trim($heading);
			
		}

		$save_files[$current_file_name]['inside_lines'][] = $this_line; //save this line to this section...

	}
		
	// first we add links to the file back to the main readme...
	foreach($save_files as $this_file => $file_data){
		if($this_file == 'ReadMe.md'){
			//do nothing on this file...
		}else{
			$this_heading = trim($file_data['heading']);
			$list_item_link = "* [$this_heading](/questions/$this_file)\n";
			$save_files['ReadMe.md']['inside_lines'][] = $list_item_link;
		}
	}

	foreach($save_files as $this_file_name => $file_data){
		$file_text = implode('',$file_data['inside_lines']);

		if($this_file_name == 'ReadMe.md'){
			$sub_dir = '/';
		}else{
			$sub_dir = '/questions/';
		}

		$output_file = $dir_to_write_to . $sub_dir . $this_file_name;
		file_put_contents($output_file,$file_text);
	}


