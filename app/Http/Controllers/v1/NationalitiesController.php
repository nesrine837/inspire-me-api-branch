<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Services\v1\NationalitiesService;

use App\Nationality;

class NationalitiesController extends Controller
{
    protected $nationalitiesService;
    protected $rules = [
        'nationality_name' => 'required|unique:nationalities,nationality_name',

    ];

    public function __construct(NationalitiesService $service)
    {
        $this->nationalitiesService = $service;
    }
    public function index()
    {
        $parameters = array_change_key_case(request()->input());
        $nationalities = $this->nationalitiesService->getNationalities($parameters);
        return response()->json($nationalities);
    }

    public function show($id)
    {
        $parameters = array_change_key_case(request()->input());
        $parameters['id'] = $id;
        $nationalities = $this->nationalitiesService->getNationalities($parameters);
        return response()->json($nationalities);
    }
    public function store(Request $request)
    {
        $validation = Validator::make($request->input(), $this->rules);
        if ($validation->fails()) {
            return response()->json($validation->messages(), 400);
        }

        $nationality = new Nationality;

        $nationality->nationality_name = $request->input('nationality_name');

        $nationality->save();

        return response()->json($nationality, 201);
    }

    public function destroy($id)
    {
        Nationality::where('id', $id)->firstOrFail()->delete();
        $data = [
                'status' => 'Record successfully deleted'
            ];
        return response()->json($data, 200);
    }
}
