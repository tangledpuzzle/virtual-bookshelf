# Vaatimukset
1. toimiva itse suunniteltu pieni palvelu esim. blogialusta, arvostelupalvelu
	- Toimii, kaikki testit läpi.
1. backendin pitää olla rest api
	- Tehty. Esimerkiksi tuotteen 1 arvostelut saa URIsta: `https://vital-minimum.codio.io:9500/index.php/api/requests/products/1/reviews`
	- Kontrolleri: `application/controllers/api/Requests.php`
1. pysyvän datan tallennus palvelinpuolella
	- MySQL. Malli: `application/models/api/R2pdb_model.php`
1. koodi täytyy löytyä GitLabista
	- https://gitlab.com/joseu/R2Projekti
1. yksikkötestit on tehty ja koodikattavuus on 80%:n luokkaa
	- Joitain testejä tehty PHPUnitilla. Kansio: `application/tests/`
	- Kaikkien testien suoritus:
		- `cd ~/workspace/r2projekti/application/tests/`
		- `php phpunit.phar`
	- JavaScriptiä ei ole testattu koska en keksinyt tapaa millä sen tekisi. JavaScriptimme generoi HTML koodia mikä näytetään sivulla. Kaikki sivut toimivat silmämääräisesti juuri niin kuin niiden pitää, niin sen perusteella voi kai sanoa että myös JavaScriptimme toimii.
1. tuotettu HTML oltava validoitu
	- Kaikki sivut validoitu käsin. Huomaa että JavaScriptin generoima koodi ei näy "View Page Source/Näytä sivun lähdekoodi" komennolla selaimesta vaan pitää käyttää "Inspect Element/Tarkista" työkalua, valita html tagi ja muokata sitä HTML koodina.
	- Myös tästä syystä JavaScript koodin testaus on hankalaa koska PHP & PHPUnit ei näe tätä JavaScriptillä generoitua koodia.
	- Joillekin sivuille on tarkoituksella jätetty [W3 HTML validaattorin](https://validator.w3.org/) havaitsemia "virheitä". Niiden poisto rikkoi sivun toiminnallissuutta emmekä löytäneet vaihtoehtoista tapaa tehdä näitä asioita.
		- Esimerkiksi käyttäjäsivulla ("userview") oleva `action=""` mikä lähettää POST datan samalle sivulle.
		- Arvostelunkirjoitussivulla ("writereview") oleva `id="inputRating"`. Sen muuttaminen classiksi aiheuttaa toisen virheen.
	- Myös CSS3 on validoitu.
	- JavaScript menee JSLintistä läpi lukuunottamatta jotain ihme `Object.keys` virhettä ja paria muuta pilkunviilausta.
1. kaikki ohjelman saama data tarkastetaan tietoturvan kannalta
	- Välttämättä ihan kaikkea dataa ei ole tarkistettu, mutta SQL injektiot ja JavaScriptin kirjoitus ei pitäisi toimia missään ja aiheuttaa pahimmillaan vain visuaalisia kummallisuuksia.
1. dokumentaatio tuotettava PHPdoc tai JsDoc
	- PHP dokumentaatio: `application/doc/php/`
	- JavaScript dokumentaatio: `application/doc/js/`

## Muuta
Sivusto vaatii MySQL tietokannan toimiakseen. Suorita MySQLissa komento: `source ~/workspace/r2projekti/dev/init.sql`

API dokumentaatio löytyy GitLab projektin wikistä tai juuresta `API_DOCUMENTATION.md`.


REST APIn kolme POST komentoa vaativat "Basic Auth" autentikaation: `admin` : `1234`

- Esim: `POST https://vital-minimum.codio.io:9500/index.php/api/requests/users/2/comments`

Kommentti lähetetään avaimella "text" ja arvona kommentin teksti. 


### Sivut joiden sisältö/toiminta muuttuu käyttäjän sisäänkirjauduttua
- Kaikki, headerissä nimimerkki.
- userview, bookview, review: kommenttien kirjoitus
- userview, bookview, review: kommenttien poisto (jos admin)
- writereview: ei toimi ilman sisäänkirjautumista
- register, login: ei toimi sisäänkirjauduttua

### Käyttäjätunnukset
- Käyttäjä: A User | `usr` : `asdASD123`
- Moderaattori: A Moderator | `mod` : `asdASD123`
	- Ei mitään toiminnallisuutta, käytännössä sama kuin käyttäjä.
- Admin: An Admin | `adm` : `asdASD123`
- Käyttäjä: Esitys | `public` : `salaSANA1`
- Admin: Esitys Admin | `admin` : `salaSANA1`
- Kaikki muut käyttäjät: Test Account <numero> | `test<numero>` : `asdASD123`

## Kolmannen osapuolen kirjastot
Käyttäjäjärjestelmä: [Community Auth](http://community-auth.com/)

Taulukoiden järjestys: [sorttable](http://www.kryogenix.org/code/browser/sorttable/)

## Polkuja
- Kontrollerit: `application/controllers/`
- Malli: `application/models/`
- Header & Footer: `application/views/templates/`
- Näkymät: `application/views/pages/`
- CSS: `css/`
- JavaScript: `js/`
- Tietokannan SQL: `dev/`
- REST APIN & sivuston reititys: `application/config/routes.php`
- Kolmannen osapuolen kirjasto, Community Auth: `application/third_party/community_auth/`
- Kolmannen osapuolen kirjasto, sorttable: `lib/sorttable.js`