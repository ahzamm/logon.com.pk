<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Update Emails</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <div class="row mb-2">
        <div class="col-8">
            <input type="text" class="form-control mb-2 mr-sm-2" id="email" placeholder="Enter New Email">
            <div class="invalid-feedback">
                Invalid email address
            </div>
        </div>
        <div class="col-4">
            <button type="button" class="btn btn-success mb-2 float-right" id="addEmail">Add</button>
        </div>
    </div>
    <form action="" id="changeContactEmail">
        <input type="hidden" name="emailId" value="{{$frontEmail->id}}">
        <ul class="todo-list" data-widget="todo-list">
            @foreach ($emails as $item)
            <li>
                <span class="text">{{$item}}</span>
                <span class="float-right removeMail" style="cursor: pointer">
                    <i class="fas fa-times"></i>
                </span>
                <input type="hidden" name="emails[]" value="{{$item}}">
            </li>
            @endforeach
        </ul>
    </form>
  </div>
  <div class="modal-footer">
      <img src="" alt="">
    <button type="button" class="btn btn-primary" id="updateEmails">Update</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
