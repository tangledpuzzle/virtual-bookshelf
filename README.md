# Group 2 web project #
Please write your ideas into Google Drive.

Read the **Contribution Guide** linked in the above toolbar.

Note the following pages on the left toolbar:
- **Network:** A visual representation of branches and commits.
- **Milestones:** Track tasks that need to be done before the end of the project.
- **Issues:** Report and track bugs.
- **Wiki:** Guides and documentation.

# Project Schedule #
> - ryhmän jäsenten on oltava paikalla tunneilla koko viimeisen kolmen viikon ajan
- keskiviikkona 2.12. klo 9.00 projektin määrittelyn palautus
- keskiviikkona 9.12. toteutuksen raakaversio esiteltävä
- keskiviikkona 16.12. projektien esittely

| Date | Time | Task |
|------|------|------|
| Fri 27.11 | | Work on the **Necessary Course Worksheets** listed below if you have not finished them. |
| Sat 28.11 | | Work on the **Necessary Course Worksheets** listed below if you have not finished them. |
| Sun 29.11 | | Work on the **Necessary Course Worksheets** listed below if you have not finished them. |
| Mon 30.11 | 9:00 - 17:00 | Writing the design document. |
| Tue 1.12 |  | **Working from home:** Writing the design document. |
| Wed 2.12 | 9:00 - 17:00 | Writing the design document, returning the design document, setting up the development environment, and start of programming. |
| Thu 3.12 | 13:00 - | Programming. |
| Fri 4.12 | 9:00 - | Programming. |
| Sat 5.12 | | Work on the **Necessary Course Worksheets** listed below if you have not finished them. |
| Sun 6.12 | | Try to finish the rest of the **Necessary Course Worksheets** listed below if you haven't already. |
| Mon 7.12 | 9:00 - 17:00 | Programming. |
| Tue 8.12 |  | **Working from home:** Programming. |
| Wed 9.12 | 9:00 - 17:00 | First usable version of application is done and presented to a teacher. Programming. |
| Thu 10.12 | 13:00 -  | Programming. |
| Fri 11.12 | 9:00 - | Programming. |
| Sat 12.12 | | |
| Sun 13.12 | | |
| **Mon 14.12** | **9:00 - 17:00** | **Programming. Project finished.** |
| Tue 15.12 |  | **Working from home:** Programming if needed. |
| **Wed 16.12** | **9:00 - 15:00** | **Project returned.** |
| Thu 17.12 | |  |
| Fri 18.12 | | Last day of school. |

# Necessary Course Worksheets #
The following is a list of [worksheets](https://github.com/covcom/205CDE/tree/master/labs) that you should have completed in order understand the technologies used in this project.

- 01 Introduction to Git
    - The part about `git diff` and `git log` is not particularly useful. Use GitLab for that.
- 02 Git Remotes
- 03 HTML5
- 04 Introduction to CSS3
- 05 Responsive Layout with CSS3
    - We will use **Bootstrap**.
- 06 HTML5 forms
    - A solid understanding of regular expressions is not necessary, there are lots of online tools that help you write regex.
- 07 JavaScript Tools
- 08 JavaScript Language
- 09 JSON and AJAX
    - We will use **JSON** a lot.
    - DOM manipulation is important.
    - I don't think we need AJAX?
    - No need to do track 2, it has too advanced stuff.
- 10 Single-Page Applications
    - Again, the DOM stuff is very important for site functionality.
- 11 JavaScript Modules
    - JavaScript objects are particularly important because we use the **MVC model**.
    - The module stuff is not needed.
- 12 Unit Testing
    - **We are required to write unit tests for JavaScript and PHP.**
    - This is an important worksheet to finish.
    - We can try doing Test-Driven Development but will probably fail.
    - *Advanced Topics* are not required.
- 14 Introduction to PHP
    - Learn section *3.3 Strings* by heart.
- 15 Modular PHP
    - Ignore section *3 REST API - a Simple Example* and tasks related to it as it is kind of confusing. The CodeIgniter REST API is much easier to use and implement.
    - Don't skip the *4 Object Oriented PHP* section and related tasks. They are important.
    - Task 6 is great practice.
- **Read only:** 16 RESTful API
    - You need to understand how to use APIs.
    - **No need** to do the tasks since Jose will be working on the API.
    - We will use **Postman** so play around with it. Do **not** use the [cityofhelsinki-erja.firebaseio.com](https://cityofhelsinki-erja.firebaseio.com) API. Use the [City of Helsinki issue reporting API](http://dev.hel.fi/apis/open311/).
        - Here's a GET query to get your started: https://asiointi.hel.fi/palautews/rest/v1/requests.json?start_date=2015-11-25T00:00:00Z
    - In fact reading the API documentation for the Helsinki issue reporting is a good way to study how APIs work.
    - Don't get stuck on this. You **cannot** do this:
    
    > Check your understanding by asking
    > - for a description of an issue and
    > - for all issues having “Katujen kunto ja liikenne” ask for their group
- 17 Model-View-Controller
    - We will use **CodeIgniter**.
    - Ignore *How to select right or best framework?*.
    - Do task 1 and try to do task 2.
    - Install CodeIgniter. Check the worksheet.
    - Read the overview: http://www.codeigniter.com/user_guide/overview/index.html
    - Do *Static Pages* part of the CodeIgniter tutorial: http://www.codeigniter.com/user_guide/tutorial/index.html
    - **Read** the rest of the tutorial.
- **Read only:** 18 Codeigniter and RESTful API
    - Definitely read: http://code.tutsplus.com/tutorials/working-with-restful-services-in-codeigniter--net-8814
    - Watch: https://www.youtube.com/watch?v=YevHf8Y11ME
    - This is a little confusing but might have some useful bits here and there: http://www.slideshare.net/sachingk30/rest-api-best-practices-implementing-in-codeigniter
- **Skip:** 20 Document Databases
    - We will use **MySQL** which is not a document database.

# Resources Used In The Project#
## Technologies  ##
- HTML5
- CSS3
- JavaScript
- PHP5
- Regular Expressions
- Apache2
- Bootstrap
- CodeIgniter
- CodeIgniter REST Server
- MySQL
- Jasmine
- PHPUnit

## Tools ##
- Codio
- Ubuntu
- Git
- GitLab
- Postman
- JSLint
- PHPDoc
- JSDoc
- MVC pattern

# Project Requirements #
- toimiva itse suunniteltu pieni palvelu esim. blogialusta, arvostelupalvelu
- backendin pitää olla rest api
- pysyvän datan tallennus palvelinpuolella
- koodi täytyy löytyä GitLabista
- yksikkötestit on tehty ja koodikattavuus on 80%:n luokkaa
- tuotettu HTML oltava validoitu
- kaikki ohjelman saama data tarkastetaan tietoturvan kannalta
- dokumentaatio tuotettava PHPdoc tai JsDoc

> Pitääkö käyttää CodeIgniteriä?
- Suositellaan mutta ei ole pakko.

> Pitääkö käyttää MongoDB:tä?
- Saa olla muukin pysyvä backend-tallennusratkaisu (esim. MySQL).

> Pitääkö ylipäätään olla tietokanta palvelimella?
- Käytännössä pitää olla, jotta web-sovellus toimii monella käyttäjällä oikein.

> Pitääkö projektissa olla JavaScriptiä jos ei jostain syystä sitä tarvitse?
- Lähtökohtaisesti kyllä. Modernissa web-sovelluksessa JavaScriptillä on keskeinen rooli. Joka tapauksessa ainakin lomakekenttien välitön tarkistus on luontevaa tehdä JavaScriptillä..

> Kuinka paljon haittaa jos projektin CSS on vähän visuaalisesti rikkinäistä, esim. valikot menee vähän sivuun ja jossain sivuston osien välillä on outoja rakoja?
- Pyritään laadukkaaseen käyttöliittymätoteutukseen. Painopiste työssä ei kuitenkaan ole visuaalisessa ulkoasussa.

> Saako käyttää Bootstrappiä tai vastaavaa?
- Suositellaan käyttämään Bootstrapia.

> Mikä on projektin minimilaajuus? (Veikkaan että ihan todo-lista ei kelpaa.)
- Ryhmä määrittelee työn laajuuden itse aikataulun huomioiden. Resursseihin nähden liian suppea työ heikentää arvosanaa.

> Tuleeko sotkuisesta koodista miinusta?
- Tulee.

> Pitääkö käyttää MVC mallia? Entä jos MVC malli on vain sinne päin? (Esim. kontrolleria ja näkymää on sotkettu tms.)
- MVC-mallia kannattaa hyödyntää suunnittelua ja toteutusta ohjaavana selkärankana. Mallia voi soveltaa tilannekohtaisesti.