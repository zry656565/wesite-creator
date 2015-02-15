<!doctype html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title><?= $pageName ?></title>
	<meta name="viewport" content="width=device-width, target-densityDpi=medium-dpi, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="../assets/library/idangerous.swiper/idangerous.swiper.css">
	<link rel="stylesheet" href="../assets/stylesheet/wesite.css">
	<style>
		.background {
			width: 100%;
			height: 100%;
		}
	</style>
	<!-- script -->
	<script src="../assets/library/jquery/jquery-1.11.2.min.js"></script>
	<script src="../assets/library/idangerous.swiper/idangerous.swiper.js"></script>
	<script src="../assets/library/spin/spin.js"></script>
	<script src="../assets/javascript/wesite.js"></script>
</head>
<body>

<div id="spinner"></div>
<div id="loading-hover"></div>

<div class="swiper-container">
	<div class="swiper-wrapper">
		<?php
		foreach ($data['slides'] as $slide) { ?>
			<div class="swiper-slide">
				<img class="background" src="<?= $slide['background'] ?>" />
			</div>
		<?php
		}
		?>
	</div>
</div>

</body>
</html>