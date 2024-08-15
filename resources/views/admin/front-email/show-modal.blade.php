<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Home Slider</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <p class="text-center">Banner Image</p>
    <img src="{{asset('homeslider/'.$homeslider->image)}}" alt="" srcset="" class="img-fluid" height="200">
    <dl class="mt-2">
        <dt>Slide Title</dt>
        <dd>{{$homeslider->title}}</dd>

        <dt>Slide Slogan</dt>
        <dd>{{$homeslider->slogan}}</dd>
    </dl>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
