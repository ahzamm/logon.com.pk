<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Zone Area</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form id="ipEditForm">
        <div class="alert bg-danger text-light pb-0" id="EditAllowedIpError" style="display: none">
        </div>
        <input type="hidden" name="id" value="{{$zoneArea->id}}">
        <div class="form-group">
          <label for="exampleInputEmail1">Zone  Name</label>
        <input type="text" name="zone_name" value="{{$zoneArea->name}}" class="form-control">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Select Core Area</label>
          <select name="core_area" id="" class="form-control">
            <option value> Select Core Area</option>
            @foreach ($coreAreas as $item)
              <option value="{{$item->id}}" {{$zoneArea->core_area_id == $item->id?'selected':''}}>{{$item->name}}</option>
            @endforeach
          </select>
        </div>
        {{-- <div class="form-group clearfix">
          <div class="icheck-success d-inline">
            <input type="checkbox"  {{$zoneArea->active == 1? 'checked' :'unchecked' }} name="active" id="checkboxSuccess1">
            <label for="checkboxSuccess1">
                Status
            </label>
          </div>
        </div> --}}
      </form>
  </div>
  <div class="modal-footer">
    <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" form="ipEditForm" class="btn btn-primary">Edit Zone Area</button>
  </div>