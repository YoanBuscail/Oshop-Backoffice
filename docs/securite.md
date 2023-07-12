# Securité

Il existe plein de types d'attaques.

On va apprendre les plus connues

## XSS

Pour Cross (X) Site Scripting, c'est le fait d'exécuter du code dans le navigateur qui n'était pas prévu.

Pour s'en prémunir, on peut utiliser la fonction htmlentities qui va convertir les caractères en entités HTML ( `<` devient `&lt;` ). Ainsi le navigateur ne va pas reconnaitre de balises HTML.

## Injection SQL

Depuis un formulaire; et selon la façon dont est construite la requête qui utilise les données du formulaire, on peut faire exécuter des requêtes non prévues par le logiciel.

par exemple en saisissant `coucou'); DELETE FROM CATEGORY; --`

```php

// la requete générée par ce code serait
$sql = "insert into category (picture) values ('" . $this->picture . "' )";

// ici on voit que deux requêtes seront exécuté
"insert into category (picture) values ('coucou'); DELETE FROM CATEGORY; --')";

```

Pour s'en prémunir, on va préparer nos requetes SQL à l'aide de PDO.
