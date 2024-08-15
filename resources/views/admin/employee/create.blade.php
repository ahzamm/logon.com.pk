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
                  Create New Employee
                </h3>
                <div class="ml-auto">
                  <a class=" float-right btn btn-outline-secondary btn-sm" href="{{ route('employee.index') }}">
                    <i class="fa fa-arrow-left"></i> Back
                  </a>
                </div>
              </div>
              <form action="{{route('employee.store')}}" method="POST" enctype="multipart/form-data">
              <!-- /.card-header -->
              <div class="card-body pad">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Employee Name</label>
                            <input type="text" class="form-control" name="name"  value="{{old('name')}}">
                              @error('name')
                                  <p class="text-danger  mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Employee Email</label>
                              <input type="email" class="form-control" name="email"  value="{{old('email')}}">
                              @error('email')
                                  <p class="text-danger  mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Employee Password</label>
                              <input type="password" class="form-control" name="password" value="{{old('password')}}">
                              @error('password')
                                  <p class="text-danger mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <label for="" style="visibility: hidden">Status</label>
                            <div class="form-group clearfix">
                                <div class="icheck-success d-inline">
                                  <input type="checkbox"  {{old('active') != null? 'checked' :'unchecked' }} name="active" id="checkboxSuccess1">
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