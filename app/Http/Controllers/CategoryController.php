<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Catch_;

class CategoryController extends Controller
{
    public function index(){
        $categorys = Category::where('parent_id',null)->get();
        return view('admin.category.category', compact('categorys'));
    }
    public function store(Request $request){
       $category = new Category;
    //    $category->parent_id = Auth::user()->user_id;
       $category->parent_id = $request->parent_id;
       $category->slug = $request->slug;
       $category->name = $request->name;
       $category->icon = $request->icon;
       $category->parent_id = $request->parent_id;

       $category->save();
       return redirect()->back();
    }
    public function edit(Request $request,$id)
    {
        $cg = Category::find($id);
        $scg = Category::where('parent_id',null)->get();
        return view('admin.category.edit',compact('cg','scg'));
    }
     public function update(Request $request,$id)
    {
        $cg = Category::find($id);
        $cg->parent_id = $request->parent_id;
        $cg->slug = $request->slug;
        $cg->name = $request->name;
        $cg->icon = $request->icon;

        $cg->save();
        return redirect()->back();
    }
     public function destroy($id)
    {
        $cg = Category::find($id);
        $cg->delete();

        return redirect()->back();
    }
}