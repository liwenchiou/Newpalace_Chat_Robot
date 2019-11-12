<?php
include("en_decode_inc.php"); //使用 加密compileStr();解密uncompileStr();
include("chat_config.php"); //損益表使用

//測試synology  我的空間 傳入 @出勤 回將資料回應
//$_CONFIG['token'] = 'XCRJUUnrCCqRKuXb6TCOUj0KTzHNRMDbB6SFCokcEUcdMnoOZEoni4dFAmPXzXVv';  
$raw1 = file_get_contents('php://input');
file_put_contents('output.txt', $raw1);

//-----------	get var value like username....
//$raw1=...test use 沒用時mark才能傳data
//$raw1="token=XCRJUUnrCCqRKuXb6TCOUj0KTzHNRMDbB6SFCokcEUcdMnoOZEoni4dFAmPXzXVv&channel_id=4&channel_type=3&channel_name=&user_id=6&username=F02165&post_id=17179869695&thread_id=0&timestamp=1553654517754&text=%40w3&trigger_word=%40w3";
$ugly_string = $raw1;
$messages = explode("&", $ugly_string);
foreach ($messages as $message) {
	$strings[] = explode('=', $message);
}
foreach ($strings as $string) {
	$data[$string[0]] = $string[1];
}

//------------------------

$zusername = $data['username'];
$ztoken = $data['token'];
$zuser_id = $data['user_id'];
$ztext = $data['text'];



//----reply 送回chat webhook-----------------

$useragent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
//$payload = 'payload={"channel": "#notification", "username": "webhookbot", "text": "'.$msg.'", "icon_emoji": ":ghost:"}';
$zfile1 = 'GetRep1' . rand(10001, 99999);
$ztext = urldecode($ztext); //如text=%E6%94%B6%E5%85%A5 轉換'收入'
$zsele1 = "XX";
if ($ztext == '收入' or $ztext == 'income') {
	$zsele1 = "A1";
} elseif ($ztext == '出勤' or $ztext == 'card' or $ztext == 'Card') {
	$zsele1 = "A2";
} else {
	$zsele1 = "指令Error 6";
}
$ztran = "pass1=" . compileStr(date("Y/m/d")) . "@pass2=" . compileStr($zusername) . "@sele1=" . $zsele1;
//$date=date("Y/m/d");
//$ztran="pass1=".$date."#pass2=".compileStr($zusername)."#sele1=".$zsele1;
//新天地 收入金額預估
//$link2="http://192.168.2.203:8080/WebReport/run_auto1.html?".$ztran;
$link2 = "http://report.newpalace.com.tw:8080/WebReport/run_auto1.html?" . $ztran;
$link2 = urlencode($link2);

//加班申請
$link3 = "http://srv.newpalace.com.tw/Newpalace_WorkFlow/OverTime.php?ChatUser=" . $zusername;
$link3 = urlencode($link3);

//電子簽核
$link4 = "http://srv.newpalace.com.tw/Newpalace_WorkFlow/WorkFlow.php?ChatUser=" . $zusername;
$link4 = urlencode($link4);

//個人出勤
// $link5 = "http://report.newpalace.com.tw:8080/WebReport/ReportServer?formlet=SynologyChat%2F%5B7576%5D%5B6708%5D%5B51fa%5D%5B52e4%5D%5B5831%5D%5B8868%5D2.frm&chatuser=" . $zusername;
$link5 = "http://report.newpalace.com.tw:8080/WebReport/ReportServer?formlet=SynologyChat/當月出勤報表2.frm&chatuser=" . $zusername;
$link5 = urlencode($link5);

//薪資
// $link6 = "http://report.newpalace.com.tw:8080/WebReport/decision/view/report?viewlet=SynologyChat/個人薪資.cpt&chatuser=" . encode($zusername);
$link6 = "http://report.newpalace.com.tw:8080/WebReport/decision/view/report?viewlet=SynologyChat/個人薪資.cpt&chatuser=" . encode($zusername);
$link6 = urlencode($link6);

//店別損益
$link7 = urlencode(getComp($zusername));


if ($ztext == '收入' or $ztext == 'income') {
	$msg = "Hello ! " . $zusername . "收入 < " . $link2 . " > ";
} elseif ($ztext == '出勤' or $ztext == 'card' or $ztext == 'Card') {
	// $msg=$zusername." <".$link2."|"."出勤點下方連結url>";
	$msg = " <" . $link5 . "|" . "出勤點下方連結url>";
} elseif ($ztext == '加班申請') {
	$msg = " <" . $link3 . "|" . "加班申請點下方連結url>";
} elseif ($ztext == '電子簽核') {
	$msg = " <" . $link4 . "|" . "電子簽核點下方連結url>";
} elseif ($ztext == '薪資' or $ztext == 'salary' or $ztext == 'SALARY') {
	$msg = " <" . $link6 . "|" . "薪資點下方連結url>";
} else if ($ztext == '損益表') {
	$msg =  $link7;
} else {
	$msg = $zusername . ' Sorry !指令: [' . $ztext . "]無相對服務!";
}


$zid = "[" . $zuser_id . "]";
$payload = 'payload={ "text": "' . $msg . '","user_ids":' . $zid . '}';

$url = "http://cloud.newpalace.com.tw/webapi/entry.cgi?api=SYNO.Chat.External&method=chatbot&version=2&token=%22qfvRBOL9NAREVJcTIdlLBB7zdxkMLfriCI6Bx2sHjJEQJKdWiXOmLVEJmSU2vZD0%22";
//$url="http://cloud.newpalace.com.tw/webapi/entry.cgi?api=SYNO.Chat.External&method=chatbot&version=2&token=%22Z9lZdfmxkY86rFyBBP9ULCN2b1pMQeMp5DGx48bhIv9B6gy2S8w9dsqBsRwZeBe0%22";
//note 不可用https:// chat不正常 
//$url="http://newp.synology.me/webapi/entry.cgi?api=SYNO.Chat.External&method=chatbot&version=2&token=%22qfvRBOL9NAREVJcTIdlLBB7zdxkMLfriCI6Bx2sHjJEQJKdWiXOmLVEJmSU2vZD0%22";      

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded"));
curl_setopt($ch, CURLOPT_USERAGENT, $useragent); //set our user agent
curl_setopt($ch, CURLOPT_POST, TRUE); //set how many paramaters to post
curl_setopt($ch, CURLOPT_URL, $url); //set the url we want to use
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_exec($ch); //execute and get the results
curl_close($ch);
