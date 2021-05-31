<?php
		$name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
		
        $message = $_POST['message'];
		
        $toemail = 'muhammadbilaliqbal98@gmail.com';
        $toname = 'Test Email';
		
		$subject = "Website Information - ".$name;
		$body = "$name $email $phone $message";
		
		mail($toemail, $subject, $body,"From: $email")
 
?>