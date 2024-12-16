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


// PWA dynamic png -OR- webmanifest
// Could be generated like the htm file, but dynamic easier while drafting and
// results in a smaller tidier complete package in GitHub
$_Full = trim(filter_var((empty($_SERVER['HTTPS']) ? 'http://' : 'https://')."{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}", FILTER_SANITIZE_URL),'/\?');
if (empty($_SERVER['QUERY_STRING']) &&
	preg_match("#^(.+)/(Holy-Bible---(.+)---(.+))/pwa\.(json|js|([0-9]+)\.png)$#", $_Full, $match) &&
	file_exists(($file=("{$match[2]}/pwa.htm"))) &&
	file_exists(($fonf=("{$match[2]}/fonts/anton-regular.ttf")))) {
	// parse filename
	$cach = $match[2];
	$bnam = preg_replace("#-#ui"," ", $match[4]);
	$type = $match[5];
	$size = (empty($match[6]) ? 0 : (int)$match[6]);
	// parse contents
	//<!-- SubTitle: {$G_VERSIONS['NAMEENGLISH']} -->
	//<!-- Short: {$G_VERSIONS['SHORT']} -->
	//<!-- Font: {$G_PWA->fontname} -->
	$SubTitle = "Aionian Bible";
	$Short = "AB";
	$Font = "";
	$name = "Aionian Bible: {$bnam}";
	if ($handle = fopen($file, 'r')) {
		$loop = $got = 0;
		while ((++$loop)<30 && ($line = fgets($handle))) {
			if		(preg_match("#<!--\s*SubTitle:\s*(.+?)\s*-->#iu",	$line, $match2)) { $SubTitle = trim($match2[1]);	++$got; }
			else if	(preg_match("#<!--\s*Short:\s*(.+?)\s*-->#iu",		$line, $match2)) { $Short = trim($match2[1]);		++$got; }
			else if	(preg_match("#<!--\s*Font:\s*(.+?)\s*-->#iu",		$line, $match2)) { $Font = trim($match2[1]);		++$got; }
			if ($got > 2) { break; }
		}
	}
	if (!empty($Font)) {
		$Font = <<<EOF
'fonts/{$Font}.woff',
'fonts/{$Font}.ttf',
EOF;
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
		imagettftext($IMG, $font, 0, $posx, $posy, $text_color, $fonf, $Short);
		header( "Content-type: image/png" );
		imagepng($IMG);
		imagecolordeallocate($IMG, $text_color);
		imagecolordeallocate($IMG, $background);
		imagedestroy($IMG);
	}
	// dynamic webmanifest
	else if ($type=='json') {
		header('Content-Type: application/manifest+json;');
		echo <<<EOL
{
"dir"				: "ltr",
"lang"				: "en",
"name"				: "{$SubTitle}",
"short_name"		: "{$Short}",
"description"		: "Holy Bible Aionian Edition® {$SubTitle}, Progressive Web Application",
"start_url"			: "{$match[1]}/{$match[2]}/",
"scope"				: "{$match[1]}/{$match[2]}/",
"background_color"	: "#663399",
"theme_color"		: "#663399",
"display"			: "minimal-ui",
"orientation"		: "portrait",
"prefer_related_applications"	: false,
"icons"			: [
	{
	"src"	: "{$match[1]}/{$match[2]}/pwa.192.png",
	"type"	: "image/png",
	"sizes"	: "192x192"
	},
	{
	"src"	: "{$match[1]}/{$match[2]}/pwa.512.png",
	"type"	: "image/png",
	"sizes"	: "512x512"
	}
],
"screenshots": [
  {
    "src": "{$match[1]}/{$match[2]}/images/Aionian-Bible-PWA-Screenshot-Landscape.jpg",
    "sizes": "1301x708",
    "type": "image/jpg",
    "form_factor": "wide",
    "label": "Aionian Bible home screen wide format"
  },
  {
    "src": "{$match[1]}/{$match[2]}/images/Aionian-Bible-PWA-Screenshot-Portrait.jpg",
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
	// dynamic serviceworker.js
	else if ($type=='js') {
		// PWA https://developer.mozilla.org/en-US/docs/Web/Progressive_web_apps
		header('Content-Type: application/javascript;');
		echo <<<EOL
// Holy Bible Aionian Edition® Progressive Web Application, service worker
// Publisher: https://NAINOIA-INC.signedon.net
// Website: https://www.AionianBible.org
// Resources: https://resources.AionianBible.org
// Repository: https://github.com/Nainoia-Inc
// Copyright: Creative Commons Attribution 4.0 International  

// Cache Setup
const AionianBible_CacheName = `{$cach}-v1`;
const AionianBible_CacheResources = [
'pwa.htm',
'fonts/gentiumplus-r.ttf',
'fonts/gentiumplus-r.woff',
'fonts/gentiumplus-r.woff2',
'fonts/notosans-basic-regular.ttf',
'fonts/notosans-basic-regular.woff',
'fonts/notosans-basic-regular.woff2',
{$Font}
'images/favicon.ico',
'images/favicon-32x32.png',
'images/favicon-16x16.png',
'images/apple-touch-icon.png',
'images/Holy-Bible-Aionian-Edition-PURPLE-HOME.png',
'images/Holy-Bible-Aionian-Edition-PURPLE-LOGO-PWA.png',
'images/Holy-Bible-Aionian-Edition-PURPLE-AB-PWA.png',
'images/Gustave-Dore-Bible-Tour-Hebrew-OT-003-Adam-and-Eve-Are-Driven-out-of-Eden.jpg',
'images/Gustave-Dore-Bible-Tour-NT-Gospel-215-The-Crucifixion-of-Jesus-and-Two-Criminals.jpg',
'images/Gustave-Dore-Bible-Tour-NT-Gospel-241-The-New-Jerusalem.jpg',
'images/Timeline-History-Aionian-Bible.jpg',
'images/Timeline-Eschatology-Aionian-Bible.jpg',
'images/MAP-Abrahams-Journey.jpg',
'images/MAP-Israels-Exodus.jpg',
'images/MAP-Jesus-Journeys.jpg',
'images/MAP-Pauls-Missionary-Journeys.jpg',
'images/MAP-World-Nations.jpg'
];

// Cache Install
async function AionianBible_CacheInstall() {
	const cache = await caches.open(AionianBible_CacheName);
	return cache.addAll(AionianBible_CacheResources);
}
self.addEventListener("install", (event) => {
	event.waitUntil(AionianBible_CacheInstall());
	console.log(`Aionian Bible App service worker cache installed`);
});

// Cache ReInstall
self.addEventListener('message', (event) => {
	if (event.data && event.data.type === 'AionianBible_PWA_ReInstall') {
		event.waitUntil(AionianBible_CacheInstall());
		console.log(`Aionian Bible App service worker cache re-installed`);
	}
});

// Cache Clean
self.addEventListener("activate", (event) => {
	event.waitUntil(
		(async () => {
			const names = await caches.keys();
			await Promise.all(
				names.map((name) => {
					if (name !== AionianBible_CacheName) {
						console.log(`Aionian Bible App service worker cache deleted: ` + name);
						return caches.delete(name);
					}
				}),
			);
			await clients.claim();
		})(),
	);
	AionianBible_CacheInstall(); // needed?
});

// Cache Fetch
async function AionianBible_CacheFirst(request) {
	const cachedResponse = await caches.match(request);
	if (cachedResponse) {
		console.log(`Aionian Bible App service worker return cache`);
		return cachedResponse;
	}
	try {
		const networkResponse = await fetch(request);
		if (networkResponse.ok) {
			const cache = await caches.open(AionianBible_CacheName);
			cache.put(request, networkResponse.clone());
			console.log(`Aionian Bible App service worker cache network`);
		}
		console.log(`Aionian Bible App service worker return network`);
		return networkResponse;
	} catch (error) {
		return Response.error();
	}
}
self.addEventListener("fetch", (event) => {
	if (AionianBible_CacheResources.includes(event.request.url.pathname)) {
		console.log(`Aionian Bible App service worker query cache`);
		event.respondWith(AionianBible_CacheFirst(event.request));
	}
	else {
		console.log(`Aionian Bible App service worker query network`);
	}
});
EOL;
	}
	exit;	
}

// PWA List
// output error message
$_Path = trim(strtok($_SERVER['REQUEST_URI'],'?'),'/\?');
$_Message = NULL;
if (!empty($_SERVER['QUERY_STRING']) ||
	!empty($_Path) ||
	!preg_match("#{$_Path}$#ui", dirname(__FILE__))) {
	http_response_code(404);
	$_Message = "<span style='color:red;'>Sorry page requested not found<br><br></span>";
}

// output list
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
{$_Message}
<b>Progressive Web Applications (PWA)</b><br>
Available off-line on smart devices.<br />
<br />
EOF;	

$files = array_diff(scandir('./'), array('.', '..'));
foreach($files as $file) {
	if (!is_dir($file) ||
		!preg_match("#^(Holy-Bible---(.+)---Aionian-Edition)$#", $file, $matches) || 
		!($bible=preg_replace("#---#", ":&nbsp;&nbsp;&nbsp;", $matches[2])) ||
		!($bible=preg_replace("#-#", "&nbsp;", $bible))) { continue; }
	
	echo "<a href='{$_Path}/{$matches[1]}/' target='_blank' class='bible'>$bible</a><br>";
}
echo "</body></html>";
exit;
