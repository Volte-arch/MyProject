<?php
session_start();
try {
    require_once('../DB/ini.php');
    $conn = connect();
    $getParams = json_decode(file_get_contents('php://input'), true);

    if (isset($getParams['v'])) {
        $QueryV = $getParams['v'];
    } else {
        throw new Exception('Nie podano parametru v');
    }

    $stmt = $conn->prepare('SELECT `Uniqid`, `access`, `Type`, `FileAttach`, `Title`, `Date_added` FROM `addedfile` WHERE Uniqid = :url');
    $stmt->bindParam(':url', $QueryV);
    $stmt->execute();
    $getinfo = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($stmt->rowCount()>0) {
        if($getinfo['access'] === 'Public'){
            echo json_encode([
                'file'=>[ 
                'fileattach'=>$getinfo['FileAttach'],
                'title'=>$getinfo['Title'],
                'data'=>$getinfo['Date_added']
                ]
            ]);
        }else{
            echo json_encode(['Answer'=>'The film is private']);
        }
    } else {
        echo json_encode(['error' => 'Brak wyników dla podanego parametru.']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Błąd połączenia: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
