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
		
		$mail = new PHPMailer;
		$mail2 = new PHPMailer;

		$mail->isSMTP();                                     
		$mail->Host = 'smtp.gmail.com'; 
		$mail->SMTPAuth = true;                               
		$mail->Username = 'mailserveraddress';             
		$mail->Password = 'mailserverpass';                         
		$mail->SMTPSecure = 'tls';                            
		$mail->Port = 587;  

		$mail2->isSMTP();                                     
		$mail2->Host = 'smtp.gmail.com'; 
		$mail2->SMTPAuth = true;                               
		$mail2->Username = 'mailserveraddress';       
		$mail2->Password = 'mailserverpass';               
		$mail2->SMTPSecure = 'tls';                            
		$mail2->Port = 587;

		$mail->isHTML(true);
		$mail2->isHTML(true);

        $mail->setFrom($email," From Your Portfolio Site By ".$name);
		$mail->addAddress('yourgmail@gmail.com', 'yourname');
		$mail2->setFrom('mailserveraddress.com',"your Portfolio");
		$mail2->addAddress($email, $name);

		$mail->Subject = $subject;
        $mail->Body    = '<b style="font-size:30px">'.$body.'</b>';
        $mail2->Subject = 'Hello '.$name;

        $search = search('database_field');
        
		if($search==1){
			$mail2->Body    = '<b style="font-size:30px;">Thank you for again contact me</b>';
		}else{
			$mail2->Body    = '<b stye="font-size:30px;">Thank you for contact me</b>';
	    }

        if(!$mail->send() || !$mail2->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
				echo 'Mailer Error: ' . $mail2->ErrorInfo;
		} else {
				$insert = connect('database_fields');
				if($insert==1){
					$message = 'Message has been sent';
					echo $message;
				}else{
					$message =  "We couldn't send the message";
					echo $message;
				}
		}
?>
