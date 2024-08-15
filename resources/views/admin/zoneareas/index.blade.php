@extends('admin.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('admin/plugins/toastr/toastr.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">    
@endpush
@section('content')
<style>

    .switch {
     position: relative;
     display: inline-block;
     width: 55px;
     height: 27px;
   }

   .switch input {
     opacity: 0;
     width: 0;
     height: 0;
   }

   .slider {
     position: absolute;
     cursor: pointer;
     top: 0;
     left: 0;
     right: 0;
     bottom: 0;
     background-color: #ccc;
     -webkit-transition: .4s;
     transition: .4s;
   }

   .slider:before {
     position: absolute;
     content: "";
     height: 20px;
     width: 20px;
     left: 4px;
     bottom: 4px;
     background-color: white;
     -webkit-transition: .4s;
     transition: .4s;
   }

   input:checked+.slider {
     background-color: green;
   }

   input:focus+.slider {
     box-shadow: 0 0 1px #2196F3;
   }

   input:checked+.slider:before {
     -webkit-transform: translateX(26px);
     -ms-transform: translateX(26px);
     transform: translateX(26px);
   }

   .slider.round {
     border-radius: 34px;
   }

   .slider.round:before {
     border-radius: 50%;
   }

</style>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                      <h3 class="card-title">View All Zone Areas</h3>
                    <button class="btn btn-success btn-sm float-right" id="addIp"><i class="fa fa-plus"></i></button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Zone Area</th>
                                    <th>Core Area</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($zoneAreas as $key=> $item)
                                    <tr>
                                    <td>{{++$key}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->coreArea->name}}</td>
                                        {{-- <td>{{$item->active == 1?'Active':'Deactive'}}</td> --}}
                                        <td>
                                            <label class="switch">
                                              <input type="checkbox" class="status_check" @if ($item->active == 1) checked @endif data-user-id="{{ $item->id }}">
                                              <span class="slider round"></span>
                                            </label>
                                        </td>
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
<script src="{{asset('admin/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            url:'/admin/zoneareas/create',
            dataType: 'html',
            success:function(res){
                $('#AllowedIpModel').find('.modal-content').html(res);
            }
        })
  })
  $(document).on('submit','#ipAddForm',function(e){
      e.preventDefault();
      $.ajax({
            url: "{{route('zoneareas.store')}}",
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
                    toastr.info('Core Area Added Successfully');
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
            url:'/admin/zoneareas/'+id,
            dataType: 'json',
            success:function(res){
                if(res.status)
                {
                    window.location.reload();
                }
                else
                {
                    alert('you don\'t delete this record');
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
            url:'/admin/zoneareas/'+id+'/edit',
            dataType: 'html',
            success:function(res){
                $('#AllowedIpModel').find('.modal-content').html(res);
            },error:function(jhxr,status,err)
            {
               console.log(jhxr);
            },
            complete:function()
            {
               $('#loader-img').css('display','none');
            }
        })
  })
  $(document).on('submit','#ipEditForm',function(e){
      e.preventDefault();
      $.ajax({
            url: "{{route('zoneareas.update',1)}}",
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

   // Changing Status with event delegation
   let changeStatusUrl = "{{ route('zonearea.status') }}";
      $(document).on('change', '.status_check', function(e) {
        let currentStatus = "";
        if ($(this).prop('checked') == true) {
          currentStatus = 1;
          $(this).closest('tr').find('.status').text('active');
        } else {
          currentStatus = 0;
          $(this).closest('tr').find('.status').text('deactive');
        }
        var status = $(this);
        e.preventDefault();
        $.ajax({
          url: changeStatusUrl,
          type: "Post",
          data: {
            id: $(this).attr("data-user-id"),
            status: currentStatus
          },
          success: function(response) {
            if (response == "success") {
              Swal.fire({
                title: 'Status Changed!',
                text: "User Status Has been Changed!",
                animation: false,
                customClass: 'animated pulse',
                type: 'success',
              });
            }
          }
        })
      });
  
</script>
@endpush
