@extends('layouts.app')

@section('content')

    <section class="breadcrumb-section">
        <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
            <div class="content-header">
                <h3 class="content-header-title">Sub Category</h3>
                <button class="btn btn-dark btn-save" onclick="window.location.href='{{route('admin.sub-category.create')}}'"><i class="fas fa-plus"></i> Add Sub Category</button>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item active">Manage Sub Category</li>
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
                    @if (session('message'))
                    <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                    </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                <div class="card-block">
                    <div class="table-responsive">
                    <table class="table table-bordered table-fitems">
                        <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Created at</th>
                            <th>Icon</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Updated at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{! $n=1 }}
                        @foreach ($subCategories as $subCategory)
                        <tr>
                            <td>{{$n++}}</td>
                            <td>{{$subCategory->created_at}}</td>
                            <td><img src="{{asset('public/images/sub_category_images/'.$subCategory->sub_category_icon)}}" class="img-fluid" style="height: 30px;"></td>
                            <td>{{$subCategory->category_name}}</td>
                            <td>{{$subCategory->sub_category_name}}</td>
                            <td>{{$subCategory->sub_category_slug}}</td>
                            <td>
                                <span @if ($subCategory->status) class='badge badge-success' @else class='badge badge-secondary'@endif>{{$subCategory->status ? 'Succcess' : 'Pending'}}
                                </span>
                            </td>
                            <td>{{$subCategory->updated_at}}</td>
                            <td>
                                <ul class="action">
                                    <li><a href="{{ route('admin.sub-category.edit', $subCategory->id) }}">
                                        <i class="fas fa-pencil-alt"></i></a></li>
                                    <li><a href="#"><i class="fas fa-times"></i></a></li>
                                    <li><a onclick="return confirm('Are you sure ? want to delete this sub category.')" href="{{route('admin.sub-category.destroy', $subCategory->id) }}"><i class="fas fa-trash"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>

@endsection
