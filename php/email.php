<?php

    $array = array("email" => "", "emailError" => "", "isSuccess" => false);
    /*$emailTo = "contact@johntaieb.com";*/
    $emailTo = "jeanmariekouassi70@gmail.com";

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        $array["email"] = test_input($_POST["email"]);
        $array["isSuccess"] = true; 
        $emailText = "";
        

        

        if(!isEmail($array["email"])) {
            $array["emailError"] = "T'essaies de me rouler ? C'est pas un email ça  !";
            $array["isSuccess"] = false; 
        } else {
            $emailText .= "Email: {$array['email']}\n";
        }


        
        if($array["isSuccess"]) {
            $headers = "From: {$array['email']} \r\nReply-To: {$array['email']}";
            mail($emailTo, "Un message de votre site", $emailText, $headers);
        }
        
        echo json_encode($array);    
    }

    function isEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    function isPhone($phone) {
        return preg_match("/^[0-9 ]*$/",$phone);
    }
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
 
?>


