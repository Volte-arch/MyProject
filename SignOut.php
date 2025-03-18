<?php
session_start();
if($_SERVER['REQUEST_METHOD']=="POST"){
    header('Content-Type: application/json');
    $dataLogout = json_decode(file_get_contents('php://input'),true);
    require_once('./DB/ini.php');
    $conn = connect();
    if($dataLogout !== null){
        $sessionuser = $conn->prepare("UPDATE user_sessions SET active_session = false WHERE session_token=:Token");
        $sessionuser->execute([':Token'=>$_SESSION['Session_token']]);
        session_destroy();
        echo json_encode(['success'=>true]);
    }else{
        echo json_encode(['message'=>'problem']);
    }
    
}else{
    echo json_encode(['Wrong'=>'Problem']);
}
