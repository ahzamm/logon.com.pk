@extends('admin.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('admin/plugins/toastr/toastr.min.css')}}">
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
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">View All Contact Us Request </h3>
                      <button class="btn btn-primary float-right btn-sm" id="emailEdit">Edit Emails</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Username</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Add_Date</th>
                                    <th>Message</th>
                                    {{-- <th>Status</th>
                                    <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($frontContact as $key=> $item)
                                    <tr>
                                    <td>{{++$key}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->subject}}</td>
                                        <td>{{$item->created_at}}</td>
                                        <td>{{$item->message}}</td>
                                        <td> <button class="btn btn-danger btn-sm btnDeleteContactRequest" data-value="{{$item->id}}"><i class="fa fa-trash"></i></button></td>
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
<script src="{{asset('admin/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script>
  function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
  $(function () {
    $("#example1").DataTable({
      "responsive": true
    //   "autoWidth": false,
    });
  });
  $(document).on('click','#emailEdit',function(){
      $('#frontPagesModal').modal('show').find('.modal-content').html(`<div class="modal-body">
            <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
        </div>`);
        id = $(this).attr('data-value');
        $.ajax({
            method:'get',
            url:'/admin/front-emails/edit',
            dataType: 'html',
            success:function(res){
                $('#frontPagesModal').find('.modal-content').html(res);
            },
            error:function(jhxr,err,status)
            {
              console.log(jhxr);
            }
        })
  })
  $(document).on('click','.removeMail',function(){
    $(this).parents('li').remove();
  });
  $(document).on('click','#addEmail',function(){
    email = $('#email').val();
    if(email != '' && validateEmail(email) )
    {
      $('.todo-list').append(`<li>
                <span class="text">${email}</span>
                <span class="float-right removeMail" style="cursor: pointer">
                    <i class="fas fa-times"></i>
                </span>
                <input type="hidden" name="emails[]" value="${email}">
            </li>`);
      $('#email').removeClass('is-invalid').val('');
    }
    else
    {
      $('#email').addClass('is-invalid')
    }
  })
  // changeContactEmail
  $(document).on('click','#updateEmails',function(){
    $.ajax({
            url: "/admin/front-emails/edit",
            type: "POST",
            data:  new FormData(document.forms.namedItem("changeContactEmail")),
            contentType: false,
            cache: false,
            processData:false,
            dataType:'JSON',
            beforeSend:function(){
            // $('#loader-img').css('display','block');
            },
            success:function(res){
               if(res.status)
               {
                  $('#frontPagesModal').modal('hide');
                  toastr.info('Emails Updated Successfully');
               }
            },
            error:function(jhxr,status,err)
            {
               console.log(jhxr);
            },
            complete:function()
            {
              //  $('#loader-img').css('display','none');
            }
         });
  })

  $(document).on('click','.btnDeleteContactRequest',function(){
        if(!confirm("Are you sure you want to delete this record"))
        {
            return;
        }
        id = $(this).attr('data-value');
        $.ajax({
            method:'delete',
            url:'/admin/front-contact/'+id,
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
