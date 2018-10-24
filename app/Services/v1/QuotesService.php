<?php

namespace App\Services\v1;

use Illuminate\Support\Facades\DB;

// Handles Database requests
class QuotesService
{
    protected $supportedIncludes = [
        'nationalities' => 'nationality',
        'professions' => 'profession',
        'categories' => 'category'
    ];

    protected $clauseProperties = [
        'likeClauses' => [
        'keywords' => 'keywords',
        'quote_content' => 'content'
        ],
        'matchClauses' => [
            'quotes.id' => 'quote_id',
            'categories.id' => 'category_id',
            'quotees.id' => 'quotee_id',
            'nationalities.id' => 'nationality_id',
            'professions.id' => 'profession_id',
            'quotees.quotee_name' => 'quotee',
            'nationalities.nationality_name' => 'nationality',
            'professions.profession_name' => 'profession',
            'categories.category_name' => 'category'
        ]

    ];

    protected $sortingFields = [
        'quotee_name' => 'quotee',
        'nationality_name' => 'nationality',
        'profession_name' => 'profession',
        'category_name' => 'category'
    ];

    protected $requiredIncludes = [
        'nationalities' => ['nationalities.id',
                            'nationalities.nationality_name',
                            'nationality_name'],
        'professions' => [  'professions.id',
                            'professions.profession_name',
                            'profession_name'],
        'categories' => [   'categories.id',
                            'categories.category_name',
                            'category_name']
    ];


    private $quoteeFields = [
        'nationality',
        'profession'
    ];

    public function getQuotes($parameters)
    {
        // Check if parameters is defined
        if (empty($parameters)) {
            // Get all quotes
            return $this->filterQuotes($this->buildQuery()->get());
        }

        $includes = $this->getIncludes($parameters);
        $clauses = $this->getWhereClauses($parameters);
        $sorting = $this->getSorting($parameters);

        $query = $this->buildQuery($includes, $clauses, $sorting);

        return $this->filterQuotes($query->get(), $includes);
    }

    // Filters what fields are shown
    protected function filterQuotes($quotes, $params = [])
    {
        // Array to hold the data
        $data = [];
        // Iterate over results
        // and choose what fields to keep
        foreach ($quotes as $quote) {
            $entry = [
                'quote_id' => $quote->quote_id,
                'quote' => $quote->quote_content,
                'keywords' => $quote->keywords,
                'quotee' => [
                    'id' => $quote->quotee_id,
                    'name' => $quote->quotee_name,
                    ]
            ];
            if (in_array('profession', $params)) {
                $entry['quotee']['profession'] = [
                            'id' => $quote->profession_id,
                            'name' => $quote->profession_name
                    ];
            }
            if (in_array('nationality', $params)) {
                $entry['quotee']['nationality'] = [
                            'id' => $quote->nationality_id,
                            'name' => $quote->nationality_name
                    ];
            }
            if (in_array('category', $params)) {
                $entry['category'] = [
                    'id' => $quote->category_id,
                    'name' => $quote->category_name
                ];
            }

            // Add entry to data array
            $data[] = $entry;
        }

        return $data;
    }

    protected function addSelects(&$query, $includes)
    {
        $quotesSelect = ['quotes.id as quote_id','quotes.quote_content','quotes.keywords'];
        $quoteesSelect = ['quotees.id as quotee_id','quotees.quotee_name','quotees.biography_link'];
        $includeSelects = [];

        if (!empty($includes)) {
            foreach ($includes as $key=>$value) {
                $includeSelects[] = $key . '.id as ' . $value . '_id';
                $includeSelects[] = $key . '.' . $value . '_name';
            }
        }

        $selectArray = array_merge($quotesSelect, $quoteesSelect, $includeSelects);

        $query->select($selectArray);
    }

    protected function addJoins(&$query, $includes)
    {
        $query->join('quotees', 'quotes.quotee_id', 'quotees.id');
        foreach ($includes as $key=>$value) {
            if (in_array($value, $this->quoteeFields)) {
                $query->join($key, 'quotees.' . $value . '_id', '=', $key . '.id');
                continue;
            }
            $query->join($key, 'quotes.' . $value . '_id', '=', $key . '.id');
        }
    }
}
