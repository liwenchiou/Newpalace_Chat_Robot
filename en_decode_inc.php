<?php
header("Content-Type:text/html; charset=utf-8");
//
/*---test use------------
$code1='123 abc XYZ Ab';
$c2=compileStr($code1);
$c3=uncompileStr($c2);
echo ("decode ok:".$c3);
*/
//*-----字串進行加密--------------------------------密--------------------------------
function compileStr($code)
{
    $k1 = charCodeAt(substr($code, 0, 1));
    $k2 = strlen($code);
    $c = fromCharCode(charCodeAt(substr($code, 0, 1)) + strlen($code));
    //ex:"abc"  charCodeAt(0)=97(a 的ascii code) code.length=3
    //97+3=100 -->ascii為d
    for ($i = 1; $i < strlen($code); $i++) //ex:i<3 (code len)
    {
        $k3 = charCodeAt(substr($code, $i, 1));
        $k4 = charCodeAt(substr($code, $i - 1, 1));
        $c = $c . fromCharCode($k3 + $k4);
    }
    return rawurlencode($c);
}


//------字串進行解密 --------
function uncompileStr($code)
{
    $code = rawurldecode($code);
    $c = fromCharCode(charCodeAt(substr($code, 0, 1)) - strlen($code));
    echo "xxx 66c=" . $c;
    $i = 1;
    for ($i = 1; $i < strlen($code); $i++) {
        $x2 = charCodeAt(substr($code, $i, 1));
        $x3 = charCodeAt(substr($c, $i - 1, 1));
        $c = $c . fromCharCode($x2 - $x3);
    }

    return $c;
}


function fromCharCode()
{
    $output = '';
    $chars = func_get_args();
    foreach ($chars as $char) {
        $output .= chr((int) $char);
    }
    return $output;
}


function charCodeAt($str) //等同于js的charCodeAt()   but有差異 "abc" return 97,98,99
{
    $result = array();
    for ($i = 0, $l = mb_strlen($str, 'utf-8'); $i < $l; ++$i) {
        $result[] = uniord(mb_substr($str, $i, 1, 'utf-8'));
    }
    return join(",", $result);
}

function uniord($str, $from_encoding = false)
{
    $from_encoding = $from_encoding ? $from_encoding : 'UTF-8';
    if (strlen($str) == 1)
        return ord($str);
    $str = mb_convert_encoding($str, 'UCS-4BE', $from_encoding);
    $tmp = unpack('N', $str);
    return $tmp[1];
}

/**
 * js escape php 实现
 * @param $string           the sting want to be escaped
 * @param $in_encoding
 * @param $out_encoding
 */

function escape($string, $in_encoding = 'UTF-8', $out_encoding = 'UCS-2')
{
    $return = '';
    if (function_exists('mb_get_info')) {
        for ($x = 0; $x < mb_strlen($string, $in_encoding); $x++) {
            $str = mb_substr($string, $x, 1, $in_encoding);
            if (strlen($str) > 1) { // 多字节字符
                $return .= '%u' . strtoupper(bin2hex(mb_convert_encoding($str, $out_encoding, $in_encoding)));
            } else {
                $return .= '%' . strtoupper(bin2hex($str));
            }
        }
    }
    return $return;
}

//----------------------------
function unescape($str)
{
    $ret = '';
    $len = strlen($str);
    for ($i = 0; $i < $len; $i++) {
        if ($str[$i] == '%' && $str[$i + 1] == 'u') {
            $val = hexdec(substr($str, $i + 2, 4));
            if ($val < 0x7f)
                $ret .= chr($val);
            else
                if ($val < 0x800)
                $ret .= chr(0xc0 | ($val >> 6)) .
                    chr(0x80 | ($val & 0x3f));
            else
                $ret .= chr(0xe0 | ($val >> 12)) .
                    chr(0x80 | (($val >> 6) & 0x3f)) .
                    chr(0x80 | ($val & 0x3f));
            $i += 5;
        } else
            if ($str[$i] == '%') {
            $ret .= urldecode(substr($str, $i, 3));
            $i += 2;
        } else
            $ret .= $str[$i];
    }
    return $ret;
}
//-------------------------------
function encode($data)
{
    return base64_encode($data);
}
//----------------------------
