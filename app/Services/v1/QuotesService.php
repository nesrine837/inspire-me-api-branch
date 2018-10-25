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
        'quotee_name' => 'quotee',
        'nationality_name' => 'nationality',
        'profession_name' => 'profession',
        'category_name' => 'category'
    ];

    # An array to check what includes are required
    # if they are not found in the parameters
    # includes that are not explicitly asked
    # will not be shown in the final results
    # but the joins necessary will be added
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
