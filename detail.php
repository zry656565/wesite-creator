<?php
require_once('model/wesiteModel.php');

if (!isset($_GET['id'])) {
	include('404.php');
	return;
}

$page = new Page();
$page->load($_GET['id']);

if (!$page->id) {
	include('404.php');
	return;
}
?>

<!DOCTYPE html>
<html lang="zh-CN">

<?php include('layout/head.php'); ?>

<body>

<?php
$currentNav = '';
include('layout/header.php');
?>

<div class="container">
	<div class="head-info col-lg-12 col-md-12">
		<h1><?= $page->pageName ?></h1>
		<p class="lead">扫描下方的二维码查看效果，你也可以点击修改按钮进行修改。</p>
		<div id="qrcode"></div>
		<a href="/create.php?id=<?= $_GET['id'] ?>">
			<button type="button" class="btn btn-primary btn-lg">修改</button>
		</a>
	</div>
</div>

<?php
include('layout/footer.php');
include('layout/script.php'); ?>

<script src="assets/library/qrcode/qrcode.min.js"></script>
<script>
	var $qr = $('#qrcode');
	new QRCode("qrcode", {
		text: "http://<?= $_SERVER['HTTP_HOST'] ?>/show?id=<?= $_GET['id'] ?>",
		width: $qr.width(),
		height: $qr.height()
	});
</script>

</body>
</html>