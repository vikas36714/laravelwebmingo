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
              <li class="breadcrumb-item active">Edit Vendor</li>
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
            @if(session('error'))
                <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
            @endif
          <div class="card">
            <div class="card-body">
              <div class="card-block">
                <div class="tabs-users-info">
                <form action="{{ route('admin.vendor.update', $vendor->id) }}" enctype="multipart/form-data" name="vendor_add_form" method="POST">
                    @csrf
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile Information</a> </li>
                    <li class="nav-item"> <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">Documents</a> </li>
                    <li class="nav-item"> <a class="nav-link" id="bank-tab" data-toggle="tab" href="#bank" role="tab" aria-controls="bank" aria-selected="false">Bank Details</a> </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                      <div class="tabcontent-userinfo">
                        <div class="form-group row">
                          <div class="col-sm-4">
                            <label class="label-control">First name</label>
                            <input type="text" value="{{$vendor->first_name}}" name="first_name" class="text-control" placeholder="Enter First Name">
                          </div>
                          <div class="col-sm-4">
                            <label class="label-control">Last name</label>
                            <input type="text" value="{{$vendor->last_name}}" name="last_name" class="text-control" placeholder="Enter Last Name">
                          </div>
                          <div class="col-sm-4">
                            <label class="label-control">Business Type</label>
                            <select class="text-control" name="business_type" id="businesstype">
                              <option value="">Select Type</option>
                              <option {{ $vendor->business_type == '1' ? 'selected' : ''}} value="1">Proprietor</option>
                              <option {{ $vendor->business_type == '2' ? 'selected' : ''}} value="2">Private Limited</option>
                              <option {{ $vendor->business_type == '3' ? 'selected' : ''}} value="3">LLP / LLC</option>
                              <option {{ $vendor->business_type == '4' ? 'selected' : ''}} value="4">Partnership</option>
                              <option {{ $vendor->business_type == '5' ? 'selected' : ''}} value="5">Others</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-4">
                            <label class="label-control">Email Id</label>
                            <input type="text" value="{{$vendor->email}}" name="email" class="text-control" placeholder="Enter Email Id">
                          </div>
                          <div class="col-sm-4">
                            <label class="label-control">Website</label>
                            <input type="text" value="{{$vendor->website}}" name="website" class="text-control" placeholder="Enter Website">
                          </div>
                          <div class="col-sm-4">
                            <label class="label-control">Referral ID</label>
                            <input type="text" value="{{$vendor->referral_id}}" name="referral_id" class="text-control" placeholder="Enter Referral Mobile No.">
                            <span class="text-danger noted-text">Referral Name: User </span> </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-4">
                            <label class="label-control">Country</label>
                            <select class="text-control" name="country" id="country">
                              <option value="">Select Country</option>
                              @foreach ($countries as $country)
                                <option value="{{$country->id}}" {{ $country->id == $vendor->country_id ? 'selected' : ''}}>{{$country->name}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-sm-4">
                            <label class="label-control">State</label>
                            <select class="text-control" name="state" id="state">
                              <option value="">Select State</option>
                              @foreach ($states as $state)
                                <option value="{{$state->id}}" {{ $state->id == $vendor->state_id ? 'selected' : ''}}>{{$state->name}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-sm-4">
                            <label class="label-control">City</label>
                            <select class="text-control" name="city" id="city">
                              <option value="">Select City</option>
                              @foreach ($cities as $city)
                                <option value="{{$city->id}}" {{ $city->id == $vendor->city_id ? 'selected' : ''}}>{{$city->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-8">
                            <label class="label-control">Full Address</label>
                            <input type="text" value="{{$vendor->full_address}}" name="full_address" class="text-control" placeholder="Enter Full Address">
                          </div>
                          <div class="col-sm-4">
                            <label class="label-control">Pincode</label>
                            <input type="number" value="{{$vendor->pincode}}" name="pincode" class="text-control" placeholder="Enter Pincode">
                          </div>
                        </div>
                        <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Category</label>
                    <select class="form-control"  name="category[]" multiple="">
                      <option value="">Select Category</option>
                      @foreach ($categories as $category)
                        <option value="{{$category->id}}"  <?php if(in_array($category->id, $vendor['categories_id'])){ echo " selected=\"selected\""; } ?>>{{$category->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Sub Category</label>
                    <select class="form-control" multiple="" name="sub_category[]">
                      <option value="">Select Sub Category</option>
                      @foreach ($subCategories as $subCategory)
                        <option value="{{$subCategory->id}}"  <?php if(in_array($subCategory->id, $vendor['sub_categories_id'])){ echo " selected=\"selected\""; } ?>>{{$subCategory->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Services</label>
                    <select class="form-control" multiple="" name="services[]">
                      <option value="">Select Services</option>
                      @foreach ($services as $service)
                        <option value="{{$service->id}}"  <?php if(in_array($service->id, $vendor['services_id'])){ echo " selected=\"selected\""; } ?>>{{$service->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                        <div class="form-group row">
                          <div class="col-sm-12 text-center">
                            <button class="btn btn-dark" type="submit">Update Profile</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="changepass-tab">
                      <div class="tabcontent-userinfo">
                        <div class="form-group row">
                          <div class="col-sm-4">
                            <label class="label-control">PAN Card No.</label>
                            <input type="text" value="{{$vendor->pan_card_number}}" name="pan_card_number" class="text-control" placeholder="Enter PAN Card No.">
                          </div>
                          <div class="col-sm-4">
                            <label class="label-control">PAN CARD Document</label>
                            <input type="file" name="pan_card_document" class="text-control">
                            <img src="{{asset('public/images/vendor_images/'.$vendor->pan_card_document)}}" class="img-fluid" style="height: 30px;">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-4">
                            <label class="label-control">Aadhaar Card No.</label>
                            <input type="text" value="{{$vendor->aadhaar_card_number}}" name="aadhaar_card_number" class="text-control" placeholder="Enter Aadhaar Card No.">
                          </div>
                          <div class="col-sm-4">
                            <label class="label-control">Aadhaar Card (Front)</label>
                            <input type="file" name="aadhaar_card_front_img" class="text-control">
                            <img src="{{asset('public/images/vendor_images/'.$vendor->aadhaar_card_front)}}" class="img-fluid" style="height: 30px;">
                          </div>
                          <div class="col-sm-4">
                            <label class="label-control">Aadhaar Card (Back)</label>
                            <input type="file" name="aadhaar_card_back_img" class="text-control">
                            <img src="{{asset('public/images/vendor_images/'.$vendor->aadhaar_card_back)}}" class="img-fluid" style="height: 30px;">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-4">
                            <label class="label-control">Business Proof No.</label>
                            <input type="text" value="{{$vendor->business_proof_number}}" name="business_proof_number" class="text-control" placeholder="Enter Business Proof No.">
                          </div>
                          <div class="col-sm-4">
                            <label class="label-control">Business Proof Doc</label>
                            <input type="file" name="business_proof_document" class="text-control">
                            <img src="{{asset('public/images/vendor_images/'.$vendor->business_proof_document)}}" class="img-fluid" style="height: 30px;">
                          </div>
                          <div class="col-sm-4">
                            <label class="label-control">Business Address</label>
                            <input type="text" value="{{$vendor->business_address}}" placeholder="Enter Address" name="business_address" class="text-control">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-4">
                            <label class="label-control">Cancelled Cheque</label>
                            <input type="file" name="cancelled_cheque_img" class="text-control">
                            <img src="{{asset('public/images/vendor_images/'.$vendor->cancelled_cheque_img)}}" class="img-fluid" style="height: 30px;">
                          </div>
                          <div class="col-sm-4">
                            <label class="label-control">Photographs</label>
                            <input type="file" name="photographs" class="text-control">
                            <img src="{{asset('public/images/vendor_images/'.$vendor->photographs)}}" class="img-fluid" style="height: 30px;">
                          </div>
                          <div class="col-sm-4">
                            <label class="label-control">Other Documents</label>
                            <input type="file" name="other_documents" class="text-control">
                            <img src="{{asset('public/images/vendor_images/'.$vendor->other_documents)}}" class="img-fluid" style="height: 30px;">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-12 text-center">
                            <button class="btn btn-dark" type="submit">Update Documents</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="bank" role="tabpanel" aria-labelledby="bank-tab">
                      <div class="tabcontent-userinfo">
                        <div class="form-group row">
                          <div class="col-sm-4">
                            <label class="label-control">Account Type </label>
                            <select name="account_type" class="text-control">
                              <option value="">Select Type</option>
                              <option value="saving" {{ $vendor->account_type == 'saving' ? 'selected' : ''}}>Saving</option>
                              <option value="current" {{ $vendor->account_type == 'current' ? 'selected' : ''}}>Current</option>
                            </select>
                          </div>
                          <div class="col-sm-4">
                            <label class="label-control">Account Name</label>
                            <input type="text" value="{{$vendor->account_name}}" name="account_name" class="text-control" placeholder="Enter Account Name">
                          </div>
                          <div class="col-sm-4">
                            <label class="label-control">Account No.</label>
                            <input type="text" value="{{$vendor->account_number}}" name="account_number" class="text-control" placeholder="Enter Account no.">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-4">
                            <label class="label-control">IFSC Code</label>
                            <input type="text" value="{{$vendor->ifsc_code}}" name="ifsc_code" class="text-control" placeholder="Enter IFSC Code">
                          </div>
                          <div class="col-sm-4">
                            <label class="label-control">Bank Name</label>
                            <input type="text" value="{{$vendor->bank_name}}" name="bank_name" class="text-control" placeholder="Enter Bank Name">
                          </div>
                          <div class="col-sm-4">
                            <label class="label-control">Bank Branch</label>
                            <input type="text" value="{{$vendor->bank_branch}}" name="bank_branch" class="text-control" placeholder="Enter Bank Branch">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-12 text-center">
                            <input type="hidden" name="vendor_id" value="{{$vendor->vendor_id}}" >
                            <button class="btn btn-dark" type="submit">Update Bank Details</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
