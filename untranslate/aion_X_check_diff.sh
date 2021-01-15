#!/usr/local/bin/php
<?php


require_once('./aion_common.php');
AION_ECHO("START " . basename(__FILE__, '.php'));
AION_LOOP_DIFF('../checksX','../checksX-MARKER','../checksX-diff');
AION_ECHO("DONE!");