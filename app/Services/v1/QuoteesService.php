<?php

namespace App\Services\v1;

use Illuminate\Support\Facades\DB;
use App\Classes\AbstractService;

class QuoteesService extends AbstractService
{
    # What table this service works with
    protected $table = 'quotees';
    protected $defaultRecordLimit = 25;

    ###################################################
    ############ Operation Arrays #####################
    ###################################################
    # What includes are allowed
    protected $supportedIncludes = [
        'quotes' => 'quote_count'
    ];

    # Supported where clauses
    # Inner Arrays: Key is the column and value is the url parameter
    protected $clauseProperties = [
        'likeClauses' => [
        ],
        'matchClauses' => [
            'quotees.id' => 'quotee_id',
            'nationalities.id' => 'nationality_id',
            'professions.id' => 'profession_id',
            'quotees.quotee_name' => 'quotee',
            'quotees.quotee_gender' => 'gender',
            'nationalities.nationality_name' => 'nationality',
            'professions.profession_name' => 'profession'
        ]

    ];

    # How results can be ordered by
    # Key is the url parameter and value is the column and order
    protected $sortingFields = [
        'quote_count'=>'quote_count asc',
        'quote_count_asc'=>'quote_count asc',
        'quote_count_desc'=>'quote_count desc',
        'name'=>'quotee_name asc',
        'name_asc'=>'quotee_name asc',
        'name_desc'=>'quotee_name desc',
        'profession'=>'profession_name asc',
        'profession_asc'=>'profession_name asc',
        'profession_desc'=>'profession_name desc',
        'nationality'=>'nationality_name asc',
        'nationality_asc'=>'nationality_name asc',
        'nationality_desc'=>'nationality_name desc'
    ];

    # An array to check what includes are required
    # if they are not found in the include parameter
    # of the request
    protected $requiredIncludes = [
        'quotes' => [
            'quote_count asc',
            'quote_count desc'
        ]
    ];
    #################################################

    # Main function that returns query results
    public function getQuotees($parameters)
    {
        $query = $this->buildQuery($parameters);

        return $this->filter($query->get());
    }

    // Filters what fields are shown
    protected function filter($quotees)
    {
        // Array to hold the data
        $data = [];
        // Iterate over results
        // and choose what fields to keep
        foreach ($quotees as $quotee) {
            $entry = [
                'quotee_id' => $quotee->quotee_id,
                'quotee_name' => $quotee->quotee_name,
                'biography_link' => $quotee->biography_link,
                'quotee_gender' => $quotee->quotee_gender == 'm' ? 'Male' : 'Female',
                'profession' => [
                    'id' => $quotee->profession_id,
                    'name' => $quotee->profession_name
                ],
                'nationality' => [
                    'id' => $quotee->nationality_id,
                    'name' => $quotee->nationality_name
                ]
            ];

            if (isset($quotee->quote_count)) {
                $entry['quote_count'] = $quotee->quote_count;
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
        $quoteesSelect = ['quotees.id as quotee_id','quotees.quotee_name','quotees.biography_link', 'quotees.quotee_gender'];
        $nationalitiesSelect = ['nationalities.id as nationality_id', 'nationalities.nationality_name as nationality_name'];
        $professionsSelect = ['professions.id as profession_id', 'professions.profession_name as profession_name'];

        $includeSelects = [];

        # Add selects based includes in the parameters
        if (!empty($includes)) {
            foreach ($includes as $key=>$value) {
                if ($key == 'quotes') {
                    $includeSelects[] = DB::raw('COUNT(quotes.id) as quote_count');
                    continue;
                }
                $includeSelects[] = $key . '.id as ' . $value . '_id';
                $includeSelects[] = $key . '.' . $value . '_name';
            }
        }

        $selectArray = array_merge($quoteesSelect, $nationalitiesSelect, $professionsSelect, $includeSelects);

        $query->select($selectArray);
    }

    # Adds necessary joins for the query
    protected function addJoins(&$query, $includes)
    {
        #joins part of every query
        $query  ->join('nationalities', 'quotees.nationality_id', 'nationalities.id')
                ->join('professions', 'quotees.profession_id', 'professions.id');

        # Add joins based on the includes
        if (isset($includes['quotes'])) {
            $query->join('quotes', 'quotes.quotee_id', 'quotees.id');
            $query->groupBy('quotee_id');
        }
    }
}
