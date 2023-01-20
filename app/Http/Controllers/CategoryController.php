<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(){
        $categorys = Category::where('parent_id',null)->get();
        return view('admin.category.category', compact('categorys'));
    }
    public function store(Request $request){
       $category = new Category;
       $category->parent_id = Auth::user()->user_id;
       $category->parent_id = Auth::user()->parent_id;
       $category->slug = $request->slug;
       $category->name = $request->name;
       $category->icon = $request->icon;
       $category->parent_id = $request->parent_id;

       $category->save();
       return redirect()->back();
    }
}