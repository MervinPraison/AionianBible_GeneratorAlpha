#!/usr/local/bin/php
<?php



/*** init ***/
require_once('./aion_common.php');
AION_ECHO("START " . basename(__FILE__, '.php'));
define('LIVE',		'../www-production-files');
define('ARCHIVE',	'../www-archive');

/*** production to archive ***/
AION_ECHO("PRODUCTION TO ARCHIVE");
system('rm -rf '.ARCHIVE);					if (is_dir(ARCHIVE)) {			AION_ECHO('ERROR! rm -rf failed: '.ARCHIVE); }
system('cp -R '.LIVE.' '.ARCHIVE);			if (!is_dir(ARCHIVE)) {			AION_ECHO('ERROR! cp -R '.ARCHIVE); }

/*** dunno why but chmod! ***/
if (!chmod(ARCHIVE,0755)) {													AION_ECHO('ERROR! chmod failed: '.ARCHIVE); }

/*** ZIP IT ***/
if (!chdir('../')) { AION_ECHO("ERROR! chdir"); }
system('tar -czf ../domain.signedon.net.archive/www.AionianBible.org.tar.gz www-production-files');
system('tar -czf ../domain.signedon.net.archive/www.AionianBible.org.RESOURCES.tar.gz www-resources');
system('tar -czf ../domain.signedon.net.archive/www.AionianBible.org.TOOLS.tar.gz untranslate');

/*** done ***/
AION_ECHO("DONE! ARCHIVE SUCCESS!!");
