<?php
// Timezone
date_default_timezone_set('America/Los_Angeles');

// Get prev & next month
if (isset($_GET['ym'])){
	$ym = $_GET['ym'];
} else {
	// This month
	$ym = date('Y-m');
}

// Check format
$timestamp = strtotime($ym, "-01");
if ($timestamp === false){
	$timestamp = time();
}

// Today
$today = date('Y-m-d', time());

// Calendar title
$html_title = date('M / Y', $timestamp);

// prev & next month links
$prev = date('Y-m', mktime(0,0,0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0,0,0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));

// Number of days in month
$day_count = date('t', $timestamp);

// Numbering days; 0:Sun, 1:Mon, etc.
$str = date('w', mktime(0,0,0, date('m', $timestamp), 1, date('Y', $timestamp)));

// Make Calendar

$weeks = array();
$week= '';

// Add empty cell
$week .= str_repeat('<td></td>', $str);

for ($day = 1; $day <= $day_count; $day++, $str++) {
	
	$date = $ym.'-'.$day;
	
	if ($today == $date) {
		$week .= '<td class="today">'.$day;
	} else {
		$week .= '<td>'.$day;
	}
	$week .= '</td>';
	
	// End of the week or end of the month
	if ($str % 7 == 6 || $day == $day_count) {

		if ($day == $day_count) {
			// Add empty cell
			$week .= str_repeat('<td></td>', 6 - ($str % 7));
		}
		
		$weeks[] = '<tr class="clickable" data-href="www.w3schools.com/html/">'.$week.'</tr>';
		
		// Prep for new week
		$week = '';		
	}
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>Monthly Calendar</title>

	<script language="javascript">
	var elements = document.getElementsByClassName('clickable');
	for (var i = 0; i < elements.length; i++) {
		var element = elements[i];
		element.addEventListener('click', function() {
			var href = this.dataset.href;
			if (href) {
				window.location.assign(href);
			}
		}
	}
	</script>
	
	<link href='https://fonts.googleapis.com/css?family=Noto+Sans:400,700' rel='stylesheet' type='text/css'>
	
	<style>
		.container {
			font-family: 'Noto Sans, sans-serif';
			margin-top: 80px;
		}
		th {
			height: 30px;
			text-align: center;
			font-weight: 700;
		}
		td {
			height: 30px;
		}
		.today {
			background: orange;
		}
		.clickable {
			cursor: pointer;
		}
		table#t1 {
			width:15%;
		}
		table#t1 th {
			background-color: black;
			color: white;
			padding: 5px;
			text-align: left;
		}
		table#t1 td {
			padding: 5px;
			text-align: left;
		}
		table#t1 tr:nth-child(even) {
			background-color: #eee;
		}
		table#t1 tr:nth-child(odd) {
		   background-color:#fff;
		}
	</style>
	
</head>
<body>
	<div class="container">
		<h3><a href="?ym=<?php echo $prev; ?>">&lt;</a><?php echo $html_title; ?><a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
		<br>
		<table id="t1">
			<tr>
				<th>S</th>
				<th>M</th>
				<th>T</th>
				<th>W</th>
				<th>T</th>
				<th>F</th>
				<th>S</th>
			</tr>
			<?php
				foreach ($weeks as $week) {
					echo $week;
				}
			?>
		</table>
	</div>
</body>
</html>