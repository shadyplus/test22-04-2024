<?php 
if (isset($_COOKIE["NAHUI"])) {
	header('Location: http://google.com/');
	return;
	}
if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) { $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP']; }
$ip = $_SERVER['REMOTE_ADDR'];
$fio = $_POST['name'];
//$upsale = $_POST['upsale'];
$phone = $_POST['phone'];
//$city = $_POST['city'];
//$surname = $_POST['surname'];
//$email = $_POST['email'];
//$address = $_POST['address'];
//$pcode = $_POST['pcode'];
$apiKey = '9aIjz2X9feRdltoG2Mp9UA9EP7UbI1whecAcaBNhSsArb';
$sub1 = (isset($_GET['_clickid']) && !empty($_GET['_clickid'])) ? $_GET['_clickid'] : $_POST['clickid'];
$sub2 = $_POST['bay'];
$apiSendLeadUrl = 'http://api.cpa.tl/api/lead/send';
$apiGetLeadUrl = 'http://api.cpa.tl/api/lead/feed';
$country = 'dz';
$offer_id = '9793';
//$add = '{'.'"other[surname]":'.'"'.$surname.'"' . ','.'   '.
  //  '"other[email]":'.'"'.$email.'"' .','.'   '.
  //  '"other[address]":'.'"'.$address.'"' . ','.'   '.
  //  '"other[city]":'.'"'.$city.'"' .','.'   '.
  //  '"other[pcode]":'. '"'.$pcode.'"'.','.'   '.
  //  '"other[upsale]":"no"'.'}';
//if ($upsale == 1) {
//$add = '{'.'"other[surname]":'.'"'.$surname.'"' . ','.'   '.
//'"other[email]":'.'"'.$email.'"' .','.'   '.
//'"other[address]":'.'"'.$address.'"' . ','.'   '.
//'"other[city]":'.'"'.$city.'"' .','.'   '.
//'"other[pcode]":'. '"'.$pcode.'"'.','.'   '.
//'"other[upsale]":"yes"' .'}';
//}
$stream_hid = 'xlDUaz3M';
$fbp = (isset($_GET['_fbp']) && !empty($_GET['_fbp'])) ? $_GET['_fbp'] : $_POST['fbp'];

if (isset($phone)) {
 

$params=array(
    'key' => $apiKey,
    'ip_address' => $ip,
	'country' => $country,
	'phone' => $phone,
    'name' => $fio,
    'offer_id' => $offer_id,
    'stream_hid' => $stream_hid,
    'sub1' => $sub1,
    'sub2' => $sub2,
//    'comments' => $add,
//    'sub3' => $add,
);
$url = "http://api.cpa.tl/api/lead/send";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_REFERER, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
$return = curl_exec($ch);
curl_close($ch);
setcookie("NAHUI", "123",time() + (3600 * 24));

date_default_timezone_set('Europe/Moscow');
$time = date('Y-m-d H:i:s');
$message = "$time;$fbp;$sub1;$sub2;$ip;$fio;$phone;$add;$return\n";
file_put_contents('log.txt', $message, FILE_APPEND | LOCK_EX); 

header("Location: success.php?fbp=".$fbp."&name=".$_POST['name']."&phone=".$_POST['phone']);



exit;

} else {
   date_default_timezone_set('Europe/Moscow');
    $time = date('Y-m-d H:i:s');
    $message = "$time;$sub1;$ip;$fio;$phone;NO PHONE\n";
    file_put_contents('log.txt', $message, FILE_APPEND | LOCK_EX);
}

?>

