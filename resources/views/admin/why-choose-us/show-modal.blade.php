<div class="modal-header">
    <h5 class="modal-title" id="whyChooseUsModal">Details</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    @if ($whychooseus->icon)
    <p class="text-center">Icon</p>
    <img src="{{asset('why-choose-us/'.$whychooseus->icon)}}" alt="" srcset="" class="img-fluid" height="200">
    @endif
    <dl class="mt-2">
        <dt>Page Heading</dt>
        <dd>{{$whychooseus->heading}}</dd>

        <dt>Meta Tag</dt>
        <dd>{{$whychooseus->text}}</dd>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
