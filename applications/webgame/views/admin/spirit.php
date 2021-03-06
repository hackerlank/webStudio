<?php $this->load->view('header_admin') ?>
<?php if ($this->method == 'listinfo') { ?>
<div class="table-list pad-lr-10">
  <form method="get" action="" name="searchform">
    <table width="100%" cellspacing="0" class="search-form">
      <tbody>
		<tr>
		  <td>
		  <div class="explain-col">
			录入时间：<input type="text" readonly="" class="date input-text" size="10" value="" id="start_time" name="start_time">&nbsp;
			<script type="text/javascript">
				Calendar.setup({
				weekNumbers: true,
				inputField : "start_time",
				trigger    : "start_time",
				dateFormat: "%Y-%m-%d",
				showTime: false,
				minuteStep: 1,
				onSelect   : function() {this.hide();}
				});
			</script>-<input type="text" readonly="" class="date input-text" size="10" value="" id="end_time" name="end_time">&nbsp;
			<script type="text/javascript">
				Calendar.setup({
				weekNumbers: true,
				inputField : "end_time",
				trigger    : "end_time",
				dateFormat: "%Y-%m-%d",
				showTime: false,
				minuteStep: 1,
				onSelect   : function() {this.hide();}
				});
			</script>
			<select name="sort"><option selected="" value="0">选择类型</option><?php echo $this->selectSort; ?></select>							
			<select name="attribute"><option selected="" value="0">选择属性</option><?php echo $this->selectAttribute; ?></select>
			<select name="position"><option selected="" value="0">选择推荐位</option><?php echo $this->selectPosition; ?></select>	
			<input type="submit" value="搜索" class="button" name="search">
	      </div>
		  </td>
	    </tr>
      </tbody>
    </table>
    <input type="hidden" name="pc_hash" value="oP31Gm">
  </form>
	<?php
		//echo validation_errors();
		$attributes = array('name' => 'myform', 'id' => 'myform');
		$hidden = array('forwardUrl' => current_url());
		echo form_open($this->appMenus['edit']['url'] . '?action=listorder', $attributes, $hidden);
	?>
	<input type="hidden" name="urlForward" id="urlForward" />
    <table width="100%" cellspacing="0">
      <thead>
		<tr>
    	  <th align="center"><input type="checkbox" value="" id="check_box" onclick="selectall('mulIds[]');"></th>
		  <th><?php echo $this->fieldInfos['listorder']['name']; ?></th>
		  <th><?php echo $this->fieldInfos['id']['name']; ?></th>
		  <th align="center"><?php echo $this->fieldInfos['title']['name']; ?></th>
		  <th align="center"><?php echo $this->fieldInfos['sort']['name']; ?></th>
		  <th align="center"><?php echo $this->fieldInfos['position']['name']; ?></th>
		  <th align="center"><?php echo $this->fieldInfos['inputtime']['name']; ?></th>
		  <th align="center"><?php echo $this->fieldInfos['updatetime']['name']; ?></th>
		  <th class="text-c"><?php echo $this->lang->line('admin_operation'); ?></th>
		</tr>
      </thead>
      <tbody>
	  <?php if (is_array($this->infos) && !empty($this->infos)) { foreach ($this->infos as $info) { ?>
        <tr>
		  <td align="center"><input type="checkbox" name="mulIds[]" value="<?php echo $info['id']; ?>"></td>
		  <td align="center"><input name='listorders[<?php echo $info['id']; ?>]' type='text' size='3' value='<?php echo $info['listorder']; ?>' class="input-text-c"></td>
          <td align="center"><?php echo $info['id']; ?></td>
          <td align="center"><?php echo $info['title']; ?></td>
		  <td align="center"><?php echo $info['sort']; ?></td>
		  <td align="center"><?php echo $info['position']; ?></td>
		  <td align="center"><?php echo $info['inputtime']; ?></td>
		  <td align="center"><?php echo $info['updatetime']; ?></td>
          <td class="text-c">
		  	<?php foreach ($this->operationMenus as $operationMenu) { if (!in_array($operationMenu, array_keys($this->appMenus))) continue; $menu = $this->appMenus[$operationMenu]; $menuUrl = $operationMenu == 'delete' ? 'javascript:confirmurl("' . $menu['url'] . '?id=' . $info['id'] . '", "确认要删除 『 ' . $info['title'] . '』 吗？");' : $menu['url'] . '?id=' . $info['id']; ?>
    		<a href='<?php echo $menuUrl; ?>'><?php echo $menu['name']; ?></a> |
    		<?php } ?>
          </td>
        </tr>
      <?php } } ?>
      </tbody>
    </table>
    <div class="btn"><label for="check_box">全选/取消</label><input type="submit" class="button" name="dosubmit" value="排序" /></div>
  </form>
  <div id="pages"> <?php echo $this->pageStr; ?></div>
</div>
<?php } else { 
$defaultContent =<<<DEFAULTCONTENT
<table width="920" cellpadding="0" cellspacing="0" bordercolor="#666666" border="1" >
	<tr><td colspan="7" class="sec_hb"><strong><span>宠物种族值</span></strong></td></tr>
	<tr>
		<td width="200" valign="middle" bgcolor="#FFCC33">宠物名称</td>
		<td width="100" bgcolor="#FF9900">精力</td>
		<td width="100" bgcolor="#FF9900">攻击</td>
		<td width="100" bgcolor="#FF9900">防御</td>
		<td width="100" bgcolor="#FF9900">特攻</td>
		<td width="100" bgcolor="#FF9900">特防</td>
		<td width="100" bgcolor="#FF9900">速度</td>
	</tr>
	<tr>
		<td width="200" valign="middle"></td>
		<td width="100"></td>
		<td width="100"></td>
		<td width="100"></td>
		<td width="100"></td>
		<td width="100"></td>
		<td width="100"></td>
	</tr>
	<tr>
		<td width="200" valign="middle"></td>
		<td width="100"></td>
		<td width="100"></td>
		<td width="100"></td>
		<td width="100"></td>
		<td width="100"></td>
		<td width="100"></td>
	</tr>
	<tr>
		<td width="200" valign="middle"></td>
		<td width="100"></td>
		<td width="100"></td>
		<td width="100"></td>
		<td width="100"></td>
		<td width="100"></td>
		<td width="100"></td>
	</tr>
</table>
<p>&nbsp;</p>
<table width="920" cellpadding="0" cellspacing="0" bordercolor="#666666" border="1" >
	<tr><td colspan="8" class="sec_hb"><strong><span>技能列表</span></strong></td></tr>
	<tr>
		<td width="117" valign="middle" bgcolor="#FFCC33">技能名称</td>
		<td width="61" bgcolor="#FF9900">学习等级</td>
		<td width="74" bgcolor="#FF9900">攻击类型</td>
		<td width="72" bgcolor="#FF9900">威力值</td>
		<td width="66" bgcolor="#FF9900">pp值</td>
		<td width="516" bgcolor="#FF9900">描述</td>
	</tr>
	<tr>
		<td valign="middle"></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td valign="middle"></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td valign="middle"></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td valign="middle"></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td width="117" valign="middle"></td>
		<td width="61"></td>
		<td width="74"></td>
		<td width="72"></td>
		<td width="66"></td>
		<td width="516"></td>
	</tr>
</table>
<br />
DEFAULTCONTENT;
?>
<style type="text/css">
.radio-label{ border-top:1px solid #e4e2e2; border-left:1px solid #e4e2e2}
.radio-label td{ border-right:1px solid #e4e2e2; border-bottom:1px solid #e4e2e2;background:#f6f9fd}
</style>
<script language="javascript">
document.domain='<?php echo $this->frontDomain; ?>';
</script>
<script type="text/javascript">
  $(document).ready(function() {
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
    $("#title").formValidator({onshow:"请输入精灵名称",onfocus:"精灵名称不能为空。"}).inputValidator({min:1,max:999,onerror:"精灵名称不能为空。"});
  })
</script>
<div class="pad_10">
  <div class="common-form">
	<?php
		//echo validation_errors();
		$attributes = array('name' => 'myform', 'id' => 'myform');
		$this->id = isset($this->id) ? $this->id : 0;
		echo form_open($this->appMenus[$this->method]['url'] . '?id=' . $this->id, $attributes);
	?>
    <table width="100%" class="table_form contentWrap">
      <tr>
        <th width="120"><?php echo $this->fieldInfos['title']['name']; ?>:</th> 
        <td><input type="text" name="title" class="input-text" id="title" value="<?php if (isset($this->currentInfo['title'])) echo $this->currentInfo['title']; ?>" /></input></td>
      </tr>
	  <tr>
		<th width="100"><?php echo $this->fieldInfos['sort']['name']; ?>：</th>
		<td><select name="sort" id="sort"><?php echo $this->selectSort; ?></select></td>
	  </tr>
	  <tr>
		<th width="100"><?php echo $this->fieldInfos['attribute']['name']; ?>：</th>
		<td><select name="attribute" id="attribute"><?php echo $this->selectAttribute; ?></select></td>
	  </tr>
	  <tr>
        <th><?php echo $this->fieldInfos['thumb']['name']; ?>:</th>
        <td>
	      <script type="text/javascript" src="<?php echo $this->staticUrl; ?>common/swfupload/swf2ckeditor.js"></script>
		  <input type="text" name="thumb" id="thumb" value="<?php if (isset($this->currentInfo['thumb'])) echo $this->currentInfo['thumb']; ?>" size="50" class="" />  
		  <input type="button" class="button" onclick="javascript:flashupload('<?php echo $this->appInfos['passport']['url'];?>attachment/swfupload?', 'image_images', '附件上传','thumb',submit_images,'1,jpg|jpeg|gif|bmp|png,1,,,0','content','','5afc0afaab383b2983ada373112bad77')"/ value="上传图片">
		</td>
      </tr>
	  <tr>
        <th><?php echo $this->fieldInfos['pic_effect']['name']; ?>:</th>
        <td>
	      <script type="text/javascript" src="<?php echo $this->staticUrl; ?>common/swfupload/swf2ckeditor.js"></script>
		  <input type="text" name="pic_effect" id="pic_effect" value="<?php if (isset($this->currentInfo['pic_effect'])) echo $this->currentInfo['pic_effect']; ?>" size="50" class="" />  
		  <input type="button" class="button" onclick="javascript:flashupload('<?php echo $this->appInfos['passport']['url'];?>attachment/swfupload?', 'image_images', '附件上传','pic_effect',submit_images,'1,jpg|jpeg|gif|bmp|png,1,,,0','content','','5afc0afaab383b2983ada373112bad77')"/ value="上传图片">
		</td>
      </tr>
	  <tr>
        <th><?php echo $this->fieldInfos['pic_growup']['name']; ?>:</th>
        <td>
	      <script type="text/javascript" src="<?php echo $this->staticUrl; ?>common/swfupload/swf2ckeditor.js"></script>
		  <input type="text" name="pic_growup" id="pic_growup" value="<?php if (isset($this->currentInfo['pic_growup'])) echo $this->currentInfo['pic_growup']; ?>" size="50" class="" />  
		  <input type="button" class="button" onclick="javascript:flashupload('<?php echo $this->appInfos['passport']['url'];?>attachment/swfupload?', 'image_images', '附件上传','pic_growup',submit_images,'1,jpg|jpeg|gif|bmp|png,1,,,0','content','','5afc0afaab383b2983ada373112bad77')"/ value="上传图片">
		</td>
      </tr>
	  <tr>
        <th><?php echo $this->fieldInfos['pic_ext']['name']; ?>:</th>
        <td>
	      <script type="text/javascript" src="<?php echo $this->staticUrl; ?>common/swfupload/swf2ckeditor.js"></script>
		  <input type="text" name="pic_ext" id="pic_ext" value="<?php if (isset($this->currentInfo['pic_ext'])) echo $this->currentInfo['pic_ext']; ?>" size="50" class="" />  
		  <input type="button" class="button" onclick="javascript:flashupload('<?php echo $this->appInfos['passport']['url'];?>attachment/swfupload?', 'image_images', '附件上传','pic_ext',submit_images,'1,jpg|jpeg|gif|bmp|png,1,,,0','content','','5afc0afaab383b2983ada373112bad77')"/ value="上传图片">
		</td>
      </tr>
	  <tr>
		<th width="100"><?php echo $this->fieldInfos['position']['name']; ?>：</th>
		<td><select name="position" id="position"><?php echo $this->selectPosition; ?></select></td>
	  </tr>
	  <tr>
	    <th><?php echo $this->fieldInfos['listorder']['name']; ?>：</th>
		<td class="y-bg"><input type="text" class="input-text" name="listorder" value="<?php if (isset($this->currentInfo['listorder'])) echo $this->currentInfo['listorder']; ?>" id="listorder"  size="30"/></td>
	  </tr>
	  <tr>
	    <th width="80"><?php echo $this->fieldInfos['status']['name']; ?>：</th>
		<td><select name="status" id="status"><?php echo $this->selectServerStatus; ?></select></td>
	  </tr>
	  <tr>
		<th width="80"> <font color="red">*</font><?php echo $this->fieldInfos['content']['name']; ?>:</th>
		<td>
		  <div id='content_tip'></div>
		  <?php
			$contentAuto= isset($this->currentInfo['content']) ? $this->currentInfo['content'] : $defaultContent;
			echo $this->ckeditor->editor('content', $contentAuto); 
		  ?>
		</td>
	  </tr>
    </table>
    <div class="bk15"></div>
    <input name="dosubmit" type="submit" value="提交" class="button">
  </form>
  </div>
</div>
<?php } ?>
</body>
</html>