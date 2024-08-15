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
                  Create New Page
                </h3>
                <div class="ml-auto">
                  <a class=" float-right btn btn-outline-secondary btn-sm" href="{{ route('front-pages.index') }}">
                    <i class="fa fa-arrow-left"></i> Back
                  </a>
                </div>
              </div>
              <form action="{{route('front-pages.store')}}" method="POST" enctype="multipart/form-data">
              <!-- /.card-header -->
              <div class="card-body pad">
                
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Page Name</label>
                            <input type="text" class="form-control" name="page_name"  value="{{old('page_name')}}">
                              @error('page_name')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Page Title</label>
                              <input type="text" class="form-control" name="page_title"  value="{{old('page_title')}}">
                              @error('page_title')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Meta Tag Name</label>
                              <input type="text" class="form-control" name="meta_name" value="{{old('meta_name')}}">
                              @error('meta_name')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Meta Tag Description</label>
                              <input type="text" class="form-control" name="meta_description" value="{{old('meta_description')}}">
                              @error('meta_description')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Slogan</label>
                            <input type="text" class="form-control" name="slogan" value="{{old('slogan')}}">
                            @error('slogan')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                          </div>
                      </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Banner Image (size h/w: 1920x580)</label>
                              <input type="file" class="form-control" name="banner_image" >
                              @error('banner_image')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group clearfix">
                                <div class="icheck-success d-inline">
                                  <input type="checkbox"  {{old('status') != null? 'checked' :'unchecked' }} name="status" id="checkboxSuccess1">
                                  <label for="checkboxSuccess1">
                                      Status
                                  </label>
                                </div>
                              </div>
                        </div> --}}
                        <div class="col-md-12">
                            <label for="">Page Content</label>
                            <div class="mb-3">
                                <textarea id="pageContent" name="content" placeholder="Place some text here"
                                          style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! old('content') !!}</textarea>
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
<script>
    $(document).ready(function(){
        $('#pageContent').summernote({
          height:300
        });
        
});
</script>
@endpush