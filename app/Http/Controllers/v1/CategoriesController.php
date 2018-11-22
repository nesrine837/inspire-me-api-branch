<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Services\v1\CategoriesService;

use App\Category;

class CategoriesController extends Controller
{
    protected $categoriesService;
    protected $rules = [
        'category_name' => 'required|unique:categories,category_name',

    ];

    public function __construct(CategoriesService $service)
    {
        $this->categoriesService = $service;
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
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
        $parameters['id'] = $id;
        $categories = $this->categoriesService->getCategories($parameters);
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->input(), $this->rules);
        if ($validation->fails()) {
            return response()->json($validation->messages(), 400);
        }

        $category = new Category;

        $category->category_name = $request->input('category_name');

        $category->save();

        return response()->json($category, 201);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->input(), $this->rules);
        if ($validation->fails()) {
            return response()->json($validation->messages(), 400);
        }

        $category = Category::where('id', $id)->firstOrFail();


        $category->category_name = $request->input('category_name');

        $category->save();

        return response()->json($category, 200);
    }

    public function destroy($id)
    {
        Category::where('id', $id)->firstOrFail()->delete();
        $data = [
                'message' => 'Record successfully deleted'
            ];
        return response()->json($data, 200);
    }
}
