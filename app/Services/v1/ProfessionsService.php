<?php

namespace App\Services\v1;

use Illuminate\Support\Facades\DB;
use App\Classes\AbstractQueryBuilderService;

class ProfessionsService extends AbstractQueryBuilderService
{
    # What table this service works with
    protected $table = 'professions';

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
            'professions.profession_name' => 'profession',
        ],
        'matchClauses' => [
            'professions.id' => 'profession_id',
        ]

    ];

    # How results can be ordered by
    # Key is the url parameter and value is the column and order
    protected $sortingFields = [
        'name' => 'profession_name asc',
        'name_asc' => 'profession_name asc',
        'name_desc' => 'profession_name desc',
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
    public function getProfessions($parameters)
    {
        $query = $this->buildQuery($parameters);

        return $query->get();
    }

    // Filters what fields are shown
    protected function filter($professions)
    {
        // Array to hold the data
        $data = [];
        // Iterate over results
        // and choose what fields to keep
        foreach ($professions as $profession) {
            $entry = [
                'profession_id' => $profession->profession_id,
                'profession_name' => $profession->profession_name,
            ];

            if (isset($quotee->quote_count)) {
                $entry['quote_count'] = $profession->quote_count;
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
        $nationalitiesSelect = ['professions.id as profession_id', 'professions.profession_name as profession_name'];

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
            $query->join('quotees', 'quotees.profession_id', 'professions.id');
            $query->groupBy('profession_id');
        }
    }
}
