#!/usr/local/bin/php
<?php


/*** init ***/
require_once('./aion_common.php');
require_once('./aion_speedata.php');
AION_ECHO("START " . basename(__FILE__, '.php'));
AION_LOOP_PDF_POD(	'/home/inmoti55/public_html/domain.aionianbible.org/www-stageresources',
					'/home/inmoti55/public_html/domain.aionianbible.org/www-stageresources'
				);
AION_ECHO("DONE!");