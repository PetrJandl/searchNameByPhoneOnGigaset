# Zobrazení jména volajícího na tel. Gigaset (vyzkouseno na A540 IP)

https://user-images.githubusercontent.com/PetrJandl/searchNameByPhoneOnGigaset/blob/61d780ef98637b3985985fadb29375584b3d00ac/zjisteniCisla.mp4?width=200&height=200

https://user-images.githubusercontent.com/22210051/124587799-abcfe300-de75-11eb-89e0-3f68ed20b79b.mp4?width=200&height=200

V nastaveni telefonu (Teledoní seznamy -> Online telefonní seznam) je možnost pridat verejne telefonni seznamy.
Bohuzel se mi nepodarilo jednoduchym pridanim docilit funkcnosti, pro spravnou funkcnost je treba upravit DNS, tak aby domena tel.search.ch smerovala na server kde bude tento script (intranet.knihovnahk.cz). V pripade, ze se vam nebude zamlouvat vychozi cesta /api/siemens (na kterou telefon GETem zasílá dotaz), je treba i nstaveni v apache (.htaccess) na spravnou cestu treba takto:
<pre>
&lt;Directory /var/www/intranet.knihovnahk.cz/api&gt;
    RewriteEngine On
    RewriteRule ^(.*)$ /TELEFONY/gigasety/tritiusNameByPhone.php/$1 [L]
&lt;/Directory&gt;
</pre>
