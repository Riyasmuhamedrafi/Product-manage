@extends('products.productheader')

@section('content')
<section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Projects Detail</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
            <div class="row">
              <div class="col-12">
                  <div class="card card-primary">
                    <div class="card-header">
                      <h4 class="card-title">Product Images</h4>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        @foreach ($product->images as $key => $value)
                            <div class="col-sm-2">
                                <a href="{{asset('storage/images/'.$value->image)}}" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                                <img src="{{asset('storage/images/'.$value->image)}}" class="img-fluid mb-2" alt="white sample"/>
                                </a>
                            </div>
                        @endforeach

                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <h4>{{$product->name}}</h4>
                        <div class="post">
                          <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                            <span class="username">
                              <a href="#">{{$product->user->name??'-'}}</a>
                            </span>
                            <span class="description">created at: {{dateTimeFormat($product->created_at)}}</span>
                          </div>
                          <p>
                            {{$product->description}}
                          </p>

                          <p>
                            Price: {{$product->price}} ₹
                          </p>
                        </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
      </div>
    </div>
  </section>
@endsection
