<?php
session_start();
if($_SERVER['REQUEST_METHOD']=="POST"){
    header('Content-Type: application/json');
    $dataLogout = json_decode(file_get_contents('php://input'),true);
    if($dataLogout !== null){
        session_destroy();
        echo json_encode(['success'=>true]);
    }else{
        echo json_encode(['message'=>'problem']);
    }
    
}else{
    echo json_encode(['Wrong'=>'Problem']);
}
