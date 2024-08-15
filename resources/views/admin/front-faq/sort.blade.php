<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Sort Faqs</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form action="" method="post" id="faqSortForm">
      <div class="card">
        <div class="card-body">
          <ul class="todo-list" data-widget="todo-list">
            @foreach ($frontfaq as $item)
            <li>
                <!-- drag handle -->
                <span class="handle">
                  <i class="fas fa-ellipsis-v"></i>
                  <i class="fas fa-ellipsis-v"></i>
                </span>
                <!-- todo text -->
                <span class="text">{{$item->question}}</span>
              <input type="hidden" name="faq[]" value="{{$item->id}}">
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </form>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>