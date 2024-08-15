@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-outline card-info mt-3">
              <div class="card-header">
                <h3 class="card-title">
                  Create New Corporate
                </h3>
                <div class="ml-auto">
                  <a class=" float-right btn btn-outline-secondary btn-sm" href="{{ route('corporate.index') }}">
                    <i class="fa fa-arrow-left"></i> Back
                  </a>
                </div>
              </div>
              <form action="{{route('corporate.store')}}" method="POST" enctype="multipart/form-data">
              <!-- /.card-header -->
              <div class="card-body pad">
                
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Name*</label>
                            <input type="text" class="form-control" name="name"  value="{{old('name')}}">
                              @error('name')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Address</label>
                              <input type="text" class="form-control" name="address"  value="{{old('address')}}">
                              @error('address')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Email</label>
                              <input type="text" class="form-control" name="email" value="{{old('email')}}">
                              @error('email')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Contact</label>
                              <input type="text" class="form-control" name="contact" value="{{old('contact')}}">
                              @error('contact')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Corporate Logo (size h/w: 115x270)*</label>
                              <input type="file" class="form-control" name="banner_image" >
                              @error('banner_image')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group clearfix">
                              <label for="" style="visibility: hidden">A</label>
                                <div class="icheck-success">
                                  <input type="checkbox"  {{old('status') != null? 'checked' :'unchecked' }} name="status" id="checkboxSuccess1">
                                  <label for="checkboxSuccess1">
                                      Status
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

@endpush