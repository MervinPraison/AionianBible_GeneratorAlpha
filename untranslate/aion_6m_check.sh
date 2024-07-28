#!/usr/local/bin/php
<?php


/*** init ***/
require_once('./aion_common.php');
AION_ECHO("START " . basename(__FILE__, '.php'));


AION_ECHO("PDF MARGIN CHECKER");
AION_LOOP_PDFMARGIN('../www-stageresources', '../pdf-margin-checker' );
AION_LOOP_DIFF('../pdf-margin-checker','../pdf-margin-checker-MARKER','../pdf-margin-checker-diff');

system('
grep "Bounding" ../pdf-margin-checker/*.pdf.out.txt | \
sed \
-e "s/\.\.\/pdf-margin-checker\/Holy-Bible---//" \
-e "s/---POD_KDP_ALL_BODY\.pdf\./\tALL\t/" \
-e "s/---POD_KDP_NEW_BODY\.pdf\./\tNEW\t/" \
-e "s/---Aionian-Edition---STUDY\.pdf\./\tSTUDY\t/" \
-e "s/---Aionian-Edition\.pdf\./\tAionian\t/" \
-e "s/\.pdf\.out\.txt:[ ]*/\t/" \
-e "s/\t\%\%HiResBoundingBox:[ .0-9]*$//" | \
tee ../pdf-margin-checker/AMASTER.PDF-MARGIN-DETAIL.txt
');

system('
wc -l ../pdf-margin-checker/*.pdf.out.txt | \
sed \
-e "s/^[ ]*//" \
-e "s/ /\t/" \
-e "s/\.\.\/pdf-margin-checker\/Holy-Bible---//" \
-e "s/---POD_KDP_ALL_BODY\.pdf\./\tall\t/" \
-e "s/---POD_KDP_NEW_BODY\.pdf\./\tnew\t/" \
-e "s/---Aionian-Edition---STUDY\.pdf\./\tstu\t/" \
-e "s/---Aionian-Edition\.pdf\./\tpdf\t/" \
-e "s/\.pdf\.out\.txt//" \
-e "/\ttotal/d" | \
tee ../pdf-margin-checker/AMASTER.PDF-MARGIN-SUMMARY.txt
');

/*** done ***/
AION_ECHO("DONE!");
