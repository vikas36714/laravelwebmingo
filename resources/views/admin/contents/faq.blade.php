@extends('layouts.app')

@section('content')
<section class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="content-header">
            <h3 class="content-header-title">Content Management</h3>
            <button class="btn btn-dark btn-save" data-target="#add-faq" data-toggle="modal"><i class="fas fa-plus"></i> Add FAQ</button>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item">Content Management</li>
              <li class="breadcrumb-item active">Manage FAQ's</li>
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
            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
            @elseif(session('error'))
                <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
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
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Status</th>
                        <th>Updated at</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        {{! $n=1 }}
                      @foreach ($faqs as $faq)
                        <tr>
                            <td>{{$n++}}</td>
                            <td>{{$faq->created_at}}</td>
                            <td>{{$faq->question}}</td>
                            <td><a href="#" data-target="#view-answer" data-id="{{$faq->id}}" id="view_answer" data-toggle="modal">View Answer</a></td>
                            <td>
                                <span @if ($faq->status) class='badge badge-success' @else class='badge badge-secondary'@endif>{{$faq->status ? 'Succcess' : 'Pending'}}
                                </span>
                            </td>
                            <td>{{$faq->updated_at}}</td>
                            <td>
                            <ul class="action">
                                <li><a href="#" data-target="#edit-faq" data-toggle="modal" data-id="{{$faq->id}}" id="edit_faq" title="Edit FAQ"><i class="fas fa-pencil-alt"></i></a></li>
                                <li><a href="#" title="Change Status"><i class="fas fa-times"></i></a></li>
                                <li><a onclick="return confirm('Are you sure ? want to delete this FAQs.')" href="{{route('admin.faq.destroy', $faq->id) }}" title="Delete FAQ"><i class="fas fa-trash"></i></a></li>
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

  <div class="modal" id="view-answer">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">View Answer</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <p id="view_ans"></p>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="add-faq">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add FAQ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form action="{{ route('admin.faq.store') }}" enctype="multipart/form-data" name="services" method="POST">
                @csrf
            <div class="form-group row">
                <div class="col-sm-12">
                  <label class="label-control">Question</label>
                  <input type="text" name="question" class="text-control" placeholder="Enter Question">
                  @if ($errors->has('question'))
                    <span class="text-danger">
                        <span>{{ $errors->first('question') }}</span>
                    </span>
                  @endif
              </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12">
                  <label class="label-control">Answer</label>
                  <textarea cols="4" rows="2" name="answer" class="text-control" placeholder="Enter Answer"></textarea>
                  @if ($errors->has('answer'))
                  <span class="text-danger">
                      <span>{{ $errors->first('answer') }}</span>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12 text-center">
                  <button type="submit" class="btn btn-dark">Add FAQ</button>
              </div>
            </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="edit-faq">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit FAQ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form action="{{ url('admin/dashboard/faq/edit') }}" enctype="multipart/form-data" name="faq" method="POST">
                @csrf
            <div class="form-group row">
                <div class="col-sm-12">
                  <label class="label-control">Question</label>
                  <input type="text" name="question" id="question" class="text-control" placeholder="Enter Question">
              </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12">
                  <label class="label-control">Answer</label>
                  <textarea cols="4" rows="2" name="answer" id="answer" class="text-control" placeholder="Enter Answer"></textarea>
              </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12 text-center">
                    <input type="hidden" name="faq_id" id="faq_id" >
                  <button type="submit" id="update_faq" class="btn btn-dark">Update FAQ</button>
              </div>
            </div>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection
