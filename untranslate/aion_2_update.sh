#!/usr/local/bin/php
<?php



/*** init ***/
require_once('./aion_common.php');
AION_ECHO("START " . basename(__FILE__, '.php'));

/*** update bibles and diff ***/
$result = system(($command='cp -a ../source-stage/. ../www-stageresources/'));
AION_LOOP_UNPACK('../www-stageresources/');
AION_LOOP_DIFF('../source-stage', '../www-stageresources', '../diff-source-stage-with-source-production-AFTER-UPDATE');

AION_ECHO("DONE! Command=" . $command . " Result=" . $result );
