<?php
session_start();

header('Content-Type: application/json');
require_once('./DB/ini.php');
$conn = connect();
$Post = json_decode(file_get_contents('php://input'),true);

if($Post && isset($Post['Action']) && isset($Post['posts'])){
    if($Post['Action'] === 'delete'){
    // echo json_encode(['delete'=>$Post['posts']]);

    deletePost($Post);
}elseif($Post['Action'] === 'public'){
    // echo json_encode(['public'=>$Post['posts']]);
    Publices();
}
}else{
    echo "problem";    
};

function deletePost($postDelete){
    global $conn;
    $query = "SELECT RId FROM user_reg WHERE RId=:RId";
    $check = $conn->prepare($query);
    $check->bindParam(':RId',$_SESSION['User_id'],PDO::PARAM_STR);
    $check->execute();
    $getinfo = $check->fetch(PDO::FETCH_ASSOC);

    if($getinfo['RId']===$_SESSION['User_id']){
        if(is_array($postDelete['posts'])){
            foreach($postDelete['posts'] as $idpost){
                $delePost = $conn->prepare("DELETE FROM addedfile WHERE ID_user=:user AND Uniqid=:idpost");
                $delePost->bindParam(':user',$_SESSION['User_id'],PDO::PARAM_STR);
                $delePost->bindParam(':idpost',$idpost,PDO::PARAM_STR);
                $delePost->execute();
                echo json_encode(['The post'=>'has been delete']);
            }
        }
    }else{
        echo json_encode(['The problem'=>'with your account']);
    }



};
function Publices(){
    // global $conn;
    // $stmt = $conn->prepare();
    // $stmt->exec();
};

