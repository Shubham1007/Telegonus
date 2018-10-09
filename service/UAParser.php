<?php
require_once __DIR__."/../vendor/autoload.php";

use UserAgentParser\Exception\NoResultFoundException;
use UserAgentParser\Provider\WhichBrowser;

$whichBrowser = new WhichBrowser();
$uaparserObj = $whichBrowser->parse($_SERVER['HTTP_USER_AGENT']);

?>