<?php
session_start();
header('Content-Type: application/json');

if((isset($_SESSION['User_id']) && (isset($_SESSION['status']) && $_SESSION['status'] == 'authorization'))){
    echo json_encode(['videos'=>$_SESSION['video_links'],'InfoUser'=>$_SESSION['Type_Account']]);
}else{
    echo json_encode(['error'=>'You aren`t logged']);
}