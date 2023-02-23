<?php
/*** KDP Rate Calculator ***/
// Errors
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on' || (int)$_SERVER['SERVER_PORT'] !== 443) { exit("ERROR: Not on HTTPS! <a href='/index-rates.php'>Start over please.</a>"); }
// Process
session_start();
$usd_float = 0.00;
if(!empty($_POST['usd'])) {
	// Sanitize
	if ($_SERVER['REQUEST_METHOD']!='POST'|| $_POST['submit']!='Submit' || empty($_POST['csrf']) || empty($_SESSION['csrf']) || $_POST['csrf']!=$_SESSION['csrf']) { exit("ERROR: Insecure! <a href='/index-rates.php'>Start over please.</a>"); }
	$usd_float = round((float)$_POST['usd'],2);
	if ($usd_float < 0 || $usd_float > 40) { exit("ERROR: Invalid amount! <a href='/index-rates.php'>Start over please.</a>"); }
}
?>
<html>
<head>
<style>
body {	margin: 40px; font-family: Arial, Helvetica, sans-serif; }
input {	font-size: 1.5em; }
table {	font-size: 1.5em; }
td {	padding: 10px; text-align: right; }
</style>
</head>
<body>
<h2>KDP Rates</h2>
<form action='/index-rates.php' method='post' accept-charset='UTF-8'>
<input type='hidden' name='csrf' value='<?php echo ($_SESSION['csrf'] = hash('sha256','AionianBible.org/Publisher'.time().random_bytes(10))); ?>' />
<input type='text' name='usd' placeholder='USD' value="<? echo number_format($usd_float,2,'.','');?>" />
<input type='submit' name='submit' value='Submit' />
</form>
<table>
<tr><td>Currency</td><td>Price</td><td>Profit</td><td>Note</td></tr>
<?
/*
$f = max(1.00,1.00);			$usd_rate = 1.00;	echo "<td>USD</td><td>" . number_format($f * $usd_float * $usd_rate, 2,'.','') . "</td><td>" . number_format($usd_rate,2,'.') . "</td><td>" . ($f==1?'?':'') . "</td></tr>";
$f = max(1.00,15.18/15.15);		$gbp_rate = 0.83;	echo "<td>GBP</td><td>" . number_format($f * $usd_float * $gbp_rate, 2,'.','') . "</td><td>" . $gbp_rate. "</td><td>" . ($f==1?'?':'') . "</td></tr>";
$f = max(1.00,17.71/16.97);		$eur_rate = 0.93;	echo "<td>EUR</td><td>" . number_format($f * $usd_float * $eur_rate, 2,'.','') . "</td><td>" . $eur_rate. "</td><td>" . ($f==1?'?':'') . "</td></tr>";
$f = max(1.00,87.84/81.21);		$pln_rate = 4.45;	echo "<td>PLN</td><td>" . number_format($f * $usd_float * $pln_rate, 2,'.','') . "</td><td>" . $pln_rate. "</td><td>" . ($f==1?'?':'') . "</td></tr>"; 
$f = max(1.00,179.16/190.71);	$sek_rate = 10.45;	echo "<td>SEK</td><td>" . number_format($f * $usd_float * $sek_rate, 2,'.','') . "</td><td>" . $sek_rate. "</td><td>" . ($f==1?'?':'') . "</td></tr>";
$f = max(1.00,3042/2447.69);	$jpy_rate = 134.12;	echo "<td>JPY</td><td>" . number_format($f * $usd_float * $jpy_rate, 2,'.','') . "</td><td>" . $jpy_rate. "</td><td>" . ($f==1?'?':'') . "</td></tr>";
$f = max(1.00,24.32/24.64);		$cad_rate = 1.35;	echo "<td>CAD</td><td>" . number_format($f * $usd_float * $cad_rate, 2,'.','') . "</td><td>" . $cad_rate. "</td><td>" . ($f==1?'?':'') . "</td></tr>";
$f = max(1.00,33.20/26.46);		$aud_rate = 1.45;	echo "<td>AUD</td><td>" . number_format($f * $usd_float * $aud_rate, 2,'.','') . "</td><td>" . $aud_rate. "</td><td>" . ($f==1?'?':'') . "</td></tr>";
*/
$f = max(1.00,1.00);			$usd_rate = 1.00;	echo "<td>USD</td><td>" . number_format($f * $usd_float * $usd_rate, 2,'.','') . "</td><td>" . number_format($usd_rate,2,'.') . "</td><td>" . ($f==1?'?':'') . "</td></tr>";
$f = max(1.00,15.18/15.15);		$gbp_rate = 0.83;	echo "<td>GBP</td><td>" . number_format($f * $usd_float * $gbp_rate, 2,'.','') . "</td><td>" . $gbp_rate. "</td><td>" . ($f==1?'?':'') . "</td></tr>";
$f = max(1.00,17.71/16.97);		$eur_rate = 0.93;	echo "<td>EUR</td><td>" . number_format($f * $usd_float * $eur_rate, 2,'.','') . "</td><td>" . $eur_rate. "</td><td>" . ($f==1?'?':'') . "</td></tr>";
$f = max(1.00,87.84/81.21);		$pln_rate = 4.45;	echo "<td>PLN</td><td>" . number_format($f * $usd_float * $pln_rate, 2,'.','') . "</td><td>" . $pln_rate. "</td><td>" . ($f==1?'?':'') . "</td></tr>"; 
$f = max(1.00,179.16/190.71);	$sek_rate = 10.45;	echo "<td>SEK</td><td>" . number_format($f * $usd_float * $sek_rate, 2,'.','') . "</td><td>" . $sek_rate. "</td><td>" . ($f==1?'?':'') . "</td></tr>";
$f = max(1.00,3042/2447.69);	$jpy_rate = 134.12;	echo "<td>JPY</td><td>" . number_format($f * $usd_float * $jpy_rate, 2,'.','') . "</td><td>" . $jpy_rate. "</td><td>" . ($f==1?'?':'') . "</td></tr>";
$f = max(1.00,24.32/24.64);		$cad_rate = 1.35;	echo "<td>CAD</td><td>" . number_format($f * $usd_float * $cad_rate, 2,'.','') . "</td><td>" . $cad_rate. "</td><td>" . ($f==1?'?':'') . "</td></tr>";
$f = max(1.00,33.99/26.46);		$aud_rate = 1.45;	echo "<td>AUD</td><td>" . number_format($f * $usd_float * $aud_rate, 2,'.','') . "</td><td>" . $aud_rate. "</td><td>" . ($f==1?'?':'') . "</td></tr>";


?>
</table>
</body>
</html>