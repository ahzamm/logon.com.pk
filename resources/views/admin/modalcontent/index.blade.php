@extends('admin.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">    
@endpush
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                      <h3 class="card-title">View Modal Content</h3>
                    <a class="btn btn-success btn-sm float-right" href="{{route('modalcontent.create')}}"><i class="fa fa-plus"></i></a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Content</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($content as $key=> $item)
                                    <tr>
                                    <td>{{++$key}}</td>
                                        <td>{{$item->title}}</td>
                                        <td><img src="{{asset('modalimages/'.$item->image)}}" height="60" width="120" alt="" srcset=""></td>
                                        <td>{!! $item->content !!}</td>
                                        <td>
                                            {{-- <button class="btn btn-success btn-sm viewFrontPages" data-value="{{$item->id}}"><i class="fa fa-eye"></i></button> --}}
                                            <a class="btn btn-primary btn-sm" href="{{route('modalcontent.edit',$item->id)}}"><i class="fa fa-edit"></i></a>
                                            <button class="btn btn-danger btn-sm btnDeletePopup" data-value="{{$item->id}}"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </section>
</div>
@include('admin.front_pages._modal')
@endsection
@push('scripts')
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true
    //   "autoWidth": false,
    });
  });
  $(document).on('click','.viewFrontPages',function(){
      $('#frontPagesModal').modal('show').find('.modal-content').html(`<div class="modal-body">
            <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
        </div>`);
        id = $(this).attr('data-value');
        $.ajax({
            method:'get',
            url:'/admin/front-pages/'+id,
            dataType: 'html',
            success:function(res){
                $('#frontPagesModal').find('.modal-content').html(res);
            }
        })
  })

  $(document).on('click','.btnDeletePopup',function(){
        if(!confirm("Are you sure you want to delete this record"))
        {
            return;
        }
        id = $(this).attr('data-value');
        $.ajax({
            method:'delete',
            url:'/admin/modalcontent/'+id,
            dataType: 'json',
            success:function(res){
                if(res.status)
                {
                    window.location.reload();
                }
            }
        })
  })
</script>
@endpush
