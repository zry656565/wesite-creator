<!doctype html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title><?= $pageName ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="../assets/library/idangerous.swiper/idangerous.swiper.css">
	<link rel="stylesheet" href="../assets/stylesheet/show.css">
	<!-- script -->
	<script src="../assets/library/jquery/jquery-1.11.2.min.js"></script>
	<script src="../assets/library/idangerous.swiper/idangerous.swiper.js"></script>
	<script src="../assets/library/spin/spin.js"></script>
	<script src="../assets/javascript/wesite.js"></script>
</head>
<body>

<div id="spinner"></div>
<div id="loading-hover"></div>
<audio id="music" src="//women-music.b0.upaiyun.com/demo/sunrise.mp3" autoplay controls loop></audio>

<div class="swiper-container">
	<div class="swiper-wrapper">
		<?php
		foreach ($data['slides'] as $slide) { ?>
			<div class="swiper-slide">
				<img class="background" src="<?= $slide['background'] ?>" />
				<img class="arrow" src="../assets/images/arrow.gif" />
			</div>
		<?php
		}
		?>
	</div>
</div>

</body>
</html>