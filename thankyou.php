
<?php
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-synch';

$tx_token = $_GET['tx'];

$auth_token = "qdQ7Ti1XJto9bH66oybCUJu7DeKJoaVlyahnPQzNNVec2xr3T-l3tsiU6-i";

$req .= "&tx=$tx_token&at=$auth_token";


// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
// If possible, securely post back to paypal using HTTPS
// Your PHP server will need to be SSL enabled
// $fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

if (!$fp) {
// HTTP ERROR
} else {
fputs ($fp, $header . $req);
// read the body data
$res = '';
$headerdone = false;
while (!feof($fp)) {
$line = fgets ($fp, 1024);
if (strcmp($line, "\r\n") == 0) {
// read the header
$headerdone = true;
}
else if ($headerdone)
{
// header has been read. now read the contents
$res .= $line;
}
}

// parse the data
$lines = explode("\n", $res);
$keyarray = array();
if (strcmp ($lines[0], "SUCCESS") == 0) {
for ($i=1; $i<count($lines);$i++){
list($key,$val) = explode("=", $lines[$i]);
$keyarray[urldecode($key)] = urldecode($val);
}
// check the payment_status is Completed
// check that txn_id has not been previously processed
// check that receiver_email is your Primary PayPal email
// check that payment_amount/payment_currency are correct
// process payment
$firstname = $keyarray['first_name'];
$lastname = $keyarray['last_name'];
$amount = $keyarray['mc_gross'];

$donatetype = "purchase";
$donation = 0;
$CUBE17purchase = 0;
$CUBE22purchase = 0;
$item = 1;
$spacer = '';
$items = '';
while(array_key_exists('item_name' . $item, $keyarray)) {
	$itemname = $keyarray['item_name' . $item];
	$itemnumber = $keyarray['item_number' . $item];
	switch($itemnumber) {
		case "FEZCLP":
		case "FEZCLW":
		case "FEZCLV":
		case "FEZCL":
			$donation += 20 * $keyarray['quantity' . $item];
			break;
		case "FEZEX":
			$donation += 25 * $keyarray['quantity' . $item];
			break;
		case "FEZCU":
			$donation += 30 * $keyarray['quantity' . $item];
			break;
		case "FICJCC":
			$donation += 10 * $keyarray['quantity' . $item];
			break;
		case "CUBE17":
			$donation += 75 * $keyarray['quantity' . $item];
			$CUBE17purchase += $keyarray['quantity' . $item];
			break;
		case "CUBE22":
			$donation += 125 * $keyarray['quantity' . $item];
			$CUBE22purchase += $keyarray['quantity' . $item];
			break;
		case "JCCC3":
			$donation += $amount;
			$donatetype = "donation";
			break;
	}
	
	$items .= $spacer . $itemname;
	$item += 1;
	$spacer = ', ';
}
$newtx = false;
if(file_exists('tx_history.txt')) {
	$file = file_get_contents('tx_history.txt');
	if(!strstr($file, $tx_token)) {
		$file .= "\n" . $tx_token;
		file_put_contents('tx_history.txt', $file);
		$newtx = true;
	}
}
if(file_exists('total.txt') && $newtx) {
	$total = file_get_contents('total.txt') + $donation;
	file_put_contents('total.txt', $total);
}
if(file_exists('CUBE17total.txt') && $newtx) {
	$total = file_get_contents('CUBE17total.txt') - $CUBE17purchase;
	file_put_contents('CUBE17total.txt', $total);
}
if(file_exists('CUBE22total.txt') && $newtx) {
	$total = file_get_contents('CUBE22total.txt') - $CUBE22purchase;
	file_put_contents('CUBE17total.txt', $total);
}
}
else if (strcmp ($lines[0], "FAIL") == 0) {
// log for manual investigation
}

}

fclose ($fp);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en"> 
<head> 
<title>Adventures of chicazul</title> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<meta http-equiv="Content-Style-Type" content="text/css" /> 
<link rel="copyright" href="http://creativecommons.org/licenses/by-nc-sa/3.0/" /> 
<link href='http://fonts.googleapis.com/css?family=Cabin+Sketch:bold' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="today.css" type="text/css" media="screen" /> 
<link rel="shortcut icon" href="../favicon.ico"> 
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="script.js"></script>
</head>
<body> 
<div id="header"><a href="http://www.chicazul.com/"><div class="headblock"><h1>Adventures of Chicazul</h1>
<p class="subhead">Maker of Things</p></div></a></div>

<div class="colmask rightmenu content">
	<div class="colmid">
		<div class="colleft">
			<div class="col1">
				<a href="fundraiser.php"><h1>Help Chicazul Go On JoCo Cruise Crazy II</h1></a>
				
				<div id="thanks">
				<p>Thanks so much for your <?php echo $donatetype . ", " . $firstname; ?>! 
				I'm now <span class="contrast">$<?php echo $donation; ?></span> closer to my goal!</p>
				<h4>Transaction Details</h4>
				<table class="details">
					<tr><td class="label"><strong>Transaction #:</strong></td><td><?php echo $tx_token; ?></td></tr>
					<tr><td class="label"><strong>Item:</strong></td><td><?php echo $items; ?></td></tr>
					<tr><td class="label"><strong>Amount:</strong></td><td>$<?php echo $amount; ?></td></tr>
				</table>
				<p>Your work here is done; a receipt has been sent via email.</p>
				<p>Return to the <a href="fundraiser.php">main fundraiser page.</a></p>
				</div>
			</div>

			<div class="col2">
			<?php include 'fundraiser-sidebar.php'; ?>
			</div>
</div>
</div>
</div>
<div id="footer"><p>Site design and content by Sara Chicazul<br/><a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-sa/3.0/88x31.png" /></a><br />All content is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/">Creative Commons Attribution-Noncommercial-Share Alike 3.0 Unported License</a>.</p></div>
</body>
</html>