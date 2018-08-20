<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"D:\TP5\twothink\public/../application/home/view/default/article\lists2.html";i:1534240480;s:75:"D:\TP5\twothink\public/../application/home/view/default/category\lists.html";i:1534240880;}*/ ?>
<?php if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;if($current == $cate['id']): ?>
		<li class="active">
			<a href="<?php echo url('Article/lists2?category='.$cate['name']); ?>">
				<i class="icon-chevron-right"></i><?php echo $cate['title']; ?>
			</a>
		</li>
	<?php else: ?>
		<li>
			<a href="<?php echo url('Article/lists2?category='.$cate['name']); ?>">
				<i class="icon-chevron-right"></i><?php echo $cate['title']; ?>
			</a>
		</li>
	<?php endif; endforeach; endif; else: echo "" ;endif; ?>
