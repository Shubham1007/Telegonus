<?php
// require_once $SER_ROOT."/check.php";
?>
<!DOCTYPE html>
<html class="has-navbar-fixed-top">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$TITLE?></title>
	
	<link rel="stylesheet" href="<?=$SER_ROOT?>/css/bulma.min.css">
	
	<script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>
	
	<script src="<?=$SER_ROOT?>/js/jquery-3.3.1.min.js"></script>
	<script src="<?=$SER_ROOT?>/js/jquery.md5.js"></script>

</head>
<body>
<style type="text/css">
	@import url('https://fonts.googleapis.com/css?family=Cinzel');

	html, body {
		height: 100%;
		background-color: transparent;
	}

	body {
		background-image: url('<?=$SER_ROOT?>/img/background.jpg');
		background-repeat: no-repeat;
		background-position: left bottom;
		background-attachment: fixed;
	}

	@media screen and (orientation:portrait) {
		body {
			background-size: contain;
		}
	}

	@media screen and (orientation:landscape) {
		body {
			background-size: 50%;
		}
	}

	.has-text-orange {
		color: #ffa500;
	}

	.brand-font {
		font-family: 'Cinzel', serif;
	}

	.is-vertical-center {
		display: flex;
		align-items: center;
	}
</style>