#!/usr/local/bin/php
<?php



/*** init ***/
require_once('./aion_common.php');
AION_ECHO("START " . basename(__FILE__, '.php'));

/*** update bibles and diff ***/
$result = system(($command='cp -a ../source-stage/. ../www-stageresources/'));
AION_LOOP_UNPACK('../www-stageresources/');
AION_LOOP_DIFF('../source-stage', '../www-stageresources', '../diff-source-stage-with-source-production-AFTER-UPDATE');

/*** unpack and specially diff the STEPBibleData */
system("rm -rf ../STEPBible-Data-master");
system("unzip -q ../www-stageresources/AB-STEPBibleData.zip -d ../");
system("mv '../STEPBible-Data-master/Lexicons/'* ../STEPBible-Data-master");
system("mv '../STEPBible-Data-master/Translators Amalgamated OT+NT/'* ../STEPBible-Data-master");
AION_LOOP_DIFF('../STEPBible-Data-master', '../STEPBible-Data-master-production', '../STEPBible-Data-master-diff-raw', '', '', '', '', '--strip-trailing-cr');

/*** remove Turkish ***/
system('rm -rf ../www-resources/Holy-Bible---Turkish---Turkish-Bible---*' );
system('chmod 640 ../www-stageresources/Holy-Bible---Turkish---Turkish-Bible---*' );

AION_ECHO("DONE! Command=" . $command . " Result=" . $result );
