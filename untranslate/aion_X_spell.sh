#!/usr/local/bin/php
<?php
// Spell checker script, automatically generated
require_once('./aion_common.php');
// SPELL CHECK: Holy-Bible---Abureni---Abureni-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Abureni---Abureni-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Abureni---Abureni-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Abureni---Abureni-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Ahirani---Ahirani-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Ahirani---Ahirani-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Ahirani---Ahirani-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ahirani---Ahirani-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Ajiya---Ajiya-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Ajiya---Ajiya-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Ajiya---Ajiya-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ajiya---Ajiya-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Alaba-Kabeena---Alaba-Kabeena-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Alaba-Kabeena---Alaba-Kabeena-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Alaba-Kabeena---Alaba-Kabeena-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Alaba-Kabeena---Alaba-Kabeena-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Amo---Amo-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Amo---Amo-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Amo---Amo-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Amo---Amo-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Apal---Apali-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Apal---Apali-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Apal---Apali-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Apal---Apali-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Arabic---Arabic-Van-Dyck-Bible (ar)
system("cat ../www-stageresources/Holy-Bible---Arabic---Arabic-Van-Dyck-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Arabic---Arabic-Van-Dyck-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Arabic---Arabic-Van-Dyck-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Arabic---Arabic-Van-Dyck-Bible.WORDS | ".
"aspell list --lang=ar  ".
"> ../spellcheck/Holy-Bible---Arabic---Arabic-Van-Dyck-Bible.ar");
system('wc -l ../spellcheck/Holy-Bible---Arabic---Arabic-Van-Dyck-Bible.ar');




// SPELL CHECK: Holy-Bible---Arabic---New-Arabic-Bible (ar)
system("cat ../www-stageresources/Holy-Bible---Arabic---New-Arabic-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Arabic---New-Arabic-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Arabic---New-Arabic-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Arabic---New-Arabic-Bible.WORDS | ".
"aspell list --lang=ar  ".
"> ../spellcheck/Holy-Bible---Arabic---New-Arabic-Bible.ar");
system('wc -l ../spellcheck/Holy-Bible---Arabic---New-Arabic-Bible.ar');




// SPELL CHECK: Holy-Bible---Aramaic---Syriac-Peshitta (WORDS)
system("cat ../www-stageresources/Holy-Bible---Aramaic---Syriac-Peshitta---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Aramaic---Syriac-Peshitta.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Aramaic---Syriac-Peshitta.WORDS');




// SPELL CHECK: Holy-Bible---Arapaho---Arapaho-Luke (WORDS)
system("cat ../www-stageresources/Holy-Bible---Arapaho---Arapaho-Luke---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Arapaho---Arapaho-Luke.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Arapaho---Arapaho-Luke.WORDS');




// SPELL CHECK: Holy-Bible---Armenian---Armenian-Bible-Eastern (hy)
system("cat ../www-stageresources/Holy-Bible---Armenian---Armenian-Bible-Eastern---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Armenian---Armenian-Bible-Eastern.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Armenian---Armenian-Bible-Eastern.WORDS');
system("cat ../spellcheck/Holy-Bible---Armenian---Armenian-Bible-Eastern.WORDS | ".
"aspell list --lang=hy  ".
"> ../spellcheck/Holy-Bible---Armenian---Armenian-Bible-Eastern.hy");
system('wc -l ../spellcheck/Holy-Bible---Armenian---Armenian-Bible-Eastern.hy');




// SPELL CHECK: Holy-Bible---Armenian---Armenian-Bible-Western (hy)
system("cat ../www-stageresources/Holy-Bible---Armenian---Armenian-Bible-Western---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Armenian---Armenian-Bible-Western.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Armenian---Armenian-Bible-Western.WORDS');
system("cat ../spellcheck/Holy-Bible---Armenian---Armenian-Bible-Western.WORDS | ".
"aspell list --lang=hy  ".
"> ../spellcheck/Holy-Bible---Armenian---Armenian-Bible-Western.hy");
system('wc -l ../spellcheck/Holy-Bible---Armenian---Armenian-Bible-Western.hy');




// SPELL CHECK: Holy-Bible---Aruamu---Aruamu-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Aruamu---Aruamu-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Aruamu---Aruamu-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Aruamu---Aruamu-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Arumanisht---Aromanian-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Arumanisht---Aromanian-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Arumanisht---Aromanian-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Arumanisht---Aromanian-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Assamese---Assamese-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Assamese---Assamese-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Assamese---Assamese-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Assamese---Assamese-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Ayta-Ambala---Ayta-Ambala-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Ayta-Ambala---Ayta-Ambala-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Ayta-Ambala---Ayta-Ambala-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ayta-Ambala---Ayta-Ambala-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Azerbaijani---Azerbaijani-Bible (az)
system("cat ../www-stageresources/Holy-Bible---Azerbaijani---Azerbaijani-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Azerbaijani---Azerbaijani-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Azerbaijani---Azerbaijani-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Azerbaijani---Azerbaijani-Bible.WORDS | ".
"aspell list --lang=az  ".
"> ../spellcheck/Holy-Bible---Azerbaijani---Azerbaijani-Bible.az");
system('wc -l ../spellcheck/Holy-Bible---Azerbaijani---Azerbaijani-Bible.az');




// SPELL CHECK: Holy-Bible---Baga-Sitemu---Baga-Sitemu-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Baga-Sitemu---Baga-Sitemu-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Baga-Sitemu---Baga-Sitemu-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Baga-Sitemu---Baga-Sitemu-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Baiso---Basio-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Baiso---Basio-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Baiso---Basio-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Baiso---Basio-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Bangwinji---Bangwinji-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Bangwinji---Bangwinji-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Bangwinji---Bangwinji-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Bangwinji---Bangwinji-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Bareli-Palya---Palya-Bareli-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Bareli-Palya---Palya-Bareli-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Bareli-Palya---Palya-Bareli-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Bareli-Palya---Palya-Bareli-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Basa-Gurmana---Basa-Gurmana-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Basa-Gurmana---Basa-Gurmana-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Basa-Gurmana---Basa-Gurmana-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Basa-Gurmana---Basa-Gurmana-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Basque---Basque-NT (WORDS)
system("cat ../www-stageresources/Holy-Bible---Basque---Basque-NT---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Basque---Basque-NT.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Basque---Basque-NT.WORDS');




// SPELL CHECK: Holy-Bible---Beami---Bedamuni-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Beami---Bedamuni-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Beami---Bedamuni-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Beami---Bedamuni-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Beaver---Beaver-Mark (WORDS)
system("cat ../www-stageresources/Holy-Bible---Beaver---Beaver-Mark---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Beaver---Beaver-Mark.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Beaver---Beaver-Mark.WORDS');




// SPELL CHECK: Holy-Bible---Bekwel---Bekwel-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Bekwel---Bekwel-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Bekwel---Bekwel-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Bekwel---Bekwel-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Bengali---Bengali-Bible (bn)
system("cat ../www-stageresources/Holy-Bible---Bengali---Bengali-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Bengali---Bengali-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Bengali---Bengali-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Bengali---Bengali-Bible.WORDS | ".
"aspell list --lang=bn  ".
"> ../spellcheck/Holy-Bible---Bengali---Bengali-Bible.bn");
system('wc -l ../spellcheck/Holy-Bible---Bengali---Bengali-Bible.bn');




// SPELL CHECK: Holy-Bible---Bengali---Contemporary (bn)
system("cat ../www-stageresources/Holy-Bible---Bengali---Contemporary---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Bengali---Contemporary.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Bengali---Contemporary.WORDS');
system("cat ../spellcheck/Holy-Bible---Bengali---Contemporary.WORDS | ".
"aspell list --lang=bn  ".
"> ../spellcheck/Holy-Bible---Bengali---Contemporary.bn");
system('wc -l ../spellcheck/Holy-Bible---Bengali---Contemporary.bn');




// SPELL CHECK: Holy-Bible---Bhadrawahi---Bhadrawahi-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Bhadrawahi---Bhadrawahi-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Bhadrawahi---Bhadrawahi-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Bhadrawahi---Bhadrawahi-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Bhattiyali---Bhattiyali-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Bhattiyali---Bhattiyali-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Bhattiyali---Bhattiyali-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Bhattiyali---Bhattiyali-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Bhilali---Bhilali-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Bhilali---Bhilali-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Bhilali---Bhilali-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Bhilali---Bhilali-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Blackfoot---Matthew (WORDS)
system("cat ../www-stageresources/Holy-Bible---Blackfoot---Matthew---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Blackfoot---Matthew.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Blackfoot---Matthew.WORDS');




// SPELL CHECK: Holy-Bible---Bodo-Parja---BOPO-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Bodo-Parja---BOPO-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Bodo-Parja---BOPO-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Bodo-Parja---BOPO-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Boga---Boga-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Boga---Boga-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Boga---Boga-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Boga---Boga-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Bondei---Bondei-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Bondei---Bondei-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Bondei---Bondei-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Bondei---Bondei-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Borna---Borna-Latin-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Borna---Borna-Latin-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Borna---Borna-Latin-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Borna---Borna-Latin-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Breton---Breton-Gospels (br)
system("cat ../www-stageresources/Holy-Bible---Breton---Breton-Gospels---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Breton---Breton-Gospels.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Breton---Breton-Gospels.WORDS');
system("cat ../spellcheck/Holy-Bible---Breton---Breton-Gospels.WORDS | ".
"aspell list --lang=br  ".
"> ../spellcheck/Holy-Bible---Breton---Breton-Gospels.br");
system('wc -l ../spellcheck/Holy-Bible---Breton---Breton-Gospels.br');




// SPELL CHECK: Holy-Bible---Bu---Bauchi-Bu-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Bu---Bauchi-Bu-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Bu---Bauchi-Bu-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Bu---Bauchi-Bu-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Bu---Bu-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Bu---Bu-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Bu---Bu-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Bu---Bu-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Bugun---Bugun-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Bugun---Bugun-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Bugun---Bugun-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Bugun---Bugun-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Bulgarian---Bulgarian-Bible (bg)
system("cat ../www-stageresources/Holy-Bible---Bulgarian---Bulgarian-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Bulgarian---Bulgarian-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Bulgarian---Bulgarian-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Bulgarian---Bulgarian-Bible.WORDS | ".
"aspell list --lang=bg  ".
"> ../spellcheck/Holy-Bible---Bulgarian---Bulgarian-Bible.bg");
system('wc -l ../spellcheck/Holy-Bible---Bulgarian---Bulgarian-Bible.bg');




// SPELL CHECK: Holy-Bible---Bwile---Bwile-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Bwile---Bwile-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Bwile---Bwile-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Bwile---Bwile-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Calo---Calo-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Calo---Calo-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Calo---Calo-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Calo---Calo-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Cebuano---Cebuano-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Cebuano---Cebuano-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Cebuano---Cebuano-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Cebuano---Cebuano-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Cebuano---Cebuano-Open-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Cebuano---Cebuano-Open-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Cebuano---Cebuano-Open-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Cebuano---Cebuano-Open-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Cebuano---Cebuano-Philippine (WORDS)
system("cat ../www-stageresources/Holy-Bible---Cebuano---Cebuano-Philippine---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Cebuano---Cebuano-Philippine.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Cebuano---Cebuano-Philippine.WORDS');




// SPELL CHECK: Holy-Bible---Chamorro---Chamorro-Gospels-Acts-and-Psalms (WORDS)
system("cat ../www-stageresources/Holy-Bible---Chamorro---Chamorro-Gospels-Acts-and-Psalms---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Chamorro---Chamorro-Gospels-Acts-and-Psalms.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Chamorro---Chamorro-Gospels-Acts-and-Psalms.WORDS');




// SPELL CHECK: Holy-Bible---Cherokee---Cherokee-New-Testament (WORDS)
system("cat ../www-stageresources/Holy-Bible---Cherokee---Cherokee-New-Testament---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Cherokee---Cherokee-New-Testament.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Cherokee---Cherokee-New-Testament.WORDS');




// SPELL CHECK: Holy-Bible---Chhattisgarhi---Chhattisgarhi-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Chhattisgarhi---Chhattisgarhi-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Chhattisgarhi---Chhattisgarhi-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Chhattisgarhi---Chhattisgarhi-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Chichewa---Chichewa-Bible (ny)
system("cat ../www-stageresources/Holy-Bible---Chichewa---Chichewa-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Chichewa---Chichewa-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Chichewa---Chichewa-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Chichewa---Chichewa-Bible.WORDS | ".
"aspell list --lang=ny  ".
"> ../spellcheck/Holy-Bible---Chichewa---Chichewa-Bible.ny");
system('wc -l ../spellcheck/Holy-Bible---Chichewa---Chichewa-Bible.ny');




// SPELL CHECK: Holy-Bible---Chin-Daai---Daai-Chin-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Chin-Daai---Daai-Chin-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Chin-Daai---Daai-Chin-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Chin-Daai---Daai-Chin-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Chin-Eastern-Khumi---Asang-Khongca-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Chin-Eastern-Khumi---Asang-Khongca-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Chin-Eastern-Khumi---Asang-Khongca-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Chin-Eastern-Khumi---Asang-Khongca-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Chinese---Chinese-Easy-to-Read (SKIP)




// SPELL CHECK: Holy-Bible---Chinese---Chinese-Sigao-Bible (SKIP)




// SPELL CHECK: Holy-Bible---Chinese---Chinese-Union-Version-Simplified (SKIP)




// SPELL CHECK: Holy-Bible---Chinese---Chinese-Union-Version-Traditional (SKIP)




// SPELL CHECK: Holy-Bible---Chinese---Mandarin-Bible-Simplified (SKIP)




// SPELL CHECK: Holy-Bible---Chinese---Mandarin-Bible-Traditional (SKIP)




// SPELL CHECK: Holy-Bible---Chin-Matu---Matupi-Chin-2019 (WORDS)
system("cat ../www-stageresources/Holy-Bible---Chin-Matu---Matupi-Chin-2019---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Chin-Matu---Matupi-Chin-2019.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Chin-Matu---Matupi-Chin-2019.WORDS');




// SPELL CHECK: Holy-Bible---Chin-Matu---Matupi-Chin-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Chin-Matu---Matupi-Chin-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Chin-Matu---Matupi-Chin-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Chin-Matu---Matupi-Chin-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Chin-Matu---Tuivang-Matu-Chin-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Chin-Matu---Tuivang-Matu-Chin-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Chin-Matu---Tuivang-Matu-Chin-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Chin-Matu---Tuivang-Matu-Chin-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Chin-Siyin---Siyin-Chin-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Chin-Siyin---Siyin-Chin-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Chin-Siyin---Siyin-Chin-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Chin-Siyin---Siyin-Chin-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Chin-Thado---Chongthu-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Chin-Thado---Chongthu-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Chin-Thado---Chongthu-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Chin-Thado---Chongthu-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Chin-Thaiphum---Thai-Phum-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Chin-Thaiphum---Thai-Phum-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Chin-Thaiphum---Thai-Phum-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Chin-Thaiphum---Thai-Phum-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Chiyawo---Yao (WORDS)
system("cat ../www-stageresources/Holy-Bible---Chiyawo---Yao---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Chiyawo---Yao.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Chiyawo---Yao.WORDS');




// SPELL CHECK: Holy-Bible---Cishingini---Cishingini-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Cishingini---Cishingini-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Cishingini---Cishingini-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Cishingini---Cishingini-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Coptic---Coptic-Boharic-NT (WORDS)
system("cat ../www-stageresources/Holy-Bible---Coptic---Coptic-Boharic-NT---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Coptic---Coptic-Boharic-NT.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Coptic---Coptic-Boharic-NT.WORDS');




// SPELL CHECK: Holy-Bible---Coptic---Coptic-NT (WORDS)
system("cat ../www-stageresources/Holy-Bible---Coptic---Coptic-NT---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Coptic---Coptic-NT.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Coptic---Coptic-NT.WORDS');




// SPELL CHECK: Holy-Bible---Coptic---Sahidic-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Coptic---Sahidic-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Coptic---Sahidic-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Coptic---Sahidic-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Coptic---Sahidic-Coptic-Horner (WORDS)
system("cat ../www-stageresources/Holy-Bible---Coptic---Sahidic-Coptic-Horner---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Coptic---Sahidic-Coptic-Horner.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Coptic---Sahidic-Coptic-Horner.WORDS');




// SPELL CHECK: Holy-Bible---Croatian---Croatian-Bible (hr)
system("cat ../www-stageresources/Holy-Bible---Croatian---Croatian-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Croatian---Croatian-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Croatian---Croatian-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Croatian---Croatian-Bible.WORDS | ".
"aspell list --lang=hr  ".
"> ../spellcheck/Holy-Bible---Croatian---Croatian-Bible.hr");
system('wc -l ../spellcheck/Holy-Bible---Croatian---Croatian-Bible.hr');




// SPELL CHECK: Holy-Bible---Croatian---Croatian-Open-Bible (hr)
system("cat ../www-stageresources/Holy-Bible---Croatian---Croatian-Open-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Croatian---Croatian-Open-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Croatian---Croatian-Open-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Croatian---Croatian-Open-Bible.WORDS | ".
"aspell list --lang=hr  ".
"> ../spellcheck/Holy-Bible---Croatian---Croatian-Open-Bible.hr");
system('wc -l ../spellcheck/Holy-Bible---Croatian---Croatian-Open-Bible.hr');




// SPELL CHECK: Holy-Bible---Cung---Chung-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Cung---Chung-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Cung---Chung-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Cung---Chung-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Czech---Czech-Bible-Kralicka (cs)
system("cat ../www-stageresources/Holy-Bible---Czech---Czech-Bible-Kralicka---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Czech---Czech-Bible-Kralicka.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Czech---Czech-Bible-Kralicka.WORDS');
system("cat ../spellcheck/Holy-Bible---Czech---Czech-Bible-Kralicka.WORDS | ".
"aspell list --lang=cs  ".
"> ../spellcheck/Holy-Bible---Czech---Czech-Bible-Kralicka.cs");
system('wc -l ../spellcheck/Holy-Bible---Czech---Czech-Bible-Kralicka.cs');




// SPELL CHECK: Holy-Bible---Czech---Kralicka (cs)
system("cat ../www-stageresources/Holy-Bible---Czech---Kralicka---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Czech---Kralicka.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Czech---Kralicka.WORDS');
system("cat ../spellcheck/Holy-Bible---Czech---Kralicka.WORDS | ".
"aspell list --lang=cs  ".
"> ../spellcheck/Holy-Bible---Czech---Kralicka.cs");
system('wc -l ../spellcheck/Holy-Bible---Czech---Kralicka.cs');




// SPELL CHECK: Holy-Bible---Czech---Living-Bible (cs)
system("cat ../www-stageresources/Holy-Bible---Czech---Living-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Czech---Living-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Czech---Living-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Czech---Living-Bible.WORDS | ".
"aspell list --lang=cs  ".
"> ../spellcheck/Holy-Bible---Czech---Living-Bible.cs");
system('wc -l ../spellcheck/Holy-Bible---Czech---Living-Bible.cs');




// SPELL CHECK: Holy-Bible---Danish---Danish-1871-1907 (da)
system("cat ../www-stageresources/Holy-Bible---Danish---Danish-1871-1907---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Danish---Danish-1871-1907.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Danish---Danish-1871-1907.WORDS');
system("cat ../spellcheck/Holy-Bible---Danish---Danish-1871-1907.WORDS | ".
"aspell list --lang=da  ".
"> ../spellcheck/Holy-Bible---Danish---Danish-1871-1907.da");
system('wc -l ../spellcheck/Holy-Bible---Danish---Danish-1871-1907.da');




// SPELL CHECK: Holy-Bible---Danish---Danish-1931-1907 (da)
system("cat ../www-stageresources/Holy-Bible---Danish---Danish-1931-1907---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Danish---Danish-1931-1907.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Danish---Danish-1931-1907.WORDS');
system("cat ../spellcheck/Holy-Bible---Danish---Danish-1931-1907.WORDS | ".
"aspell list --lang=da  ".
"> ../spellcheck/Holy-Bible---Danish---Danish-1931-1907.da");
system('wc -l ../spellcheck/Holy-Bible---Danish---Danish-1931-1907.da');




// SPELL CHECK: Holy-Bible---Danish---Danish-Bible (da)
system("cat ../www-stageresources/Holy-Bible---Danish---Danish-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Danish---Danish-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Danish---Danish-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Danish---Danish-Bible.WORDS | ".
"aspell list --lang=da  ".
"> ../spellcheck/Holy-Bible---Danish---Danish-Bible.da");
system('wc -l ../spellcheck/Holy-Bible---Danish---Danish-Bible.da');




// SPELL CHECK: Holy-Bible---Dawro---Dawuro-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Dawro---Dawuro-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Dawro---Dawuro-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Dawro---Dawuro-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Desiya---Desiya-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Desiya---Desiya-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Desiya---Desiya-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Desiya---Desiya-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Dhanki---Dhanki-Devanagari-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Dhanki---Dhanki-Devanagari-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Dhanki---Dhanki-Devanagari-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Dhanki---Dhanki-Devanagari-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Dholuo---Dholuo-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Dholuo---Dholuo-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Dholuo---Dholuo-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Dholuo---Dholuo-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Dombe---Dombe-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Dombe---Dombe-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Dombe---Dombe-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Dombe---Dombe-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Dongxiang---Donxian-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Dongxiang---Donxian-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Dongxiang---Donxian-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Dongxiang---Donxian-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Dutch---Canisiusvertaling (nl)
system("cat ../www-stageresources/Holy-Bible---Dutch---Canisiusvertaling---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Dutch---Canisiusvertaling.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Dutch---Canisiusvertaling.WORDS');
system("cat ../spellcheck/Holy-Bible---Dutch---Canisiusvertaling.WORDS | ".
"aspell list --lang=nl  ".
"> ../spellcheck/Holy-Bible---Dutch---Canisiusvertaling.nl");
system('wc -l ../spellcheck/Holy-Bible---Dutch---Canisiusvertaling.nl');




// SPELL CHECK: Holy-Bible---Dutch---Schrift (nl)
system("cat ../www-stageresources/Holy-Bible---Dutch---Schrift---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Dutch---Schrift.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Dutch---Schrift.WORDS');
system("cat ../spellcheck/Holy-Bible---Dutch---Schrift.WORDS | ".
"aspell list --lang=nl  ".
"> ../spellcheck/Holy-Bible---Dutch---Schrift.nl");
system('wc -l ../spellcheck/Holy-Bible---Dutch---Schrift.nl');




// SPELL CHECK: Holy-Bible---Dutch---Statenvertaling (nl)
system("cat ../www-stageresources/Holy-Bible---Dutch---Statenvertaling---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Dutch---Statenvertaling.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Dutch---Statenvertaling.WORDS');
system("cat ../spellcheck/Holy-Bible---Dutch---Statenvertaling.WORDS | ".
"aspell list --lang=nl  ".
"> ../spellcheck/Holy-Bible---Dutch---Statenvertaling.nl");
system('wc -l ../spellcheck/Holy-Bible---Dutch---Statenvertaling.nl');




// SPELL CHECK: Holy-Bible---Duya---Duya-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Duya---Duya-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Duya---Duya-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Duya---Duya-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Ekajuk---Ekajuk-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Ekajuk---Ekajuk-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Ekajuk---Ekajuk-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ekajuk---Ekajuk-Bible.WORDS');




// SPELL CHECK: Holy-Bible---English---A-Conservative-Version (en)
system("cat ../www-stageresources/Holy-Bible---English---A-Conservative-Version---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---A-Conservative-Version.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---A-Conservative-Version.WORDS');
system("cat ../spellcheck/Holy-Bible---English---A-Conservative-Version.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---A-Conservative-Version.en");
system('wc -l ../spellcheck/Holy-Bible---English---A-Conservative-Version.en');




// SPELL CHECK: Holy-Bible---English---Aionian-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---Aionian-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Aionian-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Aionian-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Aionian-Bible.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Aionian-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---Aionian-Bible.en');




// SPELL CHECK: Holy-Bible---English---American-Standard-Version-1901 (en)
system("cat ../www-stageresources/Holy-Bible---English---American-Standard-Version-1901---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---American-Standard-Version-1901.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---American-Standard-Version-1901.WORDS');
system("cat ../spellcheck/Holy-Bible---English---American-Standard-Version-1901.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---American-Standard-Version-1901.en");
system('wc -l ../spellcheck/Holy-Bible---English---American-Standard-Version-1901.en');




// SPELL CHECK: Holy-Bible---English---Anderson-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---Anderson-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Anderson-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Anderson-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Anderson-Bible.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Anderson-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---Anderson-Bible.en');




// SPELL CHECK: Holy-Bible---English---Berean-Standard (en)
system("cat ../www-stageresources/Holy-Bible---English---Berean-Standard---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Berean-Standard.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Berean-Standard.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Berean-Standard.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Berean-Standard.en");
system('wc -l ../spellcheck/Holy-Bible---English---Berean-Standard.en');




// SPELL CHECK: Holy-Bible---English---Bible-in-Basic-English (en)
system("cat ../www-stageresources/Holy-Bible---English---Bible-in-Basic-English---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Bible-in-Basic-English.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Bible-in-Basic-English.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Bible-in-Basic-English.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Bible-in-Basic-English.en");
system('wc -l ../spellcheck/Holy-Bible---English---Bible-in-Basic-English.en');




// SPELL CHECK: Holy-Bible---English---Brenton-English-Septuagint (en)
system("cat ../www-stageresources/Holy-Bible---English---Brenton-English-Septuagint---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Brenton-English-Septuagint.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Brenton-English-Septuagint.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Brenton-English-Septuagint.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Brenton-English-Septuagint.en");
system('wc -l ../spellcheck/Holy-Bible---English---Brenton-English-Septuagint.en');




// SPELL CHECK: Holy-Bible---English---British-English-Septuagint-2012 (en)
system("cat ../www-stageresources/Holy-Bible---English---British-English-Septuagint-2012---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---British-English-Septuagint-2012.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---British-English-Septuagint-2012.WORDS');
system("cat ../spellcheck/Holy-Bible---English---British-English-Septuagint-2012.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---British-English-Septuagint-2012.en");
system('wc -l ../spellcheck/Holy-Bible---English---British-English-Septuagint-2012.en');




// SPELL CHECK: Holy-Bible---English---Catholic-Public-Domain (en)
system("cat ../www-stageresources/Holy-Bible---English---Catholic-Public-Domain---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Catholic-Public-Domain.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Catholic-Public-Domain.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Catholic-Public-Domain.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Catholic-Public-Domain.en");
system('wc -l ../spellcheck/Holy-Bible---English---Catholic-Public-Domain.en');




// SPELL CHECK: Holy-Bible---English---Darby-Translation (en)
system("cat ../www-stageresources/Holy-Bible---English---Darby-Translation---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Darby-Translation.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Darby-Translation.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Darby-Translation.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Darby-Translation.en");
system('wc -l ../spellcheck/Holy-Bible---English---Darby-Translation.en');




// SPELL CHECK: Holy-Bible---English---Douay-Rheims-1899 (en)
system("cat ../www-stageresources/Holy-Bible---English---Douay-Rheims-1899---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Douay-Rheims-1899.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Douay-Rheims-1899.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Douay-Rheims-1899.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Douay-Rheims-1899.en");
system('wc -l ../spellcheck/Holy-Bible---English---Douay-Rheims-1899.en');




// SPELL CHECK: Holy-Bible---English---Family-35-NT (en)
system("cat ../www-stageresources/Holy-Bible---English---Family-35-NT---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Family-35-NT.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Family-35-NT.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Family-35-NT.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Family-35-NT.en");
system('wc -l ../spellcheck/Holy-Bible---English---Family-35-NT.en');




// SPELL CHECK: Holy-Bible---English---Free-Bible-Version (en)
system("cat ../www-stageresources/Holy-Bible---English---Free-Bible-Version---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Free-Bible-Version.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Free-Bible-Version.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Free-Bible-Version.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Free-Bible-Version.en");
system('wc -l ../spellcheck/Holy-Bible---English---Free-Bible-Version.en');




// SPELL CHECK: Holy-Bible---English---Geneva-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---Geneva-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Geneva-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Geneva-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Geneva-Bible.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Geneva-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---Geneva-Bible.en');




// SPELL CHECK: Holy-Bible---English---Godbey-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---Godbey-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Godbey-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Godbey-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Godbey-Bible.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Godbey-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---Godbey-Bible.en');




// SPELL CHECK: Holy-Bible---English---Gods-Living-Word (en)
system("cat ../www-stageresources/Holy-Bible---English---Gods-Living-Word---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Gods-Living-Word.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Gods-Living-Word.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Gods-Living-Word.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Gods-Living-Word.en");
system('wc -l ../spellcheck/Holy-Bible---English---Gods-Living-Word.en');




// SPELL CHECK: Holy-Bible---English---Haweis-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---Haweis-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Haweis-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Haweis-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Haweis-Bible.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Haweis-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---Haweis-Bible.en');




// SPELL CHECK: Holy-Bible---English---Jewish-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---Jewish-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Jewish-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Jewish-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Jewish-Bible.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Jewish-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---Jewish-Bible.en');




// SPELL CHECK: Holy-Bible---English---King-James-Version (en)
system("cat ../www-stageresources/Holy-Bible---English---King-James-Version---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---King-James-Version.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---King-James-Version.WORDS');
system("cat ../spellcheck/Holy-Bible---English---King-James-Version.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---King-James-Version.en");
system('wc -l ../spellcheck/Holy-Bible---English---King-James-Version.en');




// SPELL CHECK: Holy-Bible---English---King-James-Version-American (en)
system("cat ../www-stageresources/Holy-Bible---English---King-James-Version-American---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---King-James-Version-American.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---King-James-Version-American.WORDS');
system("cat ../spellcheck/Holy-Bible---English---King-James-Version-American.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---King-James-Version-American.en");
system('wc -l ../spellcheck/Holy-Bible---English---King-James-Version-American.en');




// SPELL CHECK: Holy-Bible---English---King-James-Version-Cambridge (en)
system("cat ../www-stageresources/Holy-Bible---English---King-James-Version-Cambridge---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---King-James-Version-Cambridge.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---King-James-Version-Cambridge.WORDS');
system("cat ../spellcheck/Holy-Bible---English---King-James-Version-Cambridge.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---King-James-Version-Cambridge.en");
system('wc -l ../spellcheck/Holy-Bible---English---King-James-Version-Cambridge.en');




// SPELL CHECK: Holy-Bible---English---King-James-Version-Restored-Name (en)
system("cat ../www-stageresources/Holy-Bible---English---King-James-Version-Restored-Name---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---King-James-Version-Restored-Name.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---King-James-Version-Restored-Name.WORDS');
system("cat ../spellcheck/Holy-Bible---English---King-James-Version-Restored-Name.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---King-James-Version-Restored-Name.en");
system('wc -l ../spellcheck/Holy-Bible---English---King-James-Version-Restored-Name.en');




// SPELL CHECK: Holy-Bible---English---King-James-Version-Revised (en)
system("cat ../www-stageresources/Holy-Bible---English---King-James-Version-Revised---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---King-James-Version-Revised.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---King-James-Version-Revised.WORDS');
system("cat ../spellcheck/Holy-Bible---English---King-James-Version-Revised.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---King-James-Version-Revised.en");
system('wc -l ../spellcheck/Holy-Bible---English---King-James-Version-Revised.en');




// SPELL CHECK: Holy-Bible---English---King-James-Version-Updated (en)
system("cat ../www-stageresources/Holy-Bible---English---King-James-Version-Updated---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---King-James-Version-Updated.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---King-James-Version-Updated.WORDS');
system("cat ../spellcheck/Holy-Bible---English---King-James-Version-Updated.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---King-James-Version-Updated.en");
system('wc -l ../spellcheck/Holy-Bible---English---King-James-Version-Updated.en');




// SPELL CHECK: Holy-Bible---English---Leeser-Tanakh (en)
system("cat ../www-stageresources/Holy-Bible---English---Leeser-Tanakh---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Leeser-Tanakh.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Leeser-Tanakh.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Leeser-Tanakh.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Leeser-Tanakh.en");
system('wc -l ../spellcheck/Holy-Bible---English---Leeser-Tanakh.en');




// SPELL CHECK: Holy-Bible---English---Literal-Standard (en)
system("cat ../www-stageresources/Holy-Bible---English---Literal-Standard---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Literal-Standard.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Literal-Standard.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Literal-Standard.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Literal-Standard.en");
system('wc -l ../spellcheck/Holy-Bible---English---Literal-Standard.en');




// SPELL CHECK: Holy-Bible---English---Living-Oracles-NT (en)
system("cat ../www-stageresources/Holy-Bible---English---Living-Oracles-NT---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Living-Oracles-NT.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Living-Oracles-NT.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Living-Oracles-NT.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Living-Oracles-NT.en");
system('wc -l ../spellcheck/Holy-Bible---English---Living-Oracles-NT.en');




// SPELL CHECK: Holy-Bible---English---LXX2012-U-S-English (en)
system("cat ../www-stageresources/Holy-Bible---English---LXX2012-U-S-English---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---LXX2012-U-S-English.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---LXX2012-U-S-English.WORDS');
system("cat ../spellcheck/Holy-Bible---English---LXX2012-U-S-English.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---LXX2012-U-S-English.en");
system('wc -l ../spellcheck/Holy-Bible---English---LXX2012-U-S-English.en');




// SPELL CHECK: Holy-Bible---English---Montgomery-NT (en)
system("cat ../www-stageresources/Holy-Bible---English---Montgomery-NT---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Montgomery-NT.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Montgomery-NT.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Montgomery-NT.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Montgomery-NT.en");
system('wc -l ../spellcheck/Holy-Bible---English---Montgomery-NT.en');




// SPELL CHECK: Holy-Bible---English---New-Heart-Aramaic (en)
system("cat ../www-stageresources/Holy-Bible---English---New-Heart-Aramaic---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---New-Heart-Aramaic.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---New-Heart-Aramaic.WORDS');
system("cat ../spellcheck/Holy-Bible---English---New-Heart-Aramaic.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---New-Heart-Aramaic.en");
system('wc -l ../spellcheck/Holy-Bible---English---New-Heart-Aramaic.en');




// SPELL CHECK: Holy-Bible---English---New-Heart-Jehovah (en)
system("cat ../www-stageresources/Holy-Bible---English---New-Heart-Jehovah---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---New-Heart-Jehovah.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---New-Heart-Jehovah.WORDS');
system("cat ../spellcheck/Holy-Bible---English---New-Heart-Jehovah.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---New-Heart-Jehovah.en");
system('wc -l ../spellcheck/Holy-Bible---English---New-Heart-Jehovah.en');




// SPELL CHECK: Holy-Bible---English---New-Heart-Jesus-Messiah (en)
system("cat ../www-stageresources/Holy-Bible---English---New-Heart-Jesus-Messiah---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---New-Heart-Jesus-Messiah.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---New-Heart-Jesus-Messiah.WORDS');
system("cat ../spellcheck/Holy-Bible---English---New-Heart-Jesus-Messiah.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---New-Heart-Jesus-Messiah.en");
system('wc -l ../spellcheck/Holy-Bible---English---New-Heart-Jesus-Messiah.en');




// SPELL CHECK: Holy-Bible---English---New-Heart-Messianic (en)
system("cat ../www-stageresources/Holy-Bible---English---New-Heart-Messianic---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---New-Heart-Messianic.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---New-Heart-Messianic.WORDS');
system("cat ../spellcheck/Holy-Bible---English---New-Heart-Messianic.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---New-Heart-Messianic.en");
system('wc -l ../spellcheck/Holy-Bible---English---New-Heart-Messianic.en');




// SPELL CHECK: Holy-Bible---English---New-Heart-Standard (en)
system("cat ../www-stageresources/Holy-Bible---English---New-Heart-Standard---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---New-Heart-Standard.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---New-Heart-Standard.WORDS');
system("cat ../spellcheck/Holy-Bible---English---New-Heart-Standard.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---New-Heart-Standard.en");
system('wc -l ../spellcheck/Holy-Bible---English---New-Heart-Standard.en');




// SPELL CHECK: Holy-Bible---English---New-Heart-YHWH (en)
system("cat ../www-stageresources/Holy-Bible---English---New-Heart-YHWH---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---New-Heart-YHWH.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---New-Heart-YHWH.WORDS');
system("cat ../spellcheck/Holy-Bible---English---New-Heart-YHWH.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---New-Heart-YHWH.en");
system('wc -l ../spellcheck/Holy-Bible---English---New-Heart-YHWH.en');




// SPELL CHECK: Holy-Bible---English---Noyes (en)
system("cat ../www-stageresources/Holy-Bible---English---Noyes---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Noyes.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Noyes.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Noyes.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Noyes.en");
system('wc -l ../spellcheck/Holy-Bible---English---Noyes.en');




// SPELL CHECK: Holy-Bible---English---One-Unity-Resource-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---One-Unity-Resource-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---One-Unity-Resource-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---One-Unity-Resource-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---English---One-Unity-Resource-Bible.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---One-Unity-Resource-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---One-Unity-Resource-Bible.en');




// SPELL CHECK: Holy-Bible---English---Open-English-Bible-Commonwealth (en)
system("cat ../www-stageresources/Holy-Bible---English---Open-English-Bible-Commonwealth---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Open-English-Bible-Commonwealth.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Open-English-Bible-Commonwealth.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Open-English-Bible-Commonwealth.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Open-English-Bible-Commonwealth.en");
system('wc -l ../spellcheck/Holy-Bible---English---Open-English-Bible-Commonwealth.en');




// SPELL CHECK: Holy-Bible---English---Open-English-Bible-US (en)
system("cat ../www-stageresources/Holy-Bible---English---Open-English-Bible-US---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Open-English-Bible-US.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Open-English-Bible-US.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Open-English-Bible-US.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Open-English-Bible-US.en");
system('wc -l ../spellcheck/Holy-Bible---English---Open-English-Bible-US.en');




// SPELL CHECK: Holy-Bible---English---Orthodox-Jewish-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---Orthodox-Jewish-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Orthodox-Jewish-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Orthodox-Jewish-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Orthodox-Jewish-Bible.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Orthodox-Jewish-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---Orthodox-Jewish-Bible.en');




// SPELL CHECK: Holy-Bible---English---Revised-Version (en)
system("cat ../www-stageresources/Holy-Bible---English---Revised-Version---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Revised-Version.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Revised-Version.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Revised-Version.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Revised-Version.en");
system('wc -l ../spellcheck/Holy-Bible---English---Revised-Version.en');




// SPELL CHECK: Holy-Bible---English---Rotherham-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---Rotherham-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Rotherham-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Rotherham-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Rotherham-Bible.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Rotherham-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---Rotherham-Bible.en');




// SPELL CHECK: Holy-Bible---English---STEPBible-Amalgamant (en)
system("cat ../www-stageresources/Holy-Bible---English---STEPBible-Amalgamant---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---STEPBible-Amalgamant.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---STEPBible-Amalgamant.WORDS');
system("cat ../spellcheck/Holy-Bible---English---STEPBible-Amalgamant.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---STEPBible-Amalgamant.en");
system('wc -l ../spellcheck/Holy-Bible---English---STEPBible-Amalgamant.en');




// SPELL CHECK: Holy-Bible---English---STEPBible-Concordant (en)
system("cat ../www-stageresources/Holy-Bible---English---STEPBible-Concordant---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---STEPBible-Concordant.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---STEPBible-Concordant.WORDS');
system("cat ../spellcheck/Holy-Bible---English---STEPBible-Concordant.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---STEPBible-Concordant.en");
system('wc -l ../spellcheck/Holy-Bible---English---STEPBible-Concordant.en');




// SPELL CHECK: Holy-Bible---English---Syriac-Peshitta-Etheridge (en)
system("cat ../www-stageresources/Holy-Bible---English---Syriac-Peshitta-Etheridge---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Syriac-Peshitta-Etheridge.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Syriac-Peshitta-Etheridge.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Syriac-Peshitta-Etheridge.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Syriac-Peshitta-Etheridge.en");
system('wc -l ../spellcheck/Holy-Bible---English---Syriac-Peshitta-Etheridge.en');




// SPELL CHECK: Holy-Bible---English---Syriac-Peshitta-Murdock (en)
system("cat ../www-stageresources/Holy-Bible---English---Syriac-Peshitta-Murdock---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Syriac-Peshitta-Murdock.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Syriac-Peshitta-Murdock.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Syriac-Peshitta-Murdock.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Syriac-Peshitta-Murdock.en");
system('wc -l ../spellcheck/Holy-Bible---English---Syriac-Peshitta-Murdock.en');




// SPELL CHECK: Holy-Bible---English---Text-Critical (en)
system("cat ../www-stageresources/Holy-Bible---English---Text-Critical---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Text-Critical.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Text-Critical.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Text-Critical.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Text-Critical.en");
system('wc -l ../spellcheck/Holy-Bible---English---Text-Critical.en');




// SPELL CHECK: Holy-Bible---English---Trans-Trans (en)
system("cat ../www-stageresources/Holy-Bible---English---Trans-Trans---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Trans-Trans.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Trans-Trans.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Trans-Trans.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Trans-Trans.en");
system('wc -l ../spellcheck/Holy-Bible---English---Trans-Trans.en');




// SPELL CHECK: Holy-Bible---English---Twentieth-Century-NT (en)
system("cat ../www-stageresources/Holy-Bible---English---Twentieth-Century-NT---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Twentieth-Century-NT.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Twentieth-Century-NT.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Twentieth-Century-NT.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Twentieth-Century-NT.en");
system('wc -l ../spellcheck/Holy-Bible---English---Twentieth-Century-NT.en');




// SPELL CHECK: Holy-Bible---English---Tyndale-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---Tyndale-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Tyndale-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Tyndale-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Tyndale-Bible.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Tyndale-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---Tyndale-Bible.en');




// SPELL CHECK: Holy-Bible---English---Unlocked-Literal-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---Unlocked-Literal-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Unlocked-Literal-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Unlocked-Literal-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Unlocked-Literal-Bible.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Unlocked-Literal-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---Unlocked-Literal-Bible.en');




// SPELL CHECK: Holy-Bible---English---Webster-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---Webster-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Webster-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Webster-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Webster-Bible.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Webster-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---Webster-Bible.en');




// SPELL CHECK: Holy-Bible---English---Webster-Bible-Revised (en)
system("cat ../www-stageresources/Holy-Bible---English---Webster-Bible-Revised---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Webster-Bible-Revised.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Webster-Bible-Revised.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Webster-Bible-Revised.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Webster-Bible-Revised.en");
system('wc -l ../spellcheck/Holy-Bible---English---Webster-Bible-Revised.en');




// SPELL CHECK: Holy-Bible---English---Weymouth-NT (en)
system("cat ../www-stageresources/Holy-Bible---English---Weymouth-NT---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Weymouth-NT.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Weymouth-NT.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Weymouth-NT.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Weymouth-NT.en");
system('wc -l ../spellcheck/Holy-Bible---English---Weymouth-NT.en');




// SPELL CHECK: Holy-Bible---English---World-English-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---World-English-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---World-English-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---World-English-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---English---World-English-Bible.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---World-English-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---World-English-Bible.en');




// SPELL CHECK: Holy-Bible---English---World-English-Bible-British-Edition (en)
system("cat ../www-stageresources/Holy-Bible---English---World-English-Bible-British-Edition---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---World-English-Bible-British-Edition.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---World-English-Bible-British-Edition.WORDS');
system("cat ../spellcheck/Holy-Bible---English---World-English-Bible-British-Edition.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---World-English-Bible-British-Edition.en");
system('wc -l ../spellcheck/Holy-Bible---English---World-English-Bible-British-Edition.en');




// SPELL CHECK: Holy-Bible---English---World-English-Bible-Updated (en)
system("cat ../www-stageresources/Holy-Bible---English---World-English-Bible-Updated---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---World-English-Bible-Updated.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---World-English-Bible-Updated.WORDS');
system("cat ../spellcheck/Holy-Bible---English---World-English-Bible-Updated.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---World-English-Bible-Updated.en");
system('wc -l ../spellcheck/Holy-Bible---English---World-English-Bible-Updated.en');




// SPELL CHECK: Holy-Bible---English---World-Messianic-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---World-Messianic-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---World-Messianic-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---World-Messianic-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---English---World-Messianic-Bible.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---World-Messianic-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---World-Messianic-Bible.en');




// SPELL CHECK: Holy-Bible---English---World-Messianic-Bible-British-Edition (en)
system("cat ../www-stageresources/Holy-Bible---English---World-Messianic-Bible-British-Edition---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---World-Messianic-Bible-British-Edition.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---World-Messianic-Bible-British-Edition.WORDS');
system("cat ../spellcheck/Holy-Bible---English---World-Messianic-Bible-British-Edition.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---World-Messianic-Bible-British-Edition.en");
system('wc -l ../spellcheck/Holy-Bible---English---World-Messianic-Bible-British-Edition.en');




// SPELL CHECK: Holy-Bible---English---Worsley-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---Worsley-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Worsley-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Worsley-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Worsley-Bible.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Worsley-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---Worsley-Bible.en');




// SPELL CHECK: Holy-Bible---English---Wycliffe-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---Wycliffe-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Wycliffe-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Wycliffe-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Wycliffe-Bible.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Wycliffe-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---Wycliffe-Bible.en');




// SPELL CHECK: Holy-Bible---English---Youngs-Literal-Translation (en)
system("cat ../www-stageresources/Holy-Bible---English---Youngs-Literal-Translation---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---English---Youngs-Literal-Translation.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Youngs-Literal-Translation.WORDS');
system("cat ../spellcheck/Holy-Bible---English---Youngs-Literal-Translation.WORDS | ".
"aspell list --lang=en --personal=/home/inmoti55/public_html/domain.aionianbible.org/spellcheck/.aspell.en.pws ".
"> ../spellcheck/Holy-Bible---English---Youngs-Literal-Translation.en");
system('wc -l ../spellcheck/Holy-Bible---English---Youngs-Literal-Translation.en');




// SPELL CHECK: Holy-Bible---Esperanto---Esperanto-Bible (eo)
system("cat ../www-stageresources/Holy-Bible---Esperanto---Esperanto-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Esperanto---Esperanto-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Esperanto---Esperanto-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Esperanto---Esperanto-Bible.WORDS | ".
"aspell list --lang=eo  ".
"> ../spellcheck/Holy-Bible---Esperanto---Esperanto-Bible.eo");
system('wc -l ../spellcheck/Holy-Bible---Esperanto---Esperanto-Bible.eo');




// SPELL CHECK: Holy-Bible---Estonian---Contemporary (et)
system("cat ../www-stageresources/Holy-Bible---Estonian---Contemporary---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Estonian---Contemporary.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Estonian---Contemporary.WORDS');
system("cat ../spellcheck/Holy-Bible---Estonian---Contemporary.WORDS | ".
"aspell list --lang=et  ".
"> ../spellcheck/Holy-Bible---Estonian---Contemporary.et");
system('wc -l ../spellcheck/Holy-Bible---Estonian---Contemporary.et');




// SPELL CHECK: Holy-Bible---Estonian---For-All (et)
system("cat ../www-stageresources/Holy-Bible---Estonian---For-All---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Estonian---For-All.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Estonian---For-All.WORDS');
system("cat ../spellcheck/Holy-Bible---Estonian---For-All.WORDS | ".
"aspell list --lang=et  ".
"> ../spellcheck/Holy-Bible---Estonian---For-All.et");
system('wc -l ../spellcheck/Holy-Bible---Estonian---For-All.et');




// SPELL CHECK: Holy-Bible---Etulo---Etulo-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Etulo---Etulo-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Etulo---Etulo-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Etulo---Etulo-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Ewe---Word-of-Life (WORDS)
system("cat ../www-stageresources/Holy-Bible---Ewe---Word-of-Life---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Ewe---Word-of-Life.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ewe---Word-of-Life.WORDS');




// SPELL CHECK: Holy-Bible---Falam---Falam-Chin-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Falam---Falam-Chin-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Falam---Falam-Chin-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Falam---Falam-Chin-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Finnish---Finnish-Bible (fi)
system("cat ../www-stageresources/Holy-Bible---Finnish---Finnish-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Finnish---Finnish-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Finnish---Finnish-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Finnish---Finnish-Bible.WORDS | ".
"aspell list --lang=fi  ".
"> ../spellcheck/Holy-Bible---Finnish---Finnish-Bible.fi");
system('wc -l ../spellcheck/Holy-Bible---Finnish---Finnish-Bible.fi');




// SPELL CHECK: Holy-Bible---Finnish---Finnish-Pyha-Raamattu (fi)
system("cat ../www-stageresources/Holy-Bible---Finnish---Finnish-Pyha-Raamattu---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Finnish---Finnish-Pyha-Raamattu.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Finnish---Finnish-Pyha-Raamattu.WORDS');
system("cat ../spellcheck/Holy-Bible---Finnish---Finnish-Pyha-Raamattu.WORDS | ".
"aspell list --lang=fi  ".
"> ../spellcheck/Holy-Bible---Finnish---Finnish-Pyha-Raamattu.fi");
system('wc -l ../spellcheck/Holy-Bible---Finnish---Finnish-Pyha-Raamattu.fi');




// SPELL CHECK: Holy-Bible---Finnish---Open-Living-News (fi)
system("cat ../www-stageresources/Holy-Bible---Finnish---Open-Living-News---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Finnish---Open-Living-News.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Finnish---Open-Living-News.WORDS');
system("cat ../spellcheck/Holy-Bible---Finnish---Open-Living-News.WORDS | ".
"aspell list --lang=fi  ".
"> ../spellcheck/Holy-Bible---Finnish---Open-Living-News.fi");
system('wc -l ../spellcheck/Holy-Bible---Finnish---Open-Living-News.fi');




// SPELL CHECK: Holy-Bible---Flemish---Flemish-De-Jonge-Bible (nl)
system("cat ../www-stageresources/Holy-Bible---Flemish---Flemish-De-Jonge-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Flemish---Flemish-De-Jonge-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Flemish---Flemish-De-Jonge-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Flemish---Flemish-De-Jonge-Bible.WORDS | ".
"aspell list --lang=nl  ".
"> ../spellcheck/Holy-Bible---Flemish---Flemish-De-Jonge-Bible.nl");
system('wc -l ../spellcheck/Holy-Bible---Flemish---Flemish-De-Jonge-Bible.nl');




// SPELL CHECK: Holy-Bible---French---Free-for-the-World (fr)
system("cat ../www-stageresources/Holy-Bible---French---Free-for-the-World---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---French---Free-for-the-World.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---Free-for-the-World.WORDS');
system("cat ../spellcheck/Holy-Bible---French---Free-for-the-World.WORDS | ".
"aspell list --lang=fr  ".
"> ../spellcheck/Holy-Bible---French---Free-for-the-World.fr");
system('wc -l ../spellcheck/Holy-Bible---French---Free-for-the-World.fr');




// SPELL CHECK: Holy-Bible---French---French-Crampon-Bible (fr)
system("cat ../www-stageresources/Holy-Bible---French---French-Crampon-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---French---French-Crampon-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---French-Crampon-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---French---French-Crampon-Bible.WORDS | ".
"aspell list --lang=fr  ".
"> ../spellcheck/Holy-Bible---French---French-Crampon-Bible.fr");
system('wc -l ../spellcheck/Holy-Bible---French---French-Crampon-Bible.fr');




// SPELL CHECK: Holy-Bible---French---French-Crampon-Bible-New (fr)
system("cat ../www-stageresources/Holy-Bible---French---French-Crampon-Bible-New---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---French---French-Crampon-Bible-New.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---French-Crampon-Bible-New.WORDS');
system("cat ../spellcheck/Holy-Bible---French---French-Crampon-Bible-New.WORDS | ".
"aspell list --lang=fr  ".
"> ../spellcheck/Holy-Bible---French---French-Crampon-Bible-New.fr");
system('wc -l ../spellcheck/Holy-Bible---French---French-Crampon-Bible-New.fr');




// SPELL CHECK: Holy-Bible---French---French-Darby-Bible (fr)
system("cat ../www-stageresources/Holy-Bible---French---French-Darby-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---French---French-Darby-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---French-Darby-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---French---French-Darby-Bible.WORDS | ".
"aspell list --lang=fr  ".
"> ../spellcheck/Holy-Bible---French---French-Darby-Bible.fr");
system('wc -l ../spellcheck/Holy-Bible---French---French-Darby-Bible.fr');




// SPELL CHECK: Holy-Bible---French---French-Khan-Bible (fr)
system("cat ../www-stageresources/Holy-Bible---French---French-Khan-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---French---French-Khan-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---French-Khan-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---French---French-Khan-Bible.WORDS | ".
"aspell list --lang=fr  ".
"> ../spellcheck/Holy-Bible---French---French-Khan-Bible.fr");
system('wc -l ../spellcheck/Holy-Bible---French---French-Khan-Bible.fr');




// SPELL CHECK: Holy-Bible---French---French-Louis-Segond-1910-Bible (fr)
system("cat ../www-stageresources/Holy-Bible---French---French-Louis-Segond-1910-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---French---French-Louis-Segond-1910-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---French-Louis-Segond-1910-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---French---French-Louis-Segond-1910-Bible.WORDS | ".
"aspell list --lang=fr  ".
"> ../spellcheck/Holy-Bible---French---French-Louis-Segond-1910-Bible.fr");
system('wc -l ../spellcheck/Holy-Bible---French---French-Louis-Segond-1910-Bible.fr');




// SPELL CHECK: Holy-Bible---French---French-LXX (fr)
system("cat ../www-stageresources/Holy-Bible---French---French-LXX---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---French---French-LXX.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---French-LXX.WORDS');
system("cat ../spellcheck/Holy-Bible---French---French-LXX.WORDS | ".
"aspell list --lang=fr  ".
"> ../spellcheck/Holy-Bible---French---French-LXX.fr");
system('wc -l ../spellcheck/Holy-Bible---French---French-LXX.fr');




// SPELL CHECK: Holy-Bible---French---French-LXX-TheoTex (fr)
system("cat ../www-stageresources/Holy-Bible---French---French-LXX-TheoTex---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---French---French-LXX-TheoTex.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---French-LXX-TheoTex.WORDS');
system("cat ../spellcheck/Holy-Bible---French---French-LXX-TheoTex.WORDS | ".
"aspell list --lang=fr  ".
"> ../spellcheck/Holy-Bible---French---French-LXX-TheoTex.fr");
system('wc -l ../spellcheck/Holy-Bible---French---French-LXX-TheoTex.fr');




// SPELL CHECK: Holy-Bible---French---French-Martin (fr)
system("cat ../www-stageresources/Holy-Bible---French---French-Martin---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---French---French-Martin.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---French-Martin.WORDS');
system("cat ../spellcheck/Holy-Bible---French---French-Martin.WORDS | ".
"aspell list --lang=fr  ".
"> ../spellcheck/Holy-Bible---French---French-Martin.fr");
system('wc -l ../spellcheck/Holy-Bible---French---French-Martin.fr');




// SPELL CHECK: Holy-Bible---French---French-Oltramare-Bible (fr)
system("cat ../www-stageresources/Holy-Bible---French---French-Oltramare-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---French---French-Oltramare-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---French-Oltramare-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---French---French-Oltramare-Bible.WORDS | ".
"aspell list --lang=fr  ".
"> ../spellcheck/Holy-Bible---French---French-Oltramare-Bible.fr");
system('wc -l ../spellcheck/Holy-Bible---French---French-Oltramare-Bible.fr');




// SPELL CHECK: Holy-Bible---French---French-Ostervald-Bible (fr)
system("cat ../www-stageresources/Holy-Bible---French---French-Ostervald-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---French---French-Ostervald-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---French-Ostervald-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---French---French-Ostervald-Bible.WORDS | ".
"aspell list --lang=fr  ".
"> ../spellcheck/Holy-Bible---French---French-Ostervald-Bible.fr");
system('wc -l ../spellcheck/Holy-Bible---French---French-Ostervald-Bible.fr');




// SPELL CHECK: Holy-Bible---French---French-Perret-Gentil-Rilliet (fr)
system("cat ../www-stageresources/Holy-Bible---French---French-Perret-Gentil-Rilliet---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---French---French-Perret-Gentil-Rilliet.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---French-Perret-Gentil-Rilliet.WORDS');
system("cat ../spellcheck/Holy-Bible---French---French-Perret-Gentil-Rilliet.WORDS | ".
"aspell list --lang=fr  ".
"> ../spellcheck/Holy-Bible---French---French-Perret-Gentil-Rilliet.fr");
system('wc -l ../spellcheck/Holy-Bible---French---French-Perret-Gentil-Rilliet.fr');




// SPELL CHECK: Holy-Bible---French---French-Stapfer-Bible (fr)
system("cat ../www-stageresources/Holy-Bible---French---French-Stapfer-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---French---French-Stapfer-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---French-Stapfer-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---French---French-Stapfer-Bible.WORDS | ".
"aspell list --lang=fr  ".
"> ../spellcheck/Holy-Bible---French---French-Stapfer-Bible.fr");
system('wc -l ../spellcheck/Holy-Bible---French---French-Stapfer-Bible.fr');




// SPELL CHECK: Holy-Bible---French---French-Synodale-Bible (fr)
system("cat ../www-stageresources/Holy-Bible---French---French-Synodale-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---French---French-Synodale-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---French-Synodale-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---French---French-Synodale-Bible.WORDS | ".
"aspell list --lang=fr  ".
"> ../spellcheck/Holy-Bible---French---French-Synodale-Bible.fr");
system('wc -l ../spellcheck/Holy-Bible---French---French-Synodale-Bible.fr');




// SPELL CHECK: Holy-Bible---French---Vulgate-Glaire (fr)
system("cat ../www-stageresources/Holy-Bible---French---Vulgate-Glaire---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---French---Vulgate-Glaire.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---Vulgate-Glaire.WORDS');
system("cat ../spellcheck/Holy-Bible---French---Vulgate-Glaire.WORDS | ".
"aspell list --lang=fr  ".
"> ../spellcheck/Holy-Bible---French---Vulgate-Glaire.fr");
system('wc -l ../spellcheck/Holy-Bible---French---Vulgate-Glaire.fr');




// SPELL CHECK: Holy-Bible---Gamit---Gamit-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Gamit---Gamit-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Gamit---Gamit-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Gamit---Gamit-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Gamo---Gamo-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Gamo---Gamo-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Gamo---Gamo-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Gamo---Gamo-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Gamo---Gamo-Bible-Latin (WORDS)
system("cat ../www-stageresources/Holy-Bible---Gamo---Gamo-Bible-Latin---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Gamo---Gamo-Bible-Latin.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Gamo---Gamo-Bible-Latin.WORDS');




// SPELL CHECK: Holy-Bible---Gamotso---Gamo (WORDS)
system("cat ../www-stageresources/Holy-Bible---Gamotso---Gamo---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Gamotso---Gamo.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Gamotso---Gamo.WORDS');




// SPELL CHECK: Holy-Bible---Gata---Gata-Didayi-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Gata---Gata-Didayi-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Gata---Gata-Didayi-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Gata---Gata-Didayi-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Gayil---Gayl-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Gayil---Gayl-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Gayil---Gayl-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Gayil---Gayl-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Geji---Geji-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Geji---Geji-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Geji---Geji-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Geji---Geji-Bible.WORDS');




// SPELL CHECK: Holy-Bible---German---German-Albrecht (de)
system("cat ../www-stageresources/Holy-Bible---German---German-Albrecht---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---German---German-Albrecht.WORDS");
system('wc -l ../spellcheck/Holy-Bible---German---German-Albrecht.WORDS');
system("cat ../spellcheck/Holy-Bible---German---German-Albrecht.WORDS | ".
"aspell list --lang=de  ".
"> ../spellcheck/Holy-Bible---German---German-Albrecht.de");
system('wc -l ../spellcheck/Holy-Bible---German---German-Albrecht.de');




// SPELL CHECK: Holy-Bible---German---German-Elberfelder-1871 (de)
system("cat ../www-stageresources/Holy-Bible---German---German-Elberfelder-1871---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---German---German-Elberfelder-1871.WORDS");
system('wc -l ../spellcheck/Holy-Bible---German---German-Elberfelder-1871.WORDS');
system("cat ../spellcheck/Holy-Bible---German---German-Elberfelder-1871.WORDS | ".
"aspell list --lang=de  ".
"> ../spellcheck/Holy-Bible---German---German-Elberfelder-1871.de");
system('wc -l ../spellcheck/Holy-Bible---German---German-Elberfelder-1871.de');




// SPELL CHECK: Holy-Bible---German---German-Elberfelder-1905 (de)
system("cat ../www-stageresources/Holy-Bible---German---German-Elberfelder-1905---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---German---German-Elberfelder-1905.WORDS");
system('wc -l ../spellcheck/Holy-Bible---German---German-Elberfelder-1905.WORDS');
system("cat ../spellcheck/Holy-Bible---German---German-Elberfelder-1905.WORDS | ".
"aspell list --lang=de  ".
"> ../spellcheck/Holy-Bible---German---German-Elberfelder-1905.de");
system('wc -l ../spellcheck/Holy-Bible---German---German-Elberfelder-1905.de');




// SPELL CHECK: Holy-Bible---German---German-Katholiche-Riessler (de)
system("cat ../www-stageresources/Holy-Bible---German---German-Katholiche-Riessler---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---German---German-Katholiche-Riessler.WORDS");
system('wc -l ../spellcheck/Holy-Bible---German---German-Katholiche-Riessler.WORDS');
system("cat ../spellcheck/Holy-Bible---German---German-Katholiche-Riessler.WORDS | ".
"aspell list --lang=de  ".
"> ../spellcheck/Holy-Bible---German---German-Katholiche-Riessler.de");
system('wc -l ../spellcheck/Holy-Bible---German---German-Katholiche-Riessler.de');




// SPELL CHECK: Holy-Bible---German---German-Kautzsch-Weizsacker (de)
system("cat ../www-stageresources/Holy-Bible---German---German-Kautzsch-Weizsacker---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---German---German-Kautzsch-Weizsacker.WORDS");
system('wc -l ../spellcheck/Holy-Bible---German---German-Kautzsch-Weizsacker.WORDS');
system("cat ../spellcheck/Holy-Bible---German---German-Kautzsch-Weizsacker.WORDS | ".
"aspell list --lang=de  ".
"> ../spellcheck/Holy-Bible---German---German-Kautzsch-Weizsacker.de");
system('wc -l ../spellcheck/Holy-Bible---German---German-Kautzsch-Weizsacker.de');




// SPELL CHECK: Holy-Bible---German---German-Luther-Bible-1545 (de)
system("cat ../www-stageresources/Holy-Bible---German---German-Luther-Bible-1545---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---German---German-Luther-Bible-1545.WORDS");
system('wc -l ../spellcheck/Holy-Bible---German---German-Luther-Bible-1545.WORDS');
system("cat ../spellcheck/Holy-Bible---German---German-Luther-Bible-1545.WORDS | ".
"aspell list --lang=de  ".
"> ../spellcheck/Holy-Bible---German---German-Luther-Bible-1545.de");
system('wc -l ../spellcheck/Holy-Bible---German---German-Luther-Bible-1545.de');




// SPELL CHECK: Holy-Bible---German---German-Luther-Bible-1912 (de)
system("cat ../www-stageresources/Holy-Bible---German---German-Luther-Bible-1912---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---German---German-Luther-Bible-1912.WORDS");
system('wc -l ../spellcheck/Holy-Bible---German---German-Luther-Bible-1912.WORDS');
system("cat ../spellcheck/Holy-Bible---German---German-Luther-Bible-1912.WORDS | ".
"aspell list --lang=de  ".
"> ../spellcheck/Holy-Bible---German---German-Luther-Bible-1912.de");
system('wc -l ../spellcheck/Holy-Bible---German---German-Luther-Bible-1912.de');




// SPELL CHECK: Holy-Bible---German---German-Menge (de)
system("cat ../www-stageresources/Holy-Bible---German---German-Menge---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---German---German-Menge.WORDS");
system('wc -l ../spellcheck/Holy-Bible---German---German-Menge.WORDS');
system("cat ../spellcheck/Holy-Bible---German---German-Menge.WORDS | ".
"aspell list --lang=de  ".
"> ../spellcheck/Holy-Bible---German---German-Menge.de");
system('wc -l ../spellcheck/Holy-Bible---German---German-Menge.de');




// SPELL CHECK: Holy-Bible---German---German-Reinhardt-Bible (de)
system("cat ../www-stageresources/Holy-Bible---German---German-Reinhardt-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---German---German-Reinhardt-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---German---German-Reinhardt-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---German---German-Reinhardt-Bible.WORDS | ".
"aspell list --lang=de  ".
"> ../spellcheck/Holy-Bible---German---German-Reinhardt-Bible.de");
system('wc -l ../spellcheck/Holy-Bible---German---German-Reinhardt-Bible.de');




// SPELL CHECK: Holy-Bible---German---German-Schlachter (de)
system("cat ../www-stageresources/Holy-Bible---German---German-Schlachter---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---German---German-Schlachter.WORDS");
system('wc -l ../spellcheck/Holy-Bible---German---German-Schlachter.WORDS');
system("cat ../spellcheck/Holy-Bible---German---German-Schlachter.WORDS | ".
"aspell list --lang=de  ".
"> ../spellcheck/Holy-Bible---German---German-Schlachter.de");
system('wc -l ../spellcheck/Holy-Bible---German---German-Schlachter.de');




// SPELL CHECK: Holy-Bible---German---German-Tafel-Bible (de)
system("cat ../www-stageresources/Holy-Bible---German---German-Tafel-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---German---German-Tafel-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---German---German-Tafel-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---German---German-Tafel-Bible.WORDS | ".
"aspell list --lang=de  ".
"> ../spellcheck/Holy-Bible---German---German-Tafel-Bible.de");
system('wc -l ../spellcheck/Holy-Bible---German---German-Tafel-Bible.de');




// SPELL CHECK: Holy-Bible---Ghanongga---Kubokota-Adapt-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Ghanongga---Kubokota-Adapt-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Ghanongga---Kubokota-Adapt-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ghanongga---Kubokota-Adapt-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Gikuyu---Kikuyu (WORDS)
system("cat ../www-stageresources/Holy-Bible---Gikuyu---Kikuyu---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Gikuyu---Kikuyu.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Gikuyu---Kikuyu.WORDS');




// SPELL CHECK: Holy-Bible---Glavda---Glavda-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Glavda---Glavda-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Glavda---Glavda-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Glavda---Glavda-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Gofa---Gofa-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Gofa---Gofa-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Gofa---Gofa-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Gofa---Gofa-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Gofa---Gofa-Bible-Ethiopian (WORDS)
system("cat ../www-stageresources/Holy-Bible---Gofa---Gofa-Bible-Ethiopian---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Gofa---Gofa-Bible-Ethiopian.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Gofa---Gofa-Bible-Ethiopian.WORDS');




// SPELL CHECK: Holy-Bible---Gofa---Gofa-Bible-Latin (WORDS)
system("cat ../www-stageresources/Holy-Bible---Gofa---Gofa-Bible-Latin---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Gofa---Gofa-Bible-Latin.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Gofa---Gofa-Bible-Latin.WORDS');




// SPELL CHECK: Holy-Bible---Gourma---Gourma-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Gourma---Gourma-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Gourma---Gourma-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Gourma---Gourma-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Gourmantche---Gourmantche-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Gourmantche---Gourmantche-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Gourmantche---Gourmantche-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Gourmantche---Gourmantche-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Gowlan---Gowlan-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Gowlan---Gowlan-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Gowlan---Gowlan-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Gowlan---Gowlan-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Gowli---Gawli-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Gowli---Gawli-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Gowli---Gawli-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Gowli---Gawli-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Greek---Greek-Antoniades (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Antoniades---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Antoniades.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Antoniades.WORDS');
system("cat ../spellcheck/Holy-Bible---Greek---Greek-Antoniades.WORDS | ".
"aspell list --lang=grc  ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Antoniades.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Antoniades.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-Byzantine (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Byzantine---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Byzantine.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Byzantine.WORDS');
system("cat ../spellcheck/Holy-Bible---Greek---Greek-Byzantine.WORDS | ".
"aspell list --lang=grc  ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Byzantine.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Byzantine.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-Byzantine-Majority (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Byzantine-Majority---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Byzantine-Majority.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Byzantine-Majority.WORDS');
system("cat ../spellcheck/Holy-Bible---Greek---Greek-Byzantine-Majority.WORDS | ".
"aspell list --lang=grc  ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Byzantine-Majority.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Byzantine-Majority.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-LXX-Septuagint (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-LXX-Septuagint---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-LXX-Septuagint.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-LXX-Septuagint.WORDS');
system("cat ../spellcheck/Holy-Bible---Greek---Greek-LXX-Septuagint.WORDS | ".
"aspell list --lang=grc  ".
"> ../spellcheck/Holy-Bible---Greek---Greek-LXX-Septuagint.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-LXX-Septuagint.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-Majority-Text (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Majority-Text---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Majority-Text.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Majority-Text.WORDS');
system("cat ../spellcheck/Holy-Bible---Greek---Greek-Majority-Text.WORDS | ".
"aspell list --lang=grc  ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Majority-Text.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Majority-Text.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-Modern-Kathareuousa (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Modern-Kathareuousa---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Modern-Kathareuousa.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Modern-Kathareuousa.WORDS');
system("cat ../spellcheck/Holy-Bible---Greek---Greek-Modern-Kathareuousa.WORDS | ".
"aspell list --lang=grc  ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Modern-Kathareuousa.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Modern-Kathareuousa.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-Nestle (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Nestle---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Nestle.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Nestle.WORDS');
system("cat ../spellcheck/Holy-Bible---Greek---Greek-Nestle.WORDS | ".
"aspell list --lang=grc  ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Nestle.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Nestle.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-Pickering-Family-35 (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Pickering-Family-35---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Pickering-Family-35.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Pickering-Family-35.WORDS');
system("cat ../spellcheck/Holy-Bible---Greek---Greek-Pickering-Family-35.WORDS | ".
"aspell list --lang=grc  ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Pickering-Family-35.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Pickering-Family-35.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-SBL (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-SBL---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-SBL.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-SBL.WORDS');
system("cat ../spellcheck/Holy-Bible---Greek---Greek-SBL.WORDS | ".
"aspell list --lang=grc  ".
"> ../spellcheck/Holy-Bible---Greek---Greek-SBL.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-SBL.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-Scrivener (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Scrivener---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Scrivener.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Scrivener.WORDS');
system("cat ../spellcheck/Holy-Bible---Greek---Greek-Scrivener.WORDS | ".
"aspell list --lang=grc  ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Scrivener.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Scrivener.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-Statistical-Restoration (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Statistical-Restoration---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Statistical-Restoration.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Statistical-Restoration.WORDS');
system("cat ../spellcheck/Holy-Bible---Greek---Greek-Statistical-Restoration.WORDS | ".
"aspell list --lang=grc  ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Statistical-Restoration.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Statistical-Restoration.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-STEPBible (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-STEPBible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-STEPBible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-STEPBible.WORDS');
system("cat ../spellcheck/Holy-Bible---Greek---Greek-STEPBible.WORDS | ".
"aspell list --lang=grc  ".
"> ../spellcheck/Holy-Bible---Greek---Greek-STEPBible.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-STEPBible.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-Stephanus (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Stephanus---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Stephanus.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Stephanus.WORDS');
system("cat ../spellcheck/Holy-Bible---Greek---Greek-Stephanus.WORDS | ".
"aspell list --lang=grc  ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Stephanus.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Stephanus.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-Textus-Receptus (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Textus-Receptus---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Textus-Receptus.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Textus-Receptus.WORDS');
system("cat ../spellcheck/Holy-Bible---Greek---Greek-Textus-Receptus.WORDS | ".
"aspell list --lang=grc  ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Textus-Receptus.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Textus-Receptus.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-Textus-Receptus-Boyd (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Textus-Receptus-Boyd---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Textus-Receptus-Boyd.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Textus-Receptus-Boyd.WORDS');
system("cat ../spellcheck/Holy-Bible---Greek---Greek-Textus-Receptus-Boyd.WORDS | ".
"aspell list --lang=grc  ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Textus-Receptus-Boyd.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Textus-Receptus-Boyd.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-Textus-Receptus-Elzevir (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Textus-Receptus-Elzevir---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Textus-Receptus-Elzevir.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Textus-Receptus-Elzevir.WORDS');
system("cat ../spellcheck/Holy-Bible---Greek---Greek-Textus-Receptus-Elzevir.WORDS | ".
"aspell list --lang=grc  ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Textus-Receptus-Elzevir.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Textus-Receptus-Elzevir.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-Tischendorf (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Tischendorf---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Tischendorf.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Tischendorf.WORDS');
system("cat ../spellcheck/Holy-Bible---Greek---Greek-Tischendorf.WORDS | ".
"aspell list --lang=grc  ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Tischendorf.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Tischendorf.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-Tregelles (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Tregelles---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Tregelles.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Tregelles.WORDS');
system("cat ../spellcheck/Holy-Bible---Greek---Greek-Tregelles.WORDS | ".
"aspell list --lang=grc  ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Tregelles.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Tregelles.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-TR-Stephanus-Scrivener (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-TR-Stephanus-Scrivener---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-TR-Stephanus-Scrivener.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-TR-Stephanus-Scrivener.WORDS');
system("cat ../spellcheck/Holy-Bible---Greek---Greek-TR-Stephanus-Scrivener.WORDS | ".
"aspell list --lang=grc  ".
"> ../spellcheck/Holy-Bible---Greek---Greek-TR-Stephanus-Scrivener.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-TR-Stephanus-Scrivener.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-Westcott-Hort (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Westcott-Hort---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Westcott-Hort.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Westcott-Hort.WORDS');
system("cat ../spellcheck/Holy-Bible---Greek---Greek-Westcott-Hort.WORDS | ".
"aspell list --lang=grc  ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Westcott-Hort.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Westcott-Hort.grc');




// SPELL CHECK: Holy-Bible---Greek---Text-Critical (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Text-Critical---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Greek---Text-Critical.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Text-Critical.WORDS');
system("cat ../spellcheck/Holy-Bible---Greek---Text-Critical.WORDS | ".
"aspell list --lang=grc  ".
"> ../spellcheck/Holy-Bible---Greek---Text-Critical.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Text-Critical.grc');




// SPELL CHECK: Holy-Bible---Guduf-Gava---Guduf-Gava-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Guduf-Gava---Guduf-Gava-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Guduf-Gava---Guduf-Gava-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Guduf-Gava---Guduf-Gava-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Gujarati---Gujarati-Bible (gu)
system("cat ../www-stageresources/Holy-Bible---Gujarati---Gujarati-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Gujarati---Gujarati-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Gujarati---Gujarati-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Gujarati---Gujarati-Bible.WORDS | ".
"aspell list --lang=gu  ".
"> ../spellcheck/Holy-Bible---Gujarati---Gujarati-Bible.gu");
system('wc -l ../spellcheck/Holy-Bible---Gujarati---Gujarati-Bible.gu');




// SPELL CHECK: Holy-Bible---Gujii---Guji-Oromo-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Gujii---Guji-Oromo-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Gujii---Guji-Oromo-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Gujii---Guji-Oromo-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Haitian---Haitian-Creole-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Haitian---Haitian-Creole-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Haitian---Haitian-Creole-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Haitian---Haitian-Creole-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Haitian---Haitian-Creole-Smith (WORDS)
system("cat ../www-stageresources/Holy-Bible---Haitian---Haitian-Creole-Smith---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Haitian---Haitian-Creole-Smith.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Haitian---Haitian-Creole-Smith.WORDS');




// SPELL CHECK: Holy-Bible---Halbi---Halbi-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Halbi---Halbi-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Halbi---Halbi-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Halbi---Halbi-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Haryanvi---Haryanvi-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Haryanvi---Haryanvi-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Haryanvi---Haryanvi-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Haryanvi---Haryanvi-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Hausa---Contemporary (WORDS)
system("cat ../www-stageresources/Holy-Bible---Hausa---Contemporary---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Hausa---Contemporary.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hausa---Contemporary.WORDS');




// SPELL CHECK: Holy-Bible---Hausa---Hausa-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Hausa---Hausa-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Hausa---Hausa-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hausa---Hausa-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Havu---Havu-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Havu---Havu-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Havu---Havu-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Havu---Havu-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Hawaiian---Hawaiian-Bible-1868 (WORDS)
system("cat ../www-stageresources/Holy-Bible---Hawaiian---Hawaiian-Bible-1868---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Hawaiian---Hawaiian-Bible-1868.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hawaiian---Hawaiian-Bible-1868.WORDS');




// SPELL CHECK: Holy-Bible---Hebrew---Hebrew-Aleppo-Codex (he)
system("cat ../www-stageresources/Holy-Bible---Hebrew---Hebrew-Aleppo-Codex---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Hebrew---Hebrew-Aleppo-Codex.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Hebrew-Aleppo-Codex.WORDS');
system("cat ../spellcheck/Holy-Bible---Hebrew---Hebrew-Aleppo-Codex.WORDS | ".
"aspell list --lang=he  ".
"> ../spellcheck/Holy-Bible---Hebrew---Hebrew-Aleppo-Codex.he");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Hebrew-Aleppo-Codex.he');




// SPELL CHECK: Holy-Bible---Hebrew---Hebrew-Aleppo-Miqra-Mesorah (he)
system("cat ../www-stageresources/Holy-Bible---Hebrew---Hebrew-Aleppo-Miqra-Mesorah---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Hebrew---Hebrew-Aleppo-Miqra-Mesorah.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Hebrew-Aleppo-Miqra-Mesorah.WORDS');
system("cat ../spellcheck/Holy-Bible---Hebrew---Hebrew-Aleppo-Miqra-Mesorah.WORDS | ".
"aspell list --lang=he  ".
"> ../spellcheck/Holy-Bible---Hebrew---Hebrew-Aleppo-Miqra-Mesorah.he");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Hebrew-Aleppo-Miqra-Mesorah.he');




// SPELL CHECK: Holy-Bible---Hebrew---Hebrew-Masoretic-OT (he)
system("cat ../www-stageresources/Holy-Bible---Hebrew---Hebrew-Masoretic-OT---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Hebrew---Hebrew-Masoretic-OT.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Hebrew-Masoretic-OT.WORDS');
system("cat ../spellcheck/Holy-Bible---Hebrew---Hebrew-Masoretic-OT.WORDS | ".
"aspell list --lang=he  ".
"> ../spellcheck/Holy-Bible---Hebrew---Hebrew-Masoretic-OT.he");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Hebrew-Masoretic-OT.he');




// SPELL CHECK: Holy-Bible---Hebrew---Hebrew-STEPBible (he)
system("cat ../www-stageresources/Holy-Bible---Hebrew---Hebrew-STEPBible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Hebrew---Hebrew-STEPBible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Hebrew-STEPBible.WORDS');
system("cat ../spellcheck/Holy-Bible---Hebrew---Hebrew-STEPBible.WORDS | ".
"aspell list --lang=he  ".
"> ../spellcheck/Holy-Bible---Hebrew---Hebrew-STEPBible.he");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Hebrew-STEPBible.he');




// SPELL CHECK: Holy-Bible---Hebrew---Hebrew-Westminster-Leningrad (he)
system("cat ../www-stageresources/Holy-Bible---Hebrew---Hebrew-Westminster-Leningrad---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Hebrew---Hebrew-Westminster-Leningrad.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Hebrew-Westminster-Leningrad.WORDS');
system("cat ../spellcheck/Holy-Bible---Hebrew---Hebrew-Westminster-Leningrad.WORDS | ".
"aspell list --lang=he  ".
"> ../spellcheck/Holy-Bible---Hebrew---Hebrew-Westminster-Leningrad.he");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Hebrew-Westminster-Leningrad.he');




// SPELL CHECK: Holy-Bible---Hebrew---Hebrew-Westminster-Leningrad-Kimball (he)
system("cat ../www-stageresources/Holy-Bible---Hebrew---Hebrew-Westminster-Leningrad-Kimball---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Hebrew---Hebrew-Westminster-Leningrad-Kimball.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Hebrew-Westminster-Leningrad-Kimball.WORDS');
system("cat ../spellcheck/Holy-Bible---Hebrew---Hebrew-Westminster-Leningrad-Kimball.WORDS | ".
"aspell list --lang=he  ".
"> ../spellcheck/Holy-Bible---Hebrew---Hebrew-Westminster-Leningrad-Kimball.he");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Hebrew-Westminster-Leningrad-Kimball.he');




// SPELL CHECK: Holy-Bible---Hebrew---Living-Bible (he)
system("cat ../www-stageresources/Holy-Bible---Hebrew---Living-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Hebrew---Living-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Living-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Hebrew---Living-Bible.WORDS | ".
"aspell list --lang=he  ".
"> ../spellcheck/Holy-Bible---Hebrew---Living-Bible.he");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Living-Bible.he');




// SPELL CHECK: Holy-Bible---Hebrew---Modern-Hebrew-Bible (he)
system("cat ../www-stageresources/Holy-Bible---Hebrew---Modern-Hebrew-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Hebrew---Modern-Hebrew-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Modern-Hebrew-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Hebrew---Modern-Hebrew-Bible.WORDS | ".
"aspell list --lang=he  ".
"> ../spellcheck/Holy-Bible---Hebrew---Modern-Hebrew-Bible.he");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Modern-Hebrew-Bible.he');




// SPELL CHECK: Holy-Bible---Hebrew---Salkinson-Hebrew-Bible (he)
system("cat ../www-stageresources/Holy-Bible---Hebrew---Salkinson-Hebrew-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Hebrew---Salkinson-Hebrew-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Salkinson-Hebrew-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Hebrew---Salkinson-Hebrew-Bible.WORDS | ".
"aspell list --lang=he  ".
"> ../spellcheck/Holy-Bible---Hebrew---Salkinson-Hebrew-Bible.he");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Salkinson-Hebrew-Bible.he');




// SPELL CHECK: Holy-Bible---Hebrew---Westminster-Leningrad-Philadelphia (he)
system("cat ../www-stageresources/Holy-Bible---Hebrew---Westminster-Leningrad-Philadelphia---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Hebrew---Westminster-Leningrad-Philadelphia.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Westminster-Leningrad-Philadelphia.WORDS');
system("cat ../spellcheck/Holy-Bible---Hebrew---Westminster-Leningrad-Philadelphia.WORDS | ".
"aspell list --lang=he  ".
"> ../spellcheck/Holy-Bible---Hebrew---Westminster-Leningrad-Philadelphia.he");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Westminster-Leningrad-Philadelphia.he');




// SPELL CHECK: Holy-Bible---Hindi---Contemporary (hi)
system("cat ../www-stageresources/Holy-Bible---Hindi---Contemporary---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Hindi---Contemporary.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hindi---Contemporary.WORDS');
system("cat ../spellcheck/Holy-Bible---Hindi---Contemporary.WORDS | ".
"aspell list --lang=hi  ".
"> ../spellcheck/Holy-Bible---Hindi---Contemporary.hi");
system('wc -l ../spellcheck/Holy-Bible---Hindi---Contemporary.hi');




// SPELL CHECK: Holy-Bible---Hindi---Hindi-Bible (hi)
system("cat ../www-stageresources/Holy-Bible---Hindi---Hindi-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Hindi---Hindi-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hindi---Hindi-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Hindi---Hindi-Bible.WORDS | ".
"aspell list --lang=hi  ".
"> ../spellcheck/Holy-Bible---Hindi---Hindi-Bible.hi");
system('wc -l ../spellcheck/Holy-Bible---Hindi---Hindi-Bible.hi');




// SPELL CHECK: Holy-Bible---Hruso---Hrusso-Angka-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Hruso---Hrusso-Angka-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Hruso---Hrusso-Angka-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hruso---Hrusso-Angka-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Hungarian---Hungarian-Jewish-Bible (hu)
system("cat ../www-stageresources/Holy-Bible---Hungarian---Hungarian-Jewish-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Hungarian---Hungarian-Jewish-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hungarian---Hungarian-Jewish-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Hungarian---Hungarian-Jewish-Bible.WORDS | ".
"aspell list --lang=hu  ".
"> ../spellcheck/Holy-Bible---Hungarian---Hungarian-Jewish-Bible.hu");
system('wc -l ../spellcheck/Holy-Bible---Hungarian---Hungarian-Jewish-Bible.hu');




// SPELL CHECK: Holy-Bible---Hungarian---Hungarian-Karoli (hu)
system("cat ../www-stageresources/Holy-Bible---Hungarian---Hungarian-Karoli---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Hungarian---Hungarian-Karoli.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hungarian---Hungarian-Karoli.WORDS');
system("cat ../spellcheck/Holy-Bible---Hungarian---Hungarian-Karoli.WORDS | ".
"aspell list --lang=hu  ".
"> ../spellcheck/Holy-Bible---Hungarian---Hungarian-Karoli.hu");
system('wc -l ../spellcheck/Holy-Bible---Hungarian---Hungarian-Karoli.hu');




// SPELL CHECK: Holy-Bible---Hungarian---Magyar-Bible (hu)
system("cat ../www-stageresources/Holy-Bible---Hungarian---Magyar-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Hungarian---Magyar-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hungarian---Magyar-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Hungarian---Magyar-Bible.WORDS | ".
"aspell list --lang=hu  ".
"> ../spellcheck/Holy-Bible---Hungarian---Magyar-Bible.hu");
system('wc -l ../spellcheck/Holy-Bible---Hungarian---Magyar-Bible.hu');




// SPELL CHECK: Holy-Bible---Icelandic---Open-Living-Word (is)
system("cat ../www-stageresources/Holy-Bible---Icelandic---Open-Living-Word---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Icelandic---Open-Living-Word.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Icelandic---Open-Living-Word.WORDS');
system("cat ../spellcheck/Holy-Bible---Icelandic---Open-Living-Word.WORDS | ".
"aspell list --lang=is  ".
"> ../spellcheck/Holy-Bible---Icelandic---Open-Living-Word.is");
system('wc -l ../spellcheck/Holy-Bible---Icelandic---Open-Living-Word.is');




// SPELL CHECK: Holy-Bible---Igbo---Igbo-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Igbo---Igbo-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Igbo---Igbo-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Igbo---Igbo-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Ikizu---Ikizu-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Ikizu---Ikizu-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Ikizu---Ikizu-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ikizu---Ikizu-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Ilocano---Ilocano-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Ilocano---Ilocano-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Ilocano---Ilocano-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ilocano---Ilocano-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Ilonggo---Hiligaynon-Free-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Ilonggo---Hiligaynon-Free-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Ilonggo---Hiligaynon-Free-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ilonggo---Hiligaynon-Free-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Indonesian---Bahasa-Indonesia-Sehari-hari (id)
system("cat ../www-stageresources/Holy-Bible---Indonesian---Bahasa-Indonesia-Sehari-hari---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Indonesian---Bahasa-Indonesia-Sehari-hari.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Indonesian---Bahasa-Indonesia-Sehari-hari.WORDS');
system("cat ../spellcheck/Holy-Bible---Indonesian---Bahasa-Indonesia-Sehari-hari.WORDS | ".
"aspell list --lang=id  ".
"> ../spellcheck/Holy-Bible---Indonesian---Bahasa-Indonesia-Sehari-hari.id");
system('wc -l ../spellcheck/Holy-Bible---Indonesian---Bahasa-Indonesia-Sehari-hari.id');




// SPELL CHECK: Holy-Bible---Indonesian---For-All (id)
system("cat ../www-stageresources/Holy-Bible---Indonesian---For-All---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Indonesian---For-All.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Indonesian---For-All.WORDS');
system("cat ../spellcheck/Holy-Bible---Indonesian---For-All.WORDS | ".
"aspell list --lang=id  ".
"> ../spellcheck/Holy-Bible---Indonesian---For-All.id");
system('wc -l ../spellcheck/Holy-Bible---Indonesian---For-All.id');




// SPELL CHECK: Holy-Bible---Indonesian---New-Indonesian-Translation (id)
system("cat ../www-stageresources/Holy-Bible---Indonesian---New-Indonesian-Translation---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Indonesian---New-Indonesian-Translation.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Indonesian---New-Indonesian-Translation.WORDS');
system("cat ../spellcheck/Holy-Bible---Indonesian---New-Indonesian-Translation.WORDS | ".
"aspell list --lang=id  ".
"> ../spellcheck/Holy-Bible---Indonesian---New-Indonesian-Translation.id");
system('wc -l ../spellcheck/Holy-Bible---Indonesian---New-Indonesian-Translation.id');




// SPELL CHECK: Holy-Bible---Indonesian---Simple (id)
system("cat ../www-stageresources/Holy-Bible---Indonesian---Simple---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Indonesian---Simple.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Indonesian---Simple.WORDS');
system("cat ../spellcheck/Holy-Bible---Indonesian---Simple.WORDS | ".
"aspell list --lang=id  ".
"> ../spellcheck/Holy-Bible---Indonesian---Simple.id");
system('wc -l ../spellcheck/Holy-Bible---Indonesian---Simple.id');




// SPELL CHECK: Holy-Bible---Irish---Odomhnuill-Modern (ga)
system("cat ../www-stageresources/Holy-Bible---Irish---Odomhnuill-Modern---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Irish---Odomhnuill-Modern.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Irish---Odomhnuill-Modern.WORDS');
system("cat ../spellcheck/Holy-Bible---Irish---Odomhnuill-Modern.WORDS | ".
"aspell list --lang=ga  ".
"> ../spellcheck/Holy-Bible---Irish---Odomhnuill-Modern.ga");
system('wc -l ../spellcheck/Holy-Bible---Irish---Odomhnuill-Modern.ga');




// SPELL CHECK: Holy-Bible---Isanzu---Isanzu-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Isanzu---Isanzu-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Isanzu---Isanzu-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Isanzu---Isanzu-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Italian---Conferenza-Episcopale-Italiana (it)
system("cat ../www-stageresources/Holy-Bible---Italian---Conferenza-Episcopale-Italiana---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Italian---Conferenza-Episcopale-Italiana.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Italian---Conferenza-Episcopale-Italiana.WORDS');
system("cat ../spellcheck/Holy-Bible---Italian---Conferenza-Episcopale-Italiana.WORDS | ".
"aspell list --lang=it  ".
"> ../spellcheck/Holy-Bible---Italian---Conferenza-Episcopale-Italiana.it");
system('wc -l ../spellcheck/Holy-Bible---Italian---Conferenza-Episcopale-Italiana.it');




// SPELL CHECK: Holy-Bible---Italian---Italian-Giovanni-Diodati-Bible (it)
system("cat ../www-stageresources/Holy-Bible---Italian---Italian-Giovanni-Diodati-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Italian---Italian-Giovanni-Diodati-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Italian---Italian-Giovanni-Diodati-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Italian---Italian-Giovanni-Diodati-Bible.WORDS | ".
"aspell list --lang=it  ".
"> ../spellcheck/Holy-Bible---Italian---Italian-Giovanni-Diodati-Bible.it");
system('wc -l ../spellcheck/Holy-Bible---Italian---Italian-Giovanni-Diodati-Bible.it');




// SPELL CHECK: Holy-Bible---Italian---Italian-Riveduta-Bible (it)
system("cat ../www-stageresources/Holy-Bible---Italian---Italian-Riveduta-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Italian---Italian-Riveduta-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Italian---Italian-Riveduta-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Italian---Italian-Riveduta-Bible.WORDS | ".
"aspell list --lang=it  ".
"> ../spellcheck/Holy-Bible---Italian---Italian-Riveduta-Bible.it");
system('wc -l ../spellcheck/Holy-Bible---Italian---Italian-Riveduta-Bible.it');




// SPELL CHECK: Holy-Bible---Janji---Janji-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Janji---Janji-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Janji---Janji-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Janji---Janji-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Japanese---Japanese-Bungo-yaku (SKIP)




// SPELL CHECK: Holy-Bible---Japanese---Japanese-Electronic-Network-Bible (SKIP)




// SPELL CHECK: Holy-Bible---Japanese---Japanese-Kougo-yaku (SKIP)




// SPELL CHECK: Holy-Bible---Japanese---Japanese-Meiji-yaku (SKIP)




// SPELL CHECK: Holy-Bible---Japanese---Japanese-Raguet-yaku (SKIP)




// SPELL CHECK: Holy-Bible---Japanese---New-Japanese-New-Testament (SKIP)




// SPELL CHECK: Holy-Bible---Jumjum---Jumjum-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Jumjum---Jumjum-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Jumjum---Jumjum-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Jumjum---Jumjum-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Juray---Juray-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Juray---Juray-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Juray---Juray-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Juray---Juray-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Kamano---Kamano-Kafe (WORDS)
system("cat ../www-stageresources/Holy-Bible---Kamano---Kamano-Kafe---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Kamano---Kamano-Kafe.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Kamano---Kamano-Kafe.WORDS');




// SPELL CHECK: Holy-Bible---Kannada---Indian-Revised-Version (kn)
system("cat ../www-stageresources/Holy-Bible---Kannada---Indian-Revised-Version---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Kannada---Indian-Revised-Version.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Kannada---Indian-Revised-Version.WORDS');
system("cat ../spellcheck/Holy-Bible---Kannada---Indian-Revised-Version.WORDS | ".
"aspell list --lang=kn  ".
"> ../spellcheck/Holy-Bible---Kannada---Indian-Revised-Version.kn");
system('wc -l ../spellcheck/Holy-Bible---Kannada---Indian-Revised-Version.kn');




// SPELL CHECK: Holy-Bible---Kannada---Open-Contemporary (kn)
system("cat ../www-stageresources/Holy-Bible---Kannada---Open-Contemporary---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Kannada---Open-Contemporary.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Kannada---Open-Contemporary.WORDS');
system("cat ../spellcheck/Holy-Bible---Kannada---Open-Contemporary.WORDS | ".
"aspell list --lang=kn  ".
"> ../spellcheck/Holy-Bible---Kannada---Open-Contemporary.kn");
system('wc -l ../spellcheck/Holy-Bible---Kannada---Open-Contemporary.kn');




// SPELL CHECK: Holy-Bible---Kannada---Siddi-Bible (kn)
system("cat ../www-stageresources/Holy-Bible---Kannada---Siddi-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Kannada---Siddi-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Kannada---Siddi-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Kannada---Siddi-Bible.WORDS | ".
"aspell list --lang=kn  ".
"> ../spellcheck/Holy-Bible---Kannada---Siddi-Bible.kn");
system('wc -l ../spellcheck/Holy-Bible---Kannada---Siddi-Bible.kn');




// SPELL CHECK: Holy-Bible---Kapin---Kapin-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Kapin---Kapin-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Kapin---Kapin-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Kapin---Kapin-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Kara---Kara-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Kara---Kara-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Kara---Kara-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Kara---Kara-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Kiche---Totonicapan (WORDS)
system("cat ../www-stageresources/Holy-Bible---Kiche---Totonicapan---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Kiche---Totonicapan.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Kiche---Totonicapan.WORDS');




// SPELL CHECK: Holy-Bible---Kinga---Mahanji-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Kinga---Mahanji-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Kinga---Mahanji-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Kinga---Mahanji-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Kisi---Kisi-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Kisi---Kisi-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Kisi---Kisi-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Kisi---Kisi-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Kituba---Kituba-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Kituba---Kituba-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Kituba---Kituba-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Kituba---Kituba-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Kizalamo---Zaramo-Kizalamo-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Kizalamo---Zaramo-Kizalamo-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Kizalamo---Zaramo-Kizalamo-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Kizalamo---Zaramo-Kizalamo-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Koda---Koda-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Koda---Koda-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Koda---Koda-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Koda---Koda-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Kolami-Southeastern---Kolami-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Kolami-Southeastern---Kolami-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Kolami-Southeastern---Kolami-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Kolami-Southeastern---Kolami-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Konda-Dora---Konda-Porja-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Konda-Dora---Konda-Porja-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Konda-Dora---Konda-Porja-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Konda-Dora---Konda-Porja-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Korean---Korean-1910 (SKIP)




// SPELL CHECK: Holy-Bible---Korean---Korean-Revised-Version (SKIP)




// SPELL CHECK: Holy-Bible---Korean---Korean-RV (SKIP)




// SPELL CHECK: Holy-Bible---Kosraean---Kosraean-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Kosraean---Kosraean-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Kosraean---Kosraean-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Kosraean---Kosraean-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Koya---Koya-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Koya---Koya-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Koya---Koya-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Koya---Koya-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Kuhane---Kuhane-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Kuhane---Kuhane-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Kuhane---Kuhane-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Kuhane---Kuhane-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Kurama---Kurama-Akurumi-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Kurama---Kurama-Akurumi-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Kurama---Kurama-Akurumi-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Kurama---Kurama-Akurumi-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Kurdish---Sorani-Bible (ku)
system("cat ../www-stageresources/Holy-Bible---Kurdish---Sorani-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Kurdish---Sorani-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Kurdish---Sorani-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Kurdish---Sorani-Bible.WORDS | ".
"aspell list --lang=ku  ".
"> ../spellcheck/Holy-Bible---Kurdish---Sorani-Bible.ku");
system('wc -l ../spellcheck/Holy-Bible---Kurdish---Sorani-Bible.ku');




// SPELL CHECK: Holy-Bible---Kutu---Kutu-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Kutu---Kutu-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Kutu---Kutu-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Kutu---Kutu-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Kuturmi---Kuturmi-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Kuturmi---Kuturmi-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Kuturmi---Kuturmi-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Kuturmi---Kuturmi-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Kuvi---Kuvi-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Kuvi---Kuvi-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Kuvi---Kuvi-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Kuvi---Kuvi-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Latin---Clementine-Vulgate-1598 (la)
system("cat ../www-stageresources/Holy-Bible---Latin---Clementine-Vulgate-1598---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-1598.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-1598.WORDS');
system("cat ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-1598.WORDS | ".
"aspell list --lang=la  ".
"> ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-1598.la");
system('wc -l ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-1598.la');




// SPELL CHECK: Holy-Bible---Latin---Clementine-Vulgate-Conte (la)
system("cat ../www-stageresources/Holy-Bible---Latin---Clementine-Vulgate-Conte---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Conte.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Conte.WORDS');
system("cat ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Conte.WORDS | ".
"aspell list --lang=la  ".
"> ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Conte.la");
system('wc -l ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Conte.la');




// SPELL CHECK: Holy-Bible---Latin---Clementine-Vulgate-Hetzenauer (la)
system("cat ../www-stageresources/Holy-Bible---Latin---Clementine-Vulgate-Hetzenauer---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Hetzenauer.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Hetzenauer.WORDS');
system("cat ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Hetzenauer.WORDS | ".
"aspell list --lang=la  ".
"> ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Hetzenauer.la");
system('wc -l ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Hetzenauer.la');




// SPELL CHECK: Holy-Bible---Latin---Clementine-Vulgate-Tweedale (la)
system("cat ../www-stageresources/Holy-Bible---Latin---Clementine-Vulgate-Tweedale---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Tweedale.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Tweedale.WORDS');
system("cat ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Tweedale.WORDS | ".
"aspell list --lang=la  ".
"> ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Tweedale.la");
system('wc -l ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Tweedale.la');




// SPELL CHECK: Holy-Bible---Latin---Vulgata-Sistina (la)
system("cat ../www-stageresources/Holy-Bible---Latin---Vulgata-Sistina---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Latin---Vulgata-Sistina.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Latin---Vulgata-Sistina.WORDS');
system("cat ../spellcheck/Holy-Bible---Latin---Vulgata-Sistina.WORDS | ".
"aspell list --lang=la  ".
"> ../spellcheck/Holy-Bible---Latin---Vulgata-Sistina.la");
system('wc -l ../spellcheck/Holy-Bible---Latin---Vulgata-Sistina.la');




// SPELL CHECK: Holy-Bible---Latin---Vulgate-Jerome (la)
system("cat ../www-stageresources/Holy-Bible---Latin---Vulgate-Jerome---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Latin---Vulgate-Jerome.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Latin---Vulgate-Jerome.WORDS');
system("cat ../spellcheck/Holy-Bible---Latin---Vulgate-Jerome.WORDS | ".
"aspell list --lang=la  ".
"> ../spellcheck/Holy-Bible---Latin---Vulgate-Jerome.la");
system('wc -l ../spellcheck/Holy-Bible---Latin---Vulgate-Jerome.la');




// SPELL CHECK: Holy-Bible---Latvian---Latvian-Gluck-Bible (lv)
system("cat ../www-stageresources/Holy-Bible---Latvian---Latvian-Gluck-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Latvian---Latvian-Gluck-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Latvian---Latvian-Gluck-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Latvian---Latvian-Gluck-Bible.WORDS | ".
"aspell list --lang=lv  ".
"> ../spellcheck/Holy-Bible---Latvian---Latvian-Gluck-Bible.lv");
system('wc -l ../spellcheck/Holy-Bible---Latvian---Latvian-Gluck-Bible.lv');




// SPELL CHECK: Holy-Bible---Lingala---Lingala-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Lingala---Lingala-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Lingala---Lingala-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Lingala---Lingala-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Lithuanian---Believers-Heritage (lt)
system("cat ../www-stageresources/Holy-Bible---Lithuanian---Believers-Heritage---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Lithuanian---Believers-Heritage.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Lithuanian---Believers-Heritage.WORDS');
system("cat ../spellcheck/Holy-Bible---Lithuanian---Believers-Heritage.WORDS | ".
"aspell list --lang=lt  ".
"> ../spellcheck/Holy-Bible---Lithuanian---Believers-Heritage.lt");
system('wc -l ../spellcheck/Holy-Bible---Lithuanian---Believers-Heritage.lt');




// SPELL CHECK: Holy-Bible---Lithuanian---Open-Lithuanian-Bible (lt)
system("cat ../www-stageresources/Holy-Bible---Lithuanian---Open-Lithuanian-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Lithuanian---Open-Lithuanian-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Lithuanian---Open-Lithuanian-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Lithuanian---Open-Lithuanian-Bible.WORDS | ".
"aspell list --lang=lt  ".
"> ../spellcheck/Holy-Bible---Lithuanian---Open-Lithuanian-Bible.lt");
system('wc -l ../spellcheck/Holy-Bible---Lithuanian---Open-Lithuanian-Bible.lt');




// SPELL CHECK: Holy-Bible---Lodhi---Lodhi-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Lodhi---Lodhi-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Lodhi---Lodhi-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Lodhi---Lodhi-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Luganda---Luganda-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Luganda---Luganda-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Luganda---Luganda-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Luganda---Luganda-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Lungga---Lungga-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Lungga---Lungga-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Lungga---Lungga-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Lungga---Lungga-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Luyana---Luyana-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Luyana---Luyana-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Luyana---Luyana-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Luyana---Luyana-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Mahasu-Pahari---Baghlayani-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Mahasu-Pahari---Baghlayani-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Mahasu-Pahari---Baghlayani-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Mahasu-Pahari---Baghlayani-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Makhuwa-Meetto---Makua-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Makhuwa-Meetto---Makua-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Makhuwa-Meetto---Makua-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Makhuwa-Meetto---Makua-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Malagasy---Malagasy-Bible (mg)
system("cat ../www-stageresources/Holy-Bible---Malagasy---Malagasy-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Malagasy---Malagasy-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Malagasy---Malagasy-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Malagasy---Malagasy-Bible.WORDS | ".
"aspell list --lang=mg  ".
"> ../spellcheck/Holy-Bible---Malagasy---Malagasy-Bible.mg");
system('wc -l ../spellcheck/Holy-Bible---Malagasy---Malagasy-Bible.mg');




// SPELL CHECK: Holy-Bible---Malagasy---Tandroy-Mahafaly-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Malagasy---Tandroy-Mahafaly-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Malagasy---Tandroy-Mahafaly-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Malagasy---Tandroy-Mahafaly-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Malayalam---1910-Contemporary (ml)
system("cat ../www-stageresources/Holy-Bible---Malayalam---1910-Contemporary---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Malayalam---1910-Contemporary.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Malayalam---1910-Contemporary.WORDS');
system("cat ../spellcheck/Holy-Bible---Malayalam---1910-Contemporary.WORDS | ".
"aspell list --lang=ml  ".
"> ../spellcheck/Holy-Bible---Malayalam---1910-Contemporary.ml");
system('wc -l ../spellcheck/Holy-Bible---Malayalam---1910-Contemporary.ml');




// SPELL CHECK: Holy-Bible---Malayalam---Contemporary (ml)
system("cat ../www-stageresources/Holy-Bible---Malayalam---Contemporary---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Malayalam---Contemporary.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Malayalam---Contemporary.WORDS');
system("cat ../spellcheck/Holy-Bible---Malayalam---Contemporary.WORDS | ".
"aspell list --lang=ml  ".
"> ../spellcheck/Holy-Bible---Malayalam---Contemporary.ml");
system('wc -l ../spellcheck/Holy-Bible---Malayalam---Contemporary.ml');




// SPELL CHECK: Holy-Bible---Malayalam---Malayalam-Bible (ml)
system("cat ../www-stageresources/Holy-Bible---Malayalam---Malayalam-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Malayalam---Malayalam-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Malayalam---Malayalam-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Malayalam---Malayalam-Bible.WORDS | ".
"aspell list --lang=ml  ".
"> ../spellcheck/Holy-Bible---Malayalam---Malayalam-Bible.ml");
system('wc -l ../spellcheck/Holy-Bible---Malayalam---Malayalam-Bible.ml');




// SPELL CHECK: Holy-Bible---Malayalam---Malayalam-Bible-1910 (ml)
system("cat ../www-stageresources/Holy-Bible---Malayalam---Malayalam-Bible-1910---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Malayalam---Malayalam-Bible-1910.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Malayalam---Malayalam-Bible-1910.WORDS');
system("cat ../spellcheck/Holy-Bible---Malayalam---Malayalam-Bible-1910.WORDS | ".
"aspell list --lang=ml  ".
"> ../spellcheck/Holy-Bible---Malayalam---Malayalam-Bible-1910.ml");
system('wc -l ../spellcheck/Holy-Bible---Malayalam---Malayalam-Bible-1910.ml');




// SPELL CHECK: Holy-Bible---Male---Maale-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Male---Maale-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Male---Maale-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Male---Maale-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Manipuri---Meitei-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Manipuri---Meitei-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Manipuri---Meitei-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Manipuri---Meitei-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Maori---Maori-Bible (mi)
system("cat ../www-stageresources/Holy-Bible---Maori---Maori-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Maori---Maori-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Maori---Maori-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Maori---Maori-Bible.WORDS | ".
"aspell list --lang=mi  ".
"> ../spellcheck/Holy-Bible---Maori---Maori-Bible.mi");
system('wc -l ../spellcheck/Holy-Bible---Maori---Maori-Bible.mi');




// SPELL CHECK: Holy-Bible---Marathi---Marathi-Bible (mr)
system("cat ../www-stageresources/Holy-Bible---Marathi---Marathi-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Marathi---Marathi-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Marathi---Marathi-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Marathi---Marathi-Bible.WORDS | ".
"aspell list --lang=mr  ".
"> ../spellcheck/Holy-Bible---Marathi---Marathi-Bible.mr");
system('wc -l ../spellcheck/Holy-Bible---Marathi---Marathi-Bible.mr');




// SPELL CHECK: Holy-Bible---Marathi---Marathi-Indian-Bible (mr)
system("cat ../www-stageresources/Holy-Bible---Marathi---Marathi-Indian-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Marathi---Marathi-Indian-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Marathi---Marathi-Indian-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Marathi---Marathi-Indian-Bible.WORDS | ".
"aspell list --lang=mr  ".
"> ../spellcheck/Holy-Bible---Marathi---Marathi-Indian-Bible.mr");
system('wc -l ../spellcheck/Holy-Bible---Marathi---Marathi-Indian-Bible.mr');




// SPELL CHECK: Holy-Bible---Marghi-South---Marghi-South-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Marghi-South---Marghi-South-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Marghi-South---Marghi-South-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Marghi-South---Marghi-South-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Matengo---Amatengu-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Matengo---Amatengu-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Matengo---Amatengu-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Matengo---Amatengu-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Matumbi---Matumbi-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Matumbi---Matumbi-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Matumbi---Matumbi-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Matumbi---Matumbi-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Mbe---Mbe-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Mbe---Mbe-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Mbe---Mbe-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Mbe---Mbe-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Mbula-Bwazza---Mbula-Bwazza-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Mbula-Bwazza---Mbula-Bwazza-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Mbula-Bwazza---Mbula-Bwazza-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Mbula-Bwazza---Mbula-Bwazza-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Melo---Melo-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Melo---Melo-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Melo---Melo-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Melo---Melo-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Mori-Atas---Mori-Atas-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Mori-Atas---Mori-Atas-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Mori-Atas---Mori-Atas-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Mori-Atas---Mori-Atas-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Mpoto---Mpoto-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Mpoto---Mpoto-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Mpoto---Mpoto-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Mpoto---Mpoto-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Mum---Mum-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Mum---Mum-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Mum---Mum-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Mum---Mum-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Munda---Munda-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Munda---Munda-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Munda---Munda-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Munda---Munda-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Mwaghavul---Mwaghavul-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Mwaghavul---Mwaghavul-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Mwaghavul---Mwaghavul-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Mwaghavul---Mwaghavul-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Mwera---Mwera-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Mwera---Mwera-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Mwera---Mwera-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Mwera---Mwera-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Myanmar---Burmese-Common-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Myanmar---Burmese-Common-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Myanmar---Burmese-Common-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Myanmar---Burmese-Common-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Myanmar---Burmese-Judson (WORDS)
system("cat ../www-stageresources/Holy-Bible---Myanmar---Burmese-Judson---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Myanmar---Burmese-Judson.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Myanmar---Burmese-Judson.WORDS');




// SPELL CHECK: Holy-Bible---Myanmar---Myanmar-Burmese-Judson (WORDS)
system("cat ../www-stageresources/Holy-Bible---Myanmar---Myanmar-Burmese-Judson---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Myanmar---Myanmar-Burmese-Judson.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Myanmar---Myanmar-Burmese-Judson.WORDS');




// SPELL CHECK: Holy-Bible---Naga-Pidgin---Nagamese-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Naga-Pidgin---Nagamese-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Naga-Pidgin---Nagamese-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Naga-Pidgin---Nagamese-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Naga-Tutsa---Tutsa-Naga-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Naga-Tutsa---Tutsa-Naga-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Naga-Tutsa---Tutsa-Naga-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Naga-Tutsa---Tutsa-Naga-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Ncane---Ncane-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Ncane---Ncane-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Ncane---Ncane-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ncane---Ncane-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Ndebele---Accessible-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Ndebele---Accessible-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Ndebele---Accessible-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ndebele---Accessible-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Ndebele---Ndebele-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Ndebele---Ndebele-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Ndebele---Ndebele-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ndebele---Ndebele-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Ndendeule---Ndendeule-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Ndendeule---Ndendeule-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Ndendeule---Ndendeule-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ndendeule---Ndendeule-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Ndengereko---Ndengereko-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Ndengereko---Ndengereko-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Ndengereko---Ndengereko-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ndengereko---Ndengereko-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Ndonde-Hamba---Ndonde-Hamba-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Ndonde-Hamba---Ndonde-Hamba-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Ndonde-Hamba---Ndonde-Hamba-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ndonde-Hamba---Ndonde-Hamba-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Ndwewe---Ndwewe-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Ndwewe---Ndwewe-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Ndwewe---Ndwewe-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ndwewe---Ndwewe-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Nend---Mark (WORDS)
system("cat ../www-stageresources/Holy-Bible---Nend---Mark---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Nend---Mark.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Nend---Mark.WORDS');




// SPELL CHECK: Holy-Bible---Nepali---Nepali-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Nepali---Nepali-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Nepali---Nepali-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Nepali---Nepali-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Nepali---Nepali-Contemporary (WORDS)
system("cat ../www-stageresources/Holy-Bible---Nepali---Nepali-Contemporary---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Nepali---Nepali-Contemporary.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Nepali---Nepali-Contemporary.WORDS');




// SPELL CHECK: Holy-Bible---Ngoni---Ngoni-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Ngoni---Ngoni-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Ngoni---Ngoni-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ngoni---Ngoni-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Nkangala---Nkangala-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Nkangala---Nkangala-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Nkangala---Nkangala-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Nkangala---Nkangala-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Norwegian---Living-Bible (nb)
system("cat ../www-stageresources/Holy-Bible---Norwegian---Living-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Norwegian---Living-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Norwegian---Living-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Norwegian---Living-Bible.WORDS | ".
"aspell list --lang=nb  ".
"> ../spellcheck/Holy-Bible---Norwegian---Living-Bible.nb");
system('wc -l ../spellcheck/Holy-Bible---Norwegian---Living-Bible.nb');




// SPELL CHECK: Holy-Bible---Norwegian---Norwegian-Bible (nb)
system("cat ../www-stageresources/Holy-Bible---Norwegian---Norwegian-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Norwegian---Norwegian-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Norwegian---Norwegian-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Norwegian---Norwegian-Bible.WORDS | ".
"aspell list --lang=nb  ".
"> ../spellcheck/Holy-Bible---Norwegian---Norwegian-Bible.nb");
system('wc -l ../spellcheck/Holy-Bible---Norwegian---Norwegian-Bible.nb');




// SPELL CHECK: Holy-Bible---Norwegian---Norwegian-Student-Bible (nn)
system("cat ../www-stageresources/Holy-Bible---Norwegian---Norwegian-Student-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Norwegian---Norwegian-Student-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Norwegian---Norwegian-Student-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Norwegian---Norwegian-Student-Bible.WORDS | ".
"aspell list --lang=nn  ".
"> ../spellcheck/Holy-Bible---Norwegian---Norwegian-Student-Bible.nn");
system('wc -l ../spellcheck/Holy-Bible---Norwegian---Norwegian-Student-Bible.nn');




// SPELL CHECK: Holy-Bible---Oriya---Oriya-Bible (or)
system("cat ../www-stageresources/Holy-Bible---Oriya---Oriya-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Oriya---Oriya-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Oriya---Oriya-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Oriya---Oriya-Bible.WORDS | ".
"aspell list --lang=or  ".
"> ../spellcheck/Holy-Bible---Oriya---Oriya-Bible.or");
system('wc -l ../spellcheck/Holy-Bible---Oriya---Oriya-Bible.or');




// SPELL CHECK: Holy-Bible---Oromo---New-World (WORDS)
system("cat ../www-stageresources/Holy-Bible---Oromo---New-World---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Oromo---New-World.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Oromo---New-World.WORDS');




// SPELL CHECK: Holy-Bible---Oromo---West-Central-Oromo-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Oromo---West-Central-Oromo-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Oromo---West-Central-Oromo-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Oromo---West-Central-Oromo-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Oyda---Oyda-Bible-Latin (WORDS)
system("cat ../www-stageresources/Holy-Bible---Oyda---Oyda-Bible-Latin---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Oyda---Oyda-Bible-Latin.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Oyda---Oyda-Bible-Latin.WORDS');




// SPELL CHECK: Holy-Bible---Oyda---Oyde-Bible-Ethiopic (WORDS)
system("cat ../www-stageresources/Holy-Bible---Oyda---Oyde-Bible-Ethiopic---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Oyda---Oyde-Bible-Ethiopic.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Oyda---Oyde-Bible-Ethiopic.WORDS');




// SPELL CHECK: Holy-Bible---Padoe---Padoe-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Padoe---Padoe-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Padoe---Padoe-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Padoe---Padoe-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Palaung-Shwe---Shwe-Palaung-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Palaung-Shwe---Shwe-Palaung-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Palaung-Shwe---Shwe-Palaung-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Palaung-Shwe---Shwe-Palaung-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Panjabi---Punjabi-Bible (pa)
system("cat ../www-stageresources/Holy-Bible---Panjabi---Punjabi-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Panjabi---Punjabi-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Panjabi---Punjabi-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Panjabi---Punjabi-Bible.WORDS | ".
"aspell list --lang=pa  ".
"> ../spellcheck/Holy-Bible---Panjabi---Punjabi-Bible.pa");
system('wc -l ../spellcheck/Holy-Bible---Panjabi---Punjabi-Bible.pa');




// SPELL CHECK: Holy-Bible---Pengo---Pengo-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Pengo---Pengo-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Pengo---Pengo-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Pengo---Pengo-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Persian---Old-Persion-Version-Bible (fa)
system("cat ../www-stageresources/Holy-Bible---Persian---Old-Persion-Version-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Persian---Old-Persion-Version-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Persian---Old-Persion-Version-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Persian---Old-Persion-Version-Bible.WORDS | ".
"aspell list --lang=fa  ".
"> ../spellcheck/Holy-Bible---Persian---Old-Persion-Version-Bible.fa");
system('wc -l ../spellcheck/Holy-Bible---Persian---Old-Persion-Version-Bible.fa');




// SPELL CHECK: Holy-Bible---Persian---Open-Contemporary (fa)
system("cat ../www-stageresources/Holy-Bible---Persian---Open-Contemporary---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Persian---Open-Contemporary.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Persian---Open-Contemporary.WORDS');
system("cat ../spellcheck/Holy-Bible---Persian---Open-Contemporary.WORDS | ".
"aspell list --lang=fa  ".
"> ../spellcheck/Holy-Bible---Persian---Open-Contemporary.fa");
system('wc -l ../spellcheck/Holy-Bible---Persian---Open-Contemporary.fa');




// SPELL CHECK: Holy-Bible---Pogolo---Pogoro-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Pogolo---Pogoro-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Pogolo---Pogoro-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Pogolo---Pogoro-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Pohnpeian---Pohnpeian-NT-Psalms-New-Alphabet (WORDS)
system("cat ../www-stageresources/Holy-Bible---Pohnpeian---Pohnpeian-NT-Psalms-New-Alphabet---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Pohnpeian---Pohnpeian-NT-Psalms-New-Alphabet.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Pohnpeian---Pohnpeian-NT-Psalms-New-Alphabet.WORDS');




// SPELL CHECK: Holy-Bible---Pohnpeian---Pohnpeian-NT-Psalms-Old-Alphabet (WORDS)
system("cat ../www-stageresources/Holy-Bible---Pohnpeian---Pohnpeian-NT-Psalms-Old-Alphabet---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Pohnpeian---Pohnpeian-NT-Psalms-Old-Alphabet.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Pohnpeian---Pohnpeian-NT-Psalms-Old-Alphabet.WORDS');




// SPELL CHECK: Holy-Bible---Polci---Polci-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Polci---Polci-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Polci---Polci-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Polci---Polci-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Polish---Open-Access-Word-of-Life (pl)
system("cat ../www-stageresources/Holy-Bible---Polish---Open-Access-Word-of-Life---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Polish---Open-Access-Word-of-Life.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Polish---Open-Access-Word-of-Life.WORDS');
system("cat ../spellcheck/Holy-Bible---Polish---Open-Access-Word-of-Life.WORDS | ".
"aspell list --lang=pl  ".
"> ../spellcheck/Holy-Bible---Polish---Open-Access-Word-of-Life.pl");
system('wc -l ../spellcheck/Holy-Bible---Polish---Open-Access-Word-of-Life.pl');




// SPELL CHECK: Holy-Bible---Polish---Polish-Gdansk (pl)
system("cat ../www-stageresources/Holy-Bible---Polish---Polish-Gdansk---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Polish---Polish-Gdansk.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Polish---Polish-Gdansk.WORDS');
system("cat ../spellcheck/Holy-Bible---Polish---Polish-Gdansk.WORDS | ".
"aspell list --lang=pl  ".
"> ../spellcheck/Holy-Bible---Polish---Polish-Gdansk.pl");
system('wc -l ../spellcheck/Holy-Bible---Polish---Polish-Gdansk.pl');




// SPELL CHECK: Holy-Bible---Polish---Polish-Updated-Gdansk (pl)
system("cat ../www-stageresources/Holy-Bible---Polish---Polish-Updated-Gdansk---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Polish---Polish-Updated-Gdansk.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Polish---Polish-Updated-Gdansk.WORDS');
system("cat ../spellcheck/Holy-Bible---Polish---Polish-Updated-Gdansk.WORDS | ".
"aspell list --lang=pl  ".
"> ../spellcheck/Holy-Bible---Polish---Polish-Updated-Gdansk.pl");
system('wc -l ../spellcheck/Holy-Bible---Polish---Polish-Updated-Gdansk.pl');




// SPELL CHECK: Holy-Bible---Portuguese---Almeida-Bible-1911 (pt_PT)
system("cat ../www-stageresources/Holy-Bible---Portuguese---Almeida-Bible-1911---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Portuguese---Almeida-Bible-1911.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Portuguese---Almeida-Bible-1911.WORDS');
system("cat ../spellcheck/Holy-Bible---Portuguese---Almeida-Bible-1911.WORDS | ".
"aspell list --lang=pt_PT  ".
"> ../spellcheck/Holy-Bible---Portuguese---Almeida-Bible-1911.pt_PT");
system('wc -l ../spellcheck/Holy-Bible---Portuguese---Almeida-Bible-1911.pt_PT');




// SPELL CHECK: Holy-Bible---Portuguese---Almeida-NewOrthography (pt_PT)
system("cat ../www-stageresources/Holy-Bible---Portuguese---Almeida-NewOrthography---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Portuguese---Almeida-NewOrthography.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Portuguese---Almeida-NewOrthography.WORDS');
system("cat ../spellcheck/Holy-Bible---Portuguese---Almeida-NewOrthography.WORDS | ".
"aspell list --lang=pt_PT  ".
"> ../spellcheck/Holy-Bible---Portuguese---Almeida-NewOrthography.pt_PT");
system('wc -l ../spellcheck/Holy-Bible---Portuguese---Almeida-NewOrthography.pt_PT');




// SPELL CHECK: Holy-Bible---Portuguese---Biblia-Livre (pt_PT)
system("cat ../www-stageresources/Holy-Bible---Portuguese---Biblia-Livre---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Portuguese---Biblia-Livre.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Portuguese---Biblia-Livre.WORDS');
system("cat ../spellcheck/Holy-Bible---Portuguese---Biblia-Livre.WORDS | ".
"aspell list --lang=pt_PT  ".
"> ../spellcheck/Holy-Bible---Portuguese---Biblia-Livre.pt_PT");
system('wc -l ../spellcheck/Holy-Bible---Portuguese---Biblia-Livre.pt_PT');




// SPELL CHECK: Holy-Bible---Portuguese---Free-for-All (pt_PT)
system("cat ../www-stageresources/Holy-Bible---Portuguese---Free-for-All---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Portuguese---Free-for-All.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Portuguese---Free-for-All.WORDS');
system("cat ../spellcheck/Holy-Bible---Portuguese---Free-for-All.WORDS | ".
"aspell list --lang=pt_PT  ".
"> ../spellcheck/Holy-Bible---Portuguese---Free-for-All.pt_PT");
system('wc -l ../spellcheck/Holy-Bible---Portuguese---Free-for-All.pt_PT');




// SPELL CHECK: Holy-Bible---Portuguese---Open-New-Bible (pt_PT)
system("cat ../www-stageresources/Holy-Bible---Portuguese---Open-New-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Portuguese---Open-New-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Portuguese---Open-New-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Portuguese---Open-New-Bible.WORDS | ".
"aspell list --lang=pt_PT  ".
"> ../spellcheck/Holy-Bible---Portuguese---Open-New-Bible.pt_PT");
system('wc -l ../spellcheck/Holy-Bible---Portuguese---Open-New-Bible.pt_PT');




// SPELL CHECK: Holy-Bible---Portuguese---Portuguese-Trans-Trans (pt_PT)
system("cat ../www-stageresources/Holy-Bible---Portuguese---Portuguese-Trans-Trans---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Portuguese---Portuguese-Trans-Trans.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Portuguese---Portuguese-Trans-Trans.WORDS');
system("cat ../spellcheck/Holy-Bible---Portuguese---Portuguese-Trans-Trans.WORDS | ".
"aspell list --lang=pt_PT  ".
"> ../spellcheck/Holy-Bible---Portuguese---Portuguese-Trans-Trans.pt_PT");
system('wc -l ../spellcheck/Holy-Bible---Portuguese---Portuguese-Trans-Trans.pt_PT');




// SPELL CHECK: Holy-Bible---Portuguese---World-Portuguese-Bible (pt_PT)
system("cat ../www-stageresources/Holy-Bible---Portuguese---World-Portuguese-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Portuguese---World-Portuguese-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Portuguese---World-Portuguese-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Portuguese---World-Portuguese-Bible.WORDS | ".
"aspell list --lang=pt_PT  ".
"> ../spellcheck/Holy-Bible---Portuguese---World-Portuguese-Bible.pt_PT");
system('wc -l ../spellcheck/Holy-Bible---Portuguese---World-Portuguese-Bible.pt_PT');




// SPELL CHECK: Holy-Bible---Powari---Powari-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Powari---Powari-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Powari---Powari-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Powari---Powari-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Rakhine---Rakhine-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Rakhine---Rakhine-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Rakhine---Rakhine-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Rakhine---Rakhine-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Rangi---Rangi-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Rangi---Rangi-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Rangi---Rangi-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Rangi---Rangi-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Reli---Reli-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Reli---Reli-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Reli---Reli-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Reli---Reli-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Rohingya---Kitabul-Mukaddos-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Rohingya---Kitabul-Mukaddos-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Rohingya---Kitabul-Mukaddos-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Rohingya---Kitabul-Mukaddos-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Rohingya---Rohingya-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Rohingya---Rohingya-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Rohingya---Rohingya-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Rohingya---Rohingya-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Romanian---Bayash-Luke (ro)
system("cat ../www-stageresources/Holy-Bible---Romanian---Bayash-Luke---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Romanian---Bayash-Luke.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Romanian---Bayash-Luke.WORDS');
system("cat ../spellcheck/Holy-Bible---Romanian---Bayash-Luke.WORDS | ".
"aspell list --lang=ro  ".
"> ../spellcheck/Holy-Bible---Romanian---Bayash-Luke.ro");
system('wc -l ../spellcheck/Holy-Bible---Romanian---Bayash-Luke.ro');




// SPELL CHECK: Holy-Bible---Romanian---BTF-Bible (ro)
system("cat ../www-stageresources/Holy-Bible---Romanian---BTF-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Romanian---BTF-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Romanian---BTF-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Romanian---BTF-Bible.WORDS | ".
"aspell list --lang=ro  ".
"> ../spellcheck/Holy-Bible---Romanian---BTF-Bible.ro");
system('wc -l ../spellcheck/Holy-Bible---Romanian---BTF-Bible.ro');




// SPELL CHECK: Holy-Bible---Romanian---Cyrillic (ro)
system("cat ../www-stageresources/Holy-Bible---Romanian---Cyrillic---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Romanian---Cyrillic.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Romanian---Cyrillic.WORDS');
system("cat ../spellcheck/Holy-Bible---Romanian---Cyrillic.WORDS | ".
"aspell list --lang=ro  ".
"> ../spellcheck/Holy-Bible---Romanian---Cyrillic.ro");
system('wc -l ../spellcheck/Holy-Bible---Romanian---Cyrillic.ro');




// SPELL CHECK: Holy-Bible---Romanian---Free-Bible (ro)
system("cat ../www-stageresources/Holy-Bible---Romanian---Free-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Romanian---Free-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Romanian---Free-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Romanian---Free-Bible.WORDS | ".
"aspell list --lang=ro  ".
"> ../spellcheck/Holy-Bible---Romanian---Free-Bible.ro");
system('wc -l ../spellcheck/Holy-Bible---Romanian---Free-Bible.ro');




// SPELL CHECK: Holy-Bible---Romanian---Ludari-Luke (ro)
system("cat ../www-stageresources/Holy-Bible---Romanian---Ludari-Luke---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Romanian---Ludari-Luke.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Romanian---Ludari-Luke.WORDS');
system("cat ../spellcheck/Holy-Bible---Romanian---Ludari-Luke.WORDS | ".
"aspell list --lang=ro  ".
"> ../spellcheck/Holy-Bible---Romanian---Ludari-Luke.ro");
system('wc -l ../spellcheck/Holy-Bible---Romanian---Ludari-Luke.ro');




// SPELL CHECK: Holy-Bible---Romani---Balkans-Arli-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Romani---Balkans-Arli-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Romani---Balkans-Arli-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Romani---Balkans-Arli-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Romani---Eastern-Vlakh (WORDS)
system("cat ../www-stageresources/Holy-Bible---Romani---Eastern-Vlakh---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Romani---Eastern-Vlakh.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Romani---Eastern-Vlakh.WORDS');




// SPELL CHECK: Holy-Bible---Romani-Vlax---Arli-Luke (WORDS)
system("cat ../www-stageresources/Holy-Bible---Romani-Vlax---Arli-Luke---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Romani-Vlax---Arli-Luke.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Romani-Vlax---Arli-Luke.WORDS');




// SPELL CHECK: Holy-Bible---Romani-Vlax---Chergash-Luke (WORDS)
system("cat ../www-stageresources/Holy-Bible---Romani-Vlax---Chergash-Luke---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Romani-Vlax---Chergash-Luke.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Romani-Vlax---Chergash-Luke.WORDS');




// SPELL CHECK: Holy-Bible---Romani-Vlax---Gurbet-Luke (WORDS)
system("cat ../www-stageresources/Holy-Bible---Romani-Vlax---Gurbet-Luke---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Romani-Vlax---Gurbet-Luke.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Romani-Vlax---Gurbet-Luke.WORDS');




// SPELL CHECK: Holy-Bible---Romani-Vlax---Lovaric-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Romani-Vlax---Lovaric-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Romani-Vlax---Lovaric-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Romani-Vlax---Lovaric-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Romani-Vlax---Servi-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Romani-Vlax---Servi-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Romani-Vlax---Servi-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Romani-Vlax---Servi-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Rote-Dela---Rote-Dela-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Rote-Dela---Rote-Dela-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Rote-Dela---Rote-Dela-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Rote-Dela---Rote-Dela-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Russian---Russian-Synodal-Translation (ru)
system("cat ../www-stageresources/Holy-Bible---Russian---Russian-Synodal-Translation---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Russian---Russian-Synodal-Translation.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Russian---Russian-Synodal-Translation.WORDS');
system("cat ../spellcheck/Holy-Bible---Russian---Russian-Synodal-Translation.WORDS | ".
"aspell list --lang=ru  ".
"> ../spellcheck/Holy-Bible---Russian---Russian-Synodal-Translation.ru");
system('wc -l ../spellcheck/Holy-Bible---Russian---Russian-Synodal-Translation.ru');




// SPELL CHECK: Holy-Bible---Saafi-Saafi---Saafi-Saafi-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Saafi-Saafi---Saafi-Saafi-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Saafi-Saafi---Saafi-Saafi-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Saafi-Saafi---Saafi-Saafi-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Safwa---Safwa-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Safwa---Safwa-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Safwa---Safwa-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Safwa---Safwa-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Sakachep---Sakachep-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sakachep---Sakachep-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sakachep---Sakachep-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sakachep---Sakachep-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Sanga---Sanga-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sanga---Sanga-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sanga---Sanga-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sanga---Sanga-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Sankaran-Maninka---Alla-la-Kitabu-Seniman (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sankaran-Maninka---Alla-la-Kitabu-Seniman---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sankaran-Maninka---Alla-la-Kitabu-Seniman.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sankaran-Maninka---Alla-la-Kitabu-Seniman.WORDS');




// SPELL CHECK: Holy-Bible---Sanskrit---Assamese-Script (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sanskrit---Assamese-Script---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sanskrit---Assamese-Script.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sanskrit---Assamese-Script.WORDS');




// SPELL CHECK: Holy-Bible---Sanskrit---Bengali-Script (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sanskrit---Bengali-Script---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sanskrit---Bengali-Script.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sanskrit---Bengali-Script.WORDS');




// SPELL CHECK: Holy-Bible---Sanskrit---Burmese-Script (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sanskrit---Burmese-Script---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sanskrit---Burmese-Script.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sanskrit---Burmese-Script.WORDS');




// SPELL CHECK: Holy-Bible---Sanskrit---Cologne-Script (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sanskrit---Cologne-Script---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sanskrit---Cologne-Script.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sanskrit---Cologne-Script.WORDS');




// SPELL CHECK: Holy-Bible---Sanskrit---Devanagari-Script (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sanskrit---Devanagari-Script---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sanskrit---Devanagari-Script.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sanskrit---Devanagari-Script.WORDS');




// SPELL CHECK: Holy-Bible---Sanskrit---Gujarati-Script (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sanskrit---Gujarati-Script---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sanskrit---Gujarati-Script.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sanskrit---Gujarati-Script.WORDS');




// SPELL CHECK: Holy-Bible---Sanskrit---Harvard-Kyoto-Script (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sanskrit---Harvard-Kyoto-Script---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sanskrit---Harvard-Kyoto-Script.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sanskrit---Harvard-Kyoto-Script.WORDS');




// SPELL CHECK: Holy-Bible---Sanskrit---IAST-Script (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sanskrit---IAST-Script---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sanskrit---IAST-Script.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sanskrit---IAST-Script.WORDS');




// SPELL CHECK: Holy-Bible---Sanskrit---ISO-Script (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sanskrit---ISO-Script---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sanskrit---ISO-Script.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sanskrit---ISO-Script.WORDS');




// SPELL CHECK: Holy-Bible---Sanskrit---ITRANS-Script (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sanskrit---ITRANS-Script---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sanskrit---ITRANS-Script.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sanskrit---ITRANS-Script.WORDS');




// SPELL CHECK: Holy-Bible---Sanskrit---Kannada-Script (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sanskrit---Kannada-Script---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sanskrit---Kannada-Script.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sanskrit---Kannada-Script.WORDS');




// SPELL CHECK: Holy-Bible---Sanskrit---Khmer-Script (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sanskrit---Khmer-Script---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sanskrit---Khmer-Script.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sanskrit---Khmer-Script.WORDS');




// SPELL CHECK: Holy-Bible---Sanskrit---Malayalam-Script (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sanskrit---Malayalam-Script---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sanskrit---Malayalam-Script.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sanskrit---Malayalam-Script.WORDS');




// SPELL CHECK: Holy-Bible---Sanskrit---Oriya-Script (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sanskrit---Oriya-Script---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sanskrit---Oriya-Script.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sanskrit---Oriya-Script.WORDS');




// SPELL CHECK: Holy-Bible---Sanskrit---Punjabi-Script (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sanskrit---Punjabi-Script---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sanskrit---Punjabi-Script.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sanskrit---Punjabi-Script.WORDS');




// SPELL CHECK: Holy-Bible---Sanskrit---Sinhala-Script (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sanskrit---Sinhala-Script---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sanskrit---Sinhala-Script.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sanskrit---Sinhala-Script.WORDS');




// SPELL CHECK: Holy-Bible---Sanskrit---Tamil-Script (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sanskrit---Tamil-Script---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sanskrit---Tamil-Script.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sanskrit---Tamil-Script.WORDS');




// SPELL CHECK: Holy-Bible---Sanskrit---Telugu-Script (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sanskrit---Telugu-Script---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sanskrit---Telugu-Script.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sanskrit---Telugu-Script.WORDS');




// SPELL CHECK: Holy-Bible---Sanskrit---Thai-Script (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sanskrit---Thai-Script---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sanskrit---Thai-Script.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sanskrit---Thai-Script.WORDS');




// SPELL CHECK: Holy-Bible---Sanskrit---Tibetan-Script (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sanskrit---Tibetan-Script---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sanskrit---Tibetan-Script.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sanskrit---Tibetan-Script.WORDS');




// SPELL CHECK: Holy-Bible---Sanskrit---Urdu-Script (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sanskrit---Urdu-Script---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sanskrit---Urdu-Script.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sanskrit---Urdu-Script.WORDS');




// SPELL CHECK: Holy-Bible---Sanskrit---Velthuis-Script (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sanskrit---Velthuis-Script---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sanskrit---Velthuis-Script.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sanskrit---Velthuis-Script.WORDS');




// SPELL CHECK: Holy-Bible---Sari---Sari-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sari---Sari-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sari---Sari-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sari---Sari-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Satawalese---Satawalese-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Satawalese---Satawalese-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Satawalese---Satawalese-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Satawalese---Satawalese-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Scots-Gaelic---Scots-Gaelic-Gospel-Mark (gd)
system("cat ../www-stageresources/Holy-Bible---Scots-Gaelic---Scots-Gaelic-Gospel-Mark---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Scots-Gaelic---Scots-Gaelic-Gospel-Mark.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Scots-Gaelic---Scots-Gaelic-Gospel-Mark.WORDS');
system("cat ../spellcheck/Holy-Bible---Scots-Gaelic---Scots-Gaelic-Gospel-Mark.WORDS | ".
"aspell list --lang=gd  ".
"> ../spellcheck/Holy-Bible---Scots-Gaelic---Scots-Gaelic-Gospel-Mark.gd");
system('wc -l ../spellcheck/Holy-Bible---Scots-Gaelic---Scots-Gaelic-Gospel-Mark.gd');




// SPELL CHECK: Holy-Bible---Serbian---Karadzic-Danicic-Latin-Script (sr)
system("cat ../www-stageresources/Holy-Bible---Serbian---Karadzic-Danicic-Latin-Script---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Serbian---Karadzic-Danicic-Latin-Script.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Serbian---Karadzic-Danicic-Latin-Script.WORDS');
system("cat ../spellcheck/Holy-Bible---Serbian---Karadzic-Danicic-Latin-Script.WORDS | ".
"aspell list --lang=sr  ".
"> ../spellcheck/Holy-Bible---Serbian---Karadzic-Danicic-Latin-Script.sr");
system('wc -l ../spellcheck/Holy-Bible---Serbian---Karadzic-Danicic-Latin-Script.sr');




// SPELL CHECK: Holy-Bible---Serbian---Serbian-Ekavski-Bible (sr)
system("cat ../www-stageresources/Holy-Bible---Serbian---Serbian-Ekavski-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Serbian---Serbian-Ekavski-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Serbian---Serbian-Ekavski-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Serbian---Serbian-Ekavski-Bible.WORDS | ".
"aspell list --lang=sr  ".
"> ../spellcheck/Holy-Bible---Serbian---Serbian-Ekavski-Bible.sr");
system('wc -l ../spellcheck/Holy-Bible---Serbian---Serbian-Ekavski-Bible.sr');




// SPELL CHECK: Holy-Bible---Serbian---Serbian-ONSP-Cyrillic (sr)
system("cat ../www-stageresources/Holy-Bible---Serbian---Serbian-ONSP-Cyrillic---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Serbian---Serbian-ONSP-Cyrillic.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Serbian---Serbian-ONSP-Cyrillic.WORDS');
system("cat ../spellcheck/Holy-Bible---Serbian---Serbian-ONSP-Cyrillic.WORDS | ".
"aspell list --lang=sr  ".
"> ../spellcheck/Holy-Bible---Serbian---Serbian-ONSP-Cyrillic.sr");
system('wc -l ../spellcheck/Holy-Bible---Serbian---Serbian-ONSP-Cyrillic.sr');




// SPELL CHECK: Holy-Bible---Serbian---Serbian-ONST-Latin (sr)
system("cat ../www-stageresources/Holy-Bible---Serbian---Serbian-ONST-Latin---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Serbian---Serbian-ONST-Latin.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Serbian---Serbian-ONST-Latin.WORDS');
system("cat ../spellcheck/Holy-Bible---Serbian---Serbian-ONST-Latin.WORDS | ".
"aspell list --lang=sr  ".
"> ../spellcheck/Holy-Bible---Serbian---Serbian-ONST-Latin.sr");
system('wc -l ../spellcheck/Holy-Bible---Serbian---Serbian-ONST-Latin.sr');




// SPELL CHECK: Holy-Bible---Setswana---Open-Tswana-Living (tn)
system("cat ../www-stageresources/Holy-Bible---Setswana---Open-Tswana-Living---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Setswana---Open-Tswana-Living.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Setswana---Open-Tswana-Living.WORDS');
system("cat ../spellcheck/Holy-Bible---Setswana---Open-Tswana-Living.WORDS | ".
"aspell list --lang=tn  ".
"> ../spellcheck/Holy-Bible---Setswana---Open-Tswana-Living.tn");
system('wc -l ../spellcheck/Holy-Bible---Setswana---Open-Tswana-Living.tn');




// SPELL CHECK: Holy-Bible---Shi---Mashi-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Shi---Mashi-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Shi---Mashi-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Shi---Mashi-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Sholaga---Sholaga-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Sholaga---Sholaga-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Sholaga---Sholaga-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Sholaga---Sholaga-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Shona---Rakasununguka (WORDS)
system("cat ../www-stageresources/Holy-Bible---Shona---Rakasununguka---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Shona---Rakasununguka.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Shona---Rakasununguka.WORDS');




// SPELL CHECK: Holy-Bible---Shona---Shona-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Shona---Shona-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Shona---Shona-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Shona---Shona-Bible.WORDS');




// SPELL CHECK: Holy-Bible---SlavonicChurch---Church-Slavonic-Elizabeth (WORDS)
system("cat ../www-stageresources/Holy-Bible---SlavonicChurch---Church-Slavonic-Elizabeth---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---SlavonicChurch---Church-Slavonic-Elizabeth.WORDS");
system('wc -l ../spellcheck/Holy-Bible---SlavonicChurch---Church-Slavonic-Elizabeth.WORDS');




// SPELL CHECK: Holy-Bible---Slovak---Slovak-Bible (sk)
system("cat ../www-stageresources/Holy-Bible---Slovak---Slovak-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Slovak---Slovak-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Slovak---Slovak-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Slovak---Slovak-Bible.WORDS | ".
"aspell list --lang=sk  ".
"> ../spellcheck/Holy-Bible---Slovak---Slovak-Bible.sk");
system('wc -l ../spellcheck/Holy-Bible---Slovak---Slovak-Bible.sk');




// SPELL CHECK: Holy-Bible---Slovene---Slovene-Savli-Bible (sl)
system("cat ../www-stageresources/Holy-Bible---Slovene---Slovene-Savli-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Slovene---Slovene-Savli-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Slovene---Slovene-Savli-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Slovene---Slovene-Savli-Bible.WORDS | ".
"aspell list --lang=sl  ".
"> ../spellcheck/Holy-Bible---Slovene---Slovene-Savli-Bible.sl");
system('wc -l ../spellcheck/Holy-Bible---Slovene---Slovene-Savli-Bible.sl');




// SPELL CHECK: Holy-Bible---Slovene---Slovene-Stritarja-NT (sl)
system("cat ../www-stageresources/Holy-Bible---Slovene---Slovene-Stritarja-NT---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Slovene---Slovene-Stritarja-NT.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Slovene---Slovene-Stritarja-NT.WORDS');
system("cat ../spellcheck/Holy-Bible---Slovene---Slovene-Stritarja-NT.WORDS | ".
"aspell list --lang=sl  ".
"> ../spellcheck/Holy-Bible---Slovene---Slovene-Stritarja-NT.sl");
system('wc -l ../spellcheck/Holy-Bible---Slovene---Slovene-Stritarja-NT.sl');




// SPELL CHECK: Holy-Bible---Soli---Soli-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Soli---Soli-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Soli---Soli-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Soli---Soli-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Somali---Somali-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Somali---Somali-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Somali---Somali-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Somali---Somali-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Somau-Karia---Somau-Karia-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Somau-Karia---Somau-Karia-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Somau-Karia---Somau-Karia-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Somau-Karia---Somau-Karia-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Spanish---Biblia-Platense-Straubinger (es)
system("cat ../www-stageresources/Holy-Bible---Spanish---Biblia-Platense-Straubinger---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Spanish---Biblia-Platense-Straubinger.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Biblia-Platense-Straubinger.WORDS');
system("cat ../spellcheck/Holy-Bible---Spanish---Biblia-Platense-Straubinger.WORDS | ".
"aspell list --lang=es  ".
"> ../spellcheck/Holy-Bible---Spanish---Biblia-Platense-Straubinger.es");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Biblia-Platense-Straubinger.es');




// SPELL CHECK: Holy-Bible---Spanish---Free-Bible (es)
system("cat ../www-stageresources/Holy-Bible---Spanish---Free-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Spanish---Free-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Free-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Spanish---Free-Bible.WORDS | ".
"aspell list --lang=es  ".
"> ../spellcheck/Holy-Bible---Spanish---Free-Bible.es");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Free-Bible.es');




// SPELL CHECK: Holy-Bible---Spanish---Free-for-the-World (es)
system("cat ../www-stageresources/Holy-Bible---Spanish---Free-for-the-World---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Spanish---Free-for-the-World.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Free-for-the-World.WORDS');
system("cat ../spellcheck/Holy-Bible---Spanish---Free-for-the-World.WORDS | ".
"aspell list --lang=es  ".
"> ../spellcheck/Holy-Bible---Spanish---Free-for-the-World.es");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Free-for-the-World.es');




// SPELL CHECK: Holy-Bible---Spanish---Gods-Word-for-You (es)
system("cat ../www-stageresources/Holy-Bible---Spanish---Gods-Word-for-You---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Spanish---Gods-Word-for-You.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Gods-Word-for-You.WORDS');
system("cat ../spellcheck/Holy-Bible---Spanish---Gods-Word-for-You.WORDS | ".
"aspell list --lang=es  ".
"> ../spellcheck/Holy-Bible---Spanish---Gods-Word-for-You.es");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Gods-Word-for-You.es');




// SPELL CHECK: Holy-Bible---Spanish---Reina-Valera-1865 (es)
system("cat ../www-stageresources/Holy-Bible---Spanish---Reina-Valera-1865---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Spanish---Reina-Valera-1865.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Reina-Valera-1865.WORDS');
system("cat ../spellcheck/Holy-Bible---Spanish---Reina-Valera-1865.WORDS | ".
"aspell list --lang=es  ".
"> ../spellcheck/Holy-Bible---Spanish---Reina-Valera-1865.es");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Reina-Valera-1865.es');




// SPELL CHECK: Holy-Bible---Spanish---Reina-Valera-1909 (es)
system("cat ../www-stageresources/Holy-Bible---Spanish---Reina-Valera-1909---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Spanish---Reina-Valera-1909.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Reina-Valera-1909.WORDS');
system("cat ../spellcheck/Holy-Bible---Spanish---Reina-Valera-1909.WORDS | ".
"aspell list --lang=es  ".
"> ../spellcheck/Holy-Bible---Spanish---Reina-Valera-1909.es");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Reina-Valera-1909.es');




// SPELL CHECK: Holy-Bible---Spanish---Reina-Valera-NT-1858 (es)
system("cat ../www-stageresources/Holy-Bible---Spanish---Reina-Valera-NT-1858---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Spanish---Reina-Valera-NT-1858.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Reina-Valera-NT-1858.WORDS');
system("cat ../spellcheck/Holy-Bible---Spanish---Reina-Valera-NT-1858.WORDS | ".
"aspell list --lang=es  ".
"> ../spellcheck/Holy-Bible---Spanish---Reina-Valera-NT-1858.es");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Reina-Valera-NT-1858.es');




// SPELL CHECK: Holy-Bible---Spanish---Sagradas-Escrituras-1569 (es)
system("cat ../www-stageresources/Holy-Bible---Spanish---Sagradas-Escrituras-1569---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Spanish---Sagradas-Escrituras-1569.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Sagradas-Escrituras-1569.WORDS');
system("cat ../spellcheck/Holy-Bible---Spanish---Sagradas-Escrituras-1569.WORDS | ".
"aspell list --lang=es  ".
"> ../spellcheck/Holy-Bible---Spanish---Sagradas-Escrituras-1569.es");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Sagradas-Escrituras-1569.es');




// SPELL CHECK: Holy-Bible---Spanish---Sencillo-Bible (es)
system("cat ../www-stageresources/Holy-Bible---Spanish---Sencillo-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Spanish---Sencillo-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Sencillo-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Spanish---Sencillo-Bible.WORDS | ".
"aspell list --lang=es  ".
"> ../spellcheck/Holy-Bible---Spanish---Sencillo-Bible.es");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Sencillo-Bible.es');




// SPELL CHECK: Holy-Bible---Spanish---Spanish-New-Open-Bible (es)
system("cat ../www-stageresources/Holy-Bible---Spanish---Spanish-New-Open-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Spanish---Spanish-New-Open-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Spanish-New-Open-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Spanish---Spanish-New-Open-Bible.WORDS | ".
"aspell list --lang=es  ".
"> ../spellcheck/Holy-Bible---Spanish---Spanish-New-Open-Bible.es");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Spanish-New-Open-Bible.es');




// SPELL CHECK: Holy-Bible---Swahili---Contemporary (sw)
system("cat ../www-stageresources/Holy-Bible---Swahili---Contemporary---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Swahili---Contemporary.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Swahili---Contemporary.WORDS');
system("cat ../spellcheck/Holy-Bible---Swahili---Contemporary.WORDS | ".
"aspell list --lang=sw  ".
"> ../spellcheck/Holy-Bible---Swahili---Contemporary.sw");
system('wc -l ../spellcheck/Holy-Bible---Swahili---Contemporary.sw');




// SPELL CHECK: Holy-Bible---Swahili---New-Swahili-Bible (sw)
system("cat ../www-stageresources/Holy-Bible---Swahili---New-Swahili-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Swahili---New-Swahili-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Swahili---New-Swahili-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Swahili---New-Swahili-Bible.WORDS | ".
"aspell list --lang=sw  ".
"> ../spellcheck/Holy-Bible---Swahili---New-Swahili-Bible.sw");
system('wc -l ../spellcheck/Holy-Bible---Swahili---New-Swahili-Bible.sw');




// SPELL CHECK: Holy-Bible---Swahili---Swahili-Bible (sw)
system("cat ../www-stageresources/Holy-Bible---Swahili---Swahili-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Swahili---Swahili-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Swahili---Swahili-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Swahili---Swahili-Bible.WORDS | ".
"aspell list --lang=sw  ".
"> ../spellcheck/Holy-Bible---Swahili---Swahili-Bible.sw");
system('wc -l ../spellcheck/Holy-Bible---Swahili---Swahili-Bible.sw');




// SPELL CHECK: Holy-Bible---Swahili---Swahili-Open-Bible (sw)
system("cat ../www-stageresources/Holy-Bible---Swahili---Swahili-Open-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Swahili---Swahili-Open-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Swahili---Swahili-Open-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Swahili---Swahili-Open-Bible.WORDS | ".
"aspell list --lang=sw  ".
"> ../spellcheck/Holy-Bible---Swahili---Swahili-Open-Bible.sw");
system('wc -l ../spellcheck/Holy-Bible---Swahili---Swahili-Open-Bible.sw');




// SPELL CHECK: Holy-Bible---Swedish---Swedish-Bible (sv)
system("cat ../www-stageresources/Holy-Bible---Swedish---Swedish-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Swedish---Swedish-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Swedish---Swedish-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Swedish---Swedish-Bible.WORDS | ".
"aspell list --lang=sv  ".
"> ../spellcheck/Holy-Bible---Swedish---Swedish-Bible.sv");
system('wc -l ../spellcheck/Holy-Bible---Swedish---Swedish-Bible.sv');




// SPELL CHECK: Holy-Bible---Swedish---Swedish-Bible-1873 (sv)
system("cat ../www-stageresources/Holy-Bible---Swedish---Swedish-Bible-1873---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Swedish---Swedish-Bible-1873.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Swedish---Swedish-Bible-1873.WORDS');
system("cat ../spellcheck/Holy-Bible---Swedish---Swedish-Bible-1873.WORDS | ".
"aspell list --lang=sv  ".
"> ../spellcheck/Holy-Bible---Swedish---Swedish-Bible-1873.sv");
system('wc -l ../spellcheck/Holy-Bible---Swedish---Swedish-Bible-1873.sv');




// SPELL CHECK: Holy-Bible---Swedish---Swedish-Bible-1917 (sv)
system("cat ../www-stageresources/Holy-Bible---Swedish---Swedish-Bible-1917---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Swedish---Swedish-Bible-1917.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Swedish---Swedish-Bible-1917.WORDS');
system("cat ../spellcheck/Holy-Bible---Swedish---Swedish-Bible-1917.WORDS | ".
"aspell list --lang=sv  ".
"> ../spellcheck/Holy-Bible---Swedish---Swedish-Bible-1917.sv");
system('wc -l ../spellcheck/Holy-Bible---Swedish---Swedish-Bible-1917.sv');




// SPELL CHECK: Holy-Bible---Taabwa---Kitaabua-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Taabwa---Kitaabua-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Taabwa---Kitaabua-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Taabwa---Kitaabua-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Tagakaulo---Tagakaulo-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Tagakaulo---Tagakaulo-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Tagakaulo---Tagakaulo-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Tagakaulo---Tagakaulo-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Tagalog---Tagalog-Bible-1905 (tl)
system("cat ../www-stageresources/Holy-Bible---Tagalog---Tagalog-Bible-1905---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Tagalog---Tagalog-Bible-1905.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Tagalog---Tagalog-Bible-1905.WORDS');
system("cat ../spellcheck/Holy-Bible---Tagalog---Tagalog-Bible-1905.WORDS | ".
"aspell list --lang=tl  ".
"> ../spellcheck/Holy-Bible---Tagalog---Tagalog-Bible-1905.tl");
system('wc -l ../spellcheck/Holy-Bible---Tagalog---Tagalog-Bible-1905.tl');




// SPELL CHECK: Holy-Bible---Tagalog---Tagalog-Bible-Unlocked (tl)
system("cat ../www-stageresources/Holy-Bible---Tagalog---Tagalog-Bible-Unlocked---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Tagalog---Tagalog-Bible-Unlocked.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Tagalog---Tagalog-Bible-Unlocked.WORDS');
system("cat ../spellcheck/Holy-Bible---Tagalog---Tagalog-Bible-Unlocked.WORDS | ".
"aspell list --lang=tl  ".
"> ../spellcheck/Holy-Bible---Tagalog---Tagalog-Bible-Unlocked.tl");
system('wc -l ../spellcheck/Holy-Bible---Tagalog---Tagalog-Bible-Unlocked.tl');




// SPELL CHECK: Holy-Bible---Tagin---Tagin-First-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Tagin---Tagin-First-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Tagin---Tagin-First-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Tagin---Tagin-First-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Tamil---Open-Contemporary (ta)
system("cat ../www-stageresources/Holy-Bible---Tamil---Open-Contemporary---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Tamil---Open-Contemporary.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Tamil---Open-Contemporary.WORDS');
system("cat ../spellcheck/Holy-Bible---Tamil---Open-Contemporary.WORDS | ".
"aspell list --lang=ta  ".
"> ../spellcheck/Holy-Bible---Tamil---Open-Contemporary.ta");
system('wc -l ../spellcheck/Holy-Bible---Tamil---Open-Contemporary.ta');




// SPELL CHECK: Holy-Bible---Tamil---Tamil-Bible (ta)
system("cat ../www-stageresources/Holy-Bible---Tamil---Tamil-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Tamil---Tamil-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Tamil---Tamil-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Tamil---Tamil-Bible.WORDS | ".
"aspell list --lang=ta  ".
"> ../spellcheck/Holy-Bible---Tamil---Tamil-Bible.ta");
system('wc -l ../spellcheck/Holy-Bible---Tamil---Tamil-Bible.ta');




// SPELL CHECK: Holy-Bible---Tarok---Tarok-Nigeria-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Tarok---Tarok-Nigeria-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Tarok---Tarok-Nigeria-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Tarok---Tarok-Nigeria-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Tavoyan---Tavoyan-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Tavoyan---Tavoyan-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Tavoyan---Tavoyan-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Tavoyan---Tavoyan-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Teke-Tyee---Teke-Tyee-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Teke-Tyee---Teke-Tyee-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Teke-Tyee---Teke-Tyee-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Teke-Tyee---Teke-Tyee-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Telugu---Telugu-Bible (te)
system("cat ../www-stageresources/Holy-Bible---Telugu---Telugu-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Telugu---Telugu-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Telugu---Telugu-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Telugu---Telugu-Bible.WORDS | ".
"aspell list --lang=te  ".
"> ../spellcheck/Holy-Bible---Telugu---Telugu-Bible.te");
system('wc -l ../spellcheck/Holy-Bible---Telugu---Telugu-Bible.te');




// SPELL CHECK: Holy-Bible---Telugu---Telugu-Open-Contemporary (te)
system("cat ../www-stageresources/Holy-Bible---Telugu---Telugu-Open-Contemporary---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Telugu---Telugu-Open-Contemporary.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Telugu---Telugu-Open-Contemporary.WORDS');
system("cat ../spellcheck/Holy-Bible---Telugu---Telugu-Open-Contemporary.WORDS | ".
"aspell list --lang=te  ".
"> ../spellcheck/Holy-Bible---Telugu---Telugu-Open-Contemporary.te");
system('wc -l ../spellcheck/Holy-Bible---Telugu---Telugu-Open-Contemporary.te');




// SPELL CHECK: Holy-Bible---Tharu-Rana---Rana-Tharu-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Tharu-Rana---Rana-Tharu-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Tharu-Rana---Rana-Tharu-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Tharu-Rana---Rana-Tharu-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Thur---Leb-Thur-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Thur---Leb-Thur-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Thur---Leb-Thur-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Thur---Leb-Thur-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Tichurong---Tichurong-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Tichurong---Tichurong-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Tichurong---Tichurong-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Tichurong---Tichurong-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Tongan---Revised-West-Version (WORDS)
system("cat ../www-stageresources/Holy-Bible---Tongan---Revised-West-Version---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Tongan---Revised-West-Version.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Tongan---Revised-West-Version.WORDS');




// SPELL CHECK: Holy-Bible---Tsakhur---Tsakhur-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Tsakhur---Tsakhur-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Tsakhur---Tsakhur-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Tsakhur---Tsakhur-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Tsikimba---Tsikimba-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Tsikimba---Tsikimba-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Tsikimba---Tsikimba-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Tsikimba---Tsikimba-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Tsishingini---Tsishingini-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Tsishingini---Tsishingini-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Tsishingini---Tsishingini-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Tsishingini---Tsishingini-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Turkish---Open-Basic-Turkish (tr)
system("cat ../www-stageresources/Holy-Bible---Turkish---Open-Basic-Turkish---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Turkish---Open-Basic-Turkish.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Turkish---Open-Basic-Turkish.WORDS');
system("cat ../spellcheck/Holy-Bible---Turkish---Open-Basic-Turkish.WORDS | ".
"aspell list --lang=tr  ".
"> ../spellcheck/Holy-Bible---Turkish---Open-Basic-Turkish.tr");
system('wc -l ../spellcheck/Holy-Bible---Turkish---Open-Basic-Turkish.tr');




// SPELL CHECK: Holy-Bible---Turkish---Turkish-Bible (tr)
system("cat ../www-stageresources/Holy-Bible---Turkish---Turkish-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Turkish---Turkish-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Turkish---Turkish-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Turkish---Turkish-Bible.WORDS | ".
"aspell list --lang=tr  ".
"> ../spellcheck/Holy-Bible---Turkish---Turkish-Bible.tr");
system('wc -l ../spellcheck/Holy-Bible---Turkish---Turkish-Bible.tr');




// SPELL CHECK: Holy-Bible---Twi---Akuapem-Twi-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Twi---Akuapem-Twi-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Twi---Akuapem-Twi-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Twi---Akuapem-Twi-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Twi---Asante-Twi-WASNA (WORDS)
system("cat ../www-stageresources/Holy-Bible---Twi---Asante-Twi-WASNA---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Twi---Asante-Twi-WASNA.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Twi---Asante-Twi-WASNA.WORDS');




// SPELL CHECK: Holy-Bible---Ukrainian---New-Translation (uk)
system("cat ../www-stageresources/Holy-Bible---Ukrainian---New-Translation---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Ukrainian---New-Translation.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ukrainian---New-Translation.WORDS');
system("cat ../spellcheck/Holy-Bible---Ukrainian---New-Translation.WORDS | ".
"aspell list --lang=uk  ".
"> ../spellcheck/Holy-Bible---Ukrainian---New-Translation.uk");
system('wc -l ../spellcheck/Holy-Bible---Ukrainian---New-Translation.uk');




// SPELL CHECK: Holy-Bible---Ukrainian---Ukrainian-Freedom-Bible (uk)
system("cat ../www-stageresources/Holy-Bible---Ukrainian---Ukrainian-Freedom-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Ukrainian---Ukrainian-Freedom-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ukrainian---Ukrainian-Freedom-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Ukrainian---Ukrainian-Freedom-Bible.WORDS | ".
"aspell list --lang=uk  ".
"> ../spellcheck/Holy-Bible---Ukrainian---Ukrainian-Freedom-Bible.uk");
system('wc -l ../spellcheck/Holy-Bible---Ukrainian---Ukrainian-Freedom-Bible.uk');




// SPELL CHECK: Holy-Bible---Ukrainian---Ukrainian-NT (uk)
system("cat ../www-stageresources/Holy-Bible---Ukrainian---Ukrainian-NT---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Ukrainian---Ukrainian-NT.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ukrainian---Ukrainian-NT.WORDS');
system("cat ../spellcheck/Holy-Bible---Ukrainian---Ukrainian-NT.WORDS | ".
"aspell list --lang=uk  ".
"> ../spellcheck/Holy-Bible---Ukrainian---Ukrainian-NT.uk");
system('wc -l ../spellcheck/Holy-Bible---Ukrainian---Ukrainian-NT.uk');




// SPELL CHECK: Holy-Bible---Ukrainian---Ukrainian-Ogienko (uk)
system("cat ../www-stageresources/Holy-Bible---Ukrainian---Ukrainian-Ogienko---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Ukrainian---Ukrainian-Ogienko.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ukrainian---Ukrainian-Ogienko.WORDS');
system("cat ../spellcheck/Holy-Bible---Ukrainian---Ukrainian-Ogienko.WORDS | ".
"aspell list --lang=uk  ".
"> ../spellcheck/Holy-Bible---Ukrainian---Ukrainian-Ogienko.uk");
system('wc -l ../spellcheck/Holy-Bible---Ukrainian---Ukrainian-Ogienko.uk');




// SPELL CHECK: Holy-Bible---Urdu---Urdu-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Urdu---Urdu-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Urdu---Urdu-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Urdu---Urdu-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Urdu---Urdu-Free-Contemporary (WORDS)
system("cat ../www-stageresources/Holy-Bible---Urdu---Urdu-Free-Contemporary---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Urdu---Urdu-Free-Contemporary.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Urdu---Urdu-Free-Contemporary.WORDS');




// SPELL CHECK: Holy-Bible---Ut-Ma-in---Ut-Ma-in-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Ut-Ma-in---Ut-Ma-in-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Ut-Ma-in---Ut-Ma-in-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ut-Ma-in---Ut-Ma-in-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Uyghur---Uyghur-Bible-Arabic (WORDS)
system("cat ../www-stageresources/Holy-Bible---Uyghur---Uyghur-Bible-Arabic---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Uyghur---Uyghur-Bible-Arabic.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Uyghur---Uyghur-Bible-Arabic.WORDS');




// SPELL CHECK: Holy-Bible---Uyghur---Uyghur-Bible-Cyrillic (WORDS)
system("cat ../www-stageresources/Holy-Bible---Uyghur---Uyghur-Bible-Cyrillic---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Uyghur---Uyghur-Bible-Cyrillic.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Uyghur---Uyghur-Bible-Cyrillic.WORDS');




// SPELL CHECK: Holy-Bible---Uyghur---Uyghur-Bible-Latin (WORDS)
system("cat ../www-stageresources/Holy-Bible---Uyghur---Uyghur-Bible-Latin---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Uyghur---Uyghur-Bible-Latin.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Uyghur---Uyghur-Bible-Latin.WORDS');




// SPELL CHECK: Holy-Bible---Uyghur---Uyghur-Bible-Pinyin (WORDS)
system("cat ../www-stageresources/Holy-Bible---Uyghur---Uyghur-Bible-Pinyin---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Uyghur---Uyghur-Bible-Pinyin.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Uyghur---Uyghur-Bible-Pinyin.WORDS');




// SPELL CHECK: Holy-Bible---Vaagri-Booli---Vaagri-Booli-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Vaagri-Booli---Vaagri-Booli-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Vaagri-Booli---Vaagri-Booli-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Vaagri-Booli---Vaagri-Booli-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Vaghri---Vaghri-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Vaghri---Vaghri-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Vaghri---Vaghri-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Vaghri---Vaghri-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Vidunda---Vidunda-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Vidunda---Vidunda-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Vidunda---Vidunda-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Vidunda---Vidunda-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Vietnamese---Contemporary (vi)
system("cat ../www-stageresources/Holy-Bible---Vietnamese---Contemporary---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Vietnamese---Contemporary.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Vietnamese---Contemporary.WORDS');
system("cat ../spellcheck/Holy-Bible---Vietnamese---Contemporary.WORDS | ".
"aspell list --lang=vi  ".
"> ../spellcheck/Holy-Bible---Vietnamese---Contemporary.vi");
system('wc -l ../spellcheck/Holy-Bible---Vietnamese---Contemporary.vi');




// SPELL CHECK: Holy-Bible---Vietnamese---Vietnamese-Bible (vi)
system("cat ../www-stageresources/Holy-Bible---Vietnamese---Vietnamese-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Vietnamese---Vietnamese-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Vietnamese---Vietnamese-Bible.WORDS');
system("cat ../spellcheck/Holy-Bible---Vietnamese---Vietnamese-Bible.WORDS | ".
"aspell list --lang=vi  ".
"> ../spellcheck/Holy-Bible---Vietnamese---Vietnamese-Bible.vi");
system('wc -l ../spellcheck/Holy-Bible---Vietnamese---Vietnamese-Bible.vi');




// SPELL CHECK: Holy-Bible---Vietnamese---Vietnamese-Bible-1934 (vi)
system("cat ../www-stageresources/Holy-Bible---Vietnamese---Vietnamese-Bible-1934---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Vietnamese---Vietnamese-Bible-1934.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Vietnamese---Vietnamese-Bible-1934.WORDS');
system("cat ../spellcheck/Holy-Bible---Vietnamese---Vietnamese-Bible-1934.WORDS | ".
"aspell list --lang=vi  ".
"> ../spellcheck/Holy-Bible---Vietnamese---Vietnamese-Bible-1934.vi");
system('wc -l ../spellcheck/Holy-Bible---Vietnamese---Vietnamese-Bible-1934.vi');




// SPELL CHECK: Holy-Bible---Vwanji---Vwanji-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Vwanji---Vwanji-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Vwanji---Vwanji-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Vwanji---Vwanji-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Waddar---Waddar-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Waddar---Waddar-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Waddar---Waddar-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Waddar---Waddar-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Waja---Waja-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Waja---Waja-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Waja---Waja-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Waja---Waja-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Wolio---Kitabi-Momangkilona-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Wolio---Kitabi-Momangkilona-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Wolio---Kitabi-Momangkilona-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Wolio---Kitabi-Momangkilona-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Yaka---Ivatan-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Yaka---Ivatan-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Yaka---Ivatan-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Yaka---Ivatan-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Yaka---Yaka-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Yaka---Yaka-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Yaka---Yaka-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Yaka---Yaka-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Yalunka---Yalunka-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Yalunka---Yalunka-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Yalunka---Yalunka-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Yalunka---Yalunka-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Yamap---Yamap-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Yamap---Yamap-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Yamap---Yamap-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Yamap---Yamap-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Yansi---Yansi-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Yansi---Yansi-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Yansi---Yansi-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Yansi---Yansi-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Yemsa---Yemsa-Bible-Ethiopic (WORDS)
system("cat ../www-stageresources/Holy-Bible---Yemsa---Yemsa-Bible-Ethiopic---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Yemsa---Yemsa-Bible-Ethiopic.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Yemsa---Yemsa-Bible-Ethiopic.WORDS');




// SPELL CHECK: Holy-Bible---Yemsa---Yemsa-Bible-Latin (WORDS)
system("cat ../www-stageresources/Holy-Bible---Yemsa---Yemsa-Bible-Latin---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Yemsa---Yemsa-Bible-Latin.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Yemsa---Yemsa-Bible-Latin.WORDS');




// SPELL CHECK: Holy-Bible---Yiddish-Eastern---Eastern-Yiddish-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Yiddish-Eastern---Eastern-Yiddish-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Yiddish-Eastern---Eastern-Yiddish-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Yiddish-Eastern---Eastern-Yiddish-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Yipunu---Punu-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Yipunu---Punu-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Yipunu---Punu-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Yipunu---Punu-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Yombe---Yombe-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Yombe---Yombe-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Yombe---Yombe-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Yombe---Yombe-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Yoruba---Yoruba-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Yoruba---Yoruba-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Yoruba---Yoruba-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Yoruba---Yoruba-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Zapotec-Loxicha---Loxicha-Zapotec-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Zapotec-Loxicha---Loxicha-Zapotec-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Zapotec-Loxicha---Loxicha-Zapotec-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Zapotec-Loxicha---Loxicha-Zapotec-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Zaramo---Kizalamo-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Zaramo---Kizalamo-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Zaramo---Kizalamo-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Zaramo---Kizalamo-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Zinza---Zinza-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Zinza---Zinza-Bible---Source-Edition.noia | ".
"perl -CS -pe 's/^#.*$/\\n/g' | ".
"perl -CS -pe 's/[[:space:][:punct:]]+/\\n/g' | ".
"perl -CS -pe 's/^[[:space:][:digit:]]*$/\\n/g' | ".
"sort | uniq ".
"> ../spellcheck/Holy-Bible---Zinza---Zinza-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Zinza---Zinza-Bible.WORDS');






AION_LOOP_DIFF('../spellcheck','../spellcheck-MARKER','../spellcheck-diff');
