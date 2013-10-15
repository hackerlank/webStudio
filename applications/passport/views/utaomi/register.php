<?php echo $this->load->view($this->prefix . '/header'); ?>


<script src="<?php echo $this->staticUrl; ?>common/formvalidator/formValidator-4.1.1.js" type="text/javascript" charset="UTF-8"></script>
<script src="<?php echo $this->staticUrl; ?>common/formvalidator/formValidatorRegex.js" type="text/javascript" charset="UTF-8"></script>
<script src="<?php echo $this->staticUrl; ?>common/formvalidator/themes/baidu/js/theme.js" type="text/javascript" charset="UTF-8"></script>
<link href="<?php echo $this->staticUrl; ?>common/formvalidator/themes/baidu/style/style.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function(){
	$.formValidator.initConfig({formID:"registerForm",theme:"baidu",submitOnce:true, //debug:true,
		onError:function(msg,obj,errorlist){
			$("#errorlist").empty();
			$.map(errorlist,function(msg){
				$("#errorlist").append("<li>" + msg + "</li>")
			});
			alert(msg);
		},
		ajaxPrompt : '有数据正在异步验证，请稍等...'
	});


	$("#password").formValidator({onShow:"请输入密码",onFocus:"密码为6-16个字符",onCorrect:"密码合法"}).inputValidator({min:6,max:16,empty:{leftEmpty:false,rightEmpty:false,emptyError:"密码两边不能有空符号"},onError:"密码为6-16个字符,请确认"});
	$("#password2").formValidator({onShow:"输再次输入密码",onFocus:"至少1个长度",onCorrect:"密码一致"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"重复密码两边不能有空符号"},onError:"重复密码不能为空,请确认"}).compareValidator({desID:"password",operateor:"=",onError:"2次密码不一致,请确认"});
	$("#checkcode").formValidator({onShow:"",onFocus:"验证码至少2个字符,最多10个字符",onCorrect:"验证码有效"}).inputValidator({min:2,max:10,onError:"你输入的验证码非法,请确认"})
	    .ajaxValidator({
		url: passportUrl + 'uwebgame/isValidCode?isajax=yes',
		async: false,
		cache: false,
		success : function(data){
			if (data == 'yes') {
				return true;
			} else {
				return "验证码错误";
			}
		}
	}).defaultPassed();
	//$(":checkbox[name='protocol']").formValidator({onshow:"请阅读协议",onfocus:"请阅读协议"}).inputValidator({min:1,onerror:"请阅读协议"});
	

	$("#username").formValidator({onShow:"请输入用户名",onFocus:"用户名至少5个字符,最多20个字符",onCorrect:"该用户名有效"}).inputValidator({min:5,max:20,onError:"你输入的用户名非法,请确认"})
		.ajaxValidator({
		dataType : "jsonp",
		async : false,
		jsonp:"callback",
		url : passportUrl + '<?php echo $this->prefix; ?>/getUserid/',
		success : function(data){
			var userid = parseInt(data.userid);
			if (userid == 0) {
				return true;
			}
			return "该用户名已存在，请更换用户名";
		},
		buttons: $("#button"),
		error: function(jqXHR, textStatus, errorThrown){alert("服务器没有返回数据，可能服务器忙，请重试"+errorThrown);},
		onError : "该用户名已存在，请更换用户名",
		onWait : "正在对用户名进行合法性校验，请稍候..."
	}).defaultPassed();

	$("#email").formValidator({onShow:"请输入邮箱",onFocus:"邮箱6-100个字符",onCorrect:"恭喜你,你输对了",defaultValue:"@"}).inputValidator({min:6,max:100,onError:"你输入的邮箱长度非法,请确认"}).regexValidator({regExp:"^([\\w-.]+)@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.)|(([\\w-]+.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(]?)$",onError:"你输入的邮箱格式不正确"})
	.ajaxValidator({
		dataType : "jsonp",
		async : false,
		jsonp:"callback",
		url : passportUrl + '<?php echo $this->prefix; ?>/emailValid/',
		success : function(data){
			var emailValid = parseInt(data.emailValid);
			if (emailValid == 1) {
				return true;
			}
			return "该邮箱已存在，请更换邮箱";
		},
		buttons: $("#button"),
		error: function(jqXHR, textStatus, errorThrown){alert("服务器没有返回数据，可能服务器忙，请重试"+errorThrown);},
		onError : "该用邮箱已存在，请更换邮箱",
		onWait : "正在对邮箱进行合法性校验，请稍候..."
	}).defaultPassed();

	$("#truename").formValidator({onShow:"请输入真实姓名，中文格式",onCorrect:"谢谢你的合作，你的姓名正确"}).regexValidator({regExp:"chinese",dataType:"enum",onError:"请填写您的中文姓名"});
	$("#idcard").formValidator({ajax:true,onShow:"请输入15或18位的身份证",onFocus:"输入15或18位的身份证",onCorrect:"输入正确"}).functionValidator({fun:isCardID});
});

</script>
<div class="min-body">
    <div class="min-content back">
    <form autocomplete="off" id="registerForm" name="registerForm" method="post" action="<?php echo $this->baseUrl . $this->prefix . '/register/'; ?>" >
        <input type="hidden" id="haveEmail" name="haveEmail" value="no" />
		<input type="hidden" id="haveUsername" name="haveUsername" value="no" />
        <input type="hidden" id="haveRealName" name="haveRealName" value="no" />
        <div class='new-nav'>
            <ul id="usenamelist">
                <li><a href="javascript: selectFast(); void(0);" class="nav-box cur" id="selectFast" hidefocus="true"><span class='title'><i class="spmm"></i>知金号</span><span class='tip'>自动分配帐号，快速注册</span></a></li>
				<li><a class="nav-box " href="javascript: selectSelf(); void(0);" id="selectSelf"><span class="title"><i class="spself"></i>自定义<i class="new"></i></span><span class="tip">用喜欢的字符注册，简单好记</span></a></li>
                <li><a href="javascript: selectEmail(); void(0);" class="nav-box" id="selectEmail" hidefocus="true"><span class='title'><i class='spemail'></i>邮箱帐号</span><span class='tip'>用邮箱地址注册，便于记忆</span></a></li>
            </ul>
        </div>
        <div class="reg-box" style="width:700px;overflow:hidden;float:left;margin-left:20px;">
        <div class="reg-top">
			<span class="fright f14" style="margin-right: 50px;" id="selectRealNameBar">建议你进行<a href="javascript: selectRealName(); void(0);" class="green no-underline">实名注册</a></span>
			<span class="fright f14" style="margin-right: 50px; display: none;" id="selectNoRealNameBar">您也可以<a href="javascript: selectNoRealName(); void(0);" class="green no-underline">不实名注册</a></span>
			<span class="fleft fb" id="J_quick_tip">快速注册知金号，开始快乐之旅</span>
		</div>
        <div style="position:relative;"></div>



		<div id="registerWithUsername" style="display:none">
		<div class="reg-row">
            <label class="label">自定义帐号：</label>
            <input type="text" name="username" id="username" class="user_input" />
			<div class="txt_tips"><span id="usernameTip"></span></div>
       </div>
	   </div>

		<div id="registerWithEmail" style="display: none">
        <div class="reg-row">
            <label class="label">注册邮箱：</label>
            <input type="text" name="email" id="email" class="user_input" />
			<div class="txt_tips"><span id="emailTip"></span></div>
        </div>
		</div>

        <div class="reg-row">
            <label class="label">设置密码：</label>
            <input type="text" name="password" id="password" class="user_input" />
			<div class="txt_tips"><span id="passwordTip"></span></div>
        </div>
        <div class="reg-row" style="margin-bottom:30px;">
            <label class="label">确认密码：</label>
            <input type="text" name="password2" id="password2" class="user_input" />
			<div class="txt_tips"><span id="password2Tip"></span></div>
        </div>

		<div id="registerWithRealName" style="display: none">
        <div class="reg-row">
            <label class="label">真实姓名：</label>
            <input type="text" name="truename" id="truename" class="user_input" />
			<div class="txt_tips"><span id="truenameTip"></span></div>
        </div>
        <div class="reg-row">
            <label class="label">身份证号：</label>
            <input type="text" name="idcard" id="idcard" class="user_input" />
			<div class="txt_tips"><span id="idcardTip"></span></div>
        </div>
        <div class="reg-tip"><span>请一定要准确填写自己的身份证号，如果没有，可以向爸爸妈妈借看下！</span></div>
		</div>

        <div class="rsess-row">
            <label class="label">验证码：</label>
            <input type="text" name="checkcode" id="checkcode" class="user_input" width="10px" />
			<div class="txt_tips"><span id="checkcodeTip"></span></div>

			
        </div>
            <div class="reg-img pointer" id="checkcode_img_tip">
				<img style="width:100px;" src="<?php echo $this->baseUrl; ?>admin/index/checkcode" onClick="this.src=this.src+'/'+Math.random()"  id="checkcode_img" alt="换一张"/>
				<a href="javascript:document.getElementById('checkcode_img').src='<?php echo $this->baseUrl; ?>admin/index/checkcode'+'/'+Math.random();void(0);" id="J_change_sess" class="gray f12">换一个</a>
			</div>

        <div class="comm-error ps-error" style="margin-left:198px;*margin-left:0px;" id="J_error_agree"><span></span></div>
        <div class="check-row">
            <div id="J_check_box" class="check"><input type="checkbox" value="" id="protocol" name="protocol"></div>
            <span class="gray che-span">我已阅读并同意《<a href="<?php echo $this->categoryInfos[22]['url']; ?>" target="_blank" class="fb gray no-underline">淘米网服务条款</a>》</span>
        </div>
        <div id="J_submit" class="reg-botton pointer"><span class="f16b" onclick="register();">立即注册</span></div>
        </div>
    </form>
    </div>
</div>
<script language="javascript" type="text/javascript">
function selectFast()
{
	$("#haveEmail").val("no");
	$("#haveUsername").val("no");
	
	$("#selectFast").addClass("cur");
	$("#selectUsername").removeClass("cur");
	$("#selectEmail").removeClass("cur");
	$("#registerWithEmail").hide();
	$("#registerWithUsername").hide();
}

function selectSelf()
{
	$("#haveUsername").val("yes");
	$("#haveEmail").val("no");

	$("#selectFast").removeClass("cur");
	$("#selectUsername").addClass("cur");
	$("#selectEmail").removeClass("cur");		
	$("#registerWithUsername").show();
	$("#registerWithEmail").hide();
}

function selectEmail()
{
	$("#haveEmail").val("yes");
	$("#haveUsername").val("no");

	$("#selectFast").removeClass("cur");
	$("#selectUsername").removeClass("cur");
	$("#selectEmail").addClass("cur");	
	$("#registerWithEmail").show();
	$("#registerWithUsername").hide();
}

function selectRealName()
{	
	$("#haveRealName").val("yes");
	$("#selectRealNameBar").hide();
	$("#selectNoRealNameBar").show();
	$("#registerWithRealName").show();
}

function selectNoRealName()
{
	$("#haveRealName").val("no");
	$("#selectRealNameBar").show();
	$("#selectNoRealNameBar").hide();
	$("#registerWithRealName").hide();
}

function register()
{
	$("#username").unFormValidator(true); 
	$("#email").unFormValidator(true); 
	$("#truename").unFormValidator(true); 
	$("#idcard").unFormValidator(true); 

	var haveEmail = $("#haveEmail").val();
	var haveUsername = $("#haveUsername").val();
	var haveRealName = $("#haveRealName").val();
	if (haveEmail == 'yes')	{
		$("#email").unFormValidator(false);
	}
	if (haveUsername == 'yes')	{
		$("#username").unFormValidator(false);
	}
	if (haveRealName == 'yes')	{
		$("#truename").unFormValidator(false);
		$("#idcard").unFormValidator(false);
	}
	$('#registerForm').submit();
}
</script>
<script language="javascript" type="text/javascript">
setNav(1);
selectFast();
selectNoRealName();

</script>
<?php echo $this->load->view($this->prefix . '/footer'); ?>