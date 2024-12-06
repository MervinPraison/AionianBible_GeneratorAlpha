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
# _README.txt									This explanation.
# AB-Shared-Resources.zip						Repackaged from https://github.com/STEPBible/STEPBible-Data
#	_README.txt									Also this explanation.
#	Greek-Lexicon.txt							Tyndale Greek extended Strongs lexicon.
#	Greek-Lexicon-LSJ.txt						Liddell Scott Jones lexicon.
#	Greek-Lexicon-LSJ-Extra.txt					Liddell Scott Jones lexicon.
#	Greek-Morphhology.txt						Greek word morphhology code definitions.
#	Hebrew-Lexicon.txt							Tyndale Hebrew extended Strongs lexicon.
#	Hebrew-Morphhology.txt						Hebrew word morphhology code definitions.
#	Proper-Names.txt							Proper name definitions and usage.
# Holy-Bible---[language]---AB-StudyPack.txt	Resources for Bible translation and study of underlying languages.
#
# CONTENTS:
# Select Bible translations in parallel verse by line format.
# STEPBible Hebrew and Greek Amalgamant word by line by verse format.
# Extended Strong's numerical indexes linked to lexicon entries.
# Word morphhology codes linked to explanatory entries.
#
# BELIEF:
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
# PRACTICE:
# 1. To glorify God and enjoy him forever, Revelation 21:1-7.
# 2. To defend that true religion is defined by the Christian Scriptures, with God alone as the infallible interpreter of his Word, 2 Timothy 3:14-16 and 1 John 2:20-27.
# 3. To defend that true religion obeys Christ’s commands and imitates his character, John 8:31-23 and 1 John 2:3-6.
# 4. To love and receive all those who trust Jesus as members of the family of Christ and wholly participate in regular Christian fellowship, Romans 10:9 and Hebrews 10:25.
# 5. To honor marriage as ordained by God and to acknowledge God’s only design as the lifetime covenant relationship between one man and one woman, an illustration of Christ and the Church, Genesis 2:19-25 and Ephesians 5:22-33, and that divorce and remarriage is only allowed by Christ in the case of unrepentant marital infidelity and abandonment by an unbeliever, Matthew 19:9 and 1 Corinthians 7:15.
# 6. To order our relationships in the Biblical pattern of respect and submission outlined in Romans 13:1, Hebrews 13:17, and Ephesians 5:21-6:9 with citizens obeying governmental authorities, believers obeying Christian leaders, husbands loving wives, wives submitting to husbands, children obeying parents, fathers not exasperating, but bring children up in the Lord, servants obeying their masters, and masters caring for their servants.
# 7. To be disciples of Christ, trusting and obeying God, loving God and one another, and calling others to do the same, Matthew 22:35-40 and Matthew 28:18-20.
# 8. To know God and to make him known to the unbelieving, 1 Corinthians 15:1-7 and Philemon 6.
# 9. To value, defend, and protect the sanctity of life, mankind being created by God in His image so that human life is of inestimable worth in all its dimensions, including pre-born babies, the aged, the physically or mentally challenged, and every other stage or condition from conception through natural death, Psalm 139:13-16 and Jeremiah 1:4-10.
# 10. To live sober minded lives free from drunkenness, substance abuse, gluttony, or any excess in order to honor our bodies which are the temple of the Holy Spirit and be fit and prepared for serving the Lord, Galatians 5:16-26 and Titus 2:11-14.
# 11. To serve as Christ’s peacemaking agents on earth waging war against Satan’s divisive lies, limiting ourselves to the weapons of God’s word, prayer, and a Christ-like attitude, 2 Corinthians 10:3-5, Ephesians 6:10-20, and 1 Peter 4:1.
# 12. To hold one another accountable that professing Christians have a responsibility to pursue a godly lifestyle and Christ-like life that is to be enforced and disciplined as described in Matthew 18:15-20, 1 Corinthians 5: 1-13, 2 Thessalonians 3:6-15, and 1 Timothy 5:17-21.
# 13. This statement of Christian behavior does not exhaust the extent of our practice. The Bible itself, as the inspired and infallible Word of God that speaks with final authority concerning truth, morality, and the proper conduct of mankind, is the sole and final authority of all of our behavior.  We also recognize that every matter great or small is within the realm of God’s loving concern, but prioritize our concerns to the greatest matters of Christian conscience first, Romans 11:36 and 2 Corinthians 10:3-5.  For purposes of The Corporation’s practice the Board of Directors is The Corporation’s final interpretive authority on the Bible’s meaning and application.
#
# TRANSLATE:
# 1. Pray, recruit a committee of faithful Christians, and confirm the above basic statement of faith and practice.
# 2. Agree that translations are not inspired or infallible, though Lord willing faithfully made, because only the original autographs of Scripture are God-breathed and inerrant.
# 3. Translate and do not paraphrase, prioritizing the contexts of phrase, sentence, paragraph, book, author, testament, Bible, and history.
# 4. Allow for cumbersome and ambiguous translation, if needed, until understanding is made more certain.
# 5. Translate and do not paraphrase colloquial expression, respecting the reader to interpret the Holy Spirit's expression.
# 6. Maintain the Holy Spirit's gender choice of words even when the meaning is mankind which indicates male headship, because male and female is wonderful gift from God and a reflection of His image, and Biblical roles for men and women are a cause for celebration, not apology.
# 7. Maintain word and phrase order when possible, allowing some reduced readability, if needed, to maintain the structure of the original.
# 8. Preserve word and phrase repetition and continuation (same theme different word) with concordant translation as much as possible, especially within the book and author level context, to help the reader appreciate the major and minor themes, structure, poetry, and nuance of the original.
# 9. Atttempt similar word count and economy as much as possible with the underlying text.
# 10. Translate Abyssos, Geenna, Hadēs, Limnē Pyr, Sheol, and Tartaroō as distinct locations, preferably using the transliterated word.
# 11. Translate aïdios as eternal and aiōn as age or eon.
# 12. Translate aiōnios as an adjective of aiōn, that is pertaining to the age, as life, lifetime, entire, whole, or consummate, but not as eternal or infinite time.
# 13. Follow the English standard and/or King James versification to match the AionianBible.org project
#
# STATEGY:
# 1. Pray for a modern public domain translation in every language.
# 2. Use https://AionianBible.org for study, parallel Bible text viewing, and extended Strong's lexicon entries.
# 3. Download https://github.com/STEPBible/STEPBible-Data for direct access to the STEPBBible data.
# 4. Use other resources as available and needed.
# 5. Install https://notepad-plus-plus.org or a text editor with REGEX for advanced text search and edits.
# 6. Use https://github.com/ and other public repositories to track your work and publicize.
# 7. Use the Aionian Bible verse per line format of "3-digit-book-index	3-character-book-abbreviation	3-digit-chapter-number	3-digit-verse-number	verse-text".
# 8. Create a new translation editing the top line at each verse reference.
# 9. Use modern spelling and grammar checkers if possible.
# 10. Use correct style and punctuation, as well as smart quotes.
# 11. Add lines beginning with "#" for comments as needed.
# 12. Release your work as CC0 (public domain), CC-BY (attribution), CC-BY-SA (shared with copyright), and avoid CC-ND (no derivative) and CC-NC (no commercial) so Bibles can be further developed and sold.
# 13. Submit your new translation to AionianBible.org and other outlets for distribution.
#
# WORDS:
#	STRONGS		Strongs entry number
#	JOIN		Relation to previous word: 
#		HEBREW
#				"W"		=> "Next word",
#				"W$"	=> "Next word (Hebrew root)",
#				"W+"	=> "Next word (+following shares Strongs)",
#				"C"		=> "Continue previous word",
#				"C$"	=> "Continue previous word (Hebrew root)",
#				"C+"	=> "Continue previous word (+following shares Strongs)",
#				"J"		=> "Joined with previous word",
#				"J$"	=> "Joined with previous word (Hebrew root)",
#				"D"		=> "Divided from previous word",
#				"D$"	=> "Divided from previous word (Hebrew root)",
#				"L"		=> "Link previous-next word",
#				"P"		=> "Punctuation",
#		GREEK 
#				"W"		=> "Next word",
#				"C"		=> "Continue the previous word",
#				"J"		=> "Join with previous word",
#				"D"		=> "Divide from previous word",
#				"L"		=> "Link previous-next word",
#				"P"		=> "Punctuation",
#	TYPE		Source description
#		HEBREW
#				"A"		=> "Aleppo",
#				"AH"	=> "Aleppo and Ben Chaim",
#				"AV"	=> "Aleppo and other Hebrew manuscripts",
#				"B"		=> "Biblia Hebraica Stuttgartensia",
#				"C"		=> "Cairensis",
#				"D"		=> "Dead Sea and other Judean Desert manuscripts",
#				"E"		=> "Emendation from ancient sources",
#				"F"		=> "Format pointing or word divisions differently without changing letters",
#				"H"		=> "Ben Chaim (2nd Rabbinic Bible)",
#				"K"		=> "Ketiv 'written' in the text with Tyndale pointing",
#				"L"		=> "Leningrad manuscript",
#				"LAH"	=> "Leningrad manuscript, influencing variant: Aleppo and Ben Chaim",
#				"Lav"	=> "Leningrad manuscript, minor variant: Aleppo and other Hebrew manuscripts",
#				"LB"	=> "Leningrad manuscript, influencing variant: BHS",
#				"Lb"	=> "Leningrad manuscript, minor variant: BHS",
#				"Lbp"	=> "Leningrad manuscript, minor variants: BHS and alternate punctuation",
#				"LC"	=> "Leningrad manuscript, influencing variant: Cairensis",
#				"LD"	=> "Leningrad manuscript, influencing variant: Dead Sea manuscript",
#				"LE"	=> "Leningrad manuscript, influencing variant: ancient sources",
#				"LF"	=> "Leningrad manuscript, influencing variant: pointing and divisions",
#				"LH"	=> "Leningrad manuscript, influencing variant: Ben Chaim",
#				"LP"	=> "Leningrad manuscript, influencing variant: alternate punctuation",
#				"Lp"	=> "Leningrad manuscript, minor variant: alternate punctuation",
#				"LS"	=> "Leningrad manuscript, influencing variant: Scribal traditions in Itture Sopherim, etc",
#				"LV"	=> "Leningrad manuscript, influencing variant: and other Hebrew manuscripts",
#				"Qk"	=> "Qere 'spoken' corrections from margin and text pointing, minor variant: Ketiv 'written', Tyndale pointing",
#				"QK"	=> "Qere 'spoken' corrections from margin and text pointing, influencing variant: Ketiv 'written', Tyndale pointing",
#				"QKB"	=> "Qere 'spoken' corrections from margin and text pointing, influencing variant: BHS and Ketiv 'written', Tyndale pointing",
#				"R"		=> "Restored text based on Leningrad parallels",
#				"V"		=> "Other Hebrew manuscripts",
#				"X"		=> "Extra words from Septuagint (LXX), in Hebrew based on apparatus in BHS and BHK",
#		GREEK
#				"NKO"	=> "Identical in all sources",
#				"NK+O"	=> "Identical in Nestle/Aland and King James sources, noted difference in other sources",
#				"NK+o"	=> "Identical in Nestle/Aland and King James sources, minor difference in other sources",
#				"N+KO"	=> "Identical in Nestle/Aland and other sources, noted difference in King James sources",
#				"N+K+O"	=> "Noted difference in Nestle/Aland, King James, and other sources",
#				"N+K+o"	=> "Noted difference in Nestle/Aland and King James sources, minor difference in other sources",
#				"N+kO"	=> "Identical in Nestle/Aland and other source, minor difference in King James sources",
#				"N+k+O"	=> "Noted difference in Nestle/Aland and other sources, minor difference in King James sources",
#				"N+k+o"	=> "Identical in Nestle/Aland sources, minor difference in King James and other sources",
#				"NK"	=> "Identical in Nestle/Aland and King James sources, absent in other sources",
#				"N+k"	=> "Identical in Nestle/Aland sources, minor difference in King James sources, absent in other sources",
#				"NO"	=> "Identical in Nestle/Aland and other sources, absent in King James sources",
#				"no"	=> "Minor difference in Nestle/Aland and other sources, absent in King James sources",
#				"N+O"	=> "Identical in Nestle/Aland sources, noted difference in other sources, absent in King James sources",
#				"N+o"	=> "Identical in Nestle/Aland sources, minor difference in other sources, absent in King James sources",
#				"n+o"	=> "Minor difference in Nestle/Aland and other sources, absent in King James sources",
#				"N"		=> "Identical in Nestle/Aland sources, absent in King James and other sources",
#				"n"		=> "Minor difference in Nestle/Aland sources, absent in King James and other sources",
#				"KO"	=> "Identical in King James and other sources, absent in Nestle/Aland sources",
#				"K+O"	=> "Noted difference in King James and other sources, absent in Nestle/Aland sources",
#				"K+o"	=> "Identical in King James sources, minor difference in other sources, absent in Nestle/Aland sources",
#				"k+o"	=> "Minor difference in King James and other sources, absent in Nestle/Aland sources",
#				"ko"	=> "Identical minor difference in King James and other sources, absent in Nestle/Aland sources",
#				"K"		=> "Identical in King James sources, absent in Nestle/Aland and other sources",
#				"k"		=> "Minor difference in King James sources, absent in Nestle/Aland and other sources",
#				"O"		=> "Identical in other sources, absent in Nestle/Aland and King James sources",
#				"o"		=> "Minor difference in other sources, absent in Nestle/Aland and King James sources",
#	UNDER		Hebrew underlying word
#	TRANS		Hebrew transliteration
#	LEXICON		Hebrew lexicon word
#	ENGLISH		English word in context
#	GLOSS		English from lexicon
#	MORPH		Morphhology grammar
#	EDITIONS	Found in these editions 
#		HEBREW:	None
#		GREEK:
#				"Byz"		=> "Byzantine from Robinson/Pierpoint",
#				"Coptic"	=> "Coptic",
#				"ESV"		=> "English Standard Version",
#				"Goodnews"	=> "Goodnews",
#				"KJV"		=> "King James Version",
#				"KJV?"		=> "King James Version possibly",
#				"NA26"		=> "Nestle/Aland 26th Edition",
#				"NA27"		=> "Nestle/Aland 27th Edition",
#				"NA28"		=> "Nestle/Aland 28th Edition, not ECM",
#				"Latin"		=> "Latin",
#				"NIV"		=> "New International Version",
#				"OldLatin"	=> "Old Latin",
#				"OldSyriac"	=> "Old Syriac version",
#				"P46"		=> "Papyri #46",
#				"P66"		=> "Papyri #66",
#				"P66*"		=> "Papyri #66 corrector",
#				"Punc"		=> "Accent variant from punctuation",
#				"SBL"		=> "Society of Biblical Literature Greek NT",
#				"Syriac"	=> "Syriac",
#				"TR"		=> "Textus Receptus",
#				"Treg"		=> "Tregelles",
#				"Tyn"		=> "Tyndale House GNT",
#				"U1"		=> "Uncial Codex #1, Sinaiticus",
#				"U2"		=> "Uncial Codex #2",
#				"U3"		=> "Uncial Codex #3, Alexandrinus",
#				"U4"		=> "Uncial Codex #4",
#				"U5"		=> "Uncial Codex #5, Bezae",
#				"U6"		=> "Uncial Codex #6",
#				"U32"		=> "Uncial Codex #32",
#				"WH"		=> "Westcott/Hort",
#	VAR			Translation variations
#	SPELL		Spelling variations
#	EXTRA		Extra notes
#	ALT			Alternate strongs numbers used
#
#


EOT;
AION_ECHO("INIT");
$database = array();
AION_FILE_DATA_GET('./aion_database/VERSIONS.txt',	'T_VERSIONS',	$database, 'BIBLE', TRUE );

/////////////////////////////////////////////////////////////////
// Build the Language Packs!
$PACKS = array();
foreach($database[T_VERSIONS] as $bible => $version) {
	if (empty($version['PACK'])) { continue; }
	$lang = strtok($version['LANGUAGEENGLISH'],", ");
	//if ($lang!='English' && $lang!='Spanish') { continue; }
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
	//INDX	BOOK	CHAP	VERS	STRONGS	JOIN	TYPE	UNDER	TRANS	LEXICON	ENGLISH	GLOSS	MORPH	EDITIONS	VAR	SPELL	EXTRA	ALT
	//1	GEN	1	1	H9003	W	L	בְּ/רֵאשִׁ֖ית	be.	ב	in	in	HR					
	//1	GEN	1	1	H7225G	C$	L	בְּ/רֵאשִׁ֖ית	re.Shit	רֵאשִׁית	beginning	beginning	HNcfsa				first	
	//1	GEN	1	1	H1254A	W$	L	בָּרָ֣א	ba.Ra'	בָּרָא	he created	to create	HVqp3ms					
	$files = array(
		"../www-production/library/stepbible/Hebrew_Tagged_Text.txt",
		"../www-production/library/stepbible/Greek_Tagged_Text.txt",
		);
	foreach($files as $file) {
		AION_ECHO("Processing: $file");
		if (!($handle = fopen($file, "r"))) { AION_ECHO("ERROR! fopen($file)"); }
		$last = NULL;
		$numb = 0;
		while (($line = fgets($handle)) !== false) {
			if (empty($line) || $line[0]=='#' || preg_match("#^INDX	#u",$line)) { continue; }
			if (!preg_match("#^(\d+)\t([[:alnum:]]+)\t(\d+)\t(\d+)\t(.+)$#iu",$line,$match)) { AION_ECHO("ERROR! corrupt hebrew ref: $line"); }
			$indx = sprintf('%03d', (int)$match[1]);
			$book = $match[2];
			$chap = sprintf('%03d', (int)$match[3]);
			$vers = sprintf('%03d', (int)$match[4]);
			$word = $match[5];
			$sort = "ZZ".sprintf('%03d', 100+$numb);
			++$numb;
			// block intro
			if ($last!="$indx$book$chap$vers") {
				if (fwrite($studyhandle,"$indx	$book	$chap	$vers	XX000	\n")===false) { AION_ECHO("ERROR! fwrite($file: $line)"); } // blank lines
				if (fwrite($studyhandle,"$indx	$book	$chap	$vers	XX000	\n")===false) { AION_ECHO("ERROR! fwrite($file: $line)"); } // blank lines
				if (fwrite($studyhandle,"$indx	$book	$chap	$vers	ZZ099	STRONGS	JOIN	TYPE	UNDER	TRANS	LEXICON	ENGLISH	GLOSS	MORPH	EDITIONS	VAR	SPELL	EXTRA	ALT\n")===false) { AION_ECHO("ERROR! fwrite($file: $line)"); }
				$last = "$indx$book$chap$vers";
				$numb = 0;
			}
			// write the verse word
			if (fwrite($studyhandle,"$indx	$book	$chap	$vers	$sort	$word\n")===false) { AION_ECHO("ERROR! fwrite($file: $line)"); }
		}
		fclose($handle);
	}

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
			//system("cat ../www-stageresources/$bible---Aionian-Edition.noia | sed -r \"s/[[:digit:]]+	[[:alnum:]]+	[[:digit:]]+	[[:digit:]]+	/&YY000	NEW:	/\" >> $studyfile");
			system("cat ../www-stageresources/$bible---Aionian-Edition.noia | sed -r \"s/[[:digit:]]+	[[:alnum:]]+	[[:digit:]]+	[[:digit:]]+	/&YY000	/\" >> $studyfile");
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
	/* knocked out for now
	++$order;
	$bible = "Holy-Bible---English---STEPBible-Amalgamant";
	$short = $database['T_VERSIONS'][$bible]['SHORT'];
	$name = $database['T_VERSIONS'][$bible]['NAMEENGLISH'];
	$location = $database['T_VERSIONS'][$bible]['SOURCELINK'];		
	$copyright = $database['T_VERSIONS'][$bible]['COPYRIGHT'];
	$bibledetail .= "#	$short: '$name' from $location ($copyright)\n";
	$sort = sprintf('ZZ%03d', $order);
	AION_ECHO("Processing: STEP Bible STP $sort");
	system("cat ../www-stageresources/Holy-Bible---English---STEPBible-Amalgamant---Aionian-Edition.noia | sed -r \"s/[[:digit:]]+	[[:alnum:]]+	[[:digit:]]+	[[:digit:]]+	/&$sort	STP:	/\" >> $studyfile");
	*/
	// sort and add header
	AION_ECHO("Sort: $studyfile");
	if (!($HEADER2=preg_replace("/(\# Select Bible translations[^\n]+\n)/sui", '$1'."$bibledetail", $HEADER, 1, $count)) || $count!=1) {		AION_ECHO("ERROR! preg_replace(HEADER)"); }
	if (file_put_contents("$studyfile.sort", $HEADER2)===FALSE) {																											AION_ECHO("ERROR! file_put_contents(1)"); }
	system("cat $studyfile | sed -r -e '/^[[:space:]]*$/d' -e '/^#/d' | sort | sed -r -e 's/^.*XX000//' -e 's/YY000	//' -e 's/^.*ZZ[[:alnum:]]+/#/' >> $studyfile.sort");
	if (!rename("$studyfile.sort", $studyfile)) { AION_ECHO("ERROR! Rename() failed: $studyfile"); }
	// write the files
	AION_ECHO("Copy: more files");
	// revise and write README
	if (file_put_contents("$studypack/_README.txt", $HEADER)===FALSE) {																								AION_ECHO("ERROR! file_put_contents(6)"); }
	// zip the files
	AION_ECHO("Zip: $studypack");
	unlink("../www-resources/AB-StudyPack/$studypack.zip");
	system("zip -9 -rv ../www-resources/AB-StudyPack/$studypack.zip $studypack");
	system("rm -rf $studypack");
}

/////////////////////////////////////////////////////////////////
// README
if (file_put_contents("../www-resources/AB-StudyPack/_README.txt", $HEADER)===FALSE) {																				AION_ECHO("ERROR! file_put_contents(7)"); }

//////////////////////////////////////////////////////////////////
// make the shared resource PACK
$studypack="AB-Shared-Resources";
AION_ECHO("Zip: $studypack");
unlink("../www-resources/AB-StudyPack/$studypack.zip");
system("rm -rf $studypack");
if (!mkdir($studypack)) { AION_ECHO("ERROR! mkdir()"); }
if (!copy("../www-resources/AB-StudyPack/_README.txt", "$studypack/_README.txt")) {																									AION_ECHO("ERROR! copy(1)"); }
if (!copy("../STEPBible-Data-master-production/TBESG - Translators Brief lexicon of Extended Strongs for Greek - STEPBible.org CC BY.txt", "$studypack/Greek-Lexicon.txt")) {		AION_ECHO("ERROR! copy(2)"); }
if (!copy("../STEPBible-Data-master-production/TBESH - Translators Brief lexicon of Extended Strongs for Hebrew - STEPBible.org CC BY.txt", "$studypack/Hebrew-Lexicon.txt")) {		AION_ECHO("ERROR! copy(3)"); }
if (!copy("../STEPBible-Data-master-production/TEGMC - Translators Expansion of Greek Morphhology Codes - STEPBible.org CC BY.txt", "$studypack/Greek-Morphhology.txt")) {			AION_ECHO("ERROR! copy(4)"); }
if (!copy("../STEPBible-Data-master-production/TEHMC - Translators Expansion of Hebrew Morphology Codes - STEPBible.org CC BY.txt", "$studypack/Hebrew-Morphhology.txt")) {			AION_ECHO("ERROR! copy(5)"); }	
if (!copy("../STEPBible-Data-master-production/TFLSJ  0-5624 - Translators Formatted full LSJ Bible lexicon - STEPBible.org CC BY.txt", "$studypack/Greek-Lexicon-LSJ.txt")) {		AION_ECHO("ERROR! copy(6)"); }	
if (!copy("../STEPBible-Data-master-production/TFLSJ extra - Translators Formatted full LSJ Bible lexicon - STEPBible.org CC BY.txt", "$studypack/Greek-Lexicon-LSJ-Extra.txt")) {	AION_ECHO("ERROR! copy(7)"); }	
if (!copy("../STEPBible-Data-master-production/TIPNR - Translators Individualised Proper Names with all References - STEPBible.org CC BY.txt", "$studypack/Proper-Names.txt")) {	AION_ECHO("ERROR! copy(8)"); }	
system("zip -9 -rv ../www-resources/AB-StudyPack/$studypack.zip $studypack");
system("rm -rf $studypack");

/////////////////////////////////////////////////////////////////
// DONE
AION_ECHO("DONE");
