<?php
header("Access-Control-Allow-Origin: *"); // Consenti accesso da qualsiasi origine
header('Content-Type: application/json');

$statusFile = 'data/status.json';
$statusLogFile = 'data/status_log.json';


## $currentStatus = json_decode($statusFile);
    
    echo file_get_contents($statusFile);