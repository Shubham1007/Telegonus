<?php
if (isset($_POST) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	require_once __DIR__.'/service/AccessLog.php';

	$userAgent = $_SERVER['HTTP_USER_AGENT'];
	$canvasHash = $_POST["canvasHash"];
	$resHeight = $_POST["resHeight"];
	$resWidth = $_POST["resWidth"];
	$colorDepth = $_POST["colorDepth"];
	$lang = $_POST["lang"];
	$timeZone = $_POST["timeZone"];

	$result = $accessLogObj->logUser($userAgent, $canvasHash, $resHeight, $resWidth, $colorDepth, $lang, $timeZone);

	echo $result;
}
?>