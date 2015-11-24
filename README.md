# Ryhmä 2 web-projekti #
Ideoita tänne tai Google Driveen.

## Codio Box ##
PHP:n ja Apachen asennus: `parts install php5 php5-apache2`

Kirjoita terminaaliin: `nano /home/codio/.parts/etc/apache2/httpd.conf`

Etsi seuraavat allekkaiset rivit tiedostosta:
```
DocumentRoot "/home/codio/workspace"
<Directory "/home/codio/workspace">
```

Lisää tiedostopolkujen perään "R2Projekti":
```
DocumentRoot "/home/codio/workspace/R2Projekti"
<Directory "/home/codio/workspace/R2Projekti">
```

Apachen käynnistys: `parts start apache2`

Luo tiedosto `startup.sh` työtilan juureen ja kopioi seuraavat komennot sinne:
```
parts stop apache2
parts start apache2
```

## Git ##
Gitin konfigurointi:
```
git config --global user.name "Etunimi"
git config --global user.email "sama_sähköposti@minkä_rekisteröit_gitlabiin.fi"
```

Repon kloonaus: `git clone https://gitlab.com/joseu/R2Projekti.git`

Repo on nyt valmis käyttöön.
