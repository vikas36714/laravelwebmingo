@extends('layouts.app')

@section('content')

<section class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="content-header">
            <h3 class="content-header-title">Vendors</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item">Manage Vendors</li>
              <li class="breadcrumb-item active">Vendor Registration</li>
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
                <form action="{{ route('admin.vendor.store') }}" enctype="multipart/form-data" name="vendor_add_form" method="POST">
                    @csrf
                <div class="form-group row">
                  <div class="col-sm-12">
                    <h3 class="h3-title">Basic Information</h3>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">First name</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" class="text-control" placeholder="Enter First Name">
                    @if ($errors->has('first_name'))
                        <span class="text-danger">
                            <span>{{ $errors->first('first_name') }}</span>
                        </span>
                    @endif
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Last name</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" class="text-control" placeholder="Enter Last Name">
                    @if ($errors->has('last_name'))
                        <span class="text-danger">
                            <span>{{ $errors->first('last_name') }}</span>
                        </span>
                    @endif
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Business Type</label>
                    <select name="business_type" class="text-control" id="businesstype">
                      <option value="">Select Type</option>
                      <option value="1">Proprietor</option>
                      <option value="2">Private Limited</option>
                      <option value="3">LLP / LLC</option>
                      <option value="4">Partnership</option>
                      <option value="5">Others</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Email Id</label>
                    <input type="text" name="email" value="{{ old('email') }}" class="text-control" placeholder="Enter Email Id">
                    @if ($errors->has('email'))
                        <span class="text-danger">
                            <span>{{ $errors->first('email') }}</span>
                        </span>
                    @endif
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Website</label>
                    <input type="text" name="website" value="{{ old('website') }}" class="text-control" placeholder="Enter Website">
                  </div>

                  <div class="col-sm-4">
                    <label class="label-control">Referral ID</label>
                    <input type="text" name="referral_id" value="{{ old('referral_id') }}" class="text-control" placeholder="Enter Referral Mobile No.">
                    <span class="text-danger noted-text">Referral Name: User </span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Country</label>
                    <select name="country" class="text-control" id="country">
                      <option value="">Select Country</option>
                      @foreach ($countries as $country)
                        <option value="{{$country->id}}">{{$country->name}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('country'))
                        <span class="text-danger">
                            <span>{{ $errors->first('country') }}</span>
                        </span>
                    @endif
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">State</label>
                    <select name="state" class="text-control" id="state">
                      <option value="">Select State</option>
                    </select>
                    @if ($errors->has('state'))
                        <span class="text-danger">
                            <span>{{ $errors->first('state') }}</span>
                        </span>
                    @endif
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">City</label>
                    <select name="city" class="text-control" id="city">
                      <option value="">Select City</option>
                    </select>
                    @if ($errors->has('city'))
                        <span class="text-danger">
                            <span>{{ $errors->first('city') }}</span>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-8">
                    <label class="label-control">Full Address</label>
                    <input type="text" name="full_address" value="{{ old('full_address') }}" class="text-control" placeholder="Enter Full Address">
                    @if ($errors->has('full_address'))
                        <span class="text-danger">
                            <span>{{ $errors->first('full_address') }}</span>
                        </span>
                    @endif
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Pincode</label>
                    <input type="number" name="pincode" value="{{ old('pincode') }}" class="text-control" placeholder="Enter Pincode">
                    @if ($errors->has('pincode'))
                        <span class="text-danger">
                            <span>{{ $errors->first('pincode') }}</span>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12">
                    <h3 class="title-con">Documents</h3>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">PAN Card No.</label>
                    <input type="text" name="pan_card_number" value="{{ old('pan_card_number') }}" class="text-control" placeholder="Enter PAN Card No.">
                    @if ($errors->has('pan_card_number'))
                        <span class="text-danger">
                            <span>{{ $errors->first('pan_card_number') }}</span>
                        </span>
                    @endif
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">PAN CARD Document</label>
                    <input type="file" name="pan_card_document" value="{{ old('pan_card_document') }}" class="text-control">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Aadhaar Card No.</label>
                    <input type="text" name="aadhaar_card_number" value="{{ old('aadhaar_card_number') }}" class="text-control" placeholder="Enter Aadhaar Card No.">
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Aadhaar Card (Front)</label>
                    <input type="file" name="aadhaar_card_front_img" value="{{ old('aadhaar_card_front_img') }}" class="text-control">
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Aadhaar Card (Back)</label>
                    <input type="file" name="aadhaar_card_back_img" value="{{ old('aadhaar_card_back_img') }}" class="text-control">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Business Proof No.</label>
                    <input type="text" name="business_proof_number" value="{{ old('business_proof_number') }}" class="text-control" placeholder="Enter Business Proof No.">
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Business Proof Doc</label>
                    <input type="file" name="business_proof_document" value="{{ old('business_proof_document') }}" class="text-control">
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Business Address</label>
                    <input type="text" placeholder="Enter Address" name="business_address" value="{{ old('business_address') }}" class="text-control">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Cancelled Cheque</label>
                    <input type="file" name="cancelled_cheque_img" value="{{ old('cancelled_cheque_img') }}" class="text-control">
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Photographs</label>
                    <input type="file" name="photographs" value="{{ old('photographs') }}" class="text-control">
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Other Documents</label>
                    <input type="file" name="other_documents" value="{{ old('other_documents') }}" class="text-control">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12">
                    <h3 class="title-con">Bank Information</h3>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Account Type </label>
                    <select name="account_type" class="text-control">
                      <option value="">Select Type</option>
                      <option>Saving</option>
                      <option>Current</option>
                    </select>
                    @if ($errors->has('account_type'))
                        <span class="text-danger">
                            <span>{{ $errors->first('account_type') }}</span>
                        </span>
                    @endif
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Account Name</label>
                    <input type="text" name="account_name" value="{{ old('account_name') }}" class="text-control" placeholder="Enter Account Name">
                    @if ($errors->has('account_name'))
                        <span class="text-danger">
                            <span>{{ $errors->first('account_name') }}</span>
                        </span>
                    @endif
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Account No.</label>
                    <input type="text" name="account_number" value="{{ old('account_number') }}" class="text-control" placeholder="Enter Account no.">
                    @if ($errors->has('account_number'))
                        <span class="text-danger">
                            <span>{{ $errors->first('account_number') }}</span>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">IFSC Code</label>
                    <input type="text" name="ifsc_code" value="{{ old('ifsc_code') }}" class="text-control" placeholder="Enter IFSC Code">
                    @if ($errors->has('ifsc_code'))
                        <span class="text-danger">
                            <span>{{ $errors->first('ifsc_code') }}</span>
                        </span>
                    @endif
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Bank Name</label>
                    <input type="text" name="bank_name" value="{{ old('bank_name') }}" class="text-control" placeholder="Enter Bank Name">
                    @if ($errors->has('bank_name'))
                        <span class="text-danger">
                            <span>{{ $errors->first('bank_name') }}</span>
                        </span>
                    @endif
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Bank Branch</label>
                    <input type="text" name="bank_branch" value="{{ old('bank_branch') }}" class="text-control" placeholder="Enter Bank Branch">
                    @if ($errors->has('bank_branch'))
                        <span class="text-danger">
                            <span>{{ $errors->first('bank_branch') }}</span>
                        </span>
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-12">
                    <h3 class="title-con">Services You Worked On</h3>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Category</label>
                    <select class="form-control" name="category[]" multiple>
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
                    <select class="form-control" name="sub_category[]" multiple>
                        <option value="">Select Sub Category</option>
                        @foreach ($subCategories as $subCategory)
                        <option value="{{$subCategory->id}}">{{$subCategory->sub_category_name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('sub_category'))
                        <span class="text-danger">
                            <span>{{ $errors->first('sub_category') }}</span>
                        </span>
                    @endif
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Services</label>
                    <select class="form-control" name="services[]" multiple>
                        <option value="">Select Service</option>
                        @foreach ($services as $service)
                        <option value="{{$service->id}}">{{$service->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('services'))
                        <span class="text-danger">
                            <span>{{ $errors->first('services') }}</span>
                        </span>
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-12 text-center">
                    <button class="btn btn-dark" type="submit">Add Vendor</button>
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
