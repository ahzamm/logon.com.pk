@extends('site.layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{asset('sweet-alert/sweetalert2.css')}}">
@endpush
@section('content')
<div class="modal fade" id="selectionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <h5></h5>
            <h5 class="modal-title custom-modal-title pt-4" id="exampleModalLabel" style="font-family: 'Times New Roman', Times, serif">Find Us</h5>
            <button type="button" class="close1 custom-modal-close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body px-md-5">
          <form action="" method="get" id="selectlocationform">
              <div class="form-group">
                <select name="" id="cities" class="form-control">
                    <option value>Select City</option>
                    <option value>Select City</option>
                    <option value>Select City</option>
                    <option value>Select City</option>
                    <option value>Select City</option>
                </select>
              </div>
              <div class="form-group">
                <select name="" id="coreareas" class="form-control">
                    <option value>Select Core Area</option>
                </select>
              </div>
              <div class="form-group">
                <select name="" id="zoneareas" class="form-control">
                    <option value>Select Zone</option>
                </select>
              </div>
              <div class="form-group message-btn centred mt-3">
                <button type="submit" class="theme-btn-two" id="submit-form-btn" name="submit-form">Search</button>
                </div>
          </form>
        </div>
      </div>
    </div>
</div>

{{-- Message Modal --}}
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <h5></h5>
            <h5 class="modal-title custom-modal-title pt-4" id="exampleModalLabel" style="font-family: 'Times New Roman', Times, serif">Logon Broadband</h5>
            <button type="button" class="close1 custom-modal-close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body px-5 custom-modal-body">
            <p class="text-center">We are happy to see you here. <b>Congrats,</b> we are obtainable in your selected location!</p>
            <p class="text-center">Choose our service to be a Member or a Consumer</p>
            <div class="form-group message-btn centred mt-3">
                <button type="button" style="width:100%" class="theme-btn-two" id="showpartner" name="submit-form">Be a Member</button>
            </div>
            <div class="form-group message-btn centred mt-3">
                <button type="button" style="width: 100%" class="theme-btn-two" id="showuser" name="submit-form">Be a Consumer</button>
            </div>
        </div>
      </div>
    </div>
</div>
{{-- Message Modal End --}}
{{-- Partner Modal --}}
<div class="modal fade" id="PartnerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <h5></h5>
            <h5 class="modal-title custom-modal-title pt-4" id="exampleModalLabel" style="font-family: 'Times New Roman', Times, serif">Be a Member</h5>
            <button type="button" class="close1 custom-modal-close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body px-md-5 custom-modal-body">
            <ul class="alert alert-danger" id="pError" style="display:none">
            </ul>
            <form action="" method="get" id="becomeAPartnerFrm" autocomplete="off">
                <input type="hidden" name="city_id" id="p_city_id" value="">
                <input type="hidden" name="core_area_id" id="p_core_area_id" value="">
                <input type="hidden" name="zone_area_id" id="p_zone_area_id" value="">
                <div class="form-group">
                  <input type="text" class="form-control" name="name" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="address" placeholder="Enter Address">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="landmark" placeholder="Enter Nearest Landmark">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="mobile_no" placeholder="Enter Mobile No">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="Enter Email">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="no_of_users" placeholder="Enter No.of Users">
                  </div>
                  <!---->
                  <div class="g-recaptcha" data-sitekey="6LePJq4kAAAAAJHw9YdsCFwcNaUFbDuyd6kgnsHR"></div>
                  <!---->
                <div class="form-group message-btn centred mt-3">
                  <button type="submit" class="theme-btn-two" id="p-btn" name="submit-form">Send</button>
                  </div>
            </form>
        </div>
      </div>
    </div>
</div>
{{-- Partner Modal End --}}
{{-- User  Modal --}}
<div class="modal fade" id="UserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <h5></h5>
            <h5 class="modal-title custom-modal-title pt-4" id="exampleModalLabel" style="font-family: 'Times New Roman', Times, serif">Be a Consumer</h5>
            <button type="button" class="close1 custom-modal-close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body px-md-5 custom-modal-body">
            <ul class="alert alert-danger" id="uError" style="display:none">
            </ul>
            <form action="" method="get" id="becomeAUserFrm" autocomplete="off">
                <input type="hidden" name="city_id" id="u_city_id" value="">
                <input type="hidden" name="core_area_id" id="u_core_area_id" value="">
                <input type="hidden" name="zone_area_id" id="u_zone_area_id" value="">
                <div class="form-group">
                  <input type="text" class="form-control" name="name" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="address" placeholder="Enter Address">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="landmark" placeholder="Enter Nearest Landmark">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="mobile_no" placeholder="Enter Mobile No">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="Enter Email">
                  </div>
                  <!---->
                  <div class="g-recaptcha" data-sitekey="6LePJq4kAAAAAJHw9YdsCFwcNaUFbDuyd6kgnsHR"></div>
                  <!---->
                <div class="form-group message-btn centred mt-3">
                  <button type="submit" class="theme-btn-two" id="u-btn" name="submit-form">Send</button>
                  </div>
            </form>
        </div>
      </div>
    </div>
</div>
{{-- User Modal End --}}

     <!-- page-title -->
 <section class="page-title style-two" style="background-image: url(site/images/background/coverage-area.png); ">
    <div class="container">
        <div class="content-box clearfix">
            <div class="title-box pull-left">
                <h1>Logon Broadband</h1>
                <p>We're changing the World with Technology</p>
            </div>
        </div>
    </div>
</section>
<!-- page-title end -->
<section class="designe-process">
    <div class="container">
        <div class="sec-title center"><h2>Select your Province to explore Coverage Area</h2></div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                <div class="single-item wow fadeInRight" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="inner-box cityClick" style="padding: 50px 30px 50px 30px;" data-value="sindh">
                        <div class="left-layer"></div>
                        <div class="right-layer"></div>
                        <div  style="z-index:1;position: relative;">
                            <img src="{{asset('site/images/cities/sindh.png')}}" alt="sindh" srcset="">
                        </div>
                        <h4><a>Sindh</a></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                <div class="single-item wow fadeInRight" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="inner-box cityClick" style="padding: 50px 30px 50px 30px;" data-value="punjab">
                        <div class="left-layer"></div>
                        <div class="right-layer"></div>
                        <div  style="z-index:1;position: relative;">
                            <img src="{{asset('site/images/cities/punjab.png')}}" alt="punjab" srcset="">
                        </div>
                        <h4><a>Punjab</a></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                <div class="single-item wow fadeInRight" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="inner-box cityClick" style="padding: 50px 30px 50px 30px;" data-value="balochistan">
                        <div class="left-layer"></div>
                        <div class="right-layer"></div>
                        <div  style="z-index:1;position: relative;">
                            <img src="{{asset('site/images/cities/balochistan.png')}}" alt="balochistan" srcset="">
                        </div>
                        <h4><a>Balochistan</a></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                <div class="single-item wow fadeInRight" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="inner-box cityClick" style="padding: 50px 30px 50px 30px;" data-value="kpk">
                        <div class="left-layer"></div>
                        <div class="right-layer"></div>
                        <div  style="z-index:1;position: relative;">
                            <img src="{{asset('site/images/cities/kpk.png')}}" alt="kpk" srcset="">
                        </div>
                        <h4><a>KPK</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- clients-style-four -->
@livewire('front.corporate-logo')
<!-- clients-style-four end -->
@endsection
@push('scripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script src="{{asset('sweet-alert/sweetalert2.min.js')}}"></script>
    <script>
        function printErrorMsg(msg,container) {
            $(container).html('');
            $(container).css('display','block');
            $.each( msg, function( key, value ) {
                $(container).append('<li>'+value+'</li>');
            });
        }
        function validateRequired(field)
        {
            if($(field).val() != "")
            {
                $(field).attr('style','');
                return true;
            }
            $(field).css('border','1px red solid');
            return false;
        }
        $(document).on('click','.cityClick',function(){
            $('#selectionModal').modal('show');
            province = $(this).attr('data-value');
            $.getJSON('/site/cities/'+province,function(data){
                $('#cities').html('');
                $('#cities').append('<option value>Select Cities</option>');
                $('#coreareas').html('<option value>Select Core Area</option>');
                $('#zoneareas').html('<option value>Select Zone</option>');
                $.each(data.cities,function(index,item){
                    $('#cities').append('<option value="'+item.id+'">'+item.name+'</option>');
                });
            });
        });
        $(document).on('change','#cities',function(){
            cityId = $(this).val();
            $.getJSON('/site/corearea/'+cityId,function(data){
                // console.log(data);
                $('#coreareas').html('');
                $('#coreareas').append('<option value>Select Core Area</option>');
                $.each(data.coreareas,function(index,item){
                    $('#coreareas').append('<option value="'+item.id+'">'+item.name+'</option>');
                });
            });
        })
        $(document).on('change','#coreareas',function(){
            cityId = $(this).val();
            $.getJSON('/site/zonearea/'+cityId,function(data){
                // console.log(data);
                $('#zoneareas').html('');
                $('#zoneareas').append('<option value>Select Zone</option>');
                $.each(data.zoneareas,function(index,item){
                    $('#zoneareas').append('<option value="'+item.id+'">'+item.name+'</option>');
                });
            });
        })
        $(document).on('submit','#selectlocationform',function(e){
            e.preventDefault();
            city = $('#cities');
            corearea = $('#coreareas');
            zonearea = $('#zoneareas');
            if(validateRequired(city) && validateRequired(corearea) && validateRequired(zonearea))
            {
                $('#selectionModal').modal('hide');
                setTimeout(function() {
                    $('#messageModal').modal('show');
                    }, 500);
            }
        })
        $(document).on('click','#showpartner',function(){
            $('#p_city_id').val($('#cities').val());
            $('#p_core_area_id').val($('#coreareas').val());
            $('#p_zone_area_id').val($('#zoneareas').val());
            $('.modal').modal('hide');
            setTimeout(function() {
                $('#PartnerModal').modal('show');
                document.getElementById("becomeAPartnerFrm").reset();
                    }, 500);

        })
        $(document).on('click','#showuser',function(){
            $('#u_city_id').val($('#cities').val());
            $('#u_core_area_id').val($('#coreareas').val());
            $('#u_zone_area_id').val($('#zoneareas').val());
            $('.modal').modal('hide');
            setTimeout(function() {
                $('#UserModal').modal('show');
                document.getElementById("becomeAUserFrm").reset();
                    }, 500);
        });
        $(document).on('submit','#becomeAPartnerFrm',function(e){
            e.preventDefault();
            $.ajax({
                url: "/site/becomepartner",
                type: "POST",
                data:  new FormData(document.forms.namedItem("becomeAPartnerFrm")),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend:function(){
                    $('#p-btn').prop('disabled',true).html('<img src="{{asset('site/images/loader-darker.gif')}}" width="30" alt="contact-preloader">');
                },
                success:function(res){
                   if($.isEmptyObject(res.error)){
                      if(res.status)
                      {
                        $('.modal').modal('hide');
                        swal('Message','Your request submitted successfully','success' );
                      }
                   }
                   else
                   {
                        printErrorMsg(res.error,'#pError')
                    //    swal('Validation Failed', errMessage);
                      //printErrorMsg(res.error,'#reassignError');
                   }
                },
                error:function(jhxr,status,err)
                {
                   console.log(jhxr);
                },
                complete:function()
                {
                    $('#p-btn').prop('disabled',false).text('Send');
                }
             });
        });
        $(document).on('submit','#becomeAUserFrm',function(e){
            e.preventDefault();
            $.ajax({
                url: "/site/becomeuser",
                type: "POST",
                data:  new FormData(document.forms.namedItem("becomeAUserFrm")),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend:function(){
                    $('#u-btn').prop('disabled',true).html('<img src="{{asset('site/images/loader-darker.gif')}}" width="30" alt="contact-preloader">');
                },
                success:function(res){
                   if($.isEmptyObject(res.error)){
                      if(res.status)
                      {
                        $('.modal').modal('hide');
                        swal('Message','Your request submitted successfully','success' );
                      }
                   }
                   else
                   {
                        printErrorMsg(res.error,'#uError')
                        //swal('Validation Failed', errMessage);
                        //printErrorMsg(res.error,'#reassignError');
                   }
                },
                error:function(jhxr,status,err)
                {
                   console.log(jhxr);
                },
                complete:function()
                {
                    $('#u-btn').prop('disabled',false).text('Send');
                }
             });
        });
    </script>
@endpush