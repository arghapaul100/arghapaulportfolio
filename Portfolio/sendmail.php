<?php
		include 'database/insert.php';
		include 'database/search.php';

		$jsonDecode = (array)json_decode($_POST['jsonData']);
		$name = $email= $subject = $body =$message="";
		$name = $jsonDecode['name'];
		$email = $jsonDecode['email'];
		$subject = $jsonDecode['subject'];
		$body = $jsonDecode['body']; 
		$currentTime = $jsonDecode['currentTime'];
		$currentDate = date('l d').' th '.date('F Y')." at ";
		$CurrentdateAndTime = $currentDate.$currentTime;
		$device_addr = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		$device_name = gethostbyname($device_addr);
		require 'PhpMailer/PHPMailerAutoload.php';
		$search = search($email);
		if($search==1){

			$mail = new PHPMailer;
			$mail2 = new PHPMailer;

			$mail->isSMTP();                                     
			$mail->Host = 'smtp.gmail.com'; 
			$mail->SMTPAuth = true;                               
			$mail->Username = 'mailserveraddress@gmail.com';     
			$mail->Password = 'xxxxxxxxxxxx';            
			$mail->SMTPSecure = 'tls';                            
			$mail->Port = 587;  

			$mail2->isSMTP();                                     
			$mail2->Host = 'smtp.gmail.com'; 
			$mail2->SMTPAuth = true;                               
			$mail2->Username = 'mailserveraddress@gmail.com';
			$mail2->Password = 'xxxxxxxxxxx';                   
			$mail2->SMTPSecure = 'tls';                            
			$mail2->Port = 587; 

			$mail->setFrom($email," From Your Portfolio Site By ".$name);
			$mail->addAddress('yourgmail@gmail.com', 'your name');

			$mail2->setFrom('mailserveraddress@gmail.com',"your Portfolio");
			$mail2->addAddress($email, $name); 


			$mail->isHTML(true);
			$mail2->isHTML(true);                             

			$mail->Subject = $subject;
			$mail->Body    = $body;

			$mail2->Subject = 'Hello '.$name;
			$mail2->Body    = '<b>Thank you for again contact me</b>';

			if(!$mail->send() || !$mail2->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
				echo 'Mailer Error: ' . $mail2->ErrorInfo;
			} else {
				echo connect($name,$email,$subject,$body,$CurrentdateAndTime,$device_name,$device_addr);
				$message = 'Message has been sent';
				echo $message;
			}
		}else{
			$mail = new PHPMailer;
			$mail2 = new PHPMailer;

			$mail->isSMTP();                                     
			$mail->Host = 'smtp.gmail.com'; 
			$mail->SMTPAuth = true;                               
			$mail->Username = 'mailserveraddress@gmail.com';          
			$mail->Password = 'xxxxxxxxxxxx';                         
			$mail->SMTPSecure = 'tls';                            
			$mail->Port = 587;  

			$mail2->isSMTP();                                     
			$mail2->Host = 'smtp.gmail.com'; 
			$mail2->SMTPAuth = true;                               
			$mail2->Username = 'mailserveraddress@gmail.com'; 
			$mail2->Password = 'xxxxxxxxxxx';                      
			$mail2->SMTPSecure = 'tls';                            
			$mail2->Port = 587; 

			$mail->setFrom($email," From Your Portfolio Site By ".$name);
			$mail->addAddress('yourgmail@gmail.com', 'your name');

			$mail2->setFrom('yourgmail@gmail.com',"your Portfolio");
			$mail2->addAddress($email, $name);


			$mail->isHTML(true);
			$mail2->isHTML(true);                             

			$mail->Subject = $subject;
			$mail->Body    = $body;

			$mail2->Subject = 'Hello '.$name;
			$mail2->Body    = '<b>Thank you for contact me</b>';

			if(!$mail->send() || !$mail2->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
				echo 'Mailer Error: ' . $mail2->ErrorInfo;
			} else {
				echo connect($name,$email,$subject,$body,$CurrentdateAndTime,$device_name,$device_addr);
				$message = 'Message has been sent';
				echo $message;
			}
	}
?>
