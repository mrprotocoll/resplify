<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CategoryRequest;
use App\Http\Resources\V1\CategoryResource;
use App\Models\Admin;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return ResponseHelper::success(CategoryResource::collection($categories));
    }

    public function store(CategoryRequest $request)
    {

        $category = Admin::current()->categories()->create($request->validated());
        return $category ? ResponseHelper::success(new CategoryResource($category)) : ResponseHelper::error();
    }

    public function show(Category $category)
    {
        return $category ? ResponseHelper::success(new CategoryResource($category)) : ResponseHelper::error();
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $update = $category->update($request->validated());
        return $update ? ResponseHelper::success(new CategoryResource($category)) : ResponseHelper::error();
    }
}
