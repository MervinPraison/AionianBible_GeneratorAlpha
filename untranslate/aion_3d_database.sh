#!/usr/local/bin/php
<?php

require_once('./aion_common.php');
AION_ECHO("BEGIN " . basename(__FILE__, '.php'));
require_once('./aion_3d_database.php');
AION_LOOP_EPUB_UZIP	(	'../www-stageresources',	'../www-stage/library');