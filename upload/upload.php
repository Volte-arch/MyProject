<?php
// w trakcie 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require('../DB/ini.php');
        $conn = connect();
        if($conn == true){
                header('Content-Type: application/json; charset=utf-8');
                header('Access-Control-Allow-Origin: *');
                echo json_encode(["status"=>"Success",'fileName'=>$_POST['files']]);
            }else{
                echo json_encode(["Connect"=>"connect width not work"]);
            }
        }
    