#!/usr/local/bin/php
<?php



/*** init ***/
require_once('./aion_common.php');
AION_ECHO("START " . basename(__FILE__, '.php'));
define('LIVE',		'../www-production-files');
define('BACK',		'../www-backup');
define('STAGE',		'../www-stage');
define('AION',		'./aion_customize_index');
define('TEMP',		'tmp.www-deploy');
define('TEMPBACK',	'www-backup');
define('TEMPLIVE',	'www-production-files');
define('LINK',		'www-production');
define('WEBS',		'/datawebs');
define('DATA',		'./aion_database');


/*** production to backup and temporarily repoint symbolic link ***/
AION_ECHO("PRODUCTION TO BACKUP");
system('rm -rf '.TEMP );
system('rm -rf '.BACK);						if (is_dir(BACK)) {				AION_ECHO('ERROR! rm -rf failed: '.BACK); }
system('cp -R '.LIVE.' '.BACK);				if (!is_dir(BACK)) {			AION_ECHO('ERROR! cp -R '.BACK); }
if (!mkdir(TEMP.'/'.TEMPBACK,0755,TRUE)) {									AION_ECHO('ERROR! mkdir failed: '.TEMP.'/'.TEMPBACK); }
if (!chdir(TEMP)) {															AION_ECHO('ERROR! chdir: '.TEMP); }
system('ln -s '.TEMPBACK.' '.LINK);			if (!is_dir(LINK)) {			AION_ECHO('ERROR! ln failed: '.LINK); }
system('mv '.LINK.' ../../');				if (!is_dir('../../'.LINK)) {	AION_ECHO('ERROR! mv failed: '.LINK); }
if (!chdir('..')) {															AION_ECHO('ERROR! chdir: ..'); }


/*** save DATAWEBS! ***/
system('rm -rf '.STAGE.WEBS);				if (is_dir(STAGE.WEBS)) {		AION_ECHO('ERROR! rm -rf failed: '.STAGE.WEBS); }
system('cp -R '.LIVE.WEBS.' '.STAGE.WEBS);	if (!is_dir(STAGE.WEBS)) {		AION_ECHO('ERROR! cp -R '.STAGE.WEBS); }
system('rm -rf '.AION.WEBS);				if (is_dir(AION.WEBS)) {		AION_ECHO('ERROR! rm -rf failed: '.AION.WEBS); }
system('cp -R '.LIVE.WEBS.' '.AION.WEBS);	if (!is_dir(AION.WEBS)) {		AION_ECHO('ERROR! cp -R '.AION.WEBS); }


/*** stage to production and finally repoint symbolic link ***/
AION_ECHO("STAGE TO PRODUCTION");
system('rm -rf '.LIVE);						if (is_dir(LIVE)) {				AION_ECHO('ERROR! rm -rf failed: '.LIVE); }
system('cp -R '.STAGE.' '.LIVE);			if (!is_dir(LIVE)) {			AION_ECHO('ERROR! cp -R '.LIVE); }


/*** tuneup LIVE before going LIVE ***/
system('rm -rf '.LIVE.'/library/*.php' );
system("rsync -amv \
	--include='*Source-Edition.pdf' \
	--include='*Source-Edition.epub' \
	--include='*Source-Edition.SWORD.zip' \
	--include='*Source-Edition.*.txt' \
	--include='*Aionian-Edition.epub' \
 	--include='*Aionian-Edition.pdf' \
	--include='*Aionian-Edition---STUDY.pdf' \
	--include='*Aionian-Edition.noia' \
	--include='*Standard-Edition.noia' \
	--exclude='*/' \
	--exclude='*' \
	../www-stageresources/ \
	../www-resources/ ");
$database = array();
AION_FILE_DATA_GET(			'./aion_database/VERSIONS.txt',	'T_VERSIONS',	$database, 'BIBLE', TRUE );
AION_FILE_DATA_GET(			'./aion_database/BOOKS.txt',	'T_BOOKS',		$database, 'BIBLE', TRUE );
AION_FILE_DATA_GET(			'./aion_database/NUMBERS.txt',	'T_NUMBERS',	$database, 'BIBLE', TRUE );
AION_FILE_DATABASE_BOOKS(	$database );
AION_FILE_DATABASE_PUT(		$database, '../www-resources', LIVE.'/library', FALSE);

if (!chmod(LIVE,0755)) {													AION_ECHO('ERROR! chmod failed: '.LIVE); }
if (!chmod(LIVE.'/library',0755)) {											AION_ECHO('ERROR! chmod failed: '.LIVE.'/library'); }
if (!chmod(BACK,0755)) {													AION_ECHO('ERROR! chmod failed: '.BACK); }
if (!chmod(STAGE,0755)) {													AION_ECHO('ERROR! chmod failed: '.STAGE); }


/*** okay go LIVE ***/
if (!mkdir(TEMP.'/'.TEMPLIVE,0755,TRUE)) {									AION_ECHO('ERROR! mkdir failed: '.TEMP.'/'.TEMPLIVE); }
if (!chdir(TEMP)) {															AION_ECHO('ERROR! chdir: '.TEMP); }
system('ln -s '.TEMPLIVE.' '.LINK);			if (!is_dir(LINK)) {			AION_ECHO('ERROR! ln failed: '.LINK); }
system('mv '.LINK.' ../../');				if (!is_dir('../../'.LINK)) {	AION_ECHO('ERROR! mv failed: '.LINK); }
if (!chdir('..')) {															AION_ECHO('ERROR! chdir: ..'); }
system('rm -rf '.TEMP );


/*** diff after deploy, should be no differences! ***/
AION_LOOP_DIFF		(	'../www-stage/library', 	'../www-production/library',	'../diff-www-stage-with-www-production-AFTER-DEPLOY', '/\.php$/', '', 'stageresources','resources');
AION_LOOP_DIFF		(	'../www-stageresources', 	'../www-resources',				'../diff-www-stageresources-with-www-resources-AFTER-DEPLOY', '', '/(Aionian-Edition\.noia|Standard-Edition\.noia|Source-Edition\.epub)$/');

/*** remove Turkish ***/
system('rm -rf ../www-resources/Holy-Bible---Turkish---Turkish-Bible---*' );

/*** done ***/
AION_ECHO("DONE! DEPLOYMENT SUCCESS!!");
AION_ECHO("MAKE SURE ARCHIVE IS GOOD!  DELETE TEMPORARY BACKUP IF PRODUCTION OKAY!  SAVE SPACE!  rm -rf ".BACK);
