@extends('site.layouts.app')
@section('content')
    <!-- page-title -->
<section class="page-title style-two" style="background-image: url(site/images/background/career.png); ">
   <div class="container">
       <div class="content-box clearfix">
           <div class="title-box pull-left">
               <h1>Find the career of your dreams</h1>
               <p>We're changing the World with Technology</p>
           </div>
           {{-- <ul class="bread-crumb pull-right">
               <li>FAQs</li>
               <li><a href="/">Home</a></li>
           </ul> --}}
       </div>
   </div>
</section>
<!-- page-title end -->

<section class="service-style-two elements centred">
    <div class="container">
        <div class="sec-title center"><h2>Current Job Openings</h2></div>
        <div class="inner-content">
            <div class="row">
                @if (count($jobs) > 0)
                    @foreach ($jobs as $item)
                    <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                        <div class="service-block-two wow fadeInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="text">{{$item->job_type}}</div>
                                @php
                                    $encryptId = App\ChiperText::encrypt($item->id)
                                @endphp
                                <h4><a href="{{route('job_detail',$encryptId)}}">{{$item->post_title}}</a></h4>
                                <div class="text">Location: {{$item->city}}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <p>Currently we don't have any job vacancies.</p>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
</section>

<!-- clients-style-four -->
@livewire('front.corporate-logo')
<!-- clients-style-four end -->
@endsection
