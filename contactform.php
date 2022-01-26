<?php

//variable setup, get from form, etc
$name = $_POST['name_first'] + $_POST['name_last'];
$pronouns = $_POST['pronouns'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];

$email_from = 'richard.nakatsuka@gmail.com';
$email_subject = "New Form Submission via Portfolio Website";
$email_body = "You have received a new message from: $name.\n Preffered pronouns: $pronouns.\n Message: $message"

$to = "richard.nakatsuka@gmail.com";
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";

//header validation against spam etc
function IsInjected($str)
{
    $injections = array('(\n+)',
           '(\r+)',
           '(\t+)',
           '(%0A+)',
           '(%0D+)',
           '(%08+)',
           '(%09+)'
           );

    $inject = join('|', $injections);
    $inject = "/$inject/i";

    if(preg_match($inject,$str))
    {
      return true;
    }
    else
    {
      return false;
    }
}
//call header validation and quit if necessary
if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}

//if not, send email
mail($to,$email_subject,$email_body,$headers);

?>
