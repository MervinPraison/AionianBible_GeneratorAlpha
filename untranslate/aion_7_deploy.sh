#!/usr/local/bin/php
<?php



/*** init ***/
require_once('./aion_common.php');
AION_ECHO("START " . basename(__FILE__, '.php'));
$LIVE		= '../www-production-files';
$BACK		= '../www-backup';
$BACK2		= '../www-backup-tmp';
$STAGE		= '../www-stage';
$AION		= './aion_customize_index';
$TEMP		= 'tmp.www-deploy';
$TEMPBACK	= 'www-backup';
$TEMPLIVE	= 'www-production-files';
$LINK		= 'www-production';
$WEBS		= '/datawebs';


/*** point production to old www-backup ***/
AION_ECHO("PRODUCTION TO BACKUP");
system("rm -rf $TEMP");
if (!is_dir($BACK)) {															AION_ECHO("ERROR! no backup available: $BACK"); }
if (!mkdir("$TEMP/$TEMPBACK",0755,TRUE)) {										AION_ECHO("ERROR! mkdir failed: $TEMP/$TEMPBACK"); }
if (!chdir($TEMP)) {															AION_ECHO("ERROR! chdir: $TEMP"); }
system("ln -s $TEMPBACK $LINK");		if (!is_dir($LINK)) {					AION_ECHO("ERROR! ln failed: $LINK"); }
system("mv -f $LINK ../../");			if (!is_dir("../../$LINK")) {			AION_ECHO("ERROR! mv failed: $LINK"); }
if (!chdir("../")) {															AION_ECHO("ERROR! chdir: .."); }


/*** prepare stage for production from current live ***/
AION_ECHO("STAGE TO PRODUCTION");
if (!chmod($STAGE,0755)) {														AION_ECHO("ERROR! chmod failed: $STAGE"); }
if (!chmod("$STAGE/library",0755)) {											AION_ECHO("ERROR! chmod failed: $STAGE/library"); }
if (!chmod("$STAGE/library/pwa",0755)) {										AION_ECHO("ERROR! chmod failed: $STAGE/library/pwa"); }
system("rm -rf $STAGE$WEBS");			if (is_dir("$STAGE$WEBS")) {			AION_ECHO("ERROR! rm -rf failed: $STAGE$WEBS"); }
system("cp -R $LIVE$WEBS $STAGE$WEBS");	if (!is_dir("$STAGE$WEBS")) {			AION_ECHO("ERROR! cp -a $STAGE$WEBS"); }
system("rm -rf $AION$WEBS");			if (is_dir("$AION$WEBS")) {				AION_ECHO("ERROR! rm -rf failed: $AION$WEBS"); }
system("cp -R $LIVE$WEBS $AION$WEBS");	if (!is_dir("$AION$WEBS")) {			AION_ECHO("ERROR! cp -a $AION$WEBS"); }


/*** copy to new live and prepare ***/
system("mv $LIVE $BACK2");				if (is_dir($LIVE) || !is_dir($BACK2)) {	AION_ECHO("ERROR! mv failed: $LIVE $BACK2"); }
system("cp -R $STAGE $LIVE");			if (!is_dir($LIVE)) {					AION_ECHO("ERROR! cp -a $LIVE"); }
if (!chmod($LIVE,0755)) {														AION_ECHO("ERROR! chmod failed: $LIVE"); }
if (!chmod("$LIVE/library",0755)) {												AION_ECHO("ERROR! chmod failed: $LIVE/library"); }
if (!chmod("$LIVE/library/pwa",0755)) {											AION_ECHO("ERROR! chmod failed: $LIVE/library/pwa"); }

/*** live resources also ***/
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
system("rm -rf $LIVE/library/*.php" );
$database = array();
AION_FILE_DATA_GET(			'./aion_database/VERSIONS.txt',	'T_VERSIONS',	$database, 'BIBLE', TRUE );
AION_FILE_DATA_GET(			'./aion_database/BOOKS.txt',	'T_BOOKS',		$database, 'BIBLE', TRUE );
AION_FILE_DATA_GET(			'./aion_database/NUMBERS.txt',	'T_NUMBERS',	$database, 'BIBLE', TRUE );
AION_FILE_DATABASE_BOOKS(	$database );
AION_FILE_DATABASE_PUT(		$database, '../www-resources', "$LIVE/library", FALSE);
if (!copy("./aion_customize_index/.htaccess", "$LIVE/.htaccess")) {				AION_ECHO("ERROR! copy failed: $LIVE/.htaccess"); }


/*** go live ***/
if (!mkdir("$TEMP/$TEMPLIVE",0755,TRUE)) {										AION_ECHO("ERROR! mkdir failed: $TEMP/$TEMPLIVE"); }
if (!chdir($TEMP)) {															AION_ECHO("ERROR! chdir: $TEMP"); }
system("ln -s $TEMPLIVE $LINK");		if (!is_dir($LINK)) {					AION_ECHO("ERROR! ln failed: $LINK"); }
system("mv -f $LINK ../../");			if (!is_dir('../../'.$LINK)) {			AION_ECHO("ERROR! mv failed: $LINK"); }
if (!chdir("../")) {															AION_ECHO("ERROR! chdir: .."); }
system("rm -rf $TEMP");


/*** replace temp backup with new backup ***/
system("rm -rf $BACK");					if (is_dir($BACK)) {					AION_ECHO("ERROR! rm failed: $BACK"); }
system("mv $BACK2 $BACK");				if (!is_dir($BACK)) {					AION_ECHO("ERROR! mv failed: $BACK2"); }
if (!chmod($BACK,0755)) {														AION_ECHO("ERROR! chmod failed: $BACK"); }
if (!chmod("$BACK/library",0755)) {												AION_ECHO("ERROR! chmod failed: $BACK/library"); }
if (!chmod("$BACK/library/pwa",0755)) {											AION_ECHO("ERROR! chmod failed: $BACK/library/pwa"); }

/*** diff after deploy, should be no differences! ***/
AION_LOOP_DIFF(	'../www-stage/library', 	'../www-production/library',	'../diff-www-stage-with-www-production-AFTER-DEPLOY',			'/\.php$/', '', 'stageresources','resources');
AION_LOOP_DIFF(	'../www-stageresources', 	'../www-resources',				'../diff-www-stageresources-with-www-resources-AFTER-DEPLOY',	'',			'/(Aionian-Edition\.noia|Standard-Edition\.noia|Source-Edition\.epub)$/');

/*** remove Turkish ***/
system('rm -rf ../www-resources/Holy-Bible---Turkish---Turkish-Bible---*' );
system('chmod 640 ../www-stageresources/Holy-Bible---Turkish---Turkish-Bible---*' );

/*** done ***/
AION_ECHO("DONE! DEPLOYMENT SUCCESS!!");
AION_ECHO("CHECK BACKUP FOLDER!");
