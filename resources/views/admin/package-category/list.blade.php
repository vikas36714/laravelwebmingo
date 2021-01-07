@extends('layouts.app')

@section('content')

<section class="breadcrumb-section">
	<div class="container">
		<div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="content-header">
			<h3 class="content-header-title">Package Category</h3>
			<button class="btn btn-dark btn-save" data-target="#add-package-category" data-toggle="modal"><i class="fas fa-plus"></i> Add Package Category</button>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
				<li class="breadcrumb-item">Master</li>
				<li class="breadcrumb-item active">Manage Package Category</li>
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
						<th>Category</th>
						<th>Sub Category</th>
						<th>Sub Sub</th>
						<th>Package Category</th>
						<th>Status</th>
						<th>Updated at</th>
						<th>Action</th>
						</tr>
					</thead>
					<tbody>
                        {{! $n=1 }}
                        @foreach ($packageCategories as $packageCategory)
                            <tr>
                            <td>{{$n++}}</td>
                            <td>{{$packageCategory->created_at}}</td>
                            <td>{{$packageCategory->category_name}}</td>
                            <td>{{$packageCategory->sub_category_name}}</td>
                            <td>{{$packageCategory->sub_sub_category_name}}</td>
                            <td>{{$packageCategory->package_category}}</td>
                            <td>
                                <span @if ($packageCategory->status) class='badge badge-success' @else class='badge badge-secondary'@endif>{{$packageCategory->status ? 'Succcess' : 'Pending'}}
                                </span>
                            </td>
                            <td>{{$packageCategory->updated_at}}</td>
                            <td><ul class="action">
                                <li><a href="#" data-target="#edit-package-category" data-id="{{$packageCategory->id}}" id="edit_package_category_btn" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a></li>
                                <li><a href="#"><i class="fas fa-times"></i></a></li>
                                <li><a onclick="return confirm('Are you sure ? want to delete this Package Category.')" href="{{route('admin.package-category.destroy', $packageCategory->id) }}"><i class="fas fa-trash"></i></a></li>
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

	<div class="modal" id="add-package-category">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Add Package Category</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<form action="{{ route('admin.package-category.store') }}" enctype="multipart/form-data" name="package_category_form" method="POST">
                        @csrf
						<div class="form-group row">
							<div class="col-sm-4">
								<label class="label-control">Category <span class="required">*</span></label>
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
								<label class="label-control">Sub Category <span class="required">*</span></label>
								<select class="text-control" name="sub_category" id="sub_category">
									<option>Select Sub Category</option>
                                </select>
                                @if ($errors->has('sub_category'))
                                    <span class="text-danger">
                                        <span>{{ $errors->first('sub_category') }}</span>
                                    </span>
                                @endif
							</div>
							<div class="col-sm-4">
								<label class="label-control">Sub Sub Category <span class="optional">(Optional)</span></label>
								<select class="text-control" name="sub_sub_category" id="sub_sub_category">
									<option>Select Sub Sub Category</option>
								</select>
							</div>
						</div>

						<div class="form-group row justify-content-center">
							<div class="col-sm-6">
								<label class="label-control">Package Category <span class="required">*</span></label>
                                <input class="text-control" name="package_category" type="text" placeholder="Enter Package Category">
                                @if ($errors->has('package_category'))
                                    <span class="text-danger">
                                        <span>{{ $errors->first('package_category') }}</span>
                                    </span>
                                @endif
							</div>
						</div>

						<div class="form-action row modal-footer">
							<div class="col-sm-12 text-center">
								<button class="btn btn-dark btn-save" type="submit">Add Package Category</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal" id="edit-package-category">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Edit Package Category</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<form action="{{ url('admin/dashboard/package-category/edit') }}" enctype="multipart/form-data" name="package_category_form" method="POST">
                        @csrf
						<div class="form-group row">
							<div class="col-sm-4">
								<label class="label-control">Category <span class="required">*</span></label>
								<select class="text-control" name="category" id="edit_category">
									<option value="">Select Category</option>
                                </select>
                                @if ($errors->has('category'))
                                    <span class="text-danger">
                                        <span>{{ $errors->first('category') }}</span>
                                    </span>
                                @endif
							</div>
							<div class="col-sm-4">
								<label class="label-control">Sub Category <span class="required">*</span></label>
								<select class="text-control" name="sub_category" id="edit_sub_category">
									<option value="">Select Sub Category</option>
                                </select>
                                @if ($errors->has('sub_category'))
                                    <span class="text-danger">
                                        <span>{{ $errors->first('sub_category') }}</span>
                                    </span>
                                @endif
							</div>
							<div class="col-sm-4">
								<label class="label-control">Sub Sub Category <span class="optional">(Optional)</span></label>
								<select class="text-control" name="sub_sub_category" id="edit_sub_sub_category">
									<option value="">Select Sub Sub Category</option>
                                </select>
                                @if ($errors->has('sub_sub_category'))
                                    <span class="text-danger">
                                        <span>{{ $errors->first('sub_sub_category') }}</span>
                                    </span>
                                @endif
							</div>
						</div>

						<div class="form-group row justify-content-center">
							<div class="col-sm-6">
								<label class="label-control">Package Category <span class="required">*</span></label>
                                <input type="text" class="text-control" id="edit_package_category" name="package_category" placeholder="Enter Package Category">
                                @if ($errors->has('package_category'))
                                    <span class="text-danger">
                                        <span>{{ $errors->first('package_category') }}</span>
                                    </span>
                                @endif
							</div>
						</div>

						<div class="form-action row modal-footer">
							<div class="col-sm-12 text-center">
                                <input type="hidden" id="package_category_id" name="package_category_id">
								<button class="btn btn-dark btn-save" type="submit">Update Package Category</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

@endsection
@push('scripts')
    <script type="text/javascript">
        //-------------------- Get Sub-Categories By Category ID. --------------------//

        $('#edit_category').on('change', function() {
            var category_id = this.value;
            $("#edit_sub_category").html('');
            $.ajax({
                url:"{{route('admin.sub-sub-category.getSubCategoriesByCategoryId')}}",
                type: "POST",
                data: {
                    category_id : category_id,
                    _token: '{{csrf_token()}}',
                },
                dataType : 'json',
                success: function(result){
                    $('#edit_sub_category').html('<option value="">Select Sub Category</option>');
                    $.each(result,function(key,res){
                        $("#edit_sub_category").append('<option value="'+res.id+'">'+res.sub_category_name+'</option>');
                    });
                }
            });
        });

        //-------------------- Get Sub-Sub-Categories By sub Category ID. --------------------//

        $('#edit_sub_category').on('change', function() {
            var sub_category_id = this.value;
            $("#edit_sub_sub_category").html('');
            $.ajax({
                url:"{{route('admin.services.get-sub-sub-categories-by-subCategoryId')}}",
                type: "POST",
                data: {
                    sub_category_id : sub_category_id,
                    _token: '{{csrf_token()}}',
                },
                dataType : 'json',
                success: function(result){
                    $('#edit_sub_sub_category').html('<option value="">Select Sub Category</option>');
                    $.each(result,function(key,res){
                        $("#edit_sub_sub_category").append('<option value="'+res.id+'">'+res.name+'</option>');
                    });
                }
            });
        });
    </script>
@endpush
