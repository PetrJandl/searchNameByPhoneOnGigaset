# Zobrazení jména volajícího na tel. Gigaset (vyzkouseno na A540 IP)

Video jak to ve finale funguje :

[![Demonstracni video](https://img.youtube.com/vi/TH9A381Ewss/0.jpg)](https://www.youtube.com/watch?v=TH9A381Ewss)

V nastaveni telefonu (Teledoní seznamy -> Online telefonní seznam) je možnost pridat verejne telefonni seznamy. Bohuzel se mi nepodarilo jednoduchym pridanim docilit funkcnosti. Pro spravnou funkcnost je treba upravit DNS, tak aby domena tel.search.ch smerovala na server kde bude tento script (intranet.knihovnahk.cz). V pripade, ze se vam nebude zamlouvat vychozi cesta /api/siemens (na kterou telefon GETem zasílá dotaz), je treba i nstaveni v apache (.htaccess) na spravnou cestu treba takto:
<pre>
&lt;Directory /var/www/intranet.knihovnahk.cz/api&gt;
    RewriteEngine On
    RewriteRule ^(.*)$ /TELEFONY/gigasety/tritiusNameByPhone.php/$1 [L]
&lt;/Directory&gt;
</pre>
