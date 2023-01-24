@extends('admin.layout.master')
@section('header')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
@endsection
@section('body')
    <div class="container-fluid">
        <div class="card">
            <img class="card-img-top" src="" alt="">
            <div class="card-body">
                <h4 class="text-bold">Tambah Barang</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h1 class="card-title">Quick Example</h1>
                    </div>


                    <form action="{{ url('admin/category') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter Category" name="name">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Slug"
                                    name="slug">
                                @if ($errors->has('slug'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Icon</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Icon"
                                    name="icon">
                                @if ($errors->has('icon'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('icon') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Parent Category</label>
                                <select name="parent_id" id="" class="form-control">
                                    <option value="">Kategori Baru</option>
                                    @foreach ($categorys as $cg)
                                        <option value="{{ $cg->id }}">{{ $cg->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>


                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DataTable with default features</h3>
                    </div>

                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                        aria-describedby="example1_info">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending">
                                                    Category</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Platform(s): activate to sort column ascending">Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($categorys as $cg)
                                                <tr class="odd">
                                                    <td width="10px">{{ $i++ }}</td>
                                                    <td class="dtr-control sorting_1" tabindex="0"> {{ $cg->name }}
                                                        <ul>
                                                            @foreach ($cg->children as $subc)
                                                                <li>{{ $subc->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        <div class="row">
                                                            <div class="col-6 col-md-3">
                                                                <a href="{{ url('admin/category/' . $cg->id . '/edit') }}"
                                                                    class="btn btn-primary btn-xs">Edit</a>
                                                            </div>
                                                            <form action="{{ route('category.destroy', $cg->id) }}"
                                                                method="POST">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <input type="submit" class="btn btn-danger btn-xs"
                                                                    value="Delete">
                                                            </form>
                                                        </div>
                                                        @foreach ($cg->children as $sb)
                                                            <div class="row">
                                                                <div class="col-6 col-md-3">
                                                                    <a href="{{ url('admin/category/' . $sb->id . '/edit') }}"
                                                                        class="btn btn-primary btn-xs">Edit</a>
                                                                </div>
                                                                <form action="{{ route('category.destroy', $sb->id) }}"
                                                                    method="POST">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('DELETE') }}
                                                                    <input type="submit" class="btn btn-danger btn-xs"
                                                                        value="Delete">
                                                                </form>
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div><!-- /.container-fluid -->
@endsection
@section('footer')
@endsection
@show
