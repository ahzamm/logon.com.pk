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
                      <h3 class="card-title">View All Allowed IP Addresses</h3>
                    <button class="btn btn-success btn-sm float-right" id="addIp"><i class="fa fa-plus"></i></button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Person Name</th>
                                    <th>IP Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ips as $key=> $item)
                                    <tr>
                                    <td>{{++$key}}</td>
                                        <td>{{$item->person_name}}</td>
                                        <td>{{$item->ip_address}}</td>
                                        <td>
                                        <button class="btn btn-primary btn-sm btnEditIP" data-value="{{$item->id}}"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm btnDeleteIP" data-value="{{$item->id}}"><i class="fa fa-trash"></i></button>
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
@include('admin.allowedip._modal')
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
  $(document).on('click','#addIp',function(){
      $('#AllowedIpModel').modal('show').find('.modal-content').html(`<div class="modal-body">
            <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
        </div>`);
        id = $(this).attr('data-value');
        $.ajax({
            method:'get',
            url:'/admin/allowedip/create',
            dataType: 'html',
            success:function(res){
                $('#AllowedIpModel').find('.modal-content').html(res);
            }
        })
  })
  $(document).on('submit','#ipAddForm',function(e){
      e.preventDefault();
      $.ajax({
            url: "{{route('allowedip.store')}}",
            type: "POST",
            data:  new FormData(document.forms.namedItem("ipAddForm")),
            contentType: false,
            cache: false,
            processData:false,
            dataType:'JSON',
            beforeSend:function(){
            $('#loader-img').css('display','block');
            },
            success:function(res){
               if($.isEmptyObject(res.error)){
                  if(res.status)
                  {
                     window.location.reload();
                  }
               }
               else
               {
                  printErrorMsg(res.error,'#AllowedIpError');
               }
            },
            error:function(jhxr,status,err)
            {
               console.log(jhxr);
            },
            complete:function()
            {
               $('#loader-img').css('display','none');
            }
         });
  })
  $(document).on('click','.btnDeleteIP',function(){
        if(!confirm("Are you sure you want to delete this record"))
        {
            return;
        }
        id = $(this).attr('data-value');
        $.ajax({
            method:'delete',
            url:'/admin/allowedip/'+id,
            dataType: 'json',
            success:function(res){
                if(res.status)
                {
                    window.location.reload();
                }
            }
        })
  })
  $(document).on('click','.btnEditIP',function(){
      $('#AllowedIpModel').modal('show').find('.modal-content').html(`<div class="modal-body">
            <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
        </div>`);
        id = $(this).attr('data-value');
        $.ajax({
            method:'get',
            url:'/admin/allowedip/'+id+'/edit',
            dataType: 'html',
            success:function(res){
                $('#AllowedIpModel').find('.modal-content').html(res);
            }
        })
  })
  $(document).on('submit','#ipEditForm',function(e){
      e.preventDefault();
      $.ajax({
            url: "{{route('allowedip.update',1)}}",
            type: "PUT",
            data:  $('#ipEditForm').serialize(),
            dataType:'JSON',
            beforeSend:function(){
            $('#loader-img').css('display','block');
            },
            success:function(res){
               if($.isEmptyObject(res.error)){
                  if(res.status)
                  {
                     window.location.reload();
                  }
               }
               else
               {
                  printErrorMsg(res.error,'#EditAllowedIpError');
               }
            },
            error:function(jhxr,status,err)
            {
               console.log(jhxr);
            },
            complete:function()
            {
               $('#loader-img').css('display','none');
            }
         });
  })
  
</script>
@endpush
