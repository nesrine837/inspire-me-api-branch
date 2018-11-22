<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Services\v1\QuotesService;

use App\Quote;

class QuotesController extends Controller
{
    protected $quotesService;
    protected $rules = [
        'quote_content' => 'required',
        'quotee_id' => 'required|exists:quotees,id',
        'category_id' => 'required|exists:categories,id',
        'keywords' => 'nullable',

    ];

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
    public function store(Request $request)
    {
        $validation = Validator::make($request->input(), $this->rules);
        if ($validation->fails()) {
            return response()->json($validation->messages(), 400);
        }

    }
    public function destroy($id)
    {
        Quote::where('id', $id)->firstOrFail()->delete();
        $data = [
            'message' => 'Record successfully deleted'
        ];
        return response()->json($data, 200);
    }
}
