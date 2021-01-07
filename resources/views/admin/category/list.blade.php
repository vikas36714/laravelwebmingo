@extends('layouts.app')

@section('content')

    <section class="breadcrumb-section">
        <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
            <div class="content-header">
                <h3 class="content-header-title">Categories</h3>
                <button class="btn btn-dark btn-save" onclick="window.location.href='{{ route('admin.category.create') }}'"><i class="fas fa-plus"></i> Add Category</button>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item active">Manage Categories</li>
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
                    <table class="table table-bordered table-fitems" id="category-table">
                        <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Created at</th>
                            <th>Icon</th>
                            <th>Category</th>
                            <th>Sub Categories</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Updated at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            {{! $n=1 }}
                        @foreach ($categories as $key => $category)
                            <tr>
                                <td>{{$n++}}</td>
                                <td>{{$category->created_at}}</td>
                                <td><img src="{{asset('public/images/category_images/'.$category->icon)}}" class="img-fluid" style="height: 30px;"></td>
                                <td>{{$category->name}}</td>
                                <td><a href="#">{{$category->sub_category_total}}</a></td>
                                <td>{{$category->slug}}</td>
                                <td>
                                    <span @if ($category->status) class='badge badge-success' @else class='badge badge-secondary'@endif>{{$category->status ? 'Succcess' : 'Pending'}}
                                    </span>
                                </td>
                                <td>{{$category->updated_at}}</td>
                                <td>
                                    <ul class="action">
                                        <li><a href="{{ route('admin.category.edit', $category->id) }}">
                                            <i class="fas fa-pencil-alt"></i></a></li>
                                        <li><a href="#"><i class="fas fa-times"></i></a></li>
                                        <li><a onclick="return confirm('Are you sure ? want to delete this category.')" href="{{route('admin.category.destroy', $category->id) }}"><i class="fas fa-trash"></i></a></li>
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
@push('scripts')
    {{-- <script type="text/javascript">
        //-------------------- Manage pincode listing ----------------------//
        $(function () {
            var table = $('#category-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.pincode') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'state_name', name: 'state_name'},
                    {data: 'state_name', name: 'state_name'},
                    {data: 'city_name', name: 'city_name'},
                    {data: 'pincode', name: 'pincode'},
                    {data: 'status', name: 'status'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            });
        });
    </script> --}}
@endpush
