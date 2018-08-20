<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:75:"D:\TP5\twothink\public/../application/home/view/default/article\lists2.html";i:1534240480;s:72:"D:\TP5\twothink\public/../application/home/view/default/base\common.html";i:1534240837;s:69:"D:\TP5\twothink\public/../application/home/view/default/base\var.html";i:1496373782;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo config('WEB_SITE_TITLE'); ?></title>
<link href="__STATIC__/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="__STATIC__/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<link href="__STATIC__/bootstrap/css/docs.css" rel="stylesheet">
<link href="__STATIC__/bootstrap/css/twothink.css" rel="stylesheet">

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="__STATIC__/bootstrap/js/html5shiv.js"></script>
<![endif]-->

<!--[if lt IE 9]>
<script type="text/javascript" src="__STATIC__/jquery-1.10.2.min.js"></script>
<![endif]-->
<!--[if gte IE 9]><!-->
<script type="text/javascript" src="__STATIC__/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="__STATIC__/bootstrap/js/bootstrap.min.js"></script>
<!--<![endif]-->
<!-- 页面header钩子，一般用于加载插件CSS文件和代码 -->
<?php echo hook('pageHeader'); ?>
</head>
<body>
	<!-- 头部 -->
	<!-- 导航条
	================================================== -->
	<div class="navbar navbar-inverse navbar-fixed-top">
	    <div class="navbar-inner">
	        <div class="container">
	            <a class="brand" href="<?php echo url('index/index'); ?>">TwoThink</a>
	            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	            </button>
	            <div class="nav-collapse collapse">
	                <ul class="nav"> 
		                <?php $__NAV__ = \think\Db::name('Channel')->field(true)->where("status=1")->order("sort")->select();if(is_array($__NAV__) || $__NAV__ instanceof \think\Collection || $__NAV__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__NAV__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;if($nav['pid'] == '0'): ?>
		                        <li>
		                            <a href="<?php echo get_nav_url($nav['url']); ?>" target="<?php if($nav['target'] == '1'): ?>_blank<?php else: ?>_self<?php endif; ?>"><?php echo $nav['title']; ?></a>
		                        </li>
                        	<?php endif; endforeach; endif; else: echo "" ;endif; ?> 
	                </ul>
	            </div>
	            <div class="nav-collapse collapse pull-right">
	                <?php if(is_login()): ?>
	                    <ul class="nav" style="margin-right:0">
	                        <li class="dropdown">
	                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-left:0;padding-right:0"><?php echo get_username(); ?> <b class="caret"></b></a>
	                            <ul class="dropdown-menu">
	                                <li><a href="<?php echo url('user/user/profile'); ?>">修改密码</a></li>
	                                <li><a href="<?php echo url('user/login/logout'); ?>">退出</a></li>
	                            </ul>
	                        </li>
	                    </ul>
	                <?php else: ?>
	                    <ul class="nav" style="margin-right:0">
	                        <li>
	                            <a href="<?php echo url('user/login/index'); ?>">登录</a>
	                        </li>
	                        <li>
	                            <a href="<?php echo url('user/user/register'); ?>" style="padding-left:0;padding-right:0">注册</a>
	                        </li>
	                    </ul>
	                <?php endif; ?>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- /头部 -->
	
	<!-- 主体 -->
	
	<div id="main-container" class="container">
	    <div class="row">
	        
	        <!-- 左侧 nav
	        ================================================== -->
	            <!--<div class="span3 bs-docs-sidebar">-->
					<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
	                
	                <!--<ul class="nav nav-list bs-docs-sidenav">-->
						<ul id="myTabs" class="nav nav-tabs" role="tablist">
	                   <?php echo widget('Category/lists2', array($category['id'], request()->action() == 'index')); ?>
	                </ul>
	            </div>
	        
	        
<div class="main">
	<!--导航部分-->
	<!--导航结束-->

	<div class="container-fluid">
		<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
		<div name="category_id" id="div1" category="<?php echo $data['category_id']; ?>"></div>
		<div class="row noticeList">
			<div class="col-xs-2">
				<a href="<?php echo url('Article/detail?id='.$data['id']); ?>"><img class="img-thumbnail"
																		src="__ROOT__<?php echo get_cover_path($data['cover_id']); ?>"/></a>
			</div>
			<div class="col-xs-10">
				<p class="title"><a href="<?php echo url('Article/detail?id='.$data['id']); ?>"><?php echo $data['title']; ?></a></p>
				<p class="intro"><?php echo $data['description']; ?></p>

				<p class="info">浏览: (<?php echo $data['view']; ?>) <span class="pull-right">发表于 <?php echo $data['create_time']; ?></span></p>
			</div>
		</div>
		<?php endforeach; endif; else: echo "" ;endif; ?>
		<div id="div">
		</div>
		<div id="list">
			<button class="btn btn-default btn-block get_more" onclick="getLists()">获取更多。。。</button>
		</div>
	</div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/static/home/jquery-1.11.2.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/static/home/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(function () {
        var page = 2;
        getLists = function () {
            var category_id = $('#div1').attr('category');
            if (category_id==null){
                $('#list').html('<span>没有啦。。。</span>');
            }
            $.get('/home/article/lists', "category=" + category_id + "&p=" + page + "", function (data) {
                if (data) {
                    $('#div').append(data);
                } else {
                    $('#list').html('<span>没有啦。。。</span>');
                }

            });
            page++;
        }
    });
</script>

	    </div>
	</div>

	<script type="text/javascript">
	    $(function(){
	        $(window).resize(function(){
	            $("#main-container").css("min-height", $(window).height() - 343);
	        }).resize();
	    })
	</script>
	<!-- /主体 -->

	<!-- 底部 -->
	
    <!-- 底部
    ================================================== -->
    <footer class="footer">
      <div class="container">
          <p> 本站由 <strong><a href="http://www.twothink.cn" target="_blank">TwoThink</a></strong> 强力驱动</p>
      </div>
    </footer>

	<script type="text/javascript">
(function(){
	var ThinkPHP = window.Think = {
		"ROOT"   : "__ROOT__", //当前网站地址
		"APP"    : "__APP__", //当前项目地址
		"PUBLIC" : "__PUBLIC__", //项目公共目录地址
		"DEEP"   : "<?php echo config('URL_PATHINFO_DEPR'); ?>", //PATHINFO分割符
		"MODEL"  : ["<?php echo config('URL_MODEL'); ?>", "<?php echo config('URL_CASE_INSENSITIVE'); ?>", "<?php echo config('URL_HTML_SUFFIX'); ?>"],
		"VAR"    : ["<?php echo config('VAR_MODULE'); ?>", "<?php echo config('VAR_CONTROLLER'); ?>", "<?php echo config('VAR_ACTION'); ?>"]
	}
})();
</script>
	 <!-- 用于加载js代码 -->
	<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
	<?php echo hook('pageFooter', 'widget'); ?>
	<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
		
	</div>

	<!-- /底部 -->
</body>
</html>
