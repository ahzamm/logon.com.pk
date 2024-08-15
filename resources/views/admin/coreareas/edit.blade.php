<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Core Area</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form id="ipEditForm">
        <div class="alert bg-danger text-light pb-0" id="EditAllowedIpError" style="display: none">
        </div>
        <input type="hidden" name="id" value="{{$coreArea->id}}">
        <div class="form-group">
          <label for="exampleInputEmail1">Area Name</label>
        <input type="text" name="area_name" value="{{$coreArea->name}}" class="form-control">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Select City</label>
          <select name="city" id="" class="form-control">
            <option value> Select City</option>
            @foreach ($cities as $item)
              <option value="{{$item->id}}" {{$coreArea->city_id == $item->id?'selected':''}}>{{$item->name}}</option>
            @endforeach
          </select>
        </div>
        {{-- <div class="form-group clearfix">
          <div class="icheck-success d-inline">
            <input type="checkbox"  {{$coreArea->active == 1? 'checked' :'unchecked' }} name="active" id="checkboxSuccess1">
            <label for="checkboxSuccess1">
                Status
            </label>
          </div>
        </div> --}}
      </form>
  </div>
  <div class="modal-footer">
    <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" form="ipEditForm" class="btn btn-primary">Edit Core Area</button>
  </div>