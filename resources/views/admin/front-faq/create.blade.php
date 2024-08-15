@extends('admin.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-outline card-info">
              <div class="card-header">
                <h3 class="card-title">
                  Create Frequently Ask Question
                </h3>
                <div class="ml-auto">
                  <a class=" float-right btn btn-outline-secondary btn-sm" href="{{ route('front-faqs.index') }}">
                    <i class="fa fa-arrow-left"></i> Back
                  </a>
                </div>
              </div>
              <form action="{{route('front-faqs.store')}}" method="POST" enctype="multipart/form-data">
              <!-- /.card-header -->
              <div class="card-body pad">
                
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                              <label for="">Question</label>
                            <textarea name="question" rows="4" class="form-control"></textarea>
                              @error('question')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label for="">Answer</label>
                              <textarea name="answer" rows="5" class="form-control"></textarea>
                              @error('answer')
                                  <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                              @enderror
                            </div>
                        </div>
                        
                        {{-- <div class="col-md-6">
                            <label for="">Is Active</label>
                            <div class="form-group clearfix">
                                
                                <div class="icheck-success d-inline">
                                  <input type="checkbox"  checked name="active" id="checkboxSuccess1">
                                  <label for="checkboxSuccess1">
                                      Status
                                  </label>
                                </div>
                              </div>
                        </div> --}}
                    </div>
                 
                
                
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right"><i class="far fa-guitar-electric"></i>Submit</button>
              </div>
            </form>
            </div>
          </div>
          <!-- /.col-->
        </div>
        <!-- ./row -->
      </section>
      
</div>
@endsection
@push('scripts')
<script src="{{asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
      function formatState(state) {
          if (!state.id) {
            return state.text;
          }
        var $state = $(
          "<i class='"+state.element.value+"''></i> <span style='color:black;margin-left:10px'>"+state.element.value+"</span>"
            );
            return $state;
        }
    $(function(){
        $('.selectList').select2({
            theme: 'bootstrap4'
        })

        
        $('#selectIcon').select2({
          theme: 'bootstrap4',
          templateResult: formatState,
          templateSelection: formatState
        });
        
    })
</script>
@endpush