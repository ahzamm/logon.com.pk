 @extends('site.layouts.app')
 @push('styles')
   <link rel="stylesheet" href="{{ asset('sweet-alert/sweetalert2.css') }}">
 @endpush
 @section('content')
   <!-- page-title -->
   <section class="page-title style-two" style="background-image: url(site/images/background/contact-home.jpg); ">
     <div class="container">
       <div class="content-box clearfix">
         <div class="title-box pull-left">
           <h1>Contact Us</h1>
           <p>We're changing the World with Technology</p>
         </div>

       </div>
     </div>
   </section>
   <!-- page-title end -->

   <!-- contact-section -->
   <section class="contact-section">
     <div class="container">
       <div class="row">
         <div class="col-lg-10 col-md-12 col-sm-12 offset-lg-1 big-column">
           <div class="info-content centred">
             <div class="row">
               <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                 <div class="single-info-box">
                   <figure class="icon-box"><img src="{{ asset('site/images/icons/info-icon-1.png') }}" alt=""></figure>
                   <h2>Phone</h2>
                   <div class="text">{{ $contact_information->phone_slogan }}</div>
                   <div class="phone"><a href="tel:{{ $contact_information->phone }}">{{ $contact_information->phone }}</a></div>
                 </div>
               </div>
               <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                 <div class="single-info-box">
                   <figure class="icon-box"><img src="{{ asset('site/images/icons/info-icon-2.png') }}" alt=""></figure>
                   <h2>E-mail</h2>
                   <div class="text">{{ $contact_information->email_slogan }}</div>
                   <div class="phone"><a href="mailto:{{ $contact_information->email }}">{{ $contact_information->email }}</a></div>
                 </div>
               </div>
               <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                 <div class="single-info-box">
                   <figure class="icon-box"><img src="{{ asset('site/images/icons/info-icon-3.png') }}" alt=""></figure>
                   <h2>Address</h2>
                   <div class="text">{{ $contact_information->address_slogan }}</div>
                   <div class="phone"><a href="{{ $contact_information->address_url }}" target="_blank">View on Google map</a></div>
                 </div>
               </div>

               {{-- <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                            <div class="single-info-box">
                                <figure class="icon-box"><img src="{{asset('site/images/icons/info-icon-1.png')}}" alt=""></figure>
                                <h2>Phone</h2>
                                <div class="text">Start working with Logon that can provide everything.</div>
                                <div class="phone"><a href="tel:+9203111156466">+92 3 11 11 LOGON</a></div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                            <div class="single-info-box">
                                <figure class="icon-box"><img src="{{asset('site/images/icons/info-icon-2.png')}}" alt=""></figure>
                                <h2>E-mail</h2>
                                <div class="text">Start working with Logon that can provide everything.</div>
                                <div class="phone"><a href="mailto:info@logon.com.pk">info@logon.com.pk</a></div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                            <div class="single-info-box">
                                <figure class="icon-box"><img src="{{asset('site/images/icons/info-icon-3.png')}}" alt=""></figure>
                                <h2>Address</h2>
                                <div class="text">Glass Tower Office No. E-1, Near Three Swords Clifton, Karachi.</div>
                                <div class="phone"><a href="https://goo.gl/maps/cFSRUhohxWqzKeBk8" target="_blank">View on Google map</a></div>
                            </div>
                        </div> --}}
             </div>
           </div>

           <div class="contact-form-area">
             <div class="sec-title center">
               <h2>Contact us</h2>
             </div>
             <div class="form-inner">
               <p class="my-4 text-center" style="display:none;" id="contact-message">Your Request Send successfully</p>
               <form method="post" action="{{ route('contact-us') }}" id="contact-form" class="default-form">
                 @csrf
                 <div class="row">
                   <div class="col-lg-6 col-md-12 col-sm-12 column">
                     <div class="form-group">
                       <i class="fas fa-user"></i>
                       <input type="text" name="username" placeholder="Name" required>
                     </div>
                   </div>
                   <div class="col-lg-6 col-md-12 col-sm-12 column">
                     <div class="form-group">
                       <i class="fas fa-envelope"></i>
                       <input type="email" name="email" placeholder="Email" required>
                     </div>
                   </div>
                   <div class="col-lg-6 col-md-12 col-sm-12 column">
                     <div class="form-group">
                       <i class="fas fa-file"></i>
                       <input type="text" name="subject" placeholder="Subject">
                     </div>
                   </div>
                   <div class="col-lg-6 col-md-12 col-sm-12 column">
                     <div class="form-group">
                       <i class="fas fa-phone"></i>
                       <input type="text" name="phone" placeholder="Phone">
                     </div>
                   </div>
                   <div class="col-lg-12 col-md-12 col-sm-12 column">
                     <div class="form-group">
                       <textarea name="message" placeholder="Write here message"></textarea>
                     </div>
                   </div>
                   <center>
                     <div class="g-recaptcha" data-sitekey="6LePJq4kAAAAAJHw9YdsCFwcNaUFbDuyd6kgnsHR"></div>
                   </center>

                   <div class="col-lg-12 col-md-12 col-sm-12 column">
                     <div class="form-group message-btn centred">
                       <button type="submit" class="theme-btn-two" id="submit-form-btn" name="submit-form">Submit Form</button>
                     </div>
                   </div>
                 </div>
               </form>
             </div>
           </div>
         </div>
       </div>
     </div>
   </section>
   <!-- contact-section end -->
   <!-- clients-style-four -->
   @livewire('front.corporate-logo')
   <!-- clients-style-four end -->
 @endsection
 @push('scripts')
   <script src="https://www.google.com/recaptcha/api.js" async defer></script>

   <script src="{{ asset('sweet-alert/sweetalert2.min.js') }}"></script>
   <script>
     $(document).on('submit', '#contact-form', function(e) {
       e.preventDefault();
       //  document.getElementById("myForm").reset();

       $.ajax({
         url: "/contact-us",
         type: "POST",
         data: new FormData(document.forms.namedItem("contact-form")),
         contentType: false,
         cache: false,
         processData: false,
         dataType: 'JSON',
         beforeSend: function() {
           $('#submit-form-btn').prop('disabled', true).html(
             '<img src="{{ asset('site/images/loader-darker.gif') }}" width="30" alt="contact-preloader">');
         },
         success: function(res) {
           if (res.status) {
             document.getElementById("contact-form").reset();
             // $('#contact-message').text(res.message).fadeIn(200).css('color','#4527a4');
             swal('Message', 'Request Sent Successfully', 'success');
           } else {
             swal('Error', res.message, 'error');
             // $('#contact-message').text(res.message).fadeIn(200).css('color','red');
           }
         },
         error: function(jhxr, status, err) {
           console.log(jhxr);
         },
         complete: function() {
           $('#submit-form-btn').prop('disabled', false).text('Submit Form');
         }
       });
     })
   </script>
 @endpush
