{{-- <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @foreach ($slides as $key => $item)
            <div class="carousel-item {{$key == 0?'active':''}}" >
                <img src="{{asset('homeslider/'.$item->image)}}" class="d-block w-100" alt="{{$item->image_alt}}">
                <div class="carousel-caption d-none d-lg-flex h-100 flex-column justify-content-center" >
                    <div class="home-slider-title">
                        <h1 class="display-2">{{$item->title}}</h1>
                        <p class="text-light" style="font-size: 24px;margin-top:100px;font-family:'Times New Roman', Times, serif; font-weight: lighter">{{$item->slogan}}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" style="width: 5%;" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" style="width: 5%;" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div> --}}


  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    @isset($slide)
      <div class="video_wrapper">
        <video autoplay muted loop style="width:100%;height:100%">
          <source src="{{ asset('homeslider/videos/' . $slide->image) }}" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>
    @else
      <div class="carousel-inner">
        @foreach ($slides as $key => $item)
          <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
            <img src="{{ asset('homeslider/' . $item->image) }}" class="d-block w-100" alt="{{ $item->image_alt }}">
            <div class="carousel-caption d-none d-lg-flex h-100 flex-column justify-content-center">
              <div class="home-slider-title">
                <h1 class="display-2">{{ $item->title }}</h1>
                <p class="text-light" style="font-size: 24px; margin-top:100px; font-family:'Times New Roman', Times, serif; font-weight: lighter;">{{ $item->slogan }}</p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <a class="carousel-control-prev" style="width: 5%;" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" style="width: 5%;" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    @endisset
  </div>
  
