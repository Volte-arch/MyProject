<?php
// w trakcie 
        require('../DB/ini.php');
        $conn = connect();
        if($conn == true){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                header('Content-Type: application/json; charset=utf-8');
                header('Access-Control-Allow-Origin: *');

            }
        }else{
            echo json_encode(["Connect"=>"connect width not work"]);
        }
    