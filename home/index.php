<?php
$SER_ROOT = "..";
$TITLE = "Telegonus";
$PAGE_ID = "home";

include $SER_ROOT."/modules/header.php";
include $SER_ROOT."/modules/navbar.php";

// require_once $SER_ROOT."/config/Logger.php";
require_once $SER_ROOT."/service/AccessLog.php";

?>
<style type="text/css">
</style>
<section class="section">
	<div class="container">
		<h1 class="title">
			Home
		</h1>
		<p class="subtitle">
			Control & View status of <strong class="brand-font is-size-4">Telegonus</strong> from here! 
		</p>
		<div class="columns">
			<div class="column">
				<div class="box has-text-centered">
					<div id="browser-piechart"></div>
				</div>
			</div>
			<div class="column">
				<div class="box has-text-centered">
					<div id="os-piechart"></div>
				</div>
			</div>
		</div>
		<div class="columns">
			<div class="column">
				<div class="box has-text-centered">
					<div id="dailyrequests-linechart"></div>
				</div>
			</div>
		</div>
		<div class="columns">
			<div class="column">
				<div class="box has-text-centered">
					<div>
						<p class="heading">Total Hits</p>
						<p class="title"><?=$accessLogObj->getTotalHits()?></p>
					</div>
				</div>
			</div>
			<div class="column">
				<div class="box has-text-centered">
					<div>
						<p class="heading">Unique Hits</p>
						<p class="title"><?=$accessLogObj->getUniqueHits()?></p>
					</div>
				</div>
			</div>
			<div class="column">
				<div class="box has-text-centered">
					<div>
						<p class="heading">Browsers</p>
						<p class="title" id="browser-count-display">0</p>
					</div>
				</div>
			</div>
			<div class="column">
				<div class="box has-text-centered">
					<div>
						<p class="heading">Operating Systems</p>
						<p class="title" id="os-count-display">0</p>
					</div>
				</div>
			</div>
		</div>
		<div class="box">
			<h4 class="title is-4">Genuine Fingerprints</h4>
			<table class="table is-hoverable is-fullwidth">
				<thead>
					<tr>
						<th>#</th>
						<th>OS</th>
						<th>Browser</th>
						<th>Canvas MD5 Hash</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$uniqueLogs = json_decode($accessLogObj->getAllUniqueLogs(), true);
				$index = 1;
				foreach ($uniqueLogs as $log) {
					if ($log == array() || is_null($log))
						continue;
				?>
				<tr>
					<td><?=$index++?></td>
					<td data-osname="<?=$log['osname']?>"><?=$log['osname']?> <?=$log['osversion']?></td>
					<td data-browsername="<?=$log['browsername']?>"><?=$log['browsername']?> <?=$log['browserversion']?></td>
					<td><?=$log['canvashash']?></td>
				</tr>
				<?php
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</section>
<script type="text/javascript" src="<?=$SER_ROOT?>/js/loader.js"></script>
<script>
	function formatDate(date) {
		date = new Date(date);
		var monthNames = [
			"Jan", "Feb", "Mar",
			"Apr", "May", "Jun", "Jul",
			"Aug", "Sep", "Oct",
			"Nov", "Dec"
		];

		var day = date.getDate();
		var monthIndex = date.getMonth();

		return day + ' ' + monthNames[monthIndex];
	}

	function drawMainPieChart(chartData, canvasId, chartTitle) {
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {

			var data = google.visualization.arrayToDataTable(chartData);

			var options = {
				title: chartTitle,
				pieHole: 0.3,
				chartArea: {
					width: '100%',
					height: '100%'
				}
			};

			var chart = new google.visualization.PieChart(document.getElementById(canvasId));

			chart.draw(data, options);
		}
	}

	function drawLineChart(chartData, canvasId, chartTitle) {
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {

			var data = google.visualization.arrayToDataTable(chartData);

			var options = {
			          title: chartTitle,
			          curveType: 'function',
			          legend: { position: 'bottom' }
			        };

			        var chart = new google.visualization.LineChart(document.getElementById(canvasId));

			        chart.draw(data, options);
		}
	}


	$(document).ready(function() {
		var browserDistData = JSON.parse('<?=$accessLogObj->getBrowserDist()?>');
		browserChartData = [['Browser', 'Count']];
		for (i in browserDistData)
			browserChartData.push([browserDistData[i].browsername, parseInt(browserDistData[i].count)]);
		console.log(browserChartData);
		drawMainPieChart(browserChartData, 'browser-piechart', 'User Browser distribution')

		var osDistData = JSON.parse('<?=$accessLogObj->getOsDist()?>');
		osChartData = [['OS', 'Count']];
		for (i in osDistData)
			osChartData.push([osDistData[i].osname, parseInt(osDistData[i].count)]);
		drawMainPieChart(osChartData, 'os-piechart', 'User OS distribution')

		$('#browser-count-display').html(browserChartData.length-1);
		$('#os-count-display').html(osChartData.length-1);

		var dailyHitsData = JSON.parse('<?=$accessLogObj->getDailyHits()?>');
		console.log(dailyHitsData);
		var dailyHitsChartData = [['Date', 'Hits']];
		for (i in dailyHitsData)
			dailyHitsChartData.push([formatDate(dailyHitsData[i].date), parseInt(dailyHitsData[i].hits)]);
		console.log(dailyHitsChartData);
		drawLineChart(dailyHitsChartData, 'dailyrequests-linechart', 'Daily Hits')
		
	});
	

</script>
<?php
include $SER_ROOT."/modules/footer.php";
?>