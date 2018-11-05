# Inspire Me API Documentation

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

By default this endpoint returns pages of 25 quotes and their quotes

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

-   `quote_id`: Search by the ID of a quote; \
    must be an exact match to existing record
-   `quote_content`: Search by the content of a quote
-   `keywords`: Search by the keywords of a quote
-   `category_id`: Search by the ID of a category; \
    must be an exact match to existing record
-   `category`: Search by the name of a category; \
    must be an exact match to existing record
-   `quotee_id`: Search by the ID of a quotee; \
    must be an exact match to existing record
-   `quotee`: Search by the name of a quotee; \
    must be an exact match to existing record
-   `gender`: Search by the gender of a quotee; accepted values are `m` or `f`
-   `nationality_id`: Search by the ID of a nationality; \
    must be an exact match to existing record
-   `nationality`: Search by the name of a nationality; \
    must be an exact match to existing record
-   `profession_id`: Search by the ID of a profession; \
    must be an exact match to existing record
-   `profession`: Search by the name of a profession; \
    must be an exact match to existing record

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
