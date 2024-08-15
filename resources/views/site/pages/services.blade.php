@extends('site.layouts.app')
@section('metainfo')
    <meta name="{{$menu->frontPage->meta_tag}}" content="{{$menu->frontPage->meta_description}}" />
@endsection
@section('title')
    {{$menu->frontPage->page_title}}
@endsection
@section('content')
    <!-- page-title -->
    <section class="page-title style-two" style="background-image: url(pagesbanner/{{$menu->frontPage->banner_image}}); ">
         <div class="container" > {{--style="background-color: rgba(1,1,1,0.5);" --}}
            <div class="content-box clearfix">
                <div class="title-box pull-left">
                    <h1>{{$menu->frontPage->name}}</h1>
                    <p>{{$menu->frontPage->slogan}}</p>
                </div>
                {{-- <ul class="bread-crumb pull-right">
                    <li>Contact</li>
                    <li><a href="#">Home</a></li>
                </ul> --}}
            </div>
        </div>
    </section>
    <!-- page-title end -->
     <!-- service-details -->
     <section class="service-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="service-sidebar">
                        <div class="sidebar">
                        <h3>{{$parentMenu->menu_name}}</h3>
                            <!-- <div class="text">Excepteur sint occaecat cupidatat pro ident sunt culpa officia desernt mollit</div> -->
                            <ul class="list">
                                @foreach ($parentMenu->childs as $item)
                                <li><a href="{{route('pages',$item->slug)}}">{{$item->menu_name}}</a></li>
                                @endforeach
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="service-details-content">
                        <div class="inner-box">
                            <div class="top-content">
                                <div class="sec-title">
                                    <h2>{{$menu->frontPage->name}}</h2>
                                </div>
                                {{-- <figure class="image-box"><img src="{{asset('site/images/resource/service-details-1.jpg')}}" alt=""></figure> --}}
                                <div class="text text-dark">
                                    {!! $menu->frontPage->content !!}
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- service-details end -->
    @livewire('front.corporate-logo')
@endsection