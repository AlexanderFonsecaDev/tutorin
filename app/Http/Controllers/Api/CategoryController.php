<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\CategoryCollection;

class CategoryController extends Controller
{

    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        return response()->json(new CategoryCollection(
            $this->category->orderBy('id','desc')->get()
        ));
    }

    public function store(CategoryStoreRequest $request)
    {
        $category = $this->category->create($request->all());
        return response()->json(new CategoryResource($category), 201);
    }

    public function show(Category $category)
    {
        return response()->json(new CategoryResource($category), 200);
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        $category = $this->category->find($id);
        $category->update($request->all());
        return response()->json(new CategoryResource($category), 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(null, 204);
    }
}
