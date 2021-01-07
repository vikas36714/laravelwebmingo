@extends('layouts.app')

@section('title', 'Page Title')

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
                <li class="breadcrumb-item active">Add Sub Sub Category</li>
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
                <form action="{{ route('admin.sub-sub-category.store') }}" enctype="multipart/form-data" name="sub-sub-category" method="POST">
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
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('category'))
                            <span class="text-danger">
                                <span>{{ $errors->first('category') }}</span>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-4">
                        <label class="label-control">Sub Category</label>
                        <!--Dynamic bind sub-category through category ID.-->
                        <select class="text-control" name="sub_category" id="sub_category">
                            <option value="">Select Sub Category</option>
                        </select>
                        @if ($errors->has('sub_category'))
                            <span class="text-danger">
                                <span>{{ $errors->first('sub_category') }}</span>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-4">
                        <label class="label-control">Sub Sub Category Icon</label>
                        <input type="file" name="icon" class="text-control">
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
                        <input type="text" name="name" class="text-control" placeholder="Enter Category name">
                        @if ($errors->has('name'))
                            <span class="text-danger">
                                <span>{{ $errors->first('name') }}</span>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-4">
                        <label class="label-control">Sub Sub Category URL</label>
                        <input type="text" name="slug" class="text-control" placeholder="Enter Category Slug">
                    </div>
                    <div class="col-sm-4">
                        <label class="label-control">Short Description</label>
                        <textarea class="text-control" name="short_description" rows="2" cols="4" placeholder="Enter Short Description"></textarea>
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
                        <input type="text" name="meta_title" class="text-control" placeholder="Enter Meta Title">
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
                        <button class="btn btn-dark" type="submit">Add Sub Sub Category</button>
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
