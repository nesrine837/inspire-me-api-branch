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

## Introduction

Welcome to the documentation of the REST API for the Inspire Me quotes website.
This is a free open source API for retrieving quotes from our database.
The base url is `inspire-api.redmountaindev.co.za/`

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
