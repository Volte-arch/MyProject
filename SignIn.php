<?php
require_once __DIR__.'/vendor/autoload.php';
require_once('./DB/ini.php');
// use Exception;
// use MongoDB\Client;
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

         $_SESSION['status'] = 'authorization';
         $_SESSION['User_id'] = $result['RId'];
         $_SESSION['Type_Account'] = $result['T_Account'];
         $_SESSION['User_email'] = $result['Email'];
         $_SESSION['Username'] = $result['Nickname'];
         $Answer["status"] = $_SESSION['status'];

         $sessionToken = bin2hex(random_bytes(32));
         $device_name = $_SERVER['HTTP_USER_AGENT'];
         $userIP = $_SERVER['REMOTE_ADDR'];
         
         $sessionuser = $conn->prepare("INSERT INTO user_sessions ( `user_id`, `session_token`,`active_session`, `user_agent`, `ip_address`) VALUES (:user_id,:session_token,:active,:user_Agent,:IP_Him)");
         $sessionuser->execute([
            ':user_id'=>$_SESSION['User_id'],
            ':session_token'=>$sessionToken,
            ':active'=>true,
            ':user_Agent'=>$device_name,
            ':IP_Him'=>$userIP,
         ]);
         $_SESSION['Session_token'] = $sessionToken;
         $stmt = $conn->prepare("SELECT*FROM `addedfile` WHERE ID_user =:user_id");
         $stmt->bindParam(':user_id',$result['RId'],PDO::PARAM_STR);
         $stmt->execute();
         $videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
         $_SESSION['video_links'] = $videos;
         echo json_encode($Answer);
         exit();
      }else{
         echo json_encode(["Error"=>"errorEmailorpass"]);
      }
   }else{
      echo json_encode(["ErrorAccount"=>"notAAccount"]);
   }

      // if(!empty($UserLogin || $UserPassword)){

      // }
      // if(!filter_var($UserLogin,FILTER_VALIDATE_EMAIL)){

      // }
}