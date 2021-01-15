#!/usr/local/bin/php
<?php


/*** init ***/
require_once('./aion_common.php');
AION_ECHO("START " . basename(__FILE__, '.php'));


AION_ECHO("CREATE UNTRANSLATE MODULE");
AION_LOOP_CHECK_UNTRANSLATE_MODULE(	'../www-stageresources',	'../checks/UNTRANSLATEMODULE.txt',	'../checks/UNTRANSLATECOUNT.txt' );


/*** done ***/
AION_ECHO("REMINDER! COPY TO DATABASE: ../checks/UNTRANSLATEMODULE.txt");
AION_ECHO("REMINDER! COPY TO DATABASE: ../checks/UNTRANSLATEMODULE.txt.sort");
AION_ECHO("DONE!");
