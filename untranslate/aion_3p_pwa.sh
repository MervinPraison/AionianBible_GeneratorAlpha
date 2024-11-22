#!/usr/local/bin/php
<?php

require_once('./aion_common.php');
AION_ECHO("BEGIN " . basename(__FILE__, '.php'));
require_once('./aion_3p_pwa.php');
AION_LOOP_DIFF(	'../www-stage/library/pwa', '../www-production-files/library/pwa', '../diff-www-stagepwa-with-pwa-BEFORE-DEPLOY');

