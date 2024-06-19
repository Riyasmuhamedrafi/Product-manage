@extends('layouts.header')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Products</h1>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid redirect-loc" redirect-location = "{{route('product.index')}}">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-secondary">
                    <div class="card-header">
                      <h3 class="card-title">Product Add</h3>
                    </div>
                    <form id="productForm" save-product="{{route('product.store')}}" token={{csrf_token()}}>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">Name </label>
                                        <input type="text" name="name" class="form-control" id="name" oninput="this.value = this.value.replace(/[^a-zA-Z0-9\s]/g, '');" placeholder="Enter Name">
                                        <small id="nameError" class="form-text text-muted invalid-feedback">**Product Name is missing</small>
                                        <small id="nameFormatError" class="form-text text-muted invalid-feedback">**Name can only contain letters</small>
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
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Textarea</label>
                                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter ..."></textarea>
                                        <small id="descriptionError" class="form-text text-muted invalid-feedback">**Description is required</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="price">Price </label>
                                        <input type="text" name="price" class="form-control" id="price" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="10" placeholder="Enter price">
                                        <small id="priceError" class="form-text text-muted invalid-feedback">**Price is required</small>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="image">Images </label>
                                        <input type="file" name="images[]" class="form-control-file" id="image" placeholder="Select Images" multiple>
                                        <small id="imageError" class="form-text text-muted invalid-feedback">**Please select at least one image</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-secondary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </section>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{asset('product.js')}}"></script>
@endsection
