<?php 


//helper functions 

function clean($string){
     return htmlentities($string);
}

function set_message($message){
     if(!empty($message)){
          $_SESSION['message'] = $message;
     }else{
          $message = "";
     }
}

function display_message(){
     if(isset($_SESSION['message'])){
          echo $_SESSION['message'];
          unset($_SESSION['message']);
     }
}

function token_generator(){
     $token = $_SESSION['token'] = md5(uniqid(mt_rand(),true));
     return $token;
}

//validate functions


function validate_user_registration(){
     if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $first_name = escape(clean($_POST['first_name']));
          $last_name = escape(clean($_POST['last_name']));
          $username = escape(clean($_POST['username']));
          $email = escape(clean($_POST['email']));
          $password = escape(clean($_POST['password']));

          $password = md5($password);
          $validation = md5($username . microtime());

          $query = "INSERT INTO users(first_name, last_name, username, email, password, validation_code, active) VALUES ('$first_name','$last_name','$username', '$email', '$password', '$validation',0)";
          $result = query($query);
          confirm($result);
          set_message("Please check your email or spam folder for activation link. <br><small><a href='http://localhost/login/activate.php?email=$email&code=$validation'>GOTO VALIDATION PAGE</a></small>");
          //send mail

          $subject = "Activating account";
          $msg = "
               Please click the link to activate your account
               http://localhost/login/activate.php?email=$email&code=$validation
          ";
          $headers = "From: something@yourwebsite.com";

          mail($email, $subject, $msg, $headers);
          header("Location: index.php");
     }
}

?>