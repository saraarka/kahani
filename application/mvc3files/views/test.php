<?php set_include_path("." . PATH_SEPARATOR . ($UserDir = dirname($_SERVER['DOCUMENT_ROOT'])) . "/pear/php" . PATH_SEPARATOR . get_include_path());
    require_once "Mail.php";
    $host = "ssl://smtp.gmail.com";
    $username = AEMAIL_SIGNUP;
    $password = AEMAIL_PASSWORD;
    $port = "465";
    $email_from = ADMIN_EMAIL;
    $content = "text/html; charset=utf-8";
    $email_subject = 'Activate Story Carry User Registration';
    $email_body = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> <a href="'.base_url().'welcome/verify/'.md5($to_email).'"> Click Here </a> (or)<br />Copy the link below<br />'.base_url().'welcome/verify/'.md5($to_email).'<br /><br />Thanks<br />Story Carry';
    $email_address = AEMAIL_SIGNUP;
    $headers = array ('From' => $email_from, 'To' => $to_email, 'Subject' => $email_subject, 'Reply-To' => $email_address, 'Content-type' => $content);
    $smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));
    $mail = $smtp->send($to_email, $headers, $email_body);
    if (PEAR::isError($mail)) {
        
    } else {
        
    }
?>