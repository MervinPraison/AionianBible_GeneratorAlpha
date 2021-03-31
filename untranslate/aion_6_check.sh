#!/usr/local/bin/php
<?php



/*** init ***/
require_once('./aion_common.php');
AION_ECHO("START " . basename(__FILE__, '.php'));

AION_ECHO("CREATE UNTRANSLATE COMPARE");	AION_LOOP_CHECK_UNTRANSLATE_COMPARE('../www-stageresources',				'../checks/UNTRANSLATECOMPARE.txt' );
AION_ECHO("CREATE UNTRANSLATE MODULE");		AION_LOOP_CHECK_UNTRANSLATE_MODULE(	'../www-stageresources',				'../checks/UNTRANSLATEMODULE.txt',	'../checks/UNTRANSLATECOUNT.txt' );
AION_ECHO("DATA FILE CHECK");				AION_LOOP_CHECK_DATA(				'../www-stageresources',				'../checks/CHECKDATA.txt',			'../checks/TALLY_HO.txt', FALSE ); // DEBUG OR NOT????
AION_ECHO("BOOKS COUNT");					AION_LOOP_CHECK_BOOKSCOUNT(			'./aion_database/BOOKSSTANDARD.noia',	'../checks/BOOKSCOUNT.txt' );
AION_ECHO("BOOKS COMPARE");					AION_LOOP_CHECK_BOOKSCOMPARE(		'../www-stageresources',				'../www-stage/library/online',		'../checks/BOOKS_CHECK.txt' );
AION_ECHO("BOOKS CHAPTERS");				AION_LOOP_CHECK_BOOKSCHAPTERS(		'./aion_database/BOOKSSTANDARD.noia',	'../www-stageresources',			'../checks/BOOKSCHAPTERS.txt' );
AION_ECHO("TESTWORDS");						AION_LOOP_TESTWORDS(				NULL, '../www-stageresources',			'../checks' );
AION_ECHO("NUMBERSHOT");					AION_LOOP_NUMBERSHOT(				'../www-stageresources',				"/Source-Edition\.epub$/",			'../checks/NUMBERSHOT.txt' );
AION_ECHO("IVERSE");						AION_LOOP_IVERSE(					'../www-stageresources',				'../checks' );
AION_ECHO("ANAVIGATION");					AION_LOOP_ANAVIGATION(				'../www-stageresources',				'../checks');

AION_CHECK_DIFF_TWO_FILES('./aion_database/BOOKSCOUNT.txt',				'../checks/BOOKSCOUNT.txt',				'../checks/ADIFF.BOOKSCOUNT.txt');
AION_CHECK_DIFF_TWO_FILES('./aion_database/BOOKS_CHECK.txt',			'../checks/BOOKS_CHECK.txt',			'../checks/ADIFF.BOOKS_CHECK.txt');
AION_CHECK_DIFF_TWO_FILES('./aion_database/BOOKSCHAPTERS.txt',			'../checks/BOOKSCHAPTERS.txt',			'../checks/ADIFF.BOOKSCHAPTERS.txt');
AION_CHECK_DIFF_TWO_FILES('./aion_database/UNTRANSLATEMODULE.txt',		'../checks/UNTRANSLATEMODULE.txt',		'../checks/ADIFF.UNTRANSLATEMODULE.txt');
AION_CHECK_DIFF_TWO_FILES('./aion_database/UNTRANSLATECOUNT.txt',		'../checks/UNTRANSLATECOUNT.txt',		'../checks/ADIFF.UNTRANSLATECOUNT.txt');
AION_CHECK_DIFF_TWO_FILES('./aion_database/CHECKDATA.txt',				'../checks/CHECKDATA.txt',				'../checks/ADIFF.CHECKDATA.txt');
AION_CHECK_DIFF_TWO_FILES('./aion_database/UNTRANSLATEREVERSE.txt',		'../checks/UNTRANSLATEREVERSE.txt',		'../checks/ADIFF.UNTRANSLATEREVERSE.txt');
AION_CHECK_DIFF_TWO_FILES('./aion_database/UNTRANSLATECOMPARE.txt',		'../checks/UNTRANSLATECOMPARE.txt',		'../checks/ADIFF.UNTRANSLATECOMPARE.txt');
AION_CHECK_DIFF_TWO_FILES('./aion_database/UNICODE_USAGE.txt',			'../checks/UNICODE_USAGE.txt',			'../checks/ADIFF.UNICODE_USAGE.txt');
AION_CHECK_DIFF_TWO_FILES('./aion_database/TALLY.txt',					'../checks/TALLY.txt',					'../checks/ADIFF.TALLY.txt');
AION_CHECK_DIFF_TWO_FILES('./aion_database/TALLY_HO.txt',				'../checks/TALLY_HO.txt',				'../checks/ADIFF.TALLY_HO.txt');
AION_CHECK_DIFF_TWO_FILES('../checks/TALLY.txt',						'../checks/TALLY_HO.txt',				'../checks/ADIFF.TALLY_TALLY_HO.txt');
AION_CHECK_DIFF_TWO_FILES('./aion_database/RAWCHECK.txt',				'../checks/RAWCHECK.txt',				'../checks/ADIFF.RAWCHECK.txt');
AION_CHECK_DIFF_TWO_FILES('./aion_database/SKIPPED.txt',				'../checks/SKIPPED.txt',				'../checks/ADIFF.SKIPPED.txt');
AION_CHECK_DIFF_TWO_FILES('./aion_database/TAGS.txt',					'../checks/TAGS.txt',					'../checks/ADIFF.TAGS.txt');
AION_CHECK_DIFF_TWO_FILES('./aion_database/TESTWORDS.txt',				'../checks/TESTWORDS.txt',				'../checks/ADIFF.TESTWORDS.txt');
AION_CHECK_DIFF_TWO_FILES('./aion_database/TEXTREPAIR.txt',				'../checks/TEXTREPAIR.txt',				'../checks/ADIFF.TEXTREPAIR.txt');
AION_CHECK_DIFF_TWO_FILES('./aion_database/NUMBERSHOT.txt',				'../checks/NUMBERSHOT.txt',				'../checks/ADIFF.NUMBERSHOT.txt');
AION_CHECK_DIFF_TWO_FILES('./aion_database/IVERSE.txt',					'../checks/IVERSE.txt',					'../checks/ADIFF.IVERSE.txt');
AION_CHECK_DIFF_TWO_FILES('./aion_database/IVERSE2.txt',				'../checks/IVERSE2.txt',				'../checks/ADIFF.IVERSE2.txt');
AION_CHECK_DIFF_TWO_FILES('./aion_database/ANAVIGATION.txt',			'../checks/ANAVIGATION.txt',			'../checks/ADIFF.ANAVIGATION.txt');
AION_CHECK_DIFF_TWO_FILES('../copyright-diff/AMASTER.copyright-diff',	'../checks/AMASTER.copyright-diff',		'../checks/ADIFF.AMASTER.copyright-diff');

AION_CHECK_DIFF_TWO_FILES('../checksX-diff/AMASTER.checksX-diff', '../checks/AMASTER.checksX-diff', '../checks/ADIFF.AMASTER.checksX-diff');
AION_CHECK_DIFF_TWO_FILES('../copyright-diff/AMASTER.copyright-diff', '../checks/AMASTER.copyright-diff', '../checks/ADIFF.AMASTER.copyright-diff');
AION_CHECK_DIFF_TWO_FILES('../diff-source-stage-with-source-production-AFTER-UPDATE/AMASTER.diff-source-stage-with-source-production-AFTER-UPDATE', '../checks/AMASTER.diff-source-stage-with-source-production-AFTER-UPDATE', '../checks/ADIFF.AMASTER.diff-source-stage-with-source-production-AFTER-UPDATE');
AION_CHECK_DIFF_TWO_FILES('../diff-source-stage-with-source-production-BEFORE-UPDATE/AMASTER.diff-source-stage-with-source-production-BEFORE-UPDATE', '../checks/AMASTER.diff-source-stage-with-source-production-BEFORE-UPDATE', '../checks/ADIFF.AMASTER.diff-source-stage-with-source-production-BEFORE-UPDATE');
AION_CHECK_DIFF_TWO_FILES('../diff-www-stageresources-with-www-resources-AFTER-DEPLOY/AMASTER.diff-www-stageresources-with-www-resources-AFTER-DEPLOY', '../checks/AMASTER.diff-www-stageresources-with-www-resources-AFTER-DEPLOY', '../checks/ADIFF.AMASTER.diff-www-stageresources-with-www-resources-AFTER-DEPLOY');
AION_CHECK_DIFF_TWO_FILES('../diff-www-stageresources-with-www-resources-BEFORE-DEPLOY/AMASTER.diff-www-stageresources-with-www-resources-BEFORE-DEPLOY', '../checks/AMASTER.diff-www-stageresources-with-www-resources-BEFORE-DEPLOY', '../checks/ADIFF.AMASTER.diff-www-stageresources-with-www-resources-BEFORE-DEPLOY');
AION_CHECK_DIFF_TWO_FILES('../diff-www-stage-with-www-production-AFTER-DEPLOY/AMASTER.diff-www-stage-with-www-production-AFTER-DEPLOY', '../checks/AMASTER.diff-www-stage-with-www-production-AFTER-DEPLOY', '../checks/ADIFF.AMASTER.diff-www-stage-with-www-production-AFTER-DEPLOY');
AION_CHECK_DIFF_TWO_FILES('../diff-www-stage-with-www-production-BEFORE-DEPLOY/AMASTER.diff-www-stage-with-www-production-BEFORE-DEPLOY', '../checks/AMASTER.diff-www-stage-with-www-production-BEFORE-DEPLOY', '../checks/ADIFF.AMASTER.diff-www-stage-with-www-production-BEFORE-DEPLOY');
AION_CHECK_DIFF_TWO_FILES('../raw-diff/AMASTER.raw-diff', '../checks/AMASTER.raw-diff', '../checks/ADIFF.AMASTER.raw-diff');
AION_CHECK_DIFF_TWO_FILES('../raw-diff-diff/AMASTER.raw-diff-diff', '../checks/AMASTER.raw-diff-diff', '../checks/ADIFF.AMASTER.raw-diff-diff');
AION_CHECK_DIFF_TWO_FILES('../spellcheck-diff/AMASTER.spellcheck-diff', '../checks/AMASTER.spellcheck-diff', '../checks/ADIFF.AMASTER.spellcheck-diff');

/*** done ***/
AION_ECHO("REMINDER! COPY TO DATABASE: ../checks/UNTRANSLATEMODULE.txt");
AION_ECHO("REMINDER! COPY TO DATABASE: ../checks/UNTRANSLATEMODULE.txt.sort");
AION_ECHO("DONE!");
