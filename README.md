# README 
## Database
Maak een nieuwe database aan met de naam 
>nyp 

Gebruik het nyp.sql bestand in de includes folder in de import om de tabellen te importeren. De producten in de tablellen hebben al afbeeldingen. Nieuwe producten hebben eigen afbeeldingen nodig in img/pizzamenu folder. 

## Menu
Alle text van de menutabel komt uit de productentabel van de database. 
Alle afbeeldingen hebben de index van het product als naam en de png extensie
Om nieuwe producten toe te voegen aan de menutabel voeg je in de database het product in met de query: 
```
INSERT INTO producten (naam, beschrijving, prijs, beschikbaarheid) VALUES ([naam product], [beschrijving product], [prijs], [vooraad(standaard 250)]);
```
het id wordt automatisch verhoogt om unieke waarden te garanderen en de alleen de naam is vereist voor query. 

## Bezorgers
Om een account voor bezorgers te maken gebruik je de normale signup pagina.
Daarna moet, omdat een bezorgersaccount toch wordt beheerd door de manager, moet deze in de tabel bij het account de positie van 0 naar 1 zetten. 
De bezorger kan gewoon normaal inloggen en krijgt in de navigatiebalk een extra pagina te zien met een tabel met de adressen en emails van de klanten die besteld hebben


## BRONNEN
How to create a login system in PHP for beginners | Procedural MySQLi | PHP Tutorial
by Dani Krossing
[Link](https://www.youtube.com/watch?v=gCo6JqGMi30 )

De Gebruikte afbeeldingen van de producten zijn afkomstig van de officiële New York Pizza site: https://www.newyorkpizza.nl/producten (De milkshakes zijn van: https://www.burgerking.nl/menu/section-3668daf1-3feb-45fe-861d-25e0c4d63bef)

De form in JavaScript is ontwikkeld met een beetje hulp van w3schools: https://www.w3schools.com/jsref/met_node_appendchild.asp