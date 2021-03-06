<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo $this->metaDatas['title']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php $this->metaDatas['keywords']; ?>" />
<meta name="description" content="<?php $this->metaDatas['description']; ?>" />
<link type="image/ico" rel="shortcut icon" href="<?php echo $this->staticUrl; ?>favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->staticUrl; ?>tsource/pay/css/pay.css?v=20130514699" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->staticUrl; ?>tsource/pay/css/global.css?v=201311014699" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->staticUrl; ?>tsource/pay/css/service.css?v=20130814699" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->staticUrl; ?>tsource/pay/css/account.css?v=20130814699" />
<script src="<?php echo $this->staticUrl; ?>common/script/jquery-1.8.0.min.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript">
var passportUrl = "<?php echo $this->appInfos['passport']['url']; ?>";
var webgameUrl = "<?php echo $this->appInfos['webgame']['url']; ?>";
var payUrl = "<?php echo $this->baseUrl; ?>";
</script>
</head>
<body>
<input type="hidden" name="check_form" id="check_form" value="0"/>
<div class="header">
	<div class="top">
		<h1 class="logo"><a href="/"><span><?php echo $this->metaDatas['title']; ?></span></a></h1>
		<div class="top_links">
			<ul class="top_links_list">
			<?php if (!empty($this->loginedUserInfo)) { ?>
				<li>(<span class="uid_account"><?php echo $this->loginedUserInfo['username']; ?></span>)<a class="head_top" title="我的充值中心" href="<?php echo $this->baseUrl; ?>taomi/myaccount"> 我的充值中心 </a><span>|</span></li>
				<li><a href="<?php echo $this->appInfos['passport']['url']; ?>uwebgame/logout/">安全退出</a><span>|</span></li>
			<?php } else { ?>
				<li><a id="login" href="<?php echo $this->appInfos['passport']['url']; ?>utaomi/login/">登录</a><span>|</span></li>
			<?php } ?>
				<li><a href="/" target="_blank">意见反馈</a><span>|</span></li>
				<li><a href="javascript: addBookmark(); void(0);"  hidefocus="true" style="cursor:pointer;">收藏本站</a></li>
			</ul>
		</div>
	</div>
	<div class="nav">
		<ul class="nav_list">
			<li <?php if ($this->method == 'index') echo 'class="cur"' ?>><a href="taomi/"><span>诺币充值</span></a></li>
			<li <?php if (in_array($this->method, array('topaymonth', 'paymonth'))) echo 'class="cur"' ?>><a href="<?php echo $this->baseUrl; ?>taomi/paymonth"><span>游戏包月</span></a></li>
			<li <?php if (in_array($this->method, array('towebgame', 'exchange'))) echo 'class="cur"' ?>><a href="<?php echo $this->baseUrl; ?>taomi/exchange"><span>游戏币兑换</span></a></li>
			<li <?php if (in_array($this->method, array('myaccount', 'mypay', 'mypaymonth', 'mypayinfo'))) echo 'class="cur"' ?>><a href="<?php echo $this->baseUrl; ?>taomi/mypay"><span>我的充值</span></a></li>
		</ul>
	</div>
</div>
