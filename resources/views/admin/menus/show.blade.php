<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Menu Details</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <dl class="mt-2">
        <dt>Menu name</dt>
        <dd>{{$menu->menu_name}}</dd>

        <dt>Slug</dt>
        <dd>{{$menu->slug}}</dd>

        <dt>Page Name</dt>
        <dd>{{$menu->frontPage == null ?'N/A':$menu->frontPage->name}}</dd>

        <dt>Parent Menu</dt>
        <dd>{{$menu->parent_id != 0?$menu->parent->menu_name:'N/A'}}</dd>

        <dt>Status</dt>
        <dd>{{$menu->status == 1?'Active':'Deactive'}}</dd>
    </dl>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
