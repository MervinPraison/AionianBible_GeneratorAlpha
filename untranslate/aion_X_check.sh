# TEXT CHECKER
# specials = \^$.|?*+[(){}
# bracketed specials = ^-]\
# grep '.\{80\}' file


# AIONIAN ################
echo -e '<html>\n<head>\n<meta charset="utf-8">\n<title>Aionian Bible - QUESTIONED VERSES</title>\n</head>\n<body>QUESTIONED VERSES<br /><br />\n' > ../checksX/QUESTIONED.txt
grep -P '\(questioned\)' ../www-stageresources/*Aionian-Edition.noia | sed -e 's/\.\.\/www-stageresources\///g' -e 's/$/<br \/>\n<br \/>/g' -e 's/---Aionian-Edition\.noia:/<br \/>\n/g' >> ../checksX/QUESTIONED.txt
echo -e '</body>\n</html>\n' >> ../checksX/QUESTIONED.txt
rm -rf ../www-stage/library/Holy-Bible---AAA---Versions---Questioned.htm
cp ../checksX/QUESTIONED.txt ../www-stage/library/Holy-Bible---AAA---Versions---Questioned.htm


# SOURCE #################
# CHAPS
grep "EXTRA" ../checks/BOOKSCHAPTERS.txt > ../checksX/CHAPTERS.txt
# ENCLOSERS
grep -Po '(?<=<)[^>]+(?=>)'		../www-stageresources/*Source-Edition.noia | sed -e '/osisID=/d' -e '/ level="/d' -e '/ savlm="/d' -e '/ eID="/d' -e '/ sID="/d' -e '/ type="/d' -e '/ wn="/d' -e '/ n="/d' -e '/noia:[A-Z0-9\-]+$/d' | sort | uniq > ../checksX/ENCLOSED-ARROW.txt
grep -Po '(?<=\()[^\)]+(?=\))'	../www-stageresources/*Source-Edition.noia | sort | uniq > ../checksX/ENCLOSED-PAREN.txt
grep -Po '(?<=\{)[^}]+(?=\})'	../www-stageresources/*Source-Edition.noia | sort | uniq > ../checksX/ENCLOSED-BRACE.txt
grep -Po '(?<=\[)[^\]]+(?=])'	../www-stageresources/*Source-Edition.noia | sort | uniq > ../checksX/ENCLOSED-BRACKET.txt
grep -Po '[([]{1}[[:digit:][:punct:][:space:]]*[)\]]{1}'	../www-stageresources/*Source-Edition.noia | sort | uniq > ../checksX/ENCLOSED-PUNCT-NUMB.txt
# UNCLOSERS
grep -P '<[^>]*$'	../www-stageresources/*Source-Edition.noia > ../checksX/UNCLOSED-ARROW.txt
grep -P '\([^)]*$'	../www-stageresources/*Source-Edition.noia > ../checksX/UNCLOSED-PAREN.txt
grep -P '\{[^}]*$'	../www-stageresources/*Source-Edition.noia > ../checksX/UNCLOSED-BRACE.txt
grep -P '\[[^\]]*$'	../www-stageresources/*Source-Edition.noia > ../checksX/UNCLOSED-BRACKET.txt
# UNOPENED
grep -P '^[^<]*>'	../www-stageresources/*Source-Edition.noia > ../checksX/UNOPENED-ARROW.txt
grep -P '^[^(]*\)'	../www-stageresources/*Source-Edition.noia > ../checksX/UNOPENED-PAREN.txt
grep -P '^[^{]*\}'	../www-stageresources/*Source-Edition.noia > ../checksX/UNOPENED-BRACE.txt
grep -P '^[^[]*\]'	../www-stageresources/*Source-Edition.noia > ../checksX/UNOPENED-BRACKET.txt
# NUMBERS and LONG LINE
grep -P '^...	...	...	...	.*[0-9]+' ../www-stageresources/*Source-Edition.noia | sed -e 's/<[^<>]*>//g' | grep -P '...	...	...	...	.*[0-9]+' > ../checksX/X-NUMBERS.txt
grep -P '^...	...	...	...	[0-9]+' ../www-stageresources/*Source-Edition.noia | grep -P '...	...	...	...	[0-9]+' > ../checksX/X-NUMBERS-FIRST.txt
echo -e '<html>\n<head>\n<meta charset="utf-8">\n<title>Aionian Bible - LONG VERSES SOURCE</title>\n</head>\n<body>LONG VERSES SOURCE<br /><br />\n' > ../checksX/X-LONGLINE.txt
grep '.*' ../www-stageresources/*Source-Edition.noia | awk '{ print length, $0}' | sort -n -s -r | sed -e 's/\.\.\/www-stageresources\///g' -e 's/$/<br \/><br \/>/' -e 's/-Edition\.noia:/<br \/>/g' | head -n 1200 >> ../checksX/X-LONGLINE.txt
echo -e '</body>\n</html>\n' >> ../checksX/X-LONGLINE.txt
rm -rf ../www-stage/library/Holy-Bible---AAA---Versions---LongLine.htm
cp ../checksX/X-LONGLINE.txt ../www-stage/library/Holy-Bible---AAA---Versions---LongLine.htm
# PUNCT
grep -P '`'		../www-stageresources/*Source-Edition.noia > ../checksX/PUNCTUATION-GRAVE.txt
grep -P '~'		../www-stageresources/*Source-Edition.noia > ../checksX/PUNCTUATION-TILDE.txt
grep -P '@'		../www-stageresources/*Source-Edition.noia > ../checksX/PUNCTUATION-AT.txt
grep -P '#'		../www-stageresources/*Source-Edition.noia | sed -e '/# File Date: /d' > ../checksX/PUNCTUATION-HASH.txt
grep -P '\$'	../www-stageresources/*Source-Edition.noia > ../checksX/PUNCTUATION-DOLLAR.txt
grep -P '%'		../www-stageresources/*Source-Edition.noia > ../checksX/PUNCTUATION-PERCENT.txt
grep -P '\^'	../www-stageresources/*Source-Edition.noia > ../checksX/PUNCTUATION-UPCAROT.txt
grep -P '&'		../www-stageresources/*Source-Edition.noia > ../checksX/PUNCTUATION-AMPERSAND.txt
grep -P '\*'	../www-stageresources/*Source-Edition.noia > ../checksX/PUNCTUATION-ASTERIK.txt
grep -P '_'		../www-stageresources/*Source-Edition.noia > ../checksX/PUNCTUATION-UNDERSCORE.txt
grep -P '\+'	../www-stageresources/*Source-Edition.noia > ../checksX/PUNCTUATION-PLUS.txt
grep -P '='		../www-stageresources/*Source-Edition.noia | sed -e '/osisID=/d' -e '/ level="/d' -e '/ savlm="/d' -e '/ eID="/d' -e '/ sID="/d' -e '/ type="/d' -e '/ wn="/d' -e '/ n="/d' -e '/noia:[A-Z0-9\-]+$/d' | sort > ../checksX/PUNCTUATION-EQUALS.txt
grep -P '\|'	../www-stageresources/*Source-Edition.noia > ../checksX/PUNCTUATION-PIPE.txt
grep -P '\\'	../www-stageresources/*Source-Edition.noia > ../checksX/PUNCTUATION-BACKSLASH.txt
grep -P '/'		../www-stageresources/*Source-Edition.noia | sed -e '/# File Date: /d' > ../checksX/PUNCTUATION-FORESLASH.txt
grep -P '[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+'	../www-stageresources/*Source-Edition.noia > ../checksX/NOT-PRINTABLE.txt

# STANDARD ################
# ENCLOSERS
grep -Po '(?<=<)[^>]+(?=>)'		../www-stageresources/*Standard-Edition.noia | sort | uniq > ../checksX/ENCLOSED-ARROW-STD.txt
grep -Po '(?<=\()[^\)]+(?=\))'	../www-stageresources/*Standard-Edition.noia | sort | uniq > ../checksX/ENCLOSED-PAREN-STD.txt
grep -Po '(?<=\{)[^}]+(?=\})'	../www-stageresources/*Standard-Edition.noia | sort | uniq > ../checksX/ENCLOSED-BRACE-STD.txt
grep -Po '(?<=\[)[^\]]+(?=])'	../www-stageresources/*Standard-Edition.noia | sort | uniq > ../checksX/ENCLOSED-BRACKET-STD.txt
grep -Po '[([]{1}[[:digit:][:punct:][:space:]]*[)\]]{1}'	../www-stageresources/*Standard-Edition.noia | sort | uniq > ../checksX/ENCLOSED-PUNCT-NUMB-STD.txt
# UNCLOSERS
grep -P '<[^>]*$'	../www-stageresources/*Standard-Edition.noia > ../checksX/UNCLOSED-ARROW-STD.txt
grep -P '\([^)]*$'	../www-stageresources/*Standard-Edition.noia > ../checksX/UNCLOSED-PAREN-STD.txt
grep -P '\{[^}]*$'	../www-stageresources/*Standard-Edition.noia > ../checksX/UNCLOSED-BRACE-STD.txt
grep -P '\[[^\]]*$'	../www-stageresources/*Standard-Edition.noia > ../checksX/UNCLOSED-BRACKET-STD.txt
# UNOPENED
grep -P '^[^<]*>'	../www-stageresources/*Standard-Edition.noia > ../checksX/UNOPENED-ARROW-STD.txt
grep -P '^[^(]*\)'	../www-stageresources/*Standard-Edition.noia > ../checksX/UNOPENED-PAREN-STD.txt
grep -P '^[^{]*\}'	../www-stageresources/*Standard-Edition.noia > ../checksX/UNOPENED-BRACE-STD.txt
grep -P '^[^[]*\]'	../www-stageresources/*Standard-Edition.noia > ../checksX/UNOPENED-BRACKET-STD.txt
# NUMBERS and LONG LINE
grep -P '^...	...	...	...	.*[0-9]+' ../www-stageresources/*Standard-Edition.noia | sed -e '/MAR\s016\s009/d' > ../checksX/X-NUMBERS-STD.txt
grep -P '^...	...	...	...	[0-9]+' ../www-stageresources/*Standard-Edition.noia > ../checksX/X-NUMBERS-FIRST-STD.txt
echo -e '<html>\n<head>\n<meta charset="utf-8">\n<title>Aionian Bible - LONG VERSES STANDARD</title>\n</head>\n<body>LONG VERSES STANDARD<br /><br />\n' > ../checksX/X-LONGLINE-STD.txt
grep '.*' ../www-stageresources/*Aionian-Edition.noia | awk '{ print length, $0}' | sort -n -s -r | sed -e 's/\.\.\/www-stageresources\///g' -e 's/$/<br \/><br \/>/' -e 's/-Edition\.noia:/<br \/>/g' | head -n 1200 >> ../checksX/X-LONGLINE-STD.txt
echo -e '</body>\n</html>\n' >> ../checksX/X-LONGLINE-STD.txt
rm -rf ../www-stage/library/Holy-Bible---AAA---Versions---LongLine-STD.htm
cp ../checksX/X-LONGLINE-STD.txt ../www-stage/library/Holy-Bible---AAA---Versions---LongLine-STD.htm
# PUNCT
grep -P '`'		../www-stageresources/*Standard-Edition.noia > ../checksX/PUNCTUATION-GRAVE-STD.txt
grep -P '~'		../www-stageresources/*Standard-Edition.noia > ../checksX/PUNCTUATION-TILDE-STD.txt
grep -P '@'		../www-stageresources/*Standard-Edition.noia > ../checksX/PUNCTUATION-AT-STD.txt
grep -P '#'		../www-stageresources/*Standard-Edition.noia | sed -e '/# File Date: /d' > ../checksX/PUNCTUATION-HASH-STD.txt
grep -P '\$'	../www-stageresources/*Standard-Edition.noia > ../checksX/PUNCTUATION-DOLLAR-STD.txt
grep -P '%'		../www-stageresources/*Standard-Edition.noia > ../checksX/PUNCTUATION-PERCENT-STD.txt
grep -P '\^'	../www-stageresources/*Standard-Edition.noia > ../checksX/PUNCTUATION-UPCAROT-STD.txt
grep -P '&'		../www-stageresources/*Standard-Edition.noia > ../checksX/PUNCTUATION-AMPERSAND-STD.txt
grep -P '\*'	../www-stageresources/*Standard-Edition.noia > ../checksX/PUNCTUATION-ASTERIK-STD.txt
grep -P '_'		../www-stageresources/*Standard-Edition.noia > ../checksX/PUNCTUATION-UNDERSCORE-STD.txt
grep -P '\+'	../www-stageresources/*Standard-Edition.noia > ../checksX/PUNCTUATION-PLUS-STD.txt
grep -P '='		../www-stageresources/*Standard-Edition.noia > ../checksX/PUNCTUATION-EQUALS-STD.txt
grep -P '\|'	../www-stageresources/*Standard-Edition.noia > ../checksX/PUNCTUATION-PIPE-STD.txt
grep -P '\\'	../www-stageresources/*Standard-Edition.noia > ../checksX/PUNCTUATION-BACKSLASH-STD.txt
grep -P '/'		../www-stageresources/*Standard-Edition.noia | sed -e '/# File Date: /d' > ../checksX/PUNCTUATION-FORESLASH-STD.txt
grep -P '[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+'	../www-stageresources/*Standard-Edition.noia > ../checksX/NOT-PRINTABLE-STD.txt