<?php
require_once('model/wesiteModel.php');

$page = new Page();
$page->load(1);

$data = [
	'title' => $page->pageName,
	'music' => $page->bgm,
	'slides' => $page->slides(),
];
?>

<!doctype html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title><?= $page->pageName ?></title>
	<meta name="viewport" content="width=device-width, target-densityDpi=medium-dpi, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="../assets/library/idangerous.swiper/idangerous.swiper.css">
	<link rel="stylesheet" href="../assets/stylesheet/wesite.css">
	<!-- script -->
	<script src="../assets/library/jquery/jquery-1.11.2.min.js"></script>
	<script src="../assets/library/idangerous.swiper/idangerous.swiper.js"></script>
	<script src="../assets/javascript/wesite.js"></script>
</head>
<body>

<div class="swiper-container">
	<div class="swiper-wrapper">
		<?php
		foreach ($page->slides() as $slide) { ?>
			<div class="swiper-slide">
				<?= $slide->title ?>
				<?= $slide->content ?>
				<?= $slide->footer ?>
			</div>
		<?php
		}
		?>
	</div>
</div>

</body>
</html>