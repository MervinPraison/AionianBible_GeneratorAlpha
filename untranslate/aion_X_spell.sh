#!/usr/local/bin/php
<?php
// Spell checker script, automatically generated
require_once('./aion_common.php');
// SPELL CHECK: Holy-Bible---Albanian-Tosk---Albanian-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Albanian-Tosk---Albanian-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Albanian-Tosk---Albanian-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Albanian-Tosk---Albanian-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Arabic---Arabic-Van-Dyck-Bible (ar)
system("cat ../www-stageresources/Holy-Bible---Arabic---Arabic-Van-Dyck-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Arabic---Arabic-Van-Dyck-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Arabic---Arabic-Van-Dyck-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Arabic---Arabic-Van-Dyck-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=ar | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Arabic---Arabic-Van-Dyck-Bible.ar");
system('wc -l ../spellcheck/Holy-Bible---Arabic---Arabic-Van-Dyck-Bible.ar');




// SPELL CHECK: Holy-Bible---Aramaic---Aramaic-NT-Peshitta (WORDS)
system("cat ../www-stageresources/Holy-Bible---Aramaic---Aramaic-NT-Peshitta---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Aramaic---Aramaic-NT-Peshitta.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Aramaic---Aramaic-NT-Peshitta.WORDS');




// SPELL CHECK: Holy-Bible---Arapaho---Arapaho-Luke (WORDS)
system("cat ../www-stageresources/Holy-Bible---Arapaho---Arapaho-Luke---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Arapaho---Arapaho-Luke.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Arapaho---Arapaho-Luke.WORDS');




// SPELL CHECK: Holy-Bible---Armenian---Armenian-Bible-Eastern (hy)
system("cat ../www-stageresources/Holy-Bible---Armenian---Armenian-Bible-Eastern---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Armenian---Armenian-Bible-Eastern.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Armenian---Armenian-Bible-Eastern.WORDS');
system("cat ../www-stageresources/Holy-Bible---Armenian---Armenian-Bible-Eastern---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=hy | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Armenian---Armenian-Bible-Eastern.hy");
system('wc -l ../spellcheck/Holy-Bible---Armenian---Armenian-Bible-Eastern.hy');




// SPELL CHECK: Holy-Bible---Armenian---Armenian-Bible-Western (hy)
system("cat ../www-stageresources/Holy-Bible---Armenian---Armenian-Bible-Western---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Armenian---Armenian-Bible-Western.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Armenian---Armenian-Bible-Western.WORDS');
system("cat ../www-stageresources/Holy-Bible---Armenian---Armenian-Bible-Western---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=hy | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Armenian---Armenian-Bible-Western.hy");
system('wc -l ../spellcheck/Holy-Bible---Armenian---Armenian-Bible-Western.hy');




// SPELL CHECK: Holy-Bible---Assamese---Assamese-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Assamese---Assamese-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Assamese---Assamese-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Assamese---Assamese-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Azerbaijani---Azerbaijani-Bible (az)
system("cat ../www-stageresources/Holy-Bible---Azerbaijani---Azerbaijani-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Azerbaijani---Azerbaijani-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Azerbaijani---Azerbaijani-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Azerbaijani---Azerbaijani-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=az | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Azerbaijani---Azerbaijani-Bible.az");
system('wc -l ../spellcheck/Holy-Bible---Azerbaijani---Azerbaijani-Bible.az');




// SPELL CHECK: Holy-Bible---Basque---Basque-NT (WORDS)
system("cat ../www-stageresources/Holy-Bible---Basque---Basque-NT---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Basque---Basque-NT.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Basque---Basque-NT.WORDS');




// SPELL CHECK: Holy-Bible---Beaver---Beaver-Mark (WORDS)
system("cat ../www-stageresources/Holy-Bible---Beaver---Beaver-Mark---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Beaver---Beaver-Mark.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Beaver---Beaver-Mark.WORDS');




// SPELL CHECK: Holy-Bible---Bengali---Bengali-Bible (bn)
system("cat ../www-stageresources/Holy-Bible---Bengali---Bengali-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Bengali---Bengali-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Bengali---Bengali-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Bengali---Bengali-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=bn | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Bengali---Bengali-Bible.bn");
system('wc -l ../spellcheck/Holy-Bible---Bengali---Bengali-Bible.bn');




// SPELL CHECK: Holy-Bible---Breton---Breton-Gospels (br)
system("cat ../www-stageresources/Holy-Bible---Breton---Breton-Gospels---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Breton---Breton-Gospels.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Breton---Breton-Gospels.WORDS');
system("cat ../www-stageresources/Holy-Bible---Breton---Breton-Gospels---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=br | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Breton---Breton-Gospels.br");
system('wc -l ../spellcheck/Holy-Bible---Breton---Breton-Gospels.br');




// SPELL CHECK: Holy-Bible---Calo---Calo-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Calo---Calo-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Calo---Calo-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Calo---Calo-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Chamorro---Chamorro-Gospels-Acts-and-Psalms (WORDS)
system("cat ../www-stageresources/Holy-Bible---Chamorro---Chamorro-Gospels-Acts-and-Psalms---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Chamorro---Chamorro-Gospels-Acts-and-Psalms.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Chamorro---Chamorro-Gospels-Acts-and-Psalms.WORDS');




// SPELL CHECK: Holy-Bible---Cherokee---Cherokee-New-Testament (WORDS)
system("cat ../www-stageresources/Holy-Bible---Cherokee---Cherokee-New-Testament---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Cherokee---Cherokee-New-Testament.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Cherokee---Cherokee-New-Testament.WORDS');




// SPELL CHECK: Holy-Bible---Chinese---Chinese-Union-Version-Simplified (SKIP)




// SPELL CHECK: Holy-Bible---Chinese---Chinese-Union-Version-Traditional (SKIP)




// SPELL CHECK: Holy-Bible---Coptic---Coptic-Boharic-NT (WORDS)
system("cat ../www-stageresources/Holy-Bible---Coptic---Coptic-Boharic-NT---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Coptic---Coptic-Boharic-NT.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Coptic---Coptic-Boharic-NT.WORDS');




// SPELL CHECK: Holy-Bible---Coptic---Coptic-NT (WORDS)
system("cat ../www-stageresources/Holy-Bible---Coptic---Coptic-NT---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Coptic---Coptic-NT.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Coptic---Coptic-NT.WORDS');




// SPELL CHECK: Holy-Bible---Croatian---Croatian-Bible (hr)
system("cat ../www-stageresources/Holy-Bible---Croatian---Croatian-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Croatian---Croatian-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Croatian---Croatian-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Croatian---Croatian-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=hr | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Croatian---Croatian-Bible.hr");
system('wc -l ../spellcheck/Holy-Bible---Croatian---Croatian-Bible.hr');




// SPELL CHECK: Holy-Bible---Czech---Czech-Bible-Kralicka (cs)
system("cat ../www-stageresources/Holy-Bible---Czech---Czech-Bible-Kralicka---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Czech---Czech-Bible-Kralicka.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Czech---Czech-Bible-Kralicka.WORDS');
system("cat ../www-stageresources/Holy-Bible---Czech---Czech-Bible-Kralicka---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=cs | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Czech---Czech-Bible-Kralicka.cs");
system('wc -l ../spellcheck/Holy-Bible---Czech---Czech-Bible-Kralicka.cs');




// SPELL CHECK: Holy-Bible---Danish---Danish-Bible (da)
system("cat ../www-stageresources/Holy-Bible---Danish---Danish-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Danish---Danish-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Danish---Danish-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Danish---Danish-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=da | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Danish---Danish-Bible.da");
system('wc -l ../spellcheck/Holy-Bible---Danish---Danish-Bible.da');




// SPELL CHECK: Holy-Bible---Dutch---Canisiusvertaling (nl)
system("cat ../www-stageresources/Holy-Bible---Dutch---Canisiusvertaling---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Dutch---Canisiusvertaling.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Dutch---Canisiusvertaling.WORDS');
system("cat ../www-stageresources/Holy-Bible---Dutch---Canisiusvertaling---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=nl | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Dutch---Canisiusvertaling.nl");
system('wc -l ../spellcheck/Holy-Bible---Dutch---Canisiusvertaling.nl');




// SPELL CHECK: Holy-Bible---Dutch---Statenvertaling (nl)
system("cat ../www-stageresources/Holy-Bible---Dutch---Statenvertaling---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Dutch---Statenvertaling.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Dutch---Statenvertaling.WORDS');
system("cat ../www-stageresources/Holy-Bible---Dutch---Statenvertaling---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=nl | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Dutch---Statenvertaling.nl");
system('wc -l ../spellcheck/Holy-Bible---Dutch---Statenvertaling.nl');




// SPELL CHECK: Holy-Bible---English---A-Conservative-Version (en)
system("cat ../www-stageresources/Holy-Bible---English---A-Conservative-Version---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---A-Conservative-Version.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---A-Conservative-Version.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---A-Conservative-Version---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---A-Conservative-Version.en");
system('wc -l ../spellcheck/Holy-Bible---English---A-Conservative-Version.en');




// SPELL CHECK: Holy-Bible---English---Aionian-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---Aionian-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---Aionian-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Aionian-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---Aionian-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---Aionian-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---Aionian-Bible.en');




// SPELL CHECK: Holy-Bible---English---American-Standard-Version-1901 (en)
system("cat ../www-stageresources/Holy-Bible---English---American-Standard-Version-1901---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---American-Standard-Version-1901.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---American-Standard-Version-1901.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---American-Standard-Version-1901---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---American-Standard-Version-1901.en");
system('wc -l ../spellcheck/Holy-Bible---English---American-Standard-Version-1901.en');




// SPELL CHECK: Holy-Bible---English---Bible-in-Basic-English (en)
system("cat ../www-stageresources/Holy-Bible---English---Bible-in-Basic-English---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---Bible-in-Basic-English.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Bible-in-Basic-English.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---Bible-in-Basic-English---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---Bible-in-Basic-English.en");
system('wc -l ../spellcheck/Holy-Bible---English---Bible-in-Basic-English.en');




// SPELL CHECK: Holy-Bible---English---Brenton-English-Septuagint (en)
system("cat ../www-stageresources/Holy-Bible---English---Brenton-English-Septuagint---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---Brenton-English-Septuagint.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Brenton-English-Septuagint.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---Brenton-English-Septuagint---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---Brenton-English-Septuagint.en");
system('wc -l ../spellcheck/Holy-Bible---English---Brenton-English-Septuagint.en');




// SPELL CHECK: Holy-Bible---English---British-English-Septuagint-2012 (en)
system("cat ../www-stageresources/Holy-Bible---English---British-English-Septuagint-2012---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---British-English-Septuagint-2012.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---British-English-Septuagint-2012.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---British-English-Septuagint-2012---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---British-English-Septuagint-2012.en");
system('wc -l ../spellcheck/Holy-Bible---English---British-English-Septuagint-2012.en');




// SPELL CHECK: Holy-Bible---English---Catholic-Public-Domain (en)
system("cat ../www-stageresources/Holy-Bible---English---Catholic-Public-Domain---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---Catholic-Public-Domain.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Catholic-Public-Domain.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---Catholic-Public-Domain---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---Catholic-Public-Domain.en");
system('wc -l ../spellcheck/Holy-Bible---English---Catholic-Public-Domain.en');




// SPELL CHECK: Holy-Bible---English---Darby-Translation (en)
system("cat ../www-stageresources/Holy-Bible---English---Darby-Translation---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---Darby-Translation.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Darby-Translation.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---Darby-Translation---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---Darby-Translation.en");
system('wc -l ../spellcheck/Holy-Bible---English---Darby-Translation.en');




// SPELL CHECK: Holy-Bible---English---Douay-Rheims-1899 (en)
system("cat ../www-stageresources/Holy-Bible---English---Douay-Rheims-1899---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---Douay-Rheims-1899.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Douay-Rheims-1899.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---Douay-Rheims-1899---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---Douay-Rheims-1899.en");
system('wc -l ../spellcheck/Holy-Bible---English---Douay-Rheims-1899.en');




// SPELL CHECK: Holy-Bible---English---Free-Bible-Version (en)
system("cat ../www-stageresources/Holy-Bible---English---Free-Bible-Version---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---Free-Bible-Version.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Free-Bible-Version.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---Free-Bible-Version---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---Free-Bible-Version.en");
system('wc -l ../spellcheck/Holy-Bible---English---Free-Bible-Version.en');




// SPELL CHECK: Holy-Bible---English---Geneva-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---Geneva-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---Geneva-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Geneva-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---Geneva-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---Geneva-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---Geneva-Bible.en');




// SPELL CHECK: Holy-Bible---English---Gods-Living-Word (en)
system("cat ../www-stageresources/Holy-Bible---English---Gods-Living-Word---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---Gods-Living-Word.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Gods-Living-Word.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---Gods-Living-Word---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---Gods-Living-Word.en");
system('wc -l ../spellcheck/Holy-Bible---English---Gods-Living-Word.en');




// SPELL CHECK: Holy-Bible---English---Jewish-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---Jewish-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---Jewish-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Jewish-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---Jewish-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---Jewish-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---Jewish-Bible.en');




// SPELL CHECK: Holy-Bible---English---King-James-Version (en)
system("cat ../www-stageresources/Holy-Bible---English---King-James-Version---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---King-James-Version.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---King-James-Version.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---King-James-Version---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---King-James-Version.en");
system('wc -l ../spellcheck/Holy-Bible---English---King-James-Version.en');




// SPELL CHECK: Holy-Bible---English---King-James-Version-American (en)
system("cat ../www-stageresources/Holy-Bible---English---King-James-Version-American---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---King-James-Version-American.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---King-James-Version-American.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---King-James-Version-American---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---King-James-Version-American.en");
system('wc -l ../spellcheck/Holy-Bible---English---King-James-Version-American.en');




// SPELL CHECK: Holy-Bible---English---King-James-Version-Updated (en)
system("cat ../www-stageresources/Holy-Bible---English---King-James-Version-Updated---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---King-James-Version-Updated.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---King-James-Version-Updated.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---King-James-Version-Updated---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---King-James-Version-Updated.en");
system('wc -l ../spellcheck/Holy-Bible---English---King-James-Version-Updated.en');




// SPELL CHECK: Holy-Bible---English---LXX2012-U-S-English (en)
system("cat ../www-stageresources/Holy-Bible---English---LXX2012-U-S-English---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---LXX2012-U-S-English.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---LXX2012-U-S-English.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---LXX2012-U-S-English---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---LXX2012-U-S-English.en");
system('wc -l ../spellcheck/Holy-Bible---English---LXX2012-U-S-English.en');




// SPELL CHECK: Holy-Bible---English---Montgomery-NT (en)
system("cat ../www-stageresources/Holy-Bible---English---Montgomery-NT---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---Montgomery-NT.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Montgomery-NT.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---Montgomery-NT---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---Montgomery-NT.en");
system('wc -l ../spellcheck/Holy-Bible---English---Montgomery-NT.en');




// SPELL CHECK: Holy-Bible---English---New-Heart-Aramaic (en)
system("cat ../www-stageresources/Holy-Bible---English---New-Heart-Aramaic---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---New-Heart-Aramaic.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---New-Heart-Aramaic.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---New-Heart-Aramaic---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---New-Heart-Aramaic.en");
system('wc -l ../spellcheck/Holy-Bible---English---New-Heart-Aramaic.en');




// SPELL CHECK: Holy-Bible---English---New-Heart-Jehovah (en)
system("cat ../www-stageresources/Holy-Bible---English---New-Heart-Jehovah---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---New-Heart-Jehovah.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---New-Heart-Jehovah.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---New-Heart-Jehovah---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---New-Heart-Jehovah.en");
system('wc -l ../spellcheck/Holy-Bible---English---New-Heart-Jehovah.en');




// SPELL CHECK: Holy-Bible---English---New-Heart-Jesus-Messiah (en)
system("cat ../www-stageresources/Holy-Bible---English---New-Heart-Jesus-Messiah---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---New-Heart-Jesus-Messiah.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---New-Heart-Jesus-Messiah.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---New-Heart-Jesus-Messiah---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---New-Heart-Jesus-Messiah.en");
system('wc -l ../spellcheck/Holy-Bible---English---New-Heart-Jesus-Messiah.en');




// SPELL CHECK: Holy-Bible---English---New-Heart-Messianic (en)
system("cat ../www-stageresources/Holy-Bible---English---New-Heart-Messianic---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---New-Heart-Messianic.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---New-Heart-Messianic.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---New-Heart-Messianic---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---New-Heart-Messianic.en");
system('wc -l ../spellcheck/Holy-Bible---English---New-Heart-Messianic.en');




// SPELL CHECK: Holy-Bible---English---New-Heart-Standard (en)
system("cat ../www-stageresources/Holy-Bible---English---New-Heart-Standard---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---New-Heart-Standard.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---New-Heart-Standard.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---New-Heart-Standard---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---New-Heart-Standard.en");
system('wc -l ../spellcheck/Holy-Bible---English---New-Heart-Standard.en');




// SPELL CHECK: Holy-Bible---English---New-Heart-YHWH (en)
system("cat ../www-stageresources/Holy-Bible---English---New-Heart-YHWH---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---New-Heart-YHWH.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---New-Heart-YHWH.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---New-Heart-YHWH---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---New-Heart-YHWH.en");
system('wc -l ../spellcheck/Holy-Bible---English---New-Heart-YHWH.en');




// SPELL CHECK: Holy-Bible---English---One-Unity-Resource-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---One-Unity-Resource-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---One-Unity-Resource-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---One-Unity-Resource-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---One-Unity-Resource-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---One-Unity-Resource-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---One-Unity-Resource-Bible.en');




// SPELL CHECK: Holy-Bible---English---Open-English-Bible-Commonwealth (en)
system("cat ../www-stageresources/Holy-Bible---English---Open-English-Bible-Commonwealth---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---Open-English-Bible-Commonwealth.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Open-English-Bible-Commonwealth.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---Open-English-Bible-Commonwealth---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---Open-English-Bible-Commonwealth.en");
system('wc -l ../spellcheck/Holy-Bible---English---Open-English-Bible-Commonwealth.en');




// SPELL CHECK: Holy-Bible---English---Open-English-Bible-US (en)
system("cat ../www-stageresources/Holy-Bible---English---Open-English-Bible-US---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---Open-English-Bible-US.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Open-English-Bible-US.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---Open-English-Bible-US---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---Open-English-Bible-US.en");
system('wc -l ../spellcheck/Holy-Bible---English---Open-English-Bible-US.en');




// SPELL CHECK: Holy-Bible---English---Revised-Version (en)
system("cat ../www-stageresources/Holy-Bible---English---Revised-Version---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---Revised-Version.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Revised-Version.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---Revised-Version---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---Revised-Version.en");
system('wc -l ../spellcheck/Holy-Bible---English---Revised-Version.en');




// SPELL CHECK: Holy-Bible---English---Rotherham-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---Rotherham-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---Rotherham-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Rotherham-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---Rotherham-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---Rotherham-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---Rotherham-Bible.en');




// SPELL CHECK: Holy-Bible---English---Trans-Trans (en)
system("cat ../www-stageresources/Holy-Bible---English---Trans-Trans---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---Trans-Trans.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Trans-Trans.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---Trans-Trans---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---Trans-Trans.en");
system('wc -l ../spellcheck/Holy-Bible---English---Trans-Trans.en');




// SPELL CHECK: Holy-Bible---English---Twentieth-Century-NT (en)
system("cat ../www-stageresources/Holy-Bible---English---Twentieth-Century-NT---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---Twentieth-Century-NT.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Twentieth-Century-NT.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---Twentieth-Century-NT---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---Twentieth-Century-NT.en");
system('wc -l ../spellcheck/Holy-Bible---English---Twentieth-Century-NT.en');




// SPELL CHECK: Holy-Bible---English---Tyndale-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---Tyndale-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---Tyndale-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Tyndale-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---Tyndale-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---Tyndale-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---Tyndale-Bible.en');




// SPELL CHECK: Holy-Bible---English---Unlocked-Literal-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---Unlocked-Literal-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---Unlocked-Literal-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Unlocked-Literal-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---Unlocked-Literal-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---Unlocked-Literal-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---Unlocked-Literal-Bible.en');




// SPELL CHECK: Holy-Bible---English---Webster-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---Webster-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---Webster-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Webster-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---Webster-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---Webster-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---Webster-Bible.en');




// SPELL CHECK: Holy-Bible---English---Webster-Bible-Revised (en)
system("cat ../www-stageresources/Holy-Bible---English---Webster-Bible-Revised---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---Webster-Bible-Revised.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Webster-Bible-Revised.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---Webster-Bible-Revised---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---Webster-Bible-Revised.en");
system('wc -l ../spellcheck/Holy-Bible---English---Webster-Bible-Revised.en');




// SPELL CHECK: Holy-Bible---English---Weymouth-NT (en)
system("cat ../www-stageresources/Holy-Bible---English---Weymouth-NT---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---Weymouth-NT.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Weymouth-NT.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---Weymouth-NT---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---Weymouth-NT.en");
system('wc -l ../spellcheck/Holy-Bible---English---Weymouth-NT.en');




// SPELL CHECK: Holy-Bible---English---World-English-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---World-English-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---World-English-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---World-English-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---World-English-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---World-English-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---World-English-Bible.en');




// SPELL CHECK: Holy-Bible---English---World-English-Bible-British-Edition (en)
system("cat ../www-stageresources/Holy-Bible---English---World-English-Bible-British-Edition---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---World-English-Bible-British-Edition.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---World-English-Bible-British-Edition.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---World-English-Bible-British-Edition---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---World-English-Bible-British-Edition.en");
system('wc -l ../spellcheck/Holy-Bible---English---World-English-Bible-British-Edition.en');




// SPELL CHECK: Holy-Bible---English---World-Messianic-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---World-Messianic-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---World-Messianic-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---World-Messianic-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---World-Messianic-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---World-Messianic-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---World-Messianic-Bible.en');




// SPELL CHECK: Holy-Bible---English---World-Messianic-Bible-British-Edition (en)
system("cat ../www-stageresources/Holy-Bible---English---World-Messianic-Bible-British-Edition---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---World-Messianic-Bible-British-Edition.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---World-Messianic-Bible-British-Edition.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---World-Messianic-Bible-British-Edition---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---World-Messianic-Bible-British-Edition.en");
system('wc -l ../spellcheck/Holy-Bible---English---World-Messianic-Bible-British-Edition.en');




// SPELL CHECK: Holy-Bible---English---Wycliffe-Bible (en)
system("cat ../www-stageresources/Holy-Bible---English---Wycliffe-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---Wycliffe-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Wycliffe-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---Wycliffe-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---Wycliffe-Bible.en");
system('wc -l ../spellcheck/Holy-Bible---English---Wycliffe-Bible.en');




// SPELL CHECK: Holy-Bible---English---Youngs-Literal-Translation (en)
system("cat ../www-stageresources/Holy-Bible---English---Youngs-Literal-Translation---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---English---Youngs-Literal-Translation.WORDS");
system('wc -l ../spellcheck/Holy-Bible---English---Youngs-Literal-Translation.WORDS');
system("cat ../www-stageresources/Holy-Bible---English---Youngs-Literal-Translation---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=en | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---English---Youngs-Literal-Translation.en");
system('wc -l ../spellcheck/Holy-Bible---English---Youngs-Literal-Translation.en');




// SPELL CHECK: Holy-Bible---Esperanto---Esperanto-Bible (eo)
system("cat ../www-stageresources/Holy-Bible---Esperanto---Esperanto-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Esperanto---Esperanto-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Esperanto---Esperanto-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Esperanto---Esperanto-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=eo | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Esperanto---Esperanto-Bible.eo");
system('wc -l ../spellcheck/Holy-Bible---Esperanto---Esperanto-Bible.eo');




// SPELL CHECK: Holy-Bible---Finnish---Finnish-Bible (fi)
system("cat ../www-stageresources/Holy-Bible---Finnish---Finnish-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Finnish---Finnish-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Finnish---Finnish-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Finnish---Finnish-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=fi | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Finnish---Finnish-Bible.fi");
system('wc -l ../spellcheck/Holy-Bible---Finnish---Finnish-Bible.fi');




// SPELL CHECK: Holy-Bible---Finnish---Finnish-Pyha-Raamattu (fi)
system("cat ../www-stageresources/Holy-Bible---Finnish---Finnish-Pyha-Raamattu---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Finnish---Finnish-Pyha-Raamattu.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Finnish---Finnish-Pyha-Raamattu.WORDS');
system("cat ../www-stageresources/Holy-Bible---Finnish---Finnish-Pyha-Raamattu---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=fi | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Finnish---Finnish-Pyha-Raamattu.fi");
system('wc -l ../spellcheck/Holy-Bible---Finnish---Finnish-Pyha-Raamattu.fi');




// SPELL CHECK: Holy-Bible---Flemish---Flemish-De-Jonge-Bible (nl)
system("cat ../www-stageresources/Holy-Bible---Flemish---Flemish-De-Jonge-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Flemish---Flemish-De-Jonge-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Flemish---Flemish-De-Jonge-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Flemish---Flemish-De-Jonge-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=nl | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Flemish---Flemish-De-Jonge-Bible.nl");
system('wc -l ../spellcheck/Holy-Bible---Flemish---Flemish-De-Jonge-Bible.nl');




// SPELL CHECK: Holy-Bible---French---French-Crampon-Bible (fr)
system("cat ../www-stageresources/Holy-Bible---French---French-Crampon-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---French---French-Crampon-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---French-Crampon-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---French---French-Crampon-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=fr | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---French---French-Crampon-Bible.fr");
system('wc -l ../spellcheck/Holy-Bible---French---French-Crampon-Bible.fr');




// SPELL CHECK: Holy-Bible---French---French-Darby-Bible (fr)
system("cat ../www-stageresources/Holy-Bible---French---French-Darby-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---French---French-Darby-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---French-Darby-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---French---French-Darby-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=fr | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---French---French-Darby-Bible.fr");
system('wc -l ../spellcheck/Holy-Bible---French---French-Darby-Bible.fr');




// SPELL CHECK: Holy-Bible---French---French-Khan-Bible (fr)
system("cat ../www-stageresources/Holy-Bible---French---French-Khan-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---French---French-Khan-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---French-Khan-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---French---French-Khan-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=fr | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---French---French-Khan-Bible.fr");
system('wc -l ../spellcheck/Holy-Bible---French---French-Khan-Bible.fr');




// SPELL CHECK: Holy-Bible---French---French-Louis-Segond-1910-Bible (fr)
system("cat ../www-stageresources/Holy-Bible---French---French-Louis-Segond-1910-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---French---French-Louis-Segond-1910-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---French-Louis-Segond-1910-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---French---French-Louis-Segond-1910-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=fr | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---French---French-Louis-Segond-1910-Bible.fr");
system('wc -l ../spellcheck/Holy-Bible---French---French-Louis-Segond-1910-Bible.fr');




// SPELL CHECK: Holy-Bible---French---French-LXX (fr)
system("cat ../www-stageresources/Holy-Bible---French---French-LXX---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---French---French-LXX.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---French-LXX.WORDS');
system("cat ../www-stageresources/Holy-Bible---French---French-LXX---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=fr | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---French---French-LXX.fr");
system('wc -l ../spellcheck/Holy-Bible---French---French-LXX.fr');




// SPELL CHECK: Holy-Bible---French---French-Martin (fr)
system("cat ../www-stageresources/Holy-Bible---French---French-Martin---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---French---French-Martin.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---French-Martin.WORDS');
system("cat ../www-stageresources/Holy-Bible---French---French-Martin---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=fr | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---French---French-Martin.fr");
system('wc -l ../spellcheck/Holy-Bible---French---French-Martin.fr');




// SPELL CHECK: Holy-Bible---French---French-Oltramare-Bible (fr)
system("cat ../www-stageresources/Holy-Bible---French---French-Oltramare-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---French---French-Oltramare-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---French-Oltramare-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---French---French-Oltramare-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=fr | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---French---French-Oltramare-Bible.fr");
system('wc -l ../spellcheck/Holy-Bible---French---French-Oltramare-Bible.fr');




// SPELL CHECK: Holy-Bible---French---French-Ostervald-Bible (fr)
system("cat ../www-stageresources/Holy-Bible---French---French-Ostervald-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---French---French-Ostervald-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---French-Ostervald-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---French---French-Ostervald-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=fr | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---French---French-Ostervald-Bible.fr");
system('wc -l ../spellcheck/Holy-Bible---French---French-Ostervald-Bible.fr');




// SPELL CHECK: Holy-Bible---French---French-Perret-Gentil-Rilliet (fr)
system("cat ../www-stageresources/Holy-Bible---French---French-Perret-Gentil-Rilliet---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---French---French-Perret-Gentil-Rilliet.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---French-Perret-Gentil-Rilliet.WORDS');
system("cat ../www-stageresources/Holy-Bible---French---French-Perret-Gentil-Rilliet---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=fr | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---French---French-Perret-Gentil-Rilliet.fr");
system('wc -l ../spellcheck/Holy-Bible---French---French-Perret-Gentil-Rilliet.fr');




// SPELL CHECK: Holy-Bible---French---French-Stapfer-Bible (fr)
system("cat ../www-stageresources/Holy-Bible---French---French-Stapfer-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---French---French-Stapfer-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---French-Stapfer-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---French---French-Stapfer-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=fr | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---French---French-Stapfer-Bible.fr");
system('wc -l ../spellcheck/Holy-Bible---French---French-Stapfer-Bible.fr');




// SPELL CHECK: Holy-Bible---French---French-Synodale-Bible (fr)
system("cat ../www-stageresources/Holy-Bible---French---French-Synodale-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---French---French-Synodale-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---French---French-Synodale-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---French---French-Synodale-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=fr | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---French---French-Synodale-Bible.fr");
system('wc -l ../spellcheck/Holy-Bible---French---French-Synodale-Bible.fr');




// SPELL CHECK: Holy-Bible---German---German-Elberfelder-1871 (de)
system("cat ../www-stageresources/Holy-Bible---German---German-Elberfelder-1871---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---German---German-Elberfelder-1871.WORDS");
system('wc -l ../spellcheck/Holy-Bible---German---German-Elberfelder-1871.WORDS');
system("cat ../www-stageresources/Holy-Bible---German---German-Elberfelder-1871---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=de | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---German---German-Elberfelder-1871.de");
system('wc -l ../spellcheck/Holy-Bible---German---German-Elberfelder-1871.de');




// SPELL CHECK: Holy-Bible---German---German-Elberfelder-1905 (de)
system("cat ../www-stageresources/Holy-Bible---German---German-Elberfelder-1905---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---German---German-Elberfelder-1905.WORDS");
system('wc -l ../spellcheck/Holy-Bible---German---German-Elberfelder-1905.WORDS');
system("cat ../www-stageresources/Holy-Bible---German---German-Elberfelder-1905---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=de | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---German---German-Elberfelder-1905.de");
system('wc -l ../spellcheck/Holy-Bible---German---German-Elberfelder-1905.de');




// SPELL CHECK: Holy-Bible---German---German-Katholiche-Riessler (de)
system("cat ../www-stageresources/Holy-Bible---German---German-Katholiche-Riessler---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---German---German-Katholiche-Riessler.WORDS");
system('wc -l ../spellcheck/Holy-Bible---German---German-Katholiche-Riessler.WORDS');
system("cat ../www-stageresources/Holy-Bible---German---German-Katholiche-Riessler---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=de | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---German---German-Katholiche-Riessler.de");
system('wc -l ../spellcheck/Holy-Bible---German---German-Katholiche-Riessler.de');




// SPELL CHECK: Holy-Bible---German---German-Kautzsch-Weizsacker (de)
system("cat ../www-stageresources/Holy-Bible---German---German-Kautzsch-Weizsacker---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---German---German-Kautzsch-Weizsacker.WORDS");
system('wc -l ../spellcheck/Holy-Bible---German---German-Kautzsch-Weizsacker.WORDS');
system("cat ../www-stageresources/Holy-Bible---German---German-Kautzsch-Weizsacker---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=de | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---German---German-Kautzsch-Weizsacker.de");
system('wc -l ../spellcheck/Holy-Bible---German---German-Kautzsch-Weizsacker.de');




// SPELL CHECK: Holy-Bible---German---German-Luther-Bible-1545 (de)
system("cat ../www-stageresources/Holy-Bible---German---German-Luther-Bible-1545---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---German---German-Luther-Bible-1545.WORDS");
system('wc -l ../spellcheck/Holy-Bible---German---German-Luther-Bible-1545.WORDS');
system("cat ../www-stageresources/Holy-Bible---German---German-Luther-Bible-1545---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=de | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---German---German-Luther-Bible-1545.de");
system('wc -l ../spellcheck/Holy-Bible---German---German-Luther-Bible-1545.de');




// SPELL CHECK: Holy-Bible---German---German-Luther-Bible-1912 (de)
system("cat ../www-stageresources/Holy-Bible---German---German-Luther-Bible-1912---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---German---German-Luther-Bible-1912.WORDS");
system('wc -l ../spellcheck/Holy-Bible---German---German-Luther-Bible-1912.WORDS');
system("cat ../www-stageresources/Holy-Bible---German---German-Luther-Bible-1912---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=de | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---German---German-Luther-Bible-1912.de");
system('wc -l ../spellcheck/Holy-Bible---German---German-Luther-Bible-1912.de');




// SPELL CHECK: Holy-Bible---German---German-Reinhardt-Bible (de)
system("cat ../www-stageresources/Holy-Bible---German---German-Reinhardt-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---German---German-Reinhardt-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---German---German-Reinhardt-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---German---German-Reinhardt-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=de | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---German---German-Reinhardt-Bible.de");
system('wc -l ../spellcheck/Holy-Bible---German---German-Reinhardt-Bible.de');




// SPELL CHECK: Holy-Bible---German---German-Tafel-Bible (de)
system("cat ../www-stageresources/Holy-Bible---German---German-Tafel-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---German---German-Tafel-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---German---German-Tafel-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---German---German-Tafel-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=de | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---German---German-Tafel-Bible.de");
system('wc -l ../spellcheck/Holy-Bible---German---German-Tafel-Bible.de');




// SPELL CHECK: Holy-Bible---Greek---Greek-Antoniades (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Antoniades---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Antoniades.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Antoniades.WORDS');
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Antoniades---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=grc | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Antoniades.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Antoniades.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-Byzantine-Majority (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Byzantine-Majority---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Byzantine-Majority.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Byzantine-Majority.WORDS');
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Byzantine-Majority---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=grc | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Byzantine-Majority.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Byzantine-Majority.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-LXX-Septuagint (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-LXX-Septuagint---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-LXX-Septuagint.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-LXX-Septuagint.WORDS');
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-LXX-Septuagint---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=grc | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Greek---Greek-LXX-Septuagint.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-LXX-Septuagint.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-Majority-Text (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Majority-Text---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Majority-Text.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Majority-Text.WORDS');
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Majority-Text---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=grc | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Majority-Text.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Majority-Text.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-Nestle (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Nestle---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Nestle.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Nestle.WORDS');
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Nestle---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=grc | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Nestle.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Nestle.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-Pickering-Family-35 (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Pickering-Family-35---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Pickering-Family-35.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Pickering-Family-35.WORDS');
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Pickering-Family-35---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=grc | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Pickering-Family-35.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Pickering-Family-35.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-Textus-Receptus (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Textus-Receptus---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Textus-Receptus.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Textus-Receptus.WORDS');
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Textus-Receptus---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=grc | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Textus-Receptus.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Textus-Receptus.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-Textus-Receptus-Elzevir (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Textus-Receptus-Elzevir---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Textus-Receptus-Elzevir.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Textus-Receptus-Elzevir.WORDS');
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Textus-Receptus-Elzevir---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=grc | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Textus-Receptus-Elzevir.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Textus-Receptus-Elzevir.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-Tischendorf (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Tischendorf---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Tischendorf.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Tischendorf.WORDS');
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Tischendorf---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=grc | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Tischendorf.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Tischendorf.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-Tregelles (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Tregelles---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Tregelles.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Tregelles.WORDS');
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Tregelles---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=grc | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Tregelles.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Tregelles.grc');




// SPELL CHECK: Holy-Bible---Greek---Greek-Westcott-Hort (grc)
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Westcott-Hort---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Westcott-Hort.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Westcott-Hort.WORDS');
system("cat ../www-stageresources/Holy-Bible---Greek---Greek-Westcott-Hort---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=grc | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Greek---Greek-Westcott-Hort.grc");
system('wc -l ../spellcheck/Holy-Bible---Greek---Greek-Westcott-Hort.grc');




// SPELL CHECK: Holy-Bible---Gujarati---Gujarati-Bible (gu)
system("cat ../www-stageresources/Holy-Bible---Gujarati---Gujarati-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Gujarati---Gujarati-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Gujarati---Gujarati-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Gujarati---Gujarati-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=gu | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Gujarati---Gujarati-Bible.gu");
system('wc -l ../spellcheck/Holy-Bible---Gujarati---Gujarati-Bible.gu');




// SPELL CHECK: Holy-Bible---Haitian---Haitian-Creole-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Haitian---Haitian-Creole-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Haitian---Haitian-Creole-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Haitian---Haitian-Creole-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Hawaiian---Hawaiian-Bible-1868 (WORDS)
system("cat ../www-stageresources/Holy-Bible---Hawaiian---Hawaiian-Bible-1868---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Hawaiian---Hawaiian-Bible-1868.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hawaiian---Hawaiian-Bible-1868.WORDS');




// SPELL CHECK: Holy-Bible---Hebrew---Hebrew-Aleppo-Codex (he)
system("cat ../www-stageresources/Holy-Bible---Hebrew---Hebrew-Aleppo-Codex---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Hebrew---Hebrew-Aleppo-Codex.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Hebrew-Aleppo-Codex.WORDS');
system("cat ../www-stageresources/Holy-Bible---Hebrew---Hebrew-Aleppo-Codex---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=he | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Hebrew---Hebrew-Aleppo-Codex.he");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Hebrew-Aleppo-Codex.he');




// SPELL CHECK: Holy-Bible---Hebrew---Hebrew-Masoretic-OT (he)
system("cat ../www-stageresources/Holy-Bible---Hebrew---Hebrew-Masoretic-OT---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Hebrew---Hebrew-Masoretic-OT.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Hebrew-Masoretic-OT.WORDS');
system("cat ../www-stageresources/Holy-Bible---Hebrew---Hebrew-Masoretic-OT---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=he | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Hebrew---Hebrew-Masoretic-OT.he");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Hebrew-Masoretic-OT.he');




// SPELL CHECK: Holy-Bible---Hebrew---Hebrew-Open-Scriptures (he)
system("cat ../www-stageresources/Holy-Bible---Hebrew---Hebrew-Open-Scriptures---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Hebrew---Hebrew-Open-Scriptures.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Hebrew-Open-Scriptures.WORDS');
system("cat ../www-stageresources/Holy-Bible---Hebrew---Hebrew-Open-Scriptures---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=he | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Hebrew---Hebrew-Open-Scriptures.he");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Hebrew-Open-Scriptures.he');




// SPELL CHECK: Holy-Bible---Hebrew---Hebrew-Westminster-Leningrad (he)
system("cat ../www-stageresources/Holy-Bible---Hebrew---Hebrew-Westminster-Leningrad---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Hebrew---Hebrew-Westminster-Leningrad.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Hebrew-Westminster-Leningrad.WORDS');
system("cat ../www-stageresources/Holy-Bible---Hebrew---Hebrew-Westminster-Leningrad---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=he | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Hebrew---Hebrew-Westminster-Leningrad.he");
system('wc -l ../spellcheck/Holy-Bible---Hebrew---Hebrew-Westminster-Leningrad.he');




// SPELL CHECK: Holy-Bible---Hindi---Hindi-Bible (hi)
system("cat ../www-stageresources/Holy-Bible---Hindi---Hindi-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Hindi---Hindi-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hindi---Hindi-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Hindi---Hindi-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=hi | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Hindi---Hindi-Bible.hi");
system('wc -l ../spellcheck/Holy-Bible---Hindi---Hindi-Bible.hi');




// SPELL CHECK: Holy-Bible---Hungarian---Hungarian-Karoli (hu)
system("cat ../www-stageresources/Holy-Bible---Hungarian---Hungarian-Karoli---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Hungarian---Hungarian-Karoli.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Hungarian---Hungarian-Karoli.WORDS');
system("cat ../www-stageresources/Holy-Bible---Hungarian---Hungarian-Karoli---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=hu | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Hungarian---Hungarian-Karoli.hu");
system('wc -l ../spellcheck/Holy-Bible---Hungarian---Hungarian-Karoli.hu');




// SPELL CHECK: Holy-Bible---Italian---Italian-Giovanni-Diodati-Bible (it)
system("cat ../www-stageresources/Holy-Bible---Italian---Italian-Giovanni-Diodati-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Italian---Italian-Giovanni-Diodati-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Italian---Italian-Giovanni-Diodati-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Italian---Italian-Giovanni-Diodati-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=it | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Italian---Italian-Giovanni-Diodati-Bible.it");
system('wc -l ../spellcheck/Holy-Bible---Italian---Italian-Giovanni-Diodati-Bible.it');




// SPELL CHECK: Holy-Bible---Italian---Italian-Riveduta-Bible (it)
system("cat ../www-stageresources/Holy-Bible---Italian---Italian-Riveduta-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Italian---Italian-Riveduta-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Italian---Italian-Riveduta-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Italian---Italian-Riveduta-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=it | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Italian---Italian-Riveduta-Bible.it");
system('wc -l ../spellcheck/Holy-Bible---Italian---Italian-Riveduta-Bible.it');




// SPELL CHECK: Holy-Bible---Japanese---Japanese-Bungo-yaku (SKIP)




// SPELL CHECK: Holy-Bible---Japanese---Japanese-Electronic-Network-Bible (SKIP)




// SPELL CHECK: Holy-Bible---Japanese---Japanese-Kougo-yaku (SKIP)




// SPELL CHECK: Holy-Bible---Japanese---Japanese-Meiji-yaku (SKIP)




// SPELL CHECK: Holy-Bible---Japanese---Japanese-Raguet-yaku (SKIP)




// SPELL CHECK: Holy-Bible---Japanese---New-Japanese-New-Testament (SKIP)




// SPELL CHECK: Holy-Bible---Kannada---Kannada-Bible (kn)
system("cat ../www-stageresources/Holy-Bible---Kannada---Kannada-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Kannada---Kannada-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Kannada---Kannada-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Kannada---Kannada-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=kn | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Kannada---Kannada-Bible.kn");
system('wc -l ../spellcheck/Holy-Bible---Kannada---Kannada-Bible.kn');




// SPELL CHECK: Holy-Bible---Korean---Korean-RV (SKIP)




// SPELL CHECK: Holy-Bible---Kosraean---Kosraean-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Kosraean---Kosraean-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Kosraean---Kosraean-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Kosraean---Kosraean-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Latin---Clementine-Vulgate-1598 (la)
system("cat ../www-stageresources/Holy-Bible---Latin---Clementine-Vulgate-1598---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-1598.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-1598.WORDS');
system("cat ../www-stageresources/Holy-Bible---Latin---Clementine-Vulgate-1598---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=la | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-1598.la");
system('wc -l ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-1598.la');




// SPELL CHECK: Holy-Bible---Latin---Clementine-Vulgate-Conte (la)
system("cat ../www-stageresources/Holy-Bible---Latin---Clementine-Vulgate-Conte---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Conte.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Conte.WORDS');
system("cat ../www-stageresources/Holy-Bible---Latin---Clementine-Vulgate-Conte---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=la | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Conte.la");
system('wc -l ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Conte.la');




// SPELL CHECK: Holy-Bible---Latin---Clementine-Vulgate-Hetzenauer (la)
system("cat ../www-stageresources/Holy-Bible---Latin---Clementine-Vulgate-Hetzenauer---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Hetzenauer.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Hetzenauer.WORDS');
system("cat ../www-stageresources/Holy-Bible---Latin---Clementine-Vulgate-Hetzenauer---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=la | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Hetzenauer.la");
system('wc -l ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Hetzenauer.la');




// SPELL CHECK: Holy-Bible---Latin---Clementine-Vulgate-Tweedale (la)
system("cat ../www-stageresources/Holy-Bible---Latin---Clementine-Vulgate-Tweedale---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Tweedale.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Tweedale.WORDS');
system("cat ../www-stageresources/Holy-Bible---Latin---Clementine-Vulgate-Tweedale---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=la | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Tweedale.la");
system('wc -l ../spellcheck/Holy-Bible---Latin---Clementine-Vulgate-Tweedale.la');




// SPELL CHECK: Holy-Bible---Latin---Vulgata-Sistina (la)
system("cat ../www-stageresources/Holy-Bible---Latin---Vulgata-Sistina---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Latin---Vulgata-Sistina.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Latin---Vulgata-Sistina.WORDS');
system("cat ../www-stageresources/Holy-Bible---Latin---Vulgata-Sistina---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=la | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Latin---Vulgata-Sistina.la");
system('wc -l ../spellcheck/Holy-Bible---Latin---Vulgata-Sistina.la');




// SPELL CHECK: Holy-Bible---Latin---Vulgate-Jerome (la)
system("cat ../www-stageresources/Holy-Bible---Latin---Vulgate-Jerome---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Latin---Vulgate-Jerome.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Latin---Vulgate-Jerome.WORDS');
system("cat ../www-stageresources/Holy-Bible---Latin---Vulgate-Jerome---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=la | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Latin---Vulgate-Jerome.la");
system('wc -l ../spellcheck/Holy-Bible---Latin---Vulgate-Jerome.la');




// SPELL CHECK: Holy-Bible---Latvian---Latvian-Gluck-Bible (lv)
system("cat ../www-stageresources/Holy-Bible---Latvian---Latvian-Gluck-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Latvian---Latvian-Gluck-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Latvian---Latvian-Gluck-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Latvian---Latvian-Gluck-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=lv | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Latvian---Latvian-Gluck-Bible.lv");
system('wc -l ../spellcheck/Holy-Bible---Latvian---Latvian-Gluck-Bible.lv');




// SPELL CHECK: Holy-Bible---Malagasy---Malagasy-Bible (mg)
system("cat ../www-stageresources/Holy-Bible---Malagasy---Malagasy-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Malagasy---Malagasy-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Malagasy---Malagasy-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Malagasy---Malagasy-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=mg | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Malagasy---Malagasy-Bible.mg");
system('wc -l ../spellcheck/Holy-Bible---Malagasy---Malagasy-Bible.mg');




// SPELL CHECK: Holy-Bible---Malayalam---Malayalam-Bible (ml)
system("cat ../www-stageresources/Holy-Bible---Malayalam---Malayalam-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Malayalam---Malayalam-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Malayalam---Malayalam-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Malayalam---Malayalam-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=ml | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Malayalam---Malayalam-Bible.ml");
system('wc -l ../spellcheck/Holy-Bible---Malayalam---Malayalam-Bible.ml');




// SPELL CHECK: Holy-Bible---Marathi---Marathi-Bible (mr)
system("cat ../www-stageresources/Holy-Bible---Marathi---Marathi-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Marathi---Marathi-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Marathi---Marathi-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Marathi---Marathi-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=mr | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Marathi---Marathi-Bible.mr");
system('wc -l ../spellcheck/Holy-Bible---Marathi---Marathi-Bible.mr');




// SPELL CHECK: Holy-Bible---Matu-Chin---Matupi-Chin-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Matu-Chin---Matupi-Chin-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Matu-Chin---Matupi-Chin-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Matu-Chin---Matupi-Chin-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Myanmar---Myanmar-Burmese-Judson (WORDS)
system("cat ../www-stageresources/Holy-Bible---Myanmar---Myanmar-Burmese-Judson---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Myanmar---Myanmar-Burmese-Judson.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Myanmar---Myanmar-Burmese-Judson.WORDS');




// SPELL CHECK: Holy-Bible---Ndebele---Ndebele-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Ndebele---Ndebele-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Ndebele---Ndebele-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ndebele---Ndebele-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Norwegian---Norwegian-Bible (nb)
system("cat ../www-stageresources/Holy-Bible---Norwegian---Norwegian-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Norwegian---Norwegian-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Norwegian---Norwegian-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Norwegian---Norwegian-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=nb | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Norwegian---Norwegian-Bible.nb");
system('wc -l ../spellcheck/Holy-Bible---Norwegian---Norwegian-Bible.nb');




// SPELL CHECK: Holy-Bible---Norwegian---Norwegian-Student-Bible (nn)
system("cat ../www-stageresources/Holy-Bible---Norwegian---Norwegian-Student-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Norwegian---Norwegian-Student-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Norwegian---Norwegian-Student-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Norwegian---Norwegian-Student-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=nn | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Norwegian---Norwegian-Student-Bible.nn");
system('wc -l ../spellcheck/Holy-Bible---Norwegian---Norwegian-Student-Bible.nn');




// SPELL CHECK: Holy-Bible---Oriya---Oriya-Bible (or)
system("cat ../www-stageresources/Holy-Bible---Oriya---Oriya-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Oriya---Oriya-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Oriya---Oriya-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Oriya---Oriya-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=or | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Oriya---Oriya-Bible.or");
system('wc -l ../spellcheck/Holy-Bible---Oriya---Oriya-Bible.or');




// SPELL CHECK: Holy-Bible---Panjabi---Punjabi-Bible (pa)
system("cat ../www-stageresources/Holy-Bible---Panjabi---Punjabi-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Panjabi---Punjabi-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Panjabi---Punjabi-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Panjabi---Punjabi-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=pa | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Panjabi---Punjabi-Bible.pa");
system('wc -l ../spellcheck/Holy-Bible---Panjabi---Punjabi-Bible.pa');




// SPELL CHECK: Holy-Bible---Persian---Old-Persion-Version-Bible (fa)
system("cat ../www-stageresources/Holy-Bible---Persian---Old-Persion-Version-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Persian---Old-Persion-Version-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Persian---Old-Persion-Version-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Persian---Old-Persion-Version-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=fa | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Persian---Old-Persion-Version-Bible.fa");
system('wc -l ../spellcheck/Holy-Bible---Persian---Old-Persion-Version-Bible.fa');




// SPELL CHECK: Holy-Bible---Pohnpeian---Pohnpeian-NT-Psalms-New-Alphabet (WORDS)
system("cat ../www-stageresources/Holy-Bible---Pohnpeian---Pohnpeian-NT-Psalms-New-Alphabet---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Pohnpeian---Pohnpeian-NT-Psalms-New-Alphabet.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Pohnpeian---Pohnpeian-NT-Psalms-New-Alphabet.WORDS');




// SPELL CHECK: Holy-Bible---Pohnpeian---Pohnpeian-NT-Psalms-Old-Alphabet (WORDS)
system("cat ../www-stageresources/Holy-Bible---Pohnpeian---Pohnpeian-NT-Psalms-Old-Alphabet---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Pohnpeian---Pohnpeian-NT-Psalms-Old-Alphabet.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Pohnpeian---Pohnpeian-NT-Psalms-Old-Alphabet.WORDS');




// SPELL CHECK: Holy-Bible---Polish---Polish-Gdansk (pl)
system("cat ../www-stageresources/Holy-Bible---Polish---Polish-Gdansk---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Polish---Polish-Gdansk.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Polish---Polish-Gdansk.WORDS');
system("cat ../www-stageresources/Holy-Bible---Polish---Polish-Gdansk---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=pl | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Polish---Polish-Gdansk.pl");
system('wc -l ../spellcheck/Holy-Bible---Polish---Polish-Gdansk.pl');




// SPELL CHECK: Holy-Bible---Polish---Polish-Updated-Gdansk (pl)
system("cat ../www-stageresources/Holy-Bible---Polish---Polish-Updated-Gdansk---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Polish---Polish-Updated-Gdansk.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Polish---Polish-Updated-Gdansk.WORDS');
system("cat ../www-stageresources/Holy-Bible---Polish---Polish-Updated-Gdansk---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=pl | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Polish---Polish-Updated-Gdansk.pl");
system('wc -l ../spellcheck/Holy-Bible---Polish---Polish-Updated-Gdansk.pl');




// SPELL CHECK: Holy-Bible---Portuguese---Almeida-Bible-1911 (pt_PT)
system("cat ../www-stageresources/Holy-Bible---Portuguese---Almeida-Bible-1911---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Portuguese---Almeida-Bible-1911.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Portuguese---Almeida-Bible-1911.WORDS');
system("cat ../www-stageresources/Holy-Bible---Portuguese---Almeida-Bible-1911---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=pt_PT | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Portuguese---Almeida-Bible-1911.pt_PT");
system('wc -l ../spellcheck/Holy-Bible---Portuguese---Almeida-Bible-1911.pt_PT');




// SPELL CHECK: Holy-Bible---Portuguese---Almeida-NewOrthography (pt_PT)
system("cat ../www-stageresources/Holy-Bible---Portuguese---Almeida-NewOrthography---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Portuguese---Almeida-NewOrthography.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Portuguese---Almeida-NewOrthography.WORDS');
system("cat ../www-stageresources/Holy-Bible---Portuguese---Almeida-NewOrthography---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=pt_PT | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Portuguese---Almeida-NewOrthography.pt_PT");
system('wc -l ../spellcheck/Holy-Bible---Portuguese---Almeida-NewOrthography.pt_PT');




// SPELL CHECK: Holy-Bible---Portuguese---Biblia-Livre (pt_PT)
system("cat ../www-stageresources/Holy-Bible---Portuguese---Biblia-Livre---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Portuguese---Biblia-Livre.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Portuguese---Biblia-Livre.WORDS');
system("cat ../www-stageresources/Holy-Bible---Portuguese---Biblia-Livre---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=pt_PT | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Portuguese---Biblia-Livre.pt_PT");
system('wc -l ../spellcheck/Holy-Bible---Portuguese---Biblia-Livre.pt_PT');




// SPELL CHECK: Holy-Bible---Portuguese---Portuguese-Trans-Trans (pt_PT)
system("cat ../www-stageresources/Holy-Bible---Portuguese---Portuguese-Trans-Trans---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Portuguese---Portuguese-Trans-Trans.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Portuguese---Portuguese-Trans-Trans.WORDS');
system("cat ../www-stageresources/Holy-Bible---Portuguese---Portuguese-Trans-Trans---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=pt_PT | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Portuguese---Portuguese-Trans-Trans.pt_PT");
system('wc -l ../spellcheck/Holy-Bible---Portuguese---Portuguese-Trans-Trans.pt_PT');




// SPELL CHECK: Holy-Bible---Romanian---Bayash-Luke (ro)
system("cat ../www-stageresources/Holy-Bible---Romanian---Bayash-Luke---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Romanian---Bayash-Luke.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Romanian---Bayash-Luke.WORDS');
system("cat ../www-stageresources/Holy-Bible---Romanian---Bayash-Luke---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=ro | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Romanian---Bayash-Luke.ro");
system('wc -l ../spellcheck/Holy-Bible---Romanian---Bayash-Luke.ro');




// SPELL CHECK: Holy-Bible---Rote-Dela---Rote-Dela-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Rote-Dela---Rote-Dela-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Rote-Dela---Rote-Dela-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Rote-Dela---Rote-Dela-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Russian---Russian-Synodal-Translation (ru)
system("cat ../www-stageresources/Holy-Bible---Russian---Russian-Synodal-Translation---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Russian---Russian-Synodal-Translation.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Russian---Russian-Synodal-Translation.WORDS');
system("cat ../www-stageresources/Holy-Bible---Russian---Russian-Synodal-Translation---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=ru | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Russian---Russian-Synodal-Translation.ru");
system('wc -l ../spellcheck/Holy-Bible---Russian---Russian-Synodal-Translation.ru');




// SPELL CHECK: Holy-Bible---Scots-Gaelic---Scots-Gaelic-Gospel-Mark (gd)
system("cat ../www-stageresources/Holy-Bible---Scots-Gaelic---Scots-Gaelic-Gospel-Mark---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Scots-Gaelic---Scots-Gaelic-Gospel-Mark.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Scots-Gaelic---Scots-Gaelic-Gospel-Mark.WORDS');
system("cat ../www-stageresources/Holy-Bible---Scots-Gaelic---Scots-Gaelic-Gospel-Mark---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=gd | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Scots-Gaelic---Scots-Gaelic-Gospel-Mark.gd");
system('wc -l ../spellcheck/Holy-Bible---Scots-Gaelic---Scots-Gaelic-Gospel-Mark.gd');




// SPELL CHECK: Holy-Bible---Serbian---Karadzic-Danicic-Latin-Script (sr)
system("cat ../www-stageresources/Holy-Bible---Serbian---Karadzic-Danicic-Latin-Script---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Serbian---Karadzic-Danicic-Latin-Script.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Serbian---Karadzic-Danicic-Latin-Script.WORDS');
system("cat ../www-stageresources/Holy-Bible---Serbian---Karadzic-Danicic-Latin-Script---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=sr | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Serbian---Karadzic-Danicic-Latin-Script.sr");
system('wc -l ../spellcheck/Holy-Bible---Serbian---Karadzic-Danicic-Latin-Script.sr');




// SPELL CHECK: Holy-Bible---Serbian---Serbian-Ekavski-Bible (sr)
system("cat ../www-stageresources/Holy-Bible---Serbian---Serbian-Ekavski-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Serbian---Serbian-Ekavski-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Serbian---Serbian-Ekavski-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Serbian---Serbian-Ekavski-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=sr | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Serbian---Serbian-Ekavski-Bible.sr");
system('wc -l ../spellcheck/Holy-Bible---Serbian---Serbian-Ekavski-Bible.sr');




// SPELL CHECK: Holy-Bible---Shona---Shona-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Shona---Shona-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Shona---Shona-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Shona---Shona-Bible.WORDS');




// SPELL CHECK: Holy-Bible---SlavonicChurch---Church-Slavonic-Elizabeth (WORDS)
system("cat ../www-stageresources/Holy-Bible---SlavonicChurch---Church-Slavonic-Elizabeth---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---SlavonicChurch---Church-Slavonic-Elizabeth.WORDS");
system('wc -l ../spellcheck/Holy-Bible---SlavonicChurch---Church-Slavonic-Elizabeth.WORDS');




// SPELL CHECK: Holy-Bible---Slovene---Slovene-Savli-Bible (sl)
system("cat ../www-stageresources/Holy-Bible---Slovene---Slovene-Savli-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Slovene---Slovene-Savli-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Slovene---Slovene-Savli-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Slovene---Slovene-Savli-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=sl | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Slovene---Slovene-Savli-Bible.sl");
system('wc -l ../spellcheck/Holy-Bible---Slovene---Slovene-Savli-Bible.sl');




// SPELL CHECK: Holy-Bible---Slovene---Slovene-Stritarja-NT (sl)
system("cat ../www-stageresources/Holy-Bible---Slovene---Slovene-Stritarja-NT---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Slovene---Slovene-Stritarja-NT.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Slovene---Slovene-Stritarja-NT.WORDS');
system("cat ../www-stageresources/Holy-Bible---Slovene---Slovene-Stritarja-NT---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=sl | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Slovene---Slovene-Stritarja-NT.sl");
system('wc -l ../spellcheck/Holy-Bible---Slovene---Slovene-Stritarja-NT.sl');




// SPELL CHECK: Holy-Bible---Somali---Somali-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Somali---Somali-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Somali---Somali-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Somali---Somali-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Spanish---Free-Bible-NT (es)
system("cat ../www-stageresources/Holy-Bible---Spanish---Free-Bible-NT---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Spanish---Free-Bible-NT.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Free-Bible-NT.WORDS');
system("cat ../www-stageresources/Holy-Bible---Spanish---Free-Bible-NT---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=es | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Spanish---Free-Bible-NT.es");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Free-Bible-NT.es');




// SPELL CHECK: Holy-Bible---Spanish---Reina-Valera-1865 (es)
system("cat ../www-stageresources/Holy-Bible---Spanish---Reina-Valera-1865---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Spanish---Reina-Valera-1865.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Reina-Valera-1865.WORDS');
system("cat ../www-stageresources/Holy-Bible---Spanish---Reina-Valera-1865---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=es | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Spanish---Reina-Valera-1865.es");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Reina-Valera-1865.es');




// SPELL CHECK: Holy-Bible---Spanish---Reina-Valera-1909 (es)
system("cat ../www-stageresources/Holy-Bible---Spanish---Reina-Valera-1909---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Spanish---Reina-Valera-1909.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Reina-Valera-1909.WORDS');
system("cat ../www-stageresources/Holy-Bible---Spanish---Reina-Valera-1909---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=es | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Spanish---Reina-Valera-1909.es");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Reina-Valera-1909.es');




// SPELL CHECK: Holy-Bible---Spanish---Reina-Valera-NT-1858 (es)
system("cat ../www-stageresources/Holy-Bible---Spanish---Reina-Valera-NT-1858---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Spanish---Reina-Valera-NT-1858.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Reina-Valera-NT-1858.WORDS');
system("cat ../www-stageresources/Holy-Bible---Spanish---Reina-Valera-NT-1858---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=es | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Spanish---Reina-Valera-NT-1858.es");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Reina-Valera-NT-1858.es');




// SPELL CHECK: Holy-Bible---Spanish---Sagradas-Escrituras-1569 (es)
system("cat ../www-stageresources/Holy-Bible---Spanish---Sagradas-Escrituras-1569---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Spanish---Sagradas-Escrituras-1569.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Sagradas-Escrituras-1569.WORDS');
system("cat ../www-stageresources/Holy-Bible---Spanish---Sagradas-Escrituras-1569---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=es | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Spanish---Sagradas-Escrituras-1569.es");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Sagradas-Escrituras-1569.es');




// SPELL CHECK: Holy-Bible---Spanish---Sencillo-Bible (es)
system("cat ../www-stageresources/Holy-Bible---Spanish---Sencillo-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Spanish---Sencillo-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Sencillo-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Spanish---Sencillo-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=es | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Spanish---Sencillo-Bible.es");
system('wc -l ../spellcheck/Holy-Bible---Spanish---Sencillo-Bible.es');




// SPELL CHECK: Holy-Bible---Swahili---Swahili-Bible (sw)
system("cat ../www-stageresources/Holy-Bible---Swahili---Swahili-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Swahili---Swahili-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Swahili---Swahili-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Swahili---Swahili-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=sw | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Swahili---Swahili-Bible.sw");
system('wc -l ../spellcheck/Holy-Bible---Swahili---Swahili-Bible.sw');




// SPELL CHECK: Holy-Bible---Swedish---Swedish-Bible (sv)
system("cat ../www-stageresources/Holy-Bible---Swedish---Swedish-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Swedish---Swedish-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Swedish---Swedish-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Swedish---Swedish-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=sv | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Swedish---Swedish-Bible.sv");
system('wc -l ../spellcheck/Holy-Bible---Swedish---Swedish-Bible.sv');




// SPELL CHECK: Holy-Bible---Swedish---Swedish-Bible-1873 (sv)
system("cat ../www-stageresources/Holy-Bible---Swedish---Swedish-Bible-1873---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Swedish---Swedish-Bible-1873.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Swedish---Swedish-Bible-1873.WORDS');
system("cat ../www-stageresources/Holy-Bible---Swedish---Swedish-Bible-1873---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=sv | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Swedish---Swedish-Bible-1873.sv");
system('wc -l ../spellcheck/Holy-Bible---Swedish---Swedish-Bible-1873.sv');




// SPELL CHECK: Holy-Bible---Tagalog---Tagalog-Bible (tl)
system("cat ../www-stageresources/Holy-Bible---Tagalog---Tagalog-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Tagalog---Tagalog-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Tagalog---Tagalog-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Tagalog---Tagalog-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=tl | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Tagalog---Tagalog-Bible.tl");
system('wc -l ../spellcheck/Holy-Bible---Tagalog---Tagalog-Bible.tl');




// SPELL CHECK: Holy-Bible---Tamil---Tamil-Bible (ta)
system("cat ../www-stageresources/Holy-Bible---Tamil---Tamil-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Tamil---Tamil-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Tamil---Tamil-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Tamil---Tamil-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=ta | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Tamil---Tamil-Bible.ta");
system('wc -l ../spellcheck/Holy-Bible---Tamil---Tamil-Bible.ta');




// SPELL CHECK: Holy-Bible---Telugu---Telugu-Bible (te)
system("cat ../www-stageresources/Holy-Bible---Telugu---Telugu-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Telugu---Telugu-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Telugu---Telugu-Bible.WORDS');
system("cat ../www-stageresources/Holy-Bible---Telugu---Telugu-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=te | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Telugu---Telugu-Bible.te");
system('wc -l ../spellcheck/Holy-Bible---Telugu---Telugu-Bible.te');




// SPELL CHECK: Holy-Bible---Tongan---Revised-West-Version (WORDS)
system("cat ../www-stageresources/Holy-Bible---Tongan---Revised-West-Version---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Tongan---Revised-West-Version.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Tongan---Revised-West-Version.WORDS');




// SPELL CHECK: Holy-Bible---Ukrainian---Ukrainian-NT (uk)
system("cat ../www-stageresources/Holy-Bible---Ukrainian---Ukrainian-NT---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Ukrainian---Ukrainian-NT.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ukrainian---Ukrainian-NT.WORDS');
system("cat ../www-stageresources/Holy-Bible---Ukrainian---Ukrainian-NT---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=uk | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Ukrainian---Ukrainian-NT.uk");
system('wc -l ../spellcheck/Holy-Bible---Ukrainian---Ukrainian-NT.uk');




// SPELL CHECK: Holy-Bible---Ukrainian---Ukrainian-Ogienko (uk)
system("cat ../www-stageresources/Holy-Bible---Ukrainian---Ukrainian-Ogienko---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Ukrainian---Ukrainian-Ogienko.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Ukrainian---Ukrainian-Ogienko.WORDS');
system("cat ../www-stageresources/Holy-Bible---Ukrainian---Ukrainian-Ogienko---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=uk | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Ukrainian---Ukrainian-Ogienko.uk");
system('wc -l ../spellcheck/Holy-Bible---Ukrainian---Ukrainian-Ogienko.uk');




// SPELL CHECK: Holy-Bible---Urdu---Urdu-Bible (WORDS)
system("cat ../www-stageresources/Holy-Bible---Urdu---Urdu-Bible---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Urdu---Urdu-Bible.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Urdu---Urdu-Bible.WORDS');




// SPELL CHECK: Holy-Bible---Vietnamese---Vietnamese-Bible-1934 (vi)
system("cat ../www-stageresources/Holy-Bible---Vietnamese---Vietnamese-Bible-1934---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Vietnamese---Vietnamese-Bible-1934.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Vietnamese---Vietnamese-Bible-1934.WORDS');
system("cat ../www-stageresources/Holy-Bible---Vietnamese---Vietnamese-Bible-1934---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=vi | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Vietnamese---Vietnamese-Bible-1934.vi");
system('wc -l ../spellcheck/Holy-Bible---Vietnamese---Vietnamese-Bible-1934.vi');




// SPELL CHECK: Holy-Bible---Vietnamese---Vietnamese-NT (vi)
system("cat ../www-stageresources/Holy-Bible---Vietnamese---Vietnamese-NT---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq ".
"> ../spellcheck/Holy-Bible---Vietnamese---Vietnamese-NT.WORDS");
system('wc -l ../spellcheck/Holy-Bible---Vietnamese---Vietnamese-NT.WORDS');
system("cat ../www-stageresources/Holy-Bible---Vietnamese---Vietnamese-NT---Standard-Edition.noia | ".
"sed -E -e 's/[[:space:]]+/\\n/g' | ".
"sed -E -e 's/^[[:space:][:punct:][:digit:]]*(\\w+)[[:space:][:punct:][:digit:]]*\$/\\1/g' | ".
"sort | ".
"uniq | ".
"aspell -a --dont-suggest --dont-time --dont-guess --lang=vi | ".
"sed -E -e 's/# //g' -e 's/[[:space:][:punct:][:digit:]]*\$//g' -e '/^[[:space:][:punct:][:digit:]]*\$/d' ".
"> ../spellcheck/Holy-Bible---Vietnamese---Vietnamese-NT.vi");
system('wc -l ../spellcheck/Holy-Bible---Vietnamese---Vietnamese-NT.vi');






AION_LOOP_DIFF('../spellcheck','../spellcheck-MARKER','../spellcheck-diff');
