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
              <li class="breadcrumb-item active">View Vendor Information</li>
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
                <div class="form-group row">
                  <div class="col-sm-12">
                    <h3 class="h3-title">Basic Information</h3>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">First name</label>
                    <h4 class="h4-control">{{$vendor->first_name}}</h4>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Last name</label>
                    <h4 class="h4-control">{{$vendor->last_name}}</h4>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Business Type</label>
                    <h4 class="h4-control">
                        {{(
                            ($vendor->business_type == 1) ? "Proprietor" :
                            (($vendor->business_type == 2) ? "Private Limited" :
                            (($vendor->business_type == 3) ? "LLP / LLC" :
                            (($vendor->business_type == 4) ? "Partnership" : "Others")))
                        )}}
                    </h4>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Email Id</label>
                    <h4 class="h4-control">{{$vendor->email}}</h4>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Website</label>
                    <h4 class="h4-control">{{$vendor->website}}</h4>
                  </div>

                  <div class="col-sm-4">
                    <label class="label-control">Referral ID</label>
                    <h4 class="h4-control">{{$vendor->referral_id}}</h4>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Country</label>
                    <h4 class="h4-control">{{$vendor->country}}</h4>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">State</label>
                    <h4 class="h4-control">{{$vendor->state}}</h4>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">City</label>
                    <h4 class="h4-control">{{$vendor->city}}</h4>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-8">
                    <label class="label-control">Full Address</label>
                    <h4 class="h4-control">{{$vendor->full_address}}</h4>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Pincode</label>
                    <h4 class="h4-control">{{$vendor->pincode}}</h4>
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
                    <h4 class="h4-control">{{$vendor->pan_card_number}}</h4>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">PAN CARD Document</label>
                    <h4 class="h4-control"><a href="{{asset('public/images/vendor_images/'.$vendor->pan_card_document)}}" download>View/Download</a></h4>
                  </div>are to storage k link to do knse folder me hai ?ok wait
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Aadhaar Card No.</label>
                    <h4 class="h4-control">{{$vendor->aadhaar_card_number}}</h4>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Aadhaar Card (Front)</label>
                   <h4 class="h4-control"><a href="{{asset('public/images/vendor_images/'.$vendor->aadhaar_card_front)}}" download>View/Download</a></h4>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Aadhaar Card (Back)</label>
                    <h4 class="h4-control"><a href="{{asset('public/images/vendor_images/'.$vendor->aadhaar_card_back)}}" download>View/Download</a></h4>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Business Proof No.</label>
                    <h4 class="h4-control">{{$vendor->business_proof_number}}</h4>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Business Proof Doc</label>
                    <h4 class="h4-control"><a href="{{asset('public/images/vendor_images/'.$vendor->business_proof_document)}}" download>View/Download</a></h4>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Business Address</label>
                    <h4 class="h4-control">{{$vendor->business_address}}</h4>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Cancelled Cheque</label>
                    <h4 class="h4-control"><a href="{{asset('public/images/vendor_images/'.$vendor->cancelled_cheque_img)}}" download>View/Download</a></h4>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Photographs</label>
                    <h4 class="h4-control"><a href="{{asset('public/images/vendor_images/'.$vendor->photographs)}}" download>View/Download</a></h4>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Other Documents</label>
                    <h4 class="h4-control"><a href="{{asset('public/images/vendor_images/'.$vendor->other_documents)}}" download>View/Download</a></h4>
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
                    <h4 class="h4-control">{{$vendor->account_type}}</h4>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Account Name</label>
                    <h4 class="h4-control">{{$vendor->account_name}}</h4>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Account No.</label>
                    <h4 class="h4-control">{{$vendor->account_number}}</h4>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">IFSC Code</label>
                    <h4 class="h4-control">{{$vendor->ifsc_code}}</h4>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Bank Name</label>
                    <h4 class="h4-control">{{$vendor->bank_name}}</h4>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Bank Branch</label>
                    <h4 class="h4-control">{{$vendor->bank_branch}}</h4>
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
                    <h4 class="h4-control">{{ $vendor->categories->pluck('name')->implode(', ') }}</h4>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Sub Category</label>
                    <h4 class="h4-control">{{ $vendor->sub_categories->pluck('name')->implode(', ') }}</h4>
                  </div>
                   <div class="col-sm-4">
                    <label class="label-control">Services</label>
                    <h4 class="h4-control">{{ $vendor->services->pluck('name')->implode(', ') }}</h4>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
