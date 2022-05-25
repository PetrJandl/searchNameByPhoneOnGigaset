<?php
/*
    Jednoduchý script zasílající dotaz na tritius s telefonním číslem předaným v parametru hm.
    Vrací v XML celé jméno čtenáře, pokud je nalezeno a je to jen jeden záznam.
*/

include_once "config.php";

// kontrola IP (kdyz je zapnuta)
if ($checkIP){
    print_r(fullXMLtemplate("NepovolenaIP"));
    die();
}

// ocista od specialnich znaku
$phone = htmlspecialchars($_GET["hm"], ENT_QUOTES);

// zahodit predvolbu
if( strlen($phone) >= 9 ){
    $phone=substr($phone,-9);
}
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

// pokud je jmeno vrati jmeno v xml template nebo vrati prazdny template
if($name!="" OR isset($output->rows[1])){
    echo fullXMLtemplate($name);
}else{
    echo emptyXMLtemplate();
}

