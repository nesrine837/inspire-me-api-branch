<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\v1\QuoteesService;
use Validator;

use App\Quotee;

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
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
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
        $parameters['id'] = $id;
        $quotees = $this->quoteesService->getQuotees($parameters);
        return response()->json($quotees);
    }
    public function store(Request $request)
    {
        $validation = Validator::make($request->input(), $this->rules, $this->messages);
        if ($validation->fails()) {
            return response()->json($validation->messages(), 400);
        }

        $quotee = new Quotee;

        $quotee->quotee_name = $request->input('quotee_name');
        $quotee->biography_link = $request->input('biography_link');
        $quotee->profession_id = $request->input('profession_id');
        $quotee->nationality_id = $request->input('nationality_id');
        $quotee->quotee_gender = $request->input('quotee_gender');

        $quotee->save();

        return response()->json($quotee, 201);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->input(), $this->rules);
        if ($validation->fails()) {
            return response()->json($validation->messages(), 400);
        }

        $quotee = Quotee::where('id', $id)->firstOrFail();

        $quotee->quotee_name = $request->input('quotee_name');
        $quotee->biography_link = $request->input('biography_link');
        $quotee->profession_id = $request->input('profession_id');
        $quotee->nationality_id = $request->input('nationality_id');
        $quotee->quotee_gender = $request->input('quotee_gender');

        $quotee->save();

        return response()->json($quotee, 200);
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
