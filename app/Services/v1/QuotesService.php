<?php

namespace App\Services\v1;

use Illuminate\Support\Facades\DB;
use App\Quote;

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
        'quote_content' => 'content',
        'quotees.quotee_name' => 'quotee'
        ],
        
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
            return $this->filterQuotes(Quote::all());
        }

        $includes = $this->getIncludes($parameters);
        $clauses = $this->getWhereClauses($parameters);
        $query = $this->buildQuery($includes, $clauses);

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
                'quote_id' => $quote->id,
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

    protected function getIncludes($parameters = [])
    {
        $includes = [];


        if (isset($parameters['include'])) {
            $includeParams = explode(',', $parameters['include']);
            $includes = array_intersect($this->supportedIncludes, $includeParams);
        }

        return $includes;
    }

    protected function getWhereClauses($parameters = [])
    {
        $clause = [];

        foreach ($this->clauseProperties['likeClauses'] as $key=>$value) {
            if (in_array($value, array_keys($parameters))) {
                $clause['likeClauses'][$key] = $parameters[$value];
            }
        }
        return $clause;
    }

    protected function buildQuery($includes, $clauses)
    {
        $basicQuery = DB::table('quotes')
        ->join('quotees', 'quotes.quotee_id', 'quotees.id');
        foreach ($includes as $key=>$value) {
            if (in_array($value, $this->quoteeFields)) {
                $basicQuery->join($key, 'quotees.' . $value . '_id', '=', $key . '.id');
                continue;
            }
            $basicQuery->join($key, 'quotes.' . $value . '_id', '=', $key . '.id');
        }

        foreach ($clauses['likeClauses'] as $clause=>$value) {
            $term = str_replace(['+',','], ' ', $value);
            if ($clause == 'keywords') {
                $keywords = explode(' ', $term);
                foreach ($keywords as $keyword) {
                    $basicQuery->where($clause, 'like', '%' . $keyword . '%');
                }
                continue;
            }
            $basicQuery->where($clause, 'like', '%' . $term . '%');
        }

        return $basicQuery;
    }
}
