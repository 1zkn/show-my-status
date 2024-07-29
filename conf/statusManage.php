<?php
namespace ShowMyStatus\Manage;

class statusManager {

    private $statusFile = '/data/status.json';
    private $statusLogFile = '/data/status_log.json';
    
    public function getStatusFile() {
        $statusFile = 'data/status.json';
        return $statusFile;
    }
    public function getStatusLogFile() {
        $statusLogFile = 'data/status_log.json';
        return $statusLogFile;
    }
    public function updateCurrentStatus(array $currentStatus) {

        file_put_contents($_SERVER['DOCUMENT_ROOT'].$this->statusFile, json_encode($currentStatus));
    
    }
    public function updateStatusLog($newLogEntry) {
        $logDatas = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].$this->statusLogFile), true);
    
        if (!isset($logDatas['statusLog'])) {
            $logDatas['statusLog'] = [];
        }

        array_unshift($logDatas['statusLog'], $newLogEntry);
        file_put_contents($_SERVER['DOCUMENT_ROOT'].$this->statusLogFile, json_encode($logDatas, JSON_PRETTY_PRINT));
        echo json_encode($newLogEntry);
    }
}