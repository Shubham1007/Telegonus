<?php
if (isset($_POST) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	require_once __DIR__.'/service/AccessLog.php';

	$userAgent = $_SERVER['HTTP_USER_AGENT'];
	$canvasHash = $_POST["canvasHash"];

	$result = $accessLogObj->hashCheck($userAgent, $canvasHash);

	echo $result;
}
?>