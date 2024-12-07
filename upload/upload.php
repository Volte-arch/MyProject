<?php
session_start();
require_once('../DB/ini.php');
$conn = connect();
if(isset($_SESSION['User_id'])){
header('Content-Type: application/json');

$response = [];
$file = $_FILES['files'];
try {
    if (empty($file)) {
        throw new Exception('No files were uploaded.');
    }

    $uploadDirectory = '../source/'; 
    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    $allowedMimeTypes = ['video/mp4', 'image/jpeg', 'image/png'];
    $maxFileSize = 150 * 1024 * 1024;

    foreach ($file['name'] as $index => $fileName) {
        $fileTmpPath = $file['tmp_name'][$index];
        $fileSize = $file['size'][$index];
        $fileType = $file['type'][$index];

        if (!in_array($fileType, $allowedMimeTypes)) {
            throw new Exception("File type not allowed: $fileName");
        }
        
        if ($fileSize > $maxFileSize) {
            throw new Exception("File is too large: $fileName (max 150MB)");
        }
        $NewNameFile = bin2hex(random_bytes(6)).'_'.basename($fileName);
        $destination = $uploadDirectory . $NewNameFile;

        $uniqIdFile = bin2hex(random_bytes(6));
        $date = date('Y-m-d H:i:s');
        $getInfoDevice = $_SERVER['HTTP_USER_AGENT'];
        if (!move_uploaded_file($fileTmpPath, $destination)) {
            throw new Exception("Failed to save file: $fileName");
            echo json_encode([
                'status' => 'error',
                'message' => "Your uploaded file is problem"
            ]);
        }else{
            $sql = "INSERT INTO `addedfile`(`ID_user`, `Uniqid`, `Type`, `FileAttach`, `Namefile`,`Size`,`Date_added`,`From_device`) VALUES (:ID_user, :Uniqid, :Type, :FileAttach, :namefile, :Size, :Date_added, :Device)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ":ID_user" => $_SESSION['User_id'],
                ":Uniqid" => $uniqIdFile,
                "Type"=>$fileType,
                ":FileAttach" => $NewNameFile,
                ":namefile" => $fileName,
                "Size"=>$fileSize,
                "Date_added"=>$date,
                "Device"=>$getInfoDevice
            ]);

            echo json_encode([
                'status' => 'success',
                'message' => "Uploaded successfully: "
            ]);
            
        }
    }

} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);

}
}else{
    header('location: ../');
}