<!----------------------------!over-->
<div class="footer">
	<div class="foot_con">
    	<div class="foot_logo fl"><a href="<?php echo $this->categoryInfos[8]['bind_domain']; ?>"><img src="<?php echo $this->staticUrl; ?>cfront/images/logo.png" /></a></div>
        <div class="foot_tent fl">
			<p class="nav_foot">
			
			<?php foreach (array(2, 4, 19, 20) as $showCatid) { ?>
				<a href="<?php echo $this->categoryInfos[$showCatid]['url']; ?>" target="_blank" title="<?php echo $this->categoryInfos[$showCatid]['catname']; ?>"><?php echo $this->categoryInfos[$showCatid]['catname']; ?></a> |
			<?php } ?>			
			</p>
            <p>
			京ICP备09081115号-6 
				<a href="<?php echo $this->categoryInfos[24]['url']; ?>" target="_blank">京网文[2013]0506-133号</a> 
				<a href="<?php echo $this->categoryInfos[23]['url']; ?>" target="_blank">网络文化经营许可证</a><br />
				知金伟业教育科技（北京）有限公司 Copyright ? 2008 - 2012 ZhiJin Inc. All Rights Reserved.
			</p>
        </div>
    </div>
</div>
</body>
</html>