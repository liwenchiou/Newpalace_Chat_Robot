<?php
header("Content-Type:text/html; charset=utf-8");
/**
 *  北區店->http://192.168.2.203:8080/WebReport/decision/view/report?viewlet=%25E5%25BA%2597%25E5%2588%25A5%25E6%2590%258D%25E7%259B%258A%25E8%25A1%25A8%252F%25E5%258C%2597%25E5%258D%2580%25E5%25BA%2597.cpt
 *  東區店->http://192.168.2.203:8080/WebReport/decision/view/report?viewlet=%25E5%25BA%2597%25E5%2588%25A5%25E6%2590%258D%25E7%259B%258A%25E8%25A1%25A8%252F%25E6%259D%25B1%25E5%258D%2580%25E5%25BA%2597.cpt
 *  南雅->http://192.168.2.203:8080/WebReport/decision/view/report?viewlet=%25E5%25BA%2597%25E5%2588%25A5%25E6%2590%258D%25E7%259B%258A%25E8%25A1%25A8%252F%25E5%258D%2597%25E9%259B%2585.cpt
 *  員林店->http://192.168.2.203:8080/WebReport/decision/view/report?viewlet=%25E5%25BA%2597%25E5%2588%25A5%25E6%2590%258D%25E7%259B%258A%25E8%25A1%25A8%252F%25E5%2593%25A1%25E6%259E%2597%25E5%25BA%2597.cpt
 *  文華->http://192.168.2.203:8080/WebReport/decision/view/report?viewlet=%25E5%25BA%2597%25E5%2588%25A5%25E6%2590%258D%25E7%259B%258A%25E8%25A1%25A8%252F%25E6%2596%2587%25E8%258F%25AF.cpt
 *  梧棲店->http://192.168.2.203:8080/WebReport/decision/view/report?viewlet=%25E5%25BA%2597%25E5%2588%25A5%25E6%2590%258D%25E7%259B%258A%25E8%25A1%25A8%252F%25E6%25A2%25A7%25E6%25A3%25B2%25E5%25BA%2597.cpt
 *  萊特薇庭->http://192.168.2.203:8080/WebReport/decision/view/report?viewlet=%25E5%25BA%2597%25E5%2588%25A5%25E6%2590%258D%25E7%259B%258A%25E8%25A1%25A8%252F%25E8%2590%258A%25E7%2589%25B9%25E8%2596%2587%25E5%25BA%25AD.cpt
 *  高雅->http://192.168.2.203:8080/WebReport/decision/view/report?viewlet=%25E5%25BA%2597%25E5%2588%25A5%25E6%2590%258D%25E7%259B%258A%25E8%25A1%25A8%252F%25E9%25AB%2598%25E9%259B%2585.cpt
 */

function getComp($pers_cod)
{
  $NEWB = "北區店->http://report.newpalace.com.tw:8080/WebReport/decision/view/report?viewlet=%25E5%25BA%2597%25E5%2588%25A5%25E6%2590%258D%25E7%259B%258A%25E8%25A1%25A8%252F%25E5%258C%2597%25E5%258D%2580%25E5%25BA%2597.cpt" . "\r\n\r\n";
  $NEWC = "東區店 -> http://report.newpalace.com.tw:8080/WebReport/decision/view/report?viewlet=%25E5%25BA%2597%25E5%2588%25A5%25E6%2590%258D%25E7%259B%258A%25E8%25A1%25A8%252F%25E6%259D%25B1%25E5%258D%2580%25E5%25BA%2597.cpt" . "\r\n\r\n";
  $WED06 = "南雅 -> http://report.newpalace.com.tw:8080/WebReport/decision/view/report?viewlet=%25E5%25BA%2597%25E5%2588%25A5%25E6%2590%258D%25E7%259B%258A%25E8%25A1%25A8%252F%25E5%258D%2597%25E9%259B%2585.cpt" . "\r\n\r\n";
  $WED02 = "員林店 -> http://report.newpalace.com.tw:8080/WebReport/decision/view/report?viewlet=%25E5%25BA%2597%25E5%2588%25A5%25E6%2590%258D%25E7%259B%258A%25E8%25A1%25A8%252F%25E5%2593%25A1%25E6%259E%2597%25E5%25BA%2597.cpt" . "\r\n\r\n";
  $WED05 = "文華 -> http://report.newpalace.com.tw:8080/WebReport/decision/view/report?viewlet=%25E5%25BA%2597%25E5%2588%25A5%25E6%2590%258D%25E7%259B%258A%25E8%25A1%25A8%252F%25E6%2596%2587%25E8%258F%25AF.cpt" . "\r\n\r\n";
  $NEWA = "梧棲店 -> http://report.newpalace.com.tw:8080/WebReport/decision/view/report?viewlet=%25E5%25BA%2597%25E5%2588%25A5%25E6%2590%258D%25E7%259B%258A%25E8%25A1%25A8%252F%25E6%25A2%25A7%25E6%25A3%25B2%25E5%25BA%2597.cpt" . "\r\n\r\n";
  $WED07 = "萊特薇庭 -> http://report.newpalace.com.tw:8080/WebReport/decision/view/report?viewlet=%25E5%25BA%2597%25E5%2588%25A5%25E6%2590%258D%25E7%259B%258A%25E8%25A1%25A8%252F%25E8%2590%258A%25E7%2589%25B9%25E8%2596%2587%25E5%25BA%25AD.cpt" . "\r\n\r\n";
  $WED04 = "高雅 -> http://report.newpalace.com.tw:8080/WebReport/decision/view/report?viewlet=%25E5%25BA%2597%25E5%2588%25A5%25E6%2590%258D%25E7%259B%258A%25E8%25A1%25A8%252F%25E9%25AB%2598%25E9%259B%2585.cpt" . "\r\n\r\n";
  $re_str = "";
  switch ($pers_cod) {
      //邱力文
    case "F18012":
      $re_str .= "請點下方連結查看\r\n\r\n";
      $re_str .= $NEWB;
      $re_str .= $NEWC;
      $re_str .= $WED06;
      $re_str .= $WED02;
      $re_str .= $WED05;
      $re_str .= $NEWA;
      $re_str .= $WED07;
      $re_str .= $WED04;
      break;
      //賴朝清
    case "F11024":
      $re_str .= "請點下方連結查看\r\n\r\n";
      $re_str .= $NEWB;
      $re_str .= $NEWC;
      $re_str .= $WED06;
      $re_str .= $WED02;
      $re_str .= $WED05;
      $re_str .= $NEWA;
      $re_str .= $WED07;
      $re_str .= $WED04;
      break;
    default:
      $re_str .= "無權限使用，請洽詢資訊部\r\n\r\n";
  }
  return $re_str;
}
