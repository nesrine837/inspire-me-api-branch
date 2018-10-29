<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\v1\CategoriesService;

class CategoriesController extends Controller
{
    protected $categoriesService;

    public function __construct(CategoriesService $service)
    {
        $this->categoriesService = $service;
    }
    public function index()
    {
        $parameters = array_change_key_case(request()->input());
        $categories = $this->categoriesService->getCategories($parameters);
        return response()->json($categories);
    }

    public function show($id)
    {
        $parameters = array_change_key_case(request()->input());
        $parameters['category_id'] = $id;
        $categories = $this->categoriesService->getCategories($parameters);
        return response()->json($categories);
    }
}
