<?php echo $this->load->view('header_base'); ?>
<link href="<?php echo $this->staticUrl; ?>kidsedu/css/reset.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->staticUrl; ?>kidsedu/css/member.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->staticUrl; ?>kidsedu/css/table_form.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->staticUrl; ?>common/script/jquery-1.8.0.min.js"></script>
</head>
<body>
<div id="header">
	<div class="logo"><a href=""><img src="<?php echo $this->staticUrl; ?>kidsedu/images/v9/logo.jpg" height="60" /></a><h3>会员中心</h3></div>
	<div class="link">
		你好 (aaaaaa)<span> | </span>
		<a href="<?php echo $this->baseUrl . $this->prefix; ?>/logout/">退出</a><span> | </span>
		<a href="<?php echo $this->appInfos['webgame']['url']; ?>">首页</a>
	</div>
	<div class="nav-bar">
    	<map>
        	<ul class="nav-site cu-span">
				<li><a href="<?php echo $this->baseUrl . $this->prefix; ?>" class="on"><span>管理中心</span></a></li><li class="line">|</li>
				<li><a href="<?php echo $this->baseUrl . $this->prefix; ?>/manage/" ><span>账号管理</span></a></li><li class="line">|</li>
				<li><a href="<?php echo $this->baseUrl . $this->prefix; ?>/favorite/" ><span>收藏</span></a></li><li class="line">|</li>
			</ul>
        </map>
    </div>
</div>