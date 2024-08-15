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
                  Create New Job
                </h3>
                <div class="ml-auto">
                  <a class=" float-right btn btn-outline-secondary btn-sm" href="{{ route('jobpost.index') }}">
                    <i class="fa fa-arrow-left"></i> Back
                  </a>
                </div>
              </div>
              <form action="{{route('jobpost.update',$job->id)}}" method="POST" enctype="multipart/form-data">
              <!-- /.card-header -->
              <div class="card-body pad">
                
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Post Title</label>
                            <input type="text" class="form-control" name="post_title"  value="{{$job->post_title}}">
                              @error('post_title')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Job Type</label>
                              <input type="text" class="form-control" name="job_type"  value="{{$job->job_type}}">
                              @error('job_type')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">City</label>
                              <input type="text" class="form-control" name="city" value="{{$job->city}}">
                              @error('city')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Total Positions</label>
                              <input type="text" class="form-control" name="total_position" value="{{$job->total_positions}}">
                              @error('total_position')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Work Experience</label>
                            <input type="text" class="form-control" name="work_experience" value="{{$job->work_experience}}">
                            @error('work_experience')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                          </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Job Shift</label>
                          <input type="text" class="form-control" name="shift" value="{{$job->shift}}">
                          @error('shift')
                                <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                            @enderror
                        </div>
                      </div>
                      {{-- <div class="col-md-6">
                        <div class="form-group clearfix">
                            <div class="icheck-success d-inline">
                              <input type="checkbox"  {{$job->active != 0? 'checked' :'unchecked' }} name="status" id="checkboxSuccess1">
                              <label for="checkboxSuccess1">
                                  Active
                              </label>
                            </div>
                          </div>
                    </div> --}}
                        <div class="col-md-12">
                            <label for="">Job Description</label>
                            @error('job_description')
                                <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                            @enderror
                            <div class="mb-3">
                                <textarea id="pageContent" name="job_description" placeholder="Place some text here"
                                          style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! $job->description !!}</textarea>
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