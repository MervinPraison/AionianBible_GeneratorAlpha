#!/usr/local/bin/php
<?php



/*** init ***/
require_once('./aion_common.php');
AION_ECHO("START " . basename(__FILE__, '.php'));


define('DESTINATION',	'../source-stage');
define('PRODUCTION',	'../www-stageresources');
define('DIFFERENCE',	'../diff-source-stage-with-source-production-BEFORE-UPDATE');
define('COPYRIGHT_S',	'../copyright-source');
define('COPYRIGHT_P',	'../copyright-production');
define('COPYRIGHT_D',	'../copyright-diff');


/*** utility functions ***/
AION_ECHO("DEFINE FUNCTIONS");
function postcopy( $source_url, $post_variable, $post_value, $destiny ) {
	$handle = fopen($destiny, "w");
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, str_replace(" ","%20",$source_url)); 
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_FILE, $handle);
	curl_setopt($ch, CURLOPT_FAILONERROR, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_variable . "=" . $post_value);
	$result = curl_exec($ch);
	curl_close($ch);
	fclose($handle);
	return $result;
}
function checksource( $url, &$status, &$redirect, &$size, &$date, &$stime) {
	$status = $redirect = $size = 0;
	$date = date("m/d/Y H:i:s");
	$stime = time();
	$resURL = curl_init(); 
	curl_setopt($resURL, CURLOPT_URL, $url); 
	curl_setopt($resURL, CURLOPT_BINARYTRANSFER, 1);
	curl_setopt($resURL, CURLOPT_NOBODY, true );	
	curl_setopt($resURL, CURLOPT_HEADER, true);
	curl_setopt($resURL, CURLOPT_FAILONERROR, 1); 
	curl_setopt($resURL, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($resURL, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($resURL, CURLOPT_FILETIME, true);
	if ( curl_exec ($resURL) != FALSE ) {
		$status = curl_getinfo($resURL, CURLINFO_HTTP_CODE); 
		$redirect = curl_getinfo($resURL, CURLINFO_EFFECTIVE_URL);
		$size = curl_getinfo($resURL, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
		$date_raw = curl_getinfo($resURL, CURLINFO_FILETIME);
		if (is_numeric($date_raw) && $date_raw > 0) {
			$date = date("m/d/Y H:i:s", (int)$date_raw);
			$stime = (int)$date_raw;
		}
	}
	curl_close ($resURL); 
	return $status;
}



/*** read data table ***/
AION_ECHO("READ FILE SOURCE TABLE AND BIBLE VERSIONS");
$database = array();
AION_FILE_DATA_GET( './aion_database/SOURCES.txt', 'T_SOURCES', $database, FALSE, FALSE );
AION_FILE_DATA_GET(	'./aion_database/VERSIONS.txt',	'T_VERSIONS', $database, 'BIBLE', FALSE );
$args = array('database' => $database);


/*** get bibles! ***/
AION_ECHO("LOOP THROUGH FILE RETRIEVALS");
$retrieved = $skipped = $errors = 0;
foreach( $database[T_SOURCES] as $data ) {
	/* BIBLE */
	$bible = $data[C_FILE];

	/* SKIP */
	if ($data[C_FLAG]=='SKIP') { continue; }
	

	/* RETRIEVE */
	$retrieve = FALSE;
	$source = $data[C_SOURCE];
	$source_size = 0;
	$source_date = date("m/d/Y H:i:s");
	$source_time = time();
	$destination = DESTINATION . '/' . $data[C_DESTINATION];
	
	/* POST retrieve */
	if (!empty($data[C_POST])) {
		if (postcopy ($source, $data[C_POST], $data[C_VALUE], "$destination.tmp") &&
			($stat=stat("$destination.tmp")) &&
			$stat['size']>0 &&
			rename("$destination.tmp", $destination)) {
			AION_ECHO("POST $source post(" . $data[C_POST] . "=" . $data[C_VALUE] . ") to $destination");
			if (file_exists($destination) && ($stat=stat($destination))) {
				$source_size = $stat['size'];
				$source_date = date("m/d/Y H:i:s", $stat['mtime']);
				$source_time = $stat['mtime'];
			}
			$retrieve = TRUE;
			++$retrieved;
		}
		else {
			if (file_exists("$destination.tmp")) { unlink("$destination.tmp"); }
			AION_ECHO("WARN! failed post retrieval size=" . $stat['size'] . " ~ $source post(" . $data[C_POST] . "=" . $data[C_VALUE] . ") to $destination"); }
			++$errors;
	}
	
	/* HTTP retrieve */
	else if (stripos($source,"http://")===0 || stripos($source,"https://")===0) {
		checksource($source, $source_status, $source_redirect, $source_size, $source_date, $source_time);
		if ($source_size<=0) {
			AION_ECHO("WARN! ZERO SIZE SOURCE: $source");
			if (!preg_match("#STEPBible#u",$source)) { AION_ECHO("WARN! SKIPPING ZERO SIZE SOURCE: {$data[C_FILE]} $source"); continue; }
		}
		$destination_size = $destination_date = "unknown";
		if (file_exists($destination) && ($stat=stat($destination))) {
			$destination_size = $stat['size'];
			$destination_date = date("m/d/Y H:i:s", $stat['mtime'] );
		}
		if ($source_size != $destination_size || $source_date != $destination_date) {
			if (copy($source, $destination)) {
				touch($destination, $source_time);
				AION_ECHO("COPIED $source to $destination");
				$retrieve = TRUE;
				++$retrieved;
			}
			else {
				$error = error_get_last();
				AION_ECHO("WARN! ". $error['message'] . " ~ $source to $destination");
				++$errors;
			}
		}
		else {
			++$skipped;
		}
	}

	/* local retrieval */
	else {
		if (file_exists($source) && ($stat=stat($source))) {
			$source_size = $stat['size'];
			$source_date = date("m/d/Y H:i:s", $stat['mtime']);
			$source_time = $stat['mtime'];
		}
		$destination_size = $destination_date = "unknown";
		if (file_exists($destination) && ($stat=stat($destination))) {
			$destination_size = $stat['size'];
			$destination_date = date("m/d/Y H:i:s", $stat['mtime'] );
		}
		if ($source_size != $destination_size || $source_date != $destination_date) {
			if (copy($source, $destination)) {
				touch($destination, $source_time);
				AION_ECHO("COPIED $source to $destination");
				$retrieve = TRUE;
				++$retrieved;
			}
			else {
				$error = error_get_last();
				AION_ECHO("WARN! ". $error['message'] . " ~ $source to $destination");
				++$errors;
			}
		}
		else {
			++$skipped;
		}
	}

	/* SWORD unpack */
	if ($data[C_FLAG]=='SWORD') {
		if (!preg_match("/\.SWORD\.zip$/", $destination)) {
			AION_ECHO("ERROR! FLAG=SWORD, but Sword file extension not found: $destination");
		}
		$unpack = str_replace('.zip','.txt',$destination);
		if ($retrieve || !file_exists($unpack)) {
			if ($source_size<10000) { AION_ECHO("WARN! TOO SMALL SWORD SOURCE FILE SIZE: $source_size, $source"); continue; }
			else if ($source_size<30000) { AION_ECHO("WARN! SMALL SWORD SOURCE FILE SIZE: $source_size, $source"); }
			system("unzip $destination -d /usr/share/sword");
			$module = basename(str_replace('.zip','',$source));
			system("mod2vpl $module 1 > $unpack");
			system("installmgr -u $module");
			if (file_exists($unpack)) {
				AION_LOOP_UNPACK_STAMP($bible, $source, $source_time, $unpack, $args);
			}
			else {
				AION_ECHO("SWORD UNPACK FAILED $unpack");
				++$errors;
			}
		}
	}
}


/*** diff and done ***/
AION_LOOP_DIFF( DESTINATION, PRODUCTION, DIFFERENCE, '', '', '', '', 'removexml+' );
AION_LOOP_COPYRIGHT( DESTINATION, COPYRIGHT_S );
AION_LOOP_COPYRIGHT( PRODUCTION, COPYRIGHT_P );
AION_LOOP_DIFF( COPYRIGHT_S, COPYRIGHT_P, COPYRIGHT_D );
AION_ECHO("ALSO CHECK MANUAL BIBLES FOR CHANGES");
AION_ECHO("DONE! Skipped=$skipped  Retrieved=$retrieved  Errors=$errors");
