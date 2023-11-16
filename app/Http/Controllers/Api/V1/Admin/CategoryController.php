<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CategoryRequest;
use App\Http\Resources\V1\CategoryResource;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{

    public function index()
    {
        try {
            $categories = Category::all();
            return ResponseHelper::success(CategoryResource::collection($categories));
        }catch (\Exception $e) {
            Log::error($e);
            return ResponseHelper::error();
        }
    }

    public function store(CategoryRequest $request)
    {
        try {
            $category = Admin::current()->categories()->create($request->validated());
            return ResponseHelper::success(new CategoryResource($category));
        }catch (\Exception $e) {
            Log::error($e);
            return ResponseHelper::error();
        }
    }

    public function show(Category $category)
    {
        try {
            return ResponseHelper::success(new CategoryResource($category));
        }catch (\Exception $e) {
            Log::error($e);
            return ResponseHelper::error();
        }
    }

    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $category->update($request->validated());
            return ResponseHelper::success(new CategoryResource($category));
        }catch (\Exception $e) {
            Log::error($e);
            return ResponseHelper::error();
        }
    }
}
