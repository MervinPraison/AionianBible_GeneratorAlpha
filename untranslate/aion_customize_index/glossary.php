<?php
/*** GLOSSARY - static content, except for dynamic internal href links ***/
/*
My counts differ from STEPBible TAGS
Aion	STEP=129 by including MAT6:13 and 2PE2:17, but I maintain 127
Hades	STEP=10 because 1CO15:55 is a variant, but I manually add it to match 11
*/
global $_Part;
$romans1132 = "/Bibles/English---Aionian-Bible/Romans/11";
if (empty($_Part[1])) {	$bible = "";			$usageG = "/Read";					$usageH = "/Read"; }
else {					$bible = "/$_Part[1]";	$usageG = "/Bibles/$_Part[1]/New";	$usageH = "/Bibles/$_Part[1]/Old";
	if (file_exists("./library/online/Holy-Bible---{$_Part[1]}---Aionian-Edition/045-ROM-011.json")) {
		$romans1132 = abcms_href("/Bibles{$bible}",FALSE,TRUE,"/Romans/11");
	}
}
?>
<h2 class='center'><span class='notranslate'>Aionian</span> Glossary</h2>
<p>
The  <span class='notranslate'>Aionian</span>  Bible un-translates and instead transliterates eleven special words to help us better understand the extent of God’s love for individuals and all mankind, and the nature of afterlife destinies.  The original translation is unaltered and a note is added to 64 Old Testament and 200 New Testament verses. Compare the definitions below to the <a href='<? echo abcms_href("/Strongs$bible",FALSE,TRUE,TRUE); ?>' title='Strongs Enhanced Concordance and Glossary'>Strong's Enhanced Concordance</a>.  Follow the <span class='word-blue'>blue links</span> below to study the word's usage.
<br>
</p>
<p>
<h3 class='notranslate'><i><a id="g12">Abyssos</a></i></h3>
Greek: proper noun, place<br>
Usage: <a href='<? echo abcms_href($usageG,FALSE,TRUE,'/strongs-g12'); ?>' title='Visit chapters with Strongs word usage' class='word-blue'>9 times in 3 books, 6 chapters, and 9 verses</a><br>
Strongs: <a href='<? echo abcms_href("/Strongs$bible",FALSE,TRUE,'/strongs-g12'); ?>' title='Search Strongs' class='word-blue'>g12</a><br>
Meaning:<br><div style='margin-left: 15px;'>Temporary prison for special fallen angels such as Apollyon, the Beast, and Satan.</div>
<br>
</p>
<p>
<h3 class='notranslate'><i><a id="g126">aïdios</a></i></h3>
Greek: adjective<br>
Usage: <a href='<? echo abcms_href($usageG,FALSE,TRUE,'/strongs-g126'); ?>' title='Visit chapters with Strongs word usage' class='word-blue'>2 times in Romans 1:20 and Jude 6</a><br>
Strongs: <a href='<? echo abcms_href("/Strongs$bible",FALSE,TRUE,'/strongs-g126'); ?>' title='Search Strongs' class='word-blue'>g126</a><br>
Meaning:<br><div style='margin-left: 15px;'>Lasting, enduring forever, eternal.</div>
<br>
</p>
<p>
<h3 class='notranslate'><i><a id="g165">aiōn</a></i></h3>
Greek: noun<br>
Usage: <a href='<? echo abcms_href($usageG,FALSE,TRUE,'/strongs-g165'); ?>' title='Visit chapters with Strongs word usage' class='word-blue'>127 times in 22 books, 75 chapters, and 102 verses</a><br>
Strongs: <a href='<? echo abcms_href("/Strongs$bible",FALSE,TRUE,'/strongs-g165'); ?>' title='Search Strongs' class='word-blue'>g165</a><br>
Meaning:<br><div style='margin-left: 15px;'>A lifetime or time period with a beginning and end, an era, an age, the completion of which is beyond human perception, but known only to God the creator of the aiōns, Hebrews 1:2. Never meaning simple <i>endless or infinite chronological time</i> in Koine Greek usage. Read <a href='/Aionios-and-Aidios'>Dr. Heleen Keizer and Ramelli and Konstan</a> for proofs.</div>
<br>
</p>
<p>
<h3 class='notranslate'><i><a id="g166">aiōnios</a></i></h3>
Greek: adjective<br>
Usage: <a href='<? echo abcms_href($usageG,FALSE,TRUE,'/strongs-g166'); ?>' title='Visit chapters with Strongs word usage' class='word-blue'>71 times in 19 books, 44 chapters, and 69 verses</a><br>
Strongs: <a href='<? echo abcms_href("/Strongs$bible",FALSE,TRUE,'/strongs-g166'); ?>' title='Search Strongs' class='word-blue'>g166</a><br>
Meaning:<br><div style='margin-left: 15px;'>From start to finish, pertaining to the age, lifetime, entirety, complete, or even consummate. Never meaning simple <i>endless or infinite chronological time</i> in Koine Greek usage. Read <a href='/Aionios-and-Aidios'>Dr. Heleen Keizer and Ramelli and Konstan</a> for proofs.</div>
<br>
</p>
<p>
<h3 class='notranslate'><i><a id="g1653">eleēsē</a></i></h3>
Greek: verb, aorist tense, active voice, subjunctive mood, 3rd person singular<br>
Usage: <a href='<? echo $romans1132; ?>' class='word-blue'>1 time in this conjugation, Romans 11:32</a><br>
Strongs: <a href='<? echo abcms_href("/Strongs$bible",FALSE,TRUE,'/strongs-g1653'); ?>' title='Search Strongs' class='word-blue'>g1653</a><br>
Meaning:<br><div style='margin-left: 15px;'>To have pity on, to show mercy. Typically, the subjunctive mood indicates possiblity, not certainty. However, a subjunctive in a purpose clause is a resulting action as certain as the causal action. The subjunctive in a purpose clause functions as an indicative, not an optative. Thus, the grand conclusion of grace theology in <a href='<? echo $romans1132; ?>' class='word-blue'>Romans 11:32</a> must be clarified. God's mercy on all is not a possibility, but a certainty. See <a href='https://www.ntgreek.org' target='_blank'>www.ntgreek.org</a>.</div>
<br>
</p>
<p>
<h3 class='notranslate'><i><a id="g1067">Geenna</a></i></h3>
Greek: proper noun, place<br>
Usage: <a href='<? echo abcms_href($usageG,FALSE,TRUE,'/strongs-g1067'); ?>' title='Visit chapters with Strongs word usage' class='word-blue'>12 times in 4 books, 7 chapters, and 12 verses</a><br>
Strongs: <a href='<? echo abcms_href("/Strongs$bible",FALSE,TRUE,'/strongs-g1067'); ?>' title='Search Strongs' class='word-blue'>g1067</a><br>
Meaning:<br><div style='margin-left: 15px;'>Valley of Hinnom, Jerusalem's trash dump, a place of ruin, destruction, and judgment in this life, or the next, though not eternal to Jesus' audience.</div>
<br>
</p>
<p>
<h3 class='notranslate'><i><a id="g86">Hadēs</a></i></h3>
Greek: proper noun, place<br>
Usage: <a href='<? echo abcms_href($usageG,FALSE,TRUE,'/strongs-g86'); ?>' title='Visit chapters with Strongs word usage' class='word-blue'>11 times in 5 books, 9 chapters, and 11 verses</a><br>
Strongs: <a href='<? echo abcms_href("/Strongs$bible",FALSE,TRUE,'/strongs-g86'); ?>' title='Search Strongs' class='word-blue'>g86</a><br>
Meaning:<br><div style='margin-left: 15px;'>Synonomous with <i>Sheol</i>, though in New Testament usage <i>Hades</i> is the temporal place of punishment for deceased unbelieving mankind, distinct from <i>Paradise</i> for deceased believers.</div>
<br>
</p>
<p>
<h3 class='notranslate'><i><a id="g3041"></a><a id="g4442">Limnē Pyr</a></i></h3>
Greek: proper noun, place<br>
Usage: Phrase 5 times in the New Testament<br>
Strongs: <a href='<? echo abcms_href("/Strongs$bible",FALSE,TRUE,'/strongs-g3041'); ?>' title='Search Strongs' class='word-blue'>g3041</a>
<a href='<? echo abcms_href("/Strongs$bible",FALSE,TRUE,'/strongs-g4442'); ?>' title='Search Strongs' class='word-blue'>g4442</a><br>
Meaning:<br><div style='margin-left: 15px;'>Lake of Fire, final punishment for those not named in the Book of Life, prepared for the Devil and his angels, Matthew 25:41.</div>
<br>
</p>
<p>
<h3 class='notranslate'><i><a id="h7585">Sheol</a></i></h3>
Hebrew: proper noun, place<br>
Usage: <a href='<? echo abcms_href($usageH,FALSE,TRUE,'/strongs-h7585'); ?>' title='Visit chapters with Strongs word usage' class='word-blue'>66 times in 17 books, 50 chapters, and 64 verses</a><br>
Strongs: <a href='<? echo abcms_href("/Strongs$bible",FALSE,TRUE,'/strongs-h7585'); ?>' title='Search Strongs' class='word-blue'>h7585</a><br>
Meaning:<br><div style='margin-left: 15px;'>The grave or temporal afterlife world of both the righteous and unrighteous, believing and unbelieving, until the general resurrection.</div>
<br>
</p>
<p>
<h3 class='notranslate'><i><a id="g5020">Tartaroō</a></i></h3>
Greek: proper noun, place<br>
Usage: <a href='<? echo abcms_href($usageG,FALSE,TRUE,'/strongs-g5020'); ?>' title='Visit chapters with Strongs word usage' class='word-blue'>1 time in 2 Peter 2:4</a><br>
Strongs: <a href='<? echo abcms_href("/Strongs$bible",FALSE,TRUE,'/strongs-g5020'); ?>' title='Search Strongs' class='word-blue'>g5020</a><br>
Meaning:<br><div style='margin-left: 15px;'>Temporary prison for particular fallen angels awaiting final judgment.</div>
<br>
</p>