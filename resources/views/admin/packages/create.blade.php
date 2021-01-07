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
              <li class="breadcrumb-item">Manage Packages</li>
              <li class="breadcrumb-item active">Add Package</li>
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
                <form action="{{ route('admin.packages.store') }}" enctype="multipart/form-data" name="packages" method="POST">
                    @csrf
                <div class="form-group row">
                  <div class="col-sm-12">
                    <h3 class="h3-title">Basic Information</h3>
                  </div>
                </div>
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
                    <label class="label-control">Package Category <span class="required">*</span></label>
                    <select class="text-control" name="package_category" id="package_category_id">
                        <option value="">Select Package Category</option>
                    </select>
                    @if ($errors->has('package_category'))
                        <span class="text-danger">
                            <span>{{ $errors->first('package_category') }}</span>
                        </span>
                    @endif
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Package Name <span class="required">*</span></label>
                    <input type="text" class="text-control" name="package_name" placeholder="Enter Package Name">
                    @if ($errors->has('package_name'))
                        <span class="text-danger">
                            <span>{{ $errors->first('package_name') }}</span>
                        </span>
                    @endif
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Package Video <span class="optional">(Optional)</span></label>
                    <input type="text" class="text-control" name="video" placeholder="Enter Youtube URL">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-8">
                    <label class="label-control">Services Includes <span class="required">*</span></label>
                    <div class="d-block">
                      <ul class="features-ul" id="services">
                          {{-- @foreach ($services as $service)
                            <li><label class="label-control"><input type="checkbox" name="services[]" value="{{$service->amount}}" class="services"> {{$service->name}}</label></li>
                          @endforeach --}}
                        </ul>
                        @if ($errors->has('services'))
                            <span class="text-danger">
                                <span>{{ $errors->first('services') }}</span>
                            </span>
                        @endif
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <label class="label-control">Package Gallery <span class="optional">(Optional)</span></label>
                    <input type="file" name="gallery_images[]" class="text-control" multiple>
                    <span class="noted-text">Upload Multiple Images by Pressing CTRL + Select</span>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Package MRP</label>
                    <input type="number" name="totalAmount" id="totalAmount" class="text-control" disabled placeholder="Enter Package MRP">
                    <div id="totalAmount2"></div>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Package Discount (%) <span class="required">*</span></label>
                    <input type="number" name="package_discount" id="package_discount" class="text-control" placeholder="Enter in %">
                    {{-- <input type="number" name="discount" id="discount" class="text-control" placeholder="Enter in %"> --}}
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Package After Discount <span class="required">*</span></label>
                    <input type="text" name="after_discount2" id="after_discount2" class="text-control" disabled >
                    <div id="after_discount"></div>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-12">
                    <label class="label-control">About Package</label>
                    <textarea class="text-control" name="about_package" rows="2" cols="4" placeholder="Enter Package Content"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12 text-center">
                    <button class="btn btn-dark" type="submit">Add Package</button>
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
