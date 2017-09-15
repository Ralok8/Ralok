<?php

const MAIL_SEND = 'success';
const MAIL_NO_SEND = 'failed';

if (!empty($_POST)) {
    $to = 'info@e-ralok.com'; /*info@e-ralok.com*/
    $site = 'Ralok';

    $mes = '';
    isset($_POST['email']) && $mes .= "Email: <b>{$_POST['email']}</b><br>";
    isset($_POST['name']) && $mes .= "Name: <b>{$_POST['name']}</b><br>";
    isset($_POST['country']) && $mes .= "Country: <b>{$_POST['country']}</b><br>";
    isset($_POST['subject']) && $mes .= "Subject: <b>{$_POST['subject']}</b><br>";
    isset($_POST['message']) && $mes .= "<hr>Message: <b>{$_POST['message']}</b>";

    $sub = '=?utf-8?B?' . base64_encode($site) . '?=';
    echo send_mail($to, $sub, $mes, $site . ' <info@e-ralok.com>') ? MAIL_SEND : MAIL_NO_SEND;
}

function send_mail($to, $thm, $html, $from)
{
    $boundary = "--" . md5(uniqid(time()));

    $headers = "MIME-Version: 1.0\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\n";
    $headers .= 'From: ' . $from . '';

    $multipart = "--$boundary\n";
    $multipart .= "Content-Type: text/html; charset=utf8\n";
    $multipart .= "Content-Transfer-Encoding: Quot-Printed\n\n";
    $multipart .= "$html\n\n";

    if (mail($to, $thm, $multipart, $headers)) {
		return true;
	}
	$e_info = error_get_last();
	echo $e_info["type"].' - '.$e_info["message"].' - '.$e_info["file"].' - '.$e_info["line"].' - ';
	return false;
}
?>