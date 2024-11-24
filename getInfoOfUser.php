<?php
session_start();

if((isset($_SESSION['User_id']) && (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true))){
    echo json_encode(['videos'=>$_SESSION['video_links']]);
    header('Content-Type: application/json');
    header("Access-Control-Allow-Origin: *");
}else{
    echo json_encode(['error'=>'You not logged in']);
}