<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\v1\NationalitiesService;

class NationalitiesController extends Controller
{
    protected $nationalitiesService;

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
}
