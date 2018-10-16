<?php

namespace App\Services\v1;

use Illuminate\Support\Facades\DB;
use App\Quote;

// Handles Database requests
class QuotesService
{
    protected $supportedIncludes = [
        ''
    ];

    public function getQuotes($parameters = [])
    {
        // Check if parameters is defined
        if (empty($parameters)) {
            // Get all quotes
            return Quote::all();
        }

        if (isset($parameters['include'])) {
        }
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
                'quote_id' => $quote->id,
                'quote' => $quote->quote_content,
                'quotee_id' => $quote->quotee_id,
                'quotee_name' => $quote->quotee_name,
                'keywords' => $quote->keywords
            ];

            // Add entry to data array
            $data[] = $entry;
        }

        return $data;
    }
}
