<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

$pages = array();
foreach(scandir("pages") as $ext) {
	$parts = explode(".", $ext);
	if ($parts[1]=="page")
		$pages[] = $parts[0]; }

$name = isset($_GET["page"]) ? $_GET["page"] : "anarchy";
if (in_array($name, $pages)) {
	$file = "pages/$name.page";
	$target = ":untargeted";
	$page = array($target=>"");
	foreach(file($file) as $line) {
		if ($line{0}==":") {
			$target=trim($line);
			$page[$target]=""; }
		else
			$page[$target].=($page[$target]?"<br>":"").trim($line); } }
else {

}
$internets = "food porn reddit hercules code computer apple microsoft money canada";
$defaults = explode(" ", $internets);
foreach($defaults as $d) $pages[]=$d;

?>

<html>
	<head>
		<style>
			table {
				width: 100%;
				height: 100%;
			}
			tr#second td:first-child {
				width: 150px;
				vertical-align: top;
			}
			tr#second td:last-child {
				width: 150px;
				vertical-align: top;
			}
			tr#title {
				text-align: center;
				height: 50px;
			}
			tr#second {
				height: 100px;
			}
			tr#third {
				height: 200px;
			}
			td#picture {
				background-color: black;
				background-size: contain;
				background-position: center center;
				background-repeat: no-repeat;
				background-image: url("<?=$page[":picture"]?>");
			}
			tr#bottom {
				height: 40px;
				text-align: center;
			}
		</style>
	</head>
	<body>
		<table>
			<tr id='title'>
				<td colspan=3>
					<h1><?=$page[":title"]?></h1>
				</td>
			</tr>
			<tr id='second'>
				<td rowspan=4>					
					<?php 
					foreach($pages as $p) {
						print "<a href='?page=$p'>".ucfirst($p)."</a><br>"; }
					?>
				</td>
				<td id='summary'><?=$page[":summary"]?></td>
				<td rowspan=4>

				</td>
			</tr>
			<tr id='third'>
				<td id='picture'>Some Links</td>
			</tr>
			<tr id='fourth'>
				<td id='text'><?=$page[":content"]?></td>
			</tr>
			<tr id='bottom'>
				<td>FOOTER</td>
			</tr>
		</table>
	</body>
</html>
