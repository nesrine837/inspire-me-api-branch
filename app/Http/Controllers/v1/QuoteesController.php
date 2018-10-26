<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\v1\QuoteesService;

class QuoteesController extends Controller
{
    protected $quoteesService;

    public function __construct(QuoteesService $service)
    {
        $this->quoteesService = $service;
    }
    public function index()
    {
        $parameters = array_change_key_case(request()->input());
        $quotees = $this->quoteesService->getQuotees($parameters);
        return response()->json($quotees);
    }

    public function show($id)
    {
        $parameters = array_change_key_case(request()->input());
        $parameters['quotee_id'] = $id;
        $quotees = $this->quoteesService->getQuotees($parameters);
        return response()->json($quotees);
    }
}
