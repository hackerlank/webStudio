﻿<?php
$configInfos = require '../config.php';

$action = $_POST['action'];
if ($action == 'login') {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$gamecode = $_POST['gamecode'];

	if (empty($username) || empty($password)) {
		exit('username or password is empty!<a href="/">登陆</a>=====<a href="register.php">注册</a>');
	}

	$string = "action=login&username={$username}&password={$password}";
	$token = uc_authcode($string, 'ENCODE');
	$url = 'http://passport.ci.com/api?token=' . $token;
	$returnStr = file_get_contents($url);
	if (preg_match('/^\xEF\xBB\xBF/', $returnStr)) {
		$returnStr = substr($returnStr, 3);
	}
	$result = json_decode($returnStr, true);

	if ($result['status'] === true) {
		echo '进入游戏.......';
	} else {
		echo '登陆出错了，错误代码是: ' . $result['code'];
	}
} else if ($action == 'register') {
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$seccode = $_POST['seccode'];

	if (empty($password) || empty($password2) || empty($seccode)) {
		exit('password password2 or seccode is empty<a href="/">登陆</a>=====<a href="register">注册</a>');
	}

	$string = "action=register&password={$password}&password2={$password2}&seccode={$seccode}";
	$token = uc_authcode($string, 'ENCODE');
	$url = 'http://passport.ci.com/api?token=' . $token;
	$returnStr = file_get_contents($url);
	if (preg_match('/^\xEF\xBB\xBF/', $returnStr)) {
		$returnStr = substr($returnStr, 3);
	}
	$result = json_decode($returnStr, true);
	var_dump($result);
	if ($result['status'] === true) {
		header("Location: http://g1.game.com/?action=registersuccess&username=" . $result['username'] . '&password=' . $password);
	} else {
		echo '注册出错了，错误代码是: ' . $result['code'];
	}
}


function uc_authcode($string, $operation = 'DECODE', $key = 'novagame', $expiry = 0)
{
	$ckey_length = 4;

	$key = md5($key ? $key : UC_KEY);
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);

	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);

	$result = '';
	$box = range(0, 255);

	$rndkey = array();
	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}

	for($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}

	if($operation == 'DECODE') {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	} else {
		return $keyc.str_replace('=', '', base64_encode($result));
	}
}