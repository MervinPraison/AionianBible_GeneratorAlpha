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
// these could be physically generated with the htm file, but dynamic is easier for now
if (preg_match("#(Holy-Bible---(.+)---(.+))\.(webmanifest|192\.png|512\.png)$#", $_Path, $match) &&
	file_exists(($file=$match[1].".htm")) &&
	($handle = fopen($file, 'r'))) {
	// get bible info
	$lang = preg_replace("#-#ui"," ", $match[2]);
	$name = preg_replace("#-#ui"," ", $match[3]);
	$type = $match[4];
	$shor = "AB";
	$desc = "Aionian Bible: {$name}, Progressive Web Application";
	$loop = 0;
	while ((++$loop)<7 && ($line = fgets($handle))) {
		if (preg_match("#<title>(\s*.*[^[:alnum:]]+([[:alnum:]]+))\s*</title>#iu", $line, $match)) {
			$desc = $match[1];
			$shor = $match[2];
			break;
		}
	}
	fclose($handle);
	// image
	if ($type=='192.png' || $type=='512.png') {
		$size = (int)preg_replace("#.png#ui","", $type);
		$font = ($size==192 ? 100:200);
		$posi = ($size==192 ? 170:480);
		$IMG = imagecreate($size, $size);
		$background = imagecolorallocate($IMG, 102,51, 153);
		$text_color = imagecolorallocate($IMG, 255,255,255); 
		imagettftext($IMG, $font, 0, 20, $posi, $text_color, 'anton.ttf', $shor);
		header( "Content-type: image/png" );
		imagepng($IMG);
		imagecolordeallocate($IMG, $text_color);
		imagecolordeallocate($IMG, $background);
		imagedestroy($IMG);
	}
	// webmanifest
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
	echo "<h2>Aionian Bible Progressive Web Applications</h2>";
	$files = array_diff(scandir('./'), array('.', '..'));
	foreach($files as $file) {
		if (!preg_match("#\.htm$#", $file)) { continue; }
		echo " <a href='$file' target='_blank'>$file</a><br>";
	}
}

// not found
else {
	header('HTTP/1.0 404 Not Found');
}

// byenow
exit;