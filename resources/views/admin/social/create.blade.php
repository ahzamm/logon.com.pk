@extends('admin.layouts.app')
@push('style')
  <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('site/sweet-alert/sweetalert2.css') }}">
@endpush
@section('content')
  @php
    $action = $data['action'];
    if ($action == 'create') {
        $parentRoute = Route('social.store');
        $parentTitle = 'Create';
    }
    if ($action == 'edit') {
        $id = $data['data'];
        $parentRoute = Route('social.update', $id);
        $parentTitle = 'Update';
    }
  @endphp
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info mt-2">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0"><span><i class="fa-brands fa-twitter"></i></span> {{ $parentTitle }} Social Links</h3>
              <div class="ml-auto">
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('social.index') }}">
                  <i class="fa fa-arrow-left"></i> Back
                </a>
              </div>
            </div>
            @if ($action == 'create')
              <form action="{{ route('social.store') }}" method="POST" id="submitForm" enctype="multipart/form-data">
              @elseif ($action == 'edit')
                <form action="{{ route('social.update', $data['data']->id)  }}" method="POST" id="submitForm" enctype="multipart/form-data">
                  @method('PUT')
            @endif

            {{-- <form action="{{ $parentRoute }}" method="POST" id="submitForm" enctype="multipart/form-data"> --}}
            <div class="card-body pad">
              @csrf
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <div class="form-group">
                    <label for="">Social Media Name <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ $data['data']->name ?? '' }}" placeholder="Example : Facebook" required>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6">
                  <div class="form-group">
                    <label for="">Social Media Links (URL) <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="url" value="{{ $data['data']->url ?? '' }}" placeholder="Example : https://www.facebook.com/blink" required>
                  </div>
                </div>
                <!-- </div> -->
                <!-- <div class="row"> -->
                <div class="col-lg-4 col-md-6">
                  <div class="form-group">
                    <label for="">Social Media Icon <span style="color: red">*</span></label>
                    <select class="form-control" name="icon" id="selectIcon">
                      <option value=>--Select Social Media Icon--</option>
                      @foreach ($data['icons'] as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6">
                  <div class="form-group">
                    <label for="">Color <span style="color: red">*</span></label>
                    <input type="color" class="form-control" name="color">
                  </div>
                </div>
              </div>
              <!-- <div class="row">
                    <div class="col-lg-4 col-md-6">
                      <div class="form-group">
                        <div class="icheck-success d-inline">
                          <input type="checkbox" name="status" id="checkboxSuccess1">
                          <label for="checkboxSuccess1">
                            Status (On & Off) <span style="color: red">*</span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div> -->
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
  <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('site/sweet-alert/sweetalert2.min.js') }}"></script>
  <script>
    function formatState(state) {
      if (!state.id) {
        return state.text;
      }
      var $state = $(
        "<i class='" + state.element.value + "''></i> <span style='color:black;margin-left:10px'>" + state.element.value + "</span>"
      );
      return $state;
    }
    $(function() {
      $('.selectList').select2({
        theme: 'bootstrap4'
      })
      $('#selectIcon').select2({
        theme: 'bootstrap4',
        templateResult: formatState,
        templateSelection: formatState
      });
      $('.select2.select2-container').css('width', 'auto');
    })
    $(document).ready(function() {
      $('#pageContent').summernote({
        height: 300
      });
    });
    $("#submitForm").submit(function(e) {
      if ($('input[name="url"]').val() == "") {
        e.preventDefault();
        swal({
          title: 'You are missing Something!',
          text: "Social Url is required!",
          animation: false,
          customClass: 'animated pulse',
          type: 'error',
        })
        return false;
      }
      if ($('select[name="icon"]').val() == "") {
        e.preventDefault();
        swal({
          title: 'You are missing Something!',
          text: "Social icon is required!",
          animation: false,
          customClass: 'animated pulse',
          type: 'error',
        })
        return false;
      }
    });
    let action = "{{ $action }}";
    let socialData = <?php echo isset($data['data']) && $data['data'] ? $data['data'] : 0; ?>;
    if (action == "edit") {
      $('input[name="url"]').val(socialData.url);
      $('select[name="icon"]').val(socialData.icon);
      $('input[name="color"]').val(socialData.color);
      let status = socialData.status == "1" ? "on" : "off";
      status == "on" ? $('input[name="status"]').prop('checked', true) : $('input[name="status"]').prop('checked', false);
    }
  </script>
@endpush
