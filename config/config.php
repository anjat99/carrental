<?php

// BASE SETTINGS
define("BASE_PATH", "http://localhost/carrental");
define("ABSOLUTE_PATH", $_SERVER["DOCUMENT_ROOT"]."/carrental");


// OTHER SETTINGS
define("ENV_FILE", ABSOLUTE_PATH."/config/.env");
define("LOG_FILE", ABSOLUTE_PATH."/data/log.txt");
define("LOGGED_CUSTOMERS_FILE", ABSOLUTE_PATH."/data/logged.txt");
define("ERRORS_FILE", ABSOLUTE_PATH."/data/errors.txt");

// Podesavanja za bazu
define("SERVER", env("SERVER"));
define("DATABASE", env("DBNAME"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));

define("EMAIL", env("EMAIL"));
define("SIFRA_EMAIL", env("SIFRA_EMAIL"));

function env($name){
    $data_file = file(ENV_FILE);
    $values = "";
    foreach($data_file as $key=>$value){
        $config = explode("=", $value);
        if($config[0]==$name){
            $values = trim($config[1]);
        }
    }
    return $values;
}
