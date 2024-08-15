@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-outline card-info">
              <div class="card-header">
                <h3 class="card-title">
                  Modify Employee
                </h3>
                <div class="ml-auto">
                  <a class=" float-right btn btn-outline-secondary btn-sm" href="{{ route('employee.index') }}">
                    <i class="fa fa-arrow-left"></i> Back
                  </a>
                </div>
              </div>
              <form action="{{route('employee.update',$employee->id)}}" method="POST" enctype="multipart/form-data">
              <!-- /.card-header -->
              <div class="card-body pad">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">New Password</label>
                              <input type="password" class="form-control" name="password" value="">
                              @error('password')
                                  <p class="text-danger mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <label for="" style="visibility: hidden">Status</label>
                            <div class="form-group clearfix mt-2">
                                <div class="icheck-success d-inline">
                                  <input type="checkbox"  {{$employee->active == 1? 'checked' :'unchecked' }} name="active" id="checkboxSuccess1">
                                  <label for="checkboxSuccess1">
                                      Active
                                  </label>
                                </div>
                              </div>
                        </div> --}}
                    </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Submit</button>
              </div>
            </form>
            </div>
          </div>
          <!-- /.col-->
        </div>
        <!-- ./row -->
      </section>
      
</div>
@endsection
@push('scripts')
<script>
    
</script>
@endpush