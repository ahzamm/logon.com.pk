@extends('admin.layouts.app')
@push('style')
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush
@section('content')
  <style>
    .move {
      cursor: move;
    }

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
                <h3 class="card-title">View All Menus </h3>
                <a class="btn btn-success btn-sm float-right" href="{{ route('front-menus.create') }}"><i class="fa fa-plus"></i></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped" id="example1">
                  <thead>
                    <tr>
                      <th>Sr.No</th>
                      <th>Menu Name</th>
                      <th>Parent Menu Name</th>
                      <th>Slug</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="sortFrontMenus" class="move">
                    @foreach ($menus as $key => $item)
                      <tr>
                        <td>{{ ++$key }}<input type="hidden" class="order-id" value="{{ $item->id }}"></td>
                        <td>{{ $item->menu_name }}</td>
                        <td>{{ $item->parent_id == 0 ? 'N/A' : $item->parent->menu_name }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>
                          <label class="switch">
                            <input type="checkbox" class="status_check" @if ($item->status == 1) checked @endif data-user-id="{{ $item->id }}">
                            <span class="slider round"></span>
                          </label>
                        </td>
                        <td>
                          <button class="btn btn-success btn-sm viewFrontPages" data-value="{{ $item->id }}"><i class="fa fa-eye"></i></button>
                          <a class="btn btn-primary btn-sm" href="{{ route('front-menus.edit', $item->id) }}"><i class="fa fa-edit"></i></a>
                          <button class="btn btn-danger btn-sm btnDeleteFrontMenu" data-value="{{ $item->id }}"><i class="fa fa-trash"></i></button>
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
  <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true
        //   "autoWidth": false,
      });
    });
    $(document).on('click', '.viewFrontPages', function() {
      $('#frontPagesModal').modal('show').find('.modal-content').html(`<div class="modal-body">
            <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
        </div>`);
      id = $(this).attr('data-value');
      $.ajax({
        method: 'get',
        url: '/admin/front-menus/' + id,
        dataType: 'html',
        success: function(res) {
          $('#frontPagesModal').find('.modal-content').html(res);
        },
        error: function(jhxr, status, err) {
          console.log(jhxr);
        }
      })
    })

    $(document).on('click', '.btnDeleteFrontMenu', function() {
      if (!confirm("Are you sure you want to delete this record")) {
        return;
      }
      id = $(this).attr('data-value');
      $.ajax({
        method: 'delete',
        url: '/admin/front-menus/' + id,
        dataType: 'json',
        success: function(res) {
          if (res.status) {
            window.location.reload();
          }
        }
      })
    })

    // Changing Status with event delegation
    let changeStatusUrl = "{{ route('front-menu.status') }}";
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
              text: "Front Menu Status Has been Changed!",
              animation: false,
              customClass: 'animated pulse',
              type: 'success',
            });
          }
        }
      })
    });


    // Sorting Data Start
    $(function() {
      $("#sortFrontMenus").sortable({
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

    let sortTable = $("#sortFrontMenus");
    let sortingUrl = "{{ route('front-menu.sort') }}";
    let csrfToken = "{{ csrf_token() }}"; // Include CSRF token for security
    var editUrlFront = "{{ route('front-menus.edit', ':menu') }}";

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
            response.forEach(function(value, index) {
              console.log(value);
              table += `<tr class="table-row">
                <td>${index + 1}<input type="hidden" class="order-id" value="${value.id}"></td>
                <td>${value.menu_name}</td>
                <td>${value.parent_id == 0 ? 'N/A' : value.parent.menu_name}</td>
                <td>${value.slug}</td>
                <td>
                  <label class="switch">
                    <input type="checkbox" class="status_check" ${value.status == 1 ? 'checked' : ''} data-user-id="${value.id}">
                    <span class="slider round"></span>
                  </label>
                </td>
                <td>
                  <button class="btn btn-success btn-sm viewFrontPages" data-value="${value.id}"><i class="fa fa-eye"></i></button>
                  <a class="btn btn-primary btn-sm" href="${editUrlFront.replace(':menu', value.id)}"><i class="fa fa-edit"></i></a>
                  <button class="btn btn-danger btn-sm btnDeleteFrontMenu" data-value="${value.id}"><i class="fa fa-trash"></i></button>
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
