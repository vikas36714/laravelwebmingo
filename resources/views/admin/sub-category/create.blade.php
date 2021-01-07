@extends('layouts.app')

@section('content')

<section class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="content-header">
            <h3 class="content-header-title">Sub Category</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item">Manage Sub Category</li>
              <li class="breadcrumb-item active">Add Sub Category</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="content-main-body">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
            <form action="{{ route('admin.sub-category.store') }}" enctype="multipart/form-data" name="sub-category" method="POST">
                    @csrf
                <div class="card-block">
                <div class="form-group row">
                  <div class="col-sm-12">
                    <h3 class="h3-title">Basic Information</h3>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Category</label>
                    <select class="text-control" name="category_id" id="category_id">
                      <option value="">Select Category</option>
                      @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('category_id'))
                        <span class="text-danger">
                            <span>{{ $errors->first('category_id') }}</span>
                        </span>
                    @endif
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Sub Category Icon</label>
                    <input type="file" class="text-control" name="sub_category_icon">
                    @if ($errors->has('sub_category_icon'))
                        <span class="text-danger">
                            <span>{{ $errors->first('sub_category_icon') }}</span>
                        </span>
                    @endif
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Sub Category</label>
                    <input type="text" class="text-control" name="sub_category_name" placeholder="Enter Category name">
                    @if ($errors->has('sub_category_name'))
                        <span class="text-danger">
                            <span>{{ $errors->first('sub_category_name') }}</span>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Sub Category URL</label>
                    <input type="text" class="text-control" name="sub_category_slug" placeholder="Enter Category Slug">
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Short Description</label>
                    <textarea class="text-control" name="short_description" rows="2" cols="4" placeholder="Enter Short Description"></textarea>
                  </div>

                  <div class="col-sm-4">
                    <label class="label-control">Features</label>
                    <div class="d-block">
                      <ul class="features-ul">
                       <li><label class="label-features"><input type="checkbox" name="features[]" value="add_on_services_allowed"> Add-On Services Allowed</label></li>
                       <li><label class="label-features"><input type="checkbox" name="features[]" value="deals"> Deals</label></li>
                       <li><label class="label-features"><input type="checkbox" name="features[]" value="edit_package_option"> Edit Package Option</label></li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                      <h3 class="h3-title">Servicable Pincode</h3>
                    </div>
                  </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                      <label class="label-control w-100">Pincode List
                          <div class="float-right">
                              <span>Filter By: </span>
                              <select id="state">
                                  <option value="">Select State</option>
                                  @foreach ($states as $state)
                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                  @endforeach
                              </select>
                               <select id="city">
                                <option value="">Select City</option>
                              </select>
                          </div>
                      </label>
                      <div id="pincodebox" name="pincodebox" class="scrollbox-pincode">
                          <!-- Servicable Pincode dynamic bind in <ul> tag-->
                          <ul id="pincodes">

                          </ul>
                          <div>
                              <a onclick="$('#pincodebox :checkbox').attr('checked', 'checked');" style="cursor: pointer;">
                                  <u>Select All</u>
                              </a> /
                              <a onclick="$('#pincodebox :checkbox').attr('checked', false);" style="cursor: pointer;">
                                  <u>Unselect All</u>
                              </a>
                          </div>
                        </div>
                    </div>
                  </div>


                <div class="form-group row">
                  <div class="col-sm-12">
                    <h3 class="h3-title">Meta Tags (Best for SEO)</h3>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Meta Title</label>
                    <input type="text" class="text-control" name="meta_title" placeholder="Enter Meta Title">
                    <span class="noted-text">Keep your titles under 60 characters.</span>
                  </div>

                  <div class="col-sm-4">
                    <label class="label-control">Meta Description</label>
                    <textarea class="text-control" name="meta_description" rows="2" cols="4" placeholder="Enter Meta Description"></textarea>
                    <span class="noted-text">Keep your description upto 158 characters.</span>
                  </div>

                  <div class="col-sm-4">
                    <label class="label-control">Meta Keywords</label>
                    <textarea class="text-control" name="meta_keyword" rows="2" cols="4" placeholder="Enter Meta Description"></textarea>
                    <span class="noted-text">Keep your keywords from 100 to 255 characters</span>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-12 text-center">
                    <button class="btn btn-dark" type="submit">Add Sub Category</button>
                  </div>
                </div>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

