#!/usr/local/bin/php
<?php



/*** init ***/
require_once('./aion_common.php');
AION_ECHO("START " . basename(__FILE__, '.php'));
define('DESTINATION',	'../source-stage');
define('PRODUCTION',	'../source-production');
//define('DIFFERENCE',	'../diff-source-stage-with-source-production-BEFORE-UPDATE-'.date('Y-m-d_His'));
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
function checksource( $url, &$status, &$redirect, &$size, &$date ) {
	$status = $redirect = $size = "unknown";
	$date = date("m/d/Y H:i");
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
			$date = date("m/d/Y H:i", (int)$date_raw);
		}
	}
	curl_close ($resURL); 
	return $status;
}



/*** read data table ***/
AION_ECHO("READ FILE SOURCE TABLE");
$database = array();
AION_FILE_DATA_GET( './aion_database/SOURCES.txt', 'T_SOURCES', $database, FALSE, FALSE );



/*** get bibles! ***/
AION_ECHO("LOOP BIBLES");
$post_file = $post_bible = 0;
$copy_file = $copy_bible = $copy_skip = 0;
$skip=TRUE;
foreach( $database[T_SOURCES] as $data ) {
	//if ($skip) { $skip=FALSE; continue; }
	
	/* SWORD retrieval */
	if ($data[C_POST]=='SWORD') {
		$source_size = $source_date = "unknown";
		if (stripos($data[C_SOURCE],"http://")===0 || stripos($data[C_SOURCE],"https://")===0) {
			checksource( $data[C_SOURCE], $source_status, $source_redirect, $source_size, $source_date );
		}
		else if ( file_exists( $data[C_SOURCE] ) ) {
			$stat = stat( $data[C_SOURCE] );
			$source_size = $stat['size'];
			$source_date = date("m/d/Y H:i", $stat['mtime'] );
		}
		$destination_size = $destination_date = "dunno";
		if ( file_exists( DESTINATION . '/' . $data[C_DESTINATION] ) ) {
			$stat = stat( DESTINATION . '/' . $data[C_DESTINATION] );
			$destination_size = $stat['size'];
			$destination_date = date("m/d/Y H:i", $stat['mtime'] );
		}
		$sword = DESTINATION . "/" . str_replace('.crosswire.zip','.sword',$data[C_DESTINATION]);
		if ($source_size<=0) {
			++$copy_skip;
			AION_ECHO("WARN! SKIPPING ZERO SIZE SOURCE: " . $data[C_SOURCE]);
		}
		else if ( $source_size != $destination_size || $source_date != $destination_date || !file_exists($sword)) {
			if ($source_size<30000) { AION_ECHO("WARN! SMALL SOURCE FILE SIZE: $source_size, " . $data[C_SOURCE]); }
			if ( copy( $data[C_SOURCE], DESTINATION . '/' . $data[C_DESTINATION] ) ) {
				system("unzip ".DESTINATION . "/" . $data[C_DESTINATION] . " -d /usr/share/sword");
				$module = basename(str_replace('.zip','',$data[C_SOURCE]));
				system("mod2vpl $module 1 > $sword");
				system("installmgr -u $module");
				touch( DESTINATION . '/' . $data[C_DESTINATION], strtotime( $source_date ) );
				touch( $sword, strtotime( $source_date ) );
				AION_ECHO("COPIED " . $data[C_SOURCE] . " to " . DESTINATION . '/' . $data[C_DESTINATION]);
				if ( strpos ( $data[C_DESTINATION], 'FILE_' ) !== FALSE ) { ++$copy_file; } else { ++$copy_bible; }
			}
			else {
				$error = error_get_last();
				AION_ECHO("WARN! ". $error['message'] . " ~ " . $data[C_SOURCE] . " to " . DESTINATION . '/' . $data[C_DESTINATION]); }
		}
		else { ++$copy_skip; }
	}	
	
	/* post retrieval */
	else if ( !empty($data[C_POST]) ) {
		$ret = postcopy ( $data[C_SOURCE], $data[C_POST], $data[C_VALUE], DESTINATION . '/' . $data[C_DESTINATION] . '.tmp' );
		$stat = stat( DESTINATION . '/' . $data[C_DESTINATION] . '.tmp' );
		if ($ret && !empty($stat) && $stat['size']>0 && rename(DESTINATION . '/' . $data[C_DESTINATION] . '.tmp', DESTINATION . '/' . $data[C_DESTINATION])) {
			AION_ECHO("POST " . $data[C_SOURCE] . " post(" . $data[C_POST] . "=" . $data[C_VALUE] . ") to " . DESTINATION . '/' . $data[C_DESTINATION]);
			if ( strpos ( $data[C_DESTINATION], 'FILE_' ) !== FALSE ) { ++$post_file; } else { ++$post_bible; }
		}
		else {
			unlink(DESTINATION . '/' . $data[C_DESTINATION] . '.tmp');
			AION_ECHO("WARN! failed post retrieval size=" . $stat['size'] . " ~ " . $data[C_SOURCE] . " post(" . $data[C_POST] . "=" . $data[C_VALUE] . ") to " . DESTINATION . '/' . $data[C_DESTINATION]); }
	}
	
	/* http copy retrieval */
	else if (stripos($data[C_SOURCE],"http://")===0 || stripos($data[C_SOURCE],"https://")===0) {
		checksource( $data[C_SOURCE], $source_status, $source_redirect, $source_size, $source_date );
		$destination_size = $destination_date = "dunno";
		if ( file_exists( DESTINATION . '/' . $data[C_DESTINATION] ) ) {
			$stat = stat( DESTINATION . '/' . $data[C_DESTINATION] );
			$destination_size = $stat['size'];
			$destination_date = date("m/d/Y H:i", $stat['mtime'] );
		}
		if ( $source_size != $destination_size || $source_date != $destination_date ) {
			if ( copy( $data[C_SOURCE], DESTINATION . '/' . $data[C_DESTINATION] ) ) {
				touch( DESTINATION . '/' . $data[C_DESTINATION], strtotime( $source_date ) );
				AION_ECHO("COPIED " . $data[C_SOURCE] . " to " . DESTINATION . '/' . $data[C_DESTINATION]);
				if ( strpos ( $data[C_DESTINATION], 'FILE_' ) !== FALSE ) { ++$copy_file; } else { ++$copy_bible; }
			}
			else {
				$error = error_get_last();
				AION_ECHO("WARN! ". $error['message'] . " ~ " . $data[C_SOURCE] . " to " . DESTINATION . '/' . $data[C_DESTINATION]); }
		}
		else { ++$copy_skip; }
	}

	/* copy local retrieval */
	else {
		$source_size = $source_date = "dunno";
		if ( file_exists( $data[C_SOURCE] ) ) {
			$stat = stat( $data[C_SOURCE] );
			$source_size = $stat['size'];
			$source_date = date("m/d/Y H:i", $stat['mtime'] );
		}
		$destination_size = $destination_date = "dunno";
		if ( file_exists( DESTINATION . '/' . $data[C_DESTINATION] ) ) {
			$stat = stat( DESTINATION . '/' . $data[C_DESTINATION] );
			$destination_size = $stat['size'];
			$destination_date = date("m/d/Y H:i", $stat['mtime'] );
		}
		if ( $source_size != $destination_size || $source_date != $destination_date ) {
			if ( copy( $data[C_SOURCE], DESTINATION . '/' . $data[C_DESTINATION] ) ) {
				touch( DESTINATION . '/' . $data[C_DESTINATION], strtotime( $source_date ) );
				AION_ECHO("COPIED " . $data[C_SOURCE] . " to " . DESTINATION . '/' . $data[C_DESTINATION]);
				if ( strpos ( $data[C_DESTINATION], 'FILE_' ) !== FALSE ) { ++$copy_file; } else { ++$copy_bible; }
			}
			else {
				$error = error_get_last();
				AION_ECHO("WARN! ". $error['message'] . " ~ " . $data[C_SOURCE] . " to " . DESTINATION . '/' . $data[C_DESTINATION]); }
		}
		else { ++$copy_skip; }
	}
}


/*** diff and done ***/
AION_LOOP_DIFF( DESTINATION, PRODUCTION, DIFFERENCE );
AION_LOOP_COPYRIGHT( DESTINATION, COPYRIGHT_S );
AION_LOOP_COPYRIGHT( PRODUCTION, COPYRIGHT_P );
AION_LOOP_DIFF( COPYRIGHT_S, COPYRIGHT_P, COPYRIGHT_D );
AION_ECHO("ALSO MANUALLY CHECK: unbound Korean RV  -AND-  Portuguese Biblia Livre");
AION_ECHO("DONE!"." PostBible=".$post_bible." PostFile=".$post_file." CopyBible=".$copy_bible." CopyFile=".$copy_file." CopySkip=".$copy_skip);
