<!doctype html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title><?= $pageName ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="description" content="<?= $description ?>">
	<link rel="stylesheet" href="../assets/library/idangerous.swiper/idangerous.swiper.css">
	<link rel="stylesheet" href="../assets/stylesheet/show.css?v=1.1.0">
	<link rel="stylesheet" href="../assets/library/fancyBox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
	<?php
	if (isset($id) && $id === 1) { ?>
	<link rel="stylesheet" href="../assets/stylesheet/demo/1.css?v=1.1.3">
	<?php
	} ?>
	<!-- script -->
	<script src="../assets/library/jquery/jquery-1.11.2.min.js"></script>
	<script src="../assets/library/velocity/velocity.min.js"></script>
	<script src="../assets/library/idangerous.swiper/idangerous.swiper.js"></script>
	<script src="../assets/library/spin/spin.js"></script>
	<script type="text/javascript" src="../assets/library/fancyBox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
	<?php
	if (isset($id) && $id === 1) { ?>
		<script src="../assets/javascript/demo/1.js?v=1.1.3"></script>
	<?php
	} ?>

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
<audio id="music" preload="auto" loop>
	<source src="<?= $music ?>" type="audio/mpeg">
</audio>

<div class="swiper-container">
	<div class="swiper-wrapper">
		<?php
		$id = 1;
		foreach ($data['slides'] as $slide) { ?>
			<div class="swiper-slide" data-id="<?= $id ?>">
				<img class="music-icon" src="//women-image.b0.upaiyun.com/assets/music2.png"/>
				<img class="background" src="<?= $slide['background'] ?>" />
				<?php
				if (isset($slide['asset'])) { ?>
				<a class="fancybox-link" href="#fancybox-<?= $id ?>">
					<?php
					foreach ($slide['asset'] as $asset) { ?>
					<img class="sub" src="<?= $asset['src'] ?>"
						 style="width: <?= $asset['width'] ?>%;
							 height: <?= $asset['height'] ?>%;
							 left: <?= $asset['left'] ?>%;
							 top: <?= $asset['top'] ?>%;"/>
					<?php
					} ?>
				</a>
					<?php
				}?>
				<img class="arrow" src="../assets/images/arrow.gif" />
				<div id="fancybox-<?= $id ?>" class="fancybox"><?= $slide['content'] ?></div>
			</div>
		<?php
			$id++;
		}
		?>
	</div>
</div>

</body>
</html>