#!/usr/local/bin/php
<?php



/*** init ***/
require_once('./aion_common.php');
AION_ECHO("START " . basename(__FILE__, '.php'));


/*** install epub ***/
AION_INSTALL_EPUB_BETTER('../../domain.signedon.net.epub',TRUE);


/*** done ***/
AION_ECHO("DONE!");
