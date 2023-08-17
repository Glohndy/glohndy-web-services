<?php

    $array = array("name" => "", "firstname" => "", "phone" => "", "email" => "", "message" => "", "nameError" => "", "firstnameError" => "", "phoneError" => "", "emailError" => "", "messageError" => "", "isSuccess" => false);
    /*$emailTo = "contact@johntaieb.com";*/
    $emailTo = "jeanmariekouassi70@gmail.com";

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        $array["name"] = test_input($_POST["name"]);
        $array["firstname"] = test_input($_POST["firstname"]);
        $array["phone"] = test_input($_POST["phone"]);
        $array["email"] = test_input($_POST["email"]);
        $array["message"] = test_input($_POST["message"]);
        $array["isSuccess"] = true; 
        $emailText = "";
        

        if (empty($array["name"])) {
            $array["nameError"] = "Et oui je veux tout savoir. Même ton nom !";
            $array["isSuccess"] = false; 
        } else {
            $emailText .= "Name: {$array['name']}\n";
        }


        if (empty($array["firstname"])) {
            $array["firstnameError"] = "Je veux connaitre ton prénom !";
            $array["isSuccess"] = false; 
        } else {
            $emailText .= "Firstname: {$array['firstname']}\n";
        }


        if (!isPhone($array["phone"])) {
            $array["phoneError"] = "Que des chiffres et des espaces, stp...";
            $array["isSuccess"] = false; 
        } else {
            $emailText .= "Phone: {$array['phone']}\n";
        }


        if(!isEmail($array["email"])) {
            $array["emailError"] = "T'essaies de me rouler ? C'est pas un email ça  !";
            $array["isSuccess"] = false; 
        } else {
            $emailText .= "Email: {$array['email']}\n";
        }


        if (empty($array["message"])) {
            $array["messageError"] = "Qu'est-ce que tu veux me dire ?";
            $array["isSuccess"] = false; 
        } else {
            $emailText .= "Message: {$array['message']}\n";
        }
        
        if($array["isSuccess"]) {
            $headers = "From: {$array['name']} {$array['firstname']} <{$array['phone']}>\r\nReply-To: {$array['email']}";
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


