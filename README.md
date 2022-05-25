# Zobrazení jména volajícího na tel. Gigaset (vyzkouseno na A540 IP)

<div align="left">
      <a href="https://www.youtube.com/watch?v=5yLzZikS15k">
         <img src="https://img.youtube.com/vi/5yLzZikS15k/0.jpg" style="width:100%;">
      </a>
</div>

V nastaveni telefonu (Teledoní seznamy -> Online telefonní seznam) je možnost pridat verejne telefonni seznamy.
Bohuzel se mi nepodarilo jednoduchym pridanim docilit funkcnosti, pro spravnou funkcnost je treba upravit DNS, tak aby domena tel.search.ch smerovala na server kde bude tento script (intranet.knihovnahk.cz). V pripade, ze se vam nebude zamlouvat vychozi cesta /api/siemens (na kterou telefon GETem zasílá dotaz), je treba i nstaveni v apache (.htaccess) na spravnou cestu treba takto:
<pre>
&lt;Directory /var/www/intranet.knihovnahk.cz/api&gt;
    RewriteEngine On
    RewriteRule ^(.*)$ /TELEFONY/gigasety/tritiusNameByPhone.php/$1 [L]
&lt;/Directory&gt;
</pre>
