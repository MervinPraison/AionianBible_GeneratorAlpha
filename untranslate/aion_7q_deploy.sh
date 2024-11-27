#!/usr/local/bin/php
<?php



/*** init ***/
require_once('./aion_common.php');
AION_ECHO("START " . basename(__FILE__, '.php'));


/*** save DATAWEBS! ***/
define('LIVE',		'../www-production-files');
define('STAGE',		'../www-stage');
define('AION',		'./aion_customize_index');
define('WEBS',		'/datawebs');
system('rm -rf '.STAGE.WEBS);				if (is_dir(STAGE.WEBS)) {		AION_ECHO('ERROR! rm -rf failed: '.STAGE.WEBS); }
system('cp -R '.LIVE.WEBS.' '.STAGE.WEBS);	if (!is_dir(STAGE.WEBS)) {		AION_ECHO('ERROR! cp -R '.STAGE.WEBS); }
system('rm -rf '.AION.WEBS);				if (is_dir(AION.WEBS)) {		AION_ECHO('ERROR! rm -rf failed: '.AION.WEBS); }
system('cp -R '.LIVE.WEBS.' '.AION.WEBS);	if (!is_dir(AION.WEBS)) {		AION_ECHO('ERROR! cp -R '.AION.WEBS); }


/*** Resources ***/
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


/*** database ***/
$database = array();
AION_FILE_DATA_GET(			'./aion_database/VERSIONS.txt',	'T_VERSIONS',	$database, 'BIBLE', TRUE );
AION_FILE_DATA_GET(			'./aion_database/BOOKS.txt',	'T_BOOKS',		$database, 'BIBLE', TRUE );
AION_FILE_DATA_GET(			'./aion_database/NUMBERS.txt',	'T_NUMBERS',	$database, 'BIBLE', TRUE );
AION_FILE_DATABASE_BOOKS(	$database );
AION_FILE_DATABASE_PUT(		$database, '../www-resources', LIVE.'/library', FALSE);

/*** install index ***/
AION_INSTALL_INDEX(			'../www-production');
AION_INSTALL_INDEX_UPDATED(	'../www-production/index.php');
AION_SITEMAP(				'../www-production');

/*** remove Turkish ***/
system('rm -rf ../www-resources/Holy-Bible---Turkish---Turkish-Bible---*' );
system('chmod 640 ../www-stageresources/Holy-Bible---Turkish---Turkish-Bible---*' );

/*** done ***/
AION_ECHO("DONE!");
