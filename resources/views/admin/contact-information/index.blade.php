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
              <h3 class="card-title mb-0"><span><i class="fa fa-wrench"></i></span> Update Contact Information</h3>
              <div class="ml-auto">
              </div>
            </div>
            <form action="{{ route('contact-information.update', $contact_information->id) }}" method="POST" enctype="multipart/form-data">
              @method('PUT')
              <div class="card-body pad">
                @csrf
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Phone <span style="color: red">*</span></label>
                      @isset($contact_information->phone)
                        <input type="text" class="form-control" name="phone" value="{{ old('phone') == null ? $contact_information->phone : old('phone') }}">
                      @endisset
                      @error('phone')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>


                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Phone Slogan<span style="color: red">*</span></label>
                      @isset($contact_information->phone_slogan)
                      <textarea name="phone_slogan" rows="4" placeholder="Example : How are you" required class="form-control summernote">{{ $contact_information->phone_slogan }}</textarea>
                      @endisset
                      @error('phone_slogan')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>


                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Email <span style="color: red">*</span></label>
                      @isset($contact_information->email)
                        <input type="text" class="form-control" name="email" value="{{ old('email') == null ? $contact_information->email : old('email') }}">
                      @endisset
                      @error('email')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>


                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Email Slogan <span style="color: red">*</span></label>
                      @isset($contact_information->email_slogan)
                      <textarea name="email_slogan" rows="4" placeholder="Example : How are you" required class="form-control summernote">{{ $contact_information->email_slogan }}</textarea>
                      @endisset
                      @error('email_slogan')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>


                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Address <span style="color: red">*</span></label>
                      @isset($contact_information->address)
                        <input type="text" class="form-control" name="address" value="{{ old('address') == null ? $contact_information->address : old('address') }}">
                      @endisset
                      @error('address')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Address Url<span style="color: red">*</span></label>
                      @isset($contact_information->address)
                        <input type="text" class="form-control" name="address_url" value="{{ old('address_url') == null ? $contact_information->address_url : old('address_url') }}">
                      @endisset
                      @error('address_url')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>


                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Google <span style="color: #a91525;">Coordinates</span> <span style="color: red">*</span>
                        <span class="tooltip-container">
                          <i class="fa fa-question-circle"></i>
                          <div class="tooltip-content" style=" display: none;">
                            <iframe class="tooltip-map" 
                                    src="https://www.google.com/maps?q={{ $contact_information->cordinates }}&hl=es;z=14&output=embed"
                                    width="100%" height="200px" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                          </div>
                        </span>
                      </label>
                        <input type="text" id="cordinates" class="form-control" name="cordinates" oninput="getLocationCordinates()"
                        value="{{ old('cordinates') == null ? $contact_information->cordinates : old('cordinates') }}">
                      @error('cordinates')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>


                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Address Slogan <span style="color: red">*</span></label>
                      @isset($contact_information->address_slogan)
                      <textarea name="address_slogan" rows="4" placeholder="Example : How are you" required class="form-control summernote">{{ $contact_information->address_slogan }}</textarea>
                      @endisset
                      @error('address_slogan')
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
  <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('site/sweet-alert/sweetalert2.min.js') }}"></script>
  <script>
     $(document).ready(function() {
      $('#pageContent').summernote({
        height: 300
      });
      // Hover functionality for the tooltip
      $('.tooltip-container').hover(function() {
        var $tooltip = $(this).find('.tooltip-content');
        var $img = $tooltip.find('.tooltip-img');
        $img.attr('src', $img.data('src')); // Set the src attribute to play the GIF
        $tooltip.css('display', 'block');
      }, function() {
        var $tooltip = $(this).find('.tooltip-content');
        var $img = $tooltip.find('.tooltip-img');
        $img.attr('src', ''); // Clear the src attribute to stop the GIF
        $tooltip.css('display', 'none');
      });
    });

    function getLocationCordinates() {
      var cordinates = $('#cordinates').val()
      console.log(cordinates);
      document.querySelector('.tooltip-map').src = `https://www.google.com/maps?q=${cordinates}&hl=es;z=14&output=embed`;
    }
  </script>
@endpush
