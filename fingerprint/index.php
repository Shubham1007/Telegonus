<?php
$SER_ROOT = "..";
$TITLE = "Fingerprint - Telegonus";
$PAGE_ID = "fingerprint";

include $SER_ROOT."/modules/header.php";
include $SER_ROOT."/modules/navbar.php";

require_once $SER_ROOT."/service/AccessLog.php";
require_once $SER_ROOT."/service/UAParser.php";
?>
<script type="text/javascript" src="<?=$SER_ROOT?>/js/utils.js"></script>
<script type="text/javascript" src="<?=$SER_ROOT?>/js/fingerprint.js"></script>
<section class="section">
	<div class="container">
		<h1 class="title">
			Fingerprint
		</h1>
		<p class="subtitle">
			Get your device's fingerprints and other details here
		</p>
	</div>
</section>
<section class="section">
	<div class="container">	
		<div class="box">
			Your UserAgent is <code><?=$_SERVER['HTTP_USER_AGENT']?></code>.<br>
			<?php if ($uaparserObj->isBot()) { ?>
			Your are a bot.
			<?php } else { ?>
			You are using <strong><?=$uaparserObj->getBrowser()->getName()?> <?=$uaparserObj->getBrowser()->getVersion()->getComplete()?></strong> on <strong><?=$uaparserObj->getOperatingSystem()->getName()?> <?=$uaparserObj->getOperatingSystem()->getVersion()->getComplete()?></strong>.<br>
			Your Rendering Engine is <strong><?=$uaparserObj->getRenderingEngine()->getName()?></strong>.<br>
			Your canvas fingerprint is <strong class="device-canvas"></strong>.<br>
			<div class="device-genuine-check"></div>
			<?php } ?>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function() {
		var canvasHash = getCanvasHash();
		
		$('.device-canvas').html(canvasHash);

		$.ajax({
			url: "<?=$SER_ROOT?>/hashcheck.php",
			type: 'POST',
			data: {
				canvasHash: canvasHash
			},
			success: function(result) {
				console.log(result);

				var hashCheckResult;
				
				if (result == 0) {
					hashCheckResult = "Your device's fingerprint has not been registered yet on our database.<br>";
				} else if (result == 1) {
					hashCheckResult = "Your device has been classified as <strong class='has-text-success'>Safe</strong>.<br>"
				} else {
					hashCheckResult = "Your device has been classified as <strong class='has-text-danger'>Unsafe</strong>.<br>"
				}

				$('.device-genuine-check').html(hashCheckResult);
			}
		});

		logUser("<?=$SER_ROOT?>/add2log.php", canvasHash, getResolutionHeight(), getResolutionWidth(), getColorDepth(), getLanguage(), getDateandTime());


	});
</script>
<?php
include $SER_ROOT."/modules/footer.php";
?>