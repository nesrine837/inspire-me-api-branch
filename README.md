# Inspire Me API Documentation

## Table of Contents

-   [Inspire Me API Documentation](#inspire-me-api-documentation)
    -   [Table of Contents](#table-of-contents)
    -   [Introduction](#introduction)
    -   [Public Endpoints](#public-endpoints)
    -   [Quotes](#quotes)
        -   [Route Parameters](#route-parameters)
            -   [Include](#include)
            -   [Filters](#filters)
            -   [Sort By Fields](#sort-by-fields)
    -   [Quotees](#quotees)
        -   [Route Parameters](#route-parameters-1)
            -   [Include](#include-1)
            -   [Filters](#filters-1)
            -   [Sort By Fields](#sort-by-fields-1)
    -   [Nationality](#nationality)
        -   [Route Parameters](#route-parameters-2)
            -   [Include](#include-2)
            -   [Filters](#filters-2)
            -   [Sort By Fields](#sort-by-fields-2)
    -   [Professions](#professions)
        -   [Route Parameters](#route-parameters-3)
            -   [Include](#include-3)
            -   [Filters](#filters-3)
            -   [Sort By Fields](#sort-by-fields-3)
    -   [Categories](#categories)
        -   [Route Parameters](#route-parameters-4)
            -   [Include](#include-4)
            -   [Filters](#filters-4)
            -   [Sort By Fields](#sort-by-fields-4)
         
   -   [Standards et Checklists de Qualité du Code](#standards-et-checklists-de-qualité-du-code)
            -   [Standards de qualité](#standards-de-qualité)
            -   [Checklists de Qualité du code](#checklists-de-qualité-du-code)
     
## Introduction

Welcome to the documentation of the REST API for the Inspire Me quotes API.
This is a free open source API for retrieving quotes from our database.
The base url is `inspire-me-api.redmountaindev.co.za/`

## Public Endpoints

-   GET v1/quotes
-   GET v1/professions
-   GET v1/quotees
-   GET v1/nationalities
-   GET v1/categories

## Quotes

By default this endpoint returns pages of 25 quotes and their quotees.
The number of returned quotes and page can be set like this: \
`v1/quotes?limit=30&page=3`

The maximum number of quotes that can be return in a single request is 200.

### Route Parameters

#### Include

What should be included in the returned data. Seperated by commas.

Eg. `v1/quotes?include=nationality,profession`

-   `nationality`: Includes quotee nationality
-   `profession`: Includes quotee profession
-   `category`: Includes quote category

#### Filters

Parameters to search records.

Eg. `v1/quotes?quotee=bruce+lee`

-   `id`: Search by the ID of a quote; \
    must be an exact match to existing record
-   `quote_content`: Search by the content of a quote
-   `keywords`: Search by the keywords of a quote
-   `category_id`: Search by the ID of a category; \
    must be an exact match to existing record
-   `category`: Search by the name of a category; \
-   `quotee_id`: Search by the ID of a quotee; \
    must be an exact match to existing record
-   `quotee`: Search by the name of a quotee; \
-   `gender`: Search by the gender of a quotee; accepted values are `m` or `f`
-   `nationality_id`: Search by the ID of a nationality; \
    must be an exact match to existing record
-   `nationality`: Search by the name of a nationality; \
-   `profession_id`: Search by the ID of a profession; \
    must be an exact match to existing record
-   `profession`: Search by the name of a profession; \

#### Sort By Fields

What fields you can sort by.

Eg. `v1/quotes?sortby=nationality`

It's possible to sort by multiple fields.

Eg. `v1/quotes?sortby=quotee,nationality` \
The above route would sort records by quotee name then by nationality name.

-   `quotee`: Sorts by quotee name in ascending order
-   `quotee_asc`: Sorts by quotee name in ascending order
-   `quotee_desc`: Sorts by quotee name in descending order
-   `nationality`: Sorts by nationality name in ascending order
-   `nationality_asc`: Sorts by nationality name in ascending order
-   `nationality_desc`: Sorts by nationality name in descending order
-   `profession`: Sorts by profession name in ascending order
-   `profession_asc`: Sorts by profession name in ascending order
-   `profession_desc`: Sorts by profession name in descending order
-   `category`: Sorts by category name in ascending order
-   `category_asc`: Sorts by category name in ascending order
-   `category_desc`: Sorts by category name in descending order

## Quotees

This endpoint returns a list of all quotee records.

### Route Parameters

#### Include

What should be included in the returned data. Seperated by commas.

Eg. `v1/quotees?include=quote_count`

-   `quote_count`: Includes the number of quotes a quotee has authored

#### Filters

Parameters to search records.

Eg. `v1/quotee?name=bruce+lee`

-   `id`: Search by the ID of a quotee; \
    must be an exact match to existing record
-   `name`: Search by quotee name
-   `gender`: Search by the gender of a quotee; accepted values are `m` or `f`
-   `nationality_id`: Search by the ID of a nationality; \
    must be an exact match to existing record
-   `nationality`: Search by the name of a nationality; \
-   `profession_id`: Search by the ID of a profession; \
    must be an exact match to existing record
-   `profession`: Search by the name of a profession; \

#### Sort By Fields

What fields you can sort by.

Eg. `v1/quotee?sortby=nationality`

It's possible to sort by multiple fields.

Eg. `v1/quotes?sortby=quotee,nationality` \
The above route would sort records by quotee name then by nationality name.

-   `name`: Sorts by quotee name in ascending order
-   `name_asc`: Sorts by quotee name in ascending order
-   `name_desc`: Sorts by quotee name in descending order
-   `nationality`: Sorts by nationality name in ascending order
-   `nationality_asc`: Sorts by nationality name in ascending order
-   `nationality_desc`: Sorts by nationality name in descending order
-   `profession`: Sorts by profession name in ascending order
-   `profession_asc`: Sorts by profession name in ascending order
-   `profession_desc`: Sorts by profession name in descending order
-   `quote_count`: Sorts by quote count in ascending order
-   `quote_count_asc`: Sorts by quote count in ascending order
-   `quote_count_desc`: Sorts by quote count in descending order

## Nationality

This endpoint returns a list of all nationality records.

### Route Parameters

#### Include

What should be included in the returned data. Seperated by commas.

Eg. `v1/nationalities?include=quotee_count`

-   `quotee_count`: Includes the number of quotees part of a nationality

#### Filters

Parameters to search records.

Eg. `v1/nationalities?name=bruce+lee`

-   `id`: Search by the ID of a nationality; \
    must be an exact match to existing record
-   `name`: Search by nationality name

#### Sort By Fields

What fields you can sort by.

Eg. `v1/nationalities?sortby=name`

It's possible to sort by multiple fields.

Eg. `v1/nationalities?sortby=name,quotee_count` \
The above route would sort records by nationality name then by quotee count.

-   `name`: Sorts by nationality name in ascending order
-   `name_asc`: Sorts by nationality name in ascending order
-   `name_desc`: Sorts by nationality name in descending order
-   `quotee_count`: Sorts by quotee count in ascending order
-   `quotee_count_asc`: Sorts by quotee count in ascending order
-   `quotee_count_desc`: Sorts by quotee count in descending order

## Professions

This endpoint returns a list of all profession records.

### Route Parameters

#### Include

What should be included in the returned data. Seperated by commas.

Eg. `v1/professions?include=quotee_count`

-   `quotee_count`: Includes the number of quotees part of a profession

#### Filters

Parameters to search records.

Eg. `v1/professions?name=bruce+lee`

-   `id`: Search by the ID of a profession; \
    must be an exact match to existing record
-   `name`: Search by profession name

#### Sort By Fields

What fields you can sort by.

Eg. `v1/professions?sortby=name`

It's possible to sort by multiple fields.

Eg. `v1/professions?sortby=name,quotee_count` \
The above route would sort records by profession name then by quotee count.

-   `name`: Sorts by profession name in ascending order
-   `name_asc`: Sorts by profession name in ascending order
-   `name_desc`: Sorts by profession name in descending order
-   `quotee_count`: Sorts by quotee count in ascending order
-   `quotee_count_asc`: Sorts by quotee count in ascending order
-   `quotee_count_desc`: Sorts by quotee count in descending order

## Categories

This endpoint returns a list of all category records.

### Route Parameters

#### Include

What should be included in the returned data. Seperated by commas.

Eg. `v1/categories?include=quote_count`

-   `quote_count`: Includes the number of quotes part of a category

#### Filters

Parameters to search records.

Eg. `v1/categories?name=bruce+lee`

-   `id`: Search by the ID of a category; \
    must be an exact match to existing record
-   `name`: Search by category name

#### Sort By Fields

What fields you can sort by.

Eg. `v1/categories?sortby=name`

It's possible to sort by multiple fields.

Eg. `v1/categories?sortby=name,quote_count` \
The above route would sort records by category name then by quote count.

-   `name`: Sorts by category name in ascending order
-   `name_asc`: Sorts by category name in ascending order
-   `name_desc`: Sorts by category name in descending order
-   `quote_count`: Sorts by quote count in ascending order
-   `quote_count_asc`: Sorts by quote count in ascending order
-   `quote_count_desc`: Sorts by quote count in descending order
# Standards et Checklists de Qualité du Code 

## 1. Standards de qualité 

### Suivre les standards de codage de Laravel 

Laravel a ses propres conventions et meilleures pratiques, qui s'alignent en grande partie sur les normes PSR (PHP Standard Recommendations). En nous conformant à ces standards, nous assurons la lisibilité et la maintenabilité du code. Voici comment nous pouvons procéder : 

### Documentation Laravel : 

La documentation de Laravel est une ressource précieuse pour comprendre et appliquer les meilleures pratiques et conventions du framework. Elle guide les développeurs à travers une multitude d'aspects, de la configuration initiale à des concepts avancés, en passant par la sécurité et les tests. Pour s'aligner sur les standards de qualité en utilisant Laravel, il est essentiel de se familiariser avec plusieurs sections clés de la documentation : 

**Architecture de l'Application** : Comprendre la structure proposée par Laravel, y compris la répartition logique des composants MVC (Modèle-Vue-Contrôleur), les middlewares, les services providers et les facades. 

**Conventions de Nommage** : Suivre les conventions de nommage spécifiques à Laravel pour les classes, les méthodes, les tables de base de données, et plus encore. Cela inclut l'utilisation de StudlyCaps pour les noms de classe, camelCase pour les méthodes, et snake_case pour les noms de table et de colonne. 

**Eloquent ORM** : Profiter de l'ORM Eloquent pour interagir avec la base de données de manière élégante et efficace, en suivant les conventions et les meilleures pratiques pour définir les modèles, les relations, et les mutations. 

**Tests** : Utiliser la section sur les tests pour créer des tests unitaires et de fonctionnalité robustes, en tirant parti des fonctionnalités de Laravel pour simuler des requêtes, tester des routes, des contrôleurs, et travailler avec des bases de données de test. 

En se plongeant dans la documentation de Laravel et en l'appliquant consciencieusement, on s'assure non seulement de respecter les standards de codage du framework, mais également de construire des applications plus robustes, sécurisées, et maintenables. 

### Normes PSR-2: 

La norme PSR-2, officiellement connue sous le nom de "PHP Standard Recommendation 2", établit un ensemble de règles de style de codage pour le PHP. Elle vise à standardiser la façon dont nous écrivons le code pour faciliter la lecture, la compréhension, et le maintien par différents développeurs au sein de la même base de code. Voici quelques-unes des directives clés de PSR-2 : 

**Indentation** : Utiliser 4 espaces pour l'indentation, pas des tabulations. 

**Lignes** : La longueur d'une ligne ne doit pas dépasser 120 caractères, l'idéal étant de ne pas dépasser 80 caractères. 

**Espaces** : Ajouter des espaces après les mots-clés et autour des opérateurs pour améliorer la lisibilité. 

**Accolades** : Placer les accolades ouvrantes à la fin de la ligne pour les classes, méthodes, et instructions de contrôle, et les accolades fermantes sur leur propre ligne. 

**Nommage** : Les classes doivent être déclarées en StudlyCaps, les méthodes en camelCase. 

**Espaces de Noms et Classes** : Chaque espace de noms doit avoir une déclaration namespace. Après la déclaration namespace, insérer un espace blanc, puis utiliser la déclaration use. 

En respectant ces règles et d'autres spécifiées dans PSR-2, notre code devient plus accessible et plus facile à gérer pour toute l'équipe de développement. 

### Normes PSR-4: 

PSR-4 est une recommandation qui spécifie comment les classes doivent être chargées automatiquement à partir des fichiers. Elle permet d'organiser notre structure de répertoires et de fichiers de manière cohérente, de sorte que les classes PHP peuvent être chargées automatiquement sans nécessiter d'inclusion manuelle de fichiers. Les points clés de PSR-4 incluent : 

**Correspondance Espace de Noms/Fichier** : Une correspondance directe entre l'espace de noms d'une classe et la structure des répertoires, et le nom de la classe et le nom du fichier. Par exemple, si nous avons une classe App\Http\Controllers\HomeController, elle devrait se trouver dans le fichier app/Http/Controllers/HomeController.php. 

**Chargement Automatique**: Utiliser un autoloader conforme à PSR-4 élimine le besoin d'instructions require manuelles pour chaque classe. Composer, le gestionnaire de dépendances pour PHP, fournit un autoloader PSR-4 que nous pouvons utiliser simplement en déclarant nos espaces de noms et chemins correspondants dans le fichier composer.json. 

En adoptant PSR-4, nous simplifions la gestion des dépendances et des espaces de noms dans nos projets Laravel, rendant le code plus propre et l'organisation des fichiers plus intuitive. 

### Éviter les erreurs et avertissements de linting 

Le "linting" est crucial pour identifier les erreurs syntaxiques, les problèmes de style de code et les pratiques potentiellement dangereuses avant l'exécution du code. Voici comment nous pouvons intégrer cela dans notre flux de travail : 

**PHP_CodeSniffer (PHPCS)** : Cet outil vérifie le code PHP contre un ensemble de règles définies ou standards de codage. Pour l'intégrer à notre projet Laravel, nous pouvons définir un standard de codage personnalisé basé sur les normes PSR et les conventions Laravel. PHPCS nous permettra d'analyser notre code pour détecter toute violation des standards. 

**Laravel Pint** : Laravel Pint est un outil de formatage de code conçu spécifiquement pour Laravel, s'inspirant de PHP CS Fixer et autres outils de linting. Facile à utiliser et à configurer, Pint peut être exécuté automatiquement via le terminal ou intégré dans nos workflows CI/CD pour formater notre code selon les conventions Laravel. 

En complément des directives spécifiques à Laravel, les normes PSR-2 pour le style de codage et PSR-4 pour l'autochargement des classes offrent un cadre de travail cohérent pour tous les développeurs PHP. En adoptant ces normes, nous facilitons la collaboration au sein des équipes de développement et améliorons la portabilité et la qualité du code à travers les projets. L'intégration d'outils comme PHP_CodeSniffer et Laravel Pint dans notre flux de développement nous aide à maintenir ces standards de manière automatique, assurant que notre code est non seulement fonctionnel mais aussi propre et conforme aux meilleures pratiques de l'industrie. 

## 2. Checklists de Qualité du code 

### Documentation et Commentaires 

- Fournir des commentaires significatifs pour la logique complexe dans le code, en particulier dans les méthodes abstraites qui nécessitent une implémentation. 

- Mettre à jour ou ajouter des commentaires PHPDoc pour toutes les classes, méthodes et propriétés, y compris une brève description et tous les paramètres ou types de retour. 

- S'assurer que le README.md ou toute documentation pertinente est mise à jour pour refléter les changements ou les nouvelles fonctionnalités. 

### Tests et Couverture 

- Écrire des tests unitaires pour tout nouveau code et s'assurer qu'ils passent. Utiliser PHPUnit et les facilités de test de Laravel. 

- Viser un pourcentage élevé de couverture de tests, couvrant tous les chemins importants, les cas limites et la gestion des erreurs. 

- Exécuter les tests existants pour s'assurer qu'aucune fonctionnalité existante n'est rompue. Réparer tout test échouant lié à vos changements. 

### Fonctionnalité et Sécurité 

- Tester manuellement les changements localement pour le comportement attendu. 

- Tester dans un environnement de préproduction si possible. 

- S'assurer qu'il n'y a pas de vulnérabilités de sécurité potentielles introduites avec les changements. Utiliser les fonctionnalités de sécurité de Laravel pour atténuer les problèmes de sécurité communs. 

- Valider les entrées utilisateur pour prévenir l'injection SQL, le cross-site scripting (XSS) et d'autres vulnérabilités web communes. 

### Performance & Optimisation 

- Optimiser les requêtes de base de données, en particulier dans AbstractQueryBuilderService et tous les services qui l'étendent. 

- Utiliser les mécanismes de mise en cache de Laravel pour les données fréquemment accédées afin d'améliorer la performance. 

- Examiner toute bibliothèque ou dépendance ajoutée pour d'éventuels impacts sur la performance. 

### Compatibilité et Maintenance 

- S'assurer que le code est compatible avec la version de Laravel du projet et toute autre dépendance. 

- Suivre les directives du projet pour les conventions de nommage, la structure des répertoires et d'autres décisions architecturales. 

- Écrire du code facile à maintenir et à étendre. Éviter les solutions excessivement complexes quand une approche plus simple est suffisante. 

### Collaboration et Communication 

- Décrire clairement vos changements dans la description de la PR, y compris la raison du changement et tout contexte pertinent. 

- Si votre PR aborde un problème, lier ce problème dans la description. 

- Être ouvert aux retours et prêt à faire des ajustements basés sur les commentaires de révision de la PR. 


## 3. Contrôle de Version 

1. Fork du Projet : 

   - Commencer par forker le projet inspiré-me-api sur GitHub “https://github.com/MenWhoRust/inspire-me-api" en cliquant sur le bouton "Fork" en haut à droite de la page du projet. Cela créera une copie du projet dans votre compte GitHub. 

2. Clonage du Projet : 

   - Cloner le fork localement sur votre machine: 

     git clone https://github.com/VOTRE_UTILISATEUR_GITHUB/inspire-me-api.git 

3. Création d'une Branche de Développement : 

   - Se déplacer dans le répertoire du projet : 

     cd inspire-me-api 

     ``` 

   - Créer une branche de développement : 

     ``` 

     git checkout -b develop 

     ``` 
4. Contributions : 

   - Travailler sur le code dans cette branche de développement. 

   - Créer des branches spécifiques pour les fonctionnalités ou correctifs que nous implémentons: 

     ``` 
     git checkout -b feature/nom_de_la_fonctionnalite 

     ``` 
5. Commit et Push : 

   - Une fois que nous avons effectué nos modifications, nous les ajoutons et effectuons un commit : 

     ``` 

     git add . 

     git commit -m "Message de commit des modifications effectuées" 

     ``` 
   - Pousser les modifications vers le fork sur GitHub : 

     ``` 
     git push origin develop 

     ``` 
6. Pull Request : 

   - Sur la page du fork sur GitHub, créer une Pull Request pour fusionner les modifications avec la branche principale (probablement `master`) du projet original. 

7. Code Review et Merge : 

   - Attendre que les autres administrateurs du dépôt examinent le Pull Request et apportent éventuellement des commentaires. 

La révision de code est une étape essentielle dans le processus de développement 		logiciel. Voici les quelques pratiques que nous recommandons pour une révision de code 		efficace : 

1. Formulaire de Description de la Fonctionnalité : 

   - Avant de commencer la révision du code, le développeur soumettant le code devrait remplir un formulaire décrivant la fonctionnalité développée. Ce formulaire devrait inclure des détails sur ce que fait la fonctionnalité et pourquoi elle est nécessaire 

2. Vérification des Tests : 

   - Vérifier si des tests ont été écrits pour la nouvelle fonctionnalité ou les modifications apportées. S’assurer que ces tests couvrent suffisamment de cas, y compris les cas limites et les scénarios d'erreur, pour garantir que le code fonctionne comme prévu. 

   - S’assurer également que les tests passent avec succès avant de fusionner le code. Cela peut être vérifié en exécutant les tests localement et en vérifiant les résultats des tests dans le système d'intégration continue (CI/CD) utilisé dans le pipeline de développement. 

3. Pipeline de Build et Tests : 

   - S’assurer que le pipeline de build et de tests automatisés fonctionne correctement. Cela garantit que les modifications apportées ne cassent pas le code existant et que le code nouvellement ajouté est intégré avec succès dans le projet. 

   - Vérifier les rapports de build et de tests dans le système CI/CD pour s’assurer que toutes les étapes ont été exécutées avec succès. 

4. Respect des Normes de Qualité du Code : 

   - S’assurer que le code respecte les normes de qualité établies dans le projet dans la section « Standards et Checklists de Qualité du Code ».  

   - Utiliser des outils d'analyse statique du code comme Sokrate pour identifier les problèmes potentiels tels que les violations de style et une faible qualité logiciel comme une complexité haute du code, des méthodes longues, pas de découpage adéquat, etc… 

5. Feedback Constructif : 

   - Fournir des commentaires constructifs sur le code examiné. Cela peut inclure des suggestions d'amélioration, des corrections de bugs, des clarifications sur le fonctionnement du code, etc. 

   - S’assurer que les commentaires sont spécifiques, clairs et respectueux, et encouragez la discussion et la collaboration. 

   - Une fois que la Pull Request est approuvée, elle peut être fusionnée dans la branche principale. 

8. Mise à jour du Fork : 

   - Pensez à garder le fork à jour en synchronisant régulièrement la branche de développement avec la branche principale (`master`) du projet original. Cela se fait en récupérant les modifications du projet original et en les fusionnant dans le fork local. 
