<?php
    
    function connect(){
        $dns = "mysql:host=localhost;dbname=attachthisfile"; 
        $username = "root";
        $password = "";
        try {
            // $url = 'mongodb://localhost:27017/';
            // $client = new MongoDB\Client($url);
            $conn = new PDO($dns, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            $responseAnser = ["Status"=>"error","Message"=>"Błąd połączenia".$e->getMessage()];
            echo json_encode($responseAnser);
            die();
            // echo 'Problem z połączeniem, spróbuj później'.$e->getMessage();
        }
    }
    
?>
