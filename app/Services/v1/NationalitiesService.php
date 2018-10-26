<?php

namespace App\Services\v1;

use Illuminate\Support\Facades\DB;
use App\Classes\AbstractService;

class NationalitiesService extends AbstractService
{
    # What table this service works with
    protected $table = 'nationalities';

    ###################################################
    ############ Operation Arrays #####################
    ###################################################
    # What includes are allowed
    protected $supportedIncludes = [
        'quotees' => 'quotee_count'
    ];

    # Supported where clauses
    # Inner Arrays: Key is the column and value is the url parameter
    protected $clauseProperties = [
        'likeClauses' => [
        ],
        'matchClauses' => [
            'nationalities.id' => 'nationality_id',
            'nationalities.nationality_name' => 'nationality',
        ]

    ];

    # How results can be ordered by
    # Key is the url parameter and value is the column and order
    protected $sortingFields = [
        'name' => 'nationality_name asc',
        'name_asc' => 'nationality_name asc',
        'name_desc' => 'nationality_name desc',
        'quotee_count'=>'quotee_count asc',
        'quotee_count_asc'=>'quotee_count asc',
        'quotee_count_desc'=>'quotee_count desc'
    ];

    protected $requiredIncludes = [
        'quotees' => [
            'quotee_count asc',
            'quotee_count desc'
        ]
    ];

    # An array to check what includes are required
    # if they are not found in the include parameter
    # of the request
    #################################################

    # Main function that returns query results
    public function getNationalities($parameters)
    {
        $query = $this->buildQuery($parameters);

        return $this->filter($query->get());
    }

    // Filters what fields are shown
    protected function filter($nationalities)
    {
        // Array to hold the data
        $data = [];
        // Iterate over results
        // and choose what fields to keep
        foreach ($nationalities as $nationality) {
            $entry = [
                'nationality_id' => $nationality->nationality_id,
                'nationality_name' => $nationality->nationality_name,
            ];

            if (isset($nationality->quotee_count)) {
                $entry['quotee_count'] = $nationality->quotee_count;
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
        $nationalitiesSelect = ['nationalities.id as nationality_id', 'nationalities.nationality_name as nationality_name'];

        $includeSelects = [];

        # Add selects based includes in the parameters
        if (!empty($includes)) {
            foreach ($includes as $key=>$value) {
                if ($key == 'quotees') {
                    $includeSelects[] = DB::raw('COUNT(quotees.id) as quotee_count');
                    continue;
                }
                $includeSelects[] = $key . '.id as ' . $value . '_id';
                $includeSelects[] = $key . '.' . $value . '_name';
            }
        }

        $selectArray = array_merge($nationalitiesSelect, $includeSelects);

        $query->select($selectArray);
    }

    # Adds necessary joins for the query
    protected function addJoins(&$query, $includes)
    {
        # Add joins based on the includes
        if (isset($includes['quotees'])) {
            $query->join('quotees', 'quotees.nationality_id', 'nationalities.id');
            $query->groupBy('nationality_id');
        }
    }
}
