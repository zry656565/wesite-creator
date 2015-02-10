<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">WomenIdea微信网页生成器</a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="<?= ($currentNav === 'home' ? 'active' : '' ) ?>"><a href="/">首页</a></li>
				<li class="<?= ($currentNav === 'create' ? 'active' : '' ) ?>"><a href="/create.php">创建</a></li>
				<li><a href="//www.womenidea.net">关于</a></li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>