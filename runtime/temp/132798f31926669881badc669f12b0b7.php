<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"D:\TP5\twothink\public/../application/home/view/default/repair\edit.html";i:1533813108;s:72:"D:\TP5\twothink\public/../application/home/view/default/base\common.html";i:1534240837;s:69:"D:\TP5\twothink\public/../application/home/view/default/base\var.html";i:1496373782;}*/ ?>
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
	        
	        
	<div class="main-title">
		<h2>
			<?php echo !empty($info['id'])?'编辑':'新增'; ?>报修
			<!--<?php if(!(empty($pid) || (($pid instanceof \think\Collection || $pid instanceof \think\Paginator ) && $pid->isEmpty()))): ?>"><?php echo $parent['title']; ?></a>&nbsp;]-->
			<!--<?php endif; ?>-->
		</h2>
	</div>
	<form action="<?php echo url(); ?>" method="post" class="form-horizontal">
		<!--<input type="hidden" name="pid" value="<?php echo $pid; ?>">-->
		<div class="form-item">
			<label class="item-label">报修人姓名<span class="check-tips">（用于显示的文字）</span></label>
			<div class="controls">
				<input type="text" class="text input-large" name="username" value="<?php echo (isset($info['username']) && ($info['username'] !== '')?$info['username']:''); ?>">
			</div>
		</div>

		<div class="form-item">
			<label class="item-label">报修人电话<span class="check-tips">（用于显示的文字）</span></label>
			<div class="controls">
				<input type="text" class="text input-large" name="phone" value="<?php echo (isset($info['phone']) && ($info['phone'] !== '')?$info['phone']:''); ?>">
			</div>
		</div>

		<div class="form-item">
			<label class="item-label">报修人地址<span class="check-tips">（用于显示的文字）</span></label>
			<div class="controls">
				<input type="text" class="text input-large" name="address" value="<?php echo (isset($info['address']) && ($info['address'] !== '')?$info['address']:''); ?>">
			</div>
		</div>

		<div class="form-item">
			<label class="item-label">报修标题<span class="check-tips">（用于显示的文字）</span></label>
			<div class="controls">
				<input type="text" class="text input-large" name="title" value="<?php echo (isset($info['title']) && ($info['title'] !== '')?$info['title']:''); ?>">
			</div>
		</div>

		<div class="form-item">
			<label class="item-label">报修内容<span class="check-tips">（用于显示的文字）</span></label>
			<div class="controls">
				<input type="text" class="text input-large" name="content" value="<?php echo (isset($info['content']) && ($info['content'] !== '')?$info['content']:''); ?>">
			</div>
		</div>

		<div class="form-item">
			<input type="hidden" name="id" value="<?php echo (isset($info['id']) && ($info['id'] !== '')?$info['id']:''); ?>">
			<button class="btn submit-btn ajax-posts" id="submit" type="submit" target-form="form-horizontal">确 定</button>
			<button class="btn btn-return" onclick="javascript:history.back(-1);return false;">返 回</button>
		</div>
	</form>

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
	
<script type="text/javascript" charset="utf-8">
	//导航高亮
//	highlight_subnav('<?php echo url('Repair'); ?>');
</script>
 <!-- 用于加载js代码 -->
	<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
	<?php echo hook('pageFooter', 'widget'); ?>
	<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
		
	</div>

	<!-- /底部 -->
</body>
</html>
