<!DOCTYPE html>
<html lang="zh-CN">

<?php include('layout/head.php'); ?>

<body>

<?php
$currentNav = 'home';
include('layout/header.php');
?>

<div class="container">

	<div class="head-info col-lg-12 col-md-12">
		<h1>WomenIdea微信网页生成器</h1>
		<p class="lead">你可以点击下面已经生成好的页面进行查看/修改，或者重新创建一个新的页面。</p>
		<a href="/create.php"><button type="button" class="btn btn-success btn-lg create-btn">创建新的页面</button></a>
	</div>

	<?php
	$arr = [1,2,3,4,5,6,7,8];
	foreach ($arr as $a) { ?>
		<div class="col-lg-3 col-md-3">
			<div class="page"><?= $a ?></div>
		</div>
	<?php
	} ?>

</div><!-- /.container -->

<?php include('layout/script.php'); ?>
</body>
</html>
