<?php

require_once('phpmailer/PHPMailerAutoload.php');

$mail = new PHPMailer();
$mail->SMTPDebug=0;
$mail->isSMTP(); 
$mail->Host = 'sg2plcpnl0050.prod.sin2.secureserver.net';
$mail->SMTPAuth = true; 
$mail->Username = 'p7a16lphd74y';
$mail->Password = 'Sridin@1906';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->isHTML(true);
$mail->setFrom('admin@yuwa-internal.xyz', 'Pablo');
?>