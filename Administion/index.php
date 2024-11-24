<?php
    session_start();
    if(isset($_SESSION['User_id'])){
        header('location: ../');
    }else{
        header('location: ../');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pannel Administion</title>
</head>
<body>
    <h1>Just for admins</h1>
</body>
</html>