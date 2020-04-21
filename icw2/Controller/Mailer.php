<?php
class Mailer{
    
    
    public function sendTestEmail(){
      
        require_once 'ThirdPartyScripts/PhpMailer/PHPMailerAutoload.php';
        
        
        $mail = new PHPMailer();
        $mail->IsSMTP(); // enable SMTP
        
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "testmailplan12@gmail.com";
        $mail->Password = "sudocrem12";
        $mail->SetFrom("testmailplan12@gmail.com");
        $mail->Subject = "VERIFICATION EMAIL - Plan it";
        $mail->Body =
        "<h3>Please verify your new account by clicking this link below </h3>
	`<br>
	<a href=localhost\\ROOT-LOGIN-X1\\verify_user.php?vkey=$vkey>click me! * LOCAL HOST SPECIFIC CHANGE LATER * </a>
	";
        
        
        $email = "asim1289@gmail.com";
        
        
        $mail->AddAddress($email);
        
        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message has been sent";
        }
        
        
    }
    
    
}

?>