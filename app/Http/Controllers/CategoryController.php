<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list()
    {
        try {
            return Category::all();
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function create(Request $request)
    {
        //validate the request
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        try {
            return Category::firstOrCreate($validated);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Category $category)
    {
        //validate the request
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        try {
            return $category->update($validated);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Category $category)
    {
        try {
            return $category->delete();
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
