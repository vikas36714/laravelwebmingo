@extends('layouts.app')

@section('content')

<section class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="content-header">
            <h3 class="content-header-title">Master</h3>
            <button class="btn btn-dark btn-save" id="addpincodeForm" data-target="#add-pincode" data-toggle="modal"><i class="fas fa-plus"></i> Add Pincode</button>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item">Manage Pincode</li>
              <li class="breadcrumb-item active">Edit Pincode</li>
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
                <span class="success"></span>
              <div class="card-block">
                <div class="table-responsive">
                  <table class="table table-bordered table-fitems" id="editpincode-table">
                    <thead>
                      <tr>
                        <th>Sr. No.</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Pincode</th>
                        <th>Status</th>
                        <th>Updated at</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

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
  <div class="modal" id="add-pincode">
      <div class="modal-dialog">
          <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                  <h4 class="modal-title">Add Pincode</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">

                  <div class="form-group row">
                      <div class="col-sm-6">
                          <label class="label-control">State</label>
                          <select class="text-control" id="state_id_add" name="state_id" disabled>
                          </select>
                      </div>

                      <div class="col-sm-6">
                          <label class="label-control">City</label>
                          <select class="text-control" id="city_id_add" name="city_id">
                          </select>
                      </div>
                  </div>

                  <div class="form-group row">
                      <div class="col-sm-12">
                          <label class="label-control">Pincode</label>
                      <textarea cols="6" rows="3" id="pincode_add" name="pincode" class="text-control" placeholder="Enter Pincodes with comma seperate for multiple"></textarea>
                          <span class="noted-text">Enter Pincodes with comma seperate for multiple</span>
                      </div>
                  </div>

                  <div class="form-group row">
                      <div class="col-sm-12 text-center">
                          <button type="submit" id="addbtn" class="btn btn-dark">Add Pincode</button>
                      </div>
                  </div>

              </div>
          </div>
      </div>
  </div>
  <div class="modal" id="edit-pincode">
      <div class="modal-dialog">
          <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
              <h4 class="modal-title">Edit Pincode</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                  <div class="form-group row">
                      <div class="col-sm-6">
                          <label class="label-control">State </label>
                          <select class="text-control" id="update_state_id" name="state_id" disabled>
                          </select>
                      </div>

                      <div class="col-sm-6">
                          <label class="label-control">City</label>
                          <select class="text-control" id="update_city_id" name="city_id" disabled>
                          </select>
                      </div>
                  </div>

                  <div class="form-group row">
                      <div class="col-sm-6">
                          <label class="label-control">Pincode</label>
                      <input type="number" id="update_pincode" name="pincode" class="text-control" value="">
                      </div>
                  </div>

                  <div class="form-group row">
                      <div class="col-sm-12 text-center">
                          <input type="hidden" id="pincode_id" name="pincode_id" value="">
                          <button type="submit" id="update_pincode_btn" class="btn btn-dark">Update Pincode</button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

@endsection

