<?php

class ImageHelper {
	public static function getContentHeader($filename){
		$folder = '/image/content/header/';
		$fileBefore = public_path().$folder.$filename;
		if (file_exists($fileBefore)) {
			return asset($folder.$filename);
		}
		return 'default-image.jpg';
	}
	public static function getContentHeaderThumb($filename){
		$folder = '/image/content/header-thumb/';
		$fileBefore = public_path().$folder.$filename;
		if (file_exists($fileBefore)) {
			return asset($folder.$filename);
		}
		return 'default-image.jpg';
	}
}