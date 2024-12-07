<?php
session_start();
header('Content-Type: application/json');

if((isset($_SESSION['User_id']) && (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true))){
    echo json_encode(['videos'=>$_SESSION['video_links']]);
}else{
    echo json_encode(['error'=>'You not logged in']);
}