<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\v1\QuotesService;

class QuotesController extends Controller
{
    protected $quotesService;

    public function __construct(QuotesService $service)
    {
        $this->quotesService = $service;
    }

    public function index()
    {
        $parameters = array_change_key_case(request()->input());
        $quotes = $this->quotesService->getQuotes($parameters);

        if (empty($quotes)) {
            return response('No Quotes found with the given criteria', 404);
        }

        return response()->json($quotes);
    }

    public function show($id)
    {
        $parameters = array_change_key_case(request()->input());
        $parameters['quote_id'] = $id;
        $quotes = $this->quotesService->getQuotes($parameters);
        return response()->json($quotes);
    }
}
