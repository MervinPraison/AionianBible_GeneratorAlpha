#!/usr/local/bin/php
<?php

require_once('./aion_common.php');
AION_ECHO("BEGIN " . basename(__FILE__, '.php'));
require_once('./aion_6n_check.php');

AION_LOOP_DIFF('../www-stageresources', '../analysis-MARKER', '../analysis-diff', '', '/---Analysis\..+\.txt$/');