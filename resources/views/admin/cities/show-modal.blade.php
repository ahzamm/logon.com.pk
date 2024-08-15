<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Page Details</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    @if ($frontPage->banner_image)
    <p class="text-center">Banner Image</p>
    <img src="{{asset('pagesbanner/'.$frontPage->banner_image)}}" alt="" srcset="" class="img-fluid" height="200">
    @endif
    <dl class="mt-2">
        <dt>Page Heading</dt>
        <dd>{{$frontPage->name}}</dd>

        <dt>Meta Tag</dt>
        <dd>{{$frontPage->meta_tag}}</dd>

        <dt>Meta Description</dt>
        <dd>{{$frontPage->meta_description}}</dd>

        <dt>Page Title</dt>
        <dd>{{$frontPage->page_title}}</dd>

        <dt>Slogan</dt>
        <dd>{{$frontPage->slogan}}</dd>
    </dl>
    <h3 class="text-center ">Page Content</h3>
    <div>
        {!! $frontPage->content !!}
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
