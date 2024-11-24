<?php
require_once('../DB/ini.php');
if (isset($_GET['v'])) {
    $valueFromURL = $_GET['v'];
    $query = $conn->prepare('SELECT Test FROM addedfile WHERE Uniqid Like :url');
    $query->bindParam(':url', $valueFromURL, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    
    if($query->rowCount() === 0){
        $previousURL = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER']:"$previousURL";
        if(empty($previousURL)){
            header("Location: ../");
            exit();
        }
        header("Locatiom: $previousURL");
        exit();
    }
    
}else{
    header("location: ../");
    exit();
}
foreach($result as $row){
    header("Content-Type video/mp4");
    echo json_encode(['Video'=>$row['FileAttach']]);
}
