<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Page Details</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    {{-- @if ($coveragerequest->banner_image)
    <p class="text-center">Banner Image</p>
    <img src="{{asset('pagesbanner/'.$coveragerequest->banner_image)}}" alt="" srcset="" class="img-fluid" height="200">
    @endif --}}
    <dl class="mt-2">
        <dt>Name</dt>
        <dd>{{$coveragerequest->name}}</dd>

        <dt>Address</dt>
        <dd>{{$coveragerequest->address}}</dd>

        <dt>Nearest Landmark</dt>
        <dd>{{$coveragerequest->landmark}}</dd>

        <dt>Email</dt>
        <dd>{{$coveragerequest->email}}</dd>

        <dt>Mobile Number</dt>
        <dd>{{$coveragerequest->mobile_number}}</dd>

        <dt>Number of users</dt>
        <dd>{{$coveragerequest->no_of_users}}</dd>

        <dt>Request Type</dt>
        <dd>{{$coveragerequest->request_type}}</dd>

        <dt>City</dt>
        <dd>{{$coveragerequest->city->name}}</dd>

        <dt>Core Area</dt>
        <dd>{{$coveragerequest->coreArea->name}}</dd>

        <dt>Zone Area</dt>
        <dd>{{$coveragerequest->zoneArea->name}}</dd>
    </dl>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
