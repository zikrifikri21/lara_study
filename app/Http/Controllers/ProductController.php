<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
// use Illuminate\Http\UploadedFile::save;


class ProductController extends Controller
{
    public function index(){
        $data = Product::all();
        return view('admin.product.index', compact('data'));
    }
    public function create(){
        $categorys = Category::where('parent_id', null)->get();
        return view('admin.product.add', compact('categorys'));
    }
    public function edit(Request $request, $id)
    {
        $prd = Product::find($id);
        $cg = Category::where('parent_id', null)->get();
        return view('admin.product.edit', compact('prd', 'cg'));
    }
    public function store(Request $request){
    // return $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'slug' => 'required|unique:categories,slug',
            'file' => 'required|mimes:jpeg,png,jpg,gif,JPG,JPEG|max:8048',
            'description' => 'required|max:2048',
            'stock' => 'required',
            'price' => 'required',
        ],[
            'name.required' => 'Tolong isi Namanya. ',
            'slug.required' => 'Tolong isi Slugnya. ',
            'description.required' => 'Tolong isi description. ',
            'stock.required' => 'Tolong isi Stok. ',
            'price.required' => 'Tolong isi Price. ',
            'file.required' => 'Tolong isi Gambar. ',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('error', $validator->errors()->first() . ' Pastikan anda mengisi semua inputan.');
        }

        $prd = $request->file('file');
        $filtype = $prd->getClientOriginalExtension();
        $filename = Auth::user()->name .'-'.time().'.'. $filtype;
        $request->file('file')->move('static/dist/img/',$filename);


        $prd = new Product();
        $prd->name = $request->name;
        $prd->slug = $request->slug;
        $prd->photo = 'static/dist/img/'.$filename;
        $prd->description = $request->description;
        $prd->stock = $request->stock;
        $prd->price = $request->price;
        $prd->category_id = $request->parent_id;
        $prd->user_id = Auth::user()->id;

        $prd->save();
        return redirect('admin/product')->with('success','Product Berhasil di Tambah!');
    }
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'slug' => 'required|unique:categories,slug,'.$id,
            'file' => 'mimes:jpeg,png,jpg,gif,JPG,JPEG|max:8048',
            'description' => 'required|max:2048',
            'stock' => 'required',
            'price' => 'required',
        ],[
            'name.required' => 'Tolong isi Namanya. ',
            'slug.required' => 'Tolong isi Slugnya. ',
            'description.required' => 'Tolong isi description. ',
            'stock.required' => 'Tolong isi Stok. ',
            'price.required' => 'Tolong isi Price. ',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('error', $validator->errors()->first() . ' Pastikan anda mengisi semua inputan.');
        }

        $prd = Product::find($id);
        if ($request->hasFile('file')) {
            $oldFile = public_path($prd->photo);
            if (File::exists($oldFile)) {
                File::delete($oldFile);
            }
            $prd = $request->file('file');
            $filtype = $prd->getClientOriginalExtension();
            $filename = Auth::user()->name .'-'.time().'.'. $filtype;
            $request->file('file')->move('static/dist/img/',$filename);
            $prd->photo = 'static/dist/img/'.$filename;
        }

        $prd->name = $request->name;
        $prd->slug = $request->slug;
        $prd->description = $request->description;
        $prd->stock = $request->stock;
        $prd->price = $request->price;
        $prd->category_id = $request->parent_id;

        $prd->save();
        return redirect('admin/product')->with('success','Product Berhasil di Update!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $file_path = public_path($product->photo); // ambe image dri file
        if (file_exists($file_path)) { // unlink ato hpus image seblmnya dri folder
            unlink($file_path);
        }
        $product->delete(); // delete data dri database
        return redirect()->back()->with('success', 'Product berhasil dihapus!');
    }

}
