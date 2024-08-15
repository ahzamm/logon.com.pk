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
                Create New Why Choose Us Card
              </h3>
              <div class="ml-auto">
                <a class=" float-right btn btn-outline-secondary btn-sm" href="{{ route('why-choose-us.index') }}">
                  <i class="fa fa-arrow-left"></i> Back
                </a>
              </div>
            </div>
            <form action="{{ route('why-choose-us.store') }}" method="POST" enctype="multipart/form-data">
              <!-- /.card-header -->
              <div class="card-body pad">

                @csrf
                <div class="row">
                  {{-- <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Icon (size h/w: 1920x580)</label>
                      <input type="file" class="form-control" name="icon" accept="image/*">
                      @error('icon')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div> --}}

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

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Heading</label>
                      <input type="text" class="form-control" name="heading" value="{{ old('heading') }}">
                      @error('heading')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Text</label>
                      <textarea id="pageContent" name="text" rows="4" class="form-control summernote">{{ old('text') }}</textarea>
                      @error('text')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  {{-- <div class="col-md-12">
                    <label for="">Page Content</label>
                    <div class="mb-3">
                      <textarea id="pageContent" name="content" placeholder="Place some text here" style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! old('content') !!}</textarea>
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
    $(document).ready(function() {
      $('#pageContent').summernote({
        height: 300
      });

    });

    function formatState(state) {
    if (!state.id) {
        return state.text;
    }
    var $state = $(
        `<i class="${state.element.value}"></i> <span style="margin-left:10px">${state.element.value}</span>`
    );
    return $state;
}

$(function(){
    $('#selectIcon').select2({
        theme: 'bootstrap4',
        templateResult: formatState,
        templateSelection: formatState
    });
});
  </script>
@endpush
