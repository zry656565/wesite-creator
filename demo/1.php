<?php

$demo = true;

$pageName = 'DEMO PAGE';
$assetRoot = 'http://women-image.b0.upaiyun.com/demo/1/';
$data = array(
	'slides' => array(
		array(
			'background' => $assetRoot . '1.jpg',
		), array(
			'background' => $assetRoot . '3.jpg',
		), array(
			'background' => $assetRoot . '5.jpg',
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