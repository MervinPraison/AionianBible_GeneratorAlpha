<?php
/*** includes + force UTF8 ***/
require_once('./aion_common_encoding.php');
use \ForceUTF8\Encoding;
require_once('./aion_common_rawfix.php');
function filenotzero($file) { return (file_exists($file) && filesize($file)); }
ini_set("memory_limit", "2048M");
ini_set('max_execution_time', 0);

/*** aion echo ***/
function AION_ECHO($message, $ret=FALSE) {
	$message = "*** AION: " . $message . "\n";
	if (!$ret) { echo $message; if ( strpos($message,"ERROR!") !== FALSE ) { exit(0); }	}
	return $message;
}
/*** aion garbage collection ***/
function AION_unset(&$unsetarray) {
	if (isset($unsetarray)) {
		if(is_array($unsetarray)) {
			foreach($unsetarray as $key => &$unsetelement) {
				AION_unset($unsetarray[$key]);
			}
		}
		$unsetarray = NULL;
		unset($unsetarray);
	}
	gc_collect_cycles();
}
AION_ECHO("INCLUDE " . basename(__FILE__, '.php'));


/*** aion version ***/
function AION_VERSION_GET($name, $folder, &$store_version, &$live_version) {
	/* find method */
	$find_live = $name.'.find-live.version.aionian.out';
	$find_store = $name.'.find-store.version.aionian.out';
	$find_diff = $name.'.find-diff.version.aionian.out';
	system('find '.$folder.' -type f ! -name "*.aionian.out" ! -printf "%p %g:%u P=%m S=%s %TD %TT\n" | sort > '.$find_live);
	touch($find_store);
	system("diff ".$find_store." ".$find_live." > ".$find_diff);
	$find_live_file = (!is_file($find_live) ? "" : file_get_contents($find_live));
	$find_store_file = (!is_file($find_store) ? "" : file_get_contents($find_store));
	$message = (($compare1=($find_live_file==$find_store_file && !empty($find_live_file) && !empty($find_store_file))) ? "COMPARE" : "!!! DIFFERENT !!!");
	AION_ECHO("FIND VERSION name=" . $name . " Result=" . $message);
	/* json method */
	$json = $name.'.json.version.aionian.out';
	$store_version = $live_version = array();
	$live_version['aion_count'] = $live_version['aion_version'] = 0;
	$return_version = AION_VERSION_RECURSE($folder, $live_version, TRUE);
	if ( $return_version != $live_version['aion_version'] ) { AION_ECHO("ERROR! Version sanity check failed"); }
	$store_version = ( !is_file($json) ? array('aion_version'=>0,'aion_count'=>0) : json_decode(file_get_contents($json), true) );
	$message = (($compare2=($store_version==$live_version)) ? "COMPARE" : "!!! DIFFERENT !!!");
	//if (!$compare2) { $version_diff = array_diff($store_version, $live_version); print_r($version_diff); }
	AION_ECHO("JSON VERSION name=" . $name . " Count: " . $store_version['aion_count'] . "/" . $live_version['aion_count'] . " Version: " . $store_version['aion_version'] . "/" . $live_version['aion_version'] . " Result=" . $message);
	return ($compare1 && $compare2);
}
function AION_VERSION_PUT($name, $folder, $version) {
	/* find method */
	$find = $name.'.find-store.version.aionian.out';
	system('find '.$folder.' -type f ! -name "*.aionian.out" ! -printf "%p %g:%u P=%m S=%s %TD %TT\n" | sort > '.$find);
	/* json method */
	$json = $name.'.json.version.aionian.out';
	if ( file_put_contents($json,json_encode($version, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)) === FALSE ) { AION_ECHO("ERROR! AION_VERSION_PUT file_put_contents ".$json ); }
	/* results */
	AION_ECHO($result="PUT VERSION name=" . $name . " Count: " . $version['aion_count'] . " Version: " . $version['aion_version']);
	return $result;
}
function AION_VERSION_RECURSE($folder, &$version, $track_subfolders) {
	if (!is_dir($folder)) { AION_ECHO("ERROR! AION_VERSION_RECURSE->is_dir " . $folder); }
	$version_subfolder = 0;
	$basetime = strtotime('6/21/2016');
	$files = array_diff(scandir($folder), array('.', '..'));
	foreach($files as $file) {
		$filepath = $folder.'/'.$file;
		if (strpos($filepath,'.aionian.out')!==FALSE || is_link($filepath)) { continue; }
		if (is_dir($filepath)) {
			$version_return = AION_VERSION_RECURSE($filepath, $version, FALSE);
			if ($track_subfolders) { $version[$file] = $version_return; }
			$version_subfolder += $version_return;
		}
		if (($stat=stat($filepath))===FALSE) { AION_ECHO("ERROR! AION_VERSION->stat ".$filepath); }
		if (!isset($stat['size']) || empty($stat['mtime'])) { AION_ECHO("ERROR! AION_VERSION->stat empty ".$filepath); }
		$version_subfolder += (1 + $stat['size'] + $stat['mtime'] - $basetime);
		$version['aion_version'] += (1 + $stat['size'] + $stat['mtime'] - $basetime);
		++$version['aion_count'];
	}
	return $version_subfolder;
}



/*** aion file data, utf8 ***/
function AION_FILE_DATA_GET( $file, $table, &$result, $key, $flip ) {
	if ( !is_array( $result ) ) {									AION_ECHO('ERROR! AION_FILE_DATA_GET !is_array() '.$table); }
	if ( isset($result[$table]) ) {									AION_ECHO('ERROR! AION_FILE_DATA_GET table already loaded: table='.$table.' in '.$file); }
	if ( !is_file( $file ) ) {										AION_ECHO('ERROR! AION_FILE_DATA_GET is_file() '.$file); }
	if ( ($contents = file_get_contents( $file )) === FALSE ) {		AION_ECHO('ERROR! AION_FILE_DATA_GET file_get_contents() '.$file); }
	if ( mb_detect_encoding($contents, "UTF-8", true) === FALSE ) {	AION_ECHO('ERROR! AION_FILE_DATA_GET mb_detect_encoding() '.$file); }
	if (!defined($table)) { define($table, $table); }
	mb_regex_encoding("UTF-8");
	mb_internal_encoding("UTF-8");
	$lines = mb_split( '[\r\n]', $contents );
	while( ($meta = mb_split( '\t', ($thisline=array_shift($lines)))) && (empty($thisline) || $meta[0][0]=='#') ) ;
	foreach( $meta as $meti ) { if (!defined('C_'.$meti)) { define('C_'.$meti, $meti); } }
	$count_meta = count($meta);
	if ( $key!==FALSE ) {
		if (is_array($key)) {	$tmp=array(); foreach($key as $kid) { for($x=0; $x<$count_meta; $x++) { if ((is_numeric($kid) && $kid==$x) || $kid==$meta[$x]) { $tmp[]=$x; break; } } } $key=(count($tmp) ? $tmp : FALSE ); }
		else {					for($x=0; $x<$count_meta; $x++) { if ((is_numeric($key) && $key==$x) || $key==$meta[$x]) { break; } } $key=($x < $count_meta ? $x : FALSE); }
	}
	$result[$table] = array();
	foreach( $lines as $data ) {
		if (empty($data) || $data[0]=='#') { continue; }
		$line = $data;
		$data = mb_split( '\t', $data );
		$count_data = count($data);
		if ( $count_meta != $count_data ) {							AION_ECHO('ERROR! AION_FILE_DATA_GET count(meta-'.$count_meta.' != data-'.$count_data.') line='.$line,' file='.$file); }
		for ( $newd = array(), $x = 0; $x < $count_data; $x++ ) {	$newd[$meta[$x]] = $data[$x]; }
		if ( $key===FALSE ) {										$result[$table][] = $newd; }
		else {
			if (is_array($key)) {	$index=''; foreach($key as $kid) { if (empty($index)) { $index=$data[$kid]; } else { $index.='-'.$data[$kid]; } } }
			else {					$index=$data[$key]; }
			if (isset($result[$table][$index])) {					AION_ECHO('ERROR! AION_FILE_DATA_GET duplicate table/bible found: table='.$table.' bible='.$index.' in '.$file); }
			else {													$result[$table][$index] = $newd; }
			if ($flip) {
				if (isset($result[$index][$table])) {				AION_ECHO('ERROR! AION_FILE_DATA_GET duplicate bible/table found: table='.$table.' bible='.$index.' in '.$file); }
				else {												if ( !isset($result[$index]) ) { $result[$index] = array(); }
																	$result[$index][$table] = $newd;
				}
			}
		}
		AION_unset($newd); $newd=NULL; unset($newd);
		AION_unset($data); $data=NULL; unset($data);
	}
	AION_unset($contents); $contents=NULL; unset($contents);
	AION_unset($lines); $lines=NULL; unset($lines);
	AION_unset($meta); $meta=NULL; unset($meta);
	gc_collect_cycles();
}
function AION_FILE_DATA_PUT( $file, $result, $comments_more=NULL ) {
	if ( !is_array( $result ) ) {									AION_ECHO('ERROR! AION_FILE_DATA_PUT !is_array(result) '.$file); }
	$first = array();
	foreach($result as $first) {
		if ( !is_array( $first ) ) {								AION_ECHO('ERROR! AION_FILE_DATA_PUT !is_array(first) '.$file); }
		$one = reset($first);
		if ($one[0]!='#') { break; }
	}
	// build the header
	$header = FALSE;
	foreach( $first as $key => $value ) { if ($header===FALSE) { $header .= $key; } else { $header .= "\t".$key; } }
	$callback = function($value) { return implode("\t", $value); };
	$contents = $header."\n".implode("\n", array_map($callback, $result));
	AION_unset($result); $result=NULL; unset($result);
	// add the header
	if ($comments_more!==FALSE) { $contents = AION_FILE_DATA_PUT_HEADER($file, strlen($contents), $comments_more) . $contents; }
	// write the file
	if ( file_put_contents ( $file, $contents ) === FALSE ) {		AION_ECHO('ERROR! AION_FILE_DATA_PUT file_put_contents() '.$file); }
	AION_unset($contents); $contents=NULL; unset($contents);
	gc_collect_cycles();
}
function AION_FILE_DATA_PUT_HEADER($file, $filesize, $comments_more) {
	$thedate = date('m/d/Y H:i:s');
	$comments  = "# File Name: ".basename($file)."\n";
	$comments .= "# File Size: ".sprintf("%-12s", 0)."\n";
	$comments .= "# File Date: $thedate\n";
	$comments .= "# File Purpose: Supporting resource for the Aionian Bible project\n";
	$comments .= "# File Location: https://resources.AionianBible.org\n";
	$comments .= "# File Copyright: Creative Commons Attribution No Derivative Works 4.0, 2018-".date('Y')."\n";
	$comments .= "# File Generator: ABCMS (alpha)\n";
	$comments .= "# File Accuracy: Contact publisher with corrections to file format or content\n";
	$comments .= "# Publisher Name: Nainoia Inc\n";
	$comments .= "# Publisher Contact: https://www.AionianBible.org/Publisher\n";
	$comments .= "# Publisher Mission: https://www.AionianBible.org/Preface\n";
	$comments .= "# Publisher Website: https://NAINOIA-INC.signedon.net\n";
	$comments .= "# Publisher Facebook: https://www.Facebook.com/AionianBible\n";
	$comments .= $comments_more;
	$comments .= "#\n";
	$filesize += strlen($comments);
	$comments  = "# File Name: ".basename($file)."\n";
	$comments .= "# File Size: ".sprintf("%-12s", $filesize)."\n";
	$comments .= "# File Date: $thedate\n";
	$comments .= "# File Purpose: Supporting resource for the Aionian Bible project\n";
	$comments .= "# File Location: https://resources.AionianBible.org\n";
	$comments .= "# File Copyright: Creative Commons Attribution No Derivative Works 4.0, 2018-".date('Y')."\n";
	$comments .= "# File Generator: ABCMS (alpha)\n";
	$comments .= "# File Accuracy: Contact publisher with corrections to file format or content\n";
	$comments .= "# Publisher Name: Nainoia Inc\n";
	$comments .= "# Publisher Contact: https://www.AionianBible.org/Publisher\n";
	$comments .= "# Publisher Mission: https://www.AionianBible.org/Preface\n";
	$comments .= "# Publisher Website: https://NAINOIA-INC.signedon.net\n";
	$comments .= "# Publisher Facebook: https://www.Facebook.com/AionianBible\n";
	$comments .= $comments_more;
	$comments .= "#\n";	
	return $comments;
}
function AION_FILE_DATABASE_PUT( $database, $source, $destiny, $allbibles ) {
	if ( !isset($database[T_VERSIONS]) ) {																			AION_ECHO("ERROR! AION_FILE_DATABASE_PUT !is_array($database) NO BIBLE VERSIONS!"); }
	foreach( $database[T_VERSIONS] as $bible => $version ) {
		// bible
		$base = $source.'/'.$version[C_BIBLE];
		$okay = $destiny.'/'.$version[C_BIBLE];
		$bpub = $destiny.'/epub/'.$version[C_BIBLE];
		$boli = $destiny.'/online/'.$version[C_BIBLE];

		// study pack
		$lang = strtok($version[C_LANGUAGEENGLISH],", ");
		AION_ECHO("AION_FILE_DATABASE_PUT look for ../www-resources/AB-StudyPack/Holy-Bible---$lang---AB-StudyPack.zip"); 
		$pack = (AION_filesize("../www-resources/AB-StudyPack/Holy-Bible---$lang---AB-StudyPack.zip") ? "/resources/AB-StudyPack/Holy-Bible---$lang---AB-StudyPack.zip" : "/resources/AB-StudyPack");

		// Source txt filename
		$sour = (
			(is_file($base.'---Source-Edition.STEP.txt')	? '---Source-Edition.STEP.txt' :
			(is_file($base.'---Source-Edition.NHEB.txt')	? '---Source-Edition.NHEB.txt' :
			(is_file($base.'---Source-Edition.VPL.txt')		? '---Source-Edition.VPL.txt' :
			(is_file($base.'---Source-Edition.UNBOUND.txt')	? '---Source-Edition.UNBOUND.txt' :
			(is_file($base.'---Source-Edition.B4U.txt')		? '---Source-Edition.B4U.txt' :
			(is_file($base.'---Source-Edition.SWORD.txt')	? '---Source-Edition.SWORD.txt' : NULL)))))));
		if (empty($sour) || !AION_filesize($base.$sour)) { AION_ECHO("ERROR! AION_FILE_DATABASE_PUT no source extension found! $bible"); }
		$source_version = (filemtime($base.$sour)===FALSE ? '' : ("\n<div class='field-field'><div class='field-label'>Source Version:</div><div class='field-value'>".date("n/j/Y", filemtime($base.$sour))."</div></div>"));
		
		// skip bible?
		if (!$allbibles && $database[$version[C_BIBLE]][T_VERSIONS]['NOPRO']=='TRUE') {
			// remove bible index
			AION_unset($database[T_VERSIONS][$bible]); $database[T_VERSIONS][$bible]=NULL; unset($database[T_VERSIONS][$bible]);
			// remove bible files
			unlink($base.'---Aionian-Edition.epub');
			unlink($base.'---Aionian-Edition.pdf');
			unlink($base.'---Aionian-Edition---STUDY.pdf');
			unlink($okay.'---Aionian-Edition.json');
			unlink($okay.'---Aionian-Verses.json');

			unlink($base.'---Aionian-Edition.noia');
			unlink($base.'---Standard-Edition.noia');
			unlink($base.'---Source-Edition.noia');
			
			unlink($base.'---Source-Edition.epub');
			unlink($base.'---Source-Edition.pdf');
			unlink($base.'---Source-Edition.SWORD.zip');
			unlink($base.$sour);
		
			system("rm -rf $boli"."---Aionian-Edition");
			system("rm -rf $bpub"."---Aionian-Edition");
			system("rm -rf $bpub"."---Source-Edition");
			continue;
		}
		// okay do it
		if (!isset($database[$version[C_BIBLE]])) {																	AION_ECHO("ERROR! AION_FILE_DATABASE_PUT !isset($version[C_BIBLE]) NO BIBLE"); }
		// zero out empty books!
		foreach( $database[$version[C_BIBLE]]['T_BOOKS'] as $key => $book ) {
			if ($key=='BIBLE' || $book=='NULL' || empty($book)) {					unset($database[$version[C_BIBLE]]['T_BOOKS'][$key]); continue; }
			$numb = sprintf('%03d', $database[T_BOOKS]['NUMBER'][$key]);
			$code = $database[T_BOOKS]['CODE'][$key];
			if (!file_exists("$boli---Aionian-Edition/$numb-$code-001.json")) {	unset($database[$version[C_BIBLE]]['T_BOOKS'][$key]); continue; }
		}
		// construct the online Bible file
		$langeng = "<span lang='en' class='eng'>";
		$langfor = "<span lang='".$database[$version[C_BIBLE]][T_VERSIONS]['LANGUAGECODEISO']."' class='".$database[$version[C_BIBLE]][T_VERSIONS]['LANGUAGECSS']."'>";
		
		// Amazon and Lulu links
		$L_AMAZON	= (empty($version[C_AMAZON])	|| $version[C_AMAZON]=='NULL'	? "" : "https://www.amazon.com/dp/".$version[C_AMAZON]);
		$L_AMAZONNT	= (empty($version[C_AMAZONNT])	|| $version[C_AMAZONNT]=='NULL'	? "" : "https://www.amazon.com/dp/".$version[C_AMAZONNT]);
		$L_LULU		= (empty($version[C_LULU])		|| $version[C_LULU]=='NULL'		? "" : (preg_match('/^http/i',$version[C_LULU])		? $version[C_LULU]		: "https://www.lulu.com/content/".$version[C_LULU]));
		$L_LULUHARD	= (empty($version[C_LULUHARD])	|| $version[C_LULUHARD]=='NULL'	? "" : (preg_match('/^http/i',$version[C_LULUHARD])	? $version[C_LULUHARD]	: "https://www.lulu.com/content/".$version[C_LULUHARD]));
		$L_LULUNT	= (empty($version[C_LULUNT])	|| $version[C_LULUNT]=='NULL'	? "" : (preg_match('/^http/i',$version[C_LULUNT])	? $version[C_LULUNT]	: "https://www.lulu.com/content/".$version[C_LULUNT]));

		// okay built it
		$database[$version[C_BIBLE]]['FORMATTED'] = ''.
		
        "\n<div class='field-header1'>Description:</div>".
		
        "\n<div class='field-field'><div class='field-label'>Name:</div><div class='field-value'>".$langfor.$database[$version[C_BIBLE]][T_VERSIONS]['NAME']."</span></div></div>".
		
        ($database[$version[C_BIBLE]][T_VERSIONS]['NAME']==$database[$version[C_BIBLE]][T_VERSIONS]['NAMEENGLISH']? '' : ("\n<div class='field-field'><div class='field-label'>English:</div><div class='field-value'>".$langeng.$database[$version[C_BIBLE]][T_VERSIONS]['NAMEENGLISH'])."</span></div></div>").

		(empty($database[$version[C_BIBLE]][T_VERSIONS]['DESCRIPTION'])? '' : ("\n<div class='field-field'><div class='field-label'>Description:</div><div class='field-value'>".$database[$version[C_BIBLE]][T_VERSIONS]['DESCRIPTION'])."</div></div>").
		
        "\n<div class='field-field'><div class='field-label'>Language:</div><div class='field-value'>".$langeng.$database[$version[C_BIBLE]][T_VERSIONS]['LANGUAGEENGLISH']."</span>".
		($database[$version[C_BIBLE]][T_VERSIONS]['LANGUAGE']==$database[$version[C_BIBLE]][T_VERSIONS]['LANGUAGEENGLISH']? '' : (" [ ".$langfor.$database[$version[C_BIBLE]][T_VERSIONS]['LANGUAGE']."</span> ]")).
        " <a href='https://en.wikipedia.org/wiki/ISO_639:".$database[$version[C_BIBLE]][T_VERSIONS]['LANGUAGECODE']."' target='_blank' title='Ethnologue language description'>".$database[$version[C_BIBLE]][T_VERSIONS]['LANGUAGECODE']."</a>".
		"\n</div></div>".
		
        (empty($database[$version[C_BIBLE]][T_VERSIONS]['SOURCE'])?'':("\n<div class='field-field'><div class='field-label'>Source:</div><div class='field-value'>".$database[$version[C_BIBLE]][T_VERSIONS]['SOURCE']."</div></div>")).
		$source_version.
        (empty($database[$version[C_BIBLE]][T_VERSIONS]['SOURCELINK'])?'':("\n<div class='field-field'><div class='field-label'>Source URL:</div><div class='field-value'><a href='".$database[$version[C_BIBLE]][T_VERSIONS]['SOURCELINK']."' target='_blank'>".$database[$version[C_BIBLE]][T_VERSIONS]['SOURCELINK']."</a>".(empty($database[$version[C_BIBLE]][T_VERSIONS]['SOURCELINKEXTRA'])?'':"<br /><a href='".$database[$version[C_BIBLE]][T_VERSIONS]['SOURCELINKEXTRA']."' target='_blank'>".$database[$version[C_BIBLE]][T_VERSIONS]['SOURCELINKEXTRA']."</a>")."</div></div>")).
        (empty($database[$version[C_BIBLE]][T_VERSIONS]['COPYRIGHT'])?'':("\n<div class='field-field'><div class='field-label'>Copyright:</div><div class='field-value'>".$database[$version[C_BIBLE]][T_VERSIONS]['COPYRIGHT']."</div></div>")).
        (empty($database[$version[C_BIBLE]][T_VERSIONS]['YEAR'])?'':("\n<div class='field-field'><div class='field-label'>Published:</div><div class='field-value'>".$database[$version[C_BIBLE]][T_VERSIONS]['YEAR']."</div></div>")).
		
		(empty($database[$version[C_BIBLE]][T_VERSIONS]['EXTENSION'])? '' : ("\n<div class='field-field'><div class='field-label'>Additional Information:<br /></div><div class='field-value'>".$database[$version[C_BIBLE]][T_VERSIONS]['EXTENSION']."</div></div>")).

		($database[$version[C_BIBLE]][T_VERSIONS]['DOWNLOAD']=='N' ? '' : ( 
 
		"\n<div class='field-header'>Downloads:</div><div class='field-field'><div class='field-links decorated'>".
		"<a href='https://play.google.com/store/apps/details?id=net.signedon.aionianbible.aionianbible' target='_blank' title='Aionian Bible free at Google Play Store'>Android App</a>".
        (is_dir(  $bpub.'---Aionian-Edition')					?(", <a href='/epub/"		.$version[C_BIBLE]	."---Aionian-Edition' target='_blank' title='Aionian Bible ePub Futurepress'>Futurepress</a>") :'').
        (is_dir(  $bpub.'---Aionian-Edition')					?(", <a href='/Readium/"	.$version[C_BIBLE]	."---Aionian-Edition' target='_blank' title='Aionian Bible ePub Readium'>Readium</a>") :'').
		(AION_filesize($base.'---Aionian-Edition.epub')			?(", <a href='/resources/"	.$version[C_BIBLE]	."---Aionian-Edition.epub' download title='Aionian Bible ePub format download'>ePub</a>") :'').
		(AION_filesize($base.'---Aionian-Edition.pdf')			?(", <a href='/resources/"	.$version[C_BIBLE]	."---Aionian-Edition.pdf' target='_blank' title='Aionian Bible PDF format'>PDF</a>") :'').
		(AION_filesize($base.'---Aionian-Edition---STUDY.pdf')	?(", <a href='/resources/"	.$version[C_BIBLE]	."---Aionian-Edition---STUDY.pdf' target='_blank' title='Aionian Bible wide margin PDF study format'>Study PDF</a>") :'').
		($pack													?(", <a href='$pack' target='_blank' title='Aionian Bible Study Pack resources for Bible translation and study of underlying languages'>Study Pack</a>") :'').
		(AION_filesize($base.'---Aionian-Edition.noia')			?(", <a href='/resources/"	.$version[C_BIBLE]	."---Aionian-Edition.noia' download title='Aionian Bible with annotations data format download'>Annotated Datafile</a>") :'').
		(AION_filesize($base.'---Standard-Edition.noia')		?(", <a href='/resources/"	.$version[C_BIBLE]	."---Standard-Edition.noia' download title='Standard Bible data format download'>Standard Datafile</a>") :'').
		", <a href='/resources/' target='_blank' title='All Aionian Bible resources for download'>Everything</a>".
		"</div></div>".

		((!empty($L_AMAZON) ||
		  !empty($L_AMAZONNT) ||
		  !empty($L_LULU) ||
		  !empty($L_LULUHARD) ||
		  !empty($L_LULUNT)) ?
        ("\n<div class='field-header'>Purchase / Buy:</div><div class='field-field'><div class='field-links decorated'>".
		(TRUE					?("<a href='/Buy' title='Buy Aionian Bible'><img src='/images/Aionian-Bible-Button-Buy-25.png' title='Buy the Aionian Bible in print' /></a> ") :'').
		(TRUE					?("<a href='/Buy' title='Buy the Aionian Bible in print'>All Bibles</a>, ") :'').
		(!empty($L_AMAZON)		?("<a href='$L_AMAZON' target='_blank' title='Buy Holy Bible Aionian Edition print copy at Amazon.com'>Amazon</a>, ")					:'').
		(!empty($L_AMAZONNT)	?("<a href='$L_AMAZONNT' target='_blank' title='Buy Holy Bible Aionian Edition New Testament print copy at Amazon.com'>Amazon New Testament</a>, ")	:'').
		($bible=='Holy-Bible---English---Aionian-Bible'	?("<a href='https://www.amazon.com/dp/B084DHWQXL' target='_blank' title='Buy Holy Bible Aionian Edition Aionian Bible 22 Book Special Edition print copy at Amazon.com'>Amazon 22 Special</a>, ")	:'').
		(!empty($L_LULU)		?("<a href='$L_LULU' target='_blank' title='Buy Holy Bible Aionian Edition print copy at Lulu.com'>Lulu</a>, ")								:'').
		(!empty($L_LULUHARD)	?("<a href='$L_LULUHARD' target='_blank' title='Buy Holy Bible Aionian Edition hardcover copy at Lulu.com'>Lulu Hardcover</a>, ")				:'').
		(!empty($L_LULUNT)		?("<a href='$L_LULUNT' target='_blank' title='Buy Holy Bible Aionian Edition New Testament print copy at Lulu.com'>Lulu New Testament</a>, ")	:'').
		($bible=='Holy-Bible---English---Aionian-Bible'	?("<a href='https://www.lulu.com/shop/-nainoia-inc/holy-bible-aionian-edition-aionian-bible-22-book-digest-special-edition/paperback/product-1qkg7e89.html' target='_blank' title='Buy Holy Bible Aionian Edition Aionian Bible 22 Book Special Edition print copy at Lulu.com'>Lulu 22 Special</a>")	:'').
		"</div></div>")
		 : "").
		
		((is_dir(  $bpub.'---Source-Edition') ||
		  AION_filesize($base.$sour) ||
		  AION_filesize($base.'---Source-Edition.epub') ||
		  AION_filesize($base.'---Source-Edition.pdf') ||
		  AION_filesize($base.'---Source-Edition.SWORD.zip')) ?
        ("\n<div class='field-header'>Source Downloads:</div><div class='field-field'><div class='field-links decorated'>".
		 (is_dir(  $bpub.'---Source-Edition')				?("<a href='/epub/"		.$version[C_BIBLE]."---Source-Edition' target='_blank' title='Source Bible ePub Futurepress'>Futurepress</a>, ")					:'').
		 (is_dir(  $bpub.'---Source-Edition')				?("<a href='/Readium/"	.$version[C_BIBLE]."---Source-Edition' target='_blank' title='Source Bible ePub Readium'>Readium</a>, ")							:'').
		 (AION_filesize($base.'---Source-Edition.epub')		?("<a href='/resources/".$version[C_BIBLE]."---Source-Edition.epub' download title='Source Bible ePub format download'>ePub</a>, ")							:'').
		 (AION_filesize($base.'---Source-Edition.pdf')		?("<a href='/resources/".$version[C_BIBLE]."---Source-Edition.pdf' title='Source Bible PDF format'  target='_blank'>PDF</a>, ")								:'').
		 (AION_filesize($base.'---Source-Edition.SWORD.zip')?("<a href='/resources/".$version[C_BIBLE]."---Source-Edition.SWORD.zip' download title='Source Bible Crosswire Sword download'>Crosswire module</a>, ")	:'').
		 (AION_filesize($base.$sour)						?("<a href='/resources/".$version[C_BIBLE]."$sour' download title='Source Bible data format download'>Source Datafile</a>")									:'').
		 "</div></div>")
		 : "")
		 
		 ));
		 
		$json = $okay.'---Aionian-Edition.json';
		if ( file_put_contents($json,json_encode($database[$version[C_BIBLE]], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)) === FALSE ) {	AION_ECHO("ERROR! AION_FILE_DATABASE_PUT file_put_contents $json" ); }
	}
	// sort the bibles before writing the version listing
	function AION_FILE_DATABASE_PUT_SORT($a, $b) {
		if ($a['LANGUAGEENGLISH'] == $b['LANGUAGEENGLISH'] && $a['NAMEENGLISH'] == $b['NAMEENGLISH']) { return 0; }
		return ($a['LANGUAGEENGLISH'] < $b['LANGUAGEENGLISH'] || ($a['LANGUAGEENGLISH'] == $b['LANGUAGEENGLISH'] && $a['NAMEENGLISH'] < $b['NAMEENGLISH']) ? -1 : 1);
	}
	uasort($database[T_VERSIONS], 'AION_FILE_DATABASE_PUT_SORT');
	// okay write
	$json = $destiny.'/Holy-Bible---AAA---Versions.json';
	if ( file_put_contents($json,json_encode($database[T_VERSIONS], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)) === FALSE ) {				AION_ECHO("ERROR! AION_FILE_DATABASE_PUT file_put_contents $json" ); }
	$json = $destiny.'/Holy-Bible---AAA---Books.json';
	if ( file_put_contents($json,json_encode($database[T_BOOKSY], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)) === FALSE ) {					AION_ECHO("ERROR! AION_FILE_DATABASE_PUT file_put_contents $json" ); }
}
function AION_filesize( $file ) {
	if (is_file($file)) { return(filesize($file)); }
	return(0);
}
function AION_FILE_DATABASE_BOOKS( &$database ) {
	if ( !isset($database[T_BOOKS]['NUMBER']) ) {					AION_ECHO('ERROR! AION_FILE_DATABASE_BOOKS !is_array($database) NO BOOK NUMBER!'); }
	if ( !isset($database[T_BOOKS]['CODE']) ) {						AION_ECHO('ERROR! AION_FILE_DATABASE_BOOKS !is_array($database) NO BOOK CODE!'); }
	if ( !isset($database[T_BOOKS]['CHAPTERS']) ) {					AION_ECHO('ERROR! AION_FILE_DATABASE_BOOKS !is_array($database) NO BOOK CHAPTERS!'); }
	if ( !isset($database[T_BOOKS]['ENGLISH']) ) {					AION_ECHO('ERROR! AION_FILE_DATABASE_BOOKS !is_array($database) NO BOOK ENGLISH!'); }
	if (!defined('T_BOOKSY')) { define('T_BOOKSY','T_BOOKSY'); }
	$database[T_BOOKSY] = array();
	foreach( $database[T_BOOKS]['NUMBER'] as $url => $book) {
		$database[T_BOOKSY][$database[T_BOOKS]['NUMBER'][$url]] =  $url;
		$database[T_BOOKSY][$url] = array();
		$database[T_BOOKSY][$url]['NUMBER']		=  sprintf('%03d', (int)$database[T_BOOKS]['NUMBER'][$url]);
		$database[T_BOOKSY][$url]['CODE']		=  $database[T_BOOKS]['CODE'][$url];
		$database[T_BOOKSY][$url]['CHAPTERS']	=  $database[T_BOOKS]['CHAPTERS'][$url];
		$database[T_BOOKSY][$url]['ENGLISH']	=  $database[T_BOOKS]['ENGLISH'][$url];
	}
}

function AION_LIBS_RSYNC($source,$destiny) {
	system(($command="rsync -av $source $destiny"));
	AION_ECHO("DONE! ".$command);
}


/*** index software ***/
function AION_INSTALL_INDEX( $destiny ) {
	if (system( 'cp -R aion_customize_index/. '.$destiny ) === FALSE ) { AION_ECHO('ERROR! cp -R index customizations'); }
}


/*** aion loop ***/
function AION_LOOP($args) {
	gc_collect_cycles();
	if (!is_array($args)) {													AION_ECHO("ERROR! No arguments!"); }
	if (empty($args['function']) || !function_exists ($args['function'])) {	AION_ECHO("ERROR! No function!"); }
	if (empty($args['source']) || !is_dir($args['source'])) {				AION_ECHO("ERROR! No source directory!"); }
	if (empty($args['destiny']) || !is_dir($args['destiny'])) {				AION_ECHO("ERROR! No destiny directory!"); }
	$count = 0;
	$files = array_diff(scandir($args['source']), array('.', '..'));
	foreach( $files as $file ) {
		$args['filename'] = $file;
		$args['filepath'] = $args['source'].'/'.$file;
		if (is_dir($args['filepath'])) {												continue; }
		if (!empty($args['exclude'])  && preg_match($args['exclude'], $file)==TRUE) {	continue; }
		if (!empty($args['include'])  && preg_match($args['include'], $file)!=TRUE) {	continue; }
		if (!empty($args['validate']) && call_user_func($args['validate'], $args['filename'], $args['filepath'])!=TRUE) { continue; }
		if (!is_file($args['filepath'])) {									AION_ECHO("ERROR! No regular file!"); }
		call_user_func($args['function'], $args);
		++$count;
		gc_collect_cycles();
	}
	AION_unset($files); $files=NULL; unset($files);
	gc_collect_cycles();
	AION_ECHO('LOOP DONE! Function='.$args['function'].' Files processed='.$count);
}



/*** aion diff loop ***/
function AION_LOOP_DIFF($folder_original, $folder_modified, $folder_difference, $exclude='', $include='', $search='', $replace='', $flags='') {
	system('rm -rf '.$folder_difference);
	if (!mkdir($folder_difference)) { AION_ECHO("ERROR! !mkdir: ".$folder_difference); }
	AION_LOOP( array(
		'function'	=> 'AION_LOOP_DIFF_DOIT',
		'source'	=> $folder_original,
		'compare'	=> $folder_modified,
		'destiny'	=> $folder_difference,
		'exclude'	=> $exclude,
		'include'	=> $include,
		'search'	=> $search,
		'replace'	=> $replace,
		'flags'		=> $flags,
		) );
	system("cat ".$folder_difference."/*.diff > ".$folder_difference."/AMASTER.".preg_replace('/[\/.]+/','',$folder_difference));
	system('(echo "Subject: AIONIAN ENGINE SOURCE DIFF:"; echo; echo AMASTER.DIFF; ls -ail ' . $folder_difference . ';) | /usr/lib/sendmail escribes@aionianbible.org;');
}
function AION_LOOP_DIFF_DOIT($args) {
	if (empty($args['compare']) || !is_dir($args['compare'])) {		AION_ECHO("ERROR! No compare directory!"); }
	$filename1 = $args['filename'];
	$filepath1 = $args['filepath'];
	$filename2 = $args['filename'];
	$filepath2 = $args['compare'].'/'.$args['filename'];
	$fileout   = $args['destiny'].'/'.$filename1.'.diff';
	$flags     = $args['flags'];
	if (file_put_contents($fileout, 'BEGIN DIFF! '.$filepath1.' VS '.$filepath2."\n")===FALSE) {
		AION_ECHO("ERROR! Failed header diff write!");
	}
	if (!is_file($filepath2)) {
		if (file_put_contents($fileout, 'Cannot diff because file missing: '.$filepath1.' VS '.$filepath2."\n",FILE_APPEND)===FALSE) {
			AION_ECHO("ERROR! Failed missing diff write!");
		}
		AION_ECHO('MISSING: '.$filepath1.' VS '.$filepath2);
	}
	else if (preg_match("/\.(zip)|(epub)$/i", $filename1)) {
		system("rm -rf .tmp.diff");
		if (!mkdir('.tmp.diff')) {														AION_ECHO("ERROR! mkdir()"); }
		system("unzip -q $filepath1 -d .tmp.diff/A");
		system("unzip -q $filepath2 -d .tmp.diff/B");
		system("diff -r $flags .tmp.diff/A .tmp.diff/B 2>&1 >> $fileout" );
		if (!is_dir('.tmp.diff/A') || !is_dir('.tmp.diff/A') || !is_file($fileout) ) {	AION_ECHO("ERROR! Bad unzip() or diff()"); }
		system("rm -rf .tmp.diff");
		AION_ECHO('DIFF ZIP: '.$filepath1.' VS '.$filepath2);
	}	
	else if (preg_match("/\.tar.gz$/i", $filename1)) {
		system("rm -rf .tmp.diff");
		if (!mkdir('.tmp.diff') || !mkdir('.tmp.diff/A') || !mkdir('.tmp.diff/B')) {	AION_ECHO("ERROR! mkdir()"); }
		system("tar -xf $filepath1 -C .tmp.diff/A");
		system("tar -xf $filepath2 -C .tmp.diff/B");
		system("diff -r $flags .tmp.diff/A .tmp.diff/B 2>&1 >> $fileout" );
		if (!is_dir('.tmp.diff/A') || !is_dir('.tmp.diff/A') || !is_file($fileout) ) {	AION_ECHO("ERROR! Bad unzip() or diff()"); }
		system("rm -rf .tmp.diff");
		AION_ECHO('DIFF ZIP: '.$filepath1.' VS '.$filepath2);
	}
	else {
		if (empty($args['search'])) {
			system("diff $flags '$filepath1' '$filepath2' 2>&1 >> '$fileout'");
		}
		else {
			$search = $args['search'];
			$replace = $args['replace'];
			system("sed 's/$search/$replace/g' '$filepath1' > '$fileout.one'");
			system("sed 's/$search/$replace/g' '$filepath2' > '$fileout.two'");
			system("diff $flags '$fileout.one' '$fileout.two' 2>&1 >> '$fileout'");
			unlink("$fileout.one");
			unlink("$fileout.two");
		}
		if (!is_file($fileout)) {														AION_ECHO("ERROR! Bad diff()"); }
		AION_ECHO('DIFF REG: '.$filepath1.' VS '.$filepath2);
	}
}




/*** aion diff loop ***/
function AION_LOOP_UNPACK($folder) {
	$database = array();
	AION_FILE_DATA_GET( './aion_database/SOURCES.txt', 'T_SOURCES', $database, FALSE, FALSE );
	$database['T_SOURCES'][] = array('SOURCE'=>''); // add empty one for simpler loop below
	AION_LOOP( array(
		'function'	=> 'AION_LOOP_UNPACK_DOIT',
		'source'	=> $folder,
		'destiny'	=> $folder,
		'include'	=> '/---Source-Edition(\.STEP\.txt|\.NHEB\.txt|\.VPL\.zip|\.UNBOUND\.zip|\.B4U\.zip)/',
		'exclude'	=> '',
		'database'	=> $database,
		) );
}
function AION_LOOP_UNPACK_DOIT($args) {
	/* setup */
	$zipname = $args['filename'];
	$zipfile = $args['filepath'];
	$txtfile = str_replace('.zip','.txt',$args['filepath']);
	$temp = "./tmp.unpack";
	if (!preg_match("/\/(Holy-Bible---.*)---Source-Edition/", $args['filepath'], $matches)) {	AION_ECHO("ERROR! Failed to preg_match(Holy-Bible): ".$args['filepath']); }
	$bible = $matches[1];

	/* find the source and date */
	foreach($args['database']['T_SOURCES'] as $source) { if (isset($source['DESTINATION']) && $source['DESTINATION']==$zipname) { break; } }
	if (empty($source['SOURCE'])) { AION_ECHO("ERROR! ZIPFILE UNPACK FAILED, SOURCE NOT FOUND: $zipfile"); }
	$source_date = filemtime($zipfile);

	/* always try to repack NHEB and STEP */
	if (preg_match("/\.NHEB\.txt$/", $txtfile) ||
		preg_match("/\.STEP\.txt$/", $txtfile)) {
		AION_LOOP_UNPACK_STAMP($bible, $source['SOURCE'], $source_date, $txtfile);
		return;
	}

	/* doit ornot */	
	if (file_exists($txtfile) && $source_date == filemtime($txtfile)) { return; }

	/* unpack */
	if (preg_match("/\.B4U\.zip$/", $zipfile)) {
		if (!mkdir($temp)) { AION_ECHO("ERROR! !mkdir: $temp"); }
		system("unzip $zipfile -d $temp");
		$type = 'B4U';
	}
	else {
		system("unzip $zipfile -d $temp");
		if (preg_match("/\.VPL\.zip$/", $zipfile)) { $type = 'VPL'; }
		else if (preg_match("/\.UNBOUND\.zip$/", $zipfile)) { $type = 'UNB'; }
		else { AION_ECHO("ERROR! Unknown unpack extension found $zipfile"); }
	}
	
	/* find */
	$files = array_diff(scandir($temp), array('.', '..'));
	$files[] = 'bogus-file';
	foreach($files as $unpack) {
		if ($type=='B4U' && preg_match("/\.txt$/i", $unpack)==TRUE) {		break; }
		if ($type=='VPL' && preg_match("/_vpl\.txt$/i", $unpack)==TRUE) {	break; }
		if ($type=='UNB' && preg_match("/_utf8\.txt$/i", $unpack)==TRUE) {	break; }
	}
	if (is_file("$temp/$unpack") && rename("$temp/$unpack", $txtfile)) {
		AION_LOOP_UNPACK_STAMP($bible, $source['SOURCE'], $source_date, $txtfile);
	}
	else {
		if (file_exists($txtfile)) { unlink($txtfile); }
		AION_ECHO("WARN! ZIPFILE UNPACK FAILED: $txtfile");
		++$errors;
	}
	system("rm -rf $temp");
}
function AION_LOOP_UNPACK_STAMP($bible, $source, $source_date, $file) {
if (!($contents=file_get_contents($file))) { AION_ECHO("ERROR! UNPACK_STAMP file_get_contents($file)"); }
if (preg_match("/^## Aionian Bible/", $contents)) {
	touch($file, $source_date);
	return;
}
$filename = basename($file);
$today = date('m/d/Y H:i:s');
$source_date_formatted = date("m/d/Y H:i:s", $source_date);
$contents = <<<EOT
## Aionian Bible
## File Name: $filename
## File Usage: $bible
## File Created: $today
## File Purpose: Supporting resource for the Aionian Bible project
## File Location: https://resources.AionianBible.org
## Publisher Name: Nainoia Inc
## Publisher Contact: https://www.AionianBible.org/Publisher
## Publisher Mission: https://www.AionianBible.org/Preface
## Publisher Website: https://NAINOIA-INC.signedon.net
## Publisher Facebook: https://www.Facebook.com/AionianBible
## Source URL: $source
## Source Date: $source_date_formatted
## Source Text: unaltered below
##

$contents
EOT;
if (!file_put_contents($file,$contents)) { AION_ECHO("ERROR! UNPACK_STAMP file_put_contents($file)"); }
touch($file, $source_date);
AION_ECHO("GOOD! UNPACK_STAMP:  source=$source  file=$file");
}


/*** aion convert ***/
function AION_LOOP_CONV($source, $destiny, $raw_orig, $raw_fixed, $reverse, $skipped, $tally, $uniusage, $textrepair, $rawcheck, $raw_tags, $dataput) {
	/* test utf8 encoder */
	if (Encoding::fixUTF8("FÃÂÂÂÂ©dÃÂÂÂÂ©ration Camerounaise de Football\n") != "Fédération Camerounaise de Football\n") {
		AION_ECHO("ERROR! Encoding::fixUTF8() Failed to fix: Fédération Camerounaise de Football");
	}
	$database = array();
	AION_FILE_DATA_GET( './aion_database/BOOKSCOUNT.txt', 'T_BOOKSCOUNT', $database, 'BOOK', FALSE );
	AION_FILE_DATA_GET( './aion_database/BOOKS.txt', 'T_BOOKS', $database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET(	'./aion_database/VERSIONS.txt',	'T_VERSIONS', $database, 'BIBLE', FALSE );
	AION_FILE_DATA_PUT($raw_tags,array(array("BIBLE"=>"Bibles listed below","TAGS"=>"Tags listed below")));
	$database['T_UNTRANSLATEREVERSE'] = array();
	$database['T_SKIPPED'] = array();
	$database['T_TALLY'] = array();
	$database['T_TEXTREPAIR'] = array();
	if ($dataput) { $database['T_RAWCHECK'] = array(); }
	else { $database['T_RAWCHECK'] = NULL; }
	AION_LOOP( array(
		'function'	=> 'AION_LOOP_CONV_DOIT',
		'source'	=> $source,
		'uniusage'	=> $uniusage,
		'include'	=> '/---Source-Edition\.(STEP\.txt|NHEB\.txt|VPL\.txt|UNBOUND\.txt|B4U\.txt|SWORD\.txt)$/',
		//'include'	=> '/Holy-Bible---.*(Aramaic).*---Source-Edition\.(STEP\.txt|NHEB\.txt|VPL\.txt|UNBOUND\.txt|B4U\.txt|SWORD\.txt)$/',
		//'include'	=> '/Holy-Bible---Slovene---Slovene-Savli-Bible---Source-Edition\.(STEP\.txt|NHEB\.txt|VPL\.txt|UNBOUND\.txt|B4U\.txt|SWORD\.txt)$/',	
		//'include'	=> '/Holy-Bible---([G-Z]{1}).+---Source-Edition\.(STEP\.txt|NHEB\.txt|VPL\.txt|UNBOUND\.txt|B4U\.txt|SWORD\.txt)$/',
		//'include'	=> '/Holy-Bible---Kiche---Totonicapan---Source-Edition\.(STEP\.txt|NHEB\.txt|VPL\.txt|UNBOUND\.txt|B4U\.txt|SWORD\.txt)$/',	
		//'include'	=> '/Holy-Bible---Meitei---Meitei-Bible---Source-Edition\.(STEP\.txt|NHEB\.txt|VPL\.txt|UNBOUND\.txt|B4U\.txt|SWORD\.txt)$/',	
		'destiny'	=> $destiny,
		'raw_orig'	=> $raw_orig,
		'raw_fixed'	=> $raw_fixed,
		'raw_tags'	=> $raw_tags,
		'database'	=> &$database,
		'bibles'	=> AION_BIBLES_LIST(),
		'sword'		=> AION_BIBLES_LIST_SWORD(),
		'unbound'	=> AION_BIBLES_LIST_UNB(),
		'b4u'		=> AION_BIBLES_LIST_B4U(),
		) );
	AION_FILE_DATA_PUT($reverse,$database['T_UNTRANSLATEREVERSE']);
	AION_FILE_DATA_PUT($skipped,$database['T_SKIPPED']);
	AION_FILE_DATA_PUT($textrepair,$database['T_TEXTREPAIR']);
	if (!ksort($database['T_TALLY'])) { AION_ECHO("ERROR! Failed to ksort TALLY"); }
	AION_FILE_DATA_PUT($tally,$database['T_TALLY']);
	if (!empty($database['T_RAWCHECK'])) {
		if (!ksort($database['T_RAWCHECK'])) { AION_ECHO("ERROR! Failed to ksort T_RAWCHECK"); }
		AION_FILE_DATA_PUT($rawcheck,$database['T_RAWCHECK']);
	}
	AION_unset($database); $database=NULL; unset($database);
}
function AION_LOOP_CONV_DOIT($args) {
	/* setup */
	$filepath = $args['filepath'];
	if (preg_match("/---Source-Edition\.NHEB\.txt$/", $args['filepath'])) {			$type = "HRT"; }
	else if (preg_match("/---Source-Edition\.STEP\.txt$/", $args['filepath'])) {	$type = "HRT"; }
	else if (preg_match("/---Source-Edition\.VPL\.txt$/", $args['filepath'])) {		$type = "VPL"; }
	else if (preg_match("/---Source-Edition\.UNBOUND\.txt$/", $args['filepath'])) {	$type = "UNB"; }
	else if (preg_match("/---Source-Edition\.B4U\.txt$/", $args['filepath'])) {		$type = "B4U"; }
	else if (preg_match("/---Source-Edition\.SWORD\.txt$/", $args['filepath'])) {	$type = "SWD"; }
	else { AION_ECHO("ERROR! Failed to preg_match(Bible) extension: $filepath"); }

	$output = $args['destiny'].'/'.preg_replace('/---Source-Edition(.*?)$/i', '---Standard-Edition.noia', $args['filename']);
	$output_orig = str_replace('---Standard-Edition.noia','---Source-Edition.noia',$output);
	if (!preg_match("/\/(Holy-Bible---.*)---Standard-Edition\.noia$/", $output, $matches)) {	AION_ECHO("ERROR! Failed to preg_match(Holy-Bible): ".$args['filepath']);	}
	$bible = $matches[1];
	if (!preg_match("/^Holy-Bible---/", $bible)) {												AION_ECHO("ERROR! Failed to preg_match(Bible): $bible");	}

	// open and raw fix the bible
	AION_BIBLES_RAWFIX($args, $bible, $type, $filepath, $args['bibles'], $args['sword'], $args['unbound'], $fixedbible, $args['raw_orig'], $args['raw_fixed'], $args['raw_tags'], $args['database']['T_RAWCHECK']);
	$data_orig = $data = $reverse = array();
	$rows  = $byte  = $numb  = $chap  = $vers = 0;
	$numbL = $chapL = $versL = '000';
	$fields = -1;
	$line = FALSE;
	// loop the bible lines
	while (($line===FALSE && ($line=strtok($fixedbible, "\r\n"))!==FALSE) || ($line = strtok( "\r\n" )) !== FALSE) {

		// DUPLICATE CODE!!!
		// ignore comments
		if (preg_match("/^[\s]*$/", $line) ||
			preg_match("/^(#|\/\/)/", $line) ||
			($type=='B4U' && !preg_match("/^[[:alnum:]]+\.\d+:\d+\s/",$line))) {  // Gen.1:1
			if ($fields<0 && $type=='UNB' && preg_match("/^#columns\t/i",$line)) {
				if (($parsed=preg_split("/\t/", $line)) == FALSE) {	AION_ECHO("ERROR! Unbound fields definition problem! ".$line); }
				if (4>($fields = count($parsed) - 1)) {				AION_ECHO("ERROR! Unbound fields definition count problem! ".$line); }
				AION_unset($parsed); $parsed=NULL; unset($parsed);
			}
			continue;
		}
		// switch on file types
		if ($type=='VPL' || $type=='HRT') {
			$notext = FALSE;
			if (preg_match("/\t/", $line)) {						AION_ECHO("ERROR! TAB in Source! ".$line); }
			if (($space1=strpos($line,' ',0))===FALSE) {			AION_ECHO("ERROR! Space1 missing! ".$line); }
			if (($colon1=strpos($line,':',$space1+1))===FALSE) {	AION_ECHO("ERROR! Colon1 missing! ".$line); }
			if (($space2=strpos($line,' ',$colon1+1))===FALSE) {	AION_ECHO("WARNING! Space2 missing! ".$line); $notext=TRUE; }
			$book = strtoupper(substr($line,0,$space1));
			$numb = sprintf('%03d', (int)array_search($book,array_keys($args['bibles'])));
			if (!(int)$numb) {										AION_ECHO("ERROR! Bad bible book name! $book $numb $line"); }
			$chap = sprintf('%03d', (int)substr($line,$space1+1,$colon1-$space1-1));
			$vers = sprintf('%03d', (int)substr($line,$colon1+1,$space2-$colon1-1));
			$text = ($notext ? '' : trim(substr($line,$space2+1)));
		}
		else if ($type=='SWD') {
			$notext = FALSE;
			if (preg_match("/^[^A-Z]{1}/", $line)) {				continue; }
			if (preg_match("/\t/", $line)) {						AION_ECHO("ERROR! TAB in Source! ".$line); }
			$matches = array();
			if (!preg_match("/^([^:]+) [0-9]+:/", $line, $matches)){AION_ECHO("ERROR! Bad SWORD verse! $line"); }
			if (empty($matches[1])) {								AION_ECHO("ERROR! Bad SWORD verse book! $line"); }
			$space1 = strlen($matches[1]);
			if (($colon1=strpos($line,':',$space1+1))===FALSE) {	AION_ECHO("ERROR! Colon1 missing! $line"); }
			if (($space2=strpos($line,' ',$colon1+1))===FALSE) {	AION_ECHO("WARNING! Space2 missing! $line"); $notext=TRUE; }
			if(!($book = array_search($matches[1],$args['sword']))){AION_ECHO("ERROR! Bad SWORD verse book search! $line"); }
			$numb = sprintf('%03d', (int)array_search($book,array_keys($args['bibles'])));
			if (!(int)$numb) {										AION_ECHO("ERROR! Bad bible book name! $book $numb $line"); }
			$chap = sprintf('%03d', (int)substr($line,$space1+1,$colon1-$space1-1));
			$vers = sprintf('%03d', (int)substr($line,$colon1+1,$space2-$colon1-1));
			$text = ($notext ? '' : trim(substr($line,$space2+1)));
			if (!(int)$chap || !(int)$vers) {						continue; }
		}
		else if ($type=='B4U') {
			if (preg_match("/\t/", $line)) {						AION_ECHO("ERROR! TAB in Source! ".$line); }
			$matches = array();
			if (!preg_match("/^([[:alnum:]]+)\.(\d+):(\d+)\s(.*)$/u", $line, $matches)){AION_ECHO("ERROR! Bad B4U verse! $line"); }
			if (empty($matches[1])) {								AION_ECHO("ERROR! Bad SWORD verse book! $line"); }
			if(!($book = array_search($matches[1],$args['b4u']))){AION_ECHO("ERROR! Bad B4U verse book search! $line"); }
			$numb = sprintf('%03d', (int)array_search($book,array_keys($args['bibles'])));
			if (!(int)$numb) {										AION_ECHO("ERROR! Bad bible book name! $book $numb $line"); }
			$chap = sprintf('%03d', (int)$matches[2]);
			$vers = sprintf('%03d', (int)$matches[3]);
			$text = trim($matches[4]);
			if (!(int)$chap || !(int)$vers) {						continue; }
		}
		else if ($type=='UNB') {
			if (($parsed = preg_split("/\t/", $line)) == FALSE) {	AION_ECHO("ERROR! Unbound no line fields! ".$line); }
			if (count($parsed) !== $fields) {						AION_ECHO("ERROR! Unbound line field count != $fields! ".$line); }
			if (empty($args['unbound'][$parsed[0]])) {				AION_ECHO("ERROR! Unbound bad book name! ".$line); }
			$book = strtoupper($args['unbound'][$parsed[0]]);
			$numb = sprintf('%03d', (int)array_search($book,array_keys($args['bibles'])));
			if (!(int)$numb) {										AION_ECHO("ERROR! Unbound Bad bible book name! ".$line); }
			$chap = sprintf('%03d', (int)$parsed[1]);
			$vers = sprintf('%03d', (int)$parsed[2]);
			$text = trim($parsed[$fields-1]);
			AION_unset($parsed); $parsed=NULL; unset($parsed);
			if (empty($text)) { continue; }
		}
		// don't need apocryphal at all or skipped books
		if ((int)$numb>66) { continue; }
		if (empty($args['database']['T_BOOKS'][$bible][array_search($book,$args['database']['T_BOOKS']['CODE'])]) ||
			$args['database']['T_BOOKS'][$bible][array_search($book,$args['database']['T_BOOKS']['CODE'])]=='NULL') {
			static $lastskippedbook = "";
			if ($book != $lastskippedbook) {
				AION_ECHO("WARN! SKIPPING BIBLE BOOK! Bible=$bible  Book=$book  Line=$line");
				$lastskippedbook = $book;
			}
			continue;
		}
		// duplicate verse reference!
		if (!empty($data_orig[$numb.'-'.$chap.'-'.$vers])) { AION_ECHO("ERROR! DUPLICATE ORIGINAL!\n".print_r($data_orig[$numb.'-'.$chap.'-'.$vers],TRUE)); }
		$data_orig[$numb.'-'.$chap.'-'.$vers] = array('INDEX'=>$numb,'BOOK'=>$book,'CHAPTER'=>$chap,'VERSE'=>$vers,'TEXT'=>$text);

		// conver to noia format		
		$book_orig = $book;
		$numb_orig = $numb;
		$chap_orig = $chap;
		$vers_orig = $vers;
		$elin = $bible."\t".$numb."\t".$book."\t".$chap."\t".$vers;
		if (!empty($args['uniusage'])) { AION_LOOP_CONV_DOIT_GLYF($bible, $book, $chap, $vers, $text, $args['uniusage']); }
		if (!AION_BIBLES_REMAPPER($bible,$numb,$book,$chap,$vers,$text) ||
			!($text = AION_TEXT_REPAIR($text,$elin,$bible,TRUE,$args['database']['T_TEXTREPAIR'],$vers))) {
			$args['database']['T_SKIPPED'][] = array('BIBLE'=>$bible,'INDEX'=>$numb,'BOOK'=>$book,'CHAPTER'=>$chap,'VERSE'=>$vers,'TEXT'=>$text);
			if (AION_BIBLES_REMAPPER_FUNK($numb,$book,$chap,$vers,$args['database']['T_BOOKSCOUNT'])) { continue; }
			$reverse['BIBLE']		= $bible;
			$reverse['INDEX']		= $numb_orig;
			$reverse['BOOK']		= $book_orig;
			$reverse['CHAPTER']		= $chap_orig;
			$reverse['VERSE']		= $vers_orig.'-SKIP';
			$reverse['INDEXX']		= $numb_orig;
			$reverse['BOOKX']		= $book_orig;
			$reverse['CHAPTERX']	= $chap_orig;
			$reverse['VERSEX']		= $vers_orig.'-SKIP';
			$untrans_index = $bible.'-'.$numb_orig.'-'.$chap_orig.'-'.$vers_orig.'-SKIP';
			$args['database']['T_UNTRANSLATEREVERSE'][$untrans_index] = $reverse;
			continue;
		}
		if ($book=='PSA' || $book=='HAB') { $text = AION_TEXT_SELAH($text,$elin,$bible); }
		if (!is_numeric($numb) || !is_numeric($chap) || !is_numeric($vers)) {				AION_ECHO("ERROR! Invalid Bible Number !is_numeric()! $elin = $numb $chap $vers"); }
		if ($numb>66) {																		AION_ECHO("ERROR! Invalid Bible Book Number! $elin = $numb"); }
		if ($book=='PSA' && ($chap<1 || $chap>151)) {										AION_ECHO("ERROR! Invalid Bible Psalm Chapter Number! $elin = $chap"); }
		if ($book=='PSA' && ($vers<1 || $vers>176)) {										AION_ECHO("ERROR! Invalid Bible Psalm Verse Number! $elin = $vers"); }
		if ($book!='PSA' && ($chap<1 || $chap>66)) {										AION_ECHO("ERROR! Invalid Bible Not-Psalm Chapter Number! $elin = $chap"); }
		if ($book!='PSA' && ($vers<1 || $vers>89)) {										AION_ECHO("ERROR! Invalid Bible Not-Psalm Verse Number! $elin = $vers"); }
		if ($chap>$args['database']['T_BOOKSCOUNT'][$book][C_CHAPTER]) {					AION_ECHO("ERROR! Invalid Bible Lookup Chapter Number! $elin = $vers"); }
		if ( $numb+0< $numbL ||
			($numb+0==$numbL && $chap+0< $chapL) ||
			($numb+0==$numbL && $chap+0==$chapL && $vers+0<=$versL)){						AION_ECHO("WARNING! Bible Verse Out of Sorts! numb=$numb, numL=$numbL, chap=$chap, chapL=$chapL, vers=$vers, versL=$versL | $elin | $text"); }
		if ($bible!='Holy-Bible---Albanian-Tosk---Albanian-Bible' && ($book!=$book_orig || $numb!=$numb_orig)) { AION_ECHO("ERROR! Bible convert changed the Bible book or index! $elin = $vers"); }
		// revise all text
		AION_BIBLES_REVISE($bible,$numb,$book,$chap,$vers,$text);
		if ($chap!=$chap_orig || $vers!=$vers_orig) {
			$untrans_index = $bible.'-'.$numb.'-'.$chap.'-'.$vers;
			if (!empty($args['database']['T_UNTRANSLATEREVERSE'][$untrans_index])) {		AION_ECHO("ERROR! Untranslate index duplicate remapped! orig=$elin  new=$untrans_index"); }
			$reverse['BIBLE']		= $bible;
			$reverse['INDEX']		= $numb;
			$reverse['BOOK']		= $book;
			$reverse['CHAPTER']		= $chap;
			$reverse['VERSE']		= $vers;
			$reverse['INDEXX']		= $numb_orig;
			$reverse['BOOKX']		= $book_orig;
			$reverse['CHAPTERX']	= $chap_orig;
			$reverse['VERSEX']		= $vers_orig;
			$args['database']['T_UNTRANSLATEREVERSE'][$untrans_index] = $reverse;
		}
		$data[$numb.'-'.$chap.'-'.$vers] = array('INDEX'=>$numb,'BOOK'=>$book,'CHAPTER'=>$chap,'VERSE'=>$vers,'TEXT'=>$text);
		$numbL = $numb;
		$chapL = $chap;
		$versL = $vers;
		$byte += strlen($elin."\t".$text);
		++$rows;
	}
	/* sort and check sort and doubles */
	if (!ksort($data)) {										AION_ECHO("ERROR! Failed to ksort standard edition: $bible"); }
	if (!ksort($data_orig)) {									AION_ECHO("ERROR! Failed to ksort source edition: $bible"); }
	$numbL = $chapL = $versL = '000'; $lineL = 'none';
	foreach($data as $key => $line) {
		$numb = $line['INDEX'];
		$chap = $line['CHAPTER'];
		$vers = $line['VERSE'];
		$line2 = $line['INDEX'].' '.$line['BOOK'].' '.$line['CHAPTER'].' '.$line['VERSE'];
		if ( $numb+0< $numbL ||
			($numb+0==$numbL && $chap+0< $chapL) ||
			($numb+0==$numbL && $chap+0==$chapL && $vers+0<=$versL)){	AION_ECHO("ERROR! Bible Verse Out of Sorts after ksort()! Key=$key Last=$lineL Current=$line2"); }
		$numbL = $line['INDEX'];
		$chapL = $line['CHAPTER'];
		$versL = $line['VERSE'];
		$lineL = $line2;
	}
	$args['database']['T_TALLY'][$bible] = array('BIBLE'=>$bible,'AIONIAN'=>count($data),'STANDARD'=>count($data),'SOURCE'=>count($data_orig));
	$data = AION_BIBLES_INSERT_BOOKS($data,$args['database']['T_BOOKS']['ENGLISH'],$args['database']['T_BOOKS'][$bible],$args['database']['T_BOOKS']['CODE']);
	AION_FILE_DATA_PUT($output,$data,AION_BIBLES_COMMENT_MORE($args['database']['T_VERSIONS'][$bible],'Standard',$args['source']."/$bible"));
	AION_unset($data); $data=NULL; unset($data);
	$data_orig = AION_BIBLES_INSERT_BOOKS($data_orig,$args['database']['T_BOOKS']['ENGLISH'],$args['database']['T_BOOKS'][$bible],$args['database']['T_BOOKS']['CODE']);
	AION_FILE_DATA_PUT($output_orig,$data_orig,AION_BIBLES_COMMENT_MORE($args['database']['T_VERSIONS'][$bible],'Source',$args['source']."/$bible"));
	AION_unset($data_orig); $data_orig=NULL; unset($data_orig);
	AION_unset($reverse); $reverse=NULL; unset($reverse);
	AION_ECHO('CONVERTED '.$args['filepath'].' to '.$output.' byte='.$byte.' rows='.$rows);
}
function AION_BIBLES_INSERT_BOOKS($data,$english,$foreign,$codes) {
	$data2 = array();
	$current = NULL;
	foreach($data as $verse) {
		if ($current != $verse['BOOK']) {
			$data2[] = array("#");
			$data2[] = array("# BOOK",$verse['INDEX'],$verse['BOOK'],$english[array_search($verse['BOOK'],$codes)],$foreign[array_search($verse['BOOK'],$codes)]);
			$current = $verse['BOOK'];
		}
		$data2[] = $verse;
	}
	return $data2;
}
function AION_BIBLES_REVISE($bible,$numb,$book,$chap,$vers,&$text) {
	if ($bible!='Holy-Bible---English---King-James-Version-Updated' && $numb==41 && $book=='MAR' && $chap==16 && $vers==9) {
		$text = "(note: The most reliable and earliest manuscripts do not include Mark 16:9-20.) ".$text;
	}
}
function AION_BIBLES_COMMENT_MORE($bibleversion,$datatype,$base) {
// source date
$sour = (
	(is_file($base.'---Source-Edition.STEP.txt')	? '---Source-Edition.STEP.txt' :
	(is_file($base.'---Source-Edition.NHEB.txt')	? '---Source-Edition.NHEB.txt' :
	(is_file($base.'---Source-Edition.VPL.txt')		? '---Source-Edition.VPL.txt' :
	(is_file($base.'---Source-Edition.UNBOUND.txt')	? '---Source-Edition.UNBOUND.txt' :
	(is_file($base.'---Source-Edition.B4U.txt')		? '---Source-Edition.B4U.txt' :
	(is_file($base.'---Source-Edition.SWORD.txt')	? '---Source-Edition.SWORD.txt' : NULL)))))));
$source_version = (filemtime($base.$sour)===FALSE ? '' : ("# Bible Source Version: ".date("n/j/Y", filemtime($base.$sour))."\n"));
return (
	"# Bible Name: ".$bibleversion['NAME']."\n".
	"# Bible Name English: ".$bibleversion['NAMEENGLISH']."\n".
	"# Bible Language: ".$bibleversion['LANGUAGE']."\n".
	"# Bible Language English: ".$bibleversion['LANGUAGEENGLISH']."\n".
	"# Bible Copyright Format: ".$bibleversion['ABCOPYRIGHT']."\n".	
	"# Bible Copyright Text: ".$bibleversion['COPYRIGHT']."\n".	
	"# Bible Source: ".$bibleversion['SOURCE']."\n".
	$source_version.	
	"# Bible Source Link: ".$bibleversion['SOURCELINK']."\n".
	"# Bible Source Year: ".$bibleversion['YEAR']."\n".
	(empty($bibleversion['DESCRIPTION']) ? "" : ("# Bible Description: ".$bibleversion['DESCRIPTION']."\n")).
	($datatype=='Aionian' ?		"# Bible Format: Aionian Glossary annotations to 265 verses\n" :
	($datatype=='Standard' ?	"# Bible Format: Standard formatting without annotation\n" :
	($datatype=='Source' ?		"# Bible Format: Source text without correction, Aionian Bible internal use only\n" :
	"")))
	);
}
function AION_TEXT_REPAIR($string,$errline,$bible,$trueifrawtext, &$textrepair,$vers) {
	// regex: specials = \^$.|?*+[(){}
	// regex: bracketed specials = ^-]\
	if ('Holy-Bible---Dutch---Canisiusvertaling'==$bible) { // public domain
		$string = preg_replace('/ \d+[\d:abcde-]+ /ui', ' ', $string);
		$string = preg_replace('/ \d+[\d:-]+/ui', ' ', $saved=$string);	if(is_array($textrepair) && $string!=$saved) { $textrepair[] = array($errline."\t".$string); } // note the repair		
	}
	if ('Holy-Bible---French---French-Crampon-Bible'==$bible) { // public domain
		$string = preg_replace('/1/ui', 'l', $string);
	}
	if ('Holy-Bible---Greek---Greek-Byzantine-Majority'==$bible) { // public domain
		$string = preg_replace('/[A-Z0-9[:punct:]()]*[0-9]+[A-Z0-9[:punct:]()]*/ui', ' ', $saved=$string);	if(is_array($textrepair) && $string!=$saved) { $textrepair[] = array($errline."\t".$string); } // note the repair
	}
	if ($trueifrawtext && 'Holy-Bible---Hebrew---Hebrew-Aleppo-Codex'==$bible) { // public domain
		$string = preg_replace('/^[[:space:]]*[^[:space:]]+[[:space:]]+/ui', '', $string); // remove verse numbers indicated as 1st word of each verse!
	}
	if ("Holy-Bible---Ukrainian---Ukrainian-NT"==$bible) { // public domain
		$string = preg_replace('/3/ui', 'З', $saved=$string); if(is_array($textrepair) && $string!=$saved) { $textrepair[] = array($errline."\t".$string); } // note the repair
		$string = preg_replace('/8/ui', 'З', $saved=$string); if(is_array($textrepair) && $string!=$saved) { $textrepair[] = array($errline."\t".$string); } // note the repair
		$string = preg_replace('/^1 /ui', 'І ', $saved=$string); if(is_array($textrepair) && $string!=$saved) { $textrepair[] = array($errline."\t".$string); } // note the repair
	}

	// weird number warning and fixes
	if (preg_match('/[[:space:]]*‘[[:digit:]]+’[[:space:]]*/ui', $string)) {			AION_ECHO("WARNING!!! WEIRD NUMBERS! $errline:\t$string"); }
	// fix punctuation
	$string = preg_replace('/[[:space:]]*,[[:space:]]*(\?|!|;|:|,)/ui', '$1', $string);								// no comma before punctuation
	$string = preg_replace('/(^|[^.[:space:]]{1})[[:space:]]*\.[[:space:]]*(\?|!)/ui', '$1$2', $string);			// no single period before punctuation
	$string = preg_replace('/(\?|!|;|:|,)[[:space:]]*\.([^.]{1}|$)/ui', '$1$2', $string);							// no single period after punctuation
	$string = preg_replace('/(\?|!|;|:|,)\1/ui', '$1', $string);													// no double punctuation
	$string = preg_replace('/(^|[^.[:space:]]{1})[[:space:]]*\.[[:space:]]*\.([^.]{1}|$)/ui', '$1.$2', $string);	// no double periods
	$string = preg_replace('/([^.]{1})[[:space:]]+\.([^.]{1}|$)/ui', '$1.$2', $string);								// no space before single period
	// remove spaces
	$string = trim($string);															// remove leading / trailing spaces
	$string = preg_replace('/[[:space:]]+/ui', ' ', $string);							// reduce all whitespace to one space
	if ( // „word“ and „word”
		"Holy-Bible---Czech---Living-Bible"==$bible ||
		"Holy-Bible---Danish---Danish-1871-1907"==$bible ||
		"Holy-Bible---Danish---Danish-1931-1907"==$bible ||
		"Holy-Bible---Estonian---For-All"==$bible ||
		"Holy-Bible---Flemish---Flemish-De-Jonge-Bible"==$bible ||
		"Holy-Bible---French---French-Khan-Bible"==$bible ||
		"Holy-Bible---Hungarian---Hungarian-Karoli"==$bible ||
		"Holy-Bible---Hungarian---Magyar-Bible"==$bible ||
		"Holy-Bible---Icelandic---Open-Living-Word"==$bible ||
		"Holy-Bible---Latvian---Latvian-Gluck-Bible"==$bible ||
		"Holy-Bible---Polish---Open-Access-Word-of-Life"==$bible ||
		"Holy-Bible---Polish---Polish-Updated-Gdansk"==$bible ||
		"Holy-Bible---Portuguese---Portuguese-Trans-Trans"==$bible ||
		"Holy-Bible---Romanian---Cyrillic"==$bible ||
		"Holy-Bible---Slovene---Slovene-Savli-Bible"==$bible ||
		"Holy-Bible---Ukrainian---New-Translation"==$bible ||
		"Holy-Bible---Ukrainian---Ukrainian-Ogienko"==$bible) { // public domain
		static $space_punc	= array(' ?', ' ,', ' !', ' ;', ' :');
		static $space_punc2	= array( '?',  ',',  '!',  ';',  ':');
		$string = str_replace($space_punc, $space_punc2, $string);							// remove space before punctuation, „word“
	}
	else if ("Holy-Bible---Pohnpeian---Pohnpeian-NT-Psalms-New-Alphabet"==$bible || // public domain
		"Holy-Bible---Pohnpeian---Pohnpeian-NT-Psalms-Old-Alphabet"==$bible) { // public domain
		static $space_punc	= array(' ?', ' ,', ' !', ' ;', ' :', ' ”', '‘ ', '“ ');
		static $space_punc2	= array( '?',  ',',  '!',  ';',  ':',  '”', '‘',  '“');
		$string = str_replace($space_punc, $space_punc2, $string);							// remove space before punctuation

	}
	else {
		static $space_punc	= array(' ?', ' ,', ' !', ' ;', ' :', ' ’', ' ”', '‘ ', '“ ');
		static $space_punc2	= array( '?',  ',',  '!',  ';',  ':',  '’',  '”', '‘',  '“');
		$string = str_replace($space_punc, $space_punc2, $string);							// remove space before punctuation
	}
	// warning punctuation errors
	if ('Holy-Bible---Hebrew---Hebrew-Aleppo-Codex'==$bible) {
		if (preg_match('/[~@#$%\^\\\\&*_+|<>]{1}/ui',$string)) {						AION_ECHO("WARNING!!! PUNCTUATION PROBLEM! $errline:\t$string"); }
	}
	else if ('Holy-Bible---Spanish---Reina-Valera-NT-1858'==$bible) { // allow ^
		if (preg_match('/[~@#$%\\\\&*_+|<>]{1}/ui',$string)) {							AION_ECHO("WARNING!!! PUNCTUATION PROBLEM! $errline:\t$string"); }
	}
	else if ('Holy-Bible---English---One-Unity-Resource-Bible'==$bible) {
		if (preg_match('/[~@$%\^\\\\&*_+{}|<>]{1}/ui',$string)) {						AION_ECHO("WARNING!!! PUNCTUATION PROBLEM! $errline:\t$string"); }
	}
	else if ('Holy-Bible---English---Trans-Trans'==$bible) {
		if (preg_match('/[~@#$\^\\\\&*_+|<>]{1}/ui',$string)) {							AION_ECHO("WARNING!!! PUNCTUATION PROBLEM! $errline:\t$string"); }
	}
	else if ('Holy-Bible---Portuguese---Portuguese-Trans-Trans'==$bible) {
		if (preg_match('/[~@#$%\^\\\\&*_+|<>]{1}/ui',$string)) {						AION_ECHO("WARNING!!! PUNCTUATION PROBLEM! $errline:\t$string"); }
	}
	else if ('Holy-Bible---Greek---Greek-Textus-Receptus'==$bible || 'Holy-Bible---Greek---Greek-Westcott-Hort'==$bible) {
		if (preg_match('/[~@#$%\^\\\\&*_+|<>]{1}/ui',$string)) {						AION_ECHO("WARNING!!! PUNCTUATION PROBLEM! $errline:\t$string"); }
	}
	else if ('Holy-Bible---English---STEPBible-Amalgamant'==$bible || 'Holy-Bible---English---STEPBible-Concordant'==$bible) {
		if (preg_match('/[@#$%\^\\\\&_{}|<>]{1}/ui',$string)) {							AION_ECHO("WARNING!!! PUNCTUATION PROBLEM! $errline:\t$string"); }
	}
	else if (preg_match("/Sanskrit/us", $bible)) {
		if (preg_match('/[~@#$%\\\\&*_+{}<>]{1}/ui',$string)) {							AION_ECHO("WARNING!!! PUNCTUATION PROBLEM! $errline:\t$string"); }
	}
	else {
		if (preg_match('/[~@#$%\^\\\\&*_+{}|<>]{1}/ui',$string)) {						AION_ECHO("WARNING!!! PUNCTUATION PROBLEM! $errline:\t$string"); }
	}
	// fatal bracket errors
	if ('Holy-Bible---Korean---Korean-RV'!=$bible &&
		'Holy-Bible---English---One-Unity-Resource-Bible'!=$bible) {
		if (preg_match('/[(\[]{1}[ [:digit:]]+.{0,9}[)\]]{1}/ui',$string)) {	AION_ECHO("WARNING!!! BRACKET PROBLEM! $errline:\t$string"); }
	}
	// spaces
	//$string = preg_replace('/([.?!]{1}[\'"”’]*)[ ]+/ui', '$1  ', $string);				// two space after if any spaces
	if ("Holy-Bible---Coptic---Coptic-NT"!=$bible) {
		$string = preg_replace('/([^.]{1})([.?!]{1})([[:upper:]]{1})/u', '$1$2 $3', $string); // space if no space before uppercase!
	}
	if ("Holy-Bible---Arabic---Arabic-Van-Dyck-Bible"!=$bible &&
		"Holy-Bible---Armenian---Armenian-Bible-Eastern"!=$bible &&
		"Holy-Bible---Cherokee---Cherokee-New-Testament"!=$bible &&
		"Holy-Bible---Coptic---Coptic-NT"!=$bible &&
		"Holy-Bible---Latvian---Latvian-Gluck-Bible"!=$bible &&
		"Holy-Bible---Malagasy---Malagasy-Bible"!=$bible &&
		"Holy-Bible---Oriya---Oriya-Bible"!=$bible &&
		!preg_match('/[ap]{1}\.m\./ui', $string)) {
		$string = preg_replace('/([^.]{1})([.?!]{1})([[:alpha:]]{1})/ui', '$1$2 $3', $string); // one space if no spaces before alpha!
	}
	$string = preg_replace('/([^\d]{1}[,:;]{1})[ ]*([^”’"\' ]{1})/ui', '$1 $2', $string);	// one space after for non-digits, not quoted
	$string = trim($string);													// trim
	// skip blank
	if (preg_match('/^[✠[:digit:][:punct:][:space:]]*$/ui', $string)) {
		AION_ECHO("WARNING! SKIP BLANK! $errline:\t$string"); return FALSE;
	}
	// fatal
	if (!$string) {																		AION_ECHO("ERROR! AION_TEXT_REPAIR() NULL STRING! $errline"); }
    return $string;
}
function AION_TEXT_SELAH($string,$errline,$bible){
	$preg1 = '/^[ [:punct:]]*(Selaⱨ|Селаһ|Се́ла|Села|Hera|Selá|Selaah|Sela|Sila|Selah|Pause|Selah|Jela|细拉|細拉|চেলা|셀라|ସେଲା|சேலா|Sélah|সেলা|સેલાહ|Szela|セラ|ಸೆಲಾ|Zela|സേലാ|సెలా|सिलाह)[ [:punct:]]*[ ]+/ui';
	$preg2 = '/[ ]+[ [:punct:]]*(Selaⱨ|Селаһ|Се́ла|Села|Hera|Selá|Selaah|Sela|Sila|Selah|Pause|Selah|Jela|细拉|細拉|চেলা|셀라|ସେଲା|சேலா|Sélah|সেলা|સેલાહ|Szela|セラ|ಸೆಲಾ|Zela|സേലാ|సెలా|सिलाह)[ [:punct:]]*$/ui';
	$preg3 = '/ [ [:punct:]]*(Selaⱨ|Селаһ|Се́ла|Села|Hera|Selá|Selaah|Sela|Sila|Selah|Pause|Selah|Jela|细拉|細拉|চেলা|셀라|ସେଲା|சேலா|Sélah|সেলা|સેલાહ|Szela|セラ|ಸೆಲಾ|Zela|സേലാ|సెలా|सिलाह)[ [:punct:]]* /ui';
	$preg4 = '/(Selaⱨ|Селаһ|Се́ла|Села|Hera|Selá|Selaah|Sela|Sila|Selah|Pause|Selah|Jela|细拉|細拉|চেলা|셀라|ସେଲା|சேலா|Sélah|সেলা|સેલાહ|Szela|セラ|ಸೆಲಾ|Zela|സേലാ|సెలా|सिलाह|Interlud|Jinaso|Higgaion|Higaion|Meditation|Jeu d\'instruments|Higgajon|Zwischenspiel|Hikaiona|Hikaione)/';
	if ('Holy-Bible---Tagalog---Tagalog-Bible'==$bible) {
		$preg1 = preg_replace('/sila\|/ui', '', $preg1);
		$preg2 = preg_replace('/sila\|/ui', '', $preg2);
		$preg3 = preg_replace('/sila\|/ui', '', $preg3);
		$preg4 = preg_replace('/sila\|/ui', '', $preg4);
	}
	else if ("Holy-Bible---Japanese---Japanese-Kougo-yaku"==$bible) {
		$preg2 = '/[([]+(セラ)[ [:punct:]]*$/ui';
	}
	$string = preg_replace($preg1, '($1) ', $string);
	$string = preg_replace($preg2, ' ($1)  ', $string);
	$string = preg_replace($preg3, ' ($1) ', $string);
	$string = preg_replace('/^[ [:punct:]]*(Interlud|Jinaso|Higgaion|Higaion|Meditation|Jeu d\'instruments|Higgajon|Zwischenspiel|Hikaiona|Hikaione)[ [:punct:]]*[ ]+/ui', '($1) ', $string);
	$string = preg_replace('/[ ]+[ [:punct:]]*(Interlud|Jinaso|Higgaion|Higaion|Meditation|Jeu d\'instruments|Higgajon|Zwischenspiel|Hikaiona|Hikaione)[ [:punct:]]*$/ui', ' ($1)  ', $string);
	$string = preg_replace('/ [ [:punct:]]*(Interlud|Jinaso|Higgaion|Higaion|Meditation|Jeu d\'instruments|Higgajon|Zwischenspiel|Hikaiona|Hikaione)[ [:punct:]]+ /ui', ' ($1) ', $string);
	$string = preg_replace('/[[:punct:]]{1}Psalm 9a[[:punct:]]{1}/ui', '', $string);
	$string = preg_replace('/A song of \(Pause\)/ui', '(A song of, Pause)', $string);
	$string = preg_replace('/\(A song of, \(Pause\)/ui', '(A song of, Pause)', $string);
	$string = preg_replace('/\(Sélah\) pause\)/ui', '(Sélah, pause)', $string);
	if (preg_match($preg4, $string)) {
		if (!($string = preg_replace('/\) *\(/ui', ', ', $string))) { AION_ECHO("ERROR! SELAH! failure preg_replace(())"); }
		AION_ECHO("WARNING! SELAH! $errline:\t$string");
	}
	if (!$string) { AION_ECHO("ERROR! AION_TEXT_SELAH() NULL STRING! $errline"); }
	return trim($string);
}
function AION_BIBLES_REMAPPER($bible,&$index,&$book,&$chapter,&$verse,&$text) {
	/* get the database once */
	static $database = FALSE;
	static $previous = FALSE;
	if ($database===FALSE) {
		$database = array();
		AION_FILE_DATA_GET( './aion_database/VERSEMAP.txt', 'T_VERSEMAP', $database, array('BIBLE','MAP'), FALSE );
		AION_FILE_DATA_GET( './aion_database/VERSEMAPALBANIAN.txt', 'T_VERSEMAPALBANIAN', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
		AION_FILE_DATA_GET( './aion_database/BOOKSCOUNT.txt', 'T_BOOKSCOUNT', $database, 'BOOK', FALSE );
	}
	/* FIRST **********************************************************/
	/* skip apocrypha */
	if (!isset($database[T_BOOKSCOUNT][$book])) {
		$current="WARNING REMAPPED = $bible: Apocryphal Book Skipped: $book";
		if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
		return FALSE;
	}
	/* skip blanks */
	if (strlen(trim($text))<4) {
		$current="WARNING REMAPPED = $bible: Empty verse skipped: $book $chapter $verse $text";
		if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
		return FALSE;
	}
	/* SKIP **********************************************************/
	if (isset($database[T_VERSEMAP][$bible.'-NONE'])) { goto SKIP; }
	/* GROUPS ********************************************************/
	/* PROPHET 2 GROUP */
	if (isset($database[T_VERSEMAP][$bible.'-PRO2'])!==FALSE) {
		/* ecclesiates */
		if ($book=='ECC' && $chapter==7) {
			AION_BIBLES_SLIDE_BACK($bible, 6, 12, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: PRO2 Ecclesiastes 6-7";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* song of solomon */
		if ($book=='SOL' && (($chapter==5 && $verse>=17) || ($chapter==6))) {
			AION_BIBLES_SLIDE_FORE($bible, 5, 16, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: PRO2 Song of Solomon 5-6";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* PROPHET 5 GROUP */
	if (isset($database[T_VERSEMAP][$bible.'-PRO5'])!==FALSE) {
		/* numbers */
		if ($book=='NUM' && $chapter==30) {
			AION_BIBLES_SLIDE_BACK($bible, 29, 40, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: PRO5 Numbers 29-30";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* 1 samuel */
		if ($book=='1SA' && $chapter==24) {
			AION_BIBLES_SLIDE_BACK($bible, 23, 29, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: PRO5 I Samuel 23-24";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* ecclesiates */
		if ($book=='ECC' && (($chapter==4 && $verse>=17) || ($chapter==5))) {
			AION_BIBLES_SLIDE_FORE($bible, 4, 16, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: PRO5 Ecclesiates 4-5";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* hosea */
		if ($book=='HOS' && $chapter==14) {
			AION_BIBLES_SLIDE_BACK($bible, 13, 16, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: PRO5 Hosea 13-14";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* jonah */
		if ($book=='JON' && $chapter==2) {
			AION_BIBLES_SLIDE_BACK($bible, 1, 17, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: PRO5 Jonah 1-2";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* PROPHET 6 GROUP */
	if (isset($database[T_VERSEMAP][$bible.'-PRO6'])!==FALSE) {
		/* genesis */
		if ($book=='GEN' && (($chapter==36 && $verse>=44) || ($chapter==37 && $verse<2))) {
			if ($chapter==36) {										$chapter = sprintf('%03d', $chapter+1);		$verse = sprintf('%03d', $verse-43); }
			else if ($chapter==37) {																			$verse = sprintf('%03d', $verse+1); }
			$current="WARNING REMAPPED = $bible: PRO6 Genesis 36-37";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* leviticus */
		if ($book=='LEV' && (($chapter==6 && $verse>=31) || ($chapter==7))) {
			AION_BIBLES_SLIDE_FORE($bible, 6, 30, 10, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: PRO6 Leviticus 6-7";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* deuteronomy 23-24 */
		if ($book=='DEU' && $chapter==24) {
			AION_BIBLES_SLIDE_BACK($bible, 23, 25, 2, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: PRO6 Deuteronomy 23-24";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* 1 kings */
		if ($book=='1KI' && $chapter==21) {
			AION_BIBLES_SLIDE_BACK($bible, 20, 43, 14, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: PRO6 I Kings 20-21";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* daniel */
		if ($book=='DAN' && (($chapter==3 && $verse>=31) || ($chapter==4))) {
			AION_BIBLES_SLIDE_FORE($bible, 3, 30, 3, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: PRO6 Daniel 3-4";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* haggai */
		if ($book=='HAG' && $chapter==2) {
			$verse = sprintf('%03d', $verse-1);
			$current="WARNING REMAPPED = $bible: PRO6 Haggai 1-2";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* PROPHET 6B GROUP */
	if (isset($database[T_VERSEMAP][$bible.'-PRO6B'])!==FALSE) {
		/* genesis */
		if ($book=='GEN' && (($chapter==36 && $verse>=44) || ($chapter==37 && $verse<2))) {
			if ($chapter==36) {										$chapter = sprintf('%03d', $chapter+1);		$verse = sprintf('%03d', $verse-43); }
			else if ($chapter==37) {																			$verse = sprintf('%03d', $verse+1); }
			$current="WARNING REMAPPED = $bible: PRO6B Genesis 36-37";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* leviticus */
		if ($book=='LEV' && (($chapter==6 && $verse>=31) || ($chapter==7))) {
			AION_BIBLES_SLIDE_FORE($bible, 6, 30, 10, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: PRO6B Leviticus 6-7";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* deuteronomy 23-24 */
		if ($book=='DEU' && $chapter==24) {
			AION_BIBLES_SLIDE_BACK($bible, 23, 25, 2, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: PRO6B Deuteronomy 23-24";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* 1 kings */
		if ($book=='1KI' && $chapter==21) {
			AION_BIBLES_SLIDE_BACK($bible, 20, 43, 14, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: PRO6B I Kings 20-21";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* daniel */
		if ($book=='DAN' && (($chapter==3 && $verse>=31) || ($chapter==4))) {
			AION_BIBLES_SLIDE_FORE($bible, 3, 30, 3, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: PRO6B Daniel 3-4";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* haggai */
		if ($book=='HAG' && $chapter==2 && $verse>1) {
			$verse = sprintf('%03d', $verse-1);
			$current="WARNING REMAPPED = $bible: PRO6 Haggai 1-2";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* HEBREW GROUP */
	if (isset($database[T_VERSEMAP][$bible.'-HEBREW'])!==FALSE) {
		/* genesis */
		if ($book=='GEN' && $chapter==32) {
			AION_BIBLES_SLIDE_BACK($bible, 31, 55, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW Genesis 31-32";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* exodus */
		if ($book=='EXO' && (($chapter==7 && $verse>=26) || ($chapter==8))) {
			AION_BIBLES_SLIDE_FORE($bible, 7, 25, 4, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW Exodus 7-8";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		if ($book=='EXO' && (($chapter==21 && $verse>=37) || ($chapter==22))) {
			AION_BIBLES_SLIDE_FORE($bible, 21, 36, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW Exodus 21-22";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* leviticus */
		if ($book=='LEV' && (($chapter==5 && $verse>=20) || ($chapter==6))) {
			AION_BIBLES_SLIDE_FORE($bible, 5, 19, 7, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW Leviticus 5-6";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* numbers */
		if ($book=='NUM' && $chapter==17) {
			AION_BIBLES_SLIDE_BACK($bible, 16, 50, 15, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW Numbers 16-17";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* deuteronomy */
		if ($book=='DEU' && $chapter==13) {
			AION_BIBLES_SLIDE_BACK($bible, 12, 32, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW Deuteronomy 12-13";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		if ($book=='DEU' && $chapter==23) {
			AION_BIBLES_SLIDE_BACK($bible, 22, 30, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW Deuteronomy 22-23";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		if ($book=='DEU' && (($chapter==28 && $verse>=69) || ($chapter==29))) {
			AION_BIBLES_SLIDE_FORE($bible, 28, 68, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW Deuteronomy 28-29";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* 2 samuel */
		if ($book=='2SA' && $chapter==19) {
			AION_BIBLES_SLIDE_BACK($bible, 18, 33, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW 2 Samuel 18-19";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* 1 kings */
		if ($book=='1KI' && $chapter==5) {
			AION_BIBLES_SLIDE_BACK($bible, 4, 34, 14, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW 1 Kings 4-5";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* 2 kings */
		if ($book=='2KI' && $chapter==12) {
			AION_BIBLES_SLIDE_BACK($bible, 11, 21, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW 2 Kings 11-12";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* 1 chronicles */
		if ($book=='1CH' && (($chapter==5 && $verse>=27) || ($chapter==6))) {
			AION_BIBLES_SLIDE_FORE($bible, 5, 26, 15, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW 1 Chronicles 5-6";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* 2 chronicles */
		if ($book=='2CH' && (($chapter==1 && $verse>=18) || ($chapter==2))) {
			AION_BIBLES_SLIDE_FORE($bible, 1, 17, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW 2 Chronicles 1-2";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		if ($book=='2CH' && (($chapter==13 && $verse>=23) || ($chapter==14))) {
			AION_BIBLES_SLIDE_FORE($bible, 13, 22, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW 2 Chronicles 13-14";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* nehemiah */
		if ($book=='NEH' && (($chapter==3 && $verse>=33) || ($chapter==4))) {
			AION_BIBLES_SLIDE_FORE($bible, 3, 32, 6, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW Nehemiah 3-4";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		if ($book=='NEH' && $chapter==10) {
			AION_BIBLES_SLIDE_BACK($bible, 9, 38, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW Nehemiah 9-10";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* job */
		if ($book=='JOB' && (($chapter==40 && $verse>=25) || ($chapter==41))) {
			AION_BIBLES_SLIDE_FORE($bible, 40, 24, 8, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW Job 40-41";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* isaiah */
		if ($book=='ISA' && (($chapter==8 && $verse>=23) || ($chapter==9))) {
			AION_BIBLES_SLIDE_FORE($bible, 8, 22, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW Isaiah 8-9";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* jeremiah */
		if ($book=='JER' && (($chapter==8 && $verse>=23) || ($chapter==9))) {
			AION_BIBLES_SLIDE_FORE($bible, 8, 22, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW Jeremiah 8-9";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* ezekiel */
		if ($book=='EZE' && $chapter==21) {
			AION_BIBLES_SLIDE_BACK($bible, 20, 49, 5, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW Ezekiel 20-21";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* daniel */
		if ($book=='DAN' && (($chapter==3 && $verse>=31) || ($chapter==4))) {
			AION_BIBLES_SLIDE_FORE($bible, 3, 30, 3, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW Daniel 3-4";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		if ($book=='DAN' && $chapter==6) {
			AION_BIBLES_SLIDE_BACK($bible, 5, 31, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW Daniel 5-6";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* hosea */
		if ($book=='HOS' && $chapter==2) {
			AION_BIBLES_SLIDE_BACK($bible, 1, 11, 2, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW Hosea 1-2";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		if ($book=='HOS' && $chapter==12) {
			AION_BIBLES_SLIDE_BACK($bible, 11, 12, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW Hosea 11-12";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* micah */
		if ($book=='MIC' && (($chapter==4 && $verse>=14) || ($chapter==5))) {
			AION_BIBLES_SLIDE_FORE($bible, 4, 13, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW Micah 4-5";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* nahum */
		if ($book=='NAH' && $chapter==2) {
			AION_BIBLES_SLIDE_BACK($bible, 1, 15, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW Nahum 1-2";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* zechariah */
		if ($book=='ZEC' && $chapter==2) {
			AION_BIBLES_SLIDE_BACK($bible, 1, 21, 4, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW Zechariah 1-2";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		/* malachi */
		if ($book=='MAL' && $chapter==3 && $verse>=19) {
			AION_BIBLES_SLIDE_FORE($bible, 3, 18, 6, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: HEBREW Malachi 3-4";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* XJER GROUP */
	if (isset($database[T_VERSEMAP][$bible.'-XJER'])!==FALSE) {
		/* place holder to tackle septuagint issues in Jeremiah and elsewhere */
	}
	/* SINGLES *******************************************************/
	/* GEN21 */
	if (isset($database[T_VERSEMAP][$bible.'-GEN21'])!==FALSE) {
		if ($book=='GEN' && $chapter==21 && $verse>=29) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE Genesis 21";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* GEN31-32 */
	if (isset($database[T_VERSEMAP][$bible.'-GEN31-32'])!==FALSE) {	
		/* genesis */
		if ($book=='GEN' && $chapter==32) {
			AION_BIBLES_SLIDE_BACK($bible, 31, 55, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Genesis 31-32";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* GEN42-43 */
	if (isset($database[T_VERSEMAP][$bible.'-GEN42-43'])!==FALSE) {
		if ($book=='GEN' && (($chapter==42 && $verse>=39) || ($chapter==43))) {
			AION_BIBLES_SLIDE_FORE($bible, 42, 38, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Genesis 42-43";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* GEN37 */
	if (isset($database[T_VERSEMAP][$bible.'-GEN37'])!==FALSE) {	
		/* genesis */	
		if ($book=='GEN' && $chapter==37 && $verse>=33) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE Genesis 37";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* GEN49 */
	if (isset($database[T_VERSEMAP][$bible.'-GEN49'])!==FALSE) {
		/* genesis */	
		if ($book=='GEN' && $chapter==49 && $verse>=32) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE Genesis 49";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* EXO5 */
	if (isset($database[T_VERSEMAP][$bible.'-EXO5'])!==FALSE) {	
		/* exodus */	
		if ($book=='EXO' && $chapter==5 && $verse>=12) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE Exodus 5";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* EXO5-6 */
	if (isset($database[T_VERSEMAP][$bible.'-EXO5-6'])!==FALSE) {	
		/* exodus */	
		if ($book=='EXO' && (($chapter==5 && $verse>=24) || ($chapter==6))) {
			AION_BIBLES_SLIDE_FORE($bible, 5, 23, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Exodus 5-6";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* EXO7-8 */
	if (isset($database[T_VERSEMAP][$bible.'-EXO7-8'])!==FALSE) {	
		/* exodus */	
		if ($book=='EXO' && (($chapter==7 && $verse>=26) || ($chapter==8))) {
			AION_BIBLES_SLIDE_FORE($bible, 7, 25, 4, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Exodus 7-8";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* EXO21-22 */
	if (isset($database[T_VERSEMAP][$bible.'-EXO21-22'])!==FALSE) {	
		/* exodus */	
		if ($book=='EXO' && (($chapter==21 && $verse>=37) || ($chapter==22))) {
			AION_BIBLES_SLIDE_FORE($bible, 21, 36, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Exodus 21-22";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* EXO35-36 */
	if (isset($database[T_VERSEMAP][$bible.'-EXO35-36'])!==FALSE) {	
		/* exodus */	
		if ($book=='EXO' && (($chapter==35 && $verse>=36) || ($chapter==36))) {
			AION_BIBLES_SLIDE_FORE($bible, 35, 35, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Exodus 35-36";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* EXO40 */
	if (isset($database[T_VERSEMAP][$bible.'-EXO40'])!==FALSE) {	
		/* exodus */	
		if ($book=='EXO' && $chapter==40 && $verse>=13) {
			$verse = sprintf('%03d', $verse + 2);
			$current="WARNING REMAPPED = $bible: SINGLE Exodus 40";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* LEV5-6 */
	if (isset($database[T_VERSEMAP][$bible.'-LEV5-6'])!==FALSE) {
		/* leviticus */
		if ($book=='LEV' && (($chapter==5 && $verse>=20) || ($chapter==6))) {
			AION_BIBLES_SLIDE_FORE($bible, 5, 19, 7, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Leviticus 5-6";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* LEV15 */
	if (isset($database[T_VERSEMAP][$bible.'-LEV15'])!==FALSE) {	
		/* leviticus */	
		if ($book=='LEV' && $chapter==15 && $verse>=23) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE Leviticus 15";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* DEU12-13 */
	if (isset($database[T_VERSEMAP][$bible.'-DEU12-13'])!==FALSE) {	
		/* deuteronomy */
		if ($book=='DEU' && $chapter==13) {
			AION_BIBLES_SLIDE_BACK($bible, 12, 32, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Deuteronomy 12-13";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* DEU22-23 */
	if (isset($database[T_VERSEMAP][$bible.'-DEU22-23'])!==FALSE) {	
		/* deuteronomy */
		if ($book=='DEU' && $chapter==23) {
			AION_BIBLES_SLIDE_BACK($bible, 22, 30, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Deuteronomy 22-23";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* DEU28-29 */
	if (isset($database[T_VERSEMAP][$bible.'-DEU28-29'])!==FALSE) {	
		/* deuteronomy */	
		if ($book=='DEU' && (($chapter==28 && $verse>=69) || ($chapter==29))) {
			AION_BIBLES_SLIDE_FORE($bible, 28, 68, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Deuteronomy 28-29";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* NUM12-13 */
	if (isset($database[T_VERSEMAP][$bible.'-NUM12-13'])!==FALSE) {
		/* numbers */
		if ($book=='NUM' && $chapter==13) {
			AION_BIBLES_SLIDE_BACK($bible, 12, 16, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Numbers 12-13";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* NUM16-17 */
	if (isset($database[T_VERSEMAP][$bible.'-NUM16-17'])!==FALSE) {
		/* numbers */
		if ($book=='NUM' && $chapter==17) {
			AION_BIBLES_SLIDE_BACK($bible, 16, 50, 15, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Numbers 16-17";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* NUM29-30 */
	if (isset($database[T_VERSEMAP][$bible.'-NUM29-30'])!==FALSE) {
		/* numbers */
		if ($book=='NUM' && $chapter==30) {
			AION_BIBLES_SLIDE_BACK($bible, 29, 40, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Numbers 29-30";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* JOS5-6 */
	if (isset($database[T_VERSEMAP][$bible.'-JOS5-6'])!==FALSE) {	
		/* Joshua5-6 */	
		if ($book=='JOS' && (($chapter==5 && $verse>=16) || ($chapter==6))) {
			AION_BIBLES_SLIDE_FORE($bible, 5, 15, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Joshua 5-6";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* JOS21 */
	if (isset($database[T_VERSEMAP][$bible.'-JOS21'])!==FALSE) {	
		/* Joshua21 */	
		if ($book=='JOS' && $chapter==21 && $verse>=38) {
			$verse = sprintf('%03d', $verse + 2);
			$current="WARNING REMAPPED = $bible: SINGLE Joshua 21";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* 1SA20-21 */
	if (isset($database[T_VERSEMAP][$bible.'-1SA20-21'])!==FALSE) {	
		/* 1 samuel */
		if ($book=='1SA' && $chapter==21) {
			AION_BIBLES_SLIDE_BACK($bible, 20, 43, 1, $chapter, $verse);  // 43 even though only 42 verses to push 1/2 verse back!!
			$current="WARNING REMAPPED = $bible: SINGLE I Samuel 20-21";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* 1SA23-24 */
	if (isset($database[T_VERSEMAP][$bible.'-1SA23-24'])!==FALSE) {	
		/* 1 samuel */
		if ($book=='1SA' && $chapter==24) {
			AION_BIBLES_SLIDE_BACK($bible, 23, 29, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE I Samuel 23-24";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* 2SA18-19 */
	if (isset($database[T_VERSEMAP][$bible.'-2SA18-19'])!==FALSE) {	
		/* 2 samuel */
		if ($book=='2SA' && $chapter==19) {
			AION_BIBLES_SLIDE_BACK($bible, 18, 33, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE II Samuel 18-19";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* 1KI4-5 */
	if (isset($database[T_VERSEMAP][$bible.'-1KI4-5'])!==FALSE) {	
		/* 1 Kings */
		if ($book=='1KI' && $chapter==5) {
			AION_BIBLES_SLIDE_BACK($bible, 4, 34, 14, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE I Kings 4-5";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* 1KI20-21 */
	if (isset($database[T_VERSEMAP][$bible.'-1KI20-21'])!==FALSE) {	
		/* 1 Kings */
		if ($book=='1KI' && $chapter==21) {
			AION_BIBLES_SLIDE_BACK($bible, 20, 43, 14, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE I Kings 20-21";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* 2KI11-12 */
	if (isset($database[T_VERSEMAP][$bible.'-2KI11-12'])!==FALSE) {	
		/* 2 Kings */
		if ($book=='2KI' && $chapter==12) {
			AION_BIBLES_SLIDE_BACK($bible, 11, 21, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE II Kings 11-12";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* 1CH5-6 */
	if (isset($database[T_VERSEMAP][$bible.'-1CH5-6'])!==FALSE) {	
		/* 1 Chronicles */	
		if ($book=='1CH' && (($chapter==5 && $verse>=27) || ($chapter==6))) {
			AION_BIBLES_SLIDE_FORE($bible, 5, 26, 15, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE 1 Chronicles 5-6";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* 1CH7 */
	if (isset($database[T_VERSEMAP][$bible.'-1CH7'])!==FALSE) {	
		/* 1 Chronicles */	
		if ($book=='1CH' && $chapter==7 && $verse>=23) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE 1 Chronicles 7";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* 1CH21-22 */
	if (isset($database[T_VERSEMAP][$bible.'-1CH21-22'])!==FALSE) {	
		/* 1 Chronicles */	
		if ($book=='1CH' && (($chapter==21 && $verse>=31) || ($chapter==22))) {
			AION_BIBLES_SLIDE_FORE($bible, 21, 30, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE 1 Chronicles 21-22";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* 2CH1-2 */
	if (isset($database[T_VERSEMAP][$bible.'-2CH1-2'])!==FALSE) {	
		/* 2 Chronicles */	
		if ($book=='2CH' && (($chapter==1 && $verse>=18) || ($chapter==2))) {
			AION_BIBLES_SLIDE_FORE($bible, 1, 17, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE 2 Chronicles 1-2";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* 2CH13-14 */
	if (isset($database[T_VERSEMAP][$bible.'-2CH13-14'])!==FALSE) {	
		/* 2 Chronicles */	
		if ($book=='2CH' && (($chapter==13 && $verse>=23) || ($chapter==14))) {
			AION_BIBLES_SLIDE_FORE($bible, 13, 22, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE 2 Chronicles 13-14";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* NEH3-4 */
	if (isset($database[T_VERSEMAP][$bible.'-NEH3-4'])!==FALSE) {	
		/* Nehemiah */	
		if ($book=='NEH' && (($chapter==3 && $verse>=33) || ($chapter==4))) {
			AION_BIBLES_SLIDE_FORE($bible, 3, 32, 6, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Nehemiah 3-4";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* NEH7-8 */
	if (isset($database[T_VERSEMAP][$bible.'-NEH7-8'])!==FALSE) {	
		/* Nehemiah */
		if ($book=='NEH' && $chapter==8) {
			AION_BIBLES_SLIDE_BACK($bible, 7, 74, 1, $chapter, $verse);  // 74 even though only 73 verses to push 1/2 verse back!!
			$current="WARNING REMAPPED = $bible: SINGLE Nehmiah 7-8";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* NEH7 */
	if (isset($database[T_VERSEMAP][$bible.'-NEH7'])!==FALSE) {	
		/* Nehemiah */	
		if ($book=='NEH' && $chapter==7 && $verse>=68) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE Nehemiah 7";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* NEH9-10 */
	if (isset($database[T_VERSEMAP][$bible.'-NEH9-10'])!==FALSE) {	
		/* Nehemiah */
		if ($book=='NEH' && $chapter==10) {
			AION_BIBLES_SLIDE_BACK($bible, 9, 38, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Nehmiah 9-10";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* EST8 */
	if (isset($database[T_VERSEMAP][$bible.'-EST8'])!==FALSE) {	
		/* Esther */	
		if ($book=='EST' && $chapter==8 && $verse>=13) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE Esther 8";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* EST9 */
	if (isset($database[T_VERSEMAP][$bible.'-EST9'])!==FALSE) {	
		/* Esther */	
		if ($book=='EST' && $chapter==9 && $verse>=30) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE Esther 9";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* JOB16-17 */
	if (isset($database[T_VERSEMAP][$bible.'-JOB16-17'])!==FALSE) {	
		/* JOB */	
		if ($book=='JOB' && (($chapter==16 && $verse>=23) || ($chapter==17))) {
			AION_BIBLES_SLIDE_FORE($bible, 16, 22, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Job 16-17";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* JOB36-37 */
	if (isset($database[T_VERSEMAP][$bible.'-JOB36-37'])!==FALSE) {	
		/* JOB */	
		if ($book=='JOB' && (($chapter==36 && $verse>=34) || ($chapter==37))) {
			AION_BIBLES_SLIDE_FORE($bible, 36, 33, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Job 36-37";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* JOB38-39-40 */
	if (isset($database[T_VERSEMAP][$bible.'-JOB38-39-40'])!==FALSE) {	
		/* Job */
		if ($book=='JOB' && $chapter==39 && $verse<=33) {
			AION_BIBLES_SLIDE_BACK($bible, 38, 41, 3, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Job 38-39-40";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		if ($book=='JOB' && (($chapter==39 && $verse>=34) || ($chapter==40))) {
			AION_BIBLES_SLIDE_FORE($bible, 39, 33, 5, $chapter, $verse); // verse total of 33 faked since 3 moved back and 5 moved foward
			$current="WARNING REMAPPED = $bible: SINGLE Job 38-39-40";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* JOB39-40-41-42 complicated move across three chapters - 8 verses + 41:50 funk! */
	if (isset($database[T_VERSEMAP][$bible.'-JOB39-40-41-42B'])!==FALSE) {
		/* Job */
		if ($book=='JOB' && (($chapter==39 && $verse>=31) || ($chapter==40 && $verse<=19))) {
			AION_BIBLES_SLIDE_FORE($bible, 39, 30, 5, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Job 39-40-41-42B";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		if ($book=='JOB' && (($chapter==40 && $verse>=20) || ($chapter==41 && $verse==1))) {
			AION_BIBLES_SLIDE_FORE($bible, 40, 19, 8, $chapter, $verse); // faking for a double move!
			$current="WARNING REMAPPED = $bible: SINGLE Job 39-40-41-42B";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		if ($book=='JOB' && $chapter==41 && $verse==50) { // funkeee50 to verse 10 from RAWFIX
			$verse = "010"; 
			$current="WARNING REMAPPED = $bible: SINGLE Job 39-40-41-42B";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		if ($book=='JOB' && $chapter==41 && $verse>=2) {
			AION_BIBLES_SLIDE_FORE($bible, 40, 19, 9, $chapter, $verse); // faking for a double move!
			$current="WARNING REMAPPED = $bible: SINGLE Job 39-40-41-42B";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* JOB39-40-41-42 complicated move across three chapters - 8 verses! */
	if (isset($database[T_VERSEMAP][$bible.'-JOB39-40-41-42A'])!==FALSE) {
		/* Job */
		if ($book=='JOB' && (($chapter==39 && $verse>=31) || ($chapter==40 && $verse<=19))) {
			AION_BIBLES_SLIDE_FORE($bible, 39, 30, 5, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Job 39-40-41-42A";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		if ($book=='JOB' && (($chapter==40 && $verse>=20) || ($chapter==41))) {
			AION_BIBLES_SLIDE_FORE($bible, 40, 19, 8, $chapter, $verse); // faking for a double move!
			$current="WARNING REMAPPED = $bible: SINGLE Job 39-40-41-42A";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* JOB39-40-41-42 complicated move across three chapters - 9 verses! */
	if (isset($database[T_VERSEMAP][$bible.'-JOB39-40-41-42'])!==FALSE) {
		/* Job */
		if ($book=='JOB' && (($chapter==39 && $verse>=31) || ($chapter==40 && $verse<=19))) {
			AION_BIBLES_SLIDE_FORE($bible, 39, 30, 5, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Job 39-40-41-42";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		if ($book=='JOB' && (($chapter==40 && $verse>=20) || ($chapter==41))) {
			AION_BIBLES_SLIDE_FORE($bible, 40, 19, 9, $chapter, $verse); // faking for a double move!
			$current="WARNING REMAPPED = $bible: SINGLE Job 39-40-41-42";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* JOB38-39-40-41, 3 back, 5 forward, 9 forward */
	if (isset($database[T_VERSEMAP][$bible.'-JOB38-39-40-41'])!==FALSE) {	
		/* Job */
		if ($book=='JOB' && $chapter==39 && $verse<=33) {
			AION_BIBLES_SLIDE_BACK($bible, 38, 41, 3, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Job 38-39-40-41";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		if ($book=='JOB' && (($chapter==39 && $verse>=34) || ($chapter==40 && $verse<=19))) {
			AION_BIBLES_SLIDE_FORE($bible, 39, 33, 5, $chapter, $verse); // verse total of 33 faked since 3 moved back and 5 moved foward
			$current="WARNING REMAPPED = $bible: SINGLE Job 38-39-40-41";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		if ($book=='JOB' && (($chapter==40 && $verse>=20) || ($chapter==41))) {
			AION_BIBLES_SLIDE_FORE($bible, 40, 19, 9, $chapter, $verse); // verse total of 19 faked since 5 moved forward
			$current="WARNING REMAPPED = $bible: SINGLE Job 38-39-40-41";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* JOB40-41 */
	if (isset($database[T_VERSEMAP][$bible.'-JOB40-41'])!==FALSE) {	
		/* JOB */	
		if ($book=='JOB' && (($chapter==40 && $verse>=25) || ($chapter==41))) {
			AION_BIBLES_SLIDE_FORE($bible, 40, 24, 8, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Job 40-41";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* PSA66 */
	if (isset($database[T_VERSEMAP][$bible.'-PSA66'])!==FALSE) {
		/* Proverbs */
		if ($book=='PSA' && ($chapter==66)) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE Psalms 66";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* PSA2 */
	if (isset($database[T_VERSEMAP][$bible.'-PSA2'])!==FALSE) {
		/* 9=9&10,146&147=147 */
		if ($book=='PSA' && $chapter>=9 && $chapter<=147) {
			if ($chapter==9 && $verse>=21) {						$chapter = sprintf('%03d', $chapter+1);		$verse = sprintf('%03d', $verse-20); }
			else if ($chapter>=10 && $chapter<=146) {				$chapter = sprintf('%03d', $chapter+1); }
			else if ($chapter==147) {																			$verse = sprintf('%03d', $verse+11); }
			$current="WARNING REMAPPED = $bible: SINGLE Psalms TWO Chapters";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* PSA150 */
	if (isset($database[T_VERSEMAP][$bible.'-PSA150'])!==FALSE) {
		/* 9=9&10,113=114&115,114&115=116,146&147=147 */
		if ($book=='PSA' && $chapter>=9 && $chapter<=147) {
			if ($chapter==9 && $verse>=22) {						$chapter = sprintf('%03d', $chapter+1);		$verse = sprintf('%03d', $verse-21); }
			else if ($chapter>=10 && $chapter<=112) {				$chapter = sprintf('%03d', $chapter+1); }
			else if ($chapter==113 && $verse<=8) {					$chapter = sprintf('%03d', $chapter+1); }
			else if ($chapter==113) {								$chapter = sprintf('%03d', $chapter+2); 	$verse = sprintf('%03d', $verse-8); }
			else if ($chapter==114) {								$chapter = sprintf('%03d', $chapter+2); }
			else if ($chapter==115) {								$chapter = sprintf('%03d', $chapter+1); 	$verse = sprintf('%03d', $verse+9); }
			else if ($chapter>=116 && $chapter<=146) {				$chapter = sprintf('%03d', $chapter+1); }
			else if ($chapter==147) {																			$verse = sprintf('%03d', $verse+11); }
			$current="WARNING REMAPPED = $bible: SINGLE Psalms ALL Chapters";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* PSA94 */
	if (isset($database[T_VERSEMAP][$bible.'-PSA94'])!==FALSE) {
		if ($book=='PSA' && $chapter==94 && $verse>=5) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE Psalms 94";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* PRO1 */
	if (isset($database[T_VERSEMAP][$bible.'-PRO1'])!==FALSE) {
		/* Proverbs */
		if ($book=='PRO' && $chapter==1) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE Proverbs 1";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* PRO11-12 */
	if (isset($database[T_VERSEMAP][$bible.'-PRO11-12'])!==FALSE) {
		/* Proverbs */
		if ($book=='PRO' && (($chapter==11 && $verse>=32) || ($chapter==12))) {
			AION_BIBLES_SLIDE_FORE($bible, 11, 31, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Proverbs 11-12";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* ECC1-2 */
	if (isset($database[T_VERSEMAP][$bible.'-ECC1-2'])!==FALSE) {	
		/* Ecclesiates */
		if ($book=='ECC' && $chapter==2) {
			AION_BIBLES_SLIDE_BACK($bible, 1, 18, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Ecclesiates 1-2";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* ECC4-5 */
	if (isset($database[T_VERSEMAP][$bible.'-ECC4-5'])!==FALSE) {	
		/* Ecclesiates */	
		if ($book=='ECC' && (($chapter==4 && $verse>=17) || ($chapter==5))) {
			AION_BIBLES_SLIDE_FORE($bible, 4, 16, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Ecclesiates 4-5";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* ECC6-7 */
	if (isset($database[T_VERSEMAP][$bible.'-ECC6-7'])!==FALSE) {	
		/* Ecclesiates */
		if ($book=='ECC' && $chapter==7) {
			AION_BIBLES_SLIDE_BACK($bible, 6, 12, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Ecclesiates 6-7";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* ECC6-7B */
	if (isset($database[T_VERSEMAP][$bible.'-ECC6-7B'])!==FALSE) {	
		/* Ecclesiates */
		if ($book=='ECC' && $chapter==7) {
			AION_BIBLES_SLIDE_BACK($bible, 6, 12, 2, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Ecclesiates 6-7B";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* ECC7-8 */
	if (isset($database[T_VERSEMAP][$bible.'-ECC7-8'])!==FALSE) {	
		/* Ecclesiates */	
		if ($book=='ECC' && (($chapter==7 && $verse>=30) || ($chapter==8))) {
			AION_BIBLES_SLIDE_FORE($bible, 7, 29, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Ecclesiates 7-8";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* ECC8-9-10 */
	if (isset($database[T_VERSEMAP][$bible.'-ECC8-9-10'])!==FALSE) {	
		/* Ecclesiates */
		if ($book=='ECC' && $chapter==9 && $verse<=20) {
			AION_BIBLES_SLIDE_BACK($bible, 8, 17, 2, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Ecclesiates 8-9-10";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		if ($book=='ECC' && (($chapter==9 && $verse>=21) || ($chapter==10))) {
			AION_BIBLES_SLIDE_FORE($bible, 9, 20, 3, $chapter, $verse); // indicating 20 verses even though 18 to fake it out
			$current="WARNING REMAPPED = $bible: SINGLE Ecclesiates 8-9-10";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* SOL1 */
	if (isset($database[T_VERSEMAP][$bible.'-SOL1'])!==FALSE) {
		if ($book=='SOL' && $chapter==1) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE Song of Solomon 1";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* SOL1-8 */
	if (isset($database[T_VERSEMAP][$bible.'-SOL1-8'])!==FALSE) {
		if ($book=='SOL') {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE Song of Solomon 1-8";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* SOL5-6 */
	if (isset($database[T_VERSEMAP][$bible.'-SOL5-6'])!==FALSE) {
		if ($book=='SOL' && (($chapter==5 && $verse>=17) || ($chapter==6))) {
			AION_BIBLES_SLIDE_FORE($bible, 5, 16, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Song of Solomon 5-6";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* SOL5-6 THREE */
	if (isset($database[T_VERSEMAP][$bible.'-SOL5-6T'])!==FALSE) {
		if ($book=='SOL' && (($chapter==5 && $verse>=17) || ($chapter==6))) {
			AION_BIBLES_SLIDE_FORE($bible, 5, 16, 3, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Song of Solomon 5-6 THREE";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* SOL6-7 */
	if (isset($database[T_VERSEMAP][$bible.'-SOL6-7'])!==FALSE) {
		/* song of solomon */
		if ($book=='SOL' && $chapter==7) {
			AION_BIBLES_SLIDE_BACK($bible, 6, 13, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Song of Solomon 6-7";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* ECC11-12 */
	if (isset($database[T_VERSEMAP][$bible.'-ECC11-12'])!==FALSE) {
		/* ecclesiastes */
		if ($book=='ECC' && $chapter==12) {
			AION_BIBLES_SLIDE_BACK($bible, 11, 10, 2, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Ecclesiastes 11-12";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* ISA2-3-4 */
	if (isset($database[T_VERSEMAP][$bible.'-ISA2-3-4'])!==FALSE) {	
		/* Isaiah */
		if ($book=='ISA' && $chapter==3 && $verse<=27) {
			AION_BIBLES_SLIDE_BACK($bible, 2, 22, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Isaiah 2-3-4";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
		if ($book=='ISA' && (($chapter==3 && $verse>=28) || ($chapter==4))) {
			AION_BIBLES_SLIDE_FORE($bible, 3, 27, 1, $chapter, $verse); // indicating 27 verses even though 26 to fake it out
			$current="WARNING REMAPPED = $bible: SINGLE Isaiah 2-3-4";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* ISA8-9 */
	if (isset($database[T_VERSEMAP][$bible.'-ISA8-9'])!==FALSE) {
		if ($book=='ISA' && (($chapter==8 && $verse>=23) || ($chapter==9))) {
			AION_BIBLES_SLIDE_FORE($bible, 8, 22, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Isaiah 8-9";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* ISA63-64 */
	if (isset($database[T_VERSEMAP][$bible.'-ISA63-64'])!==FALSE) {
		if ($book=='ISA' && (($chapter==63 && $verse>=20) || ($chapter==64))) {
			AION_BIBLES_SLIDE_FORE($bible, 63, 19, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Isaiah 63-64";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* ISA64 */
	if (isset($database[T_VERSEMAP][$bible.'-ISA64'])!==FALSE) {
		if ($book=='ISA' && $chapter==64) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE Isaiah 64";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* JER8-9 */
	if (isset($database[T_VERSEMAP][$bible.'-JER8-9'])!==FALSE) {
		if ($book=='JER' && (($chapter==8 && $verse>=23) || ($chapter==9))) {
			AION_BIBLES_SLIDE_FORE($bible, 8, 22, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Jeremiah 8-9";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* JER30-31 */
	if (isset($database[T_VERSEMAP][$bible.'-JER30-31'])!==FALSE) {
		if ($book=='JER' && (($chapter==30 && $verse>=25) || ($chapter==31))) {
			AION_BIBLES_SLIDE_FORE($bible, 30, 24, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Jeremiah 30-31";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* EZE6 */
	if (isset($database[T_VERSEMAP][$bible.'-EZE6'])!==FALSE) {
		if ($book=='EZE' && $chapter==6 && $verse>=5) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE Ezekiel 6";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* EZE20-21 */
	if (isset($database[T_VERSEMAP][$bible.'-EZE20-21'])!==FALSE) {
		if ($book=='EZE' && $chapter==21) {
			AION_BIBLES_SLIDE_BACK($bible, 20, 49, 5, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Ezekiel 20-21";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* DAN100 */
	if (isset($database[T_VERSEMAP][$bible.'-DAN100'])!==FALSE) {
		if ($book=='DAN' && (($chapter==3 && $verse>=24) || $chapter==4)) {
			if ($chapter==3 && $verse>=24 && $verse<=90) {			return FALSE; }
			else if ($chapter==3 && $verse>=91 && $verse<=97) {													$verse = sprintf('%03d', $verse-67); }
			else if ($chapter==3 && $verse>=98) {					$chapter = sprintf('%03d', $chapter+1);		$verse = sprintf('%03d', $verse-97); }
			else if ($chapter==4) {																				$verse = sprintf('%03d', $verse+3); }
			$current="WARNING REMAPPED = $bible: SINGLE Daniel 3:100";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* DAN100B - Chap 4 already okay */
	if (isset($database[T_VERSEMAP][$bible.'-DAN100B'])!==FALSE) {
		if ($book=='DAN' && (($chapter==3 && $verse>=24) || $chapter==4)) {
			if ($chapter==3 && $verse>=24 && $verse<=90) {			return FALSE; }
			else if ($chapter==3 && $verse>=91 && $verse<=97) {													$verse = sprintf('%03d', $verse-67); }
			else if ($chapter==3 && $verse>=98) {					$chapter = sprintf('%03d', $chapter+1);		$verse = sprintf('%03d', $verse-97); }
			$current="WARNING REMAPPED = $bible: SINGLE Daniel 3:100B";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* DAN3-4 */
	if (isset($database[T_VERSEMAP][$bible.'-DAN3-4'])!==FALSE) {
		if ($book=='DAN' && (($chapter==3 && $verse>=31) || ($chapter==4))) {
			AION_BIBLES_SLIDE_FORE($bible, 3, 30, 3, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Daniel 3-4";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* DAN5-6 */
	if (isset($database[T_VERSEMAP][$bible.'-DAN5-6'])!==FALSE) {
		if ($book=='DAN' && $chapter==6) {
			AION_BIBLES_SLIDE_BACK($bible, 5, 31, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Daniel 5-6";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* JON1-2 */
	if (isset($database[T_VERSEMAP][$bible.'-JON1-2'])!==FALSE) {	
		if ($book=='JON' && $chapter==2) {
			AION_BIBLES_SLIDE_BACK($bible, 1, 17, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Jonah 1-2";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* HAG1-2 */
	if (isset($database[T_VERSEMAP][$bible.'-HAG1-2'])!==FALSE) {
		/* haggai */
		if ($book=='HAG' && $chapter==2) {
			AION_BIBLES_SLIDE_BACK($bible, 1, 15, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Haggai 1-2";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* HOS1-2 */
	if (isset($database[T_VERSEMAP][$bible.'-HOS1-2'])!==FALSE) {
		if ($book=='HOS' && $chapter==2) {
			AION_BIBLES_SLIDE_BACK($bible, 1, 11, 2, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Hosea 1-2";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* HOS1-2F */
	if (isset($database[T_VERSEMAP][$bible.'-HOS1-2F'])!==FALSE) {
		if ($book=='HOS' && (($chapter==1 && $verse>=12) || ($chapter==2))) {
			AION_BIBLES_SLIDE_FORE($bible, 1, 11, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Hosea 1-2 Forward";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* HOS11-12 */
	if (isset($database[T_VERSEMAP][$bible.'-HOS11-12'])!==FALSE) {
		/* hosea */
		if ($book=='HOS' && $chapter==12) {
			AION_BIBLES_SLIDE_BACK($bible, 11, 12, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Hosea 11-12";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* HOS13-14 */
	if (isset($database[T_VERSEMAP][$bible.'-HOS13-14'])!==FALSE) {
		if ($book=='HOS' && $chapter==14) {
			AION_BIBLES_SLIDE_BACK($bible, 13, 16, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Hosea 13-14";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* JOE2-3 */
	if (isset($database[T_VERSEMAP][$bible.'-JOE2-3'])!==FALSE) {
		/* joel */
		if ($book=='JOE' && $chapter==3) {
			AION_BIBLES_SLIDE_BACK($bible, 2, 32, 5, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Joel 2-3";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* JOE3-4 */
	if (isset($database[T_VERSEMAP][$bible.'-JOE3-4'])!==FALSE) {
		/* joel */
		if ($book=='JOE' && $chapter>=3) {
			if ($chapter==3) {										$chapter = sprintf('%03d', 2);				$verse = sprintf('%03d', $verse+27); }
			else if ($chapter==4) {									$chapter = sprintf('%03d', 3); }
			$current="WARNING REMAPPED = $bible: SINGLE Joel 3-4";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* MIC4-5 */
	if (isset($database[T_VERSEMAP][$bible.'-MIC4-5'])!==FALSE) {
		/* micah */
		if ($book=='MIC' && (($chapter==4 && $verse>=14) || ($chapter==5))) {
			AION_BIBLES_SLIDE_FORE($bible, 4, 13, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Micah 4-5";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* NAH1-2 */
	if (isset($database[T_VERSEMAP][$bible.'-NAH1-2'])!==FALSE) {	
		/* nahum */
		if ($book=='NAH' && $chapter==2) {
			AION_BIBLES_SLIDE_BACK($bible, 1, 15, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Nahum 1-2";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* ZEC1-2 */
	if (isset($database[T_VERSEMAP][$bible.'-ZEC1-2'])!==FALSE) {	
		/* zechariah */
		if ($book=='ZEC' && $chapter==2) {
			AION_BIBLES_SLIDE_BACK($bible, 1, 21, 4, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Zechariah 1-2";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* MAL3-4 */
	if (isset($database[T_VERSEMAP][$bible.'-MAL3-4'])!==FALSE) {
		/* malachi */
		if ($book=='MAL' && $chapter==3 && $verse>=19) {
			AION_BIBLES_SLIDE_FORE($bible, 3, 18, 6, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Malachi 3-4";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* MAT2 */
	if (isset($database[T_VERSEMAP][$bible.'-MAT2'])!==FALSE) {
		/* matthew */
		if ($book=='MAT' && $chapter==2 && $verse>=17) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE Matthew 2";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* MAT12 */
	if (isset($database[T_VERSEMAP][$bible.'-MAT12'])!==FALSE) {
		/* matthew */
		if ($book=='MAT' && $chapter==12 && $verse>=18) {
			$verse = sprintf('%03d', $verse + 4);
			$current="WARNING REMAPPED = $bible: SINGLE Matthew 12";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* MAT16 */
	if (isset($database[T_VERSEMAP][$bible.'-MAT16'])!==FALSE) {
		/* matthew */
		if ($book=='MAT' && $chapter==16 && $verse>=2) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE Matthew 16";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* MAT23 */
	if (isset($database[T_VERSEMAP][$bible.'-MAT23'])!==FALSE) {
		/* matthew */
		if ($book=='MAT' && $chapter==23 && $verse>=14) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE Matthew 23";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* MAR8-9 */
	if (isset($database[T_VERSEMAP][$bible.'-MAR8-9'])!==FALSE) {
		/* mark */
		if ($book=='MAR' && (($chapter==8 && $verse>=39) || ($chapter==9))) {
			AION_BIBLES_SLIDE_FORE($bible, 8, 38, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Mark 8-9";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* MAR11 */
	if (isset($database[T_VERSEMAP][$bible.'-MAR11'])!==FALSE) {
		/* mark */
		if ($book=='MAR' && $chapter==11 && $verse>=26) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE Mark 11";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* JOH5 */
	if (isset($database[T_VERSEMAP][$bible.'-JOH5'])!==FALSE) {
		/* John 5 */
		if ($book=='JOH' && $chapter==5 && $verse>=4) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE John 5";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* JOH7-8 */
	if (isset($database[T_VERSEMAP][$bible.'-JOH7-8'])!==FALSE) {
		/* John */
		if ($book=='JOH' && (($chapter==7 && $verse>=54) || ($chapter==8))) {
			AION_BIBLES_SLIDE_FORE($bible, 7, 53, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE John 7-8";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* JOH14 */
	if (isset($database[T_VERSEMAP][$bible.'-JOH14'])!==FALSE) {
		/* John */
		if ($book=='JOH' && $chapter==14 && $verse>=14) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE John 14";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* LUK2 */
	if (isset($database[T_VERSEMAP][$bible.'-LUK2'])!==FALSE) {
		/* Luke */
		if ($book=='LUK' && $chapter==2 && $verse>=29) {
			$verse = sprintf('%03d', $verse + 4);
			$current="WARNING REMAPPED = $bible: SINGLE Luke 2";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* LUK3 */
	if (isset($database[T_VERSEMAP][$bible.'-LUK3'])!==FALSE) {
		/* Luke */
		if ($book=='LUK' && $chapter==3 && $verse>=5) {
			$verse = sprintf('%03d', $verse + 2);
			$current="WARNING REMAPPED = $bible: SINGLE Luke 3";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* LUK11 */
	if (isset($database[T_VERSEMAP][$bible.'-LUK11'])!==FALSE) {
		/* Luke */
		if ($book=='LUK' && $chapter==11 && $verse>=3) {
			$verse = sprintf('%03d', $verse + 2);
			$current="WARNING REMAPPED = $bible: SINGLE Luke 11";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* LUK17 */
	if (isset($database[T_VERSEMAP][$bible.'-LUK17'])!==FALSE) {
		/* Luke */
		if ($book=='LUK' && $chapter==17 && $verse>=36) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE Luke 17";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* ACT15 */
	if (isset($database[T_VERSEMAP][$bible.'-ACT15'])!==FALSE) {
		/* Act 15 */
		if ($book=='ACT' && $chapter==15 && $verse>=34) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE Act 15";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* ACT28 */
	if (isset($database[T_VERSEMAP][$bible.'-ACT28'])!==FALSE) {
		/* Act 28 */
		if ($book=='ACT' && $chapter==28 && $verse>=29) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE Act 29";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* ROM14-16 */
	if (isset($database[T_VERSEMAP][$bible.'-ROM14-16'])!==FALSE) {
		/* Romans 14-16 */
		if ($book=='ROM' && (($chapter==14 && $verse>=24) || ($chapter==16 && $verse>=25))) {
			if ($chapter==16) {										return FALSE; }
			else if ($chapter==14) {								$chapter = sprintf('%03d', 16); $verse = sprintf('%03d', $verse+1); }
			$current="WARNING REMAPPED = $bible: SINGLE Romans 14-16";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* ROM16 */
	if (isset($database[T_VERSEMAP][$bible.'-ROM16'])!==FALSE) {
		/* Romans 16 */
		if ($book=='ROM' && $chapter==16 && $verse>=24) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE Romans 16";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* COL3-4 */
	if (isset($database[T_VERSEMAP][$bible.'-COL3-4'])!==FALSE) {
		/* Colossians */
		if ($book=='COL' && (($chapter==3 && $verse>=26) || ($chapter==4))) {
			AION_BIBLES_SLIDE_FORE($bible, 3, 25, 1, $chapter, $verse);
			$current="WARNING REMAPPED = $bible: SINGLE Colossians 3-4";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* 2TH2 */
	if (isset($database[T_VERSEMAP][$bible.'-2TH2'])!==FALSE) {
		/* 2 Thessalonians 2 */
		if ($book=='2TH' && $chapter==2 && $verse>=11) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE 2 Thessalonians 2";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* 2TI4 */
	if (isset($database[T_VERSEMAP][$bible.'-2TI4'])!==FALSE) {
		/* 2 Timothy 4 */
		if ($book=='2TI' && $chapter==4 && $verse>=12) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE 2 Timothy 4";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* 1JO3 */
	if (isset($database[T_VERSEMAP][$bible.'-1JO3'])!==FALSE) {
		/* 1 John 3 */
		if ($book=='1JO' && $chapter==3 && $verse>=23) {
			$verse = sprintf('%03d', $verse + 1);
			$current="WARNING REMAPPED = $bible: SINGLE 1 John 3";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
	/* REV12-18 */
	if (isset($database[T_VERSEMAP][$bible.'-REV12-18'])!==FALSE) {	
		/* REV */
		if ($book=='REV' && $chapter==13) {
			AION_BIBLES_SLIDE_BACK($bible, 12, 17, 1, $chapter, $verse);	$current="WARNING REMAPPED = $bible: SINGLE Rev 12-18 12";	if ($previous!=$current) { AION_ECHO($current); $previous=$current; } goto YO; }
		if ($book=='REV' && $chapter==14) {
			AION_BIBLES_SLIDE_BACK($bible, 13, 18, 1, $chapter, $verse);	$current="WARNING REMAPPED = $bible: SINGLE Rev 12-18 13";	if ($previous!=$current) { AION_ECHO($current); $previous=$current; } goto YO; }
		if ($book=='REV' && $chapter==15) {
			AION_BIBLES_SLIDE_BACK($bible, 14, 20, 1, $chapter, $verse);	$current="WARNING REMAPPED = $bible: SINGLE Rev 12-18 14";	if ($previous!=$current) { AION_ECHO($current); $previous=$current; } goto YO; }
		if ($book=='REV' && $chapter==16) {
			AION_BIBLES_SLIDE_BACK($bible, 15, 8, 1, $chapter, $verse);		$current="WARNING REMAPPED = $bible: SINGLE Rev 12-18 15";	if ($previous!=$current) { AION_ECHO($current); $previous=$current; } goto YO; }
		if ($book=='REV' && $chapter==17) {
			AION_BIBLES_SLIDE_BACK($bible, 16, 21, 1, $chapter, $verse);	$current="WARNING REMAPPED = $bible: SINGLE Rev 12-18 16";	if ($previous!=$current) { AION_ECHO($current); $previous=$current; } goto YO; }
		if ($book=='REV' && $chapter==18) {
			AION_BIBLES_SLIDE_BACK($bible, 17, 18, 1, $chapter, $verse);	$current="WARNING REMAPPED = $bible: SINGLE Rev 12-18 17";	if ($previous!=$current) { AION_ECHO($current); $previous=$current; } goto YO; }
	}
	/* CUSTOM TRANSLATION */
	if (isset($database[T_VERSEMAP][$bible.'-XALB'])!==FALSE) {
		$albanian = $index.'-'.$book.'-'.$chapter.'-'.$verse;
		if(!empty(    $database[T_VERSEMAPALBANIAN][$albanian])) {
			$index	= $database[T_VERSEMAPALBANIAN][$albanian]['INDEX2'];
			$book	= $database[T_VERSEMAPALBANIAN][$albanian]['BOOK2'];
			$chapter= $database[T_VERSEMAPALBANIAN][$albanian]['CHAPTER2'];
			$verse	= $database[T_VERSEMAPALBANIAN][$albanian]['VERSE2'];
			$current="WARNING REMAPPED = $bible: ALBANIAN FIASCO!";
			if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
			goto YO;
		}
	}
SKIP:
	/* skip apocryphal and other verses */
	/* joshua 9:28+
	/* esther 10:4-16 */
	/* daniel 13-14 */
	if ($chapter > $database[T_BOOKSCOUNT][$book][C_CHAPTER] ||
		($book=='JOS' && $chapter==9 && $verse>=28) ||
		($book=='EST' && $chapter==10 && $verse>=4) ) {
		$current="WARNING REMAPPED = $bible: Apocryphal Verses Skipped! $book $chapter";
		if ($previous!=$current) { AION_ECHO($current); $previous=$current; }
		return FALSE;
	}
YO:	if ('Holy-Bible---Bengali---Bengali-Bible'==$bible && $book=='1CO' && $chapter==10 && $verse==34) { AION_ECHO("WARNING REMAPPED = $bible: Extra Verses Skipped! $book $chapter $verse"); return FALSE; }
	if ('Holy-Bible---English---Douay-Rheims-1899'==$bible && $book=='PSA' && $chapter==136 && $verse==27) { AION_ECHO("WARNING REMAPPED = $bible: Extra Verses Skipped! $book $chapter $verse"); return FALSE; }
	if ('Holy-Bible---Myanmar---Myanmar-Burmese-Judson'==$bible && $book=='NUM' && $chapter==27 && $verse==24) { $verse="023"; AION_ECHO("WARNING REMAPPED = $bible: verse moved back! $book $chapter $verse"); return TRUE; }
	if ('Holy-Bible---Russian---Russian-Synodal-Translation'==$bible && $book=='JOS' && $chapter==24 && $verse>=34) { AION_ECHO("WARNING REMAPPED = $bible: Extra Verses Skipped! $book $chapter $verse"); return FALSE; }
	if ('Holy-Bible---Russian---Russian-Synodal-Translation'==$bible && $book=='PRO' && $chapter==4 && $verse>=28) { AION_ECHO("WARNING REMAPPED = $bible: Extra Verses Skipped! $book $chapter $verse"); return FALSE; }
	if ('Holy-Bible---Russian---Russian-Synodal-Translation-CS'==$bible && $book=='JOS' && $chapter==24 && $verse>=34) { AION_ECHO("WARNING REMAPPED = $bible: Extra Verses Skipped! $book $chapter $verse"); return FALSE; }
	if ('Holy-Bible---Russian---Russian-Synodal-Translation-CS'==$bible && $book=='PRO' && $chapter==4 && $verse>=28) { AION_ECHO("WARNING REMAPPED = $bible: Extra Verses Skipped! $book $chapter $verse"); return FALSE; }
	if ('Holy-Bible---SlavonicChurch---Church-Slavonic-Elizabeth'==$bible && $book=='JOS' && $chapter==24 && $verse>=34) { AION_ECHO("WARNING REMAPPED = $bible: Extra Verses Skipped! $book $chapter $verse"); return FALSE; }
	if ('Holy-Bible---SlavonicChurch---Church-Slavonic-Elizabeth'==$bible && $book=='PRO' && $chapter==4 && $verse>=28) { AION_ECHO("WARNING REMAPPED = $bible: Extra Verses Skipped! $book $chapter $verse"); return FALSE; }
	return AION_BIBLES_COMBINER($bible,$index,$book,$chapter,$verse,$text);
}
function AION_BIBLES_SLIDE_FORE($bible, $chapter1, $verses1, $verses_fore, &$chapterN, &$verseN) {
	if (	 $chapterN == $chapter1     && $verseN > $verses1 + $verses_fore) {	AION_ECHO("ERROR! Remapper slide fore: $bible	$chapterN	$verseN"); }
	else if ($chapterN == $chapter1     && $verseN > $verses1) {				$chapterN = sprintf('%03d', $chapterN + 1); $verseN = sprintf('%03d', $verseN - $verses1); }
	else if ($chapterN == $chapter1 + 1) {										$verseN = sprintf('%03d', $verseN + $verses_fore); }
}
function AION_BIBLES_SLIDE_BACK($bible, $chapter1, $verses1, $verses_back, &$chapterN, &$verseN) {
	if ($chapterN == $chapter1 + 1 && $verseN <= $verses_back) {				$chapterN = sprintf('%03d', $chapterN - 1); $verseN = sprintf('%03d', $verses1 - $verses_back + $verseN); }
	else if ($chapterN == $chapter1 + 1) {										$verseN = sprintf('%03d', $verseN - $verses_back); }
}
function AION_BIBLES_REMAPPER_FUNK($numb,$book,$chap,$vers,$bookscount) {
	/* This is a funky function strongly related to AION_BIBLES_REMAPPER()
	 * AION_BIBLES_REMAPPER() remaps verse references or returns FALSE to skip a verse
	 * AION_BIBLES_REMAPPER_FUNK() returns TRUE for the subset of skipped verses with
	 * out of bound apocryphal books.  This help to streamline the final check.
	 * Thus the input conversion and the final check data comparison can loop through
	 * all aionian to source and source to aionian verses and find distinct matches.
	 */
	if ($numb>66 || empty($bookscount[$book])) { return TRUE; }
	return FALSE;
}
function AION_BIBLES_COMBINER($bible,&$index,&$book,&$chapter,&$verse,&$text) {
	/* get the database once */
	static $database = FALSE;
	if ($database===FALSE) {
		$database = array();
		AION_FILE_DATA_GET( './aion_database/VERSEMAPCOMBINER.txt', 'T_VERSEMAPCOMBINER', $database, array('BIBLE','INDEX','CHAPTER','VERSE'), FALSE );
	}
	/* combine - built to combine verse backwards to earlier verse in same chapter */
	/* extended to combine verses forward to future verse even beyond chapter, but always in same book!  flagged if COMBINE is negative, so then also use abs() for count */
	static $combine = NULL;
	static $combine_text = NULL;
	// combine to this verse
	if (!empty($database[T_VERSEMAPCOMBINER][$bible.'-'.$index.'-'.$chapter.'-'.$verse])) {
		if (!empty($combine)) {
			AION_ECHO("ERROR! COMBINER TOTAL NOT REACHED!: $bible $index!=".$combine['INDEX']." ".$combine['BOOK']." $chapter!=".$combine['CHAPTER']." $verse!=".$combine['VERSE']." ".$combine['TOTAL']." ".$combine['COMBINE']."\n".print_r($combine,TRUE));
		}
		$combine = $database[T_VERSEMAPCOMBINER][$bible.'-'.$index.'-'.$chapter.'-'.$verse];
		if ($combine['CHAPTER']>151 || $combine['VERSE']>176 || $combine['COMBINE']==0) {
			AION_ECHO("ERROR! COMBINER BAD CONFIG!: $bible $index!=".$combine['INDEX']." ".$combine['BOOK']." $chapter!=".$combine['CHAPTER']." $verse!=".$combine['VERSE']." ".$combine['TOTAL']." ".$combine['COMBINE']."\n".print_r($combine,TRUE));
		}
		$combine_text = NULL;
		$combine_text[] = trim($text);
		return FALSE;
	}
	// combine more to previous verse OR future verse
	else if (!empty($combine_text) && count($combine_text) < abs($combine['COMBINE'])) {
		if ($bible!=$combine['BIBLE'] || $index!=$combine['INDEX'] || ($combine['COMBINE']>0 && ($chapter!=$combine['CHAPTER'] || (int)$verse<=(int)$combine['VERSE']))) { AION_ECHO("ERROR! COMBINER PROB-1: $bible	$book	$chap	$vers	$text\n".print_r($combine,TRUE)); }
		$combine_text[] = trim($text);
		return FALSE;
	}
	// combine and commit
	else if (!empty($combine_text) && count($combine_text) == abs($combine['COMBINE'])) {
		if ($bible!=$combine['BIBLE'] || $index!=$combine['INDEX'] || ($combine['COMBINE']>0 && ($chapter!=$combine['CHAPTER'] || (int)$verse<=(int)$combine['VERSE']))) { AION_ECHO("ERROR! COMBINER PROB-2: $bible	$book	$chap	$vers	$text\n".print_r($combine,TRUE)); }
		if ($combine['COMBINE']>0) { // combine backwards, original
			$verse = $combine['VERSE'];
			foreach(array_keys($combine_text, "XCOMBINE", TRUE) as $key) { unset($combine_text[$key]); }
			$text = implode(' ',$combine_text)." ".trim($text);
			$combine_text = NULL;
			if ((int)$verse >  (int)$combine['TOTAL']) { AION_ECHO("ERROR! COMBINER PROB-3: $bible	$book	$chap	$vers	$text\n".print_r($combine,TRUE)); }
			if ((int)$verse == (int)$combine['TOTAL']) { $combine = NULL; }
		}
		else {
			if ((int)$verse != (int)$combine['TOTAL']) { AION_ECHO("ERROR! COMBINER MISSED FORWARD TARGET VERSE#: $bible	$book	$chap	$vers	$text\n".print_r($combine,TRUE)); }
			foreach(array_keys($combine_text, "XCOMBINE", TRUE) as $key) { unset($combine_text[$key]); }
			$text = implode(' ',$combine_text)." ".trim($text);
			$combine_text = NULL;
			$combine = NULL;
		}
		return TRUE;
	}
	// error
	else if (!empty($combine_text)) { AION_ECHO("ERROR! COMBINER PROB-4: $bible	$book	$chap	$vers	$text\n".print_r($combine,TRUE)); }
	// continue reversification
	else if (!empty($combine)) {
		// error - no combine forward past this point!
		if ($combine['COMBINE']<1) { AION_ECHO("ERROR! COMBINER WHA? NO FORWARD PAST THIS POINT: $bible	$book	$chap	$vers	$text\n".print_r($combine,TRUE)); }
		if ($bible!=$combine['BIBLE'] || $index!=$combine['INDEX'] || $chapter!=$combine['CHAPTER'] || (int)$verse<=(int)$combine['VERSE']) {
			AION_ECHO("ERROR! COMBINER TOTAL NOT REACHED!: $bible $index!=".$combine['INDEX']." ".$combine['BOOK']." $chapter!=".$combine['CHAPTER']." $verse!=".$combine['VERSE']." ".$combine['TOTAL']." ".$combine['COMBINE']."\n".print_r($combine,TRUE));
			//$combine = NULL;
			//return TRUE;
		}
		$verse = sprintf('%03d', (int)$verse - $combine['COMBINE']);
		if ((int)$verse >  (int)$combine['TOTAL']) { AION_ECHO("ERROR! COMBINER PROB-6: $bible	$book	$chap	$vers	$text\n".print_r($combine,TRUE)); }
		if ((int)$verse == (int)$combine['TOTAL']) { $combine = NULL; }
		return TRUE;
	}
	// nothing to do
	return TRUE;
}



/*** aion source unicode glyph report ***/
function AION_LOOP_CONV_DOIT_GLYF($bible, $book, $chap, $vers, $text, $uniusage) {
	static $bible_current = NULL;
	static $bible_stats = NULL;
	static $unicode_planes = NULL;
	static $output = NULL;
	// get unicode map
	if (!$unicode_planes) {
		$unicode_planes = array();
		AION_FILE_DATA_GET( './aion_database/UNICODE_PLANES.txt', 'T_UNICODE_PLANES', $unicode_planes, FALSE, FALSE );
	}
	// output
	if (!$output) {
		if (!($output=fopen($uniusage,'w+'))) {  AION_ECHO("ERROR! Glyph fopen(): $bible	$book	$chap	$vers	$text"); }
		if (!fwrite($output,"BIBLE\tDECIMAL\tUCHAR\tHEX\tPLANE\tCOUNT\tBOOK\tCHAPTER\tVERSE\tTEXT\r\n")) { AION_ECHO("ERROR! Glyph fwrite() header: $bible	$book	$chap	$vers	$text"); }
	}
	// reset
	if ($bible_current != $bible) {
		// print previous
		if ($bible_current) {
			foreach($bible_stats as $key => $stat) {
				if (!fwrite($output,"$bible_current\t$key\t".$stat['CHAR']."\t".dechex($key)."\t".$stat['MAP']."\t".$stat['COUNT']."\t".$stat['BOOK']."\t".$stat['CHAP']."\t".$stat['VERS']."\t".$stat['TEXT']."\r\n")) {
					AION_ECHO("ERROR! Glyph fopen(): $bible_current	$bible	$book	$chap	$vers	$text");
				}
			}
		}
		// initialize next
		$bible_current = $bible;
		AION_unset($bible_stats); $bible_stats=NULL; unset($bible_stats);
		$bible_stats = array();
	}
	// loop unicode text
	$pointer = 0;
	while(($uchar = aion_utf8_next($text, $pointer)) !== false) {
		if (FALSE===($value=aion_utf8_ord($uchar))) { AION_ECHO("ERROR! Glyph aion_utf8_ord($uchar): $bible	$book	$chap	$vers	$text"); }
		if ($value > 1114111) { AION_ECHO("ERROR! Glyph($value) > 1114111: $bible	$book	$chap	$vers	$text"); }
		$bible_stats[$value]['COUNT'] = (empty($bible_stats[$value]['COUNT']) ? 1 : $bible_stats[$value]['COUNT']+1);
		if (empty($bible_stats[$value]['MAP'])) {
			foreach($unicode_planes['T_UNICODE_PLANES'] as $plane) {
				if ($value >= (int)$plane['STARTDEC'] && $value <= (int)$plane['ENDDEC']) {
					$bible_stats[$value]['CHAR'] = $uchar;
					$bible_stats[$value]['MAP']  = $plane['BLOCK'];
					$bible_stats[$value]['BOOK'] = $book;
					$bible_stats[$value]['CHAP'] = $chap;
					$bible_stats[$value]['VERS'] = $vers;
					$bible_stats[$value]['TEXT'] = $text;
					break;
				}
			}
			if (empty($bible_stats[$value]['MAP'])) { AION_ECHO("ERROR! Glyph map not found for $value: $bible	$book	$chap	$vers	$text"); }
		}
	}
}
function aion_utf8_next($string, &$pointer){
    if(!isset($string[$pointer])) return false;
    $char = ord($string[$pointer]);
    if($char < 128){
        return $string[$pointer++];
    }else{
        if($char < 224){
            $bytes = 2;
        }elseif($char < 240){
            $bytes = 3;
        }elseif($char < 248){
            $bytes = 4;
        }elseif($char == 252){
            $bytes = 5;
        }else{
            $bytes = 6;
        }
        $str =  substr($string, $pointer, $bytes);
        $pointer += $bytes;
        return $str;
    }
}
function aion_utf8_ord ($chr)
{
    $bytes = array_values(unpack('C*', $chr));

    switch (count($bytes)) {
        case 1:
            return $bytes[0] < 0x80
                ? $bytes[0]
                : false;
        case 2:
            return ($bytes[0] & 0xE0) === 0xC0 && ($bytes[1] & 0xC0) === 0x80
                ? (($bytes[0] & 0x1F) << 6) | ($bytes[1] & 0x3F)
                : false;
        case 3:
            return ($bytes[0] & 0xF0) === 0xE0 && ($bytes[1] & 0xC0) === 0x80 && ($bytes[2] & 0xC0) === 0x80 
                ? (($bytes[0] & 0x0F) << 12) | (($bytes[1] & 0x3F) << 6) | ($bytes[2] & 0x3F)
                : false;
        case 4:
            return ($bytes[0] & 0xF8) === 0xF0 && ($bytes[1] & 0xC0) === 0x80 && ($bytes[2] & 0xC0) === 0x80 && ($bytes[3] & 0xC0) === 0x80
                ? (($bytes[0] & 0x07) << 18) | (($bytes[1] & 0x3F) << 12) | (($bytes[2] & 0x3F) << 6) | ($bytes[3] & 0x3F)
                : false;
    }

    return false;
}

function aion_utf8_chr ($ord)
{
    switch (true) {
        case $ord < 0x80:
            return pack('C*', $ord & 0x7F);
        case $ord < 0x0800:
            return pack('C*', (($ord & 0x07C0) >> 6) | 0xC0, ($ord & 0x3F) | 0x80);
        case $ord < 0x010000:
            return pack('C*', (($ord & 0xF000) >> 12) | 0xE0, (($ord & 0x0FC0) >> 6) | 0x80, ($ord & 0x3F) | 0x80);
        case $ord < 0x110000:
            return pack('C*', (($ord & 0x1C0000) >> 18) | 0xF0, (($ord & 0x03F000) >> 12) | 0x80, (($ord & 0x0FC0) >> 6) | 0x80, ($ord & 0x3F) | 0x80);
    }

    return false;
}




/*** aion untranslate loop ***/
function AION_LOOP_AION($source, $destiny, $destiny_json) {
	$database = array();
	AION_FILE_DATA_GET( './aion_database/UNTRANSLATEMODULE.txt', 'T_UNTRANSLATEMODULE', $database, FALSE, FALSE );
	AION_FILE_DATA_GET( './aion_database/BOOKS.txt', 'T_BOOKS', $database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET(	'./aion_database/VERSIONS.txt',	'T_VERSIONS', $database, 'BIBLE', FALSE );
	AION_LOOP( array(
		'function'	=> 'AION_LOOP_AION_DOIT',
		'source'	=> $source,
		'include'	=> "/---Standard-Edition\.noia$/",
		//'include'	=> "/^Holy-Bible---Chinese---Easy-to-Read---Standard-Edition\.noia$/",
		'database'	=> $database,
		'destiny'	=> $destiny,
		'destiny_json'	=> $destiny_json,
		'book'		=> AION_BIBLES_LIST(),
		) );
	AION_unset($database); $database=NULL; unset($database);
}
function AION_LOOP_AION_DOIT($args) {
	$output = $args['destiny'].'/'.str_replace('---Standard-Edition.noia','---Aionian-Edition.noia',$args['filename']);
	$json = $args['destiny_json'].'/'.str_replace('---Standard-Edition.noia','---Aionian-Verses.json',$args['filename']);
	if (!preg_match("/\/(Holy-Bible---.*)---Standard-Edition\.noia/", $args['filepath'], $matches)) { AION_ECHO("ERROR! Failed to preg_match(Holy-Bible): ".$args['filepath']); }
	$bible = $matches[1];
	$aionian_verses = array();
	$aionian_verses['QUESTIONED'] = array();
	$database = array();
	AION_FILE_DATA_GET( $args['filepath'], 'T_BIBLE', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	$changes = 0;
	foreach($args['database']['T_UNTRANSLATEMODULE'] as $untranslated) {
		if ($untranslated['BIBLE']!=$bible) { continue; }
		$vref = $untranslated['INDEX'].'-'.$untranslated['BOOK'].'-'.$untranslated['CHAPTER'].'-'.$untranslated['VERSE'];
		//if ($untranslated['UNTRANSLATE']=='SKIP' || $untranslated['UNTRANSLATE']=='SWAP') { continue; } dunno why SWAP is skipped!!!!
		if ($untranslated['UNTRANSLATE']=='SKIP') { continue; }
		if (empty($database['T_BIBLE'][$vref]) && stripos($untranslated['WARN'],'VERSE_')!==FALSE && $untranslated['TEXT']=='NULL') { continue; }
		if (empty($database['T_BIBLE'][$vref]) || stripos($untranslated['WARN'],'VERSE_')!==FALSE || $untranslated['TEXT']=='NULL') { AION_ECHO("ERROR! Utterly impossible situation, might need to remove UNTRANSLATE entries: $vref ".$args['filepath']); }
		$database['T_BIBLE'][$vref]['TEXT'] = $untranslated['TEXT'];
		/* untranslated json + hyper links */
		$count_q = $count_g = 0;
		if (!($untranslated['TEXT'] = preg_replace('/\(questioned\)/ui', "(<span class=word-footnote><a href='/Glossary' title='Aionian Glossary' onclick='return AionianBible_Makemark(\"/Glossary\");'>questioned</a></span>)", $untranslated['TEXT'],-1,$count_q))) {
			AION_ECHO("ERROR! AION_LOOP_ONLINE_DOIT preg_replace(gXXX)");
		}
		if (!($untranslated['TEXT'] = preg_replace('/([gGhH]{1}[[:digit:]]+)/ui', "<span class=word-footnote><a href='/Glossary#".'$1'."' title='Aionian Glossary' onclick='return AionianBible_Makemark(\"/Glossary\",\"#".'$1'."\");'>".'$1'."</a></span>", $untranslated['TEXT'],-1,$count_g))) {
			AION_ECHO("ERROR! AION_LOOP_ONLINE_DOIT preg_replace(gXXX)");
		}
		if (!($untranslated['TEXT'] = preg_replace('/(aiōnios|aiōn|aïdios|Sheol|Geenna|Hadēs|Abyssos|Tartaroō|Limnē Pyr)/ui', '<span class=notranslate>$1</span>', $untranslated['TEXT']))) {
			AION_ECHO("ERROR! AION_LOOP_ONLINE_DOIT span insert failure");
		}
		// highlight my notes!
		if (!($untranslated['TEXT'] = preg_replace('/(\(note:[^()]+\))/ui', '<span class=word-aionian>$1</span>', $untranslated['TEXT']))) {
			AION_ECHO("ERROR! AION_LOOP_ONLINE_DOIT span insert failure");
		}
		if ($count_q || $count_g) {
			$count_q = ($count_q ? 'word-questioned' : '');
			$count_g = ($count_g ? 'word-aionian' : '');
			$untranslated['TEXT'] = "<span class='$count_q $count_g'>".$untranslated['TEXT']."</span>";
		}
		$verse = array();
		$verse['INDEX']		= $untranslated['INDEX'];
		$verse['BOOK']		= $untranslated['BOOK'];
		$verse['CHAPTER']	= $untranslated['CHAPTER'];
		$verse['VERSE']		= $untranslated['VERSE'];
		$verse['TEXT']		= $untranslated['TEXT'];
		if ($count_q) {		$aionian_verses['QUESTIONED'][$untranslated['INDEX'].'-'.$untranslated['CHAPTER'].'-'.$untranslated['VERSE']] = $verse; }
		if ($count_g) {		$aionian_verses[$untranslated['INDEX'].'-'.$untranslated['CHAPTER'].'-'.$untranslated['VERSE']] = $verse; }
		if ($count_g && empty($aionian_verses[$args['book'][$untranslated['BOOK']].' '.(int)$untranslated['CHAPTER']])) { $aionian_verses[$args['book'][$untranslated['BOOK']].' '.(int)$untranslated['CHAPTER']] = TRUE; }
		++$changes;
		AION_unset($verse); $verse=NULL; unset($verse);
	}
	$database['T_BIBLE'] = AION_BIBLES_INSERT_BOOKS($database['T_BIBLE'],$args['database']['T_BOOKS']['ENGLISH'],$args['database']['T_BOOKS'][$bible],$args['database']['T_BOOKS']['CODE']);
	AION_FILE_DATA_PUT($output,$database['T_BIBLE'],AION_BIBLES_COMMENT_MORE($args['database']['T_VERSIONS'][$bible],'Aionian',$args['source']."/$bible"));
	if ( file_put_contents($json,json_encode($aionian_verses, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)) === FALSE ) { AION_ECHO("ERROR! AIONIAN_VERSES file_put_contents ".$json ); }
	AION_unset($database); $database=NULL; unset($database);
	AION_unset($aionian_verses); $aionian_verses=NULL; unset($aionian_verses);
	AION_ECHO('UNTRANSLATED '.$args['filepath'].' to '.$output.' with changes='.$changes);
}




/*** aion loop online ***/
function AION_LOOP_NOIA($source, $destiny) {
	$database = array();
	AION_FILE_DATA_GET( './aion_database/BOOKS.txt', 'T_BOOKS', $database, 'BIBLE', FALSE );
	AION_LOOP( array(
		'function'	=> 'AION_LOOP_NOIA_DOIT',
		'source'	=> $source,
		'include'	=> "/---Aionian-Edition\.noia$/",
		'destiny'	=> $destiny,
		'database'	=> $database,
		) );
}
function AION_LOOP_NOIA_DOIT($args) {
	$destiny = $args['destiny'].'/online/'.str_replace('.noia','',$args['filename']);
	system('rm -rf '.$destiny);
	if (is_dir($destiny)) { AION_ECHO("ERROR! existing isdir=".$destiny); }
	if (!mkdir($destiny)) {	AION_ECHO("ERROR! mkdir()"); }
	$database = array();
	AION_FILE_DATA_GET( $args['filepath'], 'T_BIBLE', $database, FALSE, FALSE );
	$current_book = $previous_verse = NULL;
	$json_chapter = array();
	foreach($database['T_BIBLE'] as $verse) {
		// create empty chapter if missing
		$chap_now = (int)$verse['CHAPTER'];
		$chap_pre = empty($previous_verse['CHAPTER']) ? 0 : (int)$previous_verse['CHAPTER'];
		while(	(!$previous_verse && --$chap_now>0) ||
				($previous_verse && $verse['BOOK']!=$previous_verse['BOOK'] && --$chap_now>0) ||
				($previous_verse && $verse['BOOK']==$previous_verse['BOOK'] && --$chap_now>$chap_pre)) {
			$miss_file = $destiny.'/'.$verse['INDEX'].'-'.$verse['BOOK'].'-'.sprintf('%03d',$chap_now).'.json';
			$miss_chapter = array(1 => "This chapter is missing in the source text.");
			if (file_put_contents($miss_file,json_encode($miss_chapter, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)) === FALSE ) { AION_ECHO("ERROR! AION_LOOP_ONLINE_DOIT file_put_contents MISS CHAP".$json); }
			AION_ECHO("CHAPTER STUBBY! $$destiny/$miss_file");
		}
		while($previous_verse && $verse['BOOK']!=$previous_verse['BOOK'] && ++$chap_pre<=$args['database']['T_BOOKS']['CHAPTERS'][array_search($previous_verse['BOOK'],$args['database']['T_BOOKS']['CODE'])]) {
			$miss_file = $destiny.'/'.$previous_verse['INDEX'].'-'.$previous_verse['BOOK'].'-'.sprintf('%03d',$chap_pre).'.json';
			$miss_chapter = array(1 => "This chapter is missing in the source text.");
			if (file_put_contents($miss_file,json_encode($miss_chapter, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)) === FALSE ) { AION_ECHO("ERROR! AION_LOOP_ONLINE_DOIT file_put_contents MISS CHAP".$json); }
			AION_ECHO("CHAPTER STUBBY! $$destiny/$miss_file");
		}
		
		// okay create real chapter
		if ($verse['BOOK'] != $current_book ||
			$verse['CHAPTER'] != $current_chapter) {
			if ($current_book != NULL) {
				if (file_put_contents($json_file,json_encode($json_chapter, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)) === FALSE ) {
					AION_ECHO("ERROR! AION_LOOP_ONLINE_DOIT file_put_contents ".$json );
				}
			}
			AION_unset($json_chapter); $json_chapter=NULL; unset($json_chapter);
			$json_chapter = array();
			$json_file = $destiny.'/'.$verse['INDEX'].'-'.$verse['BOOK'].'-'.$verse['CHAPTER'].'.json';
			$current_book = $verse['BOOK'];
			$current_chapter = $verse['CHAPTER'];
		}
		$count_q = $count_g = 0;
		if (!($verse['TEXT'] = preg_replace('/\(questioned\)/ui', "(<span class=word-footnote><a href='/Glossary' title='Aionian Glossary' onclick='return AionianBible_Makemark(\"/Glossary\");'>questioned</a></span>)", $verse['TEXT'],-1,$count_q))) {
			AION_ECHO("ERROR! NOIA_LOOP_ONLINE_DOIT preg_replace(gXXX)");
		}
		if (!($verse['TEXT'] = preg_replace('/([gGhH]{1}[[:digit:]]+)/ui', "<span class=word-footnote><a href='/Glossary#".'$1'."' title='Aionian Glossary' onclick='return AionianBible_Makemark(\"/Glossary\",\"#".'$1'."\");'>".'$1'."</a></span>", $verse['TEXT'],-1,$count_g))) {
			AION_ECHO("ERROR! NOIA_LOOP_ONLINE_DOIT preg_replace(gXXX)");
		}
		if (!($verse['TEXT'] = preg_replace('/(aiōnios|aiōn|aïdios|Sheol|Geenna|Hadēs|Abyssos|Tartaroō|Limnē Pyr)/ui', '<span class=notranslate>$1</span>', $verse['TEXT']))) {
			AION_ECHO("ERROR! NOIA_LOOP_ONLINE_DOIT span insert failure");
		}
		// highlight my notes!
		if (!($verse['TEXT'] = preg_replace('/(\(note:[^()]+\))/ui', '<span class=word-aionian>$1</span>', $verse['TEXT']))) {
			AION_ECHO("ERROR! NOIA_LOOP_ONLINE_DOIT span insert failure");
		}
		if ($count_q || $count_g) {
			$count_q = ($count_q ? 'word-questioned' : '');
			$count_g = ($count_g ? 'word-aionian' : '');
			$verse['TEXT'] = "<span class='$count_q $count_g'>".$verse['TEXT']."</span>";
		}
		$json_chapter[(int)$verse['VERSE']] = $verse['TEXT'];
		$previous_verse = $verse;	
	}
	if ($current_book != NULL) {
		if (file_put_contents($json_file,json_encode($json_chapter, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)) === FALSE ) { AION_ECHO("ERROR! AION_LOOP_ONLINE_DOIT file_put_contents ".$json ); }
	}
	// create empty chapter if missing
	$chap_pre = empty($previous_verse['CHAPTER']) ? 0 : (int)$previous_verse['CHAPTER'];
	while($previous_verse && ++$chap_pre<=$args['database']['T_BOOKS']['CHAPTERS'][array_search($previous_verse['BOOK'],$args['database']['T_BOOKS']['CODE'])]) {
		$miss_file = $destiny.'/'.$previous_verse['INDEX'].'-'.$previous_verse['BOOK'].'-'.sprintf('%03d',$chap_pre).'.json';
		$miss_chapter = array(1 => "This chapter is missing in the source text.");
		if (file_put_contents($miss_file,json_encode($miss_chapter, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)) === FALSE ) { AION_ECHO("ERROR! AION_LOOP_ONLINE_DOIT file_put_contents MISS CHAP".$json); }
		AION_ECHO("CHAPTER STUBBY! $$destiny/$miss_file");
	}
	AION_unset($database); $database=NULL; unset($database);
	AION_ECHO("SUCCESS ONLINE FORMAT! ".$destiny);
}



/*** aion all aionian verses / A GREAT IDEA FOR AIONIAN VERSES ONLY, BUT WANT TO NAVIGATE THROUGH ALL VERSES!!! ***/
function AION_LOOP_VALL($source, $destiny) {
	AION_ECHO("ERROR! AION_LOOP_VALL A GREAT IDEA FOR AIONIAN VERSES ONLY, BUT WANT TO NAVIGATE THROUGH ALL VERSES!!!");
	// init
	system("rm -rf $destiny/aionianverses");
	if (!mkdir("$destiny/aionianverses")) { AION_ECHO("ERROR! AION_LOOP_VALL mkdir($destiny/aionianverses)"); }
	$database = array();
	AION_FILE_DATA_GET( './aion_database/UNTRANSLATE.txt', 'T_UNTRANSLATE', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	AION_FILE_DATA_GET(	'./aion_database/VERSIONS.txt',	'T_VERSIONS', $database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/BOOKS.txt', 'T_BOOKS', $database, 'BIBLE', FALSE );
	// sort the bibles before writing the aionian verses
	function AION_FILE_DATABASE_PUT_SORT($a, $b) {
		if ($a['LANGUAGEENGLISH'] == $b['LANGUAGEENGLISH'] && $a['NAMEENGLISH'] == $b['NAMEENGLISH']) { return 0; }
		return ($a['LANGUAGEENGLISH'] < $b['LANGUAGEENGLISH'] || ($a['LANGUAGEENGLISH'] == $b['LANGUAGEENGLISH'] && $a['NAMEENGLISH'] < $b['NAMEENGLISH']) ? -1 : 1);
	}
	uasort($database['T_VERSIONS'], 'AION_FILE_DATABASE_PUT_SORT');	
	// loop aionian verses
	$countverses = 0;
	foreach($database['T_UNTRANSLATE'] as $verse) {
		$jsonread = $verse['INDEX']."-".$verse['BOOK']."-".$verse['CHAPTER'].".json";
		$aionianverses = array();
		// loop bibles
		$countbibles = 0;
		foreach($database['T_VERSIONS'] as $bible) {
			// get the verse or else!
			$biblename = $bible['BIBLE'];
			$jsonreadfull = "$source/online/$biblename---Aionian-Edition/$jsonread";
			if (!file_exists($jsonreadfull) || !is_array(($chapter = json_decode(file_get_contents($jsonreadfull),true)))) {
				if ($database['T_BOOKS'][$biblename][array_search($verse['BOOK'],$database['T_BOOKS']['CODE'])]!='NULL') {
					AION_ECHO("ERROR! AION_LOOP_VALL bible book chapter missing $jsonreadfull");
				}
				continue;
			}
			if (empty($chapter[(int)$verse['VERSE']])) {
				AION_ECHO("WARNING! AION_LOOP_VALL bible book chapter verse missing $jsonreadfull verse=".$verse['VERSE']);
			}
			// store the verse
			$aionianverse = array();
			$aionianverse['BIBLE'] = $biblename;
			$aionianverse['NAMEENGLISH'] = $bible['NAMEENGLISH'];
			$aionianverse['NAME'] = $bible['NAME'];
			$aionianverse['LANGUAGEENGLISH'] = $bible['LANGUAGEENGLISH'];
			$aionianverse['LANGUAGE'] = $bible['LANGUAGE'];
			$aionianverse['LANGUAGECODEISO'] = $bible['LANGUAGECODEISO'];
			$aionianverse['LANGUAGECSS'] = $bible['LANGUAGECSS'];
			$aionianverse['RTL'] = $bible['RTL'];
			$aionianverse['TEXT'] = (empty($chapter[(int)$verse['VERSE']]) ? "" : $chapter[(int)$verse['VERSE']]);
			$aionianverses[] = $aionianverse;
			++$countbibles;
		}
		// write the file
		$jsonwrite = "$destiny/aionianverses/".$verse['INDEX']."-".$verse['BOOK']."-".$verse['CHAPTER']."-".$verse['VERSE'].".json";
		if ( file_put_contents($jsonwrite,json_encode($aionianverses, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)) === FALSE ) { AION_ECHO("ERROR! AION_LOOP_VALL file_put_contents $jsonwrite"); }
		AION_ECHO("AIONIAN VERSE FORMATTED! $countbibles bibles in $jsonwrite");
		++$countverses;
	}
	AION_ECHO("SUCCESS ALL AIONIAN VERSE FORMATTED! $countverses at $destiny/aionianverses");
}




/*** aion loop html ***/
function AION_LOOP_HTMS($source, $destiny, $destiny2) {
	$database = array();
	AION_FILE_DATA_GET(	'./aion_database/FORPRINT.txt',	'T_FORPRINT', $database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET(	'./aion_database/VERSIONS.txt',	'T_VERSIONS', $database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/BOOKS.txt', 'T_BOOKS', $database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/BOOKSCOUNT.txt', 'T_BOOKSCOUNT', $database, 'BOOK', FALSE );
	AION_FILE_DATA_GET( './aion_database/BOOKSSTANDARD.noia', 'T_BOOKSSTANDARD', $database, array('BOOK','CHAPTER','VERSE'), FALSE );
	AION_FILE_DATA_GET( '../www-stageresources/Holy-Bible---English---New-Heart-Standard---Aionian-Edition.noia', 'T_ABCOMPAREBIBLE', $database, array('BOOK','CHAPTER','VERSE'), FALSE );
	AION_FILE_DATA_GET( './aion_database/VERSEMAP.txt', 'T_VERSEMAP', $database, FALSE, FALSE );
	AION_FILE_DATA_GET( './aion_database/VERSEMAPCOMBINER.txt', 'T_VERSEMAPCOMBINER', $database, FALSE, FALSE );
	AION_FILE_DATA_GET( '../checks/RAWCHECK.txt', 'T_RAWCHECK', $database, array('BIBLE','BOOK','CHAPTER','VERSE'), FALSE );
	AION_FILE_DATA_GET( '../checks/BOOKSCHAPTERS.txt', 'T_BOOKSCHAPTERS', $database, array('BIBLE','BOOK','CHAPTER','VERSE'), FALSE );	
	AION_FILE_DATA_GET( './aion_database/UNTRANSLATECUSTOM.txt', 'T_UNTRANSLATECUSTOM', $database, array('BIBLE','BOOK','CHAPTER','VERSE'), FALSE );
	
	$debug = "<!DOCTYPE html><html lang='en'>\n<head>\n<meta charset='utf-8'>\n<title>AionianBible.org Proof Reader</title>\n";
	$debug .= "<style>\n";
	$debug .= "table { border-collapse: collapse; }\n";
	$debug .= "table td { border: 0px solid gray; padding: 12px 3px; }\n";
	$debug .= "</style>\n";
	$debug .= "</head>\n<body style='margin:20px;padding:0'>\n<h2>AionianBible.org Proofer Reader</h2>\n";
	$debug .= "<a href='/library/Holy-Bible---AAA---Versions---eBible.htm' target='_blank'>eBible public domain and CC Bibles</a><br />\n";
	$debug .= "<a href='/library/Holy-Bible---AAA---Versions---eBible-source.txt' target='_blank'>eBible public domain and CC Bibles source template</a><br />\n";
	$debug .= "<a href='/library/Holy-Bible---AAA---Versions---Questioned.htm' target='_blank'>Questioned Verses</a><br />\n";
	$debug .= "<a href='/library/Holy-Bible---AAA---Versions---LongLine.htm' target='_blank'>Long Verses, Source Edition</a><br />\n";
	$debug .= "<a href='/library/Holy-Bible---AAA---Versions---LongLine-STD.htm' target='_blank'>Long Verses, Aionian Edition</a><br />\n";
	$debug .= "<a href='/library/stepbible/CHECK_HTML_HEBREW_TBESH.htm' target='_blank'>STEPBible Hebrew TBESH Lexicon Errors</a><br />\n";
	$debug .= "<a href='/library/stepbible/CHECK_HTML_HEBREW_TAHOT.htm' target='_blank'>STEPBible Hebrew TAHOT Line Errors</a><br />\n";
	$debug .= "<a href='/library/stepbible/CHECK_HTML_GREEK_TBESG.htm' target='_blank'>STEPBible Greek TBESG Lexicon Errors</a><br />\n";
	$debug .= "<a href='/library/stepbible/CHECK_HTML_GREEK_TFLSJ.htm' target='_blank'>STEPBible Greek TFLSJ Lexicon Errors</a><br />\n";
	$debug .= "<a href='/library/stepbible/CHECK_HTML_GREEK_TAGNT.htm' target='_blank'>STEPBible Greek TAGNT Line Errors</a><br />\n";
	$debug .= "<a href='/Please' target='_blank'>Foreign Phrases at AionianBible.org/Please</a><br />\n";
	$debug .= "<a href='/RTL' target='_blank'>Right-to-Left and Hindic proofing at AionianBible.org/RTL</a><br />\n";
	$debug .= "<a href='/Promote' target='_blank'>Promote at AionianBible.org/Promote</a><br />\n";
	$debug .= "<a href='/index-rates.php' target='_blank'>Caculate KDP currency exchange rates</a><br />\n";
	$debug .= "<br />\n";
	$debug .= "<table>";
	$debug .="<tr><td>BIBLE</td><td>P</td><td>S</td><td>NOT</td><td>B#</td><td>LAN</td><td>OLD</td><td>NEW</td><td>CHP</td><td>VER</td><td>AIO</td><td>QUE</td><td>LON</td><td>CMI</td><td>VMI</td><td>VXT</td><td>VFI</td><td>NOF</td><td>CMA</td><td>VMI</td><td>VME</td><td>CUS</td><td>PAG</td><td>PAN</td><td>PRI</td><td>KDP</td><td>KNT</td><td>LUL</td><td>LNT</td><td>LHC</td><td>WAT</td><td>STA</td></tr>\n";
	$foreign = "<!DOCTYPE html><html lang='en'>\n<head>\n<meta charset='utf-8'>\n<title>Aionian Bible Foreign Language Proof Reader</title>\n";
	$foreign .= "<style>\n";
	$foreign .= "table.aionborder { border-collapse: collapse; }\n";
	$foreign .= "table.aionborder td { border: 1px solid gray; padding: 7px; }\n";
	$foreign .= "</style>\n";
	$foreign .= "</head><body style='margin:20px;padding:0'><span id='top'></span>\n";
	$foreign .= "<h2>AionianBible.org Foreign Language Proof Reader</h2>\n";
	$foreign .= "Please help make public domain Bibles available in 74 world languages.<br />\n";
	$foreign .= "Do you or a friend know any of the foreign languages listed below?  We need your help!<br />\n";
	$foreign .= "Please help translate or confirm 14 words and phrases used as page headings.<br />\n";
	$foreign .= "<a href='/'>AionianBible.org</a> is sponsored by <a href='https://nainoia-inc.signedon.net' target='_blank'>Nainoia Inc</a>.<br />\n";
	$foreign .= "<b>** Click on the language link below to see 14 words for translation.</b><br />\n";
	$foreign .= "<br />\n";
	$last="";
	$count_google = $count_trans = $count_total = 0;
	foreach($database['T_VERSIONS'] as $bible) {
		if ($last == $bible['LANGUAGEENGLISH']) { continue; }
		$last = $bible['LANGUAGEENGLISH'];
		++$count_total;
		if ($database['T_FORPRINT'][$bible['BIBLE']]['STATUS']=='GOOD') { continue; }
		if (stripos($database['T_FORPRINT'][$bible['BIBLE']]['STATUS'],'Confirm')!==FALSE) { ++$count_google; }
		else { ++$count_trans; }
		$status = (stripos($database['T_FORPRINT'][$bible['BIBLE']]['STATUS'],'Confirm')!==FALSE ? "*" : "");
		$foreign .= "<a href='#".str_replace(array(' ',','),"-",$bible['LANGUAGEENGLISH'])."'>".$bible['LANGUAGEENGLISH']." / ".$bible['LANGUAGE']."</a> $status<br />\n";
	}
	$count_done = $count_total - ($count_google + $count_trans);
	$foreign .= "<br />There are $count_total languages with $count_done completed, $count_trans to translate, and $count_google to review.<br /><br /><br /><br /><br />\n";
	$foreign .= "<P style='page-break-before: always'>\n\n";
	$grandtotal = array('BIBLE_COUNT'=>0,'LANG_COUNT'=>0,'BOOK_OT'=>0,'BOOK_NT'=>0,'CHAP_TOTAL'=>0,'VERS_TOTAL'=>0,'VERS_AION'=>0,'VERS_QUES'=>0,'LONG'=>0,'CHAP_NO'=>0,'VERS_NO'=>0,'VERS_EX'=>0,'FIXED'=>0,'NOTFIXED'=>0,'CHAP_RE'=>0,'REVE_NO'=>0,'REVE_EX'=>0,'CUSTO'=>0,'PDFPA'=>0,'PDFPN'=>0,'PDFPI'=>(float)0,'PDF_PKDP'=>0,'PDF_PLUL'=>0,'PDF_PKNT'=>0,'PDF_PLNT'=>0,'PDF_PLHC'=>0,'PDF_PRTL'=>0,'TRANS'=>0,'PROBPDF'=>0);
	AION_LOOP( ($args=array(
		'function'	=> 'AION_LOOP_HTMS_DOIT',
		'source'	=> $source,
		'include'	=> "/---Aionian-Edition\.noia$/",
		'database'	=> $database,
		'destiny'	=> $destiny,
		'debug'		=> &$debug,
		'grandtotal'=> &$grandtotal,
		'foreign'	=> &$foreign,
		)));
	$grandmarker = array();
	$grandmarker['BIBLE_COUNT']	= $grandtotal['BIBLE_COUNT']-370;
	$grandmarker['LANG_COUNT']	= $grandtotal['LANG_COUNT']-154;
	$grandmarker['BOOK_OT']		= $grandtotal['BOOK_OT']-8183;
	$grandmarker['BOOK_NT']		= $grandtotal['BOOK_NT']-8973;
	$grandmarker['CHAP_TOTAL']	= $grandtotal['CHAP_TOTAL']-283151;
	$grandmarker['VERS_TOTAL']	= $grandtotal['VERS_TOTAL']-7528722;
	$grandmarker['VERS_AION']	= $grandtotal['VERS_AION']-80500;
	$grandmarker['VERS_QUES']	= $grandtotal['VERS_QUES']-458;
	$grandmarker['LONG']		= $grandtotal['LONG']-1153;
	$grandmarker['CHAP_NO']		= $grandtotal['CHAP_NO']-0;
	$grandmarker['VERS_NO']		= $grandtotal['VERS_NO']-2836;
	$grandmarker['VERS_EX']		= $grandtotal['VERS_EX']-910;
	$grandmarker['FIXED']		= $grandtotal['FIXED']-13524;
	$grandmarker['NOTFIXED']	= $grandtotal['NOTFIXED']-17824;
	$grandmarker['CHAP_RE']		= $grandtotal['CHAP_RE']-10328;
	$grandmarker['REVE_NO']		= $grandtotal['REVE_NO']-712;
	$grandmarker['REVE_EX']		= $grandtotal['REVE_EX']-715;
	$grandmarker['CUSTO']		= $grandtotal['CUSTO']-1339;
	$grandmarker['PDFPA']		= $grandtotal['PDFPA']-199004;
	$grandmarker['PDFPN']		= $grandtotal['PDFPN']-46956;
	$grandmarker['PDFPI']		= (float)$grandtotal['PDFPI']-4488.66;
	$grandmarker['PDF_PKDP']	= $grandtotal['PDF_PKDP']-148;
	$grandmarker['PDF_PKNT']	= $grandtotal['PDF_PKNT']-83;
	$grandmarker['PDF_PLUL']	= $grandtotal['PDF_PLUL']-359;
	$grandmarker['PDF_PLNT']	= $grandtotal['PDF_PLNT']-174;
	$grandmarker['PDF_PLHC']	= $grandtotal['PDF_PLHC']-208;
	$grandmarker['PDF_PRTL']	= $grandtotal['PDF_PRTL']-232;
	$grandmarker['TRANS']		= $grandtotal['TRANS']-309;
	$grandtotal['LONG']		= ($grandtotal['LONG']		== 0 ? $grandtotal['LONG']		: "<span style='font-weight:bold; color:red;'>".$grandtotal['LONG']."</span>" );
	$grandtotal['CHAP_NO']	= ($grandtotal['CHAP_NO']	== 0 ? $grandtotal['CHAP_NO']	: "<span style='font-weight:bold; color:red;'>".$grandtotal['CHAP_NO']."</span>" );
	$grandtotal['VERS_NO']	= ($grandtotal['VERS_NO']	== 0 ? $grandtotal['VERS_NO']	: "<span style='font-weight:bold; color:red;'>".$grandtotal['VERS_NO']."</span>" );
	$grandtotal['VERS_EX']	= ($grandtotal['VERS_EX']	== 0 ? $grandtotal['VERS_EX']	: "<span style='font-weight:bold; color:red;'>".$grandtotal['VERS_EX']."</span>" );
	$grandtotal['NOTFIXED']	= ($grandtotal['NOTFIXED']	== 0 ? $grandtotal['NOTFIXED']	: "<span style='font-weight:bold; color:red;'>".$grandtotal['NOTFIXED']."</span>" );
	$grandtotal['REVE_NO']	= ($grandtotal['REVE_NO']	== 0 ? $grandtotal['REVE_NO']	: "<span style='font-weight:bold; color:red;'>".$grandtotal['REVE_NO']."</span>" );
	$grandtotal['REVE_EX']	= ($grandtotal['REVE_EX']	== 0 ? $grandtotal['REVE_EX']	: "<span style='font-weight:bold; color:red;'>".$grandtotal['REVE_EX']."</span>" );
	$grandtotal['TRANS']	= ($grandtotal['TRANS']		== 0 ? $grandtotal['TRANS']		: "<span style='font-weight:bold; color:red;'>".$grandtotal['TRANS']."</span>" );
	$debug .= "<tr></tr>\n";
	$debug .="<tr><td>GRAND TOTAL</td><td></td><td></td><td></td>";
	$debug .= "<td>".$grandtotal['BIBLE_COUNT']."</td>";
	$debug .= "<td>".$grandtotal['LANG_COUNT']."</td>";
	$debug .= "<td>".$grandtotal['BOOK_OT']."</td>";
	$debug .= "<td>".$grandtotal['BOOK_NT']."</td>";
	$debug .= "<td>".$grandtotal['CHAP_TOTAL']."</td>";
	$debug .= "<td>".$grandtotal['VERS_TOTAL']."</td>";
	$debug .= "<td>".$grandtotal['VERS_AION']."</td>";
	$debug .= "<td>".$grandtotal['VERS_QUES']."</td>";
	$debug .= "<td>".$grandtotal['LONG']."</td>";
	$debug .= "<td>".$grandtotal['CHAP_NO']."</td>";
	$debug .= "<td>".$grandtotal['VERS_NO']."</td>";
	$debug .= "<td>".$grandtotal['VERS_EX']."</td>";
	$debug .= "<td>".$grandtotal['FIXED']."</td>";
	$debug .= "<td>".$grandtotal['NOTFIXED']."</td>";
	$debug .= "<td>".$grandtotal['CHAP_RE']."</td>";
	$debug .= "<td>".$grandtotal['REVE_NO']."</td>";
	$debug .= "<td>".$grandtotal['REVE_EX']."</td>";
	$debug .= "<td>".$grandtotal['CUSTO']."</td>";
	$debug .= "<td>".$grandtotal['PDFPA']."</td>";
	$debug .= "<td>".$grandtotal['PDFPN']."</td>";
	$debug .= "<td>".sprintf("%.2f",$grandtotal['PDFPI'])."</td>";
	$debug .= "<td>".$grandtotal['PDF_PKDP']."</td>";
	$debug .= "<td>".$grandtotal['PDF_PKNT']."</td>";
	$debug .= "<td>".$grandtotal['PDF_PLUL']."</td>";
	$debug .= "<td>".$grandtotal['PDF_PLNT']."</td>";
	$debug .= "<td>".$grandtotal['PDF_PLHC']."</td>";
	$debug .= "<td>".$grandtotal['PDF_PRTL']."</td>";
	$debug .= "<td>".$grandtotal['TRANS']."</td>";
	$debug .= "</tr>\n";
	$debug .="<tr><td>BIBLE</td><td>P</td><td>S</td><td>NOT</td><td>B#</td><td>LAN</td><td>OLD</td><td>NEW</td><td>CHP</td><td>VER</td><td>AIO</td><td>QUE</td><td>LON</td><td>CMI</td><td>VMI</td><td>VXT</td><td>VFI</td><td>NOF</td><td>CMA</td><td>VMI</td><td>VME</td><td>CUS</td><td>PAG</td><td>PAN</td><td>PRI</td><td>KDP</td><td>KNT</td><td>LUL</td><td>LNT</td><td>LHC</td><td>WAT</td><td>STA</td></tr>\n";
	$debug .="<tr><td>MARKER</td><td></td><td></td><td></td>";
	$debug .= "<td>".$grandmarker['BIBLE_COUNT']."</td>";
	$debug .= "<td>".$grandmarker['LANG_COUNT']."</td>";
	$debug .= "<td>".$grandmarker['BOOK_OT']."</td>";
	$debug .= "<td>".$grandmarker['BOOK_NT']."</td>";
	$debug .= "<td>".$grandmarker['CHAP_TOTAL']."</td>";
	$debug .= "<td>".$grandmarker['VERS_TOTAL']."</td>";
	$debug .= "<td>".$grandmarker['VERS_AION']."</td>";
	$debug .= "<td>".$grandmarker['VERS_QUES']."</td>";
	$debug .= "<td>".$grandmarker['LONG']."</td>";
	$debug .= "<td>".$grandmarker['CHAP_NO']."</td>";
	$debug .= "<td>".$grandmarker['VERS_NO']."</td>";
	$debug .= "<td>".$grandmarker['VERS_EX']."</td>";
	$debug .= "<td>".$grandmarker['FIXED']."</td>";
	$debug .= "<td>".$grandmarker['NOTFIXED']."</td>";
	$debug .= "<td>".$grandmarker['CHAP_RE']."</td>";
	$debug .= "<td>".$grandmarker['REVE_NO']."</td>";
	$debug .= "<td>".$grandmarker['REVE_EX']."</td>";
	$debug .= "<td>".$grandmarker['CUSTO']."</td>";
	$debug .= "<td>".$grandmarker['PDFPA']."</td>";
	$debug .= "<td>".$grandmarker['PDFPN']."</td>";
	$debug .= "<td>".sprintf("%.2f",$grandmarker['PDFPI'])."</td>";
	$debug .= "<td>".$grandmarker['PDF_PKDP']."</td>";
	$debug .= "<td>".$grandmarker['PDF_PKNT']."</td>";
	$debug .= "<td>".$grandmarker['PDF_PLUL']."</td>";
	$debug .= "<td>".$grandmarker['PDF_PLNT']."</td>";
	$debug .= "<td>".$grandmarker['PDF_PLHC']."</td>";
	$debug .= "<td>".$grandmarker['PDF_PRTL']."</td>";
	$debug .= "<td>".$grandmarker['TRANS']."</td>";
	$debug .= "</tr>\n";
	$debug .= "</table>\n";
	$debug .= "<br />\n";
	$debug .= "COLUMN LEGEND<br />\n";
	$debug .= "<span style='font-weight:bold; color:red;'>PROB: ".$args['grandtotal']['PROBPDF']." links and files missing or existing, search for ? or red Buy*</span><br />\n";
	$debug .= "BIBLE: Bible version name<br />\n";
	$debug .= "P: Proofer page<br />\n";
	$debug .= "S: Source link<br />\n";
	$debug .= "NOT: Special note<br />\n";
	$debug .= "B#: Bible number<br />\n";
	$debug .= "LAN: Language number<br />\n";
	$debug .= "OLD: Old Testament book count<br />\n";
	$debug .= "NEW: New Testament book count<br />\n";
	$debug .= "CHP: Chapter count<br />\n";
	$debug .= "VER: Verse count<br />\n";
	$debug .= "AIO: Aionian glossary annotated verse count<br />\n";
	$debug .= "QUE: Questioned verse count<br />\n";
	$debug .= "LON: Verses longer than 500 bytes OR if Aionian Bible 40 bytes longer than NHEB<br />\n";
	$debug .= "CMI: Missing chapters for Bible books included in version.<br />\n";
	$debug .= "VMI: Missing verses for Bible books included in version.<br />\n";
	$debug .= "VXT: Extra verses, outside of the English standard chapter verse counts.<br />\n";
	$debug .= "VFI: Verses touched by RAWFIX<br />\n";
	$debug .= "NOF: Problem verses listed in ../Checks/BOOKSCHAPTERS.txt<br />\n";
	$debug .= "CMA: Chapters remapped by ./aion_database/VERSEMAP.txt<br />\n";
	$debug .= "VMI: Missing verses in remapped chapters<br />\n";
	$debug .= "VME: Extra versse in remapped chapters<br />\n";
	$debug .= "CUS: Custom untranslation situations such as SKIP, ANNOTATE, and SWAP.<br />\n";
	$debug .= "PAG: PDF page total.<br />\n";
	$debug .= "PAN: PDF page total, New Testament.<br />\n";
	$debug .= "PRI: Amazon KDP price given page count = (($0.85 + (PAGES x $0.012))/0.6).<br />\n";
	$debug .= "KDP: Amazon KPD full Bible upload ( Add=Add-to-POD / Mod=Modify-existing-POD / A=POD-product-exists / F=POD-file-available )<br />\n";	
	$debug .= "KNT: Amazon KDP New Testament Bible upload<br />\n";	
	$debug .= "LUL: Lulu full Bible upload<br />\n";	
	$debug .= "LNT: Lulu New Testament Bible upload<br />\n";	
	$debug .= "LHC: Lulu hardcover Bible upload<br />\n";	
	$debug .= "WAT: No KDP language or non-commercial license<br />\n";
	$debug .= "STA: Status of the foreign heading translation effort.<br />\n";
	$debug .= "</body>\n</html>";
	$foreign .= "</body>\n</html>";
	if (!file_put_contents(($file="$destiny/Holy-Bible---AAA---Versions.htm"),$debug)) { AION_ECHO("ERROR! HTM Debug index file problem: $file"); }
	if (!file_put_contents(($file="$destiny/Holy-Bible---AAA---Versions---Foreign-Phrases.htm"),$foreign)) { AION_ECHO("ERROR! HTM Debug foreign file problem: $destiny/$file"); }
	if (!file_put_contents(($file="$destiny2/Holy-Bible---AAA---Versions---Foreign-Phrases.htm"),$foreign)) { AION_ECHO("ERROR! HTM Debug foreign file problem: $destiny2/$file"); }
}
function AION_LOOP_HTMS_DOIT($args) {
	// initialize
	if (!preg_match("/\/(Holy-Bible---.*)---Aionian-Edition\.noia/", $args['filepath'], $matches)) { AION_ECHO("ERROR! Failed to preg_match(Holy-Bible): ".$args['filepath']); }
	$bible = $matches[1];
	$biblename = str_replace("Holy-Bible---","",$bible);
	$newfile = $args['destiny']."/$bible.php";
	$yohebrew = (stripos($bible,"Hebrew") ? TRUE: FALSE);
	$database = array();
	AION_FILE_DATA_GET( $args['filepath'], 'T_BIBLE', $database, array('BOOK','CHAPTER','VERSE'), FALSE );

	// build the book and chapter list to proof
	$booksandchaps = array();
	foreach($args['database']['T_VERSEMAP'] as $mapped) {
		if ($mapped['MAP']=='NONE' || $mapped['BIBLE']!=$bible) { continue; }
		if ($mapped['MAP']=='HEBREW') {	$booksandchaps['HEBREW']	= array('BOOK'=>'HEBREW','CHAPTER'=>'001');	continue; }
		if ($mapped['MAP']=='XALB') {	$booksandchaps['XALB']		= array('BOOK'=>'XALB','CHAPTER'=>'001');	continue; }
		if ($mapped['MAP']=='XJER') {	$booksandchaps['XJER']		= array('BOOK'=>'XJER','CHAPTER'=>'001');	continue; }
		if ($mapped['MAP']=='PSA2') {	$booksandchaps['XPSA']		= array('BOOK'=>'XPSA','CHAPTER'=>'001');	continue; }
		if ($mapped['MAP']=='PSA150') {	$booksandchaps['XPSA']		= array('BOOK'=>'XPSA','CHAPTER'=>'001');	continue; }
		if ($mapped['MAP']=='JOE3-4') {	$booksandchaps['JOE-003']	= array('BOOK'=>'JOE','CHAPTER'=>'003');	continue; }
		if ($mapped['MAP']=='DAN100' || $mapped['MAP']=='DAN100B') {	$booksandchaps['DAN-003']	= array('BOOK'=>'DAN','CHAPTER'=>'003');	$booksandchaps['DAN-004'] = array('BOOK'=>'DAN','CHAPTER'=>'004'); continue; }
		if ($mapped['MAP']=='PRO2') {
			$booksandchaps['ECC-006'] = array('BOOK'=>'ECC','CHAPTER'=>'006');
			$booksandchaps['ECC-007'] = array('BOOK'=>'ECC','CHAPTER'=>'007');
			$booksandchaps['SOL-005'] = array('BOOK'=>'SOL','CHAPTER'=>'005');
			$booksandchaps['SOL-006'] = array('BOOK'=>'SOL','CHAPTER'=>'006');
			continue;
		}
		if ($mapped['MAP']=='PRO5') {
			$booksandchaps['NUM-029'] = array('BOOK'=>'NUM','CHAPTER'=>'029');
			$booksandchaps['NUM-030'] = array('BOOK'=>'NUM','CHAPTER'=>'030');
			$booksandchaps['1SA-023'] = array('BOOK'=>'1SA','CHAPTER'=>'023');
			$booksandchaps['1SA-024'] = array('BOOK'=>'1SA','CHAPTER'=>'024');
			$booksandchaps['ECC-004'] = array('BOOK'=>'ECC','CHAPTER'=>'004');
			$booksandchaps['ECC-005'] = array('BOOK'=>'ECC','CHAPTER'=>'005');
			$booksandchaps['HOS-013'] = array('BOOK'=>'HOS','CHAPTER'=>'013');
			$booksandchaps['HOS-014'] = array('BOOK'=>'HOS','CHAPTER'=>'014');
			$booksandchaps['JON-001'] = array('BOOK'=>'JON','CHAPTER'=>'001');
			$booksandchaps['JON-002'] = array('BOOK'=>'JON','CHAPTER'=>'002');
			continue;
		}
		if ($mapped['MAP']=='PRO6' || $mapped['MAP']=='PRO6B') {
			$booksandchaps['GEN-036'] = array('BOOK'=>'GEN','CHAPTER'=>'036');
			$booksandchaps['GEN-037'] = array('BOOK'=>'GEN','CHAPTER'=>'037');
			$booksandchaps['LEV-006'] = array('BOOK'=>'LEV','CHAPTER'=>'006');
			$booksandchaps['LEV-007'] = array('BOOK'=>'LEV','CHAPTER'=>'007');
			$booksandchaps['DEU-023'] = array('BOOK'=>'DEU','CHAPTER'=>'023');
			$booksandchaps['DEU-024'] = array('BOOK'=>'DEU','CHAPTER'=>'024');
			$booksandchaps['1KI-020'] = array('BOOK'=>'1KI','CHAPTER'=>'020');
			$booksandchaps['1KI-021'] = array('BOOK'=>'1KI','CHAPTER'=>'021');
			$booksandchaps['DAN-003'] = array('BOOK'=>'DAN','CHAPTER'=>'003');
			$booksandchaps['DAN-004'] = array('BOOK'=>'DAN','CHAPTER'=>'004');
			$booksandchaps['HAG-001'] = array('BOOK'=>'HAG','CHAPTER'=>'001');
			$booksandchaps['HAG-002'] = array('BOOK'=>'HAG','CHAPTER'=>'002');
			continue;
		}
		if (!preg_match("/([0-9A-Z]{3})([0-9\-]+)/", $mapped['MAP'], $matches) || empty($matches[1]) || empty($matches[2])) { AION_ECHO("ERROR! Failed to preg_match(MAP)= ".$mapped['MAP']." File=".$args['filepath']); }
		$chaps = explode('-',$matches[2]);
		foreach($chaps as $num) { $booksandchaps[$matches[1].'-'.sprintf('%03d',(int)$num)] = array('BOOK'=>$matches[1],'CHAPTER'=>sprintf('%03d',(int)$num)); }
	}
	foreach($args['database']['T_VERSEMAPCOMBINER'] as $mapped) {
		if ($mapped['BIBLE']!=$bible || empty($mapped['BOOK'])) { continue; }
		$booksandchaps[$mapped['BOOK'].'-'.sprintf('%03d',(int)$mapped['CHAPTER'])] = array('BOOK'=>$mapped['BOOK'],'CHAPTER'=>sprintf('%03d',(int)$mapped['CHAPTER']));
	}
	foreach($booksandchaps as $yeah) {
		if ($yeah['BOOK']=='XALB' || $yeah['BOOK']=='XJER' || $yeah['BOOK']=='XPSA' || $yeah['BOOK']=='HEBREW') { continue; }
		if (empty($args['database']['T_BOOKSCOUNT'][$yeah['BOOK']])) { AION_ECHO("ERROR! $bible Book not found in BOOKSCOUNT: ".$yeah['BOOK']); }
		if ((int)$yeah['CHAPTER'] < 1 || (int)$yeah['CHAPTER'] > (int)$args['database']['T_BOOKSCOUNT'][$yeah['BOOK']]['CHAPTER']) { AION_ECHO("ERROR! $bible Book CHAPTER not found in BOOKSCOUNT: ".$yeah['BOOK']." ".$yeah['CHAPTER']); }
		if (empty($args['database']['T_BOOKSSTANDARD'][$yeah['BOOK'].'-'.$yeah['CHAPTER'].'-001'])) { AION_ECHO("ERROR! $bible Book CHAPTER not found in BOOKSSTANDARD: ".$yeah['BOOK']." ".$yeah['CHAPTER']); }
	}

	// create html header
	$lang = "lang='".((empty($args['database']['T_VERSIONS'][$bible]['LANGUAGECODEISO'])) ? $args['database']['T_VERSIONS'][$bible]['LANGUAGECODE'] : $args['database']['T_VERSIONS'][$bible]['LANGUAGECODEISO'])."'";
	$lang2 = "sl=".((empty($args['database']['T_VERSIONS'][$bible]['LANGUAGECODEISO'])) ? $args['database']['T_VERSIONS'][$bible]['LANGUAGECODE'] : $args['database']['T_VERSIONS'][$bible]['LANGUAGECODEISO']);
	$htm = "<?PHP ?>\n";
	$htm .= "<!DOCTYPE html><html lang='en'>\n<head>\n<meta charset='utf-8'>\n<title>Aionian Bible Bible Meta Data and Proof Reader - $bible</title>\n";
	$htm .= "<style>\n";
	$htm .= "span.aionspace { padding: 0 7px; }\n";
	$htm .= "table.aionborder { border-collapse: collapse; }\n";
	$htm .= "table.aionborder td { border: 1px solid gray; padding: 7px; }\n";
	$htm .= "table.aionmeta td { padding: 3px 3px; }\n";	
	$htm .= "</style>\n";
	$htm .= "</head>\n";
	$htm .= "<body  style='margin:20px;padding:0'>\n";
	$htm .= "<h2>AionianBible.org Bible Meta Data and Proof Reader</h2>\n";

	// Marketing Blurbs
	$blurbyear = (empty($args['database']['T_VERSIONS'][$bible]['YEAR']) ? "" : ", year ".trim($args['database']['T_VERSIONS'][$bible]['YEAR']));
	$noderive  = (stripos($args['database']['T_VERSIONS'][$bible]['COPYRIGHT'],'Derivative')!==FALSE ? "" : " Apocryphal text is removed and verses renumbered to the English standard.");
	$blurbpdox = (empty($args['database']['T_FORPRINT'][$bible]['PDOEXTENSION']) ? "" : " ".trim($args['database']['T_FORPRINT'][$bible]['PDOEXTENSION']));
	$blurbdesc = (empty($args['database']['T_VERSIONS'][$bible]['DESCRIPTION']) ? "" : " ".trim($args['database']['T_VERSIONS'][$bible]['DESCRIPTION']).".");
	$blurb = "<b>The <i>Holy Bible Aionian Edition</i> is the world's first Bible <i>un-translation</i>!</b> This Bible helps us understand God's love for everyone and after-life destinies. What is an <i>un-translation</i>? This Bible shows the locations of eleven key Greek and Hebrew words. The primary word shown is <i>aionios</i>, typically translated <i>eternal</i>, yet <i>aionios</i> means something more wonderful than infinite time! Greeks used <i>aionios</i> to mean <i>entirety</i>, even <i>consummate</i>, but never merely <i>infinite</i> time. So the <i>aionios</i> life promised in John 3:16 is not simply a ticket to future <i>eternal</i> life, but the invitation to <i>consummate</i> life now! <i>Aionios</i> life with Christ is better than forever. This Bible is in the ".trim($args['database']['T_VERSIONS'][$bible]['LANGUAGEENGLISH'])." language, with source: <i>".trim($args['database']['T_VERSIONS'][$bible]['SOURCE'])."</i>$blurbyear, from ".trim($args['database']['T_VERSIONS'][$bible]['SOURCEDOMAIN']).", free at AionianBible.org, and also known as <i>The Purple Bible</i>.$noderive$blurbpdox<BR>";
	if (AION_LOOP_HTMS_DOIT_OTONLY($database['T_BIBLE'])) {
	$blurb = "<b>The <i>Holy Bible Aionian Edition</i> is the world's first Bible <i>un-translation</i>!</b> This Bible helps us understand God's love for everyone and after-life destinies. What is an <i>un-translation</i>? This Bible shows the location of the Hebrew word <i>Sheol</i>, typically translated as <i>Hell</i>. However, Hell is ill-defined when compared with the underlying Hebrew meaning. Instead, Sheol is the abode of deceased believers and unbelievers and should never be translated as Hell. The implications are more than noteworthy. This Bible is in the ".trim($args['database']['T_VERSIONS'][$bible]['LANGUAGEENGLISH'])." language, with source: <i>".trim($args['database']['T_VERSIONS'][$bible]['SOURCE'])."</i>$blurbyear, from ".trim($args['database']['T_VERSIONS'][$bible]['SOURCEDOMAIN']).", free at AionianBible.org, and also known as <i>The Purple Bible</i>.$noderive$blurbpdox<BR>";
	}
	$PDFPA = AION_PDF_PAGECOUNT("../www-stageresources/$bible---POD_KDP_ALL_BODY.pdf");
	$PDFPN = AION_PDF_PAGECOUNT("../www-stageresources/$bible---POD_KDP_NEW_BODY.pdf");
	$PDFPI = (float)($PDFPA <=0 ? 0 : ((0.85 + ($PDFPA * 0.012)) / 0.6));
	$htm .= "<table class='aionmeta' style='border: 4px solid purple;'>\n";
	$htm .= "<tr><td>TITLE</td><td><b>Holy Bible Aionian Edition: ".$args['database']['T_FORPRINT'][$bible]['VERSIONE']."</b></td></tr>\n";
	$htm .= "<tr><td>TITLE_NEW</td><td>Holy Bible Aionian Edition: ".$args['database']['T_FORPRINT'][$bible]['VERSIONE']." - New Testament</td></tr>\n";
	// Proofer Priority
	$htm .= "<tr><td><br /></td><td></td></tr>\n";
	$htm .= "<tr><td>FILE</td><td>$bible"."_POD_</td></tr>\n";
	if (!empty($args['database']['T_FORPRINT'][$bible]['NOPDO'])) {
		$htm .= "<tr><td>POD</td><td>Nope, Translation not available for Print on Demand</td></tr>\n";
	}
	else {	
		// KDP Full
		$kdpedit = (empty($args['database']['T_VERSIONS'][$bible]['KDP']) || $args['database']['T_VERSIONS'][$bible]['KDP']=='NULL' ? "<a href='https://kdp.amazon.com/en_US/bookshelf' target='_blank'>Add</a>" : "<a href='https://kdp.amazon.com/action/dualbookshelf.editpaperbackdetails/en_US/title-setup/paperback/".$args['database']['T_VERSIONS'][$bible]['KDP']."/details?ref_=kdp_BS_D_ta_de' target='_blank'>Edit</a>");
		if ($args['database']['T_FORPRINT'][$bible]['YESKDP']=='TRUE' && !empty($args['database']['T_VERSIONS'][$bible]['AMAZON']) && $args['database']['T_VERSIONS'][$bible]['AMAZON']!='NULL') {
			$kdpbuy = "<a href='https://www.amazon.com/dp/".$args['database']['T_VERSIONS'][$bible]['AMAZON']."' target='_blank'>Buy</a>";
			$htm .= "<tr><td>KDP_ALL</td><td>POD_KDP_ALL_BODY.pdf &nbsp;/&nbsp; POD_KDP_ALL_COVER.pdf &nbsp;/&nbsp; $kdpedit $kdpbuy</td></tr>\n";
		}
		else if (!empty($args['database']['T_VERSIONS'][$bible]['AMAZON']) && $args['database']['T_VERSIONS'][$bible]['AMAZON']!='NULL') {
			$kdpbuy = "<a href='https://www.amazon.com/dp/".$args['database']['T_VERSIONS'][$bible]['AMAZON']."' target='_blank'>Buy*</a>";
			$htm .= "<tr><td>KDP_ALL</td><td>POD_KDP_ALL_BODY.pdf &nbsp;/&nbsp; POD_KDP_ALL_COVER.pdf &nbsp;/&nbsp; $kdpedit* $kdpbuy</td></tr>\n";
		}
		else if ($args['database']['T_FORPRINT'][$bible]['YESKDP']=='TRUE')  {
			$kdpbuy = "<a href='https://www.amazon.com/s/keywords=Holy Bible Aionian Edition ".$args['database']['T_FORPRINT'][$bible]['VERSIONE']."' target='_blank'>Find</a>";
			$htm .= "<tr><td>KDP_ALL</td><td>POD_KDP_ALL_BODY.pdf &nbsp;/&nbsp; POD_KDP_ALL_COVER.pdf &nbsp;/&nbsp; $kdpedit $kdpbuy</td></tr>\n";
		}
		else { $htm .= "<tr><td>KDP_ALL</td><td>None</td></tr>\n"; }
		// KDP NT
		$kdpedit = (empty($args['database']['T_VERSIONS'][$bible]['KDPNT']) || $args['database']['T_VERSIONS'][$bible]['KDPNT']=='NULL' ? "<a href='https://kdp.amazon.com/en_US/bookshelf' target='_blank'>Add</a>" : "<a href='https://kdp.amazon.com/action/dualbookshelf.editpaperbackdetails/en_US/title-setup/paperback/".$args['database']['T_VERSIONS'][$bible]['KDPNT']."/details?ref_=kdp_BS_D_ta_de' target='_blank'>Edit</a>");
		if ($args['database']['T_FORPRINT'][$bible]['YESNEW']=='TRUE' && $args['database']['T_FORPRINT'][$bible]['YESKDP']=='TRUE' && !empty($args['database']['T_VERSIONS'][$bible]['AMAZONNT']) && $args['database']['T_VERSIONS'][$bible]['AMAZONNT']!='NULL') {
			$kdpbuy = "<a href='https://www.amazon.com/dp/".$args['database']['T_VERSIONS'][$bible]['AMAZONNT']."' target='_blank'>Buy</a>";
			$htm .= "<tr><td>KDP_NEW</td><td>POD_KDP_NEW_BODY.pdf &nbsp;/&nbsp; POD_KDP_NEW_COVER.pdf &nbsp;/&nbsp; $kdpedit $kdpbuy</td></tr>\n";
		}
		else if (!empty($args['database']['T_VERSIONS'][$bible]['AMAZONNT']) && $args['database']['T_VERSIONS'][$bible]['AMAZONNT']!='NULL') {
			$kdpbuy = "<a href='https://www.amazon.com/dp/".$args['database']['T_VERSIONS'][$bible]['AMAZONNT']."' target='_blank'>Buy*</a>";
			$htm .= "<tr><td>KDP_NEW</td><td>POD_KDP_NEW_BODY.pdf &nbsp;/&nbsp; POD_KDP_NEW_COVER.pdf &nbsp;/&nbsp; $kdpedit* $kdpbuy</td></tr>\n";
		}
		else if ($args['database']['T_FORPRINT'][$bible]['YESNEW']=='TRUE' && $args['database']['T_FORPRINT'][$bible]['YESKDP']=='TRUE')  {
			$kdpbuy = "<a href='https://www.amazon.com/s/keywords=Holy Bible Aionian Edition ".$args['database']['T_FORPRINT'][$bible]['VERSIONE']."' target='_blank'>Find</a>";
			$htm .= "<tr><td>KDP_NEW</td><td>POD_KDP_NEW_BODY.pdf &nbsp;/&nbsp; POD_KDP_NEW_COVER.pdf &nbsp;/&nbsp; $kdpedit $kdpbuy</td></tr>\n";
		}
		else { $htm .= "<tr><td>KDP_NEW</td><td>None</td></tr>\n"; }
		// Lulu links
		$lulu_regu	= ($args['database']['T_VERSIONS'][$bible]['LULU']=='NULL'		|| preg_match('/^http/i',$args['database']['T_VERSIONS'][$bible]['LULU'])		? $args['database']['T_VERSIONS'][$bible]['LULU']		: "https://www.lulu.com/content/".$args['database']['T_VERSIONS'][$bible]['LULU']);
		$lulu_hard	= ($args['database']['T_VERSIONS'][$bible]['LULUHARD']=='NULL'	|| preg_match('/^http/i',$args['database']['T_VERSIONS'][$bible]['LULUHARD'])	? $args['database']['T_VERSIONS'][$bible]['LULUHARD']	: "https://www.lulu.com/content/".$args['database']['T_VERSIONS'][$bible]['LULUHARD']);
		$lulu_ntnt	= ($args['database']['T_VERSIONS'][$bible]['LULUNT']=='NULL'	|| preg_match('/^http/i',$args['database']['T_VERSIONS'][$bible]['LULUNT'])		? $args['database']['T_VERSIONS'][$bible]['LULUNT']		: "https://www.lulu.com/content/".$args['database']['T_VERSIONS'][$bible]['LULUNT']);
		// Lulu Full
		// Jump to landing pages:  /start  /copyright  /design  /details  /pricing
		if (empty($args['database']['T_FORPRINT'][$bible]['ISBNLU']) && $args['database']['T_VERSIONS'][$bible]['LULU']!="NULL") { $htm .= "<tr><td>LULU_ALL</td><td>Problem</td></tr>\n"; }
		else if (!empty($args['database']['T_FORPRINT'][$bible]['ISBNLU']) && $args['database']['T_VERSIONS'][$bible]['LULU']=="NULL") { $htm .= "<tr><td>LULU_ALL</td><td>POD_LULU_ALL_BODY.pdf &nbsp;/&nbsp; POD_LULU_ALL_COVER.pdf &nbsp;/&nbsp; <b>".$args['database']['T_FORPRINT'][$bible]['ISBNLU']."</b> &nbsp;/&nbsp; <a href='https://www.lulu.com/account/projects' target='_blank'>Add</a></td></tr>\n"; }
		else if (empty($args['database']['T_FORPRINT'][$bible]['ISBNLU'])) { $htm .= "<tr><td>LULU_ALL</td><td>None</td></tr>\n"; }
		else { $htm .= "<tr><td>LULU_ALL</td><td>POD_LULU_ALL_BODY.pdf &nbsp;/&nbsp; POD_LULU_ALL_COVER.pdf &nbsp;/&nbsp; <b>".$args['database']['T_FORPRINT'][$bible]['ISBNLU']."</b> &nbsp;/&nbsp; <a href='https://www.lulu.com/account/wizard/".$args['database']['T_VERSIONS'][$bible]['LULUX']."/start' target='_blank'>Edit</a> <a href='$lulu_regu' target='_blank'>Buy</a></td></tr>\n"; }
		// Lulu NT	
		if (empty($args['database']['T_FORPRINT'][$bible]['ISBNLUNT']) && $args['database']['T_VERSIONS'][$bible]['LULUNT']!="NULL") { $htm .= "<tr><td>LULU_NEW</td><td>Problem</td></tr>\n"; }
		else if (!empty($args['database']['T_FORPRINT'][$bible]['ISBNLUNT']) && $args['database']['T_VERSIONS'][$bible]['LULUNT']=="NULL") { $htm .= "<tr><td>LULU_NEW</td><td>POD_LULU_NEW_BODY.pdf &nbsp;/&nbsp; POD_LULU_NEW_COVER.pdf &nbsp;/&nbsp; <b>".$args['database']['T_FORPRINT'][$bible]['ISBNLUNT']."</b> &nbsp;/&nbsp; <a href='https://www.lulu.com/account/projects' target='_blank'>Add</a></td></tr>\n"; }
		else if (empty($args['database']['T_FORPRINT'][$bible]['ISBNLUNT'])) { $htm .= "<tr><td>LULU_NEW</td><td>None</td></tr>\n"; }
		else { $htm .= "<tr><td>LULU_NEW</td><td>POD_LULU_NEW_BODY.pdf &nbsp;/&nbsp; POD_LULU_NEW_COVER.pdf &nbsp;/&nbsp; <b>".$args['database']['T_FORPRINT'][$bible]['ISBNLUNT']."</b> &nbsp;/&nbsp; <a href='https://www.lulu.com/account/wizard/".$args['database']['T_VERSIONS'][$bible]['LULUNTX']."/start' target='_blank'>Edit</a> <a href='$lulu_ntnt' target='_blank'>Buy</a></td></tr>\n"; }
		// Lulu Hardcover
		if (empty($args['database']['T_FORPRINT'][$bible]['ISBNLUHARD']) && $args['database']['T_VERSIONS'][$bible]['LULUHARD']!="NULL") { $htm .= "<tr><td>LULU_HARD</td><td>Problem</td></tr>\n"; }
		else if (!empty($args['database']['T_FORPRINT'][$bible]['ISBNLUHARD']) && $args['database']['T_VERSIONS'][$bible]['LULUHARD']=="NULL") { $htm .= "<tr><td>LULU_HARD</td><td>POD_LULU_HAR_BODY.pdf &nbsp;/&nbsp; POD_LULU_HAR_COVER.pdf &nbsp;/&nbsp; <b>".$args['database']['T_FORPRINT'][$bible]['ISBNLUHARD']."</b> &nbsp;/&nbsp; <a href='https://www.lulu.com/account/projects' target='_blank'>Add</a></td></tr>\n"; }
		else if (empty($args['database']['T_FORPRINT'][$bible]['ISBNLUHARD'])) { $htm .= "<tr><td>LULU_HARD</td><td>None</td></tr>\n"; }
		else  { $htm .= "<tr><td>LULU_HARD</td><td>POD_LULU_HAR_BODY.pdf &nbsp;/&nbsp; POD_LULU_HAR_COVER.pdf &nbsp;/&nbsp; <b>".$args['database']['T_FORPRINT'][$bible]['ISBNLUHARD']."</b> &nbsp;/&nbsp; <a href='https://www.lulu.com/account/wizard/".$args['database']['T_VERSIONS'][$bible]['LULUHARDX']."/start' target='_blank'>Edit</a> <a href='$lulu_hard' target='_blank'>Buy</a></td></tr>\n"; }
	}
	$htm .= "<tr><td><br /></td><td></td></tr>\n";
	$htm .= "<tr><td>LANGUAGE</td><td>".$args['database']['T_VERSIONS'][$bible]['LANGUAGEENGLISH']."</td></tr>\n";
	$htm .= "<tr><td>AUTHOR</td><td>Nainoia Inc</td></tr>\n";	
	$htm .= "<tr><td>CATEGORY</td><td>Non-fiction > Bibles > General / Christian</td></tr>\n";
	$htm .= "<tr><td>COPYRIGHT</td><td>Creative Commons Attribution-NoDerivatives</td></tr>\n";
	$htm .= "<tr><td>TYPE</td><td>6x9, NO-BLEED, Glossy</td></tr>\n";
	$htm .= "<tr><td>PAPER</td><td>Standard black and white interior with white paper</td></tr>\n";
	$htm .= "<tr><td>PAGES</td><td>Full=$PDFPA  New=$PDFPN</td></tr>\n";
	$htm .= "<tr><td>TERRITORY</td><td>ALL</td></tr>\n";
	$htm .= "<tr><td>PRICE</td><td>Approx $".sprintf("%.2f",$PDFPI)." + $1.67 = ".sprintf("%.2f",$PDFPI+1.67)." for $1 profit</td></tr>\n";
	$htm .= "<tr><td>KEYWORDS</td><td>Christian, Salvation, Jesus, Aionios, Hades, Gehenna, Sheol</td></tr>\n";
	$htm .= "<tr><td>TRANSLATOR</td><td>".$args['database']['T_VERSIONS'][$bible]['TRANSLATOR']."</td></tr>\n";
	$htm .= "<tr><td>KDP_DESC</td><td>".htmlentities($blurb)."</td></tr>\n";
	$htm .= "<tr><td>LULU_DESC</td><td>$blurb</td></tr>\n";
	$htm .= "</table\n";
	$htm .= "<br /><br />\n";

	// links
	$htm .= "<b>PROOFER</b> - <a href='/Bibles/$biblename/parallel-English---King-James-Version' target='_blank'>$bible</a><br />\n";
	$htm .= "<a href='/Bibles/$biblename/Noted/parallel-English---King-James-Version' target='_blank'>Review Aionian Verses</a><br />\n";
	$htm .= "<a href='https://translate.google.com/translate?".$lang2."&tl=en&u=http%3A%2F%2Fstage.aionianbible.org%2FBibles%2F".$biblename."%2FNoted%2Fparallel-English---King-James-Version' target='_blank'>Translate Aionian Verses</a><br />\n";
	$htm .= "<a href='https://translate.google.com/translate?".$lang2."&tl=en&u=http%3A%2F%2Fstage.aionianbible.org%2Flibrary%2F".$bible.".php'       target='_blank'>Translate WHOLE</a><br />\n";
	$htm .= "<a href='https://translate.google.com/translate?".$lang2."&tl=en&u=http%3A%2F%2Fstage.aionianbible.org%2Flibrary%2F".$bible.".php?raw=1' target='_blank'>Translate RAWFIX</a>  <a href='#raw'>On page</a><br />\n";
	$htm .= "<a href='https://translate.google.com/translate?".$lang2."&tl=en&u=http%3A%2F%2Fstage.aionianbible.org%2Flibrary%2F".$bible.".php?not=1' target='_blank'>Translate NOTFIX</a>  <a href='#not'>On page</a><br />\n";
	$htm .= "<a href='https://translate.google.com/translate?".$lang2."&tl=en&u=http%3A%2F%2Fstage.aionianbible.org%2Flibrary%2F".$bible.".php?unt=1' target='_blank'>Translate CUSTOM</a>  <a href='#unt'>On page</a><br />\n";
	$htm .= "<a href='https://translate.google.com/translate?".$lang2."&tl=en&u=http%3A%2F%2Fstage.aionianbible.org%2Flibrary%2F".$bible.".php?rev=1' target='_blank'>Translate REVERS</a>  <a href='#rev'>On page</a><br />\n";
	$htm .= "<a href='https://translate.google.com/translate?".$lang2."&tl=en&u=http%3A%2F%2Fstage.aionianbible.org%2Flibrary%2F".$bible.".php?rev=2' target='_blank'>Translate REVERS 0-120</a>  <a href='#rev'>On page</a><br />\n";
	$htm .= "<a href='https://translate.google.com/translate?".$lang2."&tl=en&u=http%3A%2F%2Fstage.aionianbible.org%2Flibrary%2F".$bible.".php?rev=3' target='_blank'>Translate REVERS 120+</a>  <a href='#rev'>On page</a><br />\n";
	$htm .= "<br /><br />\n";	
	
	// Fourteen words and phrases
	$ISGOOD = $args['database']['T_FORPRINT'][$bible]['STATUS'];
	$htmFF = "<span id='".str_replace(array(' ',','),"-",$args['database']['T_VERSIONS'][$bible]['LANGUAGEENGLISH'])."'></span><b>Please help translate or confirm the 14 words and phrases below and thank you!</b><br />\n";
	$htmFF .= "<table class='aionborder'>\n<tr><td style='background-color:lightgray'>ENGLISH   &gt;   </td><td style='background-color:lightgray'><h3>".$args['database']['T_VERSIONS'][$bible]['LANGUAGEENGLISH']." / ".$args['database']['T_VERSIONS'][$bible]['LANGUAGE']."</h3></td></tr>\n";
	$htmFF .= "<tr><td class='notranslate' style='background-color:lightgray'>Status   &gt;   </td><td style='background-color:lightgray'>".$args['database']['T_FORPRINT'][$bible]['STATUS']."</td></tr>\n";
	$htmFF .= "<tr><td class='notranslate' >Preface   &gt;   </td><td>".$args['database']['T_FORPRINT'][$bible]['W_PREF']."</td></tr>\n";
	$htmFF .= "<tr><td class='notranslate' >Old Testament   &gt;   </td><td>".$args['database']['T_FORPRINT'][$bible]['W_OLD']."</td></tr>\n";
	$htmFF .= "<tr><td class='notranslate' >New Testament   &gt;   </td><td>".$args['database']['T_FORPRINT'][$bible]['W_NEW']."</td></tr>\n";
	$htmFF .= "<tr><td class='notranslate' >Table of Contents   &gt;   </td><td>".$args['database']['T_FORPRINT'][$bible]['W_TOC']."</td></tr>\n";
	$htmFF .= "<tr><td class='notranslate' >Appendix   &gt;   </td><td>".$args['database']['T_FORPRINT'][$bible]['W_APDX']."</td></tr>\n";
	$htmFF .= "<tr><td class='notranslate' >Reader's Guide   &gt;   </td><td>".$args['database']['T_FORPRINT'][$bible]['W_READ']."</td></tr>\n";
	$htmFF .= "<tr><td class='notranslate' >Glossary   &gt;   </td><td>".$args['database']['T_FORPRINT'][$bible]['W_GLOS']."</td></tr>\n";
	$htmFF .= "<tr><td class='notranslate' >Maps   &gt;   </td><td>".$args['database']['T_FORPRINT'][$bible]['W_MAP']."</td></tr>\n";
	$htmFF .= "<tr><td class='notranslate' >Illustrations   &gt;   </td><td>".$args['database']['T_FORPRINT'][$bible]['W_ILUS']."</td></tr>\n";
	$htmFF .= "<tr><td class='notranslate' >Life   &gt;   </td><td>".$args['database']['T_FORPRINT'][$bible]['W_LIFE']."</td></tr>\n";
	$htmFF .= "<tr><td class='notranslate' >The world’s first Holy Bible untranslation<br />\n(The first Holy Bible in the world reverse translated)   &gt;   </td><td>".$args['database']['T_FORPRINT'][$bible]['W_WORL']."</td></tr>\n";
	$htmFF .= "<tr><td class='notranslate' >100% free to copy and print   &gt;   </td><td>".$args['database']['T_FORPRINT'][$bible]['W_FREE']."</td></tr>\n";
	$htmFF .= "<tr><td class='notranslate' >also known as   &gt;   </td><td>".$args['database']['T_FORPRINT'][$bible]['W_AKA']."</td></tr>\n";
	$htmFF .= "<tr><td class='notranslate' >The Purple Bible   &gt;   </td><td>".$args['database']['T_FORPRINT'][$bible]['W_PURP']."</td></tr>\n";
	$htmFF .= "</table>\n";
	$htmFF .= "<span class='notranslate'>** The word 'untranslation' is a made up to word to explain to the reader that we have un-translated certain words back to the underlying language of Hebrew or Greek to help the reader better understand in certain verses.  The word 'untranslation' is understood in English.  However, for other languages we have to consider what expression means 'un' or we could say instead 'reverse translation' or 'translated back'.  Also please note that I hope for these terms to be standard terms that you would find in a Bible or a book.  Thanks so much for your help.  Also 'Purple' is a color and the color used for the cover of these Bible translations.  So the name 'Purple Bible' is simply the friendly name of this Bible project.</span><br />";
	$htmFF .= "** <b><a href='#top'>Return to top</a> -- or -- <a href='mailto:escribes@aionianbible.org?subject=".rawurlencode(htmlspecialchars_decode('Yes! I can help translate the 14 words and phrases in '.$args['database']['T_VERSIONS'][$bible]['LANGUAGEENGLISH']))."&body=".rawurlencode(htmlspecialchars_decode(strip_tags($htmFF)))."'>Click here to email corrections for the 14 words above in ".$args['database']['T_VERSIONS'][$bible]['LANGUAGEENGLISH'].". Thank you!</a></b><br /><br /><br /><br /><br />\n";
	$htm .= $htmFF;
	
	// build foreign language page also!
	static $lastlang = "";
	if ($lastlang != $args['database']['T_VERSIONS'][$bible]['LANGUAGEENGLISH'] && $ISGOOD!='GOOD') { $args['foreign'] .= ( $htmFF . "<P style='page-break-before: always'>\n\n" ); }
	$lastlang = $args['database']['T_VERSIONS'][$bible]['LANGUAGEENGLISH'];
	
	// Eight verses
	$htm .= "<br /><br /><b>PLEASE HELP CONFIRM THE ILLUSTRATION VERSES BELOW</b><br />\n";	
	$htm .= "<table class='aionborder'>\n<tr><td>REFERENCE</td><td>VERSE</td></tr>\n";
	$htm .= "<tr><td>John 3:16 / ".$args['database']['T_FORPRINT'][$bible]['JOH3_16_B']."</td><td>".$args['database']['T_FORPRINT'][$bible]['JOH3_16']."</td></tr>\n";
	$htm .= "<tr><td>Genesis 3:24 / ".$args['database']['T_FORPRINT'][$bible]['GEN3_24_B']."</td><td>".$args['database']['T_FORPRINT'][$bible]['GEN3_24']."</td></tr>\n";
	$htm .= "<tr><td>Luke 23:34 / ".$args['database']['T_FORPRINT'][$bible]['LUK23_34_B']."</td><td>".$args['database']['T_FORPRINT'][$bible]['LUK23_34']."</td></tr>\n";
	$htm .= "<tr><td>Revelation 21:2-3 / ".$args['database']['T_FORPRINT'][$bible]['REV21_2_3_B']."</td><td>".$args['database']['T_FORPRINT'][$bible]['REV21_2_3']."</td></tr>\n";
	$htm .= "<tr><td>Hebrews 11:8 / ".$args['database']['T_FORPRINT'][$bible]['HEB11_8_B']."</td><td>".$args['database']['T_FORPRINT'][$bible]['HEB11_8']."</td></tr>\n";
	$htm .= "<tr><td>Exodus 13:17 / ".$args['database']['T_FORPRINT'][$bible]['EXO13_17_B']."</td><td>".$args['database']['T_FORPRINT'][$bible]['EXO13_17']."</td></tr>\n";
	$htm .= "<tr><td>Mark 10:45 / ".$args['database']['T_FORPRINT'][$bible]['MAR10_45_B']."</td><td>".$args['database']['T_FORPRINT'][$bible]['MAR10_45']."</td></tr>\n";
	$htm .= "<tr><td>Romans 1:1 / ".$args['database']['T_FORPRINT'][$bible]['ROM1_1_B']."</td><td>".$args['database']['T_FORPRINT'][$bible]['ROM1_1']."</td></tr>\n";
	$htm .= "<tr><td>Matthew 28:19 / ".$args['database']['T_FORPRINT'][$bible]['MAT28_19_B']."</td><td>".$args['database']['T_FORPRINT'][$bible]['MAT28_19']."</td></tr>\n";
	$htm .= "</table>\n";

	// loop complete rawfix
	$htm .= "<? if(empty(\$_GET) || !empty(\$_GET['raw'])) { ?>\n";
	$htm .= "<br /><br /><br /><a name='raw'></a><b>PLEASE HELP CONFIRM THE FIXED VERSES BELOW</b><br />\n";
	$htm .= "<br />\n<table cellpadding='3'>\n<tr><td>INDEX</td><td>BOOK</td><td>CHAP</td><td>VERS</td><td>RAWFIX</td><td>TEXT</td></tr>\n";
	$prev = NULL;
	$FIXED = 0;
	foreach($args['database']['T_RAWCHECK'] as $verse) {
		if($verse['BIBLE'] != $bible) { continue; }
		$disp_indx = ($prev && $verse['INDEX']	== $prev['INDEX']	? '' : $verse['INDEX']);
		$keys_book = $verse['BOOK'];
		$disp_book = ($prev && $verse['BOOK']	== $prev['BOOK']	? '' : $verse['BOOK']);
		$disp_link = "<a href='/Bibles/$biblename/".array_search($verse['BOOK'],$args['database']['T_BOOKS']['CODE'])."/".(int)$verse['CHAPTER']."/parallel-English---King-James-Version' target='_blank'>".$verse['CHAPTER']."</a>";
		$disp_link .= " <a href='https://translate.google.com/translate?".$lang2."&tl=en&u=http%3A%2F%2Fstage.aionianbible.org/Bibles/$biblename/".array_search($verse['BOOK'],$args['database']['T_BOOKS']['CODE'])."/".(int)$verse['CHAPTER']."/parallel-English---King-James-Version' target='_blank'>G</a>";
		$keys_chap = $verse['CHAPTER'];
		$disp_chap = ($prev && $verse['CHAPTER']	== $prev['CHAPTER']	? '' : $disp_link);
		$disp_vers = $verse['VERSE'];
		$disp_vbef = ($disp_vers > 1 ? sprintf('%03d', (int)$disp_vers-1) : 'XXX');
		$disp_vaft = sprintf('%03d', (int)$disp_vers+1);
		$disp_rawf = $verse['RAWFIX'];
		// space
		if ($prev && $verse['BOOK']!=$prev['BOOK']) { $htm .= "<tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>\n"; }
		// before
		$key = $keys_book.'-'.$keys_chap.'-'.$disp_vbef;
		if (empty($args['database']['T_RAWCHECK'][$bible.'-'.$key]) && !empty($database['T_BIBLE'][$key])) {
			$disp_text = $database['T_BIBLE'][$key]['TEXT'];
			$htm .= "<tr $lang><td>$disp_indx</td><td>$disp_book</td><td>$disp_chap</td><td>$disp_vbef</td><td></td><td>$disp_text</td></tr>\n";
			$disp_text = (empty($args['database']['T_BOOKSSTANDARD'][$key]) ? '' : $args['database']['T_BOOKSSTANDARD'][$key]['TEXT']);
			$htm .= "<tr class='notranslate'><td></td><td></td><td></td><td></td><td></td><td class='notranslate'>$disp_text</td></tr>\n";
			$disp_indx = '';
			$disp_book = '';
			$disp_chap = '';
		}
		// current
		$key = $keys_book.'-'.$keys_chap.'-'.$disp_vers;
		if (empty($database['T_BIBLE'][$key])) {
			$disp_rawf = 'REMAP';
			$disp_text = $verse['TEXT'];			
		}
		else {
			$disp_text = $database['T_BIBLE'][$key]['TEXT'];
		}
		$htm .= "<tr $lang><td>$disp_indx</td><td>$disp_book</td><td>$disp_chap</td><td>$disp_vers</td><td>$disp_rawf</td><td>$disp_text</td></tr>\n";
		$disp_text = (empty($args['database']['T_BOOKSSTANDARD'][$key]) ? '' : $args['database']['T_BOOKSSTANDARD'][$key]['TEXT']);
		$htm .= "<tr class='notranslate'><td></td><td></td><td></td><td></td><td></td><td class='notranslate'>$disp_text</td></tr>\n";
		// after
		$key = $keys_book.'-'.$keys_chap.'-'.$disp_vaft;
		if (empty($args['database']['T_RAWCHECK'][$bible.'-'.$key]) && !empty($database['T_BIBLE'][$key])) {
			$disp_text = $database['T_BIBLE'][$key]['TEXT'];
			$htm .= "<tr $lang><td></td><td></td><td></td><td>$disp_vaft</td><td></td><td>$disp_text</td></tr>\n";
			$disp_text = (empty($args['database']['T_BOOKSSTANDARD'][$key]) ? '' : $args['database']['T_BOOKSSTANDARD'][$key]['TEXT']);
			$htm .= "<tr class='notranslate'><td></td><td></td><td></td><td></td><td></td><td class='notranslate'>$disp_text</td></tr>\n";
		}
		$prev = $verse;
		++$FIXED;
	}
	$htm .= "</table>\n";
	$htm .= "<? } ?>\n";	

	
	// loop outstanding bookschapters
	$htm .= "<? if(empty(\$_GET) || !empty(\$_GET['not'])) { ?>\n";
	$htm .= "<br /><br /><br /><a name='not'><b>PLEASE HELP REVIEW THE OUTSTANDING VERSES BELOW</b><br />\n";
	$htm .= "<br />\n<table cellpadding='3'>\n<tr><td>INDEX</td><td>BOOK</td><td>CHAP</td><td>VERS</td><td>FLAG</td><td>TEXT</td></tr>\n";
	$prev = NULL;
	$NOTFIXED = 0;
	foreach($args['database']['T_BOOKSCHAPTERS'] as $verse) {
		if($verse['BIBLE'] != $bible) { continue; }
		$disp_indx = ($prev && $verse['INDEX']	== $prev['INDEX']	? '' : $verse['INDEX']);
		$keys_book = $verse['BOOK'];
		$disp_book = ($prev && $verse['BOOK']	== $prev['BOOK']	? '' : $verse['BOOK']);
		$disp_link = "<a href='/Bibles/$biblename/".array_search($verse['BOOK'],$args['database']['T_BOOKS']['CODE'])."/".(int)$verse['CHAPTER']."/parallel-English---King-James-Version' target='_blank'>".$verse['CHAPTER']."</a>";
		$disp_link .= " <a href='https://translate.google.com/translate?".$lang2."&tl=en&u=http%3A%2F%2Fstage.aionianbible.org/Bibles/$biblename/".array_search($verse['BOOK'],$args['database']['T_BOOKS']['CODE'])."/".(int)$verse['CHAPTER']."/parallel-English---King-James-Version' target='_blank'>G</a>";
		$keys_chap = $verse['CHAPTER'];
		$disp_chap = ($prev && $verse['CHAPTER']	== $prev['CHAPTER']	? '' : $disp_link);
		$disp_vers = $verse['VERSE'];
		$disp_vbef = ($disp_vers > 1 ? sprintf('%03d', (int)$disp_vers-1) : 'XXX');
		$disp_vaft = sprintf('%03d', (int)$disp_vers+1);
		$disp_flag = $verse['MAP'].' '.$verse['FLAG'];
		// space
		if ($prev && $verse['BOOK']!=$prev['BOOK']) { $htm .= "<tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>\n"; }
		// before
		$key = $keys_book.'-'.$keys_chap.'-'.$disp_vbef;
		if (empty($args['database']['T_BOOKSCHAPTERS'][$bible.'-'.$key]) && !empty($database['T_BIBLE'][$key])) {
			$disp_text = $database['T_BIBLE'][$key]['TEXT'];
			$htm .= "<tr $lang><td>$disp_indx</td><td>$disp_book</td><td>$disp_chap</td><td>$disp_vbef</td><td></td><td>$disp_text</td></tr>\n";
			$disp_text = (empty($args['database']['T_BOOKSSTANDARD'][$key]) ? '' : $args['database']['T_BOOKSSTANDARD'][$key]['TEXT']);
			$htm .= "<tr class='notranslate'><td></td><td></td><td></td><td></td><td></td><td class='notranslate'>$disp_text</td></tr>\n";
			$disp_indx = '';
			$disp_book = '';
			$disp_chap = '';
		}
		// current
		$key = $keys_book.'-'.$keys_chap.'-'.$disp_vers;
		$disp_text = (isset($database['T_BIBLE'][$key]['TEXT']) ? $database['T_BIBLE'][$key]['TEXT']: "VERSE TEXT NOT FOUND FOR $key");
		$htm .= "<tr $lang><td>$disp_indx</td><td>$disp_book</td><td>$disp_chap</td><td>$disp_vers</td><td>$disp_flag</td><td>$disp_text</td></tr>\n";
		$disp_text = (empty($args['database']['T_BOOKSSTANDARD'][$key]) ? '' : $args['database']['T_BOOKSSTANDARD'][$key]['TEXT']);
		$htm .= "<tr class='notranslate'><td></td><td></td><td></td><td></td><td></td><td class='notranslate'>$disp_text</td></tr>\n";
		// after
		$key = $keys_book.'-'.$keys_chap.'-'.$disp_vaft;
		if (empty($args['database']['T_BOOKSCHAPTERS'][$bible.'-'.$key]) && !empty($database['T_BIBLE'][$key])) {
			$disp_text = $database['T_BIBLE'][$key]['TEXT'];
			$htm .= "<tr $lang><td></td><td></td><td></td><td>$disp_vaft</td><td></td><td>$disp_text</td></tr>\n";
			$disp_text = (empty($args['database']['T_BOOKSSTANDARD'][$key]) ? '' : $args['database']['T_BOOKSSTANDARD'][$key]['TEXT']);
			$htm .= "<tr class='notranslate'><td></td><td></td><td></td><td></td><td></td><td class='notranslate'>$disp_text</td></tr>\n";
		}
		$prev = $verse;
		++$NOTFIXED;
	}
	$htm .= "</table>\n";
	$htm .= "<? } ?>\n";

	
	// loop untranslate customs
	$htm .= "<? if(empty(\$_GET) || !empty(\$_GET['unt'])) { ?>\n";
	$htm .= "<br /><br /><br /><a name='unt'><b>PLEASE HELP REVIEW THE CUSTOM UNTRANSLATE VERSES BELOW</b><br />\n";
	$htm .= "<br />\n<table cellpadding='3'>\n<tr><td>INDEX</td><td>BOOK</td><td>CHAP</td><td>VERS</td><td>FLAG</td><td>TEXT</td></tr>\n";
	$prev = NULL;
	$CUSTO = 0;
	foreach($args['database']['T_UNTRANSLATECUSTOM'] as $verse) {
		if($verse['BIBLE'] != $bible || empty($verse['INDEX'])) { continue; }
		$disp_indx = ($prev && $verse['INDEX']	== $prev['INDEX']	? '' : $verse['INDEX']);
		$keys_book = $verse['BOOK'];
		$disp_book = ($prev && $verse['BOOK']	== $prev['BOOK']	? '' : $verse['BOOK']);
		$disp_link = "<a href='/Bibles/$biblename/".array_search($verse['BOOK'],$args['database']['T_BOOKS']['CODE'])."/".(int)$verse['CHAPTER']."/parallel-English---King-James-Version' target='_blank'>".$verse['CHAPTER']."</a>";
		$disp_link .= " <a href='https://translate.google.com/translate?".$lang2."&tl=en&u=http%3A%2F%2Fstage.aionianbible.org/Bibles/$biblename/".array_search($verse['BOOK'],$args['database']['T_BOOKS']['CODE'])."/".(int)$verse['CHAPTER']."/parallel-English---King-James-Version' target='_blank'>G</a>";
		$keys_chap = $verse['CHAPTER'];
		$disp_chap = ($prev && $verse['CHAPTER']	== $prev['CHAPTER']	? '' : $disp_link);
		$disp_vers = $verse['VERSE'];
		$disp_vbef = ($disp_vers > 1 ? sprintf('%03d', (int)$disp_vers-1) : 'XXX');
		$disp_vaft = sprintf('%03d', (int)$disp_vers+1);
		$disp_flag = $verse['WORD'].' '.$verse['STRONGS'];
		// space
		if ($prev && $verse['BOOK']!=$prev['BOOK']) { $htm .= "<tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>\n"; }
		// before
		$key = $keys_book.'-'.$keys_chap.'-'.$disp_vbef;
		if (empty($args['database']['T_BOOKSCHAPTERS'][$bible.'-'.$key]) && !empty($database['T_BIBLE'][$key])) {
			$disp_text = $database['T_BIBLE'][$key]['TEXT'];
			$htm .= "<tr $lang><td>$disp_indx</td><td>$disp_book</td><td>$disp_chap</td><td>$disp_vbef</td><td></td><td>$disp_text</td></tr>\n";
			$disp_text = (empty($args['database']['T_BOOKSSTANDARD'][$key]) ? '' : $args['database']['T_BOOKSSTANDARD'][$key]['TEXT']);
			$htm .= "<tr class='notranslate'><td></td><td></td><td></td><td></td><td></td><td class='notranslate'>$disp_text</td></tr>\n";
			$disp_indx = '';
			$disp_book = '';
			$disp_chap = '';
		}
		// current
		$key = $keys_book.'-'.$keys_chap.'-'.$disp_vers;
		$disp_text = (isset($database['T_BIBLE'][$key]['TEXT']) ? $database['T_BIBLE'][$key]['TEXT']: "VERSE TEXT NOT FOUND FOR $key");
		$htm .= "<tr $lang><td>$disp_indx</td><td>$disp_book</td><td>$disp_chap</td><td>$disp_vers</td><td>$disp_flag</td><td>$disp_text</td></tr>\n";
		$disp_text = (empty($args['database']['T_BOOKSSTANDARD'][$key]) ? '' : $args['database']['T_BOOKSSTANDARD'][$key]['TEXT']);
		$htm .= "<tr class='notranslate'><td></td><td></td><td></td><td></td><td></td><td class='notranslate'>$disp_text</td></tr>\n";
		// after
		$key = $keys_book.'-'.$keys_chap.'-'.$disp_vaft;
		if (empty($args['database']['T_BOOKSCHAPTERS'][$bible.'-'.$key]) && !empty($database['T_BIBLE'][$key])) {
			$disp_text = $database['T_BIBLE'][$key]['TEXT'];
			$htm .= "<tr $lang><td></td><td></td><td></td><td>$disp_vaft</td><td></td><td>$disp_text</td></tr>\n";
			$disp_text = (empty($args['database']['T_BOOKSSTANDARD'][$key]) ? '' : $args['database']['T_BOOKSSTANDARD'][$key]['TEXT']);
			$htm .= "<tr class='notranslate'><td></td><td></td><td></td><td></td><td></td><td class='notranslate'>$disp_text</td></tr>\n";
		}
		$prev = $verse;
		++$CUSTO;
	}
	$htm .= "</table>\n";
	$htm .= "<? } ?>\n";
	
	
	
	// loop reversification
	$htm .= "<? if(empty(\$_GET) || !empty(\$_GET['rev'])) { ?>\n";
	$htm .= "<br /><br /><br /><a name='rev'><b>PLEASE HELP CONFIRM THE RE-VERSIFICATIONS BELOW</b><br />\n";
	$htm .= "<br />\n<table cellpadding='3'>\n<tr><td>INDEX</td><td>BOOK</td><td>CHAP</td><td>VERS</td><td>TEXT</td></tr>\n";
	$htm .= "<? if(empty(\$_GET) || \$_GET['rev']!=3) { ?>\n";
	$verse_last = $reverse_last = NULL;
	$current_last = 1000;
	$BOOK_OT = $BOOK_NT = $CHAP_TOTAL = $VERS_TOTAL = $VERS_AION = $VERS_QUES = $LONG = $CHAP_NO = $VERS_NO = $VERS_EX = $CHAP_RE = $REVE_NO = $REVE_EX = 0;
	foreach($database['T_BIBLE'] as $verse) {

		// calculate counts
		++$VERS_TOTAL;
		if (preg_match('/ [gh]{1}[0-9]{2,4}\)/ui', $verse['TEXT'])) { ++$VERS_AION; }
		if (preg_match('/\(questioned/ui', $verse['TEXT'])) { ++$VERS_QUES; }
		$islong = FALSE;
		$aalong = "LONG";
		if (mb_strlen($verse['TEXT'])>=500) { $islong = TRUE; ++$LONG; }
		$extra = $re_versed_missing_verse_previous = $re_versed_missing_verse_current = 0;
		$verse_same = ($verse_last == $reverse_last ? TRUE : FALSE);
		if (empty($args['database']['T_BOOKSSTANDARD'][$verse['BOOK']."-".$verse['CHAPTER']."-".$verse['VERSE']])) { $extra = 1; ++$VERS_EX; }
		if ("Holy-Bible---English---Aionian-Bible"==$bible && !$islong) {
			$long_len = mb_strlen($verse['TEXT']);
			$tempref = $verse['BOOK']."-".$verse['CHAPTER']."-".$verse['VERSE'];
			$long_len2 = mb_strlen((isset($args['database']['T_ABCOMPAREBIBLE'][$tempref]['TEXT']) ? $args['database']['T_ABCOMPAREBIBLE'][$tempref]['TEXT'] : "VERSE TEXT NOT FOUND FOR $tempref"));
			//if ($long_len > ($long_len2 * 1.3)) { $islong = TRUE; ++$LONG; $aalong = "LONG-".(int)(($long_len/$long_len2)*100); }
			if ($long_len - $long_len2 > 40) { $islong = TRUE; ++$LONG; $aalong = "LONG-".(int)($long_len - $long_len2); }
		}
		if (!$verse_last || $verse['BOOK'] != $verse_last['BOOK']) { if ((int)$verse['INDEX']<=39) { ++$BOOK_OT; } else { ++$BOOK_NT; } }
		if (!$verse_last || $verse['BOOK'] != $verse_last['BOOK'] || $verse['CHAPTER'] != $verse_last['CHAPTER']) { ++$CHAP_TOTAL; }
		if (((!$verse_last || $verse['BOOK'] != $verse_last['BOOK']) && (int)$verse['CHAPTER']!=1) ||
			($verse_last && $verse['BOOK'] == $verse_last['BOOK'] && (int)$verse['CHAPTER'] <= (int)$args['database']['T_BOOKSCOUNT'][$verse['BOOK']]['CHAPTER'] && (int)$verse['CHAPTER'] > (int)$verse_last['CHAPTER']+1) ||
			($verse_last && $verse['BOOK'] != $verse_last['BOOK'] && (int)$verse_last['CHAPTER'] != (int)$args['database']['T_BOOKSCOUNT'][$verse_last['BOOK']]['CHAPTER'])) {
			AION_ECHO("WARN! WARN! WARN! CHAPTER MISSING! Bible=$bible Book=".$verse['BOOK']." Chapter=".$verse['CHAPTER']);
			++$CHAP_NO;	
		}
		if ($verse_last && ($verse['BOOK'] != $verse_last['BOOK'] || $verse['CHAPTER'] != $verse_last['CHAPTER'])) {
			for($x=1; $x<=32; ++$x) {
				if (!empty($args['database']['T_BOOKSSTANDARD'][$verse_last['BOOK']."-".$verse_last['CHAPTER']."-".sprintf('%03d',(int)$verse_last['VERSE']+$x)])) {
					++$VERS_NO;
					if ($verse_same) { ++$re_versed_missing_verse_previous; }
				}
			}
		}
		if (((!$verse_last || $verse['BOOK'] != $verse_last['BOOK'] || $verse['CHAPTER'] != $verse_last['CHAPTER']) && (int)$verse['VERSE']!=1) ||
			($verse_last && $verse['BOOK'] == $verse_last['BOOK'] && $verse['CHAPTER'] == $verse_last['CHAPTER'] && (int)$verse['CHAPTER'] > (int)$verse_last['CHAPTER']+1)) {
			++$VERS_NO;	
			if ($verse_same) { $re_versed_missing_verse_current = 1; }
		}

		// chapter re-versed? then proof it
		if ((!empty($booksandchaps['HEBREW'])) ||
			(!empty($booksandchaps['XPSA']) && $verse['BOOK']=='PSA' && (int)$verse['CHAPTER']>=9 && (int)$verse['CHAPTER']<=147) ||
			(!empty($booksandchaps['XALB']) && (((int)$verse['INDEX']==47 && (int)$verse['CHAPTER']>=13) || (int)$verse['INDEX']>=48))  ||
			(!empty($booksandchaps['XJER']) && $verse['BOOK']=='JER') || // problems not fixed in this case
			!empty($booksandchaps[$verse['BOOK'].'-'.$verse['CHAPTER']])) {

			// calculate re-versed counts
			$REVE_EX += $extra;
			$REVE_NO += ($re_versed_missing_verse_previous + $re_versed_missing_verse_current);
			if (!$reverse_last || $verse['BOOK'] != $reverse_last['BOOK'] || (int)$verse['CHAPTER'] != (int)$reverse_last['CHAPTER']) { ++$CHAP_RE; }

			// display missing and kjv chapter for previous re-versed chapter!
			for($x=$re_versed_missing_verse_previous; $x>0; --$x) { $htm .= "<tr><td></td><td></td><td></td><td></td><td>MISSING</td></tr>\n"; }
			if ($reverse_last && ($verse['BOOK'] != $reverse_last['BOOK'] || (int)$verse['CHAPTER'] != (int)$reverse_last['CHAPTER'])) {
				$htm .= "<tr class='notranslate'><td>KJV</td><td></td><td></td><td></td><td></td></tr>\n";
				$last = $strike = 0;
				for($x=1; $x<=177; ++$x) { if (empty($args['database']['T_BOOKSSTANDARD'][$reverse_last['BOOK']."-".$reverse_last['CHAPTER']."-".sprintf('%03d', (int)$x)])) { if (++$strike>17) { break; } } else { $last = $x; } }
				if (!$yohebrew) {	$kjv_array = array("X1"=>1,"X2"=>2,"X3"=>3,"X".($last-2)=>$last-2,"X".($last-1)=>$last-1); }
				else { 				$kjv_array = array(); }
				$kjv_array["X".($last-0)] = $last-0;
				foreach($kjv_array as $x) {
					if ($x<=0 || empty($args['database']['T_BOOKSSTANDARD'][$reverse_last['BOOK']."-".$reverse_last['CHAPTER']."-".sprintf('%03d', (int)$x)])) { continue; }
					$verse_kjv = $args['database']['T_BOOKSSTANDARD'][$reverse_last['BOOK']."-".$reverse_last['CHAPTER']."-".sprintf('%03d', (int)$x)];
					$disp_indx = ($x==1 ? $verse_kjv['INDEX']   : "");
					$disp_book = ($x==1 ? $verse_kjv['BOOK']    : "");
					$disp_chap = ($x==1 ? $verse_kjv['CHAPTER'] : "");
					$disp_vers = $verse_kjv['VERSE'];
					$disp_text = $verse_kjv['TEXT'];
					$htm .= "<tr class='notranslate'><td>$disp_indx</td><td>$disp_book</td><td>$disp_chap</td><td>$disp_vers</td><td class='notranslate'>$disp_text</td></tr>\n";
				}
			}
			
			// okay break up long pages here!
			if ($CHAP_RE > 120) {	$htm .= "<? } if(empty(\$_GET) || \$_GET['rev']!=2) { ?>\n"; }

			// display missing and the chapter verse!
			$disp_indx = $disp_book = $disp_chap = "";
			if ($islong || !$reverse_last || $verse['BOOK'] != $reverse_last['BOOK'] || $verse['CHAPTER'] != $reverse_last['CHAPTER']) {
				$disp_indx = $verse['INDEX'];
				$disp_chap = $verse['CHAPTER'];
				$disp_book = "<a href='/Bibles/$biblename/".array_search($verse['BOOK'],$args['database']['T_BOOKS']['CODE'])."/".(int)$disp_chap."/parallel-English---King-James-Version' target='_blank'>".$verse['BOOK']."</a>";
				$disp_book .= " <a href='https://translate.google.com/translate?".$lang2."&tl=en&u=http%3A%2F%2Fstage.aionianbible.org/Bibles/$biblename/".array_search($verse['BOOK'],$args['database']['T_BOOKS']['CODE'])."/".(int)$disp_chap."/parallel-English---King-James-Version' target='_blank'>G</a>";
				if ($yohebrew) {
					$current_last = $strike = 0;
					for($x=1; $x<=177; ++$x) { if (empty($database['T_BIBLE'][$verse['BOOK']."-".$verse['CHAPTER']."-".sprintf('%03d', (int)$x)])) { if (++$strike>17) { break; } } else { $current_last = $x; } }
				}
			}
			else if ($extra) { $disp_chap = "EXTRA"; }
			$disp_vers = $verse['VERSE'];
			$disp_text = $verse['TEXT'];
			if ($islong) { $htm .= "<tr><td>LONG</td><td></td><td></td><td></td><td></td></tr>\n"; }
			if (!empty($disp_indx)) { $htm .= "<tr><td>OK?</td><td>$disp_book</td><td>$disp_chap</td><td></td><td></td></tr>\n"; }
			if ($re_versed_missing_verse_current) { $htm .= "<tr><td></td><td></td><td></td><td></td><td>MISSING</td></tr>\n"; }
			if ($yohebrew && !$islong && !$re_versed_missing_verse_current && $disp_vers<$current_last) { ; }
			else { $htm .= "<tr $lang><td>$disp_indx</td><td>$disp_book</td><td>$disp_chap</td><td>$disp_vers</td><td>$disp_text</td></tr>\n"; }
			
			// mark this last successful re-versed verse
			$reverse_last = $verse;
		}
		// lonely long verse found!
		else if ($islong) {
			$disp_indx = $verse['INDEX'];
			$disp_chap = $verse['CHAPTER'];
			$disp_book = "<a href='/Bibles/$biblename/".array_search($verse['BOOK'],$args['database']['T_BOOKS']['CODE'])."/".(int)$disp_chap."/parallel-English---King-James-Version' target='_blank'>".$verse['BOOK']."</a>";
			$disp_book .= " <a href='https://translate.google.com/translate?".$lang2."&tl=en&u=http%3A%2F%2Fstage.aionianbible.org/Bibles/$biblename/".array_search($verse['BOOK'],$args['database']['T_BOOKS']['CODE'])."/".(int)$disp_chap."/parallel-English---King-James-Version' target='_blank'>G</a>";
			$disp_vers = $verse['VERSE'];
			$disp_text = $verse['TEXT'];
			$htm .= "<tr><td>$aalong</td><td></td><td></td><td></td><td></td></tr>\n";
			$htm .= "<tr $lang><td>$disp_indx</td><td>$disp_book</td><td>$disp_chap</td><td>$disp_vers</td><td>$disp_text</td></tr>\n";
			$tempref = $verse['BOOK']."-".$verse['CHAPTER']."-".$verse['VERSE'];
			$htm .= "<tr class='notranslate'><td></td><td></td><td></td><td>KJV</td><td class='notranslate'>".(isset($args['database']['T_ABCOMPAREBIBLE'][$tempref]['TEXT']) ? $args['database']['T_ABCOMPAREBIBLE'][$tempref]['TEXT'] : "VERSE TEXT NOT FOUND FOR $tempref")."</td></tr>\n";
		}
		// mark this last verse accessed
		$verse_last = $verse;
	}
	// Last time... display kjv chapter for last re-versed chapter!
	if ($reverse_last) {
		$htm .= "<tr class='notranslate'><td>KJV</td><td></td><td></td><td></td><td></td></tr>\n";
		$last = $strike = 0;
		for($x=1; $x<=177; ++$x) { if (empty($args['database']['T_BOOKSSTANDARD'][$reverse_last['BOOK']."-".$reverse_last['CHAPTER']."-".sprintf('%03d', (int)$x)])) { if (++$strike>5) { break; } } else { $last = $x; } }
		foreach(array(1,2,$last-1,$last) as $x) {
			if ($last<=0) { continue; }
			$verse_kjv = $args['database']['T_BOOKSSTANDARD'][$reverse_last['BOOK']."-".$reverse_last['CHAPTER']."-".sprintf('%03d', (int)$x)];
			$disp_indx = ($x==1 ? $verse_kjv['INDEX']   : "");
			$disp_book = ($x==1 ? $verse_kjv['BOOK']    : "");
			$disp_chap = ($x==1 ? $verse_kjv['CHAPTER'] : "");
			$disp_vers = $verse_kjv['VERSE'];
			$disp_text = $verse_kjv['TEXT'];
			$htm .= "<tr class='notranslate'><td>$disp_indx</td><td>$disp_book</td><td>$disp_chap</td><td>$disp_vers</td><td class='notranslate'>$disp_text</td></tr>\n";
		}
	}
	// wrap up
	$htm .= "<? } ?>\n";
	$htm .= "</table>\n";
	$htm .= "<? } ?>\n";
	$htm .= "</body>\n</html>\n";
	if (!file_put_contents($newfile, $htm)) { AION_ECHO("ERROR! HTM Debug file problem: $newfile"); }
	unset($htm);
	$note = (empty($args['database']['T_VERSIONS'][$bible]['NOTE']) ? "" : $args['database']['T_VERSIONS'][$bible]['NOTE']);
	$note .= (empty($args['database']['T_VERSIONS'][$bible]['NEW']) ? "" : ",".$args['database']['T_VERSIONS'][$bible]['NEW']);
	$rowback = (empty($args['database']['T_VERSIONS'][$bible]['NEW']) ? "" : ($args['database']['T_VERSIONS'][$bible]['NEW']=='Y136' ? "bgcolor='#f2dcdb'" : "bgcolor='#ebf1de'"));
	static $bible_count = 0;	++$bible_count;
	static $lang_count = 0;		static $lang_last = NULL; if ($lang_last != $lang) { $lang_last=$lang; ++$lang_count;}
	$args['grandtotal']['BIBLE_COUNT']	= $bible_count;
	$args['grandtotal']['LANG_COUNT']	= $lang_count;
	$args['grandtotal']['BOOK_OT']		+= $BOOK_OT;
	$args['grandtotal']['BOOK_NT']		+= $BOOK_NT;
	$args['grandtotal']['CHAP_TOTAL']	+= $CHAP_TOTAL;
	$args['grandtotal']['VERS_TOTAL']	+= $VERS_TOTAL;
	$args['grandtotal']['VERS_AION']	+= $VERS_AION;
	$args['grandtotal']['VERS_QUES']	+= $VERS_QUES;
	$args['grandtotal']['LONG']			+= $LONG;
	$args['grandtotal']['CHAP_NO']		+= $CHAP_NO;
	$args['grandtotal']['VERS_NO']		+= $VERS_NO;
	$args['grandtotal']['VERS_EX']		+= $VERS_EX;
	$args['grandtotal']['FIXED']		+= $FIXED;
	$args['grandtotal']['NOTFIXED']		+= $NOTFIXED;
	$args['grandtotal']['CHAP_RE']		+= $CHAP_RE;
	$args['grandtotal']['REVE_NO']		+= $REVE_NO;
	$args['grandtotal']['REVE_EX']		+= $REVE_EX;
	$args['grandtotal']['CUSTO']		+= $CUSTO;
	$args['grandtotal']['PDFPA']		+= $PDFPA;
	$args['grandtotal']['PDFPN']		+= $PDFPN;
	$args['grandtotal']['PDFPI']		+= $PDFPI;
	$args['grandtotal']['TRANS']		+= ($ISGOOD != "GOOD" ? 1 : 0);
	$LONG = ($LONG == 0 ? $LONG : "<span style='font-weight:bold; color:red;'>$LONG</span>" );
	$CHAP_NO = ($CHAP_NO == 0 ? $CHAP_NO : "<span style='font-weight:bold; color:red;'>$CHAP_NO</span>" );
	$VERS_NO = ($VERS_NO == 0 ? $VERS_NO : "<span style='font-weight:bold; color:red;'>$VERS_NO</span>" );
	$VERS_EX = ($VERS_EX == 0 ? $VERS_EX : "<span style='font-weight:bold; color:red;'>$VERS_EX</span>" );
	$NOTFIXED = ($NOTFIXED == 0 ? $NOTFIXED : "<span style='font-weight:bold; color:red;'>$NOTFIXED</span>" );
	$REVE_NO = ($REVE_NO == 0 ? $REVE_NO : "<span style='font-weight:bold; color:red;'>$REVE_NO</span>" );
	$REVE_EX = ($REVE_EX == 0 ? $REVE_EX : "<span style='font-weight:bold; color:red;'>$REVE_EX</span>" );
	$PDFPA = ($PDFPA <= 0 ? "" : ($PDFPA <= 800 ? $PDFPA : "<span style='font-weight:bold; color:red;'>$PDFPA</span>"));
	$PDFPN = ($PDFPN <= 0 ? "" : ($PDFPN <= 400 ? $PDFPN : "<span style='font-weight:bold; color:red;'>$PDFPN</span>"));
	$PDFPIF = sprintf("%.2f",$PDFPI);
	$PDFPIF = ($PDFPI <= 0 ? "" : ($PDFPI <= 18 ? $PDFPIF : "<span style='font-weight:bold; color:red;'>$PDFPIF</span>"));
	$ISGOOD = ($ISGOOD == "GOOD" ? "ok" : "<span style='font-weight:bold; color:red;'>sos</span>" );
	strtok($args['database']['T_VERSIONS'][$bible]['SOURCELINK'],'/.');
	$SOURCE = "<a href='".$args['database']['T_VERSIONS'][$bible]['SOURCELINK']."' target='_blank'>".substr(strtok('/.'),0,3)."</a>";
	// init
	$PDF_PKDP = $PDF_PLUL = $PDF_PKNT = $PDF_PLNT = $PDF_PLHC = $PDF_PRTL = "";
	$PROBPDF = 0;
	// POD PDF exist?
	$pod_kdp_reg = (filenotzero("../www-stageresources/$bible---POD_KDP_ALL_COVER.pdf")		&& filenotzero("../www-stageresources/$bible---POD_KDP_ALL_BODY.pdf")	? "" : "<span style='font-weight:bold; color:red;'>*?</span>");
	$pod_kdp_new = (filenotzero("../www-stageresources/$bible---POD_KDP_NEW_COVER.pdf")		&& filenotzero("../www-stageresources/$bible---POD_KDP_NEW_BODY.pdf")	? "" : "<span style='font-weight:bold; color:red;'>*?</span>");
	$pod_luu_reg = (filenotzero("../www-stageresources/$bible---POD_LULU_ALL_COVER.pdf")	&& filenotzero("../www-stageresources/$bible---POD_LULU_ALL_BODY.pdf")	? "" : "<span style='font-weight:bold; color:red;'>*?</span>");
	$pod_luu_new = (filenotzero("../www-stageresources/$bible---POD_LULU_NEW_COVER.pdf")	&& filenotzero("../www-stageresources/$bible---POD_LULU_NEW_BODY.pdf")	? "" : "<span style='font-weight:bold; color:red;'>*?</span>");
	$pod_luu_har = (filenotzero("../www-stageresources/$bible---POD_LULU_HAR_COVER.pdf")	&& filenotzero("../www-stageresources/$bible---POD_LULU_HAR_BODY.pdf")	? "" : "<span style='font-weight:bold; color:red;'>*?</span>");

	// PDF Priority
	if ($args['database']['T_FORPRINT'][$bible]['YESKDP']!='TRUE') {
		$PDF_PRTL="noK";
		$args['grandtotal']['PDF_PRTL'] += 1;
	}
	if (!empty($args['database']['T_FORPRINT'][$bible]['NOPDO'])) {
		if (empty($pod_kdp_reg)||empty($pod_kdp_new)||empty($pod_luu_reg)||empty($pod_luu_new)||empty($pod_luu_har)) { $PDF_PRTL="no<span style='font-weight:bold; color:red;'>*?</span>"; ++$PROBPDF; }
		else { $PDF_PRTL="noP"; }
		$args['grandtotal']['PDF_PRTL'] += 1;
	}
	else {
		// KDP Full *********************************************
		$alink = ($args['database']['T_VERSIONS'][$bible]['AMAZON']=='NULL' ? "" : "<a href='https://www.amazon.com/dp/".$args['database']['T_VERSIONS'][$bible]['AMAZON']."' target='_blank'>Buy*</a>");
		// YES KDP and YES FORSALE
		if ($args['database']['T_VERSIONS'][$bible]['AMAZON']!='NULL' && $args['database']['T_FORPRINT'][$bible]['YESKDP']=='TRUE')  {
			if (!empty($pod_kdp_reg)) { ++$PROBPDF; } // File not found
			$args['grandtotal']['PDF_PKDP'] += 1; $PDF_PKDP="<a href='https://www.amazon.com/dp/".$args['database']['T_VERSIONS'][$bible]['AMAZON']."' target='_blank'>Buy</a>$pod_kdp_reg"; }
		// YES KDP but NO FORSALE - PROB
		else if ($args['database']['T_FORPRINT'][$bible]['YESKDP']=='TRUE')  {
			++$PROBPDF;
			$args['grandtotal']['PDF_PKDP'] += 1; $PDF_PKDP="<span style='font-weight:bold; color:red;'>Buy</span>$pod_kdp_reg"; }
		// NO KPD but FORSALE from CREATESPACE	
		else if ($args['database']['T_VERSIONS'][$bible]['AMAZON']!='NULL' && empty($pod_kdp_reg))  { $PDF_PKDP=$alink; }
		// NO KPD but FORSALE WHY? - PROB
		else if ($args['database']['T_VERSIONS'][$bible]['AMAZON']!='NULL')  { $PDF_PKDP="<span style='font-weight:bold; color:red;'>$alink</span>"; ++$PROBPDF; }
		else if (empty($pod_kdp_reg)) { $PDF_PKDP="File"; }
		// KDP NT **********************************************
		$alink = ($args['database']['T_VERSIONS'][$bible]['AMAZONNT']=='NULL' ? "" : "<a href='https://www.amazon.com/dp/".$args['database']['T_VERSIONS'][$bible]['AMAZONNT']."' target='_blank'>Buy*</a>");
		// YES KDP and YES FORSALE
		if ($args['database']['T_VERSIONS'][$bible]['AMAZONNT']!='NULL' && $args['database']['T_FORPRINT'][$bible]['YESKDP']=='TRUE' && $args['database']['T_FORPRINT'][$bible]['YESNEW']=='TRUE')  {
			if (!empty($pod_kdp_new)) { ++$PROBPDF; }
			$args['grandtotal']['PDF_PKNT'] += 1; $PDF_PKNT="<a href='https://www.amazon.com/dp/".$args['database']['T_VERSIONS'][$bible]['AMAZONNT']."' target='_blank'>Buy</a>$pod_kdp_new"; }
		// YES KDP but NO FORSALE - PROB		
		else if ($args['database']['T_FORPRINT'][$bible]['YESNEW']=='TRUE' && $args['database']['T_FORPRINT'][$bible]['YESKDP']=='TRUE')  {
			++$PROBPDF;
			$args['grandtotal']['PDF_PKNT'] += 1; $PDF_PKNT="<span style='font-weight:bold; color:red;'>Buy</span>$pod_kdp_new"; }
		// NO KPD but FORSALE from CREATESPACE	
		else if ($args['database']['T_VERSIONS'][$bible]['AMAZONNT']!='NULL' && empty($pod_kdp_new))  { $PDF_PKNT=$alink; }
		// NO KPD but FORSALE WHY? - PROB
		else if ($args['database']['T_VERSIONS'][$bible]['AMAZONNT']!='NULL')  { $PDF_PKNT="<span style='font-weight:bold; color:red;'>$alink</span>"; ++$PROBPDF; }
		else if (empty($pod_kdp_new)) { $PDF_PKNT="File"; }

		// Lulu Full *********************************************
		// PROBLEM
		if (0&(
			($args['database']['T_VERSIONS'][$bible]['LULU']=="NULL" && empty($pod_luu_reg)) ||
			($args['database']['T_VERSIONS'][$bible]['LULU']=="NULL" && !empty($args['database']['T_FORPRINT'][$bible]['ISBNLU'])) ||
			($args['database']['T_VERSIONS'][$bible]['LULU']!="NULL" && !empty($pod_luu_reg)) ||
			($args['database']['T_VERSIONS'][$bible]['LULU']!="NULL" && empty($args['database']['T_FORPRINT'][$bible]['ISBNLU'])) ||
			(empty($args['database']['T_FORPRINT'][$bible]['ISBNLU']) && empty($pod_luu_reg)) ||
			(!empty($args['database']['T_FORPRINT'][$bible]['ISBNLU']) && !empty($pod_luu_reg)))) {
			$PDF_PLUL="<span style='font-weight:bold; color:red;'>=?</span>"; ++$PROBPDF; }
		// YES LULU
		else if ($args['database']['T_VERSIONS'][$bible]['LULU']!='NULL')  {
			if (!empty($pod_luu_reg)) { ++$PROBPDF; }
			$args['grandtotal']['PDF_PLUL'] += 1; $PDF_PLUL="<a href='$lulu_regu' target='_blank'>Buy</a>$pod_luu_reg"; }
		// TODO LULU
		else if (!empty($args['database']['T_FORPRINT'][$bible]['ISBNLU'])) {
			++$PROBPDF; $args['grandtotal']['PDF_PLUL'] += 1; $PDF_PLUL="<span style='font-weight:bold; color:red;'>Buy</span>"; }
		else if (empty($pod_luu_reg)) {
			++$PROBPDF; $args['grandtotal']['PDF_PLUL'] += 1; $PDF_PLUL="<span style='font-weight:bold; color:red;'>File</span>"; }
		// Lulu NT *********************************************
		// PROBLEM
		if (0&(
			($args['database']['T_VERSIONS'][$bible]['LULUNT']=="NULL" && empty($pod_luu_new)) ||
			($args['database']['T_VERSIONS'][$bible]['LULUNT']=="NULL" && !empty($args['database']['T_FORPRINT'][$bible]['ISBNLUNT'])) ||
			($args['database']['T_VERSIONS'][$bible]['LULUNT']!="NULL" && !empty($pod_luu_new)) ||
			($args['database']['T_VERSIONS'][$bible]['LULUNT']!="NULL" && empty($args['database']['T_FORPRINT'][$bible]['ISBNLUNT'])) ||
			(empty($args['database']['T_FORPRINT'][$bible]['ISBNLUNT']) && empty($pod_luu_new)) ||
			(!empty($args['database']['T_FORPRINT'][$bible]['ISBNLUNT']) && !empty($pod_luu_new)))) {
			$PDF_PLNT="<span style='font-weight:bold; color:red;'>=?</span>"; ++$PROBPDF; }
		// YES LULU
		else if ($args['database']['T_VERSIONS'][$bible]['LULUNT']!='NULL')  {
			if (!empty($pod_luu_new)) { ++$PROBPDF; }
			$args['grandtotal']['PDF_PLNT'] += 1; $PDF_PLNT="<a href='$lulu_ntnt' target='_blank'>Buy</a>$pod_luu_new"; }
		// TODO LULU
		else if (!empty($args['database']['T_FORPRINT'][$bible]['ISBNLUNT'])) {
			++$PROBPDF; $args['grandtotal']['PDF_PLNT'] += 1; $PDF_PLNT="<span style='font-weight:bold; color:red;'>Buy</span>"; }
		else if (empty($pod_luu_new)) {
			++$PROBPDF; $args['grandtotal']['PDF_PLNT'] += 1; $PDF_PLNT="<span style='font-weight:bold; color:red;'>File</span>"; }
		// Lulu HARD *********************************************
		// PROBLEM
		if (0&(
			($args['database']['T_VERSIONS'][$bible]['LULUHARD']=="NULL" && empty($pod_luu_har)) ||
			($args['database']['T_VERSIONS'][$bible]['LULUHARD']=="NULL" && !empty($args['database']['T_FORPRINT'][$bible]['ISBNLUHARD'])) ||
			($args['database']['T_VERSIONS'][$bible]['LULUHARD']!="NULL" && !empty($pod_luu_har)) ||
			($args['database']['T_VERSIONS'][$bible]['LULUHARD']!="NULL" && empty($args['database']['T_FORPRINT'][$bible]['ISBNLUHARD'])) ||
			(empty($args['database']['T_FORPRINT'][$bible]['ISBNLUHARD']) && empty($pod_luu_har)) ||
			(!empty($args['database']['T_FORPRINT'][$bible]['ISBNLUHARD']) && !empty($pod_luu_har)))) {
			$PDF_PLHC="<span style='font-weight:bold; color:red;'>=?</span>"; ++$PROBPDF; }
		// YES LULU
		else if ($args['database']['T_VERSIONS'][$bible]['LULUHARD']!='NULL')  {
			if (!empty($pod_luu_har)) { ++$PROBPDF; }
			$args['grandtotal']['PDF_PLHC'] += 1; $PDF_PLHC="<a href='$lulu_hard' target='_blank'>Buy</a>$pod_luu_har"; }
		// TODO LULU
		else if (!empty($args['database']['T_FORPRINT'][$bible]['ISBNLUHARD'])) {
			++$PROBPDF; $args['grandtotal']['PDF_PLHC'] += 1; $PDF_PLHC="<span style='font-weight:bold; color:red;'>Buy</span>"; }
		else if (empty($pod_luu_har)) {
			++$PROBPDF; $args['grandtotal']['PDF_PLHC'] += 1; $PDF_PLHC="<span style='font-weight:bold; color:red;'>File</span>"; }
	}
	$args['grandtotal']['PROBPDF'] += $PROBPDF;
	
	$args['debug'].= "<tr {$rowback}><td><a href='/Bibles/$biblename/parallel-English---King-James-Version' target='_blank'>$biblename</a></td><td><a href='/library/$bible.php' target='_blank'>p</a></td><td>$SOURCE</td><td>$note</td><td>$bible_count</td><td>$lang_count</td><td>$BOOK_OT</td><td>$BOOK_NT</td><td>$CHAP_TOTAL</td><td>$VERS_TOTAL</td><td>$VERS_AION</td><td>$VERS_QUES</td><td>$LONG</td><td>$CHAP_NO</td><td>$VERS_NO</td><td>$VERS_EX</td><td>$FIXED</td><td>$NOTFIXED</td><td>$CHAP_RE</td><td>$REVE_NO</td><td>$REVE_EX</td><td>$CUSTO</td><td>$PDFPA</td><td>$PDFPN</td><td>$PDFPIF</td><td>$PDF_PKDP</td><td>$PDF_PKNT</td><td>$PDF_PLUL</td><td>$PDF_PLNT</td><td>$PDF_PLHC</td><td>$PDF_PRTL</td><td>$ISGOOD</td></tr>\n";
	
	if (!($bible_count % 20)) {
		$args['debug'].="<tr><td>BIBLE</td><td>P</td><td>S</td><td>NOT</td><td>B#</td><td>LAN</td><td>OLD</td><td>NEW</td><td>CHP</td><td>VER</td><td>AIO</td><td>QUE</td><td>LON</td><td>CMI</td><td>VMI</td><td>VXT</td><td>VFI</td><td>NOF</td><td>CMA</td><td>VMI</td><td>VME</td><td>CUS</td><td>PAG</td><td>PAN</td><td>PRI</td><td>KDP</td><td>KNT</td><td>LUL</td><td>LNT</td><td>LHC</td><td>WAT</td><td>STA</td></tr>\n";
	}	
	
	AION_unset($booksandchaps); $booksandchaps=NULL; unset($booksandchaps);
	AION_unset($database); $database=NULL; unset($database);	
	AION_ECHO("SUCCESS MAKE DEBUG HTM ".$newfile);
}




/*** aion image verses loop ***/
function AION_PDF_PAGECOUNT($filename) {
	if (!file_exists($filename)) { return 0; }
	if (!($result = system("pdftk $filename dump_data_utf8 | grep NumberOfPages"))) return 0;
	return intval(preg_replace('/[^0-9]/', '', $result));
}



/*** aion OT Only? ***/
function AION_LOOP_HTMS_DOIT_OTONLY($bible) {
return(
empty($bible['MAT-001-001']) &&
empty($bible['MAR-001-001']) &&
empty($bible['LUK-001-001']) &&
empty($bible['JOH-001-001']) &&
empty($bible['ACT-001-001']) &&
empty($bible['ROM-001-001']) &&
empty($bible['1CO-001-001']) &&
empty($bible['2CO-001-001']) &&
empty($bible['GAL-001-001']) &&
empty($bible['EPH-001-001']) &&
empty($bible['PHI-001-001']) &&
empty($bible['COL-001-001']) &&
empty($bible['1TH-001-001']) &&
empty($bible['2TH-001-001']) &&
empty($bible['1TI-001-001']) &&
empty($bible['2TI-001-001']) &&
empty($bible['TIT-001-001']) &&
empty($bible['PHM-001-001']) &&
empty($bible['HEB-001-001']) &&
empty($bible['JAM-001-001']) &&
empty($bible['1PE-001-001']) &&
empty($bible['2PE-001-001']) &&
empty($bible['1JO-001-001']) &&
empty($bible['2JO-001-001']) &&
empty($bible['3JO-001-001']) &&
empty($bible['JUD-001-001']) &&
empty($bible['REV-001-001'])
);
}


/*** aion image verses loop ***/
function AION_LOOP_IVERSE($source, $destiny) {
	$database = array();
	AION_FILE_DATA_GET( './aion_database/BOOKS.txt', 'T_BOOKS', $database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/NUMBERS.txt', 'T_NUMBERS', $database, 'BIBLE', FALSE );
	$database['T_IVERSE'] = array();
	$database['T_IVERSE'][] = array(
		'BIBLE'			=> 'BIBLE',
		'REF'			=> 'REFERENCE',
		'TEXT'			=> 'TEXT',
		);
	$database['T_IVERSE2'] = array();
	$database['T_IVERSE2'][] = array(
		'BIBLE'			=> 'DEFAULT',
		'JOH3_16'		=> 'For God so loved the world that he gave his only begotten Son that whoever believes in him should not perish, but have...',
		'JOH3_16_B'		=> 'John 3:16',
		'GEN3_24'		=> 'So he drove out the man; and he placed cherubim at the east of the garden of Eden, and a flaming sword which turned every way, to guard the way to the tree of life.',
		'GEN3_24_B'		=> 'Genesis 3:24',
		'LUK23_34'		=> 'Jesus said, ‘Father, forgive them, for they don’t know what they are doing.’ Dividing his garments among them, they cast lots.',
		'LUK23_34_B'	=> 'Luke 23:34',
		'REV21_2_3'		=> 'I saw the holy city, New Jerusalem, coming down out of heaven from God, prepared like a bride adorned for her husband. I heard a loud voice out of heaven saying, ‘Behold, God’s dwelling is with people, and he will dwell with them, and they will be his people, and God himself will be with them as their God.’',
		'REV21_2_3_B'	=> 'Revelation 21:2-3',
		'HEB11_8'		=> 'By faith, Abraham, when he was called, obeyed to go out to the place which he was to receive for an inheritance. He went out, not knowing where he went.',
		'HEB11_8_B'		=> 'Hebrews 11:8',
		'EXO13_17'		=> 'When Pharaoh had let the people go, God didn’t lead them by the way of the land of the Philistines, although that was near; for God said, ‘Lest perhaps the people change their minds when they see war, and they return to Egypt.’',
		'EXO13_17_B'	=> 'Exodus 13:17',
		'MAR10_45'		=> 'For the Son of Man also came not to be served, but to serve, and to give his life as a ransom for many.',
		'MAR10_45_B'	=> 'Mark 10:45',
		'ROM1_1'		=> 'Paul, a servant of Jesus Christ, called to be an apostle, set apart for the Good News of God.',
		'ROM1_1_B'		=> 'Romans 1:1',
		'MAT28_19'		=> 'Go and make disciples of all nations, baptizing them in the name of the Father and of the Son and of the Holy Spirit.',
		'MAT28_19_B'	=> 'Matthew 28:19',
		);
	AION_LOOP( array(
		'function'	=> 'AION_LOOP_IVERSE_DOIT',
		'source'	=> $source,
		'include'	=> "/---Standard-Edition\.noia$/",
		'database'	=> &$database,
		'destiny'	=> $destiny,
		'book'		=> AION_BIBLES_LIST(),
		) );
	AION_FILE_DATA_PUT($destiny.'/IVERSE.txt',$database['T_IVERSE']);
	AION_FILE_DATA_PUT($destiny.'/IVERSE2.txt',$database['T_IVERSE2']);
	AION_unset($database); $database=NULL; unset($database);
}
function AION_LOOP_IVERSE_DOIT($args) {
	if (!preg_match("/\/(Holy-Bible---.*)---Standard-Edition\.noia/", $args['filepath'], $matches)) { AION_ECHO("ERROR! Failed to preg_match(Holy-Bible): ".$args['filepath']); }
	$bible = $matches[1];
	$database = array();
	AION_FILE_DATA_GET( $args['filepath'], 'T_BIBLE', $database, array('BOOK','CHAPTER','VERSE'), FALSE );
	$missed = 0;
	// IVERSE
	$args['database']['T_IVERSE'][] = array('BIBLE'=>$bible,'IVERSE'=>'JOH-003-016',
	'REF'	=> empty($database['T_BIBLE']['JOH-003-016']['TEXT']) ? NULL : $args['database']['T_BOOKS'][$bible]['John']			.' '.$args['database']['T_NUMBERS'][$bible]['3']	.':'.$args['database']['T_NUMBERS'][$bible]['16'],
	'TEXT'	=> $database['T_BIBLE']['JOH-003-016']['TEXT'] ?? NULL,
	);
	$args['database']['T_IVERSE'][] = array('BIBLE'=>$bible,'IVERSE'=>'GEN-003-024',
	'REF'	=> empty($database['T_BIBLE']['GEN-003-024']['TEXT']) ? NULL : $args['database']['T_BOOKS'][$bible]['Genesis']		.' '.$args['database']['T_NUMBERS'][$bible]['3']	.':'.$args['database']['T_NUMBERS'][$bible]['24'],
	'TEXT'	=> $database['T_BIBLE']['GEN-003-024']['TEXT'] ?? NULL,
	);		
	$args['database']['T_IVERSE'][] = array('BIBLE'=>$bible,'IVERSE'=>'LUK-023-034',	
	'REF'	=> empty($database['T_BIBLE']['LUK-023-034']['TEXT']) ? NULL : $args['database']['T_BOOKS'][$bible]['Luke']			.' '.$args['database']['T_NUMBERS'][$bible]['23']	.':'.$args['database']['T_NUMBERS'][$bible]['34'],
	'TEXT'	=> $database['T_BIBLE']['LUK-023-034']['TEXT'] ?? NULL,
	);		
	$args['database']['T_IVERSE'][] = array('BIBLE'=>$bible,'IVERSE'=>'REV-021-002',
	'REF'	=> empty($database['T_BIBLE']['REV-021-002']['TEXT']) ? NULL : $args['database']['T_BOOKS'][$bible]['Revelation']	.' '.$args['database']['T_NUMBERS'][$bible]['21']	.':'.$args['database']['T_NUMBERS'][$bible]['2'].'-'.$args['database']['T_NUMBERS'][$bible]['3'],
	'TEXT'	=> ($database['T_BIBLE']['REV-021-002']['TEXT'] ?? NULL).' '.($database['T_BIBLE']['REV-021-003']['TEXT'] ?? NULL),
	);
	$args['database']['T_IVERSE'][] = array('BIBLE'=>$bible,'IVERSE'=>'HEB-011-008',		
	'REF'	=> empty($database['T_BIBLE']['HEB-011-008']['TEXT']) ? NULL : $args['database']['T_BOOKS'][$bible]['Hebrews']		.' '.$args['database']['T_NUMBERS'][$bible]['11']	.':'.$args['database']['T_NUMBERS'][$bible]['8'],
	'TEXT'	=> $database['T_BIBLE']['HEB-011-008']['TEXT'] ?? NULL,
	);
	$args['database']['T_IVERSE'][] = array('BIBLE'=>$bible,'IVERSE'=>'EXO-013-017',
	'REF'	=> empty($database['T_BIBLE']['EXO-013-017']['TEXT']) ? NULL : $args['database']['T_BOOKS'][$bible]['Exodus']		.' '.$args['database']['T_NUMBERS'][$bible]['13']	.':'.$args['database']['T_NUMBERS'][$bible]['17'],
	'TEXT'	=> $database['T_BIBLE']['EXO-013-017']['TEXT'] ?? NULL,
	);
	$args['database']['T_IVERSE'][] = array('BIBLE'=>$bible,'IVERSE'=>'MAR-010-045',
	'REF'	=> empty($database['T_BIBLE']['MAR-010-045']['TEXT']) ? NULL : $args['database']['T_BOOKS'][$bible]['Mark']			.' '.$args['database']['T_NUMBERS'][$bible]['10']	.':'.$args['database']['T_NUMBERS'][$bible]['45'],
	'TEXT'	=> $database['T_BIBLE']['MAR-010-045']['TEXT'] ?? NULL,
	);
	$args['database']['T_IVERSE'][] = array('BIBLE'=>$bible,'IVERSE'=>'ROM-001-001',		
	'REF'	=> empty($database['T_BIBLE']['ROM-001-001']['TEXT']) ? NULL : $args['database']['T_BOOKS'][$bible]['Romans']		.' '.$args['database']['T_NUMBERS'][$bible]['1']	.':'.$args['database']['T_NUMBERS'][$bible]['1'],
	'TEXT'	=> $database['T_BIBLE']['ROM-001-001']['TEXT'] ?? NULL,
	);
	$args['database']['T_IVERSE'][] = array('BIBLE'=>$bible,'IVERSE'=>'MAT-028-019',
	'REF'	=> empty($database['T_BIBLE']['MAT-028-019']['TEXT']) ? NULL : $args['database']['T_BOOKS'][$bible]['Matthew']		.' '.$args['database']['T_NUMBERS'][$bible]['28']	.':'.$args['database']['T_NUMBERS'][$bible]['19'],
	'TEXT'	=> $database['T_BIBLE']['MAT-028-019']['TEXT'] ?? NULL,
	);
	//IVERSE2
	$args['database']['T_IVERSE2'][]  = array(
	'BIBLE'			=> $bible,
	'JOH3_16'		=> $database['T_BIBLE']['JOH-003-016']['TEXT'] ?? NULL,
	'JOH3_16_B'		=> empty($database['T_BIBLE']['JOH-003-016']['TEXT']) ? NULL : $args['database']['T_BOOKS'][$bible]['John']			.' '.$args['database']['T_NUMBERS'][$bible]['3']	.':'.$args['database']['T_NUMBERS'][$bible]['16'],
	'GEN3_24'		=> $database['T_BIBLE']['GEN-003-024']['TEXT'] ?? NULL,
	'GEN3_24_B'		=> empty($database['T_BIBLE']['GEN-003-024']['TEXT']) ? NULL : $args['database']['T_BOOKS'][$bible]['Genesis']		.' '.$args['database']['T_NUMBERS'][$bible]['3']	.':'.$args['database']['T_NUMBERS'][$bible]['24'],
	'LUK23_34'		=> $database['T_BIBLE']['LUK-023-034']['TEXT'] ?? NULL,			
	'LUK23_34_B'	=> empty($database['T_BIBLE']['LUK-023-034']['TEXT']) ? NULL : $args['database']['T_BOOKS'][$bible]['Luke']			.' '.$args['database']['T_NUMBERS'][$bible]['23']	.':'.$args['database']['T_NUMBERS'][$bible]['34'],
	'REV21_2_3'		=> ($database['T_BIBLE']['REV-021-002']['TEXT'] ?? NULL).' '.($database['T_BIBLE']['REV-021-003']['TEXT'] ?? NULL),			
	'REV21_2_3_B'	=> empty($database['T_BIBLE']['REV-021-002']['TEXT']) ? NULL : $args['database']['T_BOOKS'][$bible]['Revelation']	.' '.$args['database']['T_NUMBERS'][$bible]['21']	.':'.$args['database']['T_NUMBERS'][$bible]['2'].'-'.$args['database']['T_NUMBERS'][$bible]['3'],
	'HEB11_8'		=> $database['T_BIBLE']['HEB-011-008']['TEXT'] ?? NULL,	
	'HEB11_8_B'		=> empty($database['T_BIBLE']['HEB-011-008']['TEXT']) ? NULL : $args['database']['T_BOOKS'][$bible]['Hebrews']		.' '.$args['database']['T_NUMBERS'][$bible]['11']	.':'.$args['database']['T_NUMBERS'][$bible]['8'],
	'EXO13_17'		=> $database['T_BIBLE']['EXO-013-017']['TEXT'] ?? NULL,	
	'EXO13_17_B'	=> empty($database['T_BIBLE']['EXO-013-017']['TEXT']) ? NULL : $args['database']['T_BOOKS'][$bible]['Exodus']		.' '.$args['database']['T_NUMBERS'][$bible]['13']	.':'.$args['database']['T_NUMBERS'][$bible]['17'],
	'MAR10_45'		=> $database['T_BIBLE']['MAR-010-045']['TEXT'] ?? NULL,	
	'MAR10_45_B'	=> empty($database['T_BIBLE']['MAR-010-045']['TEXT']) ? NULL : $args['database']['T_BOOKS'][$bible]['Mark']			.' '.$args['database']['T_NUMBERS'][$bible]['10']	.':'.$args['database']['T_NUMBERS'][$bible]['45'],
	'ROM1_1'		=> $database['T_BIBLE']['ROM-001-001']['TEXT'] ?? NULL,	
	'ROM1_1_B'		=> empty($database['T_BIBLE']['ROM-001-001']['TEXT']) ? NULL : $args['database']['T_BOOKS'][$bible]['Romans']		.' '.$args['database']['T_NUMBERS'][$bible]['1']	.':'.$args['database']['T_NUMBERS'][$bible]['1'],
	'MAT28_19'		=> $database['T_BIBLE']['MAT-028-019']['TEXT'] ?? NULL,	
	'MAT28_19_B'	=> empty($database['T_BIBLE']['MAT-028-019']['TEXT']) ? NULL : $args['database']['T_BOOKS'][$bible]['Matthew']		.' '.$args['database']['T_NUMBERS'][$bible]['28']	.':'.$args['database']['T_NUMBERS'][$bible]['19'],
	);
	
	// Wrap-up
	$missed += empty($database['T_BIBLE']['JOH-003-016']['TEXT']) ? 1 : 0;
	$missed += empty($database['T_BIBLE']['GEN-003-024']['TEXT']) ? 1 : 0;
	$missed += empty($database['T_BIBLE']['LUK-023-034']['TEXT']) ? 1 : 0;
	$missed += empty($database['T_BIBLE']['REV-021-002']['TEXT']) ? 1 : 0;
	$missed += empty($database['T_BIBLE']['REV-021-003']['TEXT']) ? 1 : 0;
	$missed += empty($database['T_BIBLE']['HEB-011-008']['TEXT']) ? 1 : 0;
	$missed += empty($database['T_BIBLE']['EXO-013-017']['TEXT']) ? 1 : 0;
	$missed += empty($database['T_BIBLE']['MAR-010-045']['TEXT']) ? 1 : 0;
	$missed += empty($database['T_BIBLE']['ROM-001-001']['TEXT']) ? 1 : 0;
	$missed += empty($database['T_BIBLE']['MAT-028-019']['TEXT']) ? 1 : 0;
	AION_unset($database); $database=NULL; unset($database);
	AION_ECHO('IVERSE '.$args['filepath'].' with missed = '.$missed);
}



/*** copy and keep date ***/
function AION_COPY($pathSource, $pathDest) {
    if (!copy($pathSource, $pathDest)) { return FALSE; }
    if (($dt = filemtime($pathSource)) === FALSE) { return FALSE; }
    if (!touch($pathDest, $dt)) { return FALSE; }
	return TRUE;
}



/*** aion epub uzip loop ***/
function AION_LOOP_EPUB_UZIP($source, $destiny) {
	AION_LOOP( array(
		'function'	=> 'AION_LOOP_EPUB_UZIP_DOIT',
		'source'	=> $source,
		//'include'		=> "/Holy-Bible---.*(Aionian-Bible|Gods-Living-Word|Family-35-NT|LXX2012-U-S-English).*---Aionian-Edition\.epub$/",
		//'include'		=> "/Holy-Bible---English---Aionian-Bible---Aionian-Edition\.epub$/",
		'include'	=> "/\.epub$/",
		'destiny'	=> $destiny,
		) );
}
function AION_LOOP_EPUB_UZIP_DOIT($args) {
	$destiny = $args['destiny'].'/epub/'.str_replace('.epub','',$args['filename']);
	system('rm -rf '.$destiny);
	if (is_dir($destiny)) { AION_ECHO("ERROR! existing isdir=".$destiny); }
	system('unzip -q '.$args['filepath'].' -d '.$destiny);
	if (!is_dir($destiny)) { AION_ECHO("ERROR! failed isdir=".$destiny); }
	AION_ECHO("SUCCESS EPUB UNZIPPED ".$destiny);
}



/*** aion copyright loop ***/
function AION_LOOP_COPYRIGHT($folder_original, $folder_copyright) {
	system('rm -rf '.$folder_copyright);
	if (!mkdir($folder_copyright)) { AION_ECHO("ERROR! !mkdir: ".$folder_copyright); }
	AION_LOOP( array(
		'function'	=> 'AION_LOOP_COPYRIGHT_DOIT',
		'source'	=> $folder_original,
		'destiny'	=> $folder_copyright,
		'include'	=> "/Source-Edition\.epub$/",
		) );
	system("cat ".$folder_copyright."/*.copyright > ".$folder_copyright."/AMASTER.COPYRIGHT");
	system('(echo "Subject: AIONIAN ENGINE COPYRIGHT"; echo; echo AMASTER.COPYRIGHT; ls -ail ' . $folder_copyright . '; cat ' . $folder_copyright . '/AMASTER.COPYRIGHT;) | /usr/lib/sendmail escribes@aionianbible.org;');
}
function AION_LOOP_COPYRIGHT_DOIT($args) {
	$filename1 = $args['filename'];
	$filepath1 = $args['filepath'];
	$fileout   = $args['destiny'].'/'.$filename1.'.copyright';
	system('rm -rf .tmp.copyright');
	if (!mkdir('.tmp.copyright')) {														AION_ECHO("ERROR! mkdir()"); }
	system('unzip -q ' . $filepath1 . ' -d .tmp.copyright');
	$copyright = 0;
	$files = array_diff(scandir('.tmp.copyright/OEBPS'), array('.', '..'));
	foreach( $files as $file ) { if (stripos($file,'copyright')!==FALSE) { $copyright=$file; break; } }
	if (!$copyright) {																	AION_ECHO("ERROR! No copyright found!"); }
	if (($copytext=file_get_contents('.tmp.copyright/OEBPS/'.$copyright))===FALSE) {	AION_ECHO("ERROR! Failed header copyright write!"); }
	$copytext = strip_tags($copytext);
	$copytext = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $copytext);
	if (!$copytext) {																	AION_ECHO("ERROR! No copytext found!"); }
	$problem = 0;
	if (stripos($copytext,'public domain')===FALSE &&
		stripos($copytext,'sharealike')===FALSE &&
		stripos($copytext,'share-alike')===FALSE &&
		stripos($copytext,'creative commons')===FALSE ) {
		$problem = 'PROBLEM COPYRIGHT: '.$filename1;
	}
	$copytext = "COPYRIGHT! ".$filename1."\n".$problem.$copytext."\n\n\n\n\n";
	if (file_put_contents($fileout,strip_tags($copytext))===FALSE) {					AION_ECHO("ERROR! Failed header copyright write!"); }
	system('rm -rf .tmp.copyright');
	if ($problem) { system('(echo "Subject: AIONIAN ENGINE COPYRIGHT PROBLEM: '.$filename1.'"; echo; cat '.$fileout.';) | /usr/lib/sendmail escribes@aionianbible.org;'); $message=$problem; }
	else { $message = 'SUCCESS COPYRIGHT: '.$filepath1; }
	AION_ECHO($message);
}



/*** CHECK: BOOKSCOUNT ***/
function AION_LOOP_CHECK_BOOKSCOUNT($input,$output) {
	$database = array();
	AION_FILE_DATA_GET( $input, 'T_BOOKSCOUNT', $database, FALSE, FALSE );
	$bookscount = AION_LOOP_CHECK_BOOKSCOUNT_ARRAY($database[T_BOOKSCOUNT]);
	AION_FILE_DATA_PUT($output,$bookscount);
	AION_unset($bookscount); $bookscount=NULL; unset($bookscount);
	AION_unset($database); $database=NULL; unset($database);
	gc_collect_cycles();
	AION_ECHO("SUCCESS BOOKS COUNT: $output");
}
function AION_LOOP_CHECK_BOOKSCOUNT_ARRAY($verses) {
	$row=$prev=NULL;
	$bookscount=array();
	foreach( $verses as $row ) {
		if (isset($prev) && ($row[C_INDEX] != $prev[C_INDEX] || $row[C_BOOK] != $prev[C_BOOK] || $row[C_CHAPTER] != $prev[C_CHAPTER] )) {
			unset($prev[C_TEXT]);
			$bookscount[$prev[C_BOOK]] = $prev;
		}
		$prev = $row;
	}
	if (isset($row)) {
		unset($row[C_TEXT]);
		$bookscount[$row[C_BOOK]] = $row;
	}
	return($bookscount);
}



/*** CHECK: BOOKSCOMPARE ***/
function AION_LOOP_CHECK_BOOKSCOMPARE($input,$online,$output) {
	$database = array();
	AION_FILE_DATA_GET( './aion_database/BOOKS.txt', 'T_BOOKS', $database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/BOOKSCOUNT.txt', 'T_BOOKSCOUNT', $database, 'BOOK', FALSE );
	if (($x=count($database[T_BOOKS]['CODE']))!=67) {			AION_ECHO("ERROR! Count(args[T_BOOKS][CODE])!=67: $x"); }
	AION_LOOP( array(
		'function'	=> 'AION_LOOP_CHECK_BOOKSCOMPARE_DOIT',
		'source'	=> $input,
		'online'	=> $online,
		'destiny'	=> '/tmp',
		'database'	=> &$database,
		'include'	=> "/\---Standard-Edition.noia$/",
		) );
	AION_FILE_DATA_PUT($output,$database[T_BOOKS]);
	AION_unset($database); $database=NULL; unset($database);
}
function AION_LOOP_CHECK_BOOKSCOMPARE_DOIT($args) {
	AION_ECHO('BOOKS COMPARE: '.$args['filepath']);
	if (!preg_match("/\/(Holy-Bible---.*)---Standard-Edition\.noia/", $args['filepath'], $matches)) {	AION_ECHO("ERROR! Failed to preg_match(Holy-Bible): ".$args['filepath']);	}
	$bible = $matches[1];
	if (!preg_match("/Holy-Bible---/", $bible)) {				AION_ECHO("ERROR! Failed to preg_match(Bible): $bible");	}
	if (empty($args['database'][T_BOOKS][$bible])) {			AION_ECHO("ERROR! Failed to find BOOK[bible] = $bible");	}
	if (($x=count($args['database'][T_BOOKS][$bible]))!=67) {	AION_ECHO("ERROR! Count(args[T_BOOKS][BIBLE])!=67: $x"); }
	$database = array();
	// check standard
	AION_FILE_DATA_GET( $args['filepath'], 'T_BIBLE', $database, FALSE, FALSE );	
	$bookscompare = AION_LOOP_CHECK_BOOKSCOUNT_ARRAY($database[T_BIBLE]);
	reset($args['database'][T_BOOKS]['CODE']);
	reset($args['database'][T_BOOKS][$bible]);
	$doit = FALSE;
	while(	($key_book_code=key($args['database'][T_BOOKS]['CODE']))!=NULL &&
			($key_book_name=key($args['database'][T_BOOKS][$bible]))!=NULL) {
		if ($doit) {
			$short = $args['database'][T_BOOKS]['CODE'][$key_book_code];
			if (!isset($bookscompare[$short])) {										$args['database'][T_BOOKS][$bible][$key_book_name] = 'NULL'; }					// bible does not have this book?
			else if ($args['database'][T_BOOKS][$bible][$key_book_name] == 'NULL') {	$args['database'][T_BOOKS][$bible][$key_book_name] = 'STAN-BOOKS-NULL-BUT'; }	// bible has the book and should not?
			else if ((int)$bookscompare[$short][C_CHAPTER] != (int)$args['database'][T_BOOKSCOUNT][$short][C_CHAPTER]) {
																						$args['database'][T_BOOKS][$bible][$key_book_name] = 'STAN-BAD-CHAP#'; }		// bible book wrong chapters?
		}
		next($args['database'][T_BOOKS]['CODE']);
		next($args['database'][T_BOOKS][$bible]);
		$doit = TRUE;
	}
	AION_unset($database[T_BIBLE]); $database[T_BIBLE]=NULL; unset($database[T_BIBLE]);
	// check aionian
	$aionianfile = preg_replace("/---Standard-Edition/","---Aionian-Edition", $args['filepath']);
	AION_FILE_DATA_GET( $aionianfile, 'T_BIBLE', $database, FALSE, FALSE );	
	reset($args['database'][T_BOOKS]['CODE']);
	reset($args['database'][T_BOOKS][$bible]);
	$doit = FALSE;
	while(	($key_book_code=key($args['database'][T_BOOKS]['CODE']))!=NULL &&
			($key_book_name=key($args['database'][T_BOOKS][$bible]))!=NULL) {
		if ($doit) {
			$short = $args['database'][T_BOOKS]['CODE'][$key_book_code];
			if (!isset($bookscompare[$short])) {										$args['database'][T_BOOKS][$bible][$key_book_name] = 'NULL'; }					// bible does not have this book?
			else if ($args['database'][T_BOOKS][$bible][$key_book_name] == 'NULL') {	$args['database'][T_BOOKS][$bible][$key_book_name] = 'AION-BOOKS-NULL-BUT'; }	// bible has the book and should not?
			else if ((int)$bookscompare[$short][C_CHAPTER] != (int)$args['database'][T_BOOKSCOUNT][$short][C_CHAPTER]) {
																						$args['database'][T_BOOKS][$bible][$key_book_name] = 'STAN-BAD-CHAP#'; }		// bible book wrong chapters?
		}
		next($args['database'][T_BOOKS]['CODE']);
		next($args['database'][T_BOOKS][$bible]);
		$doit = TRUE;
	}
	// check online files!
	$folder = $args['online']."/$bible---Aionian-Edition";
	$files = array_diff(scandir($folder), array('.', '..'));
	$bookchapfile = array();
	foreach( $files as $file ) { // loop the bible online folder for book/chapter contents
		$parse = preg_split("/[.-]{1}/",$file);
		if (empty($parse) || !is_array($parse) || count($parse)!=4) { AION_ECHO("ERROR! Problem parsing folder files during BOOKS check!");  }
		$bookchapfile[$parse[1]] = $parse[2];		
	}
	AION_unset($files); $files=NULL; unset($files);
	reset($args['database'][T_BOOKS]['CODE']);
	reset($args['database'][T_BOOKS][$bible]);
	$doit = FALSE;
	while(	($key_book_code=key($args['database'][T_BOOKS]['CODE']))!=NULL &&
			($key_book_name=key($args['database'][T_BOOKS][$bible]))!=NULL) {
		if ($doit) {
			$short = $args['database'][T_BOOKS]['CODE'][$key_book_code];
			if (!isset($bookchapfile[$short])) {										$args['database'][T_BOOKS][$bible][$key_book_name] = 'NULL'; }						// bible does not have this book?
			else if ($args['database'][T_BOOKS][$bible][$key_book_name] == 'NULL') {	$args['database'][T_BOOKS][$bible][$key_book_name] = $key_book_name.'-WHY-HERE'; }	// bible has the book and should not?
			else if ((int)$bookchapfile[$short] != (int)$args['database'][T_BOOKSCOUNT][$short][C_CHAPTER]) {
																						$args['database'][T_BOOKS][$bible][$key_book_name] = $key_book_name.'-BAD-CHAP'; }	// bible book wrong chapters?
		}
		next($args['database'][T_BOOKS]['CODE']);
		next($args['database'][T_BOOKS][$bible]);
		$doit = TRUE;
	}
	// done!
	AION_unset($bookchapfile); $bookchapfile=NULL; unset($bookchapfile);
	AION_unset($bookscompare); $bookscompare=NULL; unset($bookscompare);
	AION_unset($database); $database=NULL; unset($database);
	gc_collect_cycles();
}



/*** CHECK: VERSECOMPARE ***/
function AION_LOOP_CHECK_BOOKSCHAPTERS($standard,$input,$output) {
	$database = array();
	AION_FILE_DATA_GET( $standard, 'T_BIBLE', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	$database['T_STANDARD'] = AION_LOOP_CHECK_BOOKSCHAPTERS_COMPARE( $database[T_BIBLE] );
	$database['T_BOOKSCHAPTERS'] = array();
	AION_LOOP( array(
		'function'	=> 'AION_LOOP_CHECK_BOOKSCHAPTERS_DOIT',
		'source'	=> $input,
		'destiny'	=> '/tmp',
		'database'	=> &$database,
		'include'	=> "/\---Standard-Edition.noia$/",
		) );
	AION_FILE_DATA_PUT($output,$database['T_BOOKSCHAPTERS']);
	system('sort '.$output.' | head -c -1 > '.$output.'.sort' );
	if (!rename($output.'.sort', $output)) { AION_ECHO("ERROR! Rename() failed: $output"); }
	AION_unset($database); $database=NULL; unset($database);
}
function AION_LOOP_CHECK_BOOKSCHAPTERS_COMPARE( $bible ) {
	$compare = array();
	foreach( $bible as $verse) { $compare[$verse[C_INDEX]][$verse[C_BOOK]][$verse[C_CHAPTER]][$verse[C_VERSE]] = TRUE; }
	return $compare;
}
function AION_LOOP_CHECK_BOOKSCHAPTERS_DOIT($args) {
	AION_ECHO('BOOKS CHAPTERS: '.$args['filepath']);
	if (!preg_match("/\/(Holy-Bible---.*)---Standard-Edition\.noia/", $args['filepath'], $matches)) {	AION_ECHO("ERROR! Failed to preg_match(Holy-Bible): ".$args['filepath']);	}
	$bible = $matches[1];
	if (!preg_match("/Holy-Bible---/", $bible)) {				AION_ECHO("ERROR! Failed to preg_match(Bible): $bible");	}
	$database = array();
	AION_FILE_DATA_GET( $args['filepath'], 'T_BIBLE', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	$database['T_COMPARE'] = AION_LOOP_CHECK_BOOKSCHAPTERS_COMPARE( $database[T_BIBLE] );
	foreach($database['T_COMPARE'] as $index => $index_a) {
		foreach($index_a as $book => $book_a) {
			foreach($book_a as $chapter => $chapter_a) {
				$prev_verse=-99;
				foreach($chapter_a as $verse => $verse_a) {
					if (!$verse_a) { continue; }
					if (empty($args['database']['T_STANDARD'][$index][$book][$chapter]['001'])) {
						$flag = ( ($verse+0 == $prev_verse+1) ? 'SEQ' : '' );
						$args['database']['T_BOOKSCHAPTERS'][] = array('BIBLE'=>$bible,'INDEX'=>$index,'BOOK'=>$book,'CHAPTER'=>$chapter,'VERSE'=>$verse,'MAP'=>'ERROR','FLAG'=>$flag);
						$prev_verse = $verse+0;
					}
					else if (empty($args['database']['T_STANDARD'][$index][$book][$chapter][$verse])) {
						$loci = (empty($args['database']['T_STANDARD'][$index][$book][$chapter][sprintf('%03d',$verse+1)]) ? 'END' : 'MID');
						$flag = $loci.(($verse+0 == $prev_verse+1) ? '-SEQ' : '').($loci=='END'?'*':'');
						$args['database']['T_BOOKSCHAPTERS'][] = array('BIBLE'=>$bible,'INDEX'=>$index,'BOOK'=>$book,'CHAPTER'=>$chapter,'VERSE'=>$verse,'MAP'=>'EXTRA','FLAG'=>$flag);
						$prev_verse = $verse+0;
					}
				}
			}
			foreach($args['database']['T_STANDARD'][$index][$book] as $chapter => $chapter_a) {
				$prev_verse=-99;
				foreach($chapter_a as $verse => $verse_a) {
					if (!$verse_a) { continue; }
					if (empty($database['T_COMPARE'][$index][$book][$chapter][$verse])) {
						$loci = (empty($args['database']['T_STANDARD'][$index][$book][$chapter][sprintf('%03d',$verse+1)]) ? 'END' : 'MID');
						$flag = $loci.(($verse+0 == $prev_verse+1) ? '-SEQ' : '').($loci=='END'?'*':'');
						$args['database']['T_BOOKSCHAPTERS'][] = array('BIBLE'=>$bible,'INDEX'=>$index,'BOOK'=>$book,'CHAPTER'=>$chapter,'VERSE'=>$verse,'MAP'=>'MISSING','FLAG'=>$flag);
						$prev_verse = $verse+0;
					}
				}
			}
		}
	}
	AION_unset($database); $database=NULL; unset($database);
}



/*** CHECK: BOOKS HELL ALL ***/
function AION_LOOP_CHECK_UNTRANSLATE_MODULE($input,$output,$output2) {
	$database = array();
	AION_FILE_DATA_GET( './aion_database/UNTRANSLATE.txt', 'T_UNTRANSLATE', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	AION_FILE_DATA_GET( './aion_database/UNTRANSLATEWORDS.txt', 'T_UNTRANSLATEWORDS', $database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/UNTRANSLATECUSTOM.txt', 'T_UNTRANSLATECUSTOM', $database, array('BIBLE','INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	AION_FILE_DATA_GET( './aion_database/BOOKSCHAPTERS.txt', 'T_BOOKSCHAPTERS', $database, array('BIBLE','INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	AION_FILE_DATA_GET( './aion_database/BOOKSSTANDARD.noia', 'T_BOOKSSTANDARD', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	$database['T_UNTRANSLATEMODULE'] = array();
	$database['T_UNTRANSLATECOUNT'] = array();
	AION_LOOP( array(
		'function'	=> 'AION_LOOP_CHECK_UNTRANSLATE_MODULE_DOIT',
		'source'	=> $input,
		'destiny'	=> '/tmp',
		'database'	=> &$database,
		'include'	=> "/\---Standard-Edition.noia$/",
		) );
	AION_unset($database['T_UNTRANSLATE']);			unset($database['T_UNTRANSLATE']);
	AION_unset($database['T_UNTRANSLATEWORDS']);	unset($database['T_UNTRANSLATEWORDS']);
	AION_unset($database['T_UNTRANSLATECUSTOM']);	unset($database['T_UNTRANSLATECUSTOM']);
	AION_unset($database['T_BOOKSCHAPTERS']);		unset($database['T_BOOKSCHAPTERS']);
	AION_unset($database['T_BOOKSSTANDARD']);		unset($database['T_BOOKSSTANDARD']);
	gc_collect_cycles();
	AION_FILE_DATA_PUT($output, $database['T_UNTRANSLATEMODULE']);
	AION_FILE_DATA_PUT($output2,$database['T_UNTRANSLATECOUNT']);
	system('sort '.$output." | head -c -1 > ".$output.'.sort' );
	AION_unset($database); $database=NULL; unset($database);
}
function AION_LOOP_CHECK_UNTRANSLATE_MODULE_DOIT($args) {
	AION_ECHO('UNTRANSLATE MODULE: '.$args['filepath']);
	if (!preg_match("/\/(Holy-Bible---.*)---Standard-Edition\.noia/", $args['filepath'], $matches)) {	AION_ECHO("ERROR! Failed to preg_match(Holy-Bible): ".$args['filepath']);	}
	$bible = $matches[1];
	if (!preg_match("/Holy-Bible---/", $bible)) {														AION_ECHO("ERROR! Failed to preg_match(Bible): $bible");	}
	if (empty($args['database'][T_UNTRANSLATEWORDS][$bible])) {											AION_ECHO("ERROR! Failed to find UNTRANSLATEWORDS[bible] = $bible");	}
	$args['database']['T_UNTRANSLATECOUNT'][$bible] = array();
	$count = &$args['database']['T_UNTRANSLATECOUNT'][$bible];
	$count['BIBLE']		= $bible;
	$count['HELL_ALL']	= 0;
	$count['HELL_OUT']	= 0;
	$count['SHEOL']		= 0;
	$count['GEHENNA']	= 0;
	$count['ELEESE']	= 0;
	$count['HADES']		= 0;
	$count['ABYSS']		= 0;
	$count['TARTARUS']	= 0;
	$count['LOF']		= 0;
	$count['AION']		= 0;
	$count['AIONIAN']	= 0;
	$count['AION-2']	= 0;
	$count['AIDIOS']	= 0;
	$count['AION_OUT']	= 0;
	$count['CUSTOM']	= 0;
	$count['OUT']		= 0;
	$count['IN']		= 0;
	$count['VERSE_DO']	= 0;
	$count['VERSE_OK']	= 0;
	$count['VERSE_SK']	= 0;
	$count['VERSE_NO']	= 0;
	$count['VERSE_ER']	= 0;
	$count['VERSE_CK']	= 0;
	$nospace = $args['database'][T_UNTRANSLATEWORDS][$bible]['NOSPACE'];
	$nver = explode(",", $args['database'][T_UNTRANSLATEWORDS][$bible]['NOETERNAL']);					foreach($nver as &$X) { $X = trim($X); } unset($X);
	$ever =	explode(",", $args['database'][T_UNTRANSLATEWORDS][$bible]['ETERNAL']);						foreach($ever as &$X) { $X = trim($X); } unset($X);
	$nhel = explode(",", $args['database'][T_UNTRANSLATEWORDS][$bible]['NOHELL']);						foreach($nhel as &$X) { $X = trim($X); } unset($X);
	$yhel = explode(",", $args['database'][T_UNTRANSLATEWORDS][$bible]['YESHELL']);						foreach($yhel as &$X) { $X = trim($X); } unset($X);
	$sheo = explode(",", $args['database'][T_UNTRANSLATEWORDS][$bible]['SHEOL']);						foreach($sheo as &$X) { $X = trim($X); } unset($X);	
	$hade = explode(",", $args['database'][T_UNTRANSLATEWORDS][$bible]['HADES']);						foreach($hade as &$X) { $X = trim($X); } unset($X);	
	$gehe = explode(",", $args['database'][T_UNTRANSLATEWORDS][$bible]['GEHENNA']);						foreach($gehe as &$X) { $X = trim($X); } unset($X);
	$tart = explode(",", $args['database'][T_UNTRANSLATEWORDS][$bible]['TARTARUS']);					foreach($tart as &$X) { $X = trim($X); } unset($X);	
	$abys = explode(",", $args['database'][T_UNTRANSLATEWORDS][$bible]['ABYSS']);						foreach($abys as &$X) { $X = trim($X); } unset($X);
	$lofs = explode(",", $args['database'][T_UNTRANSLATEWORDS][$bible]['LOF']);							foreach($lofs as &$X) { $X = trim($X); } unset($X);
	$database = array();
	AION_FILE_DATA_GET( $args['filepath'], 'T_BIBLE', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	foreach($database[T_BIBLE] as $vref => $verse) {
		/* setup */
		$gotone 				= FALSE;
		$output					= array();
		$output['BIBLE']		= $bible;
		$output['WARN']			= NULL;
		$output['INDEX']		= $verse['INDEX'];
		$output['BOOK']			= $verse['BOOK'];
		$output['CHAPTER']		= $verse['CHAPTER'];
		$output['VERSE']		= $verse['VERSE'];
		$output['UNTRANSLATE']	= (isset($args['database'][T_UNTRANSLATE][$vref]['WORD']) ? $gotone=trim($args['database'][T_UNTRANSLATE][$vref]['WORD']) : '');
		$output['MATCH']		= NULL;
		$output['TEXT']			= NULL;
		$output['STANDARD']		= (isset($args['database'][T_BOOKSSTANDARD][$vref]['TEXT']) ? $args['database'][T_BOOKSSTANDARD][$vref]['TEXT'] : "VERSE TEXT NOT FOUND FOR $vref");
		/* custom */
		if (isset($args['database'][T_UNTRANSLATECUSTOM][$bible.'-'.$vref]['WORD'])) {
			$gotone					= TRUE;
			$count['CUSTOM']		+= 1;
			$output['WARN']			='CUSTOM,';
			$output['UNTRANSLATE']	= $args['database'][T_UNTRANSLATECUSTOM][$bible.'-'.$vref]['WORD'];
		}
		/* commands */
		$untrans = $output['UNTRANSLATE'];
		$untrana = explode(",",$output['UNTRANSLATE']);
		$replace = 0;
		/* untranslate verses */
		$doit = TRUE;
		while(!empty($untrans)) {
		if (stripos($untrans,'SKIP')!==FALSE){			$doit = FALSE; break; }
		if (stripos($untrans,'NOTE')!==FALSE){			$doit = FALSE;
														$verse['TEXT'] = $verse['TEXT'].' ('.$args['database'][T_UNTRANSLATECUSTOM][$bible.'-'.$vref]['TEXT'].')';
														++$replace;
														break;
		}
		if (stripos($untrans,'SWAP')!==FALSE){			$doit = FALSE;
														$swap_text = $args['database'][T_UNTRANSLATECUSTOM][$bible.'-'.$vref]['TEXT'];
														// totally ugly hack to deal with Aionian-Bible(Heart) not using smartquotes
														if('Holy-Bible---English---Aionian-Bible'==$bible) {
															static $space_punc	= array('’','”','‘','“');
															static $space_punc2	= array("'",'"',"'",'"');
															$swap_text = str_replace($space_punc, $space_punc2, $swap_text);
														}
														$verse['TEXT'] = $swap_text;
														++$replace;
														break;
		}
		if (stripos($untrans,'AIONS,AIONIAN')!==FALSE){	$count['AION-2']	+= AION_HEART($verse['TEXT'],$nospace,'(aiōn g165, aiōnios g166)',	2    ,$output['MATCH'],$gotone,$replace,$output['WARN']); break; }
		if (stripos($untrans,'AIONS-JAP')!==FALSE){		$count['AIONIAN']	+= AION_HEART($verse['TEXT'],$nospace,'(aiōn g165)',				2    ,$output['MATCH'],$gotone,$replace,$output['WARN']); break; }
		if (stripos($untrans,'AIONS')!==FALSE) {		$count['AION']		+= AION_HEART($verse['TEXT'],$nospace,'(aiōn g165)',				$ever,$output['MATCH'],$gotone,$replace,$output['WARN']); }
		if (stripos($untrans,'ELEESE')!==FALSE) {		$count['ELEESE']	+= AION_HEART($verse['TEXT'],$nospace,'(eleēsē g1653)',				1    ,$output['MATCH'],$gotone,$replace,$output['WARN']); }
		if (stripos($untrans,'AIONIAN')!==FALSE) {		$count['AIONIAN']	+= AION_HEART($verse['TEXT'],$nospace,'(aiōnios g166)',				$ever,$output['MATCH'],$gotone,$replace,$output['WARN']); }
		if (stripos($untrans,'AIDIOS')!==FALSE) {		$count['AIDIOS']	+= AION_HEART($verse['TEXT'],$nospace,'(aïdios g126)',				$ever,$output['MATCH'],$gotone,$replace,$output['WARN']); }
		if (stripos($untrans,'SHEOL')!==FALSE) {		$count['SHEOL']		+= AION_HEART($verse['TEXT'],$nospace,'(Sheol h7585)',				$sheo,$output['MATCH'],$gotone,$replace,$output['WARN']); }
		if (stripos($untrans,'GEHENNA')!==FALSE) {		$count['GEHENNA']	+= AION_HEART($verse['TEXT'],$nospace,'(Geenna g1067)',				$gehe,$output['MATCH'],$gotone,$replace,$output['WARN']); }
		if (stripos($untrans,'HADES')!==FALSE) {		$count['HADES']		+= AION_HEART($verse['TEXT'],$nospace,'(Hadēs g86)',				$hade,$output['MATCH'],$gotone,$replace,$output['WARN']); }
		if (stripos($untrans,'ABYSS')!==FALSE) {		$count['ABYSS']		+= AION_HEART($verse['TEXT'],$nospace,'(Abyssos g12)',				$abys,$output['MATCH'],$gotone,$replace,$output['WARN']); }
		if (stripos($untrans,'TARTARUS')!==FALSE) {		$count['TARTARUS']	+= AION_HEART($verse['TEXT'],$nospace,'(Tartaroō g5020)',			$tart,$output['MATCH'],$gotone,$replace,$output['WARN']); }
		if (stripos($untrans,'LOF')!==FALSE) {			$count['LOF']		+= AION_HEART($verse['TEXT'],$nospace,'(Limnē Pyr g3041 g4442)',	$lofs,$output['MATCH'],$gotone,$replace,$output['WARN']); }
		if (FALSE===$gotone){ AION_ECHO("ERROR! UNKNOWN UNTRANSLATE DIRECTIVE! $bible $vref $untrans"); }
		break;
		}
		if ($gotone) { ++$count['VERSE_DO']; }
		/* questioned verses */
		$questioned = 0;
		$count['HELL_ALL']	+= AION_COUNT($verse['TEXT'],$nospace,$yhel);
		if ($doit && !count(array_intersect(array('SHEOL','GEHENNA','HADES','TARTARUS','ABYSS','LOF'),$untrana))) {
			$count['HELL_OUT']	+= ($questioned=AION_EXTRA($verse['TEXT'],$nospace,$nhel,$output['MATCH'],$gotone,$replace,$output['WARN'])); }
		if ($doit && !$questioned && $verse['INDEX']>39 && !count(array_intersect(array('AIONS','AIONIAN','AIDIOS'),$untrana))) {
			$count['AION_OUT']	+= AION_EXTRA($verse['TEXT'],$nospace,$nver,$output['MATCH'],$gotone,$replace,$output['WARN']); }
		/* finish */
		if ($gotone) {
			if (isset($args['database'][T_BOOKSCHAPTERS][$bible.'-'.$verse['INDEX'].'-'.$verse['BOOK'].'-'.$verse['CHAPTER'].'-'.$verse['VERSE']])) { $output['WARN'] .= 'REFERENCE,'; }
			if ($replace>1) { $output['WARN'] .= "MULTIPLE($replace),"; }
			if (preg_match('/([[:digit:]]+)\) *\(yaani/ui', $verse['TEXT'])) { $output['TEXT'] = $verse['TEXT']; }
			else if (!($output['TEXT'] = preg_replace('/([gGhH]{1}[[:digit:]]+)\) *\(/ui', '$1, ', $verse['TEXT']))) { AION_ECHO("ERROR! Untranslate failure preg_replace(())"); }
			$args['database']['T_UNTRANSLATEMODULE'][] = $output;
		}
		AION_unset($output); $output=NULL; unset($output);
		AION_unset($untrana); $untrana=NULL; unset($untrana);
		gc_collect_cycles();
	}
	/* missing verse? */
	$good_book = NULL;
	foreach($args['database'][T_UNTRANSLATE] as $vref => $verse) {
		if (empty($database[T_BIBLE][$vref])) {
			if (isset($args['database'][T_UNTRANSLATECUSTOM][$bible.'-'.$vref]['WORD']) && $args['database'][T_UNTRANSLATECUSTOM][$bible.'-'.$vref]['WORD']=='SKIP') { ++$count['VERSE_SK']; continue; }
			$output					= array();
			$output['BIBLE']		= $bible;
			if ($good_book==$verse['BOOK']) {	$output['WARN'] = 'VERSE_ER'; ++$count['VERSE_ER']; }
			else {								$output['WARN'] = 'VERSE_NO'; ++$count['VERSE_NO']; }
			$output['INDEX']		= $verse['INDEX'];
			$output['BOOK']			= $verse['BOOK'];
			$output['CHAPTER']		= $verse['CHAPTER'];
			$output['VERSE']		= $verse['VERSE'];
			$output['UNTRANSLATE']	= (isset($args['database'][T_UNTRANSLATE][$vref]['WORD']) ? trim($args['database'][T_UNTRANSLATE][$vref]['WORD']) : '');
			$output['MATCH']		= 'NULL';
			$output['TEXT']			= 'NULL';
			$output['STANDARD']		= $args['database'][T_BOOKSSTANDARD][$vref]['TEXT'];
			$args['database']['T_UNTRANSLATEMODULE'][] = $output;
			AION_unset($output); $output=NULL; unset($output);
			gc_collect_cycles();
		}
		else {
			$good_book = $verse['BOOK'];
			++$count['VERSE_OK'];
		}
	}
	/* tab totals */
	$count['OUT']		= $count['HELL_OUT'] +	$count['AION_OUT'];
	$count['IN']		= $count['SHEOL'] + $count['GEHENNA'] + $count['HADES'] + $count['ABYSS'] + $count['TARTARUS'] + $count['LOF'] + $count['AION'] + $count['AIONIAN']	+ $count['AION-2'] + $count['AIDIOS'] + $count['ELEESE'];
	$count['VERSE_CK']	= $count['VERSE_DO'] - $count['VERSE_OK'];
	unset($nver);
	unset($ever);
	unset($nhel);
	unset($yhel);
	unset($sheo);	
	unset($hade);	
	unset($gehe);
	unset($tart);	
	unset($abys);
	unset($lofs);
	AION_unset($database); $database=NULL; unset($database);
	gc_collect_cycles();
}
/* append the annotation */
function AION_HEART(&$text,$nospace,$greek,$words,&$match,&$gotone,&$replacements,&$warn) {
	$gotone = TRUE;
	$replace = 0;
	if (!$replace) {
		if (is_numeric($words)) {		$replace = $words;	$replacements += $words; }
		else {							$replace = 1;		$replacements += 1; }
		if (is_array($words)) {			$warn .= 'MISSING,'; } 
		if (!($text = preg_replace('/( *)$/ui', " $greek$1", $text, 1))) { AION_ECHO("ERROR! Untranslate failure preg_replace(postfix)"); }
	}
	return $replace;
}
function AION_EXTRA(&$text,$nospace,$words,&$match,&$gotone,&$replacements,&$warn) {
	$replace = 0;
	/*
	This function attempts to place the aionian question note next to the appropriate word.
	Degrees of success were accomplished but never to +95% and that for only 2/3s of the Bibles
	so the effort was noble, but for now all notes will be appended to the end of the verse!

	The future plan is to use this function to again produce the UNTRANSLATE modules for
	each bible with our best guess so that manual efforts can be made for each bible
	and in fact to recruit this effort directly from the website.
	
	force the test below to be false to append the note to the end of the verse, otherwise
	the logic will attempt to place the note next to the word.
	*/
	if (FALSE) { // insert note
		foreach($words as $word) {
			$search = $nospace ? "/$word/ui" : '/(^|\s|[[:punct:]])('.$word.')($|\s|[[:punct:]])/ui';
			$substitute = $nospace ? "$word (questioned) " : "$1$2 (questioned)$3";
			if (empty($word) || !($matches=preg_match_all($search,$text))) { continue; }
			$gotone = TRUE;
			$replace += $matches;
			$replacements += $matches;
			$match .= $word."($matches),";
			$warn .= 'EXTRA,';
			if (!($text = preg_replace($search, $substitute, $text))) { AION_ECHO("ERROR! Untranslate failure preg_replace(black)"); }
		}
	}
	else { // append note
		foreach($words as $word) {
			$search = $nospace ? "/$word/ui" : '/(^|\s|[[:punct:]])('.$word.')($|\s|[[:punct:]])/ui';
			if (empty($word) || !($matches=preg_match_all($search,$text))) { continue; }
			$gotone = TRUE;
			$replace += $matches;
			$replacements += $matches;
			$match .= $word."($matches),";
			$warn .= 'EXTRA,';
		}
		if ($replace) { $text = $text.' (questioned)'; }
	}
	return $replace;
}
function AION_COUNT($text,$nospace,$words) {
	$replace = 0;
	foreach($words as $word) {
		$search = $nospace ? "/$word/ui" : '/(^|\s|[[:punct:]])('.$word.')($|\s|[[:punct:]])/ui';
		if (empty($word) || !($matches=preg_match_all($search,$text))) { continue; }
		$replace += $matches;
	}
	return $replace;
}



/*** CHECK: AION WITH STANDARD ***/
function AION_LOOP_CHECK_DATA($source, $output, $tally, $debug=FALSE) {
	$database = array();
	$database['T_CHECKDATA'] = array();
	$database['T_TALLY'] = array();
	AION_FILE_DATA_GET( './aion_database/UNTRANSLATEREVERSE.txt', 'T_UNTRANSLATEREVERSE', $database, array('BIBLE','INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	AION_FILE_DATA_GET( './aion_database/UNTRANSLATEREVERSE.txt', 'T_UNTRANSLATEREVERSE_SOURCE', $database, array('BIBLE','INDEXX','BOOKX','CHAPTERX','VERSEX'), FALSE );
	AION_FILE_DATA_GET( './aion_database/UNTRANSLATEWORDS.txt', 'T_UNTRANSLATEWORDS', $database, 'BIBLE', FALSE );
	AION_LOOP( array(
		'function'	=> 'AION_LOOP_CHECK_DATA_DOIT',
		'source'	=> $source,
		'include'	=> "/---Aionian-Edition\.noia$/",
		'destiny'	=> '/tmp',
		'database'	=> &$database,
		'debug'		=> $debug,
		) );
	AION_unset($database['T_UNTRANSLATEREVERSE']); $database['T_UNTRANSLATEREVERSE']=NULL; unset($database['T_UNTRANSLATEREVERSE']);
	AION_unset($database['T_UNTRANSLATEREVERSE_SOURCE']); $database['T_UNTRANSLATEREVERSE_SOURCE']=NULL; unset($database['T_UNTRANSLATEREVERSE_SOURCE']);
	AION_unset($database['T_UNTRANSLATEWORDS']); $database['T_UNTRANSLATEWORDS']=NULL; unset($database['T_UNTRANSLATEWORDS']);
	AION_FILE_DATA_PUT($output,$database['T_CHECKDATA']);
	AION_unset($database['T_CHECKDATA']); $database['T_CHECKDATA']=NULL; unset($database['T_CHECKDATA']);
	gc_collect_cycles();
	if (!ksort($database['T_TALLY'])) { AION_ECHO("ERROR! Failed to ksort TALLY_HO"); }
	AION_FILE_DATA_PUT($tally,$database['T_TALLY']);
	AION_unset($database['T_TALLY']); $database['T_TALLY']=NULL; unset($database['T_TALLY']);
	AION_unset($database); $database=NULL; unset($database);
	gc_collect_cycles();
}
function AION_LOOP_CHECK_DATA_DOIT($args) {
	if (!preg_match("/\/(Holy-Bible---.*)---Aionian-Edition\.noia/", $args['filepath'], $matches)) {	AION_ECHO("ERROR! Failed to preg_match(Holy-Bible): ".$args['filepath']);	}
	$bible = $matches[1];
	$file_aionian  = $args['filepath'];
	$file_standard = str_replace('---Aionian-Edition.noia','---Standard-Edition.noia',$args['filepath']);
	$file_source   = str_replace('---Aionian-Edition.noia','---Source-Edition.noia',$args['filepath']);
	$database = array();
	AION_FILE_DATA_GET( $file_aionian,  'T_BIBLE_AIONIAN',  $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	AION_FILE_DATA_GET( $file_standard, 'T_BIBLE_STANDARD', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	AION_FILE_DATA_GET( $file_source,   'T_BIBLE_SOURCE',   $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	$count_source = count($database['T_BIBLE_SOURCE']);
	AION_LOOP_CHECKDATA_CLEANUP($database['T_BIBLE_AIONIAN'],	$args['database']['T_UNTRANSLATEWORDS'][$bible]['NOSPACE'], FALSE, $bible, FALSE);
	AION_LOOP_CHECKDATA_CLEANUP($database['T_BIBLE_STANDARD'],	$args['database']['T_UNTRANSLATEWORDS'][$bible]['NOSPACE'], FALSE, $bible, FALSE);
	AION_LOOP_CHECKDATA_CLEANUP($database['T_BIBLE_SOURCE'],	$args['database']['T_UNTRANSLATEWORDS'][$bible]['NOSPACE'], TRUE,  $bible, TRUE);
	$error = $erro2 = array();
	$error['BIBLE'] = $erro2['BIBLE'] = $bible;
	$diffcount = 0;
	$diffmax = 500;
	foreach($database['T_BIBLE_AIONIAN'] as $vref => $verse) {
		if ($diffcount>=$diffmax) { break; }
		$error['CHECKDATA']	= $erro2['CHECKDATA']	= '';
		$error['VREF']		= $erro2['VREF']		= $vref;
		$error['INDEX']		= $erro2['INDEX']		= $verse['INDEX'];
		$error['BOOK']		= $erro2['BOOK']		= $verse['BOOK'];
		$error['CHAPTER']	= $erro2['CHAPTER']		= $verse['CHAPTER'];
		$error['VERSE']		= $erro2['VERSE']		= $verse['VERSE'];
		$error['TEXT']		= $erro2['TEXT']		= $verse['TEXT'];
		if (empty($database['T_BIBLE_STANDARD'][$vref])) {							$error['CHECKDATA']	= 'Aion ref != Stan';		$args['database']['T_CHECKDATA'][] = $error;	++$diffcount; }
		else if ($verse['TEXT']!=$database['T_BIBLE_STANDARD'][$vref]['TEXT']) {	$error['CHECKDATA']	= 'Aion txt != Stan';		$args['database']['T_CHECKDATA'][] = $error;
			$erro2['TEXT'] = $database['T_BIBLE_STANDARD'][$vref]['TEXT'];			$erro2['CHECKDATA']	= 'Aion txt != Sta2';		$args['database']['T_CHECKDATA'][] = $erro2; 	++$diffcount;}
		if (!empty($args['database']['T_UNTRANSLATEREVERSE'][$bible.'-'.$vref])) {
			$error['VREF']	= $erro2['VREF']		= $vref =	$args['database']['T_UNTRANSLATEREVERSE'][$bible.'-'.$vref]['INDEXX'].'-'.
																$args['database']['T_UNTRANSLATEREVERSE'][$bible.'-'.$vref]['BOOKX'].'-'.
																$args['database']['T_UNTRANSLATEREVERSE'][$bible.'-'.$vref]['CHAPTERX'].'-'.
																$args['database']['T_UNTRANSLATEREVERSE'][$bible.'-'.$vref]['VERSEX'];
		}
		if (empty($database['T_BIBLE_SOURCE'][$vref])) {							$error['CHECKDATA']	= 'Aion ref != Sour';		$args['database']['T_CHECKDATA'][] = $error;	++$diffcount; }
		else if ($verse['TEXT']!=$database['T_BIBLE_SOURCE'][$vref]['TEXT']) {		$error['CHECKDATA']	= 'Aion txt != Sour';		$args['database']['T_CHECKDATA'][] = $error;
			$erro2['TEXT'] = $database['T_BIBLE_SOURCE'][$vref]['TEXT'];			$erro2['CHECKDATA']	= 'Aion txt != Sou2';		$args['database']['T_CHECKDATA'][] = $erro2;	++$diffcount; }
	}
	foreach($database['T_BIBLE_SOURCE'] as $vref => $verse) {
		if ($diffcount>=$diffmax) { break; }
		$error['CHECKDATA']	= $erro2['CHECKDATA']	= '';
		$error['VREF']		= $erro2['VREF']		= $vref;
		if (!empty($args['database']['T_UNTRANSLATEREVERSE_SOURCE'][$bible.'-'.$vref.'-SKIP'])) { continue; }
		if (!empty($args['database']['T_UNTRANSLATEREVERSE_SOURCE'][$bible.'-'.$vref])) {
			$error['VREF']	= $erro2['VREF']		= $vref =	$args['database']['T_UNTRANSLATEREVERSE_SOURCE'][$bible.'-'.$vref]['INDEX'].'-'.
																$args['database']['T_UNTRANSLATEREVERSE_SOURCE'][$bible.'-'.$vref]['BOOK'].'-'.
																$args['database']['T_UNTRANSLATEREVERSE_SOURCE'][$bible.'-'.$vref]['CHAPTER'].'-'.
																$args['database']['T_UNTRANSLATEREVERSE_SOURCE'][$bible.'-'.$vref]['VERSE'];
		}
		$error['INDEX']		= $erro2['INDEX']		= $verse['INDEX'];
		$error['BOOK']		= $erro2['BOOK']		= $verse['BOOK'];
		$error['CHAPTER']	= $erro2['CHAPTER']		= $verse['CHAPTER'];
		$error['VERSE']		= $erro2['VERSE']		= $verse['VERSE'];
		$error['TEXT']		= $erro2['TEXT']		= $verse['TEXT'];
		if (empty($database['T_BIBLE_STANDARD'][$vref])) {							$error['CHECKDATA']	= 'Sour ref != Stan';		$args['database']['T_CHECKDATA'][] = $error;	++$diffcount; }
		else if ($verse['TEXT']!=$database['T_BIBLE_STANDARD'][$vref]['TEXT']) {	$error['CHECKDATA']	= 'Sour txt != Stan';		$args['database']['T_CHECKDATA'][] = $error;
			$erro2['TEXT'] = $database['T_BIBLE_STANDARD'][$vref]['TEXT'];			$erro2['CHECKDATA']	= 'Sour txt != Sta2';		$args['database']['T_CHECKDATA'][] = $erro2;	++$diffcount; }
		if (empty($database['T_BIBLE_AIONIAN'][$vref])) {							$error['CHECKDATA']	= 'Sour ref != Aion';		$args['database']['T_CHECKDATA'][] = $error;	++$diffcount; }
		else if ($verse['TEXT']!=$database['T_BIBLE_AIONIAN'][$vref]['TEXT']) {		$error['CHECKDATA']	= 'Sour txt != Aion';		$args['database']['T_CHECKDATA'][] = $error;
			$erro2['TEXT'] = $database['T_BIBLE_AIONIAN'][$vref]['TEXT'];			$erro2['CHECKDATA']	= 'Sour txt != Aio2';		$args['database']['T_CHECKDATA'][] = $erro2;	++$diffcount; }
	}
	if ($diffcount>=$diffmax) { AION_ECHO("WARNING! $bible diffcount maxed!!!"); }
	AION_unset($database['T_BIBLE_SOURCE']); $database['T_BIBLE_SOURCE']=NULL; unset($database['T_BIBLE_SOURCE']);
	gc_collect_cycles();
	$count_aionian = count($database['T_BIBLE_AIONIAN']);
	$count_standard = count($database['T_BIBLE_STANDARD']);
	$counts = 'aionian='.$count_aionian.' standard='.$count_standard.' source='.$count_source;
	$error['CHECKDATA']	= "Data checks: $counts";
	$error['VREF'] = $error['INDEX'] = $error['BOOK'] = $error['CHAPTER'] = $error['VERSE'] = $error['TEXT'] = '';
	$args['database']['T_CHECKDATA'][] = $error;
	$result = "DATA CHECK: $counts file=$file_aionian";
	AION_ECHO($result);
	$args['database']['T_TALLY'][$bible] = array('BIBLE'=>$bible,'AIONIAN'=>$count_aionian,'STANDARD'=>$count_standard,'SOURCE'=>$count_source);
	AION_unset($error); $error=NULL; unset($error);
	AION_unset($erro2); $$erro2=NULL; unset($erro2);
	AION_unset($database['T_BIBLE_AIONIAN']); $database['T_BIBLE_AIONIAN']=NULL; unset($database['T_BIBLE_AIONIAN']);
	AION_unset($database['T_BIBLE_STANDARD']); $database['T_BIBLE_STANDARD']=NULL; unset($database['T_BIBLE_STANDARD']);
	AION_unset($database); $database=NULL; unset($database);
	gc_collect_cycles();
	// determine which bible is the memory problem culprit
	if (!empty($args['debug'])) {
		AION_FILE_DATA_PUT('XDEBUG-'.$bible,$args['database']['T_CHECKDATA']);
	}
}
function AION_LOOP_CHECKDATA_CLEANUP(&$bible,$nospace,$allowunset,$biblename, $trueifrawtext) {
	static $database = FALSE; if ($database===FALSE) { $database = array(); AION_FILE_DATA_GET( './aion_database/BOOKSCOUNT.txt', 'T_BOOKSCOUNT', $database, 'BOOK', FALSE ); }
	foreach($bible as $vref => &$verse) {
		if ($verse['BOOK']=='JOH' && $verse['CHAPTER']==3 && ($verse['VERSE']==15 || $verse['VERSE']==16)) { continue; }
		if ($allowunset && AION_BIBLES_REMAPPER_FUNK($verse['INDEX'],$verse['BOOK'],$verse['CHAPTER'],$verse['VERSE'],$database['T_BOOKSCOUNT'])) {
			AION_unset($bible[$vref]); $bible[$vref]=NULL; unset($bible[$vref]);
			continue;
		}
		if ($nospace) {	$verse['TEXT'] = preg_replace('/ \([^(]+ (g|G|h|H)[[:digit:]]+\) {0,1}/','',$verse['TEXT']); }
		else {			$verse['TEXT'] = preg_replace('/ \([^(]+ (g|G|h|H)[[:digit:]]+\)/','',$verse['TEXT']); }
		if ($nospace) {	$verse['TEXT'] = preg_replace('/ \(questioned\) {0,1}/','',$verse['TEXT']); }
		else {			$verse['TEXT'] = preg_replace('/ \(questioned\)/','',$verse['TEXT']); }
		$verse['TEXT'] = preg_replace('/house of Hell/','house of Heli',$verse['TEXT']);
		$verse['TEXT'] = preg_replace('/vision to Hell/','vision to Heli',$verse['TEXT']);
		$verse['TEXT'] = preg_replace('/ \(Adah proper name\)/','',$verse['TEXT']);
		// WHY IS NULL POSSIBLE?
		if (!$verse['TEXT']) { AION_ECHO("WARNING! AION_LOOP_CHECKDATA_CLEANUP() preg_replace()==NULL: bible = $biblename, ".$verse['INDEX']." ".$verse['BOOK']." ".$verse['CHAPTER']." ".$verse['VERSE']); }
		$dummy=NULL;
		if (($verse['TEXT'] = AION_TEXT_REPAIR($verse['TEXT'], $vref, $biblename, $trueifrawtext, $dummy,$verse['VERSE']))===FALSE) { AION_unset($bible[$vref]); $bible[$vref]=NULL; unset($bible[$vref]); continue; }
		if ($verse['BOOK']=='PSA' || $verse['BOOK']=='HAB') { $verse['TEXT'] = AION_TEXT_SELAH($verse['TEXT'], $vref, $biblename); }
	}
}


/*** CHECK: AION WITH STANDARD ***/
function AION_LOOP_CHECK_UNTRANSLATE_COMPARE($source, $output) {
	$database = array();
	$database['T_UNTRANSLATECOMPARE'] = array();
	AION_FILE_DATA_GET( './aion_database/UNTRANSLATEREVERSE.txt', 'T_UNTRANSLATEREVERSE', $database, array('BIBLE','INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	AION_FILE_DATA_GET( './aion_database/BOOKSSTANDARD.noia', 'T_BOOKSSTANDARD', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	AION_LOOP( array(
		'function'	=> 'AION_LOOP_CHECK_UNTRANSLATE_COMPARE_DOIT',
		'source'	=> $source,
		'include'	=> "/---Aionian-Edition\.noia$/",
		'destiny'	=> '/tmp',
		'database'	=> &$database,
		) );
	AION_FILE_DATA_PUT($output,$database['T_UNTRANSLATECOMPARE']);
	AION_unset($database); $database=NULL; unset($database);
}
function AION_LOOP_CHECK_UNTRANSLATE_COMPARE_DOIT($args) {
	if (!preg_match("/\/(Holy-Bible---.*)---Aionian-Edition\.noia/", $args['filepath'], $matches)) {	AION_ECHO("ERROR! Failed to preg_match(Holy-Bible): ".$args['filepath']);	}
	$bible = $matches[1];
	$file_aionian  = $args['filepath'];
	$database = $compare = array();
	$compare['BIBLE'] = $bible;
	AION_FILE_DATA_GET( $file_aionian,  'T_BIBLE_AIONIAN',  $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	foreach($args['database']['T_UNTRANSLATEREVERSE'] as $vref => $verse) {
		if ($verse['BIBLE']!=$bible || preg_match('/SKIP/',$verse['VERSE'])) { continue; }
		if (empty($database['T_BIBLE_AIONIAN'][$verse['INDEX'].'-'.$verse['BOOK'].'-'.$verse['CHAPTER'].'-'.$verse['VERSE']])) { AION_ECHO("ERROR! Untranslate failed to map back: ".$vref); }
		$compare['INDEX']	= $verse['INDEX'];
		$compare['BOOK']	= $verse['BOOK'];
		$compare['CHAPTER']	= $verse['CHAPTER'];
		$compare['VERSE']	= $verse['VERSE'];
		$compare['TEXT']	= $database['T_BIBLE_AIONIAN'][$verse['INDEX'].'-'.$verse['BOOK'].'-'.$verse['CHAPTER'].'-'.$verse['VERSE']]['TEXT'];
		if (empty($args['database']['T_BOOKSSTANDARD'][$verse['INDEX'].'-'.$verse['BOOK'].'-'.$verse['CHAPTER'].'-'.$verse['VERSE']])) {
			AION_ECHO("WARNING! Untranslate failed to map to standard: ".$vref);
			$compare['STANDARD']='STANDARD MISSING';
		}
		else {
			$compare['STANDARD']= $args['database']['T_BOOKSSTANDARD'][$verse['INDEX'].'-'.$verse['BOOK'].'-'.$verse['CHAPTER'].'-'.$verse['VERSE']]['TEXT'];
		}
		$args['database']['T_UNTRANSLATECOMPARE'][] = $compare;
	}
	AION_ECHO('UNTRANSLATE COMPARE TO STANDARD: '.$bible);
	AION_unset($compare); $compare=NULL; unset($compare);
	AION_unset($database); $database=NULL; unset($database);
}


/*** CHECK: AION WITH STANDARD ***/
function AION_CHECK_DIFF_TWO_FILES($one, $two, $diff) {
	system('diff '.$one.' '.$two.' 2>&1 > '.$diff );
	AION_ECHO('REMINDER: CHECK DIFF FILES: '.$diff);
}



/*** sitemap loop ***/
function AION_SITEMAP($root) {
	// init master
	$UPDATED = date("Y-m-d");
	$sitemap_mast = "<?xml version='1.0' encoding='UTF-8'?>\n<sitemapindex xmlns='https://www.sitemaps.org/schemas/sitemap/0.9'>\n";
	if (!file_exists("$root/sitemaps") && !mkdir("$root/sitemaps")) {				AION_ECHO("ERROR! AION_SITEMAP mkdir($root/sitemaps)"); }
	
	// sitemap_aionianbible.xml
	$sitemap_name  = "sitemaps/sitemap_AionianBible.xml.gz";
	$sitemap_mast .= "<sitemap><loc>https://www.AionianBible.org/$sitemap_name</loc><lastmod>$UPDATED</lastmod></sitemap>\n";
	$sitemap_file  = "<?xml version='1.0' encoding='UTF-8'?>\n<urlset xmlns='https://www.sitemaps.org/schemas/sitemap/0.9'>\n";
	$sitemap_file .= "<url><loc>https://www.AionianBible.org</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>1.0</priority></url>\n";
	$sitemap_file .= "<url><loc>https://www.AionianBible.org/Preface</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.9</priority></url>\n";
	$sitemap_file .= "<url><loc>https://www.AionianBible.org/Destiny</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.9</priority></url>\n";
	$sitemap_file .= "<url><loc>https://www.AionianBible.org/Buy</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.9</priority></url>\n";
	$sitemap_file .= "<url><loc>https://www.AionianBible.org/Aionios-and-Aidios</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.9</priority></url>\n";
	$sitemap_file .= "<url><loc>https://www.AionianBible.org/Glossary</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.9</priority></url>\n";
	$sitemap_file .= "<url><loc>https://www.AionianBible.org/Read</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.9</priority></url>\n";
	$sitemap_file .= "<url><loc>https://www.AionianBible.org/Readers-Guide</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.9</priority></url>\n";
	$sitemap_file .= "<url><loc>https://www.AionianBible.org/History</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.9</priority></url>\n";
	$sitemap_file .= "<url><loc>https://www.AionianBible.org/Maps</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.9</priority></url>\n";
	$sitemap_file .= "<url><loc>https://www.AionianBible.org/Publisher</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.9</priority></url>\n";
	$sitemap_file .= "<url><loc>https://www.AionianBible.org/Promote</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.9</priority></url>\n";
	$sitemap_file .= "<url><loc>https://www.AionianBible.org/Bible-Cover</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.9</priority></url>\n";
	$sitemap_file .= "<url><loc>https://www.AionianBible.org/Apple-iOS-App</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.9</priority></url>\n";
	$sitemap_file .= "<url><loc>https://www.AionianBible.org/Third-Party-Publisher-Resources</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.9</priority></url>\n";
	$sitemap_file .= "<url><loc>https://www.AionianBible.org/Strongs</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.9</priority></url>\n";
	$sitemap_file .= "</urlset>\n";
	if (!($fp = gzopen("$root/$sitemap_name", 'w9'))) {								AION_ECHO("ERROR! AION_SITEMAP gzopen($root/$sitemap_name)"); }
	if (gzwrite($fp,$sitemap_file)!=strlen($sitemap_file)) {						AION_ECHO("ERROR! AION_SITEMAP gzwrite($root/$sitemap_name)"); }
	if (!gzclose($fp)) {															AION_ECHO("ERROR! AION_SITEMAP gzclose($root/$sitemap_name)"); }
	AION_ECHO('SITEMAP: '.$sitemap_name);
	
	// bible sitemaps
	if (!is_array(($bible_ALL = json_decode(file_get_contents("$root/library/Holy-Bible---AAA---Versions.json"),true)))) {	AION_ECHO("ERROR! AION_SITEMAP versions file missing: ".$root); }
	if (!is_array(($_BibleBOOKS = json_decode(file_get_contents("$root/library/Holy-Bible---AAA---Books.json"),true)))) {	AION_ECHO("ERROR! AION_SITEMAP books file missing: ".$root); }
	
	// verse all
	$sitemap_vall = "<?xml version='1.0' encoding='UTF-8'?>\n<urlset xmlns='https://www.sitemaps.org/schemas/sitemap/0.9'>\n";
	
	// bible loop
	foreach($bible_ALL as $bible => $version ) {
		// one bible sitemap at a time
		$holybible = $bible;
		$bible = str_replace('Holy-Bible---','',$bible);
		if (!is_array(($_BibleONE = @json_decode(file_get_contents(($biblefile="$root/library/Holy-Bible---$bible---Aionian-Edition.json")),true))) || empty($_BibleONE['T_BOOKS'])) {
																					AION_ECHO("ERROR! AION_SITEMAP bible file missing: ".$biblefile); }
		end($_BibleONE['T_BOOKS']);		$last  = $_BibleBOOKS[key($_BibleONE['T_BOOKS'])]['NUMBER'];
		reset($_BibleONE['T_BOOKS']);	$first = $_BibleBOOKS[key($_BibleONE['T_BOOKS'])]['NUMBER'];

		$sitemap_name  = "sitemaps/sitemap_$bible.xml.gz";
		$sitemap_mast .= "<sitemap><loc>https://www.AionianBible.org/$sitemap_name</loc><lastmod>$UPDATED</lastmod></sitemap>\n";
		$sitemap_file  = "<?xml version='1.0' encoding='UTF-8'?>\n<urlset xmlns='https://www.sitemaps.org/schemas/sitemap/0.9'>\n";
		// main
		$sitemap_file .= "<url><loc>https://www.AionianBible.org/Bibles/$bible</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.8</priority></url>\n";
		$sitemap_file .= "<url><loc>https://www.AionianBible.org/Bibles/$bible/Noted</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.8</priority></url>\n";
		if ($first<=39) { $sitemap_file .= "<url><loc>https://www.AionianBible.org/Bibles/$bible/Old</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.8</priority></url>\n"; }
		if ($last >=40) { $sitemap_file .= "<url><loc>https://www.AionianBible.org/Bibles/$bible/New</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.8</priority></url>\n"; }
        if (is_dir("$root/library/epub/$holybible---Aionian-Edition")) {
			$sitemap_file .= "<url><loc>https://www.AionianBible.org/epub/"		.$holybible ."---Aionian-Edition</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.7</priority></url>\n";
			$sitemap_file .= "<url><loc>https://www.AionianBible.org/Readium/"	.$holybible ."---Aionian-Edition</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.7</priority></url>\n";
		}
		if (is_dir("$root/library/epub/$holybible---Source-Edition")) {
			$sitemap_file .= "<url><loc>https://www.AionianBible.org/epub/"		.$holybible ."---Source-Edition</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.7</priority></url>\n";
			$sitemap_file .= "<url><loc>https://www.AionianBible.org/Readium/"	.$holybible ."---Source-Edition</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.7</priority></url>\n";
		}
		// books
		foreach($_BibleONE['T_BOOKS'] as $bookkey => $bookname) {
			if (empty($bookkey) || empty($bookname)) { continue; }
			if (!file_exists("$root/library/online/$holybible---Aionian-Edition/".$_BibleBOOKS[$bookkey]['NUMBER'].'-'.$_BibleBOOKS[$bookkey]['CODE'].'-001.json')) { continue; }
			$sitemap_file .= "<url><loc>https://www.AionianBible.org/Bibles/$bible/$bookkey</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.7</priority></url>\n";
			if ($bible=='English---King-James-Version') {
				$sitemap_vall .= "<url><loc>https://www.AionianBible.org/Verse/All/$bookkey</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.7</priority></url>\n";				
			}
			// chapters
			for( $chapter=1; $chapter<=$_BibleBOOKS[$bookkey]['CHAPTERS']; ++$chapter ) {
				$sitemap_file .= "<url><loc>https://www.AionianBible.org/Bibles/$bible/$bookkey/$chapter</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.6</priority></url>\n";
				if ($bible=='English---King-James-Version') {
					$sitemap_vall .= "<url><loc>https://www.AionianBible.org/Verse/All/$bookkey/$chapter</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.6</priority></url>\n";				
				}
				// verses
				$bible_VERSE = json_decode(file_get_contents(($chapterfile="$root/library/online/$holybible---Aionian-Edition/".$_BibleBOOKS[$bookkey]['NUMBER'].'-'.$_BibleBOOKS[$bookkey]['CODE'].'-'.sprintf('%03d', $chapter).'.json')),true);
				if (!is_array($bible_VERSE) || empty($bible_VERSE)) {				AION_ECHO("ERROR! AION_SITEMAP chapter file missing: ".$chapterfile); }
				foreach($bible_VERSE as $versekey => $verse) {
					$sitemap_file .= "<url><loc>https://www.AionianBible.org/Bibles/$bible/$bookkey/$chapter/$versekey</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>\n";
					if ($bible=='English---King-James-Version') {
						$sitemap_vall .= "<url><loc>https://www.AionianBible.org/Verse/All/$bookkey/$chapter/$versekey</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>\n";				
					}
				}
			}
		}
		$sitemap_file .= "</urlset>\n";
		if (!($fp = gzopen("$root/$sitemap_name", 'w9'))) {							AION_ECHO("ERROR! AION_SITEMAP gzopen($root/$sitemap_name)"); }
		if (gzwrite($fp,$sitemap_file)!=strlen($sitemap_file)) {					AION_ECHO("ERROR! AION_SITEMAP gzwrite($root/$sitemap_name)"); }
		if (!gzclose($fp)) {														AION_ECHO("ERROR! AION_SITEMAP gzclose($root/$sitemap_name)"); }
		AION_ECHO('SITEMAP: '.$sitemap_name);
		AION_unset($_BibleONE); $_BibleONE=NULL; unset($_BibleONE);
		AION_unset($bible_VERSE); $bible_VERSE=NULL; unset($bible_VERSE);
	}
	
	// Verse/All
	$sitemap_name  = "sitemaps/sitemap_AionianBible-VerseAll.xml.gz";
	$sitemap_mast .= "<sitemap><loc>https://www.AionianBible.org/$sitemap_name</loc><lastmod>$UPDATED</lastmod></sitemap>\n";	
	$sitemap_vall .= "</urlset>\n";
	if (!($fp = gzopen("$root/$sitemap_name", 'w9'))) {							AION_ECHO("ERROR! AION_SITEMAP gzopen($root/$sitemap_name)"); }
	if (gzwrite($fp,$sitemap_vall)!=strlen($sitemap_vall)) {					AION_ECHO("ERROR! AION_SITEMAP gzwrite($root/$sitemap_name)"); }	
	if (!gzclose($fp)) {														AION_ECHO("ERROR! AION_SITEMAP gzclose($root/$sitemap_name)"); }
	
	// strongs sitemap
	$sitemap_name  = "sitemaps/sitemap_AionianBible-StrongsConcordance.xml.gz";
	$sitemap_mast .= "<sitemap><loc>https://www.AionianBible.org/$sitemap_name</loc><lastmod>$UPDATED</lastmod></sitemap>\n";
	$sitemap_file  = "<?xml version='1.0' encoding='UTF-8'?>\n<urlset xmlns='https://www.sitemaps.org/schemas/sitemap/0.9'>\n";
	// loop hebrew
	if (!($fd=fopen('../www-stage/library/stepbible/Hebrew_Lexicon_Tyndale.txt', 'r'))) { AION_ECHO("ERROR! !fopen(Hebrew Tyndale)"); }
	while (($line=fgets($fd))) {
		if (!preg_match("#^(\d+)([[:alnum:]]{0,1})\t#u", $line, $match)) {		continue; }
		$stid = $match[1].(isset($match[2]) ? $match[2] : "");
		$sitemap_file .= "<url><loc>https://www.AionianBible.org/Strongs/strongs-h$stid</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>\n";
	}
	fclose($fd);
	// loop greek
	if (!($fd=fopen('../www-stage/library/stepbible/Greek_Lexicon_Tyndale.txt', 'r'))) { AION_ECHO("ERROR! !fopen(Greek Tyndale)"); }
	while (($line=fgets($fd))) {
		if (!preg_match("#^(\d+)([[:alnum:]]{0,1})\t#u", $line, $match)) {		continue; }
		$stid = $match[1].(isset($match[2]) ? $match[2] : "");
		$sitemap_file .= "<url><loc>https://www.AionianBible.org/Strongs/strongs-g$stid</loc><lastmod>$UPDATED</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>\n";
	}
	fclose($fd);	
	$sitemap_file .= "</urlset>\n";
	if (!($fp = gzopen("$root/$sitemap_name", 'w9'))) {							AION_ECHO("ERROR! AION_SITEMAP gzopen($root/$sitemap_name)"); }
	if (gzwrite($fp,$sitemap_file)!=strlen($sitemap_file)) {					AION_ECHO("ERROR! AION_SITEMAP gzwrite($root/$sitemap_name)"); }
	if (!gzclose($fp)) {														AION_ECHO("ERROR! AION_SITEMAP gzclose($root/$sitemap_name)"); }
	AION_ECHO('SITEMAP: '.$sitemap_name);
	
	// write master
	$sitemap_mast .= "</sitemapindex>\n";
	if (file_put_contents("$root/sitemap.xml", $sitemap_mast)!=strlen($sitemap_mast)) {	AION_ECHO("ERROR! AION_SITEMAP file_put_contents(sitemap.xml): ".$root); }
	AION_ECHO('SITEMAP: sitemap.xml');
}



/*** aion testwords loop ***/
function AION_LOOP_TESTWORDS($testwords, $source, $destiny) {
	$database = array();
	AION_FILE_DATA_GET( './aion_database/UNTRANSLATE.txt', 'T_UNTRANSLATE', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	AION_FILE_DATA_GET( './aion_database/UNTRANSLATECUSTOM.txt', 'T_UNTRANSLATECUSTOM', $database, array('BIBLE','INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	AION_FILE_DATA_GET( './aion_database/UNTRANSLATEWORDS.txt', 'T_UNTRANSLATEWORDS', $database, 'BIBLE', FALSE );
	$database['T_TEXTRESULT'] = array();
	AION_LOOP( array(
		'function'	=> 'AION_LOOP_TESTWORDS_DOIT',
		'include'	=> "/Aionian-Edition\.noia$/",
		'database'	=> &$database,
		'destiny'	=> $destiny,
		'source'	=> $source,
		'testwords'	=> $testwords,
		) );
	AION_FILE_DATA_PUT("$destiny/TESTWORDS.txt",$database['T_TEXTRESULT']);
	AION_unset($database); $database=NULL; unset($database);
}
function AION_LOOP_TESTWORDS_DOIT($args) {
	if (!preg_match("/\/(Holy-Bible---.*)---Aionian-Edition\.noia/", $args['filepath'], $matches)) {	AION_ECHO("ERROR! Failed to preg_match(Holy-Bible): ".$args['filepath']);	}
	$bible = $matches[1];
	$nospace = $args['database'][T_UNTRANSLATEWORDS][$bible]['NOSPACE'];
	$database = array();
	AION_FILE_DATA_GET( $args['filepath'], 'T_BIBLE', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	$result = array();
	$total_words = 0;
	$total_scanned = 0;
	$total_all = 0;
	$total_266 = 0;
	$total_out = 0;
	foreach($args['database'][T_UNTRANSLATEWORDS][$bible] as $key => $words) {
		if ($key=='BIBLE' || $key=='NOSPACE') {
			$result[$key]=$words;
			continue;
		}
		$result[$key]='';
		$group_all = 0;
		$group_266 = 0;
		$group_out = 0;
		$words = trim($words," ,");
		if (!empty($args['testwords'][$bible][$key])) { $words .= ",".trim($args['testwords'][$bible][$key]," ,") ; }
		foreach(explode(",",$words) as $word) {
			$word = trim($word);
			if (empty($word)) { continue; }
			++$total_words;
			$result[$key] .= $word;
			$count_all = 0;
			$count_266 = 0;
			$count_out = 0;
			foreach($database['T_BIBLE'] as $ref => $verse) {
				++$total_scanned;
				$search = $nospace ? "/$word/ui" : '/(^|\s|[[:punct:]])('.$word.')($|\s|[[:punct:]])/ui';
				if (preg_match($search,$verse['TEXT'])) {
					++$total_all;
					++$group_all;
					++$count_all;
					if (!empty($args['database'][T_UNTRANSLATE][$ref]['WORD']) || (!empty($args['database'][T_UNTRANSLATECUSTOM][$bible.'-'.$ref]['WORD']) && $args['database'][T_UNTRANSLATECUSTOM][$bible.'-'.$ref]['WORD']!='SKIP')) {
						++$total_266;
						++$group_266;
						++$count_266;
					}
					else if ($key!='NOETERNAL' || 40 <= $verse['INDEX']) {  // only concerned about NOETERNAL for New Testament
						++$total_out;
						++$group_out;
						++$count_out;
					}
				}
			}
			$result[$key] .= "=$count_all/$count_266/$count_out, ";
		}
		$result[$key] .= "GROUP=$group_all/$group_266/$group_out";
	}
	if (!is_array($result) || empty($result)) {	AION_ECHO("ERROR! Result array empty!"); }
	$args['database']['T_TEXTRESULT'][$bible] = $result;
	AION_unset($result); $result=NULL; unset($result);
	AION_unset($database); $database=NULL; unset($database);
	AION_ECHO("SUCCESS TESTWORDS: BIBLE=$bible, WORDS=$total_words, SCANNED=$total_scanned, MATCHES=$total_all, AIONIAN=$total_266, OUT=$total_out");
}






/*** aion testwords loop ***/
function AION_LOOP_ANAVIGATION($source, $destiny) {
	$database = array();
	AION_FILE_DATA_GET( './aion_database/UNTRANSLATE.txt', 'T_UNTRANSLATE', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	AION_FILE_DATA_GET( './aion_database/BOOKS.txt', 'T_BOOKS', $database, 'BIBLE', FALSE );
	$database['T_ANAVIGATION'] = array();
	AION_LOOP( array(
		'function'	=> 'AION_LOOP_ANAVIGATION_DOIT',
		'include'	=> "/Aionian-Edition\.noia$/",
		'database'	=> &$database,
		'destiny'	=> $destiny,
		'source'	=> $source,
		) );
	AION_FILE_DATA_PUT("$destiny//ANAVIGATION.txt",$database['T_ANAVIGATION']);
	AION_ECHO("AIONIAN MISSING: COUNT=".count($database['T_ANAVIGATION']));
	AION_unset($database); $database=NULL; unset($database);
}
function AION_LOOP_ANAVIGATION_DOIT($args) {
	if (!preg_match("/\/(Holy-Bible---.*)---Aionian-Edition\.noia/", $args['filepath'], $matches)) {	AION_ECHO("ERROR! Failed to preg_match(Holy-Bible): ".$args['filepath']);	}
	$bible = $matches[1];
	$database = array();
	AION_FILE_DATA_GET($args['filepath'], 'T_BIBLE', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	$count = 0;
	$args['database']['T_ANAVIGATION'][] = array('BIBLE'=>$bible,'STATUS'=>'','MISSING'=>'');
	AION_ECHO("AIONIAN NAVIGATION: BIBLE=$bible");
	foreach($args['database']['T_UNTRANSLATE'] as $key => $untranslate) {
		if ($args['database']['T_BOOKS'][$bible][array_search($untranslate['BOOK'],$args['database']['T_BOOKS']['CODE'])]=='NULL') { continue; }
		if (!empty($database['T_BIBLE'][$key])) { continue; }
		$key0 = preg_replace('/-\d\d\d-\d\d\d$/','',$key);
		if (empty($database['T_BIBLE'][$key0.'-001-001']) && empty($database['T_BIBLE'][$key0.'-001-002'])) { continue; }
		$key1 = preg_replace('/-\d\d\d$/','-001',$key);
		$status = (empty($database['T_BIBLE'][$key1]) ? 'CHAPMISS' : 'VERSMISS');
		$args['database']['T_ANAVIGATION'][] = array('BIBLE'=>$bible,'STATUS'=>$status,'MISSING'=>$key);
		AION_ECHO("AIONIAN NAVIGATION: BIBLE=$bible, STATUS=$status MISSING=$key");
	}
	AION_unset($database); $database=NULL; unset($database);
}



/*** retrieve foreign language numbers from ebible.org epub files! ***/
function AION_LOOP_NUMBERSHOT($source, $include, $destiny) {
	$database = array();
	$database['T_NUMBERSHOT'] = array();
	AION_LOOP( array(
		'function'	=> 'AION_LOOP_NUMBERSHOT_DOIT',
		'source'	=> $source,
		'include'	=> "/Aionian-Edition\.noia$/",
		'destiny'	=> './',
		'database'	=> &$database,
		) );
	AION_FILE_DATA_PUT($destiny,$database['T_NUMBERSHOT']);
	AION_unset($database); $database=NULL; unset($database);
}
function AION_LOOP_NUMBERSHOT_DOIT($args) {
	// bible
	if (!preg_match("/\/(Holy-Bible---.*)---Aionian-Edition\.noia/", $args['filepath'], $matches)) {	AION_ECHO("ERROR! Failed to preg_match(Holy-Bible): ".$args['filepath']);	}
	$bible = $matches[1];
	// default numbers first
	$args['database']['T_NUMBERSHOT'][$bible] = array('BIBLE'=>$bible);
	for($x=1; $x<=176; ++$x) { $args['database']['T_NUMBERSHOT'][$bible][$x] = $x; }
	// english - skip it all
	if (stripos($bible,'English')!==FALSE) {
		AION_ECHO('SEARCHED NUMBERSHOT SKIP ENGLISH! '.$args['filename']);
		return;
	}
	// find epub
	if (!($filepath=preg_replace("/---Aionian-Edition\.noia/", "---Source-Edition.epub", $args['filepath']))) {	AION_ECHO("ERROR! Failed to preg_replace(Source-Edition.epub): ".$args['filepath']); }
	if (!is_file($filepath)) {
		AION_ECHO("SEARCHED NUMBERSHOT NO EPUB FOR THIS ONE! $filepath");
		return;
	}
	// unzip epub	
	$temp = 'tmp.numbershot.'.$bible;
	system('rm -rf '.$temp);
	system('unzip -q '.$filepath.' -d '.$temp);
	if (!is_dir($temp)) { AION_ECHO("ERROR! failed isdir=".$temp); }
	// look for Psalm 119/118
	else if (is_file("$temp/OEBPS/PSA.xhtml")) {
		if (!($content=file_get_contents("$temp/OEBPS/PSA.xhtml"))) {	AION_ECHO("ERROR! Problem reading PSA.xhtml: ".$args['filepath']); }
		$cnum = 176;
		$chap = 'PS119_';
		$chap2 = 'PS118_';
	}
	// look for Luke 1/22
	else if (is_file("$temp/OEBPS/LUK.xhtml")) {
		if (!($content=file_get_contents("$temp/OEBPS/LUK.xhtml"))) {	AION_ECHO("ERROR! Problem reading LUK.xhtml: ".$args['filepath']); }
		$cnum = 80;
		$chap = 'LK1_';
		$chap2 = 'LK22_';
	}
	// look for Matthew 26/27
	else if (is_file("$temp/OEBPS/MAT.xhtml")) {
		if (!($content=file_get_contents("$temp/OEBPS/MAT.xhtml"))) {	AION_ECHO("ERROR! Problem reading MAT.xhtml: ".$args['filepath']); }
		$cnum = 75;
		$chap = 'MT26_';
		$chap2 = 'MT27_';
	}
	// look for Mark 14/6
	else if (is_file("$temp/OEBPS/MRK.xhtml")) {
		if (!($content=file_get_contents("$temp/OEBPS/MRK.xhtml"))) {	AION_ECHO("ERROR! Problem reading MRK.xhtml: ".$args['filepath']); }
		$cnum = 72;
		$chap = 'MK14_';
		$chap2 = 'MK6_';
	}
	// no go
	else {
		AION_ECHO("WARN! No epub to search! ".$args['filepath']);
		$cnum = 0;
		$chap = 'NOGO';
	}
	// search for numbers
	for($x=1; $x<=$cnum; ++$x) {
		if (!preg_match(($search="/id=\"".$chap .$x."\">(.+)&#/ui"),$content,$matches,PREG_OFFSET_CAPTURE) &&
			!preg_match(($search="/id=\"".$chap2.$x."\">(.+)&#/ui"),$content,$matches,PREG_OFFSET_CAPTURE)) {
			AION_ECHO("WARN! NUMBER NOT FOUND search=$search ".$filepath);
			continue;
		}
		if (!empty($matches[2]) || empty($matches[1][0]) || empty($matches[1][1])) {
			error_log(print_r($matches,TRUE));
			AION_ECHO("ERROR! BAD MATCH, see error_log search=$search ".$filepath);
		}
		$args['database']['T_NUMBERSHOT'][$bible][$x] = $matches[1][0];
	}
	// done
	system('rm -rf '.$temp);
	AION_ECHO("SEARCHED NUMBERSHOT chap=$chap cnum=$cnum file=$filepath");
}




/*** aion loop special ***/
function AION_LOOP_SPECIAL($source, $destiny) {
	system('rm -rf '.$destiny);
	if (is_dir($destiny)) { AION_ECHO("ERROR! existing isdir=".$destiny); }
	if (!mkdir($destiny)) {	AION_ECHO("ERROR! mkdir()"); }
	AION_LOOP( array(
		'function'	=> 'AION_LOOP_SPECIAL_DOIT',
		'source'	=> $source,
		'include'	=> "/---Aionian-Edition\.noia$/",
		'destiny'	=> $destiny,
		) );
}
function AION_LOOP_SPECIAL_DOIT($args) {
	AION_ECHO("WARNING! Special function to do something to all Bibles, currently does nothing!");
	return;
	// bible
	if (!preg_match("/\/(Holy-Bible---.*)---Aionian-Edition\.noia/", $args['filepath'], $matches)) {	AION_ECHO("ERROR! Failed to preg_match(Holy-Bible): ".$args['filepath']);	}
	$bible = $matches[1];
	// output files
	if (!($fd_A1=fopen($args['destiny'].'/Aionian-Edition.1result', 'a'))) {												print_r(error_get_last()); AION_ECHO('ERROR! SPECIAL !fopen(A1)'); }
	if (!($fd_A2=fopen($args['destiny'].'/Aionian-Edition.2result', 'a'))) {												print_r(error_get_last()); AION_ECHO('ERROR! SPECIAL !fopen(A2)'); }
	if (!($fd_B1=fopen($args['destiny'].'/Standard-Edition.1result', 'a'))) {												print_r(error_get_last()); AION_ECHO('ERROR! SPECIAL !fopen(B1)'); }
	if (!($fd_B2=fopen($args['destiny'].'/Standard-Edition.2result', 'a'))) {												print_r(error_get_last()); AION_ECHO('ERROR! SPECIAL !fopen(B2)'); }
	// bible databases
	if (!($standardpath=preg_replace("/---Aionian-Edition\.noia/", "---Standard-Edition.noia", $args['filepath']))) {	AION_ECHO("ERROR! Failed to preg_replace(Standard-Edition.noia): ".$args['filepath']); }
	$database = array();
	AION_FILE_DATA_GET( $args['filepath'], 'T_BIBLE_A', $database, FALSE, FALSE );
	AION_FILE_DATA_GET( $standardpath, 'T_BIBLE_S', $database, FALSE, FALSE );
	// doit
	foreach($database['T_BIBLE_A'] as $verse) {
		if(preg_match('/[ap]{1}\.m\./ui', $verse['TEXT'])) { AION_ECHO("WARN! SPECIAL SKIP AM|PM $bible ".$verse['TEXT']); continue; }
		if(preg_match('/[^.]{1}[.?!]{1}[[:upper:]]{1}/u', $verse['TEXT'])) {
			if (!fwrite($fd_A1,"$bible\t".$verse['INDEX']."\t".$verse['BOOK']."\t".$verse['CHAPTER']."\t".$verse['VERSE']."\t".$verse['TEXT']."\r\n")) { print_r(error_get_last()); AION_ECHO('ERROR! SPECIAL !fwrite(A1)'); }
		}
		if(preg_match('/[^.]{1}[.?!]{1}[[:alpha:]]{1}/u', $verse['TEXT'])) {
			if (!fwrite($fd_A2,"$bible\t".$verse['INDEX']."\t".$verse['BOOK']."\t".$verse['CHAPTER']."\t".$verse['VERSE']."\t".$verse['TEXT']."\r\n")) { print_r(error_get_last()); AION_ECHO('ERROR! SPECIAL !fwrite(A2)'); }
		}
	}
	foreach($database['T_BIBLE_S'] as $verse) {
		if(preg_match('/[ap]{1}\.m\./ui', $verse['TEXT'])) { AION_ECHO("WARN! SPECIAL SKIP AM|PM $bible ".$verse['TEXT']); continue; }
		if(preg_match('/[^.]{1}[.?!]{1}[[:upper:]]{1}/u', $verse['TEXT'])) {
			if (!fwrite($fd_B1,"$bible\t".$verse['INDEX']."\t".$verse['BOOK']."\t".$verse['CHAPTER']."\t".$verse['VERSE']."\t".$verse['TEXT']."\r\n")) { print_r(error_get_last()); AION_ECHO('ERROR! SPECIAL !fwrite(B1)'); }
		}
		if(preg_match('/[^.]{1}[.?!]{1}[[:alpha:]]{1}/u', $verse['TEXT'])) {
			if (!fwrite($fd_B2,"$bible\t".$verse['INDEX']."\t".$verse['BOOK']."\t".$verse['CHAPTER']."\t".$verse['VERSE']."\t".$verse['TEXT']."\r\n")) { print_r(error_get_last()); AION_ECHO('ERROR! SPECIAL !fwrite(B2)'); }
		}
	}
	// wrap up
	fclose($fd_A1);
	fclose($fd_A2);
	fclose($fd_B1);
	fclose($fd_B2);
	AION_unset($database); $database=NULL; unset($database);
	AION_ECHO("SUCCESS SPECIAL! $bible");
}




/*** aion untranslate loop ***/
function AION_LOOP_SPELL($file, $folder) {
	if (!file_exists($folder) && !mkdir($folder)) { AION_ECHO("ERROR! AION_SITEMAP mkdir($folder)"); }
	if (!file_exists($folder.'-MARKER') && !mkdir($folder.'-MARKER')) { AION_ECHO("ERROR! AION_SITEMAP mkdir($folder.'-MARKER')"); }
	if (!file_exists($folder.'-diff') && !mkdir($folder.'-diff')) { AION_ECHO("ERROR! AION_SITEMAP mkdir($folder.'-diff')"); }
	$output = <<<EOT
#!/usr/local/bin/php
<?php
// Spell checker script, automatically generated
require_once('./aion_common.php');

EOT;
	$database = array();
	AION_FILE_DATA_GET( './aion_database/VERSIONS.txt', 'T_VERSIONS', $database, FALSE, FALSE );
	foreach($database['T_VERSIONS'] as $version) {
		$spell = $version['LANGUAGESPELL'];
		$spell = $spell=="" ? "WORDS" : $spell;
		$bible = $version['BIBLE'];
		$output .= "// SPELL CHECK: $bible ($spell)\n";
		if ($spell=='SKIP') {
			$output .= "\n\n\n\n";
			continue;
		}
		$output .= <<<EOT
system("cat ../www-stageresources/$bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\\\n/g' | ".
"sort | uniq ".
"> $folder/$bible.WORDS");

EOT;
		$extra = ($spell=="en" ? "--personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws" : "");
		$output .= "system('wc -l $folder/$bible.WORDS');\n";
		if ($spell!='WORDS') {
			$output .= <<<EOT
system("cat $folder/$bible.WORDS | ".
"aspell list --lang=$spell $extra ".
"> $folder/$bible.$spell");

EOT;
		$output .= "system('wc -l $folder/$bible.$spell');\n";
		}
		$output .= "\n\n\n\n";
		AION_ECHO("SPELL CHECK: $bible, $spell");
	}
	$output .= "\n\n";
	$output .= "AION_LOOP_DIFF('$folder','$folder-MARKER','$folder-diff');\n";

	if (file_put_contents($file, $output) === FALSE ) { AION_ECHO('ERROR! AION_FILE_DATA_PUT file_put_contents() '.$file); }	
}





/*** max chapter verse ***/
function AION_BIBLES_LIST_MAX($book,$chapter) {
static $standard = array();
if (empty($standard)) {
	$database = array();
	AION_FILE_DATA_GET( './aion_database/BOOKSSTANDARD.noia', 'T_BOOKSSTANDARD', $database, FALSE, FALSE);
	foreach($database['T_BOOKSSTANDARD'] as $verse) { $standard[$verse['BOOK'].'-'.$verse['CHAPTER']] = (int)$verse['VERSE']; }		
	AION_unset($database); $database=NULL; unset($database);
}
$chapter = sprintf('%03d', (int)$chapter);
if (empty($standard[$book.'-'.$chapter])) { return 0; }
return $standard[$book.'-'.$chapter];
}
	
/*** aion bible book to index number array ***/
function AION_BIBLES_LIST() {
return(array(
'XXX' => 'XXX',
'GEN' => 'Genesis',
'EXO' => 'Exodus',
'LEV' => 'Leviticus',
'NUM' => 'Numbers',
'DEU' => 'Deuteronomy',
'JOS' => 'Joshua',
'JDG' => 'Judges',
'RUT' => 'Ruth',
'1SA' => '1 Samuel',
'2SA' => '2 Samuel',
'1KI' => '1 Kings',
'2KI' => '2 Kings',
'1CH' => '1 Chronicles',
'2CH' => '2 Chronicles',
'EZR' => 'Ezra',
'NEH' => 'Nehemiah',
'EST' => 'Esther',
'JOB' => 'Job',
'PSA' => 'Psalms',
'PRO' => 'Proverbs',
'ECC' => 'Ecclesiastes',
'SOL' => 'Song of Solomon',
'ISA' => 'Isaiah',
'JER' => 'Jeremiah',
'LAM' => 'Lamentations',
'EZE' => 'Ezekiel',
'DAN' => 'Daniel',
'HOS' => 'Hosea',
'JOE' => 'Joel',
'AMO' => 'Amos',
'OBA' => 'Obadiah',
'JON' => 'Jonah',
'MIC' => 'Micah',
'NAH' => 'Nahum',
'HAB' => 'Habakkuk',
'ZEP' => 'Zephaniah',
'HAG' => 'Haggai',
'ZEC' => 'Zechariah',
'MAL' => 'Malachi',
'MAT' => 'Matthew',
'MAR' => 'Mark',
'LUK' => 'Luke',
'JOH' => 'John',
'ACT' => 'Acts',
'ROM' => 'Romans',
'1CO' => '1 Corinthians',
'2CO' => '2 Corinthians',
'GAL' => 'Galatians',
'EPH' => 'Ephesians',
'PHI' => 'Philippians',
'COL' => 'Colossians',
'1TH' => '1 Thessalonians',
'2TH' => '2 Thessalonians',
'1TI' => '1 Timothy',
'2TI' => '2 Timothy',
'TIT' => 'Titus',
'PHM' => 'Philemon',
'HEB' => 'Hebrews',
'JAM' => 'James',
'1PE' => '1 Peter',
'2PE' => '2 Peter',
'1JO' => '1 John',
'2JO' => '2 John',
'3JO' => '3 John',
'JUD' => 'Jude',
'REV' => 'Revelation',

/* aionian apocrypha */
'151' => 'Psalm 151',
'1EN' => 'I Enoch',
'1ES' => '1 Esdras',
'2ES' => '2 Esdras',
'4ES' => '2 Esdras',
'1MA' => '1 Maccabees',
'2MA' => '2 Maccabees',
'3MA' => '3 Maccabees',
'4MA' => '4 Maccabees',
'BAR' => 'Baruch',
'BEL' => 'Bel and the Dragon',
'DNG' => 'Daniel, Greek Additions',
'DNA' => 'Additions to Daniel',
'EPJ' => 'Epistle of Jeremiah',
'ESG' => 'Esther, Greek Additions',
'ESA' => 'Additions to Esther',
'ETG' => 'Esther, Greek',
'JDT' => 'Judith',
'LAD' => 'Laodiceans',
'ODE' => 'Odes',
'POA' => 'Prayer of Azariah',
'POS' => 'Psalm of Solomon',
'PRA' => 'Prayer of Azarias (Song of Three Holy Children)',
'PRM' => 'Prayer of Manasses',
'PSX' => 'Psalm of David (Goliath Combat)',
'SIR' => 'Sirach',
'SUS' => 'Susanna',
'TOB' => 'Tobit',
'WIS' => 'Wisdom of Solomon',
'PSZ' => 'Additional Psalm',
));
}


/*** sword book map ***/
function AION_BIBLES_LIST_SWORD() {
return(array(
'GEN' => 'Genesis',
'EXO' => 'Exodus',
'LEV' => 'Leviticus',
'NUM' => 'Numbers',
'DEU' => 'Deuteronomy',
'JOS' => 'Joshua',
'JDG' => 'Judges',
'RUT' => 'Ruth',
'1SA' => 'I Samuel',
'2SA' => 'II Samuel',
'1KI' => 'I Kings',
'2KI' => 'II Kings',
'1CH' => 'I Chronicles',
'2CH' => 'II Chronicles',
'EZR' => 'Ezra',
'NEH' => 'Nehemiah',
'EST' => 'Esther',
'JOB' => 'Job',
'PSA' => 'Psalms',
'PRO' => 'Proverbs',
'ECC' => 'Ecclesiastes',
'SOL' => 'Song of Solomon',
'ISA' => 'Isaiah',
'JER' => 'Jeremiah',
'LAM' => 'Lamentations',
'EZE' => 'Ezekiel',
'DAN' => 'Daniel',
'HOS' => 'Hosea',
'JOE' => 'Joel',
'AMO' => 'Amos',
'OBA' => 'Obadiah',
'JON' => 'Jonah',
'MIC' => 'Micah',
'NAH' => 'Nahum',
'HAB' => 'Habakkuk',
'ZEP' => 'Zephaniah',
'HAG' => 'Haggai',
'ZEC' => 'Zechariah',
'MAL' => 'Malachi',
'MAT' => 'Matthew',
'MAR' => 'Mark',
'LUK' => 'Luke',
'JOH' => 'John',
'ACT' => 'Acts',
'ROM' => 'Romans',
'1CO' => 'I Corinthians',
'2CO' => 'II Corinthians',
'GAL' => 'Galatians',
'EPH' => 'Ephesians',
'PHI' => 'Philippians',
'COL' => 'Colossians',
'1TH' => 'I Thessalonians',
'2TH' => 'II Thessalonians',
'1TI' => 'I Timothy',
'2TI' => 'II Timothy',
'TIT' => 'Titus',
'PHM' => 'Philemon',
'HEB' => 'Hebrews',
'JAM' => 'James',
'1PE' => 'I Peter',
'2PE' => 'II Peter',
'1JO' => 'I John',
'2JO' => 'II John',
'3JO' => 'III John',
'JUD' => 'Jude',
'REV' => 'Revelation of John',

/* unbound apocrypha */
'151' => 'Psalm I5I',
'1EN' => 'I Enoch',
'1ES' => 'I Esdras',
'2ES' => 'II Esdras',
'4ES' => 'II Esdras',
'1MA' => 'I Maccabees',
'2MA' => 'II Maccabees',
'3MA' => 'III Maccabees',
'4MA' => 'IV Maccabees',
'BAR' => 'Baruch',
'BEL' => 'Bel and the Dragon',
'DNG' => 'Daniel, Greek Additions',
'DNA' => 'Additions to Daniel',
'EPJ' => 'Epistle of Jeremiah',
'ESG' => 'Esther, Greek Additions',
'ESA' => 'Additions to Esther',
'ETG' => 'Esther (Greek)',
'JDT' => 'Judith',
'LAD' => 'Laodiceans',
'ODE' => 'Odes',
'POA' => 'Prayer of Azariah',
'POS' => 'Psalms of Solomon',
'PRA' => 'Prayer of Azarias (Song of Three Holy Children)',
'PRM' => 'Prayer of Manasses',
'PSX' => 'Psalm of David (Goliath Combat)',
'SIR' => 'Sirach',
'SUS' => 'Susanna',
'TOB' => 'Tobit',
'WIS' => 'Wisdom',
'PSZ' => 'Additional Psalm',
));
}



/*** bible4u book map ***/
function AION_BIBLES_LIST_B4U() {
return(array(
'GEN' => 'Gen',
'EXO' => 'Exod',
'LEV' => 'Lev',
'NUM' => 'Num',
'DEU' => 'Deut',
'JOS' => 'Josh',
'JDG' => 'Judg',
'RUT' => 'Ruth',
'1SA' => '1Sam',
'2SA' => '2Sam',
'1KI' => '1Kgs',
'2KI' => '2Kgs',
'1CH' => '1Chr',
'2CH' => '2Chr',
'EZR' => 'Ezra',
'NEH' => 'Neh',
'EST' => 'Esth',
'JOB' => 'Job',
'PSA' => 'Ps',
'PRO' => 'Prov',
'ECC' => 'Eccl',
'SOL' => 'Song',
'ISA' => 'Isa',
'JER' => 'Jer',
'LAM' => 'Lam',
'EZE' => 'Ezek',
'DAN' => 'Dan',
'HOS' => 'Hos',
'JOE' => 'Joel',
'AMO' => 'Amos',
'OBA' => 'Obad',
'JON' => 'Jonah',
'MIC' => 'Mic',
'NAH' => 'Nah',
'HAB' => 'Hab',
'ZEP' => 'Zeph',
'HAG' => 'Hag',
'ZEC' => 'Zech',
'MAL' => 'Mal',
'MAT' => 'Matt',
'MAR' => 'Mark',
'LUK' => 'Luke',
'JOH' => 'John',
'ACT' => 'Acts',
'ROM' => 'Rom',
'1CO' => '1Cor',
'2CO' => '2Cor',
'GAL' => 'Gal',
'EPH' => 'Eph',
'PHI' => 'Phil',
'COL' => 'Col',
'1TH' => '1Thess',
'2TH' => '2Thess',
'1TI' => '1Tim',
'2TI' => '2Tim',
'TIT' => 'Titus',
'PHM' => 'Phlm',
'HEB' => 'Heb',
'JAM' => 'Jas',
'1PE' => '1Pet',
'2PE' => '2Pet',
'1JO' => '1John',
'2JO' => '2John',
'3JO' => '3John',
'JUD' => 'Jude',
'REV' => 'Rev',

/* apocrypha */
'TOB' => 'Tob',
'JDT' => 'Jdt',
'1MA' => '1Macc',
'2MA' => '2Macc',
'BAR' => 'Bar',
'WIS' => 'Wis',
'SIR' => 'Sir',
));
}


/*** unbound bible book to standard abbreviation ***/
function AION_BIBLES_LIST_UNB() {
return(array(
'01O' => 'GEN',
'02O' => 'EXO',
'03O' => 'LEV',
'04O' => 'NUM',
'05O' => 'DEU',
'06O' => 'JOS',
'07O' => 'JDG',
'08O' => 'RUT',
'09O' => '1SA',
'10O' => '2SA',
'11O' => '1KI',
'12O' => '2KI',
'13O' => '1CH',
'14O' => '2CH',
'15O' => 'EZR',
'16O' => 'NEH',
'17O' => 'EST',
'18O' => 'JOB',
'19O' => 'PSA',
'20O' => 'PRO',
'21O' => 'ECC',
'22O' => 'SOL',
'23O' => 'ISA',
'24O' => 'JER',
'25O' => 'LAM',
'26O' => 'EZE',
'27O' => 'DAN',
'28O' => 'HOS',
'29O' => 'JOE',
'30O' => 'AMO',
'31O' => 'OBA',
'32O' => 'JON',
'33O' => 'MIC',
'34O' => 'NAH',
'35O' => 'HAB',
'36O' => 'ZEP',
'37O' => 'HAG',
'38O' => 'ZEC',
'39O' => 'MAL',
'40N' => 'MAT',
'41N' => 'MAR',
'42N' => 'LUK',
'43N' => 'JOH',
'44N' => 'ACT',
'45N' => 'ROM',
'46N' => '1CO',
'47N' => '2CO',
'48N' => 'GAL',
'49N' => 'EPH',
'50N' => 'PHI',
'51N' => 'COL',
'52N' => '1TH',
'53N' => '2TH',
'54N' => '1TI',
'55N' => '2TI',
'56N' => 'TIT',
'57N' => 'PHM',
'58N' => 'HEB',
'59N' => 'JAM',
'60N' => '1PE',
'61N' => '2PE',
'62N' => '1JO',
'63N' => '2JO',
'64N' => '3JO',
'65N' => 'JUD',
'66N' => 'REV',

/* unbound apocrypha */
'67A' => 'TOB',
'68A' => 'JDT',
'69A' => 'ESG',
'70A' => 'WIS',
'71A' => 'SIR',
'72A' => 'BAR',
'73A' => 'EPJ',
'74A' => 'PRA',
'75A' => 'SUS',
'76A' => 'BEL',
'77A' => '1MA',
'78A' => '2MA',
'79A' => '3MA',
'80A' => '4MA',
'81A' => '1ES',
'82A' => '2ES',
'83A' => 'PRM',
'84A' => '151',
'85A' => 'POS',
'86A' => 'ODE',
));
}


/*** Tyndale STEPBible to standard abbreviation ***/
function AION_BIBLES_LIST_TYN() {
return(array(
'GEN' => 'GEN',
'EXO' => 'EXO',
'LEV' => 'LEV',
'NUM' => 'NUM',
'DEU' => 'DEU',
'JOS' => 'JOS',
'JDG' => 'JDG',
'RUT' => 'RUT',
'1SA' => '1SA',
'2SA' => '2SA',
'1KI' => '1KI',
'2KI' => '2KI',
'1CH' => '1CH',
'2CH' => '2CH',
'EZR' => 'EZR',
'NEH' => 'NEH',
'EST' => 'EST',
'JOB' => 'JOB',
'PSA' => 'PSA',
'PRO' => 'PRO',
'ECC' => 'ECC',
'SNG' => 'SOL',
'ISA' => 'ISA',
'JER' => 'JER',
'LAM' => 'LAM',
'EZK' => 'EZE',
'DAN' => 'DAN',
'HOS' => 'HOS',
'JOL' => 'JOE',
'AMO' => 'AMO',
'OBA' => 'OBA',
'JON' => 'JON',
'MIC' => 'MIC',
'NAM' => 'NAH',
'HAB' => 'HAB',
'ZEP' => 'ZEP',
'HAG' => 'HAG',
'ZEC' => 'ZEC',
'MAL' => 'MAL',
'MAT' => 'MAT',
'MRK' => 'MAR',
'LUK' => 'LUK',
'JHN' => 'JOH',
'ACT' => 'ACT',
'ROM' => 'ROM',
'1CO' => '1CO',
'2CO' => '2CO',
'GAL' => 'GAL',
'EPH' => 'EPH',
'PHP' => 'PHI',
'COL' => 'COL',
'1TH' => '1TH',
'2TH' => '2TH',
'1TI' => '1TI',
'2TI' => '2TI',
'TIT' => 'TIT',
'PHM' => 'PHM',
'HEB' => 'HEB',
'JAS' => 'JAM',
'1PE' => '1PE',
'2PE' => '2PE',
'1JN' => '1JO',
'2JN' => '2JO',
'3JN' => '3JO',
'JUD' => 'JUD',
'REV' => 'REV',
));
}

// return bible chapter index
function AION_BIBLES_CHAPTER_INDEX() {
return(array(
'GEN' => 0,
'EXO' => 50,
'LEV' => 90,
'NUM' => 117,
'DEU' => 153,
'JOS' => 187,
'JDG' => 211,
'RUT' => 232,
'1SA' => 236,
'2SA' => 267,
'1KI' => 291,
'2KI' => 313,
'1CH' => 338,
'2CH' => 367,
'EZR' => 403,
'NEH' => 413,
'EST' => 426,
'JOB' => 436,
'PSA' => 478,
'PRO' => 628,
'ECC' => 659,
'SOL' => 671,
'ISA' => 679,
'JER' => 745,
'LAM' => 797,
'EZE' => 802,
'DAN' => 850,
'HOS' => 862,
'JOE' => 876,
'AMO' => 879,
'OBA' => 888,
'JON' => 889,
'MIC' => 893,
'NAH' => 900,
'HAB' => 903,
'ZEP' => 906,
'HAG' => 909,
'ZEC' => 911,
'MAL' => 925,
'MAT' => 0,
'MAR' => 28,
'LUK' => 44,
'JOH' => 68,
'ACT' => 89,
'ROM' => 117,
'1CO' => 133,
'2CO' => 149,
'GAL' => 162,
'EPH' => 168,
'PHI' => 174,
'COL' => 178,
'1TH' => 182,
'2TH' => 187,
'1TI' => 190,
'2TI' => 196,
'TIT' => 200,
'PHM' => 203,
'HEB' => 204,
'JAM' => 217,
'1PE' => 222,
'2PE' => 227,
'1JO' => 230,
'2JO' => 235,
'3JO' => 236,
'JUD' => 237,
'REV' => 238,
));
}