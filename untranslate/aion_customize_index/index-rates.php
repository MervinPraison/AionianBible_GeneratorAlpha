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
<tr><td>Currency</td><td>Price</td><td>Profit</td></tr>
<?
$usd_rate = 1.00;	echo "<td>USD</td><td>" . number_format($usd_float * $usd_rate, 2,'.','') . "</td><td>" . number_format($usd_rate,2,'.') . "</td></tr>";
$gbp_rate = 0.81;	echo "<td>GBP</td><td>" . number_format($usd_float * $gbp_rate, 2,'.','') . "</td><td>" . $gbp_rate. "</td></tr>";
$eur_rate = 0.97;	echo "<td>EUR</td><td>" . number_format($usd_float * $eur_rate, 2,'.','') . "</td><td>" . $eur_rate. "</td></tr>";
$pln_rate = 4.06;	echo "<td>PLN</td><td>" . number_format($usd_float * $pln_rate, 2,'.','') . "</td><td>" . $pln_rate. "</td></tr>"; 
$sek_rate = 10.94;	echo "<td>SEK</td><td>" . number_format($usd_float * $sek_rate, 2,'.','') . "</td><td>" . $sek_rate. "</td></tr>";
$jpy_rate = 151.38;	echo "<td>JPY</td><td>" . number_format($usd_float * $jpy_rate, 2,'.','') . "</td><td>" . $jpy_rate. "</td></tr>";
$cad_rate = 1.43;	echo "<td>CAD</td><td>" . number_format($usd_float * $cad_rate, 2,'.','') . "</td><td>" . $cad_rate. "</td></tr>";
$aud_rate = 1.59;	echo "<td>AUD</td><td>" . number_format($usd_float * $aud_rate, 2,'.','') . "</td><td>" . $aud_rate. "</td></tr>";
?>
</table>
</body>
</html>