<?php
try{
    require_once('../DB/ini.php');
    $conn = connect();
    if (isset($_GET['v'])) {
        $valueFromURL = $_GET['v'];
        $query = $conn->prepare('SELECT FileAttach, Namefile, Date_added FROM addedfile WHERE Uniqid Like :url');
        $query->bindParam(':url', $valueFromURL, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if($query->rowCount() === 0){
            $previousURL = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER']:"$previousURL";
            if(empty($previousURL)){
                header("Location: ../");
                exit();
            }
            header("Locatiom: $previousURL");
            exit();
        }
        
    }else{
        header("location: ../");
        exit();
    }
    foreach ($result as $row) {
        $Name = $row['Namefile'];
        $Added = $row['Date_added'];
        $Date = date_create($Added);
        $FormatDate = date_format($Date,"Y-m-d");
        $generatesite = <<<GS
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <link rel="stylesheet" href="index.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <script defer src="media.js"></script>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title>Shared</title>
        </head>
        <body>
        
        </div>
        </body>
        </html>
    
    GS; 
    echo $generatesite;
    }
}catch(PDOException $e){
    echo "Błąd połączenia";
}
        
        
