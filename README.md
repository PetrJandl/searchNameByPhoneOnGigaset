# Hledani jmena vojaliciho, pro zobrazeni na display telefonu Gigaset (vyzkouseno na A540 IP)

V nastaveni telefonu (Teledoní seznamy -> Online telefonní seznam) je možnost pridat verejne telefonni seznamy. Bohuzel se mi nepodarilo jednoduchym pridanim docilit nejake funkcnosti, tedy je pro spravnou funkcnost upravit DNS. Tak aby domena tel.search.ch smerovala na server kde bude tento script. A v pripade, ze se vam nebude zamlouvat vychozi cesta /api/siemens (na kterou telefon GETem zasílá dotaz), je treba i nstaveni v apache (.htaccess) na spravnou cestu asi takto:
<pre>
    &lt;Directory /var/www/intranet.knihovnahk.cz/&gt;
        RewriteEngine On
        RewriteRule ^aspi/siemens(.*)$ /TELEFONY/tritiusNameByPhone.php/$1 [L]
    &lt;/Directory&gt;
</pre>
