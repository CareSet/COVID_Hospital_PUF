<?php
//PLEASE start using mysql.pdo.php
//instead of this file...

require_once(__DIR__ . '/../util/Spyc.php');

/*
db.yaml file contents... password should be a generated password
mysql_host: localhost
mysql_user: root
mysql_password: 'password'
mysql_database: state_data
*/

//db configuration must be in db.yaml file
//in the format above...

	$db_yaml_places = [
		__DIR__ .'/db.yaml',
		__DIR__ .'/../config/db.yaml',
		__DIR__ .'/mysql.yaml',
		__DIR__ .'/../config/mysql.yaml',
		__DIR__ .'/config.yaml',
		__DIR__ .'/../config/config.yaml',
		__DIR__ .'/../config.yaml',
		];

$yep_db_is_def_here = false;
foreach($db_yaml_places as $maybe_db_is_here){
	if(file_exists($maybe_db_is_here)){
		$yep_db_is_def_here = $maybe_db_is_here;
	}
}

if(!$yep_db_is_def_here){
	echo "I cannot find the database config file\n I looked here\n";
	var_export($db_yaml_places);
	exit();
}


if(file_exists($yep_db_is_def_here)){
$db = Spyc::YAMLLoad($yep_db_is_def_here);

if(!isset($db['mysql_host'])){
	echo "Well shit, I found $yep_db_is_def_here, but it looks like there is no mysql config inside...\n";
	exit();
}

$host = $db['mysql_host'];
$user = $db['mysql_user'];
$password = $db['mysql_password'];
$database = $db['mysql_database'];


	$DB_LINK = mysqli_connect($host,$user,$password);
	mysqli_select_db($DB_LINK,$database);

$GLOBALS['mysql_database'] = $database;
$GLOBALS['mysql_host'] = $host;
$GLOBALS['mysql_user'] = $user;
$GLOBALS['mysql_password'] = $password;
$GLOBALS['DB_LINK'] = $DB_LINK;


}else{
	echo "FATAL ERROR: You have no db.yaml file or similar.. make one before trying to access the database...\n";
	exit();
	
}

//tired of typing mysqli etc
//wrapper for http://us3.php.net/manual/en/mysqli.query.php
function f_mysql_query($query){
	$result = mysqli_query($GLOBALS['DB_LINK'],$query) or 
		die("failed with $query\n".mysqli_error($GLOBALS['DB_LINK']));
	return($result);
}

//wrapper for http://us3.php.net/manual/en/mysqli.real-escape-string.php
function f_mysql_real_escape_string($string){
	return mysqli_real_escape_string($GLOBALS['DB_LINK'], $string);
}

//wrapper for http://us3.php.net/manual/en/mysqli-result.fetch-assoc.php
function f_mysql_fetch_assoc($result){
	return mysqli_fetch_assoc($result);
}

//wrapper for http://us3.php.net/manual/en/mysqli.insert-id.php
function f_mysql_insert_id(){
	return mysqli_insert_id($GLOBALS['DB_LINK']);
}

//wrapper for http://us3.php.net/manual/en/mysqli.begin-transaction.php
function f_mysql_begin_transaction(){
        return mysqli_begin_transaction($GLOBALS['DB_LINK']);
}

//wrapper for http://us3.php.net/manual/en/mysqli.commit.php
function f_mysql_commit(){
        return mysqli_commit($GLOBALS['DB_LINK']);
}

//wrapper for http://www.php.net/manual/en/mysqli.rollback.php
function f_mysql_rollback(){
	return mysqli_rollback($GLOBALS['DB_LINK']);
}

//wrapper http://us3.php.net/manual/en/mysqli.multi-query.php
function f_mysql_multi_query($query){
	$result = mysqli_multi_query($GLOBALS['DB_LINK'],$query) or
                die("failed with $query\n".mysqli_error($GLOBALS['DB_LINK']));
	return($result);
}

//wrapper http://us3.php.net/manual/en/mysqli.next-result.php
function f_mysql_next_result(){
	return mysqli_next_result($GLOBALS['DB_LINK']);
}

//wrapper for http://us3.php.net/manual/en/mysqli.more-results.php
function f_mysql_more_results(){
	return mysqli_more_results($GLOBALS['DB_LINK']);
}

//wrapper for http://www.php.net/manual/en/mysqli.warning-count.php
function f_mysql_warning_count(){
	return mysqli_warning_count($GLOBALS['DB_LINK']);
}

//wrapper for http://www.php.net/manual/en/mysqli.kill.php
function f_mysql_kill($process_id){
	return mysqli_kill($GLOBALS['DB_LINK'],$process_id);
}	

//wrapper for http://www.php.net/manual/en/mysqli.errno.php
function f_mysql_errno(){
	return mysqli_errno($GLOBALS['DB_LINK']);
}

//wrapper for http://www.php.net/manual/en/mysqli.error-list.php
function f_mysql_error_list(){
	return mysqli_error_list($GLOBALS['DB_LINK']);
}

//wrapper for http://www.php.net/manual/en/mysqli.error.php
function f_mysql_error(){
	return mysqli_error($GLOBALS['DB_LINK']);
}

//wrapper for http://www.php.net/manual/en/mysqli.dump-debug-info.php
function f_mysql_dump_debug_info(){
	return mysqli_dump_debug_info($GLOBALS['DB_LINK']);
}

//wrapper for http://www.php.net/manual/en/mysqli.close.php
function f_mysql_close(){
	return mysqli_close($GLOBALS['DB_LINK']);
}

//wrapper for http://www.php.net/manual/en/mysqli.affected-rows.php
function f_mysql_affected_rows(){
	return mysqli_affected_rows($GLOBALS['DB_LINK']);
}



?>
