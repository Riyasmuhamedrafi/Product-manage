@extends('layouts.header')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dashboard</h1>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-box"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Products</span>
                  <span class="info-box-number">760</span>
                </div>
              </div>
            </div>
            @if (Auth::user()->user_type == 'admin')
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Sub Admins</span>
                    <span class="info-box-number">{{count($users)}}</span>
                  </div>
                </div>
              </div>
            </div>
            @endif
          </div>
    </div>
  </section>
@endsection

