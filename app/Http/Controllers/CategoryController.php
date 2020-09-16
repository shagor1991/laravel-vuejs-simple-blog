<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:3'
        ]);
        $category= new Category;
        $category->name= $request->name;
        $category->save();

        return ['status' => 200];
    }

    public function list(){
        $categories= Category::all();
        return response()->json([
            'categories' => $categories
        ], 200);
    }

    public function category($id){
        $category= Category::find($id);
        return response()->json([
            'category' => $category
        ],200);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|min:3'
        ]);
        $category= Category::find($id);
        $category->name= $request->name;
        $category->save();

        return ['status' => 200];
    }

    public function delete($id){
        $category= Category::find($id);
        $category->delete();
        return ['status' => 200];
    }
}
