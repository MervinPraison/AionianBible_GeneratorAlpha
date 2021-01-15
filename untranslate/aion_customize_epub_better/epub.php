<?php
/* epub http://futurepress.org */
if (!empty($_GET['e'])) { $epub = $_GET['e']; }
if (empty($epub)) { exit(header('Location: /epub-not-found',true,302)); }
$epub_library = 'library/'.trim(str_ireplace('/xcdn','',$epub),'/').'/';
if (!is_dir($epub_library)) { exit(header('Location: /epub-not-found',true,302)); }

/* epub html */
?>
<!DOCTYPE html>
<html class="no-js">
<head>
<title>Futurepress ePub ~ <?echo $epub;?></title>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="description" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<link rel="stylesheet" href="css/normalize.css" />
<link rel="stylesheet" href="css/main.css" />
<link rel="stylesheet" href="css/popup.css" />
<style>
div#tocView { width: 100%; padding-top: 0; min-width: 0px; direction: rtl; }
div#tocView ul { direction: ltr; }
</style>
<script src="js/libs/jquery.min.js"></script>
<script src="js/libs/zip.min.js"></script>
<script>
"use strict";
document.onreadystatechange = function () {
	if (document.readyState == "complete") {
		window.reader = ePubReader("<?echo $epub_library;?>", { 'restore': true, 'sidebarReflow': true } );
	}
};
</script>
<script src="js/libs/screenfull.min.js"></script>
<script src="js/epub.min.js"></script>
<script src="js/reader.min.js"></script>
</head>
<body>
<div id="sidebar"><div id="tocView" class="view"></div></div>
<div id="main">
	<div id="titlebar">
		<div id="opener"><a id="slider" class="icon-menu">Menu</a></div>
		<div id="metainfo">
			<span id="book-title"></span>
			<span id="title-seperator">&nbsp;&nbsp;–&nbsp;&nbsp;</span>
			<span id="chapter-title"></span>
		</div>
	</div>
	<div id="prev" class="arrow">‹</div>
	<div id="viewer"></div>
	<div id="next" class="arrow">›</div>
	<div id="loader"><img src="img/loader.gif" alt="loading..."></div>
</div>
<div class="overlay"></div>
</body>
</html>
