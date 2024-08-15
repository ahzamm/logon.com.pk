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
        $parentRoute = route('smtp-configuration.store');
        $parentTitle = 'SMTP Configuration';
    }
    if ($action == 'edit') {
        $id = $data['email']->id;
        $parentRoute = route('smtp-configuration.update', $id);
        $parentTitle = 'Update';
    }
  @endphp
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info mt-2">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0"><span><i class="fa-solid fa-envelope"></i></span> {{ $parentTitle }}</h3>
              <div class="ml-auto">
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('smtp-configuration.index') }}">
                  <i class="fa fa-arrow-left"></i> Back
                </a>
              </div>
            </div>
            <form action="{{ $parentRoute }}" method="POST" id="submitForm" enctype="multipart/form-data">
              <div class="card-body pad">
                @csrf
                @if ($action == 'edit')
                  @method('PUT')
                @endif
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">SMTP SERVER <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="smtp_server" placeholder="Example: smtp.gmail.com" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">SMTP Port <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="port" placeholder="Example: 587" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Email Address <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="email" placeholder="Example: abc@gmail.com" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Email Password <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="password" placeholder="Example: 123abc" required>
                    </div>
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
      if ($('input[name="smtp_server"]').val() == "") {
        e.preventDefault();
        Swal.fire({
          title: 'You are missing Something!',
          text: "SMTP server is required!",
          icon: 'error',
          animation: false,
          customClass: 'animated pulse'
        })
        return false;
      }
      if ($('input[name="port"]').val() == "") {
        e.preventDefault();
        Swal.fire({
          title: 'You are missing Something!',
          text: "SMTP Port is required!",
          icon: 'error',
          animation: false,
          customClass: 'animated pulse'
        })
        return false;
      }
      if ($('input[name="email"]').val() == "") {
        e.preventDefault();
        Swal.fire({
          title: 'You are missing Something!',
          text: "SMTP email is required!",
          icon: 'error',
          animation: false,
          customClass: 'animated pulse'
        })
        return false;
      }
      if ($('input[name="password"]').val() == "") {
        e.preventDefault();
        Swal.fire({
          title: 'You are missing Something!',
          text: "SMTP password is required!",
          icon: 'error',
          animation: false,
          customClass: 'animated pulse'
        })
        return false;
      }
    });
    let action = "{{ $action }}";
    let socialData = @json(isset($data['email']) ? $data['email'] : null);
    if (action == "edit") {
      $('input[name="smtp_server"]').val(socialData.smtp_server);
      $('input[name="port"]').val(socialData.port);
      $('input[name="email"]').val(socialData.emails);
      $('input[name="password"]').val(socialData.smtp_password);
      let status = socialData.status == "1" ? "on" : "off";
      status == "on" ? $('input[name="status"]').prop('checked', true) : $('input[name="status"]').prop('checked', false);
    }
  </script>
@endpush
