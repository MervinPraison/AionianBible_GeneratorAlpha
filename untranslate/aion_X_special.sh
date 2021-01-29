#!/usr/local/bin/php
<?php

require_once('./aion_common.php');
AION_ECHO("START " . basename(__FILE__, '.php'));
//AION_LOOP_SPECIAL('../www-stageresources','aion_special');

system("pdftk ../www-stageresources/Holy-Bible---Arabic---Arabic-Van-Dyck-Bible---POD_LULU.pdf cat end-1 output ../www-stageresources/Holy-Bible---Arabic---Arabic-Van-Dyck-Bible---POD_LULU-REVERSE.pdf");


AION_ECHO("DONE!");