<?php

// URL a auth tritius api viz. https://confluence.tritius.cz/display/TP/REST+API+-+Open+Tritius
$url="";
$secret="";

// Kontrolovat IP?
$checkIP=true;

// Povolene IP
$allowedOnIP = array(
	"127.0.0.1",
);

// Interni seznamy v XML ( format odpovida Yeastar online seznamu )
$phonebooks = array( );

// Kdyz neni nalezeno zadne cislo vrati se prazdna odpoved
function emptyXMLtemplate(){
    return '<list response="get_list" type="pb" total="0" first="0" last="0"></list>';
}

// Pokud je cislo nalezene nebo ma hlasit chybu
function fullXMLtemplate($text){
    return '<list response="get_list" type="pb" total="1" first="1" last="1"><entry><ln>'.$text.'</ln></entry></list>';
}

// Je IP na seznamu?
if ($checkIP){
    foreach ($allowedOnIP as $ip){
	if( $ip == $_SERVER['REMOTE_ADDR'] ){
	    $checkIP=false;
	    break;
	}
    }
}
