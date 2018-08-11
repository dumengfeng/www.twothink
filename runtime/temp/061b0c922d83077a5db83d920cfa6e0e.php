<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"D:\TP5\twothink\public/../application/user/view/default/login\register.html";i:1533798954;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>在线报修</title>

    <!-- Bootstrap -->
    <link href="/static/home/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/home/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <!--<script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>-->
    <!--<script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>-->
    <![endif]-->
    <style>
        .main{margin-bottom: 60px;}
        .indexLabel{padding: 10px 0; margin: 10px 0 0; color: #fff;}
    </style>
</head>
<body>
<div class="main">
    <!--导航部分-->
    <!--导航结束-->

    <div class="container-fluid">
        <form class="login-form" action="" method="post">
            <div class="control-group">
                <label class="control-label" for="inputusername">用户名</label>
                <div class="controls">
                    <input type="text" id="inputusername" class="form-control" placeholder="请输入用户名"  ajaxurl="/member/checkUserNameUnique.html" errormsg="请填写1-16位用户名" nullmsg="请填写用户名" datatype="*1-16" value="" name="username">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPassword">密码</label>
                <div class="controls">
                    <input type="password" id="inputPassword"  class="form-control" placeholder="请输入密码"  errormsg="密码为6-20位" nullmsg="请填写密码" datatype="*6-20" name="password">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputRePassword">确认密码</label>
                <div class="controls">
                    <input type="password" id="inputRePassword" class="form-control" placeholder="请再次输入密码" recheck="password" errormsg="您两次输入的密码不一致" nullmsg="请填确认密码" datatype="*" name="repassword">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputEmail">邮箱</label>
                <div class="controls">
                    <input type="text" id="inputEmail" class="form-control" placeholder="请输入电子邮件"  ajaxurl="/member/checkUserEmailUnique.html" errormsg="请填写正确格式的邮箱" nullmsg="请填写邮箱" datatype="e" value="" name="email">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputverify">验证码</label>
                <div class="controls">
                    <input type="text" id="inputverify" class="form-control" placeholder="请输入验证码"  errormsg="请填写5位验证码" nullmsg="请填写验证码" datatype="*5-5" name="verify">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"></label>
                <div class="controls verifyimg">
                    <?php echo captcha_img(); ?>
                </div>
                <div class="controls Validform_checktip text-warning"></div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn">注 册</button>
                </div>
            </div>
        </form>
    </div>
    <div><p><span class="pull-left"><span>还没有账号? <a href="<?php echo url('login/register'); ?>">立即注册</a></span> </span></p></div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/static/home/jquery-1.11.2.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/static/home/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document)
        .ajaxStart(function(){
            $("button:submit").addClass("log-in").attr("disabled", true);
        })
        .ajaxStop(function(){
            $("button:submit").removeClass("log-in").attr("disabled", false);
        });


    $("form").submit(function(){
        var self = $(this);
        $.post(self.attr("action"), self.serialize(), success, "json");
        return false;

        function success(data){
            if(data.code){
                window.location.href = data.url;
            } else {
                self.find(".Validform_checktip").text(data.msg);
                //刷新验证码
                $(".verifyimg img").click();
            }
        }
    });

    $(function(){
        //刷新验证码
        var verifyimg = $(".verifyimg img").attr("src");
        $(".verifyimg img").click(function(){
            if( verifyimg.indexOf('?')>0){
                $(".verifyimg img").attr("src", verifyimg+'&random='+Math.random());
            }else{
                $(".verifyimg img").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
            }
        });
    });
</script>
</body>
</html>