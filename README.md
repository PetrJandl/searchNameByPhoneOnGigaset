# Zobrazení jména volajícího na tel. Gigaset (vyzkouseno na A540 IP a A690 IP)

## Video jak to ve finale funguje :

[![Demonstracni video](https://img.youtube.com/vi/TH9A381Ewss/0.jpg)](https://www.youtube.com/watch?v=TH9A381Ewss)

## Nastaveni
- nastavit v DNS IP vlastniho serveru jako preklad pro tel.search.ch ([![dokumentace](https://teamwork.gigaset.com/gigawiki/display/GPPPO/Online+directory)])
- v telefonu (Telefonní seznamy -> Online telefonní seznam) povolit tel.search.ch 
<img src="https://raw.githubusercontent.com/PetrJandl/searchNameByPhoneOnGigaset/95b28e4ca5d1a8d3ae8e88a5377d08b1da7f613d/doc/nastaveni.png">

- nastavit v apache (nebo .htaccess ?) aby na script tritiusNameByPhone.php smerovala URL /api/siemens :

<pre>
&lt;Directory /var/www/intranet.knihovnahk.cz/api&gt;
    RewriteEngine On
    RewriteRule ^(.*)$ /TELEFONY/gigasety/tritiusNameByPhone.php/$1 [L]
&lt;/Directory&gt;
</pre>

- v config.php je nutno nastavit url tritia a secret

## Dalsi moznosti
- v config.php lze zapnout kontrolu IP a vyjmenovat z jakych IP je info povoleno
- v config.php lze definovat XML soubory ve tvaru <a href="https://github.com/PetrJandl/searchNameByPhoneOnGigaset/blob/main/doc/sample.xml">sample.xml</a>, ktere budou prohledany pred odeslanim dotazu na tritius. Format souboru odpovida online adresari pro telefony Yeastar.


## Experimentálně jsem také zkusil provázat s PC přes websocket :
[![Experimentální ověření funkčnosti nofikace v PC](https://img.youtube.com/vi/8d5yxL5S4Hw/0.jpg)](https://www.youtube.com/watch?v=8d5yxL5S4Hw)


