@extends('layouts.app')

@section('content')

<section class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="content-header">
            <h3 class="content-header-title">Master</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master</li>
              <li class="breadcrumb-item active">Manage Pincode</li>
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
                  <table class="table table-bordered table-fitems" id="pincode-table">
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

  <div class="modal" id="view-pincodes">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                  <h4 class="modal-title">View Pincodes</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                  <div class="table-responsive">
                      <table class="table table-bordered" id="pincodes_in_modal">
                          <thead>
                              <tr>
                                  <th>Sr. No.</th>
                                  <th>State</th>
                                  <th>City</th>
                                  <th>Pincode</th>
                              </tr>
                          </thead>

                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>

@endsection

@push('scripts')
    <script type="text/javascript">
        //-------------------- Manage pincode listing ----------------------//
        $(function () {
            var table = $('#pincode-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.pincode') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'state_name', name: 'state_name'},
                    {data: 'city_name', name: 'city_name'},
                    {data: 'pincode', name: 'pincode'},
                    {data: 'status', name: 'status'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            });
        });
    </script>
@endpush
