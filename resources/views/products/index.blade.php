@extends('layouts.header')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Products</h1>
        </div>
        {{-- <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">DataTables</li>
          </ol>
        </div> --}}
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header" id="bulk-delete" delete-product= {{route('bulkdelete')}} token={{csrf_token()}} redirect-loc = {{route('product.index')}}>
                <div class="row">
                    <div class="col-4">
                        <a href="{{route('product.create')}}" class="btn btn-info btn-sm btn-flat">
                            <i class="fa fa-plus"></i> Add Products
                        </a>
                    </div>
                    <div class="col-4">
                        <form action="{{ route('bulk.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex align-items-center">
                                <input type="file" name="file" class="form-control me-2">
                                <button class="btn btn-success btn-sm btn-flat">
                                    <i class="fa fa-file"></i> Import
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-4">
                        <a href="{{route('bulk.export')}}" class="btn btn-success btn-sm btn-flat"><i class="fa fa-upload"></i> Sample Export</a>
                    </div>

                </div>
                <div class="row">

                    <div class="col-12">
                        <form action="{{ route('search') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>choose</label>
                                        <input type="date" id="birthday" class="form-control me-2" name="created_at">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Select</label>
                                        <select class="form-control" name="status" id="status">
                                          <option value="1">Active</option>
                                          <option value="0">InActive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-secondary">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body" delete-action="{{ route('subadmin.delete') }}">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th></th>
                  <th># </th>
                  <th>Owner</th>
                  <th>Product Code</th>
                  <th>Product Name</th>
                  <th>Product Description</th>
                  <th>Product Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody class="render-tr">
                    @foreach ($products as $product)
                    <tr class="table-row">
                        <td>{{$product->id}}</td>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$product->user?$product->user->name:'-'}}</td>
                        <td>{{ $product->p_code }}</td>
                        <td>{{$product->name??'-'}}</td>
                        <td>{{$product->description??'-'}}</td>
                        <td>{{($product->status==1)?'Active':'Inactive'}}</td>
                        <td>
                            @can('view product')
                            <a href="{{route('product.show',['product'=>$product])}}" class="btn btn-app"><i class="fas fa-eye"></i> View</a>
                            @endcan
                            @if ($product->user_id == auth()->user()->id || auth()->user()->hasRole('admin'))
                            <a href="{{route('product.edit',['product'=>$product])}}" class="btn btn-app"><i class="fas fa-edit"></i> Edit</a>
                            @endif
                            {{-- @can('delete product')
                            <form action="{{ route('product.destroy',$product->id) }}" method="POST" id="deleteForm{{ $product->id }}">
                                @csrf
                                @method('DELETE')
                                <a href="" class="btn btn-app" onclick="event.preventDefault(); if (confirm('Do you really want to delete this product?')) { document.getElementById('deleteForm{{ $product->id }}').submit(); }"><i class="fas fa-trash"></i> Delete</a>

                            </form>
                            @endcan --}}
                            @if ($product->user_id == auth()->user()->id || auth()->user()->hasRole('admin'))

                            <form action="{{ route('product.destroy',$product->id) }}" method="POST" id="deleteForm{{ $product->id }}">
                                @csrf
                                @method('DELETE')
                                <a href="" class="btn btn-app" onclick="event.preventDefault(); if (confirm('Do you really want to delete this product?')) { document.getElementById('deleteForm{{ $product->id }}').submit(); }"><i class="fas fa-trash"></i> Delete</a>
                                {{-- <a href="#" lass="btn btn-app" onclick="event.preventDefault(); if (confirm('Do you really want to delete this product?')) { document.getElementById('deleteForm{{ $category->id }}').submit(); }"><i class="fas fa-trash"></i> Delete</a> --}}
                            </form>
                            @endif


                        </td>
                      </tr>
                    @endforeach
              </table>
              <button class="btn btn-primary" id="delete-btn">Bulk Delete</button>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

