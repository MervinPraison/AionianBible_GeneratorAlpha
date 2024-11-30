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


// Query string not allowed
if (!empty($_SERVER['QUERY_STRING'])) {
		header('HTTP/1.0 404 Not Found');
}

// Path
$_Path = trim(strtok($_SERVER['REQUEST_URI'],'?'),'/\?');
$_Full = trim(filter_var((empty($_SERVER['HTTPS']) ? 'http://' : 'https://')."{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}", FILTER_SANITIZE_URL),'/\?');

// PWA dynamic png -OR- webmanifest
// Could be generated like the htm file, but dynamic easier while drafting and
// results in a smaller tidier complete package in GitHub
if (preg_match("#^(.+)/(Holy-Bible---(.+)---(.+))\.(manifest|([0-9]+)\.png)$#", $_Full, $match) &&
	file_exists(($file=($match[2].'.htm')))) {
	// parse file name
	$lang = preg_replace("#-#ui"," ", $match[3]);
	$bnam = preg_replace("#-#ui"," ", $match[4]);
	$type = $match[5];
	$size = (empty($match[6]) ? 0 : (int)$match[6]);
	// parse file contents
	$name = "Aionian Bible: {$bnam}";
	$abbr = "AB";
	$loop = 0;
	if ($handle = fopen($file, 'r')) {
		while ((++$loop)<50 && ($line = fgets($handle))) {
			if (preg_match("#<title>(\s*.*[^[:alnum:]]+([[:alnum:]]+))\s*</title>#iu", $line, $match2)) {
				$name = $match2[1];
				$abbr = $match2[2];
				break;
			}
		}
	}
	fclose($handle);
	// dynamic image
	if ($size>=16 && $size<=2048) {
		$font = (int)($size * 0.28);
		$posx = (int)($size * 0.15);
		$posy = (int)($size * 0.65);
		$IMG = imagecreate($size, $size);
		$background = imagecolorallocate($IMG, 102,51, 153);
		$text_color = imagecolorallocate($IMG, 255,255,255); 
		imagettftext($IMG, $font, 0, $posx, $posy, $text_color, './fonts/anton-regular.ttf', $abbr);
		header( "Content-type: image/png" );
		imagepng($IMG);
		imagecolordeallocate($IMG, $text_color);
		imagecolordeallocate($IMG, $background);
		imagedestroy($IMG);
	}
	// dynamic webmanifest
	else if ($type=='manifest') {
		$id = date("YmdHis", filemtime($file)).'-'.fileinode($file);
		header('Content-Type: application/manifest+json;');
		echo <<<EOL
{
"id"				: "{$id}",
"dir"				: "ltr",
"lang"				: "en",
"name"				: "{$name}",
"short_name"		: "{$abbr}",
"description"		: "{$name} Progressive Web Application",
"start_url"			: "{$match[1]}/{$match[2]}.htm",
"scope"				: ".",
"background_color"	: "#663399",
"theme_color"		: "#663399",
"display"			: "minimal-ui",
"orientation"		: "portrait",
"prefer_related_applications"	: false,
"icons"			: [
	{
	"src"	: "{$match[2]}.192.png",
	"type"	: "image/png",
	"sizes"	: "192x192"
	},
	{
	"src"	: "{$match[2]}.512.png",
	"type"	: "image/png",
	"sizes"	: "512x512"
	}
],
"screenshots": [
  {
    "src": "images/Aionian-Bible-PWA-Screenshot-Landscape.jpg",
    "sizes": "1301x708",
    "type": "image/jpg",
    "form_factor": "wide",
    "label": "Aionian Bible home screen wide format"
  },
  {
    "src": "images/Aionian-Bible-PWA-Screenshot-Portrait.jpg",
    "sizes": "502x770",
    "type": "image/jpg",
    "form_factor": "narrow",
    "label": "Aionian Bible home screen narrow format"
  }
]
}
EOL;
		//echo $json;
		// debug
		//file_put_contents(".debug",$json);
	}
	// not found
	else {
		header('HTTP/1.0 404 Not Found');
	}	
}

// PWA List
else if (empty($_Path) || preg_match("#{$_Path}$#ui", dirname(__FILE__))) {
	$year = date("Y");
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
<meta property="og:image" content="https://www.aionianbible.org/images/MEME-AionianBible-The-Worlds-First-Bible-Untranslation-1.jpg">
<meta property="og:image" content="https://www.aionianbible.org/images/MEME-AionianBible-The-Worlds-First-Bible-Untranslation-2.jpg">
<meta property="og:image" content="https://www.aionianbible.org/images/MEME-AionianBible-The-Worlds-First-Bible-Untranslation-3.jpg">
<meta property="og:image" content="https://www.aionianbible.org/images/MEME-AionianBible-The-Worlds-First-Bible-Untranslation-4.jpg">
<link rel="shortcut icon" href="https://www.aionianbible.org/images/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" sizes="180x180" href="https://www.aionianbible.org/images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="https://www.aionianbible.org/images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="https://www.aionianbible.org/images/favicon-16x16.png">
<style>
body { padding: 16px; } h2 { margin-top: 0; }
img.bible { max-width: 216px; height: auto; }
a.bible { margin-bottom: 5px; display: inline-block; text-decoration: none; font-size: 16px; }
</style>
</head>
<body>	
<a href='http://www.AionianBible.org' title='Visit AionianBible.org' target='_blank' alt='Visit AionianBible.org'><img src='https://www.aionianbible.org/images/Holy-Bible-Aionian-Edition-PURPLE-HOME.png' alt='Aionian Bible' class='bible' /></a><br />
The world's first Holy Bible untranslation! <a href='http://www.AionianBible.org/Preface' title='Check out the mission' target='_blank' alt='Check out the mission'>Check out the mission</a>.<br />
Licensed with <a href='https://creativecommons.org/licenses/by/4.0/' title='License' alt='License' target='_blank'>Creative Commons Attribution 4.0 International license</a>, 2018-{$year}.<br />
<a href='http://www.aionianbible.org/Third-Party-Publisher-Resources' target='_blank'>Third Party Publisher resources here</a><br />
<br>
<b>Progressive Web Applications (PWA)</b><br>
Available off-line on smart devices.<br />
<br />
EOF;	
	$files = array_diff(scandir('./'), array('.', '..'));
	foreach($files as $file) {
		if (!preg_match("#^Holy-Bible---(.+)---Aionian-Edition\.htm$#", $file, $matches) || 
			!($bible=preg_replace("#---#", ":&nbsp;&nbsp;&nbsp;", $matches[1])) ||
			!($bible=preg_replace("#-#", "&nbsp;", $bible))) { continue; }
		
		echo "<a href='$file' target='_blank' class='bible'>$bible</a><br>";
	}
	echo "</body></html>";
}

// not found
else {
	header('HTTP/1.0 404 Not Found');
}

// bye now
exit;