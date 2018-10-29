<?php

namespace App\Services\v1;

use Illuminate\Support\Facades\DB;
use App\Classes\AbstractQueryBuilderService;

class CategoriesService extends AbstractQueryBuilderService
{
    # What table this service works with
    protected $table = 'categories';
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
            'categories.id' => 'category_id',
            'categories.category_name' => 'category',
        ]

    ];

    # How results can be ordered by
    # Key is the url parameter and value is the column and order
    protected $sortingFields = [
        'name' => 'category_name asc',
        'name_asc' => 'category_name asc',
        'name_desc' => 'category_name desc',
        'quote_count'=>'quote_count asc',
        'quote_count_asc'=>'quote_count asc',
        'quote_count_desc'=>'quote_count desc'
    ];

    protected $requiredIncludes = [
        'quotes' => [
            'quote_count asc',
            'quote_count desc'
        ]
    ];

    # An array to check what includes are required
    # if they are not found in the include parameter
    # of the request
    #################################################

    # Main function that returns query results
    public function getCategories($parameters)
    {
        $query = $this->buildQuery($parameters);

        return $this->filter($query->get());
    }

    // Filters what fields are shown
    protected function filter($categories)
    {
        // Array to hold the data
        $data = [];
        // Iterate over results
        // and choose what fields to keep
        foreach ($categories as $category) {
            $entry = [
                'category_id' => $category->category_id,
                'category_name' => $category->category_name,
            ];

            if (isset($category->quote_count)) {
                $entry['quote_count'] = $category->quote_count;
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
        $categoriesSelect = ['categories.id as category_id', 'categories.category_name as category_name'];

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

        $selectArray = array_merge($categoriesSelect, $includeSelects);

        $query->select($selectArray);
    }

    # Adds necessary joins for the query
    protected function addJoins(&$query, $includes)
    {
        # Add joins based on the includes
        if (isset($includes['quotes'])) {
            $query->join('quotes', 'quotes.category_id', 'categories.id');
            $query->groupBy('category_id');
        }
    }
}
