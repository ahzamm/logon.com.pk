@extends('admin.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0"><span><i class="fa fa-users-viewfinder"></i></span> Update Client</h3>
              <div class="ml-auto">
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('why-choose-us.index') }}">
                  <i class="fa fa-arrow-left"></i> Back
                </a>
              </div>
            </div>
            <form action="{{ route('why-choose-us.update', $whychooseus->id) }}" method="POST" enctype="multipart/form-data">
              @method('PUT')
              <div class="card-body pad">
                @csrf
                <div class="row">
                  {{-- <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                      <label for="">Icon <span style="color: red">*</span></label>
                      <img src="{{ asset('why-choose-us/' . $whychooseus->icon) }}" height="60" width="120" alt="" srcset="" style="float:right" accept="image/*">
                      <br>
                      <input type="file" value="{{ $whychooseus->icon }}" name="icon">
                      @error('title')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div> --}}

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Select Icon <span style="color: red">*</span></label>
                      <select name="icon" class="form-control" id="selectIcon">
                        <option value></option>
                        @foreach ($icons as $item)
                          <option value="{{ $item }}" {{ $item == $whychooseus->icon ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                      </select>
                      @error('icon')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                      <label for="">Heading <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="heading" value="{{ old('heading') == null ? $whychooseus->heading : old('heading') }}">
                      @error('heading')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Text <span style="color: red">*</span></label>
                      <textarea id="pageContent" name="text" rows="4" placeholder="Example : How are you" required class="form-control summernote">{{ $whychooseus->text }}</textarea>
                      @error('text')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-outline-primary float-right">Update</button>
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
