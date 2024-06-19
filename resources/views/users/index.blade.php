@extends('layouts.header')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Sub Admins</h1>
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
            <div class="card-header">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">
                    Add Sub Admin
                  </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body" delete-action="{{ route('subadmin.delete') }}">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th># </th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>User Type</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody class="render-tr">
                    @foreach ($users as $user)
                    <tr class="table-row">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$user->name??'-'}}</td>
                        <td>{{$user->email??'-'}}
                        </td>
                        <td>{{$user->user_type??'-'}}</td>
                        <td><button class="btn btn-app deleteRows" each-id={{$user->id}}>
                            <i class="fas fa-trash"></i> Delete
                        </button>
                        </td>
                      </tr>
                    @endforeach
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      @include('users.create')
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="{{asset('main.js')}}"></script>
@endsection

