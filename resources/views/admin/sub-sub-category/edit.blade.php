@extends('layouts.app')

@section('content')
    <section class="breadcrumb-section">
        <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
            <div class="content-header">
                <h3 class="content-header-title">Master</h3>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item">Manage Sub Sub Category</li>
                <li class="breadcrumb-item active">Edit Sub Sub Category</li>
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
                    <form action="{{ route('admin.sub-sub-category.update', $subSubCategory->id) }}" enctype="multipart/form-data" name="editsub_category" method="POST">
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
                        <select class="text-control" name="category" id="category_id">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" @if ($category->id == $subSubCategory->category_id) {{ 'selected' }} @endif>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label class="label-control">Sub Category</label>
                        <select class="text-control" name="sub_category" id="sub_category">
                        <option>Select Sub Category</option>
                            @foreach ($subCategories as $subCategory)
                                <option value="{{$subCategory->id}}" @if ($subCategory->id == $subSubCategory->sub_category_id) {{ 'selected' }} @endif>{{$subCategory->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label class="label-control">Sub Sub Category Icon</label>
                        <input type="file" name="icon" class="text-control">
                        <img src="{{asset('public/images/sub_sub_category_images/'.$subSubCategory->icon)}}" class="img-fluid" style="height: 30px;">
                        @if ($errors->has('icon'))
                            <span class="text-danger">
                                <span>{{ $errors->first('icon') }}</span>
                            </span>
                        @endif
                    </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="label-control">Sub Sub Category</label>
                    <input type="text" name="name" value="{{$subSubCategory->name}}" class="text-control" placeholder="Enter Category name">
                    </div>
                    <div class="col-sm-4">
                        <label class="label-control">Sub Sub Category URL</label>
                        <input type="text" name="slug" value="{{$subSubCategory->slug}}" class="text-control" placeholder="Enter Category Slug">
                    </div>
                    <div class="col-sm-4">
                        <label class="label-control">Short Description</label>
                        <textarea name="short_description" class="text-control" rows="2" cols="4" placeholder="Enter Short Description">{{$subSubCategory->short_description}}</textarea>
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
                        <input type="text" name="meta_title" value="{{$subSubCategory->meta_title}}" class="text-control" placeholder="Enter Meta Title">
                        <span class="noted-text">Keep your titles under 60 characters.</span>
                    </div>

                    <div class="col-sm-4">
                        <label class="label-control">Meta Description</label>
                        <textarea name="meta_description" class="text-control" rows="2" cols="4" placeholder="Enter Meta Description">{{$subSubCategory->meta_description}}</textarea>
                        <span class="noted-text">Keep your description upto 158 characters.</span>
                    </div>

                    <div class="col-sm-4">
                        <label class="label-control">Meta Keywords</label>
                        <textarea name="meta_keyword" class="text-control" rows="2" cols="4" placeholder="Enter Meta Description">{{$subSubCategory->meta_keyword}}</textarea>
                        <span class="noted-text">Keep your keywords from 100 to 255 characters</span>
                    </div>
                    </div>

                    <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <button class="btn btn-dark" type="submit">Update Sub Sub Category</button>
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
