<?php
session_start();
    try{
        require('./Config/ini.php');
        $querySelect = $conn->query("SELECT id, FileAttach FROM addedfile WHERE Date_added < NOW() - INTERVAL 2 Day");
        $rows = $querySelect->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($rows as $row){
            $folder = "source";
            chmod($folder,0777);
            $fileName = $row['FileAttach'];
            $file = "$folder/$fileName"; 
            if(file_exists($file)){
                unlink($file);
            }
            $queryDelete = $conn->prepare("DELETE FROM addedfile WHERE id =:FileAttach");
            $queryDelete->bindParam(':FileAttach', $row['id'], PDO::PARAM_INT);
            $queryDelete->execute();
        // echo "połączony";
        
    }
    
}catch(PDOException $e){
    echo $e->getMessage();
}