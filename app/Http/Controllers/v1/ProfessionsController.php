<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\v1\ProfessionsService;
use Validator;

use App\Profession;

class ProfessionsController extends Controller
{
    protected $professionsService;
    protected $rules = [
        'profession_name' => 'required|unique:professions,profession_name',

    ];

    public function __construct(ProfessionsService $service)
    {
        $this->professionsService = $service;
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
    public function index()
    {
        $parameters = array_change_key_case(request()->input());
        $professions = $this->professionsService->getProfessions($parameters);
        return response()->json($professions);
    }
    public function show($id)
    {
        $parameters = array_change_key_case(request()->input());
        $parameters['id'] = $id;
        $professions = $this->professionsService->getProfessions($parameters);
        return response()->json($professions);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->input(), $this->rules);
        if ($validation->fails()) {
            return response()->json($validation->messages(), 400);
        }

        $profession = new Profession;

        $profession->profession_name = $request->input('profession_name');

        $profession->save();

        return response()->json($profession, 201);
    }

    public function destroy($id)
    {
        Profession::where('id', $id)->firstOrFail()->delete();
        $data = [
                'message' => 'Record successfully deleted'
            ];
        return response()->json($data, 200);
    }
}
