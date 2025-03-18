<?php
require_once __DIR__.'/vendor/autoload.php';
require_once('./DB/ini.php');

// use Exception;
// use Firebase\JWT\JWT;
// use Firebase\JWT\Key;
// use MongoDB\Client;


    header('Content-Type: application/json; charset=utf-8');
    if($_SERVER['REQUEST_METHOD']=="GET"){
        $GenerateSignUp = '
        <link rel="stylesheet" href="index.css">
        <div class="Sign-up-Form">
        <form class="Re">
            <div class="boxfirst">
                <input type="text" name="Email" placeholder="E-mail">
                <input type="text" name="Phone" placeholder="Phone not required">
            </div>
            <input type="text" name="Nickname" placeholder="Nickname">
            <div class="boxsecond">
                <input type="password" name="password" placeholder="Password">
                <input type="password" name="repeatPassword" placeholder="Repeat password">
            </div>
            <div class="checkboxs">
                <input type="checkbox" name="acceptTerms" value="accept">
                <p>Zapoznałem się i akceptuję regulamin strony  <a href="" class="">Link do regulaminu</a>. Oświadczam, że rozumiem jego treść i zobowiązuję się do jego przestrzegania.</p>
            </div>
            <button type="submit" class="Sign_up" name="Sign_up">Sign up</button>
        </form>
    </div>';
    echo $GenerateSignUp;
    }elseif($_SERVER["REQUEST_METHOD"]=="POST"){
        $conn = connect();
        try{
            $Error = [];
            $Messages = [];
            $result_Account = [];
            $received_data = json_decode(file_get_contents('php://input'), true);
            $Email = htmlspecialchars($received_data['Email']);
            $Phone = htmlspecialchars($received_data['Phone']);
            $Nickname = htmlspecialchars($received_data['Nickname']);
            $password = htmlspecialchars($received_data['password']);
            $passwordConfirm = htmlspecialchars($received_data['repeatPassword']);

            $checkEmail = $conn->prepare("SELECT * FROM `user_reg` WHERE Email=:email");
            $checkEmail->bindParam(':email',$Email,PDO::PARAM_STR);
            $checkEmail->execute();
            $fetchEmail = $checkEmail->fetchAll(PDO::FETCH_ASSOC);
            if(empty($Email)){
                $Messages['CheckEmail'] = "problem";
                $Error['Email'] = "The e-mail don't be empty";
            }elseif(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
                $Messages['CheckEmail'] = "problem";
                $Error['Email'] = "The e-mail is incorrect!.";
            }elseif(count($fetchEmail)>0){
                $Messages['CheckEmail'] = "problem";
                $Error['Email'] = "the e-mail is taken!";
            }

            $checkNickname = $conn->prepare("SELECT * FROM `user_reg` WHERE Nickname=:nick");
            $checkNickname->bindParam(':nick',$Nickname,PDO::PARAM_STR);
            $checkNickname->execute();
            $fetchNick = $checkNickname->fetchAll(PDO::FETCH_ASSOC);
            if(empty($Nickname)){
                $Error['Nickname'] = "The Nickname don't be empty.";
                $Messages['CheckNickname'] = "problem";
            }elseif(count($fetchNick)>0){
                $Error['Nickname'] = "The Nickname is taken.";
                $Messages['CheckNickname'] = "problem";
            }else{
                $Messages['Status-Nickname'] = "Nickname OK.";
            }

            if($password === $passwordConfirm && strlen($password)>0){
                $Messages['Password'] = "Password is correct (comfirmed)";
            }else{
                $Messages['CheckPassword'] = "problem";
                $Error['Password'] = "The password is too short or incorrect.";
            }

            if(isset($received_data['acceptTerms'])){
                $AcceptTermss = $received_data['acceptTerms'];
                $Messages['Status-Accept-Terms'] = "Checkbox has acception, thank you";
                $Acception = true;
            }else{
                $Error['AcceptTerms'] = "Require that acception a terms";
                $Error['AcceptTerm'] = "RqAccept";
            }
            // checking if are any errors
            if(!empty($Error)){
                // foreach($Error as $field =>$Errors){
                // }
                // $jsonData = json_encode($Error);
                // echo $jsonData;
                // foreach($Messages as $mess=>$mess){
                //     $jsonDataM = json_encode($Messages);
                // }
                // echo json_encode($Messages);
                $result_Message = array_merge($Error, $Messages);
                echo json_encode($result_Message);
            }else{
                $Add_date = date('Y-m-d H:i:s');
                $RID = bin2hex(random_bytes(4));
                $PW_hash = password_hash($password, PASSWORD_ARGON2ID);
                $Sql = "INSERT INTO user_reg (`RId`,`T_Account`,`Nickname`, `Email`, `Password`, `AcceptTerms`, `Date_Created`) VALUES (:rid,:T_A,:nick,:email,:upass,:AcceptTerms,:adate)";
                $stmt = $conn->prepare($Sql);
                $stmt->bindValue(':rid', $RID,PDO::PARAM_STR);
                $stmt->bindValue(':T_A','user',PDO::PARAM_STR);
                $stmt->bindValue(':nick', $Nickname,PDO::PARAM_STR);
                $stmt->bindValue(':email', $Email, PDO::PARAM_STR);
                $stmt->bindValue(':upass', $PW_hash, PDO::PARAM_STR);
                $stmt->bindValue(':AcceptTerms', $Acception, PDO::PARAM_INT);
                $stmt->bindValue(':adate', $Add_date, PDO::PARAM_STR);
                $stmt->execute();
                $result_Account["Status"] = "The account has been create";
                $result_Account["isStatus"]= true;

                // connection too with second Data-Base: MongoDB
        // try{
            // $collection_User = $client->testing->User_registered;
            // $result = $collection_User->insertOne([
            //     "RID"=>$RID,
            //     "Nickname"=>$Nickname,
            //     "Email"=>$Email,
            //     "password"=>$PW_hash,
            //     "AcceptTerms"=>$Acception,
            //     "Confirm_Email"=>null,
            //     "Date_Created"=>$Add_date
            // ]);
            // $result_Account["MongoDb"]= "Ok.";
            session_start(); 
            $_SESSION['User_id'] = $RID;
            $_SESSION['Type_Account'] = 'user';
            $_SESSION['Username'] = $Nickname;
            $_SESSION['status'] = 'authorization';
            $_SESSION['User_email'] = $Email;
            $_SESSION['video_links']= null;

            $sessionToken = bin2hex(random_bytes(32));
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            $userIP = $_SERVER['REMOTE_ADDR'];
            $_SESSION['Session_token'] = $sessionToken;
            $sessionuser = $conn->prepare("INSERT INTO user_sessions ( `user_id`, `session_token`,`active_session`, `user_agent`, `ip_address`) VALUES (:user_id,:session_token,:active,:user_Agent,:IP_Him)");
            $sessionuser->execute([
                ':user_id'=>$_SESSION['User_id'],
                ':session_token'=>$sessionToken,
                ':active'=>true,
                ':user_Agent'=>$userAgent,
                ':IP_Him'=>$userIP,
            ]);
        // }catch(Exception $e){
        //     printf($e->getMessage());
        // }
        echo json_encode($result_Account);
    
                }
            // it after checking data and adding account to data base refresh without loading page 
            // if($password>0){
            //     echo json_encode("the password is short");
            // }else{
            //     echo json_encode("the password is good");

            // }
            // Przykładowe przetwarzanie danych
            // $processed_data = array("Data" =>$received_data);
            // $Answer = array_merge($processed_data,$AddAccunt);
            // echo json_encode($Answer);
            
            // Zwracamy przetworzone dane
        }catch(PDOException $e){
            $responseAnser = ["Status"=>"error","Problem"=>"Problems with register an account".$e->getMessage()];
            echo json_encode($responseAnser);
        }
        
        
    
    }

    