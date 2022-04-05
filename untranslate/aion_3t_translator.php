#!/usr/local/bin/php
<?php

/////////////////////////////////////////////////////////////////
// BEGIN
AION_ECHO("BEGIN");

/////////////////////////////////////////////////////////////////
// INIT
$thedate = date('m/d/Y H:i:s');
$theyear = date('Y');
$HEADER = <<<EOT
# PUBLISHER:
# File Name: AB-StudyPack.txt
# File Date: $thedate
# File Purpose: Resources for Bible translation and study of underlying languages
# File Location: https://resources.AionianBible.org/AB-StudyPack
# File Source: Aionian Bible resources by Nainoia Inc combined with STEPBible resources by STEPBible.org
# File Copyright: Creative Commons Attribution No Derivative Works 4.0, 2018-$theyear
# File Copyright Format: Creative Commons Attribution No Derivative Works 4.0, 2018-$theyear
# File Generator: ABCMS (alpha)
# File Accuracy: Contact publisher with corrections to file format or content
# Publisher Name: Nainoia Inc
# Publisher Contact: https://www.AionianBible.org/Publisher
# Publisher Mission: https://www.AionianBible.org/Preface
# Publisher Website: https://NAINOIA-INC.signedon.net
# Publisher Facebook: https://www.Facebook.com/AionianBible
# STEPBible Copyright: Creative Commons Attribution 4.0
# STEPBible Source Link: https://github.com/STEPBible/STEPBible-Data
#
# INTRODUCTION:
# Resources for Bible translation and study of underlying languages.
# Report concerns at https://www.AionianBible.org/Publisher.
# Contact https://www.AionianBible.org/Publisher for a StudyPack in your language.
# Report STEPBible data concerns at https://github.com/STEPBible/STEPBible-Data
#
# FILES:
# AREADME.txt									This explanation.
# Greek-Lexicon.txt								Tyndale Greek extended Strongs lexicon.
# Greek-Morphhology.txt							Greek word morphhology code definitions.
# Hebrew-Lexicon.txt							Tyndale Hebrew extended Strongs lexicon.
# Hebrew-Morphhology.txt						Hebrew word morphhology code definitions.
# Holy-Bible---[language]---AB-StudyPack.txt	Resources for Bible translation and study of underlying languages.
#
# CONTENTS:
# Select Bible translations in parallel verse by line format.
# STEPBible Hebrew and Greek Amalgamant word by line by verse format.
# Extended Strong's numerical indexes linked to lexicon entries.
# Word morphhology codes linked to explanatory entries.
#
# STATEMENT
# 1. In one true God, existing eternally as one God in three persons: Father, Son, and Holy Spirit, John 14:9-21, who is in essence spirit, John 4:24, light, 1 John 1:5, and love, 1 John 4:8.
# 2. That the 66 books of the Old and New Testaments are the unique, inerrant, inspired Word of God in the original autographs, and the final authority in all matters of faith and conduct, 2 Tim 3:16.
# 3. In the sovereignty and active rule of God in creation, the fall, history, revelation, miracles, prophecy, redemption, and final judgment, Romans 8:20-21.
# 4. That man was created by God in His image, but that since Adam's fall, all men are sinful and by nature deserve God's wrath, Ephesians 2:3.
# 5. That Jesus is the only begotten Son of God, fully human and fully divine, eternally existing as God, yet born in time of a virgin, and that He lived a sinless and perfect life, 2 Timothy 2:5.
# 6. In the historic death of Jesus as the full and only atonement, guaranteeing loving forgiveness for the sins of all mankind, in His bodily resurrection from the dead, and in His ascension to the right hand of the Father, 1 John 2:1-2.
# 7. That all mankind is justified by the loving grace of God and redeemed on the basis of the death of Christ, which is received through faith, Ephesians 2:8-9.
# 8. That the Holy Spirit is the effective agent in regeneration, bringing individuals to faith and transformed lives, 2 Corinthians 3:18.
# 9. In one universal church, Christ’s Body, to which all believers belong, and in local churches accountable to God, lead by officers who govern local church belief and discipline, while respecting individual conscience, Hebrews 13:17, 1 John 2:27.
# 10. That believing mankind is rewarded in paradise after death, while unbelievers suffer punishment in Hades after death merited by their sinful nature and their rejection of the grace of Christ, Luke 16:19-31.
# 11. In the future, visible, physical return of the Lord Jesus Christ in glory, Titus 2:13.
# 12. In the final resurrection of redeemed mankind to the enjoyment of God forever, and the damnation of those excluded from the Book of Life to the Lake of Fire prepared for the Devil and his angels for the ages of the ages, Matthew 25:31-46 and Revelation 20:10.
# 13. This statement of Christian faith does not exhaust the extent of our beliefs. The Bible itself, as the inspired and infallible Word of God that speaks with final authority concerning truth, morality, and the proper conduct of mankind, is the sole and final source of all that we believe.
#
# TRANSLATING:
# 1. Pray, recruit a committee of faithful Christians, and confirm the above basic Statement of Faith.
# 2. Agree that translations are not inspired or infallible, though hopefully faithfully made, because only the original autographs of Scripture are God-breathed and inerrant.
# 3. Translate and do not paraphrase, prioritizing the contexts of phrase, sentence, paragraph, book, author, testament, Bible, and history.
# 4. Allow for cumbersome and ambiguous translation, if needed, until understanding is made more certain.
# 5. Maintain the Holy Spirit's gender choice of words because male and female is wonderful gift from God and a reflection of His image, and Biblical roles for men and women are a cause for celebration, not apology.
# 6. Maintain word and phrase order when possible, allowing some reduced readability, if needed, to maintain the structure of the original.
# 7. Preserve word repetition and continuation (same theme different word) with concordant translation as much as possible to help the reader appreciate the major and minor themes, structure, poetry, and nuance of the original.
# 8. Translate Abyssos, Geenna, Hadēs, Limnē Pyr, Sheol, and Tartaroō as distinct locations.
# 9. Translate aïdios as eternal and aiōn as age or eon.
# 10. Translate aiōnios as an adjective of aiōn, that is pertaining to the age, as life, lifetime, entire, whole, or consummate, but not as eternal or infinite time.
#
# STATEGY:
# 1. Pray for a modern public domain translation in every language.
# 2. Use https://AionianBible.org for study, parallel Bible text viewing, and extended Strong's lexicon entries.
# 3. Download https://github.com/STEPBible/STEPBible-Data for direct access to the STEPBBible data.
# 4. Use other resources as available and needed.
# 5. Install https://notepad-plus-plus.org or a text editor with REGEX for advanced text search and edits.
# 6. Use the Aionian Bible verse per line format of "3-digit-book-index	3-character-book-abbreviation	3-digit-chapter-number	3-digit-verse-number	verse-text".
# 7. Create a new translation editing the verse line containing "NEW:".
# 8. Use modern spelling and grammar checkers if possible.
# 9. Use correct style and punctuation, as well as smart quotes.
# 10. Add lines beginning with "#" for comments as needed.
# 11. Release your work as CC0 (public domain), CC-BY (attribution), CC-BY-SA (shared with copyright), and avoid CC-ND (no derivative) and CC-NC (no commercial) so Bibles can be further developed and sold.
# 12. Submit your new translation to AionianBible.org and other outlets for distribution.
#
# FORMAT HEBREW: (Holy-Bible---[language]---AB-StudyPack.txt)
# Columns: Pointed, Accented, Morphology, Extended Strongs
# Indication of Ketiv or Qere reading.
# 	The Qere is the scribal version in the margin.
#	Ketiv is the version found in the main text (if it is unpointed, the pointed version has been produced by Westminster and occasionally corrected by Tyndale scholars).
#	Most translations follow the Qere. 
# Word
#	Pointed form.
#	Accented forms from Westminster Leningrad text WLC 4.20 via OpenScriptures occassionally corrected towards the Leningrad Codex by Tyndale scholars.
# Morphology is from ETCBC in the form defined by OpenScriptures at https://openscriptures.github.io/morphhb/parsing/HebrewMorphologyCodes.html#vt
#	for the source of ETCBC and conversion method by Tyndale House, see https://goo.gl/yKaXQq#HebMorph2
#	ETCBC only parses the Qere. The Ketiv versions have been parsed by Tyndale scholars - see e.g. Deu.33.2-15
# Extended Strongs numbers are augmented (with additions of "a", "b" etc) in line with BDB based on OpenScriptures
#	and extended into the 9000s to include prefixes & suffixes - as in TBESH - Translators Brief lexicon of Extended Strongs for Hebrew at https://STEPBible\.github.io/STEPBible-Data/
#	§numbers represent submeanings within the Strongs number,  added by Tyndale scholars (not fully checked)
#	§names represent unique names for people, places and other proper nouns such as months etc.
#	as in TIPNR - Translators Individualised Proper Names with all References at https://STEPBible\.github.io/STEPBible-Data/
#
# FORMAT GREEK: (Holy-Bible---[language]---AB-StudyPack.txt)
# Columns: Type, Greek, English, Strongs, Morphology, Lexical, Gloss, Editions, Spellings, Meanings, Spanish, Sub-meaning, Super-meaning, Conjoin word
# Word Types:
#	=NA same TR	133304 words are translated in both traditional KJV and modern Bibles.		NA27/28 + TR + others all having the same meaning				
#	=NA diff TR	3922 words may translate differently in traditional and modern Bibles.		NA27/28 + others having the same meaning but there are.also .. 				| Variants = different meanings in TR + others
#	=NA not TR	761 words are translated in most modern Bibles but not in the KJV.			NA27/28 + others having the same meaning but not TR				
#	=TR+NIV/ESV not NA	227 words are translated in the KJV and in some modern Bibles.		TR + others having the same meaning but not NA27/28				
#	=TR not NA,NIV/ESV	3573 words are translated in the KJV but not in most modern Bibles.	TR + others having the same meaning but not NA27/28				
#	Not in NA or TR	245 words occur in early manuscripts but not translated in most Bibles.	Others having a word that is not found in TR or NA27/28	
#
#	This text is a Bible translator resource from the STEPBible Tyndale Amalgamated Hebrew and Greek.
#	The Greek text is tagged 'NA=TR' (default Nestle/Aland = Textus Receptus) 133,304 words from NA27/28+TR+others with same meaning,
#	'NA~TR' 3,922 words from NA27/28 with different meanings in TR, 'NA-TR' 761 words in NA27/28 not in TR,
#	'KJV' 3,573 words in TR not in NA27/28, 'KJV+' 3,573 words in TR+Older Bibles but not in NA27/28,
#	'KJV++' 227 words in TR+Modern Bibles but not in NA27/28, 'NATR?' 245 words not found in NA27/28 or TR.
#	New Testament study is revolutionized by the discovery of earlier manuscripts in the North African sands and other discoveries.
#	Most modern Bibles rely on these new discoveries. The NA text is based mostly on these earlier manuscripts,
#	but the TR text was put together from later ones, before the earlier ones were found.
#	Apparently later scribes often removed ambiguities with changes like adding the name "Jesus" instead of "he",
#	adding prepositions such as "with" and "to" instead of relying on Greek cases like dative and genitive,
#	and occasionally adding phrases to clarify the text. There are no instances of changed theology confirmed by the huge failed effort to find even one.
#	Less discussed are the words found in the earlier manuscripts, but not in the later.
#	Of these there are 548 differences with no impact to meaning and 277 scribal clarification differences.
#	And these are only mildly significant changes like "72" for "70" disciples sent out in Luke 10:1,17,
#	"Spirit of Jesus" for "Jesus" in Acts 16:7, "as you now walk" in 1Th 4:1, "according to God" in 1Pet 5:2,
#	"show mercy to others" in Jude 23, and "and a third of the earth was burned" in Rev 8:7.
#	The best explanation is that the additions found only in earlier manuscripts and the additions found only
#	in later ones are simply two sets of additions by scribes to clarify the text with no theological agenda.
#	So, if you want the very earliest text, use only the words that are in both NA and TR.
#	If you want to include clarifications by North African believers like modern Bibles, then include words found only in NA.
#	If you want to include the clarifications by Byzantine scribes like the KJV, then include the words found only in TR, and use the TR variants.
#			
# Greek:
#	spelling based on NA28 for NA, then TR if not in NA, then other Eds if in neither.
#	Cases and final accents based on the punctuation which follows THGHT
# English:
#	is based on Berean Study Bible, with permission, as at 1-July02019.
#	This covered only NA words.
#	Others supplied by Tyndale scholars, and the complete work was unified in many ways. 
# Extended Strong:
#	Extended with words not used in the KJV.
#	Backwardly compatible with standard Strongs and NASB tagging, as defined in the Brief Lexicon at https://STEPBible\.github.io/STEPBible-Data/
# Morphology:
#	Based on James Tuaber, with addtional details by Tyndale scholars:
#	persons added to Personal, Reflexive and Possessive pronouns;
#	distinguish 2nd verbal forms (e.g. 2nd Aorist); distinguished betweeen "Passive", "Either middle or Passive", "Deponent"
# Lexical form & Gloss:
#	from the TBESG - Tyndale Brief lexicon of Extended Strongs for Greek at https://STEPBible\.github.io/STEPBible-Data/
# Editions:
#	those which use the same letters, though they may be accented or capitalised differently.
#	Byz=Byzantine based on RP;
#	NA27=Nestle-Aland 27th ed;
#	NA28 2012 (this is NOT the same as ECM Acts - see eg Act.1.10 ἐσθῆτι in ECM);
#	TR= Textus Receptus;
#	SBL= SBLGNT;
#	Treg= Tregelles;
#	WH= WH;
#	Tyn= Tyndale House GNT. 
# Spanish:
#	is based on Marvel Bible Project as on 9-Jan-2019 from https://github.com/eliranwong/OpenGNT/blob/master/OpenGNT_BASE_TEXT.zip & OpenGNT_keyedFeatures.csv.zip.
#	This was available only for words in NA28. Other words are supplied by Tyndale scholars.
# Sub-meanings:
#	words with more than one meaning are supplied with a context-sensitive sub-meaning.
#	Individuals and Places are identified as in TIPNR.
#	Other are based on CSG (Context Sensitive Gloss) from Marvel Bible Project as at 9-Jan-2019
#	from https://github.com/eliranwong/OpenGNT/blob/master/OpenGNT_BASE_TEXT.zip & OpenGNT_keyedFeatures.csv.zip.
#	This was available only for words in NA28.
#	Other words are supplied by Tyndale House who also edited the CSG for words where sub-meanings  were not sufficiently detailed. 
# Conjoined data:
#	links words that might not be translated (eg articles and particles) with the word they are connected to, which are often separated by several other words. 
#
#



EOT;
AION_ECHO("INIT");
$database = array();
AION_FILE_DATA_GET('./aion_database/VERSIONS.txt',	'T_VERSIONS',	$database, 'BIBLE', TRUE );
$abooks = AION_BIBLES_LIST();
$tbooks = AION_BIBLES_LIST_TYN();

/////////////////////////////////////////////////////////////////
// Build the Language Packs!
$PACKS = array();
foreach($database[T_VERSIONS] as $bible => $version) {
	if (empty($version['PACK'])) { continue; }
	$lang = strtok($version['LANGUAGEENGLISH'],", ");
	$PACKS[$lang][$version['PACK']] = $bible;
	ksort($PACKS[$lang]);
}

/////////////////////////////////////////////////////////////////
// LOOP THE LIST
foreach($PACKS as $lang => $pack) {
	// create folder and file
	$studypack="Holy-Bible---$lang---AB-StudyPack";
	$studyfile="$studypack/Holy-Bible---$lang---AB-StudyPack.txt";
	AION_ECHO("Attempting: $lang: $studypack");
	system("rm -rf $studypack");
	if (!mkdir($studypack)) { AION_ECHO("ERROR! mkdir()"); }
	if (!($studyhandle = fopen($studyfile, "w"))) { AION_ECHO("ERROR! fopen($studyfile)"); }
	// hebrew tags
	$files = array(
		"../STEPBible-Data-master/TOTHT Gen-Deu - Translators OT Hebrew Tagged text - STEPBible.org CC BY.txt",
		"../STEPBible-Data-master/TOTHT Jos-Est - Translators OT Hebrew Tagged text - STEPBible.org CC BY.txt",
		"../STEPBible-Data-master/TOTHT Job-Sng - Translators OT Hebrew Tagged text - STEPBible.org CC BY.txt",
		"../STEPBible-Data-master/TOTHT Isa-Mal - Translators OT Hebrew Tagged text - STEPBible.org CC BY.txt",
		);
	foreach($files as $file) {
		AION_ECHO("Processing: $file");
		if (!($handle = fopen($file, "r"))) { AION_ECHO("ERROR! fopen($file)"); }
		$notyet = TRUE;
		$last === NULL;
		while (($line = fgets($handle)) !== false) {
			if (empty($line)) { continue; }
			if ($notyet) { if (!preg_match("#^Gen.1.1-01	#u",$line) && !preg_match("#^Jos.1.1-01	#u",$line) && !preg_match("#^Job.1.1-01	#u",$line) && !preg_match("#^Isa.1.1-01	#u",$line)) { continue; } $notyet = FALSE; }
			// Gen.1.1-01	Gen.1.1-01	בְּרֵאשִׁית	בְּ/רֵאשִׁ֖ית	HR/Ncfsa	H9003=ב=in/H7225=רֵאשִׁית=first_§1_beginning
			if (!preg_match("#^([^\t]+)\t([[:alnum:]]+)[[:punct:]]+([\d]+)[[:punct:]]+([\d]+)[[:punct:]]+([\d]+)([KQkq]{0,1})\t(.*)$#iu",$line,$match)) { AION_ECHO("ERROR! corrupt hebrew ref: $line"); }
			$book = strtoupper($match[2]);
			if (empty($tbooks[$book])) { AION_ECHO("ERROR! missing book='$book': $line"); }
			$book = $tbooks[$book];
			$indx = sprintf('%03d', (int)array_search($book,array_keys($abooks)));
			$chap = sprintf('%03d', (int)$match[3]);
			$vers = sprintf('%03d', (int)$match[4]);
			$match[6] = strtolower($match[6]);
			$sort = "ZZ".sprintf('%03d', 100+(int)$match[5]).$match[6];
			$yeah = ($match[6]=='k' ? 'Ketiv: ' : ($match[6]=='q' ? 'Qere: ' : '')) . $match[7];
			// block intro
			if ($last!="$indx$book$chap$vers") {
				if (fwrite($studyhandle,"$indx	$book	$chap	$vers	XX000	\n")===false) { AION_ECHO("ERROR! fwrite($file: $line)"); }
				if (fwrite($studyhandle,"$indx	$book	$chap	$vers	XX000	\n")===false) { AION_ECHO("ERROR! fwrite($file: $line)"); }
				$last="$indx$book$chap$vers";
			}
			// write the verse word
			if (fwrite($studyhandle,"$indx	$book	$chap	$vers	$sort	$yeah\n")===false) { AION_ECHO("ERROR! fwrite($file: $line)"); }
			if (preg_match("#^Mal.3.24-15	#u",$line)) { break; } 			
		}
		fclose($handle);
	}
	// greek tags
	$files = array(
		"../STEPBible-Data-master/TAGNT Mat-Jhn - Translators Amalgamated Greek NT - STEPBible.org CC-BY.txt",
		"../STEPBible-Data-master/TAGNT Act-Rev - Translators Amalgamated Greek NT - STEPBible.org CC-BY.txt",
		);
	foreach($files as $file) {
		AION_ECHO("Processing: $file");
		if (!($handle = fopen($file, "r"))) { AION_ECHO("ERROR! fopen($file)"); }
		$notyet = TRUE;
		$indx = NULL;
		while (($line = fgets($handle)) !== false) {
			if (empty($line) || ctype_space($line)) { $indx = NULL; continue; }
			if ($notyet) { if (!preg_match("/^# Mat.1.1	/u",$line) && !preg_match("/^# Act.1.1	/u",$line)) { $indx = NULL; continue; } $notyet = FALSE; }
			// first line
			if (preg_match("/^# ([[:alnum:]]{3})\.([[:digit:]]{1,3})\.([[:digit:]]{1,3})\t(.+)$/u",$line,$match)) {
				$book = strtoupper($match[1]);
				if (empty($tbooks[$book])) { AION_ECHO("ERROR! missing book='$book': $line"); }
				$book = $tbooks[$book];
				$indx = sprintf('%03d', (int)array_search($book,array_keys($abooks)));
				$chap = sprintf('%03d', (int)$match[2]);
				$vers = sprintf('%03d', (int)$match[3]);
				$order = 0;
				$sort = 'ZZ001';
				$yeah = "GRK:	".$match[4];
				// block intro
				if (fwrite($studyhandle,"$indx	$book	$chap	$vers	XX000	\n")===false) { AION_ECHO("ERROR! fwrite($file: $line)"); }
				if (fwrite($studyhandle,"$indx	$book	$chap	$vers	XX000	\n")===false) { AION_ECHO("ERROR! fwrite($file: $line)"); }
			}
			else if ($indx === NULL) {
				AION_ECHO("ERROR! INDX==NULL $file: $line)");
			}
			// more lines
			else if (preg_match("/^#_(.+)$/u",$line,$match)) {
				$order = ($order < 100 ? 100 : $order);
				$sort = sprintf('ZZ%03d', $order);
				if (preg_match("/^#_Translation\s+(.+)$/u",$line,$match2)) {	$yeah = "STP:	".$match2[1]; }
				else {															$yeah = $match[1]; }
			}
			// bible word lines
			else if (preg_match("/^([[:digit:]]{2})_([[:alnum:]]{3})\.([[:digit:]]{3})\.([[:digit:]]{3})\t(.+)$/u",$line,$match)) {
				$bookT = strtoupper($match[2]);
				if (empty($tbooks[$bookT])) { AION_ECHO("ERROR! missing book='$bookT': $line"); }
				$bookT = $tbooks[$bookT];
				$indxT = sprintf('%03d', (int)array_search($bookT,array_keys($abooks)));
				$chapT = sprintf('%03d', (int)$match[3]);
				$versT = sprintf('%03d', (int)$match[4]);
				if ($indx!=$indxT || $book!=$bookT || $chap!=$chapT) {												AION_ECHO("WARN! bad big reference skipped: $line"); continue; }
				if ((int)$versT == (int)$vers + 1) {		$order = ($order < 200 || $order > 299 ? 200 : $order);	AION_ECHO("WARN! bad reference forwarded: $line"); }
				else if ((int)$versT == (int)$vers - 1) {	$order = ($order < 800 ? 800 : $order);					AION_ECHO("WARN! bad reference backwarded: $line"); }
				else if ((int)$versT != (int)$vers) {																AION_ECHO("WARN! bad verse reference skipped: $line"); continue; }
				else {										$order = ($order < 300 ? 300 : $order); }
				$sort = sprintf('ZZ%03d', $order);
				$yeah = $match[5];
			}
			else {
				AION_ECHO("ERROR! bad line no matchee: $line");
			}
			if ($order > 999) {
				AION_ECHO("ERROR! bad order number=$order: $line");
			}
			if (fwrite($studyhandle,"$indx	$book	$chap	$vers	$sort	$yeah\n")===false) { AION_ECHO("ERROR! fwrite($file: $line)"); }
			++$order;
		}
		fclose($handle);
	}
	// close the file
	fclose($studyhandle);
	// custom bible cat
	$order = 10;
	$first = TRUE;
	$bibledetail = NULL;
	foreach($pack as $bible) {
		AION_ECHO("Processing: $bible");
		if ($order>99) { break; }
		if (empty($database['T_VERSIONS'][$bible]['SHORT'])) { AION_ECHO("ERROR! Bible short not found! $bible"); }
		$sort = sprintf('ZZ%03d', $order);
		AION_ECHO("Processing: $bible $sort");
		if ($first) {
			system("cat ../www-stageresources/$bible---Aionian-Edition.noia | sed -r \"s/[[:digit:]]+	[[:alnum:]]+	[[:digit:]]+	[[:digit:]]+	/&YY000	NEW:	/\" >> $studyfile");
			$first = FALSE;
		}
		if ($bible!='Holy-Bible---English---Aionian-Bible' && $bible!='Holy-Bible---English---STEPBible-Amalgamant') {
			$short = $database['T_VERSIONS'][$bible]['SHORT'];
			$name = $database['T_VERSIONS'][$bible]['NAMEENGLISH'];
			$location = $database['T_VERSIONS'][$bible]['SOURCELINK'];		
			$copyright = $database['T_VERSIONS'][$bible]['COPYRIGHT'];
			$bibledetail .= "#	$short: '$name' from $location ($copyright)\n";
			system("cat ../www-stageresources/$bible---Aionian-Edition.noia | sed -r \"s/[[:digit:]]+	[[:alnum:]]+	[[:digit:]]+	[[:digit:]]+	/&$sort	$short:	/\" >> $studyfile");
		}
		++$order;
	}
	// Aionian Bible cat
	$bible = "Holy-Bible---English---Aionian-Bible";
	$short = $database['T_VERSIONS'][$bible]['SHORT'];
	$name = $database['T_VERSIONS'][$bible]['NAMEENGLISH'];
	$location = $database['T_VERSIONS'][$bible]['SOURCELINK'];		
	$copyright = $database['T_VERSIONS'][$bible]['COPYRIGHT'];
	$bibledetail .= "#	$short: '$name' from $location ($copyright)\n";
	$sort = sprintf('ZZ%03d', $order);
	AION_ECHO("Processing: Aionian Bible EAB $sort");
	system("cat ../www-stageresources/Holy-Bible---English---Aionian-Bible---Aionian-Edition.noia | sed -r \"s/[[:digit:]]+	[[:alnum:]]+	[[:digit:]]+	[[:digit:]]+	/&$sort	EAB:	/\" >> $studyfile");
	// STEPBible Amalgamant cat
	++$order;
	$bible = "Holy-Bible---English---STEPBible-Amalgamant";
	$short = $database['T_VERSIONS'][$bible]['SHORT'];
	$name = $database['T_VERSIONS'][$bible]['NAMEENGLISH'];
	$location = $database['T_VERSIONS'][$bible]['SOURCELINK'];		
	$copyright = $database['T_VERSIONS'][$bible]['COPYRIGHT'];
	$bibledetail .= "#	$short: '$name' from $location ($copyright)\n";
	$sort = sprintf('ZZ%03d', $order);
	AION_ECHO("Processing: STEP Bible STP $sort");
	system("cat ../www-stageresources/Holy-Bible---English---STEPBible-Amalgamant---Aionian-Edition.noia | sed -r -e '/^0[4-9]+/d' | sed -r \"s/[[:digit:]]+	[[:alnum:]]+	[[:digit:]]+	[[:digit:]]+	/&$sort	STP:	/\" >> $studyfile");
	// sort and add header
	AION_ECHO("Sort: $studyfile");
	if (!($HEADER2=preg_replace("/(\# Select Bible translations[^\n]+\n)/sui", '$1'."$bibledetail", $HEADER, 1, $count)) || $count!=1) {		AION_ECHO("ERROR! preg_replace(HEADER)"); }
	if (file_put_contents("$studyfile.sort", $HEADER2)===FALSE) {																											AION_ECHO("ERROR! file_put_contents(1)"); }
	system("cat $studyfile | sed -r -e '/^[[:space:]]*$/d' -e '/^#/d' | sort | sed -r -e 's/^.*XX000//' -e 's/YY000	//' -e 's/^.*ZZ[[:alnum:]]+/#/' >> $studyfile.sort");
	if (!rename("$studyfile.sort", $studyfile)) { AION_ECHO("ERROR! Rename() failed: $studyfile"); }
	// write the files
	AION_ECHO("Copy: more files");
	if (!copy("../STEPBible-Data-master/TBESG - Translators Brief lexicon of Extended Strongs for Greek - STEPBible.org CC BY.txt", "$studypack/Greek-Lexicon.txt")) {		AION_ECHO("ERROR! copy(2)"); }
	if (!copy("../STEPBible-Data-master/TBESH - Translators Brief lexicon of Extended Strongs for Hebrew - STEPBible.org CC BY.txt", "$studypack/Hebrew-Lexicon.txt")) {	AION_ECHO("ERROR! copy(3)"); }
	if (!copy("../STEPBible-Data-master/TEGMC - Translators Expansion of Greek Morphhology Codes - STEPBible.org CC BY.txt", "$studypack/Greek-Morphhology.txt")) {			AION_ECHO("ERROR! copy(4)"); }
	if (!copy("../STEPBible-Data-master/TEHMC - Translators Expansion of Hebrew Morphology Codes - STEPBible.org CC BY.txt", "$studypack/Hebrew-Morphhology.txt")) {		AION_ECHO("ERROR! copy(5)"); }	
	// revise and write README
	if (file_put_contents("$studypack/AB-README.txt", $HEADER)===FALSE) {																									AION_ECHO("ERROR! file_put_contents(6)"); }
	// zip the files
	AION_ECHO("Zip: $studypack");
	system("zip -9 -rv ../www-resources/AB-StudyPack/$studypack.zip $studypack");
	if (1 || ($lang!="English" && $lang!="Spanish")) {
		system("rm -rf $studypack");
	}
}

/////////////////////////////////////////////////////////////////
// CLOSE UP
	if (file_put_contents("../www-resources/AB-StudyPack/AB-README.txt", $HEADER)===FALSE) {																				AION_ECHO("ERROR! file_put_contents(7)"); }

/////////////////////////////////////////////////////////////////
// DONE
AION_ECHO("DONE");
