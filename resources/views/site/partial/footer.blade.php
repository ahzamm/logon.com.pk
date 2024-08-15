

@php
$socials = \App\Models\Social::where('status', 1)->orderBy('sortIds', 'asc')->get();
$contact_information  = \App\Models\ContactInformation::first();
$general_configuration = \App\Models\GeneralConfiguration::first();
@endphp

<!-- main-footer -->
<footer class="main-footer style-five style-six">
  <div class="anim-icons">
    <div class="icon icon-1"><img src="{{ asset('site/images/icons/pattern-21.png') }}" alt=""></div>
  </div>
  <div class="image-layer" style="background-image: url({{ URL::asset('site/images/icons/bg-footer-8.png') }})"></div>
  <div class="container">
    <div class="footer-top">
      <div class="widget-section">
        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
            <div class="about-widget footer-widget">
              {{-- <figure class="footer-logo d-flex justify-content-center"><a href="#"><img src="{{ asset('site/images/title-white.png') }}" alt="footer-logo" style="height: 100px;"></a></figure> --}}
              <figure class="footer-logo d-flex justify-content-center"><a href="#"><img src="{{ asset('site/images/'. $general_configuration->footer_logo) }}" alt="footer-logo" style="height: 100px;"></a></figure>
              <ul class="social-links social-links-footer clearfix d-flex justify-content-center">
                @foreach ($socials  as $social)
                <li><a href="{{$social->url}}" target="_blank"><span style="font-size: 20px" class="{{$social->icon}}"></span></a></li>
                @endforeach
                {{-- <li><a href="https://www.facebook.com/logon.broadband.925" target="_blank"><i class="fab fa-facebook" style="font-size: 20px"></i></a></li>
                <li><a href="https://www.linkedin.com/in/logon-broadband-a42480177/" target="_blank"><i class="fab fa-linkedin-in" style="font-size: 20px"></i></a></li> --}}
              </ul>
            </div>
          </div>
          <div class="col-lg-2 col-md-6 col-sm-12 footer-column">
            <div class="links-widget footer-widget">
              {{-- <h4 class="widget-title">Services</h4>
                            <div class="widget-content">
                                <ul class="list clearfix">
                                    <li><a href="#">Residential Services</a></li>
                                    <li><a href="#">Business Services</a></li>
                                    <li><a href="#">Managed Services</a></li>
                                    <li><a href="#">Other Services</a></li>
                                </ul>
                            </div> --}}
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
            <div class="links-widget footer-widget">
              <h4 class="widget-title">About Company</h4>
              <div class="widget-content">
                <ul class="list clearfix">
                  <li><a href="/about-us">About Us</a></li>
                  <li><a href="/contact-us">Contact Us</a></li>
                  <li><a href="/careers">Careers</a></li>
                  {{-- <li><a href="#">What We Do</a></li> --}}
                </ul>
              </div>
            </div>
          </div>
         

          <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
            <div class="contact-widget footer-widget">
              <h4 class="widget-title">Contact Us</h4>
              <div class="widget-content">
                <ul class="contact-info clearfix">
                  <li><i class="fas fa-map-marker-alt"></i><a href="{{$contact_information->address_url}}" target="_blank">LOGON BROADBAND (PVT) LTD</a> {{$contact_information->address}}</li>
                  <li><i class="fas fa-phone"></i><a href="tel:+9203111156466">{{$contact_information->phone}}</a></li>
                  <li><i class="fas fa-envelope"></i><a href="mailto:{{$contact_information->email}}">{{$contact_information->email}}</a></li>
                </ul>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    {{-- <div class="footer-bottom clearfix">
            <ul class="footer-nav pull-right">
                <li style="visibility: hidden"><a href="#">Terms of Service</a></li>
                <li style="visibility: hidden"><a href="#">Privacy Policy</a></li>
                <li style="visibility: hidden"><a href="#">Legal</a></li>
            </ul>
        </div> --}}
  </div>
  {{-- <div class="copyright">&copy; 2012 <a href="{{ route('home') }}">Logon Broadband Pvt. Limited</a>. All rights reserved</div> --}}
  <div class="copyright">{{$general_configuration->site_footer}}</div>
</footer>
<!-- main-footer end -->
