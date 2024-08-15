<table class="table">
    <thead>
        <tr>
            <th>
                Menus
            </th>
            <th>
                Access
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($userAccesses as $key => $userAccess)
        <tr>
            <td>
                {{$userAccess->submenu->submenu}}
            </td>
            <td>
                @if($userAccess->status == 1)
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input changeAccess" checked data-value="{{$userAccess->id}}" id="customSwitch{{$key}}">
                        <label class="custom-control-label" for="customSwitch{{$key}}"></label>
                    </div>
                @else
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input changeAccess" data-value="{{$userAccess->id}}" id="customSwitch{{$key}}">
                        <label class="custom-control-label" for="customSwitch{{$key}}"></label>
                    </div>
                @endif
                
            </td>
        </tr>
        @endforeach
    </tbody>
</table>