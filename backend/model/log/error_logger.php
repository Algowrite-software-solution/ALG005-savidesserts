<?php


class ErrorLogger
{
    private $logDirectory;

    public function __construct($logDirectory)
    {
        $this->logDirectory = $logDirectory;
        date_default_timezone_set('Asia/Colombo');
    }

    public function logError($error, $metadata = [])
    {
        $now = new DateTime();
        $logDate = $now->format('Y-m-d H-i');
        $logPath = $this->logDirectory . DIRECTORY_SEPARATOR . $logDate . '.log';

        $logEntry = "[" . $now->format('Y-m-d H:i:s') . "] " . $error . PHP_EOL;
        if (!empty($metadata)) {
            $logEntry .= "Metadata: " . json_encode($metadata) . PHP_EOL . PHP_EOL;
        }

        if (!file_exists($logPath)) {
            touch($logPath);
        }

        file_put_contents($logPath, $logEntry, FILE_APPEND);

        // Delete files older than one month
        $this->deleteOldFiles($this->logDirectory, 60 * 60);
    }

    private function deleteOldFiles($directory, $secondsThreshold)
    {
        $thresholdTime = time() - $secondsThreshold;
        $directoryContents = scandir($directory);

        foreach ($directoryContents as $file) {
            $filePath = $directory . DIRECTORY_SEPARATOR . $file;
            if (is_file($filePath)) {
                if (filectime($filePath) < $thresholdTime) {
                    unlink($filePath);
                }
            }
        }
    }

    // private function deleteOldFiles($directory, $daysThreshold) {
    //     $thresholdDate = new DateTime("-$daysThreshold days");
    //     $directoryContents = scandir($directory);

    //     foreach ($directoryContents as $file) {
    //         $filePath = $directory . DIRECTORY_SEPARATOR . $file;
    //         if (is_file($filePath)) {
    //             $fileCreationDate = new DateTime(date('Y-m-d', filectime($filePath)));
    //             if ($fileCreationDate < $thresholdDate) {
    //                 unlink($filePath);
    //             }
    //         }
    //     }
    // }
}

// Example usage
$logDirectory = '../../util/log/';
$logger = new ErrorLogger($logDirectory);

$error = "An error occurred.";
$metadata = [
    'request_data' => ['param1' => 'value1', 'param2' => 'value2'],
    'ip_address' => $_SERVER['REMOTE_ADDR']
];

$logger->logError($error, $metadata);
