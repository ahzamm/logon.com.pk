@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-outline card-info mt-2">
              <div class="card-header">
                <h3 class="card-title">
                  Add New City
                </h3>
                <div class="ml-auto">
                  <a class=" float-right btn btn-outline-secondary btn-sm" href="{{ route('cities.index') }}">
                    <i class="fa fa-arrow-left"></i> Back
                  </a>
                </div>
              </div>
              <form action="{{route('cities.store')}}" method="POST" enctype="multipart/form-data">
              <!-- /.card-header -->
              <div class="card-body pad">
                
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">City Name</label>
                            <input type="text" class="form-control" name="city_name"  value="{{old('city_name')}}">
                              @error('city_name')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Province Name</label>
                            <select class="form-control" name="province">
                              <option value=>--Select Province--</option>
                              <option value="sindh" {{old('province')}}>Sindh</option>
                              <option value="punjab">Punjab</option>
                              <option value="balochistan">Balochistan</option>
                              <option value="kpk">KPK</option>
                            </select>
                            @error('province')
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