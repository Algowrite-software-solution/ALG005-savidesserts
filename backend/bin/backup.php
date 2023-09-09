<?php
//require_once '/vendor/autoload.php'

class GoogleDriveUploader
{
     private $client;
     private $service;

     public function __construct($credentialsPath)
     {
          // When creating an object from this class, we need to give it the path to the credentials file.
          // The __construct function is a starting point when the class is used.
          // We're setting up the $this->client container and the $this->service container here.
          $this->client = $this->createClient($credentialsPath);
          $this->service = new Google_Service_Drive($this->client);
     }

     private function createClient($credentialsPath)
     {
          // This function takes the provided credentials path and creates a Google_Client object.
          $client = new Google_Client();
          // We set the authentication configuration using the given credentials path.
          $client->setAuthConfig($credentialsPath);
          // We're adding a permission scope to the client, which in this case is access to Google Drive.
          $client->addScope(Google_Service_Drive::DRIVE);
          // We return the configured client.
          return $client;
     }

     public function uploadFile($filePath, $folderId)
     {
          // This function is for uploading a file to Google Drive.
          // We create metadata for the file, specifying its name and the folder it should belong to.
          $fileMetadata = new Google_Service_Drive_DriveFile([
               'name' => basename($filePath),
               'parents' => [$folderId]
          ]);

          // We read the contents of the file to be uploaded.
          $content = file_get_contents($filePath);

          // We create the actual file on Google Drive using the service.
          $file = $this->service->files->create($fileMetadata, [
               'data' => $content,
               'mimeType' => 'application/octet-stream',
               'uploadType' => 'multipart'
          ]);

          // We return the ID of the uploaded file.
          return $file->id;
     }
}

#how to use this class
$credentialsPath = 'path/to/credentials.json';
$backupFilePath = 'path/to/backup.sql';
$folderId = 'Google_Drive_Folder_ID';

// We create an object from the GoogleDriveUploader class, passing the credentials path.
$uploader = new GoogleDriveUploader($credentialsPath);

// We call the uploadFile function on the object, passing the backup file path and folder ID.
$fileId = $uploader->uploadFile($backupFilePath, $folderId);

// Depending on whether the upload was successful, we display a message.
if ($fileId) {
    echo "Backup file uploaded successfully. File ID: $fileId";
} else {
    echo "Backup file upload failed.";
}
