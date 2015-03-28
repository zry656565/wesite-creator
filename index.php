<?php
require_once('model/wesiteModel.php');
require_once('help/needLogin.php');
$page = new Page();
$pages = $page->find();
?>
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
	foreach ($pages as $page) { ?>
		<div class="col-lg-3 col-md-3">
			<a href="/detail.php?id=<?= $page->id ?>">
			<div class="page" style="background-image: url(<?= $page->bg ?>); background-size: cover;">
				<?= $page->pageName ?>
			</div>
			</a>
		</div>
	<?php
	} ?>

</div><!-- /.container -->

<?php
include('layout/footer.php');
include('layout/script.php'); ?>

</body>
</html>
