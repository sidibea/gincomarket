<?php
///-build_id: 2017010213.5255
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2016 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.>
include_once(dirname(__FILE__).'/../../config/config.inc.php');
include_once(dirname(__FILE__).'/../../init.php');

$serverName = $_SERVER['SERVER_NAME'];
$serverPort = $_SERVER['SERVER_PORT'];
$url=dirname('http://'.$serverName.':'.$serverPort.$_SERVER['REQUEST_URI']);
$url = $url."/validation.php";

?>
<html>
<haed>
<title>IPN tester</title>
</haed>
<body>
<script language="javascript" type="text/javascript">
    function doSubmit() {          document.forms["ipnform"].action = document.getElementById("formAction").value;          document.forms["ipnform"].submit();      }  </script>  Post URL:<input type="text" name="formAction" id="formAction" value="<?php echo $R6E4F14B335243BE656C65E3ED9E1B115  ?>" size=128>  <form id="ipnform" action="<?php echo $R6E4F14B335243BE656C65E3ED9E1B115  ?>" method="post">  <table>  <?php  $R79993C0968AAF308B57E741FF43D3707 = "cmd=_notify-validate&transaction=Array&log_default_shipping_address_in_transaction=false&action_type=PAY&ipn_notification_url=http%3A%2F%2Fagileservex.com%2Fdev146%2Fmodules%2Fagilepaypaladaptive%2Fvalidation.php&charset=windows-1252&transaction_type=Adaptive+Payment+PAY&notify_version=UNVERSIONED&cancel_url=http%3A%2F%2Fagileservex.com%2Fdev146%2F%2Forder.php&verify_sign=AiPC9BjkCyDFQXbSkoZcgqH3hpacAU7cmEMB8ocW6y.YudB01w1bjQOC&sender_email=alvinj_1329156901_per%40gmail.com&fees_payer=EACHRECEIVER&return_url=http%3A%2F%2Fagileservex.com%2Fdev146%2Fmodules%2Fagilepaypaladaptive%2Fpaymentreturn.php&memo=Hello%2C+this+is+a+memo&reverse_all_parallel_payments_on_error=false&pay_key=AP-127845510V666563A&status=COMPLETED&test_ipn=1&payment_request_date=Mon+Feb+20+20%3A33%3A53+PST+2012";  $RC2D2567438B1F39DD71F78195B5F3DED = explode("&",$R79993C0968AAF308B57E741FF43D3707);  foreach($RC2D2567438B1F39DD71F78195B5F3DED AS $RA94EF3EDEBBECC120DD9EC4D9CB90BD1)  {      $R4A83CAD2D8955C23A7FA832596AD3104 = explode("=",$RA94EF3EDEBBECC120DD9EC4D9CB90BD1);      echo '<tr><td align="right">' . urldecode($R4A83CAD2D8955C23A7FA832596AD3104[0]) . ':</td><td><input type="text" name="' . urldecode($R4A83CAD2D8955C23A7FA832596AD3104[0]). '" value="' . urldecode($R4A83CAD2D8955C23A7FA832596AD3104[1]). '" size="80"></td></tr>';  }  ?>    <tr><td colspan="2" align="center"><input type="button" name="btn" value="submit" style="cursor:hand;" onclick="javascript:doSubmit()"></td></tr>  </table>  </form>  </body>  </html>  