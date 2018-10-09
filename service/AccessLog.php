<?php 
require_once __DIR__."/../vendor/autoload.php";

use UserAgentParser\Exception\NoResultFoundException;
use UserAgentParser\Provider\WhichBrowser;

/**
 * 
 */
class AccessLog {

	function __construct() {
		$this->whichBrowser = new WhichBrowser();
	}
	
	function logUser($userAgent, $canvasHash, $resHeight, $resWidth, $colorDepth, $lang, $timeZone) {

		require __DIR__."/Connection.php";

		$uaparserObj = $this->whichBrowser->parse($userAgent);

		if ($uaparserObj->isBot()) {
			$browserName = $uaparserObj->getBot()->getName();
			$browserVersion = "";
			$osName = $uaparserObj->getBot()->getName();
			$osVersion = "";

		} else {
			$browserName = $uaparserObj->getBrowser()->getName();
			$browserVersion = $uaparserObj->getBrowser()->getVersion()->getComplete();
			$osName = $uaparserObj->getOperatingSystem()->getName();
			$osVersion = $uaparserObj->getOperatingSystem()->getVersion()->getComplete();
		}

		$isGenuine = $this->hashCheck($userAgent, $canvasHash);

		$sql = "INSERT INTO `access_log` (`id`, `useragent`, `datetime`, `canvashash`, `resolutionheight`, `resolutionwidth`, `colordepth`, `language`, `timezone`, `browsername`, `browserversion`, `osname`, `osversion`, `isgenuine`) VALUES (NULL, '$userAgent', CURRENT_TIMESTAMP, '$canvasHash', '$resHeight', '$resWidth', '$colorDepth', '$lang', '$timeZone', '$browserName', '$browserVersion', '$osName', '$osVersion', $isGenuine);";

		$result = $conn->query($sql);

		if ($result == true) {
			return $isGenuine;
			// return $conn->insert_id;
		} else {
			return false;
		}
	}

	function hashCheck($userAgent, $canvasHash) {

		require __DIR__."/Connection.php";

		$uaparserObj = $this->whichBrowser->parse($userAgent);

		if ($uaparserObj->isBot()) {
			$browserName = $uaparserObj->getBot()->getName();
			$browserVersion = "";
			$osName = $uaparserObj->getBot()->getName();
			$osVersion = "";

		} else {
			$browserName = $uaparserObj->getBrowser()->getName();
			$browserVersion = $uaparserObj->getBrowser()->getVersion()->getComplete();
			$osName = $uaparserObj->getOperatingSystem()->getName();
			$osVersion = $uaparserObj->getOperatingSystem()->getVersion()->getComplete();
		}
		
		// $sql = "SELECT canvashash FROM access_log WHERE browsername='$browserName' AND browserversion='$browserVersion' AND osname='$osName' AND osversion='$osVersion'	 LIMIT 1";
		$sql = "SELECT canvashash FROM access_log WHERE browsername='$browserName' AND browserversion='$browserVersion' AND osname='$osName' AND osversion='$osVersion' AND isgenuine=1 LIMIT 1";
		$result = $conn->query($sql);
		if ($result == false || $result->num_rows == 0) {
			/*$sql = "SELECT canvashash FROM access_log WHERE canvashash='$canvasHash' AND isgenuine=1 LIMIT 1;";
			$result = $conn->query($sql);
			if ($result == false || $result->num_rows == 0) {
				return 0;
			} else {
				return 2;
			}*/
			return 0;
		} else {
			if (($result->fetch_assoc())['canvashash'] == $canvasHash)
				return 1;
			else
				return 2;
		}
	}

	function fixLog() {

		$currentLogs = json_decode($this->getAllLogs(), true);

		require __DIR__."/Connection.php";

		foreach ($currentLogs as $key => $value) {
			$id = $value['id'];
			$userAgent = $value['useragent'];

			$uaparserObj = $this->whichBrowser->parse($userAgent);

			if ($uaparserObj->isBot()) {
				$browserName = $uaparserObj->getBot()->getName();
				$browserVersion = "";
				$osName = $uaparserObj->getBot()->getName();
				$osVersion = "";

			} else {
				$browserName = $uaparserObj->getBrowser()->getName();
				$browserVersion = $uaparserObj->getBrowser()->getVersion()->getComplete();
				$osName = $uaparserObj->getOperatingSystem()->getName();
				$osVersion = $uaparserObj->getOperatingSystem()->getVersion()->getComplete();
			}
			
			$sql = "UPDATE access_log SET browsername='$browserName', browserversion='$browserVersion', osname='$osName', osversion='$osVersion' WHERE id=$id";
			$result = $conn->query($sql);
			echo $result ? 1 : 0;
		}
	}

	function getAllLogs() {

		require __DIR__."/Connection.php";
		
		$sql = "SELECT * FROM `access_log` ORDER BY datetime DESC";

		$result = $conn->query($sql);

		$row = array();
		while ($r=$result->fetch_assoc()) {
			$row[] = $r;
		}
		$conn->close();

		return json_encode($row);
	}

	function getBrowserDist() {

		require __DIR__."/Connection.php";

		$sql = "SELECT browsername, COUNT(*) as count FROM `access_log` WHERE isgenuine=1 GROUP BY browsername";

		$result = $conn->query($sql);

		$row = array();
		while ($r=$result->fetch_assoc()) {
			$row[] = $r;
		}
		$conn->close();

		return json_encode($row);
	}

	function getOsDist() {

		require __DIR__."/Connection.php";

		$sql = "SELECT osname, COUNT(*) as count FROM `access_log` WHERE isgenuine=1 GROUP BY osname";

		$result = $conn->query($sql);

		$row = array();
		while ($r=$result->fetch_assoc()) {
			$row[] = $r;
		}
		$conn->close();

		return json_encode($row);
	}

	function getTotalHits() {
		require __DIR__."/Connection.php";
		
		$sql = "SELECT id FROM `access_log`";

		$result = $conn->query($sql);

		if ($result == true)
			return $result->num_rows;
		else
			return 0;
	}

	function getUniqueHits() {
		require __DIR__."/Connection.php";
		
		$sql = "SELECT osname, osversion, browsername, browserversion, canvashash FROM access_log WHERE isgenuine=1 GROUP BY canvashash, browsername, browserversion, osname, osversion";

		$result = $conn->query($sql);

		if ($result == true)
			return $result->num_rows;
		else
			return 0;
	}

	function getDailyHits() {

		require __DIR__."/Connection.php";
		
		$sql = "SELECT DATE(datetime) AS date, COUNT(*) AS hits FROM access_log GROUP BY DATE(datetime) ORDER BY date";

		$result = $conn->query($sql);

		$row = array();
		while ($r=$result->fetch_assoc()) {
			$row[] = $r;
		}
		$conn->close();

		return json_encode($row);
	}

	function getAllUniqueLogs() {
		
		require __DIR__."/Connection.php";
		
		$sql = "SELECT osname, osversion, browsername, browserversion, canvashash FROM access_log WHERE isgenuine=1 GROUP BY canvashash, browsername, browserversion, osname, osversion ORDER BY osname, osversion, browsername, browserversion";

		$result = $conn->query($sql);

		$row = array();
		while ($r=$result->fetch_assoc()) {
			$row[] = $r;
		}
		$conn->close();

		return json_encode($row);
	}
}

$accessLogObj = new AccessLog();
// $accessLogObj->fixLog();
?>