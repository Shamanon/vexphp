<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<script type="text/javascript" src="/js/functions.js"></script>
<link rel="stylesheet" type="text/css" href="/css/style.css" />

<title>Web Sentry</title>

</head>

<body onload="imgLoad('/cam0/webcam.jpeg','cam0',500);statsLoad(2000);">

<div id="main">
	
	<div id="inputs">
		<div id="input_analog">
			<h3>analog inputs</h3>
			<? 
			$a = 4;
			for($i=0;$i < $a; $i++){ 
				?><span>A<?=($i+1)?>:</span> test <br /><?
			}
			?>
		</div>
		<div id="input_digital">
			<h3>digital inputs</h3>
			<table>
				<tr>
			<? 
			$d = 12;
			for($i=0;$i < $d; $i++){ 
				?><td>D<?=($i+1)?></td><?
				if($i == 5) echo '</tr><tr>';
			}
			?>
				</tr>
			</table>
		</div>
	</div>
	
	<div id="camera">
		<div class="cam">
			<img id="cam0" src="/cam0/webcam.jpeg" />
		</div>
		<div id="move_y">
			<? 
			$y = 13;
			for($i=0;$i < $y; $i++){ 
				?><input type="radio" name="move_y" value="true" onclick="output('motor',0,'<?=round(255/($y-1))*$i?>')"><br /><?
			}
			?>
		</div>
		<div id="move_x">
			<? 
			$x = 13;
			for($i=$x;$i > 0; $i--){ 
				?><input type="radio" name="move_x" value="true" onclick="output('motor',1,'<?=round(255/($x-1))*$i?>')"> <?
			}
			?>
		</div>
	</div>
	
	<div id="outputs">
		<div id="output_digital">
			<h3>digital output</h3>
			<? 
			$o = 6;
			for($i=0;$i < $o; $i++){ 
				?><span>O<?=($i+1)?></span> <input type="checkbox" onclick="if(this.checked==true) output('digital','<?=$i?>',1); else output('digital','<?=$i?>',0);" /> <br /><?
			}
			?>
		</div>
	</div>
	
	<div style="clear:both" id="message"></div>

</body>
</html>
