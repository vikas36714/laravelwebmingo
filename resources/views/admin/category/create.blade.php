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
                <li class="breadcrumb-item active">Add Category</li>
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
                @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
                @endif
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.category.store') }}" enctype="multipart/form-data" name="category" method="POST">
                        @csrf
                        <div class="card-block">
                            <div class="form-group row">
                            <div class="col-sm-12">
                                <h3 class="h3-title">Basic Information</h3>
                            </div>
                            </div>
                            <div class="form-group row">
                            <div class="col-sm-4">
                                <label class="label-control">Category Icon</label>
                                <input type="file" name="icon" class="text-control">
                                @if ($errors->has('icon'))
                                    <span class="text-danger">
                                        <span>{{ $errors->first('icon') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-4">
                                <label class="label-control">Category Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="text-control" placeholder="Enter Category name">
                                @if ($errors->has('name'))
                                    <span class="text-danger">
                                        <span>{{ $errors->first('name') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-4">
                                <label class="label-control">Category URL</label>
                                <input type="text" name="slug" value="{{ old('slug') }}" class="text-control" placeholder="Enter Category Slug">
                                 @if ($errors->has('slug'))
                                    <span class="text-danger">
                                        <span>{{ $errors->first('slug') }}</span>
                                    </span>
                                @endif
                            </div>
                            </div>
                            <div class="form-group row">
                            <div class="col-sm-4">
                                <label class="label-control">Short Description</label>
                                <textarea name="short_description" value="{{ old('short_description') }}" class="text-control" rows="2" cols="4" placeholder="Enter Short Description"></textarea>
                                {{-- @if ($errors->has('short_description'))
                                    <span class="text-danger">
                                        <span>{{ $errors->first('short_description') }}</span>
                                    </span>
                                @endif --}}
                            </div>
                            <div class="col-sm-4">
                                <label class="label-control">Reviews Title</label>
                                <input type="text" name="reviews_title"  value="{{ old('reviews_title') }}" class="text-control" value="Beauticians" placeholder="Enter Reviews Title">
                                <span class="noted-text">This Title will be placed in category review tab</span>
                                {{-- @if ($errors->has('reviews_title'))
                                    <span class="text-danger">
                                        <span>{{ $errors->first('reviews_title') }}</span>
                                    </span>
                                @endif --}}
                            </div>
                            <div class="col-sm-4">
                                <label class="label-control">FAQ Title</label>
                                <input type="text" name="faq_title" value="{{ old('faq_title') }}" class="text-control" value="FAQ's" placeholder="Enter FAQ Title">
                                <span class="noted-text">This Title will be placed in category faq tab</span>
                                {{-- @if ($errors->has('faq_title'))
                                    <span class="text-danger">
                                        <span>{{ $errors->first('faq_title') }}</span>
                                    </span>
                                @endif --}}
                            </div>
                            </div>
                            <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="label-control">About Your Category</label>
                                <textarea name="about_category" class="text-control" rows="4" cols="8" placeholder="Enter About Content"></textarea>
                                {{-- @if ($errors->has('about_category'))
                                    <span class="text-danger">
                                        <span>{{ $errors->first('about_category') }}</span>
                                    </span>
                                @endif --}}
                            </div>
                            </div>
                            <div class="form-group row">
                            <div class="col-sm-12">
                                <h3 class="h3-title">How It Works</h3>
                            </div>
                            </div>
                            <div class="hiw-boxes">
                            <div class="block_op">
                                <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="hiw-position">Position</label>
                                    <input type="text" name="position[]" class="text-control" value="1" placeholder="Enter Position">
                                    @if ($errors->has('position'))
                                        <span class="text-danger">
                                            <span>{{ $errors->first('position') }}</span>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-3">
                                    <label for="hiw-title">Title</label>
                                    <input type="text" name="title[]" class="text-control" value="Choose a Salon service" placeholder="Enter Title">
                                    @if ($errors->has('title'))
                                    <span class="text-danger">
                                            <span>{{ $errors->first('title') }}</span>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-5">
                                    <label for="hiw-title">Description</label>
                                    <input type="text" name="description[]" class="text-control" value="Select from various salon packages & services" placeholder="Enter description">
                                    @if ($errors->has('description'))
                                    <span class="text-danger">
                                            <span>{{ $errors->first('description') }}</span>
                                        </span>
                                    @endif
                                </div>
                                <span class="add_hiw"><i class="fa fa-plus"></i> Add</span> </div>
                            </div>
                            </div>
                            <div class="form-group row">
                            <div class="col-sm-12 text-center">
                                <button class="btn btn-dark" type="submit">Add Category</button>
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
