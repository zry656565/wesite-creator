<?php
require_once('upload.php');
$imgConfig = ImageConfig::getConfig('image');
$musicConfig = ImageConfig::getConfig('music');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<?php include('layout/head.php'); ?>
<script>
	var $W = {
		uploadImage: {
			url: "<?= $imgConfig['url'] ?>",
			policy: "<?= $imgConfig['params']['policy'] ?>",
			signature: "<?= $imgConfig['params']['signature'] ?>"
		},
		uploadMusic: {
			url: "<?= $musicConfig['url'] ?>",
			policy: "<?= $musicConfig['params']['policy'] ?>",
			signature: "<?= $musicConfig['params']['signature'] ?>"
		}
	};
</script>
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
		<div class="form-group">
			<label for="title" class="sr-only">微网页标题</label>
			<input type="text" class="form-control" name="title" placeholder="微网页标题">
		</div>
		<div class="form-group">
			<label for="description" class="sr-only">微网页描述</label>
			<textarea class="form-control" name="description" placeholder="微网页描述"></textarea>
		</div>
		<div class="form-group">
			<label for="bgm">背景音乐</label>
			<input type="file" name="bgm">
			<button class="btn btn-default btn-sm music-upload">上传</button>
			<p class="help-block"></p>
		</div>
		<div class="form-group">
			<label for="default-background">背景图片</label>
			<input type="file" name="default-background">
			<button class="btn btn-default btn-sm background-upload">上传</button>
			<p class="help-block"></p>
		</div>
<!--		<h4>头部内容</h4>-->
<!--		<textarea name="header"></textarea>-->
<!--		<h4>中部内容</h4>-->
<!--		<textarea name="content"></textarea>-->
<!--		<h4>尾部内容</h4>-->
<!--		<textarea name="footer"></textarea>-->
<!--		<h4>背景图片</h4>-->
<!--		<input type="file" name="background"/>-->
<!--		<h4>背景音乐</h4>-->
<!--		<input type="file" name="music"/>-->
		<button type="button" class="btn btn-success">发布</button>
	</div>

</div><!-- /.container -->

<?php
include('layout/footer.php');
include('layout/script.php'); ?>
<script src="assets/javascript/create.js"></script>

</body>
</html>
