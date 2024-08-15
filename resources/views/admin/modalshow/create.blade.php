@extends('admin.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('admin/plugins/toastr/toastr.min.css')}}">
@endpush
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-outline card-info mt-3">
              <div class="card-header">
                <h3 class="card-title">
                  Create Popup Active
                </h3>
                @isset($modalShow)
                <a href="{{route('modalshow.deactivate')}}" class="btn btn-danger float-right btn-sm">Deactivate</a>
                @endisset
                
              </div>
              <form action="{{route('modalshow.store')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
              <!-- /.card-header -->
              <div class="card-body pad">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Select Popup Content</label>
                            <select name="content" id="" class="form-control">
                                <option value>-- Select Content --</option>
                                @foreach ($content as $item)
                                    <option value="{{$item->id}}" {{old('content') == $item->id?'selected':''}}>{{$item->title}}</option>
                                @endforeach
                            </select>
                            @error('content')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                          </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Start Date:</label>
                            <div class="input-group date" id="datepickermodal" data-target-input="nearest">
                                <input type="text" name="start_date" value="{{old('start_date')}}" class="form-control datetimepicker-input" data-target="#datepickermodal">
                                <div class="input-group-append" data-target="#datepickermodal" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            @error('start_date')
                              <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                            @enderror
                        </div> 
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>End Date:</label>
                          <div class="input-group date" id="datepickermodaltwo" data-target-input="nearest">
                              <input type="text" name="end_date" value="{{old('end_date')}}" class="form-control datetimepicker-input" data-target="#datepickermodaltwo">
                              <div class="input-group-append" data-target="#datepickermodaltwo" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                          @error('end_date')
                            <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                          @enderror
                      </div> 
                    </div>
                    </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Activate</button>
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
<script src="{{asset('admin/plugins/toastr/toastr.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#pageContent').summernote({
          height:300
        });

        $('#datepickermodal,#datepickermodaltwo').datetimepicker({
            // dateFormat: 'dd-mm-yy',
            format:'YYYY-MM-DD',
        });
        @if(Session::get('deactivate'))
          toastr.info('Popup is Deactivated');
        @endif
        @if(Session::get('activate'))
          toastr.success('Popup is activated successfully');
        @endif
    });
</script>
@endpush