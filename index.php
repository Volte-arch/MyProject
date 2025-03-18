<?php
session_start();
require_once('./DB/ini.php');
$conn = connect();
if(isset($_SESSION['User_id'])){
    header('location: me');
}else{
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $userIP = $_SERVER['REMOTE_ADDR'];
     
     $guest = $conn->prepare("INSERT INTO ip_outside (`IP_address`,`Guest_agent`) VALUES (:IP_address,:user_Agent)");
     $guest->execute([
        ':IP_address'=>$userIP,
        ':user_Agent'=>$userAgent
     ]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="index.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>test</title>
</head>
<body>
    <div class="sign-in-and-out">
        <div class="signin">
            <button class="sign-in" type="button">Sign in</button></div>
        <div class="Signup">
            <button class="sign-up" type="button">Sign up</button>
        </div>
    </div>
    <div class="PopupFormMain">
        <div class="Popup"></div>
        <div class="PopupForm"></div>
    </div>
    <div class="background">
    </div>
    <div class="conteiner">
    
    </div> 
</body>
</html>