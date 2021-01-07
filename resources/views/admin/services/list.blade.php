@extends('layouts.app')

@section('content')

<section class="breadcrumb-section">
	<div class="container">
		<div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="content-header">
			<h3 class="content-header-title">Master</h3>
			<button class="btn btn-dark btn-save" data-target="#add-service" data-toggle="modal"><i class="fas fa-plus"></i> Add Service</button>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
				<li class="breadcrumb-item">Master</li>
				<li class="breadcrumb-item active">Manage Services</li>
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
            <span class="success"></span>
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
						<th>Service</th>
						<th>Amount</th>
						<th>Status</th>
						<th>Updated at</th>
						<th>Action</th>
						</tr>
					</thead>
					<tbody>
                        {{! $n=1 }}
                        @foreach ($services as $service)
                            <tr>
                            <td>{{$n++}}</td>
                            <td>{{$service->created_at}}</td>
                            <td>{{$service->category_name}}</td>
                            <td>{{$service->sub_category_name}}</td>
                            <td>{{$service->sub_sub_category_name}}</td>
                            <td>{{$service->name}}</td>
                            <td><i class="fas fa-rupee-sign"></i>{{$service->amount}}</td>
                            <td>
                                <span @if ($service->status) class='badge badge-success' @else class='badge badge-secondary'@endif>{{$service->status ? 'Succcess' : 'Pending'}}
                                </span>
                            </td>
                            <td>{{$service->created_at}}</td>
                            <td><ul class="action">
                            <li><a href="#" data-target="#edit-service" data-id="{{$service->id}}" id="edit_service" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a></li>
                                <li><a href="#"><i class="fas fa-times"></i></a></li>
                                <li><a onclick="return confirm('Are you sure ? want to delete this sub sub category.')" href="{{route('admin.services.destroy', $service->id) }}" ><i class="fas fa-trash"></i></a></li>
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

	<div class="modal" id="add-service">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Add Service</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<form action="{{ route('admin.services.store') }}" enctype="multipart/form-data" name="services" method="POST">
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
                                <label class="label-control">Sub Sub Category <span class="required">*</span></label>
                                <!--Dynamic bind sub-sub-category through sub-category ID.-->
								<select class="text-control" name="sub_sub_category" id="sub_sub_category">
									<option value="">Select Sub Sub Category</option>
                                </select>
							</div>
						</div>


						<div class="form-group row">
							<div class="col-sm-4">
								<label class="label-control">Service Name <span class="required">*</span></label>
                                <input type="text" name="name" class="text-control" placeholder="Enter Service Name">
                                @if ($errors->has('name'))
                                    <span class="text-danger">
                                        <span>{{ $errors->first('name') }}</span>
                                    </span>
                                @endif
							</div>
							<div class="col-sm-4">
								<label class="label-control">Service MRP <span class="required">*</span></label>
                                <input type="number" name="amount" id="amount" class="text-control" placeholder="Enter Service MRP">
                                @if ($errors->has('amount'))
                                    <span class="text-danger">
                                        <span>{{ $errors->first('amount') }}</span>
                                    </span>
                                @endif
							</div>
							<div class="col-sm-4">
								<label class="label-control">Service Discount <span class="required">*</span></label>
                                <input type="number" name="discount" id="discount" class="text-control" placeholder="Enter Service Discount">
                                @if ($errors->has('discount'))
                                    <span class="text-danger">
                                        <span>{{ $errors->first('discount') }}</span>
                                    </span>
                                @endif
								<span class="noted-text">Discount should be in % (If any)</span>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-sm-4">
								<label class="label-control">Service After Discount <span class="required">*</span></label>
                                <input type="text" name="after_discount2" id="after_discount2" class="text-control" disabled />
                                <div id="after_discount"></div>
                                @if ($errors->has('after_discount'))
                                    <span class="text-danger">
                                        <span>{{ $errors->first('after_discount') }}</span>
                                    </span>
                                @endif
							</div>
						</div>

						<div class="form-action row modal-footer">
							<div class="col-sm-12 text-center">
								<button class="btn btn-dark btn-save" type="submit">Add Service</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal" id="edit-service">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Edit Service</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<form>
						<div class="form-group row">
							<div class="col-sm-4">
                                <label class="label-control">Category <span class="required">*</span></label>
                                <!-- Dynamic binding category using ajax -->
								<select class="text-control" name="category" id="edit_category">

                                </select>

							</div>
							<div class="col-sm-4">
								<label class="label-control">Sub Category <span class="required">*</span></label>
								<select class="text-control" name="sub_category" id="edit_sub_category">
									{{-- <option>Select Sub Category</option> --}}
								</select>
							</div>
							<div class="col-sm-4">
								<label class="label-control">Sub Sub Category <span class="required">*</span></label>
								<select class="text-control" name="sub_sub_category" id="edit_sub_sub_category">
									{{-- <option>Select Sub Sub Category</option> --}}
								</select>
							</div>
						</div>


						<div class="form-group row">
							<div class="col-sm-4">
								<label class="label-control">Service Name <span class="required">*</span></label>
                                <input type="text" class="text-control" name="name" id="edit_name" placeholder="Enter Service Name">

							</div>
							<div class="col-sm-4">
								<label class="label-control">Service MRP <span class="required">*</span></label>
                                <input type="number" class="text-control" name="amount" id="edit_amount" placeholder="Enter Service MRP">

							</div>
							<div class="col-sm-4">
								<label class="label-control">Service Discount <span class="required">*</span></label>
								<input type="number" class="text-control" name="discount" id="edit_discount" placeholder="Enter Service Discount">
								<span class="noted-text">Discount should be in % (If any)</span>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-sm-4">
								<label class="label-control">Service After Discount <span class="required">*</span></label>
                                <input type="text" id="edit_after_discount_old" name="edit_after_discount_old" class="text-control" disabled>
                                <div id="edit_after_discount"></div>
							</div>
						</div>

						<div class="form-action row modal-footer">
							<div class="col-sm-12 text-center">
                                <input type="hidden"  id="service_id" class="text-control">
								<button class="btn btn-dark btn-save" id="update_service_button" type="submit">Update Service</button>
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
            //$("#sub_category").html('');
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
            //$("#sub_sub_category").html('');
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
