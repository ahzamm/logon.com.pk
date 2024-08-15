<form action="" id="sortMenuForm" method="post">
<ul id="sortable" style="list-style: none" class="p-0">
    
        @foreach ($menus as $item)
        <li class="ui-state-default p-2 mb-2 text-light bg-primary" style="border: 1px white solid">
            <input type="hidden" value="{{$item->id}}" name="menus[]"/>
            <i class="fa fa-sort mr-3"></i> {{$item->menu}}
        </li>
    @endforeach
</ul>
</form>
<div class="modal-footer">
    <div class="sk-circle" style="height: 25px;width: 25px;margin-right: 10px;display: none" id="loader-sortmenu-img">
        <div class="sk-circle1 sk-child"></div>
        <div class="sk-circle2 sk-child"></div>
        <div class="sk-circle3 sk-child"></div>
        <div class="sk-circle4 sk-child"></div>
        <div class="sk-circle5 sk-child"></div>
        <div class="sk-circle6 sk-child"></div>
        <div class="sk-circle7 sk-child"></div>
        <div class="sk-circle8 sk-child"></div>
        <div class="sk-circle9 sk-child"></div>
        <div class="sk-circle10 sk-child"></div>
        <div class="sk-circle11 sk-child"></div>
        <div class="sk-circle12 sk-child"></div>
    </div>
    <input type="button" value="Sort Menus" id="SortPostBtn" class="btn btn-info"/>
</div>