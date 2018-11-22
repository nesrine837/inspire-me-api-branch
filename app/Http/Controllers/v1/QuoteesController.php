<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\v1\QuoteesService;
use Validator;

class QuoteesController extends Controller
{
    protected $quoteesService;
    protected $rules = [
        'quotee_name' => 'required|unique:quotees,quotee_name',
        'biography_link' => 'nullable|max:2083',
        'profession_id' => 'required|exists:professions,id',
        'nationality_id' => 'required|exists:nationalities,id',
        'quotee_gender' => ['required','max:1', 'regex:/(m|f)/i'],

    ];
    protected $messages = [
        'quotee_gender.regex' => 'The value of quotee_gender must be \'m\' or \'f\'.'
    ];

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
    public function destroy($id)
    {
        Quotee::where('id', $id)->firstOrFail()->delete();
        $data = [
                'message' => 'Record successfully deleted'
            ];
        return response()->json($data, 200);
    }
}
