

@extends('admin.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('backend/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('site/sweet-alert/sweetalert2.css')}}">
@endpush
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                {{$error}}

            </div>
        @endforeach
        @endif
        <div class="card card-outline card-info mt-2">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-address-card"></i></span> {{$action}} Service </h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('admin.services')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>

          <form action="{{ $url }}" method="POST" id="submitForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="form-control" value="{{$service->id ?? ""}}" name="id">
            <div class="card-body pad">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Service Name<span style="color: red">*</span></label>
                            <input type="text" class="form-control" value="{{$service->service ?? "" }}" name="service">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Upload Image <span style="color: red">*</span></label>
                            @isset($service->logo)
                            <img src="{{ asset('frontend_assets/images/services/'.$service->logo) }}" height="60"
                            width="120" alt="" srcset="" >
                            @endisset

                            <input type="file" class="form-control-file" name="logo" id="image-about">
                            @error('logo')
                            <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Tagline <span style="color: red">*</span></label>
                            <textarea class="form-control" name="tagline"  >{{$service->tagline ?? "" }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Description <span style="color: red">*</span></label>
                            <textarea class="form-control summernote" name="description" id="summernote">{{$service->description ?? ""}}</textarea>
                            @error('description')
                            <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Slug <span style="color: red">*</span></label>
                            <input type="text" class="form-control" value="{{$service->slug ?? "" }}" name="slug">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="icheck-success d-inline">
                                <input type="checkbox" name="is_active" id="checkboxSuccess1" {{ isset($service) && $service->is_active==1 ? 'checked' : 'unchecked' }}>
                                <label for="checkboxSuccess1">Status (On & Off)  <span style="color: red">*</span></label>
                            </div>
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
      <!-- /.col-->
    </div>
    <!-- ./row -->
  </section>
</div>
@endsection
@push('scripts')
<script src="{{asset('backend/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('site/sweet-alert/sweetalert2.min.js')}}"></script>
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
    if ($('input[name="email"]').val() == "") {
      e.preventDefault();
      swal({
        title: 'You are missing Something!',
        text: "Email is required!",
        animation: false,
        customClass: 'animated pulse',
        type: 'error',
      })
      return false;
    }
    if ($('input[name="phone"]').val() == "") {
      e.preventDefault();
      swal({
        title: 'You are missing Something!',
        text: "Phone Number is required!",
        animation: false,
        customClass: 'animated pulse',
        type: 'error',
      })
      return false;
    }
    if ($('textarea[name="address"]').val() == "") {
      e.preventDefault();
      swal({
        title: 'You are missing Something!',
        text: "Address is required!",
        animation: false,
        customClass: 'animated pulse',
        type: 'error',
      })
      return false;
    }
  });
  let action = {{$action}};
  let socialData = <?php echo isset($data['homeside']) && $data['homeside']  ? $data['homeside'] : 0 ?>;
  if (action == "edit") {
    $('textarea[name="service"]').val(service.service);
    $('input[name="tagline"]').val(service.tagline);
    $('input[name="description"]').val(service.description);
    $('input[name="logo"]').val(service.logo);
    let status = socialData.status == "1" ? "on" : "off";
    status == "on" ? $('input[name="status"]').prop('checked', true) : $('input[name="status"]').prop('checked', false);
  }
</script>
@endpush
