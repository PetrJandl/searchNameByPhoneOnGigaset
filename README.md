# Zobrazení jména volajícího na tel. Gigaset (vyzkouseno na A540 IP a A690 IP)

## Video jak to ve finale funguje :

[![Demonstracni video](https://img.youtube.com/vi/TH9A381Ewss/0.jpg)](https://www.youtube.com/watch?v=TH9A381Ewss)

## Nastaveni
- nastavit v DNS pro telefony IP vlastniho serveru jako preklad pro tel.search.ch 
- v telefonu (Teledoní seznamy -> Online telefonní seznam) povolit tel.search.ch 

- nastavit v apache (nebo .htaccess ?) aby na script tritiusNameByPhone.php smerovala URL /api/siemens :
<pre>
&lt;Directory /var/www/intranet.knihovnahk.cz/api&gt;
    RewriteEngine On
    RewriteRule ^(.*)$ /TELEFONY/gigasety/tritiusNameByPhone.php/$1 [L]
&lt;/Directory&gt;
</pre>
