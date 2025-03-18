<?php
session_start();

function DeleteAccount(){
    if(!$_SESSION['User_id' || empty($_SESSION['User_id'])]){
        require_once("./DB/ini.php");
        $conn = connect();
        $sql = "DELETE FROM `user_reg` WHERE 0";
        $stmt = $conn->prepare("");
    }else{
    
    }
}
DeleteAccount();
