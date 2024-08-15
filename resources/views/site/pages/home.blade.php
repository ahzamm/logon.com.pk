@php
  $content = \App\Models\ModalShow::first();
  //  dd(date('Y-m-d',strtotime(now())));
@endphp
@extends('site.layouts.app')
@section('content')
  {{-- Modal For Any Offer or Update --}}
  @if ($content != null && date('Y-m-d', strtotime(now())) >= date('Y-m-d', strtotime($content->start_date)) && date('Y-m-d', strtotime(now())) <= date('Y-m-d', strtotime($content->end_date)))
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5></h5>
            <h5 class="modal-title custom-modal-title" id="exampleModalLabel">{{ $content->modalContent->title }}</h5>
            <button type="button" class="close1 custom-modal-close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body px-4 custom-modal-body">
            <img src="{{ asset('modalimages/' . $content->modalContent->image) }}" alt="" class="img-fluid">
            <p class="text-justify">{!! $content->modalContent->content !!}</p>
          </div>
        </div>
      </div>
    </div>
  @endif
  {{-- End Modal For Any Offer or Update --}}

  <!-- banner-section -->
  <section class="banner-style-18">
    @livewire('front.slider')
  </section>
  <!-- banner-section end -->
  <!-- domain-section -->
  <section class="domain-section">
    <div class="container">
      <div class="inner-container inner-container-home">
        <div class="sec-title center">
          <h2 style="margin-bottom: 50px;">Why You Should Choose Us</h2>
        </div>
        <div class="inner-content">
          <div class="row">
            @foreach ($whychooseus as $item)
              <div class="col-lg-4 col-md-4 col-sm-12 text-center service-block service-block-city">
                <div>
                  <div class="bg-layer" style="background-image: url(site/images/icons/pattern-34.png);"></div>
                  <div class="icon-box"><i class="{{ $item->icon }}"></i></div>
                  {{-- <div class="icon-box"><i class="flaticon-presentation"></i></div> --}}
                  <h3><a href="#">{{ $item->heading }}</a></h3>
                  <div class="text">{!! $item->text !!}</div>
                </div>
              </div>
            @endforeach
            {{-- <div class="col-lg-4 col-md-4 col-sm-12 text-center service-block service-block-city">
              <div>
                <div class="bg-layer" style="background-image: url(site/images/icons/pattern-34.png);"></div>
                <div class="icon-box"><i class="flaticon-analysis"></i></div>
                <h3><a href="#">No Buffering and Lags</a></h3>
                <div class="text">Now enjoy buffering free videos on your favorite video streaming sites.</div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 text-center service-block service-block-city">
              <div>
                <div class="bg-layer" style="background-image: url(site/images/icons/pattern-34.png);"></div>
                <div class="icon-box"><i class="flaticon-startup"></i></div>
                <h3><a href="#">Upload and Download</a></h3>
                <div class="text">You can now upload large files on internet without loss of bandwidths.</div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 text-center service-block service-block-city">
              <div>
                <div class="bg-layer" style="background-image: url(site/images/icons/pattern-34.png);"></div>
                <div class="icon-box"><i class="flaticon-server-1"></i></div>
                <h3><a href="#">Unlimited Data Volume</a></h3>
                <div class="text">Experience the true essence of internet browsing without the limitations.</div>
              </div>
            </div> --}}
          </div>
        </div>
        {{-- <form class="form-inline d-flex justify-content-center">
                    <select class="form-control mb-2 mr-sm-2" placeholder="Jane Doe">
                        <option value>-- --</option>
                    </select>
                    <select class="form-control mb-2 mr-sm-2" placeholder="Jane Doe">
                        <option value="">A</option>
                    </select>
                    <select class="form-control mb-2 mr-sm-2" placeholder="Jane Doe">
                        <option value="">A</option>
                    </select>
                    <button type="submit" class="btn btn-primary mb-2">Search</button>
                  </form>
                 <div class="search-form">
                    <form action="#" method="post">
                        <div class="form-group">
                            <input type="text" name="domain_name" placeholder="Enter Your Location" required="">
                            <button type="submit">Search Now</button>
                        </div>
                    </form> --}}
      </div>
      <!-- <ul class="domain-name clearfix">
                          <li><a href="#"><span>.com</span> $6.50</a></li>
                          <li><a href="#"><span>.sg</span> $10</a></li>
                          <li><a href="#"><span>.info</span> $11</a></li>
                          <li><a href="#"><span>.co</span> $9.50</a></li>
                          <li><a href="#"><span>.net</span> $7.50</a></li>
                      </ul> -->
    </div>
    </div>
  </section>
  <!-- domain-section end -->

  <!-- service-style-four -->
  <section class="service-style-four">
    <div class="container">
      <div class="sec-title center">
        <h3>Our Services</h3>
        <h2>What Featured that We Provide</h2>
      </div>
      <div class="inner-content">
        <div class="row">
          @foreach ($services as $service)
            <div class="col-lg-4 col-md-6 col-sm-12 service-block">
              <div class="service-block-three wow fadeInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                <div class="inner-box">
                  <div class="icon-box">
                    <div class="bg-layer" style="background-image: url(site/images/icons/icon-bg-{{ (($loop->iteration - 1) % 6) + 1 }}.png);"></div>
                    <i class="{{ $service->icon }}"></i>
                  </div>
                  <h3><a href="#">{{ $service->heading }}</a></h3>
                  <div class="text">{{ $service->text }}</div>
                </div>
              </div>
            </div>
          @endforeach



          {{-- <div class="col-lg-4 col-md-6 col-sm-12 service-block">
            <div class="service-block-three wow fadeInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
              <div class="inner-box">
                <div class="icon-box">
                  <div class="bg-layer" style="background-image: url(site/images/icons/icon-bg-3.png);"></div>
                  <i class="flaticon-profit"></i>
                </div>
                <h3><a href="#">Internet</a></h3>
                <div class="text">With Logon broadband you can Experience amazingly high-speed internet service in all over the Pakistan, with no buffering no lags and no more waiting.</div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-12 service-block">
            <div class="service-block-three wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
              <div class="inner-box">
                <div class="icon-box">
                  <div class="bg-layer" style="background-image: url(site/images/icons/icon-bg-1.png);"></div>
                  <i class="flaticon-server"></i>
                </div>
                <h3><a href="#">Wireless Connectivity</a></h3>
                <div class="text">Our strong wireless connectivity gives you point to point and point to multipoint private, secure and max speed network connection for corporate sector.</div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-12 service-block">
            <div class="service-block-three wow fadeInRight animated" data-wow-delay="00ms" data-wow-duration="1500ms">
              <div class="inner-box">
                <div class="icon-box">
                  <div class="bg-layer" style="background-image: url(site/images/icons/icon-bg-4.png);"></div>
                  <i class="flaticon-seo-and-web"></i>
                </div>
                <h3><a href="#">IT</a></h3>
                <div class="text">Logon’s IT Experts gives you the international standard level of services for Complete IT Solutions like ERP and Cloud Computing.</div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-12 service-block">
            <div class="service-block-three wow fadeInLeft animated" data-wow-delay="300ms" data-wow-duration="1500ms">
              <div class="inner-box">
                <div class="icon-box">
                  <div class="bg-layer" style="background-image: url(site/images/icons/icon-bg-2.png);"></div>
                  <i class="flaticon-flow-chart"></i>
                </div>
                <h3><a href="#">Network Management Infrastructure</a></h3>
                <div class="text">Logon can assist you with your need of network support Whether you need new network setup, network upgrade or network trouble shooting.</div>

              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-12 service-block">
            <div class="service-block-three wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
              <div class="inner-box">
                <div class="icon-box">
                  <div class="bg-layer" style="background-image: url(site/images/icons/icon-bg-6.png);"></div>
                  <i class="flaticon-support"></i>
                </div>
                <h3><a href="#">IP Telephonic (VOIP)</a></h3>
                <div class="text">Logon Ip telephonic solution voice over internet protocol (VOIP) and Private box exchange is a telephone system replaces services by traditional PBX systems while
                  running over your LAN and utilizing an internet connection.</div>

              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-12 service-block">
            <div class="service-block-three wow fadeInRight animated" data-wow-delay="300ms" data-wow-duration="1500ms">
              <div class="inner-box">
                <div class="icon-box">
                  <div class="bg-layer" style="background-image: url(site/images/icons/icon-bg-5.png);"></div>
                  <i class="flaticon-shield-2"></i>
                </div>
                <h3><a href="#">Surveillance Security Solutions</a></h3>
                <div class="text">Logon’s surveillance security solutions from the world leading surveillance companies for intelligent video surveillance with smart features of IP cameras, Smart
                  NVRS and video management software.</div>

              </div>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
  </section>
  <!-- service-style-four end -->

  <!-- best-hosting -->
  {{-- <section class="best-hosting">
        <div class="container">
            <div class="sec-title center">
                <!-- <h3>Fast Internet</h3> -->
                <h2>Why You Should Choose Us</h2>
            </div>
            <div class="inner-content">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 single-column">
                        <div class="single-item wow flipInY" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="bg-layer" style="background-image: url(site/images/icons/pattern-34.png);"></div>
                                <div class="icon-box"><i class="flaticon-analysis"></i></div>
                                <h3><a href="#">No Buffering and Lags</a></h3>
                                <div class="text">Now enjoy buffering free videos on your favorite video streaming sites.</div>
                                <div class="link-btn"><a href="#"><i class="fas fa-long-arrow-alt-right"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 single-column">
                        <div class="single-item wow flipInY" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="bg-layer" style="background-image: url(site/images/icons/pattern-34.png);"></div>
                                <div class="icon-box"><i class="flaticon-startup"></i></div>
                                <h3><a href="#">Upload and Download</a></h3>
                                <div class="text">You can now upload large files on internet without loss of bandwidths.</div>
                                <div class="link-btn"><a href="#"><i class="fas fa-long-arrow-alt-right"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 single-column">
                        <div class="single-item wow flipInY" data-wow-delay="600ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="bg-layer" style="background-image: url(site/images/icons/pattern-34.png);"></div>
                                <div class="icon-box"><i class="flaticon-server-1"></i></div>
                                <h3><a href="#">Unlimited Volume</a></h3>
                                <div class="text">Experience the true essence of internet browsing without the limitations.</div>
                                <div class="link-btn"><a href="#"><i class="fas fa-long-arrow-alt-right"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
  <!-- best-hosting end -->



  <!-- designe-process -->
  <section class="designe-process service-page">
    <div class="image-layer" style="background-image: url(site/images/icons/layer-image-9.png);"></div>
    <div class="container">
      <div class="sec-title center">
        <h2>Client Benefits</h2>
      </div>
      <div class="row">
        @foreach ($client_benefits as $client_benefit)
          <div class="col-lg-4 col-md-6 col-sm-12 single-column">
            <div class="single-item wow fadeInRight" data-wow-delay="00ms" data-wow-duration="1500ms">
              <div class="inner-box">
                <div class="left-layer"></div>
                <div class="right-layer"></div>
                <div class="icon-box">
                  <i class="{{ $client_benefit->icon }}"></i>
                </div>
                <h4><a href="#">{{ $client_benefit->heading }}</a></h4>
                <div class="text">{{ $client_benefit->text }}</div>
              </div>
            </div>
          </div>
        @endforeach
        {{-- <div class="col-lg-4 col-md-6 col-sm-12 single-column">
          <div class="single-item wow fadeInRight" data-wow-delay="00ms" data-wow-duration="1500ms">
            <div class="inner-box">
              <div class="left-layer"></div>
              <div class="right-layer"></div>
              <div class="icon-box">
                <i class="fas fa-expand-arrows-alt"></i>
              </div>
              <h4><a href="#">Feel The Power Of Fiber</a></h4>
              <div class="text">We have very strong fiber backbone in all over Karachi and currently working with FTTH and FTTO technology.</div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 single-column">
          <div class="single-item wow fadeInLeft" data-wow-delay="00ms" data-wow-duration="1500ms">
            <div class="inner-box">
              <div class="left-layer"></div>
              <div class="right-layer"></div>
              <div class="icon-box">
                <i class="fas fa-sliders-h"></i>
              </div>
              <h4><a href="#">Unleash Faster Internet</a></h4>
              <div class="text">All our packages are truly fast and truly unlimited. Speed will never drop during the month.</div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 single-column">
          <div class="single-item wow fadeInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
            <div class="inner-box">
              <div class="left-layer"></div>
              <div class="right-layer"></div>
              <div class="icon-box">
                <i class="fas fa-columns"></i>
              </div>
              <h4><a href="#">Peering ~ all Major Sites</a></h4>
              <div class="text">Watch YouTube & Facebook in HD videos without buffering. Seamless streaming and browsing with all major sites.</div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 single-column">
          <div class="single-item wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1500ms">
            <div class="inner-box">
              <div class="left-layer"></div>
              <div class="right-layer"></div>
              <div class="icon-box">
                <i class="fas fa-edit"></i>
              </div>
              <h4><a href="#">Symmetric Bandwidth</a></h4>
              <div class="text">Symmetric bandwidth, i.e. Download Speed & Upload Speed are same.</div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 single-column">
          <div class="single-item wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
            <div class="inner-box">
              <div class="left-layer"></div>
              <div class="right-layer"></div>
              <div class="icon-box">
                <i class="fas fa-cloud-download-alt"></i>
              </div>
              <h4><a href="#">99% Satisfied Services</a></h4>
              <div class="text">We aim to 100% customer satisfaction and we have achieved 99%.</div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 single-column">
          <div class="single-item wow fadeInRight" data-wow-delay="300ms" data-wow-duration="1500ms">
            <div class="inner-box">
              <div class="left-layer"></div>
              <div class="right-layer"></div>
              <div class="icon-box">
                <i class="fas fa-bolt"></i>
              </div>
              <h4><a href="#">Guaranteed no hidden charges</a></h4>
              <div class="text">Pay only what you see, There is nothing hide from you in terms of payment.</div>
            </div>
          </div>
        </div> --}}
      </div>
    </div>
  </section>
  <!-- designe-precess end -->

  <section class="counter-style-three">
    <div class="anim-icons">
      <div class="icon icon-1 rotate-me"></div>
      <div class="icon icon-2"></div>
      <div class="icon icon-3 rotate-me"></div>
    </div>
    <div class="container">
      <div class="sec-title center">
        <h2>Our Happy Users</h2>
      </div>
      <div class="row">
        @foreach ($happy_clients as $happy_client)
          <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
            <div class="inner-box wow zoomIn animated" data-wow-delay="00ms" data-wow-duration="1500ms">
              <div class="layer-bg" style="background-image: url(site/images/icons/pattern-25.png);"></div>
              <div class="count-outer count-box">
                <span class="count-text" data-speed="1500" data-stop="{{ $happy_client->no_of_clients }}">{{ $happy_client->no_of_clients }} +</span>
              </div>
              <div class="text">{{ $happy_client->client_type }}</div>
            </div>
          </div>
        @endforeach
        {{-- <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
          <div class="inner-box wow zoomIn animated" data-wow-delay="00ms" data-wow-duration="1500ms">
            <div class="layer-bg" style="background-image: url(site/images/icons/pattern-25.png);"></div>
            <div class="count-outer count-box">
              <span class="count-text" data-speed="1500" data-stop="50000">50000 +</span>
            </div>
            <div class="text">Happy Clients</div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
          <div class="inner-box wow zoomIn animated" data-wow-delay="300ms" data-wow-duration="1500ms">
            <div class="layer-bg" style="background-image: url(site/images/icons/pattern-26.png);"></div>
            <div class="count-outer count-box">
              <span class="count-text" data-speed="1500" data-stop="1250">250 +</span>
            </div>
            <div class="text">Corporate Clients</div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
          <div class="inner-box wow zoomIn animated" data-wow-delay="600ms" data-wow-duration="1500ms">
            <div class="layer-bg" style="background-image: url(site/images/icons/pattern-27.png);"></div>
            <div class="count-outer count-box">
              <span class="count-text" data-speed="1500" data-stop="142">300 +</span>
            </div>
            <div class="text">Areas Covered</div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
          <div class="inner-box wow zoomIn animated" data-wow-delay="900ms" data-wow-duration="1500ms">
            <div class="layer-bg" style="background-image: url(site/images/icons/pattern-28.png);"></div>
            <div class="count-outer count-box">
              <span class="count-text" data-speed="1500" data-stop="85000">85000 +</span>
            </div>
            <div class="text">Loved By</div>
          </div>
        </div> --}}
      </div>
    </div>
  </section>


  {{-- <!-- testimonial-style-nine -->
    <section class="testimonial-style-nine home-18 centred">
        <div class="container">
            <div class="sec-title center">
                <h3>Testimonials</h3>
                <h2>What Featured that We Provide</h2>
            </div>
            <div class="testimonial-carousel-2 owl-carousel owl-theme owl-dots-none">
                <div class="testimonial-content">
                    <div class="inner-box">
                    <figure class="image-box"><img src="{{asset('site/images/resource/testimonial-11.png')}}" alt=""></figure>
                        <div class="text">We needed additional insight, which is something that we didn't find when looking at other companies. I would feel that I was teacvhing them things, as opposed to LSEO time.</div>
                        <div class="author-info">
                            <h3 class="name">K. Makanzi Jack</h3>
                            <span class="designation">Creativework</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-content">
                    <div class="inner-box">
                        <figure class="image-box"><img src="{{asset('site/images/resource/testimonial-11.png')}}" alt=""></figure>
                        <div class="text">We needed additional insight, which is something that we didn't find when looking at other companies. I would feel that I was teacvhing them things, as opposed to LSEO time.</div>
                        <div class="author-info">
                            <h3 class="name">K. Makanzi Jack</h3>
                            <span class="designation">Creativework</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-content">
                    <div class="inner-box">
                        <figure class="image-box"><img src="{{asset('site/images/resource/testimonial-11.png')}}" alt=""></figure>
                        <div class="text">We needed additional insight, which is something that we didn't find when looking at other companies. I would feel that I was teacvhing them things, as opposed to LSEO time.</div>
                        <div class="author-info">
                            <h3 class="name">K. Makanzi Jack</h3>
                            <span class="designation">Creativework</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial-style-nine end --> --}}




  <!-- clients-style-four -->
  @livewire('front.corporate-logo')
  <!-- clients-style-four end -->
@endsection
@push('scripts')
  <script>
    $(document).ready(function() {
      $('#exampleModal').modal('show');
    })
  </script>
@endpush
