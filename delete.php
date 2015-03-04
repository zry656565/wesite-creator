<?php
require_once('model/wesiteModel.php');

if (isset($_POST['id'])) {
	$page = new Page();
	$page->id = $_POST['id'];
	$page->delete(false);
}