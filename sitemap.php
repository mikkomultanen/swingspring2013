<?php
include 'pages.php';

function curPageName() {
	return $_SERVER['SERVER_NAME'].substr($_SERVER["SCRIPT_NAME"],0,strrpos($_SERVER["SCRIPT_NAME"],"/"));
}
date_default_timezone_set("Europe/Helsinki");
header('Content-type: text/xml');
print '<?xml version="1.0" encoding="UTF-8"?>'."\n";
print '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
$languages = array();
$languages[0] = 'fin';
$languages[1] = 'eng';

foreach ( $languages as $language ) {
	foreach ( $pages as $page ) {
		$filename = $language.'_'.$page[0].".html";
		if (file_exists($filename)) {
			print "<url>"."\n";
			print "<loc>http://".curPageName().'/index.php?pageId='.$page[0].'&amp;language='.$language."</loc>"."\n";
			print "<lastmod>".date("Y-m-d", filemtime($filename))."</lastmod>"."\n";
			print "<changefreq>daily</changefreq>"."\n";
			print "<priority>0.8</priority>"."\n";
			print "</url>"."\n";
		}
	}
}
print '</urlset>'."\n";
?>