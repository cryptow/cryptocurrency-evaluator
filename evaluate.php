<!DOCTYPE html>
<html>
<head>
<style>
table,th,td
{
border:1px solid black;
border-collapse:collapse;
}
</style>
</head>
<body>
<table style="width:620px">
<?php
$time_start = microtime(true); 
$ltcbc="http://ltc.blockr.io/api/v1/coin/info"; // ltc blockchain info api
$result=processURL($ltcbc);
$data = json_decode($result,true);
$litecoind = $data['data']['last_block']['difficulty']; // Litecoin Difficulty
$hashtimer = ($litecoind*pow(2,32))/(1000000); // hashtime for 1mhash and Litecoin Difficulty
$lcoinsperday = 3600*24*50/$hashtimer;
$ltcjson = json_decode(processURL("https://btc-e.com/api/2/ltc_btc/ticker"), true);
$ltcbtcv = number_format($ltcjson['ticker']['buy'], 8);
print $ltcbtcv;
$lbtcpd = $lcoinsperday*$ltcbtcv;
print $lbtcpd;
if (is_numeric ($_GET["hr"])) { $hashrate = $_GET["hr"]; } else { $hashrate = 0; } 

function percent($num_amount, $num_total) {
    return number_format((1 - $num_amount / $num_total) * 100, 2);
}
function processURL($url){
    $url=str_replace('&amp;','&',$url);
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 3); //timeout in seconds
    $data = curl_exec ($ch);
    curl_close ($ch);
    return $data;
}
function coinINFO($coin, $ltcbtcv, $lbtcpd) {
	if ($coin = "coin") {
		$blockreward =1000;
		$chain = "http://explorer.coin-project.org/chain/Coin"; 
		$ticker = "https://c-cex.com/t/coin-btc.json";
			$coinjson = json_decode(processURL($ticker), true);
	$btcv = number_format($coinjson['ticker']['buy'], 8);	
	$difficulty=processURL($chain."/q/getdifficulty");
	$hashtime = ($difficulty*pow(2,32))/(1000000);
	$coinsperday = 3600*24*$blockreward/$hashtime;
	$btcpd = $coinsperday*$btcv;
	print "<tr><td>".$coin."</td><td>".$difficulty."</td><td>".$btcv."</td><td>".number_format($btcpd/$ltcbtcv, 8)."</td><td>".number_format($btcpd, 8)."</td><td>".percent($lbtcpd, $btcpd)."</td>><td>".number_format($lbtcpd/$coinsperday,8)."</td></tr>";

	}
 	if ($coin = "dogecoin") {
		$blockreward =250000;
		$chain = "http://dogechain.info/chain/Dogecoin"; 
		$ticker = "http://data.bter.com/api/1/ticker/doge_btc";
			$coinjson = json_decode(processURL($ticker), true);
	$btcv = number_format($coinjson['buy'], 8);	
	$difficulty=processURL($chain."/q/getdifficulty");
	$hashtime = ($difficulty*pow(2,32))/(1000000);
	$coinsperday = 3600*24*$blockreward/$hashtime;
	$btcpd = $coinsperday*$btcv;
	print "<tr><td>".$coin."</td><td>".$difficulty."</td><td>".$btcv."</td><td>".number_format($btcpd/$ltcbtcv, 8)."</td><td>".number_format($btcpd, 8)."</td><td>".percent($lbtcpd, $btcpd)."</td>><td>".number_format($lbtcpd/$coinsperday,8)."</td></tr>";

	} 
	if ($coin = "feathercoin") {
		$blockreward =200;
		$chain = "http://explorer.feathercoin.com/chain/Feathercoin"; 
		$ticker = "https://btc-e.com/api/2/ftc_btc/ticker";
			$coinjson = json_decode(processURL($ticker), true);
	$btcv = number_format($coinjson['ticker']['buy'], 8);	
	$difficulty=processURL($chain."/q/getdifficulty");
	$hashtime = ($difficulty*pow(2,32))/(1000000);
	$coinsperday = 3600*24*$blockreward/$hashtime;
	$btcpd = $coinsperday*$btcv;
	print "<tr><td>".$coin."</td><td>".$difficulty."</td><td>".$btcv."</td><td>".number_format($btcpd/$ltcbtcv, 8)."</td><td>".number_format($btcpd, 8)."</td><td>".percent($lbtcpd, $btcpd)."</td>><td>".number_format($lbtcpd/$coinsperday,8)."</td></tr>";
	}
	if ($coin = "dnotes") {
		$blockreward =250;
		$chain = "http://cryptoblox.com/chain/DNotes"; 
		$ticker = "https://www.allcoin.com/api1/pair/note_btc";
			$coinjson = json_decode(processURL($ticker), true);
	$btcv = number_format($coinjson['data']['trade_price'], 8);	
	$difficulty=processURL($chain."/q/getdifficulty");
	$hashtime = ($difficulty*pow(2,32))/(1000000);
	$coinsperday = 3600*24*$blockreward/$hashtime;
	$btcpd = $coinsperday*$btcv;
	print "<tr><td>".$coin."</td><td>".$difficulty."</td><td>".$btcv."</td><td>".number_format($btcpd/$ltcbtcv, 8)."</td><td>".number_format($btcpd, 8)."</td><td>".percent($lbtcpd, $btcpd)."</td>><td>".number_format($lbtcpd/$coinsperday,8)."</td><td>".$coinsperday."</td></tr>";
	}
	if ($coin = "worldcoin") {
		$blockreward =48.81;
		$chain = "http://wdc.cryptocoinexplorer.com/chain/Worldcoin"; 
		$ticker = "http://data.bter.com/api/1/ticker/wdc_btc";
			$coinjson = json_decode(processURL($ticker), true);
	$btcv = number_format($coinjson['buy'], 8);	
	$difficulty=processURL($chain."/q/getdifficulty");
	$hashtime = ($difficulty*pow(2,32))/(1000000);
	$coinsperday = 3600*24*$blockreward/$hashtime;
	$btcpd = $coinsperday*$btcv;
	print "<tr><td>".$coin."</td><td>".$difficulty."</td><td>".$btcv."</td><td>".number_format($btcpd/$ltcbtcv, 8)."</td><td>".number_format($btcpd, 8)."</td><td>".percent($lbtcpd, $btcpd)."</td>><td>".number_format($lbtcpd/$coinsperday,8)."</td></tr>";
	}
	if ($coin = "bbqcoin") {
		$blockreward =42;
		$chain = "http://bbq.cryptocoinexplorer.com/chain/BBQCoin"; 
		$ticker = "http://data.bter.com/api/1/ticker/bqc_btc";
			$coinjson = json_decode(processURL($ticker), true);
	$btcv = number_format($coinjson['buy'], 8);	
	$difficulty=processURL($chain."/q/getdifficulty");
	$hashtime = ($difficulty*pow(2,32))/(1000000);
	$coinsperday = 3600*24*$blockreward/$hashtime;
	$btcpd = $coinsperday*$btcv;
	print "<tr><td>".$coin."</td><td>".$difficulty."</td><td>".$btcv."</td><td>".number_format($btcpd/$ltcbtcv, 8)."</td><td>".number_format($btcpd, 8)."</td><td>".percent($lbtcpd, $btcpd)."</td>><td>".number_format($lbtcpd/$coinsperday,8)."</td></tr>";
	}

	if ($coin = "nyancoin") {
		$blockreward =337;
		$chain = "http://nyancha.in/chain/Nyancoin"; 
		$ticker = "http://data.bter.com/api/1/ticker/bqc_btc";
			$coinjson = json_decode(processURL($ticker), true);
	$btcv = 0.00000117;	
	$difficulty=processURL($chain."/q/getdifficulty");
	$hashtime = ($difficulty*pow(2,32))/(1000000);
	$coinsperday = 3600*24*$blockreward/$hashtime;
	$btcpd = $coinsperday*$btcv;
	print "<tr><td>".$coin."</td><td>".$difficulty."</td><td>".$btcv."</td><td>".number_format($btcpd/$ltcbtcv, 8)."</td><td>".number_format($btcpd, 8)."</td><td>".percent($lbtcpd, $btcpd)."</td>><td>".number_format($lbtcpd/$coinsperday,8)."</td></tr>";
	}

}


?>
<hr>
<h1>A Neater Calculation for 1MH/s</h1>

<table style="width:620px">
<th>Coin Name</th><th>Difficulty</th><th>BTC Value</th><th>LTC/day</th><th>BTC/day</th><th>Percent Profitability</th><th>Value could sell until</th>
<? coinINFO("coin", $ltcbtcv, $lbtcpd); ?>
<tr><td>Litecoin</td><td><? print round($litecoind, 3); ?></td><td><? print $ltcbtcv; ?></td><td><? print number_format($lcoinsperday, 8); ?></td><td><? print number_format($lbtcpd, 8); ?></td><td>0</td></tr>
</body>

</html>
