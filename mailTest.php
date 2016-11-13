<?php
	$to      = "7572856793@tmomail.net";
	$subject = 'the subject';
	$message = 'hello';
	$headers = 'From: r@chhura.com' . "\r\n" .
		'Reply-To: r@chhura.com' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message, $headers);
	
	echo $to . " - " . $headers;
?>