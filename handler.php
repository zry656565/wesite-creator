<?php
require_once('model/wesiteModel.php');

$page = new Page();
foreach ($_POST as $key => $value) {
	switch($key) {
		case 'title':
			$page->pageName = "'$value'";
			break;
		case 'description':
			$page->description = "'$value'";
			break;
		case 'defaultBackground':
			$page->bg = "'$value'";
			break;
		case 'bgm':
			$page->bgm = "'$value'";
			break;
		case 'id':
			$page->id = "$value";
			break;
	}
}
if (isset($_POST['id'])) {
	$page->update();
} else {
	$pageId = $page->insert(true);
	foreach ($_POST['slides'] as $slide) {
		$s = new Slide();
		$s->background = "'{$slide->background}'";
		$s->pageId = $pageId;
		$slideId = $s->insert(true);
		foreach ($slide['assets'] as $asset) {
			$a = new Asset();
			$a->src = "'{$asset['src']}'";
			$a->width = "'{$asset['width']}'";
			$a->height = "'{$asset['height']}'";
			$a->top = "'{$asset['top']}'";
			$a->left = "'{$asset['left']}'";
			$a->slideId = $slideId;
			$a->insert();
		}
	}
}