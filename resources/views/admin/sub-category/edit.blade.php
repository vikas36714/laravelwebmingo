@extends('layouts.app')

@section('title', 'Page Title')

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
              <li class="breadcrumb-item active">Edit Sub Category</li>
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
              <div class="card-block">
                <form action="{{ route('admin.sub-category.update', $subCategory->id) }}" enctype="multipart/form-data" name="edit_category" method="POST">
                    @csrf
                <div class="form-group row">
                  <div class="col-sm-12">
                    <h3 class="h3-title">Basic Information</h3>
                  </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="label-control">Category</label>
                        <select class="text-control" name="category_id">
                          <option value="">Select Category</option>
                          @foreach ($categories as $category)
                            <option value="{{$category->id}}" @if ($category->id == $subCategory->category_id) {{ 'selected' }} @endif>{{$category->name}}</option>
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
                        <img src="{{asset('public/images/sub_category_images/'.$subCategory->sub_category_icon)}}" class="img-fluid" style="height: 30px;">
                        @if ($errors->has('sub_category_icon'))
                            <span class="text-danger">
                                <span>{{ $errors->first('sub_category_icon') }}</span>
                            </span>
                        @endif
                      </div>
                      <div class="col-sm-4">
                        <label class="label-control">Sub Category</label>
                        <input type="text" class="text-control" name="sub_category_name" value="{{$subCategory->sub_category_name}}">
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
                        <input type="text" class="text-control" name="sub_category_slug" value="{{$subCategory->sub_category_slug}}">
                      </div>
                      <div class="col-sm-4">
                        <label class="label-control">Short Description</label>
                        <textarea class="text-control" name="short_description" rows="2" cols="4" >{{$subCategory->short_description}}</textarea>
                      </div>

                      <div class="col-sm-4">
                        <label class="label-control">Features</label>
                        <div class="d-block">
                            <ul class="features-ul">
                                <li>
                                    <label class="label-features">
                                    <input type="checkbox" name="features[]" value="add_on_services_allowed" <?php if(in_array("add_on_services_allowed", $subCategory['features'])){ echo " checked=\"checked\""; } ?>> Add-On Services Allowed</label>

                                </li>
                                <li>
                                    <label class="label-features">
                                    <input type="checkbox" name="features[]" value="deals" <?php if(in_array("deals", $subCategory['features'])){ echo " checked=\"checked\""; } ?>> Deals</label>
                                </li>
                                <li>
                                    <label class="label-features">
                                    <input type="checkbox" name="features[]" value="edit_package_option"
                                     <?php if(in_array("edit_package_option", $subCategory['features'])){ echo " checked=\"checked\""; } ?>> Edit Package Option</label>
                                </li>
                            </ul>
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
                        <input type="text" class="text-control" name="meta_title" value="{{$subCategory->meta_title}}">
                        <span class="noted-text">Keep your titles under 60 characters.</span>
                      </div>

                      <div class="col-sm-4">
                        <label class="label-control">Meta Description</label>
                        <textarea class="text-control" name="meta_description" rows="2" cols="4">{{$subCategory->meta_description}}</textarea>
                        <span class="noted-text">Keep your description upto 158 characters.</span>
                      </div>

                      <div class="col-sm-4">
                        <label class="label-control">Meta Keywords</label>
                        <textarea class="text-control" name="meta_keyword" rows="2" cols="4">{{$subCategory->meta_keyword}}</textarea>
                        <span class="noted-text">Keep your keywords from 100 to 255 characters</span>
                      </div>
                    </div>

                <div class="form-group row">
                  <div class="col-sm-12 text-center">
                    <button class="btn btn-dark" type="submit">Update Sub Category</button>
                  </div>
                </div>
            </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
