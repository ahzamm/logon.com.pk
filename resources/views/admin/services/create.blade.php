@extends('admin.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info mt-2">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0"><span><i class="fa fa-gears"></i></span> Add Service</h3>
              <div class="ml-auto">
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('service.index') }}">
                  <i class="fa fa-arrow-left"></i> Back
                </a>
              </div>
            </div>
            <form action="{{ route('service.store') }}" method="POST" enctype="multipart/form-data">
              <div class="card-body pad">
                @csrf
                <div class="row">
                  <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                      <label for="">Heading <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="heading" placeholder="Example : Bitcoin" value="{{ old('heading') }}">
                      @error('heading')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Text <span style="color: red">*</span></label>
                      <textarea name="text" rows="4" placeholder="Example : How are you" class="form-control summernote">{{ old('text') }}</textarea>
                      @error('text')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="selectIcon">Select Icon <span style="color: red">*</span></label>
                      <select name="icon" class="form-control" id="selectIcon">
                          <option value></option>
                          @foreach ($icons as $item)
                          <option value="{{ $item }}">{{ $item }}</option>
                          @endforeach
                      </select>
                        @error('icon')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div id="iconPreview" style="font-size: 24px; margin-top: 10px;"></div>
                </div>
                  
                  
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-outline-primary float-right">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@push('scripts')
  <script>
    $(document).ready(function() {
      $('#pageContent').summernote({
        height: 300
      });
    });
  </script>
@endpush
