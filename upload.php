<?php
    if (file_exists('./DB/ini.php')){
        require('./DB/ini.php');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');
            header('Content-Type: application/json; charset=utf-8');
            header('Access-Control-Allow-Origin: *');
            if(!isset($_POST['submit'])){
                if(!empty($_FILES['file'])){
                    $allowed = array('mp4','png','jpg');
                    $uploadDir = 'source/';
                    $randomkey = uniqid();
                    $fileBeforeName = htmlspecialchars($_FILES['file']['name'],ENT_QUOTES,'UTF-8');
                    $i = $fileBeforeName;
                    $currnetDateTimeSend = date('Y-m-d H:i:s');
                    $userAgent = $_SERVER['HTTP_USER_AGENT'];
                    $filename = $uploadDir . $randomkey . '_' . $fileBeforeName;  
                    $filenametobase =$randomkey . '_' . $fileBeforeName;  
                    $fileext = explode('.',$fileBeforeName);
                    $fileActual = strtolower(end($fileext));
                    if(in_array($fileActual,$allowed)){
                        // dopoprawy
                        if($_FILES['file']['size']<150*1024*1024){
                            if(move_uploaded_file($_FILES['file']['tmp_name'], $filename)){
                                try {
                                    $statement = $conn->prepare('INSERT INTO addedfile (Uniqid, FileAttach,Namefile, Date_added, From_device) VALUES (:randomkeys,:filenametobases,:is,:currnetDateTimeSends,:userAgents)');
                                    $statement->bindValue(':randomkeys',$randomkey);
                                    $statement->bindValue(':filenametobases',$filenametobase);
                                    $statement->bindValue(':is',$i);
                                    $statement->bindValue(':currnetDateTimeSends',$currnetDateTimeSend);
                                    $statement->bindValue(':userAgents',$userAgent);
                                    $statement->execute();
                                    echo json_encode(['message'=>'The file sent.','link'=>'http://192.168.0.16/watch/?v='.$randomkey]);
                            } catch (PDOException $e) {
                                echo json_encode(['message'=>'Connected failed.'.$e->getMessage()]);}
                            }else{
                                echo json_encode(['message'=>'Problem of send.']);
                            }         
                        }else{
                            echo json_encode(['message'=>'This file is too big!']);
                        }
                    }else{
                        echo json_encode(['message'=>'Bad format file! (Mp4)']);
                    }
                }else{
                    echo json_encode(['message'=>'No file']);
                }
            }else{
                echo json_encode(['message'=>'No file']);
            }
        }
    }else{
         echo json_encode(['message'=>'problem z połączeniem, spróbuj później']);
    }
    