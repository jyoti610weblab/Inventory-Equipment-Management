@extends('backend.layout.master')
@section('pagetitle', 'Work Order Edit')

@section('head')
<!-- daterange picker -->
<link rel="stylesheet" href="{{ URL::asset('assests/plugins/daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Work Order Detail <a href="{{ route('work_order.index') }}"><button class="btn btn-primary">Back</button></a></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">Work Order Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

     <!-- Main content -->
     <section class="content">
      <div class="row">
        <div class="col-md-12">
          @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
          @endif
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit {{ ucwords($work_order->title) ?? ''}} Inventory Details</h3>
            </div>
            <div class="card-body">
              <form action="{{ route('work_order.update', $work_order->id) }}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <input type="hidden" name="id" value="{{ $work_order->id ?? '' }}">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        <label for="inputName">Name <span class="text-danger">*</span></label>
                        <input type="text" id="inputName" class="form-control" name="name" value="{{ $work_order->title ?? ''}}" required>
                        @error('name')
                          <span class="invalid-feedback" role="alert" style="display:block;">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>

                    <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                        <label for="inputDescription">Description <span class="text-danger">*</span></label>
                        <textarea id="inputDescription" class="form-control" rows="6" name="description" required>{{ $work_order->description ?? ''}}</textarea>
                        @error('description')
                          <span class="invalid-feedback" role="alert" style="display:block;">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>

                  </div>
                  <div class="col-md-6">
                    <div class="form-group {{ $errors->has('staff_id') ? 'has-error' : ''}}">
                          <label for="inputStaff">Staff <span class="text-danger">*</span></label>
                          <select id="inputStaff" class="form-control" name="staff_id" required>
                            <option selected disabled>Select one</option>
                            @foreach($users as $val)
                            <option value="{{$val->id ?? ''}}" @if($work_order->staff_id == $val->id) selected @endif>{{ucwords($val->name) ?? ''}}</option>
                            @endforeach
                          </select>
                          @error('staff_id')
                          <span class="invalid-feedback" role="alert" style="display:block;">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>

                      <div class="form-group {{ $errors->has('orderdate') ? 'has-error' : ''}}">
                        <label for="inputOrderdate">Work Order Date <span class="text-danger">*</span></label>
                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                            <input type="text" id="inputOrderdate" class="form-control datetimepicker-input" data-target="#reservationdatetime" name="orderdate" value="{{ date('d/m/Y h:i A', strtotime($work_order->orderdate))  ?? ''}}" required/>
                            <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                      </div>

                      <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                        <label for="inputStatus">Status  <span class="text-danger">*</span></label>
                        <select id="inputStatus" class="form-control custom-select" name="status">
                          <option selected disabled>Select one</option>
                          <option value="1" @if($work_order->status == '1') selected @endif>Active</option>
                          <option value="2" @if($work_order->status == '2') selected @endif>Deactive</option>
                        </select>
                        @error('status')
                        <span class="invalid-feedback" role="alert" style="display:block;">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Update userrole" class="btn btn-success float-right">
                  </div>
                </div>
              </form>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </section>
    <!-- /.content -->
 
@endsection

@section('footerscript')
<!-- date-range-picker -->
<script src="{{ URL::asset('assests/plugins/daterangepicker/daterangepicker.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
      var orderDate = "{{ date('d/m/Y h:i A', strtotime($work_order->orderdate)) }}";
      //DateTime picker
      $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' },
      defaultDate: "{{ date('d/m/Y h:i A', strtotime($work_order->orderdate)) }}"});
      
       // Date Object

    });
</script>
@endsection