@extends('admin.layouts.app')
@push('style')
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
                      <h3 class="card-title">View All Employees</h3>
                    <a class="btn btn-success btn-sm float-right" href="{{route('employee.create')}}"><i class="fa fa-plus"></i></a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $key=> $item)
                                    <tr>
                                    <td>{{++$key}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        {{-- <td>{{$item->active == 1?'active':'deactive'}}</td> --}}
                                        <td>
                                          <label class="switch">
                                            <input type="checkbox" class="status_check" @if ($item->active == 1) checked @endif data-user-id="{{ $item->id }}">
                                            <span class="slider round"></span>
                                          </label>
                                      </td>
                                        <td>
                                        {{-- <button class="btn btn-success btn-sm viewFrontPages" data-value="{{$item->id}}"><i class="fa fa-eye"></i></button> --}}
                                        <a class="btn btn-primary btn-sm" href="{{route('employee.edit',$item->id)}}"><i class="fa fa-edit"></i></a>
                                        <button class="btn btn-sm btn-info btnShowAccessModal" data-value="{{$item->id}}"><i class="fa fa-unlock"></i></button>
                                        <button class="btn btn-danger btn-sm btnDeleteEmployee" data-value="{{$item->id}}"><i class="fa fa-trash"></i></button>
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
{{-- @include('admin.front_pages._modal') --}}
<div class="modal fade" id="modalShowAccess" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modify Member Access</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="modalBody">
          <div class="p-2 d-flex justify-content-center">
             <div class="sk-wave text-center">
                 <div class="sk-rect sk-rect1"></div>
                 <div class="sk-rect sk-rect2"></div>
                 <div class="sk-rect sk-rect3"></div>
                 <div class="sk-rect sk-rect4"></div>
                 <div class="sk-rect sk-rect5"></div>
             </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
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
//   $(document).on('click','.viewFrontPages',function(){
//       $('#frontPagesModal').modal('show').find('.modal-content').html(`<div class="modal-body">
//             <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
//         </div>`);
//         id = $(this).attr('data-value');
//         $.ajax({
//             method:'get',
//             url:'/admin/front-pages/'+id,
//             dataType: 'html',
//             success:function(res){
//                 $('#frontPagesModal').find('.modal-content').html(res);
//             }
//         })
//   })
$(document).on('click','.btnShowAccessModal',function(){
      $('#modalShowAccess').modal('show');
      id = $(this).attr('data-value');
      $.ajax({
         type: 'GET',
         url: '/admin/useraccess/show/'+id,
         dataType:'html',
         beforeSend:function(){
            $('#modalBody').html(`<div class="p-2 d-flex justify-content-center">
            <div class="sk-wave text-center">
                <div class="sk-rect sk-rect1"></div>
                <div class="sk-rect sk-rect2"></div>
                <div class="sk-rect sk-rect3"></div>
                <div class="sk-rect sk-rect4"></div>
                <div class="sk-rect sk-rect5"></div>
            </div>
           </div>`);
         },
         success:function(res){
            $('#modalBody').html(res);
         },
         error:function(jhxr,status,err){
            console.log(jhxr);
         },
         complete:function(){

         }
      })

    });
    $(document).on('change','.changeAccess',function(){
      status =0;
      accessId = $(this).attr('data-value');
      if($(this).prop("checked") == true){
            status = 1;
            // console.log(accessId);
      }
      else if($(this).prop("checked") == false){
         status = 0;
      }
      $.ajax({
         type: 'POST',
         url: '/admin/useraccess/update/'+accessId,
         data:{
            access_status : status,
         },
         dataType:'json',
         beforeSend:function(){

         },
         success:function(res){
            if(res.status)
            {
               Messenger().post({message:"Access Status Change Successfully.. !",type:"success"});
            }
         },
         error:function(jhxr,status,err){
            console.log(jhxr);
         },
         complete:function(){

         }
      })
    })

    $(document).on('click','.btnDeleteEmployee',function(){
        if(!confirm("Are you sure you want to delete this record"))
        {
            return;
        }
        id = $(this).attr('data-value');
        $.ajax({
            method:'delete',
            url:'/admin/employee/'+id,
            dataType: 'json',
            success:function(res){
                if(res.status)
                {
                    window.location.reload();
                }
            }
        })
  })

   // Changing Status with event delegation
   let changeStatusUrl = "{{ route('employee.status') }}";
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
                text: "Employee Status Has been Changed!",
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
