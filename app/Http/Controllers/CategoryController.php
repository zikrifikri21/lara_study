<?php

namespace App\Http\Controllers;

use Alert;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\SweetAlertServiceProvider;
// use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function index()
    {
        $categorys = Category::where('parent_id', null)->get();
        return view('admin.category.category', compact('categorys'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'slug' => 'required|unique:categories,slug',
            'icon' => 'required|max:2048',
        ],[
            'name.required' => 'Tolong isi Namanya. \n',
            'slug.required' => 'Tolong isi Slugnya. \n',
            'icon.required' => 'Tolong isi Icon. \n',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('error', $validator->errors()->first() . ' Pastikan anda mengisi semua inputan.');
        }

        $category = new Category();
        $category->slug = $request->slug;
        $category->name = $request->name;
        $category->icon = $request->icon;
        $category->parent_id = $request->parent_id;
        $category->user_id = Auth::user()->id;

        $category->save();
        return redirect('admin/category')->with('success','Category Berhasil di Tambah!');
    }
    public function edit(Request $request, $id)
    {
        $cg = Category::find($id);
        $scg = Category::where('parent_id', null)->get();
        return view('admin.category.edit', compact('cg', 'scg'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'slug' => 'required|unique:categories,slug,'.$id,
            'icon' => 'required|max:2048',
        ],[
            'name.required' => 'Tolong isi Namanya. \n',
            'slug.required' => 'Tolong isi Slugnya.\n ',
            'icon.required' => 'Tolong isi Icon. \n',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('error', $validator->errors()->first() . ' Pastikan anda mengisi semua inputan.');
        }

        $cg = Category::find($id);
        $cg->slug = $request->slug;
        $cg->name = $request->name;
        $cg->icon = $request->icon;
        $cg->parent_id = $request->parent_id;

        $cg->save();
        return redirect()->back()->with('success', 'Category Berhasil di Perbaharui');
    }
    public function destroy($id)
    {
        $cg = Category::find($id);
        $cg->delete();

        return redirect('admin/category')->with('success','Category berhasil di hapus!');
    }
}
