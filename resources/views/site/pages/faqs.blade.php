@extends('site.layouts.app')
@section('content')
    <!-- page-title -->
<section class="page-title style-two" style="background-image: url(site/images/background/faqs-banner.jpg); ">
   <div class="container">
       <div class="content-box clearfix">
           <div class="title-box pull-left">
               <h1>FAQs | Logon Broadband Internet Service Provider</h1>
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

    @livewire('front.faqs')

<!-- clients-style-four -->
@livewire('front.corporate-logo')
<!-- clients-style-four end -->
@endsection
