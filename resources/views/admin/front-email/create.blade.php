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
                  Create new Home Slide
                </h3>
              </div>
              <form action="{{route('homeslider.store')}}" method="POST" enctype="multipart/form-data">
              <!-- /.card-header -->
              <div class="card-body pad">
                
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Slide Title</label>
                            <input type="text" class="form-control" name="title"  value="{{old('title')}}">
                              @error('title')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Slide Slogan</label>
                            <input type="text" class="form-control" name="slogan" value="{{old('slogan')}}">
                            @error('slogan')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                          </div>
                      </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Banner Image (size w/h: 1903x720)</label>
                              <input type="file" class="form-control-file" name="banner_image" >
                              @error('banner_image')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group clearfix">
                              <label for="" style="visibility: hidden">A</label>
                                <div class="icheck-success d-block">
                                  <input type="checkbox"  {{old('status') != null? 'checked' :'unchecked' }} name="status" id="checkboxSuccess1">
                                  <label for="checkboxSuccess1">
                                      Status
                                  </label>
                                </div>
                              </div>
                        </div>
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