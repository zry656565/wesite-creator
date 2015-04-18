<?php
require_once('model/wesiteModel.php');

$page = new Page();
$page->pageName = "'{$_POST['title']}'";
$page->description = "'{$_POST['description']}'";
$page->bg = "'{$_POST['bg']}'";
$page->bgm = "'{$_POST['bgm']}'";

//delete the useless slides and assets
foreach ($_POST['removedSlides'] as $removedSlideId) {
	$s = new Slide();
	$s->id = $removedSlideId;
	$s->delete(false);
}
foreach ($_POST['removedAssets'] as $removedAssetId) {
	$a = new Asset();
	$a->id = $removedAssetId;
	$a->delete(false);
}

if (isset($_POST['id'])) {
	$page->id = $_POST['id'];
	$page->update();
	$pageId = $page->id;
} else {
	$pageId = $page->insert(true);
}
foreach ($_POST['slides'] as $slide) {
	$s = new Slide();
	$s->background = "'{$slide['background']}'";
	$s->blurBackground = "'{$slide['blurBackground']}'";
	$s->link = "'{$slide['link']}'";
	if ($slide['id']) {
		$s->id = $slide['id'];
		$s->update();
		$slideId = $s->id;
	} else {
		$s->pageId = $pageId;
		$slideId = $s->insert(true);
	}
	foreach ($slide['assets'] as $asset) {
		$a = new Asset();
		$a->src = "'{$asset['src']}'";
		$a->width = "'{$asset['width']}'";
		$a->height = "'{$asset['height']}'";
		$a->top = "'{$asset['top']}'";
		$a->left = "'{$asset['left']}'";
		$a->order = "'{$asset['order']}'";
		if ($asset['id']) {
			$a->id = $asset['id'];
			$a->update();
		} else {
			$a->slideId = $slideId;
			$a->insert();
		}
	}
}