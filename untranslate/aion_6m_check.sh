#!/usr/local/bin/php
<?php


/*** init ***/
require_once('./aion_common.php');
AION_ECHO("START " . basename(__FILE__, '.php'));


AION_ECHO("PDF MARGIN CHECKER");
AION_LOOP_PDFMARGIN('../www-stageresources', '../pdf-margin-checker' );


/*** done ***/
AION_ECHO("DONE!");
