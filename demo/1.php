<?php

$demo = true;

$id = 1;
$pageName = 'DEMO PAGE';
$assetRoot = '//women-image.b0.upaiyun.com/demo/1/';
$music = '//women-music.b0.upaiyun.com/demo/sunrise_little.mp3';
$data = array(
	'slides' => array(
		array(
			'background' => $assetRoot . '1.jpg',
		), array(
			'background' => $assetRoot . '3.jpg',
		), array(
			'background' => $assetRoot . '5_bg.png',
			'id' => 5,
			'header' => $assetRoot . '5_header.png',
			'body' => $assetRoot . '5_body.png',
			'footer' => $assetRoot . '5_footer1.png',
		), array(
			'background' => $assetRoot . '25k.jpg',
		), array(
			'background' => $assetRoot . '30min.jpg',
		), array(
			'background' => $assetRoot . '30y.jpg',
		), array(
			'background' => $assetRoot . '80.jpg',
		),
	)
);

include('../show/demo.php');