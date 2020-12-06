<?php
/*
	A file to load all of our various mysql tools.
*/
                date_default_timezone_set('America/Chicago'); //so we dont have to rely on a given php.ini

                require_once(__DIR__."/Spyc.php");
                require_once(__DIR__."/mysql.pdo.php");
                require_once(__DIR__."/mysqli.php");
                require_once(__DIR__."/run_sql_loop.function.php");

                //realpath for consist path


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
                        if(file_exists(realpath($maybe_db_is_here))){
                                $yep_db_is_def_here = realpath($maybe_db_is_here);
                        }
                }

                if(!$yep_db_is_def_here){
                        echo "I cannot find the database config file\n I looked here\n";
                        var_export($db_yaml_places);
                        exit();
                }
                if(file_exists($yep_db_is_def_here)){
                        $config = Spyc::YAMLLoad($yep_db_is_def_here);
                }else{
                        echo "Unable to load $db_file\r\n";
                        die(1);
                }

