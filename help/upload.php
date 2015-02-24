<?php

class ImageConfig {
	public static function getConfig($type = 'image') {
		$expire = time() + 6000;
		if ($type === 'image') {
			$bucket = "women-image";
			$secret = "MTWYHiC4ba6VVfz8GkAvruqDZ9s=";
			$options = array(
				'bucket' => $bucket,
				'expiration' => $expire,
				'save-key' => "/{year}-{mon}/{filemd5}{.suffix}",
				'content-length-range' => '0,10485760',
				'image-width-range' => '0,18048',
				'image-height-range' => '0,18048',
				'x-gmkerl-type' => 'fix_width',
				'x-gmkerl-value' => '1024',
				'x-gmkerl-rotate' => 'auto',
			);
		} else {
			$bucket = "women-music";
			$secret = "uBlL0wAOIHBuT1YIOkSKBxrEEyk=";
			$options = array(
				'bucket' => $bucket,
				'expiration' => $expire,
				'save-key' => "/{year}-{mon}/{filemd5}{.suffix}",
				'content-length-range' => '0,10485760',
			);
		}
		$policy = base64_encode(json_encode($options));
		$signature = md5($policy . '&' . $secret);
		return array(
			'url' => 'http://v0.api.upyun.com/' . $bucket,
			'params' => array(
				'policy' => $policy,
				'signature' => $signature,
			),
			'fileKey' => 'file',
			'expire' => $expire,
		);
	}
}