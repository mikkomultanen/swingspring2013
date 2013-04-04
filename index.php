<html>
<head>
<title>Swing Spring 2013</title>  
<meta name="Author" content="Swing Spring 2013 Crew" /> 
<meta name="Keywords" content="Swing Spring 2013 lindy hop balboa dance camp" /> 
<meta name="Description" content="Swing Spring 2013 dance camp in Himos, Jämsä Finland" /> 
<meta property="og:title" content="Swing Spring 2013" />
<meta property="og:type" content="activity" />
<meta property="og:url" content="http://swingspring.lindyhop.fi" />
<meta property="og:image" content="http://swingspring.lindyhop.fi/logo.png" />
<meta property="og:site_name" content="Swing Spring 2013" />
<meta property="og:description" content="Swing Spring 2013 dance camp in Himos, Jämsä Finland" />
<meta property="fb:admins" content="660309614" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link rel="icon" type="image/png" href="favicon.png" />
<link rel="stylesheet" type="text/css" href="style.css?<?php print(floor(time()/(60*60)))?>" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script defer src="http://balupton.github.com/history.js/scripts/bundled/html4+html5/jquery.history.js"></script>
</head>
<?php
include 'pages.php';

// get the current $language id
if (isset($_GET['language'])) {
	if (($_GET['language']=="fin") || ($_GET['language']=="eng")){
		$language = $_GET['language'];
	} else {
		$language = "eng";
	}
} else {
	if(strrpos($_SERVER["HTTP_ACCEPT_LANGUAGE"],"fi") !== false) {
		$language = "fin";
	} else {
		$language = "eng";
	}
}

// get the current page id
if (isset($_GET['pageId'])) {
	$pageId = $_GET['pageId'];
} else {
	$pageId = $pages[0][0];
}

?>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/" + (<?php echo '"'.$language.'"' ?> == "fin" ? "fi_FI" : "en_US") + "/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>	
<div id="content">
<div id="logo">&nbsp;</div>
<h1 class="site-header">Swing Spring 2013</h1>
<div id="menu">
<?php
function curPageName() {
	return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}

$foundValidPage = false;
// find the correct menu button for pageId:
foreach ( $pages as $page ) {
	$id = $page[0];
	if($language=='fin') {
		$name = $page[1];
	} else {
		$name = $page[2];
	}
	if($id == $pageId) {
		$foundValidPage = true;
		$clazz = ' class="active"';
	} else {
		$clazz = '';
	} 
	print('<a href="'.curPageName().'?pageId='.$id.'&language='.$language.'"'.$clazz.'>'.$name.'</a>'."\n");
}

?>
</div>
<div id="fb">
<div class="fb-like" data-href="http://swingspring.lindyhop.fi" data-send="false" data-layout="button_count" data-width="240" data-show-faces="false"></div>
</div>
<div id="languages" class="shadow">
<?php
// the language changing flag-icons
if ($language=='eng') {
	print('<a href="'.curPageName().'?pageId='.$pageId.'&language=fin"><img src="flag_fin.jpg" border="0" alt="Suomeksi"></a>');
} else {
	print('<a href="'.curPageName().'?pageId='.$pageId.'&language=eng"><img src="flag_eng.jpg" border="0" alt="In English"></a>');
}
?>
</div>
<div id="page">
<?php
// try to open the page with the content in html.
$filename = $language.'_'.$pageId.".html";

if (file_exists($filename)) {
	$fd = fopen("$filename", "r");
	$htmlContent = fread($fd, filesize("$filename"));
	print($htmlContent);
	fclose($fd);
} else {
	if($language=="eng"){
		print('<p>Page not found. Click <a href="'.curPageName().'?pageId='.$menuButtons[0]->id.'&language=eng">here to continue</a></p>');
	} else {
		print('<p>Hups, sivua ei loytynyt. <a href="'.curPageName().'?pageId='.$menuButtons[0]->id.'&language=fin">Jatka</a></p>');
	}
}
?>
</div>
<div id="banner">&nbsp;</div>
</div>
<script defer src="site.js"></script>
</body>
</html>