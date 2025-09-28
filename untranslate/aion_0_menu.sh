#!/usr/local/bin/php
<?php


/*** init ***/
system('clear');
require_once('./aion_common.php');
define('VERSION', 'aion_0_menu.sh');
define('AIONLOG', 'aion_0_menu.sh.aionian.out');
AION_ECHO("START " . basename(__FILE__, '.php'));
$commands = array(
	'0'  => VERSION,
	'1'  => 'aion_1_get.sh',
	'2'  => 'aion_2_update.sh',
	'3'  => 'aion_3_stage.sh',
	'3b' => 'aion_3b_stage.sh',
	'3d' => 'aion_3d_database.sh',
	'3e' => 'aion_3e_epub.sh',
	'3p' => 'aion_3p_pwa.sh',
	'3q' => 'aion_3q_stage.sh',
	'3s' => 'aion_3s_strongs.sh',
	'3t' => 'aion_3t_translator.sh',
	'5'  => 'aion_5_index.sh',
	'6'  => 'aion_6_check.sh',
	'6m' => 'aion_6m_check.sh',
	'6n' => 'aion_6n_check.sh',
	'6p' => 'aion_6p_check.sh',
	'6q' => 'aion_6q_check.sh',
	'6w' => 'aion_6w_check.sh',
	'7'  => 'aion_7_deploy.sh',
	'7q' => 'aion_7q_deploy.sh',
	'7qe'=> 'aion_7qe_deploy-epub.sh',
	'8'  => 'aion_8_speedata.sh',
	'9'  => 'aion_9_backup_production.sh',
);



/*** menu and version ***/
system("tail -n 10 ".AIONLOG);
echo "\n";
echo "BEWARE-1: Ok, 3 reads UNTRANSLATEMODULE created by 6 to safeguard UNTRANSLATE,\n";
echo "BEWARE-2: yet 6 needs 3 VERSEMAP. So UNTRANSLATE and VERSEMAP updates are complicated,\n";
echo "BEWARE-3: so 3q updates VERSEMAP, 6q updates UNTRANSLATE, then 3 & 6 to finish!\n";
echo "BUILD---: 0, 1, 3s, 0, 2, 3q, COPY, 6q, COPY, 3, COPY 5, 6, 3t (MAGA=Make Aionian Great Again)\n";
echo "REVIEW--: a*diff.out / checks / checksX-diff / raw-diff-diff / spellcheck-diff / BEFORE-DEPLOY(2)\n";
echo "DEPLOY--: 9? 7 or 7q\n";
echo "SPEEDATA: Run and then 'copy -a ../www-stageresources/*Aionian-Edition*.pdf ../www-resources\n";
echo "\n";
foreach($commands as $command) { echo "\t" . $command . "\n\n"; }
//$compare1 = AION_VERSION_GET( VERSION.'.ALL', '..', $store_version_all, $live_version_all );
$compare2 = AION_VERSION_GET( VERSION, '.', $store_version, $live_version );
echo "\n\t:";



/*** choice ***/
$choice = trim(fgets(STDIN));
if (empty($commands[$choice])) {	AION_ECHO("ERROR! BAD CHOICE"); }
//if ((!$compare2 && $choice!='0')) {	AION_ECHO("ERROR! PLEASE APPROVE NEW VERSIONS"); }



/*** re-version or execute ***/
if ($choice=='000') {
	//$result = AION_VERSION_PUT(VERSION.'.ALL', '..', $live_version_all);
	$result = AION_VERSION_PUT(VERSION, '.', $live_version);
}
else if ($choice=='6w') {
	/*** run the comment ***/
	$output = $commands[$choice] . '.aionian.out';
	$yepper = './' . $commands[$choice] . ' 2>/dev/null | tee '.$output;
	AION_ECHO("COMMAND " . $yepper);
	$result = system( $yepper );
	/*** diff out ***/
	system('diff ./aion_diffout/'.$output.' '.$output.' 2>&1 > '.$commands[$choice] . '.diff.aionian.out; echo "*** DIFF OUT ***"; cat '.$commands[$choice] . '.diff.aionian.out');
}
else {
	/*** run the comment ***/
	$output = $commands[$choice] . '.aionian.out';
	$yepper = './' . $commands[$choice] . ' 2>&1 | tee ' . $output . '; ';
	$yepper .= ' (echo "Subject: AIONIAN ENGINE: '. $commands[$choice] . '"; echo; cat ' . $output . ';) | /usr/lib/sendmail escribes@aionianbible.org; ';
	AION_ECHO("COMMAND " . $yepper);
	$result = system( $yepper );
	/*** diff out ***/
	system('diff ./aion_diffout/'.$output.' '.$output.' 2>&1 > '.$commands[$choice] . '.diff.aionian.out; echo "*** DIFF OUT ***"; cat '.$commands[$choice] . '.diff.aionian.out');
}



/*** done ***/
system('echo "*** AION: Command=' . $choice . ' Result=' . $result . '" >> '.AIONLOG);
