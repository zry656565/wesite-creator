<?php
require_once('help/upload.php');
require_once('help/needLogin.php');

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
	} else {
		// 准备起始数据
		$slides = $page->slides();
		$firstSlide = $slides[0];
		$assets = $firstSlide->assets();
		$firstAsset = $assets[0];

		$pageJson = array(
			'id' => $page->id,
			'title' => $page->pageName,
			'description' => $page->description,
			'defaultBackground' => $page->bg,
			'bgm' => $page->bgm,
			'slides' => array(),
		);
		foreach ($slides as $slide) {
			$assets = $slide->assets();
			$assetArr = array();
			foreach ($assets as $asset) {
				$assetArr[] = array(
					'id' => $asset->id,
					'src' => $asset->src,
					'width' => $asset->width,
					'height' => $asset->height,
					'left' => $asset->left,
					'top' => $asset->top,
					'order' => $asset->order,
					'slideId' => $asset->slideId,
				);
			}
			$slideJson = array(
				'id' => $slide->id,
				'background' => $slide->background,
				'blurBackground' => $slide->blurBackground,
				'pageId' => $slide->pageId,
				'link' => $slide->link,
				'assets' => $assetArr,
			);
			$pageJson['slides'][] = $slideJson;
		}
		$pageJson = json_encode($pageJson);
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
			<input type="text" class="form-control" name="description" placeholder="微网页描述" value="<?= $update ? $page->description : '' ?>">
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
		<ul class="nav nav-tabs nav-slides">
			<li data-slide-id="1" class="active"><a>P1</a></li>
			<?php
			if ($update) {
				for ($i = 2; $i <= count($slides); $i++) {
					echo '<li data-slide-id="'. $i .'"><a>P'. $i .'</a></li>';
				}
			} ?>
			<li class="add"><a id="add-slide">+</a></li>
		</ul>
		<div class="slide-content form-inline">
			<div class="form-group">
				<label for="slide-background">本页背景</label>
				<input type="file" name="slide-background">
				<button id="slide-background-upload" class="btn btn-default btn-sm">上传</button>
				<p class="slide-bg help-block"><?= $update && $firstSlide->background ? '已上传本页背景：'.$firstSlide->background : '' ?></p>
			</div>
			<div class="form-group">
				<label for="slide-link">本页链接</label>
				<input type="text" class="form-control" name="slide-link" placeholder="请输入链接地址" value="<?= $update && $firstSlide->link ? $firstSlide->link : '' ?>"/>
			</div>
			<br/>
			<div class="tips">
				说明：如果填写“模糊图片”，将会使得页面获得雾面擦除效果。用户需擦拭屏幕才能看到内容。“模糊图片”用于显示擦拭前的视觉效果。
			</div>
			<div class="form-group">
				<label for="slide-background">模糊图片</label>
				<input type="file" name="slide-blurBackground">
				<button id="slide-blurBackground-upload" class="btn btn-default btn-sm">上传</button>
				<p class="slide-blurBg help-block"><?= $update && $firstSlide->blurBackground ? '已上传本页背景：'.$firstSlide->blurBackground : '' ?></p>
			</div>
			<div class="form-group" style="display: block;">
				<button type="button" class="btn btn-xs btn-danger delete-slide">删除当前页面</button>
			</div>
			<hr/>
			<div class="resource">
				<ul class="nav nav-pills nav-assets">
					<li class="active" data-asset-id="1"><a>A1</a></li>
					<?php
					if ($update) {
						for ($i = 2; $i <= count($firstSlide->assets()); $i++) {
							echo '<li data-asset-id="'. $i .'"><a>A'. $i .'</a></li>';
						}
					} ?>
					<li class="add"><a id="add-asset">+</a></li>
				</ul>
				<div class="form-group">
					<label for="asset-src">资源图片</label>
					<input type="file" name="asset-src">
					<button id="asset-upload" class="btn btn-default btn-sm">上传</button>
					<p class="asset help-block"><?= $update && $firstAsset->src ? '已上传资源图片：'.$firstAsset->src : '' ?></p>
				</div>
				<div class="form-group">
					<label for="asset-width">宽度</label>
					<input type="text" class="form-control" name="asset-width" placeholder="请输入宽度" value="<?= $update && $firstAsset->width ? $firstAsset->width : '' ?>">
				</div>
				<div class="form-group">
					<label for="asset-left">左边距</label>
					<input type="text" class="form-control" name="asset-left" placeholder="请输入左边距" value="<?= $update && $firstAsset->left ? $firstAsset->left : '' ?>">
				</div>
				<hr/>
				<div class="form-group">
					<label for="asset-height">高度</label>
					<input type="text" class="form-control" name="asset-height" placeholder="请输入高度" value="<?= $update && $firstAsset->height ? $firstAsset->height : '' ?>">
				</div>
				<div class="form-group">
					<label for="asset-right">上边距</label>
					<input type="text" class="form-control" name="asset-top" placeholder="请输入上边距" value="<?= $update && $firstAsset->top ? $firstAsset->top : '' ?>">
				</div>
				<hr/>
				<div class="form-group">
					<label for="asset-order">动画顺序（填0则无动画）</label>
					<input type="text" class="form-control" name="asset-order" placeholder="请输入动画顺序" value="<?= $update && $firstAsset->order ? $firstAsset->order : '' ?>">
				</div>
				<div class="form-group" style="display: block;">
					<button type="button" class="btn btn-xs btn-danger delete-asset">删除当前资源图片</button>
				</div>
			</div>
		</div>
		<div class="btn-group final">
			<button type="button" class="btn btn-primary refresh">刷新预览图</button>
			<button type="button" class="btn btn-success post"><?= $update ? '修改' : '发布' ?></button>
<!--			<button type="button" class="btn btn-danger asset-delete">删除当前资源</button>-->
		</div>
	</div>

</div><!-- /.container -->

<?php
include('layout/footer.php');
include('layout/script.php'); ?>
<script src="assets/javascript/create.js?v=1.4.0"></script>
<?php
if ($update) { ?>
<script>
	$W.pageInfo = $.extend($W.pageInfo, JSON.parse('<?= $pageJson ?>'));
	$W.pageInfo.refresh();

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
