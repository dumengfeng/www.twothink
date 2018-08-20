<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"D:\TP5\twothink\public/../application/admin/view/default/addons\config.html";i:1496373782;s:73:"D:\TP5\twothink\public/../application/admin/view/default/public\base.html";i:1496373782;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $meta_title; ?>|TwoThink管理平台</title>
    <link href="__ROOT__/public/favicon.ico" type="image/x-icon" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/admin/css/base.css" media="all">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/admin/css/common.css" media="all">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/admin/css/module.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/admin/css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/admin/css/<?php echo \think\Config::get('color_style'); ?>.css" media="all">
     <!--[if lt IE 9]>
    <script type="text/javascript" src="__PUBLIC__/static/jquery-1.10.2.min.js"></script>
    <![endif]--><!--[if gte IE 9]><!-->
    <script type="text/javascript" src="__PUBLIC__/static/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="__PUBLIC__/admin/js/jquery.mousewheel.js"></script>
    <!--<![endif]-->
    
</head>
<body>
    <!-- 头部 -->
    <div class="header">
        <!-- Logo -->
        <span class="logo"></span>
        <!-- /Logo -->

        <!-- 主导航 -->
        <ul class="main-nav">
            <?php if(is_array($__MENU__['main']) || $__MENU__['main'] instanceof \think\Collection || $__MENU__['main'] instanceof \think\Paginator): $i = 0; $__LIST__ = $__MENU__['main'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?>
                <li class="<?php echo (isset($menu['class']) && ($menu['class'] !== '')?$menu['class']:''); ?>"><a href="<?php echo url($menu['url']); ?>"><?php echo $menu['title']; ?></a></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <!-- /主导航 -->

        <!-- 用户栏 -->
        <div class="user-bar">
            <a href="javascript:;" class="user-entrance"><i class="icon-user"></i></a>
            <ul class="nav-list user-menu hidden">
                <li class="manager">你好，<em title="<?php echo session('user_auth.username'); ?>"><?php echo session('user_auth.username'); ?></em></li>
                <li><a  onclick="go_home();">前台首页</a></li>
                <li><a href="<?php echo url('User/updatePassword'); ?>">修改密码</a></li>
                <li><a href="<?php echo url('User/updateNickname'); ?>">修改昵称</a></li>
                <li><a href="<?php echo url('Admin/delcache'); ?>">更新缓存</a></li>
                <li><a href="<?php echo url('Publics/logout'); ?>">退出</a></li>
            </ul>
        </div>
    </div>
    <!-- /头部 -->

    <!-- 边栏 -->
    <div class="sidebar">
        <!-- 子导航 -->
        
            <div id="subnav" class="subnav">
                <?php if(!(empty($_extra_menu) || (($_extra_menu instanceof \think\Collection || $_extra_menu instanceof \think\Paginator ) && $_extra_menu->isEmpty()))): ?>
                    
                    <?php echo extra_menu($_extra_menu,$__MENU__); endif; if(is_array($__MENU__['child']) || $__MENU__['child'] instanceof \think\Collection || $__MENU__['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $__MENU__['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?>
                    <!-- 子导航 -->
                    <?php if(!(empty($sub_menu) || (($sub_menu instanceof \think\Collection || $sub_menu instanceof \think\Paginator ) && $sub_menu->isEmpty()))): if(!(empty($key) || (($key instanceof \think\Collection || $key instanceof \think\Paginator ) && $key->isEmpty()))): ?><h3><i class="icon icon-unfold"></i><?php echo $key; ?></h3><?php endif; ?>
                        <ul class="side-sub-menu">
                            <?php if(is_array($sub_menu) || $sub_menu instanceof \think\Collection || $sub_menu instanceof \think\Paginator): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?>
                                <li>
                                    <a class="item" href="<?php echo url($menu['url']); ?>"><?php echo $menu['title']; ?></a>
                                </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    <?php endif; ?>
                    <!-- /子导航 -->
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        
        <!-- /子导航 -->
    </div>
    <!-- /边栏 -->

    <!-- 内容区 -->
    <div id="main-content">
        <div id="top-alert" class="fixed alert alert-error" style="display: none;">
            <button class="close fixed" style="margin-top: 4px;">&times;</button>
            <div class="alert-content">这是内容</div>
        </div>
        <div id="main" class="main">
            
            <!-- nav -->
            <?php if(!(empty($_show_nav) || (($_show_nav instanceof \think\Collection || $_show_nav instanceof \think\Paginator ) && $_show_nav->isEmpty()))): ?>
            <div class="breadcrumb">
                <span>您的位置:</span>
                <assign name="i" value="1" />
                <?php if(is_array($_nav) || $_nav instanceof \think\Collection || $_nav instanceof \think\Paginator): if( count($_nav)==0 ) : echo "" ;else: foreach($_nav as $k=>$v): if($i == count($_nav)): ?>
                    <span><?php echo $v; ?></span>
                    <?php else: ?>
                    <span><a href="<?php echo $k; ?>"><?php echo $v; ?></a>&gt;</span>
                    <?php endif; ?>
                    <assign name="i" value="$i+1" />
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <?php endif; ?>
            <!-- nav -->
            

            
	<script type="text/javascript" src="__PUBLIC__/static/uploadify/jquery.uploadify.min.js"></script>
	<div class="main-title cf">
		<h2>插件配置 [ <?php echo $data['title']; ?> ]</h2>
	</div>
	<form action="<?php echo url('saveConfig'); ?>" class="form-horizontal" method="post">
		<?php if(empty($custom_config) || (($custom_config instanceof \think\Collection || $custom_config instanceof \think\Paginator ) && $custom_config->isEmpty())): if(is_array($data['config']) || $data['config'] instanceof \think\Collection || $data['config'] instanceof \think\Paginator): if( count($data['config'])==0 ) : echo "" ;else: foreach($data['config'] as $o_key=>$form): ?>
				<div class="form-item cf">
					<label class="item-label">
						<?php echo (isset($form['title']) && ($form['title'] !== '')?$form['title']:''); if(isset($form['tip'])): ?>
							<span class="check-tips"><?php echo $form['tip']; ?></span>
						<?php endif; ?>
					</label>
						<?php switch($form['type']): case "text": ?>
							<div class="controls">
								<input type="text" name="config[<?php echo $o_key; ?>]" class="text input-large" value="<?php echo $form['value']; ?>">
							</div>
							<?php break; case "password": ?>
							<div class="controls">
								<input type="password" name="config[<?php echo $o_key; ?>]" class="text input-large" value="<?php echo $form['value']; ?>">
							</div>
							<?php break; case "hidden": ?>
								<input type="hidden" name="config[<?php echo $o_key; ?>]" value="<?php echo $form['value']; ?>">
							<?php break; case "radio": ?>
							<div class="controls">
								<?php if(is_array($form['options']) || $form['options'] instanceof \think\Collection || $form['options'] instanceof \think\Paginator): if( count($form['options'])==0 ) : echo "" ;else: foreach($form['options'] as $opt_k=>$opt): ?>
									<label class="radio">
										<input type="radio" name="config[<?php echo $o_key; ?>]" value="<?php echo $opt_k; ?>" <?php if($form['value'] == $opt_k): ?> checked<?php endif; ?>><?php echo $opt; ?>
									</label>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
							<?php break; case "checkbox": ?>
							<div class="controls">
								<?php if(is_array($form['options']) || $form['options'] instanceof \think\Collection || $form['options'] instanceof \think\Paginator): if( count($form['options'])==0 ) : echo "" ;else: foreach($form['options'] as $opt_k=>$opt): ?>
									<label class="checkbox">
										<?php 
											is_null($form["value"]) && $form["value"] = array();
										 ?>
										<input type="checkbox" name="config[<?php echo $o_key; ?>][]" value="<?php echo $opt_k; ?>" <?php if(in_array(($opt_k), is_array($form['value'])?$form['value']:explode(',',$form['value']))): ?> checked<?php endif; ?>><?php echo $opt; ?>
									</label>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
							<?php break; case "select": ?>
							<div class="controls">
								<select name="config[<?php echo $o_key; ?>]">
									<?php if(is_array($form['options']) || $form['options'] instanceof \think\Collection || $form['options'] instanceof \think\Paginator): if( count($form['options'])==0 ) : echo "" ;else: foreach($form['options'] as $opt_k=>$opt): ?>
										<option value="<?php echo $opt_k; ?>" <?php if($form['value'] == $opt_k): ?> selected<?php endif; ?>><?php echo $opt; ?></option>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
							</div>
							<?php break; case "textarea": ?>
							<div class="controls">
								<label class="textarea input-large">
									<textarea name="config[<?php echo $o_key; ?>]"><?php echo $form['value']; ?></textarea>
								</label>
							</div>
							<?php break; case "picture_union": ?>
								<div class="controls">
								<input type="file" id="upload_picture_<?php echo $o_key; ?>">
								<input type="hidden" name="config[<?php echo $o_key; ?>]" id="cover_id_<?php echo $o_key; ?>" value="<?php echo $form['value']; ?>"/>
								<div class="upload-img-box">
									<?php if(!(empty($form['value']) || (($form['value'] instanceof \think\Collection || $form['value'] instanceof \think\Paginator ) && $form['value']->isEmpty()))):  $mulimages = explode(",", $form["value"]);  if(is_array($mulimages) || $mulimages instanceof \think\Collection || $mulimages instanceof \think\Paginator): if( count($mulimages)==0 ) : echo "" ;else: foreach($mulimages as $key=>$one): ?>
										<div class="upload-pre-item" val="<?php echo $one; ?>">
											<img src="<?php echo get_cover($one,'path'); ?>"  ondblclick="removePicture<?php echo $o_key; ?>(this)"/>
										</div>
									<?php endforeach; endif; else: echo "" ;endif; endif; ?>
								</div>
								</div>
								<script type="text/javascript">
									//上传图片
									/* 初始化上传插件 */
									$("#upload_picture_<?php echo $o_key; ?>").uploadify({
										"height"          : 30,
										"swf"             : "__PUBLIC__/static/static/uploadify/uploadify.swf",
										"fileObjName"     : "download",
										"buttonText"      : "上传图片",
										"uploader"        : "<?php echo U('File/uploadPicture',array('session_id'=>session_id())); ?>",
										"width"           : 120,
										'removeTimeout'   : 1,
										'fileTypeExts'    : '*.jpg; *.png; *.gif;',
										"onUploadSuccess" : uploadPicture<?php echo $o_key; ?>,
										'onFallback' : function() {
								            alert('未检测到兼容版本的Flash.');
								        }
									});

									function uploadPicture<?php echo $o_key; ?>(file, data){
										var data = $.parseJSON(data);
										var src = '';
										if(data.status){
											src = data.url || '__ROOT__' + data.path
											$("#cover_id_<?php echo $o_key; ?>").parent().find('.upload-img-box').append(
												'<div class="upload-pre-item" val="' + data.id + '"><img src="__ROOT__' + src + '" ondblclick="removePicture<?php echo $o_key; ?>(this)"/></div>'
											);
											setPictureIds<?php echo $o_key; ?>();
										} else {
											updateAlert(data.info);
											setTimeout(function(){
												$('#top-alert').find('button').click();
												$(that).removeClass('disabled').prop('disabled',false);
											},1500);
										}
									}
									function removePicture<?php echo $o_key; ?>(o){
										var p = $(o).parent().parent();
										$(o).parent().remove();
										setPictureIds<?php echo $o_key; ?>();
									}
									function setPictureIds<?php echo $o_key; ?>(){
										var ids = [];
										$("#cover_id_<?php echo $o_key; ?>").parent().find('.upload-img-box').find('.upload-pre-item').each(function(){
											ids.push($(this).attr('val'));
										});
										if(ids.length > 0)
											$("#cover_id_<?php echo $o_key; ?>").val(ids.join(','));
										else
											$("#cover_id_<?php echo $o_key; ?>").val('');
									}
								</script>
							<?php break; case "group": ?>
								<ul class="tab-nav nav">
									<?php if(is_array($form['options']) || $form['options'] instanceof \think\Collection || $form['options'] instanceof \think\Paginator): $i = 0; $__LIST__ = $form['options'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?>
										<li data-tab="tab<?php echo $i; ?>" <?php if($i == '1'): ?>class="current"<?php endif; ?>><a href="javascript:void(0);"><?php echo $li['title']; ?></a></li>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</ul>
								<div class="tab-content">
								<?php if(is_array($form['options']) || $form['options'] instanceof \think\Collection || $form['options'] instanceof \think\Paginator): $i = 0; $__LIST__ = $form['options'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i;?>
									<div id="tab<?php echo $i; ?>" class="tab-pane <?php if($i == '1'): ?>in<?php endif; ?> tab<?php echo $i; ?>">
										<?php if(is_array($tab['options']) || $tab['options'] instanceof \think\Collection || $tab['options'] instanceof \think\Paginator): if( count($tab['options'])==0 ) : echo "" ;else: foreach($tab['options'] as $o_tab_key=>$tab_form): ?>
										<label class="item-label">
											<?php echo (isset($tab_form['title']) && ($tab_form['title'] !== '')?$tab_form['title']:''); if(isset($tab_form['tip'])): ?>
												<span class="check-tips"><?php echo $tab_form['tip']; ?></span>
											<?php endif; ?>
										</label>
										<div class="controls">
											<?php switch($tab_form['type']): case "text": ?>
													<input type="text" name="config[<?php echo $o_tab_key; ?>]" class="text input-large" value="<?php echo $tab_form['value']; ?>">
												<?php break; case "password": ?>
													<input type="password" name="config[<?php echo $o_tab_key; ?>]" class="text input-large" value="<?php echo $tab_form['value']; ?>">
												<?php break; case "hidden": ?>
													<input type="hidden" name="config[<?php echo $o_tab_key; ?>]" value="<?php echo $tab_form['value']; ?>">
												<?php break; case "radio": if(is_array($tab_form['options']) || $tab_form['options'] instanceof \think\Collection || $tab_form['options'] instanceof \think\Paginator): if( count($tab_form['options'])==0 ) : echo "" ;else: foreach($tab_form['options'] as $opt_k=>$opt): ?>
														<label class="radio">
															<input type="radio" name="config[<?php echo $o_tab_key; ?>]" value="<?php echo $opt_k; ?>" <?php if($tab_form['value'] == $opt_k): ?> checked<?php endif; ?>><?php echo $opt; ?>
														</label>
													<?php endforeach; endif; else: echo "" ;endif; break; case "checkbox": if(is_array($tab_form['options']) || $tab_form['options'] instanceof \think\Collection || $tab_form['options'] instanceof \think\Paginator): if( count($tab_form['options'])==0 ) : echo "" ;else: foreach($tab_form['options'] as $opt_k=>$opt): ?>
														<label class="checkbox">
															<?php  is_null($tab_form["value"]) && $tab_form["value"] = array(); ?>
															<input type="checkbox" name="config[<?php echo $o_tab_key; ?>][]" value="<?php echo $opt_k; ?>" <?php if(in_array(($opt_k), is_array($tab_form['value'])?$tab_form['value']:explode(',',$tab_form['value']))): ?> checked<?php endif; ?>><?php echo $opt; ?>
														</label>
													<?php endforeach; endif; else: echo "" ;endif; break; case "select": ?>
													<select name="config[<?php echo $o_tab_key; ?>]">
														<?php if(is_array($tab_form['options']) || $tab_form['options'] instanceof \think\Collection || $tab_form['options'] instanceof \think\Paginator): if( count($tab_form['options'])==0 ) : echo "" ;else: foreach($tab_form['options'] as $opt_k=>$opt): ?>
															<option value="<?php echo $opt_k; ?>" <?php if($tab_form['value'] == $opt_k): ?> selected<?php endif; ?>><?php echo $opt; ?></option>
														<?php endforeach; endif; else: echo "" ;endif; ?>
													</select>
												<?php break; case "textarea": ?>
													<label class="textarea input-large">
														<textarea name="config[<?php echo $o_tab_key; ?>]"><?php echo $tab_form['value']; ?></textarea>
													</label>
												<?php break; case "picture_union": ?>
													<div class="controls">
													<input type="file" id="upload_picture_<?php echo $o_tab_key; ?>">
													<input type="hidden" name="config[<?php echo $o_tab_key; ?>]" id="cover_id_<?php echo $o_tab_key; ?>" value="<?php echo $tab_form['value']; ?>"/>
													<div class="upload-img-box">
														<?php if(!(empty($tab_form['value']) || (($tab_form['value'] instanceof \think\Collection || $tab_form['value'] instanceof \think\Paginator ) && $tab_form['value']->isEmpty()))):  $mulimages = explode(",", $tab_form["value"]);  if(is_array($mulimages) || $mulimages instanceof \think\Collection || $mulimages instanceof \think\Paginator): if( count($mulimages)==0 ) : echo "" ;else: foreach($mulimages as $key=>$one): ?>
															<div class="upload-pre-item" val="<?php echo $one; ?>">
																<img src="<?php echo get_cover($one,'path'); ?>"  ondblclick="removePicture<?php echo $o_tab_key; ?>(this)"/>
															</div>
														<?php endforeach; endif; else: echo "" ;endif; endif; ?>
													</div>
													</div>
													<script type="text/javascript">
														//上传图片
														/* 初始化上传插件 */
														$("#upload_picture_<?php echo $o_tab_key; ?>").uploadify({
															"height"          : 30,
															"swf"             : "__PUBLIC__/static/uploadify/uploadify.swf",
															"fileObjName"     : "download",
															"buttonText"      : "上传图片",
															"uploader"        : "<?php echo U('File/uploadPicture',array('session_id'=>session_id())); ?>",
															"width"           : 120,
															'removeTimeout'   : 1,
															'fileTypeExts'    : '*.jpg; *.png; *.gif;',
															"onUploadSuccess" : uploadPicture<?php echo $o_tab_key; ?>,
															'onFallback' : function() {
													            alert('未检测到兼容版本的Flash.');
													        }
														});

														function uploadPicture<?php echo $o_tab_key; ?>(file, data){
															var data = $.parseJSON(data);
															var src = '';
															if(data.status){
																src = data.url || '__ROOT__' + data.path
																$("#cover_id_<?php echo $o_tab_key; ?>").parent().find('.upload-img-box').append(
																	'<div class="upload-pre-item" val="' + data.id + '"><img src="__ROOT__' + src + '" ondblclick="removePicture<?php echo $o_tab_key; ?>(this)"/></div>'
																);
																setPictureIds<?php echo $o_tab_key; ?>();
															} else {
																updateAlert(data.info);
																setTimeout(function(){
																	$('#top-alert').find('button').click();
																	$(that).removeClass('disabled').prop('disabled',false);
																},1500);
															}
														}
														function removePicture<?php echo $o_tab_key; ?>(o){
															var p = $(o).parent().parent();
															$(o).parent().remove();
															setPictureIds<?php echo $o_tab_key; ?>();
														}
														function setPictureIds<?php echo $o_tab_key; ?>(){
															var ids = [];
															$("#cover_id_<?php echo $o_tab_key; ?>").parent().find('.upload-img-box').find('.upload-pre-item').each(function(){
																ids.push($(this).attr('val'));
															});
															if(ids.length > 0)
																$("#cover_id_<?php echo $o_tab_key; ?>").val(ids.join(','));
															else
																$("#cover_id_<?php echo $o_tab_key; ?>").val('');
														}
													</script>
												<?php break; endswitch; ?>
											</div>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</div>
								<?php endforeach; endif; else: echo "" ;endif; ?>
								</div>
							<?php break; endswitch; ?>

					</div>
			<?php endforeach; endif; else: echo "" ;endif; else: if(isset($custom_config)): ?>
				<?php echo $custom_config; endif; endif; ?>
		<input type="hidden" name="id" value="<?php echo input('id'); ?>" readonly>
		<button type="submit" class="btn submit-btn ajax-post" target-form="form-horizontal">确 定</button>
		<button class="btn btn-return" onclick="javascript:history.back(-1);return false;">返 回</button>
	</form>

        </div>
        <div class="cont-ft">
            <div class="copyright">
                <div class="fl">感谢使用<a href="http://www.twothink.cn" target="_blank">TwoThink</a>管理平台</div>
                <div class="fr">V<?php echo TWOTHINK_VERSION; ?></div>
            </div>
        </div>
    </div>
    <!-- /内容区 -->
    <script type="text/javascript">
    (function(){
        var ThinkPHP = window.Think = {
            "ROOT"   : "__ROOT__", //当前网站地址
            "APP"    : "__APP__", //当前项目地址
            "PUBLIC" : "__PUBLIC__", //项目公共目录地址
            "DEEP"   : "<?php echo config('pathinfo_depr'); ?>", //PATHINFO分割符
            "MODEL"  : ["3", "<?php echo config('url_convert'); ?>", "<?php echo config('url_html_suffix'); ?>"],//config('URL_MODEL')
            "VAR"    : ["<?php echo config('var_module'); ?>", "<?php echo config('var_controller'); ?>", "<?php echo config('var_action'); ?>"]
        }
    })();
    </script>
    <script type="text/javascript" src="__PUBLIC__/static/think.js"></script>
    <script type="text/javascript" src="__PUBLIC__/admin/js/common.js"></script>
    <script type="text/javascript">
        +function(){
            var $window = $(window), $subnav = $("#subnav"), url;
            $window.resize(function(){
                $("#main").css("min-height", $window.height() - 130);
            }).resize();

            /* 左边菜单高亮 */
            url = window.location.pathname + window.location.search;
            url = url.replace(/(\/(p)\/\d+)|(&p=\d+)|(\/(id)\/\d+)|(&id=\d+)|(\/(group)\/\d+)|(&group=\d+)/, "");
            $subnav.find("a[href='" + url + "']").parent().addClass("current");

            /* 左边菜单显示收起 */
            $("#subnav").on("click", "h3", function(){
                var $this = $(this);
                $this.find(".icon").toggleClass("icon-fold");
                $this.next().slideToggle("fast").siblings(".side-sub-menu:visible").
                      prev("h3").find("i").addClass("icon-fold").end().end().hide();
            });

            $("#subnav h3 a").click(function(e){e.stopPropagation()});

            /* 头部管理员菜单 */
            $(".user-bar").mouseenter(function(){
                var userMenu = $(this).children(".user-menu ");
                userMenu.removeClass("hidden");
                clearTimeout(userMenu.data("timeout"));
            }).mouseleave(function(){
                var userMenu = $(this).children(".user-menu");
                userMenu.data("timeout") && clearTimeout(userMenu.data("timeout"));
                userMenu.data("timeout", setTimeout(function(){userMenu.addClass("hidden")}, 100));
            });

	        /* 表单获取焦点变色 */
	        $("form").on("focus", "input", function(){
		        $(this).addClass('focus');
	        }).on("blur","input",function(){
				        $(this).removeClass('focus');
			        });
		    $("form").on("focus", "textarea", function(){
			    $(this).closest('label').addClass('focus');
		    }).on("blur","textarea",function(){
			    $(this).closest('label').removeClass('focus');
		    });

            // 导航栏超出窗口高度后的模拟滚动条
            var sHeight = $(".sidebar").height();
            var subHeight  = $(".subnav").height();
            var diff = subHeight - sHeight; //250
            var sub = $(".subnav");
            if(diff > 0){
                $(window).mousewheel(function(event, delta){
                    if(delta>0){
                        if(parseInt(sub.css('marginTop'))>-10){
                            sub.css('marginTop','0px');
                        }else{
                            sub.css('marginTop','+='+10);
                        }
                    }else{
                        if(parseInt(sub.css('marginTop'))<'-'+(diff-10)){
                            sub.css('marginTop','-'+(diff-10));
                        }else{
                            sub.css('marginTop','-='+10);
                        }
                    }
                });
            }
        }();
        function go_home() {
          window.open("<?php echo url('/'); ?>");
        }
    </script>
    
<script type="text/javascript" charset="utf-8">
	//导航高亮
	highlight_subnav('<?php echo url('Addons/index'); ?>');
	if($('ul.tab-nav').length){
		//当有tab时，返回按钮不显示
		$('.btn-return').hide();
	}
	$(function(){
		//支持tab
		showTab();
	})
</script>

</body>
</html>
