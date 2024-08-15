@extends('admin.layouts.app')
@push('style')
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('sweet-alert/sweetalert2.css') }}">
@endpush
@section('content')
@section('title', 'All Menus')
<style>
   .move {
      cursor: move;
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
              <h5 class="card-title">All Menus</h5>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <div class="">
                    <a href="{{ route('menus.create') }}" class="btn btn-outline-primary">Add Menu / SubMenus</a>
                    {{-- <button class="btn btn-info float-md-right mt-2 mt-lg-0" id="SortMenu">Sort Menus</button> --}}
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive scrol">
                    <table id="example" style="width: 100%;" class="table table-scrolled">
                      <thead>
                        <tr>
                          <th>Sno.</th>
                          <th>Parent Menu</th>
                          <th>Total Sub Menus</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="sortAdminMenu" class="move">
                        @foreach ($collection as $key => $menu)
                          <tr data-submenu-count="{{ $menu->submenus->count() }}">
                            <td>{{ $key + 1 }}<input type="hidden" class="order-id" value="{{ $menu->id }}"></td>
                            <td>{{ $menu->menu }}</td>
                            <td>{{ $menu->submenus->count() }}</td>
                            <td>
                              <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                              <button class="btn btn-sm btn-danger btnDeleteMenu" data-value="{{ $menu->id }}"><i class="fa fa-trash"></i></button>
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
        </div>
      </div>
    </div>
  </section>
</div>


<div class="modal fade" id="SortMenuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sortable Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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
    </div>
  </div>
</div>
@endsection()
@push('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('sweet-alert/sweetalert2.min.js') }}"></script>
<script>
  // $(function() {
  //  $( "#sortable" ).sortable();
  //  $( "#sortable" ).disableSelection();
  // });
  // $(document).ready(function() {
  //   $('#example').DataTable();

  //   //Delete Menu
  //   $('.btnDeleteMenu').click(function() {
  //     menuId = $(this).attr('data-value');
  //     row = $(this);
  //     swal({
  //       title: 'Are you sure?',
  //       text: "You want to delete this record",
  //       animation: false,
  //       customClass: 'animated pulse',
  //       type: 'warning',
  //       showCancelButton: true,
  //       confirmButtonColor: '#3085d6',
  //       cancelButtonColor: '#d33',
  //       confirmButtonText: 'Yes, Delete it!',
  //       cancelButtonText: 'No, cancel!',
  //       confirmButtonClass: 'btn btn-success',
  //       cancelButtonClass: 'btn btn-danger',
  //       buttonsStyling: true,
  //       reverseButtons: true
  //     }).then(function(result) {
  //       if (result.value) {
  //         $.ajax({
  //           url: '/admin/menus/delete/' + menuId,
  //           method: 'post',
  //           dataType: 'json',
  //           success: function(res) {
  //             if (res.status) {

  //               $(row).parents('tr').remove();
  //               swal('Updated!', 'Menu / SubMenus deleted', 'success');
  //               // console.log("delete record");
  //             } else {
  //               //$(secondInput).siblings('span').removeClass('d-none');
  //             }

  //           },
  //           error: function(jhxr, status, err) {
  //             console.log(jhxr);
  //           }
  //         })
  //       } else if (result.dismiss === 'cancel') {
  //         //  swal(
  //         //      'Cancelled',
  //         //      'Your imaginary data is safe :)',
  //         //      'error'
  //         //  )
  //       }
  //     })

  //   })
  //   //delete menu end
  // });

  $(document).on('click', '.btnDeleteMenu', function() {
      if (!confirm("Are you sure you want to delete this record")) {
        return;
      }
      id = $(this).attr('data-value');
      console.log(id);
      $.ajax({
        method: 'post',
        url: '/admin/menus/delete/' + id,
        dataType: 'json',
        success: function(res) {
          if (res.status) {
            window.location.reload();
          }
        }
      })
    })
  //  $(document).on('click','#SortMenu',function(){
  //      $('#SortMenuModal').modal('show');
  //      id = $(this).attr('data-value');
  //      $.ajax({
  //              url:"{{ route('menus.sort') }}",
  //              method:'get',
  //              dataType:'html',
  //              beforeSend:function(){
  //                $('#SortMenuModal div.modal-body').html(`<div class="p-2 d-flex justify-content-center">
  //                      <div class="sk-wave text-center">
  //                         <div class="sk-rect sk-rect1"></div>
  //                         <div class="sk-rect sk-rect2"></div>
  //                         <div class="sk-rect sk-rect3"></div>
  //                         <div class="sk-rect sk-rect4"></div>
  //                         <div class="sk-rect sk-rect5"></div>
  //                      </div>
  //                   </div>`);
  //              },
  //              success:function(res){
  //                 $('#SortMenuModal div.modal-body').html(res);
  //                 $( "#sortable" ).sortable();
  //                $( "#sortable" ).disableSelection();
  //              },
  //              error:function(jhxr,status,err)
  //              {
  //                  console.log(jhxr);
  //              },
  //              complete:function()
  //              {

  //              }
  //      });
  //      //ajax end
  //  })
  //  $(document).on('click','#SortPostBtn',function(){
  //       $.ajax({
  //          url: "/admin/menus/sort",
  //          type: "POST",
  //          data:  new FormData(document.forms.namedItem("sortMenuForm")),
  //          contentType: false,
  //          cache: false,
  //          processData:false,
  //          dataType:'JSON',
  //          beforeSend:function(){
  //          $('#loader-sortmenu-img').css('display','block');
  //          },
  //          success:function(res){
  //             if($.isEmptyObject(res.error)){
  //                if(res.status)
  //                {
  //                   window.location.reload();
  //                }
  //             }
  //             else
  //             {
  //                //printErrorMsg(res.error,'#receiveSubmitError');
  //             }
  //          },
  //          error:function(jhxr,status,err)
  //          {
  //             console.log(jhxr);
  //          },
  //          complete:function()
  //          {
  //             $('#loader-sortmenu-img').css('display','none');
  //          }
  //       });
  //  });

  // Sorting Data Start
  $(function() {
    $("#sortAdminMenu").sortable({
      helper: function(e, ui) {
        ui.children().each(function() {
          $(this).width($(this).width());
        });
        return ui;
      },
      placeholder: "ui-sortable-placeholder"
    });
    $("#sortable").disableSelection();
  });

  let sortTable = $("#sortAdminMenu");
  let sortingUrl = "{{ route('menus.sort') }}";
  let csrfToken = "{{ csrf_token() }}"; // Include CSRF token for security
  var editUrlMenu = "{{ route('menus.edit', ':menu') }}";

  $(sortTable).sortable({
    update: function(event, ui) {
      var SortIds = $(this).find('.order-id').map(function() {
        return $(this).val().trim();
      }).get();

      $.ajax({
        url: sortingUrl,
        type: "POST",
        data: {
          sort_Ids: SortIds
        },
        headers: {
          "X-CSRF-TOKEN": csrfToken
        },
        success: function(response) {
          let table = "";
          response.forEach(function(item, index) {
            let existingRow = $(`#sortAdminMenu [value="${item.id}"]`).closest('tr');
            let submenuCount = existingRow.data('submenu-count') || 0;
            table += `<tr class="table-row" data-submenu-count="${submenuCount}">
            <td>${index + 1}<input type="hidden" class="order-id" value="${item.id}"></td>
            <td>${item.menu}</td>
           
            <td>${item.submenus.length}</td>
            <td>
              <a href="${editUrlMenu.replace(':menu', item.id)}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
              <button class="btn btn-sm btn-danger btnDeleteMenu" data-value="${item.id}"><i class="fa fa-trash"></i></button>
            </td>
          </tr>`;
          });
          $(sortTable).html(table);
        }
      });
    },
    helper: function(e, ui) {
      ui.children().each(function() {
        $(this).width($(this).width());
      });
      return ui;
    },
    placeholder: "ui-sortable-placeholder"
  });
  // Sorting Data End
</script>
@endpush
