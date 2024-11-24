<?php
session_start();
// header('HTTP/1.0 403 Forbidden');
// echo 'Not found';
// if(isset($_SESSION['logged_id'])){
    
// }else{  
//     header('location: ../');
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <script defer src="./index.js"></script> -->
    <script defer src="./media.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Watching</title>
</head>
<body>
    <?php 
    include('../core/header.php');
    ?>
<div class="conteiner">
    <div class="categorie">
        <div class="Polecane"><h2>Polecane</h2></div>
        <div class="Ulubieni"><h2>Ulubieni</h2></div>
        <div class="Education"><h2>Education</h2></div>
    </div>
</div>
</body>
</html>