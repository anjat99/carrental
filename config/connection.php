<?php

require_once "config.php";

noteAccessPages();

try {
    $connection = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $ex){
    echo $ex->getMessage();
}

function executeQuery($query){
    global $connection;
    return $connection->query($query)->fetchAll();
}

function noteAccessPages(){
    @$open = fopen(LOG_FILE, "a");
    if($open){
        $date = date('d-m-Y H:i:s');
        @fwrite($open, "{$_SERVER['PHP_SELF']}\t{$date}\t{$_SERVER['REQUEST_URI']}\t{$_SERVER['REMOTE_ADDR']}\t\n");
        @fclose($open);
    }
}

function enrollErrors($error){
    @$open=fopen(ERRORS_FILE,"a");
    $enroll=$error."\t".date('d-m-Y H:i:s')."\n";
    @fwrite($open,$enroll);
    @fclose($open);
}
