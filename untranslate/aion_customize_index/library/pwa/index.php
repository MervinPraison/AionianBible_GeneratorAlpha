<?php
/* PWA HOW TO
https://developer.mozilla.org/en-US/docs/Web/Progressive_web_apps
https://developer.mozilla.org/en-US/docs/Web/Progressive_web_apps/Guides/Making_PWAs_installable
https://developer.mozilla.org/en-US/docs/Web/Progressive_web_apps/Tutorials/js13kGames/App_structure

OTHER STUFF:
https://stackoverflow.com/questions/4329092/multi-dimensional-associative-arrays-in-javascript
https://medium.com/james-johnson/a-simple-progressive-web-app-tutorial-f9708e5f2605 
https://vinayak-hegde.medium.com/cache-control-meta-tag-pros-cons-and-faqs-b09aa150f5a4 
https://web.dev/progressive-web-apps/
https://www.smashingmagazine.com/2016/08/a-beginners-guide-to-progressive-web-apps/
https://www.freecodecamp.org/news/build-a-pwa-from-scratch-with-html-css-and-javascript/

USER DOCS:
https://www.pcmag.com/how-to/how-to-use-progressive-web-apps 

*/

// Path
$_Path = trim(strtok($_SERVER['REQUEST_URI'],'?'),'/');

// PWA dynamic png -OR- webmanifest
// Could be generated like the htm file, but dynamic easier while drafting and
// results in a smaller tidier complete package in GitHub
if (preg_match("#(Holy-Bible---(.+)---(.+))\.(webmanifest|192\.png|512\.png)$#", $_Path, $match) &&
	file_exists(($file=$match[1].".htm")) &&
	($handle = fopen($file, 'r'))) {
	// parse the filename for information
	$lang = preg_replace("#-#ui"," ", $match[2]);
	$name = preg_replace("#-#ui"," ", $match[3]);
	$type = $match[4];
	$shor = "AB";
	$desc = "Aionian Bible: {$name}, Progressive Web Application";
	$loop = 0;
	// parse the file contents for information
	while ((++$loop)<20 && ($line = fgets($handle))) {
		if (preg_match("#<title>(\s*.*[^[:alnum:]]+([[:alnum:]]+))\s*</title>#iu", $line, $match)) {
			$desc = $match[1];
			$shor = $match[2];
			break;
		}
	}
	fclose($handle);
	// dynamic image
	if ($type=='192.png' || $type=='512.png') {
		$size = (int)preg_replace("#.png#ui","", $type);
		$font = ($size==192 ? 100:200);
		$posi = ($size==192 ? 170:480);
		$IMG = imagecreate($size, $size);
		$background = imagecolorallocate($IMG, 102,51, 153);
		$text_color = imagecolorallocate($IMG, 255,255,255); 
		imagettftext($IMG, $font, 0, 20, $posi, $text_color, './fonts/anton-regular.ttf', $shor);
		header( "Content-type: image/png" );
		imagepng($IMG);
		imagecolordeallocate($IMG, $text_color);
		imagecolordeallocate($IMG, $background);
		imagedestroy($IMG);
	}
	// dynamic webmanifest
	else if ($type=='webmanifest') {
		header('Content-Type: application/manifest+json;');
		echo <<<EOL
{
"dir"			: "ltr",
"lang"			: "en",
"name"			: "Aionian Bible PWA ~ {$match[1]}",
"short_name"	: "Aionian Bible PWA",
"description"	: "Aionian Bible PWA ~ {$match[1]} Progressive Web Application",
"start_url"		: "{$match[1]}.htm",
"display"		: "browser",
"icons"			: [
	{
	"src"	: "{$match[1]}-192.png",
	"type"	: "image/png",
	"sizes"	: "192x192"
	},
	{
	"src"	: "{$match[1]}-512.png",
	"type"	: "image/png",
	"sizes"	: "512x512"
	}
]
}
EOL;
	}
	// not found
	else {
		header('HTTP/1.0 404 Not Found');
	}	
}

// PWA List
else if (empty($_Path) || preg_match("#{$_Path}\$#ui", dirname(__FILE__))) {
	echo <<< EOF
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Holy Bible Aionian Edition® ~ PWA</title>
<meta name="description" content="Holy Bible Aionian Edition® ~ The world's first Holy Bible untranslation! ~ Progressive Web Application">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="generator" content="ABCMS™">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta property="og:url" content="https://www.aionianbible.org/pwa">
<meta property="og:type" content="website">
<meta property="og:title" content="Holy Bible Aionian Edition® ~ PWA">
<meta property="og:description" content="Holy Bible Aionian Edition® ~ The world's first Holy Bible untranslation! ~ Progressive Web Application">
<meta property="og:image" content="images/MEME-AionianBible-The-Worlds-First-Bible-Untranslation-1.jpg">
<meta property="og:image" content="images/MEME-AionianBible-The-Worlds-First-Bible-Untranslation-2.jpg">
<meta property="og:image" content="images/MEME-AionianBible-The-Worlds-First-Bible-Untranslation-3.jpg">
<meta property="og:image" content="images/MEME-AionianBible-The-Worlds-First-Bible-Untranslation-4.jpg">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
<style>	body { padding: 16px; } h2 { margin-top: 0; } </style>
</head>
<body>	
<h2>Aionian Bible Progressive Web Applications</h2>
EOF;	
	$files = array_diff(scandir('./'), array('.', '..'));
	foreach($files as $file) {
		if (!preg_match("#\.htm$#", $file)) { continue; }
		echo "<a href='$file' target='_blank'>$file</a><br>";
	}
	echo "</body></html>";
}

// not found
else {
	header('HTTP/1.0 404 Not Found');
}

// bye now
exit;