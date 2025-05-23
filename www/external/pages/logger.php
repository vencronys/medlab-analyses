<?php
class Logger {
    private $logFile;
    private $logPath = '../logs/';
    
    public function __construct() {
        // Create logs directory if it doesn't exist
        if (!file_exists($this->logPath)) {
            mkdir($this->logPath, 0777, true);
        }
        
        // Set log file for current day
        $this->logFile = $this->logPath . date('Y-m-d') . '.log';
    }
    
    public function log($action, $userId = null, $details = '', $level = 'INFO') {
        $timestamp = date('Y-m-d H:i:s');
        $userIp = $_SERVER['REMOTE_ADDR'];
        
        // Format log message
        $logMessage = sprintf(
            "[%s] [%s] User ID: %s, IP: %s, Action: %s, Details: %s\n",
            $timestamp,
            $level,
            $userId ?? 'Guest',
            $userIp,
            $action,
            $details
        );
        
        // Write to file
        file_put_contents($this->logFile, $logMessage, FILE_APPEND);
    }
    
    public function logError($error, $userId = null) {
        $this->log('ERROR', $userId, $error, 'ERROR');
    }
    
    public function logLogin($userId, $success) {
        $status = $success ? 'successful' : 'failed';
        $this->log('LOGIN', $userId, "Login attempt $status", $success ? 'INFO' : 'WARNING');
    }
    
    public function logSignup($userId) {
        $this->log('SIGNUP', $userId, "New user registration");
    }
    
    public function logLogout($userId) {
        $this->log('LOGOUT', $userId, "User logged out");
    }
}
?>