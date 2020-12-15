<?php
/*

	This is a simple stand alone php CLI importer to ingest the facility level COVID hospital capacity data in a mysql database

	The database configuration and mysql tools are stored in /util/ these are simple wrappers to the php 7 mysqli functions
	you will need to create an appropriate database, and give a user desribed in /util/db.yaml access to this file	

*/
	require_once('util/mysql_tools.php'); //this knows how to load our passwords, etc from util/db.yaml

	//import parameters are null to start.
	$file_to_import = null;
	$db = null;
	$table = null;

	if(isset($argv[1])){
		$file_to_import = $argv[1];
		//but does the file exist? 
		if(!file_exists($file_to_import)){
			echo "Fail. I cannot see a file at $file_to_import\n";
			exit();
		}
	}

	if(isset($argv[2])){
		$db = $argv[2];
	}

	if(isset($argv[3])){
		$table  = $argv[3];
	}
	if(is_null($table) || is_null($db) || is_null($file_to_import)){
		//if we do not have anything in argv, it means that no arguments were given to this program... in that case, display details on how to use the script
		echo "Usage: php standalone_covid_data_importer.php <covid_csv_file_name> <db_to_import_to> <table_to_import_to>\n";
		exit(); 
	}
	// at this point, we should have the file name of the csv file we want to import, as well as the destination mysql db and table name

	echo "Importing \t$file_to_import into \n\t\t$db\n\t\t$table\n";

	//we will create an array, called $sql, and later we will loop through this array and execute each sql command, one at a time.
	$sql = [];

	$sql['Create the database if it does not exist'] = "
CREATE DATABASE IF NOT EXISTS `$db`
";

//this is here for convenience, but be careful to use this wisely, as it will automatically delete the previous table
	$sql['drop the target to make sure the import works'] = "
DROP TABLE IF EXISTS `$db`.`$table`
";

	$sql['create the new table schema'] = "
CREATE TABLE `$db`.`$table` (
        `hospital_pk` VARCHAR(64),
        `collection_week` VARCHAR(10),
        `state` VARCHAR(2),
        `ccn` VARCHAR(10),
        `hospital_name` VARCHAR(77),
        `address` VARCHAR(50),
        `city` VARCHAR(20),
        `zip` VARCHAR(5),
        `hospital_subtype` VARCHAR(25),
        `fips_code` VARCHAR(5),
        `is_metro_micro` VARCHAR(5),
        `tot_adult_pat_hospitalized_confirmed_and_suspected_covid_7dayavg` FLOAT(6,3),
        `tot_adult_pat_hospitalized_confirmed_covid_7dayavg` FLOAT(6,3),
        `tot_adult_pat_hospitalized_suspected_covid_7dayavg` FLOAT(6,3),
        `tot_ped_pat_hospitalized_confirmed_and_suspected_covid_7dayavg` VARCHAR(6),
        `tot_ped_pat_hospitalized_confirmed_covid_7dayavg` VARCHAR(6),
        `tot_ped_pat_hospitalized_suspected_covid_7dayavg` FLOAT(5,3),
        `inpatient_beds_7dayavg` FLOAT(7,3),
        `total_icu_beds_7dayavg` FLOAT(7,3),
        `staffed_icu_adult_patients_confirmed_covid_7dayavg` FLOAT(6,3),
        `total_patients_hospitalized_confirmed_influenza_7dayavg` FLOAT(5,3),
        `icu_patients_confirmed_influenza_7dayavg` FLOAT(4,3),
        `total_patients_hospitalized_confirmed_influenza_and_covid_7` FLOAT(5,3),
        `previous_day_admission_adult_covid_confirmed_7daysum` INT,
        `previous_day_admission_adult_covid_confirmed_18_19_7daysum` INT,
        `previous_day_admission_adult_covid_confirmed_20_29_7daysum` INT,
        `previous_day_admission_adult_covid_confirmed_30_39_7daysum` INT,
        `previous_day_admission_adult_covid_confirmed_40_49_7daysum` INT,
        `previous_day_admission_adult_covid_confirmed_50_59_7daysum` INT,
        `previous_day_admission_adult_covid_confirmed_60_69_7daysum` INT,
        `previous_day_admission_adult_covid_confirmed_70_79_7daysum` INT,
        `previous_day_admission_adult_covid_confirmed_80_7daysum` INT,
        `previous_day_admission_adult_covid_confirmed_unknown_7daysum` INT,
        `previous_day_admission_pediatric_covid_confirmed_7daysum` INT,
        `previous_day_admission_adult_covid_suspected_7daysum` INT,
        `previous_day_admission_adult_covid_suspected_18_19_7daysum` INT,
        `previous_day_admission_adult_covid_suspected_20_29_7daysum` INT,
        `previous_day_admission_adult_covid_suspected_30_39_7daysum` INT,
        `previous_day_admission_adult_covid_suspected_40_49_7daysum` INT,
        `previous_day_admission_adult_covid_suspected_50_59_7daysum` INT,
        `previous_day_admission_adult_covid_suspected_60_69_7daysum` INT,
        `previous_day_admission_adult_covid_suspected_70_79_7daysum` INT,
        `previous_day_admission_adult_covid_suspected_80_7daysum` INT,
        `previous_day_admission_adult_covid_suspected_unknown_7daysum` INT,
        `previous_day_admission_pediatric_covid_suspected_7daysum` INT,
        `previous_day_total_ed_visits_7daysum` INT,
        `previous_day_admission_influenza_confirmed_7daysum` INT,
        INDEX(hospital_name),
        INDEX(fips_code)
) ENGINE='DEFAULT'
";
	//there are frequently php and mysql permissions problems associated with using a LOAD DATA statement from the CLI.
	//stackoverflow is your friend.
	//you will need mysqli.allow_local_infile = On in your php.ini file!!
	//using variables in single quotes  is easier than sorting the double quote and single quote templating interactions in php...
	$enclosed_by = '"';
	$escaped_by = '"';
	$lines_terminated_by = '\r\n';

	$sql['the load data statement'] = "
	LOAD DATA LOCAL INFILE '$file_to_import' 
	INTO TABLE `$db`.`$table` 
	FIELDS ENCLOSED BY '$enclosed_by' 
	TERMINATED BY ',' 
	ESCAPED BY '$escaped_by' 
	LINES TERMINATED BY '$lines_terminated_by' IGNORE 1 LINES
";

	//this will each sql command and echo it to the terminal as it does...
	$is_echo_sql = true;
	run_sql_loop($sql,$is_echo_sql);

