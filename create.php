<?php
require_once('help/upload.php');
$imgConfig = ImageConfig::getConfig('image');
$musicConfig = ImageConfig::getConfig('music');

$id = $_GET['id'];
$update = isset($id);
if ($update) {
	require_once('model/wesiteModel.php');
	$page = new Page();
	$page->load($id);
	if (!$page->id) {
		$update = false;
	}
}
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
		<p>注意：预览图仅供参考，实际效果请在真机上查看。</p>
		<div class="iphone">

		</div>
	</div>

	<div class="config col-lg-6 col-md-6">
		<h2>配置</h2>
		<div class="form-group">
			<label for="title" class="sr-only">微网页标题</label>
			<input type="text" class="form-control" name="title" placeholder="微网页标题" value="<?= $update ? $page->pageName : '' ?>">
		</div>
		<div class="form-group">
			<label for="description" class="sr-only">微网页描述</label>
			<textarea class="form-control" name="description" placeholder="微网页描述"><?= $update ? $page->description : '' ?></textarea>
		</div>
		<div class="form-group">
			<label for="bgm">背景音乐</label>
			<input type="file" name="bgm">
			<button class="btn btn-default btn-sm music-upload">上传</button>
			<p class="help-block"><?= $update && $page->bgm ? '已上传音乐：'.$page->bgm : '为了让用户更快地加载出页面，请截取并压缩好背景音乐后再上传' ?></p>

		</div>
		<div class="form-group">
			<label for="default-background">背景图片</label>
			<input type="file" name="default-background">
			<button class="btn btn-default btn-sm background-upload">上传</button>
			<p class="help-block"><?= $update && $page->bg ? '已上传背景图片：'.$page->bg : '默认背景图片，请上传宽高比为2:3左右的背景图片' ?></p>
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
		<button type="button" class="btn btn-primary">刷新预览图</button>
		<button type="button" class="btn btn-success post"><?= $update ? '修改' : '发布' ?></button>
		<?php if ($update) { ?>
		<button type="button" class="btn btn-danger delete">删除</button>
		<?php } ?>
	</div>

</div><!-- /.container -->

<?php
include('layout/footer.php');
include('layout/script.php'); ?>
<script src="assets/javascript/create.js"></script>
<?php
if ($update) { ?>
<script>
	$('.iphone').append('<img class="background" src="<?= $page->bg ?>"/>');
	$W.pageInfo = {
		title: "<?= $page->pageName ?>",
		description: "<?= $page->description ?>",
		defaultBackground: "<?= $page->bg ?>",
		bgm: "<?= $page->bgm ?>",
		id: "<?= $page->id ?>"
	};

	var delDisable = false;
	$('.btn.delete').click(function() {
		if (delDisable) return;

		delDisable = true;
		$.ajax({
			url: 'delete.php',
			type: 'post',
			data: { id: <?= $_GET['id'] ?> },
			success: function(result) {
				delDisable = false;
				window.location.href = "/";
			},
			error: function(result) {
				alert('与服务器通信时发生错误。');
				delDisable = false;
			}
		});
	});
</script>
<?php
} ?>

</body>
</html>
