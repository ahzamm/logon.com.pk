<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Corporate Details</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    @if ($corporate->logo)
    <img src="{{asset('corporate/'.$corporate->logo)}}" alt="" srcset="" class="img-fluid" height="200">
    @endif
    <dl class="mt-2">
        <dt>Page Heading</dt>
        <dd>{{$corporate->name}}</dd>

        <dt>Meta Tag</dt>
        <dd>{{$corporate->email != null ? $corporate->email:'N/A'}}</dd>

        <dt>Meta Description</dt>
        <dd>{{$corporate->address != null ? $corporate->address:'N/A'}}</dd>

        <dt>Page Title</dt>
        <dd>{{$corporate->contact != null ? $corporate->contact:'N/A'}}</dd>

        <dt>Slogan</dt>
        <dd>{{$corporate->active != 1 ? 'Active':'Deactive'}}</dd>
    </dl>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
