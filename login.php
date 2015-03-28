<!DOCTYPE html>
<html lang="zh-CN">

<?php include('layout/head.php'); ?>

<body>

<?php
include('layout/header.php');
?>

<div class="container">

	<div class="col-lg-3 col-md-3">
		<h1>登陆</h1>
		<form method="post" action="loginCheck.php">
			<div class="form-group">
				<label for="password">管理员密码</label>
				<input type="password" name="password" class="form-control" id="password" placeholder="密码">
			</div>
			<button type="submit" name="submit" class="btn btn-default">登陆</button>
		</form>
	</div>

</div><!-- /.container -->

<?php
include('layout/footer.php');
include('layout/script.php'); ?>

</body>
</html>
