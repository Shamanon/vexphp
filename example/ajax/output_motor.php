<?

include '../classes/vexControl.php';
$vex = new vexControl();
$vex->controller_motor($_GET['port'],$_GET['value']);
?>
