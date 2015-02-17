<!DOCTYPE html>
<html lang="zh-CN">

<?php include('layout/head.php'); ?>

<body>

<?php
$currentNav = 'create';
include('layout/header.php');
?>

<div class="container">

	<div class="preview col-lg-6 col-md-6">
		<h2>预览图</h2>
		<p>注意：预览图采用iPhone 5的尺寸，实际效果请在真机上查看。</p>
		<button type="button" class="btn btn-info refresh">刷新</button>
		<div class="iphone">

		</div>
	</div>

	<div class="config col-lg-6 col-md-6">
		<h2>配置</h2>
		<h4>头部内容</h4>
		<textarea name="header"></textarea>
		<h4>中部内容</h4>
		<textarea name="content"></textarea>
		<h4>尾部内容</h4>
		<textarea name="footer"></textarea>
		<h4>背景图片</h4>
		<input type="file" name="background"/>
		<h4>背景音乐</h4>
		<input type="file" name="music"/>
		<button type="button" class="btn btn-success">完成</button>
	</div>

</div><!-- /.container -->

<?php
include('layout/footer.php');
include('layout/script.php'); ?>

</body>
</html>
