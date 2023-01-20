@extends('admin.layout.master')
@section('header')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
@endsection
@section('body')
    <div class="container-fluid">
        <div class="card">
            <img class="card-img-top" src="holder.js/100x180/" alt="">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10 d-flex align-items-center">
                        {{-- <div class="d-flex align-items-center"> --}}
                            <h4 class="card-title">Edit</h4>
                        {{-- </div> --}}
                    </div>
                    <div class="col-md-2">
                        <div class="d-flex justify-content-end">
                            <a href="{{ url('admin/category') }}"><button class="btn btn-primary">kemabali</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Quick Example</h3>
                    </div>


                    <form action="{{ route('category.update',$cg->id) }}" method="POST">
                        {{ method_field('PUT') }}
                        {{ @csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter Category" name="name" value="{{ $cg->name }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Slug"
                                    name="slug" value="{{ $cg->slug }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Icon</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Icon"
                                    name="icon" value="{{ $cg->icon }}">
                            </div>
                            <div class="form-group">
                                @if ($cg->parent_id == null)
                                <input type="hidden" name="parent_id" value="">
                                @else
                                <label for="exampleInputPassword1">Parent Category</label>
                                    <select name="parent_id" id="" class="form-control">
                                        @foreach ($scg as $ct)
                                            <option value="{{ $ct->id }}" @if ($ct->id == $cg->parent_id)selected="selected" @endif>{{ $ct->name }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /.container-fluid -->
@endsection
@section('footer')
@endsection
@show
