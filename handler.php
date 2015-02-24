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
	}
}
$page->insert();