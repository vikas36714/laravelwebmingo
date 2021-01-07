@extends('layouts.app')

@section('content')

    <section class="breadcrumb-section">
        <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
            <div class="content-header">
                <h3 class="content-header-title">Master</h3>
            <button class="btn btn-dark btn-save" onclick="window.location.href='{{route('admin.sub-sub-category.create')}}'"><i class="fas fa-plus"></i> Add Sub Sub Category</button>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item active">Manage Sub Sub Category</li>
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
                @if (session('message'))
                <div class="alert alert-success" role="alert">
                {{ session('message') }}
                </div>
                @elseif(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
            <div class="card">
                <div class="card-body">
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
                            <th>Sub Sub</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Updated at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            {{! $n=1 }}
                            @foreach ($subSubCategories as $subSubCategory)
                                <tr>
                                <td>{{$n++}}</td>
                                <td>{{$subSubCategory->created_at}}</td>
                                <td><img src="{{asset('public/images/sub_sub_category_images/'.$subSubCategory->icon)}}" class="img-fluid" style="height: 30px;"></td>
                                <td>{{$subSubCategory->category_name}}</td>
                                <td>{{$subSubCategory->sub_category_name}}</td>
                                <td>{{$subSubCategory->name}}</td>
                                <td>{{$subSubCategory->slug}}</td>
                                <td><span @if ($subSubCategory->status) class='badge badge-success' @else class='badge badge-secondary'@endif>{{$subSubCategory->status ? 'Succcess' : 'Pending'}}
                                </span></td>
                                <td>{{$subSubCategory->updated_at}}</td>
                                <td><ul class="action">
                                    <li><a href="{{route('admin.sub-sub-category.edit',$subSubCategory->id)}}"><i class="fas fa-pencil-alt"></i></a></li>
                                    <li><a href="#"><i class="fas fa-times"></i></a></li>
                                    <li><a onclick="return confirm('Are you sure ? want to delete this sub sub category.')" href="{{route('admin.sub-sub-category.destroy', $subSubCategory->id) }}"><i class="fas fa-trash"></i></a></li>
                                </ul></td>
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
