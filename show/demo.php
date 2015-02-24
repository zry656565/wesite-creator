<!doctype html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title><?= $pageName ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="../assets/library/idangerous.swiper/idangerous.swiper.css">
	<link rel="stylesheet" href="../assets/stylesheet/show.css">
	<?php
	if (isset($id) && $id === 1) { ?>
	<link rel="stylesheet" href="../assets/stylesheet/demo/1.css">
	<?php
	} ?>
	<!-- script -->
	<script src="../assets/library/jquery/jquery-1.11.2.min.js"></script>
	<script src="../assets/library/idangerous.swiper/idangerous.swiper.js"></script>
	<script src="../assets/library/spin/spin.js"></script>
	<?php
	if (isset($id) && $id === 1) { ?>
		<script src="../assets/javascript/demo/1.js"></script>
	<?php
	} ?>
</head>
<body>

<div id="spinner"></div>
<div id="loading-hover"></div>
<audio id="music" preload="auto" autoplay loop>
	<source src="<?= $music ?>" type="audio/mpeg">
</audio>

<div class="swiper-container">
	<div class="swiper-wrapper">
		<?php
		foreach ($data['slides'] as $slide) { ?>
			<div class="swiper-slide" <?= isset($slide['id']) ? "data-id=\"{$slide['id']}\"" : "" ?>>
				<img class="music-icon" src="../assets/images/music.png"/>
				<img class="background" src="<?= $slide['background'] ?>" />
				<?php if (isset($slide['id'])) { ?>
				<img class="header sub" src="<?= $slide['header'] ?>"/>
				<img class="body sub" src="<?= $slide['body'] ?>"/>
				<img class="footer sub" src="<?= $slide['footer'] ?>"/>
				<?php
				} ?>
				<img class="arrow" src="../assets/images/arrow.gif" />
			</div>
		<?php
		}
		?>
	</div>
</div>

</body>
</html>