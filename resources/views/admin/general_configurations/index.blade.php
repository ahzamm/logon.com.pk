@extends('admin.layouts.app')
@section('content')
  <style>
    .switch {
      position: relative;
      display: inline-block;
      width: 55px;
      height: 27px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 20px;
      width: 20px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked+.slider {
      background-color: green;
    }

    input:focus+.slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
  </style>
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0"><span><i class="fa fa-wrench"></i></span> Update General Configurations</h3>
              <div class="ml-auto">
              </div>
            </div>
            <form action="{{ route('general-configurations.update') }}" method="POST" enctype="multipart/form-data">
              @method('PUT')
              <div class="card-body pad">
                @csrf
                <div class="row">
                  <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                      <label for="">Two Factor Authentication <span style="color: red">*</span></label>
                      <label class="switch float-right">
                        <input type="checkbox" class="status_check" @if ($general_configuration->otp_status == 1) checked @endif>
                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
  </div>
  <div class="row">
                  <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                      <label for="">Brand Logo <span style="color: red">*</span></label>
                      @isset($general_configuration->brand_logo)
                        <img src="{{ asset('site/images/' . $general_configuration->brand_logo) }}" height="60" width="120" alt="" srcset="" style="float:right">
                      @endisset
                      <br>
                      <input type="file" value="{{ $general_configuration->brand_logo }}" name="brand_logo">
                      @error('brand_logo')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                      <label for="">Fav Icon <span style="color: red">*</span></label>
                      @isset($general_configuration->favicon)
                        <img src="{{ asset('site/images/' . $general_configuration->favicon) }}" height="60" width="120" alt="" srcset="" style="float:right">
                      @endisset
                      <br>
                      <input type="file" value="{{ $general_configuration->favicon }}" name="favicon">
                      @error('favicon')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                      <label for="">Footer Logo <span style="color: red">*</span></label>
                      @isset($general_configuration->footer_logo)
                        <img src="{{ asset('site/images/' . $general_configuration->footer_logo) }}" height="60" width="120" alt="" srcset="" style="float:right">
                      @endisset
                      <br>
                      <input type="file" value="{{ $general_configuration->footer_logo }}" name="footer_logo">
                      @error('footer_logo')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Brand Name <span style="color: red">*</span></label>
                      @isset($general_configuration->brand_name)
                        <input type="text" class="form-control" name="brand_name" value="{{ old('brand_name') == null ? $general_configuration->brand_name : old('brand_name') }}">
                      @endisset
                      @error('brand_name')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Site Footer <span style="color: red">*</span></label>
                      @isset($general_configuration->site_footer)
                        <input type="text" class="form-control" name="site_footer" value="{{ old('site_footer') == null ? $general_configuration->site_footer : old('site_footer') }}">
                      @endisset

                      @error('site_footer')
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
  <script>
    $(document).ready(function() {
      $('#example').DataTable();
      let changeStatusUrl = "{{ route('general-configurations.otp_configuration.update') }}";
      // Changing Status
      $(".status_check").on('change', function(e) {
        console.log("fdfd");    
        let currentStatus = "";
        if ($(this).prop('checked') == true) {
          currentStatus = 1;
          $(this).closest('tr').find('.status').text('active');
        } else {
          currentStatus = 0;
          $(this).closest('tr').find('.status').text('deactive');
        }
        var status = $(this);
        e.preventDefault();
        $.ajax({
          url: changeStatusUrl,
          type: "Post",
          data: {
            status: currentStatus
          },
          success: function(response) {
            if (response == "unauthorized") {
              e.preventDefault();
              swal("Error!", "Status Not Changed , Because You have No Rights To change status", "error");
              status.prop('checked', false);
            }
            if (response == "success") {
              Swal.fire({
                title: 'Status Changed!',
                text: "User Status Has been Changed!",
                animation: false,
                customClass: 'animated pulse',
                type: 'success',
              });
            //   location.reload();
            } else {
              swal({
                title: 'Error occurred!',
                text: "Failed to Change User Access Status!",
                animation: false,
                customClass: 'animated pulse',
                type: 'error',
              });
            }
          }
        })
      })
    });
  </script>
  <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('site/sweet-alert/sweetalert2.min.js') }}"></script>
@endpush
