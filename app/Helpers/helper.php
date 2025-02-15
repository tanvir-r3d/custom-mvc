<?php

if (!function_exists('view')) {
	function view($view_name = '', $data = [])
	{
		if (!empty($view_name)) {
			if (!empty($data) && is_array($data)) {
				extract($data);
			}

			require_once __DIR__ . "/../../resources/views/{$view_name}.php";
		}
	}
}

if (!function_exists('include_asset')) {
	function include_asset($asset_name = '')
	{
		if (!empty($asset_name)) {
			require_once __DIR__ . "/../../resources/views/{$asset_name}.php";
		}
	}
}

if (!function_exists('partial_asset')) {
	function partial_asset($partial = '', $data = [])
	{
		if (!empty($partial)) {
			if (!empty($data) && is_array($data)) {
				extract($data);
			}
			require_once __DIR__ . "/../../resources/views/{$partial}.php";
		}
	}
}

if (!function_exists('dd')) {
	function dd($data = [])
	{
		if (!empty($data)) {
			echo "<pre>";
			print_r($data);
			echo "</pre>";
		}
		die();
	}
}

if (!function_exists('baseUri')) {
	function baseUri()
	{
		$requestUri = $_SERVER['REQUEST_URI'];
		$explodedString = explode('/', $requestUri);
		return '/' . $explodedString[1];
	}
}

if (!function_exists('generateHash')) {
	function generateHash($key)
	{
		$data = $key . $_ENV['SECRET_KEY'];

		return hash('sha512', $data);
	}
}

if (!function_exists('validateInput')) {
	function validateInput($input, $pattern)
	{
		return preg_match($pattern, $input);
	}
}