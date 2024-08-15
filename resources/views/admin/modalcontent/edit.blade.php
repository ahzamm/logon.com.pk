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
                  Edit Popup Content
                </h3>
                <div class="ml-auto">
                  <a class=" float-right btn btn-outline-secondary btn-sm" href="{{ route('modalcontent.index') }}">
                    <i class="fa fa-arrow-left"></i> Back
                  </a>
                </div>
              </div>
              <form action="{{route('modalcontent.update',$content->id)}}" method="POST" enctype="multipart/form-data">
              <!-- /.card-header -->
              <div class="card-body pad">
                @method('PUT')
                    @csrf
                    <div class="row">
                        {{-- <div class="col-12">
                            <img src="{{asset('modalimages/'.$content->image)}}" class="float-right" width="30%" alt="" srcset="">
                        </div> --}}
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" name="title" value="{{$content->title}}">
                            @error('title')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                          </div>
                      </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Banner Image</label>
                              <input type="file" class="form-control-file" name="banner_image" >
                              @error('banner_image')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="">Page Content</label>
                            <div class="mb-3">
                                <textarea id="pageContent" name="content" placeholder="Place some text here" >
                                    {!! $content->content !!}
                                </textarea>
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