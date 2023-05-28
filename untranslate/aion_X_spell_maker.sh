#!/usr/local/bin/php
<?php



/*** init ***/
require_once('./aion_common.php');
AION_ECHO("START " . basename(__FILE__, '.php'));

/*** speller ***/
AION_LOOP_SPELL('aion_X_spell.sh', '../spellcheck');

/*** done ***/
AION_ECHO("DONE!");
