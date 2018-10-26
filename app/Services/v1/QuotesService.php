<?php

namespace App\Services\v1;

use Illuminate\Support\Facades\DB;
use App\Classes\QueryBuilder;

// Handles Database requests
class QuotesService extends QueryBuilder
{
    # What table this service works with
    protected $table = 'quotes';

    ###################################################
    ############ Operation Arrays #####################
    ###################################################
    # What includes are allowed
    protected $supportedIncludes = [
        'nationalities' => 'nationality',
        'professions' => 'profession',
        'categories' => 'category'
    ];

    # Supported where clauses
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

    # How results can be ordered by
    protected $sortingFields = [
        'quotee_name asc' => 'quotee',
        'quotee_name asc' => 'quotee_asc',
        'quotee_name desc' => 'quotee_desc',
        'nationality_name asc' => 'nationality',
        'nationality_name asc' => 'nationality_asc',
        'nationality_name desc' => 'nationality_desc',
        'profession_name asc' => 'profession',
        'profession_name asc' => 'profession_asc',
        'profession_name desc' => 'profession_desc',
        'category_name asc' => 'category',
        'category_name asc' => 'category_asc',
        'category_name desc' => 'category_desc',
    ];

    # An array to check what includes are required
    # if they are not found in the include parameter
    # of the request
    protected $requiredIncludes = [
        'nationalities' => ['nationalities.id',
                            'nationalities.nationality_name',
                            'nationality_name asc',
                            'nationality_name desc'],
        'professions' => [  'professions.id',
                            'professions.profession_name',
                            'profession_name asc',
                            'profession_name desc'],
        'categories' => [   'categories.id',
                            'categories.category_name',
                            'category_name asc',
                            'category_name desc']
    ];

    # Array to distinguish what fields belong to
    # the quotee table
    private $quoteeFields = [
        'nationality',
        'profession'
    ];

    #################################################


    # Main function that returns query results
    public function getQuotes($parameters)
    {
        $query = $this->buildQuery($parameters);

        return $this->filterQuotes($query->get());
    }

    // Filters what fields are shown
    protected function filterQuotes($quotes)
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
            if (isset($quote->profession_id)) {
                $entry['quotee']['profession'] = [
                            'id' => $quote->profession_id,
                            'name' => $quote->profession_name
                    ];
            }
            if (isset($quote->nationality_id)) {
                $entry['quotee']['nationality'] = [
                            'id' => $quote->nationality_id,
                            'name' => $quote->nationality_name
                    ];
            }
            if (isset($quote->category_id)) {
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

    # Add necessary selects for the query
    protected function addSelects(&$query, $includes)
    {
        # Selects part of every query
        $quotesSelect = ['quotes.id as quote_id','quotes.quote_content','quotes.keywords'];
        $quoteesSelect = ['quotees.id as quotee_id','quotees.quotee_name','quotees.biography_link'];

        $includeSelects = [];

        # Add selects based includes in the parameters
        if (!empty($includes)) {
            foreach ($includes as $key=>$value) {
                $includeSelects[] = $key . '.id as ' . $value . '_id';
                $includeSelects[] = $key . '.' . $value . '_name';
            }
        }

        $selectArray = array_merge($quotesSelect, $quoteesSelect, $includeSelects);

        $query->select($selectArray);
    }

    # Adds necessary joins for the query
    protected function addJoins(&$query, $includes)
    {
        #joins part of every query
        $query->join('quotees', 'quotes.quotee_id', 'quotees.id');

        # Add joins based on the includes
        foreach ($includes as $key=>$value) {
            if (in_array($value, $this->quoteeFields)) {
                $query->join($key, 'quotees.' . $value . '_id', '=', $key . '.id');
                continue;
            }
            $query->join($key, 'quotes.' . $value . '_id', '=', $key . '.id');
        }
    }
}
