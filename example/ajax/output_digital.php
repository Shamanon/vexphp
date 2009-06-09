<?

include '../classes/vexControl.php';
$vex = new vexControl();
$vex->controller_digital($_GET['port'],$_GET['value']);
//echo ($_GET['value']==1)?'ON':'OFF';
?>
