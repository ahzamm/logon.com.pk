<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Add New IP Address</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form id="ipAddForm">
        <div class="alert bg-danger text-light pb-0" id="AllowedIpError" style="display: none">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Person Name</label>
          <input type="text" name="person_name" class="form-control">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">IP Address</label>
          <input type="text" class="form-control" name="ip_address" >
        </div>
      </form>
  </div>
  <div class="modal-footer">
    <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" form="ipAddForm" class="btn btn-primary">Add IP Address</button>
  </div>