@extends('admin.layout.master')
@section('header')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
@endsection
@section('body')
    <div class="container-fluid">
        <div class="card">
            <img class="card-img-top" src="holder.js/100x180/" alt="">
            <div class="card-body">
                <h4 class="text-bold">Edit Product</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="{{ url('admin/product/' . $prd->id) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter Product Name" name="name" value="{{ old('name', $prd->name) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter Product Slug" name="slug" value="{{ old('slug', $prd->slug) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description</label>
                                <textarea class="form-control" id="exampleInputEmail1" placeholder="Enter Product Description" name="description">{{ old('description', $prd->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Stock</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter Product Stock" name="stock"
                                    value="{{ old('stock', $prd->stock) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter Product Price" name="price"
                                    value="{{ old('price', $prd->price) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Parent Category</label>
                                <select name="parent_id" id="" class="form-control">
                                    <option value="">Kategori Baru</option>
                                    @foreach ($cg as $cg)
                                        <option value="{{ $cg->id }}"
                                            {{ old('parent_id', $prd->category_id) == $cg->id ? 'selected' : '' }}>
                                            {{ $cg->name }}</option>
                                        @foreach ($cg->children as $cil)
                                            <option
                                                value="{{ $cil->id }}"{{ old('parent_id', $cil->category_id) == $cil->id ? 'selected' : '' }}>
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Photo</label>
                                <input type="file" class="form-control" id="exampleInputEmail1" name="file">
                                @if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif
                                <br>
                                <img src="{{ asset($prd->photo) }}" width="200">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
@endsection
@show
