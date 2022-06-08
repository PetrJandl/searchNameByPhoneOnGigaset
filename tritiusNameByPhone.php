<?php
/*
    Jednoduchy script zasilajici dotaz na tritius s telefonnim císlem predanym v parametru hm. Vraci v XML cele jmeno ctenare, pokud je nalezeno.
    Popis tritius api : https://confluence.tritius.cz/display/TP/REST+API+-+Open+Tritius
*/

include_once "config.php";

// kontrola IP (kdyz je zapnuta)
if ($checkIP){
    print_r(fullXMLtemplate("Nepovolená IP!"));
    die();
}

// ocista od specialnich znaku
$phone = htmlspecialchars($_GET["hm"], ENT_QUOTES);

$name="";

// jsou li zadany XML soubory nejprve hleda v nich
if(isset($phonebooks[0])){
    foreach($phonebooks as $phonebook){
	if($name!=""){ break; }
	    $xml = simplexml_load_file($phonebook);
	    foreach($xml->DirectoryEntry as $pbr){
		$row=(array) $pbr;
		if($row["Telephone"]==$phone){
		    $name=$row["Name"];
		    break;
		}
	    }
    }
}

// zahodit predvolbu
if( strlen($phone) >= 9 ){
    $phone=substr($phone,-9);
}

// pokud nebylo jmeno v XML souborech hleda se v tritiu
if($name==""){
    $curlHandler = curl_init();
    curl_setopt_array($curlHandler, [
	CURLOPT_HTTPHEADER =>
	array(
            "Authorization: Basic ".$secret."",
            "Accept: application/vnd.tritius-v1.0+json",
            "Content-type: application/vnd.tritius-v1.0+json",
            "X-Library: 1"
	),
	CURLOPT_URL => $url,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_POST => true,
	CURLOPT_POSTFIELDS => json_encode( array( "sql" => "select fullname from user WHERE phone like '%".$phone."%'" ))
    ]);
    $output=json_decode(curl_exec($curlHandler));
    curl_close($curlHandler);
    $name=$output->rows[0]->fullname;
}

//header('Content-type: text/plain; charset=utf-8');

// pokud je jmeno vrati jmeno v xml template nebo vrati prazdny template
if($name!="" OR isset($output->rows[1])){
    setlocale(LC_ALL, 'cs_CZ.UTF8');
    $namePuv=$name;
    $nameNew=substr( iconv( "UTF-8", "ASCII//TRANSLIT", $name ), 0, 8 );
    echo fullXMLtemplate( $nameNew . (strlen($namePuv)!=strlen($nameNew)?".":"") );
}else{
    echo emptyXMLtemplate();
}

