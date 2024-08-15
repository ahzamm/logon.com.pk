{{-- <div>
    <!-- main header -->
    <header class="main-header style-three">
        <div class="header-top">
            <div class="container">
                <div class="inner-container clearfix">
                    <ul class="header-info pull-left">
                        <li><i class="fas fa-phone-volume"></i><a href="tel:+9203111156466">+92 3 11 11 LOGON</a></li>
                        <li><i class="far fa-envelope"></i><a href="mailto:info@logon.com.pk">info@logon.com.pk</a></li>
                    </ul>
                    <ul class="header-nav pull-right">
                        <!-- <li><a href="#">Blog</a></li> -->
                        <li><a href="https://www.facebook.com/logon.broadband.925" target="_blank"><span class="fab fa-facebook-square"></span></a></li>
                    <li><a href="https://www.linkedin.com/in/logon-broadband-a42480177/" target="_blank"><span class="fab fa-linkedin-in"></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="header-upper">
            <div class="outer-container">
                <div class="container">
                    <div class="main-box clearfix">
                        <div class="logo-box pull-left">
                        <figure class="logo"><a href="/"><img src="{{asset('site/images/logo.png')}}" alt=""></a></figure>
                        </div>
                        <div class="menu-area pull-right clearfix">
                            <!--Mobile Navigation Toggler-->
                            <div class="mobile-nav-toggler">
                                <i class="icon-bar"></i>
                                <i class="icon-bar"></i>
                                <i class="icon-bar"></i>
                            </div>
                            <nav class="main-menu navbar-expand-md navbar-light">
                                <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                    <ul class="navigation clearfix">
                                        @foreach ($menus as $item)
                                        
                                            <li class="{{count($item->childs) > 0?'dropdown':''}}">
                                                @if(count($item->childs))
                                                    <a><i class="{{$item->icon}}"></i> {{$item->menu_name}}</a>
                                                    @include('site.partial.submenu',['childs' => $item->childs])
                                                @else
                                                    @if($item->page_id != null)
                                                        <a href="{{route('pages',$item->slug)}}"><i class="{{$item->icon}}"></i> {{$item->menu_name}}</a>
                                                    @else
                                                        <a><i class="{{$item->icon}}"></i> {{$item->menu_name}}</a>
                                                    @endif
                                                    
                                                @endif
                                            </li>
                                        
                                        @endforeach

                                            <li><a href="/contact-us"><i class="fa fa-phone"></i> Contact Us</a></li>
                                            <li><a href="/faqs"><i class="fa fa-question-circle"></i> Faqs</a></li>
                                    </ul>
                                </div>
                            </nav>
                            <!-- <div class="btn-box"><a href="#">Buy Now</a></div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--sticky Header-->
        <div class="sticky-header">
            <div class="container clearfix">
                <!-- <figure class="logo-box"><a href="index.html"><img src="images/logo.png" alt=""></a></figure> -->
                <div class="menu-area">
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- main-header end -->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><i class="fas fa-times"></i></div>
        
        <nav class="menu-box">
        <div class="nav-logo"><a href="index.html"><img src="{{asset('site/images/title-white.png')}}" alt="" title=""></a></div>
            <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
            <div class="contact-info">
                <h4>Contact Info</h4>
                <ul>
                    <li>LOGON BROADBAND (PVT) LTD Glass Tower Office No. E-1, Near Three Swords Clifton, Karachi, Pakistan</li>
                    <li><a href="tel:+9203111156466">+92 3 11 11 LOGON</a></li>
                    <li><a href="mailto:info@logon.com.pk">info@logon.com.pk</a></li>
                </ul>
            </div>
            <div class="social-links">
                <ul class="clearfix">
                     <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                    <li><a href="https://www.facebook.com/logon.broadband.925" target="_blank"><span class="fab fa-facebook-square"></span></a></li>
                    <li><a href="https://www.linkedin.com/in/logon-broadband-a42480177/" target="_blank"><span class="fab fa-linkedin-in"></span></a></li>
                </ul>
            </div>
        </nav>
    </div><!-- End Mobile Menu -->
</div> --}}

<div>
    <!-- Mobile Header -->
  <div class="wsmobileheader clearfix ">
    <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
    {{-- <span class="smllogo"><img src="{{asset('site/images/logo.png')}}" width="100" alt="" /></span> --}}
    {{-- <a href="tel:123456789" class="callusbtn"><i class="fas fa-phone"></i></a> --}}
  </div>
  <!-- Mobile Header -->
  <header class="main-header style-three">
    <div class="header-top d-none d-lg-block">
        <div class="container">
            <div class="inner-container clearfix">
                <ul class="header-info pull-left">
                    <li><i class="fas fa-phone-volume"></i><a href="tel:{{$contact_information->phone}}">{{$contact_information->phone}}</a></li>
                    <li><i class="far fa-envelope"></i><a href="mailto:{{$contact_information->email}}">{{$contact_information->email}}</a></li>
                </ul>
                <ul class="header-nav pull-right">
                    @foreach ($socials as $social)
                    <li><a href="{{$social->url}}" target="_blank"><span style="font-size: 20px" class="{{$social->icon}}"></span></a></li>
                    @endforeach
                    {{-- <li><a href="https://www.facebook.com/logon.broadband.925" target="_blank"><span style="font-size: 20px" class="fab fa-facebook-square"></span></a></li>
                    <li><a href="https://www.linkedin.com/in/logon-broadband-a42480177/" target="_blank"><span style="font-size: 20px" class="fab fa-linkedin-in"></span></a></li> --}}
                </ul>
            </div>
        </div>
    </div>
    <div class="header-upper">
        <div class="outer-container">
            <div class="wsmainfull clearfix">
                {{-- <div class="wsmainwp clearfix"><a href="{{route('home')}}"><img width="200" src="{{asset('site/images/logo.png')}}" alt="logon broadband Pvt. Limited" class="mt-2"></a> --}}
                <div class="wsmainwp clearfix"><a href="{{route('home')}}"><img width="200" src="{{asset('site/images/'. $general_configuration->brand_logo)}}" alt="logon broadband Pvt. Limited" class="mt-2"></a>
                  <!--Main Menu HTML Code-->
                  <nav class="wsmenu clearfix">
                    <ul class="wsmenu-list d-lg-flex justify-content-lg-end">
                      <li aria-haspopup="true"><a href="{{route('home')}}" class=" menuhomeicon"><i class="fas fa-home"></i> Home</a></li>
                      @foreach ($menus as $key =>$item)
                      @if ($item->menu_name == "Services")
                      <li aria-haspopup="true"><a href="#"><i class="fas fa-list-alt"></i>Services<span class="wsarrow"></span></a>
                        <div class="wsmegamenu clearfix custom-meganav">
                          <div class="container-fluid">
                            <div class="row">
                                @foreach ($item->childs as $subitem)
                                    <ul class="col-lg-4 col-md-12 col-xs-12 link-list">
                                    <li class="title text-purp">{{$subitem->menu_name}}</li>
                                    @foreach ($subitem->childs as $thirditem)
                                        <div><b class="text-purp">{{$thirditem->menu_name}}</b></div>
                                        @foreach ($thirditem->childs as $fourthitem)
                                        <li><a href="{{route('pages',$fourthitem->slug)}}"><i class="fas fa-arrow-circle-right"></i>{{$fourthitem->menu_name}}</a></li>
                                        @endforeach
                                    @endforeach
                                  </ul>
                                @endforeach
                            </div>
                          </div>
                        </div>
                      </li>
                      @else
                        @if(count($item->childs))
                        <li aria-haspopup="true"><a href="#" class="menuhomeicon"><i class="{{$item->icon}}"></i> {{$item->menu_name}}</a>
                            @include('site.partial.submenu',['childs' => $item->childs])
                        </li>
                        @else
                        <li aria-haspopup="true"><a href="{{route('pages',$item->slug)}}" class=" menuhomeicon"><i class="{{$item->icon}}"></i> {{$item->menu_name}}</a></li>
                        @endif
                      @endif
                      @endforeach
                      {{-- <li aria-haspopup="true"><a href="/contact-us" class=" menuhomeicon"><i class="fas fa-phone"></i> Contact Us</a></li>
                      <li aria-haspopup="true"><a href="/faqs" class=" menuhomeicon"><i class="fa fa-question-circle"></i> Faqs</a></li> --}}
                    </ul>
                  </nav>
                  <!--Menu HTML Code-->
                </div>
              </div>
        </div>
    </div>
</header>
</div>

