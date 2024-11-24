<?php
require_once __DIR__.'/vendor/autoload.php';
// use Exception;
use MongoDB\Client;
if($_SERVER["REQUEST_METHOD"]=="GET"){
   $GenerateSignIn = '
   <div class="Sign-in-Form">
        <form class="Lg">
            <input type="text" name="YL" placeholder="E-mail or phone">
            <input type="password" name="YPW" placeholder="Password">
         <button type="submit" class="Signin" name="Sign_in">Sign in</button>
        </form>
     <div class="Remind"><a href="#Remind-password">Remind password me</a></div>
</div>';
   echo $GenerateSignIn;
}elseif($_SERVER["REQUEST_METHOD"]=="POST"){
   require_once('./DB/ini.php');
   session_start();
   $conn = connect();
   $received_data = json_decode(file_get_contents("php://input"), true);
   $processed_data = array("message"=>$received_data);
   // echo json_encode($processed_data);
   $Email = $received_data['YL'];
   $Password = $received_data['YPW'];
   $stmt = $conn->prepare('SELECT * FROM `user_reg` WHERE Email =:email');
   $stmt->bindParam(':email',$Email);
   $stmt->execute();
   $Answer =[];
   if($stmt->rowcount()>0){
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if(password_verify($Password,$result['Password'])){
         
         $_SESSION['authenticated'] = true;
         $_SESSION['User_id'] = $result['RId'];
         $_SESSION['User_email'] = $result['Email'];
         $_SESSION['Username'] = $result['Nickname'];
         $Answer["isStatus"] = true;
         $stmt = $conn->prepare("SELECT*FROM `addedfile` WHERE ID_user =:user_id");
         $stmt->bindParam(':user_id',$result['RId'],PDO::PARAM_STR);
         $stmt->execute();
         $videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
         $_SESSION['video_links'] = $videos;
         echo json_encode($Answer);
         exit();
      }else{
         // echo json_encode("błędne");
      }
   }else{
      // echo json_encode("konto nie istnieje");
   }

      // if(!empty($UserLogin || $UserPassword)){

      // }
      // if(!filter_var($UserLogin,FILTER_VALIDATE_EMAIL)){

      // }
}