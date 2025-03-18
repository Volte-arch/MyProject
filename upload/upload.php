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
    if(isset($_POST['Title'])){
        throw new Exception('No title type');
    }
    $uploadDirectory = '../source/'; 
    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    $allowedMimeTypes = ['video/mp4', 'image/jpeg', 'image/png'];
    $role  = $_SESSION['Type_Account'] ?? 'user';
    $maxFileSize = ($role === 'Admin')?PHP_INT_MAX:150*1024**2;
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
        $title = htmlspecialchars($_POST['title']);
        $AccesFile = htmlspecialchars($_POST['visibility']);
        if (!move_uploaded_file($fileTmpPath, $destination)) {
            throw new Exception("Failed to save file: $fileName");
            echo json_encode([
                'status' => 'error',
                'message' => "Your uploaded file is problem"
            ]);
        }else{
            $sql = "INSERT INTO `addedfile`(`ID_user`, `Uniqid`,`access`,`Type`, `FileAttach`, `Namefile`,`Size`,`Date_added`,`From_device`) VALUES (:ID_user, :Uniqid, :access, :Type, :FileAttach, :namefile, :Size, :Date_added, :Device)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ":ID_user" => $_SESSION['User_id'],
                ":Uniqid" => $uniqIdFile,
                ":access"=>$AccesFile,
                ":Type"=>$fileType,
                ":FileAttach" => $NewNameFile,
                ":namefile" => $fileName,
                ":Size"=>$fileSize,
                ":Date_added"=>$date,
                ":Device"=>$getInfoDevice
            ]);
            $exe =[
                "ID_user" => $_SESSION['User_id'],
                "Uniqid" => $uniqIdFile,
                "access"=>$AccesFile,
                "Type"=>$fileType,
                "FileAttach" => $NewNameFile,
                "namefile" => $fileName,
                "Size"=>$fileSize,
                "Date_added"=>$date,
                "Device"=>$getInfoDevice
            ];
            if(!isset($_SESSION['video_links'])){
                $_SESSION['video_links'] = [];
            }
                $_SESSION['video_links'][] = $exe;
            
            echo json_encode([
                'status' => 'success'
            ]);
            
        }
    }

} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);

}
}else{
    header('location: ../');
}