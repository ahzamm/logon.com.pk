<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit IP Address</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form id="ipEditForm">
        <div class="alert bg-danger text-light pb-0" id="EditAllowedIpError" style="display: none">
        </div>
        <input type="hidden" name="id" value="{{$ip->id}}">
        <div class="form-group">
          <label for="exampleInputEmail1">Person Name</label>
        <input type="text" name="person_name" value="{{$ip->person_name}}" class="form-control">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">IP Address</label>
          <input type="text" class="form-control" value="{{$ip->ip_address}}" name="ip_address" >
        </div>
      </form>
  </div>
  <div class="modal-footer">
    <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" form="ipEditForm" class="btn btn-primary">Add IP Address</button>
  </div>