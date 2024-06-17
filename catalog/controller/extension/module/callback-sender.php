<?php
$email = (string)$_GET['email'];
$name = $_SERVER['HTTP_HOST'];
if($name=='') $name='callback.net';
if($email!=''){
	if((isset($_GET['phone'])&&$_GET['phone']!="")){
			$to = $email;
			$subject = 'CALLBACK';
			$message = '
					<html>
						<head>
							<title>'.$subject.'</title>
						</head>
						<body>
							<h3>'.$_GET["name"].'</h3>
							<h2>'.$_GET["phone"].'</h2>
						</body>
					</html>';
			$headers  = "Content-type: text/html; charset=utf-8 \r\n";
			$headers .= "From: ".$name." <from@".$name.">\r\n";
			mail($to, $subject, $message, $headers);
	}
}
?>