#!/usr/local/bin/php
<?php

require_once('./aion_common.php');
AION_ECHO("BEGIN " . basename(__FILE__, '.php'));
require_once('./aion_3e_epub.php');
AION_LOOP_EPUB_UZIP	(	'../www-stageresources',	'../www-stage/library');