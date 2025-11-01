<?php
/*** MAIN ***/
// Globals used and named $_var, apologies to myself and all
// COOKIES and SESSION variables are nearly eliminated to allow full HTML caching at Cloudflare!
// This is accomplished by using the webpage path/URL to carry the Parallel Bible and StrongsID flags
// This is also accomplished using javascript functions and onclick events
// See the javascript functions, onclick events, and the abcms_href() function and usage.
// EPUB
$_Path = $_Orig = trim(strtok($_SERVER['REQUEST_URI'],'?'),'/');
$_pathl = strtolower($_Path);
if (!empty($_GET['e'])) {
	if(!empty($_Path)) { abcms_notf(); }
	require 'epub.php';
	exit;
}
// DISPATCH
$_para = $_stid = $_paraC = $_stidC = $_stidN = $_stidX = $_meta = $_SwipePREV = $_SwipeNEXT = $_BibleSTRONGS = NULL;
$_Part = array(NULL);
if ($_Path=='' || $_Path=='index.php') {				$_meta = " ~ Homepage";										abcms_home(); }
else if ($_pathl=='preface') {							$_meta = " ~ Preface";										abcms_page('docs/preface.htm'); }
else if ($_pathl=='buy') {								$_meta = " ~ Buy Bibles and T-Shirts";						abcms_word_list('buy',NULL); }
else if ($_pathl=='maps') {								$_meta = " ~ Maps";											abcms_page('docs/maps.htm'); }
else if ($_pathl=='cool') {								$_meta = " ~ Cool Cup of Water";							abcms_page('docs/cool.htm'); }
else if ($_pathl=='history') {							$_meta = " ~ History";										abcms_page('docs/history.htm'); }
else if ($_pathl=='readers-guide') {					$_meta = " ~ Readers Guide";								abcms_page('docs/readers-guide.htm'); }
else if ($_pathl=='aionios-and-aidios') {				$_meta = " ~ Aiōnios and Aïdios";							abcms_page('docs/aionios-and-aidios.htm'); }
else if ($_pathl=='destiny') {							$_meta = " ~ Heaven, Hell, men, angels, demons, and Satan";	abcms_page('docs/lake-of-fire.htm'); }
else if ($_pathl=='promote') {							$_meta = " ~ Promote, Sponsor, Advertise, Market";			abcms_page('docs/promote.htm'); }
else if ($_pathl=='nainoia-inc') {						$_meta = " ~ Nainoia Inc, publisher of the Aionian Bible";	abcms_page('docs/nainoia-inc.htm'); }
else if ($_pathl=='bible-cover') {						$_meta = " ~ Aionian Bible Branded Leather Bible Covers";	abcms_page('docs/cover.htm'); }
else if ($_pathl=='privacy') {							$_meta = " ~ Privacy Policy";								abcms_page('docs/privacy.htm'); }
else if ($_pathl=='apple-ios-app') {					$_meta = " ~ Apple iOS App";								abcms_page('docs/appleiosapp.htm'); }
else if ($_pathl=='third-party-publisher-resources') {	$_meta = " ~ Third Party Publisher Resources";				abcms_page('docs/third-party-publisher-resources.htm'); }
else if (strpos($_Path, 'Debug')===0) {					$_meta = " ~ Debug";										abcms_debug(); }
else if ($_pathl=='country') {							echo "COUNTRY: ".(empty($_SERVER["HTTP_CF_IPCOUNTRY"]) ? "UNKNOWN" : $_SERVER["HTTP_CF_IPCOUNTRY"]); exit; }
else if (!preg_match('/^[a-zA-Z0-9\-\/]+$/',$_Path)) {																abcms_notf(); }
if (($number=preg_match_all("#/parallel-[^/]+#", $_Path, $matches, PREG_PATTERN_ORDER))) {
	if ($number>1) { abcms_bomb("/Read","Invalid URL Requested, multiple 'parallels' not allowed"); }
	$_para = $matches[0][0];
	$_paraC = str_replace('/parallel-','',$_para);
	$_Path = preg_replace('#/parallel-[^/]+#','',$_Path);
}
if (($number=preg_match_all("#/strongs-[^/]+#", $_Path, $matches, PREG_PATTERN_ORDER))) {
	if ($number>1) { abcms_bomb("/Read","Invalid URL Requested, multiple 'strongs' not allowed"); }
	$_stid = $matches[0][0];
	$_stidC = str_replace('/strongs-','',$_stid);
	$_Path = preg_replace('#/strongs-[^/]+#','',$_Path);
}
$_Part = explode('/',$_Path);
$_pnum = count($_Part);
abcms_stro_chek();
if ($_Path=='Read') {									$_meta = " ~ Read and Study Bible";							abcms_word_list('read',$_paraC); }
else if ($_Part[0]=='Bibles') {
	if ($_pnum==2) {									$_meta = " ~ $_Part[1] ~ Table of Contents Description";	abcms_word_tocs_detail(); }
	else if ($_pnum==3 && $_Part[2]=='Old') {			$_meta = " ~ $_Part[1] ~ Table of Contents Old Testament";	abcms_word_tocs_test('Old Testament'); }
	else if ($_pnum==3 && $_Part[2]=='New') {			$_meta = " ~ $_Part[1] ~ Table of Contents New Testament";	abcms_word_tocs_test('New Testament'); }
	else if ($_pnum==3 && $_Part[2]=='Noted') {			$_meta = " ~ $_Part[1] ~ Aionian Verses";					abcms_word_note(); }
	else if ($_pnum==3) {								$_meta = " ~ $_Part[1] ~ $_Part[2] Chapter 1";				abcms_word_chap(); }
	else if ($_pnum==4) {								$_meta = " ~ $_Part[1] ~ $_Part[2] Chapter $_Part[3]";		abcms_word_chap(); }
	else if ($_pnum==5) {								$_meta = " ~ $_Part[1] ~ $_Part[2] $_Part[3]:$_Part[4]";	abcms_word_vers(); }	
	else if ($_pnum==6) {								$_meta = " ~ $_Part[1] ~ $_Part[2] $_Part[3]:$_Part[4]-$_Part[4]"; abcms_word_chap(); }
}
else if ($_Part[0]=='Parallel' && $_pnum > 1 && $_pnum < 7) {
														$_meta = " ~ Read and Study Parallel Bible";				abcms_word_list('parallel',$_Part[1]); }
else if ($_Part[0]=='Glossary' && $_pnum < 3) {			$_meta = " ~ Glossary";										abcms_glos(); }
else if ($_Part[0]=='Strongs'  && $_pnum < 3) {			$_meta = " ~ Strongs Concordance Glossary $_stidC";			abcms_stro(); }
else if ($_Part[0]=='Publisher'&& !$_para && $_pnum<6){	$_meta = " ~ Publisher";									abcms_mail(); }
else if ($_Part[0]=='CAPTCHA' && $_pnum == 2) {			$_meta = "";												abcms_mail_captcha(); }
else if ($_Part[0]=='Verse') {
	if ($_pnum==2 && $_Part[1]=='Questioned'){			$_meta = " ~ Questioned Verses";							abcms_word_vers_questioned(); }
	else if ($_pnum==3 && $_Part[1]=='All'){			$_meta = " ~ $_Part[2] 1:1";								abcms_word_vers_all(); }
	else if ($_pnum==4 && $_Part[1]=='All'){			$_meta = " ~ $_Part[2] $_Part[3]:1";						abcms_word_vers_all(); }
	else if ($_pnum==5 && $_Part[1]=='All'){			$_meta = " ~ $_Part[2] $_Part[3]:$_Part[4]";				abcms_word_vers_all(); }
}
abcms_notf();
exit;



/*** HOME ***/
function abcms_home() {
abcms_html();
$modified = date("n/j/Y", filemtime("./index.php"));
?>
<div id='home'>
<div id='vert'>
<div id='horz'>
<a href='/Preface' onclick='return AionianBible_Bookmark("/Preface");'>
<div id='butt'>
<h2>Welcome to the <i>Holy&nbsp;Bible&nbsp;Aionian&nbsp;Edition<span class='RegisteredTM'>®</span></i></h2>
<div id='logo'><img src='/images/Holy-Bible-Aionian-Edition-PURPLE-HOME.png' alt='Aionian Bible'></div>
<div id='j316'>For God so loved the world,<br>that he gave his only begotten Son,<br>that whoever believes in him<br>should not perish, but have...</div>
<div id='aion'>Aionian Life!</div>
<div id='moto'>
The world's first Holy Bible <u>untranslation</u><br>
Two hundred ninety-one languages<br>
Five hundred thirty-eight versions<br>
9,594,853 Scripture verses total<br>
Anonymous on TOR network<br>
100% free to copy &amp; print<br>
Updated <? echo $modified; ?><br>
<br>
Also known as 'The Purple Bible'
</div>
</div>
</a>
</div>
</div>
</div>
<div id='icon'>
<a href='/Facebook'		target='_blank' title='Facebook/AionianBible'>	<img src='/images/Aionian-Bible-Facebook.png' alt='Facebook' title='Aionian Bible on Facebook'></a>
<a href='/X'			target='_blank' title='X/AionianBible Twitter'>	<img src='/images/Aionian-Bible-X.png' alt='X/Twitter' title='Aionian Bible on X/Twitter'></a>
<a href='/LinkedIn'		target='_blank' title='LinkedIn/AionianBible'>	<img src='/images/Aionian-Bible-LinkedIn.png' alt='LinkedIn' title='Aionian Bible on LinkedIn'></a>
<a href='/Instagram'	target='_blank' title='Instagram/AionianBible'>	<img src='/images/Aionian-Bible-Instagram.png' alt='Instagram' title='Aionian Bible on Instagram'></a>
<a href='/Pinterest'	target='_blank' title='Pinterest/AionianBible'>	<img src='/images/Aionian-Bible-Pinterest.png' alt='Pinterest' title='Aionian Bible on Pinterest'></a>
<a href='/YouTube'		target='_blank' title='YouTube/AionianBible'>	<img src='/images/Aionian-Bible-Youtube.png' alt='YouTube' title='Aionian Bible on Youtube'></a>
<a href='/Google-Play'	target='_blank' title='GooglePlay/AionianBible'><img src='/images/Aionian-Bible-GooglePlay.png' alt='GooglePlay' title='Aionian Bible on GooglePlay'></a>
<a href='/TOR'			target='_blank' title='TOR/AionianBible'>		<img src='/images/Aionian-Bible-TOR.png' alt='TOR' title='Aionian Bible on The Onion Router network'></a>
<a href='/EmailNews'	target='_blank' title='EmailNews/AionianBible'>	<img src='/images/Aionian-Bible-Button-Your-Gift-Email-Newsletter.png' alt='EmailNews' title='Aionian Bible Gift and Newsletter'></a>
<a href='/Buy' title='Buy Aionian Bibles and T-Shirts'>					<img src='/images/Aionian-Bible-Button-Buy-Square.png' alt='Buy Bibles' title='Buy Aionian Bible in print'></a>
</div>
<script>AionianBible_SwipeLinks('','');</script>
<? abcms_jsonld(TRUE); ?>
</body>
</html>
<?
if (0 && empty($_COOKIE['AionianBible_Bookmark']) && !preg_match('/bot|crawl|slurp|spider|curl|mediapartners/i', getenv('HTTP_USER_AGENT'))) {
	$ip = getenv('HTTP_CLIENT_IP')?: getenv('HTTP_X_FORWARDED_FOR')?: getenv('HTTP_X_FORWARDED')?: getenv('HTTP_FORWARDED_FOR')?: getenv('HTTP_FORWARDED')?: getenv('REMOTE_ADDR')?: 'UNKNOWN';
	$re = getenv('HTTP_REFERER')?: 'UNKNOWN';
	file_put_contents('./datawebs/HITS.dat',"\n".date('Y/m/d H:i:s',time())."\t".$ip."\t".$re,FILE_APPEND | LOCK_EX);
}
exit;
}



/*** NOTF ***/
function abcms_notf() {
abcms_html(FALSE);
abcms_head('',FALSE);
?>
<h2 class=center>Page Not Found</h2>
<p>The page was not found.<br><br><a href='/Read' title='Read and Study Bible'>Please choose a Bible to continue</a>.</p>
<?
abcms_tail(FALSE);
}



/*** PAGE ***/
function abcms_page($page,$header='',$goodpage=TRUE) {
abcms_html($goodpage);
abcms_head($header,$goodpage);
readfile($page);
abcms_tail();
}



/*** GLOSSARY ***/
function abcms_glos() {
global $_pnum;
if ($_pnum===2) { abcms_word_init(); }
abcms_word_init_para();
abcms_html();
abcms_head();
require 'glossary.php';
abcms_tail();
}



/*** DEBUG ***/
function abcms_debug() {
abcms_html();
abcms_head();
require 'debug.php';
abcms_tail();
}



/*** MAIL ***/
function abcms_mail() {
global $_pnum;
$nainoia = <<<EOF
<h2>Publisher</h2>
<span class='notranslate'>Nainoia, Inc.</span><br>
PO Box 462, Bellefonte, PA 16823<br>
<a href="tel:814-470-8028" rel="nofollow">(814) 470-8028</a><br>
<a href='/Nainoia-Inc' title='Nainoia Inc, Publisher'>Nainoia Inc, Publisher</a><br>
<a href='https://www.linkedin.com/company/nainoia-inc' target='_blank' title='Nainoia Inc @ LinkedIn'>LinkedIn/NAINOIA-INC</a><br>
<a href='/Third-Party-Publisher-Resources' title='Third Party Publisher Resources'>Third Party Publisher Resources</a><br>
<a href='/AB-CUSTOM-VERSES.txt' target='_blank' title='Request Custom Formatted Verses'>Request Custom Formatted Verses</a><br>
<br>
<form action="https://www.paypal.com/donate" method="post" target="_top">
<input type="hidden" name="hosted_button_id" value="PNHVLFLK5B77E">
<input type="image" src="/images/Aionian-Bible-Button-Donate.png" name="submit" title="PayPal - The safer, easier way to donate online!" alt="Donate at PayPal">
</form>
EOF;
// skipit
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on' || (int)$_SERVER['SERVER_PORT'] !== 443) {
	abcms_html();
	abcms_head();
	echo "<div id='mail'>$nainoia</div>";
	abcms_tail();
}
// doit
if ($_pnum===2 && $_SERVER['REQUEST_METHOD']!='POST') { abcms_bomb("/Publisher","Invalid URL Requested for Publisher form"); }
session_start();
$gotall = (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['message']) && !empty($_POST['submit']) ? TRUE : FALSE);
$captcha_pass = (empty($_POST['captcha']) && !empty($_POST['company']) && !empty($_SESSION['captcha2']) && !empty($_SESSION['captcha3']) && strtolower($_POST['company'])=='replace asteriks with captcha ['.$_SESSION['captcha2'].$_SESSION['captcha3'].']' ? TRUE : FALSE);
if($gotall && $captcha_pass) {
	// START
	abcms_html();
	abcms_head();
	// SANITIZE
	$input_name = aion_strip($_POST['name']);
	$input_email = aion_strip($_POST['email']);
	$input_subject = aion_strip($_POST['subject']);
	$input_message = aion_strip($_POST['message']);
	if (strlen($input_name)>100 ||
		!filter_var($input_email, FILTER_VALIDATE_EMAIL) ||
		strlen($input_subject)>500 ||
		strlen($input_message)>20000) {
		echo "<div id='mail'>Messages cannot contain HTML code or be too long.<br>Please contact Nainoia Inc via mail.";
	}
	// SECURITY
	else if ($_SERVER['REQUEST_METHOD']!='POST' || $_POST['submit']!='Submit' || empty($_POST['csrf']) || empty($_SESSION['csrf']) || $_POST['csrf']!=$_SESSION['csrf']) {
		echo "<div id='mail'>There was a problem sending your message.<br>Please contact Nainoia Inc via mail.";
		abcms_errs("abcms_mail() suspect form submission!");
	}
	// GOOD
	else {
		$input_name = trim($input_name);
		$input_email = trim($input_email);
		$input_message = trim($input_message);
		$ip = getenv('HTTP_CLIENT_IP')?: getenv('HTTP_X_FORWARDED_FOR')?: getenv('HTTP_X_FORWARDED')?: getenv('HTTP_FORWARDED_FOR')?: getenv('HTTP_FORWARDED')?: getenv('REMOTE_ADDR')?: 'UNKNOWN';
		$output = "\n".date("m/d/Y H:m:s")."\t".$ip."\t".$input_name."\t".$input_email."\t".$input_message;
		$logged = (!file_put_contents('./datawebs/EMAIL.dat', $output, FILE_APPEND | LOCK_EX) ? ' (*log failed*)' : ' (logged)' );
		$subject = "[Aionian Bible] $input_subject";
		$message = "Message from $input_name at $ip with $input_email: $logged\n\n$input_message\n\n\n\n\nDelivered by https://www.AionianBible.org";
		$headers = "From: <$input_email>\r\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: 8bit";
		mail("escribes@aionianbible.org",$subject,$message,$headers);
		// ABCOMMAND
		if ($input_subject == 'AB-CUSTOM-VERSES') {	abcms_abcommand_multiple(trim($_POST['message'])); }
		// EMAIL
		else {
			echo "<div id='mail'>$nainoia Thank you $input_name!<br>Your message has been received.<br>We will contact you shortly.";
		}
	}
	unset($_SESSION['csrf']);
}
else {
	// START
	abcms_mail_fix($status, $_POST['subject'], $_POST['message']);
	abcms_html();
	abcms_head();
	echo "<div id='mail'>";
	// FORM
	$val_name = (empty($_POST['name']) ? '' : aion_strip($_POST['name']));
	$val_email = (empty($_POST['email']) ? '' : aion_strip($_POST['email']));
	$val_subject = (empty($_POST['subject']) ? '' : aion_strip($_POST['subject']));
	$val_message = (empty($_POST['message']) || $val_subject=='AB-CUSTOM-VERSES' ? '' : aion_strip($_POST['message']));
	if (empty($status) && $_SERVER['REQUEST_METHOD']=='POST') {
		if (!$gotall) {				$status = '( please submit with all fields completed )<br><br>'; }
		else if (!$captcha_pass) {	$status = '( please replace asteriks with Captcha [******] )<br><br>'; }
	}
	echo "$nainoia Please contact us below<br><span class='form-status'>$status</span>";	
?>
<form action='/Publisher/<?php echo hash('sha256','AionianBible.org/Publisher/Submit'.time().random_bytes(7)); ?>' method='post' accept-charset='UTF-8'>
<input type='hidden' name='csrf' value='<?php echo ($_SESSION['csrf'] = hash('sha256','AionianBible.org/Publisher'.time().random_bytes(10))); ?>'>
<input type='text' name='name' placeholder='Name' value="<? echo $val_name;?>">
<input type='email' name='email' placeholder='Email' value="<? echo $val_email;?>">
<input type='text' name='subject' placeholder='Subject' value="<? echo $val_subject;?>">
<textarea name='message' placeholder='Comment or question, 1000 character maximum' rows='15'><? echo $val_message;?></textarea>
<input type='text' name='company' value="<? echo 'Replace asteriks with Captcha [******]';?>">
<input type='text' name='captcha' id='captcha' placeholder='Enter Captcha'>
<div class='captcha'><img src='/CAPTCHA/<?php echo mb_rand('l'); ?>' alt='Captcha' title='Captcha' id='lcaptcha_image'><img src='/CAPTCHA/<?php echo mb_rand('2'); ?>' alt='Captcha' title='Captcha' id='2captcha_image'><img src='/CAPTCHA/<?php echo mb_rand('3'); ?>' alt='Captcha' title='Captcha' id='3captcha_image'> <a href='javascript: AionianBible_RefreshCaptcha();'>Refresh Captcha</a></div>
<input type='submit' name='submit' value='Submit'>
</form>
<?
}
echo '</div>';
abcms_tail();
}
/*** CAPTCHA ***/
function abcms_mail_captcha() {
// setup
global $_Part;
session_start();
$captcha_code = '';
$captcha_image_height = 75;
$captcha_image_width = 180;
$total_characters_on_image = 3;
$random_captcha_dots = 50;
$random_captcha_lines = 25;
$captcha_text_color = "0x142864";
$captcha_noise_color = "0x142864";
// avoid all confusing characters and numbers (For example: l, 1 and i)
$possible_captcha_letters = strtolower('bcdfhjkmnpqrstwxy345678');
function random_font($dir) {
    $files = glob($dir . '/*.ttf');
    $file = array_rand($files);
    return $files[$file];
}
$captcha_font = random_font('../captchafonts');
// captcha string
$count = 0;
while ($count < $total_characters_on_image) { 
	$captcha_code .= substr($possible_captcha_letters, mt_rand(0, strlen($possible_captcha_letters)-1), 1);
	$count++;
}
// captcha image
$captcha_font_size = $captcha_image_height * 0.65;
$captcha_image = @imagecreate($captcha_image_width,	$captcha_image_height);
// setting the background, text and noise colours here
$background_color = imagecolorallocate($captcha_image, 255, 255, 255 );
function hextorgb($hexstring){
	$integar = hexdec($hexstring);
	return array("red" => 0xFF & ($integar >> 0x10),"green" => 0xFF & ($integar >> 0x8),"blue" => 0xFF & $integar);
}
$array_text_color = hextorgb($captcha_text_color);
$captcha_text_color = imagecolorallocate($captcha_image, $array_text_color['red'], $array_text_color['green'], $array_text_color['blue']);
$array_noise_color = hextorgb($captcha_noise_color);
$image_noise_color = imagecolorallocate($captcha_image, $array_noise_color['red'], $array_noise_color['green'], $array_noise_color['blue']);
// Generate random dots in background of the captcha image
for( $count=0; $count<$random_captcha_dots; $count++ ) {
	imagefilledellipse($captcha_image, mt_rand(0,$captcha_image_width), mt_rand(0,$captcha_image_height), 2, 3, $image_noise_color);
}
// Generate random lines in background of the captcha image
for( $count=0; $count<$random_captcha_lines; $count++ ) {
	imageline($captcha_image, mt_rand(0,$captcha_image_width), mt_rand(0,$captcha_image_height), mt_rand(0,$captcha_image_width), mt_rand(0,$captcha_image_height), $image_noise_color);
}
// Create a text box and add 6 captcha letters code in it
$text_box = imagettfbbox($captcha_font_size, 0, $captcha_font, $captcha_code); 
$x = ($captcha_image_width - $text_box[4])/2;
$y = ($captcha_image_height - $text_box[5])/2;
imagettftext($captcha_image, $captcha_font_size, 0, $x, $y, $captcha_text_color, $captcha_font, $captcha_code );
// define the image type to be shown in browser widow
header('Content-Type: image/jpeg'); 
imagejpeg($captcha_image);
imagedestroy($captcha_image);
// return captcha
$_SESSION['captcha'.$_Part[1][0]] = $captcha_code;
exit;
}
function mb_rand($x) { return $x.'l23'.mt_rand(); }



/*** SANITIZE ***/
function aion_strip($raw) {
return str_replace(array('<','>'), array('(',')'), preg_replace("/<[^<>]+>/us",'',$raw));
}



/*** MAIL ***/
function abcms_mail_fix(&$status, &$subject, &$message) {
global $_Path, $_Part, $_pnum, $_BibleONE, $_BibleCHAP1, $_BibleCHAP1_Last;
if ($_pnum < 3 || !empty($subject) || !empty($message)) { return; }
if ($_pnum > 5 ) { abcms_bomb("/Read","Invalid URL Requested, too many path components"); }
abcms_word_init();
abcms_word_init_chap();
$status = "Submit your proposed corrections";
$subject = "Proposed corrections to the ".$_BibleONE['T_VERSIONS']['NAMEENGLISH'].", $_Part[2] ";
$theurl =   "https://www.AionianBible.org/".preg_replace("#Publisher\/#","Bibles/",$_Path);
$message = <<<EOT
I understand that the Aionian Bible republishes public domain and Creative Commons Bible texts and that volunteers may be needed to present the original text accurately.  I also understand that apocryphal text is removed and most variant verse numbering is mapped to the English standard. I have entered my corrections under the verse(s) below.


EOT;
if ($_pnum == 5) {
	if (!ctype_digit($_Part[4]) || ($_Part[4]=intval($_Part[4]))<1 || $_Part[4]>$_BibleCHAP1_Last || empty($_BibleCHAP1[$_Part[4]])) {
		abcms_bomb("/Bibles/$_Part[1]","The Bible book chapter verse requested was not found");
	}
	$subject .= ($_Part[3].":".$_Part[4]);
	$message .= ("$subject\n$theurl\n\n$_Part[4]) ".$_BibleCHAP1[$_Part[4]])."\n\n";
}
else {
	$subject .= ("Chapter ".$_Part[3]);
	$message .= "$subject\n$theurl\n\n";
	for ($x=1; $x<=$_BibleCHAP1_Last; ++$x) {
		$number = (empty($_BibleONE['T_NUMBERS'][$x]) || $x==$_BibleONE['T_NUMBERS'][$x] ? '' : ' '.$_BibleONE['T_NUMBERS'][$x]);
		$text = (empty($_BibleCHAP1[$x]) ? '' : $_BibleCHAP1[$x]);
		$message .= "$x$number) $text\n\n";
	}
}
$message .= "Additional comments?";
}



/*** HREF, this works cause paths of /Bibles/*, /Parallel/*, /Strongs/*, /Parallel/*, and /Glossary/* are similar! ***/
// TRUE, 'add',			Add string to $_Path
// 'replace', TRUE,		Replace first word in $_Path
// 'replace', 'path'	Replace first word in 'path'
// 'path', FALSE		Just use path
function abcms_href($root,$path,$para,$stid) {
global $_Path, $_para, $_stid;
return	($root===TRUE ? '/'.$_Path.$path : ($path===TRUE ? preg_replace('/^[a-zA-Z]+([\/]{0,1})/',$root."$1",$_Path) : ($path && $root ? preg_replace('/^[a-zA-Z]+([\/]{0,1})/',$root."$1",$path) : $root))).
		($para===TRUE ? $_para : ($para ? $para : '')).
		($stid===TRUE ? $_stid : ($stid ? $stid : ''));
}



/*** WORD LIST ***/
function abcms_word_list($mode,$current) {
if (!is_array(($bible_ALL = json_decode(file_get_contents('./library/Holy-Bible---AAA---Versions.json'),true)))) {
	abcms_bomb("/Publisher","The Bibles are unavailable",TRUE);
}
abcms_html();
abcms_head();
echo "<div id='word'>\n";
if ($mode=='buy') {			readfile('docs/buy.htm'); }
else if ($mode=='read') {	echo "<h2 class=center>Bibles Free / <a href='/Buy' title='Buy Bibles at Amazon, Lulu, and Lightning Source'>Buy</a></h2>"; }
else {						echo "<h2 class=center>Parallel Bibles</h2>"; }
echo "<div class='center' id='word-quick'>";
$last = NULL;
foreach( $bible_ALL as $bible => $version ) {
	if($last!=$version['LANGUAGEENGLISH'][0]) {	$last=$version['LANGUAGEENGLISH'][0]; echo "<a href='#Language_$last' title='Languages beginning with $last'>$last</a>"; }
}
echo "</div>\n";
$last = NULL;
$count=1;
$bible_ALL = array( 'Holy-Bible---English---Aionian-Bible2' => $bible_ALL['Holy-Bible---English---Aionian-Bible']) + $bible_ALL;
foreach( $bible_ALL as $bible => $version ) {
	$bible = str_replace('Holy-Bible---','',$bible);
	$bible = ($bible == 'English---Aionian-Bible2' ? 'English---Aionian-Bible' : $bible);
	$stripe = ($count%2==0?'even':'odd'); ++$count;
	$highlight = ($bible == 'English---Aionian-Bible' ? 'aionian-bible' : '');
	$recommended = ($bible == 'English---Aionian-Bible' ? ' ( recommended )' : '');
	$bible_lang = "<span lang='".$version['LANGUAGECODEISO']."' class='".$version['LANGUAGECSS']."'>";
	$language = "<span lang='en' class='eng'>".$version['LANGUAGEENGLISH']."</span>";
	$language .= ( $version['LANGUAGE']==$version['LANGUAGEENGLISH'] ? '' : ' ( '.$bible_lang.$version['LANGUAGE'].'</span> )' );
	if($last!=$version['LANGUAGEENGLISH'][0] && $bible != 'English---Aionian-Bible') {
		$last=$version['LANGUAGEENGLISH'][0];
		$quick_id = "id='Language_$last'";
	}
	else {
		$quick_id = "";
	}
	$name = "<span lang='en' class='eng'>".$version['NAMEENGLISH']."$recommended</span>";
	$name .= ( $version['NAME']==$version['NAMEENGLISH'] ? '' : ' ( '.$bible_lang.$version['NAME'].'</span> )' );
	if ($mode=='buy') {
		$title = 'BUY Holy Bible Aionian Edition: '.str_replace("'", "", $version['NAMEENGLISH']);
		echo "<div class='word-buy $stripe $highlight' $quick_id><a href='".abcms_href('/Bibles/'.$bible,FALSE,TRUE,TRUE)."' title='Bible Table of Contents'>".$language." ~ ".$name."</a>";
		$buylinks  = ($version['AMAZON']=='NULL'		? '' : "<a href='https://www.amazon.com/dp/".$version['AMAZON']."'		target='_blank' title='$title'>Amazon</a>, ");
		$buylinks .= ($version['AMAZONNT']=='NULL'		? '' : "<a href='https://www.amazon.com/dp/".$version['AMAZONNT']."'	target='_blank' title='$title'>Amazon NT</a>, ");
		$buylinks .= ($version['AMAZONJOHN']=='NULL'	? '' : "<a href='https://www.amazon.com/dp/".$version['AMAZONJOHN']."'	target='_blank' title='$title'>Amazon Gospel Primer</a>, ");
		$buylinks .= ($bible!='English---Aionian-Bible'	? '' : "<a href='https://www.amazon.com/dp/B084DHWQXL'	target='_blank' title='$title'>Amazon 22 Special</a>, ");
		$buylinks .= ($version['LULU']=='NULL'			? '' : "<a href='".$version['LULU']		."' target='_blank' title='$title'>Lulu</a>, ");
		$buylinks .= ($version['LULUHARD']=='NULL'		? '' : "<a href='".$version['LULUHARD']	."' target='_blank' title='$title'>Lulu Hardcover</a>, ");
		$buylinks .= ($version['LULUNT']=='NULL'		? '' : "<a href='".$version['LULUNT']	."' target='_blank' title='$title'>Lulu NT</a>, ");
		$buylinks .= ($version['LULUJOHN']=='NULL'		? '' : "<a href='".$version['LULUJOHN']	."' target='_blank' title='$title'>Lulu Gospel Primer</a>, ");
		$buylinks .= ($bible!='English---Aionian-Bible'	? '' : "<a href='https://www.lulu.com/shop/-nainoia-inc/holy-bible-aionian-edition-aionian-bible-22-book-digest-special-edition/paperback/product-1qkg7e89.html'	target='_blank' title='$title'>Lulu 22 Special</a>, ");
		$buylinks .= ($version['BUYOTHER']=='NULL'		? '' : "<a href='".$version['BUYOTHER']	."' target='_blank' title='$title'>{$version['BUYOTHER']}</a>");
		$buylinks = trim($buylinks,', ');
		if (!empty($buylinks)) { echo "<br><span class='buylinks'>Buy at $buylinks</span>"; }
		else { echo "<br><span class='buylinks'>Print not available</span>"; }
		echo "</div>";
	}
	else if ($current==$bible) {echo "<div class='word-bible $stripe $highlight' $quick_id><a href='".abcms_href('/Bibles/'.$bible,FALSE,FALSE,TRUE)."' title='Bible Table of Contents'>".$language." ~ ".$name."</a></div>\n"; }
	else if ($mode=='read') {	echo "<div class='word-bible $stripe $highlight' $quick_id><a href='".abcms_href('/Bibles/'.$bible,FALSE,TRUE,TRUE)."' title='Bible Table of Contents'>".$language." ~ ".$name."</a></div>\n"; }
	else {						echo "<div class='word-bible $stripe $highlight' $quick_id><a href='".abcms_href('/Bibles',TRUE,'/parallel-'.$bible,TRUE)."'>".$language." ~ ".$name."</a></div>\n"; }
}
echo "</div>\n";
abcms_tail();
}




/*** BOMB ***/
function abcms_bomb($path,$mess,$log=FALSE,$nopage=FALSE) {
if ($log) { abcms_errs("abcms_bomb() $mess"); }
if ($nopage) { return $mess; }
abcms_html(FALSE);
abcms_head('',FALSE);
echo "<div id='word'><h2 class=center>Bibles</h2>$mess<br><br>";
if ($path=='/Read') {					echo "<a href='/Read' title='Read and Study Bible'>Choose a Bible to continue</a>"; }
if (strpos($path,'/Bibles/')===0) {		echo "<a href='$path' title='Read and Study Bible'>Choose a Bible Book and Chapter to continue</a>"; }
echo "<br><br><a href='/Publisher' title='Contact Nainoia Inc'>Contact the publisher for further help</a><br><br></div>";
abcms_tail(FALSE);
}



/*** WORD INIT ***/
function abcms_word_init($nopage=FALSE) {
global $_Part;
global $_BibleONE, $_BibleONE_Lang, $_BibleBOOKS;
if (!file_exists('./library/Holy-Bible---'.$_Part[1].'---Aionian-Edition.json') ||
	!is_array(($_BibleONE = @json_decode(file_get_contents('./library/Holy-Bible---'.$_Part[1].'---Aionian-Edition.json'),true))) ||
	empty($_BibleONE['T_BOOKS'])) {
	return abcms_bomb("/Read","The Bible requested was not found",FALSE,$nopage);
}
$rtl = (empty($_BibleONE['T_VERSIONS']['RTL']) ? "" : "dir='rtl'" );
$_BibleONE_Lang = "<span lang='".$_BibleONE['T_VERSIONS']['LANGUAGECODEISO']."' $rtl class='".$_BibleONE['T_VERSIONS']['LANGUAGECSS'];
if (!is_array(($_BibleBOOKS = json_decode(file_get_contents('./library/Holy-Bible---AAA---Books.json'),true)))) {
	return abcms_bomb("/Read","The Bible book list is unavailable",TRUE,$nopage);
}
return TRUE;
}



/*** WORD INIT PARA ***/
function abcms_word_init_para() {
global $_paraC, $_BibleTWO, $_BibleTWO_Lang, $_BibleTWO_xLink;
$ppath = abcms_href('/Parallel',TRUE,FALSE,TRUE);
$_BibleTWO_xLink = "<a href='$ppath' title='Read and Study Parallel Bible' class='word-tocs'>PARA</a>";
if (!empty($_paraC)) {
	if (!file_exists('./library/Holy-Bible---'.$_paraC.'---Aionian-Edition.json') ||
		!is_array(($_BibleTWO = json_decode(file_get_contents('./library/Holy-Bible---'.$_paraC.'---Aionian-Edition.json'),true)))) {
		abcms_bomb("/Read","The Parallel Bible requested was not found");
	}
	$rtl2 = (empty($_BibleTWO['T_VERSIONS']['RTL']) ? "" : "dir='rtl'" );
	$bpath = abcms_href(TRUE,'',FALSE,TRUE);
	$_BibleTWO_Lang = "<span lang='".$_BibleTWO['T_VERSIONS']['LANGUAGECODEISO']."' $rtl2 class='".$_BibleTWO['T_VERSIONS']['LANGUAGECSS'];
	$_BibleTWO_xLink = "<span class='word-tocs word-book notranslate'><a href='$ppath' title='Read and Study Parallel Bible'>".$_BibleTWO['T_VERSIONS']['SHORT']."</a><a href='$bpath' title='Cancel Parallel Bible study' class='navx'><span class='navx'>X</span></a></span>";
}
}



/*** WORD INIT CHAP ***/
function abcms_word_init_chap($quickreturn=FALSE,$nopage=FALSE) {
global $_Part, $_stid, $_paraC;
global $_BibleONE, $_BibleBOOKS;
global $_BibleCHAP1, $_BibleCHAP1_Last, $_BibleCHAP2_Last, $_BibleTWO, $_BibleCHAP2, $_BibleTWO_Lang, $_BibleTWO_xLink;
if (empty($_BibleONE['T_BOOKS'][$_Part[2]]) || empty($_BibleBOOKS[$_Part[2]]['NUMBER']) || empty($_BibleBOOKS[$_Part[2]]['CODE'])) {
	if ($quickreturn) { return FALSE; }
	return abcms_bomb("/Bibles/$_Part[1]","The Bible book requested was not found",FALSE,$nopage);
}
if (empty($_Part[3])) { $_Part[3] = 1; }
else if (is_string($_Part[3])) {
	if ($_Part[3][0]=='0' || !ctype_digit($_Part[3])) {
		if ($quickreturn) { return FALSE; }
		return abcms_bomb("/Bibles/$_Part[1]","The Bible book chapter requested was not found",FALSE,$nopage);
	}
	$_Part[3] = intval($_Part[3]);
}
else { $_Part[3] = (int)$_Part[3]; }
if (0==$_Part[3] || $_Part[3]>(int)$_BibleBOOKS[$_Part[2]]['CHAPTERS']) {
	if ($quickreturn) { return FALSE; }
	return abcms_bomb("/Bibles/$_Part[1]","The Bible book chapter requested was not found",FALSE,$nopage);
}
$_BibleCHAP1 = json_decode(file_get_contents('./library/online/Holy-Bible---'.$_Part[1].'---Aionian-Edition/'.$_BibleBOOKS[$_Part[2]]['NUMBER'].'-'.$_BibleBOOKS[$_Part[2]]['CODE'].'-'.sprintf('%03d', $_Part[3]).'.json'),true);
if (empty($_BibleCHAP1) || !is_array($_BibleCHAP1)) {
	if ($quickreturn) { return FALSE; }
	return abcms_bomb("/Bibles/$_Part[1]","The Bible chapter is unavailable",TRUE,$nopage);
}
end($_BibleCHAP1);
$_BibleCHAP1_Last = key($_BibleCHAP1);
$_BibleCHAP2_Last = FALSE;
$ppath = abcms_href('/Parallel',TRUE,FALSE,TRUE);
$_BibleTWO_xLink = "<a href='$ppath' title='Read and Study Parallel Bible' class='word-tocs'>PARA</a>";
if (!$quickreturn && !empty($_paraC)) {
	if (!file_exists('./library/Holy-Bible---'.$_paraC.'---Aionian-Edition.json') ||
		!is_array(($_BibleTWO = json_decode(file_get_contents('./library/Holy-Bible---'.$_paraC.'---Aionian-Edition.json'),true)))) {
		return abcms_bomb("/Read","The requested Parallel Bible was not found",FALSE,$nopage);
	}
	if (!empty($_BibleTWO['T_BOOKS'][$_Part[2]])) {
		$_BibleCHAP2 = json_decode(file_get_contents('./library/online/Holy-Bible---'.$_paraC.'---Aionian-Edition/'.$_BibleBOOKS[$_Part[2]]['NUMBER'].'-'.$_BibleBOOKS[$_Part[2]]['CODE'].'-'.sprintf('%03d', $_Part[3]).'.json'),true);
		if (is_array($_BibleCHAP2) && !empty($_BibleCHAP2)) { end($_BibleCHAP2); $_BibleCHAP2_Last = key($_BibleCHAP2); }
		else { abcms_errs("abcms_word_init_chap() bible chapter not found!"); }
	}
	$rtl2 = (empty($_BibleTWO['T_VERSIONS']['RTL']) ? "" : "dir='rtl'" );
	$bpath = abcms_href(TRUE,'',FALSE,TRUE);
	$_BibleTWO_Lang = "<span lang='".$_BibleTWO['T_VERSIONS']['LANGUAGECODEISO']."' $rtl2 class='".$_BibleTWO['T_VERSIONS']['LANGUAGECSS'];
	$_BibleTWO_xLink = "<span class='word-tocs word-book notranslate'><a href='$ppath' title='Read and Study Parallel Bible'>".$_BibleTWO['T_VERSIONS']['SHORT']."</a><a href='$bpath' title='Cancel Parallel Bible study' class='navx'><span class='navx'>X</span></a></span>";
}
// STRONGS
if (!$quickreturn && $_stid) {	abcms_word_init_chap_stro((int)$_BibleBOOKS[$_Part[2]]['NUMBER'], $_Part[3], NULL); }
return TRUE;
}



/*** WORD INIT CHAP ***/
function abcms_word_init_chap_stro($bnum, $chap, $vers) {
global $_BibleSTRONGS;
$fd = NULL;
$indx = ($bnum<40 ? './library/stepbible/Hebrew_Tagged_Text_Index.json'	: './library/stepbible/Greek_Tagged_Text_Index.json');
$file = ($bnum<40 ? './library/stepbible/Hebrew_Tagged_Text.txt'		: './library/stepbible/Greek_Tagged_Text.txt');
$keys = "$bnum.$chap:".($vers===NULL ? 1 : $vers);
if (!($json = json_decode(file_get_contents($indx),true)) ||
	!isset($json[$keys]) ||
	!($fd=fopen($file, 'r')) ||
	fseek($fd, $json[$keys])) {
		if ($fd) { fclose($fd); }
		// only report error if error, allow for non-standard versification
		if (!$json || isset($json[$keys])) { abcms_errs("abcms_word_init_chap_stro() strongs bible chapter tag lines not found!"); }
		$_BibleSTRONGS = NULL;
		return;
}
$_BibleSTRONGS = array();
while(($line=fgets($fd))) {
	$line = rtrim($line,"\r\n");
	if (!($parts = mb_split("\t", $line)) ||
		count($parts)!=18 ||
		empty($parts[0]) ||
		empty($parts[2]) ||
		empty($parts[3]) ||
		!preg_match("#^([GH]{1}[\d]{1,5})([A-Za-z]{0,1})$#ui",$parts[4],$match)) {
		fclose($fd);
		abcms_errs("abcms_word_init_chap_stro() strongs bible chapter tag lines corrupt! $line");
		$_BibleSTRONGS = NULL;
		return;		
	}
	// done with book, chapter, or verse
	if ((int)$parts[0] != $bnum || (int)$parts[2] != $chap || ($vers!==NULL && (int)$parts[3] != $vers)) { break; }
	// contains whole chapter of strongs usage!
	$bald = lcfirst($match[1]);
	$parts[4] = $bald . $match[2]; // [gh]\d+(case-sensitive)
	if ($vers===NULL) {
		$_BibleSTRONGS[(int)$parts[3]][$parts[4]] = TRUE; // flag strong extended always
		if (!empty($match[2])) { $_BibleSTRONGS[(int)$parts[3]][$bald] = TRUE; } // flag bald strongs if needed
		continue;
	}
	// -OR- contains whole verse of strongs tags!
	$_BibleSTRONGS[] = $parts;
}
fclose($fd);
if (empty($_BibleSTRONGS)) {
	abcms_errs("abcms_word_init_chap_stro() strongs bible chapter lines not found! $indx, $file, $bnum, $chap, $vers");
}
return;
}



/*** WORD TOCS MENU ***/
function abcms_word_tocs_menu($testament, &$tocmenu) {
global $_Part, $_paraC, $_stidC;
global $_BibleONE, $_BibleBOOKS, $_BibleTWO, $_BibleTWO_xLink, $_BibleTWO_Lang;
end($_BibleONE['T_BOOKS']);		$last  = $_BibleBOOKS[key($_BibleONE['T_BOOKS'])]['NUMBER'];	if ('New Testament'==$testament && $last <= 39) {	exit(header("Location: /Bibles/$_Part[1]",true,301)); }
reset($_BibleONE['T_BOOKS']);	$first = $_BibleBOOKS[key($_BibleONE['T_BOOKS'])]['NUMBER'];	if ('Old Testament'==$testament && $first >= 40) {	exit(header("Location: /Bibles/$_Part[1]",true,301)); }
if ($first >=40) {				$old = ""; }
else if (isset($_Part[2]) && $_Part[2]=='Old') {	$old = "<span class='word-tocs'>OLD</span>"; }
else {							$olk = abcms_href("/Bibles/$_Part[1]/Old",FALSE,TRUE,TRUE);
								$old = "<a href='$olk' title='Old Testament' class='word-tocs'>OLD</a>"; }
if ($last <= 39) {				$new = ""; }
else if (isset($_Part[2]) && $_Part[2]=='New') {	$new = "<span class='word-tocs'>NEW</span>"; }
else {							$nlk = abcms_href("/Bibles/$_Part[1]/New",FALSE,TRUE,TRUE);
								$new = "<a href='$nlk' title='New Testament' class='word-tocs'>NEW</a>"; }
if (!empty($_Part[2])) {
	$name = "<a href='".abcms_href("/Bibles/$_Part[1]",FALSE,TRUE,TRUE)."' title='Description' class='word-tocs'>".$_BibleONE['T_VERSIONS']['SHORT']."</a>";
}
else {
	$ol2 = (empty($old) ? "" : "<div class='field-field'><div class='field-links'><a href='$olk' title='Old Testament'>Old Testament</a></div></div>");
	$ne2 = (empty($new) ? "" : "<div class='field-field'><div class='field-links'><a href='$nlk' title='New Testament'>New Testament</a></div></div>");
	if (!empty($_BibleTWO)) {
		$para = "<div class='field-field'><div class='field-links'>Parallel: "; 
		$para .= "<a href='".abcms_href("/Bibles/$_paraC",FALSE,FALSE,TRUE)."' title='Parallel Bible description'>";
		$para .= "<span lang='en' class='eng'>".$_BibleTWO['T_VERSIONS']['NAMEENGLISH']."</span>";
		$para .= ( $_BibleTWO['T_VERSIONS']['NAME']==$_BibleTWO['T_VERSIONS']['NAMEENGLISH'] ? '' : ' ( '.$_BibleTWO_Lang."'>".$_BibleTWO['T_VERSIONS']['NAME'].'</span> )' );
		$para .= "</a></div></div>"; 
	}
	else { $para = ''; }
	$tocmenu = "<div class='field-header2'><img src='/images/Aionian-Bible-Bible.png' title='Read Aionian Bible'> Read:</div>$ol2$ne2$para";	
	$name = "<span class='word-tocs'>".$_BibleONE['T_VERSIONS']['SHORT']."</span>";	
}
if (isset($_Part[2]) && $_Part[2]=='Noted') {	$avs = "<span class='word-tocs'>AVS</span>"; }
else {						$avs = "<a href='".abcms_href("/Bibles/$_Part[1]/Noted",FALSE,TRUE,TRUE)."' title='Aionian Verses' class='word-tocs'>AVS</a>"; }

$path_strongs = abcms_href("/Strongs/$_Part[1]",FALSE,TRUE,TRUE);
$path_strongs_cancel = abcms_href(TRUE,'',TRUE,FALSE);
$strongs = (!$_stidC
	? "<a href='$path_strongs' title='Search Aionian Glossary and Strongs Concordance' class='word-tocs'>GLOS</a>"
	: "<span class='word-tocs word-strongs'><a href='$path_strongs' title='Search Aionian Glossary and Strongs Concordance'>$_stidC</a><a href='$path_strongs_cancel' title='Cancel word search' class='navxx'><span class='navxx'>X</span></a></span>");
return (
	"<div id='word-menu'>".
	"<div class='word-menu-l notranslate'>$name$avs$old$new$_BibleTWO_xLink$strongs</div>".
	"</div>"
);
}



/*** WORD TOCS DETAIL ***/
function abcms_word_tocs_detail() {
global $_Path, $_Part;
global $_BibleONE;
abcms_word_init();
abcms_word_init_para();
abcms_html(TRUE,'class=word-toc');
abcms_head(abcms_word_tocs_menu(NULL, $tocmenu));
echo "<div id='word'>";
echo "<h2 class=center>".$_BibleONE['T_VERSIONS']['NAMEENGLISH']."</h2>";
echo "<div id='word-description'>".$tocmenu.$_BibleONE['FORMATTED']."</div>";
echo "<div id='word-search'><div class='field-header'><img src='/images/Aionian-Bible-Online.png' title='Aionian Glossary Verses'> Aionian Glossary Verses:</div>";
$path_glossary = abcms_href('/Glossary',TRUE,TRUE,FALSE);
$path_noted = abcms_href(TRUE,'/Noted',TRUE,TRUE);
echo "<p>Chapters with <a href='$path_glossary' title='Aionian Glossary'>Aionian Glossary</a> words are highlighted in the table of contents with each verse also <a href='$path_noted' title='Aionian Glossary usage'>listed here</a>.  Notes are added to 64 Old Testament and 200 New Testament verses without altering the source text.  Contact the <a href='/Publisher' title='Contact Nainoia, Inc'>Publisher</a> with any questions. We pray for a modern public domain translation in every language.</p>";
echo '</div></div>';
abcms_tail();
}


/*** WORD TESTAMENT TOCS ***/
function abcms_word_tocs_test($testament) {
global $_Path, $_Part, $_stidC;
global $_BibleONE, $_BibleONE_Lang, $_BibleBOOKS;
abcms_word_init();
abcms_word_init_para();
if (!is_array(($bible_AIONIAN = json_decode(file_get_contents('./library/Holy-Bible---'.$_Part[1].'---Aionian-Verses.json'),true)))) {
	abcms_bomb("/Read","The Aionian Verse listing is unavailable",TRUE);
}
abcms_html(TRUE,'class=word-toc');
abcms_head(abcms_word_tocs_menu($testament, $tocmenu));
/* Books and chapters */
echo "<div id='word'><div id='word-search'><div class='word-test'>".$_BibleONE['T_VERSIONS']['NAMEENGLISH']."<br>$testament</div>\n";
foreach( $_BibleONE['T_BOOKS'] as $bookkey => $bookname ) {
	if (empty($bookname) || ('Old Testament'==$testament && (int)$_BibleBOOKS[$bookkey]['NUMBER']>=40) || ('New Testament'==$testament && (int)$_BibleBOOKS[$bookkey]['NUMBER']<=39)) { continue; }
	$bookname_foreign = ( $bookname==$_BibleBOOKS[$bookkey]['ENGLISH'] ? '' : '<br>'.$_BibleONE_Lang."'>".$bookname.'</span>' );
	$path_chapter = abcms_href("/Bibles/$_Part[1]/$bookkey",FALSE,TRUE,TRUE);	
	echo "\n<div class='word-book'><a href='$path_chapter'>".$_BibleBOOKS[$bookkey]['ENGLISH'].$bookname_foreign."</a></div>";
	echo "<div class='word-chapter'>";
	for( $chapter=1; $chapter<=$_BibleBOOKS[$bookkey]['CHAPTERS']; ++$chapter ) {
		$stripe=($chapter%2==0) ? 'even' : 'odd';
		$selected = empty($bible_AIONIAN[$_BibleBOOKS[$bookkey]['ENGLISH'].' '.(int)$chapter]) ? '' : 'selected';
		$strongs = abcms_word_tocs_stro($_stidC,$bookkey,$chapter) ? 'strongs' : '';
		$path_chapter = abcms_href("/Bibles/$_Part[1]/$bookkey/$chapter",FALSE,TRUE,TRUE);
		echo "<a href='$path_chapter' class='$stripe $selected $strongs' title='View chapter'>".$chapter."</a>";
	}
	echo '</div>';
}
echo '</div></div>';
abcms_tail();
}



/*** TOC STRONGS ***/
function abcms_word_tocs_stro($sid,$bookkey,$chapter) {
global $_BibleBOOKS;
static $schap = NULL;
static $cindex = NULL;
if (empty($sid) ||
	($sid[0]==='g' && (int)$_BibleBOOKS[$bookkey]['NUMBER']<=39) ||
	($sid[0]==='h' && (int)$_BibleBOOKS[$bookkey]['NUMBER']>=40)) {
	return FALSE;
}
if ($schap===NULL) { $schap = abcms_word_tocs_stro_index($sid); }
if ($cindex===NULL) { $cindex = abcms_word_cdex(); }
if (!isset($cindex[$bookkey])) {
	// Too many of these errors because h352a referenced instead of h352A
	// I do not think these links are generated by the website, but either externally or old caches
	//abcms_errs("abcms_word_tocs_stro() Chapter index lookup failed! sid=$sid, bookkey=$bookkey");
	return FALSE;
}
$cindex_index = $cindex[$bookkey] + $chapter - 1;
if (!empty($schap[$cindex_index]) && $schap[$cindex_index]!=' ') { return TRUE; }
return FALSE;
}



/*** TOC STRONGS INDEX NEXT PREV ***/
function abcms_word_tocs_stro_np($sid,$bookkey,$chapter,&$prevbookkey,&$prevchapter,&$nextbookkey,&$nextchapter) {
global $_BibleBOOKS;
$prevbookkey = $prevchapter = $nextbookkey = $nextchapter = NULL;
if (empty($sid)) { return; }
if (empty(($schap=abcms_word_tocs_stro_index($sid)))) { return; }
$cindex = abcms_word_cdex();
if ($sid[0]==='h' && (int)$_BibleBOOKS[$bookkey]['NUMBER']>=40) { abcms_word_tocs_stro_np_prev($schap, $cindex, 'Malachi', 4, $prevbookkey, $prevchapter); return; }
if ($sid[0]==='g' && (int)$_BibleBOOKS[$bookkey]['NUMBER']<=39) { abcms_word_tocs_stro_np_next($schap, $cindex, 'Matthew', 1, $nextbookkey, $nextchapter); return; }
if (!isset($cindex[$bookkey])) { abcms_errs("abcms_word_tocs_stro() Chapter index lookup failed! sid=$sid, bookkey=$bookkey"); return; }
abcms_word_tocs_stro_np_next($schap, $cindex, $bookkey, $chapter, $nextbookkey, $nextchapter);
abcms_word_tocs_stro_np_prev($schap, $cindex, $bookkey, $chapter, $prevbookkey, $prevchapter);
return;
}



/*** TOC STRONGS INDEX NEXT ***/
function abcms_word_tocs_stro_np_next($schap, $cindex, $bookkey, $chapter, &$nextbookkey, &$nextchapter) {
global $_BibleONE;
for($x = $cindex[$bookkey] + $chapter; isset($schap[$x]); ++$x) {
	if ($schap[$x]==' ') { continue; }
	$gotit = FALSE;
	for($chaps=reset($cindex); $chaps!==FALSE; $chaps=next($cindex)) {
		 $books = key($cindex);
		if (!$gotit) { if ($books!=$bookkey) { continue; } $gotit = TRUE; }
		if ($chaps > $x) {
			$nextchapter = 1 + $x - prev($cindex);
			$nextbookkey = key($cindex);
			if (empty($_BibleONE['T_BOOKS'][$nextbookkey])) { $nextchapter = $nextbookkey = NULL; return; }
			return;
		}
		else if ($books=='Matthew' && $bookkey!='Matthew') {
			$nextchapter = 1 + $x - 925;
			$nextbookkey = 'Malachi';
			if (empty($_BibleONE['T_BOOKS'][$nextbookkey])) { $nextchapter = $nextbookkey = NULL; return; }
			return;
		}
	}
	$nextchapter = 1 + $x - end($cindex);
	$nextbookkey = key($cindex);
	if (empty($_BibleONE['T_BOOKS'][$nextbookkey])) { $nextchapter = $nextbookkey = NULL; return; }
	return;
}
}



/*** TOC STRONGS INDEX PREV ***/
function abcms_word_tocs_stro_np_prev($schap, $cindex, $bookkey, $chapter, &$prevbookkey, &$prevchapter) {
global $_BibleONE;
for($x = $cindex[$bookkey] + $chapter - 2; $x >= 0 && isset($schap[$x]); --$x) {
	if ($schap[$x]==' ') { continue; }
	$gotit = FALSE;
	$chaps = end($cindex);
	do {
		$books = key($cindex);
		if (!$gotit) { if ($books!=$bookkey) { continue; } $gotit = TRUE; }
		if ($chaps <= $x) {
			if (empty($_BibleONE['T_BOOKS'][$books])) { return; }
			$prevchapter = 1 + $x - $chaps;
			$prevbookkey = $books;
			return;
		}
	} while(($chaps=prev($cindex))!==FALSE);
	return;
}
}



/*** READ INDEX AND LINE ***/
function abcms_read_indx_line($data=NULL, $indx=NULL, $key=NULL, $yes=TRUE) {
static $fd = NULL; static $cache = NULL; // static!
if ($cache===NULL) { $fd = $cache = array(); } // init?
if (!$indx) { foreach($fd as $x) { fclose($x); } $fd = $cache = NULL; return TRUE; } // fclose
// key family
if (!$data) {
$Ckey = 'C'.$key;
if (isset($cache[$indx][$Ckey])) { return $cache[$indx][$Ckey]; } // cached key family
if (!isset($cache[$indx]) && !($cache[$indx]=json_decode(file_get_contents($indx),true))) {			abcms_errs("abcms_read_indx_line() index not opened: $data $indx $key");				return NULL; } // index?
$cache[$indx][$Ckey] = FALSE; // set!
if (!isset($cache[$indx]['C'])) { $cache[$indx]['C'] = ' '.implode(', ', array_keys($cache[$indx])).','; }
if (preg_match("# {$key},(.* {$key}[A-Za-z]+,)#u", $cache[$indx]['C'], $match)) { return ($cache[$indx][$Ckey] = trim($match[0],", ")); } // done!
return NULL;
}
// data from key
if (isset($cache[$data.$indx][$key])) { return $cache[$data.$indx][$key]; } // cached reference line
$cache[$data.$indx][$key] = FALSE; // set!
if (!isset($cache[$indx]) && !($cache[$indx]=json_decode(file_get_contents($indx),true))) {			abcms_errs("abcms_read_indx_line() index not opened: $data $indx $key");				return NULL; } // index?
if (!isset($cache[$indx][$key])) { // key?
	// Too many of these errors because h352a referenced instead of h352A
	// I do not think these links are generated by the website, but either externally or old caches
	// also see lines 854-857 
	//if ($yes) { abcms_errs("abcms_read_indx_line() index key missing: $data $indx $key"); }
	return NULL;
}
$offset = strtok((string)$cache[$indx][$key],',');
if ($offset != (string)$cache[$indx][$key]) { // multiple?
	// json index has multiple elements in cases such as g184, g184G, g184H
	// ignore the error for now
	//if ($yes) { abcms_errs("abcms_read_indx_line() multiple offsets: $data $indx $key"); }
	return NULL;
}
if (!isset($fd[$data]) && !($fd[$data]=fopen($data, 'r'))) {										abcms_errs("abcms_read_indx_line() data not opened: $data $indx $key");					return NULL; } // data?
if (fseek($fd[$data], $cache[$indx][$key])) {														abcms_errs("abcms_read_indx_line() index offset missing: $data $indx $key");			return NULL; } // seek?
if (!($line=fgets($fd[$data]))) {																	abcms_errs("abcms_read_indx_line() data not read: $data $indx $key");					return NULL; } // read?
if (!($line = rtrim($line,"\r\n")) || !($cache[$data.$indx][$key] = mb_split("\t", $line))) {		abcms_errs("abcms_read_indx_line() data not parsed: $data $indx $key");					return NULL; } // parse?
return ($cache[$data.$indx][$key]); // done!
}



/*** TOC STRONGS INDEX ***/
function abcms_word_tocs_stro_index($sid) {
$fields = abcms_read_indx_line(
	($sid[0]==='h' ? './library/stepbible/Hebrew_Chapter_Usage.txt'			: './library/stepbible/Greek_Chapter_Usage.txt'),
	($sid[0]==='h' ? './library/stepbible/Hebrew_Chapter_Usage_Index.json'	: './library/stepbible/Greek_Chapter_Usage_Index.json'),
	($numb = substr($sid,1)));
if (!isset($fields[0]) || !isset($fields[1]) || $numb != $fields[0] || (strlen($fields[1]) != ($sid[0]==='h' ? 929 : 260))) {
	// Too many of these errors because h352a referenced instead of h352A
	// I do not think these links are generated by the website, but either externally or old caches
	// also see lines 828-833 
	//abcms_errs("abcms_word_tocs_stro_index() requested Strongs chapter data not found or corrupted! sid=$sid");
	$fields = array(NULL,NULL);
}
abcms_read_indx_line();
return($fields[1]);
}



/*** WORD MENU ***/
function abcms_word_menu($what) {
global $_Part, $_stidC;
global $_BibleONE, $_BibleCHAP1, $_BibleBOOKS, $_BibleTWO_xLink;
if ($what=='all') {
	$navup = "<a href='/Read' title='Bookmarked Bible' onclick='return AionianBible_Bookmark(".'"/Read"'.");' class='nav'><span class='nav nup'>^</span></a>";
	abcms_aionian_nav($_Part[2],$_Part[3],$_Part[4],$aionprev,$aionnext);
	$prev = ($_Part[3]>1
		? "<a href='".abcms_href("/Verse/All/$_Part[2]/".($_Part[3]-1),FALSE,TRUE,TRUE)."' title='Previous chapter' class='nav left'><span class='nav clt'>&lt;</span></a>"
		: (!empty($_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]) && !empty($_BibleONE['T_BOOKS'][$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]])
		? "<a href='".abcms_href("/Verse/All/".$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]."/".$_BibleBOOKS[$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]]['CHAPTERS'],FALSE,TRUE,TRUE)."' title='Previous chapter' class='nav left'><span class='nav clt'>&lt;</span></a>"
		: "<a href='/Read' title='Bookmarked Bible' onclick='return AionianBible_Bookmark(".'"/Read"'.");' class='nav left'><span class='nav vlt'>+</span></a>"));
	$next = ($_Part[3]<(int)$_BibleBOOKS[$_Part[2]]['CHAPTERS']
		? "<a href='".abcms_href("/Verse/All/$_Part[2]/".($_Part[3]+1),FALSE,TRUE,TRUE)."' title='Next chapter' class='nav right'><span class='nav cgt'>&gt;</span></a>"
		: (!empty($_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']+1]) && !empty($_BibleONE['T_BOOKS'][$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']+1]])
		? "<a href='".abcms_href("/Verse/All/".$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']+1]."/1",FALSE,TRUE,TRUE)."' title='Next chapter' class='nav right'><span class='nav cgt'>&gt;</span></a>"
		: "<a href='/Read' title='Bookmarked Bible' onclick='return AionianBible_Bookmark(".'"/Read"'.");' class='nav left'><span class='nav vgt'>+</span></a>"));
	$aionianprev = ($aionprev ? "<a href='".abcms_href("/Verse/$_Part[1]/$aionprev",FALSE,TRUE,TRUE)."' title='Previous Aionian Glossary word' class='nav'><span class='nav slt'>&lt;</span></a>" : '');
	$aioniannext = ($aionnext ? "<a href='".abcms_href("/Verse/$_Part[1]/$aionnext",FALSE,TRUE,TRUE)."' title='Next Aionian Glossary word' class='nav'><span class='nav sgt'>&gt;</span></a>" : '');
	$path_strongs = abcms_href("/Strongs",FALSE,TRUE,TRUE);
	$strongs = "<span class='word-tocs word-book'>$aionianprev<a href='$path_strongs' title='Search Aionian Glossary and Strongs Concordance' class='word-tocs'>GLOS</a>$aioniannext</span>";
	return ("<div id='word-menu'><div class='word-menu-l'><span class='word-tocs'>All Bibles</span>$strongs</div><div class='word-menu-r notranslate'>$prev$navup$next</div></div>");
}
$path_strongs = abcms_href("/Strongs/$_Part[1]",FALSE,TRUE,TRUE);
$test = ((int)$_BibleBOOKS[$_Part[2]]['NUMBER'] < 40 ? "Old" : "New");
if ($what=='chap') {
	$navup = "<a href='".abcms_href("/Bibles/$_Part[1]/$test",FALSE,TRUE,TRUE)."' title='$test Testament' class='nav'><span class='nav nup'>^</span></a>";
	abcms_aionian_nav($_Part[2],$_Part[3],NULL,$aionprev,$aionnext);
	$prev = (!empty($_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]) && !empty($_BibleONE['T_BOOKS'][$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]])
		? "<a href='".abcms_href("/Bibles/$_Part[1]/".$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1],FALSE,TRUE,TRUE)."' title='Previous book' class='nav book'><span>&lt;</span></a>"
		: "<a href='".abcms_href("/Bibles/$_Part[1]/$test",FALSE,TRUE,TRUE)."' title='$test Testament' class='nav book'><span>+</span></a>");
	$next =	(!empty($_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']+1]) && !empty($_BibleONE['T_BOOKS'][$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']+1]])
		? "<a href='".abcms_href("/Bibles/$_Part[1]/".$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']+1],FALSE,TRUE,TRUE)."' title='Next book' class='nav book'><span>&gt;</span></a>"
		: "<a href='".abcms_href("/Bibles/$_Part[1]/$test",FALSE,TRUE,TRUE)."' title='$test Testament' class='nav book'><span>+</span></a>");
}
else if ($what=='vers') {
	$navup = "<a href='".abcms_href("/Bibles/$_Part[1]/$_Part[2]/$_Part[3]",FALSE,TRUE,TRUE)."' title='Chapter' class='nav'><span class='nav nup'>^</span></a>";
	abcms_aionian_nav($_Part[2],$_Part[3],$_Part[4],$aionprev,$aionnext);
	$prev = ($_Part[3]>1
		? "<a href='".abcms_href("/Bibles/$_Part[1]/$_Part[2]/".($_Part[3]-1)."/1",FALSE,TRUE,TRUE)."' title='Previous chapter' class='nav left'><span class='nav clt'>&lt;</span></a>"
		: (!empty($_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]) && !empty($_BibleONE['T_BOOKS'][$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]])
		? "<a href='".abcms_href("/Bibles/$_Part[1]/".$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]."/".$_BibleBOOKS[$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]]['CHAPTERS']."/1",FALSE,TRUE,TRUE)."' title='Previous chapter' class='nav left'><span class='nav clt'>&lt;</span></a>"
		: "<a href='".abcms_href("/Bibles/$_Part[1]/$test",FALSE,TRUE,TRUE)."' title='$test Testament' class='nav left'><span class='nav clt'>+</span></a>"));
	$next = ($_Part[3]<(int)$_BibleBOOKS[$_Part[2]]['CHAPTERS']
		? "<a href='".abcms_href("/Bibles/$_Part[1]/$_Part[2]/".($_Part[3]+1)."/1",FALSE,TRUE,TRUE)."' title='Next chapter' class='nav right'><span class='nav cgt'>&gt;</span></a>"
		: (!empty($_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']+1]) && !empty($_BibleONE['T_BOOKS'][$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']+1]])
		? "<a href='".abcms_href("/Bibles/$_Part[1]/".$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']+1]."/1/1",FALSE,TRUE,TRUE)."' title='Next chapter' class='nav right'><span class='nav cgt'>&gt;</span></a>"
		: "<a href='".abcms_href("/Bibles/$_Part[1]/$test",FALSE,TRUE,TRUE)."' title='$test Testament' class='nav right'><span class='nav cgt'>+</span></a>"));
}
else { $prev = $navup = $next = $aionprev = $aionnext = NULL; }
if ($_stidC) {
	abcms_word_tocs_stro_np($_stidC,$_Part[2],$_Part[3],$prevbookkey,$prevchapter,$nextbookkey,$nextchapter);
	$strongsprev = ($prevbookkey ? "<a href='".abcms_href("/Bibles/$_Part[1]/$prevbookkey/$prevchapter",FALSE,TRUE,TRUE)."' title='Previous Strongs usage' class='nav'><span class='nav slt'>&lt;</span></a>" : '');
	$strongsnext = ($nextbookkey ? "<a href='".abcms_href("/Bibles/$_Part[1]/$nextbookkey/$nextchapter",FALSE,TRUE,TRUE)."' title='Next Strongs usage' class='nav'><span class='nav sgt'>&gt;</span></a>" : '');
	$strongs = "<span class='word-tocs word-strongs'>$strongsprev<a href='$path_strongs' title='Search Aionian Glossary and Strongs Concordance'>$_stidC</a>$strongsnext<a href='".abcms_href(TRUE,'',TRUE,FALSE)."' title='Cancel Strongs search' class='navxx'><span class='navxx'>X</span></a></span>";
}
else {
	$aionianprev = ($aionprev ? "<a href='".abcms_href("/Bibles/$_Part[1]/$aionprev",FALSE,TRUE,TRUE)."' title='Previous Aionian Glossary word' class='nav'><span class='nav slt'>&lt;</span></a>" : '');
	$aioniannext = ($aionnext ? "<a href='".abcms_href("/Bibles/$_Part[1]/$aionnext",FALSE,TRUE,TRUE)."' title='Next Aionian Glossary word' class='nav'><span class='nav sgt'>&gt;</span></a>" : '');
	$strongs = "<span class='word-tocs word-book'>$aionianprev<a href='$path_strongs' title='Search Aionian Glossary and Strongs Concordance' class='word-tocs'>GLOS</a>$aioniannext</span>";
}
$name = "<a href='".abcms_href("/Bibles/$_Part[1]",FALSE,TRUE,TRUE)."' title='Bible Table of Contents' class='word-tocs'>".$_BibleONE['T_VERSIONS']['SHORT']."</a>";
return (
	"<div id='word-menu'>".
	"<div class='word-menu-l notranslate'>".$name.$_BibleTWO_xLink.$strongs."</div>".
	"<div class='word-menu-r notranslate'>$prev$navup$next</div>".
	"</div>");
}



/*** CHAP MENU ***/
function abcms_chap_menu() {
global $_Part, $_BibleONE, $_BibleBOOKS, $_BibleONE_Lang, $_SwipePREV, $_SwipeNEXT;
$test = ((int)$_BibleBOOKS[$_Part[2]]['NUMBER'] < 40 ? "Old" : "New");
$prev = ($_Part[3]>1
		? "<a href='".($_SwipePREV=abcms_href("/Bibles/$_Part[1]/$_Part[2]/".($_Part[3]-1),FALSE,TRUE,TRUE))."' title='Previous chapter' class='nav left'><span class='nav clt'>&lt;</span></a>"
		: (!empty($_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]) && !empty($_BibleONE['T_BOOKS'][$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]])
		? "<a href='".($_SwipePREV=abcms_href("/Bibles/$_Part[1]/".$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]."/".$_BibleBOOKS[$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]]['CHAPTERS'],FALSE,TRUE,TRUE))."' title='Previous chapter' class='nav left'><span class='nav clt'>&lt;</span></a>"
		: "<a href='".($_SwipePREV=abcms_href("/Bibles/$_Part[1]/$test",FALSE,TRUE,TRUE))."' title='$test Testament' class='nav left'><span class='nav clt'>+</span></a>"));
$next = ($_Part[3]<(int)$_BibleBOOKS[$_Part[2]]['CHAPTERS']
		? "<a href='".($_SwipeNEXT=abcms_href("/Bibles/$_Part[1]/$_Part[2]/".($_Part[3]+1),FALSE,TRUE,TRUE))."' title='Next chapter' class='nav right'><span class='nav cgt'>&gt;</span></a>"
		: (!empty($_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']+1]) && !empty($_BibleONE['T_BOOKS'][$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']+1]])
		? "<a href='".($_SwipeNEXT=abcms_href("/Bibles/$_Part[1]/".$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']+1]."/1",FALSE,TRUE,TRUE))."' title='Next chapter' class='nav right'><span class='nav cgt'>&gt;</span></a>"
		: "<a href='".($_SwipeNEXT=abcms_href("/Bibles/$_Part[1]/$test",FALSE,TRUE,TRUE))."' title='$test Testament' class='nav right'><span class='nav cgt'>+</span></a>"));
echo "<div id='word-menu-float' class='notranslate'>$prev$next</div>";
return ("<h2>$prev $_BibleONE_Lang'>".$_BibleONE['T_BOOKS'][$_Part[2]]."</span> ".$_Part[3]." $next</h2>");
}



/*** VERSE MENU ***/
function abcms_vers_menu() {
global $_Part, $_BibleONE, $_BibleCHAP1, $_BibleBOOKS, $_BibleONE_Lang, $_SwipePREV, $_SwipeNEXT;
$test = ((int)$_BibleBOOKS[$_Part[2]]['NUMBER'] < 40 ? "Old" : "New");
$prev = ($_Part[4]>1
		? "<a href='".($_SwipePREV=abcms_href("/Bibles/$_Part[1]/$_Part[2]/$_Part[3]/".($_Part[4]-1),FALSE,TRUE,TRUE))."' title='Previous verse' class='nav left'><span class='nav vlt'>&lt;</span></a>"
		: ($_Part[3]>1
		? "<a href='".($_SwipePREV=abcms_href("/Bibles/$_Part[1]/$_Part[2]/".($_Part[3]-1)."/".abcms_word_menu_verses($_Part[1],$_BibleBOOKS[$_Part[2]]['NUMBER'],$_BibleBOOKS[$_Part[2]]['CODE'],($_Part[3]-1)),FALSE,TRUE,TRUE))."' title='Previous verse' class='nav left'><span class='nav vlt'>&lt;</span></a>"
		: (!empty($_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]) && !empty($_BibleONE['T_BOOKS'][$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]])
		? "<a href='".($_SwipePREV=abcms_href("/Bibles/$_Part[1]/".$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]."/".$_BibleBOOKS[$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]]['CHAPTERS']."/".abcms_word_menu_verses($_Part[1],$_BibleBOOKS[$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]]['NUMBER'],$_BibleBOOKS[$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]]['CODE'],$_BibleBOOKS[$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]]['CHAPTERS']),FALSE,TRUE,TRUE))."' title='Previous verse' class='nav left'><span class='nav vlt'>&lt;</span></a>"
		: "<a href='".($_SwipePREV=abcms_href("/Bibles/$_Part[1]/$test",FALSE,TRUE,TRUE))."' title='$test Testament' class='nav left'><span class='nav vlt'>+</span></a>")));
$next = ($_Part[4]<count($_BibleCHAP1)
		? "<a href='".($_SwipeNEXT=abcms_href("/Bibles/$_Part[1]/$_Part[2]/$_Part[3]/".($_Part[4]+1),FALSE,TRUE,TRUE))."' title='Next verse' class='nav right'><span class='nav vgt'>&gt;</span></a>"
		: ($_Part[3]<(int)$_BibleBOOKS[$_Part[2]]['CHAPTERS']
		? "<a href='".($_SwipeNEXT=abcms_href("/Bibles/$_Part[1]/$_Part[2]/".($_Part[3]+1)."/1",FALSE,TRUE,TRUE))."' title='Next verse' class='nav right'><span class='nav vgt'>&gt;</span></a>"
		: (!empty($_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']+1]) && !empty($_BibleONE['T_BOOKS'][$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']+1]])
		? "<a href='".($_SwipeNEXT=abcms_href("/Bibles/$_Part[1]/".$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']+1]."/1/1",FALSE,TRUE,TRUE))."' title='Next verse' class='nav right'><span class='nav vgt'>&gt;</span></a>"
		: "<a href='".($_SwipeNEXT=abcms_href("/Bibles/$_Part[1]/$test",FALSE,TRUE,TRUE))."' title='$test Testament' class='nav right'><span class='nav vgt'>+</span></a>")));
echo "<div id='word-menu-float' class='notranslate'>$prev$next</div>";
return ("<h2>$prev $_BibleONE_Lang'>".$_BibleONE['T_BOOKS'][$_Part[2]]."</span> ".$_Part[3].":".$_Part[4]." $next</h2>");
}



/*** VERSE ALL MENU ***/
function abcms_vall_menu() {
global $_Part, $_BibleONE, $_BibleCHAP1, $_BibleBOOKS, $_BibleONE_Lang, $_SwipePREV, $_SwipeNEXT;
$test = ((int)$_BibleBOOKS[$_Part[2]]['NUMBER'] < 40 ? "Old" : "New");
$prev = ($_Part[4]>1
		? "<a href='".($_SwipePREV=abcms_href("/Verse/$_Part[1]/$_Part[2]/$_Part[3]/".($_Part[4]-1),FALSE,TRUE,TRUE))."' title='Previous verse' class='nav left'><span class='nav vlt'>&lt;</span></a>"
		: ($_Part[3]>1
		? "<a href='".($_SwipePREV=abcms_href("/Verse/$_Part[1]/$_Part[2]/".($_Part[3]-1)."/".abcms_word_menu_verses($_Part[1],$_BibleBOOKS[$_Part[2]]['NUMBER'],$_BibleBOOKS[$_Part[2]]['CODE'],($_Part[3]-1)),FALSE,TRUE,TRUE))."' title='Previous verse' class='nav left'><span class='nav vlt'>&lt;</span></a>"
		: (!empty($_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]) && !empty($_BibleONE['T_BOOKS'][$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]])
		? "<a href='".($_SwipePREV=abcms_href("/Verse/$_Part[1]/".$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]."/".$_BibleBOOKS[$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]]['CHAPTERS']."/".abcms_word_menu_verses($_Part[1],$_BibleBOOKS[$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]]['NUMBER'],$_BibleBOOKS[$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]]['CODE'],$_BibleBOOKS[$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']-1]]['CHAPTERS']),FALSE,TRUE,TRUE))."' title='Previous verse' class='nav left'><span class='nav vlt'>&lt;</span></a>"
		: "<a href='".($_SwipePREV="/Read")."' title='Bookmarked Bible' onclick='return AionianBible_Bookmark(".'"/Read"'.");' class='nav left'><span class='nav vlt'>+</span></a>")));
$next = ($_Part[4]<count($_BibleCHAP1)
		? "<a href='".($_SwipeNEXT=abcms_href("/Verse/$_Part[1]/$_Part[2]/$_Part[3]/".($_Part[4]+1),FALSE,TRUE,TRUE))."' title='Next verse' class='nav right'><span class='nav vgt'>&gt;</span></a>"
		: ($_Part[3]<(int)$_BibleBOOKS[$_Part[2]]['CHAPTERS']
		? "<a href='".($_SwipeNEXT=abcms_href("/Verse/$_Part[1]/$_Part[2]/".($_Part[3]+1)."/1",FALSE,TRUE,TRUE))."' title='Next verse' class='nav right'><span class='nav vgt'>&gt;</span></a>"
		: (!empty($_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']+1]) && !empty($_BibleONE['T_BOOKS'][$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']+1]])
		? "<a href='".($_SwipeNEXT=abcms_href("/Verse/$_Part[1]/".$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']+1]."/1/1",FALSE,TRUE,TRUE))."' title='Next verse' class='nav right'><span class='nav vgt'>&gt;</span></a>"
		: "<a href='".($_SwipeNEXT="/Read")."' title='Bookmarked Bible' onclick='return AionianBible_Bookmark(".'"/Read"'.");' class='nav right'><span class='nav vgt'>+</span></a>")));
echo "<div id='word-menu-float' class='notranslate'>$prev$next</div>";
return ("<h2 class=center>$prev ".$_BibleBOOKS[(int)$_BibleBOOKS[$_Part[2]]['NUMBER']]." ".$_Part[3].":".$_Part[4]." $next</h2>\n");
}



/*** WORD MENU VERSES ***/
function abcms_word_menu_verses($bible,$index,$code,$chap) {
$verse = 1;
if($bible=='All') { $bible = 'English---King-James-Version'; }
$prevchap = json_decode(file_get_contents('./library/online/Holy-Bible---'.$bible.'---Aionian-Edition/'.$index.'-'.$code.'-'.sprintf('%03d', (int)$chap).'.json'),true);
if (!is_array($prevchap) || !($verse=count($prevchap))) {
	abcms_errs("abcms_word_menu_prev_chap() error locating previous chapter verse count");
}
return (max(1,$verse));
}



/*** WORD NOTE ***/
function abcms_word_note() {
global $_Part, $_paraC;
global $_BibleONE, $_BibleONE_Lang, $_BibleBOOKS, $_BibleTWO_xLink;
abcms_word_init();
if (!is_array(($AIONIAN_ONE = json_decode(file_get_contents('./library/Holy-Bible---'.$_Part[1].'---Aionian-Verses.json'),true)))) {
	abcms_bomb("/Bibles/$_Part[1]","The Aionian Bible verses file is unavailable",TRUE);
}
$AIONIAN_TWO = FALSE;
$ppath = abcms_href('/Parallel',TRUE,FALSE,TRUE);
$_BibleTWO_xLink = "<a href='$ppath' title='Read and Study Parallel Bible' class='word-tocs'>PARA</a>";
if (!empty($_paraC)) {
	if (!file_exists('./library/Holy-Bible---'.$_paraC.'---Aionian-Edition.json')) {
		abcms_bomb("/Read","The requested Parallel Bible was not found");
	}
	$AIONIAN_TWO = json_decode(file_get_contents('./library/Holy-Bible---'.$_paraC.'---Aionian-Verses.json'),true);
	$_BibleTWO = json_decode(file_get_contents('./library/Holy-Bible---'.$_paraC.'---Aionian-Edition.json'),true);
	if (!is_array($AIONIAN_TWO) || !is_array($_BibleTWO)) {
		abcms_bomb("/Read","The requested Parallel Bible data was not found",TRUE);
	}
	$rtl2 = (empty($_BibleTWO['T_VERSIONS']['RTL']) ? "" : "dir='rtl'" );
	$bpath = abcms_href(TRUE,'',FALSE,TRUE);
	$_BibleTWO_Lang = "<span lang='".$_BibleTWO['T_VERSIONS']['LANGUAGECODEISO']."' $rtl2 class='".$_BibleTWO['T_VERSIONS']['LANGUAGECSS'];
	$_BibleTWO_xLink = "<span class='word-tocs word-book notranslate'><a href='$ppath' title='Read and Study Parallel Bible'>".$_BibleTWO['T_VERSIONS']['SHORT']."</a><a href='$bpath' title='Cancel Parallel Bible study' class='navx'><span class='navx'>X</span></a></span>";
}
abcms_html(TRUE,'class=word-read');
abcms_head(abcms_word_tocs_menu(NULL, $tocmenu));
// AIONIAN TEXT
$rtl = (empty($_BibleONE['T_VERSIONS']['RTL']) ? FALSE : TRUE);
$rtlref = ($rtl ? 'rtlref' : '');
$rtl2 = (empty($_BibleTWO['T_VERSIONS']['RTL']) ? FALSE : TRUE);
echo "<div id='word' class='aionian'>";
echo "<h2 class=center>Aionian Verses</h2>\n";
$count_one = $count_two = 0;
$x = 1;
$vref2 = FALSE;
$missing1 = $_BibleONE_Lang." word-text'>(parallel missing)</span>";
$missing2 = ($AIONIAN_TWO ? $_BibleTWO_Lang." word-text'>(parallel missing)</span>" : '');
foreach( $AIONIAN_ONE as $vref1 => $verse1) {
	if ($vref1=='QUESTIONED' || $verse1===TRUE) { continue; }
	if ($AIONIAN_TWO) {
		while(($vref2=key($AIONIAN_TWO))) {
			$verse2 = current($AIONIAN_TWO);
			if ($vref2=='QUESTIONED' || $verse2===TRUE) { next($AIONIAN_TWO); continue; }
			$verse_two = $_BibleTWO_Lang." word-text'>".$verse2['TEXT'].'</span>';
			if ($vref1<=$vref2) { break; }
			$stripe = (( $x % 2 == 0 ) ? 'even' : 'odd'); ++$x;
			$vref_link =	"<span lang='en' class='eng'>".$_BibleBOOKS[$_BibleBOOKS[(int)$verse2['INDEX']]]['ENGLISH'].' '.(int)$verse2['CHAPTER'].':'.(int)$verse2['VERSE'].'</span>'.
							($_BibleBOOKS[$_BibleBOOKS[(int)$verse2['INDEX']]]['ENGLISH']==$_BibleTWO['T_BOOKS'][$_BibleBOOKS[(int)$verse2['INDEX']]] ? '' :
							' '.$_BibleTWO_Lang." word-para-ref'>".'('.$_BibleTWO['T_BOOKS'][$_BibleBOOKS[(int)$verse2['INDEX']]].' '.$_BibleTWO['T_NUMBERS'][(int)$verse2['CHAPTER']].':'.$_BibleTWO['T_NUMBERS'][(int)$verse2['VERSE']].')</span>');
			echo "<div class='word-para $stripe aionian'><div class='word-para-ref $rtlref'>$vref_link</div>\n";
			if ($rtl) {	echo "<table class='word-para-one word-rtl'><tr><td class='word-text'>$missing1</td></tr></table>\n"; }
			else {		echo "<div class='word-para-one'>$missing1</div>";}
			if ($rtl2){	echo "<table class='word-para-two word-rtl'><tr><td class='word-text'>$verse_two</td></tr></table>\n"; }
			else {		echo "<div class='word-para-two'>$verse_two</div>\n"; }	
			echo "</div>\n";
			++$count_two;
			next($AIONIAN_TWO);
		}
	}
	$stripe = (( $x % 2 == 0 ) ? 'even' : 'odd'); ++$x;
	$vref_link =	"<a href='".abcms_href("/Bibles/$_Part[1]/".$_BibleBOOKS[(int)$verse1['INDEX']].'/'.(int)$verse1['CHAPTER'],FALSE,TRUE,TRUE)."' title='View chapter'>".
					"<span lang='en' class='eng'>".$_BibleBOOKS[$_BibleBOOKS[(int)$verse1['INDEX']]]['ENGLISH'].' '.(int)$verse1['CHAPTER'].':'.(int)$verse1['VERSE'].'</span>'.
					($_BibleBOOKS[$_BibleBOOKS[(int)$verse1['INDEX']]]['ENGLISH']==$_BibleONE['T_BOOKS'][$_BibleBOOKS[(int)$verse1['INDEX']]] ? '' :
					' '.$_BibleONE_Lang." word-para-ref'>".'('.$_BibleONE['T_BOOKS'][$_BibleBOOKS[(int)$verse1['INDEX']]].' '.$_BibleONE['T_NUMBERS'][(int)$verse1['CHAPTER']].':'.$_BibleONE['T_NUMBERS'][(int)$verse1['VERSE']].')</span>').
					'</a>';
	$verse_one = $_BibleONE_Lang." word-text'>".$verse1['TEXT'].'</span>';
	echo "<div class='word-para $stripe aionian'><div class='word-para-ref $rtlref'>$vref_link</div>\n";
	if (!$AIONIAN_TWO) {
		if ($rtl) {	echo "<table class='word-para-one word-rtl'><tr><td class='word-text'>$verse_one</td></tr></table>\n"; }
		else {		echo "<div class='word-para-one'>$verse_one</div>\n"; }
	}
	else if ($vref1<$vref2 || !$vref2) {
		if ($rtl) {	echo "<table class='word-para-one word-rtl'><tr><td class='word-text'>$verse_one</td></tr></table>\n"; }
		else {		echo "<div class='word-para-one'>$verse_one</div>";}
		if ($rtl2){	echo "<table class='word-para-two word-rtl'><tr><td class='word-text'>$missing2</td></tr></table>\n"; }
		else {		echo "<div class='word-para-two'>$missing2</div>\n"; }
	}
	else if ($vref1==$vref2) {
		if ($rtl) {	echo "<table class='word-para-one word-rtl'><tr><td class='word-text'>$verse_one</td></tr></table>\n"; }
		else {		echo "<div class='word-para-one'>$verse_one</div>";}
		if ($rtl2){	echo "<table class='word-para-two word-rtl'><tr><td class='word-text'>$verse_two</td></tr></table>\n"; }
		else {		echo "<div class='word-para-two'>$verse_two</div>\n"; }		
		++$count_two;
		next($AIONIAN_TWO);
	}
	else {
		echo "<div class='word-para-one'>The Aionian verse is unavailable, <a href='/Publisher' title='Contact Nainoia Inc'>please contact the publisher for help</a></div>\n";
		abcms_errs("abcms_word_note() parallel aionian verses loop error!");
	}
	echo "</div>\n";
	++$count_one;
}
if ($AIONIAN_TWO) {
	while(($verse2=next($AIONIAN_TWO))) {
		$vref2=key($AIONIAN_TWO);
		if ($vref2=='QUESTIONED' || $verse2===TRUE) { continue; }
		$verse_two = $_BibleTWO_Lang." word-text'>".$verse2['TEXT'].'</span>';
		$stripe = (( $x % 2 == 0 ) ? 'even' : 'odd'); ++$x;
		$vref_link =	"<span lang='en' class='eng'>".$_BibleBOOKS[(int)$verse2['INDEX']].' '.(int)$verse2['CHAPTER'].':'.(int)$verse2['VERSE'].'</span>'.
						($_BibleBOOKS[(int)$verse2['INDEX']]==$_BibleTWO['T_BOOKS'][$_BibleBOOKS[(int)$verse2['INDEX']]] ? '' :
						' '.$_BibleTWO_Lang." word-para-ref'>".'('.$_BibleTWO['T_BOOKS'][$_BibleBOOKS[(int)$verse2['INDEX']]].' '.$_BibleTWO['T_NUMBERS'][(int)$verse2['CHAPTER']].':'.$_BibleTWO['T_NUMBERS'][(int)$verse2['VERSE']].')</span>');
			echo "<div class='word-para $stripe aionian'><div class='word-para-ref $rtlref'>$vref_link</div>\n";
			if ($rtl) {	echo "<table class='word-para-one word-rtl'><tr><td class='word-text'>$missing1</td></tr></table>\n"; }
			else {		echo "<div class='word-para-one'>$missing1</div>";}
			if ($rtl2){	echo "<table class='word-para-two word-rtl'><tr><td class='word-text'>$verse_two</td></tr></table>\n"; }
			else {		echo "<div class='word-para-two'>$verse_two</div>\n"; }		
			echo "</div>\n";
		++$count_two;
	}
}
$count_questioned = 0;
foreach( $AIONIAN_ONE['QUESTIONED'] as $vref1 => $verse1) {
	if ($count_questioned==0) { echo "<div class='word-aionian-questioned'><div class='word-para field-header'>Questioned verse translations do not contain Aionian Glossary words, but may wrongly imply eternal or Hell</div>"; }
	$stripe = (( $x % 2 == 0 ) ? 'even' : 'odd'); ++$x;
	$vref_link = "<a href='".abcms_href("/Bibles/$_Part[1]/".$_BibleBOOKS[(int)$verse1['INDEX']].'/'.(int)$verse1['CHAPTER'],FALSE,TRUE,TRUE)."' title='View chapter'>".
		"<span lang='en' class='eng'>".$_BibleBOOKS[$_BibleBOOKS[(int)$verse1['INDEX']]]['ENGLISH'].' '.(int)$verse1['CHAPTER'].':'.(int)$verse1['VERSE'].'</span>'.
		($_BibleBOOKS[$_BibleBOOKS[(int)$verse1['INDEX']]]['ENGLISH']==$_BibleONE['T_BOOKS'][$_BibleBOOKS[(int)$verse1['INDEX']]] ? '' :
		' '.$_BibleONE_Lang." word-para-ref'>".'('.$_BibleONE['T_BOOKS'][$_BibleBOOKS[(int)$verse1['INDEX']]].' '.$_BibleONE['T_NUMBERS'][(int)$verse1['CHAPTER']].':'.$_BibleONE['T_NUMBERS'][(int)$verse1['VERSE']].')</span>').
		'</a>';				
	$verse_one = $_BibleONE_Lang." word-text'>".$verse1['TEXT'].'</span>';
	echo "<div class='word-para $stripe aionian'><div class='word-para-ref $rtlref'>$vref_link</div>\n";
	if ($rtl) {	echo "<table class='word-para-one word-rtl'><tr><td class='word-text'>$verse_one</td></tr></table>\n"; }
	else {		echo "<div class='word-para-one'>$verse_one</div>";}
	echo "</div>\n";
	++$count_questioned;
}
if ($count_questioned) { echo '</div>'; };
$count_questioned = ($count_questioned ? ", Questioned: $count_questioned" : "");
if ($count_one) { echo "<br><div id='word-menu-bot1'>".$_BibleONE_Lang." notranslate'><a href='".abcms_href("/Bibles/$_Part[1]",FALSE,TRUE,TRUE)."' title='Bible Table of Contents'>".$_BibleONE['T_VERSIONS']['SHORT']."</a> &gt; Aionian Verses: $count_one$count_questioned</span></div>"; }
if ($count_two) { echo "<div id='word-menu-bot2'>".$_BibleTWO_Lang." notranslate'>".$_BibleTWO['T_VERSIONS']['SHORT']." &gt; Aionian Verses: $count_two</span></div>"; }
echo '</div>';
abcms_tail();
}



/*** WORD CHAP ***/
function abcms_word_chap($nopage=FALSE) {
global $_Path, $_Part;
global $_BibleBOOKS, $_BibleONE, $_BibleONE_Lang;
global $_BibleCHAP1, $_BibleCHAP1_Last, $_BibleCHAP2_Last, $_BibleTWO, $_BibleCHAP2, $_BibleTWO_Lang;
if (($message = abcms_word_init($nopage)) !== TRUE) { return $message; }
if (($message = abcms_word_init_chap(FALSE,$nopage)) !== TRUE) { return $message; }
$maxverses = max($_BibleCHAP1_Last, (int)$_BibleCHAP2_Last);
if ((!empty($_Part[4]) && (!ctype_digit($_Part[4]) || !($_Part[4]=(int)$_Part[4]) || $_Part[4]<1 || $_Part[4]>$maxverses)) ||
	(!empty($_Part[5]) && (!ctype_digit($_Part[5]) || !($_Part[5]=(int)$_Part[5]) || $_Part[5]<1 || $_Part[5]>$maxverses)) ||
	(!empty($_Part[4]) && !empty($_Part[5]) && $_Part[4] > $_Part[5])) {
	return abcms_bomb("/Bibles/$_Part[1]","The Bible book chapter verses requested were not found",FALSE,$nopage);
}
if (!empty($_Part[5]) && $_Part[5]<$maxverses) { $maxverses = $_Part[5]; }
if (!$nopage) {
	abcms_html(TRUE,'class=word-read');
	abcms_head(abcms_word_menu('chap'));
}
// TEXT
$rtl = (empty($_BibleONE['T_VERSIONS']['RTL']) ? FALSE : TRUE);
$rtl2 = (empty($_BibleTWO['T_VERSIONS']['RTL']) ? FALSE : TRUE);
if (!$nopage) {	
	echo "<div id='word'>";
	echo ($menu=abcms_chap_menu());
}
for ($x=(empty($_Part[4])?1:$_Part[4]); $x<=$maxverses; ++$x) {
	$stripe = (( $x % 2 == 0 ) ? 'even' : 'odd');
	$verse_link = "<a href='".abcms_href("/Bibles/$_Part[1]/$_Part[2]/$_Part[3]/$x",FALSE,TRUE,TRUE)."' title='View verse'>$x</a> ";
	$verse_number = (empty($_BibleONE['T_NUMBERS'][$x]) || $x==$_BibleONE['T_NUMBERS'][$x] ? '' : $_BibleONE_Lang." word-verse-lang'>".$_BibleONE['T_NUMBERS'][$x].'</span> ');
	$strongs = abcms_word_chap_stro($x);
	$verse_text = (empty($_BibleCHAP1[$x]) ? '' : "$_BibleONE_Lang word-text $strongs'>".$_BibleCHAP1[$x].'</span> ');
	if ($_BibleCHAP2_Last) {
		$verse_number2 = (empty($_BibleTWO['T_NUMBERS'][$x]) || $x==$_BibleTWO['T_NUMBERS'][$x] ? '' : $_BibleTWO_Lang." word-verse-lang'>".$_BibleTWO['T_NUMBERS'][$x].'</span>');
		$verse_text2 = (empty($_BibleCHAP2[$x]) ? '' : $_BibleTWO_Lang." word-text'>".$_BibleCHAP2[$x].'</span>');
		echo "<div class='word-para $stripe'>\n";
		if ($rtl) { echo "<table class='word-para-one word-rtl'><tr><td class='word-text'>$verse_text</td><td class='word-refs'>$verse_number<span class='word-verse'>$verse_link</span></td></tr></table>\n"; }
		else {		echo "<div class='word-para-one'><span class='word-verse'>$verse_link</span>$verse_number$verse_text</div>\n"; }
		if ($rtl2) {echo "<table class='word-para-two word-rtl'><tr><td class='word-text'>$verse_text2</td><td class='word-refs'>$verse_number2</td></tr></table>\n"; }
		else {		echo "<div class='word-para-two'>$verse_number2$verse_text2</div>\n"; }
		echo "</div>\n";
	}
	else if ($rtl) {
			echo	"<table class='word-rtl $stripe'><tr><td class='word-text'>$verse_text</td><td class='word-refs'>$verse_number<span class='word-verse'>$verse_link</span></td></tr></table>\n";
	}
	else {	echo	"<span class='word-text $stripe'><span class='word-verse'>$verse_link</span>$verse_number$verse_text</span>\n";
	}
}
if ($nopage) { return TRUE; }
echo "<div id='word-menu-bottom'>$menu</div>";
echo '</div>';
if (!empty($_BibleONE['T_VERSIONS']['WARNING'])) { echo "<div class='word-warning'>".$_BibleONE['T_VERSIONS']['WARNING']."</div>\n"; }
echo "<div id='word-links'>\n".
	"<a href='#' title='Go to Bookmark' onclick='AionianBible_Get();'>Go to</a> &gt; <a href='#' title='Set Bookmark' onclick='AionianBible_Set();'>Bookmark</a>".
	" / <a href='".abcms_href("/Strongs/$_Part[1]",FALSE,TRUE,TRUE)."' title='Aionian Glossary and Strongs Concordance'>Concordance</a>\n".
	" / <a href='/Maps' title='Middle Eastern and Mediterranean Bible maps, Bible timeline and church history'>Maps</a>\n".
	(($tmp = preg_replace("/Bibles\//","Publisher/",$_Path)) ? " / <a href='/$tmp' title='Propose translation correction'>Report Issue</a>\n" : '').
	"</div>\n";
abcms_word_dore($_Part[2],$_Part[3]);
abcms_tail();
}



/*** WORD CHAP STRONGS ***/
function abcms_word_chap_stro($x) {
global $_BibleSTRONGS, $_stidC;
if (!isset($_BibleSTRONGS[$x][$_stidC])) { return NULL; }
return 'strongs';
}



/*** WORD VERS ***/
function abcms_word_vers() {
global $_Part, $_Path;
global $_BibleONE, $_BibleONE_Lang, $_BibleBOOKS, $_BibleSTRONGS;
global $_BibleCHAP1, $_BibleCHAP1_Last, $_BibleCHAP2_Last, $_BibleTWO, $_BibleCHAP2, $_BibleTWO_Lang;
abcms_word_init();
abcms_word_init_chap();
if (!ctype_digit($_Part[4]) || (int)$_Part[4]<1 || (int)$_Part[4]>176) {
	abcms_bomb("/Bibles/$_Part[1]","The Bible book chapter verse requested was not found");
}
$_Part[4] = intval($_Part[4]);
if (empty($_BibleCHAP1[$_Part[4]]) && empty($_BibleCHAP2[$_Part[4]])) {
	exit(header("Location: ".abcms_href("/Bibles/$_Part[1]/$_Part[2]/$_Part[3]",FALSE,TRUE,TRUE)));
}
abcms_html(TRUE,'class=word-read','true');
abcms_head(abcms_word_menu('vers'));
// VERSE
$rtl = (empty($_BibleONE['T_VERSIONS']['RTL']) ? FALSE : TRUE);
$rtl2 = (empty($_BibleTWO['T_VERSIONS']['RTL']) ? FALSE : TRUE);
$x = $_Part[4];
echo "<div id='word'><div id='strong-head'>\n";
echo ($menu=abcms_vers_menu());
$verse_number = (empty($_BibleONE['T_NUMBERS'][$x]) || $x==$_BibleONE['T_NUMBERS'][$x] ? '' : $_BibleONE_Lang." word-verse-lang'>".$_BibleONE['T_NUMBERS'][$x].'</span> ');
$strongs = abcms_word_chap_stro($x);
$verse_text = "$_BibleONE_Lang word-text $strongs'>".(empty($_BibleCHAP1[$x]) ? 'Verse not available in this translation' : $_BibleCHAP1[$x]).'</span> ';
if ($_BibleCHAP2_Last) {
	$verse_number2 = (empty($_BibleTWO['T_NUMBERS'][$x]) || $x==$_BibleTWO['T_NUMBERS'][$x] ? '' : $_BibleTWO_Lang." word-verse-lang verse-num'>".$_BibleTWO['T_NUMBERS'][$x].'</span>');
	$verse_text2 = (empty($_BibleCHAP2[$x]) ? '<span>Verse not available in this translation</span>' : $_BibleTWO_Lang." word-text'>".$_BibleCHAP2[$x].'</span>');
	echo "<div class='word-para'>\n";
	if ($rtl) { echo "<table class='word-para-one word-rtl'><tr><td class='word-text'>$verse_text</td><td class='word-refs'>$verse_number<span class='word-verse'>$x </span></td></tr></table>\n"; }
	else {		echo "<div class='word-para-one'><span class='word-verse'>$x </span>$verse_number$verse_text</div>\n"; }
	if ($rtl2) {echo "<table class='word-para-two word-rtl'><tr><td class='word-text'>$verse_text2</td><td class='word-refs'>$verse_number2</td></tr></table>\n"; }
	else {		echo "<div class='word-para-two word-ltr'>$verse_number2$verse_text2</div>\n"; }
	echo "</div>\n";
}
else {
	if ($rtl) { echo "<table class='word-para word-rtl'><tr><td class='word-text'>$verse_text</td><td class='word-refs'>$verse_number<span class='word-verse'>$x </span></td></tr></table>\n"; }
	else {		echo "<div class='word-para'><span class='word-text'><span class='word-verse'>$x </span>$verse_number$verse_text</span></div>\n"; }
}
if (!empty($_BibleONE['T_VERSIONS']['WARNING'])) { echo "<div class='word-warning'>".$_BibleONE['T_VERSIONS']['WARNING']."</div>\n"; }
$javascript = "AionianBible_CollapseExpand(\"ab-lexicon\", null); return false;";
echo "<div class=field-header>\n".
	"<a href='' title='Open or close all lexicon entries below' onclick='$javascript'>Toggle Lexicons</a>\n".
	" / <a href='#' title='Go to Bookmark' onclick='AionianBible_Get();'>Go to</a> &gt; <a href='#' title='Set Bookmark' onclick='AionianBible_Set();'>Bookmark</a>".
	" / <a href='".abcms_href("/Verse/All/$_Part[2]/$_Part[3]/$_Part[4]",FALSE,TRUE,TRUE)."' title='Verse in all Bibles'>All Bibles</a>\n".
	" / <a href='".abcms_href("/Strongs/$_Part[1]",FALSE,TRUE,TRUE)."' title='Aionian Glossary and Strongs Concordance'>Concordance</a>\n".
	" / <a href='/Maps' title='Middle Eastern and Mediterranean Bible maps, Bible timeline and church history'>Maps</a>\n".
	(($tmp = preg_replace("/Bibles\//","Publisher/",$_Path)) ? " / <a href='/$tmp' title='Propose translation correction'>Report Issue</a>\n" : '').
	"</div>\n";
echo "</div>\n";
// display each strongs word
abcms_word_init_chap_stro((int)$_BibleBOOKS[$_Part[2]]['NUMBER'], (int)$_Part[3], $_Part[4]);
echo "<div id='strong-verse'>\n";
if (empty($_BibleSTRONGS) || !is_array($_BibleSTRONGS)) { echo "This verse is mis-aligned or the Strongs references are unavailable."; }
else {
	$chap = sprintf('%03d', (int)$_Part[3]);
	$verse = sprintf('%03d', $_Part[4]);
	$standard = json_decode(file_get_contents(
		'./library/online/Holy-Bible---English---King-James-Version---Aionian-Edition/'.$_BibleBOOKS[$_Part[2]]['NUMBER'].'-'.$_BibleBOOKS[$_Part[2]]['CODE']."-$chap.json"),true);
	if (empty($standard) || !is_array($standard) || count($_BibleCHAP1) != count($standard)) { echo "This verse may be mis-aligned with Strongs references.<br>"; }
	foreach($_BibleSTRONGS as $tag) {
		abcms_enty($tag[4],$tag,$_BibleBOOKS[$_Part[2]]['CODE'],$chap,$verse);
		echo "<hr>";
	}
}
echo "</div>\n";
echo "<div id='word-menu-bottom' class='always'>$menu</div>";
echo "</div>\n";
abcms_read_indx_line();
abcms_tail();		
}



/*** WORD VERS ALL ***/
function abcms_word_vers_all() {
global $_Part;
global $_BibleONE, $_BibleONE_Lang, $_BibleBOOKS, $_BibleCHAP1, $_BibleCHAP1_Last;
if (empty($_Part[3])) { $_Part[3] = '1'; }
if (empty($_Part[4])) { $_Part[4] = '1'; }
if ($_Part[3][0]=='0' || !ctype_digit($_Part[3]) || (int)$_Part[3]<1 || (int)$_Part[3]>151) {
	abcms_bomb("/Read","The Bible book chapter requested was not found");
}
if ($_Part[4][0]=='0' || !ctype_digit($_Part[4]) || (int)$_Part[4]<1 || (int)$_Part[4]>176) {
	abcms_bomb("/Read","The Bible book chapter verse requested was not found");
}
if (!is_array(($_BibleBOOKS = json_decode(file_get_contents('./library/Holy-Bible---AAA---Books.json'),true)))) {
	abcms_bomb("/Read","The Bible book list is unavailable",TRUE);
}
if (empty($_BibleBOOKS[$_Part[2]])) {
	abcms_bomb("/Read","The Bible book requested was not found");
}
if (!is_array(($bible_ALL = json_decode(file_get_contents('./library/Holy-Bible---AAA---Versions.json'),true)))) {
	abcms_bomb("/Read","The Bibles are unavailable",TRUE);
}
$_Part[1] = 'English---King-James-Version';
if (!is_array(($_BibleONE = @json_decode(file_get_contents('./library/Holy-Bible---'.$_Part[1].'---Aionian-Edition.json'),true))) || empty($_BibleONE['T_BOOKS'])) {
	abcms_bomb("/Read","Common Bible navigation is unavailable",TRUE);
}
if (!abcms_word_init_chap(TRUE) || 	$_Part[4]>$_BibleCHAP1_Last) {
	abcms_bomb("/Read","The Bible chapter verse requested was not found");
}
$_Part[1] = 'All';
$_Part[3] = intval($_Part[3]);
$_Part[4] = intval($_Part[4]);
abcms_html(TRUE,'class=word-read');
abcms_head(abcms_word_menu('all'));
echo "<div id='word' class='verseall'>\n";
echo ($menu=abcms_vall_menu());
echo "<div class='center' id='word-quick'>";
$last = NULL;
foreach( $bible_ALL as $bible => $version ) {
	if($last!=$version['LANGUAGEENGLISH'][0]) {	$last=$version['LANGUAGEENGLISH'][0]; echo "<a href='#Language_$last' title='Languages beginning with $last'>$last</a>"; }
}
echo "</div>\n";
$last = NULL;
$bible_ALL = array( 'Holy-Bible---English---Aionian-Bible2' => $bible_ALL['Holy-Bible---English---Aionian-Bible']) + $bible_ALL;
$count = 0;
foreach( $bible_ALL as $bible => $version ) {
	$_Part[1] = str_replace('Holy-Bible---','',$bible);
	$_Part[1] = ($_Part[1] == 'English---Aionian-Bible2' ? 'English---Aionian-Bible' : $_Part[1]);
	if (!is_array(($_BibleONE = @json_decode(file_get_contents('./library/Holy-Bible---'.$_Part[1].'---Aionian-Edition.json'),true))) || empty($_BibleONE['T_BOOKS'])) {
		abcms_errs("abcms_word_vers_all() bible not found!");
		continue;
	}
	if (!abcms_word_init_chap(TRUE)) { continue; }
	if($last!=$version['LANGUAGEENGLISH'][0] && $_Part[1] != 'English---Aionian-Bible') {
		$last=$version['LANGUAGEENGLISH'][0];
		$quick_id = "id='Language_$last'";
	}
	else {
		$quick_id = "";
	}	
	$rtl = (empty($_BibleONE['T_VERSIONS']['RTL']) ? "" : "dir='rtl'" );
	$rtlref = ($rtl ? 'rtlref' : '');
	$bible_lang = "<span lang='".$version['LANGUAGECODEISO']."' class='".$version['LANGUAGECSS']."'>";
	$language = "<span lang='en' class='eng'>".$version['LANGUAGEENGLISH']."</span>";
	$language .= ( $version['LANGUAGE']==$version['LANGUAGEENGLISH'] ? '' : ' ( '.$bible_lang.$version['LANGUAGE'].'</span> )' );
	$name = "<span lang='en' class='eng'>".$version['NAMEENGLISH']."</span>";
	$name .= ( $version['NAME']==$version['NAMEENGLISH'] ? '' : ' ( '.$bible_lang.$version['NAME'].'</span> )' );
	$_BibleONE_Lang = "<span lang='".$_BibleONE['T_VERSIONS']['LANGUAGECODEISO']."' $rtl class='".$_BibleONE['T_VERSIONS']['LANGUAGECSS'];
	if (empty($_BibleCHAP1[$_Part[4]])) {	$verse_text = "Verse not available"; }
	else {									$verse_text =  "$_BibleONE_Lang word-text'>".$_BibleCHAP1[$_Part[4]].'</span>'; ++$count; }
	echo "<div class='word-para-ref $rtlref' $quick_id><a href='".abcms_href("/Bibles/$_Part[1]/$_Part[2]/$_Part[3]",FALSE,TRUE,TRUE)."' title='View verse chapter'>".$language." ~ ".$name."</a></div>\n";
	if ($rtl) {	echo "<table class='word-rtl allverses'><tr><td class='word-text'>$verse_text</td></tr></table>\n"; }
	else {		echo "<div class='word-para-one allverses'><span class='word-text'>$verse_text</span></div>\n"; }
}
echo "<div>Verse Count = $count</div>\n";
echo "<div id='word-menu-bottom' class='always'>$menu</div>";
echo "</div>\n";
abcms_tail();	
}



/*** WORD VERS QUESTIONED ***/
function abcms_word_vers_questioned() {
global $_BibleONE, $_BibleONE_Lang, $_BibleBOOKS;
if (!is_array(($_BibleBOOKS = json_decode(file_get_contents('./library/Holy-Bible---AAA---Books.json'),true)))) {
	abcms_bomb("/Read","The Bible book list is unavailable",TRUE);
}
if (!is_array(($bible_ALL = json_decode(file_get_contents('./library/Holy-Bible---AAA---Versions.json'),true)))) {
	abcms_bomb("/Read","The Bibles are unavailable",TRUE);
}
abcms_html(TRUE,'class=word-read');
abcms_head("<div id='word-menu'><div class='word-menu-l'><span class='word-tocs'>All Questioned Verses</span></div></div>");
echo "<div id='word' class='questioned'>\n";
echo "<h2 class=center>Questioned Verses</h2>\n";
foreach( $bible_ALL as $bible => $version ) {
	$bible = str_replace('Holy-Bible---','',$bible);
	if (!is_array(($AIONIAN_ONE = json_decode(file_get_contents("./library/Holy-Bible---$bible---Aionian-Verses.json"),true)))) {
		abcms_errs("abcms_word_vers_questioned() Aionian verses not found!");
		continue;
	}
	if (!is_array(($_BibleONE = @json_decode(file_get_contents("./library/Holy-Bible---$bible---Aionian-Edition.json"),true))) || empty($_BibleONE['T_BOOKS'])) {
		abcms_errs("abcms_word_vers_questioned() bible not found!");
		continue;
	}
	$rtl = (empty($_BibleONE['T_VERSIONS']['RTL']) ? "" : "dir='rtl'" );
	$rtlref = ($rtl ? 'rtlref' : '');
	$bible_lang = "<span lang='".$version['LANGUAGECODEISO']."' class='".$version['LANGUAGECSS']."'>";
	$language = "<span lang='en' class='eng'>".$version['LANGUAGEENGLISH']."</span>";
	$language .= ( $version['LANGUAGE']==$version['LANGUAGEENGLISH'] ? '' : ' ( '.$bible_lang.$version['LANGUAGE'].'</span> )' );
	$name = "<span lang='en' class='eng'>".$version['NAMEENGLISH']."</span>";
	$name .= ( $version['NAME']==$version['NAMEENGLISH'] ? '' : ' ( '.$bible_lang.$version['NAME'].'</span> )' );
	$_BibleONE_Lang = "<span lang='".$_BibleONE['T_VERSIONS']['LANGUAGECODEISO']."' $rtl class='".$_BibleONE['T_VERSIONS']['LANGUAGECSS'];
	$x = 0;
	foreach( $AIONIAN_ONE['QUESTIONED'] as $vref1 => $verse1) {
		if (!$x) { echo "<div class='word-para-ref $rtlref'><a href='".abcms_href("/Bibles/$bible",FALSE,TRUE,TRUE)."' title='View Bible'>".$language." ~ ".$name."</a></div>\n"; }
		$stripe = (( $x % 2 == 0 ) ? 'even' : 'odd'); ++$x;
		$vref_link =
			"<a href='".abcms_href("/Bibles/$bible/".$_BibleBOOKS[(int)$verse1['INDEX']].'/'.(int)$verse1['CHAPTER'],FALSE,TRUE,TRUE)."' title='View chapter'>".
			"<span lang='en' class='eng'>".$_BibleBOOKS[$_BibleBOOKS[(int)$verse1['INDEX']]]['ENGLISH'].' '.(int)$verse1['CHAPTER'].':'.(int)$verse1['VERSE'].'</span>'.
			($_BibleBOOKS[$_BibleBOOKS[(int)$verse1['INDEX']]]['ENGLISH']==$_BibleONE['T_BOOKS'][$_BibleBOOKS[(int)$verse1['INDEX']]] ? '' :
			' '.$_BibleONE_Lang." word-para-ref'>".'('.$_BibleONE['T_BOOKS'][$_BibleBOOKS[(int)$verse1['INDEX']]].' '.$_BibleONE['T_NUMBERS'][(int)$verse1['CHAPTER']].':'.$_BibleONE['T_NUMBERS'][(int)$verse1['VERSE']].')</span>').
			'</a>';				
		$verse_number = (empty($_BibleONE['T_NUMBERS'][$x]) || $x==$_BibleONE['T_NUMBERS'][$x] ? '' : $_BibleONE_Lang." word-verse-lang'>".$_BibleONE['T_NUMBERS'][$x].'</span>');
		$verse_text = $_BibleONE_Lang." word-text'>".$verse1['TEXT'].'</span>';
		if ($rtl) {	echo "<table class='word-rtl $stripe'><tr><td class='word-refs rtlref'><span class='word-verse'>$vref_link</span></td></tr><tr><td class='word-text'>$verse_text</td></tr></table>\n"; }
		else {		echo "<div class='word-para $stripe aionian'><div class='word-para-ref'>$vref_link</div>\n<div class='word-para-one'>$verse_number$verse_text</div>\n</div>\n"; }
	}
	if ($x) { echo "<hr>"; }
}
echo "</div>\n";
abcms_tail();	
}



/*** STRONGS CHEK ***/
function abcms_stro_chek($nopage=FALSE) {
global $_Part, $_pnum, $_stid, $_stidC, $_stidN, $_stidX;
if (empty($_stid)) {
	if ($_Part[0]==='Strongs') { $_stidC = 'g166'; $_stidN = 166; }
	return TRUE;
}
if ($_Part[0]==='Glossary' || $_Part[0]==='Publisher') {
	return abcms_bomb("/Read","Invalid URL Requested, Strongs-Id not permitted in path",FALSE,$nopage);
}
if (!preg_match('#^([gh]{1})([\d]{1,5})([A-Za-z]{0,1})$#u',$_stidC,$matches)) {
	if ($_Part[0]!=='Strongs') { return abcms_bomb("/Read","The Strongs number requested was not found",FALSE,$nopage); }
}
else {
	$_stidN = intval($matches[2]);
	$_stidX = (empty($matches[3]) ? NULL : $matches[3]);
	$_stidC = $matches[1].$_stidN.$_stidX; // rebuild and loose leading zeros
	if (!(($_stidC[0]==='h' && $_stidN >= 1 && $_stidN <= 9049) ||
		($_stidC[0]==='g' && $_stidN >= 1 && $_stidN <= 21502 && $_stidN != 2717 && !($_stidN >= 3203 && $_stidN <= 3302) && !($_stidN >= 9997 && $_stidN <= 20000)))) {
		if ($_Part[0]!=='Strongs') { return abcms_bomb("/Read","The Strongs number requested was not found",FALSE,$nopage); }
		$_stidN = $_stidX = NULL;
	}
}
return TRUE;
}




/*** STRONGS ***/
function abcms_stro() {
global $_pnum, $_stidC, $_stidN;
if (!empty($_POST['sid'])) { exit(header("Location: ".abcms_href(TRUE,'',TRUE,"/strongs-".lcfirst(preg_replace('/[^a-zA-Z0-9]+/', '', $_POST['sid']))),true,302)); }
if ($_pnum===2) { abcms_word_init(); }
abcms_word_init_para();
abcms_html();
abcms_head();
// DISPLAY
?>
<div id='word'>
<div id='strong'>
<h2>Strong's Enhanced Concordance</h2>
The  <span class='notranslate'>Aionian</span>  Bible un-translates and instead transliterates eleven special words to help us better understand the extent of God’s love for individuals and all mankind, and the nature of afterlife destinies.  The original translation is unaltered and an inline note is appended to 64 Old Testament and 200 New Testament verses. Compare the definitions below to the <a href='/Glossary' title='Aionian Glossary' onclick='return AionianBible_Makemark("/Glossary");'><span class='notranslate'>Aionian</span> Glossary</a>. Follow the <span class='word-blue'>blue link</span> below to study the word's usage.  Search for any Strong's number: g1-21369 and h1-9049.<br>
<div class=center>
<form action='<? echo abcms_href(TRUE,'',TRUE,FALSE); ?>' method='post'>
<input type='text' name='sid' placeholder='Enter g1-21369 or h1-9049 for Greek and Hebrew Strongs numbers, for example g166' value=''>
<input type='submit' name='search' value='Search'>
</form>
</div>
<div id='strong-page'>
<?
if ($_stidN===NULL) { echo "The Strongs number requested was not found"; }
else { abcms_enty($_stidC); }
?>
</div>
</div>
</div>
<?
abcms_read_indx_line();
abcms_tail();
}



/*** ENTRY ***/
function abcms_enty($strongs,$tag=NULL,$book=NULL,$chap=NULL,$verse=NULL) {
// init
global $_stidC, $_stidN, $_Path, $_Part;

// LOOKUP ARRAYS
// jointype
static $jointype = array(
	"W"		=> "Next word",
	"W$"	=> "Next word (Hebrew root)",
	"W+"	=> "Next word (shares Strongs# with following word)",
	"C"		=> "Continue previous word",
	"C$"	=> "Continue previous word (Hebrew root)",
	"C+"	=> "Continue previous word (shares Strongs# with following word)",
	"J"		=> "Joined with previous word",
	"J$"	=> "Joined with previous word (Hebrew root)",
	"D"		=> "Divided from previous word",
	"D$"	=> "Divided from previous word (Hebrew root)",
	"L"		=> "Link previous-next word",
	"P"		=> "Punctuation",
	);

// TAGNT types
static $entry_type_greek = array(
	"(k)O"		=> "Minor variants in KJV sources, present in other sources, absent in Nestlé-Aland sources",
	"k"			=> "Minor not translated from KJV sources, absent in Nestlé-Aland and other sources",
	"K"			=> "Present in KJV sources, absent in Nestlé-Aland and other sources",
	"k(o)"		=> "Minor not translated from KJV sources, minor variants in other sources, absent in Nestlé-Aland sources",
	"K(o)"		=> "Present in KJV sources, minor variants in other sources, absent in Nestlé-Aland sources",
	"K(O)"		=> "Present in KJV sources, meaning variants in other sources, absent in Nestlé-Aland sources",
	"ko"		=> "Minor not translated from KJV and other sources, absent in Nestlé-Aland sources",
	"KO"		=> "Identical in KJV and other sources, absent in Nestlé-Aland sources",
	"n"			=> "Minor not translated from Nestlé-Aland sources, absent in KJV and other sources",
	"N"			=> "Present in Nestlé-Aland sources, absent in KJV and other sources",
	"N(k)"		=> "Present in Nestlé-Aland sources, minor variants in KJV sources, absent in other sources",
	"N(k)(o)"	=> "Present in Nestlé-Aland sources, minor variants in KJV and other sources",
	"N(k)(O)"	=> "Present in Nestlé-Aland sources, minor variants in KJV sources, meaning variants in other sources",
	"N(K)(o)"	=> "Present in Nestlé-Aland sources, meaning variants in KJV sources, minor variants in other sources",
	"N(K)(O)"	=> "Present in Nestlé-Aland sources, meaning variants in KJV and other sources",
	"N(k)O"		=> "Identical in Nestlé-Aland and other sources, minor variants in KJV sources",
	"N(K)O"		=> "Identical in Nestlé-Aland and other sources, meaning variants in KJV sources",
	"n(o)"		=> "Minor not translated from Nestlé-Aland sources, minor variants in other sources, absent in KJV sources",
	"N(o)"		=> "Present in Nestlé-Aland sources, minor variants in other sources, absent in KJV sources",
	"N(O)"		=> "Present in Nestlé-Aland sources, meaning variants in other sources, absent in KJV sources",
	"NK"		=> "Identical in Nestlé-Aland and KJV sources, absent in other sources",
	"NK(o)"		=> "Identical in Nestlé-Aland and KJV sources, minor variants in other sources",
	"NK(O)"		=> "Identical in Nestlé-Aland and KJV sources, meaning variants in other sources",
	"NKO"		=> "Identical in Nestlé-Aland, KJV, and other sources",
	"no"		=> "Minor not translated from Nestlé-Aland and other sources, absent in KJV sources",
	"NO"		=> "Identical in Nestlé-Aland and other sources, absent in KJV sources",
	"o"			=> "Minor not translated from other sources, absent in Nestlé-Aland and KJV sources",
	"O"			=> "Present in other sources, absent in Nestlé-Aland and KJV sources",
	);

// TAHOT types
static $entry_type_hebrew = array(
	"A"			=> "Aleppo",
	"B"			=> "Biblia Hebraica Stuttgartensia",
	"C"			=> "Cairensis",
	"D"			=> "Dead Sea and Judean Desert manuscripts",
	"E"			=> "Emendation from ancient sources",
	"F"			=> "Format pointing or word division difference without letter changes",
	"H"			=> "Ben Chaim (2nd Rabbinic Bible)",
	"K"			=> "Ketiv 'written' in the text with Tyndale pointing",
	"L"			=> "Leningrad",
	"L(a+bh)"	=> "Leningrad with minor variants: Aleppo plus BHS and Ben Chaim",
	"L(a+V)"	=> "Leningrad with minor variants: Aleppo plus meaning variants: other Hebrew manuscripts",
	"L(abh)"	=> "Leningrad with minor variants: Aleppo, BHS, and Ben Chaim",
	"L(ah+b)"	=> "Leningrad with minor variants: Aleppo and Ben Chaim plus BHS",
	"L(AH+B)"	=> "Leningrad with meaning variants: Aleppo and Ben Chaim plus BHS",
	"L(b)"		=> "Leningrad with minor variants: BHS",
	"L(b+p)"	=> "Leningrad with minor variants: BHS plus alternate punctuation",
	"L(bah)"	=> "Leningrad with minor variants: Aleppo, BHS, and Ben Chaim",
	"L(D)"		=> "Leningrad with meaning variants: Dead Sea and Judean Desert manuscripts",
	"L(E)"		=> "Leningrad with meaning variants: emendation from ancient sources",
	"L(F)"		=> "Leningrad with meaning variants: format pointing or word division difference without letter changes",
	"L(H)"		=> "Leningrad with meaning variants: Ben Chaim (2nd Rabbinic Bible)",
	"L(p)"		=> "Leningrad with minor variants: alternate punctuation",
	"L(P)"		=> "Leningrad with meaning variants: alternate punctuation",
	"L(S)"		=> "Leningrad with meaning variants: scribal traditions",
	"L(V)"		=> "Leningrad with meaning variants: other Hebrew manuscripts",
	"LA(bh)"	=> "Leningrad and Aleppo with minor variants: BHS and Ben Chaim",
	"LA(BH)"	=> "Leningrad and Aleppo with meaning variants: BHS and Ben Chaim",
	"LAB(h)"	=> "Leningrad, Aleppo, and BHS with minor variants: Ben Chaim",
	"LAB(H)"	=> "Leningrad, Aleppo, and BHS with meaning variants: Ben Chaim",
	"LAH(b)"	=> "Leningrad, Aleppo, and Ben Chaim with minor variants: BHS",
	"LB(ah)"	=> "Leningrad and BHS with minor variants: Aleppo and Ben Chaim",
	"LB(AH)"	=> "Leningrad and BHS with meaning variants: Aleppo and Ben Chaim",
	"LB(ha)"	=> "Leningrad and BHS with minor variants: Aleppo and Ben Chaim",
	"LBH(a)"	=> "Leningrad, BHS, and Ben Chaim with minor variants: Aleppo",
	"LBH(A)"	=> "Leningrad, BHS, and Ben Chaim with meaning variants: Aleppo",
	"LBH(a+C)"	=> "Leningrad, BHS, and Ben Chaim with minor variants: Aleppo plus meaning variants: Cairensis",
	"LH(ab)"	=> "Leningrad and Ben Chaim with minor variants: Aleppo and BHS",
	"P"			=> "Alternate punctuation",
	"Q"			=> "Qere 'spoken' corrections from margin and text pointing",
	"Q(k)"		=> "Qere 'spoken' corrections from margin and text pointing, with minor variants: Ketiv 'written', Tyndale pointing",
	"Q(K)"		=> "Qere 'spoken' corrections from margin and text pointing, with meaning variants: Ketiv 'written', Tyndale pointing",
	"R"			=> "Restored text based on Leningrad parallels",
	"S"			=> "Scribal traditions",
	"V"			=> "Variants from other Hebrew manuscripts",
	"X"			=> "Extra words from Septuagint (LXX), in Hebrew based on apparatus in BHS and BHK",
	);

// TAGNT editions
static $editions_replace = array(
	"#\+#u"			=> ", ",
	"#Byz#u"		=> "<a href='javascript:void(0)' title='Byzantine from Robinson/Pierpoint'>Byz</a>",
	"#Coptic#u"		=> "<a href='javascript:void(0)' title='Coptic Manuscript'>Coptic</a>",
	"#ESV#u"		=> "<a href='javascript:void(0)' title='English Standard Version'>ESV</a>",
	"#Goodnews#u"	=> "<a href='javascript:void(0)' title='Goodnews Bible'>Goodnews</a>",
	"#KJV#u"		=> "<a href='javascript:void(0)' title='King James Version'>KJV</a>",
	"#KJV\?#u"		=> "<a href='javascript:void(0)' title='King James Version (possibly)'>KJV?</a>",
	"#NA26#u"		=> "<a href='javascript:void(0)' title='Nestle/Aland 26th Edition'>NA26</a>",
	"#NA27#u"		=> "<a href='javascript:void(0)' title='Nestle/Aland 27th Edition'>NA27</a>",
	"#NA28#u"		=> "<a href='javascript:void(0)' title='Nestle/Aland 28th Edition, not ECM'>NA28</a>",
	"#Latin#u"		=> "<a href='javascript:void(0)' title='Latin'>Latin</a>",
	"#NIV#u"		=> "<a href='javascript:void(0)' title='New International Version'>NIV</a>",
	"#OldLatin#u"	=> "<a href='javascript:void(0)' title='Old Latin version'>OldLatin</a>",
	"#OldSyriac#u"	=> "<a href='javascript:void(0)' title='Old Syriac version'>OldSyriac</a>",
	"#P46#u"		=> "<a href='javascript:void(0)' title='Papyri #46'>P46</a>",
	"#P66#u"		=> "<a href='javascript:void(0)' title='Papyri #66'>P66</a>",
	"#P66\*#u"		=> "<a href='javascript:void(0)' title='Papyri #66 corrector'>P66*</a>",
	"#Punc#u"		=> "<a href='javascript:void(0)' title='Accent variant from punctuation'>Punc</a>",
	"#SBL#u"		=> "<a href='javascript:void(0)' title='Society of Biblical Literature Greek NT'>SBL</a>",
	"#Syriac#u"		=> "<a href='javascript:void(0)' title='Syriac'>Syriac</a>",
	"#TR#u"			=> "<a href='javascript:void(0)' title='Textus Receptus'>TR</a>",
	"#Treg#u"		=> "<a href='javascript:void(0)' title='Tregelles'>Treg</a>",
	"#Tyn#u"		=> "<a href='javascript:void(0)' title='Tyndale House GNT'>Tyn</a>",
	"#U1#u"			=> "<a href='javascript:void(0)' title='Uncial #1'>U1</a>",
	"#U2#u"			=> "<a href='javascript:void(0)' title='Uncial #2'>U2</a>",
	"#U3#u"			=> "<a href='javascript:void(0)' title='Uncial #3'>U3</a>",
	"#U4#u"			=> "<a href='javascript:void(0)' title='Uncial #4'>U4</a>",
	"#U5#u"			=> "<a href='javascript:void(0)' title='Uncial #5'>U5</a>",
	"#U6#u"			=> "<a href='javascript:void(0)' title='Uncial #6'>U6</a>",
	"#U32#u"		=> "<a href='javascript:void(0)' title='Uncial #32'>U32</a>",
	"#WH#u"			=> "<a href='javascript:void(0)' title='Westcott/Hort'>WH</a>",
	);
static $editions_search = NULL; if (NULL===$editions_search) { $editions_search = array_keys($editions_replace); } // edition search and replace

// LEXICONS			0		1		2		3			4		5		6
// HEBREW-STRONGS	STRONGS	WORD	TRANS	PRONOUNCE	LANG	MORPH	DEF
// GREEK-STRONGS	STRONGS	WORD	TRANS	PRONOUNCE	LANG	MORPH	DEF
// HEBREW-TYNDALE	STRONGS	STRONGU	WORD	TRANS		GLOSS	MORPH	DEF
// GREEK-TYNDALE	STRONGS	STRONGU	WORD	TRANS		GLOSS	MORPH	DEF
// GREEK-LSJ		STRONGS	STRONGU	WORD	TRANS		GLOSS	MORPH	DEF
//
// TAGS				0		1		2		3		4		5		6		7		8		9		10		11		12		13			14		15		16		17
// TAHOT/TAGNT		INDX	BOOK	CHAP	VERS	STRONGS	JOIN	TYPE	UNDER	TRANS	LEXICON	ENGLISH	GLOSS	MORPH	EDITIONS	VAR		SPELL	EXTRA	ALT
//
$bald = $baldyes = substr($strongs,1); // bald strongs
$baldbald = preg_replace("#[^\d]+#", "", $bald);
$baldnumb = $baldbald+0;
$logerror = ($tag ? TRUE : FALSE);
$lex_strongs = NULL;
if ($strongs[0]==='h') {
	// Strongs
	if ($baldnumb>0 && $baldnumb<=8674) { $lex_strongs = abcms_read_indx_line('./library/stepbible/Hebrew_Lexicon_Strongs.txt', './library/stepbible/Hebrew_Lexicon_Strongs_Index.json', $baldbald); }
	// Tyndale
	if (($lex_tyndale = abcms_read_indx_line('./library/stepbible/Hebrew_Lexicon_Tyndale.txt', './library/stepbible/Hebrew_Lexicon_Tyndale_Index.json', ($baldyes=$bald), $logerror)) ||
		($baldbald != $bald && ($lex_tyndale = abcms_read_indx_line('./library/stepbible/Hebrew_Lexicon_Tyndale.txt', './library/stepbible/Hebrew_Lexicon_Tyndale_Index.json', ($baldyes=$baldbald), $logerror))) ||
		($lex_tyndale = abcms_read_indx_line('./library/stepbible/Hebrew_Lexicon_Tyndale.txt', './library/stepbible/Hebrew_Lexicon_Tyndale_Index.json', ($baldyes="{$baldbald}G"), $logerror)) ||
		($lex_tyndale = abcms_read_indx_line('./library/stepbible/Hebrew_Lexicon_Tyndale.txt', './library/stepbible/Hebrew_Lexicon_Tyndale_Index.json', ($baldyes="{$baldbald}A")))) { ; }
	$lex_LSJ = NULL;
	// i/o data
	$family = abcms_read_indx_line(NULL, './library/stepbible/Hebrew_Lexicon_Tyndale_Index.json', $baldbald);
	$family = aion_hyperlink($family, 'h');
	$morphs = (empty($tag[12]) ? NULL : abcms_read_json('./library/stepbible/Hebrew_Morphhology.json', $tag[12]));
	if ($tag && !$morphs && $tag[5]!='P' && $tag[5]!='L') { abcms_errs("abcms_enty() tag morphhology not found! Strongs={$strongs} Morph={$tag[12]}"); }
	$morphs_tyndale = (empty($lex_tyndale[5]) ? NULL : aion_morphhology($lex_tyndale[5]));
	if ($lex_tyndale && !$morphs_tyndale) { abcms_errs("abcms_enty() tyndale morphhology not found! Strongs={$strongs} Morph={$lex_tyndale[5]}"); }
	$morphs_LSJ = NULL;
	$counts = abcms_read_json('./library/stepbible/Hebrew_Tagged_Text_Count.json', $bald, (!$tag ? TRUE : FALSE));
	if ($tag && !$counts) { abcms_errs("abcms_enty() tag counts not found! Strongs={$strongs}"); }
}
else {
	// Strongs
	if ($baldnumb>0 && $baldnumb<=5624) { $lex_strongs = abcms_read_indx_line('./library/stepbible/Greek_Lexicon_Strongs.txt', './library/stepbible/Greek_Lexicon_Strongs_Index.json', $baldbald); }
	// Tyndale & LSJ
	if (($lex_tyndale = abcms_read_indx_line('./library/stepbible/Greek_Lexicon_Tyndale.txt', './library/stepbible/Greek_Lexicon_Tyndale_Index.json', ($baldyes=$bald), $logerror)) ||
		($baldbald != $bald && ($lex_tyndale = abcms_read_indx_line('./library/stepbible/Greek_Lexicon_Tyndale.txt', './library/stepbible/Greek_Lexicon_Tyndale_Index.json', ($baldyes=$baldbald), $logerror))) ||
		($lex_tyndale = abcms_read_indx_line('./library/stepbible/Greek_Lexicon_Tyndale.txt', './library/stepbible/Greek_Lexicon_Tyndale_Index.json', ($baldyes="{$baldbald}G")))) { ; }
	if (($lex_LSJ = abcms_read_indx_line('./library/stepbible/Greek_Lexicon_LSJ.txt', './library/stepbible/Greek_Lexicon_LSJ_Index.json', ($baldyes2=$bald), $logerror)) ||
		($baldbald != $bald && ($lex_LSJ = abcms_read_indx_line('./library/stepbible/Greek_Lexicon_LSJ.txt', './library/stepbible/Greek_Lexicon_LSJ_Index.json', ($baldyes2=$baldbald), $logerror))) ||
		($lex_LSJ = abcms_read_indx_line('./library/stepbible/Greek_Lexicon_LSJ.txt', './library/stepbible/Greek_Lexicon_LSJ_Index.json', ($baldyes2="{$baldbald}G")))) { ; }
	// i/o data
	$family = abcms_read_indx_line(NULL, './library/stepbible/Greek_Lexicon_Tyndale_Index.json', $baldbald);
	$family = aion_hyperlink($family, 'g');
	$morphs = (empty($tag[12]) ? NULL : abcms_read_json('./library/stepbible/Greek_Morphhology.json', $tag[12]));
	if ($tag && !$morphs && $tag[5]!='P' && $tag[5]!='L') { abcms_errs("abcms_enty() tag morphhology not found! Strongs={$strongs} Morph={$tag[12]}"); }
	$morphs_tyndale = (empty($lex_tyndale[5]) ? NULL : aion_morphhology($lex_tyndale[5]));
	// Too many morphs missing - so no error for now
	// if ($lex_tyndale && !$morphs_tyndale) {
	//	abcms_errs("abcms_enty() tyndale morphhology not found! Strongs={$strongs} Morph={$lex_tyndale[5]}");
	//}
	// same with LSJ, no error reporting for missing morphs
	$morphs_LSJ = (empty($lex_LSJ[5]) ? NULL : aion_morphhology($lex_LSJ[5]));
	$counts = abcms_read_json('./library/stepbible/Greek_Tagged_Text_Count.json', $bald, (!$tag ? TRUE : FALSE));
	if ($tag && !$counts) { abcms_errs("abcms_enty() tag counts not found! Strongs={$strongs}"); }
}

// EARLY EXIT ASAP
// entry not found
if (!($word = htmlspecialchars(
	(!empty($tag[10]) ? $tag[10] : 
	(!empty($lex_tyndale[4]) ? $lex_tyndale[4] : 
	(!empty($lex_tyndale[2]) ? $lex_tyndale[2] :
	(!empty($lex_strongs[1]) ? $lex_strongs[1] : NULL))))))) {
	echo "<div class='strong-entry'><div class=strong-word>$strongs entry missing</div></div>\n";
	abcms_errs("abcms_enty() the word entry is empty! Strongs={$strongs}");
	return;
}

// fix the baldyes if bald strong index points to extended strongs, then test for fouled entry
if (!empty($lex_tyndale[0]) && preg_match("#^{$baldyes}[[:alpha:]]{1}$#", $lex_tyndale[0])) { $baldyes = $lex_tyndale[0]; }
if (!empty($lex_LSJ[0]) && preg_match("#^{$baldyes2}[[:alpha:]]{1}$#", $lex_LSJ[0])) { $baldyes2 = $lex_LSJ[0]; }
if ((!empty($lex_strongs[0]) && $baldbald!=$lex_strongs[0]) ||
	(!empty($lex_tyndale[0]) && $baldyes!=$lex_tyndale[0]) ||
	(!empty($lex_LSJ[0])     && $baldyes2!=$lex_LSJ[0])) {
	echo "<div class='strong-entry'><div class=strong-word>$strongs entry corrupted</div></div>\n";
	abcms_errs("abcms_enty() the strongs entry corrupted! Strongs={$strongs}");
	return;
}

// OKAY DOIT
// 			0		1		2		3		4		5		6		7		8		9		10			11			12			13			14		16		17		18
// NEW		INDX	BOOK	CHAP	VERS	STRONGS	JOIN	TYPE	UNDER	TRANS	LEXICON	ENGLISH		GLOSS		MORPH		EDITIONS	VAR		SPELL	EXTRA	ALT
// Strongs substitute
$lex_strongsub = NULL;
if ($lex_strongs && $bald != $baldbald) {
	$lex_strongsub = " &gt; <a href='".abcms_href((empty($_Part[1]) ? '/Strongs' : "/Strongs/{$_Part[1]}"),FALSE,TRUE,FALSE).
		"/strongs-{$strongs[0]}{$baldbald}' title='{$strongs[0]}{$baldbald} Strongs definition given, {$strongs[0]}{$baldyes} not provided.'>{$strongs[0]}{$baldbald}</a>";
}
$lex_substitute = NULL;
if ($lex_tyndale && $baldyes != $bald) {
	$lex_substitute = " &gt; <a href='".abcms_href((empty($_Part[1]) ? '/Strongs' : "/Strongs/{$_Part[1]}"),FALSE,TRUE,FALSE).
		"/strongs-{$strongs[0]}{$baldyes}' title='{$strongs[0]}{$baldyes} Tyndale definition given, {$strongs[0]}{$bald} not provided.'>{$strongs[0]}{$baldyes}</a>";
}
$lsj_substitute = NULL;
if ($lex_LSJ && $baldyes2 != $bald) {
	$lsj_substitute = " &gt; <a href='".abcms_href((empty($_Part[1]) ? '/Strongs' : "/Strongs/{$_Part[1]}"),FALSE,TRUE,FALSE).
		"/strongs-{$strongs[0]}{$baldyes2}' title='{$strongs[0]}{$baldyes2} LSJ definition given, {$strongs[0]}{$bald} not provided.'>{$strongs[0]}{$baldyes2}</a>";
}

// join
$join = (empty($tag[5]) || empty($jointype[$tag[5]]) ? NULL : $jointype[$tag[5]]);
if ($tag && !$join) { abcms_errs("abcms_enty() tag join not found! Strongs={$strongs} Join={$tag[5]}"); }

// type
$tagtype =
	((empty($tag[6]) ? NULL :
	(($strongs[0]==='h' && !empty($entry_type_hebrew[$tag[6]]))	? "[Tag={$tag[6]}] {$entry_type_hebrew[$tag[6]]}" :
	(($strongs[0]==='g' && !empty($entry_type_greek[$tag[6]]))	? "[Tag={$tag[6]}] {$entry_type_greek[$tag[6]]}" : NULL ))));
if ($tag && !$tagtype) { abcms_errs("abcms_enty() tag type not found! Strongs={$strongs} Type={$tag[6]}"); }

// underlying
$lexicon = (!empty($tag[9]) ? $tag[9] : (!empty($lex_tyndale[2]) ? $lex_tyndale[2] : NULL));
$underlying = (!empty($tag[7]) ? $tag[7] : (!empty($lex_tyndale[2]) ? $lex_tyndale[2] : NULL));
$underlying_strongs = (!empty($lex_strongs[1]) ? $lex_strongs[1] : NULL);
if (!($lexicon.$underlying.$underlying_strongs)) { abcms_errs("abcms_enty() underlying not found! Strongs={$strongs}"); }

// aionian
$aionian = abcms_aion($strongs,$SID,$word,$book,$chap,$verse);
if ($aionian && $strongs=='g1653') { $morphs['U'] = "an ACTION - by a person or thing being discussed"; } // correct the TAG morphhology for Romans 11:32

// css
$css_background = ($strongs==$_stidC || $baldnumb==$_stidN ? 'strongs' : ($aionian ? 'word-aionian' : ''));

// links
$bpath = ($_Path=='Strongs' ? abcms_href('/Read',FALSE,TRUE,'/strongs-'.$strongs) : abcms_href("/Bibles/$_Part[1]/".($strongs[0]==='g' ? 'New' : 'Old'),FALSE,TRUE,'/strongs-'.$strongs));
$usage =
	(!isset($counts[3]) ? "Not a primary reference, possibly a variation" :
	("<a href='$bpath' title='Visit chapters with Strongs word usage' class='word-blue'>".
	// Counts array(0=>'books',1=>'chapters',2=>'verses',3=>'words')
	$counts[3].($counts[3]===1 ? ' time in ':' times in ').
	$counts[0].($counts[0]===1 ? ' book, ':' books, ').
	$counts[1].($counts[1]===1 ? ' chapter, and ':' chapters, and ').
	$counts[2].($counts[2]===1 ? ' verse, ':' verses').
	'</a>'));
if ($tag && !isset($counts)) { abcms_errs("abcms_enty() tagged but no count! Strongs={$strongs}"); }

// language
$stronglang = (empty($lex_strongs[4]) ? '' :
	($lex_strongs[4]=='greek'	? 'Greek' :
	($strongs[0]=='g'			? 'Greek' :
	($lex_strongs[4]=='heb'		? 'Hebrew' :
	($lex_strongs[4]=='arc'		? 'Aramaic' :
	($lex_strongs[4]=='x-pn'	? 'Proper Name' : 'Hebrew'))))));

// SUBSTITUTIONS
// Editions, Greek only
if ($strongs[0]=='g') {
	$tag[13] = (empty($tag[13]) ? NULL : preg_replace($editions_search, $editions_replace, $tag[13])); // editions
	$tag[14] = (empty($tag[14]) ? NULL : preg_replace($editions_search, $editions_replace, $tag[14])); // var
	$tag[15] = (empty($tag[15]) ? NULL : preg_replace($editions_search, $editions_replace, $tag[15])); // spell
}
// Variations
if (!empty($tag[14]) && !($tag[14]=preg_replace("#\s*¦\s*#u", "<br>", $tag[14]))) { abcms_errs("abcms_enty() variation expansion failed! Strongs={$strongs}"); }

// javascript
static $elementid = 0;
++$elementid;
$javascript = "AionianBible_CollapseExpand(\"ab-lexicon\", \"ab-lexicon-$elementid\"); return false;";

// OUTPUT
// 			0		1		2		3		4		5		6		7		8		9		10			11			12			13			14		15		16		17
// NEW		INDX	BOOK	CHAP	VERS	STRONGS	JOIN	TYPE	UNDER	TRANS	LEXICON	ENGLISH		GLOSS		MORPH		EDITIONS	VAR		SPELL	EXTRA	ALT
echo
	// tag header
	"<div class='strong-entry {$css_background}'>" .
	"<div class='strong-word".($book ? '' : ' notranslate')."'>{$word}</div>\n" .
	"<div class='field-field'><div class='field-label'>Strongs:</div><div class='field-value word-footnote'>{$SID}</div></div>\n" .
	(empty($family)			? "" : "<div class='field-field'><div class='field-label'>Strongs extended:</div><div class='field-value'>{$family}</div></div>\n") .
	(empty($lexicon) || $lexicon==$underlying ? "" : "<div class='field-field'><div class='field-label'>Lexicon:</div><div class='field-value notranslate'>{$lexicon}</div></div>\n") .
	(empty($underlying)		? "" : "<div class='field-field'><div class='field-label'>".($strongs[0]==='h' ? 'Hebrew' : 'Greek').":</div><div class='field-value notranslate'>{$underlying}</div></div>\n") .
	(empty($tag[8])			? "" : "<div class='field-field'><div class='field-label'>Transliteration:</div><div class='field-value'>{$tag[8]}</div></div>\n") .
								   "<div class='field-field'><div class='field-label'>Usage:</div><div class=field-value>{$usage}</div></div>\n" .
	(empty($join)			? "" : "<div class='field-field'><div class='field-label'>Context:</div><div class='field-value'>{$join}</div></div>\n") .

	// collapsible
	(empty($tag)			? "" : "<div class='field-field'><div class='field-label'><a href='' title='Open or close the lexicon entry' onclick='$javascript'>Toggle Lexicon</a></div></div>\n") .
	(empty($tag)			? "" : "<div id='ab-lexicon-$elementid' class='ab-lexicon'>\n") .

	// gloss
	(empty($tag[11]) || $tag[11]==$word ? "" : "<div class='field-field'><div class='field-label'>Gloss:</div><div class='field-value'>{$tag[11]}</div></div>\n") .

	// morphhology array('M'=>'Morphhology','U'=>'Explanation')
	(empty($morphs['M'])	? "" : "<div class='field-field'><div class='field-label'>Morphhology:</div><div class='field-value'>{$morphs['M']}</div></div>\n") .
	(empty($morphs['U'])	? "" : "<div class='field-field'><div class='field-label'>Grammar:</div><div class='field-value'>{$morphs['U']}</div></div>\n") .

	// tag detail
	(empty($tagtype)		? "" : "<div class='field-field'><div class='field-label'>Source:</div><div class='field-value'>{$tagtype}</div></div>\n") .
	(empty($tag[13])		? "" : "<div class='field-field'><div class='field-label'>Editions:</div><div class='field-value'>{$tag[13]}</div></div>\n") .
	(empty($tag[14])		? "" : "<div class='field-field'><div class='field-label'>Variations:</div><div class='field-value'>{$tag[14]}</div></div>\n") .
	(empty($tag[15])		? "" : "<div class='field-field'><div class='field-label'>Other Spelling:</div><div class='field-value'>{$tag[15]}</div></div>\n") .
	(empty($tag[16])		? "" : "<div class='field-field'><div class='field-label'>Additional:</div><div class='field-value'>{$tag[16]}</div></div>\n") .
	(empty($tag[17])		? "" : "<div class='field-field'><div class='field-label'>Alternates:</div><div class='field-value'>{$tag[17]}</div></div>\n") .

	// lexicon: Aionian, Tyndale, LSJ, Strongs
	(!$aionian	? "" :
	("<div class='field-field word-aionian'><div class='field-header1'>Aionian Glossary</div></div>\n") .
	("<div class='field-field word-aionian'><div class='field-label'></div><div class='field-value'>{$aionian}</div></div>\n")) .
// LEXICONS			0		1		2		3			4		5		6
// HEBREW-STRONGS	STRONGS	WORD	TRANS	PRONOUNCE	LANG	MORPH	DEF
// GREEK-STRONGS	STRONGS	WORD	TRANS	PRONOUNCE	LANG	MORPH	DEF
// HEBREW-TYNDALE	STRONGS	STRONGU	WORD	TRANS		GLOSS	MORPH	DEF
// GREEK-TYNDALE	STRONGS	STRONGU	WORD	TRANS		GLOSS	MORPH	DEF
// GREEK-LSJ		STRONGS	STRONGU	WORD	TRANS		GLOSS	MORPH	DEF
	(!isset($lex_tyndale[0])	? "" :
	("<div class='field-field'><div class='field-header-no-bold'><span class='field-header1'>Tyndale</span>{$lex_substitute}</div></div>\n") .
	(empty($lex_tyndale[2]) ? "" : "<div class='field-field'><div class='field-label'>Word:</div><div class='field-value notranslate'>{$lex_tyndale[2]}</div></div>\n") .
	(empty($lex_tyndale[1]) ? "" : "<div class='field-field'><div class='field-label'>Origin:</div><div class='field-value notranslate'>{$lex_tyndale[1]}</div></div>\n") .
	(empty($lex_tyndale[3]) ? "" : "<div class='field-field'><div class='field-label'>Transliteration:</div><div class='field-value notranslate'>{$lex_tyndale[3]}</div></div>\n") .
	(empty($lex_tyndale[4]) ? "" : "<div class='field-field'><div class='field-label'>Gloss:</div><div class='field-value'>{$lex_tyndale[4]}</div></div>\n") .
	(empty($morphs_tyndale) ? "" : "<div class='field-field'><div class='field-label'>Morphhology:</div><div class='field-value'>{$morphs_tyndale}</div></div>\n") .
	(empty($lex_tyndale[6]) ? "" : "<div class='field-field'><div class='field-label'>Definition:</div><div class='field-value'>{$lex_tyndale[6]}</div></div>\n")) .
	(empty($lex_LSJ[0])	? "" :
	("<div class='field-field'><div class='field-header-no-bold'><span class='field-header1'>Liddell-Scott-Jones</span>{$lsj_substitute}</div></div>\n") .
	(empty($lex_LSJ[2]) ? "" : "<div class='field-field'><div class='field-label'>Word:</div><div class='field-value notranslate'>{$lex_LSJ[2]}</div></div>\n") .
	(empty($lex_LSJ[1]) ? "" : "<div class='field-field'><div class='field-label'>Origin:</div><div class='field-value notranslate'>{$lex_LSJ[1]}</div></div>\n") .
	(empty($lex_LSJ[3]) ? "" : "<div class='field-field'><div class='field-label'>Transliteration:</div><div class='field-value notranslate'>{$lex_LSJ[3]}</div></div>\n") .
	(empty($lex_LSJ[4]) ? "" : "<div class='field-field'><div class='field-label'>Gloss:</div><div class='field-value'>{$lex_LSJ[4]}</div></div>\n") .
	(empty($morphs_LSJ) ? "" : "<div class='field-field'><div class='field-label'>Morphhology:</div><div class='field-value'>{$morphs_LSJ}</div></div>\n") .
	(empty($lex_LSJ[6]) ? "" : "<div class='field-field'><div class='field-label'>Definition:</div><div class='field-value'>{$lex_LSJ[6]}</div></div>\n")) .
	(empty($lex_strongs[0])	? "" :
	("<div class='field-field'><div class='field-header-no-bold'><span class='field-header1'>Strongs</span>{$lex_strongsub}</div></div>\n") .
	(empty($lex_strongs[1]) ? "" : "<div class='field-field'><div class='field-label'>Word:</div><div class='field-value notranslate'>{$lex_strongs[1]}</div></div>\n") .
	(empty($lex_strongs[2]) ? "" : "<div class='field-field'><div class='field-label'>Transliteration:</div><div class='field-value notranslate'>{$lex_strongs[2]}</div></div>\n") .
	(empty($lex_strongs[3]) ? "" : "<div class='field-field'><div class='field-label'>Pronounciation:</div><div class='field-value notranslate'>{$lex_strongs[3]}</div></div>\n") .
	(empty($stronglang)		? "" : "<div class='field-field'><div class='field-label'>Language:</div><div class='field-value'>{$stronglang}</div></div>\n") .
	(empty($lex_strongs[5]) ? "" : "<div class='field-field'><div class='field-label'>Morphhology:</div><div class='field-value'>{$lex_strongs[5]}</div></div>\n") .
	(empty($lex_strongs[6]) ? "" : "<div class='field-field'><div class='field-label'>Definition:</div><div class='field-value'>{$lex_strongs[6]}</div></div>\n")) .
	(empty($tag)			? "" : "</div>\n");
	
echo "</div>\n";
}


/*** HYPERLINK ***/
function aion_hyperlink($text, $prefix=NULL) {
if (!empty($text) && !($text = preg_replace(
	"#(^| )([^ ]+)(,|$)#ui",
	"\$1<a href='/Strongs/strongs-{$prefix}\$2' onclick='return ABMM(\"/Strongs\",\"/strongs-{$prefix}\$2\");'>{$prefix}\$2</a>\$3",
	$text))) {
	abcms_errs("aion_hyperlink() preg_replace failed text={$text}");
}
return $text;
}


/*** MORPHHOLOGY ***/
function aion_morphhology($morph) {
// save the morphs!
static $lookup = array(
'A:A'=>'Aramaic Adjective',
'A:Adv'=>'Aramaic Adverb',
'A:Cond'=>'Aramaic Conditional',
'A:Conj'=>'Aramaic Conjunction',
'A:DemP'=>'Aramaic Demonstrative Pronoun',
'A:ImpP/A:Intg'=>'Aramaic Impersonal Pronoun / Interogative',
'A:ImpP'=>'Aramaic Impersonal Pronoun',
'A:Intg'=>'Aramaic Interogative',
'A:Intj'=>'Aramaic Interjection',
'A:PRT-I'=>'Aramaic Interogative',
'A:N--T'=>'Aramaic Noun Title',
'A:N-F'=>'Aramaic Noun Female',
'A:N-M'=>'Aramaic Noun Male',
'A:N'=>'Aramaic Noun',
'A:Neg'=>'Aramaic Negative',
'A:Part'=>'Aramaic Particle',
'A:PerP-CP'=>'Aramaic Personal Pronoun Common Plural',
'A:PerP-CS'=>'Aramaic Personal Pronoun Common Singular',
'A:PerP-MP'=>'Aramaic Personal Pronoun Male Plural',
'A:PerP-MS'=>'Aramaic Personal Pronoun Male Singular',
'A:Prep'=>'Aramaic Preposition',
'A:V+A:N'=>'Aramaic Verb Noun',
'A:V'=>'Aramaic Verb',
'G:A--C'=>'Greek Adjective Comparative',
'G:A--S'=>'Greek Adjective Superlative',
'G:A-F'=>'Greek Adjective Female',
'G:A-M'=>'Greek Adjective Male',
'G:A-NUI'=>'Greek Number (Indeclinable)',
'G:A/G:ADV'=>'Greek Adjective OR Adverb',
'G:ADV-C'=>'Greek Adverb Common',
'G:ADV-I'=>'Greek Adverb Interrogative',
'G:ADV-N'=>'Greek Adverb Neuter',
'G:ADV-S'=>'Greek Adverb Superlative',
'G:ADV-T'=>'Greek Adverb Title',
'G:ADV/G:A'=>'Greek Adverb OR Greek Adjective',
'G:ADV'=>'Greek Adverb',
'G:A'=>'Greek Adjective',
'G:C-'=>'Greek Pronoun',
'G:COND+G:PRT-N+G:CONJ'=>'Greek Conditional WITH Greek Negative WITH Greek Conjunction',
'G:COND+G:PRT-N'=>'Greek Conditional WITH Greek Negative',
'G:COND'=>'Greek Conditional',
'G:CONJ+G:P-1'=>'Greek Conjunction WITH Personal Pronoun (1st person)',
'G:CONJ-N'=>'Greek Conjunction Neuter',
'G:CONJ'=>'Greek Conjunction',
'G:D'=>'Greek Demonstrative Pronoun',
'G:F-1'=>'Greek Reflexive Pronoun (1st person)',
'G:F-2'=>'Greek Reflexive Pronoun (2nd person)',
'G:F-3'=>'Greek Reflexive Pronoun (3rd person)',
'G:'=>'Greek',
'G:I'=>'Greek Interogative',
'G:INJ'=>'Greek Interjection',
'G:K'=>'Greek Correlative',
'G:N-B'=>'Greek Noun Male/Female',
'G:N-F/G:A-F'=>'Greek Noun Female OR Adjective Female',
'G:N-F/G:V'=>'Greek Noun Female OR Verb',
'G:N-F'=>'Greek Noun Female',
'G:N-L'=>'Greek Noun Male/Neuter',
'G:N-LI'=>'Greek Letter (Indeclinable)',
'G:N-M'=>'Greek Noun Male',
'G:N-N'=>'Greek Noun Neuter',
'G:N-PRI'=>'Greek Noun Proper (Indeclinable)',
'G:N'=>'Greek Noun',
'G:P-1'=>'Greek Personal Pronoun (1st person)',
'G:P-2'=>'Greek Personal Pronoun (2nd person)',
'G:P'=>'Greek Personal Pronoun (3rd person)',
'G:PREP/G:A'=>'Greek Preposition OR Adjective',
'G:PREP'=>'Greek Preposition',
'G:PRT-I'=>'Greek Particle - Interogative',
'G:PRT-N+G:CONJ+G:PRT-N'=>'Greek Negative JOINED TO Greek Conjunction WITH Greek Negative',
'G:PRT-N+G:CONJ'=>'Greek Negative JOINED TO Greek Conjunction',
'G:PRT-N+G:PRT-N'=>'Greek Negative WITH Greek Negative',
'G:PRT-N'=>'Greek Particle Neuter',
'G:PRT'=>'Greek Particle',
'G:Q'=>'Greek Correlative or Interrogative',
'G:R'=>'Greek Relative Pronoun',
'G:S-1'=>'Greek Possessive Pronoun (1st person)',
'G:S-2'=>'Greek Possessive Pronoun (2nd person)',
'G:T+G:V+G:CONJ+G:T+G:V+G:CONJ+G:T+G:V'=>'Greek Article WITH Greek Verb WITH Greek Conjunction WITH Greek Article WITH Greek Verb WITH Greek Conjunction WITH Greek Article WITH Greek Verb',
'G:T'=>'Greek Article',
'G:V'=>'Greek Verb',
'G:W'=>'Greek',
'G:X'=>'Greek Indefinite Pronoun',
'G:Α'=>'Greek Adjective',
'H:A-F'=>'Hebrew Adjective Female',
'H:A-M'=>'Hebrew Adjective Male',
'H:A/H:N-M'=>'Hebrew Adjective OR Noun (Masculine)',
'H:A'=>'Hebrew Adjective',
'H:Adv'=>'Hebrew Adverb',
'H:Cond'=>'Hebrew Conditional',
'H:Conj'=>'Hebrew Conjunction',
'H:DemP'=>'Hebrew Demonstrative Pronoun',
'H:INJ'=>'Hebrew Interjection',
'H:IndP'=>'Hebrew Hebrew Indefinite Pronoun',
'H:Intg'=>'Hebrew Interogative',
'H:Intj'=>'Hebrew Interjection',
'H:N-B'=>'Hebrew Noun Male/Female',
'H:N-F'=>'Hebrew Noun Female',
'H:N-M/H:A'=>'Hebrew Noun (Masculine) OR Adjective',
'H:N-M/H:Adv'=>'Hebrew Noun (Masculine) OR Adverb',
'H:N-M/N:N--L'=>'Hebrew Noun (Masculine) OR Proper Name of a Location',
'H:N-M/N:N--T'=>'Hebrew Noun (Masculine) OR Proper Name of some kind',
'H:N-M/N:N-M-T'=>'Hebrew Noun (Masculine) OR Proper Name (Masculine) of some kind',
'H:N-M'=>'Hebrew Noun Male',
'H:N'=>'Hebrew Noun',
'H:Neg'=>'Hebrew Negative',
'H:Op1c'=>'Hebrew us, personal pronoun - verb/prep. 1st person common plural',
'H:Op2f'=>'Hebrew you, personal pronoun - verb/prep. 2nd person feminine plural',
'H:Op2m'=>'Hebrew you, personal pronoun - verb/prep. 2nd person masculine plural',
'H:Op3f'=>'Hebrew them, personal pronoun - verb/prep. 3rd person feminine plural',
'H:Op3m'=>'Hebrew them, personal pronoun - verb/prep. 3rd person masculine plural',
'H:Os1c'=>'Hebrew me, personal pronoun - verb/prep. suffix: 1st person common singular',
'H:Os2f'=>'Hebrew you, personal pronoun - verb/prep. 2nd person feminine singular',
'H:Os2m'=>'Hebrew you, personal pronoun - verb/prep. 2nd person masculine singular',
'H:Os3f'=>'Hebrew her, personal pronoun - verb/prep. 3rd person feminine singular',
'H:Os3m'=>'Hebrew him, personal pronoun - verb/prep. 3rd person masculine singular',
'H:PRT-I'=>'Hebrew Particle',
'H:Part'=>'Hebrew Particle',
'H:PerP-CP'=>'Hebrew Personal Pronoun Common Plural',
'H:PerP-CS'=>'Hebrew Personal Pronoun Common Singular',
'H:PerP-FP'=>'Hebrew Personal Pronoun Female Plural',
'H:PerP-FS'=>'Hebrew Personal Pronoun Female Singular',
'H:PerP-MP'=>'Hebrew Personal Pronoun Male Plural',
'H:PerP-MS'=>'Hebrew Personal Pronoun Male Singular',
'H:Pp1c'=>'Hebrew our, personal posessive - noun suffix: 1st person common plural',
'H:Pp2f'=>'Hebrew your, personal posessive - noun suffix: 2nd person feminine plural',
'H:Pp2m'=>'Hebrew your, personal posessive - noun suffix: 2nd person masculine plural',
'H:Pp3f'=>'Hebrew their, personal posessive - noun suffix: 3rd person feminine plural',
'H:Pp3m'=>'Hebrew their, personal posessive - noun suffix: 3rd person masculine plural',
'H:Prep+H:RelP'=>'Hebrew Preposition JOINED TO Relative Pronoun',
'H:Prep/H:Conj'=>'Hebrew Preposition OR Conjunction',
'H:Prep'=>'Hebrew Preposition',
'H:Ps1c'=>'Hebrew my, personal posessive - noun suffix: 1st person common singular',
'H:Ps2f'=>'Hebrew your, personal posessive - noun suffix: 2nd person feminine singular',
'H:Ps2m'=>'Hebrew your, personal posessive - noun suffix: 2nd person masculine singular',
'H:Ps3f'=>'Hebrew her, personal posessive - noun suffix: 3rd person feminine singular',
'H:Ps3m'=>'Hebrew his, personal posessive - noun suffix: 3rd person masculine singular',
'H:RelP'=>'Hebrew Relative Pronoun',
'H:Sp1c'=>'Hebrew we, subject pronoun - subject 1st person common plural',
'H:Sp2f'=>'Hebrew you, subject pronoun - subject 2nd person feminine plural',
'H:Sp2m'=>'Hebrew you, subject pronoun - subject 2nd person masculine plural',
'H:Sp3f'=>'Hebrew they, subject pronoun - subject 3rd person feminine plural',
'H:Sp3m'=>'Hebrew they, subject pronoun - subject 3rd person masculine plural',
'H:Ss1c'=>'Hebrew I, subject pronoun -  subject: 1st person common singular',
'H:Ss2f'=>'Hebrew you, subject pronoun - subject 2nd person feminine singular',
'H:Ss2m'=>'Hebrew you, subject pronoun - subject 2nd person masculine singular',
'H:Ss3f'=>'Hebrew she, subject pronoun - subject 3rd person feminine singular',
'H:Ss3m'=>'Hebrew he, subject pronoun - subject 3rd person masculine singular',
'H:V'=>'Hebrew Verb',
'N:A'=>'Proper Name Adjective',
'N:A--LG'=>'Proper Name Adjective Gentilic Location',
'N:A--PG'=>'Proper Name Adjective Gentilic Person',
'N:A-F'=>'Proper Name Adjective Feminine person',
'N:A--L'=>'Proper Name Adjective Location',
'N:ADV-T'=>'Proper Name Adverb',
'N:N' => 'Proper Name of a Location or Person with no stated gender',
'N:N--L/N:N--LG/N:N-M-P'=>'Proper Name of a Location OR of a Location in Gentilic sense OR of a Male Person',
'N:N--L/N:N--LG'=>'Proper Name of a Location OR of a Location in Gentilic sense',
'N:N--L/N:N-M-P'=>'Proper Name of a Location OR of a Male Person',
'N:N--L/N:N-M-T'=>'Proper Name of a Location OR Male of some kind',
'N:N--LG/N:N-M-P'=>'Proper Name of a Location in Gentilic sense OR of a Male Person',
'N:N--LG'=>'Proper Name Noun Gentilic Location',
'N:N--L'=>'Proper Name Noun Location',
'N:N--PG'=>'Proper Name Noun Gentilic Person',
'N:N--TG'=>'Proper Name Noun Gentilic Title',
'N:N--T'=>'Proper Name Noun Title',
'N:N-F-LG'=>'Proper Name Noun Female Gentilic Location',
'N:N-F-L'=>'Proper Name Noun Female Location',
'N:N-F-P/N:N--L'=>'Proper Name of a Female Person OR of a Location',
'N:N-F-PG'=>'Proper Name Noun Female Gentilic Person',
'N:N-F-P'=>'Proper Name Noun Female Person',
'N:N-F-T/N:N--L'=>'Proper Name of a Female of some kind OR of a Location',
'N:N-F-T'=>'Proper Name Noun Female Title',
'N:N-M-LG'=>'Proper Name Noun Male Gentilic Location',
'N:N-M-L'=>'Proper Name Noun Male Location',
'N:N-M-P/N:A'=>'Proper Name of a Male Person OR Adjectival',
'N:N-M-P/N:N--L'=>'Proper Name of a Male Person OR of a Location',
'N:N-M-P/N:N-F-P/N:N--L'=>'Proper Name of a Male Person OR of a Female Person OR of a Location',
'N:N-M-P/N:N-F-P'=>'Proper Name of a Male Person OR of a Female Person',
'N:N-M-P/N:N-M-PG'=>'Proper Name of a Male Person OR of a Male Person in Gentilic sense',
'N:N-M-P/N:N-M-T'=>'Proper Name of a Male Person OR Male of some kind',
'N:N-M-PG'=>'Proper Name Noun Male Gentilic Person',
'N:N-M-P'=>'Proper Name Noun Male Person',
'N:N-M-T'=>'Proper Name Noun Male Title',
'Prefix'=>'Prefix',
'Punct.'=>'Punctuation',
'Suffix'=>'Suffix',
);
// check
if (empty($morph)) { return ""; }
if (empty($lookup[$morph])) { abcms_errs("aion_morphhology() morphhology not found! $morph"); return ""; }
return $lookup[$morph];
}



/*** AIONIAN ***/
function abcms_aion($strongs,&$SID,&$word,$book=NULL,$chap=NULL,$verse=NULL) {
global $_Part;
// aionian glossary definitions
$SID = (NULL===$book ? $strongs :
	"<a href='".abcms_href((empty($_Part[1]) ? '/Strongs' : "/Strongs/$_Part[1]"),FALSE,TRUE,FALSE).
	"/strongs-$strongs' title='Strongs Enhanced Concordance entry $strongs' class='word-blue'>$strongs</a>");
$strongs = (($tmp=preg_replace("#[A-Za-z]{1}$#", "", $strongs)) ? $tmp : $strongs);
if (($strongs=='g1653' && $book && ($book!='ROM' || !($chap=='011' && $verse=='032'))) ||
	(($strongs=='g3041' || $strongs=='g4442') &&
	($book!='REV' ||
	!(($chap=='019' && $verse=='020') ||
	  ($chap=='020' && $verse=='010') ||
	  ($chap=='020' && $verse=='014') ||
	  ($chap=='020' && $verse=='015') ||
	  ($chap=='021' && $verse=='008'))))) {
	return NULL;
}
static $slink = NULL;
if ($slink===NULL) {
	$gpath = abcms_href((empty($_Part[1]) ? '/Glossary' : "/Glossary/$_Part[1]"),FALSE,TRUE,FALSE);
	$slink = array(
		'g12'	=> "<a href='$gpath#g12'   title='Aionian Glossary'>g12</a>",
		'g126'	=> "<a href='$gpath#g126'  title='Aionian Glossary'>g126</a>",
		'g165'	=> "<a href='$gpath#g165'  title='Aionian Glossary'>g165</a>",
		'g1653'	=> "<a href='$gpath#g1653' title='Aionian Glossary'>g1653</a>",
		'g166'	=> "<a href='$gpath#g166'  title='Aionian Glossary'>g166</a>",
		'g1067'	=> "<a href='$gpath#g1067' title='Aionian Glossary'>g1067</a>",
		'g86'	=> "<a href='$gpath#g86'   title='Aionian Glossary'>g86</a>",
		'h7585'	=> "<a href='$gpath#h7585' title='Aionian Glossary'>h7585</a>",
		'g5020'	=> "<a href='$gpath#g5020' title='Aionian Glossary'>g5020</a>",
		'g3041'	=> "<a href='$gpath#g3041' title='Aionian Glossary'>g3041</a>",
		'g4442'	=> "<a href='$gpath#g4442' title='Aionian Glossary'>g4442</a>",
	);
}
if (isset($slink[$strongs])) { $SID = $slink[$strongs]; }
static $adef = array(
	'g12'	=> "Temporary prison for special fallen angels such as Apollyon, the Beast, and Satan.",
	'g126'	=> "Lasting, enduring forever, eternal.",
	'g165'	=> "A lifetime or time period with a beginning and end, an era, an age, the completion of which is beyond human perception, but known only to God the creator of the aiōns, Hebrews 1:2. Never meaning simple <i>endless or infinite chronological time</i> in Koine Greek usage. Read <a href='/Aionios-and-Aidios'>Dr. Heleen Keizer and Ramelli and Konstan</a> for proofs.",
	'g1653'	=> "To have pity on, to show mercy. Typically, the subjunctive mood indicates possiblity, not certainty. However, a subjunctive in a purpose clause is a resulting action as certain as the causal action. The subjunctive in a purpose clause functions as an indicative, not an optative. Thus, the grand conclusion of grace theology in <a href='/Bibles/English---Aionian-Bible/Romans/11' onclick='return ABMM(\"/Bibles\",\"/Romans/11\");'>Romans 11:32</a> must be clarified. God's mercy on all is not a possibility, but a certainty. See <a href='https://www.ntgreek.org' target='_blank'>www.ntgreek.org</a>.",
	'g166'	=> "From start to finish, pertaining to the age, lifetime, entirety, complete, or even consummate. Never meaning simple <i>endless or infinite chronological time</i> in Koine Greek usage. Read <a href='/Aionios-and-Aidios'>Dr. Heleen Keizer and Ramelli and Konstan</a> for proofs.",
	'g1067'	=> "Valley of Hinnom, Jerusalem's trash dump, a place of ruin, destruction, and judgment in this life or the next, though not eternal to Jesus' audience.",
	'g86'	=> "Synonomous with <i>Sheol</i>, though in New Testament usage <i>Hades</i> is the temporal place of punishment for deceased unbelieving mankind, distinct from <i>Paradise</i> for deceased believers.",
	'h7585'	=> "The grave or temporal afterlife world of both the righteous and unrighteous, believing and unbelieving, until the general resurrection.",
	'g5020'	=> "Temporary prison for particular fallen angels awaiting final judgment.",
	'g3041'	=> "Lake of Fire, final punishment for those not named in the Book of Life, prepared for the Devil and his angels, Matthew 25:41.",
	'g4442'	=> "Lake of Fire, final punishment for those not named in the Book of Life, prepared for the Devil and his angels, Matthew 25:41.",
);
static $aword = array(
	'g12'	=> "Abyssos",
	'g126'	=> "aïdios",
	'g165'	=> "aiōn",
	'g1653'	=> "eleēsē",
	'g166'	=> "aiōnios",
	'g1067'	=> "Geenna",
	'g86'	=> "Hadēs",
	'h7585'	=> "Sheol",
	'g5020'	=> "Tartaroō",
	'g3041'	=> "Lake",
	'g4442'	=> "of Fire",
);
if (isset($aword[$strongs])) { $word = $aword[$strongs]; }
return (empty($adef[$strongs]) ? NULL : $adef[$strongs]);
}




/*** READ JSON ARRAY KEY ***/
function abcms_read_json($file, $key, $allowmissing=FALSE) {
static $cache = array();
if (!isset($cache[$file]) && !($cache[$file]=json_decode(file_get_contents($file),true))) {
	abcms_errs("abcms_read_json() json file not found: $file $key");
	$cache[$file] = array();
	return NULL;
}
if (!isset($cache[$file][$key])) {
	if (!$allowmissing) {
		abcms_errs("abcms_read_json() json file key not found: $file $key");
	}
	return NULL;
}
return $cache[$file][$key];
}




/*** HTML ***/
function abcms_html($goodpage=TRUE,$bodystuff='',$collapse='false') {
global $_para, $_stid, $_meta, $_Path, $_Part, $_pnum, $_BibleONE, $_BibleTWO;
if (!$goodpage) { http_response_code(404); $_meta = 'Page not found'; }
?>
<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='utf-8'>
<title>Holy Bible Aionian Edition®<?echo $_meta;?></title>
<meta name='description' content="Holy Bible Aionian Edition® ~ The world's first Holy Bible untranslation!<?echo $_meta;?>">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name='mobile-web-app-capable' content='yes'>
<meta name="generator" content="ABCMS™">
<meta http-equiv='x-ua-compatible' content='ie=edge'>
<?
if ($_para ||
	$_Part[0]=='Parallel' ||
	($_stid && $_Path!='Strongs') ||
	(($_Part[0]==='Glossary' || $_Part[0]==='Strongs') && $_pnum!=1)) {
	echo "<meta name='robots' content='noindex'>";
}
?>
<meta property="og:url" content="https://www.aionianbible.org">
<meta property="og:type" content="website">
<meta property="og:title" content="Holy Bible Aionian Edition">
<meta property="og:description" content="Holy Bible Aionian Edition<?echo $_meta;?>">
<meta property="og:image" content="/images/MEME-AionianBible-The-Worlds-First-Bible-Untranslation-1.jpg">
<meta property="og:image" content="/images/MEME-AionianBible-The-Worlds-First-Bible-Untranslation-2.jpg">
<meta property="og:image" content="/images/MEME-AionianBible-The-Worlds-First-Bible-Untranslation-3.jpg">
<meta property="og:image" content="/images/MEME-AionianBible-The-Worlds-First-Bible-Untranslation-4.jpg">
<link rel='shortcut icon' href='/favicon.ico' type='image/x-icon'>
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel='stylesheet' href='/styles/style.css'>
<?
if ($_Path=='Bibles' || $_Path=='Read' || $_Part[0]=='Parallel' || strpos($_Path, 'Debug')===0) {	echo "<noscript><link rel='stylesheet' type='text/css' href='/styles/style-all.css'></noscript>"; }
else {	if (!empty($_BibleONE['T_VERSIONS']['LANGUAGESTYLE'])) {	echo "<noscript><link rel='stylesheet' type='text/css' href='/styles/".$_BibleONE['T_VERSIONS']['LANGUAGESTYLE']."'></noscript>"; }
		if (!empty($_BibleTWO['T_VERSIONS']['LANGUAGESTYLE'])) {	echo "<noscript><link rel='stylesheet' type='text/css' href='/styles/".$_BibleTWO['T_VERSIONS']['LANGUAGESTYLE']."'></noscript>"; }
}
?> 
<script><?echo "var AB_Collapse = $collapse;";?></script>
<script src="/script.js"></script>
</head>
<body <?echo $bodystuff;?> >
<? 
}



/*** HEAD ***/
function abcms_head($headlo='',$good=TRUE) {
// menu
?>
<div id='page'>
<div id='sticky-body'>
<div id='head'>
<div id='head-hi'>
<div id='logo1'><a href='/' title='Aionian Bible homepage'><img src='/images/Holy-Bible-Aionian-Edition-PURPLE-LOGO.png' alt='Aionian Bible'></a></div>
<div id='logo2'><a href='/' title='Aionian Bible homepage'><img src='/images/Holy-Bible-Aionian-Edition-PURPLE-AB.png' alt='Aionian Bible'></a></div>
<div id='menu'>
<?
global $_Path, $_Part;
// preface
if ($_Path==='Preface') {					echo "<a href='#' title='Preface and mission' >Preface</a>"; }
else {										echo "<a href='/Preface' title='Preface and mission' >Preface</a>"; }
// bible
if ($good && $_Part[0]==='Bibles') {		echo "<a href='".abcms_href("/Read",FALSE,TRUE,TRUE)."' title='Read and Study Bible'>Bibles</a>"; }
else if ($good && (
	$_Part[0]==='Parallel' ||
	$_Part[0]==='Strongs' ||
	$_Part[0]==='Glossary')) {				echo "<a href='".abcms_href("/Bibles",TRUE,TRUE,TRUE)."' title='Bookmarked Bible' onclick='return AionianBible_Bookmark(".'""'.");'>Read</a>"; }
else if ($_Path==='Read') {					echo "<a href='/Read' title='Bookmarked Bible' onclick='return AionianBible_Bookmark(".'"/Read"'.");'>Read</a>"; }
else {										echo "<a href='/Read' title='Bookmarked Bible' onclick='return AionianBible_Bookmark(".'"/Read"'.");'>Read</a>"; }
// end
echo "<a href='#' title='Font Size Accessibility' onclick='AionianBible_Accessible();' id='accessible'>+</a>";
echo "</div></div>\n";
if (!empty($headlo)) { echo "<div id='head-lo'>$headlo</div>\n"; }
echo "</div><div id='body' class=''>\n";
}



/*** TAIL ***/
function abcms_tail($good=TRUE) {
global $_Orig, $_Path, $_Part, $_meta, $_BibleONE, $_BibleTWO, $_SwipePREV, $_SwipeNEXT;
// share urls from https://github.com/bradvin/social-share-urls
$url = ($good ? urlencode(($url0=("https://www.AionianBible.org/".preg_replace('/\s+/', ' ',$_Path)))) : urlencode($url0="https://www.AionianBible.org"));
$title = ($good ? urlencode(($title0=preg_replace('/\s+/', ' ',"Holy Bible Aionian Edition® $_meta"))) : urlencode($title0="Holy Bible Aionian Edition® ~ Homepage"));
$social  = "<a href='https://www.facebook.com/sharer.php?u=$url' target='_blank'><img src='/social/facebook.png' title='Facebook post' class='img25'></a>";
$social .= "<a href='https://x.com/intent/tweet?url=$url&text=$title&hashtags=AionianBible' target='_blank'><img src='/social/x.png' title='X/Twitter post' class='img25'></a>";
$social .= "<a href='https://www.linkedin.com/sharing/share-offsite/?url=$url' target='_blank'><img src='/social/linkedin.png' title='LinkedIn post' class='img25'></a>";
$social .= "<a href='https://reddit.com/submit?url=$url&title=$title' target='_blank'><img src='/social/reddit.png' title='Reddit post' class='img25'></a>";
$social .= "<a href='https://www.tumblr.com/widgets/share/tool?canonicalUrl=$url&title=$title&tags=AionianBible' target='_blank'><img src='/social/tumblr.png' title='Tumblr post' class='img25'></a>";
$social .= "<a href='https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=$url' target='_blank'><img src='/social/qzone.png' title='Qzone post' class='img25'></a>";
$social .= "<a href='https://vk.com/share.php?url=$url&title=$title' target='_blank'><img src='/social/vk.png' title='VK post' class='img25'></a>";
$social .= "<a href='https://service.weibo.com/share/share.php?url=$url&appkey=&title=$title&pic=&ralateUid=' target='_blank'><img src='/social/weibo.png' title='Weibo post' class='img25'></a>";
$social .= "<a href='mailto:?subject=".preg_replace("/ /","%20","$title0&body=$url0")."' target='_blank'><img src='/social/email.png' title='Email link' class='img25'></a>";
?>
<div id='social-footer'>
<div id='google_translate_element'></div>
<div id='social-shares'>
<?echo $social;?><br>
<a href='/EmailNews' target='_blank' title='EmailNews/AionianBible'><img src='/images/Aionian-Bible-Button-Your-Gift-Email-Newsletter.png' alt='EmailNews' title='Aionian Bible Gift and Newsletter' class='img25'></a><a href='/Facebook' target='_blank' title='Facebook/AionianBible'><img src='/images/Aionian-Bible-Facebook.png' title='Aionian Bible on Facebook' class='img25'></a><a href='/X' target='_blank' title='X/AionianBible Twitter'><img src='/images/Aionian-Bible-X.png' title='Aionian Bible on X/Twitter' class='img25'></a><a href='/LinkedIn' target='_blank' title='LinkedIn/AionianBible'><img src='/images/Aionian-Bible-LinkedIn.png' title='Aionian Bible on LinkedIn' class='img25'></a><a href='/Instagram' target='_blank' title='Instagram/AionianBible'><img src='/images/Aionian-Bible-Instagram.png' title='Aionian Bible on Instagram' class='img25'></a><a href='/Pinterest' target='_blank' title='Pinterest/AionianBible'><img src='/images/Aionian-Bible-Pinterest.png' alt='Pinterest' title='Aionian Bible on Pinterest' class='img25'></a><a href='/YouTube' target='_blank' title='YouTube/AionianBible'>	<img src='/images/Aionian-Bible-Youtube.png' title='Aionian Bible on Youtube' class='img25'></a><a href='/Google-Play' target='_blank' title='GooglePlay/AionianBible'><img src='/images/Aionian-Bible-GooglePlay.png' alt='GooglePlay' title='Aionian Bible on GooglePlay' class='img25'></a><a href='/TOR/<?echo $_Orig;?>' target='_blank' title='TOR/AionianBible'><img src='/images/Aionian-Bible-TOR.png' alt='TOR' title='Aionian Bible on The Onion Router network' class='img25'></a><a href='/Buy' title='Buy Aionian Bibles and T-Shirts'><img src='/images/Aionian-Bible-Button-Buy-Square.png' title='Buy Aionian Bible in print' class='img25'></a>
</div>
<script>function googleTranslateElementInit() { new google.translate.TranslateElement({pageLanguage: 'xx' }, 'google_translate_element'); }</script>
<script src='//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit'></script>
</div>
</div>
<div id='sticky-push'></div>
</div>
<div id='sticky-foot'> 	
<div id='tail'><a href='/Publisher' title='Contact Nainoia, Inc'>The world's first Holy Bible un-translation!</a></div>
</div>
</div>
<?
echo "<script>AionianBible_SwipeLinks('$_SwipePREV','$_SwipeNEXT');</script>";
abcms_jsonld($good);
if ($_Path=='Bibles' || $_Path=='Read' || $_Part[0]=='Parallel' || strpos($_Path, 'Debug')===0) {?>
<script>
/* www.giftofspeed.com/defer-loading-css */
var deferload = document.createElement('link');
deferload.rel = 'stylesheet';
deferload.href = '/styles/style-all.css';
deferload.type = 'text/css';
var defergo = document.getElementsByTagName('link')[0];
defergo.parentNode.insertBefore(deferload, defergo);
</script>
<?} else if (!empty($_BibleONE['T_VERSIONS']['LANGUAGESTYLE']) || !empty($_BibleTWO['T_VERSIONS']['LANGUAGESTYLE'])) {?>
<script>
<? if (!empty($_BibleONE['T_VERSIONS']['LANGUAGESTYLE'])) {?>
var deferload1 = document.createElement('link');
deferload1.rel = 'stylesheet';
deferload1.href = '/styles/<?echo $_BibleONE['T_VERSIONS']['LANGUAGESTYLE'];?>';
deferload1.type = 'text/css';
var defergo1 = document.getElementsByTagName('link')[0];
defergo1.parentNode.insertBefore(deferload1, defergo1);
<?} if (!empty($_BibleTWO['T_VERSIONS']['LANGUAGESTYLE'])) {?>
var deferload2 = document.createElement('link');
deferload2.rel = 'stylesheet';
deferload2.href = '/styles/<?echo $_BibleTWO['T_VERSIONS']['LANGUAGESTYLE'];?>';
deferload2.type = 'text/css';
var defergo2 = document.getElementsByTagName('link')[0];
defergo2.parentNode.insertBefore(deferload2, defergo2);
<?}?>
</script>
<?}?> 
</body>
</html>
<?
exit;
}



/*** JSON+LD ***/
function abcms_jsonld($good) {
global $_Path, $_Part, $_pnum, $_meta, $_BibleONE, $_BibleCHAP1;
// bad page
if (!$good) { return; }
// homepage
if ($_Path==='') {
	$jsonld = '
[
{
  "@context" : "https://schema.org",
  "@type" : "WebSite",
  "url" : "https://www.AionianBible.org",
  "name" : "AionianBible.org ~ The Holy Bible Aionian Edition®",
  "headline" : "One hundred seventy-four Bible versions. Seventy-three world languages. 100% free to copy and print. Also known as \'The Purple Bible\'",
  "description" : "The Holy Bible Aionian Edition® ~ The World\'s First Holy Bible Untranslation",
  "text" : "For God so loved the world, that he gave his one and only Son, that whoever believes in him should not perish, but have... Aionian Life! John 3:16",
  "genre" : "http://vocab.getty.edu/aat/300055271",
  "inLanguage" : "en-US",
  "keywords" : "Christian,Holy,Bible,Scripture,Word,salvation,grace,truth,aiōn,aion,aiōnios,aionios,aionian,aïdios,untranslation,translation,free,online,website,public domain,creative commons",
  "copyrightYear" : 2016,
  "educationalUse" : "to restore relationship to God and all mankind with the truth, personal transformation, and growth",
  "isAccessibleForFree" : "True",
  "isFamilyFriendly" : "True",
  "typicalAgeRange" : "4-100",
  "isBasedOn" : { "@id": "https://www.AionianBible.org/#Bible" },
  "translationOfWork" : { "@id": "https://www.AionianBible.org/#Bible" },
  "mainEntity" : { "@id": "https://www.AionianBible.org/#Bible" },
  "discussionUrl" : "https://www.facebook.com/aionianbible",
  "sameAs" : "https://www.facebook.com/aionianbible",
  "author" : { "@id": "https://www.AionianBible.org/Publisher/#NainoiaInc" },
  "translator" : { "@id": "https://www.AionianBible.org/Publisher/#NainoiaInc" },
  "editor" : { "@id": "https://www.AionianBible.org/Publisher/#eScribes" },
  "copyrightHolder" : { "@id": "https://www.AionianBible.org/Publisher/#NainoiaInc" },
  "provider" : { "@id": "https://www.AionianBible.org/Publisher/#NainoiaInc" },
  "funder" : { "@id": "https://www.AionianBible.org/Publisher/#NainoiaInc" },
  "publisher" : { "@id": "https://www.AionianBible.org/Publisher/#NainoiaInc" }
},
{
  "@context" : "https://schema.org",
  "@type" : "Book",
  "@id" : "https://www.AionianBible.org/#Bible",
  "url" : "https://www.AionianBible.org",
  "name" : "Bible",
  "abridged" : "False",
  "bookEdition" : "Original autograph",
  "headline" : "Holy Bible",
  "educationalUse" : "to restore relationship to God and all mankind with the truth, personal transformation, and growth",
  "keywords" : "Christian,Holy,Bible,Scripture,Word,salvation,grace,truth,doctrine,teaching,help,hope,inspired,teach,rebuke,correct,train",
  "description" : "Christian Scripture inspired by God the Holy Spirit for teaching, rebuking, correcting, and training in righteousness",
  "genre" : "http://vocab.getty.edu/aat/300264513",
  "inLanguage" : "en-US",
  "author" : { "@id": "https://www.AionianBible.org/#God" },
  "editor" : { "@id": "https://www.AionianBible.org/#God" },
  "copyrightHolder" : { "@id": "https://www.AionianBible.org/#God" },
  "provider" : { "@id": "https://www.AionianBible.org/#God" },
  "funder" : { "@id": "https://www.AionianBible.org/#God" },
  "publisher" : { "@id": "https://www.AionianBible.org/#God" }
},
{
  "@context" : "https://schema.org",
  "@type" : "Person",
  "@id" : "https://www.AionianBible.org/#God",
  "url" : "https://www.AionianBible.org",
  "name" : "God",
  "givenName" : "Jesus Christ, Messiah",
  "additionalName" : "YHWH",
  "alternateName" : "Our Father in Heaven",
  "honorificPrefix" : "Holy",
  "jobTitle" : "Benevolent sovereign ruler and redeemer of all creation",
  "description" : "All-wise, all-loving, almighty, all-knowing, omnipresent, intimately-present, the Holy Trinity, God the Father, Son, and Holy Spirit"
}
]
';
}
// publisher
else if ($_Path==='Publisher') {
	$jsonld = '
[
{
  "@context" : "https://schema.org",
  "@type" : "Organization",
  "@id": "https://www.AionianBible.org/Publisher/#NainoiaInc",
  "url" : "https://www.AionianBible.org/Publisher",
  "name" : "Nainoia, Inc.",
  "legalName" : "Nainoia, Inc.",
  "description" : "Nainoia, Inc. exists for Christian mission promotion, technical support services, and Bible publication. The sky is not our limit… our limit is the God who knows no limits! We hope to pray and plan with you further! Ora et labora! Pray and work!",
  "logo" : "https://nainoia-inc.signedon.net/logo.png",
  "areaServed" : "world-wide",
  "foundingDate" : "2016-12-07",
  "foundingLocation" : "Bellefonte, PA  U.S.A.",
  "telephone" : "+1-814-470-8028",
  "address" : {
     "@type" : "PostalAddress",
     "streetAddress" : "PO Box 462",
     "addressLocality" : "Bellefonte",
     "addressRegion" : "PA",
     "postalCode" : "16823",
     "addressCountry" : "USA"
  },
  "contactPoint" : {
    "@type" : "ContactPoint",
    "contactType" : "Customer Service",
    "telephone" : "+1-814-470-8028",
    "url" : "https://www.AionianBible.org/Publisher"
  },
  "sameAs" : "https://nainoia-inc.signedon.net"
},
{
  "@context" : "https://schema.org",
  "@type" : "Person",
  "@id": "https://www.AionianBible.org/Publisher/#eScribes",
  "url" : "https://www.AionianBible.org/Publisher",
  "name" : "Nainoia, Inc. eScribes",
  "jobTitle" : "Electronic Age Holy Bible Scribes",
  "worksFor" : { "@id": "https://www.AionianBible.org/Publisher/#NainoiaInc" },
  "telephone" : "+1-814-470-8028"
}
]
';
}
// table of contents
else if ($_Path==='Read') {
	$jsonld = '
{
  "@context" : "https://schema.org",
  "@type" : "WebPage",
  "url" : "https://www.AionianBible.org/Read",
  "name" : "Holy Bible Aionian Edition® Table of Contents",
  "headline" : "Holy Bible Aionian Edition® Table of Contents",
  "keywords" : "Table of Contents,Index,Sitemap",
  "description" : "Table of Contents ~ Holy Bible Aionian Edition®",
  "genre" : "http://vocab.getty.edu/aat/300055271",
  "inLanguage" : "en-US",
  "relatedLink" : [
	"https://www.AionianBible.org/Preface",
	"https://www.AionianBible.org/Readers-Guide",
	"https://www.AionianBible.org/Glossary",
	"https://www.AionianBible.org/History",
	"https://www.AionianBible.org/Aionios-and-Aidios"
  ],
  "author" : { "@id": "https://www.AionianBible.org/Publisher/#NainoiaInc" },
  "copyrightHolder" : { "@id": "https://www.AionianBible.org/Publisher/#NainoiaInc" },
  "provider" : { "@id": "https://www.AionianBible.org/Publisher/#NainoiaInc" },
  "editor" : { "@id": "https://www.AionianBible.org/Publisher/#eScribes" },
  "funder" : { "@id": "https://www.AionianBible.org/Publisher/#NainoiaInc" },
  "publisher" : { "@id": "https://www.AionianBible.org/Publisher/#NainoiaInc" }
}
';
}
// bible
else if ($_Part[0]==='Bibles' && $_pnum==2) {
	$bkey = $_Part[1];
	$bible = $_BibleONE['T_VERSIONS']['NAMEENGLISH'].($_BibleONE['T_VERSIONS']['NAMEENGLISH']==$_BibleONE['T_VERSIONS']['NAME'] ? "" : ", ".$_BibleONE['T_VERSIONS']['NAME']);
	$lang  = $_BibleONE['T_VERSIONS']['LANGUAGEENGLISH'].($_BibleONE['T_VERSIONS']['LANGUAGEENGLISH']==$_BibleONE['T_VERSIONS']['LANGUAGE'] ? "" : ", ".$_BibleONE['T_VERSIONS']['LANGUAGE']);
	$jsonld = '
[
{
  "@context" : "https://schema.org",
  "@type" : "Book",
  "@id" : "https://www.AionianBible.org/Bibles/'.$bkey.'/#Bible",
  "url" : "https://www.AionianBible.org/Bibles/#'.$bkey.'",
  "translationOfWork" : { "@id": "https://www.AionianBible.org/#Bible" },
  "name" : "'.$bible.'",
  "alternateName" : "Holy Bible '.$lang.'",
  "abridged" : "False",
  "bookEdition" : "Holy Bible Aionian Edition®",
  "headline" : "Holy Bible Aionian Edition® '.$bible.' '.$lang.'",
  "educationalUse" : "to restore relationship to God and all mankind with the truth, personal transformation, and growth",
  "keywords" : "Christian,Holy,Bible,Scripture,Word,salvation,grace,truth,doctrine,teaching,help,hope,inspired,teach,rebuke,correct,train,'.$bible.','.$lang.'",
  "description" : "Christian Scripture inspired by God the Holy Spirit for teaching, rebuking, correcting, and training in righteousness with the '.$bible.', '.$lang.'.",
  "genre" : "http://vocab.getty.edu/aat/300264513",
  "inLanguage" : "'.$_BibleONE['T_VERSIONS']['LANGUAGECODEISO'].'",
  "author" : { "@id": "https://www.AionianBible.org/#God" },
  "translator" : { "@id": "https://www.AionianBible.org/Bibles/'.$bkey.'/#Provider" },
  "copyrightHolder" : { "@id": "https://www.AionianBible.org/Bibles/'.$bkey.'/#Provider" },
  "provider" : { "@id": "https://www.AionianBible.org/Bibles/'.$bkey.'/#Provider" },
  "editor" : { "@id": "https://www.AionianBible.org/Publisher/#eScribes" },
  "publisher" : { "@id": "https://www.AionianBible.org/Publisher/#NainoiaInc" }
},
{
  "@context" : "https://schema.org",
  "@type" : "Organization",
  "@id" : "https://www.AionianBible.org/Bibles/'.$bkey.'/#Provider",
  "url" : "https://www.AionianBible.org/Bibles/#'.$bkey.'",
  "legalName" : "'.$_BibleONE['T_VERSIONS']['SOURCE'].'",
  "description" : "Source, translator, and provider of '.$bible.'"
}
]
';
}
// chapter and verse
else if ($_Part[0]==='Bibles' && $_pnum>=3 && $_pnum<=5) {
	$bkey = $_Part[1];
	$bible = $_BibleONE['T_VERSIONS']['NAMEENGLISH'].($_BibleONE['T_VERSIONS']['NAMEENGLISH']==$_BibleONE['T_VERSIONS']['NAME'] ? "" : ", ".$_BibleONE['T_VERSIONS']['NAME']);
	$lang  = $_BibleONE['T_VERSIONS']['LANGUAGEENGLISH'].($_BibleONE['T_VERSIONS']['LANGUAGEENGLISH']==$_BibleONE['T_VERSIONS']['LANGUAGE'] ? "" : ", ".$_BibleONE['T_VERSIONS']['LANGUAGE']);
	$text = '';
	if		($_pnum===3 && $_Part[2]==='Old') {											$name = "Table of Contents Old Testament"; }
	else if ($_pnum===3 && $_Part[2]==='New') {											$name = "Table of Contents New Testament"; }
	else if ($_pnum===3 && $_Part[2]==='Noted') {										$name = "Aionian Verses"; }
	else if (!empty($_BibleCHAP1[1])) {
		if ($_pnum===3) {																$name = "$_Part[2] Chapter 1";				$text = '"text" : "'.str_replace('"','',$_BibleCHAP1[1]).'",'; }
		else if ($_pnum===4) {															$name = "$_Part[2] Chapter $_Part[3]";		$text = '"text" : "'.str_replace('"','',$_BibleCHAP1[1]).'",'; }
		else if ($_pnum===5 && (empty($_Part[4]) || empty($_BibleCHAP1[$_Part[4]]))) {	$name = "$_Part[2] Chapter $_Part[3]";		$text = '"text" : "'.str_replace('"','',$_BibleCHAP1[1]).'",'; }
		else if ($_pnum===5) {															$name = "$_Part[2] $_Part[3]:$_Part[4]";	$text = '"text" : "'.str_replace('"','',$_BibleCHAP1[$_Part[4]]).'",'; }
		else { return; }
	}
	else { return; }
	$jsonld = '
{
  "@context" : "https://schema.org",
  "@type" : "Chapter",
  "url" : "https://www.AionianBible.org/'.$_Path.'",
  "translationOfWork" : { "@id": "https://www.AionianBible.org/#Bible" },
  "isPartOf" : { "@id": "https://www.AionianBible.org/Bibles/'.$bkey.'/#Bible" },
  "name" : "'.$bible.' '.$name.'",
  "pageStart" : "'.$name.'",
  "headline" : "Holy Bible Aionian Edition® '.$bible.' in '.$lang.' language, verse reference '.$name.'",
  "educationalUse" : "to restore relationship to God and all mankind with the truth, personal transformation, and growth",
  "keywords" : "Holy,Bible,Aionian,Edition,'.$bible.','.$lang.',Verse,Reference,'.$name.'",
  "description" : "Holy Bible Aionian Edition® '.$bible.' in '.$lang.' language, verse reference '.$name.'",
  '.$text.'
  "genre" : "http://vocab.getty.edu/aat/300264513",
  "inLanguage" : "'.$_BibleONE['T_VERSIONS']['LANGUAGECODEISO'].'",
  "author" : { "@id": "https://www.AionianBible.org/Bibles/'.$bkey.'/#Provider" },
  "copyrightHolder" : { "@id": "https://www.AionianBible.org/Bibles/'.$bkey.'/#Provider" },
  "provider" : { "@id": "https://www.AionianBible.org/Bibles/'.$bkey.'/#Provider" },
  "editor" : { "@id": "https://www.AionianBible.org/Publisher/#eScribes" },
  "publisher" : { "@id": "https://www.AionianBible.org/Publisher/#NainoiaInc" }
}
';
}
// one verse for all
else if ($_Part[0]==='Verse' && $_pnum>=3 && $_pnum<=5) {
	$name = "$_Part[2] $_Part[3]:$_Part[4]";
	$jsonld = '
{
  "@context" : "https://schema.org",
  "@type" : "WebPage",
  "url" : "https://www.AionianBible.org/'.$_Path.'",
  "translationOfWork" : { "@id": "https://www.AionianBible.org/#Bible" },
  "name" : "'.$name.'",
  "headline" : "Holy Bible Aionian Edition® multi-lingual Bible verse reference '.$name.'",
  "educationalUse" : "to restore relationship to God and all mankind with the truth, personal transformation, and growth",
  "keywords" : "Holy,Bible,Aionian,Edition,Verse,Reference,'.$name.'",
  "description" : "Holy Bible Aionian Edition® multi-lingual Bible verse reference '.$name.'",
  "genre" : "http://vocab.getty.edu/aat/300055271",
  "relatedLink" : [
	"https://www.AionianBible.org/Preface",
	"https://www.AionianBible.org/Readers-Guide",
	"https://www.AionianBible.org/Glossary",
	"https://www.AionianBible.org/Read",
	"https://www.AionianBible.org/History",
	"https://www.AionianBible.org/Aionios-and-Aidios"
  ],
  "author" : { "@id": "https://www.AionianBible.org/Publisher/#NainoiaInc" },
  "copyrightHolder" : { "@id": "https://www.AionianBible.org/Publisher/#NainoiaInc" },
  "provider" : { "@id": "https://www.AionianBible.org/Publisher/#NainoiaInc" },
  "editor" : { "@id": "https://www.AionianBible.org/Publisher/#eScribes" },
  "funder" : { "@id": "https://www.AionianBible.org/Publisher/#NainoiaInc" },
  "publisher" : { "@id": "https://www.AionianBible.org/Publisher/#NainoiaInc" }
}
';
}
// page
else {
	$jsonld = '
{
  "@context" : "https://schema.org",
  "@type" : "WebPage",
  "name" : "Holy Bible Aionian Edition® '.$_meta.'",
  "headline" : "Holy Bible Aionian Edition® '.$_meta.'",
  "description" : "Holy Bible Aionian Edition® '.$_meta.' '.$_Path.'",
  "url" : "https://www.AionianBible.org/'.$_Path.'",
  "genre" : "http://vocab.getty.edu/aat/300055271",
  "publisher" : { "@id": "https://www.AionianBible.org/Publisher/#NainoiaInc" },
  "relatedLink" : [
	"https://www.AionianBible.org/Preface",
	"https://www.AionianBible.org/Readers-Guide",
	"https://www.AionianBible.org/Glossary",
	"https://www.AionianBible.org/Read",
	"https://www.AionianBible.org/History",
	"https://www.AionianBible.org/Aionios-and-Aidios"
  ]
}
';
}
echo "<script type='application/ld+json'>$jsonld</script>";
}



/*** ERRS ***/
function abcms_errs($mess) {
global $_Path, $_para, $_stid;
if (!isset($_SERVER['HTTP_REFERER'])) { $_SERVER['HTTP_REFERER'] = "NA"; }
error_log("AIONIANBIBLE ERROR LOG\n mess= $mess\n_Path= .$_Path\n_para= $_para\n_stid= $_stid\nREQUEST= {$_SERVER['REQUEST_URI']}\nREFERER= {$_SERVER['HTTP_REFERER']}\n");
}



/*** AIONIAN NAVIGATION ***/
function abcms_aionian_nav($book,$chap,$vers,&$prev,&$next) {
global $_BibleBOOKS, $_BibleONE;
$prev = NULL;
$next = NULL;
if (empty($_BibleBOOKS[$book]['NUMBER'])) { return; }
static $avs = array(
'01037' => '35',
'01042' => '38',
'01044' => '29,31',
'04016' => '30,33',
'05032' => '22',
'09002' => '6',
'10022' => '6',
'11002' => '6,9',
'18007' => '9',
'18011' => '8',
'18014' => '13',
'18017' => '13,16',
'18021' => '13',
'18024' => '19',
'18026' => '6',
'19006' => '5',
'19009' => '17',
'19016' => '10',
'19018' => '5',
'19030' => '3',
'19031' => '17',
'19049' => '14,15',
'19055' => '15',
'19086' => '13',
'19088' => '3',
'19089' => '48',
'19116' => '3',
'19139' => '8',
'19141' => '7',
'20001' => '12',
'20005' => '5',
'20007' => '27',
'20009' => '18',
'20015' => '11,24',
'20023' => '14',
'20027' => '20',
'20030' => '16',
'21009' => '10',
'22008' => '6',
'23005' => '14',
'23007' => '11',
'23014' => '9,11,15',
'23028' => '15,18',
'23038' => '10,18',
'23057' => '9',
'26031' => '15,16,17',
'26032' => '21,27',
'28013' => '14',
'30009' => '2',
'32002' => '2',
'35002' => '5',
'40005' => '22,29,30',
'40010' => '28',
'40011' => '23',
'40012' => '32',
'40013' => '22,39,40,49',
'40016' => '18',
'40018' => '8,9',
'40019' => '16,29',
'40021' => '19',
'40023' => '15,33',
'40024' => '3',
'40025' => '41,46',
'40028' => '20',
'41003' => '29',
'41004' => '19',
'41009' => '43,45,47',
'41010' => '17,30',
'41011' => '14',
'42001' => '33,55,70',
'42008' => '31',
'42010' => '15,25',
'42012' => '5',
'42016' => '8,9,23',
'42018' => '18,30',
'42020' => '34,35',
'43003' => '15,16,36',
'43004' => '14,36',
'43005' => '24,39',
'43006' => '27,40,47,51,54,58,68',
'43008' => '35,51,52',
'43009' => '32',
'43010' => '28',
'43011' => '26',
'43012' => '25,34,50',
'43013' => '8',
'43014' => '16',
'43017' => '2,3',
'44002' => '27,31',
'44003' => '21',
'44013' => '46,48',
'44015' => '18',
'45001' => '20,25',
'45002' => '7',
'45005' => '21',
'45006' => '22,23',
'45009' => '5',
'45010' => '7',
'45011' => '32,36',
'45012' => '2',
'45016' => '25,26,27',
'46001' => '20',
'46002' => '6,7,8',
'46003' => '18',
'46008' => '13',
'46010' => '11',
'46015' => '55',
'47004' => '4,17,18',
'47005' => '1',
'47009' => '9',
'47011' => '31',
'48001' => '4,5',
'48006' => '8',
'49001' => '21',
'49002' => '2,7',
'49003' => '9,11,21',
'50004' => '20',
'51001' => '26',
'53001' => '9',
'53002' => '16',
'54001' => '16,17',
'54006' => '12,16,17',
'55001' => '9',
'55002' => '10',
'55004' => '10,18',
'56001' => '2',
'56002' => '12',
'56003' => '7',
'57001' => '15',
'58001' => '2,8',
'58005' => '6,9',
'58006' => '2,5,20',
'58007' => '17,21,24,28',
'58009' => '12,14,15,26',
'58011' => '3',
'58013' => '8,20,21',
'59003' => '6',
'60001' => '23,25',
'60004' => '11',
'60005' => '10,11',
'61001' => '11',
'61002' => '4',
'61003' => '18',
'62001' => '2',
'62002' => '17,25',
'62003' => '15',
'62005' => '11,13,20',
'63001' => '2',
'65001' => '6,7,13,21,25',
'66001' => '6,18',
'66004' => '9,10',
'66005' => '13',
'66006' => '8',
'66007' => '12',
'66009' => '1,2,11',
'66010' => '6',
'66011' => '7,15',
'66014' => '6,11',
'66015' => '7',
'66017' => '8',
'66019' => '3,20',
'66020' => '1,3,10,13,14,15',
'66021' => '8',
'66022' => '5',
);
// Find next and prev Aionian verse
$mybookchap = (int)sprintf("%02d%03d", (int)$_BibleBOOKS[$book]['NUMBER'], (int)$chap);
$prevbook = NULL;
foreach($avs as $bookchap => $verses) {
	$gotbook = (int)substr($bookchap,0,2);
	if (empty($_BibleBOOKS[$gotbook])) {
		abcms_errs("abcms_aionian_nav() Bible book not found!");
		return;
	}
	if (empty($_BibleONE['T_BOOKS'][$_BibleBOOKS[$gotbook]])) { continue; }
	$gotchap = (int)substr($bookchap,2,3);
	$gotvers = explode(",",$verses);
	if ((int)$bookchap < $mybookchap) {
		$prevbook = $gotbook;
		$prevchap = $gotchap;
		$prevvers = end($gotvers);
		continue;
	}
	if (!$vers) {
		if ((int)$bookchap == $mybookchap) { continue; }
		$next = $_BibleBOOKS[$gotbook]."/$gotchap";
		if ($prevbook) { $prev = $_BibleBOOKS[$prevbook]."/$prevchap"; }
		return;
	}
	if ((int)$bookchap > $mybookchap) {
		$next = $_BibleBOOKS[$gotbook]."/$gotchap/".reset($gotvers);
		if ($prevbook) { $prev = $_BibleBOOKS[$prevbook]."/$prevchap/$prevvers"; }
		return;
	}
	$vnext = NULL;
	foreach($gotvers as $vloop) {
		if ($vloop < $vers) {
			$prevbook = $gotbook;
			$prevchap = $gotchap;
			$prevvers = $vloop;
		}
		else if ($vloop > $vers) {
			$vnext = $vloop;
			break;
		}
	}
	if (!$vnext) { continue; }
	$next = $_BibleBOOKS[$gotbook]."/$gotchap/$vnext";
	$prev = ($prevbook ? $_BibleBOOKS[$prevbook]."/$prevchap/$prevvers" : "");
	return;
}
if ($prevbook) {
	if ($vers) {	$prev = $_BibleBOOKS[$prevbook]."/$prevchap/$prevvers"; }
	else {			$prev = $_BibleBOOKS[$prevbook]."/$prevchap"; }
}
return;
}

/*** GUSTAVE DORE ***/
function abcms_word_dore($book,$chap) {
static $doredata = array(
'GEN-1' => array('N'=>'', 'C'=>"The Creation of Light", 'F'=>'Hebrew-OT-001-The-Creation-of-Light'),
'GEN-2' => array('N'=>'', 'C'=>"The Creation of Eve", 'F'=>'Hebrew-OT-002-The-Creation-of-Eve'),
'GEN-3' => array('N'=>'', 'C'=>"Adam and Eve Are Driven out of Eden", 'F'=>'Hebrew-OT-003-Adam-and-Eve-Are-Driven-out-of-Eden'),
'GEN-4' => array('N'=>'2', 'C'=>"Cain and Abel Offer Their Sacrifices", 'F'=>'Hebrew-OT-004-Cain-and-Abel-Offer-Their-Sacrifices'),
'GEN-4-2' => array('N'=>'', 'C'=>"Cain Slays Abel", 'F'=>'Hebrew-OT-005-Cain-Slays-Abel'),
'GEN-6' => array('N'=>'', 'C'=>"The World is Destroyed by Water", 'F'=>'Hebrew-OT-006-The-World-is-Destroyed-by-Water'),
'GEN-7' => array('N'=>'', 'C'=>"The Great Flood", 'F'=>'Hebrew-OT-007-The-Great-Flood'),
'GEN-8' => array('N'=>'', 'C'=>"A Dove is Sent Forth from the Ark", 'F'=>'Hebrew-OT-008-A-Dove-is-Sent-Forth-from-the-Ark'),
'GEN-9' => array('N'=>'', 'C'=>"Noah Curses Ham and Canaan", 'F'=>'Hebrew-OT-009-Noah-Curses-Ham-and-Canaan'),
'GEN-11' => array('N'=>'', 'C'=>"The Tower of Babel", 'F'=>'Hebrew-OT-010-The-Tower-of-Babel'),
'GEN-12' => array('N'=>'', 'C'=>"Abraham Goes to the Land of Canaan", 'F'=>'Hebrew-OT-011-Abraham-Goes-to-the-Land-of-Canaan'),
'GEN-18' => array('N'=>'', 'C'=>"Abraham and the Three Angels", 'F'=>'Hebrew-OT-012-Abraham-and-the-Three-Angels'),
'GEN-19' => array('N'=>'', 'C'=>"Lot Flees as Sodom and Gomorrah Burn", 'F'=>'Hebrew-OT-013-Lot-Flees-as-Sodom-and-Gomorrah-Burn'),
'GEN-21' => array('N'=>'2', 'C'=>"Abraham Sends Hagar and Ishmael Away", 'F'=>'Hebrew-OT-014-Abraham-Sends-Hagar-and-Ishmael-Away'),
'GEN-21-2' => array('N'=>'', 'C'=>"Hagar and Ishmael in the Wilderness", 'F'=>'Hebrew-OT-015-Hagar-and-Ishmael-in-the-Wilderness'),
'GEN-22' => array('N'=>'', 'C'=>"The Testing of Abraham's Faith", 'F'=>'Hebrew-OT-016-The-Testing-of-Abrahams-Faith'),
'GEN-23' => array('N'=>'', 'C'=>"The Burial of Sarah", 'F'=>'Hebrew-OT-017-The-Burial-of-Sarah'),
'GEN-24' => array('N'=>'2', 'C'=>"Eliezer and Rebekah at the Well", 'F'=>'Hebrew-OT-018-Eliezer-and-Rebekah-at-the-Well'),
'GEN-24-2' => array('N'=>'', 'C'=>"The Meeting of Isaac and Rebekah", 'F'=>'Hebrew-OT-019-The-Meeting-of-Isaac-and-Rebekah'),
'GEN-27' => array('N'=>'', 'C'=>"Isaac Blesses Jacob", 'F'=>'Hebrew-OT-020-Isaac-Blesses-Jacob'),
'GEN-28' => array('N'=>'', 'C'=>"Jacob's Dream", 'F'=>'Hebrew-OT-021-Jacobs-Dream'),
'GEN-29' => array('N'=>'', 'C'=>"Jacob Tends Laban's Flocks and Meets Rachel", 'F'=>'Hebrew-OT-022-Jacob-Tends-Labans-Flocks-and-Meets-Rachel'),
'GEN-32' => array('N'=>'2', 'C'=>"Jacob Prays for Protection", 'F'=>'Hebrew-OT-023-Jacob-Prays-for-Protection'),
'GEN-32-2' => array('N'=>'', 'C'=>"Jacob Wrestles with the Angel", 'F'=>'Hebrew-OT-024-Jacob-Wrestles-with-the-Angel'),
'GEN-33' => array('N'=>'', 'C'=>"Jacob and Esau Meet", 'F'=>'Hebrew-OT-025-Jacob-and-Esau-Meet'),
'GEN-37' => array('N'=>'', 'C'=>"Joseph is Sold by His Brothers", 'F'=>'Hebrew-OT-026-Joseph-is-Sold-by-His-Brothers'),
'GEN-41' => array('N'=>'', 'C'=>"Joseph Interprets Pharaoh's Dream", 'F'=>'Hebrew-OT-027-Joseph-Interprets-Pharaohs-Dream'),
'GEN-45' => array('N'=>'', 'C'=>"Joseph Reveals Himself to His Brothers", 'F'=>'Hebrew-OT-028-Joseph-Reveals-Himself-to-His-Brothers'),
'GEN-46' => array('N'=>'', 'C'=>"Jacob Goes to Egypt", 'F'=>'Hebrew-OT-029-Jacob-Goes-to-Egypt'),
'EXO-2' => array('N'=>'2', 'C'=>"The Child Moses on the Nile", 'F'=>'Hebrew-OT-030-The-Child-Moses-on-the-Nile'),
'EXO-2-2' => array('N'=>'', 'C'=>"The Finding of Moses", 'F'=>'Hebrew-OT-031-The-Finding-of-Moses'),
'EXO-7' => array('N'=>'', 'C'=>"Moses and Aaron Appear before Pharaoh", 'F'=>'Hebrew-OT-032-Moses-and-Aaron-Appear-before-Pharaoh'),
'EXO-9' => array('N'=>'', 'C'=>"The Fifth Plague: Livestock Disease", 'F'=>'Hebrew-OT-033-The-Fifth-Plague-Livestock-Disease'),
'EXO-10' => array('N'=>'', 'C'=>"The Ninth Plague: Darkness", 'F'=>'Hebrew-OT-034-The-Ninth-Plague-Darkness'),
'EXO-12' => array('N'=>'2', 'C'=>"The Firstborn of the Egyptians Are Slain", 'F'=>'Hebrew-OT-035-The-Firstborn-of-the-Egyptians-Are-Slain'),
'EXO-12-2' => array('N'=>'', 'C'=>"The Egyptians Ask Moses to Depart", 'F'=>'Hebrew-OT-036-The-Egyptians-Ask-Moses-to-Depart'),
'EXO-14' => array('N'=>'', 'C'=>"The Egyptians Drown in the Sea", 'F'=>'Hebrew-OT-037-The-Egyptians-Drown-in-the-Sea'),
'EXO-17' => array('N'=>'', 'C'=>"Moses Strikes the Rock at Horeb", 'F'=>'Hebrew-OT-038-Moses-Strikes-the-Rock-at-Horeb'),
'EXO-19' => array('N'=>'', 'C'=>"The Giving of the Law on Mount Sinai", 'F'=>'Hebrew-OT-039-The-Giving-of-the-Law-on-Mount-Sinai'),
'EXO-32' => array('N'=>'2', 'C'=>"Moses Comes Down from Mount Sinai", 'F'=>'Hebrew-OT-040-Moses-Comes-Down-from-Mount-Sinai'),
'EXO-32-2' => array('N'=>'', 'C'=>"Moses Breaks the Tables of the Law", 'F'=>'Hebrew-OT-041-Moses-Breaks-the-Tables-of-the-Law'),
'NUM-13' => array('N'=>'', 'C'=>"The Spies Return from the Promised Land", 'F'=>'Hebrew-OT-042-The-Spies-Return-from-the-Promised-Land'),
'NUM-16' => array('N'=>'', 'C'=>"The Death of Korah, Dathan, and Abiram", 'F'=>'Hebrew-OT-043-The-Death-of-Korah-Dathan-and-Abiram'),
'NUM-21' => array('N'=>'', 'C'=>"The Bronze Serpent", 'F'=>'Hebrew-OT-044-The-Bronze-Serpent'),
'NUM-22' => array('N'=>'', 'C'=>"An Angel Appears to Balaam", 'F'=>'Hebrew-OT-045-An-Angel-Appears-to-Balaam'),
'JOS-3' => array('N'=>'', 'C'=>"The Israelites Cross the Jordan River", 'F'=>'Hebrew-OT-046-The-Israelites-Cross-the-Jordan-River'),
'JOS-6' => array('N'=>'2', 'C'=>"The Walls of Jericho Fall Down", 'F'=>'Hebrew-OT-048-The-Walls-of-Jericho-Fall-Down'),
'JOS-6-2' => array('N'=>'', 'C'=>"Joshua Spares Rahab", 'F'=>'Hebrew-OT-049-Joshua-Spares-Rahab'),
'JOS-7' => array('N'=>'', 'C'=>"Achan is Stoned to Death", 'F'=>'Hebrew-OT-050-Achan-is-Stoned-to-Death'),
'JOS-8' => array('N'=>'', 'C'=>"Joshua Burns the Town of Ai", 'F'=>'Hebrew-OT-051-Joshua-Burns-the-Town-of-Ai'),
'JOS-10' => array('N'=>'2', 'C'=>"The Army of the Amorites is Destroyed", 'F'=>'Hebrew-OT-052-The-Army-of-the-Amorites-is-Destroyed'),
'JOS-10-2' => array('N'=>'', 'C'=>"Joshua Commands the Sun to Stand Still", 'F'=>'Hebrew-OT-053-Joshua-Commands-the-Sun-to-Stand-Still'),
'JDG-2' => array('N'=>'', 'C'=>"An Angel Appears to the Israelites", 'F'=>'Hebrew-OT-047-An-Angel-Appears-to-the-Israelites'),
'JDG-4' => array('N'=>'', 'C'=>"Jael Kills Sisera", 'F'=>'Hebrew-OT-054-Jael-Kills-Sisera'),
'JDG-5' => array('N'=>'', 'C'=>"Deborah Praises Jael", 'F'=>'Hebrew-OT-055-Deborah-Praises-Jael'),
'JDG-7' => array('N'=>'2', 'C'=>"Gideon Chooses 300 Soldiers", 'F'=>'Hebrew-OT-056-Gideon-Chooses-300-Soldiers'),
'JDG-7-2' => array('N'=>'', 'C'=>"The Midianites Are Routed", 'F'=>'Hebrew-OT-057-The-Midianites-Are-Routed'),
'JDG-9' => array('N'=>'2', 'C'=>"The Death of Gideon's Sons", 'F'=>'Hebrew-OT-058-The-Death-of-Gideons-Sons'),
'JDG-9-2' => array('N'=>'', 'C'=>"The Death of Abimelech", 'F'=>'Hebrew-OT-059-The-Death-of-Abimelech'),
'JDG-11' => array('N'=>'2', 'C'=>"Jephthah's Daughter Comes to Meet Her Father", 'F'=>'Hebrew-OT-060-Jephthahs-Daughter-Comes-to-Meet-Her-Father'),
'JDG-11-2' => array('N'=>'', 'C'=>"Israelite Women Mourn with Jephthah's Daughter", 'F'=>'Hebrew-OT-061-Israelite-Women-Mourn-with-Jephthahs-Daughter'),
'JDG-14' => array('N'=>'', 'C'=>"Samson Slays a Lion", 'F'=>'Hebrew-OT-062-Samson-Slays-a-Lion'),
'JDG-15' => array('N'=>'', 'C'=>"Samson Destroys the Philistines with an Ass' Jawbone", 'F'=>'Hebrew-OT-063-Samson-Destroys-the-Philistines-with-an-Ass-Jawbone'),
'JDG-16' => array('N'=>'3', 'C'=>"Samson Carries away the Gates of Gaza", 'F'=>'Hebrew-OT-064-Samson-Carries-away-the-Gates-of-Gaza'),
'JDG-16-2' => array('N'=>'', 'C'=>"Samson and Delilah", 'F'=>'Hebrew-OT-065-Samson-and-Delilah'),
'JDG-16-3' => array('N'=>'', 'C'=>"The Death of Samson", 'F'=>'Hebrew-OT-066-The-Death-of-Samson'),
'JDG-19' => array('N'=>'2', 'C'=>"A Levite Finds a Woman's Corpse", 'F'=>'Hebrew-OT-067-A-Levite-Finds-a-Womans-Corpse'),
'JDG-19-2' => array('N'=>'', 'C'=>"The Levite Carries the Woman's Body Away", 'F'=>'Hebrew-OT-068-The-Levite-Carries-the-Womans-Body-Away'),
'JDG-21' => array('N'=>'', 'C'=>"The Benjaminites Take the Virgins of Jabesh-gilead", 'F'=>'Hebrew-OT-069-The-Benjaminites-Take-the-Virgins-of-Jabesh-gilead'),
'RUT-1' => array('N'=>'', 'C'=>"Naomi and Her Daughters-in-Law", 'F'=>'Hebrew-OT-070-Naomi-and-Her-Daughters-in-Law'),
'RUT-2' => array('N'=>'', 'C'=>"Ruth and Boaz", 'F'=>'Hebrew-OT-071-Ruth-and-Boaz'),
'1SA-6' => array('N'=>'', 'C'=>"The Ark is Returned to Beth-shemesh", 'F'=>'Hebrew-OT-072-The-Ark-is-Returned-to-Beth-shemesh'),
'1SA-9' => array('N'=>'', 'C'=>"Samuel Blesses Saul", 'F'=>'Hebrew-OT-073-Samuel-Blesses-Saul'),
'1SA-15' => array('N'=>'', 'C'=>"The Death of Agag", 'F'=>'Hebrew-OT-074-The-Death-of-Agag'),
'1SA-17' => array('N'=>'', 'C'=>"David Slays Goliath", 'F'=>'Hebrew-OT-075-David-Slays-Goliath'),
'1SA-18' => array('N'=>'', 'C'=>"Saul Attempts to Kill David", 'F'=>'Hebrew-OT-076-Saul-Attempts-to-Kill-David'),
'1SA-19' => array('N'=>'', 'C'=>"David Escapes through a Window", 'F'=>'Hebrew-OT-077-David-Escapes-through-a-Window'),
'1SA-20' => array('N'=>'', 'C'=>"David and Jonathan", 'F'=>'Hebrew-OT-078-David-and-Jonathan'),
'1SA-24' => array('N'=>'', 'C'=>"David Shows Saul How He Spared His Life", 'F'=>'Hebrew-OT-079-David-Shows-Saul-How-He-Spared-His-Life'),
'1SA-28' => array('N'=>'', 'C'=>"Saul and the Witch of Endor", 'F'=>'Hebrew-OT-080-Saul-and-the-Witch-of-Endor'),
'1SA-31' => array('N'=>'', 'C'=>"The Death of Saul", 'F'=>'Hebrew-OT-081-The-Death-of-Saul'),
'2SA-2' => array('N'=>'', 'C'=>"Combat between Soldiers of Ish-bosheth and David", 'F'=>'Hebrew-OT-083-Combat-between-Soldiers-of-Ish-bosheth-and-David'),
'2SA-12' => array('N'=>'', 'C'=>"David Attacks the Ammonites", 'F'=>'Hebrew-OT-084-David-Attacks-the-Ammonites'),
'2SA-18' => array('N'=>'2', 'C'=>"The Death of Absalom", 'F'=>'Hebrew-OT-085-The-Death-of-Absalom'),
'2SA-18-2' => array('N'=>'', 'C'=>"David Mourns the Death of Absalom", 'F'=>'Hebrew-OT-086-David-Mourns-the-Death-of-Absalom'),
'2SA-21' => array('N'=>'2', 'C'=>"Rizpah's Kindness toward the Dead", 'F'=>'Hebrew-OT-087-Rizpahs-Kindness-toward-the-Dead'),
'2SA-21-2' => array('N'=>'', 'C'=>"Abishai Saves David's Life", 'F'=>'Hebrew-OT-089-Abishai-Saves-Davids-Life'),
'1KI-3' => array('N'=>'', 'C'=>"The Judgment of Solomon", 'F'=>'Hebrew-OT-090-The-Judgment-of-Solomon'),
'1KI-5' => array('N'=>'', 'C'=>"Cedars Are Cut Down for the Jerusalem Temple", 'F'=>'Hebrew-OT-091-Cedars-Are-Cut-Down-for-the-Jerusalem-Temple'),
'1KI-13' => array('N'=>'', 'C'=>"The Disobedient Prophet is Slain by a Lion", 'F'=>'Hebrew-OT-094-The-Disobedient-Prophet-is-Slain-by-a-Lion'),
'1KI-17' => array('N'=>'', 'C'=>"Elijah Raises the Son of the Widow of Zarephath", 'F'=>'Hebrew-OT-095-Elijah-Raises-the-Son-of-the-Widow-of-Zarephath'),
'1KI-18' => array('N'=>'', 'C'=>"The Prophets of Baal Are Slaughtered", 'F'=>'Hebrew-OT-096-The-Prophets-of-Baal-Are-Slaughtered'),
'1KI-19' => array('N'=>'', 'C'=>"Elijah is Nourished by an Angel", 'F'=>'Hebrew-OT-097-Elijah-is-Nourished-by-an-Angel'),
'1KI-20' => array('N'=>'', 'C'=>"The Israelites Slaughter the Syrians", 'F'=>'Hebrew-OT-098-The-Israelites-Slaughter-the-Syrians'),
'1KI-22' => array('N'=>'', 'C'=>"The Death of Ahab", 'F'=>'Hebrew-OT-100-The-Death-of-Ahab'),
'2KI-1' => array('N'=>'', 'C'=>"Elijah Destroys the Messengers of Ahaziah", 'F'=>'Hebrew-OT-101-Elijah-Destroys-the-Messengers-of-Ahaziah'),
'2KI-2' => array('N'=>'2', 'C'=>"Elijah Ascends to Heaven in a Chariot of Fire", 'F'=>'Hebrew-OT-102-Elijah-Ascends-to-Heaven-in-a-Chariot-of-Fire'),
'2KI-2-2' => array('N'=>'', 'C'=>"Some Children Are Destroyed by Bears", 'F'=>'Hebrew-OT-103-Some-Children-Are-Destroyed-by-Bears'),
'2KI-6' => array('N'=>'', 'C'=>"A Famine in Samaria", 'F'=>'Hebrew-OT-104-A-Famine-in-Samaria'),
'2KI-9' => array('N'=>'2', 'C'=>"The Death of Jezebel", 'F'=>'Hebrew-OT-105-The-Death-of-Jezebel'),
'2KI-9-2' => array('N'=>'', 'C'=>"Jehu's Companions Find Jezebel's Remains", 'F'=>'Hebrew-OT-106-Jehus-Companions-Find-Jezebels-Remains'),
'2KI-17' => array('N'=>'', 'C'=>"Foreign Nations Are Slain by Lions in Samaria", 'F'=>'Hebrew-OT-108-Foreign-Nations-Are-Slain-by-Lions-in-Samaria'),
'2KI-19' => array('N'=>'', 'C'=>"Sennacherib's Army is Destroyed", 'F'=>'Hebrew-OT-112-Sennacheribs-Army-is-Destroyed'),
'2KI-25' => array('N'=>'', 'C'=>"Zedekiah's Sons Are Slaughtered before His Eyes", 'F'=>'Hebrew-OT-113-Zedekiahs-Sons-Are-Slaughtered-before-His-Eyes'),
'1CH-10' => array('N'=>'', 'C'=>"Jabesh-Gileadites Recover the Bodies of Saul and His Sons", 'F'=>'Hebrew-OT-082-Jabesh-Gileadites-Recover-the-Bodies-of-Saul-and-His-Sons'),
'1CH-21' => array('N'=>'', 'C'=>"The Plague of Jerusalem", 'F'=>'Hebrew-OT-088-The-Plague-of-Jerusalem'),
'2CH-9' => array('N'=>'', 'C'=>"Solomon Receives the Queen of Sheba", 'F'=>'Hebrew-OT-092-Solomon-Receives-the-Queen-of-Sheba'),
'2CH-10' => array('N'=>'', 'C'=>"King Solomon in Old Age", 'F'=>'Hebrew-OT-093-King-Solomon-in-Old-Age'),
'2CH-20' => array('N'=>'', 'C'=>"The Ammonite and Moabite Armies Are Destroyed", 'F'=>'Hebrew-OT-099-The-Ammonite-and-Moabite-Armies-Are-Destroyed'),
'2CH-22' => array('N'=>'', 'C'=>"The Death of Athaliah", 'F'=>'Hebrew-OT-107-The-Death-of-Athaliah'),
'EZR-1' => array('N'=>'', 'C'=>"Cyrus Restores the Vessels of the Temple", 'F'=>'Hebrew-OT-130-Cyrus-Restores-the-Vessels-of-the-Temple'),
'EZR-3' => array('N'=>'', 'C'=>"The Rebuilding of the Temple is Begun", 'F'=>'Hebrew-OT-135-The-Rebuilding-of-the-Temple-is-Begun'),
'EZR-7' => array('N'=>'', 'C'=>"Artaxerxes Grants Freedom to the Jews", 'F'=>'Hebrew-OT-131-Artaxerxes-Grants-Freedom-to-the-Jews'),
'EZR-9' => array('N'=>'', 'C'=>"Ezra Kneels in Prayer", 'F'=>'Hebrew-OT-132-Ezra-Kneels-in-Prayer'),
'NEH-2' => array('N'=>'', 'C'=>"Nehemiah Views the Ruins of Jerusalem's Walls", 'F'=>'Hebrew-OT-134-Nehemiah-Views-the-Ruins-of-Jerusalems-Walls'),
'NEH-8' => array('N'=>'', 'C'=>"Ezra Reads the Law to the People", 'F'=>'Hebrew-OT-133-Ezra-Reads-the-Law-to-the-People'),
'EST-1' => array('N'=>'', 'C'=>"Queen Vashti Refuses to Obey Ahasuerus' Command", 'F'=>'Hebrew-OT-119-Queen-Vashti-Refuses-to-Obey-Ahasuerus-Command'),
'EST-6' => array('N'=>'', 'C'=>"The Triumph of Mordecai", 'F'=>'Hebrew-OT-120-The-Triumph-of-Mordecai'),
'EST-7' => array('N'=>'', 'C'=>"Esther Accuses Haman", 'F'=>'Hebrew-OT-121-Esther-Accuses-Haman'),
'JOB-1' => array('N'=>'', 'C'=>"Job Hears of His Misfortunes", 'F'=>'Hebrew-OT-136-Job-Hears-of-His-Misfortunes'),
'JOB-2' => array('N'=>'', 'C'=>"Job Speaks with His Friends", 'F'=>'Hebrew-OT-137-Job-Speaks-with-His-Friends'),
'PSA-3' => array('N'=>'2', 'C'=>"The Death of Absalom", 'F'=>'Hebrew-OT-085-The-Death-of-Absalom'),
'PSA-3-2' => array('N'=>'', 'C'=>"David Mourns the Death of Absalom", 'F'=>'Hebrew-OT-086-David-Mourns-the-Death-of-Absalom'),
'PSA-4' => array('N'=>'', 'C'=>"David Mourns the Death of Absalom", 'F'=>'Hebrew-OT-086-David-Mourns-the-Death-of-Absalom'),
'PSA-7' => array('N'=>'', 'C'=>"Abishai Saves David's Life", 'F'=>'Hebrew-OT-089-Abishai-Saves-Davids-Life'),
'PSA-16' => array('N'=>'', 'C'=>"David Attacks the Ammonites", 'F'=>'Hebrew-OT-084-David-Attacks-the-Ammonites'),
'PSA-18' => array('N'=>'2', 'C'=>"Saul Attempts to Kill David", 'F'=>'Hebrew-OT-076-Saul-Attempts-to-Kill-David'),
'PSA-18-2' => array('N'=>'', 'C'=>"David Escapes through a Window", 'F'=>'Hebrew-OT-077-David-Escapes-through-a-Window'),
'PSA-57' => array('N'=>'2', 'C'=>"Saul Attempts to Kill David", 'F'=>'Hebrew-OT-076-Saul-Attempts-to-Kill-David'),
'PSA-57-2' => array('N'=>'', 'C'=>"David Escapes through a Window", 'F'=>'Hebrew-OT-077-David-Escapes-through-a-Window'),
'PSA-59' => array('N'=>'2', 'C'=>"Saul Attempts to Kill David", 'F'=>'Hebrew-OT-076-Saul-Attempts-to-Kill-David'),
'PSA-59-2' => array('N'=>'', 'C'=>"David Escapes through a Window", 'F'=>'Hebrew-OT-077-David-Escapes-through-a-Window'),
'PSA-119' => array('N'=>'', 'C'=>"The Creation of Light", 'F'=>'Hebrew-OT-001-The-Creation-of-Light'),
'PSA-143' => array('N'=>'', 'C'=>"David Slays Goliath", 'F'=>'Hebrew-OT-075-David-Slays-Goliath'),
'PRO-1' => array('N'=>'', 'C'=>"King Solomon in Old Age", 'F'=>'Hebrew-OT-093-King-Solomon-in-Old-Age'),
'ECC-1' => array('N'=>'', 'C'=>"King Solomon in Old Age", 'F'=>'Hebrew-OT-093-King-Solomon-in-Old-Age'),
'ECC-2' => array('N'=>'', 'C'=>"The Creation of Light", 'F'=>'Hebrew-OT-001-The-Creation-of-Light'),
'SOL-1' => array('N'=>'', 'C'=>"King Solomon in Old Age", 'F'=>'Hebrew-OT-093-King-Solomon-in-Old-Age'),
'ISA-6' => array('N'=>'', 'C'=>"The Prophet Isaiah", 'F'=>'Hebrew-OT-110-The-Prophet-Isaiah'),
'ISA-13' => array('N'=>'', 'C'=>"Isaiah's Vision of the Destruction of Babylon", 'F'=>'Hebrew-OT-127-Isaiahs-Vision-of-the-Destruction-of-Babylon'),
'ISA-27' => array('N'=>'', 'C'=>"The Destruction of Leviathan", 'F'=>'Hebrew-OT-128-The-Destruction-of-Leviathan'),
'ISA-37' => array('N'=>'', 'C'=>"Sennacherib's Army is Destroyed", 'F'=>'Hebrew-OT-112-Sennacheribs-Army-is-Destroyed'),
'ISA-44' => array('N'=>'', 'C'=>"Cyrus Restores the Vessels of the Temple", 'F'=>'Hebrew-OT-130-Cyrus-Restores-the-Vessels-of-the-Temple'),
'ISA-45' => array('N'=>'', 'C'=>"Cyrus Restores the Vessels of the Temple", 'F'=>'Hebrew-OT-130-Cyrus-Restores-the-Vessels-of-the-Temple'),
'ISA-54' => array('N'=>'', 'C'=>"A Dove is Sent Forth from the Ark", 'F'=>'Hebrew-OT-008-A-Dove-is-Sent-Forth-from-the-Ark'),
'JER-1' => array('N'=>'', 'C'=>"The Prophet Jeremiah", 'F'=>'Hebrew-OT-114-The-Prophet-Jeremiah'),
'JER-36' => array('N'=>'', 'C'=>"Baruch Writes Jeremiah's Prophecies", 'F'=>'Hebrew-OT-115-Baruch-Writes-Jeremiahs-Prophecies'),
'JER-39' => array('N'=>'', 'C'=>"People Mourn over the Destruction of Jerusalem", 'F'=>'Hebrew-OT-116-People-Mourn-over-the-Destruction-of-Jerusalem'),
'EZE-1' => array('N'=>'', 'C'=>"The Prophet Ezekiel", 'F'=>'Hebrew-OT-117-The-Prophet-Ezekiel'),
'EZE-37' => array('N'=>'', 'C'=>"Ezekiel's Vision of the Valley of Dry Bones", 'F'=>'Hebrew-OT-118-Ezekiels-Vision-of-the-Valley-of-Dry-Bones'),
'DAN-1' => array('N'=>'2', 'C'=>"Daniel among the Exiles", 'F'=>'Hebrew-OT-122-Daniel-among-the-Exiles'),
'DAN-1-2' => array('N'=>'', 'C'=>"Cyrus Restores the Vessels of the Temple", 'F'=>'Hebrew-OT-130-Cyrus-Restores-the-Vessels-of-the-Temple'),
'DAN-3' => array('N'=>'', 'C'=>"Shadrach, Meshach, and Abednego in the Furnace", 'F'=>'Hebrew-OT-123-Shadrach-Meshach-and-Abednego-in-the-Furnace'),
'DAN-5' => array('N'=>'', 'C'=>"Daniel Interprets the Writing on the Wall", 'F'=>'Hebrew-OT-124-Daniel-Interprets-the-Writing-on-the-Wall'),
'DAN-6' => array('N'=>'2', 'C'=>"Daniel in the Lions' Den", 'F'=>'Hebrew-OT-125-Daniel-in-the-Lions-Den'),
'DAN-6-2' => array('N'=>'', 'C'=>"Cyrus Restores the Vessels of the Temple", 'F'=>'Hebrew-OT-130-Cyrus-Restores-the-Vessels-of-the-Temple'),
'DAN-7' => array('N'=>'', 'C'=>"Daniel's Vision of the Four Beasts", 'F'=>'Hebrew-OT-126-Daniels-Vision-of-the-Four-Beasts'),
'DAN-9' => array('N'=>'', 'C'=>"The Prophet Jeremiah", 'F'=>'Hebrew-OT-114-The-Prophet-Jeremiah'),
'DAN-10' => array('N'=>'', 'C'=>"Cyrus Restores the Vessels of the Temple", 'F'=>'Hebrew-OT-130-Cyrus-Restores-the-Vessels-of-the-Temple'),
'AMO-1' => array('N'=>'', 'C'=>"The Prophet Amos", 'F'=>'Hebrew-OT-109-The-Prophet-Amos'),
'JON-2' => array('N'=>'', 'C'=>"Jonah is Spewed Forth by the Whale", 'F'=>'Hebrew-OT-138-Jonah-is-Spewed-Forth-by-the-Whale'),
'JON-3' => array('N'=>'', 'C'=>"Jonah Preaches to the Ninevites", 'F'=>'Hebrew-OT-139-Jonah-Preaches-to-the-Ninevites'),
'MIC-1' => array('N'=>'', 'C'=>"Micah Exhorts the Israelites to Repent", 'F'=>'Hebrew-OT-111-Micah-Exhorts-the-Israelites-to-Repent'),
'HAG-1' => array('N'=>'', 'C'=>"The Rebuilding of the Temple is Begun", 'F'=>'Hebrew-OT-135-The-Rebuilding-of-the-Temple-is-Begun'),
'ZEC-6' => array('N'=>'', 'C'=>"Zechariah's Vision of Four Chariots", 'F'=>'Hebrew-OT-129-Zechariahs-Vision-of-Four-Chariots'),
'MAL-4' => array('N'=>'', 'C'=>"Elijah Ascends to Heaven in a Chariot of Fire", 'F'=>'Hebrew-OT-102-Elijah-Ascends-to-Heaven-in-a-Chariot-of-Fire'),
'MAT-1' => array('N'=>'6', 'C'=>"The Testing of Abraham's Faith", 'F'=>'Hebrew-OT-016-The-Testing-of-Abrahams-Faith'),
'MAT-1-2' => array('N'=>'', 'C'=>"Joshua Spares Rahab", 'F'=>'Hebrew-OT-049-Joshua-Spares-Rahab'),
'MAT-1-3' => array('N'=>'', 'C'=>"Ruth and Boaz", 'F'=>'Hebrew-OT-071-Ruth-and-Boaz'),
'MAT-1-4' => array('N'=>'', 'C'=>"David Mourns the Death of Absalom", 'F'=>'Hebrew-OT-086-David-Mourns-the-Death-of-Absalom'),
'MAT-1-5' => array('N'=>'', 'C'=>"King Solomon in Old Age", 'F'=>'Hebrew-OT-093-King-Solomon-in-Old-Age'),
'MAT-1-6' => array('N'=>'', 'C'=>"The Annunciation", 'F'=>'NT-Gospel-161-The-Annunciation'),
'MAT-2' => array('N'=>'5', 'C'=>"The Prophet Jeremiah", 'F'=>'Hebrew-OT-114-The-Prophet-Jeremiah'),
'MAT-2-2' => array('N'=>'', 'C'=>"The Birth of Jesus", 'F'=>'NT-Gospel-162-The-Birth-of-Jesus'),
'MAT-2-3' => array('N'=>'', 'C'=>"Wise Men Are Guided by a Star", 'F'=>'NT-Gospel-163-Wise-Men-Are-Guided-by-a-Star'),
'MAT-2-4' => array('N'=>'', 'C'=>"Joseph Leads Mary and Jesus into Egypt", 'F'=>'NT-Gospel-164-Joseph-Leads-Mary-and-Jesus-into-Egypt'),
'MAT-2-5' => array('N'=>'', 'C'=>"The Children of Bethlehem Are Massacred", 'F'=>'NT-Gospel-165-The-Children-of-Bethlehem-Are-Massacred'),
'MAT-3' => array('N'=>'2', 'C'=>"John the Baptist Preaches in the Wilderness", 'F'=>'NT-Gospel-167-John-the-Baptist-Preaches-in-the-Wilderness'),
'MAT-3-2' => array('N'=>'', 'C'=>"The Baptism of Jesus", 'F'=>'NT-Gospel-168-The-Baptism-of-Jesus'),
'MAT-4' => array('N'=>'5', 'C'=>"The Temptation of Jesus", 'F'=>'NT-Gospel-169-The-Temptation-of-Jesus'),
'MAT-4-2' => array('N'=>'', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'MAT-4-3' => array('N'=>'', 'C'=>"Jesus Heals a Demoniac", 'F'=>'NT-Gospel-173-Jesus-Heals-a-Demoniac'),
'MAT-4-4' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'MAT-4-5' => array('N'=>'', 'C'=>"Jesus Heals the Sick", 'F'=>'NT-Gospel-186-Jesus-Heals-the-Sick'),
'MAT-5' => array('N'=>'', 'C'=>"The Sermon on the Mount", 'F'=>'NT-Gospel-175-The-Sermon-on-the-Mount'),
'MAT-6' => array('N'=>'2', 'C'=>"Solomon Receives the Queen of Sheba", 'F'=>'Hebrew-OT-092-Solomon-Receives-the-Queen-of-Sheba'),
'MAT-6-2' => array('N'=>'', 'C'=>"The Sermon on the Mount", 'F'=>'NT-Gospel-175-The-Sermon-on-the-Mount'),
'MAT-7' => array('N'=>'', 'C'=>"The Sermon on the Mount", 'F'=>'NT-Gospel-175-The-Sermon-on-the-Mount'),
'MAT-8' => array('N'=>'3', 'C'=>"Jesus Heals a Demoniac", 'F'=>'NT-Gospel-173-Jesus-Heals-a-Demoniac'),
'MAT-8-2' => array('N'=>'', 'C'=>"Jesus Stills the Storm", 'F'=>'NT-Gospel-179-Jesus-Stills-the-Storm'),
'MAT-8-3' => array('N'=>'', 'C'=>"Jesus Heals the Sick", 'F'=>'NT-Gospel-186-Jesus-Heals-the-Sick'),
'MAT-9' => array('N'=>'4', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'MAT-9-2' => array('N'=>'', 'C'=>"Jesus Heals a Demoniac", 'F'=>'NT-Gospel-173-Jesus-Heals-a-Demoniac'),
'MAT-9-3' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'MAT-9-4' => array('N'=>'', 'C'=>"Jesus Heals the Sick", 'F'=>'NT-Gospel-186-Jesus-Heals-the-Sick'),
'MAT-10' => array('N'=>'', 'C'=>"Jesus Heals the Sick", 'F'=>'NT-Gospel-186-Jesus-Heals-the-Sick'),
'MAT-11' => array('N'=>'2', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'MAT-11-2' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'MAT-12' => array('N'=>'7', 'C'=>"Solomon Receives the Queen of Sheba", 'F'=>'Hebrew-OT-092-Solomon-Receives-the-Queen-of-Sheba'),
'MAT-12-2' => array('N'=>'', 'C'=>"Jonah is Spewed Forth by the Whale", 'F'=>'Hebrew-OT-138-Jonah-is-Spewed-Forth-by-the-Whale'),
'MAT-12-3' => array('N'=>'', 'C'=>"Jonah Preaches to the Ninevites", 'F'=>'Hebrew-OT-139-Jonah-Preaches-to-the-Ninevites'),
'MAT-12-4' => array('N'=>'', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'MAT-12-5' => array('N'=>'', 'C'=>"Jesus Heals a Demoniac", 'F'=>'NT-Gospel-173-Jesus-Heals-a-Demoniac'),
'MAT-12-6' => array('N'=>'', 'C'=>"The Disciples Pluck Grain on the Sabbath", 'F'=>'NT-Gospel-176-The-Disciples-Pluck-Grain-on-the-Sabbath'),
'MAT-12-7' => array('N'=>'', 'C'=>"Jesus Heals a Blind Man", 'F'=>'NT-Gospel-178-Jesus-Heals-a-Blind-Man'),
'MAT-13' => array('N'=>'3', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'MAT-13-2' => array('N'=>'', 'C'=>"Jesus Preaches at the Sea of Galilee", 'F'=>'NT-Gospel-174-Jesus-Preaches-at-the-Sea-of-Galilee'),
'MAT-13-3' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'MAT-14' => array('N'=>'3', 'C'=>"Herod's Daughter Receives the Head of John the Baptist", 'F'=>'NT-Gospel-182-Herods-Daughter-Receives-the-Head-of-John-the-Baptist'),
'MAT-14-2' => array('N'=>'', 'C'=>"Jesus Feeds the Multitudes", 'F'=>'NT-Gospel-184-Jesus-Feeds-the-Multitudes'),
'MAT-14-3' => array('N'=>'', 'C'=>"Jesus Walks on the Sea", 'F'=>'NT-Gospel-185-Jesus-Walks-on-the-Sea'),
'MAT-15' => array('N'=>'4', 'C'=>"The Prophet Isaiah", 'F'=>'Hebrew-OT-110-The-Prophet-Isaiah'),
'MAT-15-2' => array('N'=>'', 'C'=>"Jesus Heals a Demoniac", 'F'=>'NT-Gospel-173-Jesus-Heals-a-Demoniac'),
'MAT-15-3' => array('N'=>'', 'C'=>"Jesus Feeds the Multitudes", 'F'=>'NT-Gospel-184-Jesus-Feeds-the-Multitudes'),
'MAT-15-4' => array('N'=>'', 'C'=>"Jesus Heals the Sick", 'F'=>'NT-Gospel-186-Jesus-Heals-the-Sick'),
'MAT-16' => array('N'=>'2', 'C'=>"Jonah is Spewed Forth by the Whale", 'F'=>'Hebrew-OT-138-Jonah-is-Spewed-Forth-by-the-Whale'),
'MAT-16-2' => array('N'=>'', 'C'=>"Jonah Preaches to the Ninevites", 'F'=>'Hebrew-OT-139-Jonah-Preaches-to-the-Ninevites'),
'MAT-17' => array('N'=>'4', 'C'=>"Elijah Ascends to Heaven in a Chariot of Fire", 'F'=>'Hebrew-OT-102-Elijah-Ascends-to-Heaven-in-a-Chariot-of-Fire'),
'MAT-17-2' => array('N'=>'', 'C'=>"Jesus Heals a Demoniac", 'F'=>'NT-Gospel-173-Jesus-Heals-a-Demoniac'),
'MAT-17-3' => array('N'=>'', 'C'=>"The Transfiguration", 'F'=>'NT-Gospel-187-The-Transfiguration'),
'MAT-17-4' => array('N'=>'', 'C'=>"Jesus Heals the Epileptic Demoniac", 'F'=>'NT-Gospel-188-Jesus-Heals-the-Epileptic-Demoniac'),
'MAT-19' => array('N'=>'', 'C'=>"Jesus Blesses the Little Children", 'F'=>'NT-Gospel-192-Jesus-Blesses-the-Little-Children'),
'MAT-21' => array('N'=>'4', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'MAT-21-2' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'MAT-21-3' => array('N'=>'', 'C'=>"Jesus Enters into Jerusalem", 'F'=>'NT-Gospel-198-Jesus-Enters-into-Jerusalem'),
'MAT-21-4' => array('N'=>'', 'C'=>"Buyers and Sellers Are Driven Out of the Temple", 'F'=>'NT-Gospel-199-Buyers-and-Sellers-Are-Driven-Out-of-the-Temple'),
'MAT-22' => array('N'=>'3', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'MAT-22-2' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'MAT-22-3' => array('N'=>'', 'C'=>"Jesus Replies about the Tribute Money", 'F'=>'NT-Gospel-200-Jesus-Replies-about-the-Tribute-Money'),
'MAT-23' => array('N'=>'2', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'MAT-23-2' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'MAT-24' => array('N'=>'4', 'C'=>"The World is Destroyed by Water", 'F'=>'Hebrew-OT-006-The-World-is-Destroyed-by-Water'),
'MAT-24-2' => array('N'=>'', 'C'=>"Daniel among the Exiles", 'F'=>'Hebrew-OT-122-Daniel-among-the-Exiles'),
'MAT-24-3' => array('N'=>'', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'MAT-24-4' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'MAT-25' => array('N'=>'2', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'MAT-25-2' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'MAT-26' => array('N'=>'5', 'C'=>"The Last Supper", 'F'=>'NT-Gospel-202-The-Last-Supper'),
'MAT-26-2' => array('N'=>'', 'C'=>"Jesus Prays in the Garden", 'F'=>'NT-Gospel-203-Jesus-Prays-in-the-Garden'),
'MAT-26-3' => array('N'=>'', 'C'=>"An Angel Appears to Jesus in the Garden", 'F'=>'NT-Gospel-204-An-Angel-Appears-to-Jesus-in-the-Garden'),
'MAT-26-4' => array('N'=>'', 'C'=>"Judas Betrays Jesus", 'F'=>'NT-Gospel-205-Judas-Betrays-Jesus'),
'MAT-26-5' => array('N'=>'', 'C'=>"Peter Denies Knowing Jesus", 'F'=>'NT-Gospel-206-Peter-Denies-Knowing-Jesus'),
'MAT-27' => array('N'=>'14', 'C'=>"The Prophet Jeremiah", 'F'=>'Hebrew-OT-114-The-Prophet-Jeremiah'),
'MAT-27-2' => array('N'=>'', 'C'=>"Jesus is Scourged", 'F'=>'NT-Gospel-207-Jesus-is-Scourged'),
'MAT-27-3' => array('N'=>'', 'C'=>"Jesus is Crowned with Thorns", 'F'=>'NT-Gospel-208-Jesus-is-Crowned-with-Thorns'),
'MAT-27-4' => array('N'=>'', 'C'=>"Jesus is Mocked", 'F'=>'NT-Gospel-209-Jesus-is-Mocked'),
'MAT-27-5' => array('N'=>'', 'C'=>"Jesus is Presented to the People", 'F'=>'NT-Gospel-210-Jesus-is-Presented-to-the-People'),
'MAT-27-6' => array('N'=>'', 'C'=>"Jesus Falls Beneath the Cross", 'F'=>'NT-Gospel-211-Jesus-Falls-Beneath-the-Cross'),
'MAT-27-7' => array('N'=>'', 'C'=>"Jesus Arrives at Calvary", 'F'=>'NT-Gospel-212-Jesus-Arrives-at-Calvary'),
'MAT-27-8' => array('N'=>'', 'C'=>"Jesus is Nailed to the Cross", 'F'=>'NT-Gospel-213-Jesus-is-Nailed-to-the-Cross'),
'MAT-27-9' => array('N'=>'', 'C'=>"The Cross is Lifted Up", 'F'=>'NT-Gospel-214-The-Cross-is-Lifted-Up'),
'MAT-27-10' => array('N'=>'', 'C'=>"The Crucifixion of Jesus and Two Criminals", 'F'=>'NT-Gospel-215-The-Crucifixion-of-Jesus-and-Two-Criminals'),
'MAT-27-11' => array('N'=>'', 'C'=>"Darkness at the Crucifixion", 'F'=>'NT-Gospel-216-Darkness-at-the-Crucifixion'),
'MAT-27-12' => array('N'=>'', 'C'=>"Jesus' Body is Removed from the Cross", 'F'=>'NT-Gospel-217-Jesus-Body-is-Removed-from-the-Cross'),
'MAT-27-13' => array('N'=>'', 'C'=>"Disciples Mourn over the Dead Jesus", 'F'=>'NT-Gospel-218-Disciples-Mourn-over-the-Dead-Jesus'),
'MAT-27-14' => array('N'=>'', 'C'=>"Jesus is Buried in the Tomb", 'F'=>'NT-Gospel-219-Jesus-is-Buried-in-the-Tomb'),
'MAT-28' => array('N'=>'2', 'C'=>"The Angel and Women at the Empty Tomb", 'F'=>'NT-Gospel-220-The-Angel-and-Women-at-the-Empty-Tomb'),
'MAT-28-2' => array('N'=>'', 'C'=>"Jesus Ascends to Heaven", 'F'=>'NT-Gospel-223-Jesus-Ascends-to-Heaven'),
'MAR-1' => array('N'=>'7', 'C'=>"John the Baptist Preaches in the Wilderness", 'F'=>'NT-Gospel-167-John-the-Baptist-Preaches-in-the-Wilderness'),
'MAR-1-2' => array('N'=>'', 'C'=>"The Baptism of Jesus", 'F'=>'NT-Gospel-168-The-Baptism-of-Jesus'),
'MAR-1-3' => array('N'=>'', 'C'=>"The Temptation of Jesus", 'F'=>'NT-Gospel-169-The-Temptation-of-Jesus'),
'MAR-1-4' => array('N'=>'', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'MAR-1-5' => array('N'=>'', 'C'=>"Jesus Heals a Demoniac", 'F'=>'NT-Gospel-173-Jesus-Heals-a-Demoniac'),
'MAR-1-6' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'MAR-1-7' => array('N'=>'', 'C'=>"Jesus Heals the Sick", 'F'=>'NT-Gospel-186-Jesus-Heals-the-Sick'),
'MAR-2' => array('N'=>'3', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'MAR-2-2' => array('N'=>'', 'C'=>"The Disciples Pluck Grain on the Sabbath", 'F'=>'NT-Gospel-176-The-Disciples-Pluck-Grain-on-the-Sabbath'),
'MAR-2-3' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'MAR-3' => array('N'=>'3', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'MAR-3-2' => array('N'=>'', 'C'=>"Jesus Heals a Demoniac", 'F'=>'NT-Gospel-173-Jesus-Heals-a-Demoniac'),
'MAR-3-3' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'MAR-4' => array('N'=>'4', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'MAR-4-2' => array('N'=>'', 'C'=>"Jesus Preaches at the Sea of Galilee", 'F'=>'NT-Gospel-174-Jesus-Preaches-at-the-Sea-of-Galilee'),
'MAR-4-3' => array('N'=>'', 'C'=>"Jesus Stills the Storm", 'F'=>'NT-Gospel-179-Jesus-Stills-the-Storm'),
'MAR-4-4' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'MAR-5' => array('N'=>'2', 'C'=>"Jesus Heals a Demoniac", 'F'=>'NT-Gospel-173-Jesus-Heals-a-Demoniac'),
'MAR-5-2' => array('N'=>'', 'C'=>"Jesus Raises the Daughter of Jairus", 'F'=>'NT-Gospel-180-Jesus-Raises-the-Daughter-of-Jairus'),
'MAR-6' => array('N'=>'6', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'MAR-6-2' => array('N'=>'', 'C'=>"Herod's Daughter Receives the Head of John the Baptist", 'F'=>'NT-Gospel-182-Herods-Daughter-Receives-the-Head-of-John-the-Baptist'),
'MAR-6-3' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'MAR-6-4' => array('N'=>'', 'C'=>"Jesus Feeds the Multitudes", 'F'=>'NT-Gospel-184-Jesus-Feeds-the-Multitudes'),
'MAR-6-5' => array('N'=>'', 'C'=>"Jesus Walks on the Sea", 'F'=>'NT-Gospel-185-Jesus-Walks-on-the-Sea'),
'MAR-6-6' => array('N'=>'', 'C'=>"Jesus Heals the Sick", 'F'=>'NT-Gospel-186-Jesus-Heals-the-Sick'),
'MAR-7' => array('N'=>'2', 'C'=>"The Prophet Isaiah", 'F'=>'Hebrew-OT-110-The-Prophet-Isaiah'),
'MAR-7-2' => array('N'=>'', 'C'=>"Jesus Heals a Demoniac", 'F'=>'NT-Gospel-173-Jesus-Heals-a-Demoniac'),
'MAR-8' => array('N'=>'3', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'MAR-8-2' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'MAR-8-3' => array('N'=>'', 'C'=>"Jesus Feeds the Multitudes", 'F'=>'NT-Gospel-184-Jesus-Feeds-the-Multitudes'),
'MAR-9' => array('N'=>'5', 'C'=>"Elijah Ascends to Heaven in a Chariot of Fire", 'F'=>'Hebrew-OT-102-Elijah-Ascends-to-Heaven-in-a-Chariot-of-Fire'),
'MAR-9-2' => array('N'=>'', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'MAR-9-3' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'MAR-9-4' => array('N'=>'', 'C'=>"The Transfiguration", 'F'=>'NT-Gospel-187-The-Transfiguration'),
'MAR-9-5' => array('N'=>'', 'C'=>"Jesus Heals the Epileptic Demoniac", 'F'=>'NT-Gospel-188-Jesus-Heals-the-Epileptic-Demoniac'),
'MAR-10' => array('N'=>'', 'C'=>"Jesus Blesses the Little Children", 'F'=>'NT-Gospel-192-Jesus-Blesses-the-Little-Children'),
'MAR-11' => array('N'=>'2', 'C'=>"Jesus Enters into Jerusalem", 'F'=>'NT-Gospel-198-Jesus-Enters-into-Jerusalem'),
'MAR-11-2' => array('N'=>'', 'C'=>"Buyers and Sellers Are Driven Out of the Temple", 'F'=>'NT-Gospel-199-Buyers-and-Sellers-Are-Driven-Out-of-the-Temple'),
'MAR-12' => array('N'=>'3', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'MAR-12-2' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'MAR-12-3' => array('N'=>'', 'C'=>"The Widow's Mite", 'F'=>'NT-Gospel-201-The-Widows-Mite'),
'MAR-13' => array('N'=>'2', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'MAR-13-2' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'MAR-14' => array('N'=>'5', 'C'=>"The Last Supper", 'F'=>'NT-Gospel-202-The-Last-Supper'),
'MAR-14-2' => array('N'=>'', 'C'=>"Jesus Prays in the Garden", 'F'=>'NT-Gospel-203-Jesus-Prays-in-the-Garden'),
'MAR-14-3' => array('N'=>'', 'C'=>"An Angel Appears to Jesus in the Garden", 'F'=>'NT-Gospel-204-An-Angel-Appears-to-Jesus-in-the-Garden'),
'MAR-14-4' => array('N'=>'', 'C'=>"Judas Betrays Jesus", 'F'=>'NT-Gospel-205-Judas-Betrays-Jesus'),
'MAR-14-5' => array('N'=>'', 'C'=>"Peter Denies Knowing Jesus", 'F'=>'NT-Gospel-206-Peter-Denies-Knowing-Jesus'),
'MAR-15' => array('N'=>'13', 'C'=>"Jesus is Scourged", 'F'=>'NT-Gospel-207-Jesus-is-Scourged'),
'MAR-15-2' => array('N'=>'', 'C'=>"Jesus is Crowned with Thorns", 'F'=>'NT-Gospel-208-Jesus-is-Crowned-with-Thorns'),
'MAR-15-3' => array('N'=>'', 'C'=>"Jesus is Mocked", 'F'=>'NT-Gospel-209-Jesus-is-Mocked'),
'MAR-15-4' => array('N'=>'', 'C'=>"Jesus is Presented to the People", 'F'=>'NT-Gospel-210-Jesus-is-Presented-to-the-People'),
'MAR-15-5' => array('N'=>'', 'C'=>"Jesus Falls Beneath the Cross", 'F'=>'NT-Gospel-211-Jesus-Falls-Beneath-the-Cross'),
'MAR-15-6' => array('N'=>'', 'C'=>"Jesus Arrives at Calvary", 'F'=>'NT-Gospel-212-Jesus-Arrives-at-Calvary'),
'MAR-15-7' => array('N'=>'', 'C'=>"Jesus is Nailed to the Cross", 'F'=>'NT-Gospel-213-Jesus-is-Nailed-to-the-Cross'),
'MAR-15-8' => array('N'=>'', 'C'=>"The Cross is Lifted Up", 'F'=>'NT-Gospel-214-The-Cross-is-Lifted-Up'),
'MAR-15-9' => array('N'=>'', 'C'=>"The Crucifixion of Jesus and Two Criminals", 'F'=>'NT-Gospel-215-The-Crucifixion-of-Jesus-and-Two-Criminals'),
'MAR-15-10' => array('N'=>'', 'C'=>"Darkness at the Crucifixion", 'F'=>'NT-Gospel-216-Darkness-at-the-Crucifixion'),
'MAR-15-11' => array('N'=>'', 'C'=>"Jesus' Body is Removed from the Cross", 'F'=>'NT-Gospel-217-Jesus-Body-is-Removed-from-the-Cross'),
'MAR-15-12' => array('N'=>'', 'C'=>"Disciples Mourn over the Dead Jesus", 'F'=>'NT-Gospel-218-Disciples-Mourn-over-the-Dead-Jesus'),
'MAR-15-13' => array('N'=>'', 'C'=>"Jesus is Buried in the Tomb", 'F'=>'NT-Gospel-219-Jesus-is-Buried-in-the-Tomb'),
'MAR-16' => array('N'=>'4', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'MAR-16-2' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'MAR-16-3' => array('N'=>'', 'C'=>"The Angel and Women at the Empty Tomb", 'F'=>'NT-Gospel-220-The-Angel-and-Women-at-the-Empty-Tomb'),
'MAR-16-4' => array('N'=>'', 'C'=>"Jesus Ascends to Heaven", 'F'=>'NT-Gospel-223-Jesus-Ascends-to-Heaven'),
'LUK-1' => array('N'=>'2', 'C'=>"The Annunciation", 'F'=>'NT-Gospel-161-The-Annunciation'),
'LUK-1-2' => array('N'=>'', 'C'=>"John the Baptist Preaches in the Wilderness", 'F'=>'NT-Gospel-167-John-the-Baptist-Preaches-in-the-Wilderness'),
'LUK-2' => array('N'=>'2', 'C'=>"The Birth of Jesus", 'F'=>'NT-Gospel-162-The-Birth-of-Jesus'),
'LUK-2-2' => array('N'=>'', 'C'=>"Jesus Questions the Doctors", 'F'=>'NT-Gospel-166-Jesus-Questions-the-Doctors'),
'LUK-3' => array('N'=>'3', 'C'=>"The Testing of Abraham's Faith", 'F'=>'Hebrew-OT-016-The-Testing-of-Abrahams-Faith'),
'LUK-3-2' => array('N'=>'', 'C'=>"David Mourns the Death of Absalom", 'F'=>'Hebrew-OT-086-David-Mourns-the-Death-of-Absalom'),
'LUK-3-3' => array('N'=>'', 'C'=>"The Baptism of Jesus", 'F'=>'NT-Gospel-168-The-Baptism-of-Jesus'),
'LUK-4' => array('N'=>'6', 'C'=>"The Prophet Isaiah", 'F'=>'Hebrew-OT-110-The-Prophet-Isaiah'),
'LUK-4-2' => array('N'=>'', 'C'=>"The Temptation of Jesus", 'F'=>'NT-Gospel-169-The-Temptation-of-Jesus'),
'LUK-4-3' => array('N'=>'', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'LUK-4-4' => array('N'=>'', 'C'=>"Jesus Heals a Demoniac", 'F'=>'NT-Gospel-173-Jesus-Heals-a-Demoniac'),
'LUK-4-5' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'LUK-4-6' => array('N'=>'', 'C'=>"Jesus Heals the Sick", 'F'=>'NT-Gospel-186-Jesus-Heals-the-Sick'),
'LUK-5' => array('N'=>'2', 'C'=>"Jesus Preaches at the Sea of Galilee", 'F'=>'NT-Gospel-174-Jesus-Preaches-at-the-Sea-of-Galilee'),
'LUK-5-2' => array('N'=>'', 'C'=>"Jesus Heals the Sick", 'F'=>'NT-Gospel-186-Jesus-Heals-the-Sick'),
'LUK-6' => array('N'=>'4', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'LUK-6-2' => array('N'=>'', 'C'=>"The Sermon on the Mount", 'F'=>'NT-Gospel-175-The-Sermon-on-the-Mount'),
'LUK-6-3' => array('N'=>'', 'C'=>"The Disciples Pluck Grain on the Sabbath", 'F'=>'NT-Gospel-176-The-Disciples-Pluck-Grain-on-the-Sabbath'),
'LUK-6-4' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'LUK-7' => array('N'=>'2', 'C'=>"A Sinful Woman Repents", 'F'=>'NT-Gospel-177-A-Sinful-Woman-Repents'),
'LUK-7-2' => array('N'=>'', 'C'=>"Jesus Heals the Sick", 'F'=>'NT-Gospel-186-Jesus-Heals-the-Sick'),
'LUK-8' => array('N'=>'3', 'C'=>"Jesus Heals a Demoniac", 'F'=>'NT-Gospel-173-Jesus-Heals-a-Demoniac'),
'LUK-8-2' => array('N'=>'', 'C'=>"Jesus Stills the Storm", 'F'=>'NT-Gospel-179-Jesus-Stills-the-Storm'),
'LUK-8-3' => array('N'=>'', 'C'=>"Jesus Raises the Daughter of Jairus", 'F'=>'NT-Gospel-180-Jesus-Raises-the-Daughter-of-Jairus'),
'LUK-9' => array('N'=>'6', 'C'=>"Elijah Ascends to Heaven in a Chariot of Fire", 'F'=>'Hebrew-OT-102-Elijah-Ascends-to-Heaven-in-a-Chariot-of-Fire'),
'LUK-9-2' => array('N'=>'', 'C'=>"Jesus Heals a Demoniac", 'F'=>'NT-Gospel-173-Jesus-Heals-a-Demoniac'),
'LUK-9-3' => array('N'=>'', 'C'=>"Herod's Daughter Receives the Head of John the Baptist", 'F'=>'NT-Gospel-182-Herods-Daughter-Receives-the-Head-of-John-the-Baptist'),
'LUK-9-4' => array('N'=>'', 'C'=>"Jesus Feeds the Multitudes", 'F'=>'NT-Gospel-184-Jesus-Feeds-the-Multitudes'),
'LUK-9-5' => array('N'=>'', 'C'=>"The Transfiguration", 'F'=>'NT-Gospel-187-The-Transfiguration'),
'LUK-9-6' => array('N'=>'', 'C'=>"Jesus Heals the Epileptic Demoniac", 'F'=>'NT-Gospel-188-Jesus-Heals-the-Epileptic-Demoniac'),
'LUK-10' => array('N'=>'3', 'C'=>"Jesus at the House of Martha and Mary", 'F'=>'NT-Gospel-181-Jesus-at-the-House-of-Martha-and-Mary'),
'LUK-10-2' => array('N'=>'', 'C'=>"The Parable of the Good Samaritan", 'F'=>'NT-Gospel-190-The-Parable-of-the-Good-Samaritan'),
'LUK-10-3' => array('N'=>'', 'C'=>"The Good Samaritan Arrives at the Inn", 'F'=>'NT-Gospel-191-The-Good-Samaritan-Arrives-at-the-Inn'),
'LUK-11' => array('N'=>'7', 'C'=>"Cain Slays Abel", 'F'=>'Hebrew-OT-005-Cain-Slays-Abel'),
'LUK-11-2' => array('N'=>'', 'C'=>"Solomon Receives the Queen of Sheba", 'F'=>'Hebrew-OT-092-Solomon-Receives-the-Queen-of-Sheba'),
'LUK-11-3' => array('N'=>'', 'C'=>"Zechariah's Vision of Four Chariots", 'F'=>'Hebrew-OT-129-Zechariahs-Vision-of-Four-Chariots'),
'LUK-11-4' => array('N'=>'', 'C'=>"Jonah is Spewed Forth by the Whale", 'F'=>'Hebrew-OT-138-Jonah-is-Spewed-Forth-by-the-Whale'),
'LUK-11-5' => array('N'=>'', 'C'=>"Jonah Preaches to the Ninevites", 'F'=>'Hebrew-OT-139-Jonah-Preaches-to-the-Ninevites'),
'LUK-11-6' => array('N'=>'', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'LUK-11-7' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'LUK-12' => array('N'=>'3', 'C'=>"Solomon Receives the Queen of Sheba", 'F'=>'Hebrew-OT-092-Solomon-Receives-the-Queen-of-Sheba'),
'LUK-12-2' => array('N'=>'', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'LUK-12-3' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'LUK-13' => array('N'=>'2', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'LUK-13-2' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'LUK-15' => array('N'=>'2', 'C'=>"The Prodigal Son Returns Home", 'F'=>'NT-Gospel-193-The-Prodigal-Son-Returns-Home'),
'LUK-15-2' => array('N'=>'', 'C'=>"The Prodigal Son in His Father's Arms", 'F'=>'NT-Gospel-194-The-Prodigal-Son-in-His-Fathers-Arms'),
'LUK-16' => array('N'=>'3', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'LUK-16-2' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'LUK-16-3' => array('N'=>'', 'C'=>"Lazarus outside the Rich Man's House", 'F'=>'NT-Gospel-195-Lazarus-outside-the-Rich-Mans-House'),
'LUK-18' => array('N'=>'2', 'C'=>"Jesus Blesses the Little Children", 'F'=>'NT-Gospel-192-Jesus-Blesses-the-Little-Children'),
'LUK-18-2' => array('N'=>'', 'C'=>"The Pharisee and the Publican", 'F'=>'NT-Gospel-196-The-Pharisee-and-the-Publican'),
'LUK-19' => array('N'=>'2', 'C'=>"Jesus Enters into Jerusalem", 'F'=>'NT-Gospel-198-Jesus-Enters-into-Jerusalem'),
'LUK-19-2' => array('N'=>'', 'C'=>"Buyers and Sellers Are Driven Out of the Temple", 'F'=>'NT-Gospel-199-Buyers-and-Sellers-Are-Driven-Out-of-the-Temple'),
'LUK-20' => array('N'=>'2', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'LUK-20-2' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'LUK-21' => array('N'=>'3', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'LUK-21-2' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'LUK-21-3' => array('N'=>'', 'C'=>"The Widow's Mite", 'F'=>'NT-Gospel-201-The-Widows-Mite'),
'LUK-22' => array('N'=>'9', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'LUK-22-2' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'LUK-22-3' => array('N'=>'', 'C'=>"The Last Supper", 'F'=>'NT-Gospel-202-The-Last-Supper'),
'LUK-22-4' => array('N'=>'', 'C'=>"Jesus Prays in the Garden", 'F'=>'NT-Gospel-203-Jesus-Prays-in-the-Garden'),
'LUK-22-5' => array('N'=>'', 'C'=>"An Angel Appears to Jesus in the Garden", 'F'=>'NT-Gospel-204-An-Angel-Appears-to-Jesus-in-the-Garden'),
'LUK-22-6' => array('N'=>'', 'C'=>"Judas Betrays Jesus", 'F'=>'NT-Gospel-205-Judas-Betrays-Jesus'),
'LUK-22-7' => array('N'=>'', 'C'=>"Peter Denies Knowing Jesus", 'F'=>'NT-Gospel-206-Peter-Denies-Knowing-Jesus'),
'LUK-22-8' => array('N'=>'', 'C'=>"Jesus is Crowned with Thorns", 'F'=>'NT-Gospel-208-Jesus-is-Crowned-with-Thorns'),
'LUK-22-9' => array('N'=>'', 'C'=>"Jesus is Mocked", 'F'=>'NT-Gospel-209-Jesus-is-Mocked'),
'LUK-23' => array('N'=>'11', 'C'=>"Jesus is Scourged", 'F'=>'NT-Gospel-207-Jesus-is-Scourged'),
'LUK-23-2' => array('N'=>'', 'C'=>"Jesus is Presented to the People", 'F'=>'NT-Gospel-210-Jesus-is-Presented-to-the-People'),
'LUK-23-3' => array('N'=>'', 'C'=>"Jesus Falls Beneath the Cross", 'F'=>'NT-Gospel-211-Jesus-Falls-Beneath-the-Cross'),
'LUK-23-4' => array('N'=>'', 'C'=>"Jesus Arrives at Calvary", 'F'=>'NT-Gospel-212-Jesus-Arrives-at-Calvary'),
'LUK-23-5' => array('N'=>'', 'C'=>"Jesus is Nailed to the Cross", 'F'=>'NT-Gospel-213-Jesus-is-Nailed-to-the-Cross'),
'LUK-23-6' => array('N'=>'', 'C'=>"The Cross is Lifted Up", 'F'=>'NT-Gospel-214-The-Cross-is-Lifted-Up'),
'LUK-23-7' => array('N'=>'', 'C'=>"The Crucifixion of Jesus and Two Criminals", 'F'=>'NT-Gospel-215-The-Crucifixion-of-Jesus-and-Two-Criminals'),
'LUK-23-8' => array('N'=>'', 'C'=>"Darkness at the Crucifixion", 'F'=>'NT-Gospel-216-Darkness-at-the-Crucifixion'),
'LUK-23-9' => array('N'=>'', 'C'=>"Jesus' Body is Removed from the Cross", 'F'=>'NT-Gospel-217-Jesus-Body-is-Removed-from-the-Cross'),
'LUK-23-10' => array('N'=>'', 'C'=>"Disciples Mourn over the Dead Jesus", 'F'=>'NT-Gospel-218-Disciples-Mourn-over-the-Dead-Jesus'),
'LUK-23-11' => array('N'=>'', 'C'=>"Jesus is Buried in the Tomb", 'F'=>'NT-Gospel-219-Jesus-is-Buried-in-the-Tomb'),
'LUK-24' => array('N'=>'3', 'C'=>"The Angel and Women at the Empty Tomb", 'F'=>'NT-Gospel-220-The-Angel-and-Women-at-the-Empty-Tomb'),
'LUK-24-2' => array('N'=>'', 'C'=>"Jesus and Two Disciples Go to Emmaus", 'F'=>'NT-Gospel-221-Jesus-and-Two-Disciples-Go-to-Emmaus'),
'LUK-24-3' => array('N'=>'', 'C'=>"Jesus Ascends to Heaven", 'F'=>'NT-Gospel-223-Jesus-Ascends-to-Heaven'),
'JOH-1' => array('N'=>'2', 'C'=>"John the Baptist Preaches in the Wilderness", 'F'=>'NT-Gospel-167-John-the-Baptist-Preaches-in-the-Wilderness'),
'JOH-1-2' => array('N'=>'', 'C'=>"The Baptism of Jesus", 'F'=>'NT-Gospel-168-The-Baptism-of-Jesus'),
'JOH-2' => array('N'=>'2', 'C'=>"The Wedding at Cana", 'F'=>'NT-Gospel-170-The-Wedding-at-Cana'),
'JOH-2-2' => array('N'=>'', 'C'=>"Buyers and Sellers Are Driven Out of the Temple", 'F'=>'NT-Gospel-199-Buyers-and-Sellers-Are-Driven-Out-of-the-Temple'),
'JOH-3' => array('N'=>'', 'C'=>"The Bronze Serpent", 'F'=>'Hebrew-OT-044-The-Bronze-Serpent'),
'JOH-4' => array('N'=>'', 'C'=>"Jesus and the Woman of Samaria", 'F'=>'NT-Gospel-171-Jesus-and-the-Woman-of-Samaria'),
'JOH-6' => array('N'=>'5', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'JOH-6-2' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'JOH-6-3' => array('N'=>'', 'C'=>"Jesus Feeds the Multitudes", 'F'=>'NT-Gospel-184-Jesus-Feeds-the-Multitudes'),
'JOH-6-4' => array('N'=>'', 'C'=>"Jesus Walks on the Sea", 'F'=>'NT-Gospel-185-Jesus-Walks-on-the-Sea'),
'JOH-6-5' => array('N'=>'', 'C'=>"Jesus Heals the Sick", 'F'=>'NT-Gospel-186-Jesus-Heals-the-Sick'),
'JOH-7' => array('N'=>'2', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'JOH-7-2' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'JOH-8' => array('N'=>'3', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'JOH-8-2' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'JOH-8-3' => array('N'=>'', 'C'=>"Jesus and the Woman Taken in Adultery", 'F'=>'NT-Gospel-189-Jesus-and-the-Woman-Taken-in-Adultery'),
'JOH-11' => array('N'=>'2', 'C'=>"Jesus at the House of Martha and Mary", 'F'=>'NT-Gospel-181-Jesus-at-the-House-of-Martha-and-Mary'),
'JOH-11-2' => array('N'=>'', 'C'=>"The Raising of Lazarus", 'F'=>'NT-Gospel-197-The-Raising-of-Lazarus'),
'JOH-12' => array('N'=>'3', 'C'=>"The Prophet Isaiah", 'F'=>'Hebrew-OT-110-The-Prophet-Isaiah'),
'JOH-12-2' => array('N'=>'', 'C'=>"Jesus at the House of Martha and Mary", 'F'=>'NT-Gospel-181-Jesus-at-the-House-of-Martha-and-Mary'),
'JOH-12-3' => array('N'=>'', 'C'=>"Jesus Enters into Jerusalem", 'F'=>'NT-Gospel-198-Jesus-Enters-into-Jerusalem'),
'JOH-13' => array('N'=>'', 'C'=>"The Last Supper", 'F'=>'NT-Gospel-202-The-Last-Supper'),
'JOH-14' => array('N'=>'2', 'C'=>"Jesus Preaches in the Synagogue", 'F'=>'NT-Gospel-172-Jesus-Preaches-in-the-Synagogue'),
'JOH-14-2' => array('N'=>'', 'C'=>"Jesus Preaches to the Multitude", 'F'=>'NT-Gospel-183-Jesus-Preaches-to-the-Multitude'),
'JOH-18' => array('N'=>'4', 'C'=>"Jesus Prays in the Garden", 'F'=>'NT-Gospel-203-Jesus-Prays-in-the-Garden'),
'JOH-18-2' => array('N'=>'', 'C'=>"An Angel Appears to Jesus in the Garden", 'F'=>'NT-Gospel-204-An-Angel-Appears-to-Jesus-in-the-Garden'),
'JOH-18-3' => array('N'=>'', 'C'=>"Judas Betrays Jesus", 'F'=>'NT-Gospel-205-Judas-Betrays-Jesus'),
'JOH-18-4' => array('N'=>'', 'C'=>"Peter Denies Knowing Jesus", 'F'=>'NT-Gospel-206-Peter-Denies-Knowing-Jesus'),
'JOH-19' => array('N'=>'13', 'C'=>"Jesus is Scourged", 'F'=>'NT-Gospel-207-Jesus-is-Scourged'),
'JOH-19-2' => array('N'=>'', 'C'=>"Jesus is Crowned with Thorns", 'F'=>'NT-Gospel-208-Jesus-is-Crowned-with-Thorns'),
'JOH-19-3' => array('N'=>'', 'C'=>"Jesus is Mocked", 'F'=>'NT-Gospel-209-Jesus-is-Mocked'),
'JOH-19-4' => array('N'=>'', 'C'=>"Jesus is Presented to the People", 'F'=>'NT-Gospel-210-Jesus-is-Presented-to-the-People'),
'JOH-19-5' => array('N'=>'', 'C'=>"Jesus Falls Beneath the Cross", 'F'=>'NT-Gospel-211-Jesus-Falls-Beneath-the-Cross'),
'JOH-19-6' => array('N'=>'', 'C'=>"Jesus Arrives at Calvary", 'F'=>'NT-Gospel-212-Jesus-Arrives-at-Calvary'),
'JOH-19-7' => array('N'=>'', 'C'=>"Jesus is Nailed to the Cross", 'F'=>'NT-Gospel-213-Jesus-is-Nailed-to-the-Cross'),
'JOH-19-8' => array('N'=>'', 'C'=>"The Cross is Lifted Up", 'F'=>'NT-Gospel-214-The-Cross-is-Lifted-Up'),
'JOH-19-9' => array('N'=>'', 'C'=>"The Crucifixion of Jesus and Two Criminals", 'F'=>'NT-Gospel-215-The-Crucifixion-of-Jesus-and-Two-Criminals'),
'JOH-19-10' => array('N'=>'', 'C'=>"Darkness at the Crucifixion", 'F'=>'NT-Gospel-216-Darkness-at-the-Crucifixion'),
'JOH-19-11' => array('N'=>'', 'C'=>"Jesus' Body is Removed from the Cross", 'F'=>'NT-Gospel-217-Jesus-Body-is-Removed-from-the-Cross'),
'JOH-19-12' => array('N'=>'', 'C'=>"Disciples Mourn over the Dead Jesus", 'F'=>'NT-Gospel-218-Disciples-Mourn-over-the-Dead-Jesus'),
'JOH-19-13' => array('N'=>'', 'C'=>"Jesus is Buried in the Tomb", 'F'=>'NT-Gospel-219-Jesus-is-Buried-in-the-Tomb'),
'JOH-20' => array('N'=>'', 'C'=>"The Angel and Women at the Empty Tomb", 'F'=>'NT-Gospel-220-The-Angel-and-Women-at-the-Empty-Tomb'),
'JOH-21' => array('N'=>'2', 'C'=>"The Miraculous Catch of Fish", 'F'=>'NT-Gospel-222-The-Miraculous-Catch-of-Fish'),
'JOH-21-2' => array('N'=>'', 'C'=>"Jesus Ascends to Heaven", 'F'=>'NT-Gospel-223-Jesus-Ascends-to-Heaven'),
'ACT-1' => array('N'=>'', 'C'=>"Jesus Ascends to Heaven", 'F'=>'NT-Gospel-223-Jesus-Ascends-to-Heaven'),
'ACT-2' => array('N'=>'3', 'C'=>"The Tower of Babel", 'F'=>'Hebrew-OT-010-The-Tower-of-Babel'),
'ACT-2-2' => array('N'=>'', 'C'=>"The Holy Spirit Descends on the Disciples", 'F'=>'NT-Gospel-224-The-Holy-Spirit-Descends-on-the-Disciples'),
'ACT-2-3' => array('N'=>'', 'C'=>"The Apostles Preach the Gospel", 'F'=>'NT-Gospel-225-The-Apostles-Preach-the-Gospel'),
'ACT-3' => array('N'=>'', 'C'=>"Peter and John at the Beautiful Gate", 'F'=>'NT-Gospel-226-Peter-and-John-at-the-Beautiful-Gate'),
'ACT-5' => array('N'=>'', 'C'=>"The Death of Ananias", 'F'=>'NT-Gospel-227-The-Death-of-Ananias'),
'ACT-7' => array('N'=>'2', 'C'=>"Moses Comes Down from Mount Sinai", 'F'=>'Hebrew-OT-040-Moses-Comes-Down-from-Mount-Sinai'),
'ACT-7-2' => array('N'=>'', 'C'=>"The Martyrdom of Stephen", 'F'=>'NT-Gospel-228-The-Martyrdom-of-Stephen'),
'ACT-8' => array('N'=>'', 'C'=>"The Prophet Isaiah", 'F'=>'Hebrew-OT-110-The-Prophet-Isaiah'),
'ACT-9' => array('N'=>'', 'C'=>"The Conversion of Saul", 'F'=>'NT-Gospel-229-The-Conversion-of-Saul'),
'ACT-10' => array('N'=>'', 'C'=>"Peter Preaches in the House of Cornelius", 'F'=>'NT-Gospel-230-Peter-Preaches-in-the-House-of-Cornelius'),
'ACT-12' => array('N'=>'', 'C'=>"Peter is Delivered from Prison", 'F'=>'NT-Gospel-231-Peter-is-Delivered-from-Prison'),
'ACT-17' => array('N'=>'', 'C'=>"Paul Preaches to the Thessalonians", 'F'=>'NT-Gospel-232-Paul-Preaches-to-the-Thessalonians'),
'ACT-19' => array('N'=>'', 'C'=>"Paul Preaches at Ephesus", 'F'=>'NT-Gospel-233-Paul-Preaches-at-Ephesus'),
'ACT-21' => array('N'=>'', 'C'=>"Paul is Rescued from the Crowd", 'F'=>'NT-Gospel-234-Paul-is-Rescued-from-the-Crowd'),
'ACT-27' => array('N'=>'', 'C'=>"Paul is Shipwrecked", 'F'=>'NT-Gospel-235-Paul-is-Shipwrecked'),
'ROM-5' => array('N'=>'', 'C'=>"Adam and Eve Are Driven out of Eden", 'F'=>'Hebrew-OT-003-Adam-and-Eve-Are-Driven-out-of-Eden'),
'ROM-9' => array('N'=>'2', 'C'=>"Isaac Blesses Jacob", 'F'=>'Hebrew-OT-020-Isaac-Blesses-Jacob'),
'ROM-9-2' => array('N'=>'', 'C'=>"The Prophet Isaiah", 'F'=>'Hebrew-OT-110-The-Prophet-Isaiah'),
'ROM-11' => array('N'=>'', 'C'=>"Elijah is Nourished by an Angel", 'F'=>'Hebrew-OT-097-Elijah-is-Nourished-by-an-Angel'),
'2CO-3' => array('N'=>'', 'C'=>"Moses Comes Down from Mount Sinai", 'F'=>'Hebrew-OT-040-Moses-Comes-Down-from-Mount-Sinai'),
'2CO-4' => array('N'=>'', 'C'=>"The Creation of Light", 'F'=>'Hebrew-OT-001-The-Creation-of-Light'),
'GAL-1' => array('N'=>'', 'C'=>"The Conversion of Saul", 'F'=>'NT-Gospel-229-The-Conversion-of-Saul'),
'GAL-4' => array('N'=>'2', 'C'=>"Abraham Sends Hagar and Ishmael Away", 'F'=>'Hebrew-OT-014-Abraham-Sends-Hagar-and-Ishmael-Away'),
'GAL-4-2' => array('N'=>'', 'C'=>"Hagar and Ishmael in the Wilderness", 'F'=>'Hebrew-OT-015-Hagar-and-Ishmael-in-the-Wilderness'),
'EPH-1' => array('N'=>'', 'C'=>"Paul Preaches at Ephesus", 'F'=>'NT-Gospel-233-Paul-Preaches-at-Ephesus'),
'1TH-2' => array('N'=>'', 'C'=>"Paul Preaches to the Thessalonians", 'F'=>'NT-Gospel-232-Paul-Preaches-to-the-Thessalonians'),
'1TI-2' => array('N'=>'', 'C'=>"Adam and Eve Are Driven out of Eden", 'F'=>'Hebrew-OT-003-Adam-and-Eve-Are-Driven-out-of-Eden'),
'HEB-11' => array('N'=>'17', 'C'=>"The Creation of Light", 'F'=>'Hebrew-OT-001-The-Creation-of-Light'),
'HEB-11-2' => array('N'=>'', 'C'=>"Cain and Abel Offer Their Sacrifices", 'F'=>'Hebrew-OT-004-Cain-and-Abel-Offer-Their-Sacrifices'),
'HEB-11-3' => array('N'=>'', 'C'=>"Cain Slays Abel", 'F'=>'Hebrew-OT-005-Cain-Slays-Abel'),
'HEB-11-4' => array('N'=>'', 'C'=>"A Dove is Sent Forth from the Ark", 'F'=>'Hebrew-OT-008-A-Dove-is-Sent-Forth-from-the-Ark'),
'HEB-11-5' => array('N'=>'', 'C'=>"Abraham Goes to the Land of Canaan", 'F'=>'Hebrew-OT-011-Abraham-Goes-to-the-Land-of-Canaan'),
'HEB-11-6' => array('N'=>'', 'C'=>"The Testing of Abraham's Faith", 'F'=>'Hebrew-OT-016-The-Testing-of-Abrahams-Faith'),
'HEB-11-7' => array('N'=>'', 'C'=>"Isaac Blesses Jacob", 'F'=>'Hebrew-OT-020-Isaac-Blesses-Jacob'),
'HEB-11-8' => array('N'=>'', 'C'=>"Jacob's Dream", 'F'=>'Hebrew-OT-021-Jacobs-Dream'),
'HEB-11-9' => array('N'=>'', 'C'=>"The Child Moses on the Nile", 'F'=>'Hebrew-OT-030-The-Child-Moses-on-the-Nile'),
'HEB-11-10' => array('N'=>'', 'C'=>"Moses and Aaron Appear before Pharaoh", 'F'=>'Hebrew-OT-032-Moses-and-Aaron-Appear-before-Pharaoh'),
'HEB-11-11' => array('N'=>'', 'C'=>"The Egyptians Drown in the Sea", 'F'=>'Hebrew-OT-037-The-Egyptians-Drown-in-the-Sea'),
'HEB-11-12' => array('N'=>'', 'C'=>"The Walls of Jericho Fall Down", 'F'=>'Hebrew-OT-048-The-Walls-of-Jericho-Fall-Down'),
'HEB-11-13' => array('N'=>'', 'C'=>"Joshua Spares Rahab", 'F'=>'Hebrew-OT-049-Joshua-Spares-Rahab'),
'HEB-11-14' => array('N'=>'', 'C'=>"Joshua Commands the Sun to Stand Still", 'F'=>'Hebrew-OT-053-Joshua-Commands-the-Sun-to-Stand-Still'),
'HEB-11-15' => array('N'=>'', 'C'=>"Gideon Chooses 300 Soldiers", 'F'=>'Hebrew-OT-056-Gideon-Chooses-300-Soldiers'),
'HEB-11-16' => array('N'=>'', 'C'=>"The Death of Samson", 'F'=>'Hebrew-OT-066-The-Death-of-Samson'),
'HEB-11-17' => array('N'=>'', 'C'=>"David Slays Goliath", 'F'=>'Hebrew-OT-075-David-Slays-Goliath'),
'HEB-12' => array('N'=>'2', 'C'=>"Cain Slays Abel", 'F'=>'Hebrew-OT-005-Cain-Slays-Abel'),
'HEB-12-2' => array('N'=>'', 'C'=>"The Giving of the Law on Mount Sinai", 'F'=>'Hebrew-OT-039-The-Giving-of-the-Law-on-Mount-Sinai'),
'JAM-1' => array('N'=>'', 'C'=>"The Creation of Light", 'F'=>'Hebrew-OT-001-The-Creation-of-Light'),
'JAM-2' => array('N'=>'', 'C'=>"Joshua Spares Rahab", 'F'=>'Hebrew-OT-049-Joshua-Spares-Rahab'),
'JAM-3' => array('N'=>'', 'C'=>"Job Hears of His Misfortunes", 'F'=>'Hebrew-OT-136-Job-Hears-of-His-Misfortunes'),
'JAM-5' => array('N'=>'2', 'C'=>"Elijah Raises the Son of the Widow of Zarephath", 'F'=>'Hebrew-OT-095-Elijah-Raises-the-Son-of-the-Widow-of-Zarephath'),
'JAM-5-2' => array('N'=>'', 'C'=>"Elijah is Nourished by an Angel", 'F'=>'Hebrew-OT-097-Elijah-is-Nourished-by-an-Angel'),
'1PE-3' => array('N'=>'2', 'C'=>"A Dove is Sent Forth from the Ark", 'F'=>'Hebrew-OT-008-A-Dove-is-Sent-Forth-from-the-Ark'),
'1PE-3-2' => array('N'=>'', 'C'=>"The Burial of Sarah", 'F'=>'Hebrew-OT-017-The-Burial-of-Sarah'),
'2PE-1' => array('N'=>'', 'C'=>"The Transfiguration", 'F'=>'NT-Gospel-187-The-Transfiguration'),
'2PE-2' => array('N'=>'2', 'C'=>"Lot Flees as Sodom and Gomorrah Burn", 'F'=>'Hebrew-OT-013-Lot-Flees-as-Sodom-and-Gomorrah-Burn'),
'2PE-2-2' => array('N'=>'', 'C'=>"An Angel Appears to Balaam", 'F'=>'Hebrew-OT-045-An-Angel-Appears-to-Balaam'),
'2PE-3' => array('N'=>'2', 'C'=>"The World is Destroyed by Water", 'F'=>'Hebrew-OT-006-The-World-is-Destroyed-by-Water'),
'2PE-3-2' => array('N'=>'', 'C'=>"The Great Flood", 'F'=>'Hebrew-OT-007-The-Great-Flood'),
'1JO-1' => array('N'=>'', 'C'=>"The Creation of Light", 'F'=>'Hebrew-OT-001-The-Creation-of-Light'),
'JUD-1' => array('N'=>'', 'C'=>"An Angel Appears to Balaam", 'F'=>'Hebrew-OT-045-An-Angel-Appears-to-Balaam'),
'REV-1' => array('N'=>'', 'C'=>"John on Patmos", 'F'=>'NT-Gospel-236-John-on-Patmos'),
'REV-2' => array('N'=>'', 'C'=>"An Angel Appears to Balaam", 'F'=>'Hebrew-OT-045-An-Angel-Appears-to-Balaam'),
'REV-6' => array('N'=>'', 'C'=>"The Pale Horse of Death", 'F'=>'NT-Gospel-237-The-Pale-Horse-of-Death'),
'REV-12' => array('N'=>'', 'C'=>"The Virgin is Crowned", 'F'=>'NT-Gospel-238-The-Virgin-is-Crowned'),
'REV-18' => array('N'=>'', 'C'=>"Babylon Has Fallen", 'F'=>'NT-Gospel-239-Babylon-Has-Fallen'),
'REV-20' => array('N'=>'', 'C'=>"The Last Judgment", 'F'=>'NT-Gospel-240-The-Last-Judgment'),
'REV-21' => array('N'=>'', 'C'=>"The New Jerusalem", 'F'=>'NT-Gospel-241-The-New-Jerusalem'),
);

global $_BibleBOOKS;
$book = (empty($_BibleBOOKS[$book]['CODE']) ? '' : $_BibleBOOKS[$book]['CODE']);
if (empty($doredata["$book-$chap"])) { return; }
$N = rand(1,(empty($doredata["$book-$chap"]['N']) ? 1 : intval($doredata["$book-$chap"]['N'])));
$N = ($N <= 1 || empty($doredata["$book-$chap-$N"]) ? '' : '-'.$N);
$file = $doredata["$book-$chap$N"]['F'];
$title = $doredata["$book-$chap$N"]['C'];
$caption =(($title=='The World is Destroyed by Water' ||
			$title=='The Great Flood' ||
			$title=='A Dove is Sent Forth from the Ark')
			? $title :
			"<a href='/resources/Gustave-Dore-La-Grande-Bible-de-Tours/Gustave-Dore-Bible-Tour-$file.jpg' target='_blank' title=\"$title\">$title</a>");
echo "<div id='dore'><img src='/resources/Gustave-Dore-La-Grande-Bible-de-Tours/web/Gustave-Dore-Bible-Tour-$file.jpg' alt=\"$title\"><br>$caption</div>";
return;
}


/*** CHAPTER INDEXES ***/
function abcms_word_cdex() {
return array(
'Genesis' => 0,
'Exodus' => 50,
'Leviticus' => 90,
'Numbers' => 117,
'Deuteronomy' => 153,
'Joshua' => 187,
'Judges' => 211,
'Ruth' => 232,
'1-Samuel' => 236,
'2-Samuel' => 267,
'1-Kings' => 291,
'2-Kings' => 313,
'1-Chronicles' => 338,
'2-Chronicles' => 367,
'Ezra' => 403,
'Nehemiah' => 413,
'Esther' => 426,
'Job' => 436,
'Psalms' => 478,
'Proverbs' => 628,
'Ecclesiastes' => 659,
'Song-of-Solomon' => 671,
'Isaiah' => 679,
'Jeremiah' => 745,
'Lamentations' => 797,
'Ezekiel' => 802,
'Daniel' => 850,
'Hosea' => 862,
'Joel' => 876,
'Amos' => 879,
'Obadiah' => 888,
'Jonah' => 889,
'Micah' => 893,
'Nahum' => 900,
'Habakkuk' => 903,
'Zephaniah' => 906,
'Haggai' => 909,
'Zechariah' => 911,
'Malachi' => 925,
'Matthew' => 0,
'Mark' => 28,
'Luke' => 44,
'John' => 68,
'Acts' => 89,
'Romans' => 117,
'1-Corinthians' => 133,
'2-Corinthians' => 149,
'Galatians' => 162,
'Ephesians' => 168,
'Philippians' => 174,
'Colossians' => 178,
'1-Thessalonians' => 182,
'2-Thessalonians' => 187,
'1-Timothy' => 190,
'2-Timothy' => 196,
'Titus' => 200,
'Philemon' => 203,
'Hebrews' => 204,
'James' => 217,
'1-Peter' => 222,
'2-Peter' => 227,
'1-John' => 230,
'2-John' => 235,
'3-John' => 236,
'Jude' => 237,
'Revelation' => 238,
);
}


/*** ABCOMMAND MULTIPLE ***/
function abcms_abcommand_multiple($command) {
// init
global $_BibleBOOKS, $_BibleCHAP1, $_BibleCHAP1_Last, $_BibleCHAP2, $_BibleCHAP2_Last, $_BibleONE, $_BibleONE_Lang, $_BibleTWO, $_BibleTWO_Lang, $_BibleTWO_xLink;
global $_Path, $_Part, $_para, $_paraC, $_pnum, $_stid, $_stidC, $_stidN, $_stidX, $_BibleSTRONGS;
$T_Path = $_Path;
$T_Part = $_Part;
$T_para = $_para;
$T_paraC = $_paraC;
$T_pnum = $_pnum;
$T_stid = $_stid;
$T_stidC = $_stidC;
$T_stidN = $_stidN;
$T_stidX = $_stidX;
$T_BibleSTRONGS = $_BibleSTRONGS;
// loop
echo "<div id='word'>";
echo "<h2>Custom Verses</h2>";
strtok("X\n$command", "\r\n");
$count = 0;
while (($line=strtok("\r\n")) !== FALSE) {
	if (empty(($line = trim($line))) || $line[0]=='#') { continue; }
	if (++$count > 100) { echo "<h4>Maximum of 100 lines processed</h4>"; break; }
	if (preg_match("#<h1>[^<>]+<\/h1>#i",$line) ||
		preg_match("#<h2>[^<>]+<\/h2>#i",$line) ||
		preg_match("#<h3>[^<>]+<\/h3>#i",$line) ||
		preg_match("#<h4>[^<>]+<\/h4>#i",$line) ||
		preg_match("#<p>[^<>]+<\/p>#i",$line)) { echo $line; continue; }
	abcms_abcommand_multiple_reference($line);
}
echo "<br>100% free to copy and print, compliments of <a href='https://www.AionianBible.org' title='Holy Bible Aionian Edition® The worlds first Bible untranslation'>AionianBible.org</a><br><br><br>";
// done
$_Path = $T_Path;
$_Part = $T_Part;
$_para = $T_para;
$_paraC = $T_paraC;
$_pnum = $T_pnum;
$_stid = $T_stid;
$_stidC = $T_stidC;
$_stidN = $T_stidN;
$_stidX = $T_stidX;
$_BibleSTRONGS = $T_BibleSTRONGS;
}


/*** ABCOMMAND MULTIPLE Display Bible Reference ***/
function abcms_abcommand_multiple_reference($reference) {
// init
global $_BibleBOOKS, $_BibleCHAP1, $_BibleCHAP1_Last, $_BibleCHAP2, $_BibleCHAP2_Last, $_BibleONE, $_BibleONE_Lang, $_BibleTWO, $_BibleTWO_Lang, $_BibleTWO_xLink;
global $_Path, $_Part, $_para, $_paraC, $_pnum, $_stid, $_stidC, $_stidN, $_stidX, $_SwipePREV, $_SwipeNEXT, $_BibleSTRONGS;
$_para = $_stid = $_paraC = $_stidC = $_stidN = $_stidX = $_SwipePREV = $_SwipeNEXT = $_BibleSTRONGS = NULL;
// errors?
$cleaned = aion_strip($reference);
if (preg_match('/[<>]+/',$reference)) {					echo "<br>ERROR: Disallowed HTML tags, REQUEST: $cleaned<br><br>";							return; }
if (!preg_match('/^[a-zA-Z0-9\-\/]+$/',$reference)) {	echo "<br>ERROR: Paths allow only alphanumeric, dash, and slash, REQUEST: $cleaned<br><br>";	return; }
// setup
$_Path = trim($reference,'/');
if (($number=preg_match_all("#/parallel-[^/]+#", $_Path, $matches, PREG_PATTERN_ORDER))) {
	if ($number>1) {									echo "<br>ERROR: Multiple 'parallels' not allowed, REQUEST: $cleaned<br><br>";				return; }
	$_para = $matches[0][0];
	$_paraC = str_replace('/parallel-','',$_para);
	$_Path = preg_replace('#/parallel-[^/]+#','',$_Path);
}
if (($number=preg_match_all("#/strongs-[^/]+#", $_Path, $matches, PREG_PATTERN_ORDER))) {
	if ($number>1) {									echo "<br>ERROR: Multiple 'strongs' not allowed, REQUEST: $cleaned<br><br>";					return; }
	$_stid = $matches[0][0];
	$_stidC = str_replace('/strongs-','',$_stid);
	$_Path = preg_replace('#/strongs-[^/]+#','',$_Path);
}
$_Part = explode('/',$_Path);
$_pnum = count($_Part);
// output
echo "<div class='word-custom'>";
if ($_Part[0]!='Bibles' || ($_pnum!=4 && $_pnum!=6)) {	echo "<br>ERROR: Invalid Bible path, REQUEST: $cleaned<br><br>"; }
else if (($error=abcms_stro_chek(TRUE)) !== TRUE) {		echo "<br>ERROR: $error, REQUEST: $cleaned<br><br>"; }
else if (($error=abcms_word_chap(TRUE)) !== TRUE) {		echo "<br>ERROR: $error, REQUEST: $cleaned<br><br>"; }
echo "</div>";
return;
}