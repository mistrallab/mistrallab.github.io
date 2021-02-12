<?php

function sanitize($item) {
	return htmlentities(strip_tags(trim($item)));
}

function links($item) {
	global $base_url;
	return $base_url ."/". $item;
}

function getUrl() {
	$protocol = (isset($_SERVER['HTTPS']) === true) ? 'https' : 'http';
	$url = $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$parsedUrl = parse_url($url);
	$path = sanitize($parsedUrl['path']);
	return explode('/', $path);
}

function isPage($page) {
	if (file_exists($page)) {
		return $page;
	} else {
		return "pages/not-found.php";
	}
}

function getPage($url) {
	if (strpos(end($url), ".") === false) {
		if (isset($url[0]) === false || empty($url[1]) === true) {
			return isPage("pages/home.php");
		} else {
			return isPage("pages/". $url[1] .".php");
		}
	}
}

function getPageTitle($page) {
	$main_title = "NetLAB - Network Modeling Lab";
	$content = file_get_contents($page);
	$pattern = "/<h2>(.*?)<\/h2>/";
	preg_match_all($pattern, $content, $title);
	$title = trim(strip_tags($title[1][0]));
	return (empty($title) === true) ? $main_title: $title ." – ". $main_title;
}

?>
