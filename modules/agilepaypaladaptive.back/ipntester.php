<?php
///-build_id: 2016030721.4219
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.
include_once(dirname(__FILE__).'/../../config/config.inc.php');
include_once(dirname(__FILE__).'/../../init.php');

$serverName = $_SERVER['SERVER_NAME'];
$serverPort = $_SERVER['SERVER_PORT'];
$url=dirname($url = Tools::getShopDomainSsl(true,true) .$_SERVER['REQUEST_URI']);

?>
<html>
<haed>
<title>IPN tester</title>
</haed>
<body>
<?php 
if(!isset($_POST['ipnData']) OR empty($_POST['ipnData'] ))
{
?>
<form id="ipnform" action="<?php echo $url ?>/ipntester.php" method="post">
Plese input your IPN data below and click <input type="submit" name="btnShowForm" value="Show Submit Form"><br>
<textarea name="ipnData" rows="5" cols="80">
</textarea>
</form>
<br>
<?php
}
else
{	
?>
<center><a href="<?php echo $url ?>/ipntester.php">Back to raw IPN form</a><br></center>
<form id="ipnform" action="<?php echo $url ?>/validation.php" method="post">
<table>
<?php
$ipn = $_POST["ipnData"];

$params = explode("&",$ipn);
foreach($params AS $param)
{
    $nv = explode("=",$param);
	echo '<tr><td align="right">' . urldecode($nv[0]) . ':</td><td><input type="text" name="' . urldecode($nv[0]). '" value="' . (count($nv) > 1?urldecode($nv[1]) : ""). '" size="80"></td></tr>';
}
?>

<tr><td colspan="2" align="center"><input type="submit" name="btn" value="submit"></td></tr>
</table>
</form>
<?php
}
?>
</body>
</html>
