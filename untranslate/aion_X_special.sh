#!/usr/local/bin/php
<?php


require_once('./aion_common.php');
AION_ECHO("START " . basename(__FILE__, '.php'));
AION_LOOP_SPECIAL('../www-stageresources','aion_special');
AION_ECHO("DONE!");