
<section class="clients-style-four style-five">
    <div class="image-layer" style="background-image: url({{ URL::asset('site/images/icons/layer-image-7.png') }})"></div>
    <div class="container">
        <div class="clients-carousel owl-carousel owl-theme owl-dots-none">
            @foreach ($corporates as $item)
                <figure class="image-box"><a href="#"><img src="{{asset('corporate/'.$item->logo)}}" alt="{{$item->name}}"></a></figure>
            @endforeach
        </div>
    </div>
</section>
