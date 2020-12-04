<?php	
        require_once(__DIR__ . '/mysqli.php');

/*
	accepts a series of SQL commands as php associative array..
	it be order indexed or label indexed...
	This function will run all of the sql commands, while echoing them to the terminal
*/
function run_sql_loop($sql, $is_echo_full_sql = false,  $start_time = null){ 	

	if(is_null($start_time)){
		$start_time = microtime(true);
	}

	$total_steps = count($sql);

	$current_step = 1;

	foreach($sql as $comment => $this_sql){
		$this_sql = trim($this_sql);
		if(strlen($this_sql) > 0){
			echo "Status: ($current_step of $total_steps) \t\t $comment\n";
			if($is_echo_full_sql){
				echo "Running $this_sql\n";
			}
			//actually run the sql here...
			f_mysql_query($this_sql);
		
		}else{
			echo "Skipping step $current_step of $total_steps because it is blank\n";
		}
		$current_step++;
	}


	$time_elapsed_secs = microtime(true) - $start_time;
	$time_elapsed_min = round($time_elapsed_secs / 60,2);
	echo "done. Processing run took $time_elapsed_min minutes.\n"; 
	
}


/*
	This works just the same as run_sql_loop
	But it uses mysqli_multi_query under the hood. 
	As a result of that, it might be somewhat unstable.
	Once this has become stablized, it should replace run_sql_loop, since this will give us the ability
	to run whole mysqldumps as a single step 
	or any other multiple step SQL statements seperated by ';'
*/
function run_multi_sql_loop($sql, $is_echo_full_sql = false,  $start_time = null){ 	

	if(is_null($start_time)){
		$start_time = microtime(true);
	}

	$total_steps = count($sql);

	$current_step = 1;

	foreach($sql as $comment => $this_sql){
		$this_sql = trim($this_sql);
		if(strlen($this_sql) > 0){
			echo "Status: ($current_step of $total_steps) \t\t $comment\n";
			if($is_echo_full_sql){
                		$short_sql = substr($this_sql,0,255);
                		echo "Running $short_sql\n";
			}
			//actually run the sql here...
                	if(f_mysql_multi_query($this_sql)){
				//we have to acknowledge the results of each query, one at a time.. 
                        	do {
                                	$result = mysqli_store_result($GLOBALS['DB_LINK']);
                                	if(is_object($result)){
                                	        mysqli_free_result($result);
                                	}
                        	} while (mysqli_next_result($GLOBALS['DB_LINK']));
                	}else{
				echo "Failed.. you should not see this since the problem should have already been echoed.. \n";
				exit();
			}
		}else{
			echo "Skipping step $current_step of $total_steps because it is blank\n";
		}
		$current_step++;
	}


	$time_elapsed_secs = microtime(true) - $start_time;
	$time_elapsed_min = round($time_elapsed_secs / 60,2);
	echo "done. Processing run took $time_elapsed_min minutes.\n"; 
	
}
