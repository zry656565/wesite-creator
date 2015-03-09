<?php
require_once('../model/wesiteModel.php');

if (!isset($_GET['id'])) {
	include('../404.php');
	return;
}

$page = new Page();
$page->load($_GET['id']);

if (!$page->id) {
	include('../404.php');
	return;
}
?>

<!doctype html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title><?= $page->pageName ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="description" content="<?= $page->description ?>">
	<link rel="stylesheet" href="../assets/library/idangerous.swiper/idangerous.swiper.css">
	<link rel="stylesheet" href="../assets/stylesheet/show.css?v=1.1.0">
	<!-- script -->
	<script src="../assets/library/jquery/jquery-1.11.2.min.js"></script>
	<script src="../assets/library/velocity/velocity.min.js"></script>
	<script src="../assets/library/idangerous.swiper/idangerous.swiper.js"></script>
	<script src="../assets/library/spin/spin.js"></script>
	<script src="../assets/javascript/wesite.js?v=1.1.0"></script>

	<!-- 百度统计 -->
	<script>
		if (['127.0.0.1', 'localhost', '192.168.1.1'].indexOf(document.domain) < 0) {
			var _hmt = _hmt || [];
			(function() {
				var hm = document.createElement("script");
				hm.src = "//hm.baidu.com/hm.js?827c8bc94d0162dab3092ab90aa9ef83";
				var s = document.getElementsByTagName("script")[0];
				s.parentNode.insertBefore(hm, s);
			})();
		}
	</script>
</head>
<body>

<div id="spinner"></div>
<div id="loading-hover"></div>
<audio id="music" preload="auto" autoplay loop>
	<source src="<?= $page->bgm ?>" type="audio/mpeg">
</audio>

<div class="swiper-container">
	<div class="swiper-wrapper">
		<?php
		$id = 1;
		foreach ($page->slides() as $slide) { ?>
			<div class="swiper-slide" data-id="<?= $id ?>">
				<img class="music-icon" src="//women-image.b0.upaiyun.com/assets/music2.png"/>
				<img class="background" src="<?= $slide->background ? $slide->background : $page->bg ?>" />
				<?php
				foreach ($slide->assets() as $asset) { ?>
					<img class="sub" src="<?= $asset->src ?>"
						 style="width: <?= $asset->width ?>%;
							 height: <?= $asset->height ?>%;
							 left: <?= $asset->left ?>%;
							 top: <?= $asset->top ?>%;"/>
				<?php
				}
				?>
				<img class="arrow" src="../assets/images/arrow.gif" />
			</div>
			<?php
			$id++;
		}
		?>
	</div>
</div>

</body>
</html>