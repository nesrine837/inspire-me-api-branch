<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\v1\ProfessionsService;

class ProfessionsController extends Controller
{
    protected $professionsService;

    public function __construct(ProfessionsService $service)
    {
        $this->professionsService = $service;
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
        $parameters['profession_id'] = $id;
        $professions = $this->professionsService->getProfessions($parameters);
        return response()->json($professions);
    }
}
