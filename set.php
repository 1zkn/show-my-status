<?php

header("Access-Control-Allow-Origin: *"); // Consenti accesso da qualsiasi origine
header('Content-Type: application/json');

require_once 'conf/statusManage.php';
require_once 'conf/secure.php';

//password check
$secureCheck = false;
if(isset($_GET['psw']) && !empty($_GET['psw'])){
    
    $secureCheck = ($_GET['psw'] == $allowMethod['psw'] ? true : false);
    
}

 if(isset($_GET['status']) && !empty($_GET['status']) && $secureCheck) {
    
    $newStatus = $_GET['status'];

    
    $statusFiles = new ShowMyStatus\Manage\statusManager();


    
    $currentStatus = [
        'time' => time(),
        'status' => $newStatus,
        'message' => mexExists()
    ];

    //Update current status
    $newLogEntry = $currentStatus;
    $statusFiles->updateCurrentStatus($currentStatus);


    $statusFiles->updateStatusLog($newLogEntry);
    ##file_put_contents($statusFiles->getStatusLogFile(), json_encode($logDatas, JSON_PRETTY_PRINT));
   
}else{
    echo json_encode(['error' => 'Password invalid or empty status']);
}


function mexExists() {
    if(isset($_GET['msg']) && !empty($_GET['msg'])){
        $infoMessage = $_GET['msg'];
    }else{
        $infoMessage = null;
    }
    return $infoMessage;
}

?>
