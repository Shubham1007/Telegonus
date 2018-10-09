<?php
$SER_ROOT = "..";
$TITLE = "History - Telegonus";
$PAGE_ID = "history";

include $SER_ROOT."/modules/header.php";
include $SER_ROOT."/modules/navbar.php";

// require_once $SER_ROOT."/config/Logger.php";
require_once $SER_ROOT."/service/AccessLog.php";
?>

<section class="section">
	<div class="container">
		<h1 class="title">
			History
		</h1>
		<p class="subtitle">
			View attempts to access the fingerprint service from here.
		</p>
		<div class="box">
		<!-- <div class="card-content"> -->
			<table class="table is-hoverable is-fullwidth">
				<thead>
					<tr>
						<th>#</th>
						<th>TD</th>
						<th>OS</th>
						<th>Browser</th>
						<th>Canvas MD5 Hash</th>
						<th>Safety Class</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$allLogs = json_decode($accessLogObj->getAllLogs(), true);
					$index = 1;
					foreach ($allLogs as $log) {
						if ($log == array() || is_null($log))
							continue;
					?>
					<tr>
						<td><?=$index++?></td>
						<td><?=$log['datetime']?></td>
						<td data-osname="<?=$log['osname']?>"><?=$log['osname']?> <?=$log['osversion']?></td>
						<td data-browsername="<?=$log['browsername']?>"><?=$log['browsername']?> <?=$log['browserversion']?></td>
						<td><?=$log['canvashash']?></td>
						<td class="get-safety-class"><?=$log['isgenuine']?></td>
					</tr>
					<?php
					}
					?>
				</tbody>
			</table>	
		</div>
	</div>
</section>
<?php
include $SER_ROOT."/modules/footer.php";
?>