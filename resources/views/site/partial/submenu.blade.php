{{-- <ul>
    @foreach($childs as $child)
    <li class="{{count($child->childs) > 0?'dropdown':''}}">
        @if(count($child->childs))
            <a href="#"><i class="{{$child->icon}}"></i> {{$child->menu_name}}</a>
            @include('site.partial.submenu',['childs' => $child->childs])
        @else
        <a href="{{route('pages',$child->slug)}}"><i class="{{$child->icon}}"></i> {{$child->menu_name}}</a>
        @endif
    </li>
    @endforeach
</ul> --}}
<ul class="sub-menu">
    @foreach($childs as $child)
        <li aria-haspopup="true"><a href="{{route('pages',$child->slug)}}"><i class="{{$child->icon}}"></i>{{$child->menu_name}} </a></li>
    @endforeach
</ul>