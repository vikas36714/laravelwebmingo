@extends('layouts.app')

@section('content')

<section class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="content-header">
            <h3 class="content-header-title">Category</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item">Manage Category</li>
              <li class="breadcrumb-item active">Edit Category</li>
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
                <form action="{{ route('admin.category.update', $category->id) }}" enctype="multipart/form-data" name="edit_category" method="POST">
                    @csrf
                <div class="form-group row">
                  <div class="col-sm-12">
                    <h3 class="h3-title">Basic Information</h3>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Category Icon</label>
                    <input type="file" name="icon" class="text-control">
                    <img src="{{asset('public/images/category_images/'.$category->icon)}}" class="img-fluid" style="height: 30px;">
                    @if ($errors->has('icon'))
                        <span class="text-danger">
                            <span>{{ $errors->first('icon') }}</span>
                        </span>
                    @endif
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Category Name</label>
                    <input type="text" class="text-control" name="name" value="{{$category->name}}">
                    @if ($errors->has('name'))
                        <span class="text-danger">
                            <span>{{ $errors->first('name') }}</span>
                        </span>
                    @endif
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Category URL</label>
                    <input type="text" class="text-control" name="slug" value="{{$category->slug}}">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Short Description</label>
                    <textarea class="text-control" rows="2" name="short_description" cols="4">{{$category->short_description}}</textarea>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Reviews Title</label>
                    <input type="text" class="text-control" name="reviews_title" value="{{$category->reviews_title}}">
                    <span class="noted-text">This Title will be placed in category review tab</span> </div>
                  <div class="col-sm-4">
                    <label class="label-control">FAQ Title</label>
                    <input type="text" class="text-control" name="faq_title" value="{{$category->faq_title}}" placeholder="Enter FAQ Title">
                    <span class="noted-text">This Title will be placed in category faq tab</span> </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12">
                    <label class="label-control">About Your Category</label>
                    <textarea class="text-control" name="about_category" rows="4" cols="8" placeholder="Enter About Content">{{$category->about_category}}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12">
                    <h3 class="h3-title">How It Works</h3>
                  </div>
                </div>
                <div class="hiw-boxes">
                  <div class="block_op">
                      @foreach ($howItWorks as $key => $howItWork)
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="hiw-position">Position</label>
                            <input type="text" class="text-control" name="position[]" value="{{$howItWork->position}}">
                            </div>
                            <div class="col-sm-3">
                                <label for="hiw-title">Title</label>
                            <input type="text" class="text-control" name="title[]" value="{{$howItWork->title}}">
                            </div>
                            <div class="col-sm-5">
                                <label for="hiw-title">Description</label>
                            <input type="text" class="text-control" name="description[]" value="{{$howItWork->description}}">
                            </div>
                            @if($key == 0)
                            <span class="add_hiw"><i class="fa fa-plus"></i> Add</span>
                            @endif
                            @if($key != 0)
                            <span class="remove_hiw"><i class="fa fa-minus"></i> Remove</span>
                            @endif
                        </div>
                      @endforeach
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12 text-center">
                    <button class="btn btn-dark" type="submit">Update Category</button>
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
