<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"D:\TP5\twothink\public/../application/home/view/default/article\article\detail.html";i:1534037336;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="/static/home/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/home/css/style.css" rel="stylesheet">
    <style>
        .main {
            margin-bottom: 60px;
        }

        .indexLabel {
            padding: 10px 0;
            margin: 10px 0 0;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="main">
    <!--导航部分-->
    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="container-fluid text-center">
            <div class="col-xs-3">
                <p class="navbar-text"><a href="index.html" class="navbar-link">首页</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="#" class="navbar-link">服务</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="#" class="navbar-link">发现</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="#" class="navbar-link">我的</a></p>
            </div>
        </div>
    </nav>
    <!--导航结束-->
        <div class="container-fluid">
            <div name="category_id" id="div1" category="<?php echo $info['category_id']; ?>"></div>
            <h3 class="noticeDetailTitle" id="title"><strong><?php echo $info['title']; ?></strong></h3>
            <div class="noticeDetailInfo" id="uid" sid="<?php echo $info['id']; ?>">发布者:<?php echo get_username($info['uid']); ?></div>
            <div class="noticeDetailInfo">发布时间：<?php echo date('Y-m-d H:i',$info['create_time']); ?></div>
            <section id="contents"><?php echo $info['content']; ?></section>
            <?php if($info['category_id']==47): if(!is_login()): ?>
            <button><a href="<?php echo url('user/user/profile'); ?>">活动报名</a></button>
            <?php else: ?><input type="button" value="活动报名" id="btn1" uid="<?php echo \think\Session::get('user_auth.uid'); ?>" onclick="test()"/>
            <?php endif; endif; ?>
        </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/static/home/jquery-1.11.2.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/static/home/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(function () {
        test = function () {
            var category_id = $('#div1').attr('category');
            var uid = $('#btn1').attr('uid');//住户id
            var sid = $('#uid').attr('sid');//活动id
            $.post('/home/sign/create', "uid=" + uid +"&sid=" +sid);
        }
    });
</script>
</body>
</html>