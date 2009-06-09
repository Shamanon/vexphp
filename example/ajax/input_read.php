<?
include '../classes/vexControl.php';

$vex = new vexControl();

while($data = explode(" ",$vex->port_read())) if($data[0] == 'BOARDDATA') break;

?>

<div id="input_analog">
	<h3>analog inputs</h3>
	<? 
	$a = 4;
	for($i=0;$i < $a; $i++){ 
		?><span>A<?=($i+1)?>:</span> <?=$data[$i+1]?> <br /><?
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
		?><td<?=(!$data[$i+5])?' class="on"':null?>>D<?=($i+1)?></td><?
		if($i == 5) echo '</tr><tr>';
	}
	?>
		</tr>
	</table>
</div>