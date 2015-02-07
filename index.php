<?php
/**
 * User: Jerry
 * Date: 15/2/7
 */
$title = 'Hello World';
?>

<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<meta name="viewport" content="width=device-width, target-densityDpi=medium-dpi, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="assets/library/idangerous.swiper/idangerous.swiper.css">
	<link rel="stylesheet" href="assets/stylesheet/wesite.css">
</head>
<body>

<div class="swiper-container">
	<div class="swiper-wrapper">
		<!--First Slide-->
		<div class="swiper-slide">
			11111111
		</div>

		<!--Second Slide-->
		<div class="swiper-slide">
			2222222
		</div>

		<!--Third Slide-->
		<div class="swiper-slide">
			3333333
		</div>
		<!--Etc..-->
	</div>
</div>

<!-- script -->
<script src="assets/library/jquery/jquery-1.11.2.min.js"></script>
<script src="assets/library/idangerous.swiper/idangerous.swiper.js"></script>
<script src="assets/javascript/wesite.js"></script>
</body>
</html>