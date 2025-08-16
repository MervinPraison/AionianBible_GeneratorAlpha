#!/usr/local/bin/php
<?php
///////////////////////////////////////////////////////////////////////////////////////////////////
/*
Holy Bible Aionian Edition® Progressive Web Application, service worker
Publisher: https://NAINOIA-INC.signedon.net
Website: https://www.AionianBible.org
Resources: https://resources.AionianBible.org
Repository: https://github.com/Nainoia-Inc
Copyright: Creative Commons Attribution 4.0 International 

The Aionian Bible project also serves all its translations as Progressive Web Apps.
Each Bible translation is contained in a single HTM file using javascript to paginate.
The PWA listing, manifests, service workers, and icons are served dynamically.
Dyanmic files could be pre-generated, but dynamic results in a simpler GitHub package.
.htaccess rules masquerade each PWA into its own folder allowing multiple-installs.

DOCS
	https://developer.mozilla.org/en-US/docs/Web/Progressive_web_apps
	https://pwa-workshop.js.org
	https://web.dev/progressive-web-apps/
	https://www.freecodecamp.org/news/build-a-pwa-from-scratch-with-html-css-and-javascript/
	https://felixgerschau.com/how-to-communicate-with-service-workers/
	Caching external domains too hard so dont do that.
	https://stackoverflow.com/questions/39432717/how-can-i-cache-external-urls-using-service-worker

TESTING
	https://www.validbot.com/tools/app-manifest-wizard.php
	https://www.seoreviewtools.com/pwa-testing-tool/ 

*/

///////////////////////////////////////////////////////////////////////////////////////////////////
// PWA COMPILER
AION_LOOP_DATABASE();
AION_ECHO("DONE!");
return;


// LOOP
function AION_LOOP_DATABASE() {
	$database = array();
	if (FALSE === ($fd = fopen('./aion_database/BIBLE.txt', 'w'))) { AION_ECHO("ERROR! fopen('./aion_database/BIBLE.txt')"); }
	if (FALSE === fwrite(
		$fd,
		"BIBLE\t".
		"INDEX\t".	
		"BOOK\t".	
		"CHAPTER\t".	
		"VERSE\t".	
		"TEXT\r\n")) { AION_ECHO("ERROR! fwrite({$bible} / $verse)"); }
	AION_FILE_DATA_GET( './aion_database/KEY.txt', 'T_KEY', $database, 'BIBLE', FALSE );
	AION_LOOP( array(
		'function'		=> 'AION_LOOP_DATABASE_DOIT',
		'source'		=> '/home/inmoti55/public_html/domain.aionianbible.org/www-stageresources',
		'include'		=> "/---Aionian-Edition\.noia$/",
		'database'		=> $database,
		'destiny'		=> './aion_database',
		'fd'			=> $fd,
		) );
	fclose($fd);
	AION_unset($database); unset($database);
	AION_ECHO("DONE DID IT!");
}


// BIBLE DATA TABLE
function AION_LOOP_DATABASE_DOIT($args) {
	if (!preg_match("/\/(Holy-Bible---.*)---Aionian-Edition\.noia/", $args['filepath'], $matches)) {	AION_ECHO("ERROR! Failed to preg_match(Holy-Bible): ".$args['filepath']); }
	$bible = $matches[1];
	//error_log(print_r($args['database']['T_KEY'][$bible],TRUE));
	//exit;
	if (empty($args['database']['T_KEY'][$bible]['KEY'])) {	AION_ECHO("ERROR! KEY not found for {$bible}"); }
	$key = $args['database']['T_KEY'][$bible]['KEY'];
	$database = array();
	AION_FILE_DATA_GET( $args['filepath'], 'T_BIBLE', $database, FALSE, FALSE );
	foreach($database['T_BIBLE'] as $verse) { // grab the questioned verses
		if (FALSE === fwrite(
			$args['fd'],
			(int)$key."\t".
			(int)$verse['INDEX']."\t".	
			$verse['BOOK']."\t".	
			(int)$verse['CHAPTER']."\t".	
			(int)$verse['VERSE']."\t".	
			$verse['TEXT']."\r\n")) { AION_ECHO("ERROR! fwrite({$bible} / $verse)"); }
	}
	AION_ECHO("AION_LOOP_DATABASE_DOIT success {$bible}"); 
	return;
}
